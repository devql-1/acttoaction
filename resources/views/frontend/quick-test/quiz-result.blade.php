@extends('frontend.course.layout')
@section('content')

    <main class="main" style="background:#f5f0eb; min-height:100vh;">

        {{-- ════════════════════════════════════════════════════
        1. RESULTS HERO BANNER
        ════════════════════════════════════════════════════ --}}
        <div class="page-title">
            <div class="heading" style="
                        background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
                        position:relative; padding:50px 0 40px;">

                <div style="position:absolute;inset:0;
                                    background:radial-gradient(circle at 30% 50%,
                                    rgba(196,154,53,0.15) 0%, transparent 60%);"></div>

                <div class="container" style="position:relative;z-index:1;">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8">

                            <div style="width:80px;height:80px;border-radius:50%;
                                                background:rgba(196,154,53,0.15);
                                                border:2px solid rgba(196,154,53,0.4);
                                                display:flex;align-items:center;
                                                justify-content:center;
                                                margin:0 auto 20px;font-size:2.2rem;">
                                🎯
                            </div>

                            <span style="display:inline-block;
                                                 background:rgba(196,154,53,0.2);
                                                 color:#f59e0b;font-size:12px;font-weight:700;
                                                 padding:4px 16px;border-radius:20px;
                                                 letter-spacing:2px;text-transform:uppercase;
                                                 border:1px solid rgba(196,154,53,0.35);
                                                 margin-bottom:14px;">
                                Your Results Are Ready
                            </span>

                            <h1 class="heading-title" style="color:#fff;
                                                font-size:clamp(1.5rem,4vw,2.4rem);
                                                margin-bottom:10px;">
                                {{ $test->test_name }}
                            </h1>

                            <p style="color:rgba(255,255,255,0.7);font-size:15px;">
                                You answered <strong style="color:#f59e0b;">
                                    {{ $totalAnswered }}</strong> questions
                                · Overall score:
                                <strong style="color:#f59e0b;">{{ $overallPercent }}%</strong>
                            </p>

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
                        <li class="current">Results</li>
                    </ol>
                </div>
            </nav>
        </div>


        {{-- ════════════════════════════════════════════════════
        2. OVERALL SCORE RING
        ════════════════════════════════════════════════════ --}}
        <section class="section" style="background:#fff; padding:50px 0 40px;">
            <div class="container">
                <div class="row align-items-center gy-4 justify-content-center">

                    {{-- Score ring --}}
                    <div class="col-lg-4 col-md-5 text-center" data-aos="zoom-in">
                        <div style="position:relative;display:inline-block;">
                            <svg width="200" height="200" viewBox="0 0 200 200">
                                <circle cx="100" cy="100" r="85" fill="none" stroke="#f0ebe3" stroke-width="14" />
                                <circle cx="100" cy="100" r="85" fill="none"
                                    stroke="{{ $overallPercent >= 75 ? '#16a34a' : ($overallPercent >= 45 ? '#f59e0b' : '#e11d48') }}"
                                    stroke-width="14" stroke-linecap="round"
                                    stroke-dasharray="{{ round(2 * 3.14159 * 85) }}"
                                    stroke-dashoffset="{{ round(2 * 3.14159 * 85 * (1 - $overallPercent / 100)) }}"
                                    transform="rotate(-90 100 100)" style="transition:stroke-dashoffset 1.5s ease;" />
                            </svg>
                            <div style="position:absolute;top:50%;left:50%;
                                                transform:translate(-50%,-50%);
                                                text-align:center;">
                                <div style="font-size:2.8rem;font-weight:900;
                                                    color:#2c1810;line-height:1;">
                                    {{ $overallPercent }}%
                                </div>
                                <div style="font-size:12px;color:#999;
                                                    font-weight:600;text-transform:uppercase;
                                                    letter-spacing:1px;margin-top:4px;">
                                    Overall
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Score breakdown text --}}
                    <div class="col-lg-5 col-md-7" data-aos="fade-left">

                        <h3 style="color:#2c1810;font-size:1.6rem;margin-bottom:8px;">
                            @if($overallPercent >= 75)
                                Highly Aligned
                            @elseif($overallPercent >= 45)
                                Moderately Aligned
                            @else
                                Developing
                            @endif
                        </h3>

                        <p style="color:#666;font-size:15px;line-height:1.7;margin-bottom:20px;">
                            Based on your responses to <strong>{{ $totalAnswered }}</strong> questions
                            across <strong>{{ count($categoryResults) }}</strong> personality dimensions.
                            Your score reflects how closely each trait describes your natural personality.
                        </p>

                        <div style="display:flex;gap:16px;flex-wrap:wrap;">
                            <div style="background:#f9f5f0;border-radius:10px;
                                                padding:14px 20px;text-align:center;min-width:90px;">
                                <div style="font-size:1.5rem;font-weight:800;color:#c49a35;">
                                    {{ $totalScore }}
                                </div>
                                <div style="font-size:11px;color:#999;font-weight:600;
                                                    text-transform:uppercase;letter-spacing:1px;">
                                    Total Score
                                </div>
                            </div>
                            <div style="background:#f9f5f0;border-radius:10px;
                                                padding:14px 20px;text-align:center;min-width:90px;">
                                <div style="font-size:1.5rem;font-weight:800;color:#c49a35;">
                                    {{ $maxPossible }}
                                </div>
                                <div style="font-size:11px;color:#999;font-weight:600;
                                                    text-transform:uppercase;letter-spacing:1px;">
                                    Max Possible
                                </div>
                            </div>
                            <div style="background:#f9f5f0;border-radius:10px;
                                                padding:14px 20px;text-align:center;min-width:90px;">
                                <div style="font-size:1.5rem;font-weight:800;color:#c49a35;">
                                    {{ count($categoryResults) }}
                                </div>
                                <div style="font-size:11px;color:#999;font-weight:600;
                                                    text-transform:uppercase;letter-spacing:1px;">
                                    Dimensions
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>


        {{-- ════════════════════════════════════════════════════
        3. PER-CATEGORY RESULTS BARS
        (.services section with custom styling)
        ════════════════════════════════════════════════════ --}}
        <section class="section light-background" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Your Personality Breakdown</h2>
                    <p>How you scored across each dimension of the {{ $test->test_name }}</p>
                </div>

                <div class="row gy-4">
                    @foreach($categoryResults as $i => $cat)
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ ($i % 2) * 100 }}">

                            <div style="background:#fff;border-radius:14px;
                                                            padding:26px 28px;height:100%;
                                                            box-shadow:0 3px 20px rgba(0,0,0,0.06);
                                                            border-left:4px solid {{ $cat['color'] }};">

                                {{-- Category header --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h5 style="color:#2c1810;font-weight:700;
                                                                       margin:0;font-size:16px;">
                                            {{ $cat['name'] }}
                                        </h5>
                                        <span style="font-size:12px;color:#aaa;">
                                            {{ $cat['answered'] }} / {{ $cat['total_qs'] }} questions answered
                                        </span>
                                    </div>
                                    <div style="text-align:right;">
                                        <div style="font-size:1.6rem;font-weight:900;
                                                                        color:{{ $cat['color'] }};line-height:1;">
                                            {{ $cat['percent'] }}%
                                        </div>
                                        <span style="background:{{ $cat['color'] }}18;
                                                                         color:{{ $cat['color'] }};
                                                                         font-size:11px;font-weight:700;
                                                                         padding:2px 10px;border-radius:20px;">
                                            {{ $cat['level'] }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Progress bar --}}
                                <div style="background:#f0ebe3;border-radius:20px;
                                                                height:10px;overflow:hidden;">
                                    <div style="height:100%;border-radius:20px;
                                                                    background:{{ $cat['color'] }};
                                                                    width:{{ $cat['percent'] }}%;
                                                                    transition:width 1.2s ease;"
                                        data-width="{{ $cat['percent'] }}">
                                    </div>
                                </div>

                                {{-- Score detail --}}
                                <div style="display:flex;justify-content:space-between;
                                                                margin-top:10px;font-size:12px;color:#aaa;">
                                    <span>Score: <strong style="color:#555;">{{ $cat['score'] }} /
                                            {{ $cat['max'] }}</strong></span>
                                    <span>
                                        @if($cat['level'] === 'High')
                                            <i class="bi bi-arrow-up-circle-fill" style="color:#16a34a;"></i> Strong trait
                                        @elseif($cat['level'] === 'Moderate')
                                            <i class="bi bi-dash-circle-fill" style="color:#f59e0b;"></i> Moderate trait
                                        @else
                                            <i class="bi bi-arrow-down-circle-fill" style="color:#e11d48;"></i> Developing trait
                                        @endif
                                    </span>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>


        {{-- ════════════════════════════════════════════════════
        4. WHAT YOUR SCORE MEANS
        (.departments-tabs .service-item layout)
        ════════════════════════════════════════════════════ --}}
        <section class="section" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Understanding Your Results</h2>
                    <p>What each score level means for your personality profile</p>
                </div>

                <div class="departments-tabs">
                    <div class="row gy-4">

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item d-flex align-items-start">
                                <div class="service-icon flex-shrink-0" style="background:#16a34a18 !important;">
                                    <i class="fas fa-arrow-up" style="color:#16a34a;"></i>
                                </div>
                                <div class="service-content">
                                    <h4 style="color:#16a34a;">High (75–100%)</h4>
                                    <p>This trait is a strong, natural part of your personality. You express it consistently
                                        and it likely shapes many of your decisions and interactions.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="service-item d-flex align-items-start">
                                <div class="service-icon flex-shrink-0" style="background:#f59e0b18 !important;">
                                    <i class="fas fa-minus" style="color:#f59e0b;"></i>
                                </div>
                                <div class="service-content">
                                    <h4 style="color:#f59e0b;">Moderate (45–74%)</h4>
                                    <p>This trait is present but situational. You may express it in some contexts but not
                                        others, depending on environment and circumstances.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="service-item d-flex align-items-start">
                                <div class="service-icon flex-shrink-0" style="background:#e11d4818 !important;">
                                    <i class="fas fa-arrow-down" style="color:#e11d48;"></i>
                                </div>
                                <div class="service-content">
                                    <h4 style="color:#e11d48;">Low (0–44%)</h4>
                                    <p>This trait is less dominant in your personality. This isn't negative — it simply
                                        means other traits are stronger in defining who you are.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>


        {{-- ════════════════════════════════════════════════════
        5. STRONGEST / WEAKEST TRAITS HIGHLIGHT
        ════════════════════════════════════════════════════ --}}
        @if(count($categoryResults) >= 2)
            @php
                $sorted = collect($categoryResults)->sortByDesc('percent');
                $strongest = $sorted->first();
                $weakest = $sorted->last();
            @endphp
            <section class="section light-background" data-aos="fade-up">
                <div class="container">

                    <div class="section-title">
                        <h2>Your Standout Traits</h2>
                        <p>Your most and least dominant personality dimensions</p>
                    </div>

                    <div class="row gy-4 justify-content-center">

                        {{-- Strongest --}}
                        <div class="col-lg-5 col-md-6" data-aos="fade-right">
                            <div style="background:#fff;border-radius:16px;
                                                            padding:32px;text-align:center;
                                                            box-shadow:0 5px 30px rgba(22,163,74,0.12);
                                                            border:2px solid #16a34a33;">
                                <div style="width:64px;height:64px;border-radius:50%;
                                                                background:#16a34a18;
                                                                display:flex;align-items:center;
                                                                justify-content:center;
                                                                margin:0 auto 16px;font-size:1.8rem;">
                                    🏆
                                </div>
                                <span style="background:#16a34a18;color:#16a34a;
                                                                 font-size:11px;font-weight:700;
                                                                 padding:3px 14px;border-radius:20px;
                                                                 letter-spacing:1px;text-transform:uppercase;">
                                    Strongest Trait
                                </span>
                                <h3 style="color:#2c1810;margin:14px 0 6px;font-size:1.4rem;">
                                    {{ $strongest['name'] }}
                                </h3>
                                <div style="font-size:2.5rem;font-weight:900;
                                                                color:#16a34a;line-height:1;margin-bottom:10px;">
                                    {{ $strongest['percent'] }}%
                                </div>
                                <p style="color:#666;font-size:14px;line-height:1.6;">
                                    This is your most dominant personality dimension — it shapes
                                    how you naturally think and behave across most situations.
                                </p>
                            </div>
                        </div>

                        {{-- Weakest --}}
                        <div class="col-lg-5 col-md-6" data-aos="fade-left">
                            <div style="background:#fff;border-radius:16px;
                                                            padding:32px;text-align:center;
                                                            box-shadow:0 5px 30px rgba(225,29,72,0.08);
                                                            border:2px solid #e11d4822;">
                                <div style="width:64px;height:64px;border-radius:50%;
                                                                background:#e11d4812;
                                                                display:flex;align-items:center;
                                                                justify-content:center;
                                                                margin:0 auto 16px;font-size:1.8rem;">
                                    🌱
                                </div>
                                <span style="background:#e11d4812;color:#e11d48;
                                                                 font-size:11px;font-weight:700;
                                                                 padding:3px 14px;border-radius:20px;
                                                                 letter-spacing:1px;text-transform:uppercase;">
                                    Growth Area
                                </span>
                                <h3 style="color:#2c1810;margin:14px 0 6px;font-size:1.4rem;">
                                    {{ $weakest['name'] }}
                                </h3>
                                <div style="font-size:2.5rem;font-weight:900;
                                                                color:#e11d48;line-height:1;margin-bottom:10px;">
                                    {{ $weakest['percent'] }}%
                                </div>
                                <p style="color:#666;font-size:14px;line-height:1.6;">
                                    This dimension is less developed. Exploring it further could
                                    unlock new strengths and self-awareness.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </section>
        @endif


        {{-- ════════════════════════════════════════════════════
        6. CTA — Retake / Other Tests
        ════════════════════════════════════════════════════ --}}
        <section class="section" data-aos="fade-up">
            <div class="container">
                <div class="expert-care-section">
                    <div class="row align-items-center gy-4 justify-content-center text-center text-lg-start">

                        <div class="col-lg-7">
                            <div class="expert-content">
                                <h3>Want to Explore More?</h3>
                                <p class="lead">
                                    Retake this test to see how you've grown, or explore our other
                                    personality assessments to build a complete picture of yourself.
                                </p>

                                <div class="expertise-list">
                                    <div class="expertise-item">
                                        <i class="bi bi-check2"></i>
                                        <span>Retake anytime — track how you evolve over time</span>
                                    </div>
                                    <div class="expertise-item">
                                        <i class="bi bi-check2"></i>
                                        <span>Share your results with a friend or coach</span>
                                    </div>
                                    <div class="expertise-item">
                                        <i class="bi bi-check2"></i>
                                        <span>Explore other tests for a complete personality profile</span>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-3 mt-4 justify-content-center justify-content-lg-start">

                                    <a href="{{ route('frontend.tests.take', $test->id) }}" class="btn-primary"
                                        style="display:inline-flex;align-items:center;gap:8px;">
                                        <i class="bi bi-arrow-clockwise"></i> Retake Test
                                    </a>

                                    <a href="#" style="display:inline-flex;align-items:center;gap:8px;
                                                      border:2px solid var(--accent-color);
                                                      color:var(--accent-color);padding:10px 24px;
                                                      border-radius:25px;font-weight:600;
                                                      font-size:14px;text-decoration:none;
                                                      transition:all 0.3s;" onmouseover="this.style.background='var(--accent-color)';
                                                            this.style.color='#fff'" onmouseout="this.style.background='transparent';
                                                           this.style.color='var(--accent-color)'">
                                        <i class="bi bi-grid-3x3-gap"></i> All Tests
                                    </a>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4 d-none d-lg-block" data-aos="fade-left">
                            <div class="expert-image">
                                <img src="{{ asset('assets/img/health/neurology-4.webp') }}" alt="Results"
                                    class="img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection