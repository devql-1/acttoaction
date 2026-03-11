<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Event;
use App\Models\PsychTest;
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
        $categories = CourseCategory::withCount('courses')
            ->with('courses')
            ->where('status', 1)
            ->get();

        // All courses

        $allCourses = Course::with(['category', 'centers.state'])
            ->latest()
            ->get();


        return view('frontend.course.course', compact('featuredCourses', 'categories', 'allCourses'));
    }
    public function event()
    {
        $events = Event::where('status', 1)
            ->withCount('subEvents')
            ->latest('event_date')
            ->take(6)
            ->get();

        return view('frontend.event.event', compact('events'));
    }
    public function subevent($id)
    {
        $event = Event::with([
            'subEvents' => function ($q) {
                $q->where('status', 1)->orderBy('event_date')->orderBy('start_time');
            }
        ])->findOrFail($id);

        return view('frontend.event.subevent', compact('event'));
    }
    public function quicktest()
    {
        $tests = PsychTest::withCount(['categories', 'questions'])
            ->latest()
            ->get();
        if ($tests->isEmpty()) {
            return view('frontend.quick-test.no-tests');
        }
        return view('frontend.quick-test.quicktest', compact('tests'));
    }

    public function show($id)
    {
        $test = PsychTest::withCount(['categories', 'questions'])
            ->findOrFail($id);

        $categories = $test->categories()
            ->withCount('questions')
            ->get();
        if ($categories->isEmpty() || $test->questions()->count() === 0) {
            return abort(404);
        }
        return view('frontend.quick-test.quizdetails', compact('tests', 'categories'));
    }

    public function take($id)
    {


        $test = PsychTest::with([
            'categories' => fn($q) => $q->orderBy('id'),
            'categories.questions' => fn($q) => $q->orderBy('id'),
        ])->findOrFail($id);


        $allQuestions = $test->categories->flatMap(fn($cat) => $cat->questions);
        $totalQuestions = $allQuestions->count();

        if ($totalQuestions === 0) {
            return redirect()->route('frontend.tests.show', $id)
                ->with('error', 'This test has no questions yet.');
        }
        if (!$test || $test->categories->isEmpty() || $totalQuestions === 0) {
            return abort(404);

        }
        return view('frontend.quick-test.take', [
            'test' => $test,
            'categories' => $test->categories,
            'allQuestions' => $allQuestions,       // 
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
    public function submit(Request $request, $id)
    {
        $request->validate([
            'answers' => 'required|string',
        ]);

        $test = PsychTest::with([
            'categories' => fn($q) => $q->orderBy('id'),
            'categories.questions' => fn($q) => $q->orderBy('id'),
        ])->findOrFail($id);

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
                'name' => $cat->category_name ?? $cat->name ?? 'Section',
                'icon' => $cat->icon ?? '📋',
                'color' => $cat->color ?? '#175cdd',
                'score' => $catMax > 0 ? (int) round(($catEarned / $catMax) * 100) : 0,
            ];
        }

        $overallPercent = $maxScore > 0
            ? (int) round(($totalScore / $maxScore) * 100)
            : 0;

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
        $range = \App\Models\TestResultRange::where('test_id', $id)
            ->where('min_percent', '<=', $overallPercent)
            ->where('max_percent', '>=', $overallPercent)
            ->first();

        // Graph config
        $graphConfig = \App\Models\TestGraphConfig::where('test_id', $id)->first();
        $graphType = $graphConfig ? $graphConfig->graph_type : 'hello';

        // ── Store everything in session ──
        session([
            'quiz_result' => [
                'test_id' => $id,
                'answers' => $rawAnswers,
                'category_scores' => $categoryScores,
                'overall_percent' => $overallPercent,
                'type_scores' => $typeScores,
                'top_type_key' => $topTypeKey,
                'graph_type' => $graphType,
                'range' => $range ? [
                    'label' => $range->label,
                    'emoji' => $range->emoji,
                    'tagline' => $range->tagline,
                    'description' => $range->description,
                    'recommended_course' => $range->recommended_course,
                    'tags' => $range->tags,
                    'color' => $range->color,
                    'min_percent' => $range->min_percent,
                    'max_percent' => $range->max_percent,
                ] : null,
            ]
        ]);

        return redirect()->route('test.result', $id);
    }
    public function result($id)
    {
        // Guard — if no session, send back to test
        if (!session()->has('quiz_result')) {
            return redirect()->route('frontend.tests.show', $id)
                ->with('error', 'No result found. Please take the test first.');
        }

        $data = session('quiz_result');

        $test = PsychTest::with([
            'categories' => fn($q) => $q->orderBy('id'),
            'categories.questions' => fn($q) => $q->orderBy('id'),
        ])->findOrFail($id);

        $chartData = collect($data['category_scores']);

        return view('frontend.quick-test.quiz-result', [
            'test' => $test,
            'chartData' => $chartData,
            'typeScores' => $data['type_scores'],
            'topTypeKey' => $data['top_type_key'],
            'overallPct' => $data['overall_percent'],
            'graphType' => $data['graph_type'],
            'range' => $data['range'],       // array or null
            'answers' => $data['answers'],
        ]);
    }

    public function about()
    {
        return view('frontend.about.about');
    }
    public function volunteer()
    {
        return view('frontend.volunteer.volunteer');
    }
    public function course_details($id)
    {
        $course = Course::with(['category', 'centers.state'])
            ->findOrFail($id);

        $otherCourses = Course::with('category')
            ->where('id', '!=', $id)
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.course.coursedetails', compact('course', 'otherCourses'));
    }
    public function blog()
    {
        return view('frontend.blog.blog');
    }

}