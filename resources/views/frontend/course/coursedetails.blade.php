@extends('frontend.course.layout')
@section('content')
    <style>
        a {
            color: var(--accent-color);
            text-decoration: none;
            transition: .3s;
        }

        a:hover {
            color: color-mix(in srgb, var(--accent-color), transparent 25%);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--heading-color);
            font-family: var(--heading-font);
        }



        .header {
            --background-color: rgb(255, 255, 255);
        }

        /* HERO BANNER */
        .course-hero {
            position: relative;
            height: 520px;
            overflow: hidden;
        }

        .course-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .course-hero .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(10, 20, 50, .85) 0%, rgba(10, 20, 50, .45) 60%, transparent 100%);
        }

        .course-hero .hero-content {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
        }

        .course-hero .hero-content .badge-cat {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #fff;
            padding: 5px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 16px;
        }

        .course-hero .hero-content h1 {
            color: #fff;
            font-size: 46px;
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 14px;
            max-width: 600px;
        }

        .course-hero .hero-content .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 28px;
        }

        .course-hero .hero-content .hero-meta .hm {
            display: flex;
            align-items: center;
            gap: 7px;
            color: rgba(255, 255, 255, .85);
            font-size: 14px;
            font-weight: 600;
        }

        .course-hero .hero-content .hero-meta .hm i {
            color: #ffd54f;
            font-size: 16px;
        }

        .course-hero .hero-content .btn-enroll-hero {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-color);
            color: #fff;
            padding: 14px 32px;
            border-radius: 30px;
            font-weight: 800;
            font-size: 15px;
            transition: .3s;
            box-shadow: 0 8px 25px rgba(23, 92, 221, .45);
        }

        .course-hero .hero-content .btn-enroll-hero:hover {
            background: #fff;
            color: var(--accent-color);
            transform: translateY(-2px);
        }

        .course-hero .breadcrumb-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(17, 35, 68, .7);
            backdrop-filter: blur(8px);
            padding: 12px 0;
        }

        .course-hero .breadcrumb-bar .breadcrumb {
            margin: 0;
            padding: 0;
            background: transparent;
        }

        .course-hero .breadcrumb-bar .breadcrumb-item {
            font-size: 13px;
            color: rgba(255, 255, 255, .7);
        }

        .course-hero .breadcrumb-bar .breadcrumb-item.active {
            color: #fff;
            font-weight: 600;
        }

        .course-hero .breadcrumb-bar .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, .4);
        }

        .course-hero .breadcrumb-bar .breadcrumb-item a {
            color: rgba(255, 255, 255, .7);
        }

        .course-hero .breadcrumb-bar .breadcrumb-item a:hover {
            color: #fff;
        }

        @media(max-width:768px) {
            .course-hero {
                height: auto;
                min-height: 420px;
            }

            .course-hero .hero-content h1 {
                font-size: 30px;
            }

            .course-hero .hero-overlay {
                background: rgba(10, 20, 50, .8);
            }
        }

        /* QUICK INFO STRIP */
        .quick-info {
            background: var(--heading-color);
            padding: 20px 0;
        }

        .quick-info .qi-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, .85);
        }

        .quick-info .qi-item i {
            font-size: 20px;
            color: #ffd54f;
        }

        .quick-info .qi-item .qi-label {
            font-size: 11px;
            opacity: .65;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 1px;
        }

        .quick-info .qi-item .qi-val {
            font-size: 14px;
            font-weight: 800;
            color: #fff;
            font-family: var(--heading-font);
        }

        .quick-info .divider {
            width: 1px;
            height: 36px;
            background: rgba(255, 255, 255, .12);
            margin: auto;
        }

        /* CONTENT AREA */
        .section {
            padding: 80px 0;
        }

        .section-alt {
            background: color-mix(in srgb, var(--accent-color), transparent 96%);
        }

        /* STICKY SIDEBAR CARD */
        .enroll-card {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 10px 50px rgba(0, 0, 0, .12);
            overflow: hidden;
            position: sticky;
            top: 100px;
        }

        .enroll-card .card-top {
            background: linear-gradient(135deg, var(--heading-color), color-mix(in srgb, var(--heading-color), #1a3a7c 50%));
            padding: 28px 28px 24px;
            color: #fff;
        }

        .enroll-card .card-top .price-big {
            font-size: 40px;
            font-weight: 900;
            color: #fff;
            font-family: var(--heading-font);
            line-height: 1;
        }

        .enroll-card .card-top .price-label {
            font-size: 13px;
            color: rgba(255, 255, 255, .65);
            margin-top: 3px;
        }

        .enroll-card .card-body-p {
            padding: 24px 28px;
        }

        .enroll-card .info-list {
            list-style: none;
            padding: 0;
            margin: 0 0 22px;
        }

        .enroll-card .info-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 0;
            border-bottom: 1px solid color-mix(in srgb, var(--accent-color), transparent 90%);
            font-size: 13.5px;
        }

        .enroll-card .info-list li:last-child {
            border-bottom: none;
        }

        .enroll-card .info-list li i {
            color: var(--accent-color);
            font-size: 15px;
            flex-shrink: 0;
        }

        .enroll-card .btn-enroll-big {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: var(--accent-color);
            color: #fff;
            padding: 15px;
            border-radius: 14px;
            font-weight: 800;
            font-size: 15px;
            transition: .3s;
            width: 100%;
            box-shadow: 0 6px 20px rgba(23, 92, 221, .35);
            margin-bottom: 12px;
        }

        .enroll-card .btn-enroll-big:hover {
            background: var(--heading-color);
            color: #fff;
            transform: translateY(-2px);
        }

        .enroll-card .btn-wa {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: #25d366;
            color: #fff;
            padding: 13px;
            border-radius: 14px;
            font-weight: 800;
            font-size: 14px;
            transition: .3s;
            width: 100%;
        }

        .enroll-card .btn-wa:hover {
            background: #1da851;
            color: #fff;
        }

        .enroll-card .note {
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 30%);
            text-align: center;
            margin-top: 14px;
            line-height: 1.5;
        }

        /* SECTION TITLE */
        .sec-title {
            font-size: 26px;
            font-weight: 900;
            margin-bottom: 6px;
        }

        .sec-sub {
            font-size: 15px;
            color: color-mix(in srgb, var(--default-color), transparent 25%);
            margin-bottom: 30px;
            line-height: 1.65;
        }

        /* ABOUT COURSE */
        .about-points {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .about-points li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
            font-size: 14.5px;
            line-height: 1.6;
            border-bottom: 1px solid color-mix(in srgb, var(--accent-color), transparent 90%);
        }

        .about-points li:last-child {
            border-bottom: none;
        }

        .about-points li i {
            color: var(--accent-color);
            font-size: 17px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* MODULES */
        .module-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        .module-card {
            background: #fff;
            border-radius: 14px;
            padding: 20px 20px;
            box-shadow: 0 3px 18px rgba(0, 0, 0, .06);
            transition: .3s;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            border-left: 4px solid var(--accent-color);
        }

        .module-card:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 28px rgba(23, 92, 221, .1);
        }

        .module-card .mod-num {
            width: 38px;
            height: 38px;
            background: var(--accent-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            font-weight: 900;
            font-family: var(--heading-font);
            flex-shrink: 0;
        }

        .module-card h5 {
            font-size: 14px;
            font-weight: 800;
            margin: 0;
            line-height: 1.4;
            color: var(--heading-color);
        }

        /* HIGHLIGHTS */
        .highlight-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .05);
            transition: .3s;
            margin-bottom: 14px;
        }

        .highlight-item:hover {
            transform: translateX(4px);
            box-shadow: 0 6px 22px rgba(23, 92, 221, .08);
        }

        .highlight-item .hl-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: color-mix(in srgb, var(--accent-color), transparent 88%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--accent-color);
            flex-shrink: 0;
        }

        .highlight-item h6 {
            font-size: 14px;
            font-weight: 800;
            margin: 0 0 3px;
        }

        .highlight-item p {
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            margin: 0;
            line-height: 1.55;
        }

        /* MATERIALS */
        .material-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #fff;
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 70%);
            color: var(--heading-color);
            padding: 10px 18px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 700;
            margin: 5px;
            transition: .3s;
        }

        .material-chip:hover {
            background: var(--accent-color);
            color: #fff;
            border-color: var(--accent-color);
        }

        .material-chip i {
            color: var(--accent-color);
            font-size: 15px;
        }

        .material-chip:hover i {
            color: #fff;
        }

        /* FAQ */
        .faq .accordion-item {
            border: 1px solid color-mix(in srgb, var(--accent-color), transparent 80%);
            border-radius: 12px !important;
            overflow: hidden;
            margin-bottom: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
        }

        .faq .accordion-button {
            font-family: var(--heading-font);
            font-size: 15px;
            font-weight: 700;
            color: var(--heading-color);
            background: #fff;
            padding: 18px 22px;
            gap: 12px;
            display: flex;
            align-items: center;
        }

        .faq .accordion-button .faq-num {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
        }

        .faq .accordion-button:not(.collapsed) {
            color: var(--accent-color);
            background: color-mix(in srgb, var(--accent-color), transparent 96%);
            box-shadow: none;
        }

        .faq .accordion-button:not(.collapsed) .faq-num {
            background: var(--accent-color);
            color: #fff;
        }

        .faq .accordion-button::after {
            display: none;
        }

        .faq .accordion-button .ti {
            margin-left: auto;
            font-size: 17px;
            color: var(--accent-color);
        }

        .faq .accordion-button.collapsed .ti::before {
            content: "\f4fe";
            font-family: "bootstrap-icons";
        }

        .faq .accordion-button .ti::before {
            content: "\f2ea";
            font-family: "bootstrap-icons";
        }

        .faq .accordion-body {
            padding: 16px 22px 18px 64px;
            color: var(--default-color);
            line-height: 1.75;
            background: #fff;
            font-size: 14px;
        }

        /* CTA BOTTOM */
        .cta-bottom {
            background: linear-gradient(135deg, var(--heading-color), color-mix(in srgb, var(--heading-color), #1a3a7c 50%));
            padding: 60px 0;
            color: #fff;
        }

        .cta-bottom h2 {
            color: #fff;
            font-size: 30px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .cta-bottom p {
            color: rgba(255, 255, 255, .8);
            font-size: 16px;
            max-width: 460px;
            margin: 0;
        }

        .cta-bottom .btn-cw {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: var(--accent-color);
            padding: 14px 30px;
            border-radius: 30px;
            font-weight: 800;
            font-size: 15px;
            transition: .3s;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .2);
        }

        .cta-bottom .btn-cw:hover {
            background: #ffd54f;
            color: #112344;
            transform: translateY(-2px);
        }

        .cta-bottom .btn-co {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: rgba(255, 255, 255, .85);
            border: 1.5px solid rgba(255, 255, 255, .35);
            padding: 14px 26px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            transition: .3s;
        }

        .cta-bottom .btn-co:hover {
            background: rgba(255, 255, 255, .1);
            color: #fff;
        }

        /* OTHER COURSES */
        .other-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 22px rgba(0, 0, 0, .07);
            transition: .3s;
        }

        .other-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 38px rgba(23, 92, 221, .12);
        }

        .other-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: block;
            transition: .5s;
        }

        .other-card:hover img {
            transform: scale(1.05);
        }

        .other-card .oc-body {
            padding: 18px 18px 16px;
        }

        .other-card .oc-body h5 {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .other-card .oc-body .oc-meta {
            font-size: 12px;
            color: var(--accent-color);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .other-card .oc-body .btn-oc {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
            padding: 7px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 800;
            transition: .3s;
        }

        .other-card .oc-body .btn-oc:hover {
            background: var(--accent-color);
            color: #fff;
        }
    </style>
    <main class="main">

        <!-- HERO BANNER -->
        <div class="course-hero">
            <img src="{{ asset($course->banner_image) }}" alt="{{ $course->title }}">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="container">
                    @if($course->category)
                        <div class="badge-cat" data-aos="fade-down">
                            <i class="bi bi-camera-video me-1"></i> {{ $course->category->name }}
                        </div>
                    @endif
                    <h1 data-aos="fade-up">{{ $course->title }}</h1>
                    <div class="hero-meta" data-aos="fade-up" data-aos-delay="80">
                        @if($course->duration)
                            <div class="hm"><i class="bi bi-clock-fill"></i> {{ $course->duration }}</div>
                        @endif
                        @if($course->sessions)
                            <div class="hm"><i class="bi bi-collection-play-fill"></i> {{ $course->sessions }} Sessions</div>
                        @endif
                        @if($course->mode)
                            <div class="hm"><i class="bi bi-laptop"></i> {{ $course->mode }}</div>
                        @endif
                        @if($course->age_group)
                            <div class="hm"><i class="bi bi-people-fill"></i> {{ $course->age_group }}</div>
                        @endif
                    </div>
                    <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-enroll-hero"
                        data-aos="fade-up" data-aos-delay="140">
                        <i class="bi bi-whatsapp"></i> Enroll Now
                    </a>
                </div>
            </div>
            <div class="breadcrumb-bar">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Courses</a></li>
                        <li class="breadcrumb-item active">{{ $course->title }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- QUICK INFO STRIP -->
        <div class="quick-info">
            <div class="container">
                <div class="row align-items-center gy-3 text-center text-md-start">
                    @if($course->duration)
                        <div class="col-6 col-md">
                            <div class="qi-item justify-content-center justify-content-md-start">
                                <i class="bi bi-clock-fill"></i>
                                <div>
                                    <div class="qi-label">Duration</div>
                                    <div class="qi-val">{{ $course->duration }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-md-auto">
                            <div class="divider"></div>
                        </div>
                    @endif

                    @if($course->sessions)
                        <div class="col-6 col-md">
                            <div class="qi-item justify-content-center justify-content-md-start">
                                <i class="bi bi-collection-play-fill"></i>
                                <div>
                                    <div class="qi-label">Sessions</div>
                                    <div class="qi-val">{{ $course->sessions }} Sessions</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-md-auto">
                            <div class="divider"></div>
                        </div>
                    @endif

                    @if($course->age_group)
                        <div class="col-6 col-md">
                            <div class="qi-item justify-content-center justify-content-md-start">
                                <i class="bi bi-people-fill"></i>
                                <div>
                                    <div class="qi-label">Age Group</div>
                                    <div class="qi-val">{{ $course->age_group }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-md-auto">
                            <div class="divider"></div>
                        </div>
                    @endif

                    @if($course->mode)
                        <div class="col-6 col-md">
                            <div class="qi-item justify-content-center justify-content-md-start">
                                <i class="bi bi-laptop"></i>
                                <div>
                                    <div class="qi-label">Mode</div>
                                    <div class="qi-val">{{ $course->mode }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-md-auto">
                            <div class="divider"></div>
                        </div>
                    @endif

                    @if($course->fees)
                        <div class="col-6 col-md">
                            <div class="qi-item justify-content-center justify-content-md-start">
                                <i class="bi bi-cash-coin"></i>
                                <div>
                                    <div class="qi-label">Course Fee</div>
                                    <div class="qi-val">₹{{ number_format($course->fees) }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <section class="section">
            <div class="container">
                <div class="row gy-5">

                    <!-- LEFT CONTENT -->
                    <div class="col-lg-8">

                        <!-- About -->
                        <div class="mb-5" data-aos="fade-up">
                            <h3 class="sec-title">About This Course</h3>
                            <div class="sec-sub">{!! $course->description !!}</div>

                            {{-- Centers & States --}}
                            @if($course->centers->count())
                                <div style="margin-top:16px;">
                                    <strong style="font-size:13px;color:var(--hc);">
                                        <i class="bi bi-geo-alt-fill" style="color:var(--ac);"></i> Available At:
                                    </strong>
                                    <div style="margin-top:8px;display:flex;flex-wrap:wrap;gap:6px;">
                                        @foreach($course->centers as $center)
                                            <span class="center-pill">
                                                <i class="bi bi-building"></i>
                                                {{ $center->name }}
                                                @if($center->state)
                                                    &nbsp;·&nbsp;{{ $center->state->name }}
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- FAQ -->
                        <div class="faq" data-aos="fade-up">
                            <h3 class="sec-title">Frequently Asked Questions</h3>
                            <p class="sec-sub">Everything you need to know before enrolling.</p>
                            <div class="accordion" id="faqAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq1">
                                            <span class="faq-num">1</span>
                                            What age group is this course for?
                                        </button>
                                    </h2>
                                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            @if($course->age_group)
                                                This programme is designed for {{ $course->age_group }}. The curriculum is
                                                carefully adapted to ensure age-appropriate learning and maximum engagement.
                                            @else
                                                This programme is open to all age groups. Contact us for details.
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq2">
                                            <span class="faq-num">2</span>
                                            How long is the course and how many sessions?
                                        </button>
                                    </h2>
                                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            The course runs for {{ $course->duration ?? 'a set duration' }}
                                            @if($course->sessions)
                                                across {{ $course->sessions }} sessions
                                            @endif
                                            . Each session is carefully designed to build on the previous one progressively.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq3">
                                            <span class="faq-num">3</span>
                                            Is a certificate provided on completion?
                                        </button>
                                    </h2>
                                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Yes! An official Act to Action certificate is awarded upon successful completion
                                            of the programme with a minimum attendance requirement.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq4">
                                            <span class="faq-num">4</span>
                                            What is the mode of training?
                                        </button>
                                    </h2>
                                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            This course is offered in
                                            <strong>{{ $course->mode ?? 'offline/hybrid' }}</strong> mode.
                                            @if($course->centers->count())
                                                Available at:
                                                @foreach($course->centers as $center)
                                                    {{ $center->name }}{{ $center->state ? ' (' . $center->state->name . ')' : '' }}{{ !$loop->last ? ', ' : '.' }}
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq5">
                                            <span class="faq-num">5</span>
                                            What is the course fee and refund policy?
                                        </button>
                                    </h2>
                                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            The course fee is <strong>₹{{ number_format($course->fees) }}</strong>. Fees are
                                            generally non-refundable. However, within the first month a refund may be
                                            considered on a case-by-case basis. Please WhatsApp us for details.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq6">
                                            <span class="faq-num">6</span>
                                            What if my child misses a session?
                                        </button>
                                    </h2>
                                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Study material is shared after every session and we offer a virtual catch-up
                                            support to help students who miss a class stay on track.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /col-lg-8 -->

                    <!-- RIGHT SIDEBAR -->
                    <div class="col-lg-4">
                        <div class="enroll-card" data-aos="fade-left">
                            <div class="card-top">
                                <div class="price-big">₹{{ number_format($course->fees) }}</div>
                                <div class="price-label">Full Course Fee</div>
                            </div>
                            <div class="card-body-p">
                                <ul class="info-list">
                                    @if($course->duration)
                                        <li><i class="bi bi-clock-fill"></i> <span><strong>Duration:</strong>
                                                {{ $course->duration }}</span></li>
                                    @endif
                                    @if($course->sessions)
                                        <li><i class="bi bi-collection-play-fill"></i> <span><strong>Sessions:</strong>
                                                {{ $course->sessions }} Total</span></li>
                                    @endif
                                    @if($course->age_group)
                                        <li><i class="bi bi-people-fill"></i> <span><strong>Age Group:</strong>
                                                {{ $course->age_group }}</span></li>
                                    @endif
                                    @if($course->mode)
                                        <li><i class="bi bi-laptop"></i> <span><strong>Mode:</strong> {{ $course->mode }}</span>
                                        </li>
                                    @endif
                                    @if($course->centers->count())
                                        <li>
                                            <i class="bi bi-geo-alt-fill"></i>
                                            <span>
                                                <strong>Centers:</strong>
                                                @foreach($course->centers as $center)
                                                    {{ $center->name }}{{ !$loop->last ? ', ' : '' }}
                                                @endforeach
                                            </span>
                                        </li>
                                    @endif
                                    <li><i class="bi bi-award-fill"></i> <span><strong>Certificate:</strong> On
                                            Completion</span></li>
                                </ul>
                                <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-enroll-big">
                                    <i class="bi bi-person-plus-fill"></i> Enroll Now
                                </a>
                                <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-wa">
                                    <i class="bi bi-whatsapp"></i> Ask on WhatsApp
                                </a>
                                <p class="note">🔒 Your details are safe with us. Our team will confirm your slot.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- OTHER COURSES -->
        @if($otherCourses->count())
            <section class="section-alt">
                <div class="container">
                    <h3 class="sec-title text-center" data-aos="fade-up">Explore Other Courses</h3>
                    <p class="sec-sub text-center" data-aos="fade-up">Discover more skill programmes offered by Act to Action.
                    </p>
                    <div class="row gy-4">
                        @foreach($otherCourses as $other)
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                                <div class="other-card">
                                    <img src="{{ asset($other->banner_image) }}" alt="{{ $other->title }}">
                                    <div class="oc-body">
                                        <div class="oc-meta">
                                            <i class="bi bi-people me-1"></i>{{ $other->age_group ?? 'All Ages' }}
                                            &nbsp;|&nbsp; ₹{{ number_format($other->fees) }}
                                        </div>
                                        <h5>{{ $other->title }}</h5>
                                        <a href="{{ route('course.details', $other->id) }}" class="btn-oc">
                                            View Details <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- CTA BOTTOM -->
        <div class="cta-bottom">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-7">
                        <h2>Secure Your Child's Seat Today</h2>
                        <p>Next batch starting soon — limited seats available. Contact us now and our team will guide you
                            through the enrolment process.</p>
                    </div>
                    <div class="col-lg-5 text-lg-end d-flex flex-wrap gap-3 justify-content-lg-end">
                        <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-cw">
                            <i class="bi bi-whatsapp"></i> WhatsApp Us
                        </a>
                        <a href="#" class="btn-co">
                            <i class="bi bi-arrow-left"></i> All Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        window.addEventListener('load', () => document.getElementById('preloader')?.classList.add('loaded'));
        AOS.init({ duration: 600, easing: 'ease-in-out', once: true });

        const sTop = document.getElementById('scrollTop');
        if (sTop) {
            window.addEventListener('scroll', () => sTop.classList.toggle('active', scrollY > 100));
            sTop.addEventListener('click', e => { e.preventDefault(); scrollTo({ top: 0, behavior: 'smooth' }); });
        }

        const hdr = document.getElementById('header');
        if (hdr) window.addEventListener('scroll', () => hdr.classList.toggle('scrolled', scrollY > 10));

        const tog = document.getElementById('mobileNavToggle'), nav = document.getElementById('navmenu');
        if (tog) {
            tog.addEventListener('click', () => {
                nav.classList.toggle('mobile-nav-active');
                tog.querySelector('i').classList.toggle('bi-list');
                tog.querySelector('i').classList.toggle('bi-x-lg');
            });
        }
    </script>
@endsection