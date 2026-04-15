@extends('frontend.course.layout')
@section('content')
    {{--
    resources/views/frontend/event/register.blade.php
    Variables: $sub, $booked, $avail, $isFull, $centres
--}}
    @php
        use Carbon\Carbon;
        $event = $sub->event;
        $pct = $sub->max_seats && $sub->max_seats > 0 ? min(100, round(($booked / $sub->max_seats) * 100)) : 0;
        $isLow = $avail !== null && $avail > 0 && $avail <= 5;
        $maxTickets = $avail !== null ? min($avail, 10) : 10;
        $oldAtts = old('attendees', [
            ['name' => '', 'phone' => '', 'email' => '', 'dob' => '', 'gender' => '', 'institution' => ''],
        ]);
        $oldPrimary = (int) old('primary_ticket', 0);
    @endphp

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap"
        rel="stylesheet">
    <script>
        window.__RZP_KEY__ = '{{ config('services.razorpay.key') }}';
    </script>

    <style>
        :root {
            --ink: #0c1825;
            --soft: #455a70;
            --mute: #8fa8bf;
            --blue: #1a4fd6;
            --bdk: #1240b0;
            --blt: #eef3ff;
            --bd: #d5e2f0;
            --bg: #f4f8ff;
            --w: #fff;
            --gr: #0b7a52;
            --glt: #e6f7f1;
            --am: #b05a08;
            --alt: #fff3e0;
            --rd: #c0181c;
            --rlt: #fdeaea;
            --R: 14px;
            --H: 'Bricolage Grotesque', sans-serif;
            --B: 'Bricolage Grotesque', sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .pg {
            background: var(--bg);
            min-height: 100vh;
            font-family: var(--B);
        }

        .bc {
            background: var(--w);
            border-bottom: 1px solid var(--bd);
            padding: 10px 0;
            margin-top: 185px;
            font-size: 12px;
            color: var(--mute);
        }

        .bc a {
            color: var(--mute);
            text-decoration: none;
        }

        .bc a:hover {
            color: var(--blue);
        }

        .bc .s {
            margin: 0 6px;
        }

        .hero {
            background: var(--ink);
            overflow: hidden;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 90% 70% at 65% 40%, rgba(26, 79, 214, .4) 0%, transparent 65%);
            pointer-events: none;
        }

        .hero-inner {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 0;
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 44px 24px 38px;
        }

        @media(max-width:860px) {
            .hero-inner {
                grid-template-columns: 1fr;
                gap: 28px;
            }
        }

        @media(max-width:600px) {
            .hero-inner {
                padding: 28px 16px 24px;
            }

            .sp-big {
                font-size: 32px;
            }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .15);
            color: #93c5fd;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 14px;
        }

        .hero h1 {
            font-size: clamp(20px, 3vw, 34px);
            font-weight: 800;
            color: #fff;
            line-height: 1.18;
            margin-bottom: 10px;
        }

        .hero-desc {
            font-family: 'Instrument Serif', serif;
            font-style: italic;
            font-size: 14px;
            color: rgba(255, 255, 255, .52);
            line-height: 1.7;
            margin-bottom: 20px;
            max-width: 520px;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, .07);
            border: 1px solid rgba(255, 255, 255, .13);
            color: rgba(255, 255, 255, .82);
            font-size: 11.5px;
            font-weight: 600;
            padding: 4px 11px;
            border-radius: 20px;
        }

        .chip i {
            color: #93c5fd;
            font-size: 11px;
        }

        .seat-panel {
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 16px;
            padding: 24px 22px;
            min-width: 200px;
            align-self: center;
        }

        .sp-lbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .9px;
            color: rgba(255, 255, 255, .35);
            margin-bottom: 8px;
        }

        .sp-big {
            font-size: 46px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
            font-family: var(--H);
        }

        .sp-big.low {
            color: #fbbf24;
        }

        .sp-big.full {
            color: #f87171;
        }

        .sp-of {
            font-size: 11px;
            color: rgba(255, 255, 255, .35);
            margin-bottom: 12px;
        }

        .sp-bar-bg {
            height: 5px;
            background: rgba(255, 255, 255, .1);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 6px;
        }

        .sp-bar-fill {
            height: 100%;
            border-radius: 5px;
            background: #3b82f6;
        }

        .sp-bar-fill.low {
            background: #f59e0b;
        }

        .sp-bar-fill.full {
            background: #ef4444;
        }

        .sp-note {
            font-size: 11px;
            color: rgba(255, 255, 255, .35);
        }

        .sp-fee {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid rgba(255, 255, 255, .09);
        }

        .sp-fee-lbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: rgba(255, 255, 255, .35);
            margin-bottom: 3px;
        }

        .sp-fee-val {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            font-family: var(--H);
        }

        .sp-fee-val.free {
            color: #4ade80;
        }

        .body {
            padding: 40px 0 80px;
        }

        .card {
            background: var(--w);
            border-radius: var(--R);
            border: 1.5px solid var(--bd);
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(12, 24, 37, .05);
            margin-bottom: 20px;
        }

        .card:last-child {
            margin-bottom: 0;
        }

        .ch {
            padding: 14px 22px;
            background: var(--blt);
            border-bottom: 1px solid var(--bd);
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .ch-step {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--blue);
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ch h4 {
            font-size: 14px;
            font-weight: 800;
            color: var(--ink);
            margin: 0;
        }

        .ch p {
            font-size: 11px;
            color: var(--mute);
            margin: 0;
        }

        .cb {
            padding: 22px;
        }

        .sig {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(148px, 1fr));
            gap: 9px;
            margin-bottom: 16px;
        }

        .si-box {
            background: var(--bg);
            border: 1px solid var(--bd);
            border-radius: 10px;
            padding: 12px 13px;
        }

        .si-lbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--mute);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 4px;
        }

        .si-lbl i {
            color: var(--blue);
            font-size: 11px;
        }

        .si-val {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }

        .si-val.free {
            color: var(--gr);
        }

        .desc-txt {
            background: var(--bg);
            border: 1px solid var(--bd);
            border-radius: 10px;
            padding: 14px 15px;
            font-size: 13px;
            color: var(--soft);
            line-height: 1.72;
            margin-bottom: 14px;
        }

        .ctrs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 6px;
        }

        .ctr {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--blt);
            border: 1px solid #c7d7fa;
            color: var(--blue);
            font-size: 11.5px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 8px;
        }

        .ctr-s {
            font-size: 10px;
            opacity: .6;
        }

        .ctr-option {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 14px;
            border: 1.5px solid var(--bd);
            border-radius: 11px;
            cursor: pointer;
            transition: border-color .18s, background .18s;
            margin-bottom: 8px;
        }

        .ctr-option:last-child {
            margin-bottom: 0;
        }

        .ctr-option:hover {
            border-color: #a5b4fc;
            background: var(--blt);
        }

        .ctr-option.selected {
            border-color: var(--blue);
            background: var(--blt);
            box-shadow: 0 0 0 3px rgba(26, 79, 214, .08);
        }

        .ctr-radio {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid var(--bd);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color .15s, background .15s;
        }

        .ctr-option.selected .ctr-radio {
            border-color: var(--blue);
            background: var(--blue);
        }

        .ctr-option.selected .ctr-radio::after {
            content: '';
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #fff;
            display: block;
        }

        .ctr-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }

        .ctr-meta {
            font-size: 11.5px;
            color: var(--mute);
            margin-top: 1px;
        }

        .ctr-required-msg {
            font-size: 12px;
            color: var(--rd);
            margin-top: 8px;
            display: none;
            align-items: center;
            gap: 5px;
        }

        .ctr-required-msg.show {
            display: flex;
        }

        /* ── Fields ── */
        .fg {
            margin-bottom: 16px;
        }

        .fg:last-child {
            margin-bottom: 0;
        }

        .fl {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--ink);
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 6px;
        }

        .fl .req {
            color: var(--rd);
            margin-left: 2px;
        }

        .fl .opt {
            font-weight: 400;
            opacity: .5;
            font-size: 10px;
            margin-left: 3px;
            text-transform: none;
            letter-spacing: 0;
        }

        .fi,
        .fs {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--bd);
            border-radius: 10px;
            font-family: var(--B);
            font-size: 14px;
            color: var(--ink);
            background: var(--w);
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            transition: border-color .16s, box-shadow .16s;
        }

        .fi::placeholder {
            color: #b8c8d8;
        }

        .fi:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(26, 79, 214, .09);
        }

        /* Validation states */
        .fi.v-err {
            border-color: var(--rd) !important;
            box-shadow: 0 0 0 3px rgba(192, 24, 28, .07) !important;
        }

        .fi.v-ok {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, .07) !important;
        }

        .v-msg {
            font-size: 11px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .v-msg.err {
            color: var(--rd);
        }

        .v-msg.ok {
            color: #10b981;
        }

        .v-msg.hidden {
            display: none;
        }

        .f-hint {
            font-size: 11px;
            color: var(--mute);
            margin-top: 4px;
        }

        /* Global validation banner */
        .val-banner {
            background: var(--rlt);
            border: 1px solid #fca5a5;
            border-radius: 11px;
            padding: 13px 16px;
            margin-bottom: 18px;
            display: none;
        }

        .val-banner.show {
            display: block;
        }

        .val-banner .vb-t {
            font-weight: 700;
            color: var(--rd);
            font-size: 13px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .val-banner ul {
            margin: 0;
            padding-left: 18px;
            font-size: 12.5px;
            color: var(--rd);
        }

        .val-banner ul li {
            margin-bottom: 3px;
        }

        /* Ticket counter */
        .tc-wrap {
            display: flex;
            align-items: center;
            border: 1.5px solid var(--bd);
            border-radius: 11px;
            overflow: hidden;
            width: fit-content;
        }

        .tc-btn {
            width: 44px;
            height: 44px;
            background: var(--blt);
            border: none;
            font-size: 20px;
            font-weight: 700;
            color: var(--blue);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .13s;
            flex-shrink: 0;
        }

        .tc-btn:hover {
            background: #dce8ff;
        }

        .tc-btn:disabled {
            color: #ccc;
            cursor: not-allowed;
            background: var(--blt);
        }

        .tc-num {
            width: 54px;
            text-align: center;
            font-size: 18px;
            font-weight: 800;
            color: var(--ink);
            border: none;
            border-left: 1px solid var(--bd);
            border-right: 1px solid var(--bd);
            outline: none;
            background: #fff;
            height: 44px;
            padding: 0;
            font-family: var(--H);
        }

        /* Attendee cards */
        .att-card {
            border: 1.5px solid var(--bd);
            border-radius: 13px;
            padding: 18px;
            margin-bottom: 14px;
            background: var(--bg);
            transition: border-color .2s, box-shadow .2s;
        }

        .att-card.is-primary {
            border-color: #93c5fd;
            background: #eef6ff;
            box-shadow: 0 0 0 3px rgba(26, 79, 214, .07);
        }

        .att-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .att-num-badge {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--soft);
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .att-card.is-primary .att-num-badge {
            background: var(--blue);
        }

        .att-title {
            font-size: 13px;
            font-weight: 800;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .primary-star {
            color: var(--blue);
            font-size: 14px;
        }

        .btn-set-primary {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 8px;
            cursor: pointer;
            border: 1.5px solid var(--bd);
            background: var(--w);
            color: var(--mute);
            transition: all .15s;
        }

        .btn-set-primary:hover {
            border-color: var(--blue);
            color: var(--blue);
            background: var(--blt);
        }

        .primary-tag {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--blue);
            background: rgba(26, 79, 214, .1);
            padding: 2px 8px;
            border-radius: 6px;
        }

        .btn-remove {
            background: none;
            border: 1px solid var(--bd);
            border-radius: 7px;
            width: 28px;
            height: 28px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--mute);
            transition: all .15s;
            flex-shrink: 0;
        }

        .btn-remove:hover {
            border-color: var(--rd);
            color: var(--rd);
        }

        .gender-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .gp {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border: 1.5px solid var(--bd);
            border-radius: 10px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: var(--soft);
            background: var(--w);
            transition: all .15s;
            user-select: none;
        }

        .gp:hover {
            border-color: #a5b4fc;
            background: var(--blt);
        }

        .gp.active {
            border-color: var(--blue);
            background: var(--blt);
            color: var(--blue);
        }

        .gp i {
            font-size: 14px;
        }

        /* Submit */
        .btn-go {
            width: 100%;
            padding: 14px;
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: var(--H);
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 6px 22px rgba(26, 79, 214, .26);
            transition: background .2s, transform .15s;
            margin-top: 20px;
        }

        .btn-go:hover:not(:disabled) {
            background: var(--bdk);
            transform: translateY(-2px);
        }

        .btn-go:disabled {
            background: #a5b4fc;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        .spin {
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 2px solid rgba(255, 255, 255, .3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: sp .6s linear infinite;
        }

        @keyframes sp {
            to {
                transform: rotate(360deg);
            }
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: 82px;
        }

        @media(max-width:768px) {
            .sidebar {
                position: static;
            }
        }

        .sc {
            background: var(--w);
            border-radius: var(--R);
            border: 1.5px solid var(--bd);
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(12, 24, 37, .05);
            margin-bottom: 16px;
        }

        .sc:last-child {
            margin-bottom: 0;
        }

        .sc-head {
            background: linear-gradient(135deg, var(--ink), #1a3360);
            padding: 15px 18px;
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .sc-head i {
            color: #93c5fd;
            font-size: 16px;
        }

        .sc-head h5 {
            font-size: 13px;
            font-weight: 800;
            color: #fff;
            margin: 0;
            font-family: var(--H);
        }

        .sc-ev {
            padding: 12px 16px;
            background: var(--blt);
            border-bottom: 1px solid var(--bd);
        }

        .sc-ev .ek {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--blue);
            margin-bottom: 2px;
        }

        .sc-ev .ev {
            font-size: 13px;
            font-weight: 800;
            color: var(--ink);
            line-height: 1.3;
            font-family: var(--H);
        }

        .sc-rows {
            padding: 12px 16px;
            border-bottom: 1px solid var(--bd);
        }

        .sc-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 7px 0;
            border-bottom: 1px dashed #e5edf8;
            font-size: 12.5px;
            gap: 8px;
        }

        .sc-row:last-child {
            border-bottom: none;
        }

        .sc-row .rk {
            color: var(--mute);
            display: flex;
            align-items: center;
            gap: 4px;
            flex-shrink: 0;
        }

        .sc-row .rk i {
            color: var(--blue);
            font-size: 11px;
        }

        .sc-row .rv {
            font-weight: 700;
            color: var(--ink);
            text-align: right;
            font-family: var(--H);
        }

        .sc-row .rv.free {
            color: var(--gr);
        }

        .sc-seat {
            padding: 12px 16px;
            border-bottom: 1px solid var(--bd);
        }

        .ss-lbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--mute);
            margin-bottom: 6px;
        }

        .ss-bg {
            height: 5px;
            background: #e4edf8;
            border-radius: 5px;
            overflow: hidden;
        }

        .ss-fill {
            height: 100%;
            border-radius: 5px;
            background: var(--blue);
        }

        .ss-fill.low {
            background: #f59e0b;
        }

        .ss-fill.full {
            background: #ef4444;
        }

        .ss-txt {
            font-size: 11px;
            color: var(--mute);
            margin-top: 3px;
        }

        .ss-txt.low {
            color: var(--am);
            font-weight: 700;
        }

        .sc-total {
            padding: 14px 16px;
            background: var(--blt);
        }

        .sc-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sc-total-lbl {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--mute);
        }

        .sc-total-val {
            font-size: 22px;
            font-weight: 900;
            color: var(--blue);
            font-family: var(--H);
        }

        .sc-total-val.free {
            color: var(--gr);
        }

        .sc-total-note {
            font-size: 11px;
            color: var(--mute);
            margin-top: 2px;
        }

        .sc-status {
            padding: 9px 16px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--soft);
            border-top: 1px solid var(--bd);
        }

        .sdot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .sdot.open {
            background: #10b981;
        }

        .sdot.low {
            background: #f59e0b;
        }

        .sdot.full {
            background: #ef4444;
        }

        .sc-loc {
            padding: 10px 16px;
            border-top: 1px solid var(--bd);
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: var(--soft);
        }

        .sc-loc i {
            color: var(--blue);
            font-size: 13px;
        }

        .sc-loc .loc-name {
            font-weight: 700;
            color: var(--ink);
        }

        .sc-help {
            padding: 12px 16px;
        }

        .sc-help a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 12.5px;
            font-weight: 600;
            transition: background .15s;
            margin-bottom: 7px;
        }

        .sc-help a:last-child {
            margin-bottom: 0;
        }

        .hw {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16803d;
        }

        .hw:hover {
            background: #dcfce7;
            color: #16803d;
        }

        .hw i {
            color: #22c55e;
            font-size: 15px;
        }

        .hp {
            background: var(--blt);
            border: 1px solid #c7d7fa;
            color: var(--blue);
        }

        .hp:hover {
            background: #dce8ff;
            color: var(--blue);
        }

        .a-full {
            background: var(--rlt);
            border: 1px solid #fca5a5;
            border-radius: 11px;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--rd);
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .a-low {
            background: var(--alt);
            border: 1px solid #fcd34d;
            border-radius: 11px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--am);
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 14px;
        }

        .divider-lbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--mute);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .divider-lbl::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--bd);
        }
    </style>

    <div class="pg">

        {{-- BREADCRUMB --}}
        <div class="bc">
            <div class="container d-flex align-items-center flex-wrap">
                <a href="{{ url('/') }}"><i class="bi bi-house me-1"></i>Home</a>
                <span class="s">/</span><a href="#">Events</a>
                <span class="s">/</span>
                <a href="{{ route('frontend.events.subevent', $event->slug) }}">{{ Str::limit($event->title, 30) }}</a>
                <span class="s">/</span>
                <span style="color:var(--ink);font-weight:700;">{{ Str::limit($sub->title, 26) }}</span>
                <span class="s">/</span>
                <span style="color:var(--blue);font-weight:700;">Register</span>
            </div>
        </div>

        {{-- HERO --}}
        <div class="hero">
            @if ($sub->banner_image)
                <div
                    style="position:absolute;inset:0;background-image:url('{{ asset($sub->banner_image) }}');background-size:cover;background-position:center;z-index:0;">
                </div>
                <div
                    style="position:absolute;inset:0;background:linear-gradient(to right,rgba(12,24,37,.93) 0%,rgba(12,24,37,.72) 55%,rgba(12,24,37,.38) 100%);z-index:1;">
                </div>
            @endif
            <div class="hero-inner" style="position:relative;z-index:2;">
                <div>
                    <div class="hero-badge"><i class="bi bi-collection-fill"></i>{{ $event->title }}</div>
                    <h1>{{ $sub->title }}</h1>
                    @if ($sub->description)
                        <p class="hero-desc">{{ Str::limit(strip_tags($sub->description), 120) }}</p>
                    @endif
                    <div class="chips">
                        <span class="chip"><i
                                class="bi bi-calendar3"></i>{{ Carbon::parse($sub->event_date)->format('M j, Y') }}</span>
                        @if ($sub->time_range && $sub->time_range !== '--')
                            <span class="chip"><i class="bi bi-clock"></i>{{ $sub->time_range }}</span>
                        @endif
                        @if ($sub->mode)
                            <span class="chip"><i class="bi bi-display"></i>{{ ucfirst($sub->mode) }}</span>
                        @endif
                        @if ($sub->age_group)
                            <span class="chip"><i class="bi bi-people"></i>{{ $sub->age_group }}</span>
                        @endif
                        <span class="chip"
                            style="background:rgba(74,222,128,.1);border-color:rgba(74,222,128,.2);color:#4ade80;">
                            <i class="bi bi-ticket-perforated" style="color:#4ade80;"></i>
                            {{ $sub->fees == 0 ? 'Free Entry' : '₹' . number_format($sub->fees, 0) . ' / person' }}
                        </span>
                    </div>
                </div>
                <div class="seat-panel">
                    <div class="sp-lbl">Seats Available</div>
                    @if ($sub->max_seats)
                        <div class="sp-big {{ $isFull ? 'full' : ($isLow ? 'low' : '') }}">{{ $isFull ? '0' : $avail }}
                        </div>
                        <div class="sp-of">of {{ $sub->max_seats }} total</div>
                        <div class="sp-bar-bg">
                            <div class="sp-bar-fill {{ $isFull ? 'full' : ($isLow ? 'low' : '') }}"
                                style="width:{{ $pct }}%"></div>
                        </div>
                        <div class="sp-note">
                            @if ($isFull)
                                Fully booked
                            @elseif($isLow)
                                Only {{ $avail }} left!
                            @else
                                {{ $booked }} registered
                            @endif
                        </div>
                    @else
                        <div class="sp-big">∞</div>
                        <div class="sp-of">Unlimited seats</div>
                        <div class="sp-bar-bg">
                            <div class="sp-bar-fill" style="width:0%"></div>
                        </div>
                        <div class="sp-note">Open for all</div>
                    @endif
                    <div class="sp-fee">
                        <div class="sp-fee-lbl">Fee per ticket</div>
                        <div class="sp-fee-val {{ $sub->fees == 0 ? 'free' : '' }}">
                            {{ $sub->fees == 0 ? 'FREE' : '₹' . number_format($sub->fees, 0) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="body">
            <div class="container">
                <div class="row g-4">

                    {{-- FORM --}}
                    <div class="col-lg-7">

                        @if ($isFull)
                            <div class="a-full"><i class="bi bi-x-octagon-fill fs-5"></i>
                                <div>Session <strong>fully booked</strong>. WhatsApp us for the waitlist.</div>
                            </div>
                        @endif
                        @if ($isLow && !$isFull)
                            <div class="a-low"><i class="bi bi-exclamation-triangle-fill"></i>
                                Only <strong>{{ $avail }} seat{{ $avail > 1 ? 's' : '' }}</strong> left — register
                                now!
                            </div>
                        @endif

                        {{-- Global validation banner --}}
                        <div class="val-banner" id="valBanner">
                            <div class="vb-t"><i class="bi bi-exclamation-circle-fill"></i>Please fix the following before
                                continuing:</div>
                            <ul id="valBannerList"></ul>
                        </div>

                        <form method="POST" action="{{ route('frontend.events.register.store', $sub->slug) }}"
                            id="regForm" novalidate>
                            @csrf
                            <input type="hidden" name="primary_ticket" id="primaryInput" value="{{ $oldPrimary }}">
                            <input type="hidden" name="center_id" id="centerIdInput" value="{{ old('center_id') }}">
                            <input type="hidden" name="city" id="cityInput" value="{{ old('city') }}">
                            <input type="hidden" name="state" id="stateInput" value="{{ old('state') }}">

                            {{-- SESSION DETAILS --}}
                            <div class="card">
                                <div class="ch">
                                    <div class="ch-step" style="background:var(--ink);font-size:13px;"><i
                                            class="bi bi-info-circle"></i></div>
                                    <div>
                                        <h4>Session Details</h4>
                                        <p>What you're registering for</p>
                                    </div>
                                </div>
                                <div class="cb">
                                    @if ($sub->description)
                                        <div class="desc-txt">{{ strip_tags($sub->description) }}</div>
                                    @endif
                                    <div class="sig">
                                        <div class="si-box">
                                            <div class="si-lbl"><i class="bi bi-calendar3"></i>Date</div>
                                            <div class="si-val">{{ Carbon::parse($sub->event_date)->format('M j, Y') }}
                                            </div>
                                        </div>
                                        @if ($sub->time_range && $sub->time_range !== '--')
                                            <div class="si-box">
                                                <div class="si-lbl"><i class="bi bi-clock"></i>Time</div>
                                                <div class="si-val">{{ $sub->time_range }}</div>
                                            </div>
                                        @endif
                                        @if ($sub->mode)
                                            <div class="si-box">
                                                <div class="si-lbl"><i class="bi bi-display"></i>Mode</div>
                                                <div class="si-val">{{ ucfirst($sub->mode) }}</div>
                                            </div>
                                        @endif
                                        @if ($sub->age_group)
                                            <div class="si-box">
                                                <div class="si-lbl"><i class="bi bi-people"></i>Age Group</div>
                                                <div class="si-val">{{ $sub->age_group }}</div>
                                            </div>
                                        @endif
                                        <div class="si-box">
                                            <div class="si-lbl"><i class="bi bi-ticket-perforated"></i>Fee / Person</div>
                                            <div class="si-val {{ $sub->fees == 0 ? 'free' : '' }}">
                                                {{ $sub->fees == 0 ? 'FREE' : '₹' . number_format($sub->fees, 0) }}</div>
                                        </div>
                                        @if ($sub->max_seats)
                                            <div class="si-box">
                                                <div class="si-lbl"><i class="bi bi-person-check"></i>Seats Left</div>
                                                <div class="si-val"
                                                    style="{{ $isFull ? 'color:var(--rd)' : ($isLow ? 'color:var(--am)' : '') }}">
                                                    {{ $isFull ? 'Full' : $avail . ' / ' . $sub->max_seats }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($centres->count())
                                        <div class="divider-lbl"><i class="bi bi-geo-alt"
                                                style="color:var(--blue);"></i>Available Centres</div>
                                        <div class="ctrs">
                                            @foreach ($centres as $c)
                                                <span class="ctr"><i class="bi bi-building"></i>{{ $c->name }}
                                                    @if ($c->state)
                                                        <span class="ctr-s">· {{ $c->state->name }}</span>
                                                    @endif
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- CHOOSE CENTRE --}}
                            @if ($centres->count() > 1)
                                <div class="card">
                                    <div class="ch">
                                        <div class="ch-step">1</div>
                                        <div>
                                            <h4>Choose Your Centre</h4>
                                            <p>Select the location you'll attend from</p>
                                        </div>
                                    </div>
                                    <div class="cb">
                                        @foreach ($centres as $c)
                                            <div class="ctr-option {{ old('center_id') == $c->id ? 'selected' : ($loop->first && !old('center_id') ? 'selected' : '') }}"
                                                onclick="selectCentre({{ $c->id }},'{{ addslashes($c->name) }}','{{ addslashes($c->state->name ?? '') }}',this)">
                                                <div class="ctr-radio"></div>
                                                <div>
                                                    <div class="ctr-name"><i class="bi bi-building me-1"
                                                            style="color:var(--blue);font-size:12px;"></i>{{ $c->name }}
                                                    </div>
                                                    @if ($c->state)
                                                        <div class="ctr-meta"><i class="bi bi-map me-1"
                                                                style="font-size:10px;"></i>{{ $c->state->name }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="ctr-required-msg" id="ctrRequiredMsg">
                                            <i class="bi bi-exclamation-circle"></i> Please select a centre to continue.
                                        </div>
                                    </div>
                                </div>
                            @elseif($centres->count() == 1)
                                @php $onlyCentre = $centres->first(); @endphp
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        document.getElementById('centerIdInput').value = '{{ $onlyCentre->id }}';
                                        document.getElementById('cityInput').value = '{{ addslashes($onlyCentre->name) }}';
                                        document.getElementById('stateInput').value = '{{ addslashes($onlyCentre->state->name ?? '') }}';
                                    });
                                </script>
                            @endif

                            {{-- TICKETS --}}
                            <div class="card">
                                <div class="ch">
                                    <div class="ch-step">{{ $centres->count() > 1 ? 2 : 1 }}</div>
                                    <div>
                                        <h4>Number of Tickets</h4>
                                        <p>How many people are attending?</p>
                                    </div>
                                </div>
                                <div class="cb">
                                    <div class="d-flex align-items-center gap-4 flex-wrap">
                                        <div class="tc-wrap">
                                            <button type="button" class="tc-btn" id="tcMinus" disabled>−</button>
                                            <input type="number" class="tc-num" id="ticketInput" name="tickets"
                                                value="{{ old('tickets', 1) }}" min="1"
                                                max="{{ $maxTickets }}" readonly>
                                            <button type="button" class="tc-btn" id="tcPlus">+</button>
                                        </div>
                                        <div>
                                            <div style="font-size:13px;font-weight:800;color:var(--ink);" id="tcLabel">1
                                                Ticket</div>
                                            <div style="font-size:11.5px;color:var(--mute);">
                                                @if ($avail !== null)
                                                    Max {{ $maxTickets }} · {{ $avail }} seats left
                                                @else
                                                    Max 10 per booking
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ATTENDEES --}}
                            <div class="card">
                                <div class="ch">
                                    <div class="ch-step">{{ $centres->count() > 1 ? 3 : 2 }}</div>
                                    <div>
                                        <h4>Attendee Details</h4>
                                        <p>Primary contact gets full form · others just Name &amp; Phone</p>
                                    </div>
                                </div>
                                <div class="cb">
                                    <div
                                        style="background:var(--blt);border:1px solid #c7d7fa;border-radius:10px;padding:10px 14px;font-size:12.5px;color:var(--blue);margin-bottom:16px;display:flex;align-items:flex-start;gap:7px;">
                                        <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:2px;"></i>
                                        <div>Fill details for each attendee. The <strong>Primary Contact</strong> must have
                                            a phone &amp; email — confirmation will be sent there. Click <strong>"Set as
                                                Primary"</strong> to change who that is.</div>
                                    </div>
                                    <div id="attList"></div>
                                </div>
                            </div>

                            {{-- CONFIRM --}}
                            <div class="card">
                                <div class="ch">
                                    <div class="ch-step">{{ $centres->count() > 1 ? 4 : 3 }}</div>
                                    <div>
                                        <h4>Review &amp; Submit</h4>
                                        <p>Check your booking details below</p>
                                    </div>
                                </div>
                                <div class="cb">
                                    <div
                                        style="background:var(--bg);border:1.5px solid var(--bd);border-radius:12px;padding:16px 18px;margin-bottom:4px;">
                                        <div
                                            style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:10px;">
                                            <div>
                                                <div
                                                    style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--mute);">
                                                    Session</div>
                                                <div
                                                    style="font-size:14px;font-weight:800;color:var(--ink);margin-top:2px;">
                                                    {{ $sub->title }}</div>
                                                <div style="font-size:12px;color:var(--mute);margin-top:3px;">
                                                    {{ Carbon::parse($sub->event_date)->format('M j, Y') }}
                                                    @if ($sub->time_range && $sub->time_range !== '--')
                                                        · {{ $sub->time_range }}
                                                    @endif
                                                </div>
                                                <div id="confirmLocation"
                                                    style="font-size:12px;color:var(--mute);margin-top:2px;display:none;">
                                                    <i class="bi bi-geo-alt" style="color:var(--blue);"></i>
                                                    <span id="confirmLocText"></span>
                                                </div>
                                            </div>
                                            <div style="text-align:right;">
                                                <div
                                                    style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--mute);">
                                                    Total</div>
                                                <div style="font-size:22px;font-weight:900;font-family:var(--H);color:{{ $sub->fees == 0 ? 'var(--gr)' : 'var(--blue)' }};"
                                                    id="liveTotal">
                                                    {{ $sub->fees == 0 ? 'FREE' : '₹' . number_format($sub->fees, 0) }}
                                                </div>
                                                <div style="font-size:11px;color:var(--mute);" id="liveBreak">
                                                    1 ticket
                                                    {{ $sub->fees == 0 ? '· Free' : '× ₹' . number_format($sub->fees, 0) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-go" id="submitBtn"
                                        {{ $isFull ? 'disabled' : '' }}>
                                        <i class="bi bi-check2-circle"></i>
                                        <span
                                            id="submitTxt">{{ $isFull ? 'Session Fully Booked' : 'Complete Registration' }}</span>
                                    </button>
                                    <p
                                        style="text-align:center;font-size:11px;color:var(--mute);margin-top:11px;margin-bottom:0;">
                                        <i class="bi bi-shield-check" style="color:var(--gr);"></i> Your details are safe.
                                        We never share them.
                                    </p>
                                </div>
                            </div>

                        </form>
                    </div>

                    {{-- SIDEBAR --}}
                    <div class="col-lg-5">
                        <div class="sidebar">
                            <div class="sc">
                                <div class="sc-head"><i class="bi bi-receipt"></i>
                                    <h5>Booking Summary</h5>
                                </div>
                                <div class="sc-ev">
                                    <div class="ek">Main Event</div>
                                    <div class="ev">{{ $event->title }}</div>
                                </div>
                                <div class="sc-rows">
                                    <div class="sc-row"><span class="rk"><i
                                                class="bi bi-collection"></i>Session</span><span
                                            class="rv">{{ Str::limit($sub->title, 22) }}</span></div>
                                    <div class="sc-row"><span class="rk"><i
                                                class="bi bi-calendar3"></i>Date</span><span
                                            class="rv">{{ Carbon::parse($sub->event_date)->format('M j, Y') }}</span>
                                    </div>
                                    @if ($sub->time_range && $sub->time_range !== '--')
                                        <div class="sc-row"><span class="rk"><i
                                                    class="bi bi-clock"></i>Time</span><span
                                                class="rv">{{ $sub->time_range }}</span></div>
                                    @endif
                                    @if ($sub->mode)
                                        <div class="sc-row"><span class="rk"><i
                                                    class="bi bi-display"></i>Mode</span><span
                                                class="rv">{{ ucfirst($sub->mode) }}</span></div>
                                    @endif
                                    @if ($sub->age_group)
                                        <div class="sc-row"><span class="rk"><i class="bi bi-people"></i>Age
                                                Group</span><span class="rv">{{ $sub->age_group }}</span></div>
                                    @endif
                                    <div class="sc-row"><span class="rk"><i
                                                class="bi bi-ticket-perforated"></i>Fee/Person</span><span
                                            class="rv {{ $sub->fees == 0 ? 'free' : '' }}">{{ $sub->fees == 0 ? 'FREE' : '₹' . number_format($sub->fees, 0) }}</span>
                                    </div>
                                    <div class="sc-row"><span class="rk"><i
                                                class="bi bi-hash"></i>Tickets</span><span class="rv"
                                            id="sideTickets">1</span></div>
                                </div>
                                @if ($sub->max_seats)
                                    <div class="sc-seat">
                                        <div class="ss-lbl">Seat Availability</div>
                                        <div class="ss-bg">
                                            <div class="ss-fill {{ $isFull ? 'full' : ($isLow ? 'low' : '') }}"
                                                style="width:{{ $pct }}%"></div>
                                        </div>
                                        <div class="ss-txt {{ $isLow || $isFull ? 'low' : '' }}">
                                            @if ($isFull)
                                                Fully booked ({{ $sub->max_seats }}/{{ $sub->max_seats }})
                                            @else
                                                {{ $avail }} of {{ $sub->max_seats }} seats available
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="sc-total">
                                    <div class="sc-total-row">
                                        <span class="sc-total-lbl">Total</span>
                                        <span class="sc-total-val {{ $sub->fees == 0 ? 'free' : '' }}" id="sideTotal">
                                            {{ $sub->fees == 0 ? 'FREE' : '₹' . number_format($sub->fees, 0) }}
                                        </span>
                                    </div>
                                    <div class="sc-total-note" id="sideNote">
                                        {{ $sub->fees == 0 ? 'No payment required' : '1 ticket × ₹' . number_format($sub->fees, 0) }}
                                    </div>
                                </div>
                                <div class="sc-status">
                                    <div class="sdot {{ $isFull ? 'full' : ($isLow ? 'low' : 'open') }}"></div>
                                    @if ($isFull)
                                        Fully booked
                                    @elseif($isLow)
                                        Only {{ $avail }} seat{{ $avail > 1 ? 's' : '' }} left!
                                    @elseif($sub->max_seats)
                                        {{ $avail }} seats available
                                    @else
                                        Unlimited seats
                                    @endif
                                </div>
                                <div class="sc-loc" id="sideLocation" style="display:none;">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <div>
                                        <div class="loc-name" id="sideLocName"></div>
                                        <div style="font-size:11px;" id="sideLocState"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="sc">
                                <div class="sc-head"><i class="bi bi-question-circle"></i>
                                    <h5>Need Help?</h5>
                                </div>
                                <div class="sc-help">
                                    <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="hw">
                                        <i class="bi bi-whatsapp"></i>
                                        <div>
                                            <div>Chat on WhatsApp</div>
                                            <div style="font-size:10.5px;font-weight:400;opacity:.7;">Quickest way to reach
                                                us</div>
                                        </div>
                                    </a>
                                    <a href="tel:+919352023276" class="hp">
                                        <i class="bi bi-telephone-fill"></i>
                                        <div>
                                            <div>+91 93520 23276</div>
                                            <div style="font-size:10.5px;font-weight:400;opacity:.7;">Tue–Sat · 11 AM – 7
                                                PM</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        (function() {
            const FEE = {{ (float) $sub->fees }};
            const IS_FREE = {{ $sub->fees == 0 ? 'true' : 'false' }};
            const MAX_T = {{ $maxTickets }};
            const HAS_MULTI_CTR = {{ $centres->count() > 1 ? 'true' : 'false' }};
            const OLD_ATTS = @json($oldAtts);
            const OLD_PRI = {{ $oldPrimary }};
            const CSRF = '{{ csrf_token() }}';
            const STORE_URL = '{{ route('frontend.events.register.store', $sub->slug) }}';
            const ORDER_URL = '{{ route('frontend.events.register.create-order', $sub->slug) }}';
            const SUCCESS_BASE = '{{ url('/events/register/success') }}';

            let primaryIdx = OLD_PRI;

            /* ════════════════════════════════════════════════════════════════
               HELPERS
            ════════════════════════════════════════════════════════════════ */
            const esc = s => String(s || '').replace(/[&<>"']/g, c =>
                ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [c]));
            const fmt = n => IS_FREE ? 'FREE' : '₹' + (FEE * n).toLocaleString('en-IN');

            /* ════════════════════════════════════════════════════════════════
               INLINE FIELD VALIDATION
            ════════════════════════════════════════════════════════════════ */
            function getMsgEl(input) {
                // Look for sibling .v-msg (may be after f-hint)
                let el = input.closest('.fg')?.querySelector('.v-msg');
                if (!el) {
                    el = document.createElement('div');
                    el.className = 'v-msg hidden';
                    input.parentElement.appendChild(el);
                }
                return el;
            }

            function fieldErr(input, msg) {
                input.classList.remove('v-ok');
                input.classList.add('v-err');
                const el = getMsgEl(input);
                el.className = 'v-msg err';
                el.innerHTML = `<i class="bi bi-exclamation-circle" style="font-size:11px;flex-shrink:0;"></i>${msg}`;
            }

            function fieldOk(input) {
                input.classList.remove('v-err');
                input.classList.add('v-ok');
                const el = getMsgEl(input);
                el.className = 'v-msg hidden';
                el.innerHTML = '';
            }

            function fieldClear(input) {
                input.classList.remove('v-err', 'v-ok');
                const el = getMsgEl(input);
                el.className = 'v-msg hidden';
                el.innerHTML = '';
            }

            // Returns error string or null
            function validateField(input) {
                const name = input.getAttribute('name') || '';
                const val = input.value.trim();

                if (name.includes('[name]')) {
                    if (!val) return 'Full name is required.';
                    if (val.length < 2) return 'Name must be at least 2 characters.';
                    if (val.length > 100) return 'Name is too long (max 100 chars).';
                    return null;
                }
                if (name.includes('[phone]')) {
                    if (input.required && !val) return 'Phone number is required.';
                    if (val && val.replace(/\D/g, '').length !== 10) return 'Enter a valid 10-digit number.';
                    return null;
                }
                if (name.includes('[email]')) {
                    if (input.required && !val) return 'Email address is required.';
                    if (val && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) return 'Enter a valid email address.';
                    return null;
                }
                if (name.includes('[dob]') && val) {
                    const d = new Date(val);
                    if (isNaN(d.getTime())) return 'Enter a valid date.';
                    if (d >= new Date()) return 'Date of birth must be in the past.';
                    return null;
                }
                return null;
            }

            function bindLiveValidation(input) {
                input.addEventListener('blur', () => {
                    const err = validateField(input);
                    if (err) fieldErr(input, err);
                    else if (input.value.trim()) fieldOk(input);
                    else fieldClear(input);
                });
                input.addEventListener('input', () => {
                    if (input.classList.contains('v-err')) {
                        if (!validateField(input)) fieldOk(input);
                    }
                });
            }

            /* ════════════════════════════════════════════════════════════════
               CENTRE SELECTOR
            ════════════════════════════════════════════════════════════════ */
            window.selectCentre = function(id, name, state, el) {
                document.getElementById('centerIdInput').value = id;
                document.getElementById('cityInput').value = name;
                document.getElementById('stateInput').value = state;
                document.querySelectorAll('.ctr-option').forEach(o => o.classList.remove('selected'));
                el.classList.add('selected');
                const msg = document.getElementById('ctrRequiredMsg');
                if (msg) msg.classList.remove('show');
                // Sidebar + confirm
                document.getElementById('sideLocation').style.display = 'flex';
                document.getElementById('sideLocName').textContent = name;
                document.getElementById('sideLocState').textContent = state;
                document.getElementById('confirmLocation').style.display = '';
                document.getElementById('confirmLocText').textContent = name + (state ? ', ' + state : '');
            };

            /* ════════════════════════════════════════════════════════════════
               GENDER PILLS
            ════════════════════════════════════════════════════════════════ */
            window.toggleGender = function(el, idx, val) {
                document.querySelectorAll('#att_' + idx + ' .gp').forEach(p => p.classList.remove('active'));
                el.classList.add('active');
                document.getElementById('gender_' + idx).value = val;
            };

            /* ════════════════════════════════════════════════════════════════
               BUILD PRIMARY CARD
            ════════════════════════════════════════════════════════════════ */
            function makePrimaryCard(idx, old) {
                const n = idx + 1;
                const d = document.createElement('div');
                d.className = 'att-card is-primary';
                d.id = 'att_' + idx;
                const genders = [{
                        val: 'male',
                        icon: 'bi-gender-male',
                        label: 'Male'
                    },
                    {
                        val: 'female',
                        icon: 'bi-gender-female',
                        label: 'Female'
                    },
                    {
                        val: 'other',
                        icon: 'bi-gender-ambiguous',
                        label: 'Other'
                    },
                    {
                        val: 'prefer_not_to_say',
                        icon: 'bi-dash-circle',
                        label: 'Prefer not to say'
                    },
                ];
                const gPills = genders.map(g =>
                    `<div class="gp ${old?.gender===g.val?'active':''}" onclick="toggleGender(this,${idx},'${g.val}')">
                    <i class="bi ${g.icon}"></i>${g.label}
                 </div>`).join('');
                d.innerHTML = `
            <div class="att-card-head">
                <div class="att-title">
                    <div class="att-num-badge">${n}</div>Ticket ${n}
                    <i class="bi bi-star-fill primary-star"></i>
                </div>
                <div style="display:flex;align-items:center;gap:7px;">
                    <span class="primary-tag"><i class="bi bi-star-fill me-1" style="font-size:9px;"></i>Primary Contact</span>
                    ${idx>0?`<button type="button" class="btn-remove" onclick="removeAtt(${idx})"><i class="bi bi-x"></i></button>`:''}
                </div>
            </div>
            <div class="row g-2">
                <div class="col-12 col-sm-6">
                    <div class="fg">
                        <label class="fl">Full Name <span class="req">*</span></label>
                        <input type="text" name="attendees[${idx}][name]" class="fi" placeholder="Full name" value="${esc(old?.name)}" required autocomplete="name">
                        <div class="v-msg hidden"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="fg">
                        <label class="fl">Phone <span class="req">*</span></label>
                        <div style="display:flex;align-items:stretch;border:1.5px solid var(--border,#dde5f4);border-radius:8px;overflow:hidden;background:#fff;">
                            <span style="display:flex;align-items:center;padding:0 10px;background:#f3f6fb;border-right:1.5px solid var(--border,#dde5f4);font-size:13px;font-weight:600;white-space:nowrap;gap:4px;user-select:none;">+91</span>
                            <input type="tel" name="attendees[${idx}][phone]" class="fi" placeholder="10-digit number" value="${esc(old?.phone)}" maxlength="10" required autocomplete="tel" inputmode="numeric" style="border:none!important;border-radius:0!important;flex:1;">
                        </div>
                        <div class="f-hint"><i class="bi bi-whatsapp" style="color:#22c55e;"></i> Confirmation sent here</div>
                        <div class="v-msg hidden"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="fg">
                        <label class="fl">Email Address <span class="req">*</span></label>
                        <input type="email" name="attendees[${idx}][email]" class="fi" placeholder="email@example.com" value="${esc(old?.email)}" required autocomplete="email">
                        <div class="v-msg hidden"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="fg">
                        <label class="fl">Date of Birth <span class="opt">(optional)</span></label>
                        <input type="date" name="attendees[${idx}][dob]" class="fi" value="${esc(old?.dob)}" max="${new Date().toISOString().split('T')[0]}">
                        <div class="v-msg hidden"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="fg">
                        <label class="fl">Gender <span class="opt">(optional)</span></label>
                        <input type="hidden" name="attendees[${idx}][gender]" id="gender_${idx}" value="${esc(old?.gender)}">
                        <div class="gender-pills">${gPills}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="fg">
                        <label class="fl">School / College / Institution <span class="opt">(optional)</span></label>
                        <input type="text" name="attendees[${idx}][institution]" class="fi" placeholder="e.g. Delhi Public School" value="${esc(old?.institution)}">
                    </div>
                </div>
            </div>`;
                d.querySelectorAll('input.fi').forEach(bindLiveValidation);
                return d;
            }

            /* ════════════════════════════════════════════════════════════════
               BUILD REGULAR CARD
            ════════════════════════════════════════════════════════════════ */
            function makeSimpleCard(idx, old) {
                const n = idx + 1;
                const d = document.createElement('div');
                d.className = 'att-card';
                d.id = 'att_' + idx;
                const genders = [{
                        val: 'male',
                        icon: 'bi-gender-male',
                        label: 'Male'
                    },
                    {
                        val: 'female',
                        icon: 'bi-gender-female',
                        label: 'Female'
                    },
                    {
                        val: 'other',
                        icon: 'bi-gender-ambiguous',
                        label: 'Other'
                    },
                    {
                        val: 'prefer_not_to_say',
                        icon: 'bi-dash-circle',
                        label: 'Prefer not to say'
                    },
                ];
                const gPills = genders.map(g =>
                    `<div class="gp ${old?.gender===g.val?'active':''}" onclick="toggleGender(this,${idx},'${g.val}')">
                    <i class="bi ${g.icon}"></i>${g.label}
                 </div>`).join('');
                d.innerHTML = `
            <div class="att-card-head">
                <div class="att-title">
                    <div class="att-num-badge">${n}</div>Ticket ${n}
                </div>
                <div style="display:flex;align-items:center;gap:7px;">
                    <button type="button" class="btn-set-primary" onclick="setPrimary(${idx})">
                        <i class="bi bi-star me-1"></i>Set as Primary
                    </button>
                    <button type="button" class="btn-remove" onclick="removeAtt(${idx})">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-12 col-sm-6">
                    <div class="fg">
                        <label class="fl">Full Name <span class="req">*</span></label>
                        <input type="text" name="attendees[${idx}][name]" class="fi" placeholder="Full name" value="${esc(old?.name)}" required>
                        <div class="v-msg hidden"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="fg">
                        <label class="fl">Phone <span class="opt">(optional)</span></label>
                        <div style="display:flex;align-items:stretch;border:1.5px solid var(--border,#dde5f4);border-radius:8px;overflow:hidden;background:#fff;">
                            <span style="display:flex;align-items:center;padding:0 10px;background:#f3f6fb;border-right:1.5px solid var(--border,#dde5f4);font-size:13px;font-weight:600;white-space:nowrap;gap:4px;user-select:none;">+91</span>
                            <input type="tel" name="attendees[${idx}][phone]" class="fi" placeholder="10-digit number" value="${esc(old?.phone)}" maxlength="10" inputmode="numeric" style="border:none!important;border-radius:0!important;flex:1;">
                        </div>
                        <div class="v-msg hidden"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="fg">
                        <label class="fl">Email <span class="opt">(optional)</span></label>
                        <input type="email" name="attendees[${idx}][email]" class="fi" placeholder="email@example.com" value="${esc(old?.email)}">
                        <div class="v-msg hidden"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="fg">
                        <label class="fl">Date of Birth <span class="opt">(optional)</span></label>
                        <input type="date" name="attendees[${idx}][dob]" class="fi" value="${esc(old?.dob)}" max="${new Date().toISOString().split('T')[0]}">
                        <div class="v-msg hidden"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="fg">
                        <label class="fl">Gender <span class="opt">(optional)</span></label>
                        <input type="hidden" name="attendees[${idx}][gender]" id="gender_${idx}" value="${esc(old?.gender)}">
                        <div class="gender-pills">${gPills}</div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="attendees[${idx}][institution]" value="">`;
                d.querySelectorAll('input.fi').forEach(bindLiveValidation);
                return d;
            }

            /* ════════════════════════════════════════════════════════════════
               SAVE / RENDER
            ════════════════════════════════════════════════════════════════ */
            function saveValues() {
                const saved = [];
                document.querySelectorAll('#attList .att-card').forEach((card, i) => {
                    saved[i] = {
                        name: card.querySelector(`input[name="attendees[${i}][name]"]`)?.value || '',
                        phone: card.querySelector(`input[name="attendees[${i}][phone]"]`)?.value || '',
                        email: card.querySelector(`input[name="attendees[${i}][email]"]`)?.value || '',
                        dob: card.querySelector(`input[name="attendees[${i}][dob]"]`)?.value || '',
                        gender: card.querySelector(`input[name="attendees[${i}][gender]"]`)?.value || '',
                        institution: card.querySelector(`input[name="attendees[${i}][institution]"]`)
                            ?.value || '',
                    };
                });
                return saved;
            }

            function renderAll(count, saved) {
                const list = document.getElementById('attList');
                list.innerHTML = '';
                for (let i = 0; i < count; i++) {
                    const data = (saved && saved[i]) ? saved[i] : (OLD_ATTS[i] || {});
                    list.appendChild(i === primaryIdx ? makePrimaryCard(i, data) : makeSimpleCard(i, data));
                }
                document.getElementById('primaryInput').value = primaryIdx;
            }

            window.setPrimary = function(idx) {
                const saved = saveValues();
                primaryIdx = idx;
                renderAll(parseInt(document.getElementById('ticketInput').value), saved);
            };

            window.removeAtt = function(idx) {
                let v = parseInt(document.getElementById('ticketInput').value);
                if (v <= 1) return;
                const saved = saveValues();
                saved.splice(idx, 1);
                if (primaryIdx === idx) primaryIdx = 0;
                else if (primaryIdx > idx) primaryIdx--;
                document.getElementById('ticketInput').value = v - 1;
                updateCounter(saved);
            };

            /* ════════════════════════════════════════════════════════════════
               COUNTER / TOTALS
            ════════════════════════════════════════════════════════════════ */
            function updateCounter(saved) {
                const v = parseInt(document.getElementById('ticketInput').value);
                document.getElementById('tcMinus').disabled = v <= 1;
                document.getElementById('tcPlus').disabled = v >= MAX_T;
                document.getElementById('tcLabel').textContent = v + ' Ticket' + (v > 1 ? 's' : '');
                document.getElementById('sideTickets').textContent = v;
                if (primaryIdx >= v) primaryIdx = 0;
                renderAll(v, saved || null);
                updateTotals(v);
            }

            function updateTotals(v) {
                const total = fmt(v);
                const note = IS_FREE ? v + ' ticket' + (v > 1 ? 's' : '') + ' · Free' : v + ' × ₹' + FEE.toLocaleString(
                    'en-IN');
                document.getElementById('liveTotal').textContent = total;
                document.getElementById('liveBreak').textContent = note;
                document.getElementById('sideTotal').textContent = total;
                document.getElementById('sideNote').textContent = note;
                const c = IS_FREE ? 'var(--gr)' : 'var(--blue)';
                document.getElementById('liveTotal').style.color = c;
                document.getElementById('sideTotal').style.color = c;
            }

            document.getElementById('tcMinus').addEventListener('click', () => {
                let v = parseInt(document.getElementById('ticketInput').value);
                if (v > 1) {
                    const s = saveValues();
                    document.getElementById('ticketInput').value = v - 1;
                    updateCounter(s);
                }
            });
            document.getElementById('tcPlus').addEventListener('click', () => {
                let v = parseInt(document.getElementById('ticketInput').value);
                if (v < MAX_T) {
                    const s = saveValues();
                    document.getElementById('ticketInput').value = v + 1;
                    updateCounter(s);
                }
            });

            const initCount = Math.max(1, OLD_ATTS.length || 1);
            document.getElementById('ticketInput').value = initCount;
            updateCounter(null);

            /* ════════════════════════════════════════════════════════════════
               FULL FORM VALIDATION — runs on submit, blocks if any error
            ════════════════════════════════════════════════════════════════ */
            function validateForm() {
                const errors = [];
                let firstBad = null;

                // Centre required when multiple exist
                if (HAS_MULTI_CTR && !document.getElementById('centerIdInput').value) {
                    const msg = document.getElementById('ctrRequiredMsg');
                    if (msg) msg.classList.add('show');
                    errors.push('Please select a centre.');
                    if (!firstBad) firstBad = msg;
                }

                // Every visible attendee input
                document.querySelectorAll('#attList input.fi').forEach(input => {
                    const err = validateField(input);
                    if (err) {
                        fieldErr(input, err);
                        // Human-readable label for banner
                        const card = input.closest('.att-card');
                        const badge = card?.querySelector('.att-num-badge')?.textContent || '?';
                        const label = input.closest('.fg')?.querySelector('.fl')?.textContent?.replace('*', '')
                            .replace('(optional)', '').trim() || 'Field';
                        errors.push(`Ticket ${badge}: ${label} — ${err}`);
                        if (!firstBad) firstBad = input;
                    } else if (input.value.trim()) {
                        fieldOk(input);
                    }
                });

                // Show / hide banner
                const banner = document.getElementById('valBanner');
                const bannerUl = document.getElementById('valBannerList');

                if (errors.length) {
                    // Deduplicate
                    const unique = [...new Set(errors)];
                    bannerUl.innerHTML = unique.map(e => `<li>${e}</li>`).join('');
                    banner.classList.add('show');
                    // Scroll + focus first broken field
                    setTimeout(() => {
                        if (firstBad) {
                            firstBad.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                            if (typeof firstBad.focus === 'function') firstBad.focus();
                        } else {
                            banner.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }, 50);
                    return false;
                }

                banner.classList.remove('show');
                return true;
            }

            /* ════════════════════════════════════════════════════════════════
               BUTTON HELPERS
            ════════════════════════════════════════════════════════════════ */
            function setBtnLoading(msg) {
                document.getElementById('submitBtn').disabled = true;
                document.getElementById('submitTxt').innerHTML = '<span class="spin"></span> ' + msg;
            }

            function setBtnReady() {
                document.getElementById('submitBtn').disabled = false;
                document.getElementById('submitTxt').innerHTML =
                    '<i class="bi bi-check2-circle"></i> Complete Registration';
            }

            /* ════════════════════════════════════════════════════════════════
               SHOW SERVER ERRORS IN BANNER (maps Laravel validation errors)
            ════════════════════════════════════════════════════════════════ */
            function showServerErrors(errorsObj, fallbackMsg) {
                const banner = document.getElementById('valBanner');
                const bannerUl = document.getElementById('valBannerList');
                const msgs = errorsObj ? Object.values(errorsObj).flat() : [fallbackMsg || 'Something went wrong.'];
                bannerUl.innerHTML = msgs.map(e => `<li>${e}</li>`).join('');
                banner.classList.add('show');
                banner.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Highlight specific fields from Laravel errors
                if (errorsObj) {
                    Object.entries(errorsObj).forEach(([key, errs]) => {
                        const m = key.match(/^attendees\.(\d+)\.(\w+)$/);
                        if (m) {
                            const inp = document.querySelector(`input[name="attendees[${m[1]}][${m[2]}]"]`);
                            if (inp) fieldErr(inp, errs[0]);
                        }
                    });
                }
            }

            /* ════════════════════════════════════════════════════════════════
               SUBMIT — AJAX for both free and paid
            ════════════════════════════════════════════════════════════════ */
            // Restrict phone inputs to digits only (runs on new cards as they're added)
            document.getElementById('attList').addEventListener('input', function(e) {
                if (e.target && e.target.name && e.target.name.includes('[phone]')) {
                    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 10);
                }
            });

            document.getElementById('regForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                // Gate 1: client-side validation
                if (!validateForm()) return;

                // Prepend +91 to all phone inputs before FormData capture
                document.querySelectorAll('input[name*="[phone]"]').forEach(function(el) {
                    var d = el.value.replace(/\D/g, '');
                    if (d) el.value = '+91' + d;
                });

                // ── FREE EVENT ────────────────────────────────────────────
                if (IS_FREE) {
                    setBtnLoading('Submitting…');
                    try {
                        const res = await fetch(STORE_URL, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json'
                            },
                            body: new FormData(this),
                        });
                        const json = await res.json().catch(() => null);

                        if (!res.ok || !json?.registration_id) {
                            showServerErrors(json?.errors, json?.message ||
                                'Submission failed. Please check your details.');
                            setBtnReady();
                            return;
                        }
                        window.location.href = SUCCESS_BASE + '/' + json.registration_id;
                    } catch (err) {
                        console.error('Free submit error:', err);
                        showServerErrors(null, 'Network error. Please try again.');
                        setBtnReady();
                    }
                    return;
                }

                // ── PAID EVENT — Razorpay ─────────────────────────────────
                setBtnLoading('Creating order…');

                if (!window.__RZP_KEY__) {
                    showServerErrors(null, 'Payment configuration error. Please contact support.');
                    setBtnReady();
                    return;
                }

                try {
                    // Step 1: Create order
                    const orderRes = await fetch(ORDER_URL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF
                        },
                        body: JSON.stringify({
                            tickets: parseInt(document.getElementById('ticketInput').value)
                        }),
                    });
                    const order = await orderRes.json().catch(() => null);

                    if (!order || order.error || !order.order_id) {
                        showServerErrors(null, order?.error ||
                            'Could not create payment order. Please try again.');
                        setBtnReady();
                        return;
                    }

                    // Step 2: Open Razorpay
                    const rzp = new Razorpay({
                        key: window.__RZP_KEY__,
                        amount: order.amount,
                        currency: order.currency,
                        order_id: order.order_id,
                        name: '{{ addslashes($event->title) }}',
                        description: '{{ addslashes($sub->title) }}',
                        theme: {
                            color: '#1a4fd6'
                        },

                        handler: async function(response) {
                            setBtnLoading('Saving registration…');
                            try {
                                // Step 3: Save registration
                                const regRes = await fetch(STORE_URL, {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json'
                                    },
                                    body: new FormData(document.getElementById(
                                        'regForm')),
                                });
                                const regJson = await regRes.json().catch(() => null);

                                if (!regRes.ok || !regJson?.registration_id) {
                                    showServerErrors(
                                        regJson?.errors,
                                        regJson?.message ||
                                        'Registration failed. Contact support. Payment ID: ' +
                                        response.razorpay_payment_id
                                    );
                                    setBtnReady();
                                    return;
                                }

                                setBtnLoading('Verifying payment…');

                                // Step 4: Verify signature
                                const verifyRes = await fetch(
                                    '/events/register/' + regJson.registration_id +
                                    '/verify-payment', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': CSRF
                                        },
                                        body: JSON.stringify({
                                            razorpay_order_id: response
                                                .razorpay_order_id,
                                            razorpay_payment_id: response
                                                .razorpay_payment_id,
                                            razorpay_signature: response
                                                .razorpay_signature,
                                        }),
                                    }
                                );
                                const verify = await verifyRes.json().catch(() => null);

                                if (!verify) {
                                    showServerErrors(null,
                                        'Server error during verification. Please contact support.'
                                    );
                                    setBtnReady();
                                    return;
                                }
                                if (verify.success) {
                                    window.location.href = SUCCESS_BASE + '/' + regJson
                                        .registration_id;
                                } else {
                                    showServerErrors(null, 'Payment verification failed: ' + (
                                        verify.message || 'Unknown error'));
                                    setBtnReady();
                                }

                            } catch (err) {
                                console.error('Post-payment error:', err);
                                showServerErrors(null,
                                    'Something went wrong after payment. Please contact support.'
                                );
                                setBtnReady();
                            }
                        },

                        modal: {
                            ondismiss: () => setBtnReady()
                        },
                    });

                    rzp.open();

                } catch (err) {
                    console.error('Order creation error:', err);
                    showServerErrors(null, 'Network error. Please try again.');
                    setBtnReady();
                }
            });

        })();
    </script>
@endsection
