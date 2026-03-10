@extends('frontend.course.layout')
@section('content')
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--default-font);
            color: var(--default);
            background: #f4f8ff;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        h1,
    
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--heading-font);
            color: var(--heading);
        }

        /* TOPBAR */
        .topbar {
            background: var(--accent);
            padding: 7px 0;
            font-family: var(--nav-font);
            font-size: 13px;
            color: #fff;
        }

        .topbar a {
            color: rgba(255, 255, 255, .85);
            transition: color .2s;
        }

        .topbar a:hover {
            color: #fff;
        }

        /* HEADER */

        /* ── RESULT HERO ── */
        .result-hero {
            background: linear-gradient(135deg, var(--heading) 0%, #1e3a8a 55%, #175cdd 100%);
            padding: 60px 0 50px;
            position: relative;
            overflow: hidden;
        }

        .result-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1516627145497-ae6968895b74?w=1400&q=40') center/cover;
            opacity: .07;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #b8d4ff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .result-hero h1 {
            font-size: clamp(28px, 4vw, 48px);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .result-hero h1 span {
            color: #60a5fa;
        }

        .result-hero .hero-sub {
            font-size: 16px;
            color: rgba(255, 255, 255, .72);
            margin-bottom: 24px;
            max-width: 500px;
        }

        .talent-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .28);
            border-radius: 40px;
            padding: 10px 20px;
        }

        .talent-badge .tb-emoji {
            font-size: 26px;
        }

        .talent-badge .tb-label {
            font-size: 11px;
            color: rgba(255, 255, 255, .6);
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .talent-badge .tb-name {
            font-family: var(--heading-font);
            font-size: 17px;
            font-weight: 800;
            color: #fff;
        }

        /* big score ring (CSS only) */
        .score-ring-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .score-ring {
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: conic-gradient(#60a5fa var(--pct, 0%), rgba(255, 255, 255, .12) 0%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 0 40px rgba(96, 165, 250, .4);
        }

        .score-ring::before {
            content: '';
            position: absolute;
            inset: 16px;
            border-radius: 50%;
            background: rgba(17, 35, 68, .85);
        }

        .score-ring-inner {
            position: relative;
            text-align: center;
        }

        .score-ring-inner .pct {
            font-family: var(--heading-font);
            font-size: 46px;
            font-weight: 900;
            color: #fff;
            line-height: 1;
        }

        .score-ring-inner .pct-label {
            font-size: 12px;
            color: rgba(255, 255, 255, .6);
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 28px;
        }

        .btn-white {
            background: #fff;
            color: var(--accent);
            border: none;
            padding: 12px 26px;
            border-radius: 30px;
            font-family: var(--heading-font);
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: background .2s, transform .15s;
        }

        .btn-white:hover {
            background: #f0f5ff;
            transform: translateY(-2px);
        }

        .btn-outline-white {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, .5);
            padding: 11px 22px;
            border-radius: 30px;
            font-family: var(--heading-font);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all .2s;
        }

        .btn-outline-white:hover {
            border-color: #fff;
            background: rgba(255, 255, 255, .1);
        }

        /* ── SECTION TITLE ── */
        .section-title {
            text-align: center;
            margin-bottom: 44px;
        }

        .section-title h2 {
            
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .section-title .div-line {
            display: block;
            width: 48px;
            height: 3px;
            background: var(--accent);
            border-radius: 2px;
            margin: 0 auto 12px;
        }

        .section-title p {
            font-size: 15px;
            color: #6b7280;
            max-width: 540px;
            margin: 0 auto;
        }

        /* ── CARDS / SURFACES ── */
        .result-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #e4ecf8;
            overflow: hidden;
            height: 100%;
        }

        .card-header-bar {
            padding: 18px 24px;
            border-bottom: 1px solid #f0f4fb;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header-bar .ch-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .card-header-bar h5 {
            font-size: 15px;
            font-weight: 800;
            color: var(--heading);
            margin: 0;
        }

        .card-header-bar p {
            font-size: 12px;
            color: #9ca3af;
            margin: 0;
        }

        .card-body-pad {
            padding: 24px;
        }

        /* ── SECTION 1: OVERALL SUMMARY ── */
        .overall-section {
            padding: 60px 0 0;
        }

        .overall-type-card {
            background: linear-gradient(135deg, #f0f7ff 0%, #e8f0fe 100%);
            border: 1.5px solid #dbeafe;
            border-radius: 20px;
            padding: 32px;
            display: flex;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .otc-emoji {
            font-size: 52px;
            line-height: 1;
            flex-shrink: 0;
        }

        .otc-type-num {
            font-size: 11px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 4px;
        }

        .otc-name {
            font-size: 26px;
            font-weight: 900;
            color: var(--heading);
            margin-bottom: 4px;
        }

        .otc-tagline {
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .otc-desc {
            font-size: 14px;
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 16px;
        }

        .otc-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .otc-tag {
            background: #fff;
            border: 1.5px solid #dbeafe;
            color: var(--accent);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .mini-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .mini-stat {
            background: #fff;
            border: 1.5px solid #e4ecf8;
            border-radius: 14px;
            padding: 18px 14px;
            text-align: center;
        }

        .mini-stat .ms-val {
            font-family: var(--heading-font);
            font-size: 26px;
            font-weight: 900;
            color: var(--accent);
        }

        .mini-stat .ms-label {
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-top: 4px;
        }

        .course-rec {
            background: linear-gradient(135deg, var(--heading), #175cdd);
            border-radius: 16px;
            padding: 22px;
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .course-rec .cr-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .course-rec h6 {
            font-size: 13px;
            font-weight: 700;
            color: rgba(255, 255, 255, .65);
            margin-bottom: 3px;
        }

        .course-rec p {
            font-size: 15px;
            font-weight: 800;
            color: #fff;
            margin: 0;
        }

        /* ── SECTION 2: CATEGORY SCORES (PROGRESS BARS) ── */
        .cat-section {
            padding: 50px 0;
        }

        .cat-progress-wrap {
            margin-bottom: 20px;
        }

        .cat-progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .cat-progress-header .cp-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 14px;
            color: var(--heading);
        }

        .cat-progress-header .cp-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .cat-progress-header .cp-pct {
            font-family: var(--heading-font);
            font-size: 16px;
            font-weight: 800;
        }

        .cat-track {
            height: 12px;
            background: #e8edf5;
            border-radius: 8px;
            overflow: hidden;
        }

        .cat-fill {
            height: 100%;
            border-radius: 8px;
            transition: width 1.2s cubic-bezier(.4, 0, .2, 1);
        }

        .cat-sub {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 5px;
        }

        /* Category breakdown mini cards */
        .cat-mini-card {
            background: #fff;
            border-radius: 14px;
            border: 1.5px solid #e4ecf8;
            padding: 20px;
            height: 100%;
        }

        .cat-mini-card .cmc-icon {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .cat-mini-card h6 {
            font-size: 14px;
            font-weight: 800;
            color: var(--heading);
            margin-bottom: 6px;
        }

        .cat-mini-card .cmc-score {
            font-family: var(--heading-font);
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 4px;
        }

        .cat-mini-card p {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.5;
            margin: 0;
        }

        .cat-mini-card .cmc-bar {
            height: 6px;
            background: #e8edf5;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 10px;
        }

        .cat-mini-card .cmc-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 1.2s;
        }

        /* ── SECTION 3: BAR CHART ── */
        .chart-section {
            padding: 50px 0;
        }

        .chart-canvas-wrap {
            position: relative;
            height: 320px;
        }

        /* ── SECTION 4: RADAR CHART ── */
        .radar-section {
            padding: 0 0 50px;
        }

        .radar-canvas-wrap {
            position: relative;
            height: 360px;
        }

        /* ── SECTION 5: PIE CHART ── */
        .pie-section {
            padding: 0 0 50px;
        }

        .pie-canvas-wrap {
            position: relative;
            height: 300px;
        }

        .pie-legend {
            display: flex;
            flex-direction: column;
            gap: 12px;
            justify-content: center;
        }

        .pie-legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pie-legend-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .pie-legend-item span {
            font-size: 13px;
            font-weight: 600;
            color: var(--heading);
        }

        .pie-legend-item .pli-pct {
            margin-left: auto;
            font-family: var(--heading-font);
            font-weight: 800;
            font-size: 14px;
        }

        /* ── SECTION 6: CATEGORY DETAIL CARDS ── */
        .detail-section {
            padding: 0 0 60px;
        }

        .detail-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e4ecf8;
            overflow: hidden;
            height: 100%;
        }

        .detail-card-top {
            padding: 22px 22px 16px;
            border-bottom: 1px solid #f0f4fb;
        }

        .detail-card-top .dct-cat {
            font-size: 11px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 6px;
        }

        .detail-card-top h5 {
            font-size: 17px;
            font-weight: 800;
            color: var(--heading);
            margin-bottom: 8px;
        }

        .detail-card-top .dct-score-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .detail-card-top .dct-big-score {
            font-family: var(--heading-font);
            font-size: 36px;
            font-weight: 900;
        }

        .detail-card-top .dct-track {
            flex: 1;
            height: 8px;
            background: #e8edf5;
            border-radius: 4px;
            overflow: hidden;
        }

        .detail-card-top .dct-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 1.2s;
        }

        .detail-card-body {
            padding: 18px 22px;
        }

        .detail-card-body p {
            font-size: 13.5px;
            color: #4b5563;
            line-height: 1.65;
            margin-bottom: 14px;
        }

        .detail-q-list {
            list-style: none;
            padding: 0;
        }

        .detail-q-list li {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--default);
            padding: 6px 0;
            border-bottom: 1px dashed #f0f4fb;
        }

        .detail-q-list li:last-child {
            border-bottom: none;
        }

        .q-score-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .q-ans-badge {
            margin-left: auto;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 8px;
            white-space: nowrap;
        }

        .ans-inaccurate {
            background: #fee2e2;
            color: #dc2626;
        }

        .ans-neutral {
            background: #fef3c7;
            color: #d97706;
        }

        .ans-accurate {
            background: #dcfce7;
            color: #16a34a;
        }

        /* ── CTA BOTTOM ── */
        .cta-bottom {
            background: linear-gradient(135deg, var(--heading), #175cdd);
            padding: 70px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-bottom::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1560523159-6b681a1e1852?w=1400&q=40') center/cover;
            opacity: .06;
        }

        .cta-bottom h2 {
            font-size: 36px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 12px;
            position: relative;
        }

        .cta-bottom p {
            font-size: 16px;
            color: rgba(255, 255, 255, .72);
            margin-bottom: 28px;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }

        .cta-trust {
            display: flex;
            justify-content: center;
            gap: 22px;
            flex-wrap: wrap;
            margin-top: 24px;
            position: relative;
        }

        .cta-trust-item {
            display: flex;
            align-items: center;
            gap: 7px;
            color: rgba(255, 255, 255, .7);
            font-size: 13px;
        }

        .cta-trust-item i {
            color: #60a5fa;
        }



        .scroll-top {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 44px;
            height: 44px;
            background: var(--accent);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 20px rgba(23, 92, 221, .35);
            cursor: pointer;
            opacity: 0;
            pointer-events: none;
            transition: opacity .3s, transform .3s;
            z-index: 999;
        }

        .scroll-top.active {
            opacity: 1;
            pointer-events: auto;
        }

        .scroll-top:hover {
            transform: translateY(-3px);
        }

        /* Print */
        @media print {

            .site-header,
            .topbar,
            .cta-bottom,
            .footer-16,
            .scroll-top {
                display: none !important;
            }

            body {
                background: #fff;
            }

            .result-hero {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        @media(max-width:768px) {


            .mini-stat-grid {
                grid-template-columns: 1fr 1fr;
            }

            .score-ring {
                width: 150px;
                height: 150px;
            }

            .score-ring-inner .pct {
                font-size: 36px;
            }
        }
    </style>
@php
$talentTypes = [
    'performer' => [
        'name'    => 'The Performer',
        'emoji'   => '🎭',
        'tagline' => 'Natural On-Screen Magnetism',
        'desc'    => 'Your child has exceptional natural charisma and camera presence. They light up every room, command attention instinctively, and make every performance feel alive and genuine. They were born for the screen.',
        'course'  => 'Screen Acting + Camera Techniques',
        'tags'    => ['Charismatic','Camera-Ready','Energetic','Scene-Stealer'],
        'color'   => '#175cdd',
    ],
    'empath' => [
        'name'    => 'The Empath',
        'emoji'   => '💙',
        'tagline' => 'Deep Emotional Expression',
        'desc'    => 'Your child feels emotions profoundly and channels them into powerful, believable performances. Their ability to connect emotionally with characters and audiences is rare and extremely valuable.',
        'course'  => 'Screen Acting + Personality Development',
        'tags'    => ['Deeply Feeling','Expressive','Authentic','Emotionally Intelligent'],
        'color'   => '#7c3aed',
    ],
    'creator' => [
        'name'    => 'The Creator',
        'emoji'   => '✨',
        'tagline' => 'Storytelling & Wild Imagination',
        'desc'    => "Your child's imagination is extraordinary. They invent entire worlds, create vivid characters, and bring originality to everything they do.",
        'course'  => 'Theatre & Stage + Filmmaking',
        'tags'    => ['Imaginative','Inventive','Original','Storyteller'],
        'color'   => '#059669',
    ],
    'leader' => [
        'name'    => 'The Leader',
        'emoji'   => '👑',
        'tagline' => 'Stage Presence & Command',
        'desc'    => 'Your child naturally commands attention and authority. They have powerful stage presence and the ability to lead an audience through any performance with confidence.',
        'course'  => 'Screen Acting + Public Speaking',
        'tags'    => ['Commanding','Confident','Authoritative','Natural Leader'],
        'color'   => '#d97706',
    ],
    'voice' => [
        'name'    => 'The Voice',
        'emoji'   => '🎤',
        'tagline' => 'Powerful Speech & Expression',
        'desc'    => "Your child's greatest gift is their voice — its tone, clarity, and expressive range. They excel in dialogue delivery, public speaking, and voice-led performance.",
        'course'  => 'Public Speaking + Theatre & Stage',
        'tags'    => ['Articulate','Persuasive','Expressive','Clear Communicator'],
        'color'   => '#db2777',
    ],
    'director' => [
        'name'    => 'The Director',
        'emoji'   => '🎬',
        'tagline' => 'Vision, Craft & Filmmaking',
        'desc'    => 'Your child has the eye of a director. They see the bigger picture, understand narrative structure, and notice details others miss.',
        'course'  => 'Filmmaking + Screen Acting',
        'tags'    => ['Visionary','Strategic','Detail-Oriented','Big-Picture Thinker'],
        'color'   => '#0891b2',
    ],
];

$tt = $talentTypes[$topTypeKey] ?? $talentTypes['performer'];

// Admin range overrides talent type if set
$displayLabel   = $range['label']              ?? $tt['name'];
$displayEmoji   = $range['emoji']              ?? $tt['emoji'];
$displayTagline = $range['tagline']            ?? $tt['tagline'];
$displayDesc    = $range['description']        ?? $tt['desc'];
$displayCourse  = $range['recommended_course'] ?? $tt['course'];
$displayTags    = $range['tags']               ?? $tt['tags'];
$displayColor   = $range['color']              ?? $tt['color'];
@endphp

<main class="main">

    {{-- ══════════════════════════════════════════
         HERO
    ══════════════════════════════════════════ --}}
    <section class="result-hero">
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="hero-eyebrow">
                        <i class="bi bi-bar-chart-fill"></i> Your Test Result is Ready!
                    </div>
                    <h1>You're <span id="hero-talent-name">{{ $displayLabel }}</span>!</h1>
                    <p class="hero-sub">{{ $displayTagline }}</p>

                    <div class="talent-badge">
                        <div class="tb-emoji">{{ $displayEmoji }}</div>
                        <div>
                            <div class="tb-label">Dominant Talent Type</div>
                            <div class="tb-name">{{ $displayLabel }}</div>
                        </div>
                    </div>

                    <div class="hero-actions">
                        <button class="btn-white" onclick="window.print()">
                            <i class="bi bi-printer"></i> Download Report
                        </button>
                        <a href="https://wa.me/?text={{ urlencode('🎭 My child\'s Acting Talent Result from Act to Action: ' . $displayEmoji . ' ' . $displayLabel . ' — ' . $displayTagline . '! Free test: https://www.acttoaction.com') }}"
                           target="_blank" class="btn-outline-white">
                            <i class="bi bi-whatsapp"></i> Share on WhatsApp
                        </a>
                        <a href="{{ route('frontend.tests.take', $test->id) }}" class="btn-outline-white">
                            <i class="bi bi-arrow-repeat"></i> Retake Test
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 text-center">
                    <div class="score-ring-wrap">
                        <div class="score-ring" id="score-ring" style="--pct:0deg">
                            <div class="score-ring-inner">
                                <div class="pct" id="ring-pct">0%</div>
                                <div class="pct-label">Overall Score</div>
                            </div>
                        </div>
                    </div>
                    <p style="color:rgba(255,255,255,.55);font-size:13px;margin-top:14px;">
                        Based on {{ $test->categories->flatMap->questions->count() }} questions
                        across {{ $test->categories->count() }} sections
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════
         SECTION 1 — OVERALL RESULT SUMMARY
    ══════════════════════════════════════════ --}}
    <section class="overall-section">
        <div class="container">
            <div class="section-title">
                <h2>Your Overall Result</h2>
                <span class="div-line"></span>
                <p>A complete breakdown of your child's performing arts talent profile across all 6 talent dimensions.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="overall-type-card">
                        <div class="otc-emoji">{{ $displayEmoji }}</div>
                        <div>
                            <div class="otc-type-num">Dominant Talent Type</div>
                            <div class="otc-name">{{ $displayLabel }}</div>
                            <div class="otc-tagline">{{ $displayTagline }}</div>
                            <p class="otc-desc">{{ $displayDesc }}</p>
                            @if($displayTags)
                                <div class="otc-tags">
                                    @foreach((array) $displayTags as $tag)
                                        <span class="otc-tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mini-stat-grid">
                        <div class="mini-stat">
                            <div class="ms-val">{{ $overallPct }}%</div>
                            <div class="ms-label">Overall Score</div>
                        </div>
                        <div class="mini-stat">
                            <div class="ms-val">
                                {{ $test->categories->flatMap->questions->count() }}
                            </div>
                            <div class="ms-label">Questions Answered</div>
                        </div>
                        <div class="mini-stat">
                            <div class="ms-val">{{ $test->categories->count() }}</div>
                            <div class="ms-label">Sections Completed</div>
                        </div>
                    </div>

                    @if($displayCourse)
                        <div class="course-rec">
                            <div class="cr-icon">🎬</div>
                            <div>
                                <h6>Recommended Course</h6>
                                <p>{{ $displayCourse }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-5">
                    <div class="result-card">
                        <div class="card-header-bar">
                            <div class="ch-icon" style="background:#eff6ff;color:var(--accent-color);">
                                <i class="bi bi-bar-chart-steps"></i>
                            </div>
                            <div>
                                <h5>All 6 Talent Scores</h5>
                                <p>How you scored across every type</p>
                            </div>
                        </div>
                        <div class="card-body-pad">
                            @foreach(collect($typeScores)->sortDesc() as $key => $val)
                                @php $t = $talentTypes[$key] ?? null; @endphp
                                @if($t)
                                <div style="margin-bottom:12px;">
                                    <div style="display:flex;justify-content:space-between;
                                                align-items:center;margin-bottom:5px;">
                                        <span style="font-size:13px;font-weight:600;
                                                     color:var(--heading-color);">
                                            {{ $t['emoji'] }} {{ $t['name'] }}
                                        </span>
                                        <strong style="font-size:13px;color:{{ $t['color'] }};">
                                            {{ $val }}%
                                        </strong>
                                    </div>
                                    <div style="height:8px;background:#e8edf5;
                                                border-radius:5px;overflow:hidden;">
                                        <div class="anim-bar"
                                             style="height:100%;border-radius:5px;
                                                    background:{{ $t['color'] }};width:0%;"
                                             data-w="{{ $val }}">
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════
         SECTION 2 — CATEGORY SCORES
    ══════════════════════════════════════════ --}}
    <section class="cat-section">
        <div class="container">
            <div class="section-title">
                <h2>Category-Wise Scores</h2>
                <span class="div-line"></span>
                <p>Your performance across {{ $chartData->count() }} test sections.</p>
            </div>

            <div class="row g-4 mb-5">
                @foreach($chartData as $i => $cat)
                <div class="col-md-4">
                    <div class="cat-mini-card">
                        <div class="cmc-icon">{{ $cat['icon'] }}</div>
                        <h6>{{ $cat['name'] }}</h6>
                        <div class="cmc-score" style="color:{{ $cat['color'] }};">
                            {{ $cat['score'] }}%
                        </div>
                        <p>Section {{ $i + 1 }} performance score</p>
                        <div class="cmc-bar">
                            <div class="cmc-fill"
                                 style="width:0%;background:{{ $cat['color'] }};"
                                 data-w="{{ $cat['score'] }}">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Category detail cards --}}
            <div class="row g-4">
                @php
                    $qIndex       = 0;
                    $ansLabels    = ['', 'Never', 'Rarely', 'Sometimes', 'Often', 'Always'];
                    $ansEmoji     = ['', '😟', '😐', '🙂', '😊', '🤩'];
                    $ansClass     = ['', 'ans-inaccurate', 'ans-inaccurate', 'ans-neutral', 'ans-accurate', 'ans-accurate'];
                @endphp
                @foreach($test->categories as $si => $cat)
                @php
                    $catColor = $cat->color ?? ($chartData[$si]['color'] ?? '#175cdd');
                    $catIcon  = $cat->icon  ?? ($chartData[$si]['icon']  ?? '📋');
                    $catName  = $cat->category_name ?? $cat->name ?? 'Section ' . ($si + 1);
                    $catScore = $chartData[$si]['score'] ?? 0;
                @endphp
                <div class="col-md-4">
                    <div class="cat-mini-card" style="padding:0;border-radius:18px;overflow:hidden;">
                        <div style="background:{{ $catColor }};padding:18px 20px;">
                            <div style="font-size:24px;margin-bottom:4px;">{{ $catIcon }}</div>
                            <div style="font-family:var(--heading-font);font-size:16px;
                                        font-weight:800;color:#fff;">{{ $catName }}</div>
                            <div style="font-size:22px;font-weight:900;color:#fff;opacity:.9;">
                                {{ $catScore }}%
                            </div>
                        </div>
                        <div style="padding:16px 18px;">
                            <ul class="detail-q-list">
                                @foreach($cat->questions as $qi => $question)
                                @php
                                    $ans = $answers[$qIndex] ?? 3;
                                    $qIndex++;
                                @endphp
                                <li>
                                    <div class="q-score-dot"
                                         style="background:{{ $catColor }};"></div>
                                    <span style="flex:1;">{{ $question->question_text }}</span>
                                    <span class="q-ans-badge {{ $ansClass[$ans] ?? 'ans-neutral' }}">
                                        {{ $ansLabels[$ans] ?? 'Sometimes' }}
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════
         DYNAMIC GRAPH — admin selected
    ══════════════════════════════════════════ --}}
    @if($graphType !== 'none')
    <section class="chart-section" style="background:#fff;padding:60px 0;">
        <div class="container">
            <div class="section-title">
                @php
                    $graphTitles = [
                        'bar'   => '📊 Talent Type Bar Chart',
                        'radar' => '🕸️ Talent Radar Chart',
                        'pie'   => '🥧 Talent Distribution Pie',
                        'line'  => '📈 Category Performance Line',
                    ];
                @endphp
                <h2>{{ $graphTitles[$graphType] ?? '📊 Score Chart' }}</h2>
                <span class="div-line"></span>
                <p>A visual breakdown of your child's complete talent profile.</p>
            </div>
            <div class="result-card">
                <div class="card-header-bar">
                    <div class="ch-icon" style="background:#eff6ff;color:var(--accent-color);">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    <div>
                        <h5>Score Breakdown Chart</h5>
                        <p>Visual representation of your talent profile</p>
                    </div>
                </div>
                <div class="card-body-pad">
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    @include('partials.graphs.' . $graphType, [
                        'chartData' => $chartData
                    ])
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ══════════════════════════════════════════
         QUESTION-BY-QUESTION BREAKDOWN
    ══════════════════════════════════════════ --}}
    <section class="detail-section" style="background:#fff;padding-top:60px;">
        <div class="container">
            <div class="section-title">
                <h2>Question-by-Question Breakdown</h2>
                <span class="div-line"></span>
                <p>See exactly how your child answered each question in every test section.</p>
            </div>
            <div class="row g-4">
                @php $qIndex2 = 0; @endphp
                @foreach($test->categories as $si => $cat)
                @php
                    $catColor = $cat->color ?? ($chartData[$si]['color'] ?? '#175cdd');
                    $catIcon  = $cat->icon  ?? ($chartData[$si]['icon']  ?? '📋');
                    $catName  = $cat->category_name ?? $cat->name ?? 'Section ' . ($si + 1);
                    $catScore = $chartData[$si]['score'] ?? 0;
                @endphp
                <div class="col-lg-4">
                    <div class="detail-card">
                        <div class="detail-card-top"
                             style="background:{{ $catColor }}15;">
                            <div class="dct-cat">
                                Section {{ $si + 1 }} of {{ $test->categories->count() }}
                            </div>
                            <h5>{{ $catIcon }} {{ $catName }}</h5>
                            <div class="dct-score-row">
                                <div class="dct-big-score" style="color:{{ $catColor }};">
                                    {{ $catScore }}%
                                </div>
                                <div class="dct-track">
                                    <div class="dct-fill"
                                         style="background:{{ $catColor }};width:0%;"
                                         data-w="{{ $catScore }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail-card-body">
                            @foreach($cat->questions as $qi => $question)
                            @php
                                $ans = $answers[$qIndex2] ?? 3;
                                $qIndex2++;
                            @endphp
                            <div class="step-q-row"
                                 style="padding:14px 0;border-bottom:1px solid #f0f4fb;">
                                <div style="font-size:11px;color:#9ca3af;font-weight:700;
                                            text-transform:uppercase;margin-bottom:5px;">
                                    Q{{ $qi + 1 }}
                                </div>
                                <div style="font-size:13.5px;font-weight:600;
                                            color:var(--heading-color);margin-bottom:8px;">
                                    {{ $question->question_text }}
                                </div>
                                <span class="q-ans-badge {{ $ansClass[$ans] ?? 'ans-neutral' }}"
                                      style="font-size:12px;">
                                    {{ $ansEmoji[$ans] ?? '🙂' }}
                                    {{ $ansLabels[$ans] ?? 'Sometimes' }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════
         CTA
    ══════════════════════════════════════════ --}}
    <section class="cta-bottom">
        <div class="container">
            <h2>Ready to Turn This Talent into a Career?</h2>
            <p>Book a free appointment today — our expert coaches will guide your child to the
               perfect course based on these results.</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap position-relative">
                <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank">
                    <button class="btn-white">
                        <i class="bi bi-whatsapp"></i> Book Free Appointment
                    </button>
                </a>
                <a href="{{ route('frontend.tests.take', $test->id) }}">
                    <button class="btn-outline-white">
                        <i class="bi bi-arrow-repeat"></i> Retake the Test
                    </button>
                </a>
            </div>
            <div class="cta-trust">
                <div class="cta-trust-item">
                    <i class="bi bi-check-circle-fill"></i> No-risk 1-month trial
                </div>
                <div class="cta-trust-item">
                    <i class="bi bi-check-circle-fill"></i> Only 20 seats per batch
                </div>
                <div class="cta-trust-item">
                    <i class="bi bi-check-circle-fill"></i> Certificate on completion
                </div>
                <div class="cta-trust-item">
                    <i class="bi bi-check-circle-fill"></i> Govt. registered institute
                </div>
            </div>
        </div>
    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const overallScore = {{ $overallPct }};

// Animate score ring
setTimeout(() => {
    const ring  = document.getElementById('score-ring');
    const pctEl = document.getElementById('ring-pct');
    const deg   = Math.round((overallScore / 100) * 360);
    ring.style.setProperty('--pct', deg + 'deg');
    ring.style.background =
        `conic-gradient(#60a5fa ${deg}deg, rgba(255,255,255,.12) 0%)`;
    let c = 0;
    const iv = setInterval(() => {
        c = Math.min(c + 2, overallScore);
        pctEl.textContent = c + '%';
        if (c >= overallScore) clearInterval(iv);
    }, 20);
}, 400);

// Animate all progress bars
setTimeout(() => {
    document.querySelectorAll('.anim-bar, .cmc-fill, .dct-fill').forEach(el => {
        el.style.transition = 'width 1.2s cubic-bezier(0.25,0.46,0.45,0.94)';
        el.style.width = (el.dataset.w || 0) + '%';
    });
}, 600);
</script>


@endsection