@extends('frontend.course.layout')
@section('content')

    @php
        // Safety fallback — prevents "Undefined variable" if controller skipped
        $totalQuestions = $totalQuestions ?? ($allQuestions ?? collect())->count();
        $allQuestions = $allQuestions ?? collect();
    @endphp

    {{-- Sticky progress bar (fixed top) --}}
    <div id="quizProgressBar" style="
                position:fixed; top:0; left:0; width:100%; z-index:9999;
                height:5px; background:#e5e7eb;">
        <div id="progressFill" style="
                    height:100%; width:0%;
                    background:linear-gradient(90deg, var(--accent-color), #f59e0b);
                    transition:width 0.4s ease;"></div>
    </div>

    <main class="main" style="background:#f5f0eb; min-height:100vh; padding-top:20px;">

        {{-- ════════════════════════════════════════════════════
        1. TEST HEADER BANNER
        ════════════════════════════════════════════════════ --}}
        <div class="page-title" style="margin-top:5px;">
            <div class="heading" style="
                    background:linear-gradient(135deg,#2c1810 0%,#5c3317 50%,#8b5e3c 100%);
                    position:relative; padding:40px 0 30px;">

                <div style="position:absolute;inset:0;
                                background:radial-gradient(circle at 80% 50%,
                                rgba(255,255,255,0.05) 0%, transparent 70%);"></div>

                <div class="container" style="position:relative;z-index:1;">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8">

                            <span style="display:inline-block;
                                             background:rgba(255,255,255,0.12);
                                             color:rgba(255,255,255,0.9);
                                             font-size:11px;font-weight:700;
                                             padding:4px 16px;border-radius:20px;
                                             letter-spacing:2px;text-transform:uppercase;
                                             border:1px solid rgba(255,255,255,0.2);
                                             margin-bottom:12px;">
                                Personality Assessment
                            </span>

                            <h1 class="heading-title" style="color:#fff;
                                            font-size:clamp(1.4rem,3.5vw,2.2rem);
                                            margin-bottom:10px;">
                                {{ $test->test_name }}
                            </h1>

                            {{-- Progress indicator --}}
                            <div style="display:flex;align-items:center;justify-content:center;
                                            gap:16px;flex-wrap:wrap;margin-top:14px;">

                                <span style="color:rgba(255,255,255,0.75);font-size:13px;">
                                    <i class="bi bi-question-circle me-1"></i>
                                    <span id="answeredCount">0</span> / {{ $totalQuestions }} answered
                                </span>

                                <span style="color:rgba(255,255,255,0.3);">|</span>

                                <span style="color:rgba(255,255,255,0.75);font-size:13px;">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $test->duration ?? 'No time limit' }}
                                </span>

                                <span style="color:rgba(255,255,255,0.3);">|</span>

                                <span id="completePct" style="color:#f59e0b;font-size:13px;font-weight:700;">
                                    0% complete
                                </span>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('home') }}">Home</a></li>
                        <li><a href="#">Tests</a></li>
                        <li><a href="{{ route('frontend.tests.show', $test->id) }}">
                                {{ Str::limit($test->test_name, 30) }}
                            </a></li>
                        <li class="current">Take Test</li>
                    </ol>
                </div>
            </nav>
        </div>


        {{-- ════════════════════════════════════════════════════
        2. INSTRUCTIONS STRIP (like Truity's gold bar)
        ════════════════════════════════════════════════════ --}}
        <div style="background:#c49a35; padding:14px 0; text-align:center;
                        margin-bottom:0;">
            <div class="container">
                <p style="margin:0; color:#fff; font-size:13px; font-weight:700;
                              letter-spacing:1.5px; text-transform:uppercase;">
                    <i class="bi bi-info-circle me-2"></i>
                    FOR EACH STATEMENT BELOW, CHOOSE HOW ACCURATELY IT DESCRIBES YOU
                    &nbsp;·&nbsp;
                    <span style="font-weight:500;letter-spacing:0;">
                        INACCURATE &nbsp;←→&nbsp; ACCURATE
                    </span>
                </p>
            </div>
        </div>


        {{-- ════════════════════════════════════════════════════
        3. QUIZ FORM
        ════════════════════════════════════════════════════ --}}
        <div class="container" style="max-width:820px; padding:40px 16px 60px;">

            <form action="{{ route('frontend.tests.submit', $test->id) }}" method="POST" id="quizForm">
                @csrf

                {{-- Scale legend (sticky) --}}
                <div style="position:sticky;top:5px;z-index:100;
                                background:#d4a843;border-radius:8px;
                                padding:12px 24px;margin-bottom:32px;
                                display:flex;justify-content:space-between;
                                align-items:center;
                                box-shadow:0 4px 16px rgba(0,0,0,0.15);">
                    <span style="color:#fff;font-size:12px;font-weight:800;
                                     letter-spacing:2px;text-transform:uppercase;">
                        Inaccurate
                    </span>
                    <div style="display:flex;gap:6px;align-items:center;">
                        @foreach(['1', '2', '3', '4', '5'] as $sv)
                            <div style="width:28px;height:28px;border-radius:50%;
                                                    border:2px solid rgba(255,255,255,0.6);
                                                    background:rgba(255,255,255,0.15);"></div>
                        @endforeach
                    </div>
                    <span style="color:#fff;font-size:12px;font-weight:800;
                                     letter-spacing:2px;text-transform:uppercase;">
                        Accurate
                    </span>
                </div>

                {{-- Questions grouped by category --}}
                @foreach($categories as $category)

                    {{-- ── Category divider ── --}}
                    <div style="background:linear-gradient(135deg,#2c1810,#5c3317);
                                            border-radius:10px;padding:16px 28px;
                                            margin-bottom:2px;display:flex;
                                            align-items:center;gap:14px;">
                        <div style="width:38px;height:38px;border-radius:50%;
                                                background:rgba(255,255,255,0.12);flex-shrink:0;
                                                display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-collection" style="color:#f59e0b;font-size:1rem;"></i>
                        </div>
                        <div>
                            <div style="color:#fff;font-weight:700;font-size:15px;">
                                {{ $category->name }}
                            </div>
                            <div style="color:rgba(255,255,255,0.55);font-size:12px;">
                                {{ $category->questions->count() }} questions in this section
                            </div>
                        </div>
                    </div>

                    @foreach($category->questions as $index => $question)
                        <div class="quiz-question" data-qid="{{ $question->id }}" style="background:#fff;border-radius:0;
                                                        margin-bottom:2px;padding:32px 40px;
                                                        border-bottom:1px solid #ede8e0;
                                                        transition:background 0.2s;" id="q_{{ $question->id }}">

                            <p style="text-align:center;font-size:18px;
                                                          font-weight:600;color:#2c1810;
                                                          line-height:1.5;margin-bottom:24px;
                                                          font-family: Georgia, serif;">
                                {{ $question->question_text
                        ?? $question->text
                        ?? $question->title
                        ?? $question->name
                        ?? 'Question ' . ($loop->parent->index + 1) . '.' . ($index + 1) }}
                            </p>

                            <div style="display:flex;align-items:center;
                                                            justify-content:center;gap:0;">

                                <span style="font-size:11px;font-weight:700;
                                                                 color:#999;letter-spacing:1.5px;
                                                                 text-transform:uppercase;
                                                                 margin-right:16px;white-space:nowrap;">
                                    Inaccurate
                                </span>

                                {{-- 5-point radio scale --}}
                                @foreach([1, 2, 3, 4, 5] as $score)
                                    <label class="scale-option" for="q{{ $question->id }}_s{{ $score }}" style="display:flex;flex-direction:column;
                                                                              align-items:center;cursor:pointer;
                                                                              padding:8px 12px;border-radius:8px;
                                                                              transition:all 0.15s;
                                                                              position:relative;">

                                        <input type="radio" name="answers[{{ $question->id }}]" id="q{{ $question->id }}_s{{ $score }}"
                                            value="{{ $score }}" class="quiz-radio" data-qid="{{ $question->id }}"
                                            style="position:absolute;opacity:0;width:0;height:0;">

                                        <div class="radio-circle" style="width:34px;height:34px;
                                                                                border-radius:50%;
                                                                                border:2px solid #c49a35;
                                                                                background:#fff;
                                                                                transition:all 0.2s;
                                                                                display:flex;align-items:center;
                                                                                justify-content:center;">
                                            <div class="radio-dot" style="width:14px;height:14px;
                                                                                    border-radius:50%;
                                                                                    background:transparent;
                                                                                    transition:background 0.2s;"></div>
                                        </div>

                                        <span style="font-size:10px;color:#bbb;
                                                                                 margin-top:4px;font-weight:600;">
                                            {{ $score }}
                                        </span>
                                    </label>
                                @endforeach

                                <span style="font-size:11px;font-weight:700;
                                                                 color:#999;letter-spacing:1.5px;
                                                                 text-transform:uppercase;
                                                                 margin-left:16px;white-space:nowrap;">
                                    Accurate
                                </span>

                            </div>

                            {{-- Answered tick --}}
                            <div class="answered-tick" id="tick_{{ $question->id }}"
                                style="display:none;text-align:center;margin-top:12px;">
                                <span style="color:#16a34a;font-size:12px;font-weight:600;">
                                    <i class="bi bi-check-circle-fill me-1"></i> Answered
                                </span>
                            </div>

                        </div>
                    @endforeach

                @endforeach

                {{-- Submit section --}}
                <div style="text-align:center;padding:40px 0 20px;">

                    <div id="submitWarning" style="display:none;background:#fef3c7;
                                    border:1px solid #f59e0b;border-radius:10px;
                                    padding:14px 20px;margin-bottom:20px;
                                    font-size:14px;color:#92400e;">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        You have <strong id="unansweredCount"></strong> unanswered question(s).
                        You can still submit, but your results will be incomplete.
                    </div>

                    <button type="submit" id="submitBtn" style="background:var(--accent-color);color:#fff;
                                       border:none;padding:16px 48px;
                                       border-radius:35px;font-size:16px;
                                       font-weight:700;cursor:pointer;
                                       box-shadow:0 8px 30px rgba(var(--accent-color-rgb),0.35);
                                       transition:all 0.3s;letter-spacing:0.5px;" onmouseover="this.style.transform='translateY(-2px)';
                                             this.style.boxShadow='0 12px 40px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='translateY(0)';
                                            this.style.boxShadow='0 8px 30px rgba(var(--accent-color-rgb),0.35)'">
                        <i class="bi bi-send-fill me-2"></i>
                        Submit &amp; See Results
                    </button>

                    <p style="margin-top:14px;font-size:12px;color:#aaa;">
                        <i class="bi bi-lock me-1"></i>
                        Your responses are private and never shared.
                    </p>

                </div>

            </form>

        </div>

    </main>


    <style>
        /* Highlight answered question row */
        .quiz-question.is-answered {
            background: #fffdf5 !important;
            border-left: 3px solid #c49a35;
        }

        /* Scale option hover */
        .scale-option:hover .radio-circle {
            border-color: var(--accent-color);
            background: rgba(var(--accent-color-rgb), 0.06);
            transform: scale(1.1);
        }

        /* Selected state */
        .scale-option.selected .radio-circle {
            background: #c49a35 !important;
            border-color: #c49a35 !important;
        }

        .scale-option.selected .radio-dot {
            background: #fff !important;
        }

        .scale-option.selected span {
            color: #c49a35 !important;
            font-weight: 800 !important;
        }

        /* Smooth scroll offset for sticky bar */
        html {
            scroll-padding-top: 80px;
        }
    </style>


    <script>
        (function () {
            const totalQuestions = {{ $totalQuestions }};
            let answeredSet = new Set();

            // ─── Radio click handler ───────────────────────────────────────
            document.querySelectorAll('.quiz-radio').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    const qid = this.dataset.qid;
                    const qRow = document.getElementById('q_' + qid);
                    const tick = document.getElementById('tick_' + qid);

                    // Clear previous selection highlights in this question
                    qRow.querySelectorAll('.scale-option').forEach(function (opt) {
                        opt.classList.remove('selected');
                    });

                    // Highlight chosen
                    this.closest('.scale-option').classList.add('selected');

                    // Mark row answered
                    qRow.classList.add('is-answered');
                    if (tick) tick.style.display = 'block';

                    // Track answered
                    answeredSet.add(qid);

                    updateProgress();
                });
            });

            // ─── Progress bar & counter update ────────────────────────────
            function updateProgress() {
                const answered = answeredSet.size;
                const pct = Math.round((answered / totalQuestions) * 100);

                document.getElementById('answeredCount').textContent = answered;
                document.getElementById('completePct').textContent = pct + '% complete';
                document.getElementById('progressFill').style.width = pct + '%';
            }

            // ─── Submit validation ─────────────────────────────────────────
            document.getElementById('quizForm').addEventListener('submit', function (e) {
                const unanswered = totalQuestions - answeredSet.size;
                const warning = document.getElementById('submitWarning');
                const uCount = document.getElementById('unansweredCount');

                if (unanswered > 0) {
                    uCount.textContent = unanswered;
                    warning.style.display = 'block';
                    // Let them proceed after seeing warning — scroll to it
                    warning.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    // On second click, submit
                    if (!this.dataset.confirmed) {
                        e.preventDefault();
                        this.dataset.confirmed = '1';
                        document.getElementById('submitBtn').textContent =
                            'Submit Anyway →';
                        document.getElementById('submitBtn').style.background = '#f59e0b';
                    }
                }
            });

            // Init
            updateProgress();
        })();
    </script>

@endsection