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
use App\Models\stat;
use App\Models\AboutSection;
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
}
