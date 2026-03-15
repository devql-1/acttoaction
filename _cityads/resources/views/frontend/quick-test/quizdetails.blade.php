@extends('frontend.course.layout')
@section('content')

<main class="main">

{{-- ════════════════════════════════
     1. PAGE TITLE / HERO BANNER
════════════════════════════════ --}}
<div class="page-title">
    <div class="heading" style="
        background:linear-gradient(135deg,#112344 0%,#1a3a6e 60%,#2563ab 100%);
        position:relative; min-height:340px; display:flex; align-items:center;">

        <div style="position:absolute;inset:0;
                    background:radial-gradient(circle at 70% 40%,
                    rgba(255,255,255,0.05) 0%,transparent 65%);"></div>

        {{-- Decorative circles --}}
        <div style="position:absolute;top:20px;right:8%;width:160px;height:160px;
                    border-radius:50%;border:1px solid rgba(255,255,255,0.08);
                    pointer-events:none;"></div>
        <div style="position:absolute;bottom:20px;right:18%;width:70px;height:70px;
                    border-radius:50%;border:1px solid rgba(255,255,255,0.12);
                    pointer-events:none;"></div>

        <div class="container" style="position:relative;z-index:1;">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">

                    <span style="display:inline-block;
                                 background:rgba(255,255,255,0.12);
                                 color:rgba(255,255,255,0.9);
                                 font-size:11px;font-weight:700;
                                 padding:5px 18px;border-radius:25px;
                                 letter-spacing:2px;text-transform:uppercase;
                                 border:1px solid rgba(255,255,255,0.2);
                                 margin-bottom:16px;">
                        Personality Assessment
                    </span>

                    <h1 class="heading-title" style="color:#fff;
                                font-size:clamp(1.8rem,4.5vw,3rem);
                                line-height:1.2;margin-bottom:16px;">
                        {{ $test->test_name }}
                    </h1>

                    @if($test->description)
                    <p style="color:rgba(255,255,255,0.78);font-size:16px;
                              line-height:1.7;max-width:620px;margin:0 auto 24px;">
                        {{ Str::limit(strip_tags($test->description), 180) }}
                    </p>
                    @endif

                    {{-- Quick stats strip --}}
                    <div class="d-flex flex-wrap justify-content-center gap-4"
                         style="font-size:13px;color:rgba(255,255,255,0.7);">
                        <span>
                            <strong style="color:#fff;font-size:1.4rem;display:block;">
                                {{ $test->categories_count }}
                            </strong>
                            Categories
                        </span>
                        <span style="width:1px;background:rgba(255,255,255,0.15);"></span>
                        <span>
                            <strong style="color:#fff;font-size:1.4rem;display:block;">
                                {{ $test->questions_count }}
                            </strong>
                            Questions
                        </span>
                        <span style="width:1px;background:rgba(255,255,255,0.15);"></span>
                        <span>
                            <strong style="color:#fff;font-size:1.4rem;display:block;">
                                {{ $test->duration ?? 'Free' }}
                            </strong>
                            Duration
                        </span>
                        <span style="width:1px;background:rgba(255,255,255,0.15);"></span>
                        <span>
                            <strong style="color:#f59e0b;font-size:1.4rem;display:block;">
                                Free
                            </strong>
                            Always
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
                <li class="current">{{ Str::limit($test->test_name, 40) }}</li>
            </ol>
        </div>
    </nav>
</div>


{{-- ════════════════════════════════
     2. DEPARTMENT DETAILS HERO
     (split layout — left info / right image)
════════════════════════════════ --}}
<section id="department-details" class="department-details section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">

            {{-- Left: text content --}}
            <div class="col-xl-6 col-lg-7">
                <div class="department-hero" data-aos="fade-right" data-aos-delay="200">

                    <div class="badge-wrap">
                        <span class="specialty-badge">Personality Test</span>
                    </div>

                    <h1 class="department-title">{{ $test->test_name }}</h1>

                    <p class="department-intro">
                        {{ $test->description
                            ? strip_tags($test->description)
                            : 'Discover your personality through this comprehensive, research-backed assessment. Gain deep insight into how you think, feel, and interact with the world.' }}
                    </p>

                    <div class="key-highlights">
                        <div class="highlight-item">
                            <span class="highlight-number">{{ $test->categories_count }}</span>
                            <span class="highlight-text">Categories</span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-number">{{ $test->questions_count }}</span>
                            <span class="highlight-text">Questions</span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-number">{{ $test->duration ?? 'Open' }}</span>
                            <span class="highlight-text">Duration</span>
                        </div>
                    </div>

                    <div class="action-group">
                        <a href="{{ route('frontend.tests.take', $test->id) }}" class="btn-primary">
                            <i class="bi bi-play-circle me-2"></i>Start Test
                        </a>
                        <a href="#" class="btn-secondary">
                            <span>All Tests</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                </div>
            </div>

            {{-- Right: image with floating card --}}
            <div class="col-xl-6 col-lg-5">
                <div class="department-visual" data-aos="fade-left" data-aos-delay="300">
                    <div class="image-container">
                        <img src="{{ asset('assets/img/health/neurology-2.webp') }}"
                             alt="{{ $test->test_name }}"
                             class="img-fluid primary-image">
                        <div class="floating-card" data-aos="zoom-in" data-aos-delay="500">
                            <div class="card-icon">
                                <i class="bi bi-clipboard2-pulse"></i>
                            </div>
                            <div class="card-content">
                                <h4>{{ $test->test_name }}</h4>
                                <p>{{ $test->questions_count }} questions
                                   · {{ $test->categories_count }} sections</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        {{-- ════════════════════════════════
             3. CATEGORIES GRID
             .services-overview .service-item
        ════════════════════════════════ --}}
        @if($categories->count())
        <div class="services-overview" data-aos="fade-up" data-aos-delay="400">

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="overview-header">
                        <h3>Test Categories</h3>
                        <p>This assessment is divided into {{ $categories->count() }} sections</p>
                    </div>
                </div>
            </div>

            @php
            $catIcons = [
                'bi-lightning-charge','bi-search','bi-heart-pulse',
                'bi-person-gear','bi-moon-stars','bi-shield-check',
                'bi-bar-chart-line','bi-brain','bi-clipboard2-pulse',
                'bi-emoji-smile','bi-stars','bi-eye',
            ];
            @endphp

            <div class="row gy-4 services-grid">
                @foreach($categories as $ci => $category)
                <div class="col-lg-4 col-md-6"
                     data-aos="fade-up"
                     data-aos-delay="{{ 500 + ($ci * 60) }}">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi {{ $catIcons[$ci % count($catIcons)] }}"></i>
                        </div>
                        <h4>{{ $category->name }}</h4>
                        @if($category->description ?? false)
                            <p>{{ Str::limit(strip_tags($category->description), 100) }}</p>
                        @endif
                        <p style="font-size:13px;color:var(--accent-color);
                                  font-weight:600;margin-top:8px;">
                            <i class="bi bi-question-circle me-1"></i>
                            {{ $category->questions_count }} Questions
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        @endif


        {{-- ════════════════════════════════
             4. WHY TAKE THIS TEST
             .expert-care-section layout
        ════════════════════════════════ --}}
        <div class="expert-care-section" data-aos="fade-up" data-aos-delay="700">
            <div class="row align-items-center">

                <div class="col-lg-5" data-aos="fade-right" data-aos-delay="800">
                    <div class="expert-image">
                        <img src="{{ asset('assets/img/health/neurology-4.webp') }}"
                             alt="{{ $test->test_name }}" class="img-fluid">
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="800">
                    <div class="expert-content">

                        <h3>Why Take This Test?</h3>
                        <p class="lead">
                            Gain deep insights into your personality, strengths, and
                            behavioural patterns through this scientifically designed assessment.
                        </p>

                        <div class="expertise-list">
                            <div class="expertise-item">
                                <i class="bi bi-check2"></i>
                                <span>{{ $test->questions_count }} carefully crafted questions</span>
                            </div>
                            <div class="expertise-item">
                                <i class="bi bi-check2"></i>
                                <span>Covers {{ $test->categories_count }} distinct personality dimensions</span>
                            </div>
                            <div class="expertise-item">
                                <i class="bi bi-check2"></i>
                                <span>Instant results with detailed category breakdown</span>
                            </div>
                            <div class="expertise-item">
                                <i class="bi bi-check2"></i>
                                <span>
                                    @if($test->duration)
                                        Takes approximately {{ $test->duration }} to complete
                                    @else
                                        Complete at your own pace — no time limit
                                    @endif
                                </span>
                            </div>
                            <div class="expertise-item">
                                <i class="bi bi-check2"></i>
                                <span>100% free — no sign-up required</span>
                            </div>
                        </div>

                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="bi bi-collection"></i>
                                <div>
                                    <span class="contact-label">Total Categories</span>
                                    <span class="contact-value">{{ $test->categories_count }} Sections</span>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-clock"></i>
                                <div>
                                    <span class="contact-label">Duration</span>
                                    <span class="contact-value">{{ $test->duration ?? 'No time limit' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('frontend.tests.take', $test->id) }}"
                               class="btn-primary" style="display:inline-flex;
                               align-items:center;gap:8px;">
                                <i class="bi bi-play-circle-fill"></i>
                                Start Test Now
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

</main>
@endsection