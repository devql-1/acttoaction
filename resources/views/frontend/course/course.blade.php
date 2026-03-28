@extends('frontend.course.layout')

@section('content')
    {{-- ══════════════════════════════════════════════════════════
     HOME PAGE — resources/views/frontend/Home/index.blade.php
     Variables: $featuredCourses, $categories, $allCourses
══════════════════════════════════════════════════════════ --}}
    <style>
        /* ═══ CSS VARIABLES ═══ */
        /* These were missing in the original courses CSS — added from healthcare CSS pattern */

        /* ═══ HERO ═══ */
        .hero-section {
            position: relative;
            min-height: 92vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(17, 35, 68, .93) 0%, rgba(17, 35, 68, .7) 55%, rgba(23, 92, 221, .45) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 100px 0 80px;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .25);
            color: #b8d4ff;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 22px;
            margin-bottom: 22px;
            text-transform: uppercase;
            letter-spacing: .7px;
            backdrop-filter: blur(6px);
        }

        .hero-section h1 {
            font-size: clamp(34px, 6vw, 68px);
            font-weight: 900;
            color: #fff;
            line-height: 1.08;
            margin-bottom: 20px;
            letter-spacing: -1px;
            font-family: var(--heading-font);
        }

        .hero-section h1 em {
            font-style: normal;
            color: #60a5fa;
            position: relative;
        }

        .hero-section h1 em::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #60a5fa, transparent);
            border-radius: 2px;
        }

        .hero-sub {
            font-size: 17px;
            color: rgba(255, 255, 255, .78);
            line-height: 1.75;
            max-width: 560px;
            margin-bottom: 34px;
        }

        .hero-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 32px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .18);
            color: rgba(255, 255, 255, .85);
            font-size: 13px;
            font-weight: 600;
            padding: 7px 15px;
            border-radius: 22px;
            backdrop-filter: blur(4px);
        }

        .pill i {
            color: #93c5fd;
        }

        .hero-actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        /* Fixed: was using --ac variable without declaring it — now uses explicit color with var() fallback */
        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--ac, #ff6a00);
            color: #fff;
            padding: 14px 30px;
            border-radius: 32px;
            font-weight: 700;
            font-size: 15px;
            font-family: var(--heading-font);
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, transform .15s;
            box-shadow: 0 8px 28px rgba(23, 92, 221, .4);
        }

        .btn-hero-primary:hover {
            background: #0f4ab8;
            transform: translateY(-2px);
            color: #fff;
        }

        .btn-hero-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #fff;
            padding: 13px 28px;
            border-radius: 32px;
            font-weight: 600;
            font-size: 15px;
            font-family: var(--heading-font);
            border: 2px solid rgba(255, 255, 255, .4);
            cursor: pointer;
            text-decoration: none;
            transition: border-color .2s, background .2s;
        }

        .btn-hero-outline:hover {
            border-color: #fff;
            background: rgba(255, 255, 255, .1);
            color: #fff;
        }

        .scroll-hint {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            color: rgba(255, 255, 255, .45);
            font-size: 12px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(6px);
            }
        }

        /* ═══ SECTION TITLE ═══ */
        /* Fixed: was missing padding-bottom, text-align structure aligned to healthcare CSS */
        .section-title {
            text-align: center;
            padding-bottom: 50px;
            position: relative;
        }

        .section-title .sh-label {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--ac, #ff6a00);
            background: #eff6ff;
            border: 1px solid #dbeafe;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .section-title h2 {
            font-size: clamp(26px, 4vw, 38px);
            font-weight: 900;
            color: var(--hc, #112344);
            margin-bottom: 12px;
            letter-spacing: -.5px;
            font-family: var(--heading-font);
        }

        .section-title h2 em {
            font-style: normal;
            color: var(--ac, #ff6a00);
        }

        .section-title p {
            font-size: 15.5px;
            color: #6b7280;
            max-width: 580px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Fixed: divider-line is now a proper block element, not a pseudo-element */
        .divider-line {
            display: block;
            width: 48px;
            height: 3px;
            background: var(--ac, #ff6a00);
            border-radius: 2px;
            margin: 14px auto 0;
        }

        /* ═══ CATEGORY TABS ═══ */
        .cat-tabs-wrap {
            background: #fff;
            border-bottom: 2px solid var(--border, #e4ecf8);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 20px rgba(17, 35, 68, .06);
        }

        .cat-tabs {
            display: flex;
            gap: 4px;
            padding: 12px 0;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .cat-tabs::-webkit-scrollbar {
            display: none;
        }

        .cat-tab {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-family: var(--nav-font);
            font-size: 13px;
            font-weight: 700;
            color: #6b7280;
            background: transparent;
            border: 1.5px solid transparent;
            border-radius: 25px;
            padding: 8px 18px;
            cursor: pointer;
            transition: color .2s, background .2s, border-color .2s;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .cat-tab:hover {
            color: var(--ac, #ff6a00);
            background: #eff6ff;
            border-color: #dbeafe;
        }

        .cat-tab.active {
            color: var(--ac, #ff6a00);
            background: #eff6ff;
            border-color: var(--ac, #ff6a00);
        }

        .tab-count {
            background: var(--ac, #ff6a00);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 1px 7px;
            border-radius: 10px;
        }

        .cat-tab.active .tab-count {
            background: var(--hc, #112344);
        }

        /* ═══ CATEGORY PANELS ═══ */
        .courses-panel {
            display: none;
            padding: 60px 0 40px;
        }

        .courses-panel.active {
            display: block;
            animation: fadeIn .3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Panel header */
        /* Fixed: removed broken ::before accent bar (had no background color set) */
        .panel-header {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 40px;
            padding: 28px 32px;
            background: var(--light-bg, #f8f9ff);
            border-radius: 20px;
            border: 1.5px solid var(--border, #e4ecf8);
            position: relative;
            overflow: hidden;
        }

        .panel-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--ac, #ff6a00);
            border-radius: 0;
        }

        .ph-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
            background: #eff6ff;
            color: var(--ac, #ff6a00);
        }

        .ph-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 5px;
            color: var(--ac, #ff6a00);
        }

        .panel-header h2 {
            font-size: 22px;
            font-weight: 800;
            color: var(--hc, #112344);
            margin-bottom: 6px;
            font-family: var(--heading-font);
        }

        .panel-header p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.65;
            margin: 0;
        }

        /* ═══ COURSE CARDS ═══ */
        /* Fixed: removed duplicate box-shadow on non-hover state; border pattern aligned to healthcare CSS */
        .course-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid var(--border, #e4ecf8);
            overflow: hidden;
            transition: box-shadow .25s, transform .2s, border-color .25s;
            margin-bottom: 28px;
        }

        .course-card:hover {
            box-shadow: 0 20px 60px rgba(23, 92, 221, .12);
            transform: translateY(-4px);
            border-color: var(--ac, #ff6a00);
        }

        .course-card.flagship:hover {
            transform: translateY(-5px);
        }

        .c-banner {
            position: relative;
            overflow: hidden;
        }

        .c-banner img {
            width: 100%;
            object-fit: cover;
            display: block;
            transition: transform .5s;
        }

        .course-card:hover .c-banner img {
            transform: scale(1.04);
        }

        .c-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .4px;
            background: var(--ac, #ff6a00);
        }

        .c-mode {
            position: absolute;
            bottom: 14px;
            right: 14px;
            background: rgba(17, 35, 68, .75);
            backdrop-filter: blur(6px);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 11px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .c-body {
            padding: 26px 28px;
        }

        .c-age {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--ac, #ff6a00);
            background: #eff6ff;
            padding: 3px 10px;
            border-radius: 12px;
            margin-bottom: 10px;
        }

        .c-body h4 {
            font-size: 20px;
            font-weight: 800;
            color: var(--hc, #112344);
            line-height: 1.3;
            margin-bottom: 10px;
            font-family: var(--heading-font);
        }

        .c-desc {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.7;
            margin-bottom: 14px;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .c-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 18px;
        }

        .c-stats span {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            color: var(--hc, #112344);
            background: #f4f8ff;
            border: 1px solid var(--border, #e4ecf8);
            padding: 4px 11px;
            border-radius: 10px;
        }

        .c-stats span i {
            color: var(--ac, #ff6a00);
            font-size: 12px;
        }

        .c-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid #f0f4fb;
            gap: 12px;
            flex-wrap: wrap;
        }

        .c-price {
            font-family: var(--heading-font);
            font-size: 22px;
            font-weight: 900;
            color: var(--hc, #112344);
        }

        .c-price small {
            font-size: 12px;
            font-weight: 500;
            color: #9ca3af;
            display: block;
            margin-top: -2px;
        }

        .c-btn-enroll {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--ac, #ff6a00);
            color: #fff;
            padding: 11px 24px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 14px;
            font-family: var(--heading-font);
            text-decoration: none;
            transition: background .2s, transform .15s;
            box-shadow: 0 5px 18px rgba(23, 92, 221, .22);
        }

        .c-btn-enroll:hover {
            background: #0f4ab8;
            transform: translateY(-1px);
            color: #fff;
        }

        .center-tag {
            background: #eef2ff;
            color: #ff6a00;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Sessions panel */
        .sessions-panel {
            background: linear-gradient(135deg, #f8f9ff 0%, #eff6ff 100%);
            border-radius: 20px;
            padding: 28px 26px;
            height: 100%;
            border: 1.5px solid #dbeafe;
        }

        .sessions-panel h5 {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 16px;
            color: var(--hc, #112344);
            font-family: var(--heading-font);
        }

        .sessions-panel p {
            font-size: 13.5px;
            line-height: 1.75;
            color: #4b5563;
        }

        /* ═══ CATEGORY CARDS ═══ */
        .categories-section {
            padding: 80px 0;
            background: #fff;
        }

        .cat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
        }

        .cat-card {
            border-radius: 22px;
            overflow: hidden;
            border: 1.5px solid var(--border, #e4ecf8);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            transition: box-shadow .25s, transform .2s, border-color .25s;
            background: #fff;
            color: inherit;
        }

        .cat-card:hover {
            box-shadow: 0 24px 70px rgba(23, 92, 221, .14);
            transform: translateY(-6px);
            border-color: var(--ac, #ff6a00);
        }

        .card-img {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .55s;
        }

        .cat-card:hover .card-img img {
            transform: scale(1.07);
        }

        .img-scrim {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(17, 35, 68, .15) 0%, rgba(17, 35, 68, .72) 100%);
        }

        .top-badges {
            position: absolute;
            top: 14px;
            left: 14px;
            right: 14px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .prog-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .atp-b {
            background: var(--ac, #ff6a00);
            color: #fff;
        }

        .stp-b {
            background: #059669;
            color: #fff;
        }

        .count-pill {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 14px;
            backdrop-filter: blur(4px);
        }

        .bottom-row {
            position: absolute;
            bottom: 14px;
            left: 14px;
            right: 14px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 12px;
            backdrop-filter: blur(4px);
        }

        .card-body-inner {
            padding: 26px 28px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .cat-abbr-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .abbr-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--ac, #ff6a00);
        }

        .abbr-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--ac, #ff6a00);
        }

        .card-body-inner h3 {
            font-size: 20px;
            font-weight: 800;
            color: var(--hc, #112344);
            line-height: 1.3;
            margin-bottom: 10px;
            font-family: var(--heading-font);
        }

        .cat-desc {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.7;
            margin-bottom: 16px;
            flex: 1;
        }

        .feat-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 18px;
        }

        .fp {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 11px;
            border-radius: 10px;
            background: #f4f8ff;
            border: 1px solid var(--border, #e4ecf8);
            color: var(--hc, #112344);
        }

        .fp i {
            color: var(--ac, #ff6a00);
        }

        .card-cta-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-top: 14px;
            border-top: 1px solid #f0f4fb;
            margin-top: auto;
        }

        .card-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ac, #ff6a00);
            font-weight: 700;
            font-size: 14px;
            font-family: var(--heading-font);
            text-decoration: none;
            transition: gap .2s;
        }

        .card-cta-btn:hover {
            gap: 10px;
        }

        /* ═══ WHY SECTION ═══ */
        .why-section {
            padding: 80px 0;
            background: var(--light-bg, #f8f9ff);
        }

        /* Fixed: removed bare box-shadow on rest state; aligned hover to healthcare card pattern */
        .why-card {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid var(--border, #e4ecf8);
            padding: 28px;
            height: 100%;
            transition: box-shadow .25s, transform .2s, border-color .25s;
        }

        .why-card:hover {
            box-shadow: 0 14px 45px rgba(23, 92, 221, .1);
            transform: translateY(-4px);
            border-color: var(--ac, #ff6a00);
        }

        /* Fixed: why-icon was just a font-size with no container — aligned to healthcare .icon pattern */
        .why-icon {
            width: 60px;
            height: 60px;
            background: #eff6ff;
            border: 1.5px solid var(--border, #e4ecf8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: var(--ac, #ff6a00);
            margin-bottom: 18px;
            transition: background .25s, color .2s, border-color .2s;
        }

        .why-card:hover .why-icon {
            background: var(--ac, #ff6a00);
            color: #fff;
            border-color: var(--ac, #ff6a00);
        }

        .why-card h5 {
            font-size: 16px;
            font-weight: 800;
            color: var(--hc, #112344);
            margin-bottom: 9px;
            font-family: var(--heading-font);
        }

        .why-card p {
            font-size: 13.5px;
            color: #6b7280;
            line-height: 1.7;
            margin: 0;
        }

        /* ═══ GALLERY ═══ */
        .gallery-section {
            padding: 80px 0;
        }

        /* Fixed: aligned gallery-grid and gallery-item to healthcare CSS pattern */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto auto;
            gap: 12px;
        }

        .gallery-item {
            border-radius: 14px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            border: 1.5px solid var(--border, #e4ecf8);
        }

        .gallery-item.span-2 {
            grid-column: span 2;
        }

        .gallery-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform .5s;
        }

        .gallery-item.span-2 img {
            height: 220px;
        }

        .gallery-item:hover img {
            transform: scale(1.06);
        }

        .g-overlay {
            position: absolute;
            inset: 0;
            background: rgba(17, 35, 68, .4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .2s;
        }

        .gallery-item:hover .g-overlay {
            opacity: 1;
        }

        /* Fixed: icon was unstyled — aligned to healthcare overlay link pattern */
        .g-overlay a,
        .g-overlay-btn {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, .15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            backdrop-filter: blur(5px);
            transition: background .2s;
        }

        .g-overlay a:hover,
        .g-overlay-btn:hover {
            background: var(--ac, #ff6a00);
        }

        .g-overlay i {
            color: #fff;
            font-size: 20px;
        }

        .g-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(17, 35, 68, .85), transparent);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 14px 14px 10px;
            transform: translateY(100%);
            transition: transform .25s;
        }

        .gallery-item:hover .g-caption {
            transform: translateY(0);
        }

        /* ═══ TESTIMONIALS ═══ */
        .testimonials-section {
            padding: 80px 0;
            background: var(--light-bg, #f8f9ff);
        }

        /* Fixed: was missing box-shadow on non-hover, border alignment fixed */
        .testimonial-item {
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid var(--border, #e4ecf8);
            padding: 28px;
            height: 100%;
            transition: box-shadow .25s, border-color .25s;
            position: relative;
        }

        .testimonial-item:hover {
            box-shadow: 0 12px 40px rgba(23, 92, 221, .08);
            border-color: var(--ac, #ff6a00);
        }

        .stars {
            color: #f59e0b;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .testimonial-item blockquote {
            font-size: 14px;
            font-style: italic;
            color: var(--dc, #374151);
            line-height: 1.7;
            margin-bottom: 18px;
            padding: 0;
            border: none;
        }

        .t-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Fixed: .av had no fallback font stack */
        .av {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--ac, #ff6a00);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--heading-font, 'Nunito', sans-serif);
            font-weight: 700;
            font-size: 14px;
            color: #fff;
            flex-shrink: 0;
        }

        .t-author .name {
            font-size: 14px;
            font-weight: 700;
            color: var(--hc, #112344);
            display: block;
        }

        .t-author .role {
            font-size: 12px;
            color: #9ca3af;
        }

        .t-big-q {
            position: absolute;
            top: 18px;
            right: 20px;
            font-size: 52px;
            color: #f0f4fb;
            line-height: 1;
            font-family: Georgia, serif;
            font-weight: 900;
        }

        /* ═══ CTA BAND ═══ */
        .cta-band {
            position: relative;
            padding: 80px 0;
            overflow: hidden;
        }

        .cta-bg {
            position: absolute;
            inset: 0;
        }

        .cta-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .cta-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(17, 35, 68, .95) 0%, rgba(23, 92, 221, .88) 100%);
        }

        .cta-inner {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .cta-inner h2 {
            font-size: clamp(26px, 4vw, 44px);
            font-weight: 900;
            color: #fff;
            margin-bottom: 14px;
            font-family: var(--heading-font);
            letter-spacing: -.5px;
        }

        .cta-inner p {
            font-size: 17px;
            color: rgba(255, 255, 255, .75);
            max-width: 560px;
            margin: 0 auto 32px;
            line-height: 1.7;
        }

        .cta-btns {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-cta-solid {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: var(--ac, #ff6a00);
            padding: 14px 32px;
            border-radius: 32px;
            font-weight: 700;
            font-size: 15px;
            font-family: var(--heading-font);
            text-decoration: none;
            transition: background .2s, transform .15s;
            box-shadow: 0 8px 28px rgba(0, 0, 0, .2);
        }

        .btn-cta-solid:hover {
            background: #f0f5ff;
            transform: translateY(-2px);
            color: var(--ac, #ff6a00);
        }

        .btn-cta-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #fff;
            padding: 13px 30px;
            border-radius: 32px;
            font-weight: 600;
            font-size: 15px;
            font-family: var(--heading-font);
            text-decoration: none;
            border: 2px solid rgba(255, 255, 255, .45);
            transition: border-color .2s, background .2s;
        }

        .btn-cta-ghost:hover {
            border-color: #fff;
            background: rgba(255, 255, 255, .1);
            color: #fff;
        }

        /* ═══ FAQ ═══ */
        .faq-section {
            padding: 80px 0;
            background: #fff;
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Fixed: border-radius was not overriding Bootstrap — added !important for standalone use */
        .faq-item {
            background: #fff;
            border: 1.5px solid var(--border, #e4ecf8);
            border-radius: 14px;
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s;
        }

        .faq-item.open,
        .faq-item:hover {
            border-color: var(--ac, #ff6a00);
            box-shadow: 0 4px 20px rgba(23, 92, 221, .08);
        }

        .faq-q {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            background: transparent;
            border: none;
            padding: 18px 22px;
            font-family: var(--heading-font);
            font-size: 15px;
            font-weight: 700;
            color: var(--hc, #112344);
            cursor: pointer;
            text-align: left;
        }

        /* Fixed: icon rotation was missing transition */
        .faq-q i {
            color: var(--ac, #ff6a00);
            flex-shrink: 0;
            transition: transform .3s;
        }

        .faq-item.open .faq-q i {
            transform: rotate(180deg);
        }

        /* Fixed: max-height transition was too abrupt — eased properly */
        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: max-height .35s ease, padding .2s;
            padding: 0 22px;
            font-size: 14px;
            color: #6b7280;
            line-height: 1.7;
        }

        .faq-item.open .faq-a {
            max-height: 300px;
            padding: 0 22px 18px;
        }

        /* ═══ VIDEO SECTION ═══ */
        .video-section {
            padding: 80px 0;
            background: var(--light-bg, #f8f9ff);
        }

        /* Fixed: box-shadow was on rest state causing visual noise — moved to hover only */
        .video-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            border: 1.5px solid var(--border, #e4ecf8);
            transition: transform .25s, box-shadow .25s, border-color .25s;
            cursor: pointer;
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(23, 92, 221, .12);
            border-color: var(--ac, #ff6a00);
        }

        .vid-thumb {
            position: relative;
            overflow: hidden;
        }

        .vid-thumb img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .vid-play {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .25);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vid-play-btn {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .95);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .3);
        }

        .vid-play-btn i {
            color: #ff0000;
            font-size: 16px;
            margin-left: 3px;
        }

        .vid-duration {
            position: absolute;
            bottom: 7px;
            right: 9px;
            background: rgba(0, 0, 0, .8);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 4px;
        }

        .vid-info {
            padding: 13px 15px 16px;
        }

        .vid-info h5 {
            font-size: 13px;
            font-weight: 700;
            color: var(--hc, #112344);
            line-height: 1.45;
            margin-bottom: 5px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-family: var(--heading-font);
        }

        .vid-info p {
            font-size: 11.5px;
            color: #9ca3af;
            line-height: 1.5;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .vid-nav {
            display: flex;
            gap: 8px;
        }

        .vid-nav-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--ac, #ff6a00);
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .2s, transform .15s;
            flex-shrink: 0;
        }

        .vid-nav-btn:hover {
            background: #0f4ab8;
            transform: scale(1.05);
        }

        /* Video Modal */
        /* Fixed: display:none with align/justify won't work — use flex only when active */
        #videoModal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: rgba(0, 0, 0, .92);
            padding: 20px;
        }

        #videoModal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-inner {
            position: relative;
            width: 100%;
            max-width: 1100px;
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .modal-close-btn {
            position: absolute;
            top: -42px;
            right: 0;
            background: none;
            border: none;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
            line-height: 1;
            z-index: 1;
        }

        .modal-player {
            flex: 1;
            min-width: 0;
        }

        .vid-frame-wrap {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .5);
        }

        .vid-frame-wrap iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        #videoTitle {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            margin-top: 12px;
            line-height: 1.4;
        }

        .rec-sidebar {
            width: 300px;
            flex-shrink: 0;
            max-height: 78vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, .2) transparent;
        }

        .rec-label {
            color: rgba(255, 255, 255, .55);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .rec-item {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 8px;
            padding: 6px;
            transition: background .2s;
        }

        .rec-item:hover {
            background: rgba(255, 255, 255, .08);
        }

        .rec-thumb {
            position: relative;
            flex-shrink: 0;
            width: 120px;
        }

        .rec-thumb img {
            width: 120px;
            height: 68px;
            object-fit: cover;
            border-radius: 6px;
            display: block;
        }

        .rec-dur {
            position: absolute;
            bottom: 4px;
            right: 5px;
            background: rgba(0, 0, 0, .8);
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            padding: 1px 5px;
            border-radius: 3px;
        }

        .rec-play {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rec-play-btn {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .9);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rec-play-btn i {
            color: #ff0000;
            font-size: 10px;
            margin-left: 2px;
        }

        .rec-item-title {
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.4;
            margin: 0 0 3px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .rec-item-desc {
            color: rgba(255, 255, 255, .4);
            font-size: 11px;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ═══ CTA BAR ═══ */
        .cta-bar {
            background: linear-gradient(135deg, var(--hc, #112344) 0%, #1e3a8a 60%, var(--ac, #ff6a00) 100%);
            padding: 56px 0;
        }

        .cta-bar h3 {
            font-size: clamp(20px, 3vw, 28px);
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
            font-family: var(--heading-font);
        }

        .cta-bar p {
            font-size: 15px;
            color: rgba(255, 255, 255, .7);
            margin: 0;
            line-height: 1.6;
        }

        .btn-cta-wa {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: var(--hc, #112344);
            padding: 13px 28px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            font-family: var(--heading-font);
            text-decoration: none;
            transition: background .2s, transform .15s;
            box-shadow: 0 6px 24px rgba(0, 0, 0, .2);
        }

        .btn-cta-wa:hover {
            background: #f0f5ff;
            transform: translateY(-2px);
            color: var(--hc, #112344);
        }

        /* ═══ ANIMATIONS ═══ */

        /* --- Keyframes --- */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeLeft {
            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeRight {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.90);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* --- Base: hidden before scroll triggers .animated --- */
        .animate-up,
        .animate-down,
        .animate-left,
        .animate-right,
        .animate-fade,
        .animate-zoom {
            opacity: 0;
        }

        /* --- Triggered by IntersectionObserver adding .animated class in JS --- */
        .animate-up.animated {
            animation: fadeUp 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .animate-down.animated {
            animation: fadeDown 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .animate-left.animated {
            animation: fadeLeft 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .animate-right.animated {
            animation: fadeRight 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .animate-fade.animated {
            animation: fadeIn 0.60s ease both;
        }

        .animate-zoom.animated {
            animation: zoomIn 0.60s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        /* --- Stagger delay helpers (add to child elements) --- */
        .delay-1 {
            animation-delay: 0.10s !important;
        }

        .delay-2 {
            animation-delay: 0.20s !important;
        }

        .delay-3 {
            animation-delay: 0.30s !important;
        }

        .delay-4 {
            animation-delay: 0.40s !important;
        }

        .delay-5 {
            animation-delay: 0.50s !important;
        }

        .delay-6 {
            animation-delay: 0.60s !important;
        }

        /* --- Hero: animates on page load, no scroll trigger needed --- */
        .hero-eyebrow {
            animation: fadeDown 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.10s both;
        }

        .hero-section h1 {
            animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.25s both;
        }

        .hero-sub {
            animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.40s both;
        }

        .hero-pills {
            animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.50s both;
        }

        .hero-actions {
            animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.60s both;
        }

        /* --- Category tabs: stagger in on load --- */
        .cat-tab {
            animation: fadeDown 0.4s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .cat-tab:nth-child(1) {
            animation-delay: 0.05s;
        }

        .cat-tab:nth-child(2) {
            animation-delay: 0.10s;
        }

        .cat-tab:nth-child(3) {
            animation-delay: 0.15s;
        }

        .cat-tab:nth-child(4) {
            animation-delay: 0.20s;
        }

        .cat-tab:nth-child(5) {
            animation-delay: 0.25s;
        }

        .cat-tab:nth-child(6) {
            animation-delay: 0.30s;
        }

        /* --- Panel header: slide in when panel becomes active --- */
        .courses-panel.active .panel-header {
            animation: fadeRight 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        /* --- Section titles: triggered by .animated on the .section-title wrapper --- */
        .section-title.animated .sh-label {
            animation: fadeDown 0.50s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .section-title.animated h2 {
            animation: fadeUp 0.60s cubic-bezier(0.22, 1, 0.36, 1) 0.10s both;
        }

        .section-title.animated p {
            animation: fadeUp 0.60s cubic-bezier(0.22, 1, 0.36, 1) 0.20s both;
        }

        .section-title.animated .divider-line {
            animation: fadeIn 0.5s ease 0.15s both;
        }

        /* --- Cards: keep hover transitions clean alongside animation --- */
        .course-card,
        .cat-card,
        .why-card,
        .testimonial-item,
        .video-card {
            transition: box-shadow .25s, transform .2s, border-color .25s;
        }

        /* --- Gallery items: smooth reveal --- */
        .gallery-item {
            transition: transform .5s, border-color .3s;
        }

        /* --- Respect reduced-motion preference --- */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* ═══ RESPONSIVE ═══ */

        /* --- Tablet (≤991px) --- */
        @media (max-width: 991px) {
            .hero-content {
                padding: 80px 0 60px;
            }

            .cat-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }

            /* Video sidebar hidden on tablet — too narrow */
            .rec-sidebar {
                display: none;
            }

            /* Video modal goes full width */
            .modal-inner {
                flex-direction: column;
            }

            /* Video section: 2 columns on tablet */
            .video-section .col-lg-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* --- Mobile (≤768px) --- */
        @media (max-width: 768px) {

            /* Course card body */
            .c-body {
                padding: 18px;
            }

            /* Course card footer: stack price + button */
            .c-foot {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .c-btn-enroll {
                width: 100%;
                justify-content: center;
            }

            /* Panel header: stack icon + text */
            .panel-header {
                flex-direction: column;
                gap: 12px;
                padding: 20px;
            }

            /* Hero buttons: full width stacked */
            .hero-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-hero-primary,
            .btn-hero-outline {
                width: 100%;
                justify-content: center;
            }

            /* CTA band: stack text + button */
            .cta-bar {
                padding: 40px 0;
                text-align: center;
            }

            .cta-bar .text-lg-end {
                text-align: center !important;
                margin-top: 20px;
            }

            .btn-cta-wa {
                width: 100%;
                justify-content: center;
                margin-top: 16px;
            }

            /* CTA band buttons */
            .cta-btns {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-cta-solid,
            .btn-cta-ghost {
                width: 100%;
                justify-content: center;
            }

            /* Gallery: 2 columns */
            .gallery-grid {
                grid-template-columns: 1fr 1fr;
            }

            .gallery-item.span-2 {
                grid-column: span 2;
            }

            /* FAQ */
            .faq-q {
                font-size: 14px;
                padding: 16px 18px;
            }

            .faq-a {
                padding: 0 18px;
            }

            .faq-item.open .faq-a {
                padding: 0 18px 16px;
            }

            /* ── VIDEO / YOUTUBE SECTION ── */

            /* Stack all video cards full width */
            .video-section .col-lg-3,
            .video-section .col-md-4,
            .video-section [class*="col-"] {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 16px;
            }

            /* Video nav buttons center */
            .vid-nav {
                justify-content: center;
                margin-top: 16px;
            }

            /* Video section header row: stack */
            .video-section .d-flex {
                flex-direction: column;
                gap: 14px;
                align-items: flex-start;
            }

            /* Modal: full screen overlay */
            #videoModal {
                padding: 12px;
                padding-top: 56px;
                align-items: flex-start;
            }

            .modal-inner {
                flex-direction: column;
                max-width: 100%;
                width: 100%;
            }

            .modal-close-btn {
                top: -40px;
                right: 0;
                font-size: 24px;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.12);
                border-radius: 50%;
            }

            /* iframe wrapper already has aspect-ratio padding — ensure it's fluid */
            .vid-frame-wrap {
                border-radius: 8px;
            }

            /* Rec sidebar hidden on mobile too */
            .rec-sidebar {
                display: none;
            }
        }

        /* --- Small phone (≤480px) --- */
        @media (max-width: 480px) {

            /* Hero */
            .hero-section {
                min-height: 100svh;
            }

            .hero-content {
                padding: 70px 0 50px;
            }

            /* Gallery: single column */
            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .gallery-item,
            .gallery-item.span-2 {
                grid-column: span 1;
            }

            /* Category cards: single column */
            .cat-grid {
                grid-template-columns: 1fr;
            }

            /* Cat tabs: smaller text so more tabs fit */
            .cat-tabs {
                gap: 4px;
                padding: 10px 0;
            }

            .cat-tab {
                padding: 6px 12px;
                font-size: 12px;
            }

            /* Video: ensure aspect ratio on tiny screens */
            .vid-thumb img {
                height: auto;
                aspect-ratio: 16/9;
            }

            /* Video modal close button: bigger tap target */
            .modal-close-btn {
                width: 44px;
                height: 44px;
                top: -50px;
            }

            /* Testimonial card */
            .testimonial-item {
                padding: 20px 16px;
            }

            /* Sessions panel */
            .sessions-panel {
                padding: 20px 16px;
            }

            /* Why cards: reduce padding */
            .why-card {
                padding: 22px 18px;
            }
        }

        .fixedtmp {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * .4);
            padding-left: calc(var(--bs-gutter-x) * 1);
            margin-top: var(--bs-gutter-y);
        }
    </style>

    <main class="main">


        <section class="hero-section">
            <div class="hero-bg">
                <img src="https://images.unsplash.com/photo-1503095396549-807759245b35?w=1600&q=85" alt="Act to Action" />
            </div>
            <div class="container hero-content">
                <div class="row">
                    <div class="col-lg-7 fixedtmp">
                        <div class="hero-eyebrow"><i class="bi bi-mortarboard-fill"></i> Explore Our Programs</div>
                        <h1>Train. Perform.<br><em>Transform.</em></h1>
                        <p class="hero-sub">India's first screen acting school for children. Choose from our flagship
                            year-long program or focused short-term skill tracks designed for every young performer.</p>
                        <div class="hero-pills">
                            <div class="pill"><i class="bi bi-people-fill"></i> 1000+ Students</div>
                            <div class="pill"><i class="bi bi-award-fill"></i> 250+ Castings</div>
                            <div class="pill"><i class="bi bi-building"></i> {{ $allCourses->count() > 0 ? '6' : '6' }}
                                Centres</div>
                            <div class="pill"><i class="bi bi-collection"></i> {{ $allCourses->count() }} Courses</div>
                        </div>
                        <div class="hero-actions">
                            <a href="#categories" class="btn-hero-primary" onclick="smoothScroll(event,'categories')"><i
                                    class="bi bi-grid-3x3-gap-fill"></i> View Programs</a>
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" class="btn-hero-outline" target="_blank"><i
                                    class="bi bi-whatsapp"></i> Talk to Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-hint">
                <i class="bi bi-chevron-down" style="font-size:18px;"></i>
                <span>Scroll</span>
            </div>
        </section>

        <section class="categories-section" id="categories">
            <div class="container">
                <div class="section-title">
                    <div class="sh-label">Our Programs</div>
                    <h2>Choose Your <em>Program</em></h2>
                    <p>{{ $categories->count() }} distinct learning track{{ $categories->count() != 1 ? 's' : '' }} built
                        for different goals, age groups, and commitment levels.</p>

                </div>

                <div class="cat-grid">
                    @foreach ($categories as $ci => $category)
                        @php
                            $catCourses = $allCourses->where('category_id', $category->id);
                            $courseCount = $catCourses->count();
                            $firstCourse = $catCourses->first();
                            $badgeClass = $ci === 0 ? 'atp-b' : 'stp-b';
                            $badgeLabel = $ci === 0 ? 'Flagship Program' : 'Short Term';
                            $abbr =
                                strtoupper(preg_replace('/[^A-Z]/', '', $category->name)) ?:
                                strtoupper(substr($category->name, 0, 3));
                        @endphp

                        <a href="{{ route('course.show', $category->id) }}" class="cat-card">
                            <div class="card-img">
                                @if ($firstCourse && $firstCourse->banner_image)
                                    <img src="{{ asset($firstCourse->banner_image) }}" alt="{{ $category->name }}" />
                                @else
                                    <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=800&q=80"
                                        alt="{{ $category->name }}" />
                                @endif
                                <div class="img-scrim"></div>
                                <div class="top-badges">
                                    <span class="prog-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                                    <div class="count-pill"><i class="bi bi-collection"></i> {{ $courseCount }}
                                        Course{{ $courseCount != 1 ? 's' : '' }}</div>
                                </div>
                                <div class="bottom-row">
                                    @if ($firstCourse)
                                        @if ($firstCourse->duration)
                                            <span class="chip"><i class="bi bi-clock"></i>
                                                {{ $firstCourse->duration }}</span>
                                        @endif
                                        @if ($firstCourse->age_group)
                                            <span class="chip"><i class="bi bi-people"></i>
                                                {{ $firstCourse->age_group }}</span>
                                        @endif
                                        @if ($courseCount > 1)
                                            <span class="chip"><i class="bi bi-lightning"></i> {{ $courseCount }}
                                                Tracks</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="card-body-inner">
                                <div class="cat-abbr-row">
                                    <span class="abbr-dot"></span>
                                    <span class="abbr-label">{{ $abbr }}</span>
                                </div>
                                <h3>{{ $category->name }}</h3>
                                <p class="cat-desc">{!! Str::limit(strip_tags($category->description ?? ''), 160) !!}</p>
                                <div class="feat-pills">
                                    @foreach ($catCourses->take(4) as $fc)
                                        <span class="fp"><i class="bi bi-check-circle"></i>
                                            {{ Str::limit($fc->title, 18) }}</span>
                                    @endforeach
                                </div>
                                <div class="card-cta-row">
                                    <span class="card-cta-btn">Explore {{ $abbr }} <i
                                            class="bi bi-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>


        <section class="why-section">
            <div class="container">
                <div class="section-title">
                    <div class="sh-label">Why Act to Action</div>
                    <h2>Why Choose <em>Us?</em></h2>
                    <p>Trusted by 1000+ students and parents across Jaipur since 2019.</p>

                </div>
                <div class="row g-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="why-card animate-up">
                            <div class="why-icon">🎬</div>
                            <h5>Screen-First Curriculum</h5>
                            <p>Purpose-built for on-camera acting, digital auditions, and media — not just stage theatre.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="why-card animate-up">
                            <div class="why-icon">🏆</div>
                            <h5>250+ Casting Wins</h5>
                            <p>Students on Zee TV, Star Plus, OTT platforms, brand TVCs, and international productions.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="why-card animate-up">
                            <div class="why-icon">📍</div>
                            <h5>6 Centres in Jaipur</h5>
                            <p>Convenient locations in Vaishali Nagar, Malviya Nagar, Sitapura, Jagatpura & more.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="why-card animate-up">
                            <div class="why-icon">✅</div>
                            <h5>Startup India Certified</h5>
                            <p>Registered with Startup India & iStart Rajasthan. Aligned with NEP 2020 & Skill India.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="gallery-section" data-aos="fade-up">
            <div class="container">

                <div class="section-title text-center">
                    <div class="sh-label">Our Memories</div>
                    <h2>Event <em>Gallery</em></h2>

                    <p>Moments & highlights from our students, events and performances</p>
                </div>
                @include('frontend.partialspages.Gallery', [
                    'images' => $galleryImages,
                    'sectionTitle' => 'Event Highlights Gallery',
                    'sectionDesc' =>
                        'A glimpse into the magic of our past events — the smiles, the performances, and the unforgettable moments captured in every frame.',
                ])
            </div>
        </section>
        {{-- <section class="gallery-section">
            <div class="container">
                <div class="section-title">
                    <div class="sh-label">Behind the Scenes</div>
                    <h2>Life at <em>Act to Action</em></h2>
                    <p>Workshops, showcases, casting wins and everyday magic.</p>
                    <span class="divider-line"></span>
                </div>
                <div class="gallery-grid">
                    <div class="gallery-item span-2"><img
                            src="https://images.unsplash.com/photo-1503095396549-807759245b35?w=900&q=80"
                            alt="Performance" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Annual Graduation Showcase 2024</div>
                    </div>
                    <div class="gallery-item"><img
                            src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&q=80"
                            alt="Workshop" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Screen Acting Workshop</div>
                    </div>
                    <div class="gallery-item"><img
                            src="https://images.unsplash.com/photo-1549737221-bef65e2604a6?w=500&q=80"
                            alt="Kids Acting" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">DramATA 2025</div>
                    </div>
                    <div class="gallery-item"><img
                            src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?w=500&q=80"
                            alt="Summer Camp" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Summer Camp 2024</div>
                    </div>
                    <div class="gallery-item"><img
                            src="https://images.unsplash.com/photo-1560523159-4a9692d222ef?w=500&q=80" alt="Award" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Star Achievers Award Night</div>
                    </div>
                    <div class="gallery-item span-2"><img
                            src="https://images.unsplash.com/photo-1588702547954-4800eb827c08?w=900&q=80"
                            alt="Casting" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Behind the Camera — Mobile Filmmaking</div>
                    </div>
                </div>
            </div>
        </section> --}}


        <section class="testimonials-section">
            <div class="container">
                <div class="section-title">
                    <div class="sh-label">Parent Stories</div>
                    <h2>What <em>Parents Say</em></h2>
                    <p>Stories from families whose children trained with us.</p>

                </div>
                <div class="row g-4">
                    @php
                        $testimonials = [
                            [
                                'init' => 'PR',
                                'name' => 'Priya Rathore',
                                'role' => 'Parent · ATP Student, Age 8',
                                'stars' => 5,
                                'q' =>
                                    'My daughter joined ATP at age 7 and within 6 months she was shortlisted for a Zee TV audition. The confidence she has built here is beyond anything I expected from an acting school.',
                            ],
                            [
                                'init' => 'AK',
                                'name' => 'Amit Kumar',
                                'role' => 'Parent · STP Public Speaking, Age 14',
                                'stars' => 5,
                                'q' =>
                                    'The Short Term Program in Public Speaking completely transformed how my son communicates. He now speaks at school assemblies and has won two inter-school competitions since joining.',
                            ],
                            [
                                'init' => 'SM',
                                'name' => 'Sunita Meena',
                                'role' => 'Parent · STP Mythology, Age 5',
                                'stars' => 5,
                                'q' =>
                                    'The Mythology & Shlok program is a hidden gem. My 5-year-old now recites Bhagavad Gita shlokas and understands their meaning. Kritesh sir and the team are absolutely phenomenal.',
                            ],
                            [
                                'init' => 'DS',
                                'name' => 'Deepak Sharma',
                                'role' => 'Parent · ATP Student, Age 11',
                                'stars' => 5,
                                'q' =>
                                    'Aadvika has appeared in two brand campaigns after completing the ATP. The curriculum is incredibly thorough — from voice to on-camera presence to audition technique. World-class for Jaipur.',
                            ],
                            [
                                'init' => 'RG',
                                'name' => 'Rahul Gupta',
                                'role' => 'Parent · STP Filmmaking, Age 13',
                                'stars' => 5,
                                'q' =>
                                    'The Mobile Filmmaking STP gave my son a complete film shoot experience. He shot, directed, edited and screened his own short film at age 13. Kritesh sir makes it so hands-on and practical.',
                            ],
                            [
                                'init' => 'NJ',
                                'name' => 'Nisha Jain',
                                'role' => 'Parent · ATP Twins, Age 9',
                                'stars' => 5,
                                'q' =>
                                    'I enrolled my twins in the ATP and the transformation is visible in everything — their posture, their voice, how they connect with people. This school is genuinely changing young lives in Jaipur.',
                            ],
                        ];
                    @endphp
                    @foreach ($testimonials as $t)
                        <div class="col-md-6 col-lg-4">
                            <div class="testimonial-item animate-up">
                                <div class="t-big-q">"</div>
                                <div class="stars">
                                    @for ($s = 0; $s < $t['stars']; $s++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                </div>
                                <blockquote>{{ $t['q'] }}</blockquote>
                                <div class="t-author">
                                    <div class="av">{{ $t['init'] }}</div>
                                    <div>
                                        <span class="name">{{ $t['name'] }}</span>
                                        <span class="role">{{ $t['role'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <div class="cta-band">
            <div class="cta-bg">
                <img src="https://images.unsplash.com/photo-1598899134739-24c46f58b8c0?w=1400&q=60" alt="CTA" />
            </div>
            <div class="container cta-inner">
                <h2>Ready to Start the Journey?</h2>
                <p>Join 1000+ students already performing, growing and shining across Jaipur's biggest stages and
                    screens.
                </p>
                <div class="cta-btns">
                    <a href="#" class="btn-cta-solid"><i class="bi bi-person-plus-fill"></i> Enroll Now</a>
                    <a href="https://wa.me/message/PE3X4SUC2OJTB1" class="btn-cta-ghost" target="_blank"><i
                            class="bi bi-whatsapp"></i> Chat on WhatsApp</a>
                </div>
            </div>
        </div>


        <section class="video-section">
            <div class="container">
                <div class="section-title">
                    <div class="sh-label">Student Stories</div>
                    <h2>Course <em>Testimonials</em></h2>
                    <p>Real stories from our students and parents — straight from the heart.</p>

                </div>

                @include('frontend.partialspages.youtube', ['videos' => $videos])
            </div>
        </section>

        {{-- Modal --}}


        <div class="faq-section">
            <div class="container">
                <div class="section-title">
                    <div class="sh-label">Got Questions?</div>
                    <h2>Frequently Asked <em>Questions</em></h2>
                    <p>Everything you need to know before enrolling your child.</p>

                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-8">
                        <div class="faq-list">
                            @php
                                $faqs = [
                                    [
                                        'q' => 'What age groups are your courses designed for?',
                                        'a' =>
                                            'Our programmes cater to a wide range — the Actors Training Program is for ages 3–15, Writing for Screen and Mobile Filmmaking are for ages 8+, and Public Speaking & Podcasting is for ages 12–25. There is something for every child and young adult.',
                                    ],
                                    [
                                        'q' => 'Are classes available online or only offline?',
                                        'a' =>
                                            'We offer both online and offline modes depending on the programme. Most short courses are available online and offline, while the flagship Actors Training Program is primarily offline/hybrid. Check the mode badge on each course card for details.',
                                    ],
                                    [
                                        'q' => 'How do I enroll my child?',
                                        'a' =>
                                            'Simply click the Enroll Now button on any course card or WhatsApp us directly. Our team will guide you through the right course selection, batch availability, and payment process.',
                                    ],
                                    [
                                        'q' => 'What is included in the course fee?',
                                        'a' =>
                                            'The course fee covers all sessions, training materials, mentorship, and the final showcase or certification event. No hidden charges — what you see on the card is the complete fee.',
                                    ],
                                    [
                                        'q' => 'Do you provide a certificate after course completion?',
                                        'a' =>
                                            'Yes! Every student who completes the course receives an official Act to Action certificate of completion, along with a final showcase or screening experience they\'ll remember for life.',
                                    ],
                                    [
                                        'q' => 'How many students are there per batch?',
                                        'a' =>
                                            'We keep our batches small — typically 15 to 20 students — so every child receives personal attention and has ample time to perform, practice, and grow.',
                                    ],
                                ];
                            @endphp
                            @foreach ($faqs as $i => $faq)
                                <div class="faq-item {{ $i === 0 ? 'open' : '' }}">
                                    <button class="faq-q" onclick="toggleFaq(this)">
                                        {{ $faq['q'] }}
                                        <i class="bi bi-chevron-down"></i>
                                    </button>
                                    <div class="faq-a">{{ $faq['a'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="cta-bar">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-7">
                        <h3>Ready to Enroll Your Child?</h3>
                        <p>Next batch starting soon — limited seats. WhatsApp us and we'll guide you to the right
                            course.
                        </p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-cta-wa">
                            <i class="bi bi-whatsapp"></i> WhatsApp to Enroll
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="videoModal" onclick="closeVideo(event)">
            <div class="modal-inner" onclick="event.stopPropagation()">
                <button class="modal-close-btn" onclick="closeVideo()"><i class="bi bi-x-lg"></i></button>
                <div class="modal-player">
                    <div class="vid-frame-wrap">
                        <iframe id="videoFrame" src=""
                            allow="accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    <p id="videoTitle"></p>
                </div>
                <div class="rec-sidebar">
                    <p class="rec-label">Recommended</p>
                    <div id="recommendedList"></div>
                </div>
            </div>
        </div>

    </main>


    <script>
        const allVideos = {!! json_encode(array_values($videos)) !!};

        /* ── Panel tabs ── */
        function showPanel(id, btn) {
            document.querySelectorAll('.courses-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
            const panel = document.getElementById('panel-' + id);
            if (panel) panel.classList.add('active');
            if (btn) btn.classList.add('active');
            document.getElementById('cat-tabs-anchor').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        /* ── FAQ ── */
        function toggleFaq(btn) {
            const item = btn.closest('.faq-item');
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        }

        /* ── Video carousel ── */
        let vidIdx = 0;
        const VISIBLE = window.innerWidth < 768 ? 1 : window.innerWidth < 992 ? 2 : 4;
        const track = document.getElementById('vidTrack');
        const items = track ? track.querySelectorAll('[style*="flex:0"]') : [];
        const totalItems = items.length;
        const maxIdx = Math.max(0, totalItems - VISIBLE);

        function updateCarousel() {
            if (!track || totalItems === 0) return;
            const cardW = items[0].offsetWidth + 16;
            track.style.transform = `translateX(-${vidIdx * cardW}px)`;
            renderDots();
        }

        function renderDots() {
            const dotsEl = document.getElementById('vidDots');
            if (!dotsEl) return;
            const pages = maxIdx + 1;
            dotsEl.innerHTML = Array.from({
                    length: pages
                }, (_, i) =>
                `<button onclick="goVidPage(${i})" style="width:${i===vidIdx?'22px':'8px'};height:8px;border-radius:10px;border:none;background:${i===vidIdx?'var(--ac)':'#d1d5db'};transition:all .3s;cursor:pointer;padding:0;"></button>`
            ).join('');
        }

        function goVidPage(i) {
            vidIdx = i;
            updateCarousel();
        }

        document.getElementById('vidPrev')?.addEventListener('click', () => {
            if (vidIdx > 0) {
                vidIdx--;
                updateCarousel();
            }
        });
        document.getElementById('vidNext')?.addEventListener('click', () => {
            if (vidIdx < maxIdx) {
                vidIdx++;
                updateCarousel();
            }
        });

        window.addEventListener('load', () => {
            renderDots();
        });

        /* ── Video modal ── */
        function openVideo(videoId) {
            const modal = document.getElementById('videoModal');
            const frame = document.getElementById('videoFrame');
            const titleEl = document.getElementById('videoTitle');
            frame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
            const found = allVideos.find(v => v.id === videoId);
            titleEl.textContent = found ? found.title : '';
            buildRecommended(videoId);
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function buildRecommended(excludeId) {
            const list = document.getElementById('recommendedList');
            list.innerHTML = '';
            allVideos.filter(v => v.id !== excludeId).forEach(v => {
                const d = document.createElement('div');
                d.className = 'rec-item';
                d.onclick = () => switchVideo(v.id);
                d.innerHTML = `
      <div class="rec-thumb">
        <img src="${v.thumb}" alt="${v.title}">
        <div class="rec-dur">${v.duration || ''}</div>
        <div class="rec-play"><div class="rec-play-btn"><i class="bi bi-play-fill" style="color:#ff0000;font-size:10px;margin-left:2px;"></i></div></div>
      </div>
      <div style="flex:1;min-width:0;">
        <p class="rec-item-title">${v.title}</p>
        <p class="rec-item-desc">${v.desc}</p>
      </div>`;
                list.appendChild(d);
            });
        }

        function switchVideo(videoId) {
            document.getElementById('videoFrame').src =
                `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
            const found = allVideos.find(v => v.id === videoId);
            document.getElementById('videoTitle').textContent = found ? found.title : '';
            buildRecommended(videoId);
            document.getElementById('recommendedList').parentElement.scrollTop = 0;
        }

        function closeVideo(event) {
            if (event && event.target !== document.getElementById('videoModal')) return;
            document.getElementById('videoFrame').src = '';
            document.getElementById('videoModal').style.display = 'none';
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeVideo();
        });

        /* ── Smooth scroll ── */
        function smoothScroll(e, id) {
            e.preventDefault();
            document.getElementById(id)?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        /* ── Scroll reveal ── */
        const obs = new IntersectionObserver(entries => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = `fadeUp .55s ease ${i * 0.08}s forwards`;
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.animate-up, .cat-card, .why-card, .testimonial-item, .gallery-item').forEach(el => {
            el.style.opacity = '0';
            obs.observe(el);
        });
    </script>
@endsection
