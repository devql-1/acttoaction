@extends('frontend.course.layout')
@section('content')

    <main class="main">

        {{-- ════════════════════════════════════════════════════
        1. PAGE TITLE — .page-title .heading .breadcrumbs
        ════════════════════════════════════════════════════ --}}
        <div class="page-title">
            <div class="heading" style="
            background-image: url('assets/img/health/neurology-2.webp');
            background-size:cover; background-position:center top;
            position:relative; min-height:380px; display:flex; align-items:center;">

                {{-- Gradient overlay --}}
                <div
                    style="position:absolute;inset:0;
                        background:linear-gradient(135deg,rgba(17,35,68,0.88) 0%,rgba(var(--accent-color-rgb),0.55) 100%);">
                </div>

                {{-- Floating shapes --}}
                <div style="position:absolute;top:30px;right:10%;width:180px;height:180px;border-radius:50%;
                        border:1px solid rgba(255,255,255,0.1);pointer-events:none;"></div>
                <div style="position:absolute;bottom:20px;right:20%;width:80px;height:80px;border-radius:50%;
                        border:1px solid rgba(255,255,255,0.15);pointer-events:none;"></div>
                <div style="position:absolute;top:50%;left:5%;width:40px;height:40px;
                        background:rgba(255,255,255,0.05);border-radius:8px;
                        transform:rotate(30deg);pointer-events:none;"></div>

                <div class="container" style="position:relative;z-index:1;">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <span style="display:inline-block;background:rgba(255,255,255,0.15);
                                     color:rgba(255,255,255,0.9);font-size:12px;font-weight:700;
                                     padding:5px 18px;border-radius:25px;
                                     letter-spacing:2px;text-transform:uppercase;
                                     border:1px solid rgba(255,255,255,0.25);
                                     margin-bottom:18px;backdrop-filter:blur(6px);">
                                Free · Scientific · Instant Results
                            </span>
                            <h1 class="heading-title" style="color:#fff;font-size:clamp(2rem,5vw,3.2rem);
                                                         line-height:1.2;margin-bottom:18px;">
                                Discover Who You <em style="font-style:italic;
                            color:rgba(255,255,255,0.75);">Really</em> Are
                            </h1>
                            <p class="mb-0" style="color:rgba(255,255,255,0.80);font-size:17px;
                                              line-height:1.7;max-width:600px;margin:0 auto;">
                                Scientifically validated personality assessments to help you understand
                                your mind, behaviour, and hidden strengths.
                            </p>

                            {{-- Quick stats --}}
                            <div class="d-flex flex-wrap justify-content-center gap-4 mt-4"
                                style="font-size:14px;color:rgba(255,255,255,0.75);">
                                <span><strong style="color:#fff;font-size:22px;
                                                 display:block;">{{ $tests->count() }}+</strong> Tests</span>
                                <span style="width:1px;background:rgba(255,255,255,0.2);"></span>
                                <span><strong style="color:#fff;font-size:22px;
                                                 display:block;">{{ $tests->sum('questions_count') }}+</strong>
                                    Questions</span>
                                <span style="width:1px;background:rgba(255,255,255,0.2);"></span>
                                <span><strong style="color:#fff;font-size:22px;
                                                 display:block;">Free</strong> Always</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('home') }}">Home</a></li>
                        <li class="current">Psychological Tests</li>
                    </ol>
                </div>
            </nav>
        </div>


        {{-- ════════════════════════════════════════════════════
        2. TRUITY-STYLE ICON QUICK-LINKS
        (horizontal pill row — exact Truity homepage feel)
        ════════════════════════════════════════════════════ --}}
        @if($tests->count())
            <section class="section" style="padding:40px 0 0;">
                <div class="container">

                    <div class="section-title" style="margin-bottom:24px;">
                        <h2>Browse All Tests</h2>
                        <p>Click any test to jump straight to its detail page</p>
                    </div>

                    <div class="row justify-content-center g-2 g-md-3">
                        @php
                            $quickIcons = [
                                'bi-clipboard2-pulse',
                                'bi-brain',
                                'bi-person-heart',
                                'bi-bar-chart-line',
                                'bi-stars',
                                'bi-emoji-smile',
                                'bi-patch-question',
                                'bi-heart-pulse',
                                'bi-shield-check',
                                'bi-lightning-charge',
                                'bi-eye',
                                'bi-compass',
                            ];
                            $quickColors = [
                                '#4f46e5',
                                '#0891b2',
                                '#e11d48',
                                '#16a34a',
                                '#f59e0b',
                                '#8b5cf6',
                                '#06b6d4',
                                '#dc2626',
                                '#059669',
                                '#7c3aed',
                                '#0284c7',
                                '#d97706',
                            ];
                        @endphp

                        @foreach($tests as $qi => $qTest)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <a href="{{ route('frontend.tests.show', $qTest->id) }}"
                                    class="d-flex flex-column align-items-center text-center text-decoration-none p-3" style="border-radius:14px;border:1px solid transparent;
                                      transition:all 0.25s;background:var(--surface-color);" onmouseover="this.style.borderColor='var(--accent-color)';
                                            this.style.boxShadow='0 8px 25px rgba(0,0,0,0.10)';
                                            this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='transparent';
                                           this.style.boxShadow='none';
                                           this.style.transform='translateY(0)'">

                                    <div style="width:58px;height:58px;border-radius:50%;
                                            background:{{ $quickColors[$qi % count($quickColors)] }}1a;
                                            display:flex;align-items:center;justify-content:center;
                                            margin-bottom:10px;flex-shrink:0;">
                                        <i class="bi {{ $quickIcons[$qi % count($quickIcons)] }}"
                                            style="font-size:1.5rem;color:{{ $quickColors[$qi % count($quickColors)] }};"></i>
                                    </div>

                                    <div style="font-weight:700;font-size:13px;
                                            color:var(--heading-color);line-height:1.3;">
                                        {{ Str::limit($qTest->test_name, 22) }}
                                    </div>
                                    <div style="font-size:11px;color:#999;margin-top:3px;">
                                        {{ $qTest->questions_count }} questions
                                    </div>

                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif


        {{-- ════════════════════════════════════════════════════
        3. WHY TAKE A TEST — .departments-tabs .service-item
        (horizontal icon + text cards, 3-col grid)
        ════════════════════════════════════════════════════ --}}
        <section class="section light-background" style="margin-top:40px;">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Why Take a Personality Test?</h2>
                    <p>Understanding yourself is the foundation of every great decision</p>
                </div>

                <div class="departments-tabs">
                    <div class="row gy-4">

                        @php
                            $whyItems = [
                                ['icon' => 'fas fa-bullseye', 'title' => 'Know Your Strengths', 'text' => 'Uncover hidden talents and natural abilities so you can lean into what makes you exceptional.'],
                                ['icon' => 'fas fa-handshake', 'title' => 'Improve Relationships', 'text' => 'Understand how you relate to others and build deeper, more meaningful connections.'],
                                ['icon' => 'fas fa-briefcase', 'title' => 'Find the Right Career', 'text' => 'Match your personality type to careers where younaturally thrive and feel fulfilled.'],
                                ['icon' => 'fas fa-brain', 'title' => 'Understand Your Mind', 'text' => 'Learn why you think, feel, and behave the way you do — backed by psychology.'],
                                ['icon' => 'fas fa-chart-line', 'title' => 'Track Personal Growth', 'text' => 'Use your results as a baseline to measure how you evolve and grow over time.'],
                                ['icon' => 'fas fa-shield-alt', 'title' => 'Build Resilience', 'text' => 'Identify stress triggers and coping patterns so you can navigate challenges with confidence.'],
                            ];
                        @endphp

                        @foreach($whyItems as $wi => $item)
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 80 * ($wi + 1) }}">
                                <div class="service-item d-flex align-items-start">
                                    <div class="service-icon flex-shrink-0">
                                        <i class="{{ $item['icon'] }}"></i>
                                    </div>
                                    <div class="service-content">
                                        <h4>{{ $item['title'] }}</h4>
                                        <p>{{ $item['text'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </section>


        {{-- ════════════════════════════════════════════════════
        4. FEATURED TEST — .department-details hero layout
        (big split hero — left text / right image)
        ════════════════════════════════════════════════════ --}}
        @if($tests->count())
            @php $featured = $tests->first(); @endphp
            <section id="department-details" class="department-details section">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row">

                        {{-- Left text --}}
                        <div class="col-xl-6 col-lg-7">
                            <div class="department-hero" data-aos="fade-right" data-aos-delay="200">

                                <div class="badge-wrap">
                                    <span class="specialty-badge">Featured Assessment</span>
                                </div>

                                <h1 class="department-title">{{ $featured->test_name }}</h1>

                                <p class="department-intro">
                                    {{ $featured->description
                ? Str::limit(strip_tags($featured->description), 220)
                : 'Discover your personality through this comprehensive, research-backed assessment. Gain deep insight into how you think, feel, and interact with the world.' }}
                                </p>

                                <div class="key-highlights">
                                    <div class="highlight-item">
                                        <span class="highlight-number">{{ $featured->categories_count }}</span>
                                        <span class="highlight-text">Categories</span>
                                    </div>
                                    <div class="highlight-item">
                                        <span class="highlight-number">{{ $featured->questions_count }}</span>
                                        <span class="highlight-text">Questions</span>
                                    </div>
                                    <div class="highlight-item">
                                        <span class="highlight-number">{{ $featured->duration ?? 'Free' }}</span>
                                        <span class="highlight-text">Duration</span>
                                    </div>
                                </div>

                                <div class="action-group">
                                    <a href="{{ route('frontend.tests.show', $featured->id) }}" class="btn-primary">
                                        <i class="bi bi-play-circle me-2"></i>Take This Test
                                    </a>
                                    <a href="#all-tests" class="btn-secondary">
                                        <span>All Tests</span>
                                        <i class="bi bi-arrow-down"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                        {{-- Right image --}}
                        <div class="col-xl-6 col-lg-5">
                            <div class="department-visual" data-aos="fade-left" data-aos-delay="300">
                                <div class="image-container">
                                    <img src="assets/img/health/neurology-3.webp" alt="{{ $featured->test_name }}"
                                        class="img-fluid primary-image">
                                    <div class="floating-card" data-aos="zoom-in" data-aos-delay="500">
                                        <div class="card-icon">
                                            <i class="bi bi-clipboard2-pulse"></i>
                                        </div>
                                        <div class="card-content">
                                            <h4>{{ $featured->test_name }}</h4>
                                            <p>{{ $featured->questions_count }} questions · {{ $featured->categories_count }}
                                                sections</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endif


        {{-- ════════════════════════════════════════════════════
        5. STATS COUNTER STRIP
        (bold numbers in a dark accent band)
        ════════════════════════════════════════════════════ --}}
        <section style="background:var(--accent-color);padding:50px 0;" data-aos="fade-up">
            <div class="container">
                <div class="row text-center gy-4">

                    @php
                        $stats = [
                            ['num' => $tests->count(), 'label' => 'Personality Tests', 'icon' => 'bi-clipboard-check'],
                            ['num' => $tests->sum('questions_count'), 'label' => 'Total Questions', 'icon' => 'bi-question-circle'],
                            ['num' => $tests->sum('categories_count'), 'label' => 'Test Categories', 'icon' => 'bi-collection'],
                            ['num' => '100%', 'label' => 'Free to Take', 'icon' => 'bi-unlock'],
                        ];
                    @endphp

                    @foreach($stats as $st)
                        <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                            <div style="display:flex;flex-direction:column;align-items:center;gap:8px;">
                                <i class="bi {{ $st['icon'] }}" style="font-size:2rem;color:rgba(255,255,255,0.7);"></i>
                                <div style="font-size:clamp(2rem,5vw,3rem);font-weight:800;color:#fff;
                                        line-height:1;">
                                    {{ $st['num'] }}
                                </div>
                                <div style="font-size:14px;color:rgba(255,255,255,0.75);
                                        font-weight:500;text-transform:uppercase;letter-spacing:1px;">
                                    {{ $st['label'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>


        {{-- ════════════════════════════════════════════════════
        6. ALL TESTS GRID — .services section .service-item
        (main dynamic cards — 3 per row, full details)
        ════════════════════════════════════════════════════ --}}
        <section id="all-tests" class="services section light-background">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="section-title">
                    <h2>All Assessments</h2>
                    <p>{{ $tests->count() }} tests available — scientifically designed, free to start</p>
                </div>

                <div class="row gy-4">

                    @forelse($tests as $ti => $test)
                        @php
                            $cardIcons = [
                                'bi-clipboard2-pulse',
                                'bi-brain',
                                'bi-person-heart',
                                'bi-bar-chart-line',
                                'bi-stars',
                                'bi-emoji-smile',
                                'bi-patch-question',
                                'bi-heart-pulse',
                                'bi-shield-check',
                                'bi-lightning-charge',
                                'bi-eye',
                                'bi-compass',
                            ];
                            $accentHues = [
                                '#4f46e5',
                                '#0891b2',
                                '#e11d48',
                                '#16a34a',
                                '#f59e0b',
                                '#8b5cf6',
                                '#06b6d4',
                                '#dc2626',
                                '#059669',
                                '#7c3aed',
                                '#0284c7',
                                '#d97706',
                            ];
                            $ci = $ti % count($cardIcons);
                            $col = $accentHues[$ci];
                            $delay = ($loop->index % 3) * 100;
                        @endphp

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                            <div class="service-item" style="height:100%;display:flex;flex-direction:column;
                                    border-top:3px solid {{ $col }};position:relative;overflow:hidden;">

                                {{-- Top accent strip --}}
                                <div style="position:absolute;top:0;right:0;width:80px;height:80px;
                                        background:{{ $col }}0d;border-radius:0 0 0 80px;
                                        pointer-events:none;"></div>

                                {{-- Icon + number --}}
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div style="width:54px;height:54px;border-radius:14px;flex-shrink:0;
                                            background:{{ $col }}18;
                                            display:flex;align-items:center;justify-content:center;">
                                        <i class="bi {{ $cardIcons[$ci] }}" style="font-size:1.5rem;color:{{ $col }};"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin:0;font-size:16px;line-height:1.3;
                                               color:var(--heading-color);">
                                            {{ $test->test_name }}
                                        </h4>
                                        <span style="font-size:11px;color:#aaa;font-weight:500;">
                                            Assessment #{{ $test->id }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Description --}}
                                @if($test->description)
                                    <p style="font-size:14px;color:var(--default-color);
                                          line-height:1.7;flex:1;margin-bottom:16px;">
                                        {{ Str::limit(strip_tags($test->description), 115) }}
                                    </p>
                                @else
                                    <p style="font-size:14px;color:#aaa;flex:1;margin-bottom:16px;font-style:italic;">
                                        A comprehensive personality assessment to discover your unique traits.
                                    </p>
                                @endif

                                {{-- Meta badges --}}
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                    <span style="background:{{ $col }}12;color:{{ $col }};
                                             border-radius:20px;padding:3px 12px;
                                             font-size:12px;font-weight:600;">
                                        <i class="bi bi-collection me-1"></i>
                                        {{ $test->categories_count }} {{ Str::plural('Category', $test->categories_count) }}
                                    </span>
                                    <span style="background:{{ $col }}12;color:{{ $col }};
                                             border-radius:20px;padding:3px 12px;
                                             font-size:12px;font-weight:600;">
                                        <i class="bi bi-question-circle me-1"></i>
                                        {{ $test->questions_count }} Qs
                                    </span>
                                    @if($test->duration)
                                        <span style="background:#f0f4f8;color:#64748b;
                                                 border-radius:20px;padding:3px 12px;font-size:12px;">
                                            <i class="bi bi-clock me-1"></i>{{ $test->duration }}
                                        </span>
                                    @endif
                                    <span style="background:#f0fdf4;color:#16a34a;
                                             border-radius:20px;padding:3px 12px;font-size:12px;">
                                        <i class="bi bi-unlock me-1"></i>Free
                                    </span>
                                </div>

                                {{-- CTA button (uses template's .service-btn) --}}
                                <a href="{{ route('frontend.tests.show', $test->id) }}" class="service-btn mt-auto">
                                    <span>Take the Test</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>
                        </div>

                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-clipboard-x mb-3 d-block"
                                style="font-size:3.5rem;color:color-mix(in srgb,var(--accent-color),transparent 60%);"></i>
                            <h5 style="color:var(--heading-color);">No tests available yet</h5>
                            <p class="text-muted">Check back soon — assessments are being added regularly.</p>
                        </div>
                    @endforelse

                </div>

            </div>
        </section>


        {{-- ════════════════════════════════════════════════════
        7. HOW IT WORKS — numbered step cards
        (.services-overview .service-item style)
        ════════════════════════════════════════════════════ --}}
        <section class="section" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>How It Works</h2>
                    <p>Get your results in 4 simple steps</p>
                </div>

                <div class="row gy-4">
                    @php
                        $steps = [
                            ['num' => '01', 'icon' => 'fas fa-mouse-pointer', 'title' => 'Choose a Test', 'text' => 'Browse our library of validated personality assessments and pick the one that interests you most.'],
                            ['num' => '02', 'icon' => 'fas fa-pencil-alt', 'title' => 'Answer Honestly', 'text' => 'Read each question carefully and respond as honestly as possible. There are no right or wrong answers.'],
                            ['num' => '03', 'icon' => 'fas fa-cogs', 'title' => 'We Analyse', 'text' => 'Our system instantly processes your responses using evidence-based psychological frameworks.'],
                            ['num' => '04', 'icon' => 'fas fa-star', 'title' => 'Get Results', 'text' => 'Receive a detailed, personalised report with insights, strengths, and actionable recommendations.'],
                        ];
                    @endphp

                    @foreach($steps as $si => $step)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 * ($si + 1) }}">
                            <div class="service-item text-center" style="position:relative;padding-top:50px;">

                                {{-- Big step number background --}}
                                <div style="position:absolute;top:10px;right:14px;
                                        font-size:5rem;font-weight:900;line-height:1;
                                        color:var(--accent-color);opacity:0.06;
                                        pointer-events:none;user-select:none;">
                                    {{ $step['num'] }}
                                </div>

                                {{-- Step badge --}}
                                <div style="position:absolute;top:-16px;left:50%;transform:translateX(-50%);
                                        width:36px;height:36px;border-radius:50%;
                                        background:var(--accent-color);color:#fff;
                                        font-size:13px;font-weight:800;
                                        display:flex;align-items:center;justify-content:center;
                                        box-shadow:0 4px 12px rgba(var(--accent-color-rgb),0.35);">
                                    {{ $si + 1 }}
                                </div>

                                <div class="service-icon" style="margin:0 auto 16px;">
                                    <i class="{{ $step['icon'] }}"></i>
                                </div>
                                <h4>{{ $step['title'] }}</h4>
                                <p>{{ $step['text'] }}</p>

                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section>


        {{-- ════════════════════════════════════════════════════
        8. EXPERT CARE / CTA SECTION
        (.expert-care-section .expert-image .expert-content)
        ════════════════════════════════════════════════════ --}}
        <section class="section light-background" data-aos="fade-up">
            <div class="container">

                <div class="expert-care-section">
                    <div class="row align-items-center">

                        {{-- Left image --}}
                        <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
                            <div class="expert-image">
                                <img src="assets/img/health/cardiology-2.webp" alt="Personality Testing" class="img-fluid">
                            </div>
                        </div>

                        {{-- Right content --}}
                        <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
                            <div class="expert-content">

                                <h3>Backed by Psychological Science</h3>
                                <p class="lead">
                                    Every test in our library is built on established psychological frameworks,
                                    peer-reviewed research, and validated methodologies trusted by professionals worldwide.
                                </p>

                                <div class="expertise-list">
                                    <div class="expertise-item">
                                        <i class="bi bi-check2"></i>
                                        <span>Based on Big Five, MBTI, Enneagram &amp; other proven models</span>
                                    </div>
                                    <div class="expertise-item">
                                        <i class="bi bi-check2"></i>
                                        <span>Instant personalised results with detailed breakdowns</span>
                                    </div>
                                    <div class="expertise-item">
                                        <i class="bi bi-check2"></i>
                                        <span>All {{ $tests->count() }} assessments are completely free to take</span>
                                    </div>
                                    <div class="expertise-item">
                                        <i class="bi bi-check2"></i>
                                        <span>Designed for personal growth, career guidance, and relationships</span>
                                    </div>
                                </div>

                                <div class="contact-info">
                                    <div class="contact-item">
                                        <i class="bi bi-collection"></i>
                                        <div>
                                            <span class="contact-label">Total Assessments</span>
                                            <span class="contact-value">{{ $tests->count() }} Active Tests</span>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <i class="bi bi-question-circle"></i>
                                        <div>
                                            <span class="contact-label">Total Questions</span>
                                            <span class="contact-value">{{ $tests->sum('questions_count') }}+
                                                Questions</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 d-flex flex-wrap gap-3">
                                    @if($tests->count())
                                        <a href="{{ route('frontend.tests.show', $tests->first()->id) }}" class="btn-primary"
                                            style="display:inline-flex;align-items:center;gap:8px;">
                                            <i class="bi bi-play-circle"></i> Start a Test Now
                                        </a>
                                    @endif
                                    <a href="#all-tests" style="display:inline-flex;align-items:center;gap:8px;
                                          border:2px solid var(--accent-color);
                                          color:var(--accent-color);padding:10px 24px;
                                          border-radius:25px;font-weight:600;font-size:14px;
                                          text-decoration:none;transition:all 0.3s;"
                                        onmouseover="this.style.background='var(--accent-color)';this.style.color='#fff'"
                                        onmouseout="this.style.background='transparent';this.style.color='var(--accent-color)'">
                                        <i class="bi bi-grid-3x3-gap"></i> Browse All
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>


        {{-- ════════════════════════════════════════════════════
        9. FAQ ACCORDION
        (clean accordion using Bootstrap collapse)
        ════════════════════════════════════════════════════ --}}
        <section class="section" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Frequently Asked Questions</h2>
                    <p>Everything you need to know before taking a test</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-9">

                        <div class="accordion" id="faqAccordion">

                            @php
                                $faqs = [
                                    [
                                        'q' => 'Are these tests completely free?',
                                        'a' => 'Yes — every assessment on this platform is 100% free. You can take as many tests as you like with no hidden charges, subscriptions, or paywalls.'
                                    ],
                                    [
                                        'q' => 'How long does each test take?',
                                        'a' => 'Most tests take between 5 and 20 minutes depending on the number of questions. Each test page shows the estimated duration before you start.'
                                    ],
                                    [
                                        'q' => 'Are the results scientifically accurate?',
                                        'a' => 'Our assessments are built on validated psychological frameworks including Big Five personality theory, MBTI indicators, and Enneagram models — the same foundations used by professional psychologists.'
                                    ],
                                    [
                                        'q' => 'Can I retake a test?',
                                        'a' => 'Absolutely. You can retake any test at any time. In fact, many people retake tests after major life events to track how they have grown.'
                                    ],
                                    [
                                        'q' => 'Is my data kept private?',
                                        'a' => 'Your responses are completely confidential. We do not sell or share your personal data with third parties. Your results are for your eyes only.'
                                    ],
                                    [
                                        'q' => 'What do I do with my results?',
                                        'a' => 'Use your results as a tool for self-reflection. Share them with a coach, therapist, partner, or employer to foster better understanding and communication.'
                                    ],
                                ];
                            @endphp

                            @foreach($faqs as $fi => $faq)
                                <div class="accordion-item" style="border:1px solid color-mix(in srgb,var(--accent-color),transparent 80%);
                                        border-radius:10px;margin-bottom:10px;overflow:hidden;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $fi > 0 ? 'collapsed' : '' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq{{ $fi }}" style="font-weight:600;font-size:15px;
                                                   background:var(--surface-color);
                                                   color:var(--heading-color);">
                                            <i class="bi bi-question-circle me-2"
                                                style="color:var(--accent-color);font-size:16px;"></i>
                                            {{ $faq['q'] }}
                                        </button>
                                    </h2>
                                    <div id="faq{{ $fi }}" class="accordion-collapse collapse {{ $fi === 0 ? 'show' : '' }}"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body" style="font-size:14px;line-height:1.8;
                                                color:var(--default-color);
                                                padding-left:44px;">
                                            {{ $faq['a'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>

            </div>
        </section>


        {{-- ════════════════════════════════════════════════════
        10. BOTTOM CTA BAND
        (full-width gradient call-to-action)
        ════════════════════════════════════════════════════ --}}
        <section style="background:linear-gradient(135deg,
                        color-mix(in srgb,var(--accent-color),#000 20%) 0%,
                        var(--accent-color) 50%,
                        color-mix(in srgb,var(--accent-color),#fff 15%) 100%);
                    padding:70px 0;text-align:center;" data-aos="fade-up">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">

                        <i class="bi bi-clipboard2-heart" style="font-size:3rem;color:rgba(255,255,255,0.6);display:block;
                              margin-bottom:16px;"></i>

                        <h2 style="color:#fff;font-size:clamp(1.6rem,4vw,2.4rem);
                               margin-bottom:14px;font-weight:800;">
                            Ready to Discover Yourself?
                        </h2>
                        <p style="color:rgba(255,255,255,0.80);font-size:17px;
                              margin-bottom:32px;line-height:1.7;">
                            Take your first test in under 10 minutes — free, private, and instant results.
                        </p>

                        @if($tests->count())
                            <a href="{{ route('frontend.tests.show', $tests->first()->id) }}" style="display:inline-flex;align-items:center;gap:10px;
                                  background:#fff;color:var(--accent-color);
                                  padding:14px 36px;border-radius:35px;
                                  font-size:16px;font-weight:700;text-decoration:none;
                                  box-shadow:0 8px 30px rgba(0,0,0,0.20);
                                  transition:transform 0.3s,box-shadow 0.3s;" onmouseover="this.style.transform='translateY(-3px)';
                                        this.style.boxShadow='0 14px 40px rgba(0,0,0,0.28)'" onmouseout="this.style.transform='translateY(0)';
                                       this.style.boxShadow='0 8px 30px rgba(0,0,0,0.20)'">
                                <i class="bi bi-play-circle-fill"></i>
                                Start Your First Test
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection