<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action UI</title>
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
    </style>
</head>

<body>
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
            <h2>Building Future Ready Leaders Explore our courses,<span> assessments & summer camps.</span>
            </h2>
            <p>Creative Expression, Cognative Leadership & Technology led Innovation</p>
        </div>
    </section>

    <!-- DEAL POPUP -->
    <span class="bell-badge">4</span>
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
</body>
@include('frontend.Home.chatbot')
<script>
    // Banner Slides Data - Static
    const bannerSlidesData = [{
            id: 1,
            image: "{{ asset('courseassets/img/homebanner/IMG_3987.JPEG') }}",
            title: "Learn Programming",
            url: "{{ route('index.course') }}"
        },
        {
            id: 2,
            image: "https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80",
            title: "Free Skill Assessment",
            url: "{{ route('frontend.tests') }}"
        },
        {
            id: 3,
            image: "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&q=80",
            title: "Summer Camp 2026",
            url: "{{ route('summercamp') }}"
        },
        {
            id: 4,
            image: "https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80",
            title: "Special Offer - 30% Off",
            url: "{{ route('index.course') }}"
        }
    ];

    let currentSlideIndex = 0;

    // Create Bell Notification + Banner Slider
    function createBellAndSlider() {
        const bellHTML = `
        <div class="bell-notification-wrapper">
            <button class="bell-icon" id="bellIcon" onclick="toggleBannerSlider()" aria-label="Notifications">
                <i class="fas fa-bell"></i>
                <span class="bell-badge">${bannerSlidesData.length}</span>
            </button>
        </div>
    `;

        const sliderHTML = `
        <!-- Banner Slider Modal -->
        <div class="banner-slider-backdrop" id="bannerBackdrop" onclick="closeBannerSlider(event)"></div>
        
        <div class="banner-slider-container" id="bannerSliderContainer">
            <!-- Close Button -->
            <button class="banner-slider-close" onclick="closeBannerSlider(event)" aria-label="Close">✕</button>

            <!-- Slider Wrapper -->
            <div class="banner-slider-wrapper">
                <div class="banner-slides" id="bannerSlides">
                    ${bannerSlidesData.map((slide, index) => `
                        <div class="banner-slide" onclick="goToBannerPage('${slide.url}')">
                            <img src="${slide.image}" alt="${slide.title}">
                            <div class="banner-slide-overlay">
                                <p>${slide.title}</p>
                            </div>
                        </div>
                    `).join('')}
                </div>

                <!-- Navigation Arrows -->
                <button class="banner-arrow banner-arrow-prev" onclick="prevBannerSlide()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="banner-arrow banner-arrow-next" onclick="nextBannerSlide()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

        
        </div>
    `;

        document.body.insertAdjacentHTML('beforeend', bellHTML);
        document.body.insertAdjacentHTML('beforeend', sliderHTML);
        addBellAndSliderStyles();
    }

    // Add Styles
    function addBellAndSliderStyles() {
        const styles = `
        /* ===== BELL NOTIFICATION ICON ===== */
        .bell-notification-wrapper {
            position: fixed;
            bottom: 100px;
            left: 25px;
            z-index: 150;
        }

        .bell-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6a00, #ff8533);
            color: #ffffff;
            border: none;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 4px 15px rgba(255, 106, 0, 0.35);
            transition: all 0.3s ease;
        }

        .bell-icon:hover {
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 6px 20px rgba(255, 106, 0, 0.45);
        }

        .bell-icon:active {
            transform: scale(0.95);
        }

        .bell-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff3b3b;
            color: #ffffff;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            border: 2px solid #ffffff;
            animation: bellPulse 2s infinite;
        }

        @keyframes bellPulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.15);
            }
        }

        /* ===== BANNER SLIDER MODAL ===== */
        .banner-slider-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 998;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.35s ease, pointer-events 0.35s ease;
        }

        .banner-slider-backdrop.open {
            opacity: 1;
            pointer-events: auto;
        }

        .banner-slider-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 900px;
            height: 500px;
            background: #ffffff;
            border-radius: 20px;
            z-index: 999;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            opacity: 0;
            pointer-events: none;
            overflow: hidden;
            transition: opacity 0.4s ease, pointer-events 0.4s ease;
        }

        .banner-slider-container.open {
            opacity: 1;
            pointer-events: auto;
        }

        @keyframes bannerSliderSlideIn {
            to {
                opacity: 1;
            }
        }

        .banner-slider-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #0f2747;
            color: #ffffff;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: background 0.2s ease;
        }

        .banner-slider-close:hover {
            background: #ff6a00;
        }

        .banner-slider-wrapper {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .banner-slides {
            display: flex;
            height: 100%;
            transition: transform 0.5s ease;
        }

        .banner-slide {
            min-width: 100%;
            height: 100%;
            position: relative;
            cursor: pointer;
            overflow: hidden;
        }

        .banner-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .banner-slide:hover img {
            transform: scale(1.05);
        }

        .banner-slide-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(15, 39, 71, 0.8));
            padding: 30px 20px 20px;
            color: #ffffff;
        }

        .banner-slide-overlay p {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        /* Navigation Arrows */
        .banner-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 106, 0, 0.85);
            color: #ffffff;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
            transition: all 0.3s ease;
        }

        .banner-arrow:hover {
            background: #ff6a00;
            transform: translateY(-50%) scale(1.1);
        }

        .banner-arrow-prev {
            left: 15px;
        }

        .banner-arrow-next {
            right: 15px;
        }

        /* Dots Indicator */
        .banner-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            padding: 16px;
            background: #f8f9fb;
        }

        .banner-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #d0d5dd;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .banner-dot.active {
            background: #ff6a00;
            width: 28px;
            border-radius: 5px;
        }

        .banner-dot:hover {
            background: #ff6a00;
        }

        /* ===== MOBILE RESPONSIVE ===== */
        @media (max-width: 900px) {
            .bell-notification-wrapper {
                bottom: 80px;
                left: 15px;
            }

            .bell-icon {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .banner-slider-container {
                height: 350px;
                max-width: 85%;
            }

            .banner-slide-overlay {
                padding: 20px 15px 15px;
            }

            .banner-slide-overlay p {
                font-size: 15px;
            }

            .banner-arrow {
                width: 38px;
                height: 38px;
                font-size: 16px;
            }
        }

        @media (max-width: 600px) {
            .bell-notification-wrapper {
                bottom: 70px;
                left: 12px;
            }

            .bell-icon {
                width: 44px;
                height: 44px;
                font-size: 16px;
            }

            .bell-badge {
                width: 20px;
                height: 20px;
                font-size: 10px;
            }

            .banner-slider-container {
                height: 300px;
                width: 95%;
                max-width: none;
                border-radius: 16px;
            }

            .banner-arrow {
                width: 34px;
                height: 34px;
                font-size: 14px;
            }

            .banner-arrow-prev {
                left: 8px;
            }

            .banner-arrow-next {
                right: 8px;
            }

            .banner-slide-overlay {
                padding: 16px 12px 12px;
            }

            .banner-slide-overlay p {
                font-size: 13px;
            }

            .banner-dots {
                padding: 12px;
                gap: 6px;
            }

            .banner-dot {
                width: 8px;
                height: 8px;
            }

            .banner-dot.active {
                width: 24px;
            }
        }

        @media (max-width: 380px) {
            .bell-icon {
                width: 40px;
                height: 40px;
                font-size: 14px;
            }

            .bell-badge {
                width: 18px;
                height: 18px;
                font-size: 9px;
            }

            .banner-slider-container {
                height: 250px;
            }

            .banner-slide-overlay p {
                font-size: 12px;
            }
        }
    `;

        const styleTag = document.createElement('style');
        styleTag.textContent = styles;
        document.head.appendChild(styleTag);
    }

    // Toggle Banner Slider
    function toggleBannerSlider() {
        const container = document.getElementById('bannerSliderContainer');
        const backdrop = document.getElementById('bannerBackdrop');

        if (container && backdrop) {
            const isOpen = container.classList.contains('open');
            if (isOpen) {
                container.classList.remove('open');
                backdrop.classList.remove('open');
            } else {
                container.classList.add('open');
                backdrop.classList.add('open');
            }
        }
    }

    // Close Banner Slider
    function closeBannerSlider(e) {
        if (e) {
            e.stopPropagation();
        }

        const container = document.getElementById('bannerSliderContainer');
        const backdrop = document.getElementById('bannerBackdrop');

        if (container) container.classList.remove('open');
        if (backdrop) backdrop.classList.remove('open');
    }

    // Next Slide
    function nextBannerSlide() {
        currentSlideIndex = (currentSlideIndex + 1) % bannerSlidesData.length;
        updateSlide();
    }

    // Previous Slide
    function prevBannerSlide() {
        currentSlideIndex = (currentSlideIndex - 1 + bannerSlidesData.length) % bannerSlidesData.length;
        updateSlide();
    }

    // Go to Specific Slide
    function goToSlide(index) {
        currentSlideIndex = index;
        updateSlide();
    }

    // Update Slide Display
    function updateSlide() {
        const slidesContainer = document.getElementById('bannerSlides');
        const dots = document.querySelectorAll('.banner-dot');

        slidesContainer.style.transform = `translateX(-${currentSlideIndex * 100}%)`;

        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlideIndex);
        });
    }

    // Go to Banner Page
    function goToBannerPage(url) {
        if (url && url !== '#') {
            window.location.href = url;
        }
    }

    // Initialize on Page Load
    document.addEventListener('DOMContentLoaded', function() {
        createBellAndSlider();

        // Auto-advance slides every 5 seconds (only when modal is open)
        setInterval(() => {
            try {
                const container = document.getElementById('bannerSliderContainer');
                if (container && container.classList.contains('open')) {
                    nextBannerSlide();
                }
            } catch (err) {
                console.log('Auto-advance error:', err);
            }
        }, 5000);

        // Test - make sure functions are accessible
        window.toggleBannerSlider = toggleBannerSlider;
        window.closeBannerSlider = closeBannerSlider;
        window.nextBannerSlide = nextBannerSlide;
        window.prevBannerSlide = prevBannerSlide;
        window.goToSlide = goToSlide;
        window.goToBannerPage = goToBannerPage;
    });
</script>

</html>
