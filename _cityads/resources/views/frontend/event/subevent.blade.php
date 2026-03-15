@extends('frontend.course.layout')
@section('content')

    {{-- ══════════════════════════════════════════════════════
     EVENT DETAIL PAGE
     resources/views/frontend/events/show.blade.php

     Controller:
     public function show($id) {
         $event = Event::with(['subEvents' => function($q) {
             $q->active()->with(['centersWithState']);
         }])->findOrFail($id);

         $otherEvents = Event::with(['subEvents' => function($q) {
             $q->active();
         }])->where('id', '!=', $id)->latest()->take(3)->get();

         return view('frontend.events.show', compact('event', 'otherEvents'));
     }
══════════════════════════════════════════════════════ --}}

    @php
        use Carbon\Carbon;
        $now = now();

        $totalSeats = $event->subEvents->sum('max_seats');
        $freeCount = $event->subEvents->where('fees', 0)->count();
        $activeCount = $event->subEvents->where('status', 1)->count();

        $stripes = [
            'linear-gradient(90deg,#112344,#175cdd)',
            'linear-gradient(90deg,#d97706,#fbbf24)',
            'linear-gradient(90deg,#059669,#34d399)',
            'linear-gradient(90deg,#7c3aed,#a78bfa)',
            'linear-gradient(90deg,#0891b2,#22d3ee)',
            'linear-gradient(90deg,#db2777,#f472b6)',
        ];

        $modeBadge = [
            'online' => ['bg' => '#dcfce7', 'color' => '#166534', 'icon' => 'bi-camera-video-fill'],
            'offline' => ['bg' => '#dbeafe', 'color' => '#1e40af', 'icon' => 'bi-building'],
            'hybrid' => ['bg' => '#f3e8ff', 'color' => '#6b21a8', 'icon' => 'bi-intersect'],
        ];
    @endphp

    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--heading-font);
            color: var(--heading-color);
        }

        /* BREADCRUMB */
        .breadcrumb-bar {
            background: #f4f8ff;
            border-bottom: 1px solid #e4ecf8;
            padding: 11px 0;
            font-size: 13px;
            color: #6b7280;
        }

        .breadcrumb-bar a {
            color: #6b7280;
            text-decoration: none;
            transition: color .2s;
        }

        .breadcrumb-bar a:hover {
            color: var(--accent-color);
        }

        .bc-sep {
            margin: 0 7px;
            color: #d1d5db;
        }

        .bc-current {
            color: var(--heading-color);
            font-weight: 700;
        }

        /* HERO */
        .detail-hero {
            position: relative;
            overflow: hidden;
        }

        .detail-hero-img {
            width: 100%;
            height: 440px;
            object-fit: cover;
            display: block;
        }

        .detail-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17, 35, 68, .94) 0%, rgba(17, 35, 68, .45) 55%, transparent 100%);
        }

        .detail-hero-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 44px 0;
        }

        .hero-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .pill-upcoming {
            background: #fef3c7;
            color: #92400e;
        }

        .pill-ongoing {
            background: #dcfce7;
            color: #166534;
        }

        .pill-past {
            background: #f3f4f6;
            color: #6b7280;
        }

        .detail-hero-content h1 {
            font-size: clamp(26px, 4.5vw, 50px);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .detail-tagline {
            font-size: 15px;
            color: rgba(255, 255, 255, .75);
            max-width: 620px;
            line-height: 1.65;
            margin-bottom: 20px;
        }

        .hero-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            color: rgba(255, 255, 255, .9);
            font-size: 12px;
            font-weight: 600;
            padding: 5px 13px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
        }

        .hero-pill i {
            color: #93c5fd;
        }

        @media(max-width:600px) {
            .detail-hero-img {
                height: 280px;
            }

            .detail-hero-content {
                padding: 20px 0;
            }
        }

        /* ABOUT */
        .about-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e8edf5;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(17, 35, 68, .05);
            margin-bottom: 28px;
        }

        .about-card h2 {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .about-card .desc-text {
            font-size: 15px;
            color: var(--default-color);
            line-height: 1.8;
        }

        .about-card .desc-text p {
            margin-bottom: 12px;
        }

        /* QUICK STATS */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 24px;
        }

        @media(max-width:576px) {
            .quick-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .qs-box {
            background: #f4f8ff;
            border: 1px solid #e4ecf8;
            border-radius: 12px;
            padding: 14px;
            text-align: center;
        }

        .qs-box .qsn {
            font-family: var(--heading-font);
            font-size: 22px;
            font-weight: 900;
            color: var(--accent-color);
            line-height: 1;
        }

        .qs-box .qsl {
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-top: 4px;
        }

        /* SUB EVENT CARDS */
        .sub-section {
            margin-top: 40px;
        }

        .sub-section-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .sub-section-sub {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 24px;
        }

        .sub-event-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e8edf5;
            overflow: hidden;
            transition: box-shadow .25s, transform .2s, border-color .25s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .sub-event-card:hover {
            box-shadow: 0 18px 55px rgba(23, 92, 221, .13);
            transform: translateY(-6px);
            border-color: var(--accent-color);
        }

        .sub-stripe {
            height: 5px;
            width: 100%;
        }

        .sub-card-head {
            padding: 18px 20px 14px;
            border-bottom: 1px solid #f0f4fb;
        }

        .sub-num-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--accent-color);
            margin-bottom: 4px;
        }

        .sub-card-head h5 {
            font-size: 16px;
            font-weight: 800;
            color: var(--heading-color);
            line-height: 1.3;
            margin-bottom: 0;
        }

        .sub-meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-bottom: 1px solid #f0f4fb;
        }

        .sub-meta-item {
            padding: 10px 18px;
            border-right: 1px solid #f0f4fb;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .sub-meta-item:nth-child(even) {
            border-right: none;
        }

        .sub-meta-item i {
            color: var(--accent-color);
            font-size: 13px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .sub-meta-label {
            font-size: 10px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 2px;
        }

        .sub-meta-value {
            font-size: 13px;
            font-weight: 600;
            color: var(--heading-color);
        }

        .sub-card-body {
            padding: 14px 20px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sub-card-body>p {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 14px;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .centers-wrap {
            margin-bottom: 14px;
        }

        .centers-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #9ca3af;
            margin-bottom: 6px;
        }

        .center-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .center-tag {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 8px;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .mode-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .fee-free {
            color: #166534;
            font-size: 13px;
            font-weight: 800;
            font-family: var(--heading-font);
        }

        .fee-paid {
            color: var(--heading-color);
            font-size: 13px;
            font-weight: 800;
            font-family: var(--heading-font);
        }

        .sub-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid #f0f4fb;
            margin-top: auto;
        }

        .sub-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
        }

        .dot-open {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #10b981;
            flex-shrink: 0;
        }

        .dot-soon {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #f59e0b;
            flex-shrink: 0;
        }

        .dot-closed {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #ef4444;
            flex-shrink: 0;
        }

        .btn-register {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--accent-color);
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: gap .2s;
        }

        .btn-register:hover {
            gap: 9px;
            color: var(--accent-color);
        }

        .btn-closed {
            font-size: 12px;
            color: #9ca3af;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* SIDEBAR */
        .detail-sidebar-wrap {
            position: sticky;
            top: 80px;
        }

        .sidebar-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e8edf5;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(17, 35, 68, .05);
            margin-bottom: 20px;
        }

        .sidebar-card:last-child {
            margin-bottom: 0;
        }

        .sc-head {
            padding: 13px 18px;
            border-bottom: 1px solid #f0f4fb;
            background: #f4f8ff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sc-head-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-color);
            font-size: 15px;
            flex-shrink: 0;
        }

        .sc-head h5 {
            font-size: 13px;
            font-weight: 700;
            color: var(--heading-color);
            margin: 0;
        }

        .sc-body {
            padding: 16px 18px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 9px 0;
            border-bottom: 1px dashed #e4ecf8;
            font-size: 13px;
            gap: 10px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row .ik {
            color: #6b7280;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .info-row .ik i {
            color: var(--accent-color);
            font-size: 12px;
        }

        .info-row .iv {
            color: var(--heading-color);
            font-weight: 700;
            font-family: var(--heading-font);
            text-align: right;
        }

        .side-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .side-stat {
            background: #f4f8ff;
            border: 1px solid #e4ecf8;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
        }

        .side-stat .ssn {
            font-family: var(--heading-font);
            font-size: 20px;
            font-weight: 900;
            color: var(--accent-color);
            line-height: 1;
        }

        .side-stat .ssl {
            font-size: 10px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-top: 3px;
        }

        .btn-reg-cta {
            width: 100%;
            padding: 13px;
            background: var(--accent-color);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: var(--heading-font);
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background .2s, transform .15s;
            box-shadow: 0 6px 22px rgba(23, 92, 221, .22);
            text-decoration: none;
        }

        .btn-reg-cta:hover {
            background: #0f4ab8;
            transform: translateY(-2px);
            color: #fff;
        }

        .btn-wa-cta {
            width: 100%;
            padding: 11px;
            background: #fff;
            color: var(--heading-color);
            border: 1.5px solid #e4ecf8;
            border-radius: 12px;
            font-family: var(--heading-font);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: border-color .2s;
            text-decoration: none;
            margin-top: 9px;
        }

        .btn-wa-cta:hover {
            border-color: #25d366;
            color: #25d366;
        }

        .sc-list {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sc-list li {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            font-size: 13px;
            color: var(--default-color);
        }

        .sc-list li i {
            color: var(--accent-color);
            font-size: 14px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* OTHER EVENTS */
        .other-events-section {
            padding: 60px 0 70px;
            background: #f4f8ff;
        }

        .section-title {
            text-align: center;
            margin-bottom: 44px;
        }

        .section-title h2 {
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .section-title .divider-line {
            display: block;
            width: 48px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 2px;
            margin: 0 auto 12px;
        }

        .section-title p {
            font-size: 15px;
            color: #6b7280;
            max-width: 520px;
            margin: 0 auto;
        }

        .oe-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e8edf5;
            overflow: hidden;
            transition: box-shadow .25s, transform .2s, border-color .25s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .oe-card:hover {
            box-shadow: 0 18px 55px rgba(23, 92, 221, .13);
            transform: translateY(-6px);
            border-color: var(--accent-color);
        }

        .oe-card-img {
            position: relative;
            height: 160px;
            overflow: hidden;
        }

        .oe-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .5s;
        }

        .oe-card:hover .oe-card-img img {
            transform: scale(1.06);
        }

        .oe-date-pill {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(17, 35, 68, .72);
            backdrop-filter: blur(5px);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 9px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .oe-card-body {
            padding: 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .oe-card-body h5 {
            font-size: 15px;
            font-weight: 800;
            color: var(--heading-color);
            line-height: 1.3;
            margin-bottom: 7px;
        }

        .oe-card-body p {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.55;
            margin-bottom: 12px;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .oe-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid #f0f4fb;
            margin-top: auto;
        }

        .oe-sub-count {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
        }

        .oe-sub-count i {
            color: var(--accent-color);
        }

        .oe-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--accent-color);
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: gap .2s;
        }

        .oe-link:hover {
            gap: 9px;
            color: var(--accent-color);
        }

        @media(max-width:768px) {
            .detail-sidebar-wrap {
                position: static;
            }

            .sub-meta-grid {
                grid-template-columns: 1fr;
            }

            .sub-meta-item {
                border-right: none !important;
                border-bottom: 1px solid #f0f4fb;
            }

            .sub-meta-item:last-child {
                border-bottom: none;
            }
        }
    </style>

    <main class="main">

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-bar">
            <div class="container d-flex align-items-center">
                <a href="{{ url('/') }}"><i class="bi bi-house me-1"></i>Home</a>
                <span class="bc-sep">/</span>
                <a href="#">Events</a>
                <span class="bc-sep">/</span>
                <span class="bc-current">{{ $event->title }}</span>
            </div>
        </div>

        {{-- HERO --}}
        <div class="detail-hero">
            @if ($event->banner_image)
                <img class="detail-hero-img" src="{{ asset($event->banner_image) }}" alt="{{ $event->title }}" />
            @else
                <img class="detail-hero-img" src="https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?w=1400&q=80"
                    alt="{{ $event->title }}" />
            @endif
            <div class="detail-hero-overlay"></div>
            <div class="detail-hero-content">
                <div class="container">

                    @php
                        // Determine hero status from sub events
                        $earliest = $event->subEvents->sortBy('event_date')->first();
                        if ($earliest) {
                            $eDate = Carbon::parse($earliest->event_date);
                            if ($now->lt($eDate)) {
                                $hStatus = 'Upcoming';
                                $hClass = 'pill-upcoming';
                                $hIcon = 'bi-calendar-alt';
                            } elseif ($activeCount > 0) {
                                $hStatus = 'Ongoing';
                                $hClass = 'pill-ongoing';
                                $hIcon = 'bi-calendar-check';
                            } else {
                                $hStatus = 'Past';
                                $hClass = 'pill-past';
                                $hIcon = 'bi-calendar-x';
                            }
                        } else {
                            $hStatus = 'Event';
                            $hClass = 'pill-upcoming';
                            $hIcon = 'bi-calendar-star';
                            $earliest = null;
                        }
                    @endphp

                    <div class="hero-status-pill {{ $hClass }}">
                        <i class="bi {{ $hIcon }}"></i>{{ $hStatus }}
                    </div>

                    <h1>{{ $event->title }}</h1>
                    <p class="detail-tagline">{{ Str::limit(strip_tags($event->description), 130) }}</p>

                    <div class="hero-pills">
                        @if ($earliest)
                            <span class="hero-pill"><i class="bi bi-calendar3"></i>From
                                {{ Carbon::parse($earliest->event_date)->format('M j, Y') }}</span>
                            @if ($earliest->age_group)
                                <span class="hero-pill"><i class="bi bi-people-fill"></i>{{ $earliest->age_group }}</span>
                            @endif
                            @if ($earliest->time_range !== '--')
                                <span class="hero-pill"><i class="bi bi-clock"></i>{{ $earliest->time_range }}</span>
                            @endif
                        @endif
                        @php $modes = $event->subEvents->pluck('mode')->unique()->filter(); @endphp
                        @foreach ($modes as $m)
                            @php $mb = $modeBadge[strtolower($m)] ?? ['bg'=>'#f3f4f6','color'=>'#374151','icon'=>'bi-circle']; @endphp
                            <span class="hero-pill"><i class="bi {{ $mb['icon'] }}"></i>{{ ucfirst($m) }}</span>
                        @endforeach
                        @if ($freeCount > 0)
                            <span class="hero-pill"><i class="bi bi-gift-fill"></i>{{ $freeCount }} Free
                                Session{{ $freeCount > 1 ? 's' : '' }}</span>
                        @endif
                        <span class="hero-pill"><i class="bi bi-collection-fill"></i>{{ $event->subEvents->count() }}
                            Session{{ $event->subEvents->count() != 1 ? 's' : '' }}</span>
                    </div>

                </div>
            </div>
        </div>

        {{-- BODY --}}
        <section style="padding:50px 0 60px;background:#fff;">
            <div class="container">
                <div class="row g-4">

                    {{-- LEFT --}}
                    <div class="col-lg-8">

                        {{-- About --}}
                        <div class="about-card">
                            <h2>About {{ $event->title }}</h2>
                            <div class="desc-text">{!! $event->description !!}</div>

                            @if ($event->subEvents->count() > 0)
                                <div class="quick-stats">
                                    <div class="qs-box">
                                        <div class="qsn">{{ $event->subEvents->count() }}</div>
                                        <div class="qsl">Sessions</div>
                                    </div>
                                    <div class="qs-box">
                                        <div class="qsn">{{ $activeCount }}</div>
                                        <div class="qsl">Active Now</div>
                                    </div>
                                    <div class="qs-box">
                                        <div class="qsn">{{ $totalSeats > 0 ? number_format($totalSeats) : '∞' }}</div>
                                        <div class="qsl">Total Seats</div>
                                    </div>
                                    <div class="qs-box">
                                        <div class="qsn">{{ $freeCount > 0 ? $freeCount : '—' }}</div>
                                        <div class="qsl">Free</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Sub Events --}}
                        @if ($event->subEvents->count() > 0)
                            <div class="sub-section">
                                <h3 class="sub-section-title">Sessions & Sub-Events</h3>
                                <p class="sub-section-sub">
                                    {{ $event->subEvents->count() }}
                                    session{{ $event->subEvents->count() != 1 ? 's' : '' }}
                                    available — register via WhatsApp
                                </p>

                                <div class="row g-4">
                                    @foreach ($event->subEvents as $si => $sub)
                                        @php
                                            $subDate = Carbon::parse($sub->event_date);
                                            $subStripe = $stripes[$si % count($stripes)];
                                            $mb = $modeBadge[strtolower($sub->mode ?? '')] ?? [
                                                'bg' => '#f3f4f6',
                                                'color' => '#374151',
                                                'icon' => 'bi-circle',
                                            ];
                                            $centers = $sub->centersWithState ?? collect();

                                            if (!$sub->status) {
                                                $subDot = 'dot-closed';
                                                $subStatus = 'Inactive';
                                            } elseif ($now->lt($subDate)) {
                                                $subDot = 'dot-soon';
                                                $subStatus = 'Opening Soon';
                                            } elseif ($now->gt($subDate)) {
                                                $subDot = 'dot-closed';
                                                $subStatus = 'Registrations Closed';
                                            } else {
                                                $subDot = 'dot-open';
                                                $subStatus = 'Open · Live';
                                            }
                                        @endphp

                                        <div class="col-md-6">
                                            <div class="sub-event-card">

                                                <div class="sub-stripe" style="background:{{ $subStripe }}"></div>

                                                <div class="sub-card-head">
                                                    <div class="sub-num-label">Session
                                                        {{ str_pad($si + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                                    <h5>{{ $sub->title }}</h5>
                                                </div>

                                                <div class="sub-meta-grid">

                                                    <div class="sub-meta-item">
                                                        <i class="bi bi-calendar3"></i>
                                                        <div>
                                                            <div class="sub-meta-label">Date</div>
                                                            <div class="sub-meta-value">{{ $subDate->format('M j, Y') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="sub-meta-item">
                                                        <i class="bi bi-clock"></i>
                                                        <div>
                                                            <div class="sub-meta-label">Time</div>
                                                            <div class="sub-meta-value">{{ $sub->time_range }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="sub-meta-item">
                                                        <i class="bi bi-ticket-perforated"></i>
                                                        <div>
                                                            <div class="sub-meta-label">Fee</div>
                                                            <div class="sub-meta-value">
                                                                @if ($sub->is_free)
                                                                    <span class="fee-free">Free</span>
                                                                @else
                                                                    <span
                                                                        class="fee-paid">₹{{ number_format($sub->fees, 0) }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="sub-meta-item">
                                                        <i class="bi bi-people"></i>
                                                        <div>
                                                            <div class="sub-meta-label">Age Group</div>
                                                            <div class="sub-meta-value">{{ $sub->age_group ?: '—' }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="sub-meta-item">
                                                        <i class="bi {{ $mb['icon'] }}"></i>
                                                        <div>
                                                            <div class="sub-meta-label">Mode</div>
                                                            <div class="sub-meta-value">
                                                                <span class="mode-badge"
                                                                    style="background:{{ $mb['bg'] }};color:{{ $mb['color'] }}">
                                                                    {{ ucfirst($sub->mode ?: '—') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="sub-meta-item">
                                                        <i class="bi bi-person-check"></i>
                                                        <div>
                                                            <div class="sub-meta-label">Max Seats</div>
                                                            <div class="sub-meta-value">
                                                                {{ $sub->max_seats ?: 'Unlimited' }}</div>
                                                        </div>
                                                    </div>

                                                </div>{{-- /sub-meta-grid --}}

                                                <div class="sub-card-body">

                                                    @if ($sub->description)
                                                        <p>{{ Str::limit(strip_tags($sub->description), 130) }}</p>
                                                    @endif

                                                    @if ($centers->count() > 0)
                                                        <div class="centers-wrap">
                                                            <div class="centers-label"><i
                                                                    class="bi bi-geo-alt me-1"></i>Available Centres</div>
                                                            <div class="center-tags">
                                                                @foreach ($centers as $center)
                                                                    <span class="center-tag"
                                                                        title="{{ $center->state->name ?? '' }}">
                                                                        {{ $center->name }}
                                                                        @if ($center->state)
                                                                            <span style="opacity:.6;font-size:10px;">·
                                                                                {{ $center->state->name }}</span>
                                                                        @endif
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="sub-card-footer">
                                                        <div class="sub-status">
                                                            <div class="{{ $subDot }}"></div>{{ $subStatus }}
                                                        </div>
                                                        @if ($subDot !== 'dot-closed')
                                                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank"
                                                                class="btn-register">
                                                                Register <i class="bi bi-arrow-right"></i>
                                                            </a>
                                                        @else
                                                            <span class="btn-closed"><i class="bi bi-x-circle"></i>
                                                                Closed</span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5"
                                style="background:#f8fafc;border-radius:16px;border:1.5px dashed #e4ecf8;">
                                <i class="bi bi-calendar-x"
                                    style="font-size:40px;color:#e5e7eb;display:block;margin-bottom:12px;"></i>
                                <p style="color:#9ca3af;font-size:14px;margin:0;">No sub-events scheduled yet. Check back
                                    soon!</p>
                            </div>
                        @endif

                    </div>{{-- /col-lg-8 --}}

                    {{-- SIDEBAR --}}
                    <div class="col-lg-4">
                        <div class="detail-sidebar-wrap">

                            {{-- Overview stats --}}
                            <div class="sidebar-card">
                                <div class="sc-head">
                                    <div class="sc-head-icon"><i class="bi bi-bar-chart-fill"></i></div>
                                    <h5>Event Overview</h5>
                                </div>
                                <div class="sc-body">
                                    <div class="side-stats">
                                        <div class="side-stat">
                                            <div class="ssn">{{ $event->subEvents->count() }}</div>
                                            <div class="ssl">Sessions</div>
                                        </div>
                                        <div class="side-stat">
                                            <div class="ssn">{{ $activeCount }}</div>
                                            <div class="ssl">Active</div>
                                        </div>
                                        <div class="side-stat">
                                            <div class="ssn">{{ $freeCount > 0 ? $freeCount : '—' }}</div>
                                            <div class="ssl">Free</div>
                                        </div>
                                        <div class="side-stat">
                                            <div class="ssn">{{ $totalSeats > 0 ? $totalSeats : '∞' }}</div>
                                            <div class="ssl">Seats</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Event Info --}}
                            <div class="sidebar-card">
                                <div class="sc-head">
                                    <div class="sc-head-icon"><i class="bi bi-info-circle-fill"></i></div>
                                    <h5>Event Information</h5>
                                </div>
                                <div class="sc-body">
                                    @if ($earliest ?? null)
                                        <div class="info-row">
                                            <span class="ik"><i class="bi bi-calendar3"></i>Starts</span>
                                            <span
                                                class="iv">{{ Carbon::parse($earliest->event_date)->format('M j, Y') }}</span>
                                        </div>
                                        @if ($earliest->time_range !== '--')
                                            <div class="info-row">
                                                <span class="ik"><i class="bi bi-clock"></i>Time</span>
                                                <span class="iv">{{ $earliest->time_range }}</span>
                                            </div>
                                        @endif
                                        @if ($earliest->age_group)
                                            <div class="info-row">
                                                <span class="ik"><i class="bi bi-people"></i>Age Group</span>
                                                <span class="iv">{{ $earliest->age_group }}</span>
                                            </div>
                                        @endif
                                    @endif

                                    @php $modes = $event->subEvents->pluck('mode')->unique()->filter()->map(fn($m)=>ucfirst($m)); @endphp
                                    @if ($modes->count())
                                        <div class="info-row">
                                            <span class="ik"><i class="bi bi-display"></i>Mode</span>
                                            <span class="iv">{{ $modes->implode(' / ') }}</span>
                                        </div>
                                    @endif

                                    @if ($freeCount > 0)
                                        <div class="info-row">
                                            <span class="ik"><i class="bi bi-gift"></i>Free Sessions</span>
                                            <span class="iv">{{ $freeCount }} available</span>
                                        </div>
                                    @endif

                                    @php
                                        $allCenters = $event->subEvents
                                            ->flatMap(fn($s) => $s->centersWithState ?? collect())
                                            ->unique('id');
                                    @endphp
                                    @if ($allCenters->count())
                                        <div class="info-row">
                                            <span class="ik"><i class="bi bi-geo-alt"></i>Centres</span>
                                            <span class="iv">{{ $allCenters->count() }}
                                                Location{{ $allCenters->count() > 1 ? 's' : '' }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- CTA --}}
                            <div class="sidebar-card">
                                <div class="sc-body">
                                    <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-reg-cta">
                                        <i class="bi bi-check2-circle"></i> Register Now — It's Free!
                                    </a>
                                    <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-wa-cta">
                                        <i class="bi bi-whatsapp" style="color:#25d366;"></i> Ask on WhatsApp
                                    </a>
                                </div>
                            </div>

                            {{-- Centres by State --}}
                            @if ($allCenters->count() > 0)
                                <div class="sidebar-card">
                                    <div class="sc-head">
                                        <div class="sc-head-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                        <h5>Available Centres</h5>
                                    </div>
                                    <div class="sc-body" style="padding:8px 18px;">
                                        @php $byState = $allCenters->groupBy(fn($c) => $c->state->name ?? 'Other'); @endphp
                                        @foreach ($byState as $stateName => $stateCenters)
                                            <div style="padding:8px 0;border-bottom:1px dashed #e4ecf8;">
                                                <div
                                                    style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#9ca3af;margin-bottom:5px;">
                                                    <i class="bi bi-map me-1"></i>{{ $stateName }}
                                                </div>
                                                @foreach ($stateCenters as $c)
                                                    <div
                                                        style="font-size:13px;font-weight:600;color:var(--heading-color);padding:2px 0;display:flex;align-items:center;gap:6px;">
                                                        <i class="bi bi-building"
                                                            style="color:var(--accent-color);font-size:11px;"></i>
                                                        {{ $c->name }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Hours --}}
                            <div class="sidebar-card">
                                <div class="sc-head">
                                    <div class="sc-head-icon"><i class="bi bi-clock-fill"></i></div>
                                    <h5>Operating Hours</h5>
                                </div>
                                <div class="sc-body">
                                    <ul class="sc-list">
                                        <li><i class="bi bi-calendar-week"></i>
                                            <div><strong>Tue – Sat</strong>&nbsp; 11 AM – 7 PM</div>
                                        </li>
                                        <li><i class="bi bi-calendar-week"></i>
                                            <div><strong>Sunday</strong>&nbsp; 10 AM – 4 PM</div>
                                        </li>
                                        <li><i class="bi bi-geo-alt-fill"></i>
                                            <div>Rising Passion Studio, Vaishali Nagar, Jaipur</div>
                                        </li>
                                        <li><i class="bi bi-telephone-fill"></i>
                                            <div>+91 93520 23276</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>{{-- /col-lg-4 --}}

                </div>
            </div>
        </section>

        {{-- OTHER EVENTS --}}
        @if (isset($otherEvents) && $otherEvents->count() > 0)
            <section class="other-events-section">
                <div class="container">
                    <div class="section-title">
                        <h2>Other Events by Act to Action</h2>
                        <span class="divider-line"></span>
                        <p>Explore more exciting programmes for young performers.</p>
                    </div>
                    <div class="row g-4">
                        @foreach ($otherEvents as $oi => $other)
                            @php
                                $oEarliest = $other->subEvents
                                    ? $other->subEvents->sortBy('event_date')->first()
                                    : null;
                                $oCount = $other->subEvents ? $other->subEvents->count() : 0;
                                $oStripe = $stripes[$oi % count($stripes)];
                            @endphp
                            <div class="col-md-4">
                                <div class="oe-card">
                                    <div class="sub-stripe" style="background:{{ $oStripe }}"></div>
                                    <div class="oe-card-img">
                                        @if ($other->banner_image)
                                            <img src="{{ asset($other->banner_image) }}" alt="{{ $other->title }}"
                                                loading="lazy" />
                                        @else
                                            <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600&q=80"
                                                alt="{{ $other->title }}" loading="lazy" />
                                        @endif
                                        @if ($oEarliest)
                                            <span class="oe-date-pill">
                                                <i
                                                    class="bi bi-calendar3"></i>{{ Carbon::parse($oEarliest->event_date)->format('M j, Y') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="oe-card-body">
                                        <h5>{{ $other->title }}</h5>
                                        <p>{{ Str::limit(strip_tags($other->description), 90) }}</p>
                                        <div class="oe-card-footer">
                                            <div class="oe-sub-count">
                                                <i class="bi bi-collection-fill"></i>{{ $oCount }}
                                                session{{ $oCount != 1 ? 's' : '' }}
                                            </div>
                                            <a href="{{ route('frontend.events.subevent', $other->id) }}"
                                                class="oe-link">
                                                View <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </main>
@endsection
