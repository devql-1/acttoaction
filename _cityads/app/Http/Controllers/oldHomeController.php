<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Industry;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\VideoGallery;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class oldHomeController extends Controller
{
    //This method will show Our website Landing page
    public function index(){
        $sliders = Slider::where('status',1)->get();
        $service_category = ServiceCategory::where('status',1)->get();
        $services = Service::where('status',1)->latest()->get();
        $abouts = About::where('status',1)->first();
        $video_gallery = VideoGallery::where('status',1)->get();
        $testimonials = Testimonial::where('status',1)->get();
        $team_members = TeamMember::where('status',1)->get();
        $industries = Industry::where('status',1)->get();
        $projects = Blog::with('category')->where('status', 1)->get();
        $projects_categories = $projects
        ->map(function ($project) {
            return optional($project->category)->category_name;
        })->filter()->unique()->values();

        return view('frontend.index',compact('sliders','services','service_category', 'abouts','testimonials','team_members','industries','projects','projects_categories','video_gallery'));
    }

    

    public function admission_form(){
        $classes = Service::where('status',1)->get();
        return view('frontend.admission-form',compact('classes'));
    }

    public function about(){
        $abouts = About::where('status',1)->skip(1)->limit(1)->first();
        return view('frontend.about-us.index',compact('abouts'));
    }

    //This method will show Our website blog page
    public function blog(Request $request){
        $blogs = Blog::where('status',1)->paginate(6);
        $recent_blogs = Blog::where('status', 1)->orderBy('created_at', 'desc')->get();
        $blogs_categories = BlogCategory::where('status',1)->withCount('posts')->get();

        // AJAX request par sirf blogs list + pagination return karenge
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.blog.partials.blogs_list', compact('blogs'))->render(),
                'pagination' => view('frontend.blog.partials.blogs_pagination', compact('blogs'))->render(),
            ]);
        }

        return view('frontend.blog.index',compact('blogs','blogs_categories','recent_blogs'));
    }

    public function blog_filter($id)
    {
        if ($id == 'all') {
            $blogs = Blog::where('status',1)->get();
        } else {
            $blogs = Blog::where('status',1)->where('category_id', $id)->get();
        }

        // Sirf blog items ka HTML return hoga
        $html = view('frontend.blog.partials.blogs_list', compact('blogs'))->render();

        return response()->json(['html' => $html]);
    }

    public function blog_search(Request $request)
    {
        $keyword = $request->q;

        $blogs = Blog::where('status', 1)
            ->where(function($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                      ->orWhere('short_description', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->latest()
            ->get();

        $html = view('frontend..blog.partials.blogs_list', compact('blogs'))->render();

        return response()->json(['html' => $html]);
    }


    //This method will show Our website blog-details page
    public function blog_details($slug){
        $blogs = Blog::where('slug',$slug)->get();
        return view('frontend.blog.blog-details',compact('blogs'));
    }

    public function service_details($slug){
        $service = Service::where('slug',$slug)->first();
        return view('frontend.services.service-details',compact('service'));
    }


}
