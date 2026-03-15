<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\TeamMember;
class old2HomeController extends Controller
{
    function home()
    {
        $services = Service::where('status', 1)->latest()->limit(3)->get();
        $blogs = Blog::where('status', 1)->limit(4)->latest()->get();
        return view('frontend.index', compact('services', 'blogs'));
    }

    function servicedetails($slug)
    {
        $services = Service::where('status', 1)->latest()->get();
        $servicedetails = Service::where('slug', $slug)->first();
        return view('frontend.servicedetails', compact('servicedetails', 'services'));
    }

    function service()
    {
        $services = Service::where('status', 1)->latest()->get();
        return view('frontend.service', compact('services'));
    }

    function project()
    {
        return view('frontend.project');
    }

    function projectdetails()
    {
        return view('frontend.projectdetails');
    }


    public function blog(Request $request)
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(6);
        $blogcategories = BlogCategory::where('status', 1)->withCount('posts')->get();

        // AJAX request par sirf blogs list + pagination return karenge
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.blog.partials.blogs_list', compact('blogs'))->render(),
                'pagination' => view('frontend.blog.partials.blogs_pagination', compact('blogs'))->render(),
            ]);
        }

        return view('frontend.blog.index', compact('blogs', 'blogcategories'));
    }

    public function blog_filter($id)
    {
        if ($id == 'all') {
            $blogs = Blog::where('status', 1)->get();
        } else {
            $blogs = Blog::where('status', 1)->where('category_id', $id)->get();
        }

        // Sirf blog items ka HTML return hoga
        $html = view('frontend.blog.partials.blogs_list', compact('blogs'))->render();

        return response()->json(['html' => $html]);
    }

    public function blog_search(Request $request)
    {
        $keyword = $request->q;

        $blogs = Blog::where('status', 1)
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('short_description', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->latest()
            ->get();

        $html = view('frontend..blog.partials.blogs_list', compact('blogs'))->render();

        return response()->json(['html' => $html]);
    }


    function blogdetails($slug)
    {
        $blogdetails = Blog::where('slug', $slug)->first();
        return view('frontend.blog.blogdetails', compact('blogdetails'));
    }

    function aboutus()
    {
        $teams = TeamMember::where('status', 1)->get();
        return view('frontend.aboutus', compact('teams'));
    }

    function team()
    {
        $teams = TeamMember::where('status', 1)->get();
        return view('frontend.team', compact('teams'));
    }

    function gallery()
    {
        return view('frontend.gallery');
    }

    function contactus()
    {
        return view('frontend.contactus');
    }

    function privacy()
    {
        return view('frontend.privacy');
    }
}
