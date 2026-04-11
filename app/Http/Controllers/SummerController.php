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
    public function subEventDetail($id)
    {
        $sub = SubEvent::with(['event.subEvents', 'centersWithState.state'])->findOrFail($id);

        return view('frontend.Summercamp.event.subeventdetails', compact('sub'));
    }
    public function subevent($id)
    {
        $event = Event::with('subEvents')->where('type', 'summer-event')->findOrFail($id);

        $otherEvents = Event::with('subEvents')->where('type', 'summer-event')->where('id', '!=', $id)->latest('event_date')->take(3)->get();

        return view('frontend.Summercamp.event.subevent', compact('event', 'otherEvents'));
    }
    public function curriculum()
    {
        return view('frontend.Summercamp.cirulum');
    }
}
