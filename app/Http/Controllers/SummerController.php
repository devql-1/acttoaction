<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\TeamMember;
use App\Models\GalleryCategory;
use App\Models\HeroBanner;
use App\Models\Person;
use Illuminate\View\View;
use App\Models\Stat;
use App\Models\AboutSection;
use App\Models\SubEvent;
use App\Models\Event;
use App\Models\YoutubeVideo;
use App\Models\SummerPartner;
use App\Models\SchoolPartner;
use App\Models\SchoolPartnerCategory;
use App\Models\SchoolSection;
class SummerController extends Controller
{
    public function index(): View
    {
        $categoryId = \App\Models\YoutubeCategory::where('slug', 'parent-testimoial')->value('id');

        $videos = YoutubeVideo::where('youtube_category_id', $categoryId)
            ->latest()
            ->get()
            ->map(function ($v) {
                $cleanId = explode('?', $v->youtube_id)[0];
                return [
                    'id' => $cleanId,
                    'thumb' => 'https://img.youtube.com/vi/' . $cleanId . '/mqdefault.jpg',
                    'title' => $v->name,
                    'desc' => 'Parent testimonial',
                    'duration' => '',
                ];
            })
            ->toArray();

        if (empty($videos)) {
            $videos = [
                [
                    'id' => 'dQw4w9WgXcQ',
                    'thumb' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/mqdefault.jpg',
                    'title' => 'Fallback Video',
                    'desc' => 'No videos found',
                    'duration' => '2:30',
                ],
            ];
        }
        $heroBanner = HeroBanner::getActive();
        $stats = Stat::getActive();
        $people = Person::getBySection();
        $about = AboutSection::getActive();
        $galleryCategories = GalleryCategory::active()
            ->ordered()
            ->with([
                'images' => function ($query) {
                    $query->where('status', 1)->orderBy('sort_order')->orderBy('id');
                },
            ])
            ->get();

        return view('frontend.Summercamp.summercamp', compact('heroBanner', 'people', 'galleryCategories', 'stats', 'about', 'videos'));
    }
    public function event()
    {
        $galleryImages = \App\Models\Gallery::with('galleryCategory')
            ->latest()
            ->get()
            ->map(function ($g) {
                return [
                    'id' => $g->id,
                    'title' => $g->title,
                    'image' => asset('storage/' . $g->image),
                    'category' => $g->galleryCategory->name ?? '',
                    'slug' => $g->galleryCategory->slug ?? '',
                ];
            })
            ->toArray();
        $galleryCategories = \App\Models\Gallerycat::withCount('galleries')->get();

        $events = Event::with('subEvents')->where('type', 'summer-event')->latest('event_date')->get();
        $categoryId = \App\Models\YoutubeCategory::where('slug', 'parent-testimoial')->value('id');

        $videos = YoutubeVideo::where('youtube_category_id', $categoryId)
            ->latest()
            ->get()
            ->map(function ($v) {
                $cleanId = explode('?', $v->youtube_id)[0];
                return [
                    'id' => $cleanId,
                    'thumb' => 'https://img.youtube.com/vi/' . $cleanId . '/mqdefault.jpg',
                    'title' => $v->name,
                    'desc' => 'Parent testimonial',
                    'duration' => '',
                ];
            })
            ->toArray();

        if (empty($videos)) {
            $videos = [
                [
                    'id' => 'dQw4w9WgXcQ',
                    'thumb' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/mqdefault.jpg',
                    'title' => 'Fallback Video',
                    'desc' => 'No videos found',
                    'duration' => '2:30',
                ],
            ];
        }

        return view('frontend.Summercamp.event.event', compact('events', 'videos', 'galleryImages', 'galleryCategories'));
    }
    public function subEventDetail(SubEvent $subEvent)
    {
        $subEvent->load(['event.subEvents', 'centersWithState.state']);
        $sub = $subEvent;

        return view('frontend.Summercamp.event.subeventdetails', compact('sub'));
    }
    public function subevent(Event $event)
    {
        $event->load('subEvents');

        $otherEvents = Event::with('subEvents')->where('type', 'summer-event')->where('id', '!=', $event->id)->latest('event_date')->take(3)->get();

        return view('frontend.Summercamp.event.subevent', compact('event', 'otherEvents'));
    }
    public function partners()
    {
        $partners = SummerPartner::getByCategory();

        return view('frontend.Summercamp.partners', compact('partners'));
    }

    public function curriculum()
    {
        $schoolsByCategory = SchoolPartner::getByCategory();
        $activeCategory    = null;
        $activeSection     = null;

        return view('frontend.Summercamp.cirulum', compact('schoolsByCategory', 'activeCategory', 'activeSection'));
    }

    // ── Dynamic section pages:  /{section}  and  /{section}/{category} ──

    public function schoolSection(SchoolSection $section)
    {
        abort_unless($section->status, 404);

        $schoolsByCategory = SchoolPartner::getByCategory($section->id);
        $activeSection     = $section;
        $activeCategory    = null;

        return view('frontend.Summercamp.school-section', compact('schoolsByCategory', 'activeSection', 'activeCategory'));
    }

    public function schoolSectionCategory(SchoolSection $section, SchoolPartnerCategory $category)
    {
        abort_unless($section->status, 404);
        abort_unless($category->school_section_id === $section->id, 404);

        $schoolsByCategory = SchoolPartner::getByCategory($section->id);
        $activeSection     = $section;
        $activeCategory    = $category;

        return view('frontend.Summercamp.school-section', compact('schoolsByCategory', 'activeSection', 'activeCategory'));
    }
}
