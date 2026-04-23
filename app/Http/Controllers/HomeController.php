<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Event;
use App\Models\PsychTest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\YoutubeVideo;
use App\Models\PageCategory;
use App\Models\BlogTag;
use App\Models\ActionItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $actions = ActionItem::where('status', 1)->orderBy('order')->get();
        $category = PageCategory::where('slug', 'course-page')->firstOrFail();
        $videos = $category->activeVideos()->ordered()->get();
        $tabs = $videos
            ->groupBy(fn($item) => $item->video_category ?? 'uncategorized')
            ->map(function ($g, $key) {
                return [
                    'key' => $key,
                    'label' => optional($g->first())->category_label,
                ];
            })
            ->values();
        // Featured courses (first 6)
        $featuredCourses = Course::with('category')->latest()->take(6)->get();

        // All active categories with their courses
        $categories = CourseCategory::with('courses')->where('status', 1)->get();

        // All courses
        $allCourses = Course::with('category')->latest()->get();

        return view('frontend.Home.index', compact('featuredCourses', 'categories', 'allCourses', 'videos', 'tabs', 'actions'));
    }

    public function course()
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

        $featuredCourses = Course::with('category', 'centers')->latest()->take(6)->get();

        $categories = CourseCategory::withCount('courses')->with('courses')->get();

        $allCourses = Course::with(['category', 'centers.state'])
            ->latest()
            ->get();

        return view(
            'frontend.course.course',
            compact(
                'featuredCourses',
                'categories',
                'allCourses',
                'videos', // ← don't forget to pass videos to the view
                'galleryImages',
                'galleryCategories',
            ),
        );
    }
    /**
     * Show courses by category
     */
    public function cat_course(CourseCategory $courseCategory)
    {
        $courseCategory->load([
            'courses' => function ($q) {
                $q->with(['sessions', 'documents', 'centers'])->latest();
            },
        ]);
        $currentCategory = $courseCategory;

        // All categories for the switcher bar (with course count)
        $allCategories = CourseCategory::with('courses')->where('status', 1)->get();

        return view('frontend.course.cat_course', compact('currentCategory', 'allCategories'));
    }

    /**
     * Show single course detail by slug
     */
    // public function course_detail($slug)
    // {
    //     dd($slug);
    //     $course = Course::with(['category', 'centers.state', 'sessions', 'documents'])
    //         ->where('slug', $slug)
    //         ->firstOrFail();

    //     // Get related courses (same category)
    //     $relatedCourses = Course::with('category', 'centers')->where('category_id', $course->category_id)->where('id', '!=', $course->id)->latest()->take(3)->get();

    //     return view('frontend.course.course-detail', compact('course', 'relatedCourses'));
    // }

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

        $events = Event::with('subEvents')
            ->whereNull('type')
            ->latest('event_date')
            ->get();

        return view('frontend.event.event', compact('events', 'videos', 'galleryImages', 'galleryCategories'));
    }

    public function subevent(Event $event)
    {
        abort_if($event->type === 'summer-event', 404);

        $event->load('subEvents');

        $otherEvents = Event::with('subEvents')
            ->whereNull('type')
            ->where('id', '!=', $event->id)
            ->latest('event_date')
            ->take(3)
            ->get();

        return view('frontend.event.subevent', compact('event', 'otherEvents'));
    }

    public function quicktest(Request $request)
    {
        // ================= BLOG DATA =================
        $categories = BlogCategory::where('status', 1)
            ->withCount(['posts' => fn($q) => $q->where('status', 1)])
            ->get();

        $totalBlogs = Blog::where('status', 1)->count();

        $featured = Blog::with(['author', 'category'])
            ->where('status', 1)
            ->latest()
            ->first();

        $blogsQuery = Blog::with(['author', 'category', 'tags'])->where('status', 1);

        // Filter by category
        if ($categorySlug = $request->category) {
            $blogsQuery->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Filter by tag
        if ($tagSlug = $request->tag) {
            $blogsQuery->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        $blogs = $blogsQuery->latest()->paginate(6)->withQueryString();

        $recentPosts = Blog::with('category')->where('status', 1)->latest()->limit(5)->get();

        $tags = BlogTag::withCount('blogs')->having('blogs_count', '>', 0)->orderByDesc('blogs_count')->limit(20)->get();

        // ================= QUICK TEST DATA =================
        $tests = PsychTest::withCount(['categories', 'questions'])
            ->latest()
            ->get();

        if ($tests->isEmpty()) {
            return view('frontend.quick-test.no-tests');
        }

        // ================= RETURN VIEW =================
        return view('frontend.quick-test.quicktest', compact('tests', 'categories', 'totalBlogs', 'featured', 'blogs', 'recentPosts', 'tags'));
    }

    public function show(PsychTest $psychTest)
    {
        $test = $psychTest->loadCount(['categories', 'questions']);

        $categories = $test->categories()->withCount('questions')->get();
        if ($categories->isEmpty() || $test->questions()->count() === 0) {
            return abort(404);
        }
        return view('frontend.quick-test.quizdetails', compact('test', 'categories'));
    }

    public function take(PsychTest $psychTest)
    {
        $test = $psychTest->load([
            'categories' => fn($q) => $q->orderBy('id'),
            'categories.questions' => fn($q) => $q->orderBy('id'),
        ]);

        $allQuestions = $test->categories->flatMap(fn($cat) => $cat->questions);
        $totalQuestions = $allQuestions->count();

        if ($totalQuestions === 0) {
            return redirect()->route('frontend.tests.show', $psychTest->slug)->with('error', 'This test has no questions yet.');
        }
        if ($test->categories->isEmpty() || $totalQuestions === 0) {
            return abort(404);
        }
        return view('frontend.quick-test.take', [
            'test' => $test,
            'categories' => $test->categories,
            'allQuestions' => $allQuestions, //
            'totalQuestions' => $totalQuestions,
        ]);
    }

    // public function submit(Request $request, $id)
    // {
    //     $test = PsychTest::with([
    //         'categories.questions'
    //     ])->findOrFail($id);

    //     $answers = $request->input('answers', []); // ['question_id' => score]

    //     // Build per-category scores
    //     $categoryResults = [];
    //     $totalScore = 0;
    //     $totalAnswered = 0;
    //     $maxPossible = 0;

    //     foreach ($test->categories as $category) {
    //         $catScore = 0;
    //         $catAnswered = 0;
    //         $catMax = $category->questions->count() * 5; // max 5 per question

    //         foreach ($category->questions as $question) {
    //             $score = isset($answers[$question->id])
    //                 ? (int) $answers[$question->id]
    //                 : 0;

    //             if (isset($answers[$question->id])) {
    //                 $catScore += $score;
    //                 $catAnswered++;
    //                 $totalAnswered++;
    //             }
    //         }

    //         $catPercent = $catMax > 0 ? round(($catScore / $catMax) * 100) : 0;

    //         $categoryResults[] = [
    //             'name' => $category->name,
    //             'score' => $catScore,
    //             'max' => $catMax,
    //             'answered' => $catAnswered,
    //             'total_qs' => $category->questions->count(),
    //             'percent' => $catPercent,
    //             'level' => $catPercent >= 75 ? 'High'
    //                 : ($catPercent >= 45 ? 'Moderate' : 'Low'),
    //             'color' => $catPercent >= 75 ? '#16a34a'
    //                 : ($catPercent >= 45 ? '#f59e0b' : '#e11d48'),
    //         ];

    //         $totalScore += $catScore;
    //         $maxPossible += $catMax;
    //     }

    //     $overallPercent = $maxPossible > 0
    //         ? round(($totalScore / $maxPossible) * 100)
    //         : 0;

    //     return view('frontend.quick-test.quiz-result', compact(
    //         'test',
    //         'categoryResults',
    //         'totalScore',
    //         'maxPossible',
    //         'overallPercent',
    //         'totalAnswered'
    //     ));
    // }
    public function submit(Request $request, PsychTest $psychTest)
    {
        $request->validate([
            'answers' => 'required|string',
        ]);

        $test = $psychTest->load([
            'categories' => fn($q) => $q->orderBy('id'),
            'categories.questions' => fn($q) => $q->orderBy('id'),
        ]);

        $rawAnswers = json_decode($request->answers, true);
        $allQuestions = $test->categories->flatMap(fn($cat) => $cat->questions)->values();
        $totalQuestions = $allQuestions->count();
        $maxScore = $totalQuestions * 5;
        $totalScore = 0;

        // Category scores
        $categoryScores = [];
        $questionIndex = 0;

        foreach ($test->categories as $cat) {
            $catEarned = 0;
            $catMax = $cat->questions->count() * 5;

            foreach ($cat->questions as $question) {
                $answer = $rawAnswers[$questionIndex] ?? 3;
                $catEarned += $answer;
                $totalScore += $answer;
                $questionIndex++;
            }

            $categoryScores[] = [
                'name' => $cat->category_name ?? ($cat->name ?? 'Section'),
                'icon' => $cat->icon ?? '📋',
                'color' => $cat->color ?? '#175cdd',
                'score' => $catMax > 0 ? (int) round(($catEarned / $catMax) * 100) : 0,
            ];
        }

        $overallPercent = $maxScore > 0 ? (int) round(($totalScore / $maxScore) * 100) : 0;

        // Type scores
        $typeKeys = ['performer', 'empath', 'creator', 'leader', 'voice', 'director'];
        $chunkSize = max(1, (int) ceil(count($rawAnswers) / 6));
        $typeScores = [];

        foreach ($typeKeys as $i => $key) {
            $slice = array_slice($rawAnswers, $i * $chunkSize, $chunkSize);
            $slice = array_filter($slice, fn($v) => $v !== null);
            if (empty($slice)) {
                $typeScores[$key] = 0;
                continue;
            }
            $avg = array_sum($slice) / count($slice);
            $typeScores[$key] = (int) round((($avg - 1) / 4) * 100);
        }

        arsort($typeScores);
        $topTypeKey = array_key_first($typeScores);

        // Match result range
        $range = \App\Models\TestResultRange::where('test_id', $psychTest->id)->where('min_percent', '<=', $overallPercent)->where('max_percent', '>=', $overallPercent)->first();

        // Graph config
        $graphConfig = \App\Models\TestGraphConfig::where('test_id', $psychTest->id)->first();
        $graphType = $graphConfig ? $graphConfig->graph_type : 'none';

        // ── Store everything in session ──
        session([
            'quiz_result' => [
                'test_id' => $psychTest->id,
                'answers' => $rawAnswers,
                'category_scores' => $categoryScores,
                'overall_percent' => $overallPercent,
                'type_scores' => $typeScores,
                'top_type_key' => $topTypeKey,
                'graph_type' => $graphType,
                'range' => $range
                    ? [
                        'label' => $range->label,
                        'emoji' => $range->emoji,
                        'tagline' => $range->tagline,
                        'description' => $range->description,
                        'recommended_course' => $range->recommended_course,
                        'tags' => $range->tags,
                        'color' => $range->color,
                        'min_percent' => $range->min_percent,
                        'max_percent' => $range->max_percent,
                    ]
                    : null,
            ],
        ]);

        return redirect()->route('test.result', $psychTest->slug);
    }
    public function result(PsychTest $psychTest)
    {
        // Guard — if no session, send back to test
        if (!session()->has('quiz_result')) {
            return redirect()->route('frontend.tests.show', $psychTest->slug)->with('error', 'No result found. Please take the test first.');
        }

        $data = session('quiz_result');

        $test = $psychTest->load([
            'categories' => fn($q) => $q->orderBy('id'),
            'categories.questions' => fn($q) => $q->orderBy('id'),
        ]);

        $chartData = collect($data['category_scores']);

        return view('frontend.quick-test.quiz-result', [
            'test' => $test,
            'chartData' => $chartData,
            'typeScores' => $data['type_scores'],
            'topTypeKey' => $data['top_type_key'],
            'overallPct' => $data['overall_percent'],
            'graphType' => $data['graph_type'],
            'range' => $data['range'], // array or null
            'answers' => $data['answers'],
        ]);
    }

    public function downloadPdf(PsychTest $psychTest)
    {
        if (!session()->has('quiz_result')) {
            return redirect()->route('test.result', $psychTest->slug)
                ->with('error', 'No result found. Please take the test first.');
        }

        $data = session('quiz_result');

        $test = $psychTest->load([
            'categories'           => fn($q) => $q->orderBy('id'),
            'categories.questions' => fn($q) => $q->orderBy('id'),
        ]);

        $chartData = collect($data['category_scores']);

        /* Talent type fallback definitions (mirrors quiz-result.blade.php) */
        $talentTypes = [
            'performer' => ['name' => 'The Performer', 'emoji' => '🎭', 'tagline' => 'Natural On-Screen Magnetism',
                'desc' => 'Your child has exceptional natural charisma and camera presence. They light up every room, command attention instinctively, and make every performance feel alive and genuine.',
                'course' => 'Screen Acting + Camera Techniques', 'tags' => ['Charismatic', 'Camera-Ready', 'Energetic', 'Scene-Stealer'], 'color' => '#175cdd'],
            'empath'    => ['name' => 'The Empath',     'emoji' => '💙', 'tagline' => 'Deep Emotional Expression',
                'desc' => 'Your child feels emotions profoundly and channels them into powerful, believable performances. Their ability to connect emotionally with characters and audiences is rare and extremely valuable.',
                'course' => 'Screen Acting + Personality Development', 'tags' => ['Deeply Feeling', 'Expressive', 'Authentic', 'Emotionally Intelligent'], 'color' => '#7c3aed'],
            'creator'   => ['name' => 'The Creator',    'emoji' => '✨', 'tagline' => 'Storytelling & Wild Imagination',
                'desc' => "Your child's imagination is extraordinary. They invent entire worlds, create vivid characters, and bring total originality to everything they do. Storytelling is their superpower.",
                'course' => 'Theatre & Stage + Filmmaking', 'tags' => ['Imaginative', 'Inventive', 'Original', 'Storyteller'], 'color' => '#059669'],
            'leader'    => ['name' => 'The Leader',     'emoji' => '👑', 'tagline' => 'Stage Presence & Command',
                'desc' => 'Your child naturally commands attention the moment they enter a room. They have powerful stage presence and the natural ability to lead an audience through any performance with total confidence.',
                'course' => 'Screen Acting + Public Speaking', 'tags' => ['Commanding', 'Confident', 'Authoritative', 'Natural Leader'], 'color' => '#d97706'],
            'voice'     => ['name' => 'The Voice',      'emoji' => '🎤', 'tagline' => 'Powerful Speech & Expression',
                'desc' => "Your child's greatest performing gift is their voice — its tone, clarity, and expressive range. They excel in dialogue delivery, public speaking, and voice-led performance.",
                'course' => 'Public Speaking + Theatre & Stage', 'tags' => ['Articulate', 'Persuasive', 'Expressive', 'Clear Communicator'], 'color' => '#db2777'],
            'director'  => ['name' => 'The Director',   'emoji' => '🎬', 'tagline' => 'Vision, Craft & Filmmaking',
                'desc' => 'Your child has the eye of a born director. They see the bigger picture, understand narrative structure, and have a natural gift for guiding the creative process.',
                'course' => 'Filmmaking + Screen Acting', 'tags' => ['Visionary', 'Strategic', 'Detail-Oriented', 'Big-Picture Thinker'], 'color' => '#0891b2'],
        ];

        $tt           = $talentTypes[$data['top_type_key']] ?? $talentTypes['performer'];
        $range        = $data['range'];
        $hasRange     = !empty($range);

        $displayLabel  = $range['label']              ?? $tt['name'];
        $displayEmoji  = $range['emoji']              ?? $tt['emoji'];
        $displayTagline= $range['tagline']            ?? $tt['tagline'];
        $displayDesc   = $range['description']        ?? $tt['desc'];
        $displayCourse = $range['recommended_course'] ?? $tt['course'];
        $displayTags   = !empty($range['tags'])        ? $range['tags'] : $tt['tags'];
        $displayColor  = $range['color']              ?? $tt['color'];
        $rangeMin      = $range['min_percent']        ?? null;
        $rangeMax      = $range['max_percent']        ?? null;

        $pdf = Pdf::loadView('frontend.quick-test.quiz-result-pdf', [
            'test'          => $test,
            'chartData'     => $chartData,
            'overallPct'    => $data['overall_percent'],
            'answers'       => $data['answers'],
            'hasRange'      => $hasRange,
            'displayLabel'  => $displayLabel,
            'displayEmoji'  => $displayEmoji,
            'displayTagline'=> $displayTagline,
            'displayDesc'   => $displayDesc,
            'displayCourse' => $displayCourse,
            'displayTags'   => $displayTags,
            'displayColor'  => $displayColor,
            'rangeMin'      => $rangeMin,
            'rangeMax'      => $rangeMax,
            'graphType'     => $data['graph_type'] ?? 'none',
        ])->setPaper('a4', 'portrait');

        $filename = 'talent-result-' . \Illuminate\Support\Str::slug($displayLabel) . '.pdf';

        return $pdf->download($filename);
    }

    public function about()
    {
        return view('frontend.about.about');
    }

    public function contactus()
    {
        $contactInfo = \App\Models\ContactInfo::first();
        return view('frontend.contact.contact', compact('contactInfo'));
    }

    public function volunteer()
    {
        return view('frontend.volunteer.volunteer');
    }

    public function course_details(Course $course)
    {
        $course->load(['category', 'centers.state', 'sessions', 'documents']);

        $otherCourses = Course::with('category', 'centers')
            ->where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.course.coursedetails', compact('course', 'otherCourses'));
    }

    public function blog(Request $request)
    {
        $categories = BlogCategory::where('status', 1)
            ->withCount(['posts' => fn($q) => $q->where('status', 1)])
            ->get();

        $totalBlogs = Blog::where('status', 1)->count();

        $featured = Blog::with(['author', 'category'])
            ->where('status', 1)
            ->latest()
            ->first();

        $blogsQuery = Blog::with(['author', 'category', 'tags'])->where('status', 1);

        if ($categorySlug = request('category')) {
            $blogsQuery->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
        }

        if ($tagSlug = request('tag')) {
            $blogsQuery->whereHas('tags', fn($q) => $q->where('slug', $tagSlug));
        }

        $blogs = $blogsQuery->latest()->paginate(12)->withQueryString();

        $recentPosts = Blog::with('category')->where('status', 1)->latest()->limit(5)->get();

        $tags = BlogTag::withCount('blogs')->having('blogs_count', '>', 0)->orderByDesc('blogs_count')->limit(20)->get();

        // ← AJAX request: return only cards + button HTML
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.blog.partials.blog-cards', compact('blogs'))->render(),
                'hasMore' => $blogs->hasMorePages(),
                'nextPage' => $blogs->currentPage() + 1,
                'showing' => $blogs->count() + ($blogs->currentPage() - 1) * $blogs->perPage(),
                'total' => $blogs->total(),
            ]);
        }

        return view('frontend.blog.blog', compact('categories', 'totalBlogs', 'featured', 'blogs', 'recentPosts', 'tags'));
    }

    public function blog_details($slug)
    {
        $blog = Blog::with(['author', 'category'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Related posts — same category, exclude current post
        $related = Blog::with(['author', 'category'])
            ->where('status', 1)
            ->where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->latest()
            ->limit(3)
            ->get();

        // Sidebar: recent posts
        $recentPosts = Blog::with('category')->where('status', 1)->latest()->limit(4)->get();

        // Sidebar: categories with post counts
        $categories = BlogCategory::where('status', 1)
            ->withCount(['posts' => fn($q) => $q->where('status', 1)])
            ->get();

        // Sidebar & tag section tags
        $tags = collect(['Acting', 'Screen Acting', 'DramATA', 'Kids', 'Jaipur', 'Casting', 'Summer Camp', 'Theatre', 'Workshops', 'Confidence', 'NEP 2020', 'Performance']);

        return view('frontend.blog.blogdetails', compact('blog', 'related', 'recentPosts', 'categories', 'tags'));
    }

    public function blog_category($slug)
    {
        $currentCategory = BlogCategory::where('slug', $slug)->where('status', 1)->firstOrFail();

        $categories = BlogCategory::where('status', 1)
            ->withCount(['posts' => fn($q) => $q->where('status', 1)])
            ->get();

        $totalBlogs = Blog::where('status', 1)->count();

        $blogs = Blog::with(['author', 'category'])
            ->where('status', 1)
            ->where('category_id', $currentCategory->id)
            ->latest()
            ->paginate(12);

        $recentPosts = Blog::with('category')->where('status', 1)->latest()->limit(5)->get();

        $tags = collect(['Acting', 'Screen Acting', 'Kids', 'Jaipur', 'Casting', 'Workshops', 'Confidence']);

        $featured = $blogs->first();

        return view('frontend.blog.blog', compact('categories', 'totalBlogs', 'featured', 'blogs', 'recentPosts', 'tags', 'currentCategory'));
    }

    public function privacy()
    {
        return view('frontend.legal.privacy');
    }

    public function terms()
    {
        return view('frontend.legal.terms');
    }

    public function refund()
    {
        return view('frontend.legal.refund');
    }
}
