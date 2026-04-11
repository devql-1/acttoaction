<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action UI</title>
    {{-- <link rel="stylesheet" href="{{ asset('frontendassets/css/style.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('courseassets/img/faviconsdf.png') }}">
</head>

<body>

    <style>
        /* ============================================================
   BASE OVERRIDES — keep all original style.css rules intact
   ============================================================ */

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
        }

        /* ============================================================
   TOPBAR
   ============================================================ */

        .topbar {
            width: 100%;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            position: relative;
            z-index: 10;
            flex-shrink: 0;
        }

        .logo img {
            height: 60px;
            width: auto;
            display: block;
        }

        /* ============================================================
   BANNER  — full-width, always visible on every screen
   ============================================================ */

        /* ============================================================
   HERO BANNER — FULL SCREEN
   ============================================================ */
        .site-banner {
            width: 100%;
            height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Banner image */
        .site-banner img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            /* ensures proper alignment */
            z-index: 1;
        }

        /* Dark overlay */
        .site-banner::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 39, 71, 0.5);
            z-index: 2;
        }

        /* Hero content */
        .hero-content {
            position: relative;
            z-index: 3;
            color: #fff;
            text-align: center;
            padding: 20px;
            max-width: 900px;
        }

        /* Heading */
        .hero-content h1 {
            font-size: 56px;
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        /* Paragraph */
        .hero-content p {
            font-size: 18px;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        /* ============================================================
   DEAL POPUP — fixed left, vertically centred
   ============================================================ */

        .deal-popup {
            position: fixed;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: #0f2747;
            color: #ffffff;
            border-radius: 18px;
            padding: 20px 14px;
            width: 138px;
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

        /* ============================================================
   SHARED PILL BUTTON  — used for Deal, Support, Login
   ============================================================ */

        .pill-btn {
            display: inline-block;
            background: #ff6a00;
            color: #ffffff !important;
            border: none;
            padding: 9px 22px;
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

        .deal-popup .pill-btn {
            width: 100%;
            font-size: 11px;
            padding: 8px 10px;
        }

        /* ============================================================
   MAIN CONTAINER  — vertically centred action items
   ============================================================ */

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 20px 130px;
            width: 100%;
        }

        /* ============================================================
   ACTION ITEMS
   ============================================================ */

        .action {
            display: flex;
            align-items: center;
            gap: 18px;
            margin: 26px 0;
            cursor: pointer;
            opacity: 0;
            transform: translateY(25px);
            animation: fadeSlide 0.6s ease forwards;
        }

        .action:nth-child(1) {
            animation-delay: 0s;
        }

        .action:nth-child(2) {
            animation-delay: .2s;
        }

        .action:nth-child(3) {
            animation-delay: .4s;
        }

        .action-link {
            display: flex;
            align-items: center;
            gap: 18px;
            text-decoration: none;
            color: inherit;
        }

        .icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
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
            font-size: 64px;
            font-weight: 700;
            color: #0f2747;
            line-height: 1;
            font-family: Arial, sans-serif;
        }

        .action:hover .icon {
            transform: translateY(-6px) scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        /* ============================================================
   BOTTOM NAV  — desktop pill
   ============================================================ */

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

        /* ============================================================
   HAMBURGER BUTTON  — mobile only
   ============================================================ */

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

        /* ============================================================
   MOBILE MENU DRAWER
   ============================================================ */

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

        /* ============================================================
   SUPPORT BUTTON — fixed bottom-right
   ============================================================ */

        .support {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 200;
        }

        .support .pill-btn {
            box-shadow: 0 6px 20px rgba(255, 106, 0, 0.38);
            font-size: 14px;
        }

        /* ============================================================
   ANIMATIONS
   ============================================================ */

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

        /* ============================================================
   RESPONSIVE — TABLET  (601px – 900px)
   ============================================================ */

        @media (max-width: 900px) and (min-width: 601px) {

            .topbar {
                padding: 16px 30px;
            }

            .logo img {
                height: 50px;
            }

            .site-banner img {
                height: 200px;
            }

            .action h1 {
                font-size: 50px;
            }

            .icon {
                width: 58px;
                height: 58px;
                font-size: 24px;
            }

            .deal-popup {
                left: 12px;
                width: 120px;
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

        /* ============================================================
   RESPONSIVE — MOBILE  (≤ 600px)
   ============================================================ */

        @media (max-width: 600px) {

            /* Topbar */
            .action h1 {
                font-size: 37px;
            }

            .topbar {
                padding: 12px 16px;
            }

            .logo img {
                height: 55px;
            }

            /* Banner */
            .site-banner img {
                height: 160px;
            }

            /* Actions */
            .container {
                padding: 20px 16px 120px;
                align-items: center;
            }

            .action {
                gap: 14px;
                margin: 18px 0;
            }

            .action h1 {
                font-size: 38px;
            }

            .icon {
                width: 54px;
                height: 54px;
                font-size: 22px;
                border-radius: 14px;
            }

            /* Deal popup — bottom-left on mobile */
            .deal-popup {
                left: 10px;
                top: auto;
                bottom: 100px;
                transform: none;
                width: 118px;
                padding: 14px 10px;
            }

            .deal-title {
                font-size: 12px;
            }

            .deal-desc {
                font-size: 10px;
            }

            .deal-popup .pill-btn {
                font-size: 10px;
                padding: 7px 8px;
            }

            /* Desktop nav hidden on mobile */
            .bottom-nav {
                display: none !important;
            }

            /* Hamburger visible on mobile */
            .hamburger-btn {
                display: flex !important;
            }

            .mobile-menu {
                display: block;
            }

            /* Support */
            .support {
                bottom: 20px;
                right: 14px;
            }

            .support .pill-btn {
                font-size: 12px;
                padding: 9px 14px;
            }
        }
    </style>

    <!-- ===================== HEADER ===================== -->
    <header class="topbar">
        <div class="logo">
            <img src="{{ asset('img/logo/IMG_1658.JPG-removebg-preview.png') }}" alt="ActToAction Logo">
        </div>
    </header>

    <!-- ===================== BANNER ===================== -->
    <div class="site-banner">
        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1600&q=80" alt="Site Banner">
    </div>

    <!-- ===================== DEAL POPUP ===================== -->
    <div class="deal-popup" id="dealPopup">
        <button class="deal-close" onclick="document.getElementById('dealPopup').style.display='none'"
            aria-label="Close">✕</button>
        <div class="deal-badge">Hot Deal</div>
        <div class="deal-title">Special Offer!</div>
        <div class="deal-desc">30% off on all courses today only</div>
        <button class="pill-btn">Grab Now</button>
    </div>

    <!-- ===================== MAIN CONTENT ===================== -->
    <div class="container">

        <div class="action add">
            <a href="{{ route('index.course') }}" class="action-link">
                <div class="icon"><i class="fas fa-book-open"></i></div>
                <h1>Courses</h1>
            </a>
        </div>

        <div class="action send">
            <a href="{{ route('frontend.tests') }}" class="action-link">
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <h1>Skill Assessment</h1>
            </a>
        </div>

        <div class="action exchange">
            <a href="{{ route('summercamp') }}" class="action-link">
                <div class="icon"><i class="fas fa-campground"></i></div>
                <h1>Summer Camp</h1>
            </a>
        </div>

    </div>

    <!-- ===================== BOTTOM NAV — desktop ===================== -->
    <div class="bottom-nav">
        <a href="{{ route('frontend.blog.index') }}">
            <div>Blog</div>
        </a>
        <a href="{{ route('event') }}">
            <div>Events</div>
        </a>
        <a href="{{ route('aboutus') }}">
            <div>About us</div>
        </a>
    </div>

    <!-- ===================== HAMBURGER — mobile only ===================== -->
    <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleMenu()" aria-label="Open menu">
        <div class="hb-bars">
            <span id="hb1"></span>
            <span id="hb2"></span>
            <span id="hb3"></span>
        </div>
        Menu
    </button>

    <!-- ===================== MOBILE MENU ===================== -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('frontend.blog.index') }}">Blog</a>
        <a href="{{ route('event') }}">Events</a>
        <a href="{{ route('aboutus') }}">About us</a>
    </div>

    <!-- ===================== SUPPORT ===================== -->
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

</html>
