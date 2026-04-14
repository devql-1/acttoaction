<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ActtoAction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('courseassets/img/faviconsdf.png') }}">
    <style>
        /* ===== RESET & BASE ===== */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            width: 100%;
            overflow-x: hidden;
            font-family: Arial, sans-serif;
            background: #ffffff;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            width: 100%;
            padding: 16px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            position: relative;
            z-index: 10;
            flex-shrink: 0;
        }

        .logo img {
            height: 80px;
            width: auto;
            display: block;
        }

        /* ===== BADGE ===== */
        .badge-free {
            position: absolute;
            top: 8px;
            right: -34px;

            background: linear-gradient(45deg, #ff3b3b, #ff0000);
            color: #fff;

            font-size: 11px;
            font-weight: 700;
            padding: 5px 32px;

            transform: rotate(45deg);
            z-index: 3;
            letter-spacing: 1px;
            text-transform: uppercase;

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);

            animation: glow 1.5s infinite alternate;

            white-space: nowrap;
            /* prevent breaking */
        }

        @media (max-width: 600px) {
            .badge-free {
                top: 6px;
                right: -26px;

                font-size: 9px;
                padding: 3px 20px;

                transform: rotate(45deg);
            }
        }

        @media (max-width: 380px) {
            .badge-free {
                top: 12px;
                right: -29px;
                font-size: 7px;
                padding: 2px 14px;
            }
        }

        .badge-free::before,
        .badge-free::after {
            content: "";
            position: absolute;
            bottom: -6px;
            border-top: 6px solid #b30000;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
        }

        .badge-free::before {
            left: 0;
        }

        .badge-free::after {
            right: 0;
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
            }

            to {
                box-shadow: 0 0 12px rgba(255, 0, 0, 0.9);
            }
        }

        /* ===== BANNER SECTION ===== */
        .site-banner {
            width: 100%;
            height: 800px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .site-banner img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 1;
        }

        .site-banner::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(15, 39, 71, 0.45);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            color: #ffffff;
            text-align: center;
            padding: 20px 30px;
            max-width: 800px;
            width: 100%;
        }

        .hero-content h2 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.2;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .hero-content h2 span {
            color: #ff6a00;
        }

        .hero-content p {
            font-size: 17px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.88);
            margin-bottom: 0;
        }

        /* ===== PILL BUTTON ===== */
        .pill-btn {
            display: inline-block;
            background: #ff6a00;
            color: #ffffff !important;
            border: none;
            padding: 10px 24px;
            border-radius: 33px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.3px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
            white-space: nowrap;
        }

        .pill-btn:hover {
            background: #e65c00;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 106, 0, 0.38);
        }

        /* ===== DEAL POPUP ===== */
        .deal-popup {
            position: fixed;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: #0f2747;
            color: #ffffff;
            border-radius: 18px;
            padding: 20px 14px;
            width: 140px;
            text-align: center;
            z-index: 300;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.28);
        }

        .deal-close {
            position: absolute;
            top: 9px;
            right: 11px;
            background: none;
            border: none;
            color: #a0b4cc;
            font-size: 13px;
            cursor: pointer;
            line-height: 1;
            padding: 0;
        }

        .deal-close:hover {
            color: #ff6a00;
        }

        .deal-badge {
            background: #ff6a00;
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 33px;
            display: inline-block;
            margin-bottom: 10px;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .deal-title {
            font-size: 13px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .deal-desc {
            font-size: 11px;
            color: #a0b4cc;
            margin-bottom: 14px;
            line-height: 1.45;
        }

        .deal-popup .pill-btn {
            width: 100%;
            font-size: 11px;
            padding: 8px 10px;
        }

        /* ===== MAIN CONTAINER & ACTIONS ===== */
        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 80px 20px 140px;
            width: 100%;
        }

        .action {
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 32px 0;
            cursor: pointer;
            opacity: 0;
            transform: translateY(25px);
            animation: fadeSlide 0.6s ease forwards;
            position: relative;
        }

        .action:nth-child(1) {
            animation-delay: 0.0s;
        }

        .action:nth-child(2) {
            animation-delay: 0.2s;
        }

        .action:nth-child(3) {
            animation-delay: 0.4s;
        }

        .action-link {
            display: flex;
            align-items: center;
            gap: 20px;
            text-decoration: none;
            color: inherit;
        }

        .icon {
            width: 68px;
            height: 68px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #ffffff;
            flex-shrink: 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .add .icon {
            background: #ff6a00;
        }

        .send .icon {
            background: #0f2747;
        }

        .exchange .icon {
            background: #ff6a00;
        }

        .action h1 {
            font-size: 58px;
            font-weight: 700;
            color: #0f2747;
            line-height: 1;
            font-family: Arial, sans-serif;
        }

        .action:hover .icon {
            transform: translateY(-6px) scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        /* ===== BOTTOM NAV (DESKTOP) ===== */
        .bottom-nav {
            position: fixed;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%) translateY(40px);
            background: #0f2747;
            color: #ffffff;
            padding: 14px 32px;
            border-radius: 50px;
            display: flex;
            gap: 30px;
            font-size: 15px;
            font-family: Arial, sans-serif;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            z-index: 200;
            opacity: 0;
            animation: navSlideUp 0.8s ease 0.6s forwards;
        }

        .bottom-nav a {
            text-decoration: none;
            color: #ffffff;
            display: inline-block;
        }

        .bottom-nav a div {
            cursor: pointer;
            transition: color 0.25s ease, transform 0.25s ease;
            white-space: nowrap;
            user-select: none;
        }

        .bottom-nav a div:hover {
            color: #ff6a00;
            transform: translateY(-3px);
        }

        .bottom-nav a div.active {
            color: #ff6a00;
            font-weight: 600;
        }

        /* ===== HAMBURGER BUTTON (MOBILE) ===== */
        .hamburger-btn {
            display: none;
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #0f2747;
            color: #ffffff;
            border: none;
            border-radius: 33px;
            padding: 13px 28px;
            font-size: 15px;
            font-weight: 600;
            font-family: Arial, sans-serif;
            cursor: pointer;
            z-index: 201;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.28);
            align-items: center;
            gap: 10px;
            transition: background 0.25s ease;
        }

        .hamburger-btn:hover {
            background: #1a3a62;
        }

        .hb-bars {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .hb-bars span {
            width: 18px;
            height: 2px;
            background: #ffffff;
            border-radius: 2px;
            display: block;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        /* ===== MOBILE MENU ===== */
        .mobile-menu {
            display: none;
            position: fixed;
            bottom: 78px;
            left: 50%;
            transform: translateX(-50%) scale(0.94);
            background: #0f2747;
            border-radius: 20px;
            padding: 8px 12px;
            z-index: 202;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.32);
            min-width: 190px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.22s ease, transform 0.22s ease;
        }

        .mobile-menu.open {
            opacity: 1;
            transform: translateX(-50%) scale(1);
            pointer-events: all;
        }

        .mobile-menu a {
            display: block;
            text-decoration: none;
            color: #ffffff;
            padding: 13px 18px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 500;
            font-family: Arial, sans-serif;
            text-align: center;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .mobile-menu a+a {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .mobile-menu a:hover {
            background: rgba(255, 106, 0, 0.18);
            color: #ff6a00;
        }

        /* ===== SUPPORT BUTTON ===== */
        .support {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 200;
        }

        .support .pill-btn {
            box-shadow: 0 6px 20px rgba(255, 106, 0, 0.38);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes navSlideUp {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        /* ===== LARGE DESKTOP (1200px+) ===== */
        @media (min-width: 1200px) {
            .site-banner {
                height: 1000px;
            }

            .hero-content h2 {
                font-size: 48px;
            }

            .action h1 {
                font-size: 60px;
            }
        }

        /* ===== TABLET (601px – 900px) ===== */
        @media (max-width: 900px) and (min-width: 601px) {
            .topbar {
                padding: 14px 30px;
            }

            .logo img {
                height: 56px;
            }

            .site-banner {
                height: 260px;
            }

            .hero-content h2 {
                font-size: 32px;
            }

            .hero-content p {
                font-size: 15px;
            }

            .container {
                padding: 60px 20px 130px;
            }

            .action {
                margin: 24px 0;
            }

            .action h1 {
                font-size: 40px;
            }

            .icon {
                width: 58px;
                height: 58px;
                font-size: 24px;
            }

            .deal-popup {
                left: 12px;
                width: 122px;
                padding: 14px 10px;
            }

            .deal-title {
                font-size: 12px;
            }

            .deal-desc {
                font-size: 10px;
            }

            .bottom-nav {
                font-size: 14px;
                gap: 20px;
                padding: 12px 24px;
            }

            .support .pill-btn {
                font-size: 13px;
                padding: 8px 16px;
            }
        }

        /* ===== MOBILE (≤ 600px) ===== */
        @media (max-width: 600px) {
            .topbar {
                padding: 10px 16px;
            }

            .logo img {
                height: 48px;
            }

            .site-banner {
                height: 200px;
            }

            .hero-content h2 {
                font-size: 22px;
            }

            .hero-content p {
                font-size: 13px;
            }

            .container {
                padding: 50px 16px 120px;
                align-items: center;
                justify-content: flex-start;
            }

            .action {
                gap: 14px;
                margin: 20px 0;
            }

            .action h1 {
                font-size: 30px;
            }

            .icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
                border-radius: 14px;
            }

            .deal-popup {
                left: 8px;
                top: auto;
                bottom: 95px;
                transform: none;
                width: 112px;
                padding: 12px 9px;
            }

            .deal-badge {
                font-size: 9px;
                padding: 3px 8px;
                margin-bottom: 8px;
            }

            .deal-title {
                font-size: 11px;
            }

            .deal-desc {
                font-size: 10px;
                margin-bottom: 10px;
            }

            .deal-popup .pill-btn {
                font-size: 10px;
                padding: 6px 8px;
            }

            .bottom-nav {
                display: none !important;
            }

            .hamburger-btn {
                display: flex !important;
            }

            .mobile-menu {
                display: block;
            }

            .support {
                bottom: 18px;
                right: 12px;
            }

            .support .pill-btn {
                font-size: 12px;
                padding: 9px 13px;
            }
        }

        /* ===== SMALL MOBILE (≤ 380px) ===== */
        @media (max-width: 380px) {
            .site-banner {
                height: 170px;
            }

            .hero-content h2 {
                font-size: 18px;
            }

            .hero-content p {
                display: none;
            }

            .action h1 {
                font-size: 25px;
            }

            .icon {
                width: 44px;
                height: 44px;
                font-size: 18px;
            }

            .deal-popup {
                display: none;
            }
        }

        .ann-bar {
            background: #0e1c38;
            height: var(--ann-h);
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1002;
            font-family: var(--ff-nav);
            font-size: 11.5px;
            border-bottom: 1px solid rgba(255, 106, 0, .25);
            transition: height .3s, opacity .3s;
        }

        .ann-bar.hidden {
            height: 0;
            opacity: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .ann-bar .inner {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            gap: 12px;
            position: relative;
            padding: 0 40px;
        }

        .ann-bar .dot {
            width: 6px;
            height: 6px;
            background: #ff6a00;
            border-radius: 50%;
            flex-shrink: 0;
            animation: dotPulse 1.8s infinite;
        }

        @keyframes dotPulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .25
            }
        }

        /* ===== ANNOUNCEMENT BAR (Below Header) ===== */
        .ann-bar {
            background: #0e1c38;
            display: flex;
            align-items: center;
            position: relative;
            font-family: Arial, sans-serif;
            font-size: 12px;
            border-bottom: 1px solid rgba(255, 106, 0, 0.25);
            transition: max-height 0.3s ease, opacity 0.3s ease, padding 0.3s ease;
            max-height: 60px;
            opacity: 1;
            overflow: hidden;
        }

        .ann-bar.hidden {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .ann-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            gap: 12px;
            position: relative;
            padding: 12px 40px;
        }

        .ann-dot {
            width: 6px;
            height: 6px;
            background: #ff6a00;
            border-radius: 50%;
            flex-shrink: 0;
            animation: dotPulse 1.8s infinite;
        }

        @keyframes dotPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.25;
            }
        }

        .ann-msg {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 640px;
        }

        .ann-msg strong {
            color: #ff6a00;
            font-weight: 700;
        }

        .ann-cta {
            background: #ff6a00;
            color: #ffffff;
            border: none;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            white-space: nowrap;
            flex-shrink: 0;
            transition: background 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .ann-cta:hover {
            background: #e65c00;
        }

        .ann-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.35);
            font-size: 14px;
            cursor: pointer;
            padding: 0;
            position: absolute;
            right: 12px;
            line-height: 1;
            transition: color 0.2s ease;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ann-close:hover {
            color: #ffffff;
        }

        /* ===== TABLET (601px – 900px) ===== */
        @media (max-width: 900px) and (min-width: 601px) {
            .ann-bar {
                font-size: 11px;
                max-height: 56px;
            }

            .ann-inner {
                padding: 10px 30px;
                gap: 10px;
            }

            .ann-msg {
                max-width: 500px;
            }

            .ann-cta {
                padding: 5px 12px;
                font-size: 9px;
            }
        }

        /* ===== MOBILE (≤ 600px) ===== */
        @media (max-width: 600px) {
            .ann-bar {
                font-size: 10.5px;
                max-height: 80px;
            }

            .ann-inner {
                padding: 10px 40px 10px 12px;
                gap: 8px;
                flex-wrap: wrap;
            }

            .ann-msg {
                max-width: 100%;
                font-size: 10px;
                line-height: 1.4;
                white-space: normal;
                overflow: visible;
                text-overflow: clip;
            }

            .ann-cta {
                display: none;
            }

            .ann-dot {
                width: 5px;
                height: 5px;
            }

            .ann-close {
                right: 6px;
                font-size: 12px;
            }
        }

        /* ===== SMALL MOBILE (≤ 380px) ===== */
        @media (max-width: 380px) {
            .ann-bar {
                font-size: 9.5px;
                max-height: 100px;
            }

            .ann-inner {
                padding: 8px 36px 8px 8px;
                gap: 6px;
            }

            .ann-msg {
                font-size: 9px;
            }

            .ann-close {
                right: 4px;
                width: 20px;
                height: 20px;
                font-size: 11px;
            }
        }
    </style>
</head>

<body>

    <div class="ann-bar" id="annBar">
        <div class="ann-inner">
            <span class="ann-dot"></span>
            <span class="ann-msg">🎭 &nbsp;<strong>Summer Camp 2026</strong> — Jaipur's Biggest Performing Arts Camp is
                Coming! &nbsp;|&nbsp; Drama · Dance · Music · Storytelling</span>
            <a href="{{ route('event') }}" class="ann-cta">Register Interest</a>
            <button class="ann-close" id="annClose" title="Close"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <!-- HEADER -->
    <header class="topbar">
        <div class="logo">
            <img src="{{ asset('img/logo/IMG_6008.PNG') }}" alt="ActToAction Logo">
        </div>
    </header>

    <!-- HERO BANNER SECTION -->
    <section class="site-banner">
        <img src="{{ asset('courseassets/img/homebanner/IMG_3987.JPEG') }}" alt="Site Banner">
        <div class="hero-content">
            <h2>Building Future Ready <span> Leaders</span>
            </h2>
            <p>Creative Expression, Cognitive Leadership & Technology led Innovation</p>
        </div>
    </section>

    <!-- DEAL POPUP -->
    <span class="bell-badge">5</span>
    <!-- MAIN ACTION SECTION -->
    <section class="container">
        <div class="action add">
            <a href="{{ route('index.course') }}" class="action-link">
                <div class="icon"><i class="fas fa-book-open"></i></div>
                <h1>Our Courses</h1>
            </a>
        </div>

        <div class="action send">
            <span class="badge-free">FREE*</span>
            <a href="{{ route('frontend.tests') }}" class="action-link">
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <h1>Skill Assessment</h1>
            </a>
        </div>

        <div class="action exchange">
            <a href="{{ route('summercamp') }}" class="action-link">
                <div class="icon"><i class="fas fa-campground"></i></div>
                <h1>Summer Camp 2026</h1>
            </a>
        </div>
    </section>

    <!-- BOTTOM NAVIGATION (DESKTOP) -->
    <nav class="bottom-nav">
        <a href="{{ route('frontend.blog.index') }}">
            <div>Blog</div>
        </a>
        <a href="{{ route('event') }}">
            <div>Events</div>
        </a>
        <a href="{{ route('aboutus') }}">
            <div>About us</div>
        </a>
        <a href="{{ route('volunteer') }}">
            <div>Join us</div>
        </a>
    </nav>

    <!-- HAMBURGER BUTTON (MOBILE) -->
    <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleMenu()" aria-label="Open menu">
        <div class="hb-bars">
            <span id="hb1"></span>
            <span id="hb2"></span>
            <span id="hb3"></span>
            <span id="hb4"></span>
        </div>
        Menu
    </button>

    <!-- MOBILE MENU DRAWER -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('frontend.blog.index') }}">Blog</a>
        <a href="{{ route('event') }}">Events</a>
        <a href="{{ route('aboutus') }}">About us</a>
        <a href="{{ route('volunteer') }}">
            <div>Join us</div>
        </a>
    </div>

    <!-- SUPPORT BUTTON -->
    <div class="support">
        <button class="pill-btn">&#128172; Support</button>
    </div>
    <script>
        // Simple Announcement Bar Close (Current Tab Only - No Storage)
        document.addEventListener('DOMContentLoaded', function() {
            const annBar = document.getElementById('annBar');
            const annCloseBtn = document.getElementById('annClose');

            if (!annBar || !annCloseBtn) return;

            annCloseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                annBar.classList.add('hidden'); // Closes only for current tab
            });
        });
    </script>
    <script>
        function toggleMenu() {
            var menu = document.getElementById('mobileMenu');
            var open = menu.classList.toggle('open');
            document.getElementById('hb1').style.transform = open ? 'rotate(45deg) translate(4px, 4px)' : '';
            document.getElementById('hb2').style.opacity = open ? '0' : '1';
            document.getElementById('hb3').style.transform = open ? 'rotate(-45deg) translate(4px, -4px)' : '';
        }

        document.addEventListener('click', function(e) {
            var menu = document.getElementById('mobileMenu');
            var btn = document.getElementById('hamburgerBtn');
            if (menu && btn && !menu.contains(e.target) && !btn.contains(e.target)) {
                menu.classList.remove('open');
                document.getElementById('hb1').style.transform = '';
                document.getElementById('hb2').style.opacity = '';
                document.getElementById('hb3').style.transform = '';
            }
        });
    </script>
    @include('frontend.Home.notification')

</body>
@include('frontend.Home.chatbot')




</html>
