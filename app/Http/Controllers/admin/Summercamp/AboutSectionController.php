<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutSectionController extends Controller
{
    /**
     * Single-record pattern:
     * If a record exists → show edit form.
     * If not → show create form.
     */
    public function index()
    {
        $aboutSections = AboutSection::latest()->paginate(10);
        return view('backend.Summercamp.aboutus.about-section-index', compact('aboutSections'));
    }
    public function create(): View
    {
        return view('backend.Summercamp.aboutus.about-section-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'heading' => ['required', 'string', 'max:255'],
            'lead_text' => ['nullable', 'string'],
            'body_text' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'badge_year' => ['nullable', 'string', 'max:20'],
            'badge_text' => ['nullable', 'string', 'max:60'],
            'fc_title' => ['nullable', 'string', 'max:100'],
            'fc_subtitle' => ['nullable', 'string', 'max:150'],
            'btn1_label' => ['nullable', 'string', 'max:60'],
            'btn1_url' => ['nullable', 'string', 'max:255'],
            'btn2_label' => ['nullable', 'string', 'max:60'],
            'btn2_url' => ['nullable', 'string', 'max:255'],
            // mini stats — 3 rows
            'mini_stat_num.*' => ['nullable', 'string', 'max:20'],
            'mini_stat_label.*' => ['nullable', 'string', 'max:60'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('about', 'public');
        }

        // Build mini_stats JSON from 3 separate input pairs
        $miniStats = $this->buildMiniStats($request);

        AboutSection::create([
            'heading' => $request->heading,
            'lead_text' => $request->lead_text,
            'body_text' => $request->body_text,
            'image_path' => $imagePath,
            'badge_year' => $request->badge_year,
            'badge_text' => $request->badge_text,
            'fc_title' => $request->fc_title,
            'fc_subtitle' => $request->fc_subtitle,
            'btn1_label' => $request->btn1_label,
            'btn1_url' => $request->btn1_url,
            'btn2_label' => $request->btn2_label,
            'btn2_url' => $request->btn2_url,
            'mini_stats' => $miniStats,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('about-section-index')->with('success', 'About section saved.');
    }

    public function edit(AboutSection $aboutSection): View
    {
        return view('backend.Summercamp.aboutus.about-section-edit', compact('aboutSection'));
    }

    public function update(Request $request, AboutSection $aboutSection): RedirectResponse
    {
        $request->validate([
            'heading' => ['required', 'string', 'max:255'],
            'lead_text' => ['nullable', 'string'],
            'body_text' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'badge_year' => ['nullable', 'string', 'max:20'],
            'badge_text' => ['nullable', 'string', 'max:60'],
            'fc_title' => ['nullable', 'string', 'max:100'],
            'fc_subtitle' => ['nullable', 'string', 'max:150'],
            'btn1_label' => ['nullable', 'string', 'max:60'],
            'btn1_url' => ['nullable', 'string', 'max:255'],
            'btn2_label' => ['nullable', 'string', 'max:60'],
            'btn2_url' => ['nullable', 'string', 'max:255'],
            'mini_stat_num.*' => ['nullable', 'string', 'max:20'],
            'mini_stat_label.*' => ['nullable', 'string', 'max:60'],
        ]);

        if ($request->hasFile('image')) {
            if ($aboutSection->image_path) {
                Storage::disk('public')->delete($aboutSection->image_path);
            }
            $aboutSection->image_path = $request->file('image')->store('about', 'public');
        }

        $miniStats = $this->buildMiniStats($request);

        $aboutSection->update([
            'heading' => $request->heading,
            'lead_text' => $request->lead_text,
            'body_text' => $request->body_text,
            'image_path' => $aboutSection->image_path,
            'badge_year' => $request->badge_year,
            'badge_text' => $request->badge_text,
            'fc_title' => $request->fc_title,
            'fc_subtitle' => $request->fc_subtitle,
            'btn1_label' => $request->btn1_label,
            'btn1_url' => $request->btn1_url,
            'btn2_label' => $request->btn2_label,
            'btn2_url' => $request->btn2_url,
            'mini_stats' => $miniStats,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('about-section-index')->with('success', 'About section updated.');
    }

    // ── Build mini_stats array from request inputs ────────────

    private function buildMiniStats(Request $request): array
    {
        $nums = $request->input('mini_stat_num', []);
        $labels = $request->input('mini_stat_label', []);
        $result = [];

        foreach ($nums as $i => $num) {
            if (!empty($num) || !empty($labels[$i])) {
                $result[] = [
                    'num' => $num ?? '',
                    'label' => $labels[$i] ?? '',
                ];
            }
        }

        return $result;
    }
}
