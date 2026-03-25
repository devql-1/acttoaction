<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageCategory;
use App\Models\TestimonialVideo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * TestimonialVideoController
 *
 * Pure Blade/Laravel controller — no API endpoints.
 * All data is passed directly from PHP to Blade views.
 * The two response()->json() calls are for small inline
 * toggle/reorder UI actions only (not a separate API layer).
 */
class TestimonialVideoController extends Controller
{
    // ══════════════════════════════════════════════════════════
    //  VIDEOS — CRUD
    // ══════════════════════════════════════════════════════════

    public function index(Request $request)
    {
        $query = TestimonialVideo::with('pageCategory');

        if ($request->filled('page_category_id')) {
            $query->where('page_category_id', $request->page_category_id);
        }
        if ($request->filled('video_category')) {
            $query->byCategory($request->video_category);
        }
        if ($request->filled('search')) {
            $query->where(fn($q) => $q->where('title', 'like', "%{$request->search}%")->orWhere('youtube_video_id', 'like', "%{$request->search}%"));
        }

        $videos = $query->ordered()->paginate(20)->withQueryString();
        $categories = PageCategory::active()->ordered()->get();

        return view('backend.testttii.index', compact('videos', 'categories'));
    }

    public function create()
    {
        $categories = PageCategory::active()->ordered()->get();
        return view('backend.testttii.form', compact('categories'));
    }

    public function store(Request $request)
    {
        TestimonialVideo::create($this->validated($request));

        return redirect()->route('admin.testimonials.index')->with('success', 'Video added successfully.');
    }

    public function edit(TestimonialVideo $testimonialVideo)
    {
        $categories = PageCategory::active()->ordered()->get();

        return view('backend.testttii.edit', [
            'video' => $testimonialVideo,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, TestimonialVideo $testimonialVideo)
    {
        $testimonialVideo->update($this->validated($request));

        return redirect()->route('backend.testttii.index')->with('success', 'Video updated successfully.');
    }

    public function destroy(TestimonialVideo $testimonialVideo)
    {
        $testimonialVideo->delete();

        return redirect()->route('backend.testttii.index')->with('success', 'Video deleted.');
    }

    /**
     * PATCH /admin/testimonial-videos/{video}/toggle
     * Small JSON response for the inline toggle switch in the table.
     * Not an API — just a quick status flip from the admin UI.
     */
    public function toggle(TestimonialVideo $testimonialVideo)
    {
        $testimonialVideo->update(['is_active' => !$testimonialVideo->is_active]);

        return response()->json([
            'is_active' => $testimonialVideo->is_active,
            'message' => $testimonialVideo->is_active ? 'Activated.' : 'Deactivated.',
        ]);
    }

    /**
     * PATCH /admin/testimonial-videos/reorder
     * Small JSON response for drag-drop sort order in the table.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:testimonial_videos,id',
            'items.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            TestimonialVideo::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['message' => 'Order saved.']);
    }

    // ══════════════════════════════════════════════════════════
    //  PAGE CATEGORIES — CRUD
    // ══════════════════════════════════════════════════════════

    public function categories()
    {
        $categories = PageCategory::withCount('testimonialVideos')->ordered()->paginate(20);

        return view('backend.testttii.catindex', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:page_categories,slug|regex:/^[a-z0-9\-]+$/',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        PageCategory::create($data);

        return redirect()->route('admin.testimonials.categories')->with('success', 'Page category created.');
    }

    public function updateCategory(Request $request, PageCategory $pageCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9\-]+$/', Rule::unique('page_categories', 'slug')->ignore($pageCategory->id)],
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $pageCategory->update($data);

        return redirect()->route('backend.testttii.categories')->with('success', 'Category updated.');
    }

    public function destroyCategory(PageCategory $pageCategory)
    {
        $pageCategory->delete();

        return redirect()->route('backend.testttii.categories')->with('success', 'Category deleted.');
    }

    // ══════════════════════════════════════════════════════════
    //  PRIVATE
    // ══════════════════════════════════════════════════════════

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'page_category_id' => 'required|integer|exists:page_categories,id',
            'youtube_video_id' => 'required|string|max:20',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'video_category' => 'required|string|max:50',
            'video_category_label' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:10',
            'thumbnail_url' => 'nullable|url|max:500',
            'channel_name' => 'nullable|string|max:100',
            'watch_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
