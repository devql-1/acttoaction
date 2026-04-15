<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Summer Camp 2025 | Act To Action</title>
    <link rel="icon" type="image/png" href="{{ asset('courseassets/img/faviconsdf.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Montserrat:wght@300;400;500;600;700;800&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />

    <style>
        /* ===== VARIABLES ===== */
        :root {
            --ff-body: "Roboto", system-ui, sans-serif;
            --ff-head: "Montserrat", sans-serif;
            --ff-nav: "Lato", sans-serif;
            --bg: #ffffff;
            --fg: #3c4049;
            --head: #112344;
            --accent: #ff6a00;
            --surface: #ffffff;
            --white: #ffffff;
            --ann-h: 40px;
            scroll-behavior: smooth;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            color: var(--fg);
            background: var(--bg);
            font-family: var(--ff-body);
            margin: 0;
            /* padding-top: calc(var(--ann-h) + 48px); */
        }

        /* body.ann-gone {
            padding-top: 58px;
        } */

        a {
            color: var(--accent);
            text-decoration: none;
            transition: .3s;
        }

        a:hover {
            color: color-mix(in srgb, var(--accent), transparent 25%);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--head);
            font-family: var(--ff-head);
        }

        img {
            max-width: 100%;
            display: block;
        }

        /* FIX: was "overflow: clip" which breaks gallery scroll strip animations */
        section {
            overflow: hidden;
        }


        /* ===== ANNOUNCEMENT BAR ===== */
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

        .ann-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            gap: 12px;
            position: relative;
            padding: 0 40px;
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
                opacity: 1
            }

            50% {
                opacity: .25
            }
        }

        .ann-msg {
            font-weight: 500;
            color: rgba(255, 255, 255, .8);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 640px;
        }

        .ann-msg strong {
            color: #ff6a00;
        }

        .ann-cta {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 3px 12px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            white-space: nowrap;
            flex-shrink: 0;
            transition: .2s;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .ann-cta:hover {
            background: color-mix(in srgb, var(--accent), black 15%);
            color: #fff;
        }

        .ann-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, .35);
            font-size: 12px;
            cursor: pointer;
            padding: 0;
            position: absolute;
            right: 12px;
            line-height: 1;
            transition: .2s;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ann-close:hover {
            color: #fff;
        }

        @media(max-width:575px) {
            .ann-cta {
                display: none;
            }

            .ann-msg {
                font-size: 10.5px;
            }
        }


        /* ===== HEADER ===== */
        .site-header {
            background: #fff;
            box-shadow: 0 2px 14px rgba(0, 0, 0, .08);
            position: fixed;
            top: var(--ann-h);
            left: 0;
            right: 0;
            z-index: 1001;
            transition: top .3s, box-shadow .3s;
        }

        .site-header.ann-gone {
            top: 0;
        }

        .site-header .brand {
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .site-header .brand .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .site-header .brand .logo img {
            margin-top: 10px;
            height: 83px;
        }

        .site-header .brand .logo h1 {
            font-size: 30px;
            font-weight: 700;
            color: var(--head);
            margin: 0;
        }

        .navmenu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 0;
        }

        .navmenu>ul>li {
            position: relative;
        }

        .navmenu a {
            font-family: var(--ff-nav);
            font-size: 13.5px;
            font-weight: 500;
            color: var(--fg);
            padding: 18px 13px;
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
            transition: .3s;
            position: relative;
        }

        .navmenu a::after {
            content: '';
            position: absolute;
            bottom: 10px;
            left: 13px;
            right: 13px;
            height: 2px;
            background: var(--accent);
            transform: scaleX(0);
            transition: .3s;
        }

        .navmenu a:hover,
        .navmenu a.active {
            color: var(--accent);
        }

        .navmenu a:hover::after,
        .navmenu a.active::after {
            transform: scaleX(1);
        }

        .navmenu .has-drop {
            position: relative;
        }

        .navmenu .drop-arrow {
            font-size: 10px;
            margin-left: 2px;
            transition: .3s;
        }

        .navmenu .dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, .12);
            border: 1px solid rgba(0, 0, 0, .06);
            min-width: 210px;
            padding: 8px 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: .25s;
            z-index: 999;
        }

        .navmenu .has-drop:hover .dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .navmenu .has-drop:hover .drop-arrow {
            transform: rotate(180deg);
        }

        .navmenu .dropdown a {
            padding: 10px 18px;
            font-size: 13px;
            color: var(--fg);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navmenu .dropdown a::after {
            display: none;
        }

        .navmenu .dropdown a:hover {
            color: var(--accent);
            background: #fff8f4;
            padding-left: 22px;
        }

        .navmenu .dropdown a i {
            color: var(--accent);
            font-size: 13px;
            width: 16px;
        }

        .navmenu .dropdown .sep {
            height: 1px;
            background: #f0f0f0;
            margin: 6px 0;
        }

        .nav-register {
            background: var(--accent);
            color: #fff !important;
            padding: 9px 18px !important;
            border-radius: 22px;
            font-weight: 700 !important;
            font-size: 13px !important;
        }

        .nav-register::after {
            display: none !important;
        }

        .nav-register:hover {
            background: color-mix(in srgb, var(--accent), black 12%) !important;
            color: #fff !important;
            transform: translateY(-1px);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .header-soc {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-right: 12px;
            padding-right: 12px;
            border-right: 1px solid #eee;
        }

        .header-soc a {
            color: #aaa;
            font-size: 14px;
            transition: .2s;
        }

        .header-soc a:hover {
            color: var(--accent);
        }

        .mob-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--fg);
            cursor: pointer;
            padding: 4px;
        }

        @media(max-width:1099px) {
            .nav-wrap {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .65);
                z-index: 9998;
            }

            .nav-wrap.open {
                display: block;
            }

            .navmenu {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                width: 270px;
                background: #fff;
                z-index: 9999;
                padding: 60px 0 24px;
                overflow-y: auto;
                box-shadow: -4px 0 20px rgba(0, 0, 0, .15);
            }

            .navmenu ul {
                flex-direction: column;
                gap: 0;
            }

            .navmenu a {
                font-size: 15px;
                padding: 13px 22px;
                border-bottom: 1px solid #f5f5f5;
            }

            .navmenu a::after {
                display: none;
            }

            .navmenu .dropdown {
                position: static;
                box-shadow: none;
                border: none;
                border-radius: 0;
                opacity: 1;
                visibility: visible;
                transform: none;
                display: none;
                padding: 0;
                background: #f9f9f9;
            }

            .navmenu .has-drop.open .dropdown {
                display: block;
            }

            .navmenu .dropdown a {
                padding: 10px 32px;
                font-size: 13px;
                border-bottom: 1px solid #f0f0f0;
            }

            .navmenu .dropdown .sep {
                display: none;
            }

            .navmenu .has-drop>a {
                justify-content: space-between;
            }

            .mob-toggle {
                display: block;
            }

            .mob-close {
                position: absolute;
                top: 14px;
                right: 14px;
                background: none;
                border: none;
                font-size: 22px;
                cursor: pointer;
                color: var(--fg);
            }

            .nav-register {
                margin: 12px 22px;
                border-radius: 8px;
                text-align: center;
                display: block;
            }

            .header-soc {
                display: none;
            }
        }


        /* ===== HERO ===== */
        .hero {
            width: 100%;
            height: 92vh;
            min-height: 500px;
            position: relative;
            overflow: hidden;
            display: block;
        }

        .hero-banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 160px;
            background: linear-gradient(to top, rgba(0, 0, 0, .35), transparent);
            pointer-events: none;
        }

        @media(max-width:767px) {
            .hero {
                height: 55vw;
                min-height: 260px;
            }
        }


        /* ===== SECTION BASE ===== */
        .sec {
            padding: 70px 0;
        }

        .sec.bg-light2 {
            background: #f4f8ff;
        }

        .sec-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .sec-title h2 {
            font-size: clamp(24px, 4vw, 34px);
            font-weight: 600;
            margin-bottom: 16px;
            padding-bottom: 16px;
            position: relative;
        }

        .sec-title h2::before {
            content: '';
            position: absolute;
            bottom: 1px;
            left: 50%;
            transform: translateX(-50%);
            width: 140px;
            height: 1px;
            background: rgba(60, 64, 73, .25);
        }

        .sec-title h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: var(--accent);
        }

        .sec-title p {
            color: color-mix(in srgb, var(--fg), transparent 25%);
            max-width: 580px;
            margin: 0 auto;
            font-size: 15px;
            line-height: 1.7;
        }


        /* ===== PRELOADER ===== */
        #preloader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #preloader::before,
        #preloader::after {
            content: '';
            position: absolute;
            border: 4px solid var(--accent);
            border-radius: 50%;
            animation: preAnim 2s cubic-bezier(0, .2, .8, 1) infinite;
        }

        #preloader::after {
            animation-delay: -.5s;
        }

        @keyframes preAnim {
            0% {
                width: 10px;
                height: 10px;
                top: calc(50% - 5px);
                left: calc(50% - 5px);
                opacity: 1
            }

            100% {
                width: 72px;
                height: 72px;
                top: calc(50% - 36px);
                left: calc(50% - 36px);
                opacity: 0
            }
        }


        /* ===== SCROLL TOP ===== */
        .scroll-top {
            position: fixed;
            right: 16px;
            bottom: -20px;
            z-index: 9999;
            width: 44px;
            height: 44px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: .4s;
        }

        .scroll-top i {
            font-size: 22px;
            color: #fff;
        }

        .scroll-top.show {
            bottom: 16px;
            opacity: 1;
            visibility: visible;
        }


        /* ===== STATS COUNTER ===== */
        .stats-sec {
            padding: 60px 0;
            background: linear-gradient(135deg, #112344, #1c3d75);
            position: relative;
            overflow: hidden;
        }

        .stats-sec::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .stat-card {
            text-align: center;
            padding: 28px 16px;
            position: relative;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            right: 0;
            top: 20%;
            height: 60%;
            width: 1px;
            background: rgba(255, 255, 255, .1);
        }

        .stat-card:last-child::after {
            display: none;
        }

        .stat-ico {
            width: 64px;
            height: 64px;
            background: rgba(255, 106, 0, .15);
            border: 2px solid rgba(255, 106, 0, .3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .stat-ico i {
            font-size: 26px;
            color: #ff6a00;
        }

        .ctr {
            font-family: var(--ff-head);
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 800;
            color: #fff;
            line-height: 1;
            display: block;
            margin-bottom: 6px;
        }

        .ctr .sfx {
            font-size: 1.6rem;
            color: #ff6a00;
        }

        .stat-lbl {
            font-size: 13px;
            color: rgba(255, 255, 255, .6);
            letter-spacing: .3px;
        }

        @media(max-width:767px) {
            .stat-card::after {
                display: none;
            }

            .stat-card {
                border-bottom: 1px solid rgba(255, 255, 255, .07);
            }

            .stat-card:last-child {
                border: none;
            }
        }


        /* ===== ABOUT ===== */
        .about-sec {
            padding: 90px 0;
            background: #fff;
        }

        .about-sec .section-heading {
            font-size: clamp(1.6rem, 3.5vw, 2.4rem);
            font-weight: 300;
            line-height: 1.35;
            margin-bottom: 18px;
        }

        .about-sec .lead-p {
            font-size: 1.15rem;
            font-weight: 300;
            line-height: 1.75;
            color: color-mix(in srgb, var(--fg), transparent 15%);
            margin-bottom: 16px;
        }

        .about-sec .body-p {
            font-size: 1rem;
            line-height: 1.85;
            color: color-mix(in srgb, var(--fg), transparent 20%);
            margin-bottom: 28px;
        }

        .mini-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .mini-stat {
            text-align: center;
            padding: 16px 10px;
            background: #f4f8ff;
            border-radius: 12px;
        }

        .mini-stat .num {
            font-size: 2rem;
            font-weight: 300;
            color: var(--accent);
            display: block;
        }

        .mini-stat .num::after {
            content: '+';
            font-size: 1.2rem;
        }

        .mini-stat .lbl {
            font-size: 12px;
            color: color-mix(in srgb, var(--fg), transparent 30%);
            margin-top: 4px;
        }

        .about-visual {
            position: relative;
        }

        .about-img {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .1);
        }

        .about-img img {
            width: 100%;
            object-fit: cover;
            transition: .4s;
        }

        .about-img:hover img {
            transform: scale(1.04);
        }

        .about-badge {
            position: absolute;
            top: 16px;
            right: -14px;
            background: var(--accent);
            color: #fff;
            padding: 14px 16px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 12px 32px rgba(255, 106, 0, .4);
        }

        .about-badge .yr {
            display: block;
            font-size: 1.4rem;
            font-weight: 700;
            line-height: 1;
        }

        .about-badge .txt {
            display: block;
            font-size: 11px;
            opacity: .9;
            margin-top: 3px;
        }

        .about-fc {
            position: absolute;
            bottom: -24px;
            left: -20px;
            background: #fff;
            padding: 16px;
            border-radius: 10px;
            box-shadow: 0 12px 36px rgba(0, 0, 0, .1);
            border: 1px solid rgba(0, 0, 0, .05);
        }

        .about-fc .content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .about-fc .ico {
            width: 44px;
            height: 44px;
            background: rgba(255, 106, 0, .1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .about-fc .ico i {
            color: var(--accent);
            font-size: 20px;
        }

        .about-fc h4 {
            font-size: 13px;
            font-weight: 700;
            margin: 0 0 3px;
            line-height: 1.2;
        }

        .about-fc p {
            font-size: 12px;
            color: #888;
            margin: 0;
        }

        @media(max-width:991px) {
            .about-badge {
                position: static;
                display: inline-block;
                margin-bottom: 16px;
            }

            .about-fc {
                position: static;
                margin-top: 20px;
            }
        }

        @media(max-width:575px) {
            .mini-stats {
                grid-template-columns: 1fr;
            }
        }


        /* ===== THEMES ===== */
        .themes-sec {
            padding: 70px 0;
        }

        .theme-card {
            background: #fff;
            border-radius: 14px;
            padding: 28px 22px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, .07);
            transition: .35s;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .theme-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent);
            transform: scaleX(0);
            transition: .35s;
        }

        .theme-card:hover::after {
            transform: scaleX(1);
        }

        .theme-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 18px 44px rgba(0, 0, 0, .1);
        }

        .theme-ico {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 32px;
            transition: .3s;
        }

        .theme-card:hover .theme-ico {
            transform: scale(1.1) rotate(-4deg);
        }

        .theme-card h4 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .theme-card p {
            font-size: 13px;
            color: #777;
            margin: 0;
            line-height: 1.6;
        }

        .theme-tag {
            display: inline-block;
            margin-top: 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            padding: 3px 10px;
            border-radius: 20px;
        }


        /* ===== ACTIVITIES ===== */
        .act-card {
            background: #fff;
            border-radius: 14px;
            padding: 32px 24px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, .07);
            transition: .3s;
            height: 100%;
        }

        .act-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .1);
            border-color: rgba(255, 106, 0, .3);
        }

        .act-ico {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, var(--accent), #ff9500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .act-ico i {
            color: #fff;
            font-size: 28px;
        }

        .act-card h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .act-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 18px;
            line-height: 1.6;
        }

        .act-list {
            list-style: none;
            padding: 0;
            margin: 0 0 20px;
        }

        .act-list li {
            padding: 7px 0;
            font-size: 13px;
            color: #555;
            border-bottom: 1px solid #f0f0f0;
        }

        .act-list li::before {
            content: "→";
            color: var(--accent);
            margin-right: 8px;
            font-weight: 700;
        }

        .act-list li:last-child {
            border: none;
        }

        .act-cta {
            color: var(--accent);
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .act-banner {
            background: linear-gradient(135deg, var(--accent), #c85000);
            border-radius: 16px;
            padding: 36px 32px;
            margin-top: 50px;
            color: #fff;
        }

        .act-banner h3 {
            color: #fff;
            font-size: clamp(18px, 3vw, 26px);
            margin-bottom: 8px;
        }

        .act-banner p {
            color: rgba(255, 255, 255, .85);
            margin: 0;
            font-size: 15px;
        }

        .act-banner .act-btn {
            background: #fff;
            color: var(--accent);
            padding: 14px 26px;
            border-radius: 40px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: .3s;
        }

        .act-banner .act-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .15);
            color: var(--accent);
        }


        /* =======================================================
           GALLERY — every rule scoped under .gallery-sec
           No unscoped img rules. No duplicate panel rules.
           ======================================================= */

        .gallery-sec {
            background: #0d0d0d;
            padding-bottom: 0;
            overflow: hidden;
        }

        /* ── panels ── */
        .gallery-sec .gallery-panel {
            display: none;
        }

        .gallery-sec .gallery-panel.active {
            display: block;
            animation: galFadeIn .3s ease;
        }

        @keyframes galFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── header ── */
        .gallery-header {
            padding: 60px 0 32px;
            text-align: center;
            position: relative;
        }

        .gallery-header::before {
            content: 'GALLERY';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: clamp(60px, 12vw, 120px);
            font-weight: 900;
            color: rgba(255, 255, 255, .025);
            letter-spacing: 8px;
            white-space: nowrap;
            pointer-events: none;
            font-family: var(--ff-head);
        }

        .gallery-header .g-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--accent);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 14px;
        }

        .gallery-header .g-eyebrow span {
            width: 28px;
            height: 1px;
            background: var(--accent);
            display: block;
        }

        .gallery-header h2 {
            color: #fff;
            font-size: clamp(24px, 4vw, 38px);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .gallery-header p {
            color: rgba(255, 255, 255, .45);
            font-size: 14px;
        }

        /* ── tabs ── */
        .gallery-tabs {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
            padding: 0 16px 36px;
        }

        .gtab {
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .1);
            color: rgba(255, 255, 255, .55);
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: .25s;
            white-space: nowrap;
            font-family: var(--ff-nav);
            letter-spacing: .3px;
        }

        .gtab:hover {
            background: rgba(255, 255, 255, .1);
            color: #fff;
        }

        .gtab.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            box-shadow: 0 4px 16px rgba(255, 106, 0, .35);
        }

        /* ── scroll strips ── */
        .scroll-strip {
            position: relative;
            overflow: hidden;
            padding: 6px 0;
        }

        .scroll-strip::before,
        .scroll-strip::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100px;
            z-index: 2;
            pointer-events: none;
        }

        .scroll-strip::before {
            left: 0;
            background: linear-gradient(to right, #0d0d0d 30%, transparent);
        }

        .scroll-strip::after {
            right: 0;
            background: linear-gradient(to left, #0d0d0d 30%, transparent);
        }

        .scroll-track {
            display: flex;
            gap: 8px;
            width: max-content;
            padding: 4px 0;
        }

        .scroll-track.fwd {
            animation: stripFwd 40s linear infinite;
        }

        .scroll-track.bwd {
            animation: stripBwd 48s linear infinite;
        }

        .scroll-track.fwd2 {
            animation: stripFwd 55s linear infinite;
        }

        .scroll-strip:hover .scroll-track {
            animation-play-state: paused;
        }

        @keyframes stripFwd {
            from {
                transform: translateX(0)
            }

            to {
                transform: translateX(-50%)
            }
        }

        @keyframes stripBwd {
            from {
                transform: translateX(-50%)
            }

            to {
                transform: translateX(0)
            }
        }

        /* FIX: scoped */
        .gallery-sec .scroll-track img {
            display: block;
            width: 100%;
        }

        /* ── slides ── */
        .s-slide {
            flex-shrink: 0;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            transition: .35s;
        }

        /* FIX: scoped — was the #1 bleeder */
        .gallery-sec .s-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .4s ease;
        }

        .gallery-sec .s-slide:hover img {
            transform: scale(1.08);
        }

        .gallery-sec .s-slide:hover {
            transform: scale(1.03);
            z-index: 2;
        }

        /* FIX: scoped overlay */
        .gallery-sec .s-slide .s-over {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            opacity: 0;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-sec .s-slide:hover .s-over {
            opacity: 1;
        }

        .gallery-sec .s-slide .s-over i {
            color: #fff;
            font-size: 22px;
        }

        .s-slide.sm {
            width: 200px;
            height: 150px;
        }

        .s-slide.md {
            width: 260px;
            height: 175px;
        }

        .s-slide.lg {
            width: 320px;
            height: 200px;
        }

        @media(max-width:575px) {
            .s-slide.sm {
                width: 150px;
                height: 115px;
            }

            .s-slide.md {
                width: 190px;
                height: 130px;
            }

            .s-slide.lg {
                width: 230px;
                height: 155px;
            }
        }

        /* ── masonry ── */
        .g-masonry {
            columns: 4 240px;
            column-gap: 8px;
            padding: 8px 16px 16px;
            width: 100%;
            min-height: 100px;
            overflow: visible;
        }

        .g-masonry .gm-item {
            break-inside: avoid;
            margin-bottom: 8px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
        }

        /* FIX: scoped */
        .gallery-sec .g-masonry .gm-item img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform .4s ease;
        }

        .gallery-sec .g-masonry .gm-item:hover img {
            transform: scale(1.05);
        }

        /* FIX: scoped overlay */
        .gallery-sec .g-masonry .gm-item .gm-over {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            opacity: 0;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-sec .g-masonry .gm-item:hover .gm-over {
            opacity: 1;
        }

        .gallery-sec .g-masonry .gm-item .gm-over i {
            color: #fff;
            font-size: 24px;
        }

        .gm-item .gm-label {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(0, 0, 0, .6);
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: .3s;
        }

        /* FIX: scoped */
        .gallery-sec .gm-item:hover .gm-label {
            opacity: 1;
        }

        @media(max-width:767px) {
            .g-masonry {
                columns: 2 150px;
            }
        }

        /* ── featured grid ── */
        .g-featured {
            display: grid;
            gap: 8px;
            padding: 8px 16px 16px;
        }

        .g-featured.layout-1 {
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: 220px 220px;
        }

        .g-featured.layout-1 .gf-hero {
            grid-row: span 2;
        }

        .g-featured .gf-item {
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
        }

        /* FIX: scoped */
        .gallery-sec .g-featured .gf-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .4s ease;
        }

        .gallery-sec .g-featured .gf-item:hover img {
            transform: scale(1.07);
        }

        /* FIX: scoped overlay */
        .gallery-sec .g-featured .gf-item .gf-over {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            opacity: 0;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-sec .g-featured .gf-item:hover .gf-over {
            opacity: 1;
        }

        .gallery-sec .g-featured .gf-item .gf-over i {
            color: #fff;
            font-size: 28px;
        }

        .gf-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 14px 16px;
            background: linear-gradient(to top, rgba(0, 0, 0, .75), transparent);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            opacity: 0;
            transform: translateY(6px);
            transition: .3s;
        }

        /* FIX: scoped */
        .gallery-sec .gf-item:hover .gf-caption {
            opacity: 1;
            transform: translateY(0);
        }

        @media(max-width:767px) {
            .g-featured.layout-1 {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
            }

            .g-featured.layout-1 .gf-hero {
                grid-row: span 1;
            }

            /* FIX: scoped */
            .gallery-sec .g-featured .gf-item img {
                height: 160px;
            }
        }

        /* ── footer ── */
        .g-footer {
            padding: 22px 16px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, .06);
        }

        .g-footer a {
            color: rgba(255, 255, 255, .5);
            font-size: 13px;
            font-family: var(--ff-nav);
            transition: .2s;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .g-footer a:hover {
            color: var(--accent);
        }

        /* ── lightbox ── */
        .lb-back {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .94);
            z-index: 99998;
            align-items: center;
            justify-content: center;
        }

        .lb-back.open {
            display: flex;
        }

        .lb-inner {
            position: relative;
            max-width: 92vw;
            max-height: 90vh;
        }

        /* FIX: transition:none so gallery hover styles never apply inside lightbox */
        .lb-inner img {
            max-width: 90vw;
            max-height: 86vh;
            border-radius: 8px;
            object-fit: contain;
            display: block;
            box-shadow: 0 24px 80px rgba(0, 0, 0, .6);
            transition: none !important;
            transform: none !important;
        }

        .lb-close {
            position: absolute;
            top: -44px;
            right: 0;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, .12);
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s;
        }

        .lb-close:hover {
            background: var(--accent);
        }

        .lb-prev,
        .lb-next {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .15);
            color: #fff;
            font-size: 20px;
            padding: 14px 15px;
            cursor: pointer;
            border-radius: 50%;
            transition: .2s;
            z-index: 99999;
        }

        .lb-prev {
            left: 16px;
        }

        .lb-next {
            right: 16px;
        }

        .lb-prev:hover,
        .lb-next:hover {
            background: var(--accent);
            border-color: var(--accent);
        }

        .lb-counter {
            position: absolute;
            bottom: -34px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, .4);
            font-size: 12px;
            white-space: nowrap;
        }


        /* ===== PEOPLE SECTIONS ===== */
        .people-section {
            padding: 80px 0;
        }

        .people-section.bg-alt {
            background: #f4f8ff;
        }

        .ppl-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 106, 0, .08);
            border: 1px solid rgba(255, 106, 0, .2);
            color: var(--accent);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 14px;
        }

        .ppl-label i {
            font-size: 13px;
        }

        .ppl-heading {
            font-size: clamp(22px, 3.5vw, 30px);
            font-weight: 700;
            margin-bottom: 8px;
        }

        .ppl-sub {
            font-size: 14px;
            color: #888;
            margin-bottom: 40px;
            max-width: 520px;
        }

        .ppl-swiper {
            overflow: hidden;
            padding-bottom: 50px !important;
        }

        .ppl-swiper .swiper-pagination {
            bottom: 0;
        }

        .ppl-swiper .swiper-pagination-bullet {
            background: rgba(60, 64, 73, .3);
            opacity: 1;
        }

        .ppl-swiper .swiper-pagination-bullet-active {
            background: var(--accent);
            width: 20px;
            border-radius: 4px;
        }

        .ppl-nav {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
        }

        .ppl-arrow {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2px solid rgba(0, 0, 0, .1);
            background: #fff;
            color: var(--fg);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .25s;
            font-size: 14px;
        }

        .ppl-arrow:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .ppl-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .07);
            transition: .3s;
            height: 100%;
            position: relative;
        }

        .ppl-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 44px rgba(0, 0, 0, .13);
        }

        .ppl-photo {
            position: relative;
            overflow: hidden;
            height: 260px;
        }

        .ppl-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .45s;
            display: block;
        }

        .ppl-card:hover .ppl-photo img {
            transform: scale(1.07);
        }

        .ppl-hover-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17, 35, 68, .88) 0%, rgba(17, 35, 68, .3) 55%, transparent 100%);
            opacity: 0;
            transition: .3s;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 18px;
        }

        .ppl-card:hover .ppl-hover-overlay {
            opacity: 1;
        }

        .ppl-hover-links {
            display: flex;
            gap: 8px;
            transform: translateY(10px);
            transition: .3s .05s;
        }

        .ppl-card:hover .ppl-hover-links {
            transform: translateY(0);
        }

        .ppl-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, .25);
            color: #fff;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s;
            white-space: nowrap;
        }

        .ppl-link i {
            font-size: 12px;
        }

        .ppl-link:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .ppl-hover-name {
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            opacity: 0;
            transform: translateY(6px);
            transition: .25s;
        }

        .ppl-card:hover .ppl-hover-name {
            opacity: 1;
            transform: translateY(0);
        }

        .ppl-role-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--accent);
            color: #fff;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .8px;
            padding: 3px 9px;
            border-radius: 10px;
            z-index: 2;
        }

        .ppl-body {
            padding: 16px 18px 20px;
        }

        .ppl-body h4 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 3px;
            color: var(--head);
        }

        .ppl-body .ppl-desig {
            font-size: 12px;
            color: var(--accent);
            font-weight: 600;
            display: block;
            margin-bottom: 7px;
        }

        .ppl-body p {
            font-size: 12.5px;
            color: #888;
            line-height: 1.55;
            margin: 0;
        }

        @media(max-width:575px) {
            .ppl-photo {
                height: 210px;
            }
        }


        /* ===== DIGNITARIES ===== */
        .doc-card {
            background: #fff;
            border-radius: 14px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
            transition: .3s;
            height: 100%;
        }

        .doc-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .13);
        }

        .doc-img-wrap {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            position: relative;
        }

        .doc-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .doc-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 106, 0, .8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: .3s;
        }

        .doc-card:hover .doc-overlay {
            opacity: 1;
        }

        .doc-overlay a {
            width: 34px;
            height: 34px;
            background: #fff;
            color: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .doc-card h4 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .doc-card .spec {
            color: var(--accent);
            font-weight: 600;
            font-size: 15px;
            display: block;
            margin-bottom: 12px;
        }

        .doc-card p {
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 14px;
            color: color-mix(in srgb, var(--fg), transparent 20%);
        }

        .doc-card .doc-meta {
            font-size: 12px;
            color: #888;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .doc-card .doc-meta i {
            color: var(--accent);
        }

        .btn-read {
            background: var(--accent);
            color: #fff;
            padding: 10px 26px;
            border-radius: 24px;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
            transition: .3s;
        }

        .btn-read:hover {
            background: color-mix(in srgb, var(--accent), black 12%);
            color: #fff;
            transform: translateY(-2px);
        }


        /* ===== VIDEO ===== */
        .video-sec {
            padding: 70px 0;
            background: #f8f9ff;
        }

        .vid-card {
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, .12);
            cursor: pointer;
            transition: .3s;
            position: relative;
        }

        .vid-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 44px rgba(0, 0, 0, .18);
        }

        .vid-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .vid-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .38);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .3s;
        }

        .vid-card:hover .vid-overlay {
            background: rgba(0, 0, 0, .52);
        }

        .play-btn {
            width: 58px;
            height: 58px;
            background: rgba(255, 106, 0, .9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 10px rgba(255, 106, 0, .2);
            transition: .3s;
        }

        .vid-card:hover .play-btn {
            transform: scale(1.1);
        }

        .play-btn i {
            font-size: 22px;
            color: #fff;
            margin-left: 4px;
        }

        .vid-title {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px 14px;
            background: linear-gradient(to top, rgba(0, 0, 0, .8), transparent);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        .vid-modal-bg {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .9);
            z-index: 99999;
            align-items: center;
            justify-content: center;
        }

        .vid-modal-bg.open {
            display: flex;
        }

        .vid-modal {
            position: relative;
            width: 90vw;
            max-width: 880px;
            aspect-ratio: 16/9;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
        }

        .vid-modal iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .vid-close {
            position: absolute;
            top: -42px;
            right: 0;
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, .15);
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s;
        }

        .vid-close:hover {
            background: var(--accent);
        }


        /* ===== CTA ===== */
        .cta-sec {
            padding: 100px 0 80px;
        }

        .cta-sec h1 {
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 300;
            margin-bottom: 22px;
        }

        .cta-sec .desc {
            font-size: 17px;
            line-height: 1.8;
            color: color-mix(in srgb, var(--fg), transparent 25%);
            margin-bottom: 40px;
        }

        .cta-links {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .cta-link-main {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--accent);
            border-bottom: 1px solid var(--accent);
            padding-bottom: 2px;
            font-weight: 500;
            font-size: 15px;
            width: fit-content;
            transition: .3s;
        }

        .cta-link-main:hover {
            color: color-mix(in srgb, var(--accent), black 18%);
        }

        .cta-link-sub {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: color-mix(in srgb, var(--fg), transparent 40%);
            font-size: 14px;
            width: fit-content;
            transition: .3s;
        }

        .cta-link-sub:hover {
            color: var(--fg);
        }

        .feat-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border: 1px solid rgba(0, 0, 0, .07);
            border-radius: 4px;
            margin-bottom: 80px;
        }

        .feat-blk {
            padding: 44px 30px;
            border-right: 1px solid rgba(0, 0, 0, .07);
        }

        .feat-blk:last-child {
            border: none;
        }

        .feat-blk i {
            font-size: 2.2rem;
            color: var(--accent);
            display: block;
            margin-bottom: 18px;
        }

        .feat-blk h3 {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .feat-blk p {
            font-size: 14px;
            line-height: 1.7;
            color: #777;
            margin: 0;
        }

        .cta-contact {
            background: rgba(255, 106, 0, .05);
            padding: 50px 40px;
            border-radius: 8px;
        }

        .cta-contact h2 {
            font-size: 1.8rem;
            font-weight: 300;
            margin-bottom: 14px;
        }

        .cta-contact p {
            font-size: 15px;
            color: #666;
            margin: 0;
            line-height: 1.7;
        }

        .cta-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
        }

        .cta-phone {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent);
            color: #fff;
            padding: 14px 22px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            transition: .3s;
        }

        .cta-phone:hover {
            background: color-mix(in srgb, var(--accent), black 12%);
            color: #fff;
            transform: translateY(-2px);
        }

        .cta-wa {
            color: #888;
            font-size: 13px;
            transition: .3s;
        }

        .cta-wa:hover {
            color: var(--fg);
        }

        @media(max-width:991px) {
            .feat-row {
                grid-template-columns: 1fr 1fr;
            }

            .feat-blk:nth-child(2) {
                border-right: none;
            }

            .feat-blk:nth-child(3) {
                border-right: 1px solid rgba(0, 0, 0, .07);
            }

            .feat-blk:nth-child(4) {
                border-right: none;
            }

            .feat-blk {
                border-bottom: 1px solid rgba(0, 0, 0, .07);
            }

            .feat-blk:nth-child(3),
            .feat-blk:nth-child(4) {
                border-bottom: none;
            }

            .cta-actions {
                align-items: flex-start;
            }
        }

        @media(max-width:575px) {
            .feat-row {
                grid-template-columns: 1fr;
            }

            .feat-blk {
                border-right: none;
            }

            .feat-blk:last-child {
                border-bottom: none;
            }

            .cta-contact {
                padding: 30px 20px;
            }
        }


        /* ===== TESTIMONIALS ===== */
        .test-sec {
            padding: 70px 0;
            background: #f4f8ff;
        }

        .test-item {
            background: #fff;
            padding: 24px;
            border-radius: 10px;
        }

        .test-stars {
            color: #f7b50d;
            margin-bottom: 14px;
        }

        .test-text {
            font-size: 14px;
            font-style: italic;
            margin: 0 0 18px;
            line-height: 1.7;
        }

        .test-profile {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .test-profile img {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            object-fit: cover;
        }

        .test-profile h4 {
            font-size: 15px;
            font-weight: 700;
            margin: 0 0 2px;
        }

        .test-profile h4 i {
            font-size: 13px;
            color: var(--accent);
        }

        .test-profile span {
            font-size: 12px;
            color: #888;
        }

        .ts-swiper .swiper-pagination {
            margin-top: 28px;
            position: relative;
        }

        .ts-swiper .swiper-pagination-bullet {
            background: rgba(60, 64, 73, .4);
            opacity: 1;
        }

        .ts-swiper .swiper-pagination-bullet-active {
            background: var(--accent);
            width: 18px;
            border-radius: 4px;
        }


        /* ===== PARTNERS / CONTACT ===== */
        .partner-sec {
            padding: 70px 0;
        }

        .ci-item {
            display: flex;
            gap: 18px;
            align-items: flex-start;
            margin-bottom: 26px;
        }

        .ci-icon {
            width: 56px;
            height: 56px;
            background: rgba(255, 106, 0, .1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ci-icon i {
            font-size: 22px;
            color: var(--accent);
        }

        .ci-item h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .ci-item p {
            font-size: 14px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        .contact-form-card {
            background: #fff;
            border-radius: 14px;
            padding: 36px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .06);
        }

        .contact-form-card h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .contact-form-card .sub {
            font-size: 14px;
            color: #888;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .contact-form-card .form-control {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 13px 16px;
            height: auto;
            background: #fff;
            color: var(--fg);
            margin-bottom: 16px;
            font-size: 14px;
        }

        .contact-form-card .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(255, 106, 0, .12);
        }

        .contact-form-card textarea.form-control {
            min-height: 130px;
            resize: vertical;
        }

        .btn-submit {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            transition: .3s;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: color-mix(in srgb, var(--accent), black 12%);
            transform: translateY(-2px);
        }


        /* ===== FOOTER ===== */
        .footer {
            background: #fff;
            border-top: 1px solid rgba(0, 0, 0, .08);
            padding: 80px 0 0;
        }

        .footer .brand-desc {
            font-size: 15px;
            line-height: 1.75;
            color: #888;
            max-width: 340px;
            margin: 16px 0 24px;
        }

        .footer .fc-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 14px;
            font-size: 14px;
            color: #666;
        }

        .footer .fc-item i {
            color: var(--accent);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .footer-nav-wrap {
            padding-left: 40px;
        }

        @media(max-width:991px) {
            .footer-nav-wrap {
                padding-left: 0;
                margin-top: 40px;
            }
        }

        .footer h6 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--head);
        }

        .fn-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .fn-list a {
            font-size: 14px;
            color: #888;
            transition: .3s;
        }

        .fn-list a:hover {
            color: var(--accent);
            padding-left: 4px;
        }

        .footer-social-bar {
            padding: 40px 0;
            border-top: 1px solid rgba(0, 0, 0, .06);
            border-bottom: 1px solid rgba(0, 0, 0, .06);
            margin-top: 60px;
        }

        .footer-social-bar h5 {
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .footer-social-bar p {
            font-size: 14px;
            color: #888;
            margin: 0;
            max-width: 320px;
        }

        .soc-links {
            display: flex;
            gap: 24px;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        @media(max-width:767px) {
            .soc-links {
                justify-content: flex-start;
                margin-top: 24px;
            }
        }

        .soc-link {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #888;
            font-size: 13px;
            transition: .3s;
        }

        .soc-link i {
            font-size: 17px;
        }

        .soc-link:hover {
            color: var(--accent);
            transform: translateY(-2px);
        }

        .footer-bottom {
            padding: 24px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-bottom p {
            font-size: 13px;
            color: #bbb;
            margin: 0;
        }

        .footer-bottom p span {
            color: var(--head);
            font-weight: 500;
        }

        .legal-links {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            align-items: center;
        }

        .legal-links a {
            font-size: 12px;
            color: #bbb;
            transition: .3s;
        }

        .legal-links a:hover {
            color: var(--accent);
        }

        .credits {
            font-size: 11px;
            color: #ccc;
            padding-left: 18px;
            border-left: 1px solid #e0e0e0;
        }


        /* ===== UTILITY ===== */
        .btn-fill {
            background: var(--accent);
            color: #fff;
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: .3s;
            border: 2px solid var(--accent);
            font-size: 15px;
        }

        .btn-fill:hover {
            background: color-mix(in srgb, var(--accent), black 10%);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-ghost {
            color: var(--accent);
            border: 2px solid var(--accent);
            background: transparent;
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: .3s;
            font-size: 15px;
        }

        .btn-ghost:hover {
            background: var(--accent);
            color: #fff;
        }

        @media(max-width:767px) {
            .sec {
                padding: 50px 0;
            }

            .sec-title {
                margin-bottom: 36px;
            }
        }

        /* ===== ONLY ADD THESE ANIMATION RULES TO YOUR EXISTING CSS ===== */

        /* UPDATE: .ann-bar - Add animation */
        .ann-bar {
            /* Keep all existing properties, just ADD these: */
            animation: slideDownAnn 0.4s ease-out;
        }

        .ann-bar.hidden {
            /* Keep all existing properties, just ADD this: */
            animation: slideUpAnn 0.4s ease-out forwards;
        }

        /* ADD NEW KEYFRAME: Announcement Bar Slide Down */
        @keyframes slideDownAnn {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* ADD NEW KEYFRAME: Announcement Bar Slide Up */
        @keyframes slideUpAnn {
            from {
                transform: translateY(0);
                opacity: 1;
            }

            to {
                transform: translateY(-100%);
                opacity: 0;
            }
        }

        /* UPDATE: .ann-bar .cta - Add animation & hover scale */
        .ann-bar .cta {
            /* Keep all existing properties, just ADD these: */
            animation: popIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.2s both;
        }

        .ann-bar .cta:hover {
            /* Change this line: */
            /* FROM: transform: (nothing) */
            /* TO: */
            transform: scale(1.05);
        }

        /* UPDATE: .ann-bar .close-btn:hover - Add rotation */
        .ann-bar .close-btn:hover {
            /* Keep color, just ADD this: */
            transform: rotate(90deg);
        }

        /* ADD NEW KEYFRAME: Pop In Effect */
        @keyframes popIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* ===== HEADER ANIMATIONS ===== */

        /* UPDATE: .site-header - Add animation */
        .site-header {
            /* Keep all existing properties, just ADD this: */
            animation: slideHeaderDown 0.5s ease-out;
        }

        /* ADD NEW KEYFRAME: Header Slide Down */
        @keyframes slideHeaderDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* UPDATE: .site-header .brand .logo - Add animation */
        .site-header .brand .logo {
            /* Keep all existing properties, just ADD this: */
            animation: fadeInLeft 0.6s ease-out 0.1s both;
        }

        /* UPDATE: .site-header .brand .logo img - Add hover effect */
        .site-header .brand .logo img {
            /* Keep all existing, just ADD this: */
            transition: transform 0.3s ease;
        }

        .site-header .brand .logo img:hover {
            /* ADD NEW RULE: */
            transform: scale(1.05);
        }

        /* ADD NEW KEYFRAME: Fade In Left */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* UPDATE: .navmenu ul - Add animation */
        .navmenu ul {
            /* Keep all existing properties, just ADD this: */
            animation: fadeInRight 0.6s ease-out 0.2s both;
        }

        /* ADD NEW KEYFRAME: Fade In Right */
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* UPDATE: .navmenu a::after - Improve transition */
        .navmenu a::after {
            /* Keep all existing, change this line: */
            /* FROM: transition: .3s; */
            /* TO: */
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            /* AND ADD: */
            transform-origin: center;
        }

        /* UPDATE: .navmenu .dropdown - Improve transition */
        .navmenu .dropdown {
            /* Keep all existing, change this line: */
            /* FROM: transition: .25s; */
            /* TO: */
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* UPDATE: .nav-register - Add animation & better hover */
        .nav-register {
            /* Keep all existing properties, just ADD these: */
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
            animation: popIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.3s both;
        }

        .nav-register:hover {
            /* Keep existing, change this line: */
            /* FROM: transform: translateY(-1px); */
            /* TO: */
            transform: translateY(-3px) scale(1.05);
            /* AND ADD: */
            box-shadow: 0 8px 20px rgba(255, 106, 0, 0.3);
        }

        /* UPDATE: .header-right - Add animation */
        .header-right {
            /* Keep all existing properties, just ADD this: */
            animation: fadeInRight 0.6s ease-out 0.3s both;
        }

        /* UPDATE: .header-soc a - Better hover animation */
        .header-soc a {
            /* Change this line: */
            /* FROM: transition: .2s; */
            /* TO: */
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .header-soc a:hover {
            /* Change this line: */
            /* FROM: color: var(--accent); */
            /* TO: */
            color: var(--accent);
            transform: translateY(-3px) scale(1.15);
        }

        /* UPDATE: .mob-toggle - Add hover animation */
        .mob-toggle {
            /* Keep all existing, just ADD this: */
            transition: all 0.3s ease;
        }

        .mob-toggle:hover {
            /* ADD NEW RULE: */
            color: var(--accent);
            transform: scale(1.1);
        }

        /* ===== MOBILE MENU ANIMATIONS ===== */

        /* UPDATE: .nav-wrap - Add fade animation */
        .nav-wrap {
            /* Keep all existing, just ADD this: */
            animation: fadeIn 0.3s ease;
        }

        /* ADD NEW KEYFRAME: Fade In */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* UPDATE: .navmenu (mobile) - Add slide animation */
        .navmenu {
            /* Keep all existing, just ADD this: */
            animation: slideInRight 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* ADD NEW KEYFRAME: Slide In Right */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        /* UPDATE: .navmenu .has-drop.open .dropdown - Add slide animation */
        .navmenu .has-drop.open .dropdown {
            /* Keep all existing, just ADD this: */
            animation: slideDown 0.25s ease-out;
        }

        /* ADD NEW KEYFRAME: Slide Down Menu */
        @keyframes slideDown {
            from {
                max-height: 0;
                opacity: 0;
            }

            to {
                max-height: 500px;
                opacity: 1;
            }
        }

        /* UPDATE: .mob-close - Add hover animation */
        .mob-close {
            /* Keep all existing, just ADD this: */
            transition: all 0.3s ease;
        }

        .mob-close:hover {
            /* ADD NEW RULE: */
            transform: rotate(90deg);
            color: var(--accent);
        }
    </style>
</head>
