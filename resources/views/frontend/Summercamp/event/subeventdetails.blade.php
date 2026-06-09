@extends('frontend.course.layout')
@section('content')


    <style>
        /* ── Base ─────────────────────────────────────────── */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--heading-font);
            color: var(--heading-color)
        }

        /* ── Breadcrumb ───────────────────────────────────── */
        .breadcrumb-bar {
            background: #f4f8ff;
            border-bottom: 1px solid #e4ecf8;
            padding: 11px 0;
            margin-top: 185px;
            font-size: 13px;
            color: #6b7280
        }

        .breadcrumb-bar a {
            color: #6b7280;
            text-decoration: none;
            transition: color .2s
        }

        .breadcrumb-bar a:hover {
            color: var(--accent-color)
        }

        .bc-sep {
            margin: 0 7px;
            color: #d1d5db
        }

        .bc-current {
            color: var(--heading-color);
            font-weight: 700
        }

        /* ── Hero ─────────────────────────────────────────── */
        .sd-hero {
            position: relative;
            overflow: hidden
        }

        .sd-hero-img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            display: block
        }

        .sd-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17, 35, 68, .95) 0%, rgba(17, 35, 68, .5) 55%, transparent 100%)
        }

        .sd-hero-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 44px 0
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: .5px
        }

        .pill-open {
            background: #dcfce7;
            color: #166534
        }

        .pill-soon {
            background: #fef3c7;
            color: #92400e
        }

        .pill-closed {
            background: #f3f4f6;
            color: #6b7280
        }

        .sd-hero-content h1 {
            font-size: clamp(24px, 4vw, 46px);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 10px
        }

        .sd-hero-sub {
            font-size: 14px;
            color: rgba(255, 255, 255, .7);
            margin-bottom: 16px
        }

        .sd-parent-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: rgba(255, 255, 255, .6);
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, .2);
            padding: 5px 12px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
            transition: background .2s
        }

        .sd-parent-link:hover {
            background: rgba(255, 255, 255, .12);
            color: #fff
        }

        .hero-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 14px
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
            backdrop-filter: blur(4px)
        }

        .hero-pill i {
            color: #93c5fd
        }

        @media(max-width:600px) {
            .sd-hero-img {
                height: 260px
            }

            .sd-hero-content {
                padding: 20px 0
            }
        }

        /* ── Layout ───────────────────────────────────────── */
        .sd-body {
            padding: 50px 0 70px;
            background: #fff
        }

        /* ── Detail card ──────────────────────────────────── */
        .detail-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e8edf5;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(17, 35, 68, .05);
            margin-bottom: 28px
        }

        .detail-card h2 {
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 14px
        }

        .detail-card .desc-text {
            font-size: 15px;
            color: var(--default-color);
            line-height: 1.8
        }

        .detail-card .desc-text p {
            margin-bottom: 12px
        }

        /* ── Meta grid ────────────────────────────────────── */
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 24px
        }

        @media(max-width:768px) {
            .meta-grid {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media(max-width:480px) {
            .meta-grid {
                grid-template-columns: 1fr 1fr
            }
        }

        .meta-box {
            background: #f4f8ff;
            border: 1px solid #e4ecf8;
            border-radius: 14px;
            padding: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px
        }

        .meta-box-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-color);
            font-size: 16px;
            flex-shrink: 0
        }

        .meta-box-label {
            font-size: 10px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 3px
        }

        .meta-box-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--heading-color);
            font-family: var(--heading-font)
        }

        .fee-free {
            color: #166534
        }

        .fee-paid {
            color: var(--heading-color)
        }

        /* ── Centres ──────────────────────────────────────── */
        .centres-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e8edf5;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(17, 35, 68, .05);
            margin-bottom: 28px
        }

        .centres-card h3 {
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 18px
        }

        .state-block {
            margin-bottom: 18px
        }

        .state-block:last-child {
            margin-bottom: 0
        }

        .state-name {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: #9ca3af;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 5px
        }

        .center-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 7px
        }

        .center-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 10px
        }

        .center-chip i {
            font-size: 11px
        }

        /* ── Siblings ─────────────────────────────────────── */
        .siblings-section {
            margin-top: 40px
        }

        .siblings-section h3 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 6px
        }

        .siblings-section .sib-sub {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 22px
        }

        .sib-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #e8edf5;
            overflow: hidden;
            transition: box-shadow .25s, transform .2s, border-color .25s;
            height: 100%;
            display: flex;
            flex-direction: column
        }

        .sib-card:hover {
            box-shadow: 0 16px 48px rgba(23, 92, 221, .12);
            transform: translateY(-5px);
            border-color: var(--accent-color)
        }

        .sib-stripe {
            height: 4px;
            width: 100%
        }

        .sib-body {
            padding: 16px 18px;
            flex: 1;
            display: flex;
            flex-direction: column
        }

        .sib-num {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--accent-color);
            margin-bottom: 4px
        }

        .sib-body h5 {
            font-size: 14px;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 10px;
            line-height: 1.3
        }

        .sib-meta {
            font-size: 12px;
            color: #6b7280;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 12px
        }

        .sib-meta span {
            display: flex;
            align-items: center;
            gap: 4px
        }

        .sib-meta i {
            color: var(--accent-color)
        }

        .sib-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid #f0f4fb;
            margin-top: auto
        }

        .sib-status {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            color: #6b7280
        }

        .dot-open {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
            flex-shrink: 0
        }

        .dot-soon {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #f59e0b;
            flex-shrink: 0
        }

        .dot-closed {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #ef4444;
            flex-shrink: 0
        }

        .sib-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: var(--accent-color);
            font-weight: 700;
            font-size: 12px;
            text-decoration: none;
            transition: gap .2s
        }

        .sib-link:hover {
            gap: 8px;
            color: var(--accent-color)
        }

        /* ── Sidebar ──────────────────────────────────────── */
        .sd-sidebar {
            position: sticky;
            top: 80px
        }

        .sc {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e8edf5;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(17, 35, 68, .05);
            margin-bottom: 20px
        }

        .sc:last-child {
            margin-bottom: 0
        }

        .sc-head {
            padding: 13px 18px;
            border-bottom: 1px solid #f0f4fb;
            background: #f4f8ff;
            display: flex;
            align-items: center;
            gap: 10px
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
            flex-shrink: 0
        }

        .sc-head h5 {
            font-size: 13px;
            font-weight: 700;
            color: var(--heading-color);
            margin: 0
        }

        .sc-body {
            padding: 16px 18px
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 9px 0;
            border-bottom: 1px dashed #e4ecf8;
            font-size: 13px;
            gap: 10px
        }

        .info-row:last-child {
            border-bottom: none
        }

        .info-row .ik {
            color: #6b7280;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 5px
        }

        .info-row .ik i {
            color: var(--accent-color);
            font-size: 12px
        }

        .info-row .iv {
            color: var(--heading-color);
            font-weight: 700;
            font-family: var(--heading-font);
            text-align: right
        }

        /* ── CTA Buttons ──────────────────────────────────── */
        .btn-reg-cta {
            width: 100%;
            padding: 14px;
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
            text-decoration: none
        }

        .btn-reg-cta:hover {
            background: #0f4ab8;
            transform: translateY(-2px);
            color: #fff
        }

        .btn-reg-cta.disabled-cta {
            background: #e5e7eb;
            color: #9ca3af;
            box-shadow: none;
            cursor: not-allowed;
            pointer-events: none
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
            margin-top: 9px
        }

        .btn-wa-cta:hover {
            border-color: #25d366;
            color: #25d366
        }

        .sc-list {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 10px
        }

        .sc-list li {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            font-size: 13px;
            color: var(--default-color)
        }

        .sc-list li i {
            color: var(--accent-color);
            font-size: 14px;
            flex-shrink: 0;
            margin-top: 2px
        }

        /* ── Countdown banner ─────────────────────────────── */
        .countdown-banner {
            background: linear-gradient(90deg, #112344, #175cdd);
            border-radius: 14px;
            padding: 18px 20px;
            margin-bottom: 20px;
            color: #fff;
            text-align: center
        }

        .countdown-banner .cb-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: rgba(255, 255, 255, .7);
            margin-bottom: 10px
        }

        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 10px
        }

        .ct-unit {
            background: rgba(255, 255, 255, .12);
            border-radius: 10px;
            padding: 8px 12px;
            min-width: 52px
        }

        .ct-unit .ctn {
            font-family: var(--heading-font);
            font-size: 22px;
            font-weight: 900;
            line-height: 1
        }

        .ct-unit .ctl {
            font-size: 10px;
            color: rgba(255, 255, 255, .6);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-top: 3px
        }

        @media(max-width:768px) {
            .sd-sidebar {
                position: static
            }
        }
    </style>
    @php
        use Carbon\Carbon;
        $now = now();

        $subDate = Carbon::parse($sub->event_date);
        $centers = $sub->centersWithState ?? collect();
        $byState = $centers->groupBy(fn($c) => $c->state->name ?? 'Other');

        $modeBadge = [
            'online' => [
                'bg' => '#dcfce7',
                'color' => '#166534',
                'icon' => 'bi-camera-video-fill',
                'label' => 'Online',
            ],
            'offline' => ['bg' => '#dbeafe', 'color' => '#1e40af', 'icon' => 'bi-building', 'label' => 'Offline'],
            'hybrid' => ['bg' => '#f3e8ff', 'color' => '#6b21a8', 'icon' => 'bi-intersect', 'label' => 'Hybrid'],
        ];
        $mb = $modeBadge[strtolower($sub->mode ?? '')] ?? [
            'bg' => '#f3f4f6',
            'color' => '#374151',
            'icon' => 'bi-circle',
            'label' => ucfirst($sub->mode ?: '—'),
        ];

        // Status logic
        if (!$sub->status) {
            $dot = 'dot-closed';
            $statusLabel = 'Inactive';
        } elseif ($now->lt($subDate)) {
            $dot = 'dot-soon';
            $statusLabel = 'Opening Soon';
        } elseif ($now->gt($subDate)) {
            $dot = 'dot-closed';
            $statusLabel = 'Registrations Closed';
        } else {
            $dot = 'dot-open';
            $statusLabel = 'Open · Live';
        }

        $canRegister = $dot !== 'dot-closed';

        // Related sessions from same parent event (exclude current)
        $siblings = $sub->event->subEvents->where('id', '!=', $sub->id)->values();

        $stripes = [
            'linear-gradient(90deg,#112344,#175cdd)',
            'linear-gradient(90deg,#d97706,#fbbf24)',
            'linear-gradient(90deg,#059669,#34d399)',
            'linear-gradient(90deg,#7c3aed,#a78bfa)',
            'linear-gradient(90deg,#0891b2,#22d3ee)',
            'linear-gradient(90deg,#db2777,#f472b6)',
        ];
    @endphp



    <main class="main">

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-bar">
            <div class="container d-flex align-items-center flex-wrap">
                <a href="{{ url('/') }}"><i class="bi bi-house me-1"></i>Home</a>
                <span class="bc-sep">/</span>
                <a href="#">Events</a>
                <span class="bc-sep">/</span>
                <a href="{{ route('summercamp.event', $sub->event->slug) }}">{{ $sub->event->title }}</a>
                <span class="bc-sep">/</span>
                <span class="bc-current">{{ $sub->title }}</span>
            </div>
        </div>

        {{-- HERO --}}
        <div class="sd-hero">
            @if ($sub->banner_image)
                <img class="sd-hero-img" src="{{ $sub->banner_url }}" alt="{{ $sub->title }}" />
            @elseif ($sub->event->banner_image)
                <img class="sd-hero-img" src="{{ $sub->event->banner_url }}" alt="{{ $sub->title }}" />
            @else
                <img class="sd-hero-img" src="https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?w=1400&q=80"
                    alt="{{ $sub->title }}" />
            @endif
            <div class="sd-hero-overlay"></div>
            <div class="sd-hero-content">
                <div class="container">

                    @php
                        if ($dot === 'dot-open') {
                            $pillClass = 'pill-open';
                            $pillIcon = 'bi-circle-fill';
                        } elseif ($dot === 'dot-soon') {
                            $pillClass = 'pill-soon';
                            $pillIcon = 'bi-calendar-alt';
                        } else {
                            $pillClass = 'pill-closed';
                            $pillIcon = 'bi-x-circle';
                        }
                    @endphp

                    <div class="status-pill {{ $pillClass }}">
                        <i class="bi {{ $pillIcon }}" style="font-size:8px"></i>{{ $statusLabel }}
                    </div>

                    <a href="{{ route('summercamp.event', $sub->event->slug) }}" class="sd-parent-link d-inline-flex mb-2">
                        <i class="bi bi-arrow-left"></i>{{ $sub->event->title }}
                    </a>

                    <h1>{{ $sub->title }}</h1>
                    <p class="sd-hero-sub">Part of <strong style="color:#fff">{{ $sub->event->title }}</strong></p>

                    <div class="hero-pills">
                        <span class="hero-pill"><i class="bi bi-calendar3"></i>{{ $subDate->format('M j, Y') }}</span>
                        @if ($sub->time_range !== '--')
                            <span class="hero-pill"><i class="bi bi-clock"></i>{{ $sub->time_range }}</span>
                        @endif
                        @if ($sub->age_group)
                            <span class="hero-pill"><i class="bi bi-people-fill"></i>{{ $sub->age_group }}</span>
                        @endif
                        <span class="hero-pill">
                            <i class="bi {{ $mb['icon'] }}"></i>{{ $mb['label'] }}
                        </span>
                        @if ($sub->is_free)
                            <span class="hero-pill"><i class="bi bi-gift-fill"></i>Free</span>
                        @else
                            <span class="hero-pill"><i
                                    class="bi bi-currency-rupee"></i>₹{{ number_format($sub->fees, 0) }}</span>
                        @endif
                        @if ($sub->max_seats)
                            <span class="hero-pill"><i class="bi bi-person-check"></i>{{ number_format($sub->max_seats) }}
                                seats</span>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        {{-- BODY --}}
        <section class="sd-body">
            <div class="container">
                <div class="row g-4">

                    {{-- ── LEFT ────────────────────────────────── --}}
                    <div class="col-lg-8">

                        {{-- About --}}
                        <div class="detail-card">
                            <h2>About This Session</h2>
                            <div class="desc-text">
                                @if ($sub->description)
                                    {!! $sub->description !!}
                                @else
                                    <p style="color:#9ca3af">No description provided for this session.</p>
                                @endif
                            </div>

                            {{-- Meta boxes --}}
                            <div class="meta-grid">
                                <div class="meta-box">
                                    <div class="meta-box-icon"><i class="bi bi-calendar3"></i></div>
                                    <div>
                                        <div class="meta-box-label">Date</div>
                                        <div class="meta-box-value">{{ $subDate->format('M j, Y') }}</div>
                                        <div style="font-size:11px;color:#9ca3af;margin-top:2px">
                                            {{ $subDate->format('l') }}</div>
                                    </div>
                                </div>

                                <div class="meta-box">
                                    <div class="meta-box-icon"><i class="bi bi-clock"></i></div>
                                    <div>
                                        <div class="meta-box-label">Time</div>
                                        <div class="meta-box-value">
                                            {{ $sub->time_range !== '--' ? $sub->time_range : '—' }}</div>
                                    </div>
                                </div>

                                <div class="meta-box">
                                    <div class="meta-box-icon"><i class="bi bi-ticket-perforated"></i></div>
                                    <div>
                                        <div class="meta-box-label">Registration Fee</div>
                                        <div class="meta-box-value">
                                            @if ($sub->is_free)
                                                <span class="fee-free">Free</span>
                                            @else
                                                <span class="fee-paid">₹{{ number_format($sub->fees, 0) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="meta-box">
                                    <div class="meta-box-icon"><i class="bi bi-people"></i></div>
                                    <div>
                                        <div class="meta-box-label">Age Group</div>
                                        <div class="meta-box-value">{{ $sub->age_group ?: '—' }}</div>
                                    </div>
                                </div>

                                <div class="meta-box">
                                    <div class="meta-box-icon"><i class="bi {{ $mb['icon'] }}"></i></div>
                                    <div>
                                        <div class="meta-box-label">Mode</div>
                                        <div class="meta-box-value">
                                            <span
                                                style="background:{{ $mb['bg'] }};color:{{ $mb['color'] }};padding:2px 8px;border-radius:7px;font-size:12px">
                                                {{ $mb['label'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="meta-box">
                                    <div class="meta-box-icon"><i class="bi bi-person-check"></i></div>
                                    <div>
                                        <div class="meta-box-label">Max Seats</div>
                                        <div class="meta-box-value">
                                            {{ $sub->max_seats ? number_format($sub->max_seats) : 'Unlimited' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Centres --}}
                        @if ($centers->count() > 0)
                            <div class="centres-card">
                                <h3><i class="bi bi-geo-alt-fill me-2" style="color:var(--accent-color)"></i>Available
                                    Centres</h3>
                                @foreach ($byState as $stateName => $stateCenters)
                                    <div class="state-block">
                                        <div class="state-name"><i class="bi bi-map"></i>{{ $stateName }}</div>
                                        <div class="center-chips">
                                            @foreach ($stateCenters as $c)
                                                <span class="center-chip">
                                                    <i class="bi bi-building"></i>{{ $c->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Other sessions from same event --}}
                        @if ($siblings->count() > 0)
                            <div class="siblings-section">
                                <h3>Other Sessions in {{ $sub->event->title }}</h3>
                                <p class="sib-sub">{{ $siblings->count() }} more
                                    session{{ $siblings->count() != 1 ? 's' : '' }} available</p>
                                <div class="row g-3">
                                    @foreach ($siblings as $si => $sib)
                                        @php
                                            $sibDate = Carbon::parse($sib->event_date);
                                            $sibStripe = $stripes[$si % count($stripes)];
                                            if (!$sib->status) {
                                                $sd = 'dot-closed';
                                                $sl = 'Inactive';
                                            } elseif ($now->lt($sibDate)) {
                                                $sd = 'dot-soon';
                                                $sl = 'Opening Soon';
                                            } elseif ($now->gt($sibDate)) {
                                                $sd = 'dot-closed';
                                                $sl = 'Registrations Closed';
                                            } else {
                                                $sd = 'dot-open';
                                                $sl = 'Open · Live';
                                            }
                                        @endphp
                                        <div class="col-md-6">
                                            <div class="sib-card">
                                                <div class="sib-stripe" style="background:{{ $sibStripe }}"></div>
                                                <div class="sib-body">
                                                    <div class="sib-num">Session
                                                        {{ str_pad($si + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                                    <h5>{{ $sib->title }}</h5>
                                                    <div class="sib-meta">
                                                        <span><i
                                                                class="bi bi-calendar3"></i>{{ $sibDate->format('M j, Y') }}</span>
                                                        @if ($sib->time_range !== '--')
                                                            <span><i class="bi bi-clock"></i>{{ $sib->time_range }}</span>
                                                        @endif
                                                        <span>
                                                            <i class="bi bi-ticket-perforated"></i>
                                                            {{ $sib->is_free ? 'Free' : '₹' . number_format($sib->fees, 0) }}
                                                        </span>
                                                    </div>
                                                    <div class="sib-footer">
                                                        <div class="sib-status">
                                                            <div class="{{ $sd }}"></div>{{ $sl }}
                                                        </div>
                                                        <a href="{{ route('frontend.events.subevent-detail', $sib->slug) }}"
                                                            class="sib-link">
                                                            View <i class="bi bi-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>{{-- /col-lg-8 --}}

                    {{-- ── SIDEBAR ──────────────────────────────── --}}
                    <div class="col-lg-4">
                        <div class="sd-sidebar">

                            {{-- Countdown (only if upcoming) --}}
                            @if ($dot === 'dot-soon')
                                <div class="countdown-banner">
                                    <div class="cb-label">Event starts in</div>
                                    <div class="countdown-timer" id="countdown"
                                        data-date="{{ $subDate->format('Y-m-d') }}T{{ $sub->start_time ?? '00:00:00' }}">
                                        <div class="ct-unit">
                                            <div class="ctn" id="cd-days">--</div>
                                            <div class="ctl">Days</div>
                                        </div>
                                        <div class="ct-unit">
                                            <div class="ctn" id="cd-hrs">--</div>
                                            <div class="ctl">Hrs</div>
                                        </div>
                                        <div class="ct-unit">
                                            <div class="ctn" id="cd-min">--</div>
                                            <div class="ctl">Min</div>
                                        </div>
                                        <div class="ct-unit">
                                            <div class="ctn" id="cd-sec">--</div>
                                            <div class="ctl">Sec</div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Register CTA --}}
                            <div class="sc">
                                <div class="sc-body">
                                    @if ($canRegister)
                                        <a href="{{ route('frontend.events.register', $sub->slug) }}"
                                            class="btn-reg-cta">
                                            <i class="bi bi-check2-circle"></i>
                                            {{ $sub->is_free ? 'Register Free' : 'Register — ₹' . number_format($sub->fees, 0) }}
                                        </a>
                                    @else
                                        <div class="btn-reg-cta disabled-cta">
                                            <i class="bi bi-x-circle"></i> Registrations Closed
                                        </div>
                                    @endif
                                    <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-wa-cta">
                                        <i class="bi bi-whatsapp" style="color:#25d366"></i> Ask on WhatsApp
                                    </a>
                                </div>
                            </div>

                            {{-- Session Info --}}
                            <div class="sc">
                                <div class="sc-head">
                                    <div class="sc-head-icon"><i class="bi bi-info-circle-fill"></i></div>
                                    <h5>Session Details</h5>
                                </div>
                                <div class="sc-body">
                                    <div class="info-row">
                                        <span class="ik"><i class="bi bi-calendar3"></i>Date</span>
                                        <span class="iv">{{ $subDate->format('M j, Y') }}</span>
                                    </div>
                                    @if ($sub->time_range !== '--')
                                        <div class="info-row">
                                            <span class="ik"><i class="bi bi-clock"></i>Time</span>
                                            <span class="iv">{{ $sub->time_range }}</span>
                                        </div>
                                    @endif
                                    @if ($sub->age_group)
                                        <div class="info-row">
                                            <span class="ik"><i class="bi bi-people"></i>Age Group</span>
                                            <span class="iv">{{ $sub->age_group }}</span>
                                        </div>
                                    @endif
                                    <div class="info-row">
                                        <span class="ik"><i class="bi bi-display"></i>Mode</span>
                                        <span class="iv">{{ $mb['label'] }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="ik"><i class="bi bi-ticket-perforated"></i>Fee</span>
                                        <span
                                            class="iv">{{ $sub->is_free ? 'Free' : '₹' . number_format($sub->fees, 0) }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="ik"><i class="bi bi-person-check"></i>Seats</span>
                                        <span
                                            class="iv">{{ $sub->max_seats ? number_format($sub->max_seats) : 'Unlimited' }}</span>
                                    </div>
                                    @if ($centers->count())
                                        <div class="info-row">
                                            <span class="ik"><i class="bi bi-geo-alt"></i>Centres</span>
                                            <span class="iv">{{ $centers->count() }}
                                                Location{{ $centers->count() > 1 ? 's' : '' }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Part of Event --}}
                            <div class="sc">
                                <div class="sc-head">
                                    <div class="sc-head-icon"><i class="bi bi-collection-fill"></i></div>
                                    <h5>Part of Event</h5>
                                </div>
                                <div class="sc-body">
                                    <div
                                        style="font-size:14px;font-weight:700;color:var(--heading-color);margin-bottom:6px">
                                        {{ $sub->event->title }}
                                    </div>
                                    <div style="font-size:13px;color:#6b7280;margin-bottom:14px">
                                        {{ $sub->event->subEvents->count() }}
                                        session{{ $sub->event->subEvents->count() != 1 ? 's' : '' }} in total
                                    </div>
                                    <a href="{{ route('summercamp.event', $sub->event->slug) }}"
                                        style="display:inline-flex;align-items:center;gap:5px;color:var(--accent-color);font-weight:700;font-size:13px;text-decoration:none">
                                        View All Sessions <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            {{-- Operating Hours --}}
                            <div class="sc">
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
                                            <div>Threat Expert Training Centre, Jaipur, Rajasthan, India</div>
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

    </main>

    {{-- Countdown JS --}}
    @if ($dot === 'dot-soon')
        <script>
            (function() {
                const el = document.getElementById('countdown');
                const end = new Date(el.dataset.date).getTime();
                const tick = () => {
                    const diff = end - Date.now();
                    if (diff <= 0) {
                        el.innerHTML = '<span style="color:#fff;font-weight:700">Starting now!</span>';
                        return;
                    }
                    const d = Math.floor(diff / 86400000);
                    const h = Math.floor((diff % 86400000) / 3600000);
                    const m = Math.floor((diff % 3600000) / 60000);
                    const s = Math.floor((diff % 60000) / 1000);
                    document.getElementById('cd-days').textContent = String(d).padStart(2, '0');
                    document.getElementById('cd-hrs').textContent = String(h).padStart(2, '0');
                    document.getElementById('cd-min').textContent = String(m).padStart(2, '0');
                    document.getElementById('cd-sec').textContent = String(s).padStart(2, '0');
                };
                tick();
                setInterval(tick, 1000);
            })();
        </script>
    @endif

@endsection
