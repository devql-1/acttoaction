@extends('frontend.course.layout')
@section('content')

    <style>
        /* ─── CSS Variable System (Clinic / Bootstrap template) ─── */


        .light-background {
            --background-color: #f4f8ff;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--default-font);
            color: var(--default-color);
            background: var(--background-color);
        }

        a {
            text-decoration: none;
            color: inherit;
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

        /* ─── TOPBAR ─── */
        .topbar {
            background: var(--accent-color);
            padding: 7px 0;
            font-family: var(--nav-font);
            font-size: 13px;
            color: var(--contrast-color);
        }

        .topbar a {
            color: rgba(255, 255, 255, .85);
            transition: color .2s;
        }

        .topbar a:hover {
            color: #fff;
        }

        /* ─── HERO ─── */
        .hero-tests {
            background: var(--background-color);
            padding: 64px 0 48px;
            border-bottom: 2px solid #eef3fb;
        }

        .hero-tests .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #eff6ff;
            color: var(--accent-color);
            font-size: 12px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .hero-tests h1 {
            font-size: clamp(28px, 4.5vw, 48px);
            font-weight: 900;
            line-height: 1.15;
            color: var(--heading-color);
            margin-bottom: 16px;
        }

        .hero-tests h1 em {
            font-style: normal;
            color: var(--accent-color);
            position: relative;
        }

        .hero-tests h1 em::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 100%;
            height: 3px;
            background: var(--accent-color);
            border-radius: 2px;
            opacity: .35;
        }

        .hero-tests .hero-sub {
            font-size: 17px;
            color: #4b5563;
            line-height: 1.7;
            max-width: 560px;
            margin-bottom: 32px;
        }

        .hero-cta-row {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: center;
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
            transition: background .2s, transform .15s;
        }

        .btn-primary-solid:hover {
            background: #0f4ab8;
            transform: translateY(-2px);
            color: #fff;
        }

        .btn-ghost {
            background: transparent;
            color: var(--accent-color);
            padding: 12px 26px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 15px;
            font-family: var(--heading-font);
            border: 2px solid var(--accent-color);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background .2s, color .2s;
        }

        .btn-ghost:hover {
            background: var(--accent-color);
            color: #fff;
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
            color: #6b7280;
        }

        .hero-trust-item i {
            color: var(--accent-color);
            font-size: 15px;
        }

        /* hero illustration side */
        .hero-illustration {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .test-preview-stack {
            position: relative;
            width: 340px;
            height: 360px;
        }

        .preview-card {
            position: absolute;
            background: var(--surface-color);
            border-radius: 18px;
            padding: 20px 22px;
            box-shadow: 0 12px 40px rgba(17, 35, 68, .12);
            border: 1.5px solid #e4ecf8;
            transition: transform .3s;
        }

        .preview-card:hover {
            transform: scale(1.04);
        }

        .preview-card.pc1 {
            top: 0;
            left: 0;
            width: 200px;
            z-index: 3;
        }

        .preview-card.pc2 {
            top: 80px;
            right: 0;
            width: 190px;
            z-index: 2;
        }

        .preview-card.pc3 {
            bottom: 0;
            left: 30px;
            width: 210px;
            z-index: 1;
        }

        .pc-icon {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .pc-title {
            font-family: var(--heading-font);
            font-size: 13px;
            font-weight: 700;
            color: var(--heading-color);
        }

        .pc-sub {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 3px;
        }

        .pc-tag {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 10px;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .tag-free {
            background: #dcfce7;
            color: #16a34a;
        }

        .tag-quick {
            background: #eff6ff;
            color: var(--accent-color);
        }

        .tag-popular {
            background: #fef3c7;
            color: #d97706;
        }

        /* ─── DIVIDER ─── */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0 0 36px;
        }

        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e4ecf8;
        }

        .section-divider span {
            font-family: var(--nav-font);
            font-size: 12px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            white-space: nowrap;
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


        .section-title p {
            font-size: 16px;
            color: #6b7280;
            max-width: 560px;
            margin: 0 auto;
        }

        /* ─── TEST CARDS ─── */
        .tests-section {
            padding: 70px 0;
            background: var(--background-color);
        }

        .test-card {
            background: var(--surface-color);
            border-radius: 18px;
            padding: 0;
            border: 1.5px solid #e8edf5;
            overflow: hidden;
            transition: box-shadow .25s, transform .2s, border-color .25s;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .test-card:hover {
            box-shadow: 0 18px 55px rgba(23, 92, 221, .13);
            transform: translateY(-6px);
            border-color: var(--accent-color);
        }

        .test-card-top {
            padding: 28px 24px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex: 1;
            position: relative;
        }

        .test-card-stripe {
            height: 5px;
            width: 100%;
            border-radius: 18px 18px 0 0;
        }

        .test-icon-wrap {
            width: 80px;
            height: 80px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin-bottom: 16px;
            position: relative;
        }

        .test-card h5 {
            font-size: 17px;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 6px;
        }

        .test-card .test-tagline {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.55;
            margin-bottom: 14px;
        }

        .test-meta {
            display: flex;
            gap: 14px;
            justify-content: center;
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 8px;
        }

        .test-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .test-card-footer {
            padding: 14px 20px;
            border-top: 1px solid #f0f4fb;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .badge-free {
            background: #dcfce7;
            color: #16a34a;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .take-test-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--accent-color);
            font-weight: 700;
            font-size: 13px;
            font-family: var(--heading-font);
            transition: gap .2s;
        }

        .take-test-btn:hover {
            gap: 10px;
        }

        .popular-ribbon {
            position: absolute;
            top: -5px;
            right: 14px;
            background: #f59e0b;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 0 0 8px 8px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        /* ─── WHY OUR TESTS ─── */
        .why-tests-section {
            padding: 80px 0;
            background: var(--background-color);
        }

        .why-top-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #eff6ff;
            color: var(--accent-color);
            font-size: 12px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        /* Big feature card */
        .why-big-card {
            background: linear-gradient(135deg, var(--heading-color) 0%, #1a3a72 60%, #175cdd 100%);
            border-radius: 24px;
            padding: 52px 48px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 400px;
        }

        .why-big-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1516627145497-ae6968895b74?w=900&q=50') center/cover;
            opacity: .07;
        }

        .why-big-card .big-num {
            font-family: var(--heading-font);
            font-size: 80px;
            font-weight: 900;
            color: rgba(255, 255, 255, .08);
            line-height: 1;
            margin-bottom: -20px;
            position: relative;
        }

        .why-big-card h3 {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
            position: relative;
        }

        .why-big-card p {
            font-size: 15px;
            color: rgba(255, 255, 255, .72);
            line-height: 1.7;
            max-width: 440px;
            position: relative;
        }

        .why-big-card .accent-line {
            width: 48px;
            height: 3px;
            background: #60a5fa;
            border-radius: 2px;
            margin: 16px 0;
            position: relative;
        }

        /* Stat pills inside big card */
        .why-pill-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 28px;
            position: relative;
        }

        .why-pill {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .22);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 7px 16px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 7px;
            backdrop-filter: blur(4px);
        }

        .why-pill i {
            color: #60a5fa;
        }

        /* Small feature cards */
        .why-feat-card {
            background: var(--surface-color);
            border: 1.5px solid #e8edf5;
            border-radius: 18px;
            padding: 28px 24px;
            transition: box-shadow .25s, transform .2s, border-color .25s;
            height: 100%;
        }

        .why-feat-card:hover {
            box-shadow: 0 14px 44px rgba(23, 92, 221, .11);
            transform: translateY(-5px);
            border-color: var(--accent-color);
        }

        .why-feat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 18px;
        }

        .why-feat-card h5 {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 8px;
            color: var(--heading-color);
        }

        .why-feat-card p {
            font-size: 13.5px;
            color: #6b7280;
            line-height: 1.6;
            margin: 0;
        }

        .why-feat-card .feat-check-list {
            list-style: none;
            padding: 0;
            margin-top: 14px;
        }

        .why-feat-card .feat-check-list li {
            font-size: 13px;
            color: var(--default-color);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 7px;
        }

        .why-feat-card .feat-check-list li i {
            color: #16a34a;
            font-size: 13px;
            flex-shrink: 0;
        }

        /* Comparison table */
        .comparison-wrap {
            margin-top: 60px;
        }

        .comparison-table {
            background: var(--surface-color);
            border: 1.5px solid #e8edf5;
            border-radius: 20px;
            overflow: hidden;
        }

        .comp-header {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1fr;
            background: #f8faff;
            padding: 18px 24px;
            border-bottom: 1.5px solid #e8edf5;
        }

        .comp-header .ch {
            font-family: var(--heading-font);
            font-size: 13px;
            font-weight: 700;
            color: var(--heading-color);
        }

        .comp-header .ch.highlight {
            color: var(--accent-color);
        }

        .comp-row {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1fr;
            padding: 16px 24px;
            border-bottom: 1px solid #f0f4fb;
            align-items: center;
            transition: background .15s;
        }

        .comp-row:last-child {
            border-bottom: none;
        }

        .comp-row:hover {
            background: #fafcff;
        }

        .comp-row .cr-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--default-color);
        }

        .comp-row .cr-val {
            text-align: center;
            font-size: 14px;
            color: #9ca3af;
        }

        .comp-row .cr-val.yes {
            color: #16a34a;
            font-size: 18px;
        }

        .comp-row .cr-val.no {
            color: #ef4444;
            font-size: 18px;
        }

        .comp-row .cr-val.ata {
            color: var(--accent-color);
            font-weight: 700;
        }

        .ata-col {
            background: linear-gradient(180deg, #eff6ff 0%, #fff 100%);
            border-left: 2px solid #dbeafe;
            border-right: 2px solid #dbeafe;
        }

        /* Process steps */
        .process-section {
            margin-top: 60px;
        }

        .process-step {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 0;
            position: relative;
        }

        .process-line {
            position: absolute;
            left: 23px;
            top: 52px;
            width: 2px;
            height: calc(100% - 10px);
            background: linear-gradient(to bottom, var(--accent-color), #dbeafe);
            z-index: 0;
        }

        .step-num {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--accent-color);
            color: #fff;
            font-family: var(--heading-font);
            font-size: 16px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 14px rgba(23, 92, 221, .3);
        }

        .step-body {
            padding-bottom: 32px;
        }

        .step-body h5 {
            font-size: 16px;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 6px;
        }

        .step-body p {
            font-size: 13.5px;
            color: #6b7280;
            line-height: 1.6;
            margin: 0;
        }

        /* Result preview */
        .result-preview {
            background: linear-gradient(135deg, #f0f7ff 0%, #e8f0fe 100%);
            border-radius: 20px;
            padding: 36px 32px;
            border: 1.5px solid #dbeafe;
            text-align: center;
            height: 100%;
        }

        .result-preview .rp-icon {
            font-size: 48px;
            margin-bottom: 14px;
        }

        .result-preview h4 {
            font-size: 20px;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 10px;
        }

        .result-preview p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .result-tag-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .result-tag {
            background: #fff;
            border: 1.5px solid #dbeafe;
            color: var(--accent-color);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 12px;
        }

        /* ─── NEWS / IN THE NEWS ─── */
        .news-section {
            padding: 60px 0;
            background: #f4f8ff;
        }

        .news-label {
            font-family: var(--nav-font);
            font-size: 12px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Scrolling marquee logos */
        .logo-marquee-wrap {
            overflow: hidden;
            position: relative;
        }

        .logo-marquee-wrap::before,
        .logo-marquee-wrap::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 80px;
            z-index: 2;
        }

        .logo-marquee-wrap::before {
            left: 0;
            background: linear-gradient(to right, #f4f8ff, transparent);
        }

        .logo-marquee-wrap::after {
            right: 0;
            background: linear-gradient(to left, #f4f8ff, transparent);
        }

        .logo-marquee {
            display: flex;
            gap: 16px;
            animation: marquee 28s linear infinite;
            width: max-content;
        }

        .logo-marquee:hover {
            animation-play-state: paused;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .logo-pill {
            display: flex;
            align-items: center;
            gap: 9px;
            background: #fff;
            border: 1.5px solid #e0e8f5;
            border-radius: 10px;
            padding: 11px 22px;
            white-space: nowrap;
            font-family: var(--heading-font);
            font-size: 13px;
            font-weight: 700;
            color: var(--heading-color);
            transition: border-color .2s, box-shadow .2s;
        }

        .logo-pill:hover {
            border-color: var(--accent-color);
            box-shadow: 0 4px 18px rgba(23, 92, 221, .1);
        }

        .logo-pill i {
            font-size: 15px;
            color: var(--accent-color);
        }

        /* News quotes slider */
        .news-quotes {
            margin-top: 42px;
        }

        .quote-card {
            background: #fff;
            border: 1.5px solid #e0e8f5;
            border-radius: 16px;
            padding: 28px 30px;
            position: relative;
            height: 100%;
        }

        .quote-source {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--accent-color);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 12px;
            margin-bottom: 14px;
        }

        .quote-card blockquote {
            font-size: 14px;
            line-height: 1.65;
            color: var(--default-color);
            font-style: italic;
            margin: 0;
        }

        .quote-big {
            position: absolute;
            top: 14px;
            right: 18px;
            font-size: 40px;
            color: #e8edf5;
            line-height: 1;
        }

        /* ─── FOR SCHOOLS / BUSINESS ─── */
        .business-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--heading-color) 0%, #112344 60%, #2b539e 100%);
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
            font-size: 38px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 14px;
        }

        .business-section p {
            font-size: 16px;
            color: rgba(255, 255, 255, .75);
            line-height: 1.7;
            margin-bottom: 30px;
            max-width: 540px;
        }

        .biz-feature-row {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .biz-feature-row .biz-ico {
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
            transition: background .2s, transform .15s;
            cursor: pointer;
        }

        .btn-white-solid:hover {
            background: #f0f5ff;
            transform: translateY(-2px);
        }

        .biz-visual {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .biz-stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .biz-stat-card {
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 16px;
            padding: 24px 20px;
            text-align: center;
            backdrop-filter: blur(4px);
        }

        .biz-stat-card .bsn {
            font-family: var(--heading-font);
            font-size: 34px;
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

        /* ─── TESTIMONIALS ─── */
        .testimonials-section {
            padding: 80px 0;
            background: var(--background-color);
        }

        .testimonial-item {
            background: var(--surface-color);
            border-radius: 16px;
            padding: 28px;
            border: 1.5px solid #e8edf5;
            transition: box-shadow .2s;
            position: relative;
            height: 100%;
        }

        .testimonial-item:hover {
            box-shadow: 0 10px 35px rgba(23, 92, 221, .09);
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
            color: #9ca3af;
        }

        .t-big-quote {
            position: absolute;
            top: 16px;
            right: 18px;
            font-size: 38px;
            color: #f0f4fb;
        }

        /* ─── BLOG ─── */
        .blog-section {
            padding: 80px 0;
            background: #f4f8ff;
        }

        .blog-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1.5px solid #e8edf5;
            transition: box-shadow .25s, transform .2s;
            height: 100%;
        }

        .blog-card:hover {
            box-shadow: 0 12px 40px rgba(23, 92, 221, .1);
            transform: translateY(-4px);
        }

        .blog-img {
            width: 100%;
            height: 185px;
            object-fit: cover;
            display: block;
        }

        .blog-body {
            padding: 22px;
        }

        .blog-tag {
            display: inline-block;
            background: #eff6ff;
            color: var(--accent-color);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 10px;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 10px;
        }

        .blog-card h5 {
            font-size: 15px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 8px;
            color: var(--heading-color);
        }

        .blog-card p {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.55;
            margin-bottom: 12px;
        }

        .blog-by {
            font-size: 12px;
            color: #9ca3af;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .read-more-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--accent-color);
            font-weight: 600;
            font-size: 13px;
            margin-top: 10px;
            transition: gap .2s;
        }

        .read-more-link:hover {
            gap: 9px;
        }

        /* ─── NEWSLETTER ─── */
        .newsletter-section {
            padding: 70px 0;
            background: var(--background-color);
            border-top: 1px solid #eef3fb;
        }

        .newsletter-box {
            background: linear-gradient(135deg, #eff6ff 0%, #f4f8ff 100%);
            border-radius: 24px;
            padding: 52px 40px;
            text-align: center;
            border: 1.5px solid #dbeafe;
        }

        .newsletter-box h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 10px;
        }

        .newsletter-box p {
            color: #6b7280;
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
            border: 1.5px solid #dbeafe;
            border-radius: 30px;
            font-size: 14px;
            font-family: var(--default-font);
            outline: none;
            transition: border-color .2s;
        }

        .newsletter-form input:focus {
            border-color: var(--accent-color);
        }



        /* ─── SCROLL TOP ─── */
        .scroll-top {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 44px;
            height: 44px;
            background: var(--accent-color);
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

        @media (max-width: 768px) {


            .hero-tests h1 {
                font-size: 27px;
            }

            .test-preview-stack {
                display: none;
            }

            .business-section h2 {
                font-size: 26px;
            }

            .newsletter-box {
                padding: 36px 20px;
            }
        }
    </style>
    <main class="main">
        <div class="page-title"></div>

        {{-- ── HERO ── --}}
        <section class="hero-tests">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="eyebrow"><i class="bi bi-lightning-charge-fill"></i> Free Skill & Talent Assessments
                        </div>
                        <h1>We've got your child's <em>talent tests</em> down to a science</h1>
                        <p class="hero-sub">Accurate, insightful assessments for children aged 3–29 — discover acting
                            talent, personality type, confidence level, and the ideal skill course for your child.</p>
                        <div class="hero-cta-row">
                            <a href="#tests" class="btn-primary-solid">
                                <i class="bi bi-play-circle-fill"></i> Take a Free Test
                            </a>
                            <a href="#" class="btn-ghost">
                                <i class="bi bi-grid-3x3-gap"></i> View All Courses
                            </a>
                        </div>
                        <div class="hero-trust-row">
                            <div class="hero-trust-item"><i class="bi bi-check-circle-fill"></i> 100% Free</div>
                            <div class="hero-trust-item"><i class="bi bi-clock"></i> 5–10 min each</div>
                            <div class="hero-trust-item"><i class="bi bi-shield-check"></i> Expert designed</div>
                            <div class="hero-trust-item"><i class="bi bi-people-fill"></i> 1000+ taken</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-illustration">
                            <div class="test-preview-stack">
                                @php
                                    $heroCards = [
                                        ['icon' => '🎭', 'tag_class' => 'tag-popular', 'tag_text' => '⭐ Most Popular'],
                                        ['icon' => '🎯', 'tag_class' => 'tag-free', 'tag_text' => 'Free'],
                                        ['icon' => '💬', 'tag_class' => 'tag-quick', 'tag_text' => '5 mins'],
                                    ];
                                    $pcClasses = ['pc1', 'pc2', 'pc3'];
                                @endphp

                                @foreach($tests->take(3) as $i => $test)
                                    <div class="preview-card {{ $pcClasses[$i] }}">
                                        <div class="pc-icon">{{ $heroCards[$i]['icon'] }}</div>
                                        <div class="pc-title">{{ $test->test_name }}</div>
                                        <div class="pc-sub">{{ Str::limit($test->description, 50) }}</div>
                                        <span
                                            class="pc-tag {{ $heroCards[$i]['tag_class'] }}">{{ $heroCards[$i]['tag_text'] }}</span>
                                    </div>
                                @endforeach

                                {{-- Fallback placeholders if fewer than 3 tests --}}
                                @for($j = $tests->count(); $j < 3; $j++)
                                    <div class="preview-card {{ $pcClasses[$j] }}">
                                        <div class="pc-icon">{{ $heroCards[$j]['icon'] }}</div>
                                        <div class="pc-title">Coming Soon</div>
                                        <div class="pc-sub">New assessment coming soon</div>
                                        <span
                                            class="pc-tag {{ $heroCards[$j]['tag_class'] }}">{{ $heroCards[$j]['tag_text'] }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── TESTS GRID ── --}}
        <section class="tests-section" id="tests">
            <div class="container">
                <div class="section-title">
                    <h2>Tests & Assessments</h2>
                    <span class="divider-line"></span>
                    <p>Free, science-backed assessments designed by child development experts and professional acting
                        coaches.</p>
                </div>

                @if($tests->isEmpty())
                    <div class="text-center py-5">
                        <p style="color:#6b7280;font-size:16px;">No assessments available at the moment. Please check back soon!
                        </p>
                    </div>
                @else
                    <div class="row g-4">
                        @php
                            // {{-- Palette cycles through for visual variety --}}
                            $palettes = [
                                [
                                    'gradient' => 'linear-gradient(90deg,#175cdd,#60a5fa)',
                                    'icon_bg' => '#eff6ff',
                                    'icon' => '🎭',
                                    'badge_bg' => '#eff6ff',
                                    'badge_text' => '#175cdd',
                                ],
                                [
                                    'gradient' => 'linear-gradient(90deg,#7c3aed,#a78bfa)',
                                    'icon_bg' => '#f5f3ff',
                                    'icon' => '🌟',
                                    'badge_bg' => '#f5f3ff',
                                    'badge_text' => '#7c3aed',
                                ],
                                [
                                    'gradient' => 'linear-gradient(90deg,#059669,#34d399)',
                                    'icon_bg' => '#ecfdf5',
                                    'icon' => '🎯',
                                    'badge_bg' => '#ecfdf5',
                                    'badge_text' => '#059669',
                                ],
                                [
                                    'gradient' => 'linear-gradient(90deg,#d97706,#fbbf24)',
                                    'icon_bg' => '#fffbeb',
                                    'icon' => '💬',
                                    'badge_bg' => '#fffbeb',
                                    'badge_text' => '#d97706',
                                ],
                                [
                                    'gradient' => 'linear-gradient(90deg,#db2777,#f472b6)',
                                    'icon_bg' => '#fdf2f8',
                                    'icon' => '🎨',
                                    'badge_bg' => '#fdf2f8',
                                    'badge_text' => '#db2777',
                                ],
                                [
                                    'gradient' => 'linear-gradient(90deg,#0891b2,#22d3ee)',
                                    'icon_bg' => '#ecfeff',
                                    'icon' => '🏆',
                                    'badge_bg' => '#ecfeff',
                                    'badge_text' => '#0891b2',
                                ],
                            ];
                        @endphp

                        @foreach($tests as $index => $test)
                            @php
                                $palette = $palettes[$index % count($palettes)];
                                $isFirst = $index === 0;
                            @endphp

                            <div class="col-sm-6 col-lg-4">
                                <div class="test-card">
                                    <div class="test-card-stripe" style="background:{{ $palette['gradient'] }}"></div>
                                    <div class="test-card-top">

                                        {{-- Most Popular ribbon on first card --}}
                                        @if($isFirst)
                                            <div class="popular-ribbon">⭐ Most Popular</div>
                                        @endif

                                        <div class="test-icon-wrap" style="background:{{ $palette['icon_bg'] }};">
                                            {{ $palette['icon'] }}
                                        </div>

                                        <h5>{{ $test->test_name }}</h5>

                                        <p class="test-tagline">
                                            {{ $test->description ?? 'Discover your child\'s unique strengths and potential through this expert-designed assessment.' }}
                                        </p>

                                        <div class="test-meta">
                                            {{-- Duration --}}
                                            @if($test->duration)
                                                <span>
                                                    <i class="bi bi-clock"></i>
                                                    {{ $test->duration }} mins
                                                </span>
                                            @endif

                                            {{-- Questions count (from withCount) --}}
                                            <span>
                                                <i class="bi bi-question-circle"></i>
                                                {{ $test->questions_count }} question{{ $test->questions_count != 1 ? 's' : '' }}
                                            </span>

                                            {{-- Age range --}}
                                            @if($test->age)
                                                <span>
                                                    <i class="bi bi-people"></i>
                                                    Age {{ $test->age }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="test-card-footer">
                                        <span class="badge-free">Free</span>
                                        <a href="{{ route('quicktest.take', $test->id) }}" class="take-test-btn">
                                                        Take Test <i class="bi bi-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                        @endforeach
                            </div>
                @endif
                </div>
            </section>

            {{-- ── WHY OUR TESTS ARE THE BEST ── --}}
            <section class="why-tests-section">
                <div class="container">

                    <div class="text-center mb-5">
                        <div class="why-top-badge d-inline-flex"><i class="bi bi-patch-check-fill"></i> Science-Backed & Expert
                            Designed</div>
                        <h2 style="font-size:34px;font-weight:900;color:var(--heading-color);margin-bottom:12px;">Why Our Tests
                            Are the <span style="color:var(--accent-color)">Best</span> for Your Child</h2>
                        <p style="font-size:16px;color:#6b7280;max-width:580px;margin:0 auto;">Not just another online quiz —
                            our assessments are built by child psychologists, acting coaches, and neuro-development experts to
                            give you truly actionable insights.</p>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-lg-6">
                            <div class="why-big-card">
                                <div class="big-num">01</div>
                                <h3>Built by Child Development Experts</h3>
                                <div class="accent-line"></div>
                                <p>Every question is co-designed with Dr. Bhumika Soni (Child Neuro Therapist), Kritesh Agarwal
                                    (Filmmaker & Acting Coach), and child psychology professionals — not generic quiz templates.
                                    Each assessment measures real developmental indicators.</p>
                                <div class="why-pill-row">
                                    <div class="why-pill"><i class="bi bi-brain"></i> Neuro-Psychology Based</div>
                                    <div class="why-pill"><i class="bi bi-award"></i> Expert Validated</div>
                                    <div class="why-pill"><i class="bi bi-clipboard2-check"></i> 100% Free</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row g-4 h-100">
                                <div class="col-12">
                                    <div class="why-feat-card">
                                        <div class="why-feat-icon" style="background:#eff6ff;color:var(--accent-color);"><i
                                                class="bi bi-lightning-charge-fill"></i></div>
                                        <h5>Fast, Focused & Accurate</h5>
                                        <p>No 50-question marathon. Each test is 5–10 minutes — designed to get a precise,
                                            reliable result without losing a child's attention. Every question earns its place.
                                        </p>
                                        <ul class="feat-check-list">
                                            <li><i class="bi bi-check-circle-fill"></i> 5–10 minutes per test</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Age-appropriate language at every level
                                            </li>
                                            <li><i class="bi bi-check-circle-fill"></i> Immediate, detailed result report</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="why-feat-card">
                                        <div class="why-feat-icon" style="background:#ecfdf5;color:#059669;"><i
                                                class="bi bi-graph-up-arrow"></i></div>
                                        <h5>Actionable Results, Not Just Labels</h5>
                                        <p>We don't just tell you your child is "creative." We show you exactly which Act to
                                            Action course matches their profile — so every test leads to a real next step.</p>
                                        <ul class="feat-check-list">
                                            <li><i class="bi bi-check-circle-fill"></i> Personalised course recommendation</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Strength & growth area breakdown</li>
                                            <li><i class="bi bi-check-circle-fill"></i> Shareable PDF result report</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-sm-6 col-lg-3">
                            <div class="why-feat-card text-center">
                                <div class="why-feat-icon mx-auto" style="background:#f5f3ff;color:#7c3aed;"><i
                                        class="bi bi-shield-check"></i></div>
                                <h5>100% Free, Always</h5>
                                <p>Every single test on this page is completely free to take — no hidden fees, no credit card,
                                    no trial. Because every child deserves to discover their potential.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="why-feat-card text-center">
                                <div class="why-feat-icon mx-auto" style="background:#fffbeb;color:#d97706;"><i
                                        class="bi bi-people-fill"></i></div>
                                <h5>Trusted by 1000+ Families</h5>
                                <p>Parents across Jaipur and India have used our assessments to find the perfect course,
                                    discover hidden talent, and unlock their child's confidence.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="why-feat-card text-center">
                                <div class="why-feat-icon mx-auto" style="background:#fdf2f8;color:#db2777;"><i
                                        class="bi bi-mortarboard-fill"></i></div>
                                <h5>Aligned with NEP 2020</h5>
                                <p>Our assessments are built around the National Education Policy 2020 framework — holistic
                                    child development, skill-based learning, and creative intelligence.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="why-feat-card text-center">
                                <div class="why-feat-icon mx-auto" style="background:#ecfeff;color:#0891b2;"><i
                                        class="bi bi-phone-fill"></i></div>
                                <h5>Works on Any Device</h5>
                                <p>Take the test on a phone, tablet, or laptop — our tests are fully mobile-optimised so
                                    children can complete them comfortably from anywhere.</p>
                            </div>
                        </div>
                    </div>

                    <div class="comparison-wrap">
                        <h3 class="text-center mb-2" style="font-size:26px;font-weight:800;">How We Compare</h3>
                        <p class="text-center mb-4" style="color:#6b7280;font-size:15px;">See why Act to Action tests go far
                            beyond generic online quizzes.</p>
                        <div class="comparison-table">
                            <div class="comp-header">
                                <div class="ch">Feature</div>
                                <div class="ch highlight text-center">Act to Action ✦</div>
                                <div class="ch text-center" style="color:#9ca3af;">Generic Online Quiz</div>
                                <div class="ch text-center" style="color:#9ca3af;">Paid Assessment App</div>
                            </div>
                            @php
                                $compRows = [
                                    ['label' => 'Expert-designed questions', 'ata' => '✔ Yes', 'generic' => '✘', 'paid' => '✔'],
                                    ['label' => '100% Free', 'ata' => '✔ Yes', 'generic' => '✔', 'paid' => '✘ Paid'],
                                    ['label' => 'Child-specific (age 3–29)', 'ata' => '✔ Yes', 'generic' => '✘', 'paid' => '✘'],
                                    ['label' => 'Course recommendation included', 'ata' => '✔ Yes', 'generic' => '✘', 'paid' => '✘'],
                                    ['label' => 'Neuro-psychology backed', 'ata' => '✔ Yes', 'generic' => '✘', 'paid' => 'Sometimes'],
                                    ['label' => 'Links to real coaching & castings', 'ata' => '✔ Yes', 'generic' => '✘', 'paid' => '✘'],
                                    ['label' => 'Shareable PDF result report', 'ata' => '✔ Yes', 'generic' => '✘', 'paid' => 'Paid only'],
                                ];
                            @endphp
                            @foreach($compRows as $row)
                                <div class="comp-row">
                                    <div class="cr-label">{{ $row['label'] }}</div>
                                    <div class="cr-val yes ata">{{ $row['ata'] }}</div>
                                    <div class="cr-val {{ str_starts_with($row['generic'], '✘') ? 'no' : 'yes' }}">
                                        {{ $row['generic'] }}</div>
                                    <div class="cr-val {{ str_starts_with($row['paid'], '✘') ? 'no' : (str_starts_with($row['paid'], '✔') ? 'yes' : '') }}"
                                        @if(!str_starts_with($row['paid'], '✘') && !str_starts_with($row['paid'], '✔'))
                                        style="color:#d97706;" @endif>
                                        {{ $row['paid'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row g-5 mt-2 align-items-start">
                        <div class="col-lg-6">
                            <h3 style="font-size:24px;font-weight:800;margin-bottom:30px;">How It Works — 3 Simple Steps</h3>
                            <div class="process-section">
                                <div style="position:relative;">
                                    <div class="process-step">
                                        <div class="step-num">1</div>
                                        <div class="step-body">
                                            <h5>Choose Your Test</h5>
                                            <p>Pick the assessment that matches what you want to discover — acting talent,
                                                confidence level, personality type, or the right course. All free, no sign-up
                                                needed.</p>
                                        </div>
                                    </div>
                                    <div class="process-line" style="top:46px;height:60px;"></div>
                                    <div class="process-step" style="margin-top:8px;">
                                        <div class="step-num">2</div>
                                        <div class="step-body">
                                            <h5>Answer 10–20 Quick Questions</h5>
                                            <p>Fun, engaging questions designed for children and parents to answer together.
                                                Takes just 5–10 minutes. No wrong answers — just honest responses!</p>
                                        </div>
                                    </div>
                                    <div class="process-line" style="top:130px;height:60px;left:23px;position:absolute;"></div>
                                    <div class="process-step" style="margin-top:8px;">
                                        <div class="step-num">3</div>
                                        <div class="step-body">
                                            <h5>Get Your Personalised Report</h5>
                                            <p>Instantly receive a detailed result — your child's strengths, growth areas,
                                                personality profile, and the exact Act to Action course recommended for them.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <a href="#tests" class="btn-primary-solid mt-3" style="display:inline-flex;">
                                    <i class="bi bi-play-circle-fill"></i> Start a Free Test Now
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="result-preview">
                                <div class="rp-icon">📊</div>
                                <h4>Your Child's Result Report</h4>
                                <p>After completing any test, you get an instant, personalised report like this — broken down
                                    into easy-to-understand scores and clear next steps.</p>
                                <div
                                    style="background:#fff;border-radius:14px;padding:20px;margin-bottom:18px;border:1.5px solid #dbeafe;text-align:left;">
                                    <div
                                        style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                                        <span
                                            style="font-family:var(--heading-font);font-weight:700;font-size:14px;color:var(--heading-color);">Acting
                                            Talent Score</span>
                                        <span style="font-weight:800;font-size:18px;color:var(--accent-color);">87%</span>
                                    </div>
                                    <div style="background:#e8edf5;border-radius:8px;height:8px;overflow:hidden;">
                                        <div
                                            style="width:87%;height:100%;background:linear-gradient(90deg,var(--accent-color),#60a5fa);border-radius:8px;">
                                        </div>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;margin-top:14px;gap:8px;">
                                        <div style="text-align:center;flex:1;">
                                            <div style="font-size:18px;font-weight:800;color:#059669;">High</div>
                                            <div style="font-size:11px;color:#9ca3af;text-transform:uppercase;">Emotional Range
                                            </div>
                                        </div>
                                        <div style="text-align:center;flex:1;">
                                            <div style="font-size:18px;font-weight:800;color:#d97706;">Medium</div>
                                            <div style="font-size:11px;color:#9ca3af;text-transform:uppercase;">Stage Confidence
                                            </div>
                                        </div>
                                        <div style="text-align:center;flex:1;">
                                            <div style="font-size:18px;font-weight:800;color:var(--accent-color);">High</div>
                                            <div style="font-size:11px;color:#9ca3af;text-transform:uppercase;">Creativity</div>
                                        </div>
                                    </div>
                                </div>
                                <p style="font-size:13px;color:#16a34a;font-weight:600;margin-bottom:14px;"><i
                                        class="bi bi-star-fill me-1"></i> Recommended: Screen Acting + Personality Development
                                    Course</p>
                                <div class="result-tag-row">
                                    <span class="result-tag">Natural Performer</span>
                                    <span class="result-tag">Visual Thinker</span>
                                    <span class="result-tag">Empathetic Leader</span>
                                    <span class="result-tag">Camera-Ready</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            {{-- ── IN THE NEWS ── --}}
            <section class="news-section">
                <div class="container">
                    <p class="news-label">Act to Action — In the News</p>
                    <div class="logo-marquee-wrap">
                        <div class="logo-marquee">
                            @php
                                $newsLogos = [
                                    ['icon' => 'bi-newspaper', 'name' => 'Rajasthan Patrika'],
                                    ['icon' => 'bi-newspaper', 'name' => 'Dainik Bhaskar'],
                                    ['icon' => 'bi-trophy', 'name' => 'Dada Saheb Phalke'],
                                    ['icon' => 'bi-film', 'name' => 'RIFF — Film Festival'],
                                    ['icon' => 'bi-globe', 'name' => 'Cannes Film Festival'],
                                    ['icon' => 'bi-building', 'name' => 'Birla Auditorium'],
                                    ['icon' => 'bi-palette', 'name' => 'Kalaneri Art Expo'],
                                    ['icon' => 'bi-shield-check', 'name' => 'Startup India'],
                                    ['icon' => 'bi-award', 'name' => 'iStart Rajasthan'],
                                    ['icon' => 'bi-flag', 'name' => 'Skill India'],
                                    ['icon' => 'bi-shop', 'name' => 'Decathlon'],
                                    ['icon' => 'bi-star', 'name' => 'RAS Club Awards'],
                                ];
                            @endphp
                            {{-- First set --}}
                            @foreach($newsLogos as $logo)
                                <div class="logo-pill"><i class="bi {{ $logo['icon'] }}"></i> {{ $logo['name'] }}</div>
                            @endforeach
                            {{-- Duplicate for seamless loop --}}
                            @foreach($newsLogos as $logo)
                                <div class="logo-pill"><i class="bi {{ $logo['icon'] }}"></i> {{ $logo['name'] }}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="news-quotes">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="quote-card">
                                    <i class="bi bi-quote quote-big"></i>
                                    <div class="quote-source"><i class="bi bi-newspaper"></i> Rajasthan Patrika</div>
                                    <blockquote>"Act to Action's theatre show at RIC showcased extraordinary talent from
                                        Jaipur's youngest stars — a standing ovation from all."</blockquote>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="quote-card">
                                    <i class="bi bi-quote quote-big"></i>
                                    <div class="quote-source"><i class="bi bi-palette"></i> Kalaneri Art Expo</div>
                                    <blockquote>"A unique blend of performing arts and inner science — Act to Action students
                                        brought depth and emotion rarely seen at this age."</blockquote>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="quote-card">
                                    <i class="bi bi-quote quote-big"></i>
                                    <div class="quote-source"><i class="bi bi-trophy"></i> Dada Saheb Phalke 2022</div>
                                    <blockquote>"Kritesh Agarwal's award-winning films reflect a generation of children trained
                                        to tell stories that matter."</blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ── FOR SCHOOLS & BUSINESSES ── --}}
            <section class="business-section">
                <div class="container position-relative">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6">
                            <div class="biz-badge"><i class="bi bi-buildings-fill"></i> For Schools & Organisations</div>
                            <h2>Unlock your school's true creative potential</h2>
                            <p>Act to Action partners with schools, NGOs, hospitals, and corporates to deliver impactful
                                workshops, events, and ongoing programmes. Get started in minutes — no consultants, no wasted
                                time, just results.</p>
                            <div class="biz-feature-row">
                                <div class="biz-ico"><i class="bi bi-mortarboard-fill"></i></div>
                                <div>
                                    <h6>School Partnerships</h6>
                                    <p>Theatre in Education, NEP 2020 aligned, modelling shows, exhibitions & parenting
                                        workshops.</p>
                                </div>
                            </div>
                            <div class="biz-feature-row">
                                <div class="biz-ico"><i class="bi bi-heart-pulse-fill"></i></div>
                                <div>
                                    <h6>Hospitals & Health Institutions</h6>
                                    <p>Mindfulness teaching and mindful doctor programmes for healthcare professionals.</p>
                                </div>
                            </div>
                            <div class="biz-feature-row">
                                <div class="biz-ico"><i class="bi bi-globe2"></i></div>
                                <div>
                                    <h6>NGOs & Government Campaigns</h6>
                                    <p>Free character building based on Bhagavad Gita for NGOs, slums, juveniles, and awareness
                                        campaigns.</p>
                                </div>
                            </div>
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" class="btn-white-solid mt-2" target="_blank">
                                <i class="bi bi-whatsapp"></i> Get Started Today
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="biz-visual">
                                <div class="biz-stats-grid">
                                    <div class="biz-stat-card">
                                        <div class="bsn">25<span>+</span></div>
                                        <div class="bsl">Partner Institutes</div>
                                    </div>
                                    <div class="biz-stat-card">
                                        <div class="bsn">3K<span>+</span></div>
                                        <div class="bsl">Students Impacted</div>
                                    </div>
                                    <div class="biz-stat-card">
                                        <div class="bsn">6<span>+</span></div>
                                        <div class="bsl">Centres in Jaipur</div>
                                    </div>
                                    <div class="biz-stat-card">
                                        <div class="bsn">100<span>%</span></div>
                                        <div class="bsl">Free for NGOs</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ── TESTIMONIALS ── --}}
            <section class="testimonials-section">
                <div class="container">
                    <div class="section-title">
                        <h2>What people are saying about us</h2>
                        <span class="divider-line"></span>
                        <p>From child development experts to parents and students — here's what they say.</p>
                    </div>
                    <div class="row g-4">
                        @php
                            $testimonials = [
                                [
                                    'initials' => 'DB',
                                    'color' => '#7c3aed',
                                    'author' => 'Dr. Bhumika Soni',
                                    'role' => 'Child Neuro Therapist',
                                    'quote' => '"Kritesh\'s integration of neuro-psychology with theatre is genuinely pioneering. I have not seen any other programme in India address both the emotional and cognitive development of children this holistically."',
                                ],
                                [
                                    'initials' => 'PV',
                                    'color' => '#059669',
                                    'author' => 'Priya Verma',
                                    'role' => 'Parent — Vaishali Nagar',
                                    'quote' => '"My daughter went from refusing to speak in public to anchoring the school annual function. The Stage Confidence assessment showed us exactly where she needed support — and the course delivered."',
                                ],
                                [
                                    'initials' => 'AK',
                                    'color' => '#d97706',
                                    'author' => 'Arjun Kapoor',
                                    'role' => 'Student, Age 19 — Jagatpura',
                                    'quote' => '"I took the Acting Talent Test and was surprised by how accurately it identified my strengths. Joined the screen acting batch within a week and got my first casting call in Month 4!"',
                                ],
                                [
                                    'initials' => 'NS',
                                    'color' => '#db2777',
                                    'author' => 'Neha Singhania',
                                    'role' => 'Parent — Old City, Jaipur',
                                    'quote' => '"The Skill Course Finder test is brilliant for parents who don\'t know where to start. It asked the right questions and matched my 7-year-old perfectly to the theatre programme."',
                                ],
                                [
                                    'initials' => 'MK',
                                    'color' => '#0891b2',
                                    'author' => 'Mrs. Meena Khatri',
                                    'role' => 'Principal — Mayoor School, Sitapura',
                                    'quote' => '"As a school principal, I partnered with Act to Action for our annual day. The children\'s transformation was visible — confidence, expression, and discipline all improved noticeably."',
                                ],
                                [
                                    'initials' => 'RS',
                                    'color' => '#175cdd',
                                    'author' => 'Rajesh Sharma',
                                    'role' => 'Parent — Malviya Nagar',
                                    'quote' => '"The Bhagavad Gita module is unlike anything I\'ve seen. My son is calmer, more focused, and speaks about values we were struggling to teach at home. Act to Action changed our family."',
                                ],
                            ];
                        @endphp

                        @foreach($testimonials as $t)
                            <div class="col-md-6 col-lg-4">
                                <div class="testimonial-item">
                                    <i class="bi bi-quote t-big-quote"></i>
                                    <div class="t-stars">
                                        @for($s = 0; $s < 5; $s++)<i class="bi bi-star-fill"></i>@endfor
                                    </div>
                                    <p class="t-quote">{{ $t['quote'] }}</p>
                                    <div class="t-footer">
                                        <div class="avatar-circle" style="background:{{ $t['color'] }};">{{ $t['initials'] }}</div>
                                        <div>
                                            <div class="t-author">{{ $t['author'] }}</div>
                                            <div class="t-role">{{ $t['role'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- ── BLOG ── --}}
            <section class="blog-section">
                <div class="container">
                    <div class="section-title">
                        <h2>Something to Read</h2>
                        <span class="divider-line"></span>
                        <p>The latest updates on child acting, personality development, and creative education from our blog.
                        </p>
                    </div>
                    <div class="row g-4">
                        @php
                            $blogs = [
                                [
                                    'img' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&q=75',
                                    'tag' => 'Acting Tips',
                                    'tag_style' => '',
                                    'title' => '5 Signs Your Child Has Natural Acting Talent',
                                    'excerpt' => 'From emotional memory to spontaneous improvisation — how to recognise the star in your child before they even audition.',
                                    'author' => 'Kritesh Agarwal',
                                    'date' => 'Jan 2025',
                                ],
                                [
                                    'img' => 'https://images.unsplash.com/photo-1535982330050-f1c2fb79ff78?w=600&q=75',
                                    'tag' => 'Parenting',
                                    'tag_style' => 'background:#f5f3ff;color:#7c3aed;',
                                    'title' => 'How Bhagavad Gita Shapes a Confident, Character-Strong Child',
                                    'excerpt' => 'Ancient wisdom meets modern child psychology — a deep dive into our unique curriculum approach for inner strength.',
                                    'author' => 'Act to Action Team',
                                    'date' => 'Dec 2024',
                                ],
                                [
                                    'img' => 'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?w=600&q=75',
                                    'tag' => 'Success Story',
                                    'tag_style' => 'background:#ecfdf5;color:#059669;',
                                    'title' => 'From Jaipur to Bollywood: A Student\'s Journey',
                                    'excerpt' => 'How one of our students went from stage fright at age 10 to landing a national television advertisement by age 12.',
                                    'author' => 'Kriti Gupta',
                                    'date' => 'Nov 2024',
                                ],
                                [
                                    'img' => 'https://images.unsplash.com/photo-1560523159-6b681a1e1852?w=600&q=75',
                                    'tag' => 'Development',
                                    'tag_style' => 'background:#fef3c7;color:#d97706;',
                                    'title' => 'Why Theatre is the Best Classroom for Children',
                                    'excerpt' => 'Research shows theatre-trained children score higher in empathy, communication, and academic performance.',
                                    'author' => 'Kritesh Agarwal',
                                    'date' => 'Oct 2024',
                                ],
                                [
                                    'img' => 'https://images.unsplash.com/photo-1543269664-7eef42226a21?w=600&q=75',
                                    'tag' => 'Industry',
                                    'tag_style' => 'background:#ecfeff;color:#0891b2;',
                                    'title' => 'What Bollywood Casting Directors Actually Look For',
                                    'excerpt' => 'Insider tips from our casting head on what makes a child stand out in an audition — beyond just acting skill.',
                                    'author' => 'Deepak Chandel',
                                    'date' => 'Sep 2024',
                                ],
                                [
                                    'img' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?w=600&q=75',
                                    'tag' => 'Wellness',
                                    'tag_style' => 'background:#fdf2f8;color:#db2777;',
                                    'title' => 'The Link Between Creativity and Mental Health in Children',
                                    'excerpt' => 'How expressive arts reduce anxiety, build resilience, and improve focus in children aged 3 to 18.',
                                    'author' => 'Dr. Bhumika Soni',
                                    'date' => 'Aug 2024',
                                ],
                            ];
                        @endphp

                        @foreach($blogs as $blog)
                            <div class="col-md-4">
                                <div class="blog-card">
                                    <img class="blog-img" src="{{ $blog['img'] }}" alt="{{ $blog['title'] }}" />
                                    <div class="blog-body">
                                        <span class="blog-tag" @if($blog['tag_style']) style="{{ $blog['tag_style'] }}" @endif>
                                            {{ $blog['tag'] }}
                                        </span>
                                        <h5>{{ $blog['title'] }}</h5>
                                        <p>{{ $blog['excerpt'] }}</p>
                                        <div class="blog-by">
                                            <i class="bi bi-person-circle"></i> {{ $blog['author'] }}
                                            &nbsp;·&nbsp;
                                            <i class="bi bi-calendar3"></i> {{ $blog['date'] }}
                                        </div>
                                        <a href="#" class="read-more-link">Read More <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-5">
                        <a href="#" class="btn-primary-solid" style="display:inline-flex;">
                            <i class="bi bi-journals"></i> Read All Entries
                        </a>
                    </div>
                </div>
            </section>

            {{-- ── NEWSLETTER ── --}}
            <section class="newsletter-section">
                <div class="container">
                    <div class="newsletter-box">
                        <h3>Get Our Newsletter</h3>
                        <p>Monthly tips on child acting, personality development, casting opportunities, and event updates —
                            straight to your inbox.</p>
                        <div class="newsletter-form">
                            <input type="email" placeholder="Enter your email address..." />
                            <button class="btn-primary-solid" type="button">
                                <i class="bi bi-send-fill"></i> Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </section>

        </main>
@endsection