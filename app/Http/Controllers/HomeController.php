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
        $categories = CourseCategory::with('courses')
            ->where('status', 1)
            ->get();

        // All courses
        $allCourses = Course::with('category')
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
        return view('frontend.quick-test.quicktest', compact('tests'));
    }

    public function show($id)
    {
        $test = PsychTest::withCount(['categories', 'questions'])
            ->findOrFail($id);

        $categories = $test->categories()
            ->withCount('questions')
            ->get();
        return view('frontend.quick-test.quizdetails', compact('test', 'categories'));
    }

    public function take($id)
    {
        // Load the test WITH its categories AND each category's questions
        $test = PsychTest::with([
            'categories' => fn($q) => $q->orderBy('id'),
            'categories.questions' => fn($q) => $q->orderBy('id'),
        ])->findOrFail($id);

        // Flat list of ALL questions across every category (used for progress bar)
        $allQuestions = $test->categories->flatMap(fn($cat) => $cat->questions);
        $totalQuestions = $allQuestions->count();

        if ($totalQuestions === 0) {
            return redirect()->route('frontend.tests.show', $id)
                ->with('error', 'This test has no questions yet.');
        }

        return view('frontend.quick-test.take', [
            'test' => $test,
            'categories' => $test->categories,  // each has ->questions loaded
            'allQuestions' => $allQuestions,       // flat list for JS counter
            'totalQuestions' => $totalQuestions,
        ]);
    }




    public function submit(Request $request, $id)
    {
        $test = PsychTest::with([
            'categories.questions'
        ])->findOrFail($id);

        $answers = $request->input('answers', []); // ['question_id' => score]

        // Build per-category scores
        $categoryResults = [];
        $totalScore = 0;
        $totalAnswered = 0;
        $maxPossible = 0;

        foreach ($test->categories as $category) {
            $catScore = 0;
            $catAnswered = 0;
            $catMax = $category->questions->count() * 5; // max 5 per question

            foreach ($category->questions as $question) {
                $score = isset($answers[$question->id])
                    ? (int) $answers[$question->id]
                    : 0;

                if (isset($answers[$question->id])) {
                    $catScore += $score;
                    $catAnswered++;
                    $totalAnswered++;
                }
            }

            $catPercent = $catMax > 0 ? round(($catScore / $catMax) * 100) : 0;

            $categoryResults[] = [
                'name' => $category->name,
                'score' => $catScore,
                'max' => $catMax,
                'answered' => $catAnswered,
                'total_qs' => $category->questions->count(),
                'percent' => $catPercent,
                'level' => $catPercent >= 75 ? 'High'
                    : ($catPercent >= 45 ? 'Moderate' : 'Low'),
                'color' => $catPercent >= 75 ? '#16a34a'
                    : ($catPercent >= 45 ? '#f59e0b' : '#e11d48'),
            ];

            $totalScore += $catScore;
            $maxPossible += $catMax;
        }

        $overallPercent = $maxPossible > 0
            ? round(($totalScore / $maxPossible) * 100)
            : 0;

        return view('frontend.quick-test.quiz-result', compact(
            'test',
            'categoryResults',
            'totalScore',
            'maxPossible',
            'overallPercent',
            'totalAnswered'
        ));
    }
}