@extends('frontend.course.layout')
@section('content')

<style>
    :root {
        --ink: #0e1c35;
        --ink2: #1e3a5f;
        --blue: #7C3AED;
        --blue-lt: #9b59f0;
        --gold: #f5a623;
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
        --shadow-blue: 0 8px 32px rgba(124, 58, 237, .22);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: var(--font-body); background: var(--bg); color: var(--ink); min-height: 100vh; }

    body::before {
        content: ''; position: fixed; inset: 0; pointer-events: none; z-index: 0;
        background:
            radial-gradient(ellipse 80% 60% at 10% 0%, rgba(124,58,237,.07) 0%, transparent 60%),
            radial-gradient(ellipse 60% 50% at 90% 100%, rgba(14,28,53,.05) 0%, transparent 60%);
    }

    /* ── HEADER ── */
    .page-header {
        background: linear-gradient(135deg, var(--ink) 0%, var(--ink2) 50%, var(--blue) 100%);
        padding: 0; position: relative; overflow: hidden;
    }
    .page-header::after {
        content: ''; position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }
    .header-inner {
        max-width: 860px; margin: 0 auto; padding: 42px 24px 38px;
        position: relative; z-index: 1; text-align: center;
    }
    .header-logo {
        display: inline-flex; align-items: center; gap: 10px;
        margin-bottom: 22px; text-decoration: none;
    }
    .logo-mark {
        width: 42px; height: 42px; background: var(--blue); border-radius: 10px;
        display: flex; align-items: center; justify-content: center; font-size: 20px;
    }
    .logo-text {
        font-family: var(--font-head); font-size: 22px; font-weight: 700;
        color: #fff; letter-spacing: -.3px;
    }
    .logo-text span { color: #c4b5fd; }
    .header-eyebrow {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(245,166,35,.18); border: 1px solid rgba(245,166,35,.4);
        color: var(--gold); font-size: 11px; font-weight: 600;
        padding: 4px 14px; border-radius: 20px; margin-bottom: 14px;
        letter-spacing: .5px; text-transform: uppercase;
    }
    .page-header h1 {
        font-family: var(--font-head); font-size: clamp(26px,4.5vw,44px);
        font-weight: 900; color: #fff; line-height: 1.15; margin-bottom: 10px;
    }
    .page-header h1 em { font-style: normal; color: #c4b5fd; }
    .page-header p {
        font-size: 15px; color: rgba(255,255,255,.6);
        max-width: 440px; margin: 0 auto 24px;
    }
    .trust-row { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
    .trust-chip {
        display: flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12);
        border-radius: 20px; padding: 5px 14px;
        color: rgba(255,255,255,.65); font-size: 12px;
    }
    .trust-chip i { color: #c4b5fd; font-size: 13px; }

    /* ── STEPPER ── */
    .stepper-wrap {
        max-width: 860px; margin: 0 auto; padding: 32px 24px 0;
        position: relative; z-index: 1;
    }
    .stepper {
        display: flex; align-items: flex-start; gap: 0; position: relative;
    }
    .stepper::before {
        content: ''; position: absolute; top: 20px; left: 20px; right: 20px;
        height: 2px; background: var(--border); z-index: 0; border-radius: 2px;
    }
    .stepper-progress {
        position: absolute; top: 20px; left: 20px; height: 2px;
        background: linear-gradient(90deg, var(--blue), var(--blue-lt));
        border-radius: 2px; z-index: 1; transition: width .5s cubic-bezier(.4,0,.2,1);
    }
    .step-item {
        flex: 1; display: flex; flex-direction: column; align-items: center;
        gap: 8px; position: relative; z-index: 2; cursor: pointer;
    }
    .step-circle {
        width: 40px; height: 40px; border-radius: 50%;
        border: 2.5px solid var(--border); background: var(--surface);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-mono); font-size: 13px; font-weight: 500;
        color: var(--muted); transition: all .35s;
    }
    .step-item.active .step-circle {
        border-color: var(--blue); background: var(--blue); color: #fff;
        box-shadow: 0 0 0 5px rgba(124,58,237,.15);
    }
    .step-item.done .step-circle {
        border-color: var(--step-done); background: var(--step-done); color: #fff;
    }
    .step-label {
        font-size: 11px; font-weight: 600; color: var(--muted);
        text-align: center; transition: color .3s; white-space: nowrap;
    }
    .step-item.active .step-label { color: var(--blue); }
    .step-item.done .step-label { color: var(--step-done); }

    /* ── FORM CONTAINER ── */
    .form-wrap {
        max-width: 860px; margin: 24px auto 60px;
        padding: 0 24px; position: relative; z-index: 1;
    }
    .form-panel {
        background: var(--surface); border-radius: 24px;
        border: 1.5px solid var(--border); box-shadow: var(--shadow);
        overflow: hidden;
    }
    .panel-head {
        padding: 28px 36px 22px; border-bottom: 1.5px solid var(--border);
        display: flex; align-items: center; gap: 16px;
    }
    .ph-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; flex-shrink: 0;
    }
    .ph-step {
        font-size: 11px; font-weight: 600; color: var(--muted);
        text-transform: uppercase; letter-spacing: .5px; margin-bottom: 3px;
    }
    .ph-title {
        font-family: var(--font-head); font-size: 22px; font-weight: 700;
        color: var(--ink); margin: 0;
    }
    .ph-sub { font-size: 13px; color: var(--muted); margin-top: 2px; }
    .panel-body { padding: 32px 36px; }

    /* ── FIELD GROUPS ── */
    .row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .field-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px; }
    .field-group:last-child { margin-bottom: 0; }
    label {
        font-size: 13px; font-weight: 600; color: var(--ink);
        display: flex; align-items: center; gap: 5px;
    }
    label .req { color: var(--error); font-size: 12px; }
    label .opt { color: var(--muted); font-size: 11px; font-weight: 400; }

    /* ── INPUT STYLES ── */
    .fi {
        width: 100%; padding: 12px 16px; border: 1.5px solid var(--border);
        border-radius: 12px; background: #fafbff; font-family: var(--font-body);
        font-size: 14px; color: var(--ink); outline: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
        appearance: none; -webkit-appearance: none;
    }
    .fi::placeholder { color: #bcc6df; }
    .fi:focus {
        border-color: var(--blue); background: #fff;
        box-shadow: 0 0 0 4px rgba(124,58,237,.1);
    }
    .fi.has-error { border-color: var(--error); background: #fff8f8; }
    .fi.is-valid { border-color: var(--success); }
    select.fi {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7a99' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 14px center;
        padding-right: 38px; cursor: pointer;
    }
    textarea.fi { resize: vertical; min-height: 100px; line-height: 1.6; }
    .field-hint { font-size: 12px; color: var(--muted); margin-top: 2px; }
    .field-error {
        font-size: 12px; color: var(--error); margin-top: 2px;
        display: none; align-items: center; gap: 4px;
    }
    .field-error.show { display: flex; }
    .field-success {
        font-size: 12px; color: var(--success); font-weight: 600;
        margin-top: 4px; display: none; align-items: center; gap: 4px;
    }
    .field-success.show { display: flex; }

    /* Radio group */
    .radio-group { display: flex; gap: 10px; flex-wrap: wrap; }
    .radio-card { position: relative; }
    .radio-card input { position: absolute; opacity: 0; width: 0; height: 0; }
    .radio-label {
        display: flex; align-items: center; gap: 8px;
        padding: 10px 18px; border: 1.5px solid var(--border); border-radius: 10px;
        cursor: pointer; font-size: 13px; font-weight: 500; color: var(--ink);
        background: #fafbff; transition: all .2s; user-select: none;
    }
    .radio-card input:checked + .radio-label {
        border-color: var(--blue); background: #f5f3ff; color: var(--blue); font-weight: 600;
    }
    .radio-dot {
        width: 16px; height: 16px; border-radius: 50%;
        border: 2px solid var(--border); background: #fff;
        transition: all .2s; flex-shrink: 0;
    }
    .radio-card input:checked + .radio-label .radio-dot {
        border-color: var(--blue); background: var(--blue);
        box-shadow: inset 0 0 0 3px #fff;
    }

    /* Checkboxes */
    .check-card {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 16px; border: 1.5px solid var(--border); border-radius: 12px;
        cursor: pointer; background: #fafbff; transition: border-color .2s, background .2s;
        user-select: none;
    }
    .check-card:hover { border-color: var(--blue); background: #f5f8ff; }
    .check-card input { display: none; }
    .check-box {
        width: 20px; height: 20px; border-radius: 6px;
        border: 2px solid var(--border); background: #fff; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        transition: all .2s; margin-top: 1px;
    }
    .check-card.checked .check-box { background: var(--blue); border-color: var(--blue); }
    .check-card.checked .check-box::after {
        content: '✓'; color: #fff; font-size: 12px; font-weight: 700;
    }
    .check-card.checked { border-color: var(--blue); background: #f5f3ff; }
    .check-text strong {
        display: block; font-size: 14px; font-weight: 600;
        color: var(--ink); margin-bottom: 2px;
    }
    .check-text span { font-size: 12px; color: var(--muted); line-height: 1.5; }
    .check-req { color: var(--error) !important; }

    /* Divider */
    .form-divider {
        display: flex; align-items: center; gap: 12px; margin: 24px 0;
    }
    .form-divider span {
        font-size: 11px; font-weight: 600; color: var(--muted);
        text-transform: uppercase; letter-spacing: .5px; white-space: nowrap;
    }
    .form-divider::before, .form-divider::after {
        content: ''; flex: 1; height: 1px; background: var(--border);
    }

    /* ── NAVIGATION BUTTONS ── */
    .panel-footer {
        padding: 22px 36px; border-top: 1.5px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
        gap: 12px; background: #fafbff;
    }
    .btn-back {
        display: flex; align-items: center; gap: 7px;
        padding: 12px 24px; border: 1.5px solid var(--border); border-radius: 40px;
        background: #fff; color: var(--muted); font-family: var(--font-body);
        font-size: 14px; font-weight: 600; cursor: pointer; transition: all .2s;
    }
    .btn-back:hover { border-color: var(--ink); color: var(--ink); }
    .btn-back:disabled { opacity: .35; cursor: not-allowed; }
    .btn-next {
        display: flex; align-items: center; gap: 8px;
        padding: 13px 30px; border: none; border-radius: 40px;
        background: linear-gradient(135deg, var(--blue), var(--blue-lt));
        color: #fff; font-family: var(--font-body); font-size: 14px;
        font-weight: 700; cursor: pointer; transition: all .2s;
        box-shadow: var(--shadow-blue);
    }
    .btn-next:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(124,58,237,.35); }
    .btn-next.submit-btn {
        background: linear-gradient(135deg, #059669, #10b981);
    }
    .btn-next.submit-btn:hover { box-shadow: 0 12px 40px rgba(16,185,129,.35); }
    .step-indicator { font-size: 12px; color: var(--muted); }
    .step-indicator strong { color: var(--ink); }
    .footer-right { display: flex; align-items: center; gap: 14px; flex-shrink: 0; }

    /* ── SUCCESS / FAILED SCREENS ── */
    .success-screen { display: none; padding: 60px 36px; text-align: center; }
    .success-anim {
        width: 88px; height: 88px; border-radius: 50%;
        background: linear-gradient(135deg, #059669, #10b981);
        display: flex; align-items: center; justify-content: center;
        font-size: 36px; margin: 0 auto 24px;
        animation: bounceIn .6s cubic-bezier(.36,.07,.19,.97);
    }
    .success-anim.failed { background: linear-gradient(135deg, #dc2626, #ef4444); }
    @keyframes bounceIn {
        0% { transform: scale(0); opacity: 0; }
        60% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }
    .success-title {
        font-family: var(--font-head); font-size: 30px;
        font-weight: 900; color: var(--ink); margin-bottom: 10px;
    }
    .success-sub {
        font-size: 15px; color: var(--muted); max-width: 420px;
        margin: 0 auto 30px; line-height: 1.7;
    }
    .success-ref {
        display: inline-flex; align-items: center; gap: 8px;
        background: #f0f5ff; border: 1.5px solid var(--border);
        border-radius: 12px; padding: 10px 20px;
        font-family: var(--font-mono); font-size: 15px;
        color: var(--ink); font-weight: 500; margin-bottom: 28px;
    }
    .success-ref span { color: var(--muted); font-size: 12px; }
    .success-actions { display: flex; justify-content: center; gap: 12px; flex-wrap: wrap; }
    .btn-wa {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 13px 26px; background: #25d366; color: #fff;
        border: none; border-radius: 40px; font-family: var(--font-body);
        font-size: 14px; font-weight: 700; cursor: pointer;
        text-decoration: none; transition: all .2s;
    }
    .btn-wa:hover { background: #1cb955; transform: translateY(-2px); }
    .btn-home {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 24px; background: #fff; color: var(--ink);
        border: 1.5px solid var(--border); border-radius: 40px;
        font-family: var(--font-body); font-size: 14px;
        font-weight: 600; cursor: pointer; text-decoration: none; transition: all .2s;
    }
    .btn-home:hover { border-color: var(--ink); }

    /* ── STEP VISIBILITY ── */
    .step-content { display: none; }
    .step-content.active { display: block !important; }

    /* ── MINI PROGRESS BAR ── */
    .mini-progress { height: 3px; background: var(--border); position: relative; overflow: hidden; }
    .mini-progress-fill {
        height: 100%; background: linear-gradient(90deg, var(--blue), var(--blue-lt));
        transition: width .5s cubic-bezier(.4,0,.2,1);
    }

    /* ── Phone prefix ── */
    .phone-pfx-wrap {
        display: flex; align-items: stretch; border: 1.5px solid var(--border);
        border-radius: 10px; overflow: hidden; background: #fff; position: relative;
    }
    .phone-pfx {
        display: flex; align-items: center; padding: 0 12px;
        background: #f3f6fb; border-right: 1.5px solid var(--border);
        font-size: 14px; font-weight: 600; color: var(--ink);
        white-space: nowrap; user-select: none; flex-shrink: 0;
    }
    .phone-pfx-wrap .fi { border: none !important; border-radius: 0 !important; flex: 1; min-width: 0; }
    .phone-pfx-wrap:focus-within {
        border-color: var(--blue); box-shadow: 0 0 0 4px rgba(124,58,237,.1);
    }
    .phone-pfx-wrap.has-error { border-color: var(--error); background: #fff8f8; }
    .phone-pfx-wrap.is-valid { border-color: var(--success); }

    /* Ajax indicator */
    .ajax-indicator {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        font-size: 14px; pointer-events: none;
    }
    .ajax-indicator.checking::after {
        content: ''; display: inline-block; width: 14px; height: 14px;
        border: 2px solid #e5e7eb; border-top-color: var(--blue);
        border-radius: 50%; animation: spin .6s linear infinite; vertical-align: middle;
    }
    .ajax-indicator.ok::after { content: '✓'; color: var(--success); font-weight: 700; }
    .ajax-indicator.bad::after { content: '✕'; color: var(--error); font-weight: 700; }
    @keyframes spin { to { transform: translateY(-50%) rotate(360deg); } }

    /* Course card */
    .course-display {
        background: linear-gradient(135deg, #f5f3ff, #ede9fe);
        border: 2px solid #c4b5fd; border-radius: 18px;
        padding: 22px 24px; position: relative; overflow: hidden;
    }
    .course-badge {
        position: absolute; top: 16px; right: 16px;
        background: var(--blue); color: #fff; font-size: 11px;
        font-weight: 800; padding: 5px 14px; border-radius: 20px;
        letter-spacing: .5px;
    }
    .course-fee-box {
        text-align: center; min-width: 110px; background: #fff;
        border-radius: 14px; padding: 14px 16px;
        box-shadow: 0 2px 12px rgba(124,58,237,.08);
    }

    /* Centre info card */
    .centre-info-card {
        background: #f0f5ff; border: 1.5px solid #c7d2fe;
        border-radius: 14px; padding: 18px 20px; display: none; margin-top: 8px;
    }

    /* Summary grid */
    #summary-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 14px;
    }
    .summary-item {
        border-bottom: 1px solid var(--border); padding-bottom: 10px;
    }
    .summary-label {
        font-size: 11px; font-weight: 600; color: var(--muted);
        text-transform: uppercase; letter-spacing: .4px; margin-bottom: 2px;
    }
    .summary-value { font-size: 14px; font-weight: 600; color: var(--ink); }

    /* Error box */
    #submit-error-box {
        display: none; margin-top: 14px;
        background: #fef2f2; border: 1.5px solid #fecaca;
        border-radius: 12px; padding: 14px 18px;
        font-size: 13px; color: var(--error); line-height: 1.6;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 860px) {
        .stepper-wrap, .form-wrap { padding-left: 16px; padding-right: 16px; }
    }
    @media (max-width: 640px) {
        .fi, select.fi, textarea.fi { font-size: 16px; }
        .header-inner { padding: 28px 16px 24px; }
        .page-header h1 { font-size: 22px; }
        .trust-row { gap: 8px; }
        .trust-chip { font-size: 10px; padding: 4px 10px; }
        .stepper-wrap { padding: 20px 14px 0; }
        .step-circle { width: 30px; height: 30px; font-size: 11px; }
        .stepper::before { top: 15px; left: 15px; right: 15px; }
        .stepper-progress { top: 15px; left: 15px; }
        .step-label { font-size: 9px; }
        .form-wrap { padding: 14px 12px 48px; }
        .form-panel { border-radius: 18px; }
        .panel-head { padding: 16px 16px 14px; gap: 10px; }
        .ph-icon { width: 40px; height: 40px; font-size: 18px; }
        .ph-title { font-size: 17px; }
        .panel-body { padding: 18px 16px; }
        .panel-footer { padding: 16px; flex-wrap: nowrap; }
        .step-indicator { display: none; }
        .btn-next { padding: 10px 18px; font-size: 13px; white-space: nowrap; flex-shrink: 0; }
        .btn-back { padding: 10px 14px; font-size: 13px; white-space: nowrap; flex-shrink: 0; }
        .row-2 { grid-template-columns: 1fr; gap: 0; }
        .success-screen { padding: 40px 20px; }
        .success-title { font-size: 24px; }
    }
    @media (max-width: 420px) {
        #summary-grid { grid-template-columns: 1fr !important; }
        .step-label { display: none; }
        .step-circle { width: 28px; height: 28px; font-size: 10px; }
        .stepper::before { top: 14px; left: 14px; right: 14px; }
        .stepper-progress { top: 14px; left: 14px; }
        .btn-back .back-text { display: none; }
        .btn-back { padding: 10px 12px; }
        .btn-next { padding: 10px 14px; font-size: 12px; }
    }
</style>

@php
    $centresByState = $centresByState ?? [];
    $courseStates = $courseStates ?? [];
    if (empty($centresByState) && $course->relationLoaded('centers')) {
        foreach ($course->centers as $center) {
            $stateName = $center->state && $center->state->name ? $center->state->name : 'Other';
            if (!isset($centresByState[$stateName])) $centresByState[$stateName] = [];
            $centresByState[$stateName][] = [
                'id' => $center->id,
                'name' => $center->name,
                'fees' => (float) ($center->pivot->fees ?? $center->pivot->fee ?? 0),
                'address' => $center->address ?? '',
                'phone' => $center->phone ?? '',
                'email' => $center->email ?? '',
                'map' => $center->map_link ?? '',
            ];
        }
        $courseStates = array_keys($centresByState);
    }
    $modeMap = [
        'Online' => ['icon' => '💻', 'label' => 'Online — Live Classes'],
        'Offline' => ['icon' => '🏫', 'label' => 'Offline — At Centre'],
        'Hybrid' => ['icon' => '🔄', 'label' => 'Hybrid — Online + Centre'],
    ];
    $modeMeta = $modeMap[$course->mode ?? 'Offline'] ?? $modeMap['Offline'];
@endphp

<main class="main">
    <div class="page-title"></div>

    <header class="page-header">
        <div class="header-inner">
            <a href="{{ url('/') }}" class="header-logo">
                <div class="logo-mark">🛡️</div>
                <span class="logo-text">Threat<span>Expert</span></span>
            </a>
            <div class="header-eyebrow"><i class="bi bi-shield-lock-fill"></i> India's Most Hands-On Cybersecurity Training Institute</div>
            <h1>Enroll in <em>{{ $course->title }}</em></h1>
            <p>
                Since 2020 · 500+ Professionals Trained ·
                {{ $course->centers->count() }} {{ Str::plural('Centre', $course->centers->count()) }}
                across {{ count($courseStates) }} {{ Str::plural('State', count($courseStates)) }}
            </p>
            <div class="trust-row">
                <span class="trust-chip"><i class="bi bi-shield-check-fill"></i> 100% Secure</span>
                <span class="trust-chip"><i class="bi bi-clock-fill"></i> 5 Min to Complete</span>
                <span class="trust-chip"><i class="bi bi-award-fill"></i> Free Demo Class</span>
                <span class="trust-chip"><i class="bi bi-whatsapp"></i> Instant Confirmation</span>
            </div>
        </div>
    </header>

    <div class="mini-progress"><div class="mini-progress-fill" id="miniBar" style="width:0%"></div></div>

    <div class="stepper-wrap">
        <div class="stepper">
            <div class="stepper-progress" id="stepperProgress" style="width:0%"></div>
            <div class="step-item active" id="si-0" onclick="showStep(0)">
                <div class="step-circle">1</div>
                <div class="step-label">Personal</div>
            </div>
            <div class="step-item" id="si-1" onclick="showStep(1)">
                <div class="step-circle">2</div>
                <div class="step-label">Contact</div>
            </div>
            <div class="step-item" id="si-2" onclick="showStep(2)">
                <div class="step-circle">3</div>
                <div class="step-label">Location</div>
            </div>
            <div class="step-item" id="si-3" onclick="showStep(3)">
                <div class="step-circle">4</div>
                <div class="step-label">Course</div>
            </div>
            <div class="step-item" id="si-4" onclick="showStep(4)">
                <div class="step-circle">5</div>
                <div class="step-label">Confirm</div>
            </div>
        </div>
    </div>

    <div class="form-wrap">
        <div class="form-panel">

            {{-- ===================== STEP 1: Personal ===================== --}}
            <div class="step-content active" data-step="0">
                <div class="panel-head">
                    <div class="ph-icon" style="background:#f5f3ff;color:var(--blue);">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div>
                        <div class="ph-step">Step 1 of 5</div>
                        <h2 class="ph-title">Your Personal Details</h2>
                        <p class="ph-sub">Tell us about the professional enrolling for this course.</p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row-2">
                        <div class="field-group">
                            <label>First Name <span class="req">*</span></label>
                            <input class="fi" type="text" id="firstName" placeholder="e.g. Arjun" autocomplete="given-name" />
                            <div class="field-error" id="err-firstName"><i class="bi bi-exclamation-circle"></i> First name is required</div>
                        </div>
                        <div class="field-group">
                            <label>Last Name <span class="req">*</span></label>
                            <input class="fi" type="text" id="lastName" placeholder="e.g. Mehta" autocomplete="family-name" />
                            <div class="field-error" id="err-lastName"><i class="bi bi-exclamation-circle"></i> Last name is required</div>
                        </div>
                    </div>
                    <div class="row-2">
                        <div class="field-group">
                            <label>Date of Birth <span class="req">*</span></label>
                            <input class="fi" type="date" id="dob" />
                            <div class="field-error" id="err-dob"><i class="bi bi-exclamation-circle"></i> Please enter a valid date of birth</div>
                        </div>
                        <div class="field-group">
                            <label>Gender <span class="req">*</span></label>
                            <div class="radio-group">
                                <div class="radio-card">
                                    <input type="radio" name="gender" id="g-male" value="Male" />
                                    <label class="radio-label" for="g-male"><span class="radio-dot"></span> Male</label>
                                </div>
                                <div class="radio-card">
                                    <input type="radio" name="gender" id="g-female" value="Female" />
                                    <label class="radio-label" for="g-female"><span class="radio-dot"></span> Female</label>
                                </div>
                                <div class="radio-card">
                                    <input type="radio" name="gender" id="g-other" value="Other" />
                                    <label class="radio-label" for="g-other"><span class="radio-dot"></span> Other</label>
                                </div>
                            </div>
                            <div class="field-error" id="err-gender"><i class="bi bi-exclamation-circle"></i> Please select a gender</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div></div>
                    <div class="footer-right">
                        <span class="step-indicator">Step <strong>1</strong> of 5</span>
                        <button class="btn-next" onclick="nextStep(0)">Continue <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            {{-- ===================== STEP 2: Contact ===================== --}}
            <div class="step-content" data-step="1">
                <div class="panel-head">
                    <div class="ph-icon" style="background:#ecfdf5;color:#059669;">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div>
                        <div class="ph-step">Step 2 of 5</div>
                        <h2 class="ph-title">Contact &amp; Professional Details</h2>
                        <p class="ph-sub">How can we reach you? And your current professional background.</p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-divider"><span>Contact Information</span></div>
                    <div class="row-2">
                        <div class="field-group">
                            <label>Phone Number <span class="req">*</span></label>
                            <div class="phone-pfx-wrap" id="wrap-phone">
                                <span class="phone-pfx">+91</span>
                                <input class="fi" type="tel" id="phone" placeholder="10-digit number" maxlength="10" inputmode="numeric" />
                                <span class="ajax-indicator" id="ajax-phone"></span>
                            </div>
                            <div class="field-error" id="err-phone"><i class="bi bi-exclamation-circle"></i> A valid 10-digit phone number is required</div>
                            <div class="field-success" id="succ-phone"><i class="bi bi-check-circle-fill"></i> Phone number looks good</div>
                        </div>
                        <div class="field-group">
                            <label>Email Address <span class="req">*</span></label>
                            <div style="position:relative;">
                                <input class="fi" type="email" id="email" placeholder="e.g. arjun@email.com" />
                                <span class="ajax-indicator" id="ajax-email"></span>
                            </div>
                            <div class="field-error" id="err-email"><i class="bi bi-exclamation-circle"></i> A valid email address is required</div>
                            <div class="field-success" id="succ-email"><i class="bi bi-check-circle-fill"></i> Email looks good</div>
                        </div>
                    </div>
                    <div class="field-group">
                        <label>Full Address <span class="req">*</span></label>
                        <textarea class="fi" id="address" placeholder="House no., Street, Area…" style="min-height:80px;"></textarea>
                        <div class="field-error" id="err-address"><i class="bi bi-exclamation-circle"></i> Address is required</div>
                    </div>
                    <div class="form-divider"><span>Professional Details</span></div>
                    <div class="row-2">
                        <div class="field-group">
                            <label>Current Organisation / College <span class="req">*</span></label>
                            <input class="fi" type="text" id="school" placeholder="e.g. Infosys, Jaipur Engineering College" />
                            <div class="field-error" id="err-school"><i class="bi bi-exclamation-circle"></i> Organisation or college name is required</div>
                        </div>
                    </div>
                    <div class="field-group">
                        <label>Prior Cybersecurity Experience / Certifications <span class="req">*</span></label>
                        <textarea class="fi" id="achievements" placeholder="Any prior security training, certifications (CEH, CompTIA, OSCP), CTF experience, or write N/A…" style="min-height:90px;"></textarea>
                        <div class="field-error" id="err-achievements"><i class="bi bi-exclamation-circle"></i> Please enter your experience or write N/A</div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn-back" onclick="prevStep(1)"><i class="bi bi-arrow-left"></i> <span class="back-text">Back</span></button>
                    <div class="footer-right">
                        <span class="step-indicator">Step <strong>2</strong> of 5</span>
                        <button class="btn-next" onclick="nextStep(1)">Continue <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            {{-- ===================== STEP 3: Location ===================== --}}
            <div class="step-content" data-step="2">
                <div class="panel-head">
                    <div class="ph-icon" style="background:#fff7ed;color:#d97706;">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <div class="ph-step">Step 3 of 5</div>
                        <h2 class="ph-title">Location &amp; Centre Selection</h2>
                        <p class="ph-sub">
                            <strong>{{ $course->title }}</strong> is available at
                            <strong>{{ $course->centers->count() }} {{ Str::plural('centre', $course->centers->count()) }}</strong>
                            in <strong>{{ count($courseStates) }} {{ Str::plural('state', count($courseStates)) }}</strong>.
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="field-group">
                        <label>City <span class="req">*</span></label>
                        <select class="fi" id="state" onchange="updateCentres()">
                            <option value="">— Select City —</option>
                            @foreach ($courseStates as $sName)
                                <option value="{{ $sName }}">{{ $sName }}</option>
                            @endforeach
                        </select>
                        <div class="field-error" id="err-state"><i class="bi bi-exclamation-circle"></i> Please select your city</div>
                    </div>
                    <div class="field-group">
                        <label>Threat Expert Training Centre <span class="req">*</span></label>
                        <select class="fi" id="centre" onchange="showCentreInfo()">
                            <option value="">— Select your city first —</option>
                        </select>
                        <div class="field-error" id="err-centre"><i class="bi bi-exclamation-circle"></i> Please select a centre</div>
                    </div>

                    <div class="centre-info-card" id="centre-info-wrap">
                        <div style="display:flex;gap:14px;align-items:flex-start;">
                            <div style="font-size:26px;">📍</div>
                            <div style="flex:1;">
                                <div style="font-size:14px;font-weight:700;color:var(--ink);margin-bottom:4px;" id="ci-name">—</div>
                                <div style="font-size:13px;color:var(--muted);margin-bottom:8px;" id="ci-address">—</div>
                                <div style="display:flex;flex-wrap:wrap;gap:12px;align-items:center;">
                                    <span id="ci-phone-wrap" style="display:none;align-items:center;gap:4px;font-size:12px;color:#059669;font-weight:600;">
                                        <i class="bi bi-telephone-fill"></i> <span id="ci-phone"></span>
                                    </span>
                                    <span id="ci-email-wrap" style="display:none;align-items:center;gap:4px;font-size:12px;color:#7c3aed;font-weight:600;">
                                        <i class="bi bi-envelope-fill"></i> <span id="ci-email"></span>
                                    </span>
                                    <a id="ci-map" href="#" target="_blank" style="display:none;align-items:center;gap:4px;font-size:12px;color:#d97706;font-weight:600;text-decoration:none;">
                                        <i class="bi bi-map-fill"></i> View on Map
                                    </a>
                                    <span id="ci-fee-wrap" style="display:none;align-items:center;gap:6px;font-size:13px;color:#7c3aed;font-weight:700;background:#f5f3ff;padding:5px 14px;border-radius:20px;border:1.5px solid #ede9fe;">
                                        <i class="bi bi-tag-fill"></i> Course Fee: <span id="ci-fee"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field-group" style="margin-top:22px;">
                        <label>Class Mode</label>
                        <div style="background:#f0fdf4;border:1.5px solid #86efac;border-radius:12px;padding:14px 18px;display:flex;align-items:center;gap:14px;">
                            <span style="font-size:26px;">{{ $modeMeta['icon'] }}</span>
                            <div>
                                <div style="font-size:14px;font-weight:700;color:#166534;">{{ $modeMeta['label'] }}</div>
                                <div style="font-size:12px;color:#4ade80;margin-top:2px;">Pre-set for <strong>{{ $course->title }}</strong> — cannot be changed</div>
                            </div>
                            <i class="bi bi-lock-fill ms-auto" style="color:#16a34a;font-size:16px;"></i>
                        </div>
                        <input type="radio" name="mode" value="{{ $modeMeta['label'] }}" checked style="display:none;" />
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn-back" onclick="prevStep(2)"><i class="bi bi-arrow-left"></i> <span class="back-text">Back</span></button>
                    <div class="footer-right">
                        <span class="step-indicator">Step <strong>3</strong> of 5</span>
                        <button class="btn-next" onclick="nextStep(2)">Continue <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            {{-- ===================== STEP 4: Course ===================== --}}
            <div class="step-content" data-step="3">
                <div class="panel-head">
                    <div class="ph-icon" style="background:#f5f3ff;color:#7c3aed;">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <div>
                        <div class="ph-step">Step 4 of 5</div>
                        <h2 class="ph-title">Course &amp; Enrollment Details</h2>
                        <p class="ph-sub">Your selected course is pre-filled. Review the details below.</p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-divider"><span>Your Selected Course</span></div>
                    <div class="course-display">
                        <div class="course-badge">✓ SELECTED</div>
                        <div style="display:flex;gap:18px;align-items:flex-start;flex-wrap:wrap;">
                            <div style="font-size:48px;line-height:1;margin-top:2px;">🛡️</div>
                            <div style="flex:1;min-width:180px;">
                                <div style="font-size:20px;font-weight:900;color:var(--ink);margin-bottom:4px;">{{ $course->title }}</div>
                                @if ($course->category)
                                    <div style="font-size:12px;font-weight:700;color:#7c3aed;margin-bottom:12px;text-transform:uppercase;letter-spacing:.4px;">{{ $course->category->name }}</div>
                                @endif
                                <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:10px;">
                                    @if ($course->age_group)
                                        <span style="background:#f5f3ff;color:#7c3aed;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;">
                                            <i class="bi bi-people-fill"></i> {{ $course->age_group }}
                                        </span>
                                    @endif
                                    @if ($course->duration)
                                        <span style="background:#ede9fe;color:#7c3aed;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;">
                                            <i class="bi bi-clock-fill"></i> {{ $course->duration }}
                                        </span>
                                    @endif
                                    @if ($course->sessions)
                                        <span style="background:#ecfdf5;color:#059669;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;">
                                            <i class="bi bi-calendar-check-fill"></i> {{ $course->sessions }} Sessions
                                        </span>
                                    @endif
                                    <span style="background:#fff7ed;color:#d97706;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;">
                                        {{ $modeMeta['icon'] }} {{ $course->mode }}
                                    </span>
                                </div>
                                @if ($course->description)
                                    <div style="font-size:13px;color:#6b7280;line-height:1.6;margin:0;">{!! Str::limit(strip_tags($course->description), 120) !!}</div>
                                @endif
                            </div>
                            <div class="course-fee-box">
                                <div style="font-size:11px;color:var(--muted);font-weight:700;text-transform:uppercase;letter-spacing:.4px;margin-bottom:4px;">Course Fee</div>
                                <div id="course-fee-display" style="font-size:28px;font-weight:900;color:#7c3aed;line-height:1;">
                                    {{ $course->fees ? '₹' . number_format($course->fees) : '—' }}
                                </div>
                                <div style="font-size:10px;color:#9ca3af;margin-top:3px;" id="course-fee-note">
                                    {{ $course->fees ? 'Incl. of taxes' : 'Select a centre first' }}
                                </div>
                            </div>
                        </div>
                        <input type="radio" name="course" value="{{ $course->title }}" checked style="display:none;" />
                    </div>

                    <div class="form-divider" style="margin-top:24px;"><span>Payment</span></div>
                    <div style="background:#f0f5ff;border:1.5px solid #c7d2fe;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:14px;">
                        <div style="font-size:22px;">💳</div>
                        <div>
                            <div style="font-size:13px;font-weight:700;color:var(--ink);">Payment via Razorpay</div>
                            <div style="font-size:12px;color:var(--muted);">UPI · Cards · Net Banking · Wallets — 100% Secure.</div>
                        </div>
                        <img src="https://razorpay.com/favicon.ico" style="width:22px;height:22px;border-radius:4px;margin-left:auto;" onerror="this.style.display='none'" alt="Razorpay" />
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn-back" onclick="prevStep(3)"><i class="bi bi-arrow-left"></i> <span class="back-text">Back</span></button>
                    <div class="footer-right">
                        <span class="step-indicator">Step <strong>4</strong> of 5</span>
                        <button class="btn-next" onclick="nextStep(3)">Review &amp; Confirm <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            {{-- ===================== STEP 5: Confirm ===================== --}}
            <div class="step-content" data-step="4">
                <div class="panel-head">
                    <div class="ph-icon" style="background:#ecfdf5;color:#059669;">
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <div>
                        <div class="ph-step">Step 5 of 5</div>
                        <h2 class="ph-title">Review &amp; Confirm Enrollment</h2>
                        <p class="ph-sub">Check everything is correct before we confirm your spot.</p>
                    </div>
                </div>
                <div class="panel-body">
                    <div style="background:#f8faff;border:1.5px solid var(--border);border-radius:18px;overflow:hidden;margin-bottom:24px;">
                        <div style="background:linear-gradient(135deg,var(--ink),var(--ink2));padding:16px 22px;display:flex;align-items:center;justify-content:space-between;">
                            <div style="font-family:var(--font-head);font-size:16px;color:#fff;font-weight:700;">Enrollment Summary</div>
                            <div style="font-size:12px;color:rgba(255,255,255,.5);">Review before submitting</div>
                        </div>
                        <div style="padding:22px;">
                            <div id="summary-grid"></div>
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
                                    <a href="{{ route('terms') }}" target="_blank" style="color:var(--blue);font-weight:600;" onclick="event.stopPropagation()">Terms &amp; Conditions</a>
                                    and
                                    <a href="{{ route('refund') }}" target="_blank" style="color:var(--blue);font-weight:600;" onclick="event.stopPropagation()">Cancellation Policy</a>.
                                </span>
                            </div>
                        </label>
                        <label class="check-card" id="chk-newsletter-card" onclick="toggleCheck('newsletter')">
                            <input type="checkbox" id="newsletter" />
                            <div class="check-box" id="chk-newsletter"></div>
                            <div class="check-text">
                                <strong>Subscribe to Updates &amp; Newsletters</strong>
                                <span>Receive updates on new courses, batch schedules, CTF competitions, and cybersecurity events.</span>
                            </div>
                        </label>
                    </div>
                    <div class="field-error" id="err-terms"><i class="bi bi-exclamation-circle"></i> You must agree to the Terms &amp; Conditions to continue</div>
                    <div id="submit-error-box">
                        <div style="font-weight:700;margin-bottom:6px;"><i class="bi bi-exclamation-triangle-fill"></i> Please fix the following:</div>
                        <div id="submit-error-list"></div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn-back" onclick="prevStep(4)"><i class="bi bi-arrow-left"></i> <span class="back-text">Back</span></button>
                    <div class="footer-right">
                        <span class="step-indicator">Final Step</span>
                        <button class="btn-next submit-btn" onclick="submitForm()"><i class="bi bi-check2-circle"></i> Submit Enrollment</button>
                    </div>
                </div>
            </div>

            {{-- ===================== Success Screen ===================== --}}
            <div class="success-screen" id="successScreen">
                <div class="success-anim">🎉</div>
                <div class="success-title">Enrollment Confirmed!</div>
                <p class="success-sub">Your seat has been reserved for <strong>{{ $course->title }}</strong>. Our team will contact you within 24 hours to confirm your batch details and schedule your free demo class.</p>
                <div class="success-ref"><span>Reference ID:</span>&nbsp;<span id="refId">TX-000000</span></div>
                <div style="background:#ecfdf5;border:1.5px solid #86efac;border-radius:14px;padding:16px 20px;margin:16px 0;text-align:left;">
                    <div style="font-size:13px;font-weight:700;color:#166534;margin-bottom:4px;"><i class="bi bi-check-circle-fill"></i> What happens next?</div>
                    <ul style="font-size:13px;color:#166534;margin:0;padding-left:18px;line-height:2;">
                        <li>You'll receive a confirmation shortly</li>
                        <li>Our team will call to confirm your batch timing and lab access</li>
                        <li>Free demo class will be scheduled within 48 hours</li>
                    </ul>
                </div>
                <div class="success-actions">
                    <a href="{{ url('/') }}" class="btn-home"><i class="bi bi-house"></i> Back to Home</a>
                </div>
            </div>

            {{-- ===================== Failed Screen ===================== --}}
            <div class="success-screen" id="failedScreen">
                <div class="success-anim failed">❌</div>
                <div class="success-title" style="color:#dc2626;">Payment Failed</div>
                <p class="success-sub">Your enrollment details have been saved. Please try the payment again or contact us for immediate assistance.</p>
                <div style="background:#fff7ed;border:1.5px solid #fed7aa;border-radius:14px;padding:16px 20px;margin:16px 0;text-align:left;">
                    <div style="font-size:13px;font-weight:700;color:#92400e;margin-bottom:4px;"><i class="bi bi-info-circle-fill"></i> What to do next?</div>
                    <ul style="font-size:13px;color:#92400e;margin:0;padding-left:18px;line-height:2;">
                        <li>Click "Retry Payment" to try again with your saved details</li>
                        <li>Contact us for instant assistance</li>
                    </ul>
                </div>
                <div class="success-actions">
                    <button onclick="retryPayment()" class="btn-wa" style="background:#dc2626;border:none;cursor:pointer;"><i class="bi bi-arrow-repeat"></i> Retry Payment</button>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
    var CENTRE_DATA = @json($centresByState);
    var COURSE_STATES = @json($courseStates);
    var COURSE_ID = {{ $course->id }};
    var COURSE_TITLE = {{ json_encode($course->title) }};

    var _enrollmentId = null;
    var _silentSaveDone = false;
    var _ajaxTimers = {};
    var _ajaxCache = {};

    // ── Ajax field validation ──────────────────────────────────────────────
    function ajaxValidateField(fieldId, value) {
        var indicator = document.getElementById('ajax-' + fieldId);
        var errEl = document.getElementById('err-' + fieldId);
        var succEl = document.getElementById('succ-' + fieldId);
        if (!indicator) return;

        var cacheKey = fieldId + ':' + value;
        if (_ajaxCache[cacheKey] !== undefined) {
            applyAjaxResult(fieldId, _ajaxCache[cacheKey]);
            return;
        }

        clearTimeout(_ajaxTimers[fieldId]);
        indicator.className = 'ajax-indicator checking';
        if (errEl) errEl.classList.remove('show');
        if (succEl) succEl.classList.remove('show');

        _ajaxTimers[fieldId] = setTimeout(function() {
            fetch('{{ route('enrollment.validate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ field: fieldId, value: value })
                })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    var result = { ok: data.valid === true, message: data.message || '' };
                    _ajaxCache[cacheKey] = result;
                    applyAjaxResult(fieldId, result);
                })
                .catch(function() { indicator.className = 'ajax-indicator'; });
        }, 550);
    }

    function applyAjaxResult(fieldId, result) {
        var indicator = document.getElementById('ajax-' + fieldId);
        var errEl = document.getElementById('err-' + fieldId);
        var succEl = document.getElementById('succ-' + fieldId);
        var inputEl = document.getElementById(fieldId);

        if (result.ok) {
            if (indicator) indicator.className = 'ajax-indicator ok';
            if (errEl) errEl.classList.remove('show');
            if (inputEl) inputEl.classList.remove('has-error');
            if (succEl) succEl.classList.add('show');
        } else {
            if (indicator) indicator.className = 'ajax-indicator bad';
            if (errEl) {
                if (result.message) errEl.innerHTML = '<i class="bi bi-exclamation-circle"></i> ' + result.message;
                errEl.classList.add('show');
            }
            if (inputEl) inputEl.classList.add('has-error');
            if (succEl) succEl.classList.remove('show');
        }
    }

    document.getElementById('phone').addEventListener('blur', function() {
        var digits = this.value.replace(/\D/g, '');
        if (digits.length === 10) ajaxValidateField('phone', '+91' + digits);
    });
    document.getElementById('phone').addEventListener('input', function() {
        var ind = document.getElementById('ajax-phone');
        var suc = document.getElementById('succ-phone');
        if (ind) ind.className = 'ajax-indicator';
        if (suc) suc.classList.remove('show');
        _ajaxCache = Object.fromEntries(Object.entries(_ajaxCache).filter(function(e) {
            return !e[0].startsWith('phone:');
        }));
    });

    // Restrict phone input to digits only
    var phoneEl = document.getElementById('phone');
    if (phoneEl) phoneEl.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });

    document.getElementById('email').addEventListener('blur', function() {
        var val = this.value.trim();
        if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) ajaxValidateField('email', val);
    });
    document.getElementById('email').addEventListener('input', function() {
        var ind = document.getElementById('ajax-email');
        var suc = document.getElementById('succ-email');
        if (ind) ind.className = 'ajax-indicator';
        if (suc) suc.classList.remove('show');
        _ajaxCache = Object.fromEntries(Object.entries(_ajaxCache).filter(function(e) {
            return !e[0].startsWith('email:');
        }));
    });

    // ── Centre helpers ─────────────────────────────────────────────────────
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
                o.dataset.id = list[i].id || '';
                o.dataset.fees = list[i].fees || '';
                o.dataset.address = list[i].address || '';
                o.dataset.phone = list[i].phone || '';
                o.dataset.email = list[i].email || '';
                o.dataset.map = list[i].map || '';
                sel.appendChild(o);
            }
        }
    }

    function showCentreInfo() {
        var sel = document.getElementById('centre');
        var wrap = document.getElementById('centre-info-wrap');
        var opt = sel.options[sel.selectedIndex];

        if (!opt || !opt.value) { wrap.style.display = 'none'; return; }

        document.getElementById('ci-name').textContent = opt.value;
        document.getElementById('ci-address').textContent = opt.dataset.address || '—';

        var phoneWrap = document.getElementById('ci-phone-wrap');
        var emailWrap = document.getElementById('ci-email-wrap');
        var mapLink = document.getElementById('ci-map');
        var feeWrap = document.getElementById('ci-fee-wrap');
        var feeEl = document.getElementById('ci-fee');

        phoneWrap.style.display = opt.dataset.phone ? 'inline-flex' : 'none';
        if (opt.dataset.phone) document.getElementById('ci-phone').textContent = opt.dataset.phone;

        emailWrap.style.display = opt.dataset.email ? 'inline-flex' : 'none';
        if (opt.dataset.email) document.getElementById('ci-email').textContent = opt.dataset.email;

        if (opt.dataset.map) {
            mapLink.href = opt.dataset.map;
            mapLink.style.display = 'inline-flex';
        } else {
            mapLink.style.display = 'none';
        }

        var fee = parseFloat(opt.dataset.fees || 0);
        if (fee > 0) {
            var formatted = '₹' + fee.toLocaleString('en-IN');
            feeEl.textContent = formatted;
            feeWrap.style.display = 'inline-flex';
            document.getElementById('course-fee-display').textContent = formatted;
            document.getElementById('course-fee-note').textContent = 'Incl. of taxes';
        } else {
            feeWrap.style.display = 'none';
            document.getElementById('course-fee-display').textContent = '—';
            document.getElementById('course-fee-note').textContent = 'Select a centre first';
        }

        wrap.style.display = 'block';
    }

    function getSelectedCentre() {
        var sel = document.getElementById('centre');
        var opt = sel.options[sel.selectedIndex];
        return {
            id: (opt && opt.dataset.id) ? opt.dataset.id : '',
            fees: (opt && opt.dataset.fees) ? opt.dataset.fees : '',
        };
    }

    // ── Checkboxes ─────────────────────────────────────────────────────────
    function toggleCheck(id) {
        var inp = document.getElementById(id);
        var card = document.getElementById('chk-' + id + '-card');
        inp.checked = !inp.checked;
        card.classList.toggle('checked', inp.checked);
        if (id === 'terms') document.getElementById('err-terms').classList.remove('show');
    }

    // ── Stepper ────────────────────────────────────────────────────────────
    var currentStep = 0;
    var TOTAL_STEPS = 5;

    function showStep(step) {
        try {
            for (var i = 0; i < TOTAL_STEPS; i++) {
                var si = document.getElementById('si-' + i);
                if (!si) continue;
                var circle = si.querySelector('.step-circle');
                si.className = 'step-item' + (i < step ? ' done' : '') + (i === step ? ' active' : '');
                if (circle) circle.textContent = i < step ? '✓' : String(i + 1);
            }
            var pct = step === 0 ? 0 : (step / (TOTAL_STEPS - 1)) * 100;
            var sp = document.getElementById('stepperProgress');
            if (sp) sp.style.width = pct + '%';
            var mb = document.getElementById('miniBar');
            if (mb) mb.style.width = ((step + 1) / TOTAL_STEPS * 100) + '%';

            var steps = document.querySelectorAll('.step-content');
            for (var j = 0; j < steps.length; j++) {
                var el = steps[j];
                if (j === step) {
                    el.classList.add('active');
                    el.style.display = 'block';
                } else {
                    el.classList.remove('active');
                    el.style.display = 'none';
                }
            }
            currentStep = step;
            try { window.scrollTo({ top: 0, behavior: 'smooth' }); } catch (e) {}
        } catch (e) {
            var all = document.querySelectorAll('.step-content');
            for (var k = 0; k < all.length; k++) {
                all[k].style.display = (k === step) ? 'block' : 'none';
            }
            currentStep = step;
        }
    }

    function showErr(id, show) {
        var el = document.getElementById('err-' + id);
        if (el) el.classList.toggle('show', show);
        var fi = document.getElementById(id);
        if (fi) fi.classList.toggle('has-error', show);
        var wrap = document.getElementById('wrap-' + id);
        if (wrap) wrap.classList.toggle('has-error', show);
    }

    // ── Validation ─────────────────────────────────────────────────────────
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
            var dobOk = dobVal !== '' && !isNaN(new Date(dobVal).getTime());
            req('dob', dobOk);
            req('gender', document.querySelector('input[name="gender"]:checked') !== null);
        } else if (step === 1) {
            var phoneEl = document.getElementById('phone');
            var phoneVal = phoneEl ? phoneEl.value.replace(/\D/g, '') : '';
            req('phone', phoneVal.length === 10);
            var emailVal = document.getElementById('email').value.trim();
            req('email', /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal));
            req('address', document.getElementById('address').value.trim() !== '');
            req('school', document.getElementById('school').value.trim() !== '');
            var ach = document.getElementById('achievements').value.trim();
            req('achievements', ach !== '');
        } else if (step === 2) {
            req('state', document.getElementById('state').value !== '');
            req('centre', document.getElementById('centre').value !== '');
        } else if (step === 3) {
            req('course', document.querySelector('input[name="course"]:checked') !== null);
        } else if (step === 4) {
            var terms = document.getElementById('terms').checked;
            showErr('terms', !terms);
            if (!terms) ok = false;
        }
        return ok;
    }

    function nextStep(step) {
        if (!validateStep(step)) return;
        if (step === 2 && !_silentSaveDone) silentSave();
        if (step === 3) buildSummary();
        showStep(step + 1);
    }

    function prevStep(step) {
        showStep(step - 1);
    }

    // ── Helpers ────────────────────────────────────────────────────────────
    function getVal(id) {
        var el = document.getElementById(id);
        return (el && el.value) ? el.value : '';
    }
    function radioVal(name) {
        var el = document.querySelector('input[name="' + name + '"]:checked');
        return el ? el.value : '';
    }

    // ── Silent save (lead) ─────────────────────────────────────────────────
    function silentSave() {
        var centre = getSelectedCentre();
        var phoneVal = getVal('phone').replace(/\D/g, '');
        var payload = {
            _token: '{{ csrf_token() }}',
            course_id: COURSE_ID,
            first_name: getVal('firstName'),
            last_name: getVal('lastName'),
            dob: getVal('dob'),
            gender: radioVal('gender'),
            phone: phoneVal.length === 10 ? '+91' + phoneVal : '',
            email: getVal('email'),
            address: getVal('address'),
            school: getVal('school'),
            achievements: getVal('achievements'),
            state: getVal('state'),
            city: getVal('state'),
            centre: getVal('centre'),
            centre_id: centre.id,
            mode: radioVal('mode'),
            course: COURSE_TITLE,
            is_lead: 1,
        };
        fetch('{{ route('enrollment.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload),
            })
            .then(function(res) { return res.ok ? res.json() : null; })
            .then(function(data) {
                if (data && data.enrollment_id) {
                    _enrollmentId = data.enrollment_id;
                    _silentSaveDone = true;
                }
            })
            .catch(function() {});
    }

    // ── Summary builder ────────────────────────────────────────────────────
    function buildSummary() {
        var centre = getSelectedCentre();
        var fee = parseFloat(centre.fees || 0);
        var feeText = fee > 0 ? '₹' + fee.toLocaleString('en-IN') : '—';

        var items = [
            ['Student Name', getVal('firstName') + ' ' + getVal('lastName')],
            ['Date of Birth', getVal('dob')],
            ['Gender', radioVal('gender')],
            ['Phone', getVal('phone') ? '+91 ' + getVal('phone').replace(/\D/g, '') : '—'],
            ['Email', getVal('email')],
            ['Address', getVal('address')],
            ['School / College', getVal('school')],
            ['Experience / Certifications', getVal('achievements')],
            ['City', getVal('state')],
            ['Centre', getVal('centre')],
            ['Mode', radioVal('mode')],
            ['Course', COURSE_TITLE],
            ['Course Fee', feeText],
        ];

        var grid = document.getElementById('summary-grid');
        grid.innerHTML = '';
        for (var i = 0; i < items.length; i++) {
            var div = document.createElement('div');
            div.className = 'summary-item';

            var label = document.createElement('div');
            label.className = 'summary-label';
            label.textContent = items[i][0];

            var value = document.createElement('div');
            value.className = 'summary-value';
            value.textContent = items[i][1];

            div.appendChild(label);
            div.appendChild(value);
            grid.appendChild(div);
        }
    }

    // ── Result screens ─────────────────────────────────────────────────────
    function showResultScreen(screenId) {
        document.querySelectorAll('.step-content').forEach(function(el) {
            el.style.display = 'none';
        });
        document.getElementById(screenId).style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ── Submit ─────────────────────────────────────────────────────────────
    function submitForm() {
        if (!validateStep(4)) return;

        var centre = getSelectedCentre();
        var payload = {
            _token: '{{ csrf_token() }}',
            course_id: COURSE_ID,
            first_name: getVal('firstName'),
            last_name: getVal('lastName'),
            dob: getVal('dob'),
            gender: radioVal('gender'),
            phone: '+91' + getVal('phone').replace(/\D/g, ''),
            email: getVal('email'),
            address: getVal('address'),
            school: getVal('school'),
            achievements: getVal('achievements'),
            state: getVal('state'),
            city: getVal('state'),
            centre: getVal('centre'),
            centre_id: centre.id,
            mode: radioVal('mode'),
            course: COURSE_TITLE,
            newsletter_subscribed: document.getElementById('newsletter').checked ? 1 : 0,
            terms_accepted: document.getElementById('terms').checked ? 1 : 0,
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
                        var lines = [];
                        if (data.errors) {
                            lines = Object.values(data.errors).flat();
                        } else if (data.message) {
                            lines = [data.message];
                        } else {
                            lines = ['Validation failed. Please check all fields.'];
                        }
                        showSubmitError(lines);
                        btn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-check2-circle"></i> Submit Enrollment';
                    });
                }
                if (!res.ok) {
                    return res.text().then(function() {
                        showSubmitError(['Server error (' + res.status + '). Please try again.']);
                        btn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-check2-circle"></i> Submit Enrollment';
                    });
                }
                return res.json();
            })
            .then(function(data) {
                if (!data || !data.success) return;
                hideSubmitError();
                window.location.href = data.payment_url;
            })
            .catch(function() {
                showSubmitError(['Network error. Please check your connection and try again.']);
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-check2-circle"></i> Submit Enrollment';
            });
    }

    function showSubmitError(lines) {
        var box = document.getElementById('submit-error-box');
        var list = document.getElementById('submit-error-list');
        if (!box || !list) return;
        list.innerHTML = lines.map(function(l) {
            return '<div>• ' + l + '</div>';
        }).join('');
        box.style.display = 'block';
        box.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function hideSubmitError() {
        var box = document.getElementById('submit-error-box');
        if (box) box.style.display = 'none';
    }

    // ── Retry ──────────────────────────────────────────────────────────────
    function retryPayment() {
        document.getElementById('failedScreen').style.display = 'none';
        document.querySelectorAll('.step-content').forEach(function(el) {
            el.style.display = 'none';
        });
        var btn = document.querySelector('.submit-btn');
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-check2-circle"></i> Submit Enrollment';
        currentStep = 4;
        showStep(4);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    showStep(0);
</script>

@endsection