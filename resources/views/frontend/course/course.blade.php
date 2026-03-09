@extends('frontend.course.layout')
@section('content')
    <style>
        a {
            color: var(--ac);
            text-decoration: none;
            transition: .3s;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--hc);
            font-family: var(--hf);
        }

        #preloader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity .4s, visibility .4s;
        }

        #preloader.loaded {
            opacity: 0;
            visibility: hidden;
        }

        #preloader .spinner {
            width: 48px;
            height: 48px;
            border: 4px solid color-mix(in srgb, var(--ac), transparent 70%);
            border-top-color: var(--ac);
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .scroll-top {
            position: fixed;
            bottom: 15px;
            right: 15px;
            z-index: 99999;
            width: 40px;
            height: 40px;
            background: var(--ac);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            opacity: 0;
            visibility: hidden;
            transition: all .4s;
            box-shadow: 0 4px 15px rgba(23, 92, 221, .35);
        }

        .scroll-top.active {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            background: color-mix(in srgb, var(--ac), #000 15%);
            transform: translateY(-3px);
        }

        .page-title {
            padding: 72px 0 58px;
            text-align: center;
            background: linear-gradient(135deg, #0d1f4a, #ff8800);
            position: relative;
            overflow: hidden;
        }

        .page-title::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
        }

        .page-title h1 {
            font-size: 46px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 12px;
            position: relative;
        }

        .page-title h1 em {
            color: #ffd96a;
            font-style: normal;
        }

        .page-title p {
            color: rgba(255, 255, 255, .8);
            font-size: 16px;
            max-width: 520px;
            margin: 0 auto 24px;
            line-height: 1.7;
            position: relative;
        }

        .page-title .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            justify-content: center;
            position: relative;
        }

        .page-title .breadcrumb-item {
            font-size: 13px;
            color: rgba(255, 255, 255, .7);
        }

        .page-title .breadcrumb-item.active {
            color: #fff;
            font-weight: 600;
        }

        .page-title .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, .4);
        }

        .page-title .breadcrumb-item a {
            color: rgba(255, 255, 255, .7);
        }

        .cat-tabs-wrap {
            background: #fff;
            border-bottom: 2px solid #f0f4ff;
            padding: 0;
            position: sticky;
            top: 72px;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
        }

        .cat-tabs {
            display: flex;
            gap: 0;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .cat-tabs::-webkit-scrollbar {
            display: none;
        }

        .cat-tab {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 18px 28px;
            cursor: pointer;
            border: none;
            background: none;
            font-family: var(--hf);
            font-size: 14px;
            font-weight: 700;
            color: color-mix(in srgb, var(--hc), transparent 35%);
            white-space: nowrap;
            border-bottom: 3px solid transparent;
            transition: .3s;
            position: relative;
            top: 2px;
        }

        .cat-tab .tab-emoji {
            font-size: 20px;
        }

        .cat-tab .tab-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--hc), transparent 90%);
            font-size: 11px;
            font-weight: 800;
            color: var(--hc);
            transition: .3s;
        }

        .cat-tab:hover {
            color: var(--ac);
        }

        .cat-tab.active {
            color: var(--ac);
            border-bottom-color: var(--ac);
        }

        .cat-tab.active .tab-count {
            background: var(--ac);
            color: #fff;
        }

        .courses-panel {
            display: none;
            padding: 60px 0;
        }

        .courses-panel.active {
            display: block;
        }

        .panel-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 44px;
        }

        .panel-header .ph-icon {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }

        .panel-header .ph-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 3px;
        }

        .panel-header h2 {
            font-size: 30px;
            font-weight: 900;
            margin: 0;
            line-height: 1.2;
        }

        .panel-header p {
            font-size: 14px;
            color: color-mix(in srgb, var(--dc), transparent 20%);
            margin: 6px 0 0;
            line-height: 1.6;
        }

        .panel-header .ph-line {
            flex: 1;
            height: 2px;
            border-radius: 2px;
            background: color-mix(in srgb, var(--ac), transparent 85%);
        }

        .course-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 28px rgba(0, 0, 0, .07);
            transition: .3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 48px rgba(23, 92, 221, .13);
        }

        .course-card .c-banner {
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .course-card .c-banner img {
            width: 100%;
            object-fit: cover;
            display: block;
            transition: .5s;
        }

        .course-card:hover .c-banner img {
            transform: scale(1.06);
        }

        .course-card .c-banner .c-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            z-index: 2;
            padding: 4px 13px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .4px;
            color: #fff;
        }

        .course-card .c-banner .c-mode {
            position: absolute;
            bottom: 12px;
            right: 12px;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, .18);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #fff;
            padding: 4px 11px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 700;
        }

        .course-card .c-body {
            padding: 22px 22px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .course-card .c-age {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: color-mix(in srgb, var(--ac), transparent 91%);
            color: var(--ac);
            font-size: 11px;
            font-weight: 800;
            padding: 3px 11px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .course-card h4 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 7px;
            line-height: 1.3;
        }

        .course-card .c-desc {
            font-size: 13px;
            color: color-mix(in srgb, var(--dc), transparent 18%);
            line-height: 1.7;
            margin-bottom: 16px;
            flex: 1;
        }

        .course-card .c-stats {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .course-card .c-stats span {
            display: flex;
            align-items: center;
            gap: 4px;
            background: #f4f7ff;
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 11px;
            font-weight: 700;
            color: var(--hc);
        }

        .course-card .c-stats span i {
            color: var(--ac);
            font-size: 12px;
        }

        .course-card .c-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 14px;
            border-top: 1px solid #eef2ff;
        }

        .course-card .c-price {
            font-size: 22px;
            font-weight: 900;
            color: var(--hc);
            font-family: var(--hf);
            line-height: 1;
        }

        .course-card .c-price small {
            display: block;
            font-size: 10px;
            color: color-mix(in srgb, var(--dc), transparent 40%);
            font-weight: 500;
            margin-top: 1px;
        }

        .course-card .c-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--ac);
            color: #fff;
            padding: 10px 18px;
            border-radius: 22px;
            font-size: 12px;
            font-weight: 800;
            transition: .3s;
        }

        .course-card .c-btn:hover {
            background: var(--hc);
            color: #fff;
        }

        .c-btn-enroll {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #25d366;
            color: #fff;
            padding: 10px 18px;
            border-radius: 22px;
            font-size: 12px;
            font-weight: 800;
            transition: .3s;
        }

        .c-btn-enroll:hover {
            background: #1ebe5d;
            color: #fff;
        }

        .flagship .c-banner {
            height: 100%;
            min-height: 280px;
        }

        .flagship h4 {
            font-size: 22px;
        }

        .flagship .c-body {
            padding: 30px 30px;
        }

        .flagship .c-desc {
            font-size: 14px;
        }

        .cta-bar {
            background: var(--ac);
            padding: 44px 0;
        }

        .cta-bar h3 {
            color: #fff;
            font-size: 26px;
            font-weight: 900;
            margin-bottom: 6px;
        }

        .cta-bar p {
            color: rgba(255, 255, 255, .82);
            font-size: 14px;
            margin: 0;
        }

        .cta-bar .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #fff;
            color: var(--ac);
            padding: 13px 28px;
            border-radius: 28px;
            font-weight: 800;
            font-size: 14px;
            transition: .3s;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15);
        }

        .cta-bar .btn-cta:hover {
            background: #ffd54f;
            color: #112344;
            transform: translateY(-2px);
        }

        /* WHY CHOOSE US */
        .why-section {
            padding: 80px 0;
            background: #f8faff;
        }

        .section-head {
            margin-bottom: 10px;
        }

        .section-head .sh-label {
            display: inline-block;
            background: color-mix(in srgb, var(--ac), transparent 88%);
            color: var(--ac);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .section-head h2 {
            font-size: 34px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .section-head h2 em {
            color: var(--ac);
            font-style: normal;
        }

        .section-head p {
            font-size: 15px;
            color: color-mix(in srgb, var(--dc), transparent 20%);
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .why-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px 26px;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
            transition: .3s;
            border-bottom: 3px solid transparent;
        }

        .why-card:hover {
            transform: translateY(-6px);
            border-bottom-color: var(--ac);
            box-shadow: 0 12px 36px rgba(23, 92, 221, .12);
        }

        .why-card .why-icon {
            font-size: 36px;
            margin-bottom: 16px;
            line-height: 1;
        }

        .why-card h5 {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .why-card p {
            font-size: 13px;
            color: color-mix(in srgb, var(--dc), transparent 20%);
            line-height: 1.7;
            margin: 0;
        }

        /* FAQ */
        .faq-section {
            padding: 80px 0;
            background: #fff;
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .faq-item {
            border: 1px solid #eef2ff;
            border-radius: 16px;
            overflow: hidden;
            transition: .3s;
        }

        .faq-item.open {
            border-color: color-mix(in srgb, var(--ac), transparent 60%);
        }

        .faq-q {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 22px;
            background: none;
            border: none;
            text-align: left;
            font-family: var(--hf);
            font-size: 15px;
            font-weight: 700;
            color: var(--hc);
            cursor: pointer;
            transition: .3s;
        }

        .faq-q:hover {
            color: var(--ac);
        }

        .faq-item.open .faq-q {
            color: var(--ac);
        }

        .faq-q i {
            font-size: 14px;
            flex-shrink: 0;
            transition: .3s;
            color: var(--ac);
        }

        .faq-item.open .faq-q i {
            transform: rotate(180deg);
        }

        .faq-a {
            display: none;
            padding: 0 22px 18px;
            font-size: 14px;
            color: color-mix(in srgb, var(--dc), transparent 15%);
            line-height: 1.8;
            border-top: 1px solid #eef2ff;
            padding-top: 14px;
        }

        .faq-item.open .faq-a {
            display: block;
        }

        @media(max-width:768px) {

            .why-section,
            .faq-section {
                padding: 50px 0;
            }

            .section-head h2 {
                font-size: 26px;
            }
        }

        @media(max-width:768px) {
            .page-title h1 {
                font-size: 32px;
            }

            .cat-tab {
                padding: 14px 18px;
                font-size: 13px;
            }

            .courses-panel {
                padding: 40px 0;
            }

            .panel-header {
                flex-wrap: wrap;
            }

            .panel-header .ph-line {
                display: none;
            }

            .flagship .c-body {
                padding: 22px 22px;
            }

            .page-title {
                background-image: url("images/banner-courses.jpg");
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                padding: 120px 0;
                color: #fff;
                position: relative;
            }

            .page-title::before {
                content: "";
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
            }

            .page-title .container {
                position: relative;
                z-index: 2;
            }
        }
    </style>

    <main class="main">
        <div class="page-title">
            <div class="container" style="position:relative;">
                <h1 data-aos="fade-up">Our <em>Offerings</em></h1>
                <p data-aos="fade-up" data-aos-delay="80">
                    Here are our course offerings. Select the suitable programme that best matches your goals.
                </p>
                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="150">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Offerings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div id="scrollTop"></div>

        <!-- STICKY CATEGORY TABS -->
        <div class="cat-tabs-wrap">
            <div class="container">
                <div class="cat-tabs">
                    @foreach($categories as $index => $category)
                        @php $tabCourses = $allCourses->where('category_id', $category->id); @endphp
                        <button class="cat-tab {{ $index === 0 ? 'active' : '' }}"
                            onclick="showPanel('cat-{{ $category->id }}', this)">
                            <span class="tab-emoji">📚</span>
                            {{ $category->name }}
                            <span class="tab-count">{{ $tabCourses->count() }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- CATEGORY PANELS -->
        @foreach($categories as $index => $category)
            @php $categoryCourses = $allCourses->where('category_id', $category->id); @endphp

            <div class="courses-panel {{ $index === 0 ? 'active' : '' }}" id="panel-cat-{{ $category->id }}">
                <div class="container">

                    <!-- Panel Header -->
                    <div class="panel-header" data-aos="fade-up">
                        <div class="ph-icon" style="background:color-mix(in srgb,#175cdd,transparent 88%);">📚</div>
                        <div>
                            <div class="ph-label" style="color:#175cdd;">{{ $category->name }}</div>
                            <h2>{{ $category->name }}</h2>
                            <p>{!! $category->description ?? '' !!}</p>
                        </div>
                        <div class="ph-line" style="background:color-mix(in srgb,#175cdd,transparent 80%);"></div>
                    </div>

                    @if($categoryCourses->count() === 1)
                        {{-- Single course: flagship horizontal card --}}
                        @php $course = $categoryCourses->first(); @endphp
                        <div class="course-card flagship" data-aos="fade-up" data-aos-delay="80">
                            <div class="row g-0">
                                <div class="col-lg-5">
                                    <div class="c-banner" style="height:100%;min-height:300px;">
                                        <img src="{{ asset($course->banner_image) }}" alt="{{ $course->title }}"
                                            style="height:100%;">
                                        <div class="c-mode">
                                            <i class="bi bi-laptop"></i> {{ $course->mode ?? 'Offline / Hybrid' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="c-body">
                                        <div class="c-age">
                                            <i class="bi bi-people-fill"></i> {{ $course->age_group ?? 'All Ages' }}
                                        </div>
                                        <h4>{{ $course->title }}</h4>
                                        <p class="c-desc">{!! $course->description !!}</p>

                                        {{-- Centers & States --}}
                                        @if($course->centers->count())
                                            <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px;">
                                                <i class="bi bi-geo-alt-fill" style="color:var(--ac);margin-top:3px;"></i>
                                                @foreach($course->centers as $center)
                                                    <span
                                                        style="background:#eef2ff;color:#175cdd;padding:2px 10px;border-radius:20px;font-size:12px;font-weight:600;">
                                                        {{ $center->name }}
                                                        @if($center->state)
                                                            &nbsp;·&nbsp;{{ $center->state->name }}
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="c-stats">
                                            @if($course->duration)
                                                <span><i class="bi bi-clock"></i> {{ $course->duration }}</span>
                                            @endif
                                            @if($course->sessions)
                                                <span><i class="bi bi-collection-play"></i> {{ $course->sessions }} Sessions</span>
                                            @endif
                                            @if($course->mode)
                                                <span><i class="bi bi-laptop"></i> {{ $course->mode }}</span>
                                            @endif
                                        </div>
                                        <div class="c-foot">
                                            <div class="c-price">
                                                ₹{{ number_format($course->fees) }}
                                                <small>Full Course</small>
                                            </div>
                                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="c-btn-enroll">
                                                <i class="bi bi-whatsapp"></i> Enroll Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        {{-- Multiple courses: grid layout --}}
                        @foreach($categoryCourses as $course)
                            <div class="row gy-4 mb-4">
                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="80">
                                    <div class="course-card">
                                        <div class="c-banner">
                                            <img src="{{ asset($course->banner_image) }}" alt="{{ $course->title }}"
                                                style="height:240px;">
                                            <div class="c-badge" style="background:#175cdd;">{{ $category->name }}</div>
                                            <div class="c-mode">
                                                <i class="bi bi-laptop"></i> {{ $course->mode ?? 'Online / Offline' }}
                                            </div>
                                        </div>
                                        <div class="c-body">
                                            <div class="c-age">
                                                <i class="bi bi-people-fill"></i> {{ $course->age_group ?? 'All Ages' }}
                                            </div>
                                            <h4>{{ $course->title }}</h4>

                                            {{-- Centers & States --}}
                                            @if($course->centers->count())
                                                <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:10px;">
                                                    <i class="bi bi-geo-alt-fill" style="color:var(--ac);margin-top:3px;"></i>
                                                    @foreach($course->centers as $center)
                                                        <span
                                                            style="background:#eef2ff;color:#175cdd;padding:2px 10px;border-radius:20px;font-size:12px;font-weight:600;">
                                                            {{ $center->name }}
                                                            @if($center->state)
                                                                &nbsp;·&nbsp;{{ $center->state->name }}
                                                            @endif
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <div class="c-stats">
                                                @if($course->duration)
                                                    <span><i class="bi bi-clock"></i> {{ $course->duration }}</span>
                                                @endif
                                                @if($course->sessions)
                                                    <span><i class="bi bi-collection-play"></i> {{ $course->sessions }} Sessions</span>
                                                @endif
                                                @if($course->mode)
                                                    <span><i class="bi bi-laptop"></i> {{ $course->mode }}</span>
                                                @endif
                                                @if($course->age_group)
                                                    <span><i class="bi bi-people-fill"></i> {{ $course->age_group }}</span>
                                                @endif
                                            </div>
                                            <div class="c-foot">
                                                <div class="c-price">
                                                    ₹{{ number_format($course->fees) }}
                                                    <small>Full Course</small>
                                                </div>
                                                <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="c-btn-enroll">
                                                    <i class="bi bi-whatsapp"></i> Enroll Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Sessions description panel --}}
                                @if($course->sessions)
                                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="130">
                                        <div style="background:#f8f9ff;border-radius:20px;padding:28px 26px;height:100%;">
                                            <h5 style="font-size:15px;font-weight:800;margin-bottom:18px;color:var(--hc);">
                                                Course Sessions
                                            </h5>
                                            <p style="font-size:13px;line-height:1.7;color:#555;">
                                                {!! $course->description !!}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        @endforeach

        <!-- WHY CHOOSE US -->
        <div class="why-section">
            <div class="container">
                <div class="section-head text-center" data-aos="fade-up">
                    <div class="sh-label">Why Act to Action</div>
                    <h2>Why Choose <em>Us?</em></h2>
                    <p>We don't just teach — we transform. Here's what makes our programmes different.</p>
                </div>
                <div class="row gy-4 mt-2">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="60">
                        <div class="why-card">
                            <div class="why-icon">🎯</div>
                            <h5>Expert-Led Training</h5>
                            <p>Every programme is designed and delivered by industry professionals with real screen, stage,
                                and media experience.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="120">
                        <div class="why-card">
                            <div class="why-icon">🧒</div>
                            <h5>Age-Appropriate Curriculum</h5>
                            <p>Our courses are carefully crafted for different age groups — from 3-year-olds to young adults
                                — ensuring the right level of engagement.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="180">
                        <div class="why-card">
                            <div class="why-icon">🏆</div>
                            <h5>Real Showcase Experience</h5>
                            <p>Every course ends with a live performance, film screening, or showcase — giving children
                                real-world stage and screen confidence.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="240">
                        <div class="why-card">
                            <div class="why-icon">📱</div>
                            <h5>Modern Skills for the Digital Age</h5>
                            <p>From mobile filmmaking to podcasting, we teach skills that are relevant to today's
                                digital-first world.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="why-card">
                            <div class="why-icon">🕉️</div>
                            <h5>Rooted in Indian Culture</h5>
                            <p>Our mythology and shlok programmes connect children to India's timeless wisdom while building
                                confidence and character.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="360">
                        <div class="why-card">
                            <div class="why-icon">🤝</div>
                            <h5>Small Batches, Big Impact</h5>
                            <p>Limited seats per batch ensure every child gets personalised attention, mentorship, and the
                                spotlight they deserve.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ -->
        <div class="faq-section">
            <div class="container">
                <div class="section-head text-center" data-aos="fade-up">
                    <div class="sh-label">Got Questions?</div>
                    <h2>Frequently Asked <em>Questions</em></h2>
                    <p>Everything you need to know before enrolling your child.</p>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="60">
                        <div class="faq-list">

                            <div class="faq-item">
                                <button class="faq-q" onclick="toggleFaq(this)">
                                    What age groups are your courses designed for?
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <div class="faq-a">
                                    Our programmes cater to a wide range — the Actors Training Program is for ages 3–15,
                                    Writing for Screen and Mobile Filmmaking are for ages 8+, and Public Speaking &
                                    Podcasting is for ages 12–25. There is something for every child and young adult.
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-q" onclick="toggleFaq(this)">
                                    Are classes available online or only offline?
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <div class="faq-a">
                                    We offer both online and offline modes depending on the programme. Most short courses
                                    (Mythology, Writing, Filmmaking) are available online and offline, while the flagship
                                    Actors Training Program is primarily offline/hybrid. Check the mode badge on each course
                                    card for details.
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-q" onclick="toggleFaq(this)">
                                    How do I enroll my child?
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <div class="faq-a">
                                    Simply click the <strong>Enroll Now</strong> button on any course card or WhatsApp us
                                    directly at the number provided. Our team will guide you through the right course
                                    selection, batch availability, and payment process.
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-q" onclick="toggleFaq(this)">
                                    What is included in the course fee?
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <div class="faq-a">
                                    The course fee covers all sessions, training materials, mentorship, and the final
                                    showcase or certification event. No hidden charges — what you see on the card is the
                                    complete fee.
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-q" onclick="toggleFaq(this)">
                                    Do you provide a certificate after course completion?
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <div class="faq-a">
                                    Yes! Every student who completes the course receives an official Act to Action
                                    certificate of completion, along with a final showcase or screening experience they'll
                                    remember for life.
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-q" onclick="toggleFaq(this)">
                                    How many students are there per batch?
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <div class="faq-a">
                                    We keep our batches small — typically 15 to 20 students — so every child receives
                                    personal attention and has ample time to perform, practice, and grow.
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section light-background" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Course Testimonials</h2>
                    <p>Real stories from our event participants</p>
                </div>
                @php
                    $videos = [
                        [
                            'id' => 'VIDEO_ID_1',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_1/mqdefault.jpg',
                            'title' => 'Breaking Beauty Stereotypes | Dark Complexion to Stage Star | Parent Feedback',
                            'desc' => 'It\'s not the skin tone, it\'s the talent that shines! A parent shares the inspiring journey.',
                            'duration' => '2:30',
                        ],
                        [
                            'id' => 'VIDEO_ID_2',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_2/mqdefault.jpg',
                            'title' => 'Working Mom\'s Journey | Weekend Classes Made Dreams Possible | Act to Action',
                            'desc' => 'When dreams are strong, challenges don\'t matter. The inspiring story of a working mother.',
                            'duration' => '2:47',
                        ],
                        [
                            'id' => 'VIDEO_ID_3',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_3/mqdefault.jpg',
                            'title' => 'Dausa Ratna Awardee Aadvika Sharma Success Journey | Parents Feedback',
                            'desc' => 'From Classroom to the Spotlight! Presenting the inspiring journey of Aadvika Sharma.',
                            'duration' => '2:53',
                        ],
                        [
                            'id' => 'VIDEO_ID_4',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_4/mqdefault.jpg',
                            'title' => 'First Time in Family Pranay Malpani did TV Shows, Films & Advertisements',
                            'desc' => 'Breaking Barriers, Creating Firsts! Meet Pranay Malpani, a trailblazer in his family.',
                            'duration' => '2:01',
                        ],
                        [
                            'id' => 'VIDEO_ID_5',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_5/mqdefault.jpg',
                            'title' => 'Benefits of Early Start at Act to Action | Aanya Galav | Kota to Jaipur Every Sunday',
                            'desc' => 'From Kota to Jaipur — Every Sunday. Meet Aanya Galav, a shining example.',
                            'duration' => '3:12',
                        ],
                        [
                            'id' => 'VIDEO_ID_6',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_6/mqdefault.jpg',
                            'title' => 'Success Story | From Stage Fear to Confidence | Parent Testimonial',
                            'desc' => 'Watch how our events transformed this child\'s confidence and stage presence.',
                            'duration' => '1:55',
                        ],
                    ];
                @endphp
                {{-- VIDEO GRID --}}
                {{-- Prev / Next controls --}}
                <div class="d-flex justify-content-end gap-2 mb-3">
                    <button class="btn btn-sm px-3" id="vidPrev"
                        style="background:var(--accent-color);color:#fff;border:none;">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button class="btn btn-sm px-3" id="vidNext"
                        style="background:var(--accent-color);color:#fff;border:none;">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                {{-- Scrollable track --}}
                <div style="overflow:hidden;">
                    <div id="vidTrack"
                        style="display:flex; gap:16px;
                                                                        transition:transform 0.5s cubic-bezier(0.25,0.46,0.45,0.94);">

                        @foreach($videos as $video)
                            <div style="flex:0 0 calc(25% - 12px); min-width:0;">
                                <div class="video-card" onclick="openVideo('{{ $video['id'] }}')"
                                    style="cursor:pointer; background:var(--surface-color);
                                                                                                                                       border-radius:10px; overflow:hidden;
                                                                                                                                       box-shadow:0 5px 20px rgba(0,0,0,0.08);
                                                                                                                                       transition:transform 0.3s, box-shadow 0.3s;"
                                    onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 15px 35px rgba(0,0,0,0.15)'"
                                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">

                                    {{-- Thumbnail --}}
                                    <div style="position:relative; overflow:hidden;">
                                        <img src="{{ $video['thumb'] }}" alt="{{ $video['title'] }}" class="img-fluid w-100"
                                            style="aspect-ratio:16/9; object-fit:cover; display:block;">

                                        {{-- Play overlay --}}
                                        <div
                                            style="position:absolute;inset:0;
                                                                                                                                                background:rgba(0,0,0,0.25);
                                                                                                                                                display:flex;align-items:center;justify-content:center;">
                                            <div
                                                style="width:44px;height:44px;border-radius:50%;
                                                                                                                                                    background:rgba(255,255,255,0.95);
                                                                                                                                                    display:flex;align-items:center;justify-content:center;
                                                                                                                                                    box-shadow:0 4px 15px rgba(0,0,0,0.3);">
                                                <i class="fas fa-play"
                                                    style="color:#ff0000;font-size:15px;margin-left:3px;"></i>
                                            </div>
                                        </div>

                                        {{-- Duration --}}
                                        <div
                                            style="position:absolute;bottom:6px;right:8px;
                                                                                                                                                background:rgba(0,0,0,0.8);color:#fff;
                                                                                                                                                font-size:11px;font-weight:600;
                                                                                                                                                padding:2px 6px;border-radius:3px;">
                                            {{ $video['duration'] }}
                                        </div>
                                    </div>

                                    {{-- Info --}}
                                    <div style="padding:12px 14px 16px;">
                                        <h5
                                            style="font-size:13px;font-weight:600;
                                                                                                                                               color:var(--heading-color);line-height:1.4;
                                                                                                                                               margin-bottom:5px;
                                                                                                                                               display:-webkit-box;-webkit-line-clamp:2;
                                                                                                                                               -webkit-box-orient:vertical;overflow:hidden;">
                                            {{ $video['title'] }}
                                        </h5>
                                        <p
                                            style="font-size:11px;color:color-mix(in srgb,var(--default-color),transparent 35%);
                                                                                                                                              line-height:1.5;margin:0;
                                                                                                                                              display:-webkit-box;-webkit-line-clamp:2;
                                                                                                                                              -webkit-box-orient:vertical;overflow:hidden;">
                                            {{ $video['desc'] }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- Dots --}}
                <div class="d-flex justify-content-center gap-2 mt-3" id="vidDots"></div>
            </div>
        </section>

        {{-- ══════════════════════════════════
        VIDEO MODAL WITH RECOMMENDATIONS
        ══════════════════════════════════ --}}
        <div id="videoModal" style="display:none; position:fixed; inset:0; z-index:99999;
                                                                background:rgba(0,0,0,0.92); align-items:center; justify-content:center;
                                                                padding:20px;" onclick="closeVideo(event)">

            <div style="position:relative; width:100%; max-width:1100px;
                                                                    display:flex; gap:16px; align-items:flex-start;"
                onclick="event.stopPropagation()">

                {{-- Close button --}}
                <button onclick="closeVideo()"
                    style="position:absolute;top:-40px;right:0;
                                                                           background:none;border:none;color:#fff;
                                                                           font-size:28px;cursor:pointer;line-height:1;z-index:1;">
                    <i class="fas fa-times"></i>
                </button>

                {{-- LEFT: Main video player --}}
                <div style="flex:1; min-width:0;">
                    <div
                        style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;
                                                                            border-radius:10px;box-shadow:0 20px 60px rgba(0,0,0,0.5);">
                        <iframe id="videoFrame" src=""
                            style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                                                                                   gyroscope; picture-in-picture; web-share" allowfullscreen>
                        </iframe>
                    </div>
                    {{-- Playing title --}}
                    <p id="videoTitle" style="color:#fff;font-size:14px;font-weight:600;
                                                                          margin-top:12px;line-height:1.4;"></p>
                </div>

                {{-- RIGHT: Recommended sidebar --}}
                <div
                    style="width:300px; flex-shrink:0;
                                                                        max-height:75vh; overflow-y:auto;
                                                                        scrollbar-width:thin; scrollbar-color:rgba(255,255,255,0.2) transparent;">

                    <p style="color:rgba(255,255,255,0.6);font-size:12px;
                                                                          font-weight:600;text-transform:uppercase;
                                                                          letter-spacing:1px;margin-bottom:12px;">
                        Recommended
                    </p>

                    <div id="recommendedList"></div>

                </div>

            </div>
        </div>


        <script>
            // ── your full videos array (same as the grid above) ──
            const allVideos = @json($videos); { { --passes PHP $videos array to JS-- } }

            let currentVideoId = null;

            function openVideo(videoId) {
                const modal = document.getElementById('videoModal');
                const frame = document.getElementById('videoFrame');
                const titleEl = document.getElementById('videoTitle');

                currentVideoId = videoId;
                frame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;

                // set title
                const found = allVideos.find(v => v.id === videoId);
                titleEl.textContent = found ? found.title : '';

                // build recommended list (all except current)
                buildRecommended(videoId);

                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function buildRecommended(excludeId) {
                const list = document.getElementById('recommendedList');
                list.innerHTML = '';

                const recs = allVideos.filter(v => v.id !== excludeId);

                recs.forEach(v => {
                    const item = document.createElement('div');
                    item.style.cssText = [
                        'display:flex', 'gap:10px', 'align-items:flex-start',
                        'margin-bottom:12px', 'cursor:pointer', 'border-radius:8px',
                        'padding:6px', 'transition:background 0.2s'
                    ].join(';');
                    item.onmouseover = () => item.style.background = 'rgba(255,255,255,0.08)';
                    item.onmouseout = () => item.style.background = 'transparent';
                    item.onclick = () => switchVideo(v.id);

                    item.innerHTML = `
                                                                <div style="position:relative;flex-shrink:0;width:120px;">
                                                                    <img src="${v.thumb}"
                                                                         style="width:120px;height:68px;object-fit:cover;
                                                                                border-radius:6px;display:block;">
                                                                    <div style="position:absolute;bottom:4px;right:5px;
                                                                                background:rgba(0,0,0,0.8);color:#fff;
                                                                                font-size:10px;font-weight:600;padding:1px 5px;border-radius:3px;">
                                                                        ${v.duration}
                                                                    </div>
                                                                    <div style="position:absolute;inset:0;display:flex;
                                                                                align-items:center;justify-content:center;">
                                                                        <div style="width:28px;height:28px;border-radius:50%;
                                                                                    background:rgba(255,255,255,0.9);
                                                                                    display:flex;align-items:center;justify-content:center;">
                                                                            <i class="fas fa-play"
                                                                               style="color:#ff0000;font-size:10px;margin-left:2px;"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="flex:1;min-width:0;">
                                                                    <p style="color:#fff;font-size:12px;font-weight:600;
                                                                               line-height:1.4;margin:0 0 4px;
                                                                               display:-webkit-box;-webkit-line-clamp:2;
                                                                               -webkit-box-orient:vertical;overflow:hidden;">
                                                                        ${v.title}
                                                                    </p>
                                                                    <p style="color:rgba(255,255,255,0.45);font-size:11px;margin:0;
                                                                               display:-webkit-box;-webkit-line-clamp:2;
                                                                               -webkit-box-orient:vertical;overflow:hidden;">
                                                                        ${v.desc}
                                                                    </p>
                                                                </div>
                                                            `;

                    list.appendChild(item);
                });
            }

            function switchVideo(videoId) {
                const frame = document.getElementById('videoFrame');
                const titleEl = document.getElementById('videoTitle');

                currentVideoId = videoId;
                frame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;

                const found = allVideos.find(v => v.id === videoId);
                titleEl.textContent = found ? found.title : '';

                // refresh recommended list
                buildRecommended(videoId);

                // scroll sidebar back to top
                document.getElementById('recommendedList').parentElement.scrollTop = 0;
            }

            function closeVideo(event) {
                if (event && event.target !== document.getElementById('videoModal')) return;
                document.getElementById('videoFrame').src = '';
                document.getElementById('videoModal').style.display = 'none';
                document.body.style.overflow = '';
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    document.getElementById('videoFrame').src = '';
                    document.getElementById('videoModal').style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
        </script>

        <script>
            function openVideo(videoId) {
                const modal = document.getElementById('videoModal');
                const frame = document.getElementById('videoFrame');

                // autoplay=1 starts video immediately, rel=0 hides unrelated recommendations
                frame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;

                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden'; // prevent background scroll
            }

            function closeVideo(event) {
                // if called from overlay click, only close if clicking the backdrop itself
                if (event && event.target !== document.getElementById('videoModal')) return;

                const modal = document.getElementById('videoModal');
                const frame = document.getElementById('videoFrame');

                frame.src = '';  // stops the video
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }

            // Close on Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    const modal = document.getElementById('videoModal');
                    if (modal.style.display === 'flex') {
                        document.getElementById('videoFrame').src = '';
                        modal.style.display = 'none';
                        document.body.style.overflow = '';
                    }
                }
            });
        </script>
        <!-- CTA BAR -->
        <div class="cta-bar">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-7">
                        <h3>Ready to Enroll Your Child?</h3>
                        <p>Next batch starting soon — limited seats. WhatsApp us and we'll guide you to the right course.
                        </p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-cta">
                            <i class="bi bi-whatsapp"></i> WhatsApp to Enroll
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        window.addEventListener('load', () => document.getElementById('preloader').classList.add('loaded'));
        AOS.init({ duration: 600, easing: 'ease-in-out', once: true });

        const sTop = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => sTop.classList.toggle('active', scrollY > 100));
        sTop.addEventListener('click', e => { e.preventDefault(); scrollTo({ top: 0, behavior: 'smooth' }); });

        const hdr = document.getElementById('header');
        window.addEventListener('scroll', () => hdr.classList.toggle('scrolled', scrollY > 10));

        const tog = document.getElementById('mobileNavToggle'), nav = document.getElementById('navmenu');
        tog.addEventListener('click', () => {
            nav.classList.toggle('mobile-nav-active');
            tog.querySelector('i').classList.toggle('bi-list');
            tog.querySelector('i').classList.toggle('bi-x-lg');
        });

        function toggleFaq(btn) {
            const item = btn.closest('.faq-item');
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        }

        function showPanel(id, btn) {
            document.querySelectorAll('.courses-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
            const panel = document.getElementById('panel-' + id);
            if (!panel) return;
            panel.classList.add('active');
            btn.classList.add('active');
            document.querySelector('.cat-tabs-wrap').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    </script>
@endsection