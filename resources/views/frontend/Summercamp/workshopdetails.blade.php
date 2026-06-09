{{-- resources/views/frontend/Summercamp/workshopdetails.blade.php --}}
@extends('frontend.course.layout')
@section('title', $school->name . ' – Act To Action')

@section('content')

<style>
    a { color: var(--accent-color); text-decoration: none; transition: .3s; }
    a:hover { color: color-mix(in srgb, var(--accent-color), transparent 25%); }
    h1, h2, h3, h4, h5, h6 { color: var(--heading-color); font-family: var(--heading-font); }

    .header { --background-color: rgb(255, 255, 255); }

    /* HERO BANNER */
    .course-hero { position: relative; height: 520px; overflow: hidden; background: #0a1432; }
    .course-hero > img { width: 100%; height: 100%; object-fit: cover; display: block; filter: blur(2px) saturate(.9) brightness(.7); transform: scale(1.05); }
    .course-hero .hero-overlay { position: absolute; inset: 0; background: linear-gradient(115deg, rgba(10,20,50,.94) 0%, rgba(10,20,50,.82) 45%, rgba(10,20,50,.68) 75%, rgba(10,20,50,.55) 100%); }
    .course-hero .hero-overlay::after { content: ""; position: absolute; inset: 0; background: radial-gradient(ellipse at top right, rgba(23,92,221,.25) 0%, transparent 55%); pointer-events: none; }
    .course-hero .hero-content { position: absolute; inset: 0; display: flex; align-items: center; padding-top: 185px; z-index: 2; }
    .course-hero .hero-content .container { position: relative; z-index: 2; }
    .course-hero .hero-content .badge-cat { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.35); color: #fff; padding: 5px 16px; border-radius: 30px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: .6px; margin-right: 6px; margin-bottom: 6px; backdrop-filter: blur(6px); }
    .course-hero .hero-content .badge-free { background: rgba(22,163,74,.4); border-color: rgba(22,163,74,.6); }
    .course-hero .hero-content h1 { color: #fff; font-size: 46px; font-weight: 900; line-height: 1.15; margin-bottom: 14px; max-width: 680px; text-shadow: 0 2px 14px rgba(0,0,0,.35); text-transform: capitalize; }
    .course-hero .hero-content p.lead { color: rgba(255,255,255,.92); max-width: 640px; font-size: 16px; line-height: 1.65; margin-bottom: 24px; text-shadow: 0 1px 8px rgba(0,0,0,.35); }
    .course-hero .hero-content .hero-meta { display: flex; flex-wrap: wrap; gap: 14px; margin-bottom: 28px; }
    .course-hero .hero-content .hero-meta .hm { display: flex; align-items: center; gap: 7px; color: rgba(255,255,255,.85); font-size: 14px; font-weight: 600; }
    .course-hero .hero-content .hero-meta .hm i { color: #ffd54f; font-size: 16px; }
    .course-hero .hero-content .btn-enroll-hero { display: inline-flex; align-items: center; gap: 8px; background: var(--accent-color); color: #fff; padding: 14px 32px; border-radius: 30px; font-weight: 800; font-size: 15px; transition: .3s; box-shadow: 0 8px 25px rgba(23,92,221,.45); }
    .course-hero .hero-content .btn-enroll-hero:hover { background: #fff; color: var(--accent-color); transform: translateY(-2px); }
    .course-hero .hero-content .btn-ghost { display: inline-flex; align-items: center; gap: 8px; background: transparent; color: #fff; border: 1.5px solid rgba(255,255,255,.4); padding: 13px 26px; border-radius: 30px; font-weight: 700; font-size: 14px; transition: .3s; margin-left: 8px; }
    .course-hero .hero-content .btn-ghost:hover { background: rgba(255,255,255,.12); color: #fff; }
    .course-hero .breadcrumb-bar { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(17,35,68,.7); backdrop-filter: blur(8px); padding: 12px 0; }
    .course-hero .breadcrumb-bar .breadcrumb { margin: 0; padding: 0; background: transparent; }
    .course-hero .breadcrumb-bar .breadcrumb-item { font-size: 13px; color: rgba(255,255,255,.7); }
    .course-hero .breadcrumb-bar .breadcrumb-item.active { color: #fff; font-weight: 600; }
    .course-hero .breadcrumb-bar .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,.4); }
    .course-hero .breadcrumb-bar .breadcrumb-item a { color: rgba(255,255,255,.7); }
    .course-hero .breadcrumb-bar .breadcrumb-item a:hover { color: #fff; }

    @media(max-width:991px) { .enroll-card { position: static; top: auto; margin-top: 32px; } }
    @media(max-width:768px) {
        .course-hero { height: auto; min-height: 460px; }
        .course-hero .hero-content h1 { font-size: 28px; }
        .course-hero .hero-overlay { background: rgba(10,20,50,.8); }
        .quick-info { padding: 16px 0; }
        .quick-info .qi-item { justify-content: center; padding: 6px 0; }
        .enroll-card .card-top { padding: 22px 20px 18px; }
        .enroll-card .card-top .price-big { font-size: 32px; }
    }
    @media(max-width:576px) { .course-hero .hero-content h1 { font-size: 24px; } }

    /* QUICK INFO STRIP */
    .quick-info { background: var(--heading-color); padding: 20px 0; }
    .quick-info .qi-item { display: flex; align-items: center; gap: 10px; color: rgba(255,255,255,.85); }
    .quick-info .qi-item i { font-size: 20px; color: #ffd54f; }
    .quick-info .qi-item .qi-label { font-size: 11px; opacity: .65; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 1px; }
    .quick-info .qi-item .qi-val { font-size: 14px; font-weight: 800; color: #fff; font-family: var(--heading-font); }
    .quick-info .divider { width: 1px; height: 36px; background: rgba(255,255,255,.12); margin: auto; }

    /* SECTION */
    .section { padding: 80px 0; }
    .section-alt { background: color-mix(in srgb, var(--accent-color), transparent 96%); }
    .sec-title { font-size: 26px; font-weight: 900; margin-bottom: 6px; }
    .sec-sub { font-size: 15px; color: color-mix(in srgb, var(--default-color), transparent 25%); margin-bottom: 30px; line-height: 1.65; }

    /* ENROLL / SIDEBAR */
    .enroll-card { background: #fff; border-radius: 22px; box-shadow: 0 10px 50px rgba(0,0,0,.12); overflow: hidden; position: sticky; top: 100px; }
    .enroll-card .card-top { background: linear-gradient(135deg, var(--heading-color), color-mix(in srgb, var(--heading-color), #1a3a7c 50%)); padding: 28px 28px 24px; color: #fff; }
    .enroll-card .card-top .price-big { font-size: 40px; font-weight: 900; color: #fff; font-family: var(--heading-font); line-height: 1; }
    .enroll-card .card-top .price-label { font-size: 13px; color: rgba(255,255,255,.65); margin-top: 3px; }
    .enroll-card .card-top .price-free { color: #8ef0b0; }
    .enroll-card .card-body-p { padding: 24px 28px; }
    .enroll-card .info-list { list-style: none; padding: 0; margin: 0 0 22px; }
    .enroll-card .info-list li { display: flex; align-items: flex-start; gap: 10px; padding: 10px 0; border-bottom: 1px solid color-mix(in srgb, var(--accent-color), transparent 90%); font-size: 13.5px; line-height: 1.5; }
    .enroll-card .info-list li:last-child { border-bottom: none; }
    .enroll-card .info-list li i { color: var(--accent-color); font-size: 15px; flex-shrink: 0; margin-top: 2px; }
    .enroll-card .btn-enroll-big { display: flex; align-items: center; justify-content: center; gap: 9px; background: var(--accent-color); color: #fff; padding: 15px; border-radius: 14px; font-weight: 800; font-size: 15px; transition: .3s; width: 100%; box-shadow: 0 6px 20px rgba(23,92,221,.35); margin-bottom: 12px; }
    .enroll-card .btn-enroll-big:hover { background: var(--heading-color); color: #fff; transform: translateY(-2px); }
    .enroll-card .btn-wa { display: flex; align-items: center; justify-content: center; gap: 9px; background: #25d366; color: #fff; padding: 13px; border-radius: 14px; font-weight: 800; font-size: 14px; transition: .3s; width: 100%; }
    .enroll-card .btn-wa:hover { background: #1da851; color: #fff; }
    .enroll-card .note { font-size: 12px; color: color-mix(in srgb, var(--default-color), transparent 30%); text-align: center; margin-top: 14px; line-height: 1.5; }

    /* HIGHLIGHTS */
    .highlight-item { display: flex; align-items: flex-start; gap: 14px; padding: 16px; background: #fff; border-radius: 14px; box-shadow: 0 3px 15px rgba(0,0,0,.05); transition: .3s; margin-bottom: 14px; height: calc(100% - 14px); }
    .highlight-item:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(23,92,221,.1); }
    .highlight-item .hl-icon { width: 46px; height: 46px; border-radius: 12px; background: color-mix(in srgb, var(--accent-color), transparent 88%); display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--accent-color); flex-shrink: 0; }
    .highlight-item h6 { font-size: 14px; font-weight: 800; margin: 0 0 3px; }
    .highlight-item p { font-size: 13px; color: color-mix(in srgb, var(--default-color), transparent 20%); margin: 0; line-height: 1.55; }

    /* ABOUT */
    .about-body { font-size: 15px; line-height: 1.8; color: color-mix(in srgb, var(--default-color), transparent 15%); }

    /* LOCATION */
    .map-wrap { border-radius: 18px; overflow: hidden; box-shadow: 0 6px 28px rgba(0,0,0,.08); height: 380px; }
    .map-wrap iframe { width: 100%; height: 100%; border: 0; display: block; }
    .addr-card { background: #fff; border-radius: 18px; padding: 26px; box-shadow: 0 4px 22px rgba(0,0,0,.06); height: 100%; display: flex; flex-direction: column; gap: 18px; }
    .addr-row { display: flex; gap: 14px; align-items: flex-start; }
    .addr-row .ic { width: 42px; height: 42px; border-radius: 12px; background: color-mix(in srgb, var(--accent-color), transparent 88%); color: var(--accent-color); display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
    .addr-row .lb { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .8px; color: #9ca3af; margin-bottom: 3px; }
    .addr-row .vl { font-size: 14.5px; font-weight: 600; color: var(--heading-color); line-height: 1.5; }

    /* MERCHANDISE */
    .merch-head { display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 14px; margin-bottom: 24px; }
    .merch-badge { display: inline-flex; align-items: center; gap: 6px; background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); font-size: 11px; font-weight: 800; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: .6px; margin-bottom: 6px; }
    .merch-card { background: #fff; border-radius: 16px; overflow: hidden; border: 1.5px solid color-mix(in srgb, var(--default-color), transparent 90%); transition: .3s; display: flex; flex-direction: column; height: 100%; }
    .merch-card:hover { transform: translateY(-5px); box-shadow: 0 14px 36px rgba(0,0,0,.1); border-color: var(--accent-color); }
    .merch-card-img, .merch-card-ph { width: 100%; height: 190px; object-fit: cover; display: block; }
    .merch-card-ph { background: color-mix(in srgb, var(--accent-color), transparent 92%); display: flex; align-items: center; justify-content: center; }
    .merch-card-ph i { font-size: 3rem; color: var(--accent-color); opacity: .35; }
    .merch-card-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }
    .merch-card-name { font-size: 15px; font-weight: 800; color: var(--heading-color); margin-bottom: 4px; }
    .merch-card-desc { font-size: 12.5px; color: #9ca3af; line-height: 1.5; flex: 1; margin-bottom: 12px; }
    .merch-card-foot { display: flex; align-items: center; justify-content: space-between; padding-top: 10px; border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 92%); }
    .merch-card-price { font-size: 18px; font-weight: 900; color: var(--accent-color); }
    .merch-add { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 700; color: var(--accent-color); background: color-mix(in srgb, var(--accent-color), transparent 90%); padding: 5px 11px; border-radius: 20px; }
    .merch-note { margin-top: 22px; padding: 14px 18px; background: #fff; border-left: 4px solid var(--accent-color); border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,.04); font-size: 13.5px; color: color-mix(in srgb, var(--default-color), transparent 15%); display: flex; align-items: center; gap: 10px; }
    .merch-note i { color: var(--accent-color); flex-shrink: 0; font-size: 16px; }

    /* OTHER SCHOOLS */
    .other-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 22px rgba(0,0,0,.07); transition: .3s; display: block; text-decoration: none; color: inherit; }
    .other-card:hover { transform: translateY(-6px); box-shadow: 0 14px 38px rgba(23,92,221,.12); color: inherit; text-decoration: none; }
    .other-card .img-wrap { width: 100%; height: 170px; overflow: hidden; background: color-mix(in srgb, var(--accent-color), transparent 90%); display: flex; align-items: center; justify-content: center; }
    .other-card .img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: .5s; }
    .other-card:hover .img-wrap img { transform: scale(1.05); }
    .other-card .img-wrap .ph-i { font-size: 3rem; color: var(--accent-color); opacity: .3; }
    .other-card .oc-body { padding: 18px; }
    .other-card .oc-body h5 { font-size: 15px; font-weight: 800; margin-bottom: 6px; }
    .other-card .oc-body .oc-meta { font-size: 12px; color: var(--accent-color); font-weight: 700; margin-bottom: 10px; display: flex; flex-wrap: wrap; gap: 10px; }
    .other-card .oc-body .oc-meta span { display: inline-flex; align-items: center; gap: 4px; }
    .other-card .oc-body .btn-oc { display: inline-flex; align-items: center; gap: 5px; background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 7px 16px; border-radius: 20px; font-size: 12px; font-weight: 800; transition: .3s; }
    .other-card .oc-body .btn-oc:hover { background: var(--accent-color); color: #fff; }

    /* CTA BOTTOM */
    .cta-bottom { background: linear-gradient(135deg, var(--heading-color), color-mix(in srgb, var(--heading-color), #1a3a7c 50%)); padding: 60px 0; color: #fff; }
    .cta-bottom h2 { color: #fff; font-size: 30px; font-weight: 900; margin-bottom: 10px; }
    .cta-bottom p { color: rgba(255,255,255,.8); font-size: 16px; max-width: 520px; margin: 0; }
    .cta-bottom .btn-cw { display: inline-flex; align-items: center; gap: 8px; background: var(--accent-color); color: #fff; padding: 14px 30px; border-radius: 30px; font-weight: 800; font-size: 15px; transition: .3s; box-shadow: 0 8px 25px rgba(0,0,0,.2); }
    .cta-bottom .btn-cw:hover { background: #fff; color: var(--accent-color); transform: translateY(-2px); }
    .cta-bottom .btn-co { display: inline-flex; align-items: center; gap: 8px; background: transparent; color: rgba(255,255,255,.85); border: 1.5px solid rgba(255,255,255,.35); padding: 14px 26px; border-radius: 30px; font-weight: 700; font-size: 15px; transition: .3s; }
    .cta-bottom .btn-co:hover { background: rgba(255,255,255,.1); color: #fff; }
</style>

<main class="main">

    {{-- HERO BANNER --}}
    <div class="course-hero">
        @if($school->image_url)
            <img src="{{ $school->image_url }}" alt="{{ $school->name }}">
        @else
            <div style="position:absolute;inset:0;background:linear-gradient(135deg,#0a1432 0%,#1a2e5c 100%);"></div>
        @endif
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container">
                <div class="mb-2" data-aos="fade-down">
                    @if($school->ageGroup)
                        <span class="badge-cat"><i class="bi bi-people-fill"></i> {{ $school->ageGroup->name }}</span>
                    @endif
                    @if($school->city?->name)
                        <span class="badge-cat"><i class="bi bi-geo-alt-fill"></i> {{ $school->city->name }}</span>
                    @endif
                    @if($school->fees > 0)
                        <span class="badge-cat"><i class="bi bi-currency-rupee"></i> ₹{{ number_format($school->fees) }} / child</span>
                    @else
                        <span class="badge-cat badge-free"><i class="bi bi-gift-fill"></i> Free Workshop</span>
                    @endif
                </div>
                <h1 data-aos="fade-up">{{ $school->name }}</h1>
                @if($school->description)
                    <p class="lead" data-aos="fade-up" data-aos-delay="60">{{ Str::limit($school->description, 170) }}</p>
                @endif
                <div class="hero-meta" data-aos="fade-up" data-aos-delay="100">
                    @if($school->timings)
                        <div class="hm"><i class="bi bi-clock-fill"></i> {{ $school->timings }}</div>
                    @endif
                    @if($school->city)
                        <div class="hm"><i class="bi bi-geo-alt-fill"></i> {{ $school->city->name }}</div>
                    @endif
                    <div class="hm"><i class="bi bi-award-fill"></i> Certificate</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="140">
                    <a href="{{ route('workshops.register', $school) }}" class="btn-enroll-hero">
                        <i class="bi bi-pencil-square"></i> Register Now
                    </a>
                    <a href="#about" class="btn-ghost">
                        <i class="bi bi-info-circle"></i> Learn More
                    </a>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bar">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('workshops') }}">Workshops</a></li>
                    @if($school->ageGroup && $school->city)
                        <li class="breadcrumb-item">
                            <a href="{{ route('workshops', ['age_group_id' => $school->age_group_id, 'city_id' => $school->city_id]) }}">
                                {{ $school->ageGroup->name }} · {{ $school->city->name }}
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active">{{ $school->name }}</li>
                </ol>
            </div>
        </div>
    </div>

    {{-- QUICK INFO STRIP --}}
    <div class="quick-info">
        <div class="container">
            <div class="row align-items-center gy-3 text-center text-md-start">
                @if($school->timings)
                    <div class="col-6 col-md">
                        <div class="qi-item justify-content-center justify-content-md-start">
                            <i class="bi bi-calendar-week"></i>
                            <div>
                                <div class="qi-label">Schedule</div>
                                <div class="qi-val">{{ $school->timings }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-auto"><div class="divider"></div></div>
                @endif
                @if($school->city)
                    <div class="col-6 col-md">
                        <div class="qi-item justify-content-center justify-content-md-start">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <div class="qi-label">Location</div>
                                <div class="qi-val">{{ $school->city->name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-auto"><div class="divider"></div></div>
                @endif
                @if($school->ageGroup)
                    <div class="col-6 col-md">
                        <div class="qi-item justify-content-center justify-content-md-start">
                            <i class="bi bi-people-fill"></i>
                            <div>
                                <div class="qi-label">Age Group</div>
                                <div class="qi-val">{{ $school->ageGroup->name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-auto"><div class="divider"></div></div>
                @endif
                <div class="col-6 col-md">
                    <div class="qi-item justify-content-center justify-content-md-start">
                        <i class="bi bi-cash-coin"></i>
                        <div>
                            <div class="qi-label">Fees</div>
                            <div class="qi-val">
                                @if($school->fees > 0) ₹{{ number_format($school->fees) }} @else Free @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <section class="section" id="about">
        <div class="container">
            <div class="row gy-5">
                {{-- LEFT --}}
                <div class="col-lg-8">
                    @if($school->description)
                        <div class="mb-5" data-aos="fade-up">
                            <h3 class="sec-title">About This Workshop</h3>
                            <p class="sec-sub">Learn more about what this workshop has to offer.</p>
                            <div class="about-body">{{ $school->description }}</div>
                        </div>
                    @endif

                    {{-- HIGHLIGHTS --}}
                    <div data-aos="fade-up">
                        <h3 class="sec-title">What You'll Get</h3>
                        <p class="sec-sub">A carefully designed experience focused on hands-on learning and real skills.</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="highlight-item">
                                    <div class="hl-icon"><i class="bi bi-award-fill"></i></div>
                                    <div>
                                        <h6>Professional Trainers</h6>
                                        <p>Industry-trained mentors guiding every session.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="highlight-item">
                                    <div class="hl-icon"><i class="bi bi-camera-video-fill"></i></div>
                                    <div>
                                        <h6>Practical Learning</h6>
                                        <p>Activity-based modules — not just lectures.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="highlight-item">
                                    <div class="hl-icon"><i class="bi bi-shield-check"></i></div>
                                    <div>
                                        <h6>Safe Environment</h6>
                                        <p>Supervised sessions in a trusted school setting.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="highlight-item">
                                    <div class="hl-icon"><i class="bi bi-trophy-fill"></i></div>
                                    <div>
                                        <h6>Completion Certificate</h6>
                                        <p>Awarded to every child who completes the workshop.</p>
                                    </div>
                                </div>
                            </div>
                            @if($school->fees == 0)
                                <div class="col-md-6">
                                    <div class="highlight-item">
                                        <div class="hl-icon"><i class="bi bi-gift-fill"></i></div>
                                        <div>
                                            <h6>Completely Free</h6>
                                            <p>No fees — open to all eligible students.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="highlight-item">
                                    <div class="hl-icon"><i class="bi bi-headset"></i></div>
                                    <div>
                                        <h6>Dedicated Support</h6>
                                        <p>Mon–Sat, 11 AM – 7 PM. We're a call away.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="col-lg-4">
                    <div class="enroll-card" data-aos="fade-left">
                        <div class="card-top">
                            @if($school->fees > 0)
                                <div class="price-big">₹{{ number_format($school->fees) }}</div>
                                <div class="price-label">Per child · Workshop fee</div>
                            @else
                                <div class="price-big price-free">Free</div>
                                <div class="price-label">No fees to register</div>
                            @endif
                        </div>
                        <div class="card-body-p">
                            <ul class="info-list">
                                @if($school->timings)
                                    <li><i class="bi bi-clock-fill"></i> <span><strong>Schedule:</strong> {{ $school->timings }}</span></li>
                                @endif
                                @if($school->city)
                                    <li><i class="bi bi-geo-alt-fill"></i> <span><strong>City:</strong> {{ $school->city->name }}</span></li>
                                @endif
                                @if($school->ageGroup)
                                    <li><i class="bi bi-people-fill"></i> <span><strong>Age Group:</strong> {{ $school->ageGroup->name }}</span></li>
                                @endif
                                @if($school->address)
                                    <li><i class="bi bi-building"></i> <span><strong>Venue:</strong> {{ Str::limit($school->address, 60) }}</span></li>
                                @endif
                                <li><i class="bi bi-award-fill"></i> <span><strong>Certificate:</strong> On Completion</span></li>
                            </ul>
                            <a href="{{ route('workshops.register', $school) }}" class="btn-enroll-big">
                                <i class="bi bi-pencil-square"></i> Register Now
                            </a>
                            <a href="tel:+919024164323" class="btn-wa">
                                <i class="bi bi-telephone-fill"></i> Call +91 90241 64323
                            </a>
                            <p class="note">🔒 Seats are limited. Our team will confirm your registration on call.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LOCATION --}}
    @if($school->address)
        <section class="section-alt section">
            <div class="container">
                <div class="text-center mb-4" data-aos="fade-up">
                    <h3 class="sec-title">Workshop Location</h3>
                    <p class="sec-sub mb-0">Here's where you'll find us — easy to reach and well-connected.</p>
                </div>
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="map-wrap">
                            <iframe src="https://maps.google.com/maps?q={{ urlencode($school->address) }}&output=embed" allowfullscreen loading="lazy"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="addr-card">
                            <div class="addr-row">
                                <div class="ic"><i class="bi bi-geo-alt-fill"></i></div>
                                <div>
                                    <div class="lb">Address</div>
                                    <div class="vl">{{ $school->address }}</div>
                                </div>
                            </div>
                            <div class="addr-row">
                                <div class="ic"><i class="bi bi-telephone-fill"></i></div>
                                <div>
                                    <div class="lb">Phone</div>
                                    <div class="vl">+91 90241 64323</div>
                                </div>
                            </div>
                            <div class="addr-row">
                                <div class="ic"><i class="bi bi-envelope-fill"></i></div>
                                <div>
                                    <div class="lb">Email</div>
                                    <div class="vl">training@threatxpert.com</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- MERCHANDISE --}}
    @if($merchandises->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="merch-head" data-aos="fade-up">
                    <div>
                        <div class="merch-badge"><i class="bi bi-bag-heart-fill"></i> Official Merchandise</div>
                        <h3 class="sec-title" style="margin-bottom:4px;">Add Merchandise to Your Order</h3>
                        <p class="sec-sub" style="margin-bottom:0;">Select items when you register — fees are added to your total automatically.</p>
                    </div>
                    <a href="{{ route('workshops.register', $school) }}" class="btn-enroll-hero" style="white-space:nowrap;">
                        <i class="bi bi-pencil-square"></i> Register &amp; Add Items
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($merchandises as $item)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up">
                            <div class="merch-card">
                                @if($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="merch-card-img">
                                @else
                                    <div class="merch-card-ph"><i class="bi bi-bag"></i></div>
                                @endif
                                <div class="merch-card-body">
                                    <div class="merch-card-name">{{ $item->name }}</div>
                                    @if($item->description)
                                        <div class="merch-card-desc">{{ Str::limit($item->description, 70) }}</div>
                                    @endif
                                    <div class="merch-card-foot">
                                        <div class="merch-card-price">₹{{ number_format($item->price, 0) }}</div>
                                        <span class="merch-add"><i class="bi bi-plus-circle-fill"></i> On Register</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="merch-note" data-aos="fade-up">
                    <i class="bi bi-info-circle-fill"></i>
                    Merchandise is optional. Pick items and quantities on the registration page — the price is added to your workshop fee before payment.
                </div>
            </div>
        </section>
    @endif

    {{-- RELATED WORKSHOPS --}}
    @if($relatedSchools->isNotEmpty())
        <section class="section-alt section">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h3 class="sec-title">More Workshops in {{ $school->city?->name }}</h3>
                    <p class="sec-sub mb-0">Explore other nearby workshops in the same city.</p>
                </div>
                <div class="row gy-4">
                    @foreach($relatedSchools as $rel)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                            <a href="{{ route('workshops.show', $rel) }}" class="other-card">
                                <div class="img-wrap">
                                    @if($rel->image_url)
                                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}">
                                    @else
                                        <i class="bi bi-building ph-i"></i>
                                    @endif
                                </div>
                                <div class="oc-body">
                                    <div class="oc-meta">
                                        @if($rel->timings)
                                            <span><i class="bi bi-clock"></i>{{ Str::limit($rel->timings, 18) }}</span>
                                        @endif
                                        <span>
                                            @if($rel->fees > 0)
                                                <i class="bi bi-currency-rupee"></i>{{ number_format($rel->fees) }}
                                            @else
                                                <i class="bi bi-gift-fill"></i>Free
                                            @endif
                                        </span>
                                    </div>
                                    <h5>{{ $rel->name }}</h5>
                                    <span class="btn-oc">View Details <i class="bi bi-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- BOTTOM CTA --}}
    <div class="cta-bottom">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-7">
                    <h2>Ready to Join {{ $school->name }}?</h2>
                    <p>Secure your child's seat today — limited spots available. Our team will confirm your registration within 24 hours.</p>
                </div>
                <div class="col-lg-5 text-lg-end d-flex flex-wrap gap-3 justify-content-lg-end">
                    <a href="{{ route('workshops.register', $school) }}" class="btn-cw">
                        <i class="bi bi-pencil-square"></i>
                        @if($school->fees > 0)
                            Register — ₹{{ number_format($school->fees) }}
                        @else
                            Register — It's Free
                        @endif
                    </a>
                    <a href="{{ route('workshops') }}" class="btn-co">
                        <i class="bi bi-arrow-left"></i> All Workshops
                    </a>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
