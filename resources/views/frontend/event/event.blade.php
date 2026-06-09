@extends('frontend.course.layout')
@section('content')
    <style>
        /* ─── CSS Variable System ─── */

        .light-background {
            background: color-mix(in srgb, var(--accent-color), transparent 96%) !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--heading-font);
            color: var(--heading-color);
        }

        /* ─── HERO ─── */
        .hero-events {
            background: linear-gradient(135deg, var(--heading-color) 0%, #1a3a72 50%, var(--accent-color) 100%);
            padding: 195px 0 56px;
            position: relative;
            overflow: hidden;
        }

        .hero-events::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1503095396549-807759245b35?w=1400&q=70') center/cover;
            opacity: .1;
        }

        .hero-events .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .25);
            color: #b8d4ff;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: .6px;
            backdrop-filter: blur(4px);
        }

        .hero-events h1 {
            font-size: clamp(28px, 5vw, 52px);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 16px;
        }

        .hero-events h1 em {
            font-style: normal;
            color: #60a5fa;
        }

        .hero-events .hero-sub {
            font-size: 17px;
            color: rgba(255, 255, 255, .8);
            line-height: 1.7;
            max-width: 540px;
            margin-bottom: 30px;
        }

        .btn-primary-solid {
            background: var(--accent-color);
            color: #fff;
            padding: 13px 30px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            font-family: var(--heading-font);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s, transform 0.3s;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(23, 92, 221, 0.35);
        }

        .btn-primary-solid:hover {
            background: color-mix(in srgb, var(--accent-color), #000 15%);
            transform: translateY(-2px);
            color: #fff;
        }

        .btn-ghost {
            background: transparent;
            color: #fff;
            padding: 12px 26px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 15px;
            font-family: var(--heading-font);
            border: 2px solid rgba(255, 255, 255, .45);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: border-color 0.3s, background 0.3s;
            text-decoration: none;
        }

        .btn-ghost:hover {
            border-color: #fff;
            background: rgba(255, 255, 255, .1);
        }

        .hero-trust-row {
            display: flex;
            gap: 20px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .hero-trust-item {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            color: rgba(255, 255, 255, .75);
        }

        .hero-trust-item i {
            color: #60a5fa;
            font-size: 15px;
        }

        .hero-mosaic .mosaic-img {
            border-radius: 14px;
            overflow: hidden;
            height: 160px;
        }

        .hero-mosaic .mosaic-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* ─── STATS BAND ─── */
        .stats-band {
            background: linear-gradient(135deg, var(--heading-color) 0%, #dd6413 100%);
            padding: 50px 0;
        }

        .stat-box {
            text-align: center;
        }

        .stat-box .num {
            font-family: var(--heading-font);
            font-size: 42px;
            font-weight: 900;
            color: #fff;
            line-height: 1;
        }

        .stat-box .num span {
            color: #60a5fa;
        }

        .stat-box .lbl {
            font-size: 13px;
            color: rgba(255, 255, 255, .6);
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-top: 6px;
        }

        /* ─── SECTION TITLE ─── */
        .section-title {
            text-align: center;
            margin-bottom: 44px;
        }

        .section-title h2 {
            font-size: 32px;
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
            font-size: 16px;
            color: color-mix(in srgb, var(--default-color), transparent 25%);
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ─── FILTER TABS ─── */
        .filter-bar {
            padding: 0 0 32px;
        }

        .filter-btn {
            font-family: var(--nav-font);
            font-size: 13px;
            font-weight: 600;
            color: var(--default-color);
            background: color-mix(in srgb, var(--accent-color), transparent 96%);
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 80%);
            border-radius: 25px;
            padding: 7px 18px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--accent-color);
            color: #fff;
            border-color: var(--accent-color);
            box-shadow: 0 6px 20px rgba(23, 92, 221, 0.35);
        }

        /* ─── EVENT CARDS ─── */
        .events-section {
            padding: 70px 0;
            background: var(--background-color);
        }

        .event-card {
            background: var(--surface-color);
            border-radius: 18px;
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 85%);
            overflow: hidden;
            transition: box-shadow 0.3s, transform 0.3s, border-color 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            box-shadow: 0 18px 55px rgba(23, 92, 221, .13);
            transform: translateY(-6px);
            border-color: var(--accent-color);
        }

        .event-card-stripe {
            height: 5px;
            width: 100%;
        }

        .event-card-img {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .event-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s;
        }

        .event-card:hover .event-card-img img {
            transform: scale(1.06);
        }

        .event-cat-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 20px;
            letter-spacing: .4px;
        }

        .event-date-pill {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(17, 35, 68, .72);
            backdrop-filter: blur(5px);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .event-card-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .event-card-cat {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--accent-color);
            margin-bottom: 7px;
        }

        .event-card-body h5 {
            font-size: 18px;
            font-weight: 800;
            color: var(--heading-color);
            line-height: 1.3;
            margin-bottom: 9px;
        }

        .event-card-body p {
            font-size: 13.5px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            line-height: 1.6;
            margin-bottom: 14px;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .event-meta-row {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
        }

        .event-meta-item i {
            color: var(--accent-color);
        }

        .event-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 13px;
            border-top: 1px solid color-mix(in srgb, var(--accent-color), transparent 90%);
            margin-top: auto;
        }

        .event-sub-count {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
        }

        .view-details-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--accent-color);
            font-weight: 700;
            font-size: 13px;
            font-family: var(--heading-font);
            transition: gap 0.3s;
            text-decoration: none;
        }

        .view-details-link:hover {
            gap: 10px;
            color: color-mix(in srgb, var(--accent-color), transparent 25%);
        }

        /* Status badge colours */
        .status-upcoming {
            background: color-mix(in srgb, var(--accent-color), transparent 85%);
            color: var(--accent-color);
        }

        .status-ongoing {
            background: #dcfce7;
            color: #166534;
        }

        .status-past {
            background: color-mix(in srgb, var(--default-color), transparent 90%);
            color: color-mix(in srgb, var(--default-color), transparent 20%);
        }

        /* ─── WHY JOIN ─── */
        .why-section {
            padding: 70px 0;
            background: var(--background-color);
        }

        .why-card {
            background: var(--surface-color);
            border-radius: 14px;
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 85%);
            padding: 24px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            height: 100%;
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .why-card:hover {
            box-shadow: 0 10px 30px rgba(23, 92, 221, .1);
            transform: translateY(-4px);
            border-color: var(--accent-color);
        }

        .why-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--accent-color);
            flex-shrink: 0;
            transition: background 0.3s, color 0.3s;
        }

        .why-card:hover .why-icon {
            background: var(--accent-color);
            color: #fff;
        }

        .why-card h4 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--heading-color);
        }

        .why-card p {
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            line-height: 1.55;
            margin: 0;
        }

        /* ─── GALLERY ─── */
        .gallery-section {
            padding: 70px 0;
        }

        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .gallery-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(13, 23, 43, 0.7) 0%, transparent 60%);
            opacity: 0;
            display: flex;
            align-items: flex-end;
            padding: 14px;
            transition: opacity 0.3s;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay span {
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        /* ─── FOR SCHOOLS ─── */
        .business-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--heading-color) 0%, #1e3a8a 60%, var(--accent-color) 100%);
            position: relative;
            overflow: hidden;
        }

        .business-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1543269664-7eef42226a21?w=1400&q=50') center/cover;
            opacity: .06;
        }

        .biz-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #b8d4ff;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .business-section h2 {
            font-size: 36px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 14px;
        }

        .biz-p {
            font-size: 16px;
            color: rgba(255, 255, 255, .75);
            line-height: 1.7;
            margin-bottom: 28px;
            max-width: 520px;
        }

        .biz-feature-row {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .biz-ico {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #93c5fd;
            flex-shrink: 0;
            transition: background 0.3s;
        }

        .biz-feature-row:hover .biz-ico {
            background: rgba(255, 255, 255, .22);
        }

        .biz-feature-row h6 {
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .biz-feature-row p {
            color: rgba(255, 255, 255, .65);
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
        }

        .biz-stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .biz-stat-card {
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 16px;
            padding: 22px 18px;
            text-align: center;
            backdrop-filter: blur(4px);
            transition: background 0.3s, transform 0.3s;
        }

        .biz-stat-card:hover {
            background: rgba(255, 255, 255, .18);
            transform: translateY(-3px);
        }

        .biz-stat-card .bsn {
            font-family: var(--heading-font);
            font-size: 32px;
            font-weight: 900;
            color: #fff;
        }

        .biz-stat-card .bsn span {
            color: #60a5fa;
        }

        .biz-stat-card .bsl {
            font-size: 12px;
            color: rgba(255, 255, 255, .6);
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-top: 4px;
        }

        .btn-white-solid {
            background: #fff;
            color: var(--accent-color);
            padding: 13px 30px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            font-family: var(--heading-font);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s, transform 0.3s;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-white-solid:hover {
            background: color-mix(in srgb, #fff, transparent 8%);
            transform: translateY(-2px);
            color: var(--accent-color);
        }

        /* ─── TESTIMONIALS ─── */
        .testimonials-section {
            padding: 80px 0;
            background: var(--background-color);
        }

        .testimonial-item {
            background: var(--surface-color);
            border-radius: 16px;
            padding: 28px;
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 85%);
            transition: box-shadow 0.3s, transform 0.3s;
            position: relative;
            height: 100%;
        }

        .testimonial-item:hover {
            box-shadow: 0 10px 35px rgba(23, 92, 221, .09);
            transform: translateY(-4px);
        }

        .t-stars {
            color: #f59e0b;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .t-quote {
            font-size: 14px;
            line-height: 1.65;
            color: var(--default-color);
            font-style: italic;
            margin-bottom: 18px;
        }

        .t-footer {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--heading-font);
            font-weight: 700;
            font-size: 15px;
            color: #fff;
            flex-shrink: 0;
        }

        .t-author {
            font-weight: 700;
            font-size: 14px;
            color: var(--heading-color);
        }

        .t-role {
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
        }

        .t-big-quote {
            position: absolute;
            top: 16px;
            right: 18px;
            font-size: 38px;
            color: color-mix(in srgb, var(--accent-color), transparent 90%);
            line-height: 1;
        }

        /* ─── NEWSLETTER ─── */
        .newsletter-section {
            padding: 70px 0;
            background: var(--background-color);
            border-top: 1px solid color-mix(in srgb, var(--accent-color), transparent 85%);
        }

        .newsletter-box {
            background: color-mix(in srgb, var(--accent-color), transparent 94%);
            border-radius: 24px;
            padding: 52px 40px;
            text-align: center;
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 80%);
        }

        .newsletter-box h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 10px;
        }

        .newsletter-box p {
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            font-size: 15px;
            margin-bottom: 28px;
        }

        .newsletter-form {
            display: flex;
            gap: 10px;
            max-width: 480px;
            margin: 0 auto;
            flex-wrap: wrap;
            justify-content: center;
        }

        .newsletter-form input {
            flex: 1;
            min-width: 220px;
            padding: 13px 20px;
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 75%);
            border-radius: 30px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .newsletter-form input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent-color), transparent 85%);
        }

        /* ─── VIDEO CARDS ─── */
        .video-card {
            cursor: pointer;
            background: var(--surface-color);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .video-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(23, 92, 221, .15);
        }

        /* ─── VIDEO MODAL ─── */
        #videoModal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: rgba(0, 0, 0, .92);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* ─── VIDEO SECTION ─── */
        .video-section {
            padding: 70px 0;
            background: var(--background-color);
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .hero-mosaic {
                display: none !important;
            }

            .biz-stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .business-section h2 {
                font-size: 26px;
            }

            .stat-box .num {
                font-size: 32px;
            }

            .section-title h2 {
                font-size: 26px;
            }

            .newsletter-box {
                padding: 36px 24px;
            }

            /* Filter bar: scrollable row on tablet/mobile */
            .filter-bar {
                flex-direction: column !important;
                align-items: flex-start !important;
            }

            #filterBtns {
                flex-wrap: nowrap !important;
                overflow-x: auto;
                padding-bottom: 4px;
                scrollbar-width: none;
                -ms-overflow-style: none;
                max-width: 100%;
            }

            #filterBtns::-webkit-scrollbar {
                display: none;
            }

            .events-section {
                padding: 50px 0;
            }

            .why-section {
                padding: 50px 0;
            }

            .testimonials-section {
                padding: 54px 0;
            }

            .gallery-section {
                padding: 50px 0;
            }
        }

        @media (max-width: 576px) {
            .business-section h2 {
                font-size: 22px;
            }

            .stat-box .num {
                font-size: 28px;
            }

            .section-title h2 {
                font-size: 22px;
            }

            .hero-events {
                padding: 195px 0 40px;
            }

            .hero-events h1 {
                font-size: clamp(24px, 7vw, 36px);
            }

            .hero-events .hero-sub {
                font-size: 15px;
            }

            .hero-trust-row {
                gap: 10px;
            }

            .hero-trust-item {
                font-size: 12px;
            }

            .filter-btn {
                font-size: 12px;
                padding: 6px 14px;
                white-space: nowrap;
            }

            .event-card-body {
                padding: 16px;
            }

            .event-card-body h5 {
                font-size: 16px;
            }

            .newsletter-box {
                padding: 28px 16px;
            }

            .newsletter-box h3 {
                font-size: 22px;
            }

            .newsletter-form input {
                min-width: 0;
                width: 100%;
            }

            .events-section {
                padding: 40px 0;
            }

            .why-section {
                padding: 40px 0;
            }

            .gallery-section {
                padding: 40px 0;
            }

            .video-section {
                padding: 40px 0;
            }

            .business-section {
                padding: 52px 0;
            }

            .testimonials-section {
                padding: 44px 0;
            }

            .newsletter-section {
                padding: 44px 0;
            }

            .stats-band {
                padding: 36px 0;
            }

            .stat-box {
                margin-bottom: 8px;
            }
        }

        /* Video modal responsive layout */
        .video-modal-inner {
            position: relative;
            width: 100%;
            max-width: 1100px;
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .video-modal-main {
            flex: 1;
            min-width: 0;
        }

        .video-modal-recs {
            width: 300px;
            flex-shrink: 0;
            max-height: 75vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, .2) transparent;
        }

        @media (max-width: 900px) {
            .video-modal-inner {
                flex-direction: column;
                gap: 12px;
            }

            .video-modal-recs {
                width: 100%;
                max-height: 40vh;
                flex-shrink: 1;
            }
        }

        @media (max-width: 576px) {
            #videoModal {
                padding: 12px !important;
            }
        }
    </style>
    {{-- ══════════════════════════════════════════════════════
     EVENTS PAGE — Dynamic blade (design from static HTML)
══════════════════════════════════════════════════════ --}}



    <main class="main">

        {{-- ══════════════════════
       HERO
  ══════════════════════ --}}
        <section class="hero-events">
            <div class="container position-relative">
                <div class="row align-items-center g-5">
                    <div class="col-lg-7">
                        <div class="eyebrow"><i class="bi bi-calendar-star-fill"></i> Events & Programmes — Threat Expert
                        </div>
                        <h1>Where Cyber Talent Meets<br />the <em>Real World</em></h1>
                        <p class="hero-sub">From live CTF competitions and bootcamp graduation ceremonies to corporate
                            security workshops — Threat Expert hosts India's most practical cybersecurity events for
                            students, professionals, and organisations.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="https://wa.me/{{ $whatsappDigits }}" target="_blank" class="btn-primary-solid">
                                <i class="bi bi-whatsapp"></i> Register for an Event
                            </a>
                            <a href="#evSection" class="btn-ghost">
                                <i class="bi bi-grid-3x3-gap"></i> Browse All Events
                            </a>
                        </div>
                        <div class="hero-trust-row">
                            <div class="hero-trust-item"><i class="bi bi-check-circle-fill"></i> Free & Paid Events</div>
                            <div class="hero-trust-item"><i class="bi bi-people-fill"></i> 500+ Participants</div>
                            <div class="hero-trust-item"><i class="bi bi-building"></i> 20+ Partner Organisations</div>
                            <div class="hero-trust-item"><i class="bi bi-patch-check-fill"></i> Since 2020</div>
                        </div>
                    </div>
                            <div class="col-lg-5 d-none d-lg-flex hero-mosaic">
                        <div class="row g-3 w-100">
                            <div class="col-6">
                                <div class="mosaic-img"><img
                                        src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=400&q=80"
                                        alt="Cybersecurity CTF" /></div>
                            </div>
                            <div class="col-6">
                                <div class="mosaic-img" style="margin-top:22px;"><img
                                        src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400&q=80"
                                        alt="Training Workshop" /></div>
                            </div>
                            <div class="col-12">
                                <div class="mosaic-img" style="height:130px;"><img
                                        src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=600&q=80"
                                        alt="Graduation Ceremony" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- ══════════════════════
       EVENTS GRID
  ══════════════════════ --}}
        <section class="events-section" id="evSection">
            <div class="container">
                <div class="section-title">
                    <h2>All Events & Programmes</h2>
                    <p>Click any event to see full details, sub-events, and register.</p>
                </div>

                {{-- Filter bar --}}
                <div class="filter-bar d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex gap-2 flex-wrap" id="filterBtns">
                        <button class="filter-btn active" data-filter="all">All Events</button>
                        <button class="filter-btn" data-filter="upcoming">Upcoming</button>
                        <button class="filter-btn" data-filter="ongoing">Ongoing</button>
                        <button class="filter-btn" data-filter="past">Past</button>
                    </div>
                    <div style="font-size:13px;color:#6b7280;">
                        Showing <strong id="evCount">{{ $events->count() }}</strong> events
                    </div>
                </div>

                {{-- Cards --}}
                <div class="row g-4" id="eventsGrid">
                    @forelse($events as $index => $event)
                        @php
                            $start = \Carbon\Carbon::parse($event->event_date);
                            $end = $event->event_end_date
                                ? \Carbon\Carbon::parse($event->event_end_date)
                                : $start->copy()->endOfDay();
                            $now = now();

                            if ($now->lt($start)) {
                                $statusLabel = 'upcoming';
                                $statusText = 'Upcoming';
                                $statusIcon = 'bi-calendar-alt';
                            } elseif ($now->between($start, $end)) {
                                $statusLabel = 'ongoing';
                                $statusText = 'Ongoing';
                                $statusIcon = 'bi-calendar-check';
                            } else {
                                $statusLabel = 'past';
                                $statusText = 'Past';
                                $statusIcon = 'bi-calendar-x';
                            }

                            $stripes = [
                                'linear-gradient(90deg,#112344,#175cdd)',
                                'linear-gradient(90deg,#d97706,#fbbf24)',
                                'linear-gradient(90deg,#059669,#34d399)',
                                'linear-gradient(90deg,#7c3aed,#a78bfa)',
                                'linear-gradient(90deg,#0891b2,#22d3ee)',
                                'linear-gradient(90deg,#db2777,#f472b6)',
                            ];
                            $stripe = $stripes[$index % count($stripes)];

                            $subCount = $event->subEvents ? $event->subEvents->count() : 0;
                        @endphp

                        <div class="col-sm-6 col-xl-4 event-item" data-status="{{ $statusLabel }}">
                            <div class="event-card">
                                <div class="event-card-stripe" style="background:{{ $stripe }}"></div>
                                <div class="event-card-img">
                                    @if ($event->banner_image)
                                        <img src="{{ $event->banner_url }}" alt="{{ $event->title }}"
                                            loading="lazy" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=600&q=80';" />
                                    @else
                                        <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=600&q=80"
                                            alt="{{ $event->title }}" loading="lazy" />
                                    @endif
                                    <span class="event-cat-badge status-{{ $statusLabel }}">
                                        <i class="bi {{ $statusIcon }} me-1"></i>{{ $statusText }}
                                    </span>
                                    <span class="event-date-pill">
                                        <i class="bi bi-calendar3"></i>{{ $start->format('M j, Y') }}
                                    </span>
                                </div>
                                <div class="event-card-body">
                                    <div class="event-card-cat">
                                        @if ($event->category)
                                            {{ strtoupper($event->category->name) }}
                                        @else
                                            EVENT
                                        @endif
                                    </div>
                                    <h5>{{ $event->title }}</h5>
                                    <p>{!! Str::limit(strip_tags($event->description), 120) !!}</p>
                                    <div class="event-meta-row">
                                        @if ($event->venue)
                                            <div class="event-meta-item"><i
                                                    class="bi bi-geo-alt"></i>{{ Str::limit($event->venue, 25) }}</div>
                                        @endif
                                        @if ($event->age_group)
                                            <div class="event-meta-item"><i
                                                    class="bi bi-people"></i>{{ $event->age_group }}</div>
                                        @endif
                                    </div>
                                    <div class="event-card-footer">
                                        @if ($subCount > 0)
                                            <div class="event-sub-count">
                                                <i class="bi bi-collection-fill"></i>{{ $subCount }}
                                                Sub-Event{{ $subCount > 1 ? 's' : '' }}
                                            </div>
                                        @else
                                            <div></div>
                                        @endif
                                        <a href="{{ route('frontend.events.subevent', $event->slug) }}"
                                            class="view-details-link">
                                            View Details <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-calendar-x"
                                style="font-size:52px;color:#e5e7eb;display:block;margin-bottom:14px;"></i>
                            <h5 style="color:#9ca3af;font-weight:600;">No events available at the moment</h5>
                            <p style="color:#d1d5db;font-size:14px;">Check back soon for upcoming programmes!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- ══════════════════════
       WHY JOIN
  ══════════════════════ --}}
        <section class="why-section light-background">
            <div class="container">
                <div class="section-title">
                    <h2>Why Join Our Events</h2>
                    <p>More than just an event — a career-defining experience</p>
                </div>
                <div class="row g-4">
                    @foreach ([
            ['bi-people-fill', 'Network with Security Professionals', 'Meet like-minded security practitioners, form lasting professional bonds, and grow your network in a high-trust environment.'],
            ['bi-lightbulb-fill', 'Learn from Active Practitioners', 'Hands-on workshops and sessions led by certified ethical hackers and security experts designed to sharpen real skills.'],
            ['bi-trophy-fill', 'Compete & Get Recognised', 'From CTF challenges to live attack simulations — compete, prove your skills, and earn recognition on a national stage.'],
            ['bi-camera-fill', 'Capture the Experience', 'Professional event coverage, live highlights, and a gallery to relive every session and breakthrough moment.'],
            ['bi-patch-check-fill', 'Certified Participation', 'Every participant receives a Threat Expert certificate of participation recognising their involvement.'],
            ['bi-geo-alt-fill', 'Online & Offline Options', 'Events available both in-person at our Jaipur centre and online — so you can always participate from wherever you are.'],
        ] as [$icon, $title, $text])
                        <div class="col-lg-4 col-md-6">
                            <div class="why-card">
                                <div class="why-icon"><i class="bi {{ $icon }}"></i></div>
                                <div>
                                    <h4>{{ $title }}</h4>
                                    <p>{{ $text }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ══════════════════════
       GALLERY
  ══════════════════════ --}}
        <section class="gallery-section" data-aos="fade-up">
            <div class="container">
                <div class="section-title text-center">
                    <div class="sh-label">Our Highlights</div>
                    <h2>Event <em>Gallery</em></h2>
                    <p>Moments from our bootcamps, CTF competitions, lab sessions, and certification events.</p>
                </div>
                @include('frontend.partialspages.Gallery', [
                    'images' => $galleryImages,
                    'sectionTitle' => 'Event Highlights Gallery',
                    'sectionDesc' =>
                        'A glimpse into the world of Threat Expert events — the labs, the competitions, and the moments that shape India\'s next generation of cybersecurity professionals.',
                ])
            </div>
        </section>

        {{-- ══════════════════════
       FOR ORGANISATIONS
  ══════════════════════ --}}
        <section class="business-section">
            <div class="container position-relative">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="biz-badge"><i class="bi bi-buildings-fill me-1"></i> For Colleges &amp; Organisations
                        </div>
                        <h2>Bring Our Events to Your Campus or Office</h2>
                        <p class="biz-p">Want to host a CTF competition, cybersecurity awareness workshop, or bootcamp
                            graduation at your college or corporate office? We bring the full Threat Expert experience
                            directly to your team.</p>
                        @foreach ([['bi-calendar-check-fill', 'Custom Event Scheduling', 'Choose a date that works for your academic or corporate calendar — we\'ll come to you.'], ['bi-people-fill', 'Suitable for All Levels', 'From complete beginners to seasoned IT professionals — tailored sessions for every skill level.'], ['bi-award-fill', 'Certificates & Recognition', 'Every participant receives an official Threat Expert certificate of participation.']] as [$ico, $title, $text])
                            <div class="biz-feature-row">
                                <div class="biz-ico"><i class="bi {{ $ico }}"></i></div>
                                <div>
                                    <h6>{{ $title }}</h6>
                                    <p>{{ $text }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-4">
                            <a href="https://wa.me/{{ $whatsappDigits }}" target="_blank" class="btn-white-solid">
                                <i class="bi bi-whatsapp"></i> Talk to Our Team
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="biz-stats-grid">
                            <div class="biz-stat-card">
                                <div class="bsn">20<span>+</span></div>
                                <div class="bsl">Partner Organisations</div>
                            </div>
                            <div class="biz-stat-card">
                                <div class="bsn">2<span>+</span></div>
                                <div class="bsl">Training Centres</div>
                            </div>
                            <div class="biz-stat-card">
                                <div class="bsn">500<span>+</span></div>
                                <div class="bsl">Professionals Trained</div>
                            </div>
                            <div class="biz-stat-card">
                                <div class="bsn">100<span>%</span></div>
                                <div class="bsl">Placement Support</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ══════════════════════
       TESTIMONIALS
  ══════════════════════ --}}
        <section class="testimonials-section">
            <div class="container">
                <div class="section-title">
                    <h2>What Students &amp; Clients Say</h2>
                    <p>Real feedback from professionals, students, and organisations who've attended our events.</p>
                </div>
                <div class="row g-4">
                    @foreach ([['A', 'Arjun Mehta', 'Student · CTF Competition 2024', '"The CTF event at Threat Expert was unlike anything I\'d experienced. Real-world challenges, great mentors, and I walked away with skills I could apply immediately."'], ['V', 'Vikram Joshi', 'HR Director · Corporate Workshop', '"We hosted a cybersecurity awareness workshop through Threat Expert and the response from our staff was overwhelming. Engaging, practical, and brilliantly delivered."'], ['P', 'Pooja Tiwari', 'Alumni · Bootcamp Graduation', '"The graduation ceremony after completing my Cloud Security bootcamp was a proud moment. Threat Expert truly makes you feel valued and part of a professional community."']] as [$initial, $name, $role, $quote])
                        <div class="col-md-6 col-lg-4">
                            <div class="testimonial-item">
                                <div class="t-big-quote">"</div>
                                <div class="t-stars">
                                    @for ($s = 0; $s < 5; $s++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                </div>
                                <p class="t-quote">{{ $quote }}</p>
                                <div class="t-footer">
                                    <div class="avatar-circle">{{ $initial }}</div>
                                    <div>
                                        <div class="t-author">{{ $name }}</div>
                                        <div class="t-role">{{ $role }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ══════════════════════
       YOUTUBE / TESTIMONIALS
  ══════════════════════ --}}
        <section class="video-section">
            <div class="container">
                <div class="section-title" style="padding-bottom: 0px;">
                    <div class="sh-label">Event Testimonials</div>
                    <h2>Event <em>Testimonials</em></h2>
                    <p>Real stories from our event participants and corporate clients.</p>
                </div>
                @include('frontend.partialspages.youtube', ['videos' => $videos])
            </div>
        </section>

        {{-- ══════════════════════
       VIDEO MODAL
  ══════════════════════ --}}
        <div id="videoModal" onclick="closeVideo(event)"
            style="display:none;position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,.92);align-items:center;justify-content:center;padding:20px;">
            <div class="video-modal-inner" onclick="event.stopPropagation()">
                <button onclick="closeVideo()"
                    style="position:absolute;top:-40px;right:0;background:none;border:none;color:#fff;font-size:28px;cursor:pointer;line-height:1;z-index:1;">
                    <i class="fas fa-times"></i>
                </button>
                <div class="video-modal-main">
                    <div
                        style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:10px;box-shadow:0 20px 60px rgba(0,0,0,.5);">
                        <iframe id="videoFrame" src=""
                            style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    <p id="videoTitle" style="color:#fff;font-size:14px;font-weight:600;margin-top:12px;line-height:1.4;">
                    </p>
                </div>
                <div class="video-modal-recs">
                    <p
                        style="color:rgba(255,255,255,.6);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:12px;">
                        Recommended</p>
                    <div id="recommendedList"></div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════
       NEWSLETTER
  ══════════════════════ --}}
        <section class="newsletter-section">
            <div class="container">
                <div class="newsletter-box" data-newsletter data-source="event">
                    <h3>Stay Updated on All Events</h3>
                    <p>Get notified about upcoming CTF competitions, bootcamp schedules, and early registration slots before
                        anyone else.</p>
                    <div class="newsletter-form">
                        <input type="email" class="newsletter-email-input" placeholder="Enter your email address" />
                        <button type="button" class="btn-primary-solid newsletter-subscribe-btn"><i
                                class="bi bi-send-fill"></i> Subscribe</button>
                    </div>
                </div>
            </div>
        </section>

    </main>
    {{-- ══════════════════════════════════════
     SCRIPTS
══════════════════════════════════════ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/5.0.36/fancybox/fancybox.umd.js"></script>
    <script>
        /* ── Fancybox ── */
        Fancybox.bind('[data-fancybox="gallery"]', {
            Thumbs: {
                type: 'modern'
            },
            Toolbar: {
                display: {
                    left: ['infobar'],
                    middle: [],
                    right: ['slideshow', 'fullscreen', 'thumbs', 'close']
                }
            }
        });

        /* ── Filter tabs ── */
        document.querySelectorAll('#filterBtns .filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('#filterBtns .filter-btn').forEach(b => b.classList.remove(
                    'active'));
                this.classList.add('active');
                const f = this.dataset.filter;
                const items = document.querySelectorAll('.event-item');
                let shown = 0;
                items.forEach(item => {
                    const show = f === 'all' || item.dataset.status === f;
                    item.style.display = show ? '' : 'none';
                    if (show) shown++;
                });
                document.getElementById('evCount').textContent = shown;
            });
        });

        /* ── Gallery carousel ── */
        (function() {
            const track = document.getElementById('evTrack');
            const dotsEl = document.getElementById('evDots');
            if (!track) return;
            const slides = Array.from(track.children);
            let current = 0;

            function visible() {
                const w = track.parentElement.offsetWidth;
                return w < 576 ? 1 : w < 992 ? 2 : 3;
            }

            function maxIdx() {
                return Math.max(0, slides.length - visible());
            }

            function buildDots() {
                dotsEl.innerHTML = '';
                for (let i = 0; i <= maxIdx(); i++) {
                    const d = document.createElement('div');
                    d.style.cssText =
                        `width:8px;height:8px;border-radius:50%;cursor:pointer;transition:all .25s;display:inline-block;background:${i===0?'var(--accent-color)':'#ccc'}`;
                    d.addEventListener('click', () => goTo(i));
                    dotsEl.appendChild(d);
                }
            }

            function goTo(idx) {
                current = Math.max(0, Math.min(idx, maxIdx()));
                track.style.transform = `translateX(-${current * (slides[0].offsetWidth + 16)}px)`;
                Array.from(dotsEl.children).forEach((d, i) => {
                    d.style.background = i === current ? 'var(--accent-color)' : '#ccc';
                    d.style.transform = i === current ? 'scale(1.4)' : 'scale(1)';
                });
            }
            buildDots();
            setInterval(() => goTo(current + 1 > maxIdx() ? 0 : current + 1), 3500);
            window.addEventListener('resize', () => {
                buildDots();
                goTo(Math.min(current, maxIdx()));
            });
        })();

        /* ── Video carousel ── */
        (function() {
            const track = document.getElementById('vidTrack');
            const dotsEl = document.getElementById('vidDots');
            const prev = document.getElementById('vidPrev');
            const next = document.getElementById('vidNext');
            if (!track) return;
            const slides = Array.from(track.children);
            let current = 0;

            function visible() {
                const w = track.parentElement.offsetWidth;
                return w < 576 ? 1 : w < 992 ? 2 : 4;
            }

            function maxIdx() {
                return Math.max(0, slides.length - visible());
            }

            function buildDots() {
                dotsEl.innerHTML = '';
                for (let i = 0; i <= maxIdx(); i++) {
                    const d = document.createElement('div');
                    d.style.cssText =
                        `width:8px;height:8px;border-radius:50%;cursor:pointer;transition:all .25s;display:inline-block;background:${i===0?'var(--accent-color)':'#ccc'}`;
                    d.addEventListener('click', () => goTo(i));
                    dotsEl.appendChild(d);
                }
            }

            function goTo(idx) {
                current = Math.max(0, Math.min(idx, maxIdx()));
                track.style.transform = `translateX(-${current * (slides[0].offsetWidth + 16)}px)`;
                Array.from(dotsEl.children).forEach((d, i) => {
                    d.style.background = i === current ? 'var(--accent-color)' : '#ccc';
                    d.style.transform = i === current ? 'scale(1.4)' : 'scale(1)';
                });
            }
            prev && prev.addEventListener('click', () => goTo(current - 1));
            next && next.addEventListener('click', () => goTo(current + 1));
            buildDots();
            window.addEventListener('resize', () => {
                buildDots();
                goTo(Math.min(current, maxIdx()));
            });
        })();

        /* ── Video modal ── */

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
            if (e.key === 'Escape' && document.getElementById('videoModal').style.display === 'flex') {
                document.getElementById('videoFrame').src = '';
                document.getElementById('videoModal').style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    </script>
@endsection
