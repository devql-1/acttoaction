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

        return view('frontend.Summercamp.summercamp', compact('heroBanner', 'people', 'galleryCategories', 'stats', 'about'));
    }
    public function event()
    {
        $events = Event::with('subEvents')->where('type', 'summer-event')->latest('event_date')->get();

        $videoData = YoutubeVideo::with('youtubeCategory')->latest()->get()->map(
            fn($v) => [
                'id' => $v->youtube_id,
                'thumb' => 'https://img.youtube.com/vi/' . $v->youtube_id . '/mqdefault.jpg',
                'title' => $v->name,
                'desc' => $v->youtubeCategory?->name ?? '',
                'duration' => '',
            ],
        );

        return view('frontend.Summercamp.event.event', compact('events', 'videoData'));
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
}
