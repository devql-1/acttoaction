@extends('frontend.course.layout')
@section('title', 'Courses — Act To Action')

@section('content')
    <style>
        /* ── CLINIC VARIABLES ── */
        :root {
            --default-font: "Roboto", system-ui, sans-serif;
            --heading-font: "Montserrat", sans-serif;
            --nav-font: "Lato", sans-serif;
            --background-color: #ffffff;
            --default-color: #3c4049;
            --heading-color: #112344;
            --accent-color: #175cdd;
            --surface-color: #ffffff;
            --contrast-color: #ffffff;
            --nav-color: #3c4049;
            --nav-hover-color: #175cdd;
            --nav-mobile-background-color: #ffffff;
            scroll-behavior: smooth;
        }

        .light-background {
            --background-color: #f4f8ff;
            --surface-color: #ffffff;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            color: var(--default-color);
            background-color: var(--background-color);
            font-family: var(--default-font);
            margin: 0;
        }

        a {
            color: var(--accent-color);
            text-decoration: none;
            transition: .3s;
        }

        a:hover {
            color: color-mix(in srgb, var(--accent-color), transparent 25%);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--heading-color);
            font-family: var(--heading-font);
        }

        section,
        .section {
            padding: 80px 0;
            overflow: clip;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* ════════════ HEADER ════════════ */
        .header {
            z-index: 997;
            background-color: #ffffff;
            box-shadow: 0 0 18px rgba(0, 0, 0, .08);
            transition: all .5s;
        }

        .header .topbar {
            background-color: var(--accent-color);
            height: 40px;
            padding: 0;
            font-size: 14px;
        }

        .header .topbar .contact-info i {
            font-style: normal;
            color: var(--contrast-color);
        }

        .header .topbar .contact-info i a,
        .header .topbar .contact-info i span {
            padding-left: 5px;
            color: var(--contrast-color);
        }

        .header .topbar .contact-info i a:hover {
            text-decoration: underline;
            color: var(--contrast-color);
        }

        .header .topbar .social-links a {
            color: rgba(255, 255, 255, .6);
            line-height: 0;
            transition: .3s;
            margin-left: 20px;
        }

        .header .topbar .social-links a:hover {
            color: #fff;
        }

        .header .branding {
            min-height: 60px;
            padding: 10px 0;
        }

        .header .logo h1 {
            font-size: 28px;
            margin: 0;
            font-weight: 700;
            color: var(--heading-color);
            letter-spacing: -.5px;
        }

        .header .logo h1 span {
            color: var(--accent-color);
        }

        .scrolled .header .topbar {
            height: 0;
            visibility: hidden;
            overflow: hidden;
        }

        @media(min-width:1200px) {
            .navmenu {
                padding: 0;
            }

            .navmenu ul {
                margin: 0;
                padding: 0;
                display: flex;
                list-style: none;
                align-items: center;
            }

            .navmenu li {
                position: relative;
            }

            .navmenu>ul>li {
                white-space: nowrap;
                padding: 15px 14px;
            }

            .navmenu>ul>li:last-child {
                padding-right: 0;
            }

            .navmenu a,
            .navmenu a:focus {
                color: var(--nav-color);
                font-size: 15px;
                padding: 0 2px;
                font-family: var(--nav-font);
                font-weight: 500;
                display: flex;
                align-items: center;
                transition: .3s;
                position: relative;
            }

            .navmenu>ul>li>a::before {
                content: "";
                position: absolute;
                width: 0;
                height: 2px;
                bottom: -6px;
                left: 0;
                background: var(--accent-color);
                visibility: hidden;
                transition: all .3s;
            }

            .navmenu a:hover::before,
            .navmenu li:hover>a::before,
            .navmenu .active::before {
                visibility: visible;
                width: 100%;
            }

            .navmenu li:hover>a,
            .navmenu .active,
            .navmenu .active:focus {
                color: var(--nav-hover-color);
            }

            .nav-cta {
                background: var(--accent-color);
                color: var(--contrast-color) !important;
                padding: 8px 22px !important;
                border-radius: 50px;
                font-weight: 600 !important;
            }

            .nav-cta:hover {
                background: color-mix(in srgb, var(--accent-color), black 10%) !important;
                color: #fff !important;
            }

            .nav-cta::before {
                display: none !important;
            }
        }

        @media(max-width:1199px) {
            .mobile-nav-toggle {
                color: var(--nav-color);
                font-size: 28px;
                line-height: 0;
                margin-right: 10px;
                cursor: pointer;
                transition: color .3s;
            }

            .navmenu {
                padding: 0;
                z-index: 9997;
            }

            .navmenu ul {
                display: none;
                position: absolute;
                inset: 60px 20px 20px 20px;
                padding: 10px 0;
                margin: 0;
                border-radius: 6px;
                background-color: #ffffff;
                border: 1px solid rgba(60, 64, 73, .1);
                overflow-y: auto;
                z-index: 9998;
                transition: .3s;
            }

            .navmenu a,
            .navmenu a:focus {
                color: var(--nav-color);
                padding: 10px 20px;
                font-family: var(--nav-font);
                font-size: 17px;
                font-weight: 500;
                display: flex;
                align-items: center;
                transition: .3s;
            }

            .navmenu a:hover,
            .navmenu .active {
                color: var(--nav-hover-color);
            }

            .mobile-nav-active {
                overflow: hidden;
            }

            .mobile-nav-active .mobile-nav-toggle {
                color: #fff;
                position: absolute;
                font-size: 32px;
                top: 15px;
                right: 15px;
                margin-right: 0;
                z-index: 9999;
            }

            .mobile-nav-active .navmenu {
                position: fixed;
                overflow: hidden;
                inset: 0;
                background: rgba(33, 37, 41, .8);
            }

            .mobile-nav-active .navmenu>ul {
                display: block;
            }
        }

        /* ════════════ SCROLL TOP ════════════ */
        .scroll-top {
            position: fixed;
            visibility: hidden;
            opacity: 0;
            right: 15px;
            bottom: -15px;
            z-index: 99999;
            background-color: var(--accent-color);
            width: 44px;
            height: 44px;
            border-radius: 50px;
            transition: all .4s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .scroll-top i {
            font-size: 24px;
            color: #fff;
            line-height: 0;
        }

        .scroll-top:hover {
            background-color: color-mix(in srgb, var(--accent-color), transparent 20%);
        }

        .scroll-top.active {
            visibility: visible;
            opacity: 1;
            bottom: 15px;
        }

        /* ════════════ SECTION TITLE ════════════ */
        .section-title {
            text-align: center;
            padding-bottom: 50px;
        }

        .section-title h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 20px;
            position: relative;
        }

        .section-title h2::before {
            content: "";
            position: absolute;
            display: block;
            width: 160px;
            height: 1px;
            background: color-mix(in srgb, var(--default-color), transparent 60%);
            left: 0;
            right: 0;
            bottom: 1px;
            margin: auto;
        }

        .section-title h2::after {
            content: "";
            position: absolute;
            display: block;
            width: 60px;
            height: 3px;
            background: var(--accent-color);
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }

        .section-title p {
            color: color-mix(in srgb, var(--default-color), transparent 22%);
            margin: 0;
        }

        /* ════════════════════════════════════════
         HERO — REAL PHOTO, NO GRADIENT BG
      ════════════════════════════════════════ */
        .course-hero {
            position: relative;
            min-height: 72vh;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
        }

        .course-hero .hero-photo {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .course-hero .hero-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 25%;
            transition: opacity .5s ease;
        }

        /* Overlay — dark bottom only, so real photo shows clearly on top */
        .course-hero .hero-photo::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                    rgba(17, 35, 68, .28) 0%,
                    rgba(17, 35, 68, .55) 60%,
                    rgba(17, 35, 68, .88) 100%);
        }

        .course-hero .hero-text {
            position: relative;
            z-index: 2;
            width: 100%;
            padding: 140px 0 60px;
        }

        .hero-cat-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 20px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 18px;
            backdrop-filter: blur(6px);
            border: 1.5px solid rgba(255, 255, 255, .25);
        }

        .hero-cat-badge.atp {
            background: rgba(23, 92, 221, .7);
        }

        .hero-cat-badge.stp {
            background: rgba(42, 157, 143, .7);
        }

        .course-hero h1 {
            font-size: clamp(2rem, 5vw, 3.6rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.12;
            margin-bottom: 16px;
        }

        .course-hero h1 em {
            font-style: normal;
        }

        .atp-hero h1 em {
            color: #7aaeff;
        }

        .stp-hero h1 em {
            color: #5ee0d2;
        }

        .course-hero .hero-desc {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, .78);
            max-width: 550px;
            line-height: 1.78;
            margin-bottom: 28px;
        }

        .hero-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
        }

        .hero-meta-row .hm {
            display: flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, .12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, .2);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 50px;
        }

        .hero-meta-row .hm i {
            font-size: 13px;
        }

        .atp-hero .hm i {
            color: #7aaeff;
        }

        .stp-hero .hm i {
            color: #5ee0d2;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-enroll {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 15px;
            transition: all .3s;
            color: #fff;
        }

        .atp-hero .btn-enroll {
            background: var(--accent-color);
        }

        .atp-hero .btn-enroll:hover {
            background: color-mix(in srgb, var(--accent-color), black 12%);
            color: #fff;
            transform: translateY(-2px);
        }

        .stp-hero .btn-enroll {
            background: #2a9d8f;
        }

        .stp-hero .btn-enroll:hover {
            background: #238378;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-wa {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 26px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            transition: all .3s;
            background: rgba(255, 255, 255, .12);
            backdrop-filter: blur(6px);
            border: 1.5px solid rgba(255, 255, 255, .3);
            color: #fff;
        }

        .btn-wa:hover {
            background: rgba(255, 255, 255, .22);
            color: #fff;
        }

        /* Breadcrumb inside hero */
        .hero-breadcrumb {
            position: absolute;
            top: 100px;
            left: 0;
            right: 0;
            z-index: 3;
        }

        .hero-breadcrumb .bc-inner {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: rgba(255, 255, 255, .55);
            flex-wrap: wrap;
        }

        .hero-breadcrumb .bc-inner a {
            color: rgba(255, 255, 255, .65);
        }

        .hero-breadcrumb .bc-inner a:hover {
            color: #fff;
        }

        .hero-breadcrumb .bc-inner .sep {
            color: rgba(255, 255, 255, .3);
        }

        .hero-breadcrumb .bc-inner .cur {
            color: #fff;
            font-weight: 600;
        }

        /* ════════════════════════════════════════
         CATEGORY SWITCHER BAR
      ════════════════════════════════════════ */
        .switcher-bar {
            background: #ffffff;
            border-bottom: 1.5px solid color-mix(in srgb, var(--default-color), transparent 90%);
            position: sticky;
            top: 100px;
            z-index: 200;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .06);
        }

        .switcher-bar .sb-inner {
            display: flex;
            align-items: stretch;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .switcher-bar .sb-inner::-webkit-scrollbar {
            display: none;
        }

        .sw-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 32px;
            height: 58px;
            font-family: var(--nav-font);
            font-size: 14px;
            font-weight: 700;
            letter-spacing: .3px;
            cursor: pointer;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            color: color-mix(in srgb, var(--default-color), transparent 45%);
            white-space: nowrap;
            transition: all .3s;
            position: relative;
        }

        .sw-btn:hover {
            color: var(--default-color);
        }

        .sw-btn.active.atp {
            color: var(--accent-color);
            border-bottom-color: var(--accent-color);
        }

        .sw-btn.active.stp {
            color: #2a9d8f;
            border-bottom-color: #2a9d8f;
        }

        .sw-btn .sw-chip {
            font-size: 10px;
            font-weight: 800;
            padding: 2px 9px;
            border-radius: 50px;
            letter-spacing: .5px;
        }

        .sw-btn .sw-chip.a {
            background: color-mix(in srgb, var(--accent-color), transparent 88%);
            color: var(--accent-color);
        }

        .sw-btn .sw-chip.s {
            background: color-mix(in srgb, #2a9d8f, transparent 85%);
            color: #2a9d8f;
        }

        .sw-btn.active .sw-chip.a {
            background: var(--accent-color);
            color: #fff;
        }

        .sw-btn.active .sw-chip.s {
            background: #2a9d8f;
            color: #fff;
        }

        .sw-btn .sw-icon {
            font-size: 16px;
        }

        .sw-back {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 0 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: color-mix(in srgb, var(--default-color), transparent 30%);
            white-space: nowrap;
            transition: all .3s;
            flex-shrink: 0;
        }

        .sw-back:hover {
            color: var(--accent-color);
        }

        /* ════════════════════════════════════════
         COURSE CARDS SECTION
      ════════════════════════════════════════ */
        .courses-section {
            padding: 70px 0 90px;
        }

        /* ── ATP — single featured card ── */
        .atp-feature-card {
            background: var(--surface-color);
            border-radius: 24px;
            overflow: hidden;
            border: 1.5px solid color-mix(in srgb, var(--default-color), transparent 88%);
            box-shadow: 0 8px 40px color-mix(in srgb, var(--default-color), transparent 92%);
            display: flex;
            gap: 0;
            transition: all .4s cubic-bezier(.4, 0, .2, 1);
        }

        .atp-feature-card:hover {
            box-shadow: 0 28px 70px color-mix(in srgb, var(--default-color), transparent 82%);
            border-color: color-mix(in srgb, var(--accent-color), transparent 60%);
            transform: translateY(-4px);
        }

        @media(max-width:768px) {
            .atp-feature-card {
                flex-direction: column;
            }
        }

        .atp-feature-card .fc-img {
            width: 42%;
            flex-shrink: 0;
            position: relative;
            min-height: 380px;
        }

        @media(max-width:768px) {
            .atp-feature-card .fc-img {
                width: 100%;
                min-height: 260px;
            }
        }

        .atp-feature-card .fc-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .5s ease;
        }

        .atp-feature-card:hover .fc-img img {
            transform: scale(1.05);
        }

        .atp-feature-card .fc-img .fc-scrim {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, transparent 60%, rgba(255, 255, 255, .12));
        }

        .atp-feature-card .fc-img .fc-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--accent-color);
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 5px 14px;
            border-radius: 50px;
        }

        .atp-feature-card .fc-body {
            padding: 44px 44px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
        }

        @media(max-width:768px) {
            .atp-feature-card .fc-body {
                padding: 28px 24px 28px;
            }
        }

        .atp-feature-card .fc-tag {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--accent-color);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .atp-feature-card h3 {
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 14px;
            line-height: 1.25;
        }

        .atp-feature-card p {
            font-size: .9rem;
            line-height: 1.75;
            color: color-mix(in srgb, var(--default-color), transparent 18%);
            margin-bottom: 22px;
        }

        /* modules accordion */
        .modules-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 20px;
            transition: gap .3s;
        }

        .modules-btn i {
            transition: transform .3s;
            font-size: 12px;
        }

        .modules-btn.open i {
            transform: rotate(180deg);
        }

        .modules-list {
            display: none;
            background: color-mix(in srgb, var(--default-color), transparent 95%);
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 20px;
            animation: slideDown .2s ease;
        }

        .modules-list.open {
            display: block;
        }

        .modules-list li {
            font-size: 12.5px;
            line-height: 1.65;
            color: color-mix(in srgb, var(--default-color), transparent 15%);
            padding: 4px 0;
            border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 91%);
            display: flex;
            gap: 8px;
        }

        .modules-list li:last-child {
            border: none;
        }

        .modules-list li span {
            font-weight: 800;
            color: var(--accent-color);
            flex-shrink: 0;
            width: 30px;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fc-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 24px;
        }

        .fc-meta-row .fm {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: color-mix(in srgb, var(--default-color), transparent 25%);
        }

        .fc-meta-row .fm i {
            color: var(--accent-color);
            font-size: 13px;
        }

        .fc-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-card-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 12px 26px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            transition: all .3s;
            color: #fff;
        }

        .atp-btn {
            background: var(--accent-color);
        }

        .atp-btn:hover {
            background: color-mix(in srgb, var(--accent-color), black 12%);
            color: #fff;
            transform: translateY(-1px);
        }

        .stp-btn {
            background: #2a9d8f;
        }

        .stp-btn:hover {
            background: #238378;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-card-outline {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 11px 22px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            transition: all .3s;
            border: 1.5px solid;
            color: var(--default-color);
            border-color: color-mix(in srgb, var(--default-color), transparent 72%);
        }

        .btn-card-outline:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        /* ── STP course grid ── */
        .stp-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 28px;
        }

        @media(max-width:768px) {
            .stp-grid {
                grid-template-columns: 1fr;
            }
        }

        .stp-card {
            background: var(--surface-color);
            border-radius: 22px;
            overflow: hidden;
            border: 1.5px solid color-mix(in srgb, var(--default-color), transparent 90%);
            box-shadow: 0 6px 28px color-mix(in srgb, var(--default-color), transparent 93%);
            transition: all .38s cubic-bezier(.4, 0, .2, 1);
            display: flex;
            flex-direction: column;
        }

        .stp-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 28px 66px color-mix(in srgb, var(--default-color), transparent 83%);
            border-color: color-mix(in srgb, #2a9d8f, transparent 58%);
        }

        .stp-card .sc-img {
            position: relative;
            height: 210px;
            overflow: hidden;
        }

        .stp-card .sc-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .45s ease;
            display: block;
        }

        .stp-card:hover .sc-img img {
            transform: scale(1.07);
        }

        .stp-card .sc-img .sc-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17, 35, 68, .65) 0%, transparent 55%);
        }

        .stp-card .sc-img .sc-label {
            position: absolute;
            top: 14px;
            left: 14px;
            background: #2a9d8f;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 4px 12px;
            border-radius: 50px;
        }

        .stp-card .sc-img .sc-duration {
            position: absolute;
            bottom: 14px;
            right: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, .2);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 50px;
        }

        .stp-card .sc-body {
            padding: 24px 26px 28px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sc-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 12px;
        }

        .sc-meta span {
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 38%);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .sc-meta span i {
            color: #2a9d8f;
            font-size: 12px;
        }

        .stp-card h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .stp-card .sc-desc {
            font-size: .875rem;
            line-height: 1.7;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            margin-bottom: 14px;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .sc-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 18px;
        }

        .sc-tags .tag {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 50px;
            background: color-mix(in srgb, #2a9d8f, transparent 88%);
            color: #2a9d8f;
        }

        .stp-card .sc-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            padding-top: 16px;
            margin-top: auto;
        }

        .stp-sessions {
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 35%);
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
        }

        .stp-sessions i {
            color: #2a9d8f;
        }

        /* session expander */
        .sessions-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            color: #2a9d8f;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 14px;
            transition: gap .3s;
        }

        .sessions-btn i {
            transition: transform .3s;
            font-size: 11px;
        }

        .sessions-btn.open i {
            transform: rotate(180deg);
        }

        .sessions-list {
            display: none;
            background: color-mix(in srgb, #2a9d8f, transparent 94%);
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 12px;
            animation: slideDown .2s ease;
        }

        .sessions-list.open {
            display: block;
        }

        .sessions-list li {
            font-size: 12px;
            line-height: 1.6;
            color: color-mix(in srgb, var(--default-color), transparent 15%);
            padding: 3px 0;
            border-bottom: 1px solid color-mix(in srgb, #2a9d8f, transparent 85%);
            display: flex;
            gap: 8px;
        }

        .sessions-list li:last-child {
            border: none;
        }

        .sessions-list li span {
            font-weight: 800;
            color: #2a9d8f;
            flex-shrink: 0;
            width: 24px;
        }

        /* info strip */
        .info-strip {
            border-radius: 16px;
            padding: 26px 28px;
            margin-top: 40px;
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .info-strip.atp-strip {
            background: color-mix(in srgb, var(--accent-color), transparent 93%);
        }

        .info-strip.stp-strip {
            background: color-mix(in srgb, #2a9d8f, transparent 91%);
        }

        .info-strip .is-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .atp-strip .is-icon {
            background: var(--accent-color);
        }

        .stp-strip .is-icon {
            background: #2a9d8f;
        }

        .info-strip .is-icon i {
            color: #fff;
            font-size: 20px;
        }

        .info-strip .is-text {
            flex: 1;
            min-width: 200px;
        }

        .info-strip .is-text strong {
            display: block;
            font-size: .95rem;
            color: var(--heading-color);
            margin-bottom: 3px;
        }

        .info-strip .is-text p {
            font-size: .855rem;
            color: color-mix(in srgb, var(--default-color), transparent 22%);
            margin: 0;
        }

        .is-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            white-space: nowrap;
            transition: all .3s;
        }

        .atp-strip .is-action {
            background: var(--accent-color);
        }

        .atp-strip .is-action:hover {
            background: color-mix(in srgb, var(--accent-color), black 12%);
            color: #fff;
        }

        .stp-strip .is-action {
            background: #2a9d8f;
        }

        .stp-strip .is-action:hover {
            background: #238378;
            color: #fff;
        }

        /* ════════════════════════════════════════
         GALLERY
      ════════════════════════════════════════ */
        .gallery-section {
            padding: 80px 0;
            background: var(--background-color);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: 220px 220px;
            gap: 14px;
        }

        @media(max-width:992px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: repeat(4, 190px);
            }
        }

        @media(max-width:576px) {
            .gallery-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: repeat(4, 150px);
                gap: 10px;
            }
        }

        .g-item {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            cursor: pointer;
        }

        .g-item.span-2 {
            grid-column: span 2;
        }

        .g-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
            display: block;
        }

        .g-item:hover img {
            transform: scale(1.08);
        }

        .g-overlay {
            position: absolute;
            inset: 0;
            background: rgba(17, 35, 68, .5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .35s;
        }

        .g-item:hover .g-overlay {
            opacity: 1;
        }

        .g-overlay i {
            color: #fff;
            font-size: 2.2rem;
        }

        .g-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px 14px;
            background: linear-gradient(to top, rgba(17, 35, 68, .75), transparent);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            transform: translateY(100%);
            transition: transform .35s;
        }

        .g-item:hover .g-caption {
            transform: translateY(0);
        }

        /* ════════════════════════════════════════
         TESTIMONIALS
      ════════════════════════════════════════ */
        .testimonials-section {
            padding: 80px 0;
        }

        .t-card {
            background: var(--surface-color);
            border-radius: 18px;
            padding: 32px;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            box-shadow: 0 6px 24px color-mix(in srgb, var(--default-color), transparent 92%);
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all .32s ease;
        }

        .t-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 52px color-mix(in srgb, var(--default-color), transparent 83%);
        }

        .t-card .stars {
            color: #f7b50d;
            margin-bottom: 14px;
        }

        .t-card .stars i {
            font-size: 15px;
            margin-right: 1px;
        }

        .t-card .quote-mark {
            font-size: 3rem;
            color: var(--accent-color);
            line-height: .6;
            font-family: Georgia, serif;
            margin-bottom: 12px;
            display: block;
        }

        .stp-test .quote-mark {
            color: #2a9d8f;
        }

        .t-card blockquote {
            font-size: .9rem;
            line-height: 1.76;
            color: color-mix(in srgb, var(--default-color), transparent 12%);
            font-style: italic;
            margin: 0 0 20px;
            flex: 1;
        }

        .t-author {
            display: flex;
            align-items: center;
            gap: 12px;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            padding-top: 16px;
            margin-top: auto;
        }

        .t-av {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            flex-shrink: 0;
        }

        .atp-av {
            background: color-mix(in srgb, var(--accent-color), transparent 85%);
            color: var(--accent-color);
        }

        .stp-av {
            background: color-mix(in srgb, #2a9d8f, transparent 83%);
            color: #2a9d8f;
        }

        .t-av img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .t-info .t-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--heading-color);
            display: block;
        }

        .t-info .t-role {
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
        }

        /* ════════════════════════════════════════
         CTA BAND — REAL IMAGE
      ════════════════════════════════════════ */
        .cta-band {
            position: relative;
            overflow: hidden;
        }

        .cta-band .cta-photo {
            position: absolute;
            inset: 0;
        }

        .cta-band .cta-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cta-band .cta-photo::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(17, 35, 68, .92) 0%, rgba(23, 92, 221, .78) 100%);
        }

        .cta-band .cta-inner {
            position: relative;
            z-index: 1;
            padding: 90px 0;
            text-align: center;
        }

        .cta-band h2 {
            font-size: clamp(1.6rem, 3.5vw, 2.6rem);
            font-weight: 700;
            color: #fff;
            margin-bottom: 12px;
        }

        .cta-band p {
            color: rgba(255, 255, 255, .72);
            font-size: 1.05rem;
            margin-bottom: 30px;
        }

        .cta-btns {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-cta-solid {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-color);
            color: #fff;
            padding: 13px 32px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 15px;
            transition: all .3s;
        }

        .btn-cta-solid:hover {
            background: color-mix(in srgb, var(--accent-color), black 12%);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-cta-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .12);
            border: 1.5px solid rgba(255, 255, 255, .32);
            color: #fff;
            padding: 13px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            backdrop-filter: blur(6px);
            transition: all .3s;
        }

        .btn-cta-ghost:hover {
            background: rgba(255, 255, 255, .22);
            color: #fff;
        }

        /* ════════════════════════════════════════
         FOOTER-16
      ════════════════════════════════════════ */
        .footer-16 {
            background: var(--background-color);
            font-size: 15px;
            padding: 100px 0 0;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 92%);
        }

        .footer-16 .footer-main {
            margin-bottom: 80px;
        }

        .footer-16 .brand-section .logo .sitename {
            font-family: var(--heading-font);
            font-size: 26px;
            font-weight: 300;
            color: var(--heading-color);
        }

        .footer-16 .brand-section .logo .sitename strong {
            color: var(--accent-color);
            font-weight: 700;
        }

        .footer-16 .brand-section .brand-description {
            font-size: 15px;
            line-height: 1.7;
            color: color-mix(in srgb, var(--default-color), transparent 25%);
            font-weight: 300;
            max-width: 340px;
            margin: 14px 0 0;
        }

        .footer-16 .contact-info {
            margin-top: 20px;
        }

        .footer-16 .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            font-size: 14px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
        }

        .footer-16 .contact-item i {
            font-size: 14px;
            color: var(--accent-color);
            margin-right: 10px;
            margin-top: 3px;
            flex-shrink: 0;
        }

        .footer-16 .footer-nav-wrapper {
            padding-left: 60px;
        }

        @media(max-width:991px) {
            .footer-16 .footer-nav-wrapper {
                padding-left: 0;
                margin-top: 50px;
            }
        }

        .footer-16 .nav-column {
            margin-bottom: 40px;
        }

        .footer-16 .nav-column h6 {
            font-family: var(--heading-font);
            font-size: 14px;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 18px;
        }

        .footer-16 .footer-nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-16 .footer-nav a {
            color: color-mix(in srgb, var(--default-color), transparent 30%);
            font-size: 14px;
            font-weight: 300;
            transition: all .3s;
        }

        .footer-16 .footer-nav a:hover {
            color: var(--accent-color);
            transform: translateX(4px);
        }

        .footer-16 .footer-social {
            padding: 40px 0;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 93%);
            border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 93%);
        }

        .footer-16 .social-links {
            display: flex;
            gap: 28px;
            align-items: center;
            flex-wrap: wrap;
        }

        .footer-16 .social-links .social-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
            font-size: 13px;
            transition: all .3s;
        }

        .footer-16 .social-links .social-link i {
            font-size: 18px;
        }

        .footer-16 .social-links .social-link:hover {
            color: var(--accent-color);
            transform: translateY(-2px);
        }

        .footer-16 .footer-bottom {
            padding: 24px 0;
        }

        .footer-16 .footer-bottom .copyright p {
            margin: 0;
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 45%);
            font-weight: 300;
        }

        .footer-16 .footer-bottom .legal-links {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 20px;
            flex-wrap: wrap;
        }

        @media(max-width:991px) {
            .footer-16 .footer-bottom .legal-links {
                justify-content: flex-start;
                margin-top: 14px;
            }
        }

        .footer-16 .footer-bottom .legal-links a {
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 50%);
            font-weight: 300;
            transition: color .3s;
        }

        .footer-16 .footer-bottom .legal-links a:hover {
            color: var(--accent-color);
        }

        @media(max-width:768px) {
            .footer-16 {
                padding: 60px 0 0;
            }
        }

        /* ════════ ANIMATIONS ════════ */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(28px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reveal {
            opacity: 0;
        }
    </style>
    {{-- ═══ HERO ═══ --}}
    <section class="course-hero" id="courseHero">
        <div class="hero-breadcrumb">
            <div class="container">
                <div class="bc-inner">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="sep">/</span>
                    <span class="cur">Courses</span>
                </div>
            </div>
        </div>
        <div class="hero-photo">
            @php $firstCourse = $allCourses->first(); @endphp
            <img id="heroImg"
                src="{{ $firstCourse && $firstCourse->banner_image ? asset('img/courses/' . $firstCourse->banner_image) : asset('img/default-course-banner.jpg') }}"
                alt="Courses Hero" />
        </div>
        <div class="container hero-text" id="heroText">
            <div class="ht-tag"><i class="bi bi-mortarboard-fill"></i> Our Programs</div>
            <h1>Find Your <span class="ht-accent">Perfect Course</span></h1>
            <p class="ht-sub">India's first screen acting school for children — drama, filmmaking, public speaking &amp;
                more.</p>
            <div class="ht-meta">
                <span><i class="bi bi-journal-text"></i> {{ $allCourses->count() }} Courses</span>
                <span><i class="bi bi-grid"></i> {{ $categories->count() }} Categories</span>
            </div>
        </div>
    </section>

    {{-- ═══ CATEGORY SWITCHER ═══ --}}
    <div class="switcher-bar">
        <div class="container">
            <div class="sb-inner">
                @foreach ($categories as $index => $cat)
                    <button class="sw-btn {{ $index === 0 ? 'active' : '' }}" id="swBtn{{ $cat->id }}"
                        onclick="switchTo('cat{{ $cat->id }}')">
                        <i class="bi bi-mortarboard-fill sw-icon"></i>
                        {{ $cat->name }}
                        @if ($cat->courses->count())
                            <span class="sw-chip">
                                {{ $cat->courses->count() }} Course{{ $cat->courses->count() > 1 ? 's' : '' }}
                            </span>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ═══ COURSES SECTION ═══ --}}
    <section class="courses-section">
        <div class="container">

            @foreach ($categories as $index => $cat)
                <div id="blockCat{{ $cat->id }}" style="{{ $index === 0 ? '' : 'display:none;' }}">

                    @if ($cat->courses->count() === 1)
                        {{-- ── SINGLE COURSE → ATP feature-card layout ─────────── --}}
                        @php $course = $cat->courses->first(); @endphp

                        <div class="atp-feature-card reveal">
                            <div class="fc-img">
                                <img src="{{ $course->banner_image ? asset('img/courses/' . $course->banner_image) : asset('img/default-course-banner.jpg') }}"
                                    alt="{{ $course->title }}" />
                                <div class="fc-scrim"></div>
                                <span class="fc-badge">{{ $cat->name }}</span>
                            </div>
                            <div class="fc-body">
                                <div class="fc-tag">
                                    <i class="bi bi-mortarboard-fill"></i> {{ $cat->name }}
                                </div>

                                <h3>
                                    {{ $course->title }}
                                    @if ($course->age_group)
                                        <br><small style="font-weight:400;font-size:1rem;">Ages
                                            {{ $course->age_group }}</small>
                                    @endif
                                </h3>

                                <p>{{ $course->description }}</p>

                                <div class="fc-meta-row">
                                    @if ($course->duration)
                                        <span class="fm"><i class="bi bi-clock"></i> {{ $course->duration }}</span>
                                    @endif
                                    @if ($course->sessions)
                                        <span class="fm"><i class="bi bi-collection-play"></i> {{ $course->sessions }}
                                            Sessions</span>
                                    @endif
                                    @if ($course->age_group)
                                        <span class="fm"><i class="bi bi-people"></i> Age
                                            {{ $course->age_group }}</span>
                                    @endif
                                    @if ($course->mode)
                                        <span class="fm"><i class="bi bi-camera-video"></i> {{ $course->mode }}</span>
                                    @endif
                                    @if ($course->fees)
                                        <span class="fm"><i class="bi bi-currency-rupee"></i>
                                            {{ $course->fees }}</span>
                                    @endif
                                </div>

                                {{-- Sessions list (modules) --}}
                                @if ($course->sessions()->count())
                                    <button class="modules-btn" onclick="toggleList(this,'modList{{ $course->id }}')">
                                        <i class="bi bi-chevron-down"></i>
                                        View all {{ $course->sessions()->count() }} Sessions
                                    </button>
                                    <ul class="modules-list" id="modList{{ $course->id }}">
                                        @foreach ($course->sessions as $sess)
                                            <li>
                                                <span>{{ $loop->iteration }}</span>
                                                {{ $sess->title }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                {{-- Documents / PDFs --}}
                                <div class="fc-actions">
                                    <a href="{{ route('enrollment.enroll', $course->id) }}"
                                        class="btn-card-primary atp-btn">
                                        <i class="bi bi-person-plus-fill"></i> Enroll Now
                                    </a>
                                    @if ($course->highlights_link)
                                        <a href="{{ $course->highlights_link }}" target="_blank" class="btn-card-outline">
                                            <i class="bi bi-play-circle"></i> Watch Highlights
                                        </a>
                                    @endif
                                    @foreach ($course->documents as $doc)
                                        <a href="{{ asset('docs/' . $doc->file) }}" target="_blank"
                                            class="btn-card-outline">
                                            <i class="bi bi-download"></i> {{ $doc->title ?? 'Syllabus PDF' }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="info-strip atp-strip reveal">
                            <div class="is-icon"><i class="bi bi-info-circle-fill"></i></div>
                            <div class="is-text">
                                <strong>New batches starting every quarter</strong>
                                <p>Limited seats per batch. Enroll early to secure your child's spot.</p>
                            </div>
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="is-action"><i
                                    class="bi bi-whatsapp"></i> Check Seats</a>
                        </div>
                    @else
                        {{-- ── MULTIPLE COURSES → STP grid-card layout ─────────── --}}

                        <div class="stp-grid">
                            @foreach ($cat->courses as $course)
                                <div class="stp-card reveal">
                                    <div class="sc-img">
                                        <img src="{{ $course->banner_image ? asset('img/courses/' . $course->banner_image) : asset('img/default-course-banner.jpg') }}"
                                            alt="{{ $course->title }}" />
                                        <div class="sc-overlay"></div>
                                        <span class="sc-label">{{ $cat->name }}</span>
                                        @if ($course->duration && $course->sessions)
                                            <div class="sc-duration">
                                                <i class="bi bi-clock"></i>
                                                {{ $course->duration }} · {{ $course->sessions }} Sessions
                                            </div>
                                        @endif
                                    </div>
                                    <div class="sc-body">
                                        <div class="sc-meta">
                                            @if ($course->age_group)
                                                <span><i class="bi bi-people"></i> Age {{ $course->age_group }}</span>
                                            @endif
                                            @if ($course->mode)
                                                <span><i class="bi bi-camera-video"></i> {{ $course->mode }}</span>
                                            @endif
                                            @if ($course->fees)
                                                <span><i class="bi bi-currency-rupee"></i> {{ $course->fees }}</span>
                                            @endif
                                        </div>

                                        <h4>{{ $course->title }}</h4>

                                        <p class="sc-desc">
                                            {{ Str::limit($course->description, 200) }}
                                        </p>

                                        {{-- Sessions list --}}
                                        @if ($course->sessions()->count())
                                            <button class="sessions-btn"
                                                onclick="toggleList(this,'sess{{ $course->id }}')">
                                                <i class="bi bi-chevron-down"></i>
                                                View {{ $course->sessions()->count() }} Sessions
                                            </button>
                                            <ul class="sessions-list" id="sess{{ $course->id }}">
                                                @foreach ($course->sessions as $sess)
                                                    <li>
                                                        <span>S{{ $loop->iteration }}</span>
                                                        {{ $sess->title }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        <div class="sc-footer">
                                            <div class="stp-sessions">
                                                <i class="bi bi-collection-play"></i>
                                                {{ $course->sessions()->count() ?: $course->sessions ?? 0 }} Sessions
                                            </div>
                                            <a href="{{ route('enrollment.enroll', $course->id) }}"
                                                class="btn-card-primary stp-btn">
                                                <i class="bi bi-person-plus-fill"></i> Enroll
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>{{-- /stp-grid --}}

                        <div class="info-strip stp-strip reveal">
                            <div class="is-icon"><i class="bi bi-lightbulb-fill"></i></div>
                            <div class="is-text">
                                <strong>Can't decide which course to pick?</strong>
                                <p>All {{ $cat->courses->count() }} courses run independently — enroll in one or many!</p>
                            </div>
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="is-action"><i
                                    class="bi bi-whatsapp"></i> Ask Counsellor</a>
                        </div>
                    @endif

                </div>{{-- /block --}}
            @endforeach

        </div>
    </section>

    {{-- ═══ CTA BAND ═══ --}}
    <div class="cta-band">
        <div class="cta-photo">
            <img src="{{ asset('img/cta-band.jpg') }}" alt="Enroll Now" />
        </div>
        <div class="container cta-inner">
            <h2>Ready to Start the Journey?</h2>
            <p>Join 1000+ students already performing, growing and shining across Jaipur.</p>
            <div class="cta-btns">
                <a href="#" class="btn-cta-solid">
                    <i class="bi bi-person-plus-fill"></i> Enroll Now
                </a>
                <a href="https://wa.me/message/PE3X4SUC2OJTB1" class="btn-cta-ghost" target="_blank">
                    <i class="bi bi-whatsapp"></i> WhatsApp Us
                </a>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // ── Category switcher ─────────────────────────────────────────────────────
        const allBlocks = document.querySelectorAll('[id^="blockCat"]');
        const allSwBtns = document.querySelectorAll('.sw-btn');

        function switchTo(catKey) {
            // hide all blocks
            allBlocks.forEach(b => b.style.display = 'none');
            allSwBtns.forEach(b => b.classList.remove('active'));

            // show selected block
            const block = document.getElementById('block' + catKey.charAt(0).toUpperCase() + catKey.slice(1));
            if (block) block.style.display = '';

            // mark active button
            const btn = document.querySelector(`[onclick="switchTo('${catKey}')"]`);
            if (btn) btn.classList.add('active');

            // update hero image to first course banner in that category
            const img = block?.querySelector('.fc-img img, .sc-img img');
            if (img) document.getElementById('heroImg').src = img.src;
        }

        // ── Toggle session / module list ──────────────────────────────────────────
        function toggleList(btn, id) {
            const list = document.getElementById(id);
            const open = list.classList.toggle('open');
            btn.querySelector('i').className = open ? 'bi bi-chevron-up' : 'bi bi-chevron-down';
        }

        // ── Scroll reveal ─────────────────────────────────────────────────────────
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('revealed');
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.08
        });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
    </script>
@endpush
