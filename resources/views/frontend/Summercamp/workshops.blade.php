{{-- resources/views/frontend/workshops.blade.php --}}
@extends('frontend.course.layoutsummercamp')

@section('title', 'Workshops — Act To Action')

{{-- ── Styles ── --}}
<style>
    /* ── Page title ── */
    .page-title {
        color: var(--default-color);
        background-color: var(--background-color);
        position: relative;
        padding-top: 100px;
    }

    /* ── Register button ── */
    .register-btn {
        background: var(--accent-color);
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 30px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: opacity 0.2s ease;
    }

    .register-btn:hover {
        opacity: 0.88;
    }

    /* ── Service button ── */
    .service-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 16px 42px;
        border-radius: 60px;
        background: linear-gradient(135deg, #36d1dc, #5b86e5);
        color: #fff;
        font-size: 1.05rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        border: none;
        cursor: pointer;
        position: relative;
        transition: all 0.35s ease;
        box-shadow: 0 10px 25px rgba(91, 134, 229, 0.35);
    }

    .service-btn i {
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .service-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 35px rgba(91, 134, 229, 0.45);
    }

    .service-btn:hover i {
        transform: translateX(8px);
    }

    .service-btn:active {
        transform: scale(0.96);
    }

    .service-btn::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 60px;
        background: linear-gradient(135deg, #36d1dc, #5b86e5);
        filter: blur(18px);
        opacity: 0.5;
        z-index: -1;
    }

    /* ── Hero section ── */
    .workshops-hero {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: linear-gradient(135deg, #0f2c5c 0%, #1a4a8a 50%, #0e7490 100%);
        padding: 100px 0 70px;
    }

    .workshops-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 60% 50% at 80% 50%, rgba(54, 209, 220, 0.18) 0%, transparent 70%),
            radial-gradient(ellipse 40% 60% at 10% 80%, rgba(91, 134, 229, 0.2) 0%, transparent 60%);
        pointer-events: none;
    }

    .workshops-hero::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 70px;
        background: var(--background-color, #fff);
        clip-path: ellipse(55% 100% at 50% 100%);
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(54, 209, 220, 0.18);
        border: 1px solid rgba(54, 209, 220, 0.35);
        color: #7ee8f0;
        font-size: 0.82rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 40px;
        margin-bottom: 20px;
    }

    .hero-badge span.dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #36d1dc;
        display: inline-block;
        animation: pulse-dot 1.8s ease-in-out infinite;
    }

    @keyframes pulse-dot {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.5;
            transform: scale(0.7);
        }
    }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.4rem);
        font-weight: 800;
        line-height: 1.15;
        color: #fff;
        margin-bottom: 20px;
    }

    .hero-title .highlight {
        background: linear-gradient(90deg, #36d1dc, #7ee8f0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.75);
        max-width: 520px;
        line-height: 1.7;
        margin-bottom: 36px;
    }

    .hero-stats {
        display: flex;
        gap: 36px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .hero-stat {
        text-align: left;
    }

    .hero-stat .stat-number {
        font-size: 1.9rem;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }

    .hero-stat .stat-label {
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 4px;
    }

    .hero-visual {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-float-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 18px;
        padding: 22px 28px;
        color: #fff;
        max-width: 290px;
        animation: float-card 4s ease-in-out infinite;
    }

    @keyframes float-card {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-12px);
        }
    }

    .hero-float-card .card-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #36d1dc, #5b86e5);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 14px;
    }

    .hero-float-card h5 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 6px;
        color: #fff;
    }

    .hero-float-card p {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .hero-float-card-sm {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 14px;
        padding: 14px 18px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 16px;
        max-width: 260px;
        margin-left: auto;
        animation: float-card 4s ease-in-out 2s infinite;
    }

    .hero-float-card-sm .sm-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(54, 209, 220, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .hero-float-card-sm .sm-text {
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.85);
    }

    .hero-float-card-sm .sm-text strong {
        display: block;
        font-size: 0.92rem;
        color: #fff;
        margin-bottom: 2px;
    }

    /* ── Why choose section ── */
    .why-choose-section {
        padding: 90px 0 80px;
        background: var(--background-color, #fff);
    }

    .section-eyebrow {
        display: inline-block;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--accent-color, #1a4a8a);
        margin-bottom: 14px;
    }

    .section-title {
        font-size: clamp(1.6rem, 3.5vw, 2.4rem);
        font-weight: 800;
        color: var(--heading-color, #1a1a2e);
        line-height: 1.2;
        margin-bottom: 16px;
    }

    .section-desc {
        font-size: 1rem;
        color: var(--default-color, #555);
        max-width: 560px;
        line-height: 1.7;
    }

    .why-feature-card {
        padding: 36px 30px;
        border-radius: 20px;
        background: #f8faff;
        border: 1px solid #e8edf8;
        height: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .why-feature-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #36d1dc, #5b86e5);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.35s ease;
        border-radius: 4px 4px 0 0;
    }

    .why-feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(26, 74, 138, 0.1);
        border-color: #c5d4f0;
    }

    .why-feature-card:hover::before {
        transform: scaleX(1);
    }

    .why-icon-wrap {
        width: 62px;
        height: 62px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(54, 209, 220, 0.15), rgba(91, 134, 229, 0.15));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 22px;
        color: #1a4a8a;
    }

    .why-feature-card h4 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--heading-color, #1a1a2e);
        margin-bottom: 10px;
    }

    .why-feature-card p {
        font-size: 0.92rem;
        color: var(--default-color, #666);
        line-height: 1.65;
        margin: 0;
    }

    /* ── Testimonials ── */
    .testimonials-section {
        padding: 90px 0 80px;
        background: linear-gradient(135deg, #f0f5ff 0%, #e8f8fa 100%);
        position: relative;
        overflow: hidden;
    }

    .testimonials-section::before {
        content: "";
        position: absolute;
        top: -80px;
        right: -80px;
        width: 340px;
        height: 340px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(54, 209, 220, 0.12) 0%, transparent 70%);
        pointer-events: none;
    }

    .testimonials-section::after {
        content: "";
        position: absolute;
        bottom: -60px;
        left: -60px;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(91, 134, 229, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .testimonial-card {
        background: #fff;
        border-radius: 20px;
        padding: 34px 30px;
        height: 100%;
        border: 1px solid rgba(91, 134, 229, 0.12);
        box-shadow: 0 4px 24px rgba(26, 74, 138, 0.06);
        transition: all 0.3s ease;
        position: relative;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 48px rgba(26, 74, 138, 0.12);
    }

    .testimonial-quote-icon {
        font-size: 3.5rem;
        line-height: 1;
        color: #dce7fa;
        font-family: Georgia, serif;
        margin-bottom: 6px;
        display: block;
    }

    .testimonial-stars {
        color: #f59e0b;
        font-size: 0.9rem;
        margin-bottom: 16px;
        letter-spacing: 2px;
    }

    .testimonial-text {
        font-size: 0.96rem;
        color: #555;
        line-height: 1.75;
        margin-bottom: 24px;
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 14px;
        border-top: 1px solid #eef1f8;
        padding-top: 20px;
    }

    .testimonial-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #36d1dc, #5b86e5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .testimonial-author-info .name {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 2px;
    }

    .testimonial-author-info .role {
        font-size: 0.82rem;
        color: #888;
    }

    .testimonial-tag {
        position: absolute;
        top: 22px;
        right: 22px;
        background: linear-gradient(135deg, rgba(54, 209, 220, 0.12), rgba(91, 134, 229, 0.12));
        color: #1a4a8a;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid rgba(91, 134, 229, 0.2);
    }
</style>

@section('content')

    {{-- ── Hero Section ── --}}
    <section class="workshops-hero">
        <div class="container position-relative">
            <div class="row align-items-center">

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-badge">
                        <span class="dot"></span>
                        Skill India Mission &amp; NEP 2020
                    </div>
                    <h1 class="hero-title">
                        Discover Workshops That <span class="highlight">Transform Children</span>
                    </h1>
                    <p class="hero-subtitle">
                        Hands-on professional skill workshops designed for young minds — empowering kids with real-world
                        abilities, creativity, and confidence from an early age.
                    </p>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="stat-number">50+</div>
                            <div class="stat-label">Workshops</div>
                        </div>
                        <div class="hero-stat">
                            <div class="stat-number">20+</div>
                            <div class="stat-label">Cities</div>
                        </div>
                        <div class="hero-stat">
                            <div class="stat-number">10K+</div>
                            <div class="stat-label">Children Trained</div>
                        </div>
                        <div class="hero-stat">
                            <div class="stat-number">98%</div>
                            <div class="stat-label">Parent Satisfaction</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div>
                            <div class="hero-float-card">
                                <div class="card-icon">
                                    <i class="bi bi-stars"></i>
                                </div>
                                <h5>NEP 2020 Aligned Curriculum</h5>
                                <p>Every workshop follows India's National Education Policy 2020 for holistic child
                                    development.</p>
                            </div>
                            <div class="hero-float-card-sm">
                                <div class="sm-icon">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <div class="sm-text">
                                    <strong>Certified Trainers</strong>
                                    Expert educators with proven track records
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Why Choose Section ── --}}
    <section class="why-choose-section">
        <div class="container">

            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-7">
                    <span class="section-eyebrow">Why Act To Action</span>
                    <h2 class="section-title">Why Parents Trust Our Workshops</h2>
                    <p class="section-desc mx-auto">
                        We blend structured learning with hands-on fun, ensuring every child gains skills they'll carry for
                        life.
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <h4>Government-Backed Curriculum</h4>
                        <p>Workshops designed in alignment with Skill India Mission and NEP 2020 — trusted by thousands of
                            schools and parents nationwide.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4>Age-Appropriate Learning</h4>
                        <p>Every workshop is carefully tailored to specific age groups, ensuring the content, pace, and
                            activities are just right for your child.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-lightbulb-fill"></i>
                        </div>
                        <h4>Hands-On, Practical Skills</h4>
                        <p>No rote learning — children engage in real projects, activities, and challenges that build
                            critical thinking and creativity.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h4>Available Across India</h4>
                        <p>With workshops in 20+ cities and growing, we bring quality skill training to your neighbourhood —
                            offline and accessible.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <h4>Expert Certified Trainers</h4>
                        <p>Our educators are trained, certified professionals who specialise in child development and
                            experiential learning methodologies.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Safe &amp; Supportive Environment</h4>
                        <p>Every workshop is conducted in a safe, inclusive, and encouraging space where children feel
                            confident to explore and grow.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Page Title ── --}}
    <div class="page-title" style="padding-top: 10px">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Our Workshops</h1>
                        <p class="mb-0">
                            Empowering children with professional skill courses aligned with
                            Skill India Mission &amp; National Education Policy 2020
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Workshops</li>
                </ol>
            </div>
        </nav>
    </div>

    {{-- ── Filter Section ── --}}
    <section class="find-a-doctor section">
        <div class="container">

            {{-- Search header --}}
            <div class="search-section text-center">
                <h2 class="search-title">Find Your Perfect Workshop</h2>
                <p class="search-subtitle">Select an age group and city to discover workshops near you</p>

                {{-- Filter form --}}
                <form method="GET" action="{{ route('workshops') }}" id="workshopFilterForm">
                    <div class="row justify-content-center g-3 mt-2">

                        {{-- Age group select --}}
                        <div class="col-lg-4 col-md-5">
                            <div class="search-input-group">
                                <div class="select-wrapper">
                                    <i class="bi bi-people"></i>
                                    <select name="age_group_id" id="ageGroupSelect" class="form-select"
                                        onchange="this.form.submit()">
                                        <option value="">Select Age Group</option>
                                        @foreach ($ageGroups as $group)
                                            <option value="{{ $group->id }}"
                                                {{ $selectedAgeGroupId == $group->id ? 'selected' : '' }}>
                                                {{ $group->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- City select (only after age group chosen) --}}
                        @if ($selectedAgeGroupId)
                            <div class="col-lg-4 col-md-5">
                                <div class="search-input-group">
                                    <div class="select-wrapper">
                                        <i class="bi bi-geo-alt"></i>
                                        @if ($cities->isNotEmpty())
                                            <select name="city_id" id="citySelect" class="form-select"
                                                onchange="this.form.submit()">
                                                <option value="">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ $selectedCityId == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select class="form-select" disabled>
                                                <option>No cities available yet</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </form>

                {{-- Breadcrumb trail --}}
                @if ($selectedAgeGroup || $selectedCity)
                    <div class="mt-3">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('workshops') }}">All Workshops</a>
                            </li>
                            @if ($selectedAgeGroup)
                                <li class="breadcrumb-item {{ !$selectedCity ? 'active' : '' }}">
                                    @if ($selectedCity)
                                        <a href="{{ route('workshops', ['age_group_id' => $selectedAgeGroupId]) }}">
                                            {{ $selectedAgeGroup->name }}
                                        </a>
                                    @else
                                        {{ $selectedAgeGroup->name }}
                                    @endif
                                </li>
                            @endif
                            @if ($selectedCity)
                                <li class="breadcrumb-item active">{{ $selectedCity->name }}</li>
                            @endif
                        </ol>
                    </div>
                @endif
            </div>

            {{-- ── Results ── --}}
            @if ($selectedAgeGroupId && $selectedCityId)

                {{-- Results header --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-5 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Workshops in {{ $selectedCity->name }}</h4>
                        <p class="text-muted small mb-0">
                            Age Group: {{ $selectedAgeGroup->name }}
                            @if ($selectedAgeGroup->description)
                                &mdash; {{ $selectedAgeGroup->description }}
                            @endif
                        </p>
                    </div>
                    <span class="badge bg-primary px-3 py-2" style="font-size: 14px">
                        {{ $schools->count() }} Workshop{{ $schools->count() !== 1 ? 's' : '' }} Found
                    </span>
                </div>

                @if ($schools->isNotEmpty())

                    {{-- Workshop cards --}}
                    <div class="row gy-4">
                        @foreach ($schools as $school)
                            <div class="col-lg-4 col-md-6">
                                <div class="service-item">

                                    {{-- Image --}}
                                    <div class="service-image">
                                        @if ($school->image_url)
                                            <img src="{{ $school->image_url }}" alt="{{ $school->name }}"
                                                class="img-fluid">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light"
                                                style="height: 220px">
                                                <i class="bi bi-building" style="font-size: 3.5rem; color: #ccc"></i>
                                            </div>
                                        @endif
                                        <div class="service-overlay">
                                            <i class="bi bi-building"></i>
                                        </div>
                                    </div>

                                    {{-- Details --}}
                                    <div class="service-content">
                                        <div class="mb-3">
                                            <span class="badge bg-primary">
                                                {{ $selectedAgeGroup->name }}
                                            </span>
                                            @if ($school->timings)
                                                <span class="badge bg-success ms-2">
                                                    <i class="bi bi-clock me-1"></i>{{ $school->timings }}
                                                </span>
                                            @endif
                                        </div>

                                        <h3>{{ $school->name }}</h3>

                                        @if ($school->description)
                                            <p>{{ Str::limit($school->description, 501) }}</p>
                                        @endif

                                        <div class="service-features">
                                            <div class="feature-item">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                <span>{{ $selectedCity->name }}</span>
                                            </div>
                                            @if ($school->address)
                                                <div class="feature-item">
                                                    <i class="bi bi-pin-map-fill"></i>
                                                    <span>{{ $school->address }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <a href="{{ route('workshops.show', $school->id) }}" target="_blank"
                                            rel="noopener">
                                            <button type="button" class="register-btn">
                                                Register Now
                                                <i class="bi bi-arrow-right"></i>
                                            </button>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- No results --}}
                    <div class="text-center py-5">
                        <i class="bi bi-search" style="font-size: 3.5rem; color: #ccc"></i>
                        <h4 class="mt-3">No Workshops Found</h4>
                        <p class="text-muted">
                            No workshops are available in <strong>{{ $selectedCity->name }}</strong>
                            for <strong>{{ $selectedAgeGroup->name }}</strong> yet.<br>
                            Please check back soon or contact us directly.
                        </p>
                        <a href="tel:9119118844" class="btn btn-primary mt-2">
                            <i class="bi bi-telephone-fill me-1"></i> Call Us
                        </a>
                    </div>

                @endif
            @elseif ($selectedAgeGroupId && !$selectedCityId)
                {{-- Age chosen, awaiting city --}}
                <div class="text-center py-5 mt-4">
                    <i class="bi bi-geo-alt" style="font-size: 3rem; color: #ddd"></i>
                    <p class="text-muted mt-3">
                        Now select a <strong>city</strong> above to see available workshops
                        for <strong>{{ $selectedAgeGroup->name ?? '' }}</strong>.
                    </p>
                </div>
            @else
                {{-- Nothing selected --}}
                <div class="text-center py-5 mt-4">
                    <i class="bi bi-arrow-up-circle" style="font-size: 3rem; color: #ddd"></i>
                    <p class="text-muted mt-3">
                        Please select an <strong>age group</strong> above to get started.
                    </p>
                </div>

            @endif

        </div>
    </section>

    {{-- ── Testimonials Section ── --}}
    <section class="testimonials-section">
        <div class="container position-relative">

            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-7">
                    <span class="section-eyebrow">Testimonials</span>
                    <h2 class="section-title">What Parents &amp; Kids Are Saying</h2>
                    <p class="section-desc mx-auto">
                        Real stories from families who've experienced the Act To Action difference firsthand.
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Coding Workshop</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            My daughter came home on Day 1 and built a mini app herself. I was stunned. The trainers make
                            complex ideas feel so natural for kids. Best investment we've made in her education.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">PR</div>
                            <div class="testimonial-author-info">
                                <div class="name">Priya Rajput</div>
                                <div class="role">Parent &mdash; Jaipur</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Communication Skills</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            My son used to be very shy. After just two weekends at the communication workshop,
                            he gave a speech at his school assembly. The difference was remarkable and lasting.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">AM</div>
                            <div class="testimonial-author-info">
                                <div class="name">Amit Mehta</div>
                                <div class="role">Parent &mdash; Delhi</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Art &amp; Design</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            The Art &amp; Design workshop was incredible. My twins learned about colour theory,
                            design thinking, and even created their own brand logos. Truly professional quality.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">SK</div>
                            <div class="testimonial-author-info">
                                <div class="name">Sunita Kapoor</div>
                                <div class="role">Parent &mdash; Mumbai</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Financial Literacy</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            My 12-year-old now manages his pocket money with a budget and even started
                            a small savings goal. The financial literacy workshop gave him real life skills.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">RV</div>
                            <div class="testimonial-author-info">
                                <div class="name">Rakesh Verma</div>
                                <div class="role">Parent &mdash; Pune</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Leadership Camp</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            The leadership workshop was phenomenal. My daughter leads her school project teams
                            with confidence and empathy now. The facilitators were truly world-class.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">NS</div>
                            <div class="testimonial-author-info">
                                <div class="name">Neha Sharma</div>
                                <div class="role">Parent &mdash; Bengaluru</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Science &amp; Robotics</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            My son built his first robot at age 9. He calls it his greatest achievement. The
                            science and robotics workshop sparked a curiosity in him that no school had managed to ignite.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">DG</div>
                            <div class="testimonial-author-info">
                                <div class="name">Deepak Gupta</div>
                                <div class="role">Parent &mdash; Hyderabad</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── CTA ── --}}
    <section class="call-to-action section light-background">
        <div class="container">
            <div class="contact-block">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="contact-content">
                            <h2>Not Sure Which Workshop to Choose?</h2>
                            <p>Our team is here to help you find the perfect workshop for your child's interests and
                                development goals.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-actions">
                            <a href="tel:9119118844" class="emergency-call">
                                <i class="bi bi-telephone-fill"></i>
                                <span>Call Us: +91 91191 88844</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
