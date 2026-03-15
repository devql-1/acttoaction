@extends('frontend.course.layout')
@section('content')
    <style>
        /* ════════════════════════════════════════════
                                   QUIZ RESULT PAGE — Act to Action
                                   Design: Deep navy + electric blue, editorial
                                   premium feel with bold typographic hierarchy
                                ════════════════════════════════════════════ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ── HERO ── */
        .rh-hero {
            background: #07112b;
            padding: 0;
            position: relative;
            overflow: hidden;
            min-height: 520px;
            display: flex;
            align-items: center;
        }

        .rh-hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 75% 50%, rgba(23, 92, 221, .35) 0%, transparent 65%),
                radial-gradient(ellipse 50% 80% at 10% 80%, rgba(96, 165, 250, .12) 0%, transparent 60%);
            pointer-events: none;
        }

        .rh-hero-dots {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, .06) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }

        .rh-hero-glow {
            position: absolute;
            right: -80px;
            top: -80px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(23, 92, 221, .25) 0%, transparent 70%);
            pointer-events: none;
        }

        .rh-hero .container {
            position: relative;
            padding: 72px 0;
        }

        /* Eyebrow */
        .rh-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(96, 165, 250, .15);
            border: 1px solid rgba(96, 165, 250, .35);
            color: #93c5fd;
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 5px 16px;
            border-radius: 30px;
            margin-bottom: 22px;
        }

        .rh-eyebrow .dot-live {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #34d399;
            animation: pulse-dot 1.6s ease-in-out infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .4;
                transform: scale(1.5);
            }
        }

        /* Title */
        .rh-hero h1 {
            font-size: clamp(32px, 5vw, 56px);
            font-weight: 900;
            color: #fff;
            line-height: 1.05;
            margin-bottom: 14px;
            letter-spacing: -1px;
        }

        .rh-hero h1 .accent-text {
            background: linear-gradient(90deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .rh-tagline {
            font-size: 16px;
            color: rgba(255, 255, 255, .62);
            margin-bottom: 32px;
            max-width: 460px;
            line-height: 1.65;
        }

        /* Talent badge */
        .rh-badge {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            background: rgba(255, 255, 255, .07);
            border: 1.5px solid rgba(255, 255, 255, .16);
            border-radius: 16px;
            padding: 14px 22px;
            backdrop-filter: blur(8px);
            margin-bottom: 8px;
        }

        .rh-badge .badge-emoji {
            font-size: 32px;
            line-height: 1;
        }

        .rh-badge .badge-meta {
            display: flex;
            flex-direction: column;
        }

        .rh-badge .badge-meta small {
            font-size: 10px;
            font-weight: 700;
            color: rgba(255, 255, 255, .45);
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 3px;
        }

        .rh-badge .badge-meta strong {
            font-size: 17px;
            font-weight: 800;
            color: #fff;
            font-family: var(--heading-font);
        }

        /* Range info strip — only shown when DB range matched */
        .range-info-strip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(52, 211, 153, .12);
            border: 1px solid rgba(52, 211, 153, .3);
            color: #6ee7b7;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
            margin-top: 12px;
            margin-bottom: 6px;
        }

        .range-info-strip i {
            color: #34d399;
        }

        /* Hero actions */
        .rh-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 26px;
        }

        .rh-btn-primary {
            background: #175cdd;
            color: #fff;
            border: none;
            padding: 13px 26px;
            border-radius: 10px;
            font-family: var(--heading-font);
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .2s;
            box-shadow: 0 4px 18px rgba(23, 92, 221, .45);
            text-decoration: none;
        }

        .rh-btn-primary:hover {
            background: #1a6aff;
            transform: translateY(-2px);
            color: #fff;
        }

        .rh-btn-ghost {
            background: transparent;
            color: rgba(255, 255, 255, .75);
            border: 1.5px solid rgba(255, 255, 255, .22);
            padding: 12px 22px;
            border-radius: 10px;
            font-family: var(--heading-font);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .2s;
            text-decoration: none;
        }

        .rh-btn-ghost:hover {
            border-color: rgba(255, 255, 255, .5);
            color: #fff;
            background: rgba(255, 255, 255, .07);
        }

        /* Score ring */
        .rh-ring-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .rh-ring {
            width: 210px;
            height: 210px;
            border-radius: 50%;
            background: conic-gradient(#175cdd 0deg, rgba(255, 255, 255, .07) 0deg);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow:
                0 0 0 12px rgba(23, 92, 221, .12),
                0 0 60px rgba(23, 92, 221, .35);
            transition: background 1.2s ease;
        }

        .rh-ring::before {
            content: '';
            position: absolute;
            inset: 18px;
            border-radius: 50%;
            background: #07112b;
            border: 1px solid rgba(255, 255, 255, .08);
        }

        .rh-ring-inner {
            position: relative;
            text-align: center;
        }

        .rh-ring-inner .rr-pct {
            font-family: var(--heading-font);
            font-size: 52px;
            font-weight: 900;
            color: #fff;
            line-height: 1;
        }

        .rh-ring-inner .rr-label {
            font-size: 11px;
            color: rgba(255, 255, 255, .45);
            text-transform: uppercase;
            letter-spacing: .7px;
            margin-top: 4px;
        }

        .rh-ring-caption {
            text-align: center;
            color: rgba(255, 255, 255, .4);
            font-size: 12px;
            margin-top: 18px;
            line-height: 1.5;
        }

        /* ── SECTION LAYOUT ── */
        .res-section {
            padding: 70px 0;
        }

        .res-section.bg-soft {
            background: #f5f8ff;
        }

        .res-section.bg-white {
            background: #fff;
        }

        .sec-head {
            text-align: center;
            margin-bottom: 50px;
        }

        .sec-head h2 {
            font-family: var(--heading-font);
            font-size: clamp(22px, 3vw, 30px);
            font-weight: 800;
            color: var(--heading-color, #07112b);
            margin-bottom: 10px;
        }

        .sec-head .sh-bar {
            display: block;
            width: 44px;
            height: 3px;
            background: #175cdd;
            border-radius: 2px;
            margin: 0 auto 12px;
        }

        .sec-head p {
            font-size: 15px;
            color: #6b7280;
            max-width: 500px;
            margin: 0 auto;
        }

        /* ── TYPE SPOTLIGHT ── */
        .type-spotlight {
            background: #fff;
            border-radius: 24px;
            border: 1.5px solid #e0eaff;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(23, 92, 221, .08);
            margin-bottom: 22px;
        }

        .ts-accent-bar {
            height: 5px;
            width: 100%;
        }

        .ts-body {
            padding: 34px 36px;
            display: flex;
            gap: 26px;
            align-items: flex-start;
        }

        .ts-emoji {
            font-size: 60px;
            line-height: 1;
            flex-shrink: 0;
            margin-top: 6px;
        }

        .ts-content {
            flex: 1;
            min-width: 0;
        }

        .ts-source-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .ts-source-badge.db-source {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
        }

        .ts-source-badge.fallback-source {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1d4ed8;
        }

        .ts-name {
            font-family: var(--heading-font);
            font-size: 30px;
            font-weight: 900;
            color: var(--heading-color, #07112b);
            line-height: 1.1;
            margin-bottom: 5px;
        }

        .ts-tagline {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .ts-desc {
            font-size: 14.5px;
            color: #4b5563;
            line-height: 1.75;
            margin-bottom: 20px;
        }

        .ts-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ts-tag {
            font-size: 12px;
            font-weight: 600;
            padding: 5px 14px;
            border-radius: 20px;
            border: 1.5px solid;
        }

        .range-band {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f8faff;
            border: 1px solid #dbeafe;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 14px;
            border-radius: 8px;
            margin-top: 14px;
        }

        .range-band i {
            color: #175cdd;
        }

        /* ── STAT GRID ── */
        .stat-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }

        .stat-tile {
            background: #fff;
            border: 1.5px solid #e4ecf8;
            border-radius: 16px;
            padding: 22px 16px;
            text-align: center;
            transition: transform .2s, box-shadow .2s;
        }

        .stat-tile:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(23, 92, 221, .1);
        }

        .stat-tile .st-val {
            font-family: var(--heading-font);
            font-size: 30px;
            font-weight: 900;
            color: #175cdd;
            line-height: 1;
        }

        .stat-tile .st-lbl {
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-top: 6px;
        }

        /* Course pill */
        .course-pill {
            background: linear-gradient(130deg, #07112b 0%, #0f2570 55%, #175cdd 100%);
            border-radius: 16px;
            padding: 22px 24px;
            display: flex;
            gap: 16px;
            align-items: center;
            box-shadow: 0 8px 28px rgba(23, 92, 221, .3);
        }

        .course-pill .cp-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .course-pill h6 {
            font-size: 11px;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            margin-bottom: 4px;
        }

        .course-pill p {
            font-size: 16px;
            font-weight: 800;
            color: #fff;
            margin: 0;
        }

        /* ── SCORES SIDEBAR CARD ── */
        .scores-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #e4ecf8;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 4px 20px rgba(23, 92, 221, .06);
        }

        .scores-card-head {
            padding: 20px 24px 16px;
            border-bottom: 1px solid #f0f4fb;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sch-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #eff6ff;
            color: #175cdd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .sch-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--heading-color, #07112b);
            margin: 0;
        }

        .sch-sub {
            font-size: 12px;
            color: #9ca3af;
            margin: 0;
        }

        .scores-card-body {
            padding: 22px 24px;
        }

        .score-row {
            margin-bottom: 14px;
        }

        .score-row-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .score-row-head .sr-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--heading-color, #07112b);
        }

        .score-row-head .sr-val {
            font-size: 13px;
            font-weight: 800;
        }

        .score-track {
            height: 8px;
            background: #eef1f7;
            border-radius: 5px;
            overflow: hidden;
        }

        .score-fill {
            height: 100%;
            border-radius: 5px;
            width: 0%;
            transition: width 1.3s cubic-bezier(.4, 0, .2, 1);
        }

        /* ── CATEGORY CARDS ── */
        .cat-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid #e4ecf8;
            overflow: hidden;
            height: 100%;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 2px 12px rgba(23, 92, 221, .04);
        }

        .cat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 40px rgba(23, 92, 221, .12);
        }

        .cat-card-top {
            padding: 22px 22px 18px;
        }

        .cat-card-top .ct-icon {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .cat-card-top .ct-name {
            font-family: var(--heading-font);
            font-size: 16px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 4px;
        }

        .cat-card-top .ct-score {
            font-family: var(--heading-font);
            font-size: 36px;
            font-weight: 900;
            color: rgba(255, 255, 255, .92);
            line-height: 1;
        }

        .cat-card-top .ct-bar-wrap {
            height: 5px;
            background: rgba(255, 255, 255, .2);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 14px;
        }

        .cat-card-top .ct-bar-fill {
            height: 100%;
            border-radius: 3px;
            background: rgba(255, 255, 255, .7);
            width: 0%;
            transition: width 1.3s .3s cubic-bezier(.4, 0, .2, 1);
        }

        .cat-card-body {
            padding: 18px 20px;
        }

        .q-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 9px 0;
            border-bottom: 1px solid #f5f7fb;
            font-size: 13px;
        }

        .q-item:last-child {
            border-bottom: none;
        }

        .q-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 5px;
        }

        .q-text {
            flex: 1;
            color: #374151;
            line-height: 1.5;
            font-weight: 500;
        }

        .q-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 8px;
            white-space: nowrap;
            flex-shrink: 0;
            margin-left: 6px;
        }

        .ans-never {
            background: #fee2e2;
            color: #b91c1c;
        }

        .ans-rarely {
            background: #fef3c7;
            color: #b45309;
        }

        .ans-sometimes {
            background: #fef9c3;
            color: #ca8a04;
        }

        .ans-often {
            background: #dcfce7;
            color: #15803d;
        }

        .ans-always {
            background: #bbf7d0;
            color: #166534;
        }

        /* ── BREAKDOWN DETAIL CARDS ── */
        .breakdown-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #e4ecf8;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 3px 16px rgba(23, 92, 221, .05);
        }

        .bc-top {
            padding: 22px 24px 18px;
            border-bottom: 1px solid #f0f4fb;
        }

        .bc-top .bc-section-num {
            font-size: 10px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 7px;
        }

        .bc-top h5 {
            font-family: var(--heading-font);
            font-size: 17px;
            font-weight: 800;
            color: var(--heading-color, #07112b);
            margin-bottom: 12px;
        }

        .bc-score-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bc-big-pct {
            font-family: var(--heading-font);
            font-size: 38px;
            font-weight: 900;
            line-height: 1;
        }

        .bc-track {
            flex: 1;
            height: 8px;
            background: #e8edf5;
            border-radius: 4px;
            overflow: hidden;
        }

        .bc-fill {
            height: 100%;
            border-radius: 4px;
            width: 0%;
            transition: width 1.4s cubic-bezier(.4, 0, .2, 1);
        }

        .bc-body {
            padding: 18px 24px;
        }

        .bc-q-row {
            padding: 13px 0;
            border-bottom: 1px dashed #f0f4fb;
        }

        .bc-q-row:last-child {
            border-bottom: none;
        }

        .bc-q-num {
            font-size: 10px;
            font-weight: 700;
            color: #b0b8cc;
            text-transform: uppercase;
            letter-spacing: .7px;
            margin-bottom: 5px;
        }

        .bc-q-text {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--heading-color, #07112b);
            line-height: 1.5;
            margin-bottom: 8px;
        }

        /* ── FINAL CTA ── */
        .final-cta {
            background: #07112b;
            padding: 90px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .final-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 60% at 50% 120%, rgba(23, 92, 221, .3) 0%, transparent 65%);
            pointer-events: none;
        }

        .final-cta .container {
            position: relative;
        }

        .final-cta h2 {
            font-family: var(--heading-font);
            font-size: clamp(26px, 4vw, 40px);
            font-weight: 900;
            color: #fff;
            margin-bottom: 14px;
            letter-spacing: -.5px;
        }

        .final-cta>.container>p {
            font-size: 16px;
            color: rgba(255, 255, 255, .58);
            max-width: 500px;
            margin: 0 auto 34px;
            line-height: 1.7;
        }

        .trust-row {
            display: flex;
            justify-content: center;
            gap: 24px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 7px;
            color: rgba(255, 255, 255, .55);
            font-size: 13px;
        }

        .trust-item i {
            color: #60a5fa;
        }

        /* ── SCROLL TOP ── */
        .scroll-top-btn {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 46px;
            height: 46px;
            background: #175cdd;
            color: #fff;
            border-radius: 12px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 6px 22px rgba(23, 92, 221, .5);
            opacity: 0;
            pointer-events: none;
            transition: opacity .3s, transform .3s;
            z-index: 999;
        }

        .scroll-top-btn.show {
            opacity: 1;
            pointer-events: auto;
        }

        .scroll-top-btn:hover {
            transform: translateY(-3px);
        }

        /* Animations */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .au {
            animation: fadeUp .6s ease both;
        }

        .au-1 {
            animation-delay: .1s;
        }

        .au-2 {
            animation-delay: .2s;
        }

        .au-3 {
            animation-delay: .3s;
        }

        .au-4 {
            animation-delay: .45s;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .ts-body {
                flex-direction: column;
                gap: 14px;
            }

            .ts-emoji {
                font-size: 44px;
            }
        }

        @media (max-width: 768px) {
            .stat-grid-3 {
                grid-template-columns: 1fr 1fr;
            }

            .rh-ring {
                width: 160px;
                height: 160px;
            }

            .rh-ring-inner .rr-pct {
                font-size: 40px;
            }

            .rh-actions {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media print {

            .rh-actions,
            .final-cta,
            .scroll-top-btn {
                display: none !important;
            }

            .rh-hero {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>

    @php
        /* ════════════════════════════════════════════
           TALENT TYPES — used as FALLBACK when no
           TestResultRange is configured for this score
        ════════════════════════════════════════════ */
        $talentTypes = [
            'performer' => [
                'name' => 'The Performer',
                'emoji' => '🎭',
                'tagline' => 'Natural On-Screen Magnetism',
                'desc' => 'Your child has exceptional natural charisma and camera presence. They light up every room, command attention instinctively, and make every performance feel alive and genuine. They were born for the screen.',
                'course' => 'Screen Acting + Camera Techniques',
                'tags' => ['Charismatic', 'Camera-Ready', 'Energetic', 'Scene-Stealer'],
                'color' => '#175cdd',
            ],
            'empath' => [
                'name' => 'The Empath',
                'emoji' => '💙',
                'tagline' => 'Deep Emotional Expression',
                'desc' => 'Your child feels emotions profoundly and channels them into powerful, believable performances. Their ability to connect emotionally with characters and audiences is rare and extremely valuable in performing arts.',
                'course' => 'Screen Acting + Personality Development',
                'tags' => ['Deeply Feeling', 'Expressive', 'Authentic', 'Emotionally Intelligent'],
                'color' => '#7c3aed',
            ],
            'creator' => [
                'name' => 'The Creator',
                'emoji' => '✨',
                'tagline' => 'Storytelling & Wild Imagination',
                'desc' => "Your child's imagination is extraordinary. They invent entire worlds, create vivid characters, and bring total originality to everything they do. Storytelling is their superpower.",
                'course' => 'Theatre & Stage + Filmmaking',
                'tags' => ['Imaginative', 'Inventive', 'Original', 'Storyteller'],
                'color' => '#059669',
            ],
            'leader' => [
                'name' => 'The Leader',
                'emoji' => '👑',
                'tagline' => 'Stage Presence & Command',
                'desc' => 'Your child naturally commands attention and authority the moment they enter a room. They have powerful stage presence and the natural ability to lead an audience through any performance with total confidence.',
                'course' => 'Screen Acting + Public Speaking',
                'tags' => ['Commanding', 'Confident', 'Authoritative', 'Natural Leader'],
                'color' => '#d97706',
            ],
            'voice' => [
                'name' => 'The Voice',
                'emoji' => '🎤',
                'tagline' => 'Powerful Speech & Expression',
                'desc' => "Your child's greatest performing gift is their voice — its tone, clarity, and expressive range. They excel in dialogue delivery, public speaking, and voice-led performance of all kinds.",
                'course' => 'Public Speaking + Theatre & Stage',
                'tags' => ['Articulate', 'Persuasive', 'Expressive', 'Clear Communicator'],
                'color' => '#db2777',
            ],
            'director' => [
                'name' => 'The Director',
                'emoji' => '🎬',
                'tagline' => 'Vision, Craft & Filmmaking',
                'desc' => "Your child has the eye of a born director. They see the bigger picture, understand narrative structure, notice composition details others miss, and have a natural gift for guiding the creative process.",
                'course' => 'Filmmaking + Screen Acting',
                'tags' => ['Visionary', 'Strategic', 'Detail-Oriented', 'Big-Picture Thinker'],
                'color' => '#0891b2',
            ],
        ];

        $tt = $talentTypes[$topTypeKey] ?? $talentTypes['performer'];

        /* ════════════════════════════════════════════
           TestResultRange DATA
           ─────────────────────────────────────────
           $range comes from session (set in submit())
           It's a plain PHP array built from:
               TestResultRange::where('test_id', $id)
                   ->where('min_percent', '<=', $overallPct)
                   ->where('max_percent', '>=', $overallPct)
                   ->first()
           and stored as:
               'range' => [
                   'label'              => $range->label,
                   'emoji'              => $range->emoji,
                   'tagline'            => $range->tagline,
                   'description'        => $range->description,
                   'recommended_course' => $range->recommended_course,
                   'tags'               => $range->tags,   // cast as array in model
                   'color'              => $range->color,
                   'min_percent'        => $range->min_percent,
                   'max_percent'        => $range->max_percent,
               ]
           If no range matched → $range is null → fallback to talent type
        ════════════════════════════════════════════ */
        $hasRange = !empty($range);

        $displayLabel = $range['label'] ?? $tt['name'];
        $displayEmoji = $range['emoji'] ?? $tt['emoji'];
        $displayTagline = $range['tagline'] ?? $tt['tagline'];
        $displayDesc = $range['description'] ?? $tt['desc'];
        $displayCourse = $range['recommended_course'] ?? $tt['course'];
        $displayTags = !empty($range['tags']) ? $range['tags'] : $tt['tags'];
        $displayColor = $range['color'] ?? $tt['color'];
        $rangeMin = $range['min_percent'] ?? null;
        $rangeMax = $range['max_percent'] ?? null;

        /* Answer display maps (1-indexed to match scale 1–5) */
        $ansLabels = ['', 'Never', 'Rarely', 'Sometimes', 'Often', 'Always'];
        $ansEmoji = ['', '😟', '😐', '🙂', '😊', '🤩'];
        $ansBadge = ['', 'ans-never', 'ans-rarely', 'ans-sometimes', 'ans-often', 'ans-always'];
    @endphp

    <main class="main">

        {{-- ════════════════════════════════════════════
        HERO
        ════════════════════════════════════════════ --}}
        <section class="rh-hero">
            <div class="rh-hero-bg"></div>
            <div class="rh-hero-dots"></div>
            <div class="rh-hero-glow"></div>

            <div class="container">
                <div class="row align-items-center g-5">

                    {{-- LEFT: Text + badge --}}
                    <div class="col-lg-7">

                        <div class="rh-eyebrow au">
                            <span class="dot-live"></span>
                            Your Result is Ready
                        </div>

                        <h1 class="au au-1">
                            You're<br>
                            <span class="accent-text">{{ $displayLabel }}</span>!
                        </h1>

                        <p class="rh-tagline au au-2">{{ $displayTagline }}</p>

                        <div class="au au-2">
                            <div class="rh-badge">
                                <div class="badge-emoji">{{ $displayEmoji }}</div>
                                <div class="badge-meta">
                                    <small>Dominant Talent Type</small>
                                    <strong>{{ $displayLabel }}</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Range band pill — only shown when TestResultRange matched --}}
                        @if($hasRange && $rangeMin !== null && $rangeMax !== null)
                            <div class="au au-3">
                                <div class="range-info-strip">
                                    <i class="bi bi-shield-check-fill"></i>
                                    Personalised result · Score
                                    <strong style="color:#34d399;">{{ $overallPct }}%</strong>
                                    matched band
                                    <strong style="color:#34d399;">{{ $rangeMin }}%–{{ $rangeMax }}%</strong>
                                </div>
                            </div>
                        @endif

                        <div class="rh-actions au au-3">
                            <button class="rh-btn-primary" onclick="window.print()">
                                <i class="bi bi-printer"></i> Download Report
                            </button>
                            <a href="https://wa.me/?text={{ urlencode('🎭 ' . $displayEmoji . ' ' . $displayLabel . ' — ' . $displayTagline . '! Free test: acttoaction.com') }}"
                                target="_blank" class="rh-btn-ghost">
                                <i class="bi bi-whatsapp"></i> Share
                            </a>
                            <a href="#" class="rh-btn-ghost">
                                <i class="bi bi-arrow-repeat"></i> Retake
                            </a>
                        </div>

                    </div>

                    {{-- RIGHT: Score ring --}}
                    <div class="col-lg-5 text-center au au-2">
                        <div class="rh-ring-wrap">
                            <div class="rh-ring" id="score-ring">
                                <div class="rh-ring-inner">
                                    <div class="rr-pct" id="ring-pct">0%</div>
                                    <div class="rr-label">Overall Score</div>
                                </div>
                            </div>
                        </div>
                        <p class="rh-ring-caption">
                            {{ $test->categories->flatMap->questions->count() }} questions answered ·
                            {{ $test->categories->count() }} sections completed
                        </p>
                    </div>

                </div>
            </div>
        </section>


        {{-- ════════════════════════════════════════════
        SECTION 1 — OVERALL RESULT SUMMARY
        Shows TestResultRange data if matched,
        otherwise falls back to talent type profile
        ════════════════════════════════════════════ --}}
        <section class="res-section bg-soft">
            <div class="container">

                <div class="sec-head">
                    <h2>Your Complete Result</h2>
                    <span class="sh-bar"></span>
                    <p>A full breakdown of your child's performing arts talent profile across all dimensions.</p>
                </div>

                <div class="row g-4 align-items-start">

                    {{-- LEFT: Type spotlight --}}
                    <div class="col-lg-7">

                        <div class="type-spotlight">
                            {{-- Coloured accent top bar using the range/talent color --}}
                            <div class="ts-accent-bar" style="background:{{ $displayColor }};"></div>
                            <div class="ts-body">
                                <div class="ts-emoji">{{ $displayEmoji }}</div>
                                <div class="ts-content">

                                    {{-- ✅ Source badge: DB range or fallback talent type --}}
                                    @if($hasRange)
                                        <div class="ts-source-badge db-source">
                                            <i class="bi bi-database-check"></i>
                                            Personalised Range · Admin Configured
                                        </div>
                                    @else
                                        <div class="ts-source-badge fallback-source">
                                            <i class="bi bi-stars"></i>
                                            Talent Type Profile
                                        </div>
                                    @endif

                                    <div class="ts-name">{{ $displayLabel }}</div>
                                    <div class="ts-tagline" style="color:{{ $displayColor }};">
                                        {{ $displayTagline }}
                                    </div>
                                    <p class="ts-desc">{{ $displayDesc }}</p>

                                    {{-- Tags --}}
                                    @if($displayTags)
                                        <div class="ts-tags">
                                            @foreach((array) $displayTags as $tag)
                                                <span class="ts-tag"
                                                    style="color:{{ $displayColor }};
                                                                                                                                             border-color:{{ $displayColor }}33;
                                                                                                                                             background:{{ $displayColor }}0e;">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- ✅ Show score band info when range matched --}}
                                    @if($hasRange && $rangeMin !== null && $rangeMax !== null)
                                        <div class="range-band">
                                            <i class="bi bi-bar-chart-fill"></i>
                                            Your score: <strong>{{ $overallPct }}%</strong>
                                            &nbsp;·&nbsp; Matched band: <strong>{{ $rangeMin }}%–{{ $rangeMax }}%</strong>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        {{-- Stats --}}
                        <div class="stat-grid-3">
                            <div class="stat-tile">
                                <div class="st-val" style="color:{{ $displayColor }};">{{ $overallPct }}%</div>
                                <div class="st-lbl">Overall Score</div>
                            </div>
                            <div class="stat-tile">
                                <div class="st-val">{{ $test->categories->flatMap->questions->count() }}</div>
                                <div class="st-lbl">Questions Answered</div>
                            </div>
                            <div class="stat-tile">
                                <div class="st-val">{{ $test->categories->count() }}</div>
                                <div class="st-lbl">Sections Done</div>
                            </div>
                        </div>

                        {{-- ✅ Recommended course (from range or talent type) --}}
                        @if($displayCourse)
                            <div class="course-pill">
                                <div class="cp-icon">🎬</div>
                                <div>
                                    <h6>
                                        @if($hasRange)
                                            Admin-Recommended Course
                                        @else
                                            Suggested Course for Your Type
                                        @endif
                                    </h6>
                                    <p>{{ $displayCourse }}</p>
                                </div>
                            </div>
                        @endif

                    </div>

                    {{-- RIGHT: All 6 talent scores --}}
                    <div class="col-lg-5">
                        <div class="scores-card">
                            <div class="scores-card-head">
                                <div class="sch-icon">
                                    <i class="bi bi-bar-chart-steps"></i>
                                </div>
                                <div>
                                    <p class="sch-title">All 6 Talent Scores</p>
                                    <p class="sch-sub">Sorted highest to lowest</p>
                                </div>
                            </div>
                            <div class="scores-card-body">
                                @foreach(collect($typeScores)->sortDesc() as $key => $val)
                                    @php $t = $talentTypes[$key] ?? null; @endphp
                                    @if($t)
                                        <div class="score-row">
                                            <div class="score-row-head">
                                                <span class="sr-name">{{ $t['emoji'] }} {{ $t['name'] }}</span>
                                                <span class="sr-val" style="color:{{ $t['color'] }};">{{ $val }}%</span>
                                            </div>
                                            <div class="score-track">
                                                <div class="score-fill anim-bar" style="background:{{ $t['color'] }};"
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


        {{-- ════════════════════════════════════════════
        SECTION 2 — CATEGORY SCORES
        Each category card shows score + all
        question answers from $answers array
        ════════════════════════════════════════════ --}}
        <section class="res-section bg-white">
            <div class="container">

                <div class="sec-head">
                    <h2>Category-Wise Scores</h2>
                    <span class="sh-bar"></span>
                    <p>Performance across all {{ $chartData->count() }} test sections, with each question answered.</p>
                </div>

                <div class="row g-4">
                    @php $qIdx = 0; @endphp
                    @foreach($test->categories as $si => $cat)
                        @php
                            $catColor = $cat->color ?? ($chartData[$si]['color'] ?? '#175cdd');
                            $catIcon = $cat->icon ?? ($chartData[$si]['icon'] ?? '📋');
                            $catName = $cat->category_name ?? $cat->name ?? 'Section ' . ($si + 1);
                            $catScore = $chartData[$si]['score'] ?? 0;
                        @endphp
                        <div class="col-md-4">
                            <div class="cat-card">
                                <div class="cat-card-top" style="background:{{ $catColor }};">
                                    <div class="ct-icon">{{ $catIcon }}</div>
                                    <div class="ct-name">{{ $catName }}</div>
                                    <div class="ct-score">{{ $catScore }}%</div>
                                    <div class="ct-bar-wrap">
                                        <div class="ct-bar-fill cmc-fill" data-w="{{ $catScore }}"></div>
                                    </div>
                                </div>
                                <div class="cat-card-body">
                                    @foreach($cat->questions as $qi => $question)
                                        @php
                                            $ans = $answers[$qIdx] ?? 3;
                                            $qIdx++;
                                        @endphp
                                        <div class="q-item">
                                            <div class="q-dot" style="background:{{ $catColor }};"></div>
                                            <span class="q-text">{{ $question->question_text }}</span>
                                            <span class="q-badge {{ $ansBadge[$ans] ?? 'ans-sometimes' }}">
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


        {{-- ════════════════════════════════════════════
        SECTION 3 — DYNAMIC GRAPH (admin-selected)
        Admin sets graph_type per test in
        TestGraphConfig table. Options: bar, radar,
        pie, line, none
        ════════════════════════════════════════════ --}}
        @if(isset($graphType) && $graphType !== 'none')
            <section class="res-section bg-soft">
                <div class="container">

                    <div class="sec-head">
                        @php
                            $graphTitles = [
                                'bar' => '📊 Talent Bar Chart',
                                'radar' => '🕸️ Talent Radar',
                                'pie' => '🥧 Talent Distribution',
                                'line' => '📈 Performance Line',
                            ];
                        @endphp
                        <h2>{{ $graphTitles[$graphType] ?? '📊 Score Chart' }}</h2>
                        <span class="sh-bar"></span>
                        <p>Visual breakdown of your child's complete talent profile.</p>
                    </div>

                    <div class="scores-card" style="max-width:820px;margin:0 auto;">
                        <div class="scores-card-head">
                            <div class="sch-icon"><i class="bi bi-bar-chart-fill"></i></div>
                            <div>
                                <p class="sch-title">Score Breakdown Chart</p>
                                <p class="sch-sub">Visual representation of the full talent profile</p>
                            </div>
                        </div>
                        <div style="padding:28px;">
                            @include('frontend.graph.' . $graphType, ['chartData' => $chartData])
                        </div>
                    </div>

                </div>
            </section>
        @endif


        {{-- ════════════════════════════════════════════
        SECTION 4 — QUESTION-BY-QUESTION BREAKDOWN
        Detailed card per category showing every
        question and its answer label
        ════════════════════════════════════════════ --}}
        <section class="res-section bg-white">
            <div class="container">

                <div class="sec-head">
                    <h2>Question-by-Question Breakdown</h2>
                    <span class="sh-bar"></span>
                    <p>Every answer, section by section — so you know exactly what shaped this result.</p>
                </div>

                <div class="row g-4">
                    @php $qIdx2 = 0; @endphp
                    @foreach($test->categories as $si => $cat)
                        @php
                            $catColor = $cat->color ?? ($chartData[$si]['color'] ?? '#175cdd');
                            $catIcon = $cat->icon ?? ($chartData[$si]['icon'] ?? '📋');
                            $catName = $cat->category_name ?? $cat->name ?? 'Section ' . ($si + 1);
                            $catScore = $chartData[$si]['score'] ?? 0;
                        @endphp
                        <div class="col-lg-4">
                            <div class="breakdown-card" style="border-top: 4px solid {{ $catColor }};">
                                <div class="bc-top">
                                    <div class="bc-section-num">
                                        Section {{ $si + 1 }} of {{ $test->categories->count() }}
                                    </div>
                                    <h5>{{ $catIcon }} {{ $catName }}</h5>
                                    <div class="bc-score-row">
                                        <div class="bc-big-pct" style="color:{{ $catColor }};">
                                            {{ $catScore }}%
                                        </div>
                                        <div class="bc-track">
                                            <div class="bc-fill dct-fill" style="background:{{ $catColor }};"
                                                data-w="{{ $catScore }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bc-body">
                                    @foreach($cat->questions as $qi => $question)
                                        @php
                                            $ans = $answers[$qIdx2] ?? 3;
                                            $qIdx2++;
                                        @endphp
                                        <div class="bc-q-row">
                                            <div class="bc-q-num">Q{{ $qi + 1 }}</div>
                                            <div class="bc-q-text">{{ $question->question_text }}</div>
                                            <span class="q-badge {{ $ansBadge[$ans] ?? 'ans-sometimes' }}">
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


        {{-- ════════════════════════════════════════════
        FINAL CTA
        ════════════════════════════════════════════ --}}
        <section class="final-cta">
            <div class="container">
                <h2>Ready to Turn This Talent into a Career?</h2>
                <p>Book a free appointment — our expert coaches will guide your child to the perfect course based on these
                    personalised results.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank">
                        <button class="rh-btn-primary" style="font-size:15px;padding:14px 30px;">
                            <i class="bi bi-whatsapp"></i> Book Free Appointment
                        </button>
                    </a>
                    <a href="#">
                        <button class="rh-btn-ghost" style="font-size:15px;padding:13px 26px;">
                            <i class="bi bi-arrow-repeat"></i> Retake the Test
                        </button>
                    </a>
                </div>
                <div class="trust-row">
                    <div class="trust-item"><i class="bi bi-check-circle-fill"></i> No-risk 1-month trial</div>
                    <div class="trust-item"><i class="bi bi-check-circle-fill"></i> Only 20 seats per batch</div>
                    <div class="trust-item"><i class="bi bi-check-circle-fill"></i> Certificate on completion</div>
                    <div class="trust-item"><i class="bi bi-check-circle-fill"></i> Govt. registered institute</div>
                </div>
            </div>
        </section>

    </main>

    <button class="scroll-top-btn" id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const OVERALL = {{ $overallPct }};

        /* ── Score ring animated counter + conic fill ── */
        (function () {
            const ring = document.getElementById('score-ring');
            const label = document.getElementById('ring-pct');
            const color = '{{ $displayColor }}';

            setTimeout(() => {
                const deg = Math.round((OVERALL / 100) * 360);
                ring.style.background =
                    `conic-gradient(${color} ${deg}deg, rgba(255,255,255,.07) 0deg)`;
                ring.style.boxShadow =
                    `0 0 0 12px ${color}22, 0 0 60px ${color}55`;

                let c = 0;
                const iv = setInterval(() => {
                    c = Math.min(c + 1, OVERALL);
                    label.textContent = c + '%';
                    if (c >= OVERALL) clearInterval(iv);
                }, 15);
            }, 500);
        })();

        /* ── Scroll-triggered bar animations ── */
        const barObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.style.width = (e.target.dataset.w || 0) + '%';
                    barObs.unobserve(e.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll(
            '.anim-bar, .cmc-fill, .dct-fill, .bc-fill, .ct-bar-fill'
        ).forEach(el => barObs.observe(el));

        /* ── Scroll top button ── */
        window.addEventListener('scroll', () => {
            document.getElementById('scrollTopBtn')
                .classList.toggle('show', window.scrollY > 500);
        });
    </script>

@endsection