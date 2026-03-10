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
            color: #fff;
        }

        .topbar a {
            color: rgba(255, 255, 255, .85);
            transition: color .2s;
        }

        .topbar a:hover {
            color: #fff;
        }



        /* ─── TEST HERO ─── */
        .test-hero {
            background: linear-gradient(135deg, #f0f6ff 0%, #e8f0fe 60%, #f4f8ff 100%);
            padding: 60px 0 50px;
            border-bottom: 2px solid #dbeafe;
        }

        .test-hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--accent-color);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .test-hero h1 {
            font-size: clamp(26px, 4vw, 44px);
            font-weight: 900;
            color: var(--heading-color);
            line-height: 1.18;
            margin-bottom: 12px;
        }

        .test-hero h1 span {
            color: var(--accent-color);
        }

        .test-count-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1.5px solid #dbeafe;
            border-radius: 30px;
            padding: 7px 18px;
            font-size: 13px;
            font-weight: 600;
            color: var(--heading-color);
            margin-bottom: 18px;
            box-shadow: 0 2px 12px rgba(23, 92, 221, .07);
        }

        .test-count-badge .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1
            }

            50% {
                transform: scale(1.4);
                opacity: .7
            }
        }

        .test-hero-desc {
            font-size: 16px;
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 20px;
            max-width: 540px;
        }

        .reviewer-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            border: 1.5px solid #e0e8f5;
            border-radius: 40px;
            padding: 8px 16px;
            font-size: 13px;
            color: #6b7280;
        }

        .reviewer-badge .rv-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #175cdd, #60a5fa);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #fff;
            font-weight: 700;
            flex-shrink: 0;
        }

        .reviewer-badge strong {
            color: var(--heading-color);
        }

        /* Hero visual — floating test card preview */
        .hero-test-visual {
            background: var(--surface-color);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(17, 35, 68, .13);
            border: 1.5px solid #e4ecf8;
            overflow: hidden;
        }

        .htv-header {
            background: linear-gradient(135deg, var(--heading-color), #175cdd);
            padding: 20px 24px;
        }

        .htv-header h4 {
            color: #fff;
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .htv-header p {
            color: rgba(255, 255, 255, .7);
            font-size: 12px;
        }

        .htv-progress-wrap {
            padding: 16px 24px 0;
        }

        .htv-progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 6px;
        }

        .htv-progress-bar {
            height: 6px;
            background: #e8edf5;
            border-radius: 4px;
            overflow: hidden;
        }

        .htv-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--accent-color), #60a5fa);
            border-radius: 4px;
            width: 27%;
            transition: width .5s;
        }

        .htv-question {
            padding: 20px 24px;
        }

        .htv-q-num {
            font-size: 11px;
            color: #9ca3af;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 8px;
        }

        .htv-q-text {
            font-family: var(--heading-font);
            font-size: 15px;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 18px;
        }

        .htv-scale {
            display: flex;
            justify-content: space-between;
            gap: 6px;
            padding: 0 4px;
            margin-bottom: 10px;
        }

        .htv-scale-btn {
            flex: 1;
            border: 1.5px solid #e8edf5;
            border-radius: 10px;
            padding: 10px 4px;
            text-align: center;
            cursor: pointer;
            font-size: 11px;
            font-family: var(--nav-font);
            font-weight: 600;
            color: #9ca3af;
            background: #fafcff;
            transition: all .15s;
        }

        .htv-scale-btn:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
            background: #eff6ff;
        }

        .htv-scale-btn.selected {
            background: var(--accent-color);
            color: #fff;
            border-color: var(--accent-color);
        }

        .htv-scale-label {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #bbb;
            padding: 0 4px;
        }

        .htv-footer {
            padding: 14px 24px 20px;
            border-top: 1px solid #f0f4fb;
            display: flex;
            justify-content: flex-end;
        }

        .htv-next-btn {
            background: var(--accent-color);
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 20px;
            font-size: 13px;
            font-family: var(--heading-font);
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: background .2s;
        }

        .htv-next-btn:hover {
            background: #112344;
        }

        /* ─── MEDIA LOGOS ─── */
        .media-bar {
            padding: 30px 0;
            border-bottom: 1px solid #eef3fb;
        }

        .media-bar p {
            font-family: var(--nav-font);
            font-size: 11px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-align: center;
            margin-bottom: 18px;
        }

        .media-logos {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .media-logo {
            background: #f8faff;
            border: 1.5px solid #e0e8f5;
            border-radius: 8px;
            padding: 8px 18px;
            font-family: var(--heading-font);
            font-size: 12px;
            font-weight: 700;
            color: #6b7280;
            transition: border-color .2s;
        }

        .media-logo:hover {
            border-color: var(--accent-color);
            color: var(--heading-color);
        }

        /* ─── MAIN QUIZ AREA ─── */
        .quiz-wrapper {
            padding: 60px 0 80px;
        }

        .quiz-sidebar {
            position: sticky;
            top: 90px;
        }

        /* Sidebar info card */
        .sidebar-card {
            background: #f4f8ff;
            border: 1.5px solid #dbeafe;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 18px;
        }

        .sidebar-card h6 {
            font-size: 14px;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 12px;
        }

        .sidebar-info-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 13px;
            color: var(--default-color);
        }

        .sidebar-info-row i {
            color: var(--accent-color);
            font-size: 15px;
            width: 18px;
        }

        .sidebar-types h6 {
            font-size: 14px;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 12px;
        }

        .type-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #e8edf5;
            font-size: 13px;
            color: var(--default-color);
            cursor: pointer;
            transition: color .15s;
        }

        .type-chip:last-child {
            border-bottom: none;
        }

        .type-chip:hover {
            color: var(--accent-color);
        }

        .type-chip .tc-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--heading-font);
            font-size: 11px;
            font-weight: 800;
            color: var(--accent-color);
            flex-shrink: 0;
        }

        .type-chip .tc-name {
            font-weight: 600;
        }

        .type-chip .tc-sub {
            font-size: 11px;
            color: #9ca3af;
        }

        /* ─── QUIZ CARD ─── */
        #quiz-container {
            background: var(--surface-color);
            border: 1.5px solid #e4ecf8;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(17, 35, 68, .07);
        }

        .quiz-top-bar {
            background: linear-gradient(135deg, var(--heading-color) 0%, #1e4b9e 100%);
            padding: 24px 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .quiz-top-bar h3 {
            color: #fff;
            font-size: 17px;
            font-weight: 700;
            margin: 0;
        }

        .quiz-step-badge {
            background: rgba(255, 255, 255, .15);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 5px 14px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, .25);
            white-space: nowrap;
        }

        /* Progress */
        .quiz-progress-wrap {
            padding: 20px 36px 0;
        }

        .progress-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .progress-meta span {
            font-size: 13px;
            color: #6b7280;
            font-family: var(--nav-font);
        }

        .progress-meta strong {
            color: var(--accent-color);
            font-family: var(--heading-font);
        }

        .progress-track {
            height: 8px;
            background: #e8edf5;
            border-radius: 6px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 6px;
            background: linear-gradient(90deg, var(--accent-color) 0%, #60a5fa 100%);
            transition: width .5s cubic-bezier(.4, 0, .2, 1);
        }

        /* Step labels */
        .step-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            padding-bottom: 4px;
            overflow-x: auto;
            gap: 4px;
        }

        .step-dot {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .step-dot .sd {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #e8edf5;
            transition: background .3s;
        }

        .step-dot.done .sd {
            background: var(--accent-color);
        }

        .step-dot.active .sd {
            background: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(23, 92, 221, .25);
        }

        /* Question pane */
        .quiz-body {
            padding: 32px 36px 28px;
        }

        .q-section-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: var(--accent-color);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 12px;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .q-number {
            font-size: 12px;
            font-weight: 600;
            color: #9ca3af;
            margin-bottom: 8px;
            font-family: var(--nav-font);
            letter-spacing: .4px;
        }

        .q-text {
            font-family: var(--heading-font);
            font-size: 20px;
            font-weight: 800;
            color: var(--heading-color);
            line-height: 1.35;
            margin-bottom: 32px;
        }

        /* ── 5-question-per-step Inaccurate/Neutral/Accurate layout ── */
        .step-q-row {
            padding: 22px 0;
            border-bottom: 1px solid #f0f4fb;
        }

        .step-q-row:last-child {
            border-bottom: none;
        }

        .step-q-num {
            font-size: 11px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 6px;
        }

        .step-q-text {
            font-family: var(--heading-font);
            font-size: 16px;
            font-weight: 700;
            color: var(--heading-color);
            line-height: 1.4;
            margin-bottom: 16px;
        }

        .ina-row {
            display: flex;
            gap: 10px;
        }

        .ina-btn {
            flex: 1;
            border: 2px solid #e4ecf8;
            border-radius: 12px;
            padding: 12px 6px;
            text-align: center;
            cursor: pointer;
            font-family: var(--heading-font);
            font-size: 13px;
            font-weight: 700;
            color: #9ca3af;
            background: #fafcff;
            transition: all .18s;
            user-select: none;
            line-height: 1.3;
        }

        .ina-btn .ina-icon {
            display: block;
            font-size: 20px;
            margin-bottom: 4px;
        }

        .ina-btn:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
            background: #eff6ff;
            transform: translateY(-2px);
        }

        .ina-btn.sel-inaccurate {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fca5a5;
            transform: translateY(-2px);
        }

        .ina-btn.sel-neutral {
            background: #fef3c7;
            color: #d97706;
            border-color: #fcd34d;
            transform: translateY(-2px);
        }

        .ina-btn.sel-accurate {
            background: #dcfce7;
            color: #16a34a;
            border-color: #86efac;
            transform: translateY(-2px);
        }

        .unanswered-hint {
            font-size: 12px;
            color: #f59e0b;
            font-weight: 600;
            display: none;
            margin-top: 8px;
        }

        .unanswered-hint.show {
            display: block;
        }

        /* Nav buttons */
        .quiz-nav {
            padding: 0 36px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn-quiz-prev {
            background: transparent;
            border: 2px solid #e4ecf8;
            color: #6b7280;
            padding: 12px 24px;
            border-radius: 30px;
            font-family: var(--heading-font);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all .18s;
        }

        .btn-quiz-prev:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        .btn-quiz-prev:disabled {
            opacity: .35;
            cursor: not-allowed;
        }

        .btn-quiz-next {
            background: var(--accent-color);
            color: #fff;
            border: none;
            padding: 13px 32px;
            border-radius: 30px;
            font-family: var(--heading-font);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background .2s, transform .15s;
            box-shadow: 0 4px 18px rgba(23, 92, 221, .3);
        }

        .btn-quiz-next:hover {
            background: #0f4ab8;
            transform: translateY(-2px);
        }

        .btn-quiz-next:disabled {
            background: #9ca3af;
            box-shadow: none;
            cursor: not-allowed;
            transform: none;
        }

        /* ─── RESULTS PANEL ─── */
        #result-panel {
            display: none;
        }

        .result-header {
            background: linear-gradient(135deg, var(--heading-color), #175cdd);
            border-radius: 24px 24px 0 0;
            padding: 40px 36px 36px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .result-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1516627145497-ae6968895b74?w=800&q=40') center/cover;
            opacity: .07;
        }

        .result-header .confetti {
            font-size: 40px;
            margin-bottom: 8px;
        }

        .result-header h2 {
            font-size: 28px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 6px;
        }

        .result-header p {
            color: rgba(255, 255, 255, .75);
            font-size: 15px;
        }

        .result-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 20px;
            margin-top: 14px;
        }

        .result-body {
            padding: 36px;
        }

        .score-bar-wrap {
            margin-bottom: 14px;
        }

        .score-bar-label {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 600;
            color: var(--heading-color);
            margin-bottom: 6px;
        }

        .score-bar-track {
            height: 10px;
            background: #e8edf5;
            border-radius: 6px;
            overflow: hidden;
        }

        .score-bar-fill {
            height: 100%;
            border-radius: 6px;
            transition: width 1s cubic-bezier(.4, 0, .2, 1);
        }

        .result-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 20px 0;
        }

        .result-tag {
            background: #eff6ff;
            color: var(--accent-color);
            border: 1.5px solid #dbeafe;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 14px;
            border-radius: 20px;
        }

        .result-cta-box {
            background: linear-gradient(135deg, #f0f7ff, #e8f0fe);
            border: 1.5px solid #dbeafe;
            border-radius: 16px;
            padding: 28px;
            text-align: center;
            margin-top: 24px;
        }

        .result-cta-box h4 {
            font-size: 18px;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 8px;
        }

        .result-cta-box p {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 20px;
        }

        .btn-result-primary {
            background: var(--accent-color);
            color: #fff;
            border: none;
            padding: 13px 30px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 14px;
            font-family: var(--heading-font);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background .2s, transform .15s;
            box-shadow: 0 4px 18px rgba(23, 92, 221, .3);
        }

        .btn-result-primary:hover {
            background: #0f4ab8;
            transform: translateY(-2px);
        }

        .btn-result-outline {
            background: transparent;
            color: var(--accent-color);
            border: 2px solid var(--accent-color);
            padding: 12px 26px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
            font-family: var(--heading-font);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .2s;
        }

        .btn-result-outline:hover {
            background: var(--accent-color);
            color: #fff;
        }

        /* Share row */
        .share-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 16px;
        }

        .share-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: transform .15s, opacity .2s;
        }

        .share-btn:hover {
            transform: translateY(-2px);
            opacity: .9;
        }

        .share-wa {
            background: #25d366;
            color: #fff;
        }

        .share-ig {
            background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            color: #fff;
        }

        .share-copy {
            background: #e8edf5;
            color: var(--heading-color);
        }

        /* ─── TALENT TYPES INFO ─── */
        .talent-types-section {
            padding: 80px 0;
            background: #f4f8ff;
        }

        .section-title {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-title h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .section-title .divider {
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
            max-width: 540px;
            margin: 0 auto;
        }

        .talent-type-card {
            background: #fff;
            border-radius: 16px;
            padding: 26px 22px;
            border: 1.5px solid #e0e8f5;
            height: 100%;
            transition: box-shadow .2s, transform .2s, border-color .2s;
        }

        .talent-type-card:hover {
            box-shadow: 0 12px 40px rgba(23, 92, 221, .1);
            transform: translateY(-4px);
            border-color: var(--accent-color);
        }

        .tt-icon {
            font-size: 34px;
            margin-bottom: 14px;
        }

        .tt-type-num {
            font-size: 11px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 4px;
        }

        .tt-name {
            font-family: var(--heading-font);
            font-size: 17px;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 4px;
        }

        .tt-tagline {
            font-size: 12px;
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        .tt-desc {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 14px;
        }

        .tt-traits {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .tt-trait {
            background: #f0f4fb;
            color: var(--heading-color);
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 10px;
        }

        /* ─── FAQ ─── */
        .faq-section {
            padding: 80px 0;
            background: var(--background-color);
        }

        .accordion-button {
            font-family: var(--heading-font);
            font-weight: 600;
            font-size: 15px;
            color: var(--heading-color);
            background: var(--surface-color);
        }

        .accordion-button:not(.collapsed) {
            background: #eff6ff;
            color: var(--accent-color);
            box-shadow: none;
        }

        .accordion-button::after {
            filter: none;
        }

        .accordion-item {
            border: 1.5px solid #e8edf5;
            border-radius: 12px !important;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .accordion-body {
            font-size: 14px;
            color: var(--default-color);
            line-height: 1.7;
        }

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

            .quiz-top-bar,
            .quiz-body,
            .quiz-nav,
            .quiz-progress-wrap {
                padding-left: 20px;
                padding-right: 20px;
            }

            .scale-btns {
                gap: 5px;
            }

            .scale-btn {
                padding: 10px 3px;
                font-size: 10px;
            }

            .result-body,
            .result-header {
                padding: 24px 20px;
            }
        }
    </style>
    <main class="main">
        <div class="section-title"></div>
        {{-- ── HERO ── --}}
        <section class="test-hero">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="test-hero-eyebrow">
                            <i class="bi bi-camera-video-fill"></i> Free {{ $test->test_name }}
                        </div>
                        <h1>{{ $test->test_name }} for <span>Children & Teens</span></h1>
                        <div class="test-count-badge">
                            <div class="dot"></div>
                            <span><strong>2,840</strong> tests taken in the last 30 days</span>
                        </div>
                        <p class="test-hero-desc">
                            {{ $test->description ?? 'This free test will reveal your child\'s natural performance strengths — from emotional expression to stage confidence and camera presence. Discover which course is the perfect match.' }}
                        </p>
                        @if($test->age)
                            <p style="font-size:14px;color:#6b7280;margin-bottom:12px;">
                                <i class="bi bi-people-fill me-1"></i> Recommended for age: <strong>{{ $test->age }}</strong>
                            </p>
                        @endif
                        <div class="reviewer-badge">
                            <div class="rv-avatar">KA</div>
                            <span>Reviewed by <strong>Kritesh Agarwal</strong>, Filmmaker & Child Acting Coach</span>
                        </div>
                        <div class="mt-3">
                            <a href="#quiz" class="btn d-inline-flex align-items-center gap-2"
                                style="background:var(--accent-color);color:#fff;border-radius:30px;padding:13px 32px;font-family:var(--heading-font);font-weight:700;font-size:15px;">
                                <i class="bi bi-play-circle-fill"></i> Start the Free Test
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-test-visual">
                            <div class="htv-header">
                                <h4>🎭 {{ $test->test_name }}</h4>
                                <p>Step 1 of {{ $categories->count() }} — Ready to discover your talent?</p>
                            </div>
                            <div class="htv-progress-wrap">
                                <div class="htv-progress-label"><span>Progress</span><span>0%</span></div>
                                <div class="htv-progress-bar">
                                    <div class="htv-progress-fill" style="width:0%"></div>
                                </div>
                            </div>
                            <div class="htv-question">
                                <div class="htv-q-num">Question 1 of {{ $totalQuestions }}</div>
                                @if($allQuestions->first())
                                    <div class="htv-q-text">{{ $allQuestions->first()->question_text }}</div>
                                @endif
                                <div class="htv-scale">
                                    <div class="htv-scale-btn">😟<br />1</div>
                                    <div class="htv-scale-btn">😐<br />2</div>
                                    <div class="htv-scale-btn selected">🙂<br />3</div>
                                    <div class="htv-scale-btn">😊<br />4</div>
                                    <div class="htv-scale-btn">🤩<br />5</div>
                                </div>
                                <div class="htv-scale-label"><span>Inaccurate</span><span>Accurate</span></div>
                            </div>
                            <div class="htv-footer">
                                <button class="htv-next-btn">Next Step <i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── MEDIA BAR ── --}}
        <div class="media-bar">
            <div class="container">
                <p>As Seen In</p>
                <div class="media-logos">
                    <div class="media-logo">Rajasthan Patrika</div>
                    <div class="media-logo">Dainik Bhaskar</div>
                    <div class="media-logo">Cannes FF</div>
                    <div class="media-logo">Dada Saheb Phalke</div>
                    <div class="media-logo">RIFF</div>
                    <div class="media-logo">Birla Auditorium</div>
                    <div class="media-logo">Startup India</div>
                    <div class="media-logo">Skill India</div>
                </div>
            </div>
        </div>

        {{-- ── QUIZ AREA ── --}}
        <section class="quiz-wrapper" id="quiz">
            <div class="container">
                <div class="row g-5">

                    {{-- SIDEBAR --}}
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="quiz-sidebar">
                            <div class="sidebar-card">
                                <h6><i class="bi bi-info-circle-fill me-2" style="color:var(--accent-color)"></i>About This
                                    Test</h6>
                                @if($test->duration)
                                    <div class="sidebar-info-row"><i class="bi bi-clock"></i> Takes about {{ $test->duration }}
                                        minutes</div>
                                @endif
                                <div class="sidebar-info-row"><i class="bi bi-list-check"></i> {{ $totalQuestions }} quick
                                    questions</div>
                                @if($test->age)
                                    <div class="sidebar-info-row"><i class="bi bi-people"></i> Best for age {{ $test->age }}
                                    </div>
                                @endif
                                <div class="sidebar-info-row"><i class="bi bi-shield-check"></i> 100% Free, no sign-up
                                    needed</div>
                                <div class="sidebar-info-row"><i class="bi bi-bar-chart-line"></i> Instant personalised
                                    result</div>
                                <div class="sidebar-info-row"><i class="bi bi-star-fill" style="color:#f59e0b"></i> Rated
                                    4.9/5 by 1000+ parents</div>
                            </div>
                            <div class="sidebar-card">
                                <div class="sidebar-types">
                                    <h6><i class="bi bi-lightning-charge-fill me-2"
                                            style="color:var(--accent-color)"></i>Talent Types You May Discover</h6>
                                    <div class="type-chip">
                                        <div class="tc-num">1</div>
                                        <div>
                                            <div class="tc-name">The Performer</div>
                                            <div class="tc-sub">Natural on-screen magnetism</div>
                                        </div>
                                    </div>
                                    <div class="type-chip">
                                        <div class="tc-num">2</div>
                                        <div>
                                            <div class="tc-name">The Empath</div>
                                            <div class="tc-sub">Deep emotional expression</div>
                                        </div>
                                    </div>
                                    <div class="type-chip">
                                        <div class="tc-num">3</div>
                                        <div>
                                            <div class="tc-name">The Creator</div>
                                            <div class="tc-sub">Storytelling & imagination</div>
                                        </div>
                                    </div>
                                    <div class="type-chip">
                                        <div class="tc-num">4</div>
                                        <div>
                                            <div class="tc-name">The Leader</div>
                                            <div class="tc-sub">Stage presence & command</div>
                                        </div>
                                    </div>
                                    <div class="type-chip">
                                        <div class="tc-num">5</div>
                                        <div>
                                            <div class="tc-name">The Voice</div>
                                            <div class="tc-sub">Powerful speech & expression</div>
                                        </div>
                                    </div>
                                    <div class="type-chip">
                                        <div class="tc-num">6</div>
                                        <div>
                                            <div class="tc-name">The Director</div>
                                            <div class="tc-sub">Vision, craft & filmmaking</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- QUIZ CARD --}}
                    <div class="col-lg-8 order-lg-2 order-1">
                        <div id="quiz-container">
                            <div class="quiz-top-bar">
                                <h3>🎭 {{ $test->test_name }}</h3>
                                <span class="quiz-step-badge" id="step-badge">Step 1 of {{ $categories->count() }}</span>
                            </div>
                            <div class="quiz-progress-wrap">
                                <div class="progress-meta">
                                    <span id="q-progress-label">Question <strong>1</strong> of {{ $totalQuestions }}</span>
                                    <span><strong id="pct-label">0%</strong> complete</span>
                                </div>
                                <div class="progress-track">
                                    <div class="progress-fill" id="progress-fill" style="width:0%"></div>
                                </div>
                                <div class="step-labels" id="step-labels"></div>
                            </div>
                            <div class="quiz-body">
                                <div class="q-section-label" id="q-section-label">
                                    <i class="bi bi-emoji-smile"></i> Loading...
                                </div>
                                <div class="q-number" id="q-number"></div>
                                <div class="q-text" id="q-text"></div>
                                <div id="q-answers"></div>
                            </div>
                            <div class="quiz-nav">
                                <button class="btn-quiz-prev" id="btn-prev" disabled>
                                    <i class="bi bi-arrow-left"></i> Previous
                                </button>
                                <button class="btn-quiz-next" id="btn-next">
                                    Next <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        {{-- ✅ HIDDEN FORM — submits answers to controller --}}
                        <form id="quiz-submit-form" method="POST" action="{{ route('test.submit', $test->id) }}"
                            style="display:none;">
                            @csrf
                            <input type="hidden" id="hidden-answers" name="answers" value="">
                        </form>

                    </div>{{-- end col-lg-8 --}}
                </div>
            </div>
        </section>

        {{-- ── TALENT TYPES ── --}}
        <section class="talent-types-section">
            <div class="container">
                <div class="section-title">
                    <h2>What Are the 6 Acting Talent Types?</h2>
                    <span class="divider"></span>
                    <p>Act to Action's talent framework identifies 6 core performing arts profiles — each with unique
                        strengths and the ideal course pathway.</p>
                </div>
                <div class="row g-4">
                    @php
                        $talentCards = [
                            ['icon' => '🎭', 'num' => 'Type 1', 'name' => 'The Performer', 'tagline' => 'Natural On-Screen Magnetism', 'desc' => 'Performers have natural charisma and camera presence. They light up on stage and on screen, captivating audiences effortlessly. Their energy is infectious and their confidence instinctive.', 'traits' => ['Charismatic', 'Energetic', 'Camera-Ready']],
                            ['icon' => '💙', 'num' => 'Type 2', 'name' => 'The Empath', 'tagline' => 'Deep Emotional Expression', 'desc' => 'Empaths feel emotions deeply and express them powerfully. They connect with characters on a profound level and bring genuine feeling to every scene — making audiences truly believe.', 'traits' => ['Sensitive', 'Expressive', 'Deeply Feeling']],
                            ['icon' => '✨', 'num' => 'Type 3', 'name' => 'The Creator', 'tagline' => 'Storytelling & Imagination', 'desc' => 'Creators have boundless imagination and a natural gift for storytelling. They invent characters, build worlds, and bring unique perspectives to their performances that surprise and delight.', 'traits' => ['Imaginative', 'Inventive', 'Storyteller']],
                            ['icon' => '👑', 'num' => 'Type 4', 'name' => 'The Leader', 'tagline' => 'Stage Presence & Command', 'desc' => 'Leaders naturally command attention the moment they walk on stage. They have powerful presence, clear voice, and the ability to guide an audience through a performance with confidence.', 'traits' => ['Confident', 'Authoritative', 'Commanding']],
                            ['icon' => '🎤', 'num' => 'Type 5', 'name' => 'The Voice', 'tagline' => 'Powerful Speech & Expression', 'desc' => 'Voices have extraordinary command of language, tone, and speech. They excel in public speaking, dialogue delivery, and voice modulation — making every word they speak memorable.', 'traits' => ['Articulate', 'Persuasive', 'Expressive']],
                            ['icon' => '🎬', 'num' => 'Type 6', 'name' => 'The Director', 'tagline' => 'Vision, Craft & Filmmaking', 'desc' => 'Directors see the bigger picture. They notice composition, rhythm, and narrative. Their talent lies behind the camera — in storytelling, directing others, and crafting complete cinematic experiences.', 'traits' => ['Visionary', 'Strategic', 'Detail-Oriented']],
                        ];
                    @endphp
                    @foreach($talentCards as $tc)
                        <div class="col-sm-6 col-lg-4">
                            <div class="talent-type-card">
                                <div class="tt-icon">{{ $tc['icon'] }}</div>
                                <div class="tt-type-num">{{ $tc['num'] }}</div>
                                <div class="tt-name">{{ $tc['name'] }}</div>
                                <div class="tt-tagline">{{ $tc['tagline'] }}</div>
                                <p class="tt-desc">{{ $tc['desc'] }}</p>
                                <div class="tt-traits">
                                    @foreach($tc['traits'] as $trait)
                                        <span class="tt-trait">{{ $trait }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ── FAQ ── --}}
        <section class="faq-section">
            <div class="container">
                <div class="section-title">
                    <h2>{{ $test->test_name }} — FAQ</h2>
                    <span class="divider"></span>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="accordion" id="faqAccordion">
                            @php
                                $faqs = [
                                    ['q' => 'What is this test based on?', 'a' => 'This test is co-developed by Kritesh Agarwal (Filmmaker & Acting Coach), Dr. Bhumika Soni (Child Neuro Therapist), and child development experts at Act to Action. It combines performing arts science, neuro-psychology, and 6+ years of practical coaching data to accurately identify a child\'s natural talent type.'],
                                    ['q' => 'How long does the test take?', 'a' => 'The test consists of ' . $totalQuestions . ' questions across ' . $categories->count() . ' sections and takes approximately ' . ($test->duration ?? '8–10') . ' minutes to complete. Questions are simple and fun — parents can complete it with their child together.'],
                                    ['q' => 'Is this a free test?', 'a' => 'Yes, this test is completely free to take and receive your full results. There are no hidden fees, no credit card required, and no account needed. We believe every child deserves to discover their potential.'],
                                    ['q' => 'What will my results look like?', 'a' => 'After completing the test, you will instantly receive your child\'s Talent Type (e.g., The Performer, The Empath), a score breakdown across 6 dimensions, key strength tags, a detailed description, and a personalised course recommendation from Act to Action\'s skill programmes.'],
                                    ['q' => 'What age group is this test for?', 'a' => 'This test is designed for ' . ($test->age ? 'children aged ' . $test->age : 'children and young adults aged 5 to 29') . '. For children under 10, we recommend that parents complete the test on behalf of their child or together with them.'],
                                    ['q' => 'Can I have my school or group take this test?', 'a' => 'Yes! Act to Action offers group assessments for schools, NGOs, and organisations. Contact us via WhatsApp to arrange a batch assessment session. We have partnered with 25+ top educational institutes across India.'],
                                    ['q' => 'Will you sell my data?', 'a' => 'We do not sell your email or personal data to any third parties and have a zero-spam policy. We are registered with Startup India and iStart Rajasthan and comply with applicable privacy laws.'],
                                ];
                            @endphp
                            @foreach($faqs as $i => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">
                                            {{ $faq['q'] }}
                                        </button>
                                    </h2>
                                    <div id="faq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">{{ $faq['a'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-5">
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank"
                                class="btn d-inline-flex align-items-center gap-2"
                                style="background:var(--accent-color);color:#fff;border-radius:30px;padding:13px 30px;font-family:var(--heading-font);font-weight:700;">
                                <i class="bi bi-play-circle-fill"></i> Take the Test Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        const ALL_QUESTIONS = {!! json_encode(
        $allQuestions->values()->map(function ($q) {
            return [
                'id' => $q->id,
                'text' => $q->question_text,
                'min' => $q->scale_min ?? 1,
                'max' => $q->scale_max ?? 5,
            ];
        })->values()
    ) !!};

        const TOTAL_Q = {{ $totalQuestions }};
        const Q_PER_STEP = 6;

        const steps = [];
        for (let i = 0; i < ALL_QUESTIONS.length; i += Q_PER_STEP) {
            steps.push(ALL_QUESTIONS.slice(i, i + Q_PER_STEP));
        }

        const TOTAL_STEPS = steps.length;
        let answers = steps.map(s => new Array(s.length).fill(null));
        let currentStep = 0;

        const SCALE = [
            { val: 1, emoji: '😟', label: 'Never' },
            { val: 2, emoji: '😐', label: 'Rarely' },
            { val: 3, emoji: '🙂', label: 'Sometimes' },
            { val: 4, emoji: '😊', label: 'Often' },
            { val: 5, emoji: '🤩', label: 'Always' },
        ];

        function renderStep(stepIdx) {
            const stepQs = steps[stepIdx];
            const startQ = stepIdx * Q_PER_STEP;
            const endQ = startQ + stepQs.length;
            const pct = Math.round((startQ / TOTAL_Q) * 100);

            document.getElementById('progress-fill').style.width = pct + '%';
            document.getElementById('pct-label').textContent = pct + '%';
            document.getElementById('q-progress-label').innerHTML =
                `Questions <strong>${startQ + 1}–${endQ}</strong> of ${TOTAL_Q}`;
            document.getElementById('step-badge').textContent =
                `Step ${stepIdx + 1} of ${TOTAL_STEPS}`;
            document.getElementById('q-section-label').innerHTML =
                `<i class="bi bi-emoji-smile"></i> Part ${stepIdx + 1} of ${TOTAL_STEPS}`;

            // Step dots
            const dotWrap = document.getElementById('step-labels');
            dotWrap.innerHTML = '';
            steps.forEach((_, i) => {
                const d = document.createElement('div');
                d.className = 'step-dot'
                    + (answers[i].every(a => a !== null) ? ' done' : '')
                    + (i === stepIdx ? ' active' : '');
                d.innerHTML = '<div class="sd"></div>';
                dotWrap.appendChild(d);
            });

            // Build questions
            const wrap = document.getElementById('q-answers');
            wrap.innerHTML = '';

            stepQs.forEach((q, qi) => {
                const globalNum = startQ + qi + 1;
                const row = document.createElement('div');
                row.className = 'step-q-row';

                const scaleHTML = SCALE.map(s =>
                    `<div class="ina-btn${answers[stepIdx][qi] === s.val ? ' sel-' + scaleClass(s.val) : ''}"
                          data-qi="${qi}" data-val="${s.val}">
                        <span class="ina-icon">${s.emoji}</span>${s.label}
                     </div>`
                ).join('');

                row.innerHTML = `
                    <div class="step-q-num">Question ${globalNum}</div>
                    <div class="step-q-text">${q.text}</div>
                    <div class="ina-row">${scaleHTML}</div>
                    <div class="ina-scale-legend">
                        <span>← Inaccurate</span><span>Accurate →</span>
                    </div>
                    <div class="unanswered-hint" id="hint-${qi}">
                        ⚠ Please select an answer
                    </div>`;

                wrap.appendChild(row);
            });

            // Click handlers
            wrap.querySelectorAll('.ina-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const qi = parseInt(btn.dataset.qi);
                    const val = parseInt(btn.dataset.val);
                    answers[stepIdx][qi] = val;
                    wrap.querySelectorAll(`.ina-btn[data-qi="${qi}"]`)
                        .forEach(b => b.classList.remove('sel-low', 'sel-mid', 'sel-high'));
                    btn.classList.add('sel-' + scaleClass(val));
                    document.getElementById(`hint-${qi}`).classList.remove('show');
                });
            });

            document.getElementById('btn-prev').disabled =
                (stepIdx === 0);
            document.getElementById('btn-next').innerHTML =
                stepIdx === TOTAL_STEPS - 1
                    ? 'See Results 📊'
                    : 'Next Step ➜';
        }

        function scaleClass(val) {
            if (val <= 2) return 'low';
            if (val === 3) return 'mid';
            return 'high';
        }

        // Previous button
        document.getElementById('btn-prev').addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                renderStep(currentStep);
            }
        });

        // Next button
        document.getElementById('btn-next').addEventListener('click', () => {
            let allAnswered = true;
            answers[currentStep].forEach((a, qi) => {
                if (a === null) {
                    allAnswered = false;
                    document.getElementById(`hint-${qi}`).classList.add('show');
                }
            });
            if (!allAnswered) return;

            if (currentStep < TOTAL_STEPS - 1) {
                currentStep++;
                renderStep(currentStep);
            } else {
                showResults();
            }
        });

        // ✅ ONLY CHANGE — submit to controller instead of showing inline panel
        function showResults() {
            const flat = answers.flat();
            document.getElementById('hidden-answers').value = JSON.stringify(flat);
            document.getElementById('quiz-submit-form').submit();
        }

        renderStep(0);
    </script>

    <style>
        .ina-scale-legend {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #9ca3af;
            font-weight: 600;
            margin-top: 4px;
            padding: 0 2px;
        }

        .ina-btn.sel-low {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fca5a5;
        }

        .ina-btn.sel-mid {
            background: #fef9c3;
            color: #ca8a04;
            border-color: #fde047;
        }

        .ina-btn.sel-high {
            background: #dcfce7;
            color: #16a34a;
            border-color: #86efac;
        }
    </style>
@endsection