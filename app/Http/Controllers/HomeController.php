<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;

class HomeController extends Controller
{
    public function index()
    {
        // Featured courses (first 6)
        $featuredCourses = Course::with('category')
            ->latest()
            ->take(6)
            ->get();

        // All active categories with their courses
        $categories = CourseCategory::with('courses')
            ->where('status', 1)
            ->get();

        // All courses
        $allCourses = Course::with('category')
            ->latest()
            ->get();

        return view('frontend.Home.index', compact('featuredCourses', 'categories', 'allCourses'));
    }

    public function course()
    {
        $featuredCourses = Course::with('category')
            ->latest()
            ->take(6)
            ->get();

        // All active categories with their courses
        $categories = CourseCategory::with('courses')
            ->where('status', 1)
            ->get();

        // All courses
        $allCourses = Course::with('category')
            ->latest()
            ->get();
        return view('frontend.course.course', compact('featuredCourses', 'categories', 'allCourses'));
    }
}