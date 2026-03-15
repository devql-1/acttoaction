@extends('frontend.course.layout')
@section('content')
    <style>
        /* ── FAILED SCREEN anim override ── */
        #failedScreen .success-anim {
            background: linear-gradient(135deg, #dc2626, #ef4444);
        }

        :root {
            --ink: #0e1c35;
            --ink2: #1e3a5f;
            --blue: #ff6a00;
            --blue-lt: #ff6a00;
            --gold: #ff6a00;
            --surface: #ffffff;
            --muted: #6b7a99;
            --border: #dde5f4;
            --bg: #f0f5ff;
            --success: #10b981;
            --error: #ef4444;
            --step-done: #10b981;
            --font-head: 'Playfair Display', serif;
            --font-body: 'DM Sans', sans-serif;
            --font-mono: 'DM Mono', monospace;
            --radius: 16px;
            --shadow: 0 8px 40px rgba(14, 28, 53, .10);
            --shadow-blue: 0 8px 32px rgba(23, 92, 221, .22);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background: var(--bg);
            color: var(--ink);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── PAGE BACKGROUND TEXTURE ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background:
                radial-gradient(ellipse 80% 60% at 10% 0%, rgba(23, 92, 221, .07) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 100%, rgba(14, 28, 53, .05) 0%, transparent 60%);
        }

        /* ── HEADER ── */
        .page-header {
            background: linear-gradient(135deg, var(--ink) 0%, var(--ink2) 50%, #ff6a00 100%);
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        .page-header::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .header-inner {
            max-width: 860px;
            margin: 0 auto;
            padding: 42px 24px 38px;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .header-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            text-decoration: none;
        }

        .logo-mark {
            width: 42px;
            height: 42px;
            background: var(--blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .logo-text {
            font-family: var(--font-head);
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.3px;
        }

        .logo-text span {
            color: #60a5fa;
        }

        .header-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(245, 166, 35, .18);
            border: 1px solid rgba(245, 166, 35, .4);
            color: var(--gold);
            font-size: 11px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 14px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .page-header h1 {
            font-family: var(--font-head);
            font-size: clamp(26px, 4.5vw, 44px);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .page-header h1 em {
            font-style: normal;
            color: #60a5fa;
        }

        .page-header p {
            font-size: 15px;
            color: rgba(255, 255, 255, .6);
            max-width: 440px;
            margin: 0 auto 24px;
        }

        .trust-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .trust-chip {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 20px;
            padding: 5px 14px;
            color: rgba(255, 255, 255, .65);
            font-size: 12px;
        }

        .trust-chip i {
            color: #60a5fa;
            font-size: 13px;
        }

        /* ── STEPPER ── */
        .stepper-wrap {
            max-width: 860px;
            margin: 0 auto;
            padding: 32px 24px 0;
            position: relative;
            z-index: 1;
        }

        .stepper {
            display: flex;
            align-items: flex-start;
            gap: 0;
            position: relative;
        }

        .stepper::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            height: 2px;
            background: var(--border);
            z-index: 0;
            border-radius: 2px;
        }

        .stepper-progress {
            position: absolute;
            top: 20px;
            left: 20px;
            height: 2px;
            background: linear-gradient(90deg, var(--blue), var(--blue-lt));
            border-radius: 2px;
            z-index: 1;
            transition: width .5s cubic-bezier(.4, 0, .2, 1);
        }

        .step-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2.5px solid var(--border);
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-mono);
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            transition: all .35s;
            cursor: default;
        }

        .step-item.active .step-circle {
            border-color: var(--blue);
            background: var(--blue);
            color: #fff;
            box-shadow: 0 0 0 5px rgba(23, 92, 221, .15);
        }

        .step-item.done .step-circle {
            border-color: var(--step-done);
            background: var(--step-done);
            color: #fff;
        }

        .step-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--muted);
            text-align: center;
            transition: color .3s;
            white-space: nowrap;
        }

        .step-item.active .step-label {
            color: var(--blue);
        }

        .step-item.done .step-label {
            color: var(--step-done);
        }

        /* ── FORM CONTAINER ── */
        .form-wrap {
            max-width: 860px;
            margin: 24px auto 60px;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }

        .form-panel {
            background: var(--surface);
            border-radius: 24px;
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-head {
            padding: 28px 36px 22px;
            border-bottom: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .ph-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .ph-step {
            font-size: 11px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 3px;
        }

        .ph-title {
            font-family: var(--font-head);
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
        }

        .ph-sub {
            font-size: 13px;
            color: var(--muted);
            margin-top: 2px;
        }

        .panel-body {
            padding: 32px 36px;
        }

        /* ── FIELD GROUPS ── */
        .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .row-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 20px;
        }

        .field-group:last-child {
            margin-bottom: 0;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        label .req {
            color: var(--error);
            font-size: 12px;
        }

        label .opt {
            color: var(--muted);
            font-size: 11px;
            font-weight: 400;
        }

        /* ── INPUT STYLES ── */
        .fi {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            background: #fafbff;
            font-family: var(--font-body);
            font-size: 14px;
            color: var(--ink);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            appearance: none;
            -webkit-appearance: none;
        }

        .fi::placeholder {
            color: #bcc6df;
        }

        .fi:focus {
            border-color: var(--blue);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(23, 92, 221, .1);
        }

        .fi.has-error {
            border-color: var(--error);
            background: #fff8f8;
        }

        .fi.is-valid {
            border-color: var(--success);
        }

        select.fi {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7a99' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 38px;
            cursor: pointer;
        }

        textarea.fi {
            resize: vertical;
            min-height: 100px;
            line-height: 1.6;
        }

        .field-hint {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
        }

        .field-error {
            font-size: 12px;
            color: var(--error);
            margin-top: 2px;
            display: none;
            align-items: center;
            gap: 4px;
        }

        .field-error.show {
            display: flex;
        }

        /* Radio group */
        .radio-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .radio-card {
            position: relative;
        }

        .radio-card input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
            background: #fafbff;
            transition: all .2s;
            user-select: none;
        }

        .radio-card input:checked+.radio-label {
            border-color: var(--blue);
            background: #eff6ff;
            color: var(--blue);
            font-weight: 600;
        }

        .radio-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: #fff;
            transition: all .2s;
            flex-shrink: 0;
        }

        .radio-card input:checked+.radio-label .radio-dot {
            border-color: var(--blue);
            background: var(--blue);
            box-shadow: inset 0 0 0 3px #fff;
        }

        /* Checkboxes */
        .check-card {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            background: #fafbff;
            transition: border-color .2s, background .2s;
            user-select: none;
        }

        .check-card:hover {
            border-color: var(--blue);
            background: #f5f8ff;
        }

        .check-card input {
            display: none;
        }

        .check-box {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 2px solid var(--border);
            background: #fff;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
            margin-top: 1px;
        }

        .check-card.checked .check-box {
            background: var(--blue);
            border-color: var(--blue);
        }

        .check-card.checked .check-box::after {
            content: '✓';
            color: #fff;
            font-size: 12px;
            font-weight: 700;
        }

        .check-card.checked {
            border-color: var(--blue);
            background: #eff6ff;
        }

        .check-text strong {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 2px;
        }

        .check-text span {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.5;
        }

        .check-req {
            color: var(--error) !important;
        }

        /* Course pill selection */
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }

        .course-card-opt {
            position: relative;
        }

        .course-card-opt input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .course-opt-label {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 16px;
            border: 1.5px solid var(--border);
            border-radius: 14px;
            cursor: pointer;
            background: #fafbff;
            transition: all .22s;
        }

        .course-card-opt input:checked+.course-opt-label {
            border-color: var(--blue);
            background: #eff6ff;
            box-shadow: 0 0 0 3px rgba(23, 92, 221, .1);
        }

        .coll-icon {
            font-size: 22px;
            margin-bottom: 2px;
        }

        .coll-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.3;
        }

        .coll-age {
            font-size: 11px;
            color: var(--muted);
        }

        .course-card-opt input:checked+.course-opt-label .coll-name {
            color: var(--blue);
        }

        /* Coupon input row */
        .coupon-row {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .coupon-row .fi {
            flex: 1;
        }

        .btn-apply {
            padding: 12px 22px;
            background: var(--ink);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: var(--font-body);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: background .2s;
        }

        .btn-apply:hover {
            background: var(--blue);
        }

        .coupon-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #dcfce7;
            color: #15803d;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 8px;
            margin-top: 6px;
            display: none;
        }

        .coupon-badge.show {
            display: inline-flex;
        }

        /* ── NAVIGATION BUTTONS ── */
        .panel-footer {
            padding: 22px 36px;
            border-top: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #fafbff;
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 12px 24px;
            border: 1.5px solid var(--border);
            border-radius: 40px;
            background: #fff;
            color: var(--muted);
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-back:hover {
            border-color: var(--ink);
            color: var(--ink);
        }

        .btn-back:disabled {
            opacity: .35;
            cursor: not-allowed;
        }

        .btn-next {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 13px 30px;
            border: none;
            border-radius: 40px;
            background: linear-gradient(135deg, var(--blue), var(--blue-lt));
            color: #fff;
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            box-shadow: var(--shadow-blue);
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(23, 92, 221, .35);
        }

        .btn-next.submit-btn {
            background: linear-gradient(135deg, #059669, #10b981);
        }

        .btn-next.submit-btn:hover {
            box-shadow: 0 12px 40px rgba(16, 185, 129, .35);
        }

        .step-indicator {
            font-size: 12px;
            color: var(--muted);
        }

        .step-indicator strong {
            color: var(--ink);
        }

        /* ── DIVIDER ── */
        .form-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
        }

        .form-divider span {
            font-size: 11px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .form-divider::before,
        .form-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── SUCCESS SCREEN ── */
        .success-screen {
            display: none;
            padding: 60px 36px;
            text-align: center;
        }

        .success-anim {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: linear-gradient(135deg, #059669, #10b981);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 24px;
            animation: bounceIn .6s cubic-bezier(.36, .07, .19, .97);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, .4);
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            60% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-title {
            font-family: var(--font-head);
            font-size: 30px;
            font-weight: 900;
            color: var(--ink);
            margin-bottom: 10px;
        }

        .success-sub {
            font-size: 15px;
            color: var(--muted);
            max-width: 420px;
            margin: 0 auto 30px;
            line-height: 1.7;
        }

        .success-ref {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f0f5ff;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 10px 20px;
            font-family: var(--font-mono);
            font-size: 15px;
            color: var(--ink);
            font-weight: 500;
            margin-bottom: 28px;
        }

        .success-ref span {
            color: var(--muted);
            font-size: 12px;
        }

        .success-actions {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-wa {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 26px;
            background: #25d366;
            color: #fff;
            border: none;
            border-radius: 40px;
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-wa:hover {
            background: #1cb955;
            transform: translateY(-2px);
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: #fff;
            color: var(--ink);
            border: 1.5px solid var(--border);
            border-radius: 40px;
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-home:hover {
            border-color: var(--ink);
        }

        /* ── SLIDE TRANSITIONS ── */
        .step-content {
            display: none;
            animation: slideIn .35s cubic-bezier(.4, 0, .2, 1);
        }

        .step-content.active {
            display: block;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(18px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInBack {
            from {
                opacity: 0;
                transform: translateX(-18px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .step-content.back-anim {
            animation: slideInBack .35s cubic-bezier(.4, 0, .2, 1);
        }

        /* ── PROGRESS MINI BAR ── */
        .mini-progress {
            height: 3px;
            background: var(--border);
            position: relative;
            overflow: hidden;
        }

        .mini-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--blue), var(--blue-lt));
            transition: width .5s cubic-bezier(.4, 0, .2, 1);
        }

        /* ── RESPONSIVE ── */
        @media(max-width:640px) {
            .panel-head {
                padding: 20px 20px 16px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .panel-body {
                padding: 24px 20px;
            }

            .panel-footer {
                padding: 18px 20px;
                flex-wrap: wrap;
            }

            .row-2,
            .row-3 {
                grid-template-columns: 1fr;
            }

            .course-grid {
                grid-template-columns: 1fr 1fr;
            }

            .stepper {
                gap: 0;
            }

            .step-label {
                display: none;
            }
        }

        @media(max-width:420px) {
            .course-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @php
        /*
    |--------------------------------------------------------------------------
    | Variables from controller:
    |   $course         — Course (with category, centers.state)
    |   $otherCourses   — Collection of other courses
    |   $centresByState — [ 'Rajasthan' => [ ['id','name','address','phone','email','map'], ... ] ]
    |   $courseStates   — [ 'Rajasthan', 'Delhi', ... ]
    |--------------------------------------------------------------------------
    */

        // Null-safe defaults — prevents count() errors if controller didn't pass these
$centresByState = $centresByState ?? [];
$courseStates = $courseStates ?? [];
$otherCourses = $otherCourses ?? collect();

// If centresByState wasn't built by controller, build it now from the loaded relationship
        if (empty($centresByState) && $course->relationLoaded('centers')) {
            foreach ($course->centers as $center) {
                $stateName = $center->state && $center->state->name ? $center->state->name : 'Other';
                if (!isset($centresByState[$stateName])) {
                    $centresByState[$stateName] = [];
                }
                $centresByState[$stateName][] = [
                    'id' => $center->id,
                    'name' => $center->name,
                    'address' => $center->address ?? '',
                    'phone' => $center->phone ?? '',
                    'email' => $center->email ?? '',
                    'map' => $center->map_link ?? '',
                ];
            }
            $courseStates = array_keys($centresByState);
        }

        $modeMap = [
            'Online' => ['icon' => '💻', 'label' => 'Online — Live Classes', 'id' => 'm-online'],
            'Offline' => ['icon' => '🏫', 'label' => 'Offline — At Centre', 'id' => 'm-offline'],
            'Hybrid' => ['icon' => '🔄', 'label' => 'Hybrid — Online + Centre', 'id' => 'm-hybrid'],
        ];
        $courseMode = $course->mode ?? 'Offline';
        $modeMeta = $modeMap[$courseMode] ?? $modeMap['Offline'];
    @endphp

    @php
        /*
    |--------------------------------------------------------------------------
    | Variables from controller:
    |   $course         — Course (with category, centers.state)
    |   $otherCourses   — Collection of other courses
    |   $centresByState — [ 'Rajasthan' => [ ['id','name','address','phone','email','map'], ... ] ]
    |   $courseStates   — [ 'Rajasthan', 'Delhi', ... ]
    |--------------------------------------------------------------------------
    */

        // Null-safe defaults — prevents count() errors if controller didn't pass these
$centresByState = $centresByState ?? [];
$courseStates = $courseStates ?? [];
$otherCourses = $otherCourses ?? collect();

// If centresByState wasn't built by controller, build it now from the loaded relationship
        if (empty($centresByState) && $course->relationLoaded('centers')) {
            foreach ($course->centers as $center) {
                $stateName = $center->state && $center->state->name ? $center->state->name : 'Other';
                if (!isset($centresByState[$stateName])) {
                    $centresByState[$stateName] = [];
                }
                $centresByState[$stateName][] = [
                    'id' => $center->id,
                    'name' => $center->name,
                    'address' => $center->address ?? '',
                    'phone' => $center->phone ?? '',
                    'email' => $center->email ?? '',
                    'map' => $center->map_link ?? '',
                ];
            }
            $courseStates = array_keys($centresByState);
        }

        $modeMap = [
            'Online' => ['icon' => '💻', 'label' => 'Online — Live Classes', 'id' => 'm-online'],
            'Offline' => ['icon' => '🏫', 'label' => 'Offline — At Centre', 'id' => 'm-offline'],
            'Hybrid' => ['icon' => '🔄', 'label' => 'Hybrid — Online + Centre', 'id' => 'm-hybrid'],
        ];
        $courseMode = $course->mode ?? 'Offline';
        $modeMeta = $modeMap[$courseMode] ?? $modeMap['Offline'];
    @endphp

    @php
        /*
    |--------------------------------------------------------------------------
    | Variables from controller:
    |   $course         — Course (with category, centers.state)
    |   $otherCourses   — Collection of other courses
    |   $centresByState — [ 'Rajasthan' => [ ['id','name','address','phone','email','map'], ... ] ]
    |   $courseStates   — [ 'Rajasthan', 'Delhi', ... ]
    |--------------------------------------------------------------------------
    */

        // Null-safe defaults — prevents count() errors if controller didn't pass these
$centresByState = $centresByState ?? [];
$courseStates = $courseStates ?? [];
$otherCourses = $otherCourses ?? collect();

// If centresByState wasn't built by controller, build it now from the loaded relationship
        if (empty($centresByState) && $course->relationLoaded('centers')) {
            foreach ($course->centers as $center) {
                $stateName = $center->state && $center->state->name ? $center->state->name : 'Other';
                if (!isset($centresByState[$stateName])) {
                    $centresByState[$stateName] = [];
                }
                $centresByState[$stateName][] = [
                    'id' => $center->id,
                    'name' => $center->name,
                    'address' => $center->address ?? '',
                    'phone' => $center->phone ?? '',
                    'email' => $center->email ?? '',
                    'map' => $center->map_link ?? '',
                ];
            }
            $courseStates = array_keys($centresByState);
        }

        $modeMap = [
            'Online' => ['icon' => '💻', 'label' => 'Online — Live Classes', 'id' => 'm-online'],
            'Offline' => ['icon' => '🏫', 'label' => 'Offline — At Centre', 'id' => 'm-offline'],
            'Hybrid' => ['icon' => '🔄', 'label' => 'Hybrid — Online + Centre', 'id' => 'm-hybrid'],
        ];
        $courseMode = $course->mode ?? 'Offline';
        $modeMeta = $modeMap[$courseMode] ?? $modeMap['Offline'];
    @endphp

    <main class="main">
        <div class="page-title"></div>

        {{-- ── HEADER ── --}}
        <header class="page-header">
            <div class="header-inner">
                <a href="{{ url('/') }}" class="header-logo">
                    <div class="logo-mark">🎭</div>
                    <span class="logo-text">Act<span></span>To</span>Action</span>
                </a>
                <div class="header-eyebrow"><i class="bi bi-star-fill"></i> India's First Screen Acting School</div>
                <h1>Enroll in <em>{{ $course->title }}</em></h1>
                <p>
                    Since 2019 · 1000+ Students ·
                    {{ $course->centers->count() }} {{ Str::plural('Centre', $course->centers->count()) }}
                    across {{ count($courseStates ?? []) }} {{ Str::plural('State', count($courseStates ?? [])) }}
                </p>
                <div class="trust-row">
                    <span class="trust-chip"><i class="bi bi-shield-check-fill"></i> 100% Secure</span>
                    <span class="trust-chip"><i class="bi bi-clock-fill"></i> 5 Min to Complete</span>
                    <span class="trust-chip"><i class="bi bi-award-fill"></i> Free Demo Class</span>
                    <span class="trust-chip"><i class="bi bi-whatsapp"></i> Instant Confirmation</span>
                </div>
            </div>
        </header>

        <div class="mini-progress">
            <div class="mini-progress-fill" id="miniBar" style="width:0%"></div>
        </div>

        <div class="stepper-wrap">
            <div class="stepper">
                <div class="stepper-progress" id="stepperProgress" style="width:0%"></div>
                <div class="step-item active" id="si-0">
                    <div class="step-circle">1</div>
                    <div class="step-label">Personal</div>
                </div>
                <div class="step-item" id="si-1">
                    <div class="step-circle">2</div>
                    <div class="step-label">Parents</div>
                </div>
                <div class="step-item" id="si-2">
                    <div class="step-circle">3</div>
                    <div class="step-label">Contact</div>
                </div>
                <div class="step-item" id="si-3">
                    <div class="step-circle">4</div>
                    <div class="step-label">Location</div>
                </div>
                <div class="step-item" id="si-4">
                    <div class="step-circle">5</div>
                    <div class="step-label">Course</div>
                </div>
                <div class="step-item" id="si-5">
                    <div class="step-circle">6</div>
                    <div class="step-label">Confirm</div>
                </div>
            </div>
        </div>

        <div class="form-wrap">
            <div class="form-panel">

                {{-- ══ STEP 1 — PERSONAL ══ --}}
                <div class="step-content active" data-step="0">
                    <div class="panel-head">
                        <div class="ph-icon" style="background:#eff6ff;color:var(--blue);"><i class="bi bi-person-fill"
                                style="font-size:22px;"></i></div>
                        <div>
                            <div class="ph-step">Step 1 of 6</div>
                            <h2 class="ph-title">Student Personal Details</h2>
                            <p class="ph-sub">Tell us about the student enrolling for the course.</p>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row-2">
                            <div class="field-group">
                                <label>First Name <span class="req">*</span></label>
                                <input class="fi" type="text" id="firstName" placeholder="e.g. Aryan"
                                    autocomplete="given-name" />
                                <div class="field-error" id="err-firstName"><i class="bi bi-exclamation-circle"></i> First
                                    name is required</div>
                            </div>
                            <div class="field-group">
                                <label>Last Name <span class="req">*</span></label>
                                <input class="fi" type="text" id="lastName" placeholder="e.g. Sharma"
                                    autocomplete="family-name" />
                                <div class="field-error" id="err-lastName"><i class="bi bi-exclamation-circle"></i> Last
                                    name is required</div>
                            </div>
                        </div>
                        <div class="row-2">
                            <div class="field-group">
                                <label>Date of Birth <span class="req">*</span></label>
                                <input class="fi" type="date" id="dob" />
                                <div class="field-hint">
                                    Age group for this course:
                                    <strong>{{ $course->age_group ?? '3–29 years' }}</strong>
                                </div>
                                <div class="field-error" id="err-dob"><i class="bi bi-exclamation-circle"></i> Please
                                    enter a valid date of birth</div>
                            </div>
                            <div class="field-group">
                                <label>Age <span class="opt">(auto-calculated)</span></label>
                                <input class="fi" type="text" id="ageDisplay" placeholder="Will auto-fill"
                                    readonly style="background:#f5f7fc;color:var(--muted);cursor:default;" />
                            </div>
                        </div>
                        <div class="field-group">
                            <label>Gender <span class="req">*</span></label>
                            <div class="radio-group">
                                <div class="radio-card"><input type="radio" name="gender" id="g-male"
                                        value="Male" /><label class="radio-label" for="g-male"><span
                                            class="radio-dot"></span> Male</label></div>
                                <div class="radio-card"><input type="radio" name="gender" id="g-female"
                                        value="Female" /><label class="radio-label" for="g-female"><span
                                            class="radio-dot"></span> Female</label></div>
                                <div class="radio-card"><input type="radio" name="gender" id="g-other"
                                        value="Other" /><label class="radio-label" for="g-other"><span
                                            class="radio-dot"></span> Other</label></div>
                            </div>
                            <div class="field-error" id="err-gender"><i class="bi bi-exclamation-circle"></i> Please
                                select a gender</div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div></div>
                        <div style="display:flex;align-items:center;gap:16px;">
                            <span class="step-indicator">Step <strong>1</strong> of 6</span>
                            <button class="btn-next" onclick="nextStep(0)">Continue <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                {{-- ══ STEP 2 — PARENTS ══ --}}
                <div class="step-content" data-step="1">
                    <div class="panel-head">
                        <div class="ph-icon" style="background:#fdf2f8;color:#db2777;"><i class="bi bi-people-fill"
                                style="font-size:22px;"></i></div>
                        <div>
                            <div class="ph-step">Step 2 of 6</div>
                            <h2 class="ph-title">Parent / Guardian Details</h2>
                            <p class="ph-sub">We use this to communicate with the student's family.</p>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row-2">
                            <div class="field-group">
                                <label>Father's Name <span class="req">*</span></label>
                                <input class="fi" type="text" id="fatherName" placeholder="e.g. Rajesh Sharma" />
                                <div class="field-error" id="err-fatherName"><i class="bi bi-exclamation-circle"></i>
                                    Father's name is required</div>
                            </div>
                            <div class="field-group">
                                <label>Mother's Name <span class="req">*</span></label>
                                <input class="fi" type="text" id="motherName" placeholder="e.g. Priya Sharma" />
                                <div class="field-error" id="err-motherName"><i class="bi bi-exclamation-circle"></i>
                                    Mother's name is required</div>
                            </div>
                        </div>
                        <div class="row-2">
                            <div class="field-group">
                                <label>Parent Phone <span class="opt">(optional)</span></label>
                                <input class="fi" type="tel" id="parentPhone" placeholder="e.g. 98765 43210"
                                    maxlength="15" />
                                <div class="field-hint">We'll send updates via WhatsApp</div>
                            </div>
                            <div class="field-group">
                                <label>Parent Email <span class="opt">(optional)</span></label>
                                <input class="fi" type="email" id="parentEmail"
                                    placeholder="e.g. rajesh@email.com" />
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn-back" onclick="prevStep(1)"><i class="bi bi-arrow-left"></i> Back</button>
                        <div style="display:flex;align-items:center;gap:16px;">
                            <span class="step-indicator">Step <strong>2</strong> of 6</span>
                            <button class="btn-next" onclick="nextStep(1)">Continue <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                {{-- ══ STEP 3 — CONTACT & ACADEMIC ══ --}}
                <div class="step-content" data-step="2">
                    <div class="panel-head">
                        <div class="ph-icon" style="background:#ecfdf5;color:#059669;"><i class="bi bi-telephone-fill"
                                style="font-size:22px;"></i></div>
                        <div>
                            <div class="ph-step">Step 3 of 6</div>
                            <h2 class="ph-title">Contact & Academic Details</h2>
                            <p class="ph-sub">How can we reach the student? And their current school info.</p>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-divider"><span>Contact Information</span></div>
                        <div class="row-2">
                            <div class="field-group">
                                <label>Phone Number <span class="req">*</span></label>
                                <input class="fi" type="tel" id="phone" placeholder="e.g. 93520 23276"
                                    maxlength="15" />
                                <div class="field-error" id="err-phone"><i class="bi bi-exclamation-circle"></i> A valid
                                    10-digit phone number is required</div>
                            </div>
                            <div class="field-group">
                                <label>Email Address <span class="req">*</span></label>
                                <input class="fi" type="email" id="email"
                                    placeholder="e.g. aryan@email.com" />
                                <div class="field-error" id="err-email"><i class="bi bi-exclamation-circle"></i> A valid
                                    email address is required</div>
                            </div>
                        </div>
                        <div class="field-group">
                            <label>Full Address <span class="opt">(optional)</span></label>
                            <textarea class="fi" id="address" placeholder="House no., Street, Area…" style="min-height:80px;"></textarea>
                        </div>
                        <div class="form-divider"><span>Academic Details</span></div>
                        <div class="row-2">
                            <div class="field-group">
                                <label>School Name <span class="req">*</span></label>
                                <input class="fi" type="text" id="school"
                                    placeholder="e.g. Mayoor School, Jaipur" />
                                <div class="field-error" id="err-school"><i class="bi bi-exclamation-circle"></i> School
                                    name is required</div>
                            </div>
                            <div class="field-group">
                                <label>Class / Grade <span class="req">*</span></label>
                                <select class="fi" id="grade">
                                    <option value="">— Select Class —</option>
                                    <option>Nursery / Pre-School</option>
                                    <option>KG (Kindergarten)</option>
                                    @foreach (range(1, 12) as $cls)
                                        <option>Class {{ $cls }}</option>
                                    @endforeach
                                    <option>Undergraduate (College)</option>
                                    <option>Postgraduate</option>
                                    <option>Working Professional</option>
                                    <option>Other</option>
                                </select>
                                <div class="field-error" id="err-grade"><i class="bi bi-exclamation-circle"></i> Please
                                    select a class</div>
                            </div>
                        </div>
                        <div class="field-group">
                            <label>Achievements / Additional Notes <span class="opt">(optional)</span></label>
                            <textarea class="fi" id="achievements" placeholder="Any prior acting experience, awards, special skills…"
                                style="min-height:90px;"></textarea>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn-back" onclick="prevStep(2)"><i class="bi bi-arrow-left"></i> Back</button>
                        <div style="display:flex;align-items:center;gap:16px;">
                            <span class="step-indicator">Step <strong>3</strong> of 6</span>
                            <button class="btn-next" onclick="nextStep(2)">Continue <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                {{-- ══ STEP 4 — LOCATION & CENTRE ══
                 States from $courseStates (only states with centres for THIS course)
                 Centres from $centresByState[selectedState] via JS
            ══ --}}
                <div class="step-content" data-step="3">
                    <div class="panel-head">
                        <div class="ph-icon" style="background:#fff7ed;color:#d97706;"><i class="bi bi-geo-alt-fill"
                                style="font-size:22px;"></i></div>
                        <div>
                            <div class="ph-step">Step 4 of 6</div>
                            <h2 class="ph-title">Location & Centre Selection</h2>
                            <p class="ph-sub">
                                <strong>{{ $course->title }}</strong> is available at
                                <strong>{{ $course->centers->count() }}
                                    {{ Str::plural('centre', $course->centers->count()) }}</strong>
                                in
                                <strong>{{ count($courseStates ?? []) }}
                                    {{ Str::plural('state', count($courseStates ?? [])) }}</strong>.
                            </p>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row-2">
                            <div class="field-group">
                                <label>State <span class="req">*</span></label>
                                <select class="fi" id="state" onchange="updateCentres()">
                                    <option value="">— Select State —</option>
                                    @foreach ($courseStates as $sName)
                                        <option value="{{ $sName }}">{{ $sName }}</option>
                                    @endforeach
                                </select>
                                <div class="field-error" id="err-state"><i class="bi bi-exclamation-circle"></i> Please
                                    select your state</div>
                            </div>
                            <div class="field-group">
                                <label>Preferred City <span class="opt">(optional)</span></label>
                                <input class="fi" type="text" id="city" placeholder="Your city name" />
                            </div>
                        </div>

                        <div class="field-group">
                            <label>Act to Action Centre <span class="req">*</span></label>
                            <select class="fi" id="centre" onchange="showCentreInfo()">
                                <option value="">— Select your state first —</option>
                            </select>
                            <div class="field-error" id="err-centre"><i class="bi bi-exclamation-circle"></i> Please
                                select a centre</div>
                        </div>

                        {{-- Centre detail card --}}
                        <div id="centre-info-wrap" style="display:none;margin-top:8px;">
                            <div
                                style="background:#f0f5ff;border:1.5px solid #dbeafe;border-radius:14px;padding:18px 20px;">
                                <div style="display:flex;gap:14px;align-items:flex-start;">
                                    <div style="font-size:26px;">📍</div>
                                    <div style="flex:1;">
                                        <div style="font-size:14px;font-weight:700;color:var(--ink);margin-bottom:4px;"
                                            id="ci-name">—</div>
                                        <div style="font-size:13px;color:var(--muted);margin-bottom:8px;" id="ci-address">
                                            —</div>
                                        <div style="display:flex;flex-wrap:wrap;gap:12px;align-items:center;">
                                            <span id="ci-phone-wrap"
                                                style="display:none;align-items:center;gap:4px;font-size:12px;color:#059669;font-weight:600;">
                                                <i class="bi bi-telephone-fill"></i> <span id="ci-phone"></span>
                                            </span>
                                            <span id="ci-email-wrap"
                                                style="display:none;align-items:center;gap:4px;font-size:12px;color:#175cdd;font-weight:600;">
                                                <i class="bi bi-envelope-fill"></i> <span id="ci-email"></span>
                                            </span>
                                            <a id="ci-map" href="#" target="_blank"
                                                style="display:none;align-items:center;gap:4px;font-size:12px;color:#d97706;font-weight:600;text-decoration:none;">
                                                <i class="bi bi-map-fill"></i> View on Map
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Mode — locked from course.mode, shown as info card + hidden radio --}}
                        <div class="field-group" style="margin-top:22px;">
                            <label>Class Mode</label>
                            <div
                                style="background:#f0fdf4;border:1.5px solid #86efac;border-radius:12px;padding:14px 18px;display:flex;align-items:center;gap:14px;">
                                <span style="font-size:26px;">{{ $modeMeta['icon'] }}</span>
                                <div>
                                    <div style="font-size:14px;font-weight:700;color:#166534;">{{ $modeMeta['label'] }}
                                    </div>
                                    <div style="font-size:12px;color:#4ade80;margin-top:2px;">
                                        Pre-set for <strong>{{ $course->title }}</strong> — cannot be changed
                                    </div>
                                </div>
                                <i class="bi bi-lock-fill ms-auto" style="color:#16a34a;font-size:16px;"></i>
                            </div>
                            {{-- Hidden radio so radioVal('mode') in summary returns the correct value --}}
                            <input type="radio" name="mode" value="{{ $modeMeta['label'] }}" checked
                                style="display:none;" />
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn-back" onclick="prevStep(3)"><i class="bi bi-arrow-left"></i> Back</button>
                        <div style="display:flex;align-items:center;gap:16px;">
                            <span class="step-indicator">Step <strong>4</strong> of 6</span>
                            <button class="btn-next" onclick="nextStep(3)">Continue <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                {{-- ══ STEP 5 — COURSE ══
                 One pre-selected course card for $course
                 $otherCourses as switchable alternatives
            ══ --}}
                <div class="step-content" data-step="4">
                    <div class="panel-head">
                        <div class="ph-icon" style="background:#f5f3ff;color:#7c3aed;"><i class="bi bi-mortarboard-fill"
                                style="font-size:22px;"></i></div>
                        <div>
                            <div class="ph-step">Step 5 of 6</div>
                            <h2 class="ph-title">Course & Enrollment Details</h2>
                            <p class="ph-sub">Your selected course is pre-filled. You may switch to another if needed.</p>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="form-divider"><span>Your Selected Course</span></div>

                        {{-- Pre-selected course detail card --}}
                        <div
                            style="background:linear-gradient(135deg,#eff6ff,#f5f3ff);border:2px solid #bfdbfe;border-radius:18px;padding:22px 24px;margin-bottom:24px;position:relative;overflow:hidden;">
                            {{-- Badge --}}
                            <div
                                style="position:absolute;top:16px;right:16px;background:#175cdd;color:#fff;font-size:11px;font-weight:800;padding:5px 14px;border-radius:20px;letter-spacing:.5px;">
                                ✓ SELECTED
                            </div>
                            <div style="display:flex;gap:18px;align-items:flex-start;flex-wrap:wrap;">
                                <div style="font-size:48px;line-height:1;margin-top:2px;">🎭</div>
                                <div style="flex:1;min-width:180px;">
                                    <div style="font-size:20px;font-weight:900;color:var(--ink);margin-bottom:4px;">
                                        {{ $course->title }}
                                    </div>
                                    @if ($course->category)
                                        <div
                                            style="font-size:12px;font-weight:700;color:#7c3aed;margin-bottom:12px;text-transform:uppercase;letter-spacing:.4px;">
                                            {{ $course->category->name }}
                                        </div>
                                    @endif
                                    <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:10px;">
                                        @if ($course->age_group)
                                            <span
                                                style="background:#eff6ff;color:#175cdd;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;">
                                                <i class="bi bi-people-fill me-1"></i>Age {{ $course->age_group }}
                                            </span>
                                        @endif
                                        @if ($course->duration)
                                            <span
                                                style="background:#f5f3ff;color:#7c3aed;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;">
                                                <i class="bi bi-clock-fill me-1"></i>{{ $course->duration }}
                                            </span>
                                        @endif
                                        @if ($course->sessions)
                                            <span
                                                style="background:#ecfdf5;color:#059669;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;">
                                                <i class="bi bi-calendar-check-fill me-1"></i>{{ $course->sessions }}
                                                Sessions
                                            </span>
                                        @endif
                                        <span
                                            style="background:#fff7ed;color:#d97706;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;">
                                            {{ $modeMeta['icon'] }} {{ $course->mode }}
                                        </span>
                                    </div>
                                    @if ($course->description)
                                        <p style="font-size:13px;color:#6b7280;line-height:1.6;margin:0;">
                                            {{ Str::limit($course->description, 120) }}
                                        </p>
                                    @endif
                                </div>
                                {{-- Fee --}}
                                @if ($course->fees)
                                    <div
                                        style="text-align:center;min-width:110px;background:#fff;border-radius:14px;padding:14px 16px;box-shadow:0 2px 12px rgba(23,92,221,.08);">
                                        <div
                                            style="font-size:11px;color:var(--muted);font-weight:700;text-transform:uppercase;letter-spacing:.4px;margin-bottom:4px;">
                                            Course Fee</div>
                                        <div style="font-size:28px;font-weight:900;color:#175cdd;line-height:1;">
                                            ₹{{ number_format($course->fees) }}
                                        </div>
                                        <div style="font-size:10px;color:#9ca3af;margin-top:3px;">Incl. of taxes</div>
                                    </div>
                                @endif
                            </div>
                            {{-- Hidden radio pre-checked --}}
                            <input type="radio" name="course" id="c-main" value="{{ $course->title }}" checked
                                style="display:none;" />
                        </div>

                        {{-- Other courses --}}
                        @if ($otherCourses->count() > 0)
                            <div class="form-divider"><span>Or Switch to Another Course</span></div>
                            <div class="course-grid" style="margin-bottom:24px;">
                                @foreach ($otherCourses as $oc)
                                    <div class="course-card-opt">
                                        <input type="radio" name="course" id="c-{{ $oc->id }}"
                                            value="{{ $oc->title }}" />
                                        <label class="course-opt-label" for="c-{{ $oc->id }}">
                                            <div class="coll-icon">🌟</div>
                                            <div class="coll-name">{{ $oc->title }}</div>
                                            <div class="coll-age">
                                                @if ($oc->age_group)
                                                    Age {{ $oc->age_group }} ·
                                                @endif
                                                {{ $oc->duration ?? '3 months' }}
                                            </div>
                                            @if ($oc->fees)
                                                <div style="font-size:13px;font-weight:800;color:#175cdd;margin-top:6px;">
                                                    ₹{{ number_format($oc->fees) }}
                                                </div>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="field-error" id="err-course" style="margin-bottom:16px;">
                            <i class="bi bi-exclamation-circle"></i> Please select a course
                        </div>

                        <div class="form-divider"><span>Payment</span></div>
                        <div
                            style="background:#f0f5ff;border:1.5px solid #dbeafe;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:14px;margin-bottom:20px;">
                            <div style="font-size:22px;">💳</div>
                            <div>
                                <div style="font-size:13px;font-weight:700;color:var(--ink);">Payment via Razorpay</div>
                                <div style="font-size:12px;color:var(--muted);">UPI · Cards · Net Banking · Wallets — 100%
                                    Secure.</div>
                            </div>
                            <img src="https://razorpay.com/favicon.ico"
                                style="width:22px;height:22px;border-radius:4px;margin-left:auto;"
                                onerror="this.style.display='none'" alt="Razorpay" />
                        </div>

                        <div class="field-group">
                            <label>Coupon Code <span class="opt">(optional)</span></label>
                            <div class="coupon-row">
                                <input class="fi" type="text" id="coupon" placeholder="e.g. WELCOME20"
                                    style="text-transform:uppercase;" />
                                <button class="btn-apply" onclick="applyCoupon()">Apply</button>
                            </div>
                            <div class="coupon-badge" id="couponBadge" style="display:none;">
                                <i class="bi bi-check-circle-fill"></i> Coupon applied! ₹200 off
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn-back" onclick="prevStep(4)"><i class="bi bi-arrow-left"></i> Back</button>
                        <div style="display:flex;align-items:center;gap:16px;">
                            <span class="step-indicator">Step <strong>5</strong> of 6</span>
                            <button class="btn-next" onclick="nextStep(4)">Review &amp; Confirm <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                {{-- ══ STEP 6 — REVIEW ══ --}}
                <div class="step-content" data-step="5">
                    <div class="panel-head">
                        <div class="ph-icon" style="background:#ecfdf5;color:#059669;"><i
                                class="bi bi-clipboard2-check-fill" style="font-size:22px;"></i></div>
                        <div>
                            <div class="ph-step">Step 6 of 6</div>
                            <h2 class="ph-title">Review &amp; Confirm Enrollment</h2>
                            <p class="ph-sub">Check everything is correct before we confirm your spot.</p>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div
                            style="background:#f8faff;border:1.5px solid var(--border);border-radius:18px;overflow:hidden;margin-bottom:24px;">
                            <div
                                style="background:linear-gradient(135deg,var(--ink),var(--ink2));padding:16px 22px;display:flex;align-items:center;justify-content:space-between;">
                                <div style="font-family:var(--font-head);font-size:16px;color:#fff;font-weight:700;">
                                    Enrollment Summary</div>
                                <div style="font-size:12px;color:rgba(255,255,255,.5);">Review before submitting</div>
                            </div>
                            <div style="padding:22px;">
                                <div id="summary-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;"></div>
                            </div>
                        </div>
                        <div class="form-divider"><span>Agreements</span></div>
                        <div style="display:flex;flex-direction:column;gap:12px;margin-bottom:8px;">
                            <label class="check-card" id="chk-terms-card" onclick="toggleCheck('terms')">
                                <input type="checkbox" id="terms" />
                                <div class="check-box" id="chk-terms"></div>
                                <div class="check-text">
                                    <strong>I agree to the Terms &amp; Conditions <span class="check-req">*</span></strong>
                                    <span>I have read and accept the
                                        <a href="https://www.acttoaction.com/terms-and-conditions" target="_blank"
                                            style="color:var(--blue);font-weight:600;"
                                            onclick="event.stopPropagation()">Terms &amp; Conditions</a>
                                        and
                                        <a href="https://www.acttoaction.com/refund-policy" target="_blank"
                                            style="color:var(--blue);font-weight:600;"
                                            onclick="event.stopPropagation()">Refund Policy</a>.
                                    </span>
                                </div>
                            </label>
                            <label class="check-card" id="chk-newsletter-card" onclick="toggleCheck('newsletter')">
                                <input type="checkbox" id="newsletter" />
                                <div class="check-box" id="chk-newsletter"></div>
                                <div class="check-text">
                                    <strong>Subscribe to Updates &amp; Newsletters</strong>
                                    <span>Receive news about upcoming events, summer camps, casting calls, and
                                        courses.</span>
                                </div>
                            </label>
                        </div>
                        <div class="field-error" id="err-terms">
                            <i class="bi bi-exclamation-circle"></i> You must agree to the Terms &amp; Conditions to
                            continue
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn-back" onclick="prevStep(5)"><i class="bi bi-arrow-left"></i> Back</button>
                        <div style="display:flex;align-items:center;gap:16px;">
                            <span class="step-indicator">Final Step</span>
                            <button class="btn-next submit-btn" onclick="submitForm()">
                                <i class="bi bi-check2-circle"></i> Submit Enrollment
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ══ SUCCESS ══ --}}
                <div class="success-screen" id="successScreen" style="display:none;">
                    <div class="success-anim">🎉</div>
                    <div class="success-title">Payment Successful!</div>
                    <p class="success-sub">
                        Your seat has been reserved for <strong>{{ $course->title }}</strong>.
                        Our team will contact you within 24 hours to confirm your batch and free demo class.
                    </p>
                    <div class="success-ref"><span>Reference ID:</span>&nbsp;<span id="refId">ATA-000000</span></div>
                    <div
                        style="background:#ecfdf5;border:1.5px solid #86efac;border-radius:14px;padding:16px 20px;margin:16px 0;text-align:left;">
                        <div style="font-size:13px;font-weight:700;color:#166534;margin-bottom:4px;"><i
                                class="bi bi-check-circle-fill"></i> What happens next?</div>
                        <ul style="font-size:13px;color:#166534;margin:0;padding-left:18px;line-height:2;">
                            <li>You'll receive a WhatsApp confirmation shortly</li>
                            <li>Our team will call to confirm your batch timing</li>
                            <li>Free demo class will be scheduled within 48 hours</li>
                        </ul>
                    </div>
                    <div class="success-actions">
                        <a href="https://wa.me/919352023276" target="_blank" class="btn-wa">
                            <i class="bi bi-whatsapp"></i> Message on WhatsApp
                        </a>
                        <a href="{{ url('/') }}" class="btn-home">
                            <i class="bi bi-house"></i> Back to Home
                        </a>
                    </div>
                </div>

                {{-- ══ FAILED ══ --}}
                <div class="success-screen" id="failedScreen" style="display:none;">
                    <div class="success-anim">❌</div>
                    <div class="success-title" style="color:#dc2626;">Payment Failed</div>
                    <p class="success-sub">
                        Your payment could not be processed. Don't worry — your enrollment details have been saved.
                        You can try again or contact us for help.
                        <br><br>
                        <span style="font-size:13px;color:#9ca3af;">
                            Redirecting to course page in <strong id="failedCountdown">10</strong> seconds...
                        </span>
                    </p>
                    <div id="failedPaymentId"
                        style="background:#fef2f2;border:1.5px solid #fca5a5;border-radius:12px;padding:14px 20px;margin:16px 0;font-size:13px;color:#991b1b;display:none;">
                        <i class="bi bi-info-circle-fill"></i>
                        Payment ID: <strong id="failedPidText"></strong> — share this with support if needed.
                    </div>
                    <div class="success-actions">
                        <button class="btn-next" onclick="retryPayment()" style="background:#dc2626;">
                            <i class="bi bi-arrow-repeat"></i> Retry Payment
                        </button>
                        <a href="{{ url('/courses/' . $course->id) }}" class="btn-home">
                            <i class="bi bi-arrow-left"></i> Back to Course
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        /* ── DB data ── */
        var CENTRE_DATA = @json($centresByState);
        var COURSE_STATES = @json($courseStates);

        /* ── Silent save state ── */
        var _enrollmentId = null;
        var _silentSaveDone = false;

        /* ── Centre dropdown ── */
        function updateCentres() {
            var state = document.getElementById('state').value;
            var sel = document.getElementById('centre');
            var wrap = document.getElementById('centre-info-wrap');

            sel.innerHTML = '<option value="">— Select a Centre —</option>';
            wrap.style.display = 'none';
            if (!state) return;

            var list = CENTRE_DATA[state];
            if (list && list.length > 0) {
                for (var i = 0; i < list.length; i++) {
                    var o = document.createElement('option');
                    o.value = list[i].name;
                    o.textContent = list[i].name;
                    o.dataset.address = list[i].address || '';
                    o.dataset.phone = list[i].phone || '';
                    o.dataset.email = list[i].email || '';
                    o.dataset.map = list[i].map || '';
                    sel.appendChild(o);
                }
            }
        }

        /* ── Centre detail card ── */
        function showCentreInfo() {
            var sel = document.getElementById('centre');
            var wrap = document.getElementById('centre-info-wrap');
            var opt = sel.options[sel.selectedIndex];

            if (!opt || !opt.value) {
                wrap.style.display = 'none';
                return;
            }

            document.getElementById('ci-name').textContent = opt.value;
            document.getElementById('ci-address').textContent = opt.dataset.address || '—';

            var phoneWrap = document.getElementById('ci-phone-wrap');
            var emailWrap = document.getElementById('ci-email-wrap');
            var mapLink = document.getElementById('ci-map');

            if (opt.dataset.phone) {
                document.getElementById('ci-phone').textContent = opt.dataset.phone;
                phoneWrap.style.display = 'inline-flex';
            } else {
                phoneWrap.style.display = 'none';
            }

            if (opt.dataset.email) {
                document.getElementById('ci-email').textContent = opt.dataset.email;
                emailWrap.style.display = 'inline-flex';
            } else {
                emailWrap.style.display = 'none';
            }

            if (opt.dataset.map) {
                mapLink.href = opt.dataset.map;
                mapLink.style.display = 'inline-flex';
            } else {
                mapLink.style.display = 'none';
            }

            wrap.style.display = 'block';
        }

        /* ── Coupon ── */
        function applyCoupon() {
            var code = document.getElementById('coupon').value.trim().toUpperCase();
            var badge = document.getElementById('couponBadge');
            var valid = ['WELCOME20', 'ATA100', 'TRYACT', 'FREE50'];
            if (valid.indexOf(code) !== -1) {
                badge.style.display = 'inline-flex';
            } else {
                badge.style.display = 'none';
                if (code) alert('Invalid coupon code. Try WELCOME20 for \u20b9200 off.');
            }
        }

        /* ── Auto age ── */
        document.getElementById('dob').addEventListener('change', function() {
            var dob = new Date(this.value);
            if (isNaN(dob.getTime())) return;
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) age--;
            document.getElementById('ageDisplay').value = age >= 0 ? age + ' years old' : '';
        });

        /* ── Checkbox ── */
        function toggleCheck(id) {
            var card = document.getElementById('chk-' + id + '-card');
            var inp = document.getElementById(id);
            inp.checked = !inp.checked;
            card.classList.toggle('checked', inp.checked);
            if (id === 'terms') document.getElementById('err-terms').classList.remove('show');
        }

        /* ── Stepper ── */
        var currentStep = 0;
        var TOTAL_STEPS = 6;

        function updateStepper(step, goingBack) {
            for (var i = 0; i < TOTAL_STEPS; i++) {
                var si = document.getElementById('si-' + i);
                var circle = si.querySelector('.step-circle');
                si.className = 'step-item' + (i < step ? ' done' : '') + (i === step ? ' active' : '');
                circle.textContent = i < step ? '\u2713' : String(i + 1);
            }
            var pct = step === 0 ? 0 : (step / (TOTAL_STEPS - 1)) * 100;
            document.getElementById('stepperProgress').style.width = pct + '%';
            document.getElementById('miniBar').style.width = ((step + 1) / TOTAL_STEPS * 100) + '%';
            document.querySelectorAll('.step-content').forEach(function(el, idx) {
                el.classList.remove('active', 'back-anim');
                if (idx === step) {
                    el.classList.add('active');
                    if (goingBack) el.classList.add('back-anim');
                }
            });
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        /* ── Validation ── */
        function showErr(id, show) {
            var el = document.getElementById('err-' + id);
            if (el) el.classList.toggle('show', show);
            var fi = document.getElementById(id);
            if (fi) fi.classList.toggle('has-error', show);
        }

        function validateStep(step) {
            var ok = true;

            function req(id, cond) {
                showErr(id, !cond);
                if (!cond) ok = false;
            }

            if (step === 0) {
                req('firstName', document.getElementById('firstName').value.trim() !== '');
                req('lastName', document.getElementById('lastName').value.trim() !== '');
                var dobVal = document.getElementById('dob').value;
                var dobOk = false;
                if (dobVal) {
                    var d = new Date(dobVal),
                        now = new Date();
                    var age = now.getFullYear() - d.getFullYear();
                    var mo = now.getMonth() - d.getMonth();
                    if (mo < 0 || (mo === 0 && now.getDate() < d.getDate())) age--;
                    dobOk = (age >= 3 && age <= 29);
                }
                req('dob', dobOk);
                req('gender', document.querySelector('input[name="gender"]:checked') !== null);

            } else if (step === 1) {
                req('fatherName', document.getElementById('fatherName').value.trim() !== '');
                req('motherName', document.getElementById('motherName').value.trim() !== '');

            } else if (step === 2) {
                var ph = document.getElementById('phone').value.replace(/\D/g, '');
                req('phone', ph.length >= 10);
                req('email', /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(document.getElementById('email').value.trim()));
                req('school', document.getElementById('school').value.trim() !== '');
                req('grade', document.getElementById('grade').value !== '');

            } else if (step === 3) {
                req('state', document.getElementById('state').value !== '');
                req('centre', document.getElementById('centre').value !== '');

            } else if (step === 4) {
                req('course', document.querySelector('input[name="course"]:checked') !== null);

            } else if (step === 5) {
                var terms = document.getElementById('terms').checked;
                showErr('terms', !terms);
                if (!terms) ok = false;
            }
            return ok;
        }

        /* ── Nav ── */
        function nextStep(step) {
            if (!validateStep(step)) return;
            if (step === 3 && !_silentSaveDone) silentSave();
            if (step === 4) buildSummary();
            currentStep = step + 1;
            updateStepper(currentStep, false);
        }

        function prevStep(step) {
            currentStep = step - 1;
            updateStepper(currentStep, true);
        }

        /* ── Silent lead save (after Step 4) ── */
        function silentSave() {
            function getVal(id) {
                var el = document.getElementById(id);
                return (el && el.value) ? el.value : '';
            }

            function radioVal(name) {
                var el = document.querySelector('input[name="' + name + '"]:checked');
                return el ? el.value : '';
            }

            fetch('{{ route('enrollment.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        _token: '{{ csrf_token() }}',
                        course_id: '{{ $course->id }}',
                        first_name: getVal('firstName'),
                        last_name: getVal('lastName'),
                        dob: getVal('dob'),
                        gender: radioVal('gender'),
                        father_name: getVal('fatherName'),
                        mother_name: getVal('motherName'),
                        parent_phone: getVal('parentPhone'),
                        parent_email: getVal('parentEmail'),
                        phone: getVal('phone'),
                        email: getVal('email'),
                        address: getVal('address'),
                        school: getVal('school'),
                        grade: getVal('grade'),
                        achievements: getVal('achievements'),
                        state: getVal('state'),
                        city: getVal('city'),
                        centre: getVal('centre'),
                        mode: radioVal('mode'),
                        course: '{{ $course->title }}',
                        is_lead: 1,
                    }),
                })
                .then(function(res) {
                    return res.ok ? res.json() : null;
                })
                .then(function(data) {
                    if (data && data.enrollment_id) {
                        _enrollmentId = data.enrollment_id;
                        _silentSaveDone = true;
                    }
                })
                .catch(function() {});
        }

        /* ── Summary ── */
        function buildSummary() {
            function getVal(id) {
                var el = document.getElementById(id);
                return (el && el.value) ? el.value : '\u2014';
            }

            function radioVal(name) {
                var el = document.querySelector('input[name="' + name + '"]:checked');
                return el ? el.value : '\u2014';
            }

            var items = [
                ['Student Name', getVal('firstName') + ' ' + getVal('lastName')],
                ['Date of Birth', getVal('dob')],
                ['Gender', radioVal('gender')],
                ["Father's Name", getVal('fatherName')],
                ["Mother's Name", getVal('motherName')],
                ['Phone', getVal('phone')],
                ['Email', getVal('email')],
                ['School', getVal('school')],
                ['Class', getVal('grade')],
                ['State', getVal('state')],
                ['Centre', getVal('centre')],
                ['Mode', radioVal('mode')],
                ['Course', radioVal('course')],
                ['Coupon', (getVal('coupon') && getVal('coupon') !== '\u2014') ? getVal('coupon') : 'None'],
            ];
            var grid = document.getElementById('summary-grid');
            grid.innerHTML = '';
            for (var i = 0; i < items.length; i++) {
                var div = document.createElement('div');
                div.style.cssText = 'border-bottom:1px solid var(--border);padding-bottom:10px;';
                div.innerHTML =
                    '<div style="font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:2px;">' +
                    items[i][0] + '</div>' +
                    '<div style="font-size:14px;font-weight:600;color:var(--ink);">' + items[i][1] + '</div>';
                grid.appendChild(div);
            }
        }

        /* ── Helper: hide all steps, show a result screen ── */
        function showResultScreen(screenId) {
            document.querySelectorAll('.step-content').forEach(function(el) {
                el.style.display = 'none';
            });
            document.getElementById(screenId).style.display = 'block';
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        /* ── Helper: start countdown then redirect ── */
        function startFailedCountdown() {
            var countdown = 10;
            var courseUrl = '{{ url('/courses/' . $course->id) }}';
            var timer = setInterval(function() {
                countdown--;
                var el = document.getElementById('failedCountdown');
                if (el) el.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(timer);
                    window.location.href = courseUrl;
                }
            }, 1000);
        }

        /* ── Final submit ── */
        function submitForm() {
            if (!validateStep(5)) return;

            function getVal(id) {
                var el = document.getElementById(id);
                return (el && el.value) ? el.value : '';
            }

            function radioVal(name) {
                var el = document.querySelector('input[name="' + name + '"]:checked');
                return el ? el.value : '';
            }

            var payload = {
                _token: '{{ csrf_token() }}',
                course_id: '{{ $course->id }}',
                first_name: getVal('firstName'),
                last_name: getVal('lastName'),
                dob: getVal('dob'),
                gender: radioVal('gender'),
                father_name: getVal('fatherName'),
                mother_name: getVal('motherName'),
                parent_phone: getVal('parentPhone'),
                parent_email: getVal('parentEmail'),
                phone: getVal('phone'),
                email: getVal('email'),
                address: getVal('address'),
                school: getVal('school'),
                grade: getVal('grade'),
                achievements: getVal('achievements'),
                state: getVal('state'),
                city: getVal('city'),
                centre: getVal('centre'),
                mode: radioVal('mode'),
                course: radioVal('course'),
                coupon: getVal('coupon'),
                newsletter: document.getElementById('newsletter').checked ? 1 : 0,
                enrollment_id: _enrollmentId,
            };

            var btn = document.querySelector('.submit-btn');
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Submitting…';

            fetch('{{ route('enrollment.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload),
                })
                .then(function(res) {
                    if (res.status === 422) {
                        return res.json().then(function(data) {
                            var msgs = data.errors ? Object.values(data.errors).flat().join('\n') :
                                'Validation failed.';
                            alert('Please fix the following:\n\n' + msgs);
                            btn.disabled = false;
                            btn.innerHTML = '<i class="bi bi-check2-circle"></i> Submit Enrollment';
                        });
                    }
                    if (!res.ok) {
                        return res.text().then(function(text) {
                            alert('Server error (' + res.status + '). Please try again.');
                            btn.disabled = false;
                            btn.innerHTML = '<i class="bi bi-check2-circle"></i> Submit Enrollment';
                        });
                    }
                    return res.json();
                })
                .then(function(data) {
                    if (!data || !data.success) return;

                    var rzp = new Razorpay({
                        key: data.razorpay_key,
                        amount: data.amount,
                        currency: 'INR',
                        name: 'Act To Action',
                        description: 'Course Enrollment',
                        order_id: data.order_id,
                        handler: function(response) {
                            verifyPayment(response, data.enrollment_id);
                        },
                        prefill: {
                            name: payload.first_name + ' ' + payload.last_name,
                            email: payload.email,
                            contact: payload.phone,
                        },
                        theme: {
                            color: '#175cdd'
                        },
                        modal: {
                            ondismiss: function() {
                                btn.disabled = false;
                                btn.innerHTML = '<i class="bi bi-check2-circle"></i> Submit Enrollment';
                            }
                        }
                    });
                    rzp.open();
                })
                .catch(function() {
                    alert('Network error. Please check your connection and try again.');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="bi bi-check2-circle"></i> Submit Enrollment';
                });
        }

        /* ── Verify payment ── */
        function verifyPayment(response, enrollmentId) {
            fetch('{{ route('enrollment.verify') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_signature: response.razorpay_signature,
                        enrollment_id: enrollmentId,
                    }),
                })
                .then(function(res) {
                    return res.json();
                })
                .then(function(data) {
                    if (data.success) {
                        document.getElementById('refId').textContent = data.reference_id || ('ATA-' + enrollmentId);
                        showResultScreen('successScreen');
                    } else {
                        showResultScreen('failedScreen');
                        if (response.razorpay_payment_id) {
                            document.getElementById('failedPidText').textContent = response.razorpay_payment_id;
                            document.getElementById('failedPaymentId').style.display = 'block';
                        }
                        startFailedCountdown();
                    }
                })
                .catch(function() {
                    showResultScreen('failedScreen');
                    startFailedCountdown();
                });
        }

        /* ── Retry payment ── */
        function retryPayment() {
            document.getElementById('failedScreen').style.display = 'none';

            /* Restore step-content display so stepper works again */
            document.querySelectorAll('.step-content').forEach(function(el) {
                el.style.display = '';
            });

            var btn = document.querySelector('.submit-btn');
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-check2-circle"></i> Submit Enrollment';

            currentStep = 5;
            updateStepper(5, false);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        /* INIT */
        updateStepper(0, false);
    </script>
@endsection
