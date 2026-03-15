@extends('frontend.course.layout')

@section('content')

    {{-- ══════════════════════════════════════════════════════
     EVENT REGISTRATION PAGE
     resources/views/frontend/events/register.blade.php
══════════════════════════════════════════════════════ --}}

    @php
        use Carbon\Carbon;
        $firstSub = $event->subEvents->sortBy('event_date')->first();
    @endphp

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800;900&family=DM+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --reg-ink: #0d1b2a;
            --reg-blue: #1750d4;
            --reg-light: #f0f5ff;
            --reg-border: #dde5f5;
            --reg-muted: #64748b;
            --reg-green: #059669;
            --reg-amber: #d97706;
            --reg-red: #dc2626;
            --reg-card: #ffffff;
            --reg-font-head: 'Sora', sans-serif;
            --reg-font-body: 'DM Sans', sans-serif;
        }

        .reg-page * {
            box-sizing: border-box;
        }

        /* ── PAGE WRAPPER ── */
        .reg-page {
            min-height: 100vh;
            background: #f7f9ff;
            font-family: var(--reg-font-body);
        }

        /* ── BREADCRUMB ── */
        .reg-crumb {
            background: #fff;
            border-bottom: 1px solid var(--reg-border);
            padding: 11px 0;
            font-size: 13px;
            color: var(--reg-muted);
        }

        .reg-crumb a {
            color: var(--reg-muted);
            text-decoration: none;
        }

        .reg-crumb a:hover {
            color: var(--reg-blue);
        }

        .reg-crumb .bc-sep {
            margin: 0 8px;
        }

        /* ── HERO STRIP ── */
        .reg-hero {
            background: linear-gradient(135deg, #0d1b2a 0%, #1750d4 100%);
            padding: 48px 0 36px;
            position: relative;
            overflow: hidden;
        }

        .reg-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='28'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .reg-hero-inner {
            position: relative;
            z-index: 1;
        }

        .reg-hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            color: #93c5fd;
            font-family: var(--reg-font-head);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        .reg-hero h1 {
            font-family: var(--reg-font-head);
            font-size: clamp(24px, 4vw, 42px);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .reg-hero p {
            font-size: 15px;
            color: rgba(255, 255, 255, .68);
            max-width: 560px;
            line-height: 1.7;
            margin-bottom: 0;
        }

        /* ── LAYOUT ── */
        .reg-layout {
            padding: 44px 0 80px;
        }

        .reg-left {}

        .reg-right {}

        /* ── CARD ── */
        .reg-card {
            background: var(--reg-card);
            border-radius: 20px;
            border: 1.5px solid var(--reg-border);
            overflow: hidden;
            box-shadow: 0 4px 30px rgba(17, 80, 212, .07);
            margin-bottom: 22px;
        }

        .reg-card:last-child {
            margin-bottom: 0;
        }

        .rc-head {
            padding: 18px 24px;
            background: var(--reg-light);
            border-bottom: 1px solid var(--reg-border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .rc-head-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #fff;
            border: 1.5px solid var(--reg-border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--reg-blue);
            font-size: 16px;
            flex-shrink: 0;
        }

        .rc-head h4 {
            font-family: var(--reg-font-head);
            font-size: 15px;
            font-weight: 800;
            color: var(--reg-ink);
            margin: 0;
        }

        .rc-head p {
            font-size: 12px;
            color: var(--reg-muted);
            margin: 0;
            margin-top: 1px;
        }

        .rc-body {
            padding: 26px 24px;
        }

        /* ── FORM FIELDS ── */
        .field-group {
            margin-bottom: 20px;
        }

        .field-group:last-child {
            margin-bottom: 0;
        }

        .field-label {
            display: block;
            font-family: var(--reg-font-head);
            font-size: 12px;
            font-weight: 700;
            color: var(--reg-ink);
            text-transform: uppercase;
            letter-spacing: .7px;
            margin-bottom: 7px;
        }

        .field-label .req {
            color: var(--reg-red);
            margin-left: 2px;
        }

        .field-input,
        .field-select {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid var(--reg-border);
            border-radius: 12px;
            font-family: var(--reg-font-body);
            font-size: 14px;
            color: var(--reg-ink);
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        .field-input::placeholder {
            color: #b0bec5;
        }

        .field-input:focus,
        .field-select:focus {
            border-color: var(--reg-blue);
            box-shadow: 0 0 0 4px rgba(23, 80, 212, .08);
        }

        .field-input.is-error,
        .field-select.is-error {
            border-color: var(--reg-red);
            box-shadow: 0 0 0 4px rgba(220, 38, 38, .06);
        }

        .field-hint {
            font-size: 12px;
            color: var(--reg-muted);
            margin-top: 5px;
        }

        .field-error {
            font-size: 12px;
            color: var(--reg-red);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .select-wrap {
            position: relative;
        }

        .select-wrap::after {
            content: '';
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid var(--reg-muted);
            pointer-events: none;
        }

        /* ── SESSION CARDS ── */
        .session-grid {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .session-option {
            position: relative;
            cursor: pointer;
        }

        .session-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .session-label {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 16px;
            border: 1.5px solid var(--reg-border);
            border-radius: 14px;
            background: #fff;
            cursor: pointer;
            transition: border-color .2s, background .2s, box-shadow .2s;
        }

        .session-option input:checked+.session-label {
            border-color: var(--reg-blue);
            background: #f0f5ff;
            box-shadow: 0 0 0 4px rgba(23, 80, 212, .07);
        }

        .session-label:hover {
            border-color: #a5b4fc;
            background: #f8faff;
        }

        .sl-radio {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--reg-border);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
            transition: border-color .2s, background .2s;
        }

        .session-option input:checked~.session-label .sl-radio {
            border-color: var(--reg-blue);
            background: var(--reg-blue);
        }

        .session-option input:checked~.session-label .sl-radio::after {
            content: '';
            display: block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #fff;
        }

        .sl-content {
            flex: 1;
            min-width: 0;
        }

        .sl-title {
            font-family: var(--reg-font-head);
            font-size: 14px;
            font-weight: 700;
            color: var(--reg-ink);
            margin-bottom: 5px;
        }

        .sl-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            font-size: 12px;
            color: var(--reg-muted);
        }

        .sl-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .sl-meta i {
            color: var(--reg-blue);
            font-size: 11px;
        }

        .sl-price {
            font-family: var(--reg-font-head);
            font-size: 15px;
            font-weight: 800;
            flex-shrink: 0;
            align-self: flex-start;
        }

        .sl-price.free {
            color: var(--reg-green);
        }

        .sl-price.paid {
            color: var(--reg-ink);
        }

        .seat-bar-wrap {
            margin-top: 7px;
        }

        .seat-bar-bg {
            height: 4px;
            border-radius: 4px;
            background: #e2e8f0;
            overflow: hidden;
        }

        .seat-bar-fill {
            height: 100%;
            border-radius: 4px;
            background: var(--reg-blue);
            transition: width .4s;
        }

        .seat-bar-text {
            font-size: 10px;
            color: var(--reg-muted);
            margin-top: 3px;
        }

        .seat-bar-text.low {
            color: var(--reg-red);
            font-weight: 600;
        }

        /* ── TICKETS COUNTER ── */
        .ticket-counter {
            display: flex;
            align-items: center;
            gap: 0;
            border: 1.5px solid var(--reg-border);
            border-radius: 12px;
            overflow: hidden;
            width: fit-content;
        }

        .tc-btn {
            width: 46px;
            height: 46px;
            background: var(--reg-light);
            border: none;
            font-size: 20px;
            font-weight: 700;
            color: var(--reg-blue);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .15s;
            flex-shrink: 0;
        }

        .tc-btn:hover {
            background: #dbe5ff;
        }

        .tc-btn:disabled {
            color: #ccc;
            cursor: not-allowed;
            background: var(--reg-light);
        }

        .tc-val {
            width: 64px;
            text-align: center;
            font-family: var(--reg-font-head);
            font-size: 18px;
            font-weight: 800;
            color: var(--reg-ink);
            border: none;
            border-left: 1px solid var(--reg-border);
            border-right: 1px solid var(--reg-border);
            outline: none;
            background: #fff;
            height: 46px;
            padding: 0;
        }

        /* ── SIDEBAR SUMMARY CARD ── */
        .summary-card {
            background: var(--reg-card);
            border-radius: 20px;
            border: 1.5px solid var(--reg-border);
            overflow: hidden;
            box-shadow: 0 4px 30px rgba(17, 80, 212, .07);
            position: sticky;
            top: 88px;
        }

        .summary-head {
            padding: 16px 20px;
            background: linear-gradient(135deg, #0d1b2a, #1750d4);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-head h5 {
            font-family: var(--reg-font-head);
            font-size: 14px;
            font-weight: 800;
            color: #fff;
            margin: 0;
        }

        .summary-head i {
            color: #93c5fd;
            font-size: 16px;
        }

        /* Placeholder state */
        .summary-placeholder {
            padding: 32px 20px;
            text-align: center;
        }

        .summary-placeholder i {
            font-size: 38px;
            color: #e2e8f0;
            display: block;
            margin-bottom: 10px;
        }

        .summary-placeholder p {
            font-size: 13px;
            color: #94a3b8;
            margin: 0;
            line-height: 1.6;
        }

        /* Loaded state */
        .summary-loaded {
            display: none;
        }

        .summary-loaded.active {
            display: block;
        }

        .sum-event-title {
            padding: 16px 20px 12px;
            border-bottom: 1px solid var(--reg-border);
        }

        .sum-event-title .set-kicker {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--reg-blue);
            margin-bottom: 4px;
        }

        .sum-event-title .set-name {
            font-family: var(--reg-font-head);
            font-size: 14px;
            font-weight: 800;
            color: var(--reg-ink);
            line-height: 1.3;
        }

        .sum-rows {
            padding: 14px 20px;
            border-bottom: 1px solid var(--reg-border);
        }

        .sum-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 7px 0;
            font-size: 13px;
            border-bottom: 1px dashed #edf2f7;
            gap: 8px;
        }

        .sum-row:last-child {
            border-bottom: none;
        }

        .sum-row .sk {
            color: var(--reg-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .sum-row .sk i {
            color: var(--reg-blue);
            font-size: 12px;
        }

        .sum-row .sv {
            font-weight: 700;
            color: var(--reg-ink);
            text-align: right;
            font-family: var(--reg-font-head);
        }

        .sum-seats-bar {
            padding: 0 20px 16px;
        }

        .sum-total {
            padding: 16px 20px;
            background: var(--reg-light);
            border-top: 1px solid var(--reg-border);
        }

        .sum-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }

        .sum-total-row .stk {
            font-size: 12px;
            color: var(--reg-muted);
            text-transform: uppercase;
            letter-spacing: .6px;
            font-weight: 600;
        }

        .sum-total-row .stv {
            font-family: var(--reg-font-head);
            font-size: 24px;
            font-weight: 900;
            color: var(--reg-blue);
        }

        .sum-total-row .stv.free {
            color: var(--reg-green);
        }

        .sum-total-note {
            font-size: 11px;
            color: #94a3b8;
        }

        .sum-seat-status {
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 600;
            border-top: 1px solid var(--reg-border);
        }

        .ss-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .ss-dot.open {
            background: var(--reg-green);
        }

        .ss-dot.low {
            background: var(--reg-amber);
        }

        .ss-dot.full {
            background: var(--reg-red);
        }

        /* ── SUBMIT BUTTON ── */
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: var(--reg-blue);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: var(--reg-font-head);
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 8px 28px rgba(23, 80, 212, .28);
            margin-top: 20px;
        }

        .btn-submit:hover {
            background: #1244b8;
            transform: translateY(-2px);
            box-shadow: 0 12px 36px rgba(23, 80, 212, .38);
        }

        .btn-submit:active {
            transform: none;
        }

        .btn-submit:disabled {
            background: #a5b4fc;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        /* ── LOADING SKELETON ── */
        .skeleton {
            background: linear-gradient(90deg, #f0f5ff 25%, #dde5f5 50%, #f0f5ff 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 8px;
            height: 14px;
            margin-bottom: 6px;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* ── SEAT ALERT ── */
        .seat-alert {
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: 10px;
        }

        .seat-alert.warning {
            background: #fef9c3;
            color: #a16207;
            border: 1px solid #fde047;
        }

        .seat-alert.danger {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }

        .seat-alert.success {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
        }

        /* ── AJAX LOADER ── */
        .ajax-spin {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #dde5f5;
            border-top-color: var(--reg-blue);
            border-radius: 50%;
            animation: spin .6s linear infinite;
            vertical-align: middle;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .summary-card {
                position: static;
            }

            .reg-hero {
                padding: 32px 0 24px;
            }
        }

        /* ── VALIDATION STATE ICONS ── */
        .field-wrap {
            position: relative;
        }

        /* ── STEP BADGE ── */
        .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--reg-blue);
            color: #fff;
            font-family: var(--reg-font-head);
            font-size: 13px;
            font-weight: 800;
            flex-shrink: 0;
        }
    </style>

    <div class="reg-page">

        {{-- BREADCRUMB --}}
        <div class="reg-crumb">
            <div class="container d-flex align-items-center">
                <a href="{{ url('/') }}"><i class="bi bi-house me-1"></i>Home</a>
                <span class="bc-sep">/</span>
                <a href="#">Events</a>
                <span class="bc-sep">/</span>
                <a href="{{ route('frontend.events.subevent', $event->id) }}">{{ Str::limit($event->title, 35) }}</a>
                <span class="bc-sep">/</span>
                <span style="color:var(--reg-ink);font-weight:700;">Register</span>
            </div>
        </div>

        {{-- HERO STRIP --}}
        <div class="reg-hero">
            <div class="container reg-hero-inner">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="reg-hero-kicker">
                            <i class="bi bi-pencil-square"></i> Registration
                        </div>
                        <h1>{{ $event->title }}</h1>
                        <p>{{ Str::limit(strip_tags($event->description), 110) }}</p>
                    </div>
                    <div class="col-lg-4 d-none d-lg-flex justify-content-end">
                        @if ($event->banner_image)
                            <img src="{{ asset($event->banner_image) }}" alt="{{ $event->title }}"
                                style="width:160px;height:110px;object-fit:cover;border-radius:16px;border:3px solid rgba(255,255,255,.18);box-shadow:0 12px 40px rgba(0,0,0,.3);">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="reg-layout">
            <div class="container">
                <div class="row g-4">

                    {{-- ── LEFT: FORM ── --}}
                    <div class="col-lg-7 reg-left">

                        <form method="POST" action="{{ route('frontend.events.register.store', $event->id) }}"
                            id="regForm" novalidate>
                            @csrf

                            {{-- 1. CHOOSE SESSION --}}
                            <div class="reg-card">
                                <div class="rc-head">
                                    <div class="step-badge">1</div>
                                    <div>
                                        <h4>Choose a Session</h4>
                                        <p>Select the session you wish to attend</p>
                                    </div>
                                </div>
                                <div class="rc-body">

                                    @if ($event->subEvents->count() > 0)
                                        <div class="session-grid">
                                            @foreach ($event->subEvents as $si => $sub)
                                                @php
                                                    $oldSub = old('sub_event_id');
                                                @endphp
                                                <label class="session-option">
                                                    <input type="radio" name="sub_event_id" value="{{ $sub->id }}"
                                                        data-fees="{{ $sub->fees }}"
                                                        data-max="{{ $sub->max_seats ?? '' }}" class="sub-radio"
                                                        {{ $oldSub == $sub->id || ($si == 0 && !$oldSub) ? 'checked' : '' }}>
                                                    <div class="session-label">
                                                        <div class="sl-radio"></div>
                                                        <div class="sl-content">
                                                            <div class="sl-title">{{ $sub->title }}</div>
                                                            <div class="sl-meta">
                                                                <span>
                                                                    <i class="bi bi-calendar3"></i>
                                                                    {{ \Carbon\Carbon::parse($sub->event_date)->format('M j, Y') }}
                                                                </span>
                                                                @if ($sub->time_range && $sub->time_range !== '--')
                                                                    <span>
                                                                        <i class="bi bi-clock"></i>
                                                                        {{ $sub->time_range }}
                                                                    </span>
                                                                @endif
                                                                @if ($sub->mode)
                                                                    <span>
                                                                        <i class="bi bi-display"></i>
                                                                        {{ ucfirst($sub->mode) }}
                                                                    </span>
                                                                @endif
                                                                @if ($sub->age_group)
                                                                    <span>
                                                                        <i class="bi bi-people"></i>
                                                                        {{ $sub->age_group }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            {{-- Seat bar placeholder, filled via JS --}}
                                                            <div class="seat-bar-wrap" id="seatBar_{{ $sub->id }}"
                                                                style="display:none;">
                                                                <div class="seat-bar-bg">
                                                                    <div class="seat-bar-fill"
                                                                        id="seatFill_{{ $sub->id }}" style="width:0%">
                                                                    </div>
                                                                </div>
                                                                <div class="seat-bar-text"
                                                                    id="seatText_{{ $sub->id }}"></div>
                                                            </div>
                                                        </div>
                                                        <div class="sl-price {{ $sub->fees == 0 ? 'free' : 'paid' }}">
                                                            {{ $sub->fees == 0 ? 'Free' : '₹' . number_format($sub->fees, 0) }}
                                                        </div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>

                                        @error('sub_event_id')
                                            <div class="field-error mt-2"><i class="bi bi-exclamation-circle"></i>
                                                {{ $message }}</div>
                                        @enderror
                                    @else
                                        <div class="text-center py-4" style="background:#f8fafc;border-radius:12px;">
                                            <i class="bi bi-calendar-x" style="font-size:36px;color:#e2e8f0;"></i>
                                            <p style="color:#94a3b8;font-size:14px;margin:10px 0 0;">No sessions available
                                                for this event.</p>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            {{-- 2. YOUR DETAILS --}}
                            <div class="reg-card">
                                <div class="rc-head">
                                    <div class="step-badge">2</div>
                                    <div>
                                        <h4>Your Details</h4>
                                        <p>We'll use this to send your registration confirmation</p>
                                    </div>
                                </div>
                                <div class="rc-body">

                                    <div class="row g-3">
                                        {{-- Name --}}
                                        <div class="col-12">
                                            <div class="field-group">
                                                <label class="field-label" for="reg_name">
                                                    Full Name <span class="req">*</span>
                                                </label>
                                                <input type="text" id="reg_name" name="name"
                                                    class="field-input {{ $errors->has('name') ? 'is-error' : '' }}"
                                                    placeholder="e.g. Rahul Sharma" value="{{ old('name') }}"
                                                    autocomplete="name" required>
                                                @error('name')
                                                    <div class="field-error"><i class="bi bi-exclamation-circle"></i>
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-12 col-md-6">
                                            <div class="field-group">
                                                <label class="field-label" for="reg_phone">
                                                    WhatsApp Number <span class="req">*</span>
                                                </label>
                                                <input type="tel" id="reg_phone" name="phone"
                                                    class="field-input {{ $errors->has('phone') ? 'is-error' : '' }}"
                                                    placeholder="10-digit mobile number" value="{{ old('phone') }}"
                                                    pattern="[0-9]{10,13}" maxlength="13" autocomplete="tel" required>
                                                @error('phone')
                                                    <div class="field-error"><i class="bi bi-exclamation-circle"></i>
                                                        {{ $message }}</div>
                                                @else
                                                    <div class="field-hint"><i class="bi bi-whatsapp"
                                                            style="color:#25d366;"></i> We'll send confirmation on WhatsApp
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- City --}}
                                        <div class="col-12 col-md-6">
                                            <div class="field-group">
                                                <label class="field-label" for="reg_city">
                                                    City <span class="req">*</span>
                                                </label>
                                                <input type="text" id="reg_city" name="city"
                                                    class="field-input {{ $errors->has('city') ? 'is-error' : '' }}"
                                                    placeholder="e.g. Jaipur" value="{{ old('city') }}" required>
                                                @error('city')
                                                    <div class="field-error"><i class="bi bi-exclamation-circle"></i>
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- State --}}
                                        <div class="col-12">
                                            <div class="field-group">
                                                <label class="field-label" for="reg_state">
                                                    State <span class="req">*</span>
                                                </label>
                                                <div class="select-wrap">
                                                    <select id="reg_state" name="state"
                                                        class="field-select {{ $errors->has('state') ? 'is-error' : '' }}"
                                                        required>
                                                        <option value="">— Select your state —</option>
                                                        @foreach ($states as $st)
                                                            <option value="{{ $st->name }}"
                                                                {{ old('state') == $st->name ? 'selected' : '' }}>
                                                                {{ $st->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('state')
                                                    <div class="field-error"><i class="bi bi-exclamation-circle"></i>
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- 3. TICKETS --}}
                            <div class="reg-card">
                                <div class="rc-head">
                                    <div class="step-badge">3</div>
                                    <div>
                                        <h4>Number of Tickets</h4>
                                        <p>How many people are registering?</p>
                                    </div>
                                </div>
                                <div class="rc-body">

                                    <div class="d-flex align-items-center gap-4 flex-wrap">
                                        <div class="ticket-counter">
                                            <button type="button" class="tc-btn" id="tcMinus" disabled>−</button>
                                            <input type="number" class="tc-val" id="ticketVal" name="tickets"
                                                value="{{ old('tickets', 1) }}" min="1" max="10" readonly>
                                            <button type="button" class="tc-btn" id="tcPlus">+</button>
                                        </div>
                                        <div>
                                            <div style="font-family:var(--reg-font-head);font-size:13px;font-weight:700;color:var(--reg-ink);"
                                                id="ticketLabel">
                                                1 Ticket
                                            </div>
                                            <div style="font-size:12px;color:var(--reg-muted);" id="ticketSub">
                                                Max 10 per booking
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Seat availability alert (dynamic) --}}
                                    <div id="seatAlertWrap" style="margin-top:12px;"></div>

                                    @error('tickets')
                                        <div class="field-error mt-2"><i class="bi bi-exclamation-circle"></i>
                                            {{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            {{-- SUBMIT --}}
                            <button type="submit" class="btn-submit" id="submitBtn">
                                <i class="bi bi-check2-circle"></i>
                                <span id="submitText">Complete Registration</span>
                            </button>

                            <p style="text-align:center;font-size:12px;color:#94a3b8;margin-top:14px;">
                                <i class="bi bi-shield-check" style="color:var(--reg-green);"></i>
                                Your info is safe with us. We never share it with third parties.
                            </p>

                        </form>

                    </div>

                    {{-- ── RIGHT: SUMMARY ── --}}
                    <div class="col-lg-5 reg-right">
                        <div class="summary-card" id="summaryCard">

                            <div class="summary-head">
                                <i class="bi bi-receipt"></i>
                                <h5>Registration Summary</h5>
                            </div>

                            {{-- Placeholder --}}
                            <div id="summaryPlaceholder" class="summary-placeholder">
                                <i class="bi bi-calendar2-event"></i>
                                <p>Select a session above to see your booking summary here in real time.</p>
                            </div>

                            {{-- Loaded state --}}
                            <div id="summaryLoaded" class="summary-loaded">

                                {{-- Loading skeleton --}}
                                <div id="summarySkeletonWrap" style="padding:18px 20px;display:none;">
                                    <div class="skeleton" style="width:60%;height:10px;margin-bottom:10px;"></div>
                                    <div class="skeleton" style="width:90%;height:14px;margin-bottom:16px;"></div>
                                    <div class="skeleton" style="height:10px;margin-bottom:8px;"></div>
                                    <div class="skeleton" style="width:75%;height:10px;margin-bottom:8px;"></div>
                                    <div class="skeleton" style="width:85%;height:10px;margin-bottom:8px;"></div>
                                </div>

                                {{-- Summary content --}}
                                <div id="summaryContent" style="display:none;">
                                    <div class="sum-event-title">
                                        <div class="set-kicker">{{ $event->title }}</div>
                                        <div class="set-name" id="sumSubTitle">—</div>
                                    </div>

                                    <div class="sum-rows">
                                        <div class="sum-row">
                                            <span class="sk"><i class="bi bi-calendar3"></i>Date</span>
                                            <span class="sv" id="sumDate">—</span>
                                        </div>
                                        <div class="sum-row">
                                            <span class="sk"><i class="bi bi-clock"></i>Time</span>
                                            <span class="sv" id="sumTime">—</span>
                                        </div>
                                        <div class="sum-row">
                                            <span class="sk"><i class="bi bi-display"></i>Mode</span>
                                            <span class="sv" id="sumMode">—</span>
                                        </div>
                                        <div class="sum-row" id="sumAgeRow">
                                            <span class="sk"><i class="bi bi-people"></i>Age Group</span>
                                            <span class="sv" id="sumAge">—</span>
                                        </div>
                                        <div class="sum-row">
                                            <span class="sk"><i class="bi bi-ticket-perforated"></i>Fee /
                                                Ticket</span>
                                            <span class="sv" id="sumFeePerTicket">—</span>
                                        </div>
                                        <div class="sum-row">
                                            <span class="sk"><i class="bi bi-hash"></i>Tickets</span>
                                            <span class="sv" id="sumTickets">1</span>
                                        </div>
                                    </div>

                                    <div class="sum-seats-bar" id="sumSeatsBarWrap" style="padding:12px 20px 0;">
                                        <div
                                            style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--reg-muted);margin-bottom:6px;">
                                            Seat Availability
                                        </div>
                                        <div class="seat-bar-bg" style="height:6px;">
                                            <div class="seat-bar-fill" id="sumSeatFill" style="width:0%;height:6px;">
                                            </div>
                                        </div>
                                        <div class="seat-bar-text" id="sumSeatText" style="margin-top:4px;"></div>
                                    </div>

                                    <div class="sum-total">
                                        <div class="sum-total-row">
                                            <span class="stk">Total Amount</span>
                                            <span class="stv" id="sumTotal">₹0</span>
                                        </div>
                                        <div class="sum-total-note" id="sumTotalNote"></div>
                                    </div>

                                    <div class="sum-seat-status" id="sumSeatStatus">
                                        <div class="ss-dot open" id="sumStatusDot"></div>
                                        <span id="sumStatusText">Seats available</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Help card --}}
                        <div class="reg-card" style="margin-top:20px;">
                            <div class="rc-head">
                                <div class="rc-head-icon"><i class="bi bi-question-circle-fill"></i></div>
                                <div>
                                    <h4>Need Help?</h4>
                                </div>
                            </div>
                            <div class="rc-body" style="padding:16px 20px;">
                                <div style="display:flex;flex-direction:column;gap:10px;">
                                    <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank"
                                        style="display:flex;align-items:center;gap:10px;text-decoration:none;padding:12px 14px;border:1.5px solid #dcfce7;border-radius:12px;background:#f0fdf4;">
                                        <i class="bi bi-whatsapp" style="color:#25d366;font-size:18px;"></i>
                                        <div>
                                            <div style="font-size:13px;font-weight:700;color:#15803d;">Chat on WhatsApp
                                            </div>
                                            <div style="font-size:11px;color:#6b7280;">Quick answers anytime</div>
                                        </div>
                                    </a>
                                    <a href="tel:+919352023276"
                                        style="display:flex;align-items:center;gap:10px;text-decoration:none;padding:12px 14px;border:1.5px solid var(--reg-border);border-radius:12px;">
                                        <i class="bi bi-telephone-fill" style="color:var(--reg-blue);font-size:16px;"></i>
                                        <div>
                                            <div style="font-size:13px;font-weight:700;color:var(--reg-ink);">+91 93520
                                                23276</div>
                                            <div style="font-size:11px;color:#6b7280;">Tue–Sat · 11 AM – 7 PM</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>{{-- /col-lg-5 --}}

                </div>
            </div>
        </div>

    </div>{{-- /reg-page --}}

    <script>
        (function() {
            'use strict';

            // ── Cache ------------------------------------------------------------------
            const subRadios = document.querySelectorAll('.sub-radio');
            const tcMinus = document.getElementById('tcMinus');
            const tcPlus = document.getElementById('tcPlus');
            const ticketVal = document.getElementById('ticketVal');
            const ticketLabel = document.getElementById('ticketLabel');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const seatAlertWrap = document.getElementById('seatAlertWrap');

            // Summary els
            const summaryPlaceholder = document.getElementById('summaryPlaceholder');
            const summaryLoaded = document.getElementById('summaryLoaded');
            const summarySkeletonWrap = document.getElementById('summarySkeletonWrap');
            const summaryContent = document.getElementById('summaryContent');

            let currentSubData = null;
            let fetchController = null;

            // ── AJAX: fetch sub-event details -----------------------------------------
            function fetchSubDetails(subId) {
                if (fetchController) fetchController.abort();
                fetchController = new AbortController();

                // Show skeleton
                summaryPlaceholder.style.display = 'none';
                summaryLoaded.classList.add('active');
                summarySkeletonWrap.style.display = 'block';
                summaryContent.style.display = 'none';

                fetch(`/events/sub-event/${subId}/details`, {
                        signal: fetchController.signal
                    })
                    .then(r => r.json())
                    .then(data => {
                        currentSubData = data;
                        summarySkeletonWrap.style.display = 'none';
                        summaryContent.style.display = 'block';
                        renderSummary();
                        renderSeatBar(subId, data);
                    })
                    .catch(e => {
                        if (e.name !== 'AbortError') console.error(e);
                    });
            }

            // ── Render summary sidebar ------------------------------------------------
            function renderSummary() {
                if (!currentSubData) return;
                const d = currentSubData;
                const tickets = parseInt(ticketVal.value) || 1;

                document.getElementById('sumSubTitle').textContent = d.title;
                document.getElementById('sumDate').textContent = d.event_date;
                document.getElementById('sumTime').textContent = d.time_range !== '--' ? d.time_range : '—';
                document.getElementById('sumMode').textContent = d.mode ? d.mode.charAt(0).toUpperCase() + d.mode.slice(
                    1) : '—';

                const ageRow = document.getElementById('sumAgeRow');
                if (d.age_group) {
                    document.getElementById('sumAge').textContent = d.age_group;
                    ageRow.style.display = '';
                } else {
                    ageRow.style.display = 'none';
                }

                document.getElementById('sumFeePerTicket').textContent = d.is_free ? 'Free' : '₹' + d.fees
                    .toLocaleString('en-IN');
                document.getElementById('sumTickets').textContent = tickets + ' × ' + (d.is_free ? 'Free' : '₹' + d.fees
                    .toLocaleString('en-IN'));

                const total = d.fees * tickets;
                const sumTotalEl = document.getElementById('sumTotal');
                if (d.is_free) {
                    sumTotalEl.textContent = 'FREE';
                    sumTotalEl.className = 'stv free';
                    document.getElementById('sumTotalNote').textContent = 'No payment required';
                } else {
                    sumTotalEl.textContent = '₹' + total.toLocaleString('en-IN');
                    sumTotalEl.className = 'stv';
                    document.getElementById('sumTotalNote').textContent = tickets + ' ticket' + (tickets > 1 ? 's' :
                        '') + ' × ₹' + d.fees.toLocaleString('en-IN');
                }

                // Seats
                const seatsBarWrap = document.getElementById('sumSeatsBarWrap');
                if (d.max_seats) {
                    seatsBarWrap.style.display = '';
                    const pct = Math.min(100, Math.round((d.booked / d.max_seats) * 100));
                    document.getElementById('sumSeatFill').style.width = pct + '%';
                    document.getElementById('sumSeatFill').style.background = pct > 80 ? '#ef4444' : pct > 55 ?
                        '#f59e0b' : '#1750d4';

                    const avail = d.available;
                    const seatTextEl = document.getElementById('sumSeatText');
                    seatTextEl.textContent = avail + ' of ' + d.max_seats + ' seats available';
                    seatTextEl.className = 'seat-bar-text ' + (avail <= 5 ? 'low' : '');

                    // Status dot + text
                    const dot = document.getElementById('sumStatusDot');
                    const span = document.getElementById('sumStatusText');
                    if (avail <= 0) {
                        dot.className = 'ss-dot full';
                        span.textContent = 'Fully booked';
                    } else if (avail <= 5) {
                        dot.className = 'ss-dot low';
                        span.textContent = 'Only ' + avail + ' seat' + (avail > 1 ? 's' : '') + ' left!';
                    } else {
                        dot.className = 'ss-dot open';
                        span.textContent = avail + ' seats available';
                    }
                } else {
                    seatsBarWrap.style.display = 'none';
                    document.getElementById('sumStatusDot').className = 'ss-dot open';
                    document.getElementById('sumStatusText').textContent = 'Unlimited seats';
                }

                renderSeatAlert();
            }

            // ── Seat bar inside session card ------------------------------------------
            function renderSeatBar(subId, data) {
                const bar = document.getElementById('seatBar_' + subId);
                const fill = document.getElementById('seatFill_' + subId);
                const text = document.getElementById('seatText_' + subId);
                if (!bar) return;

                if (data.max_seats) {
                    bar.style.display = '';
                    const pct = Math.min(100, Math.round((data.booked / data.max_seats) * 100));
                    fill.style.width = pct + '%';
                    fill.style.background = pct > 80 ? '#ef4444' : pct > 55 ? '#f59e0b' : '#1750d4';
                    text.textContent = data.available + ' / ' + data.max_seats + ' seats left';
                    text.className = 'seat-bar-text ' + (data.available <= 5 ? 'low' : '');
                }
            }

            // ── Seat alert in form ----------------------------------------------------
            function renderSeatAlert() {
                if (!currentSubData) {
                    seatAlertWrap.innerHTML = '';
                    return;
                }
                const d = currentSubData;
                const tickets = parseInt(ticketVal.value) || 1;

                seatAlertWrap.innerHTML = '';
                if (!d.max_seats) return;

                const avail = d.available;
                if (avail <= 0) {
                    seatAlertWrap.innerHTML =
                        `<div class="seat-alert danger"><i class="bi bi-x-circle-fill"></i> This session is fully booked.</div>`;
                    submitBtn.disabled = true;
                } else if (tickets > avail) {
                    seatAlertWrap.innerHTML =
                        `<div class="seat-alert danger"><i class="bi bi-exclamation-triangle-fill"></i> Only ${avail} seat${avail > 1 ? 's' : ''} left — please reduce ticket count.</div>`;
                    submitBtn.disabled = true;
                } else if (avail <= 5) {
                    seatAlertWrap.innerHTML =
                        `<div class="seat-alert warning"><i class="bi bi-exclamation-circle-fill"></i> Hurry! Only ${avail} seat${avail > 1 ? 's' : ''} remaining.</div>`;
                    submitBtn.disabled = false;
                } else {
                    seatAlertWrap.innerHTML =
                        `<div class="seat-alert success"><i class="bi bi-check-circle-fill"></i> ${avail} seats available for this session.</div>`;
                    submitBtn.disabled = false;
                }
            }

            // ── Ticket counter --------------------------------------------------------
            function updateCounter() {
                const val = parseInt(ticketVal.value);
                const max = currentSubData?.available ?? 10;
                const cap = Math.min(max, 10);

                tcMinus.disabled = val <= 1;
                tcPlus.disabled = val >= cap;

                ticketLabel.textContent = val + ' Ticket' + (val > 1 ? 's' : '');

                if (currentSubData) renderSummary();
            }

            tcMinus.addEventListener('click', () => {
                let v = parseInt(ticketVal.value);
                if (v > 1) {
                    ticketVal.value = v - 1;
                    updateCounter();
                }
            });

            tcPlus.addEventListener('click', () => {
                let v = parseInt(ticketVal.value);
                const max = currentSubData?.available ?? 10;
                const cap = Math.min(max, 10);
                if (v < cap) {
                    ticketVal.value = v + 1;
                    updateCounter();
                }
            });

            // ── Session radio change --------------------------------------------------
            subRadios.forEach(radio => {
                radio.addEventListener('change', () => {
                    if (radio.checked) {
                        ticketVal.value = 1;
                        updateCounter();
                        fetchSubDetails(radio.value);
                    }
                });
            });

            // ── Auto-load first selected session on page load ------------------------
            const checkedRadio = document.querySelector('.sub-radio:checked');
            if (checkedRadio) {
                fetchSubDetails(checkedRadio.value);
            }

            // ── Form submit spinner ---------------------------------------------------
            document.getElementById('regForm').addEventListener('submit', function(e) {
                submitText.innerHTML = '<span class="ajax-spin"></span> Processing…';
                submitBtn.disabled = true;
            });

            // Init counter
            updateCounter();

        })();
    </script>

@endsection
