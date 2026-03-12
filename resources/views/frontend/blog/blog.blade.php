@extends('frontend.course.layout')
@section('content')
    <style>
        /* ===== CLINIC CSS VARIABLES ===== */

        a {
            color: var(--accent-color);
            text-decoration: none;
            transition: .3s;
        }

        a:hover {
            color: color-mix(in srgb, var(--accent-color), transparent 25%);
            text-decoration: none;
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

        /* ===== HEADER ===== */
        .header {
            --background-color: rgba(255, 255, 255, 0);
            color: var(--default-color);
            transition: all .5s;
            z-index: 997;
            background-color: var(--background-color);
            box-shadow: 0 0 18px rgba(0, 0, 0, .1);
        }

        .header .topbar {
            background-color: var(--accent-color);
            height: 40px;
            padding: 0;
            font-size: 14px;
            transition: all .5s;
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

        .header .topbar .contact-info i a {
            line-height: 0;
            transition: .3s;
        }

        .header .topbar .contact-info i a:hover {
            color: var(--contrast-color);
            text-decoration: underline;
        }

        .header .topbar .social-links a {
            color: color-mix(in srgb, var(--contrast-color), transparent 40%);
            line-height: 0;
            transition: .3s;
            margin-left: 20px;
        }

        .header .topbar .social-links a:hover {
            color: var(--contrast-color);
        }

        .header .branding {
            min-height: 60px;
            padding: 10px 0;
        }

        .header .logo {
            line-height: 1;
        }

        .header .logo h1 {
            font-size: 28px;
            margin: 0;
            font-weight: 700;
            color: var(--heading-color);
            letter-spacing: -0.5px;
        }

        .header .logo h1 span {
            color: var(--accent-color);
        }

        .scrolled .header .topbar {
            height: 0;
            visibility: hidden;
            overflow: hidden;
        }

        .scrolled .header {
            --background-color: #ffffff;
        }

        /* ===== NAVMENU ===== */
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
                justify-content: space-between;
                white-space: nowrap;
                transition: .3s;
                position: relative;
            }

            .navmenu>ul>li>a:before {
                content: "";
                position: absolute;
                width: 100%;
                height: 2px;
                bottom: -6px;
                left: 0;
                background-color: var(--accent-color);
                visibility: hidden;
                width: 0;
                transition: all .3s ease-in-out 0s;
            }

            .navmenu a:hover:before,
            .navmenu li:hover>a:before,
            .navmenu .active:before {
                visibility: visible;
                width: 100%;
            }

            .navmenu li:hover>a,
            .navmenu .active,
            .navmenu .active:focus {
                color: var(--nav-hover-color);
            }

            .nav-cta-btn {
                background: var(--accent-color);
                color: var(--contrast-color) !important;
                padding: 8px 20px !important;
                border-radius: 50px;
                font-weight: 600 !important;
                transition: all .3s ease !important;
            }

            .nav-cta-btn:hover {
                background: color-mix(in srgb, var(--accent-color), black 10%) !important;
                transform: translateY(-1px);
            }

            .nav-cta-btn::before {
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
                list-style: none;
                position: absolute;
                inset: 60px 20px 20px 20px;
                padding: 10px 0;
                margin: 0;
                border-radius: 6px;
                background-color: var(--nav-mobile-background-color);
                border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
                overflow-y: auto;
                transition: .3s;
                z-index: 9998;
            }

            .navmenu a,
            .navmenu a:focus {
                color: var(--nav-dropdown-color);
                padding: 10px 20px;
                font-family: var(--nav-font);
                font-size: 17px;
                font-weight: 500;
                display: flex;
                align-items: center;
                justify-content: space-between;
                white-space: nowrap;
                transition: .3s;
            }

            .navmenu a:hover,
            .navmenu .active,
            .navmenu .active:focus {
                color: var(--nav-dropdown-hover-color);
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
                transition: .3s;
            }

            .mobile-nav-active .navmenu>ul {
                display: block;
            }
        }

        /* ===== SECTIONS ===== */
        section,
        .section {
            color: var(--default-color);
            background-color: var(--background-color);
            padding: 60px 0;
            scroll-margin-top: 90px;
            overflow: clip;
        }

        .section-title {
            text-align: center;
            padding-bottom: 60px;
            position: relative;
        }

        .section-title h2 {
            font-size: 32px;
            font-weight: 500;
            margin-bottom: 20px;
            padding-bottom: 20px;
            position: relative;
        }

        .section-title h2:before {
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
            margin-bottom: 0;
        }

        /* ===== SCROLL TOP ===== */
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
            color: var(--contrast-color);
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

        /* ===== BLOG HERO ===== */
        .blog-hero {
            background: linear-gradient(135deg, var(--heading-color) 0%, color-mix(in srgb, var(--accent-color), #112344 40%) 100%);
            padding: 80px 0 0;
            position: relative;
            overflow: hidden;
        }

        .blog-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1503095396549-807759245b35?w=1400&q=20') center/cover;
            opacity: 0.08;
        }

        .blog-hero .hero-inner {
            position: relative;
            z-index: 1;
            padding-bottom: 50px;
        }

        .blog-hero .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: color-mix(in srgb, var(--accent-color), transparent 75%);
            border: 1px solid color-mix(in srgb, var(--accent-color), transparent 50%);
            color: #a8c4ff;
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .blog-hero h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 16px;
        }

        .blog-hero h1 em {
            color: #a8c4ff;
            font-style: normal;
        }

        .blog-hero p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, .72);
            max-width: 520px;
            line-height: 1.7;
        }

        .blog-hero .hero-stats {
            display: flex;
            gap: 32px;
            margin-top: 32px;
            flex-wrap: wrap;
        }

        .blog-hero .hero-stats .hs {
            text-align: center;
        }

        .blog-hero .hero-stats .hs .num {
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            display: block;
            line-height: 1;
        }

        .blog-hero .hero-stats .hs .lbl {
            font-size: 12px;
            color: rgba(255, 255, 255, .55);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-top: 4px;
            display: block;
        }

        /* Category Filter Tabs */
        .blog-hero .category-bar {
            background: rgba(255, 255, 255, .07);
            border-top: 1px solid rgba(255, 255, 255, .1);
            backdrop-filter: blur(10px);
            margin-top: 40px;
        }

        .blog-hero .category-bar .cat-tabs {
            display: flex;
            gap: 0;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .blog-hero .category-bar .cat-tabs::-webkit-scrollbar {
            display: none;
        }

        .blog-hero .category-bar .cat-tab {
            padding: 16px 24px;
            font-size: 14px;
            font-weight: 500;
            font-family: var(--nav-font);
            color: rgba(255, 255, 255, .6);
            border: none;
            background: transparent;
            cursor: pointer;
            white-space: nowrap;
            position: relative;
            transition: all .3s;
            border-bottom: 3px solid transparent;
        }

        .blog-hero .category-bar .cat-tab:hover {
            color: rgba(255, 255, 255, .9);
        }

        .blog-hero .category-bar .cat-tab.active {
            color: #fff;
            border-bottom-color: var(--accent-color);
        }

        .blog-hero .category-bar .cat-tab .cat-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--accent-color), transparent 70%);
            font-size: 11px;
            margin-left: 6px;
        }

        .blog-hero .category-bar .cat-tab.active .cat-count {
            background: var(--accent-color);
        }

        /* ===== FEATURED POST ===== */
        .featured-post-section {
            background: var(--background-color);
            padding: 60px 0 40px;
        }

        .featured-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 4px;
            margin-bottom: 24px;
        }

        .featured-card {
            background: var(--surface-color);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px color-mix(in srgb, var(--default-color), transparent 88%);
            transition: transform .4s ease, box-shadow .4s ease;
        }

        .featured-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 30px 80px color-mix(in srgb, var(--default-color), transparent 82%);
        }

        .featured-card .fc-img {
            position: relative;
            height: 420px;
            overflow: hidden;
        }

        @media(max-width:768px) {
            .featured-card .fc-img {
                height: 260px;
            }
        }

        .featured-card .fc-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .featured-card:hover .fc-img img {
            transform: scale(1.04);
        }

        .featured-card .fc-img .fc-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17, 35, 68, .8) 0%, transparent 60%);
        }

        .featured-card .fc-img .fc-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--accent-color);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 50px;
        }

        .featured-card .fc-body {
            padding: 36px 40px 40px;
        }

        @media(max-width:768px) {
            .featured-card .fc-body {
                padding: 24px;
            }
        }

        .featured-card .fc-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .featured-card .fc-meta .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 35%);
        }

        .featured-card .fc-meta .meta-item i {
            color: var(--accent-color);
            font-size: 13px;
        }

        .featured-card h2 {
            font-size: clamp(1.3rem, 2.5vw, 1.9rem);
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 14px;
            line-height: 1.3;
        }

        .featured-card p {
            font-size: 1rem;
            line-height: 1.7;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            margin-bottom: 24px;
        }

        .featured-card .fc-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .featured-card .fc-author .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--accent-color), transparent 85%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--accent-color);
            font-size: 14px;
            flex-shrink: 0;
        }

        .featured-card .fc-author .au-info .au-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--heading-color);
            display: block;
        }

        .featured-card .fc-author .au-info .au-role {
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 45%);
        }

        .btn-read-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-color);
            color: var(--contrast-color);
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            transition: all .3s ease;
            text-decoration: none;
        }

        .btn-read-more:hover {
            background: color-mix(in srgb, var(--accent-color), black 10%);
            color: var(--contrast-color);
            transform: translateY(-2px);
            gap: 12px;
        }

        .btn-read-more i {
            font-size: 12px;
            transition: transform .3s;
        }

        .btn-read-more:hover i {
            transform: translateX(3px);
        }

        /* ===== BLOG GRID ===== */
        .blog-grid-section {
            background: var(--background-color);
            padding: 40px 0 80px;
        }

        .blog-card-wrap {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        @media(max-width:992px) {
            .blog-card-wrap {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:576px) {
            .blog-card-wrap {
                grid-template-columns: 1fr;
            }
        }

        .bc {
            background: var(--surface-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px color-mix(in srgb, var(--default-color), transparent 93%);
            transition: all .35s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 93%);
        }

        .bc:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px color-mix(in srgb, var(--default-color), transparent 85%);
            border-color: color-mix(in srgb, var(--accent-color), transparent 80%);
        }

        .bc .bc-img {
            position: relative;
            height: 210px;
            overflow: hidden;
        }

        .bc .bc-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }

        .bc:hover .bc-img img {
            transform: scale(1.07);
        }

        .bc .bc-img .bc-cat {
            position: absolute;
            top: 14px;
            left: 14px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 50px;
            background: var(--accent-color);
            color: #fff;
        }

        .bc .bc-cat.cat-media {
            background: #e63946;
        }

        .bc .bc-cat.cat-casting {
            background: #f4a261;
        }

        .bc .bc-cat.cat-workshop {
            background: #2a9d8f;
        }

        .bc .bc-cat.cat-dramata {
            background: #7209b7;
        }

        .bc .bc-cat.cat-story {
            background: #175cdd;
        }

        .bc .bc-body {
            padding: 22px 24px 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .bc .bc-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .bc .bc-meta span {
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .bc .bc-meta span i {
            color: var(--accent-color);
            font-size: 11px;
        }

        .bc h3 {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--heading-color);
            margin-bottom: 10px;
            line-height: 1.45;
            flex: 1;
        }

        .bc p {
            font-size: .875rem;
            line-height: 1.65;
            color: color-mix(in srgb, var(--default-color), transparent 25%);
            margin-bottom: 18px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .bc .bc-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            padding-top: 14px;
            margin-top: auto;
        }

        .bc .bc-author {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bc .bc-author .av {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--accent-color), transparent 85%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--accent-color);
            flex-shrink: 0;
        }

        .bc .bc-author span {
            font-size: 12px;
            font-weight: 500;
            color: var(--heading-color);
        }

        .bc .bc-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--accent-color);
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap .3s;
        }

        .bc .bc-link:hover {
            gap: 8px;
            color: color-mix(in srgb, var(--accent-color), black 10%);
        }

        /* ===== BLOG SIDEBAR ===== */
        .blog-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 40px;
            align-items: start;
        }

        @media(max-width:1100px) {
            .blog-layout {
                grid-template-columns: 1fr;
            }
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .sidebar-card {
            background: var(--surface-color);
            border-radius: 16px;
            padding: 28px;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
        }

        .sidebar-card h5 {
            font-size: 16px;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid color-mix(in srgb, var(--accent-color), transparent 80%);
            position: relative;
        }

        .sidebar-card h5::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--accent-color);
        }

        /* Category list */
        .cat-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .cat-list li a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            border-radius: 8px;
            color: var(--default-color);
            font-size: 14px;
            font-weight: 500;
            transition: all .3s;
            background: color-mix(in srgb, var(--default-color), transparent 96%);
        }

        .cat-list li a:hover,
        .cat-list li a.active {
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
        }

        .cat-list li a .badge {
            background: var(--accent-color);
            color: #fff;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 50px;
            font-weight: 600;
        }

        /* Recent posts */
        .recent-post {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
        }

        .recent-post:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .recent-post img {
            width: 64px;
            height: 52px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .recent-post .rp-info h6 {
            font-size: 13px;
            font-weight: 600;
            color: var(--heading-color);
            margin: 0 0 4px;
            line-height: 1.4;
        }

        .recent-post .rp-info span {
            font-size: 11px;
            color: color-mix(in srgb, var(--default-color), transparent 45%);
        }

        .recent-post:hover h6 {
            color: var(--accent-color);
        }

        /* Tags */
        .tag-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag-cloud a {
            font-size: 12px;
            padding: 5px 13px;
            border-radius: 50px;
            background: color-mix(in srgb, var(--default-color), transparent 93%);
            color: var(--default-color);
            font-weight: 500;
            transition: all .3s;
        }

        .tag-cloud a:hover {
            background: var(--accent-color);
            color: #fff;
        }

        /* Newsletter sidebar */
        .sidebar-newsletter {
            background: linear-gradient(135deg, var(--heading-color), color-mix(in srgb, var(--accent-color), #112344 30%));
            border-radius: 16px;
            padding: 28px;
            color: #fff;
        }

        .sidebar-newsletter h5 {
            color: #fff;
            border-bottom-color: rgba(255, 255, 255, .2);
        }

        .sidebar-newsletter h5::after {
            background: #a8c4ff;
        }

        .sidebar-newsletter p {
            font-size: 13px;
            color: rgba(255, 255, 255, .7);
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .sidebar-newsletter .ns-input {
            width: 100%;
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 8px;
            padding: 10px 14px;
            color: #fff;
            font-size: 13px;
            margin-bottom: 10px;
            outline: none;
        }

        .sidebar-newsletter .ns-input::placeholder {
            color: rgba(255, 255, 255, .45);
        }

        .sidebar-newsletter .ns-input:focus {
            border-color: rgba(255, 255, 255, .5);
        }

        .sidebar-newsletter .ns-btn {
            width: 100%;
            background: var(--accent-color);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all .3s;
        }

        .sidebar-newsletter .ns-btn:hover {
            background: color-mix(in srgb, var(--accent-color), black 10%);
        }

        /* ===== LOAD MORE ===== */
        .load-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            background: transparent;
            cursor: pointer;
            transition: all .3s;
        }

        .load-more-btn:hover {
            background: var(--accent-color);
            color: #fff;
            transform: translateY(-2px);
        }

        /* ===== NEWSLETTER SECTION ===== */
        .newsletter-cta {
            background: linear-gradient(135deg, var(--heading-color) 0%, color-mix(in srgb, var(--accent-color), #112344 40%) 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .newsletter-cta::before {
            content: "";
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1598899134739-24c46f58b8c0?w=1200&q=15') center/cover;
            opacity: 0.05;
        }

        .newsletter-cta .inner {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .newsletter-cta h2 {
            color: #fff;
            font-size: clamp(1.5rem, 3vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 12px;
        }

        .newsletter-cta p {
            color: rgba(255, 255, 255, .7);
            font-size: 1.05rem;
            margin-bottom: 32px;
        }

        .newsletter-cta .nl-form {
            display: flex;
            gap: 12px;
            max-width: 520px;
            margin: 0 auto;
            flex-wrap: wrap;
            justify-content: center;
        }

        .newsletter-cta .nl-form input {
            flex: 1;
            min-width: 220px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 50px;
            padding: 14px 22px;
            color: #fff;
            font-size: 15px;
            outline: none;
        }

        .newsletter-cta .nl-form input::placeholder {
            color: rgba(255, 255, 255, .5);
        }

        .newsletter-cta .nl-form input:focus {
            border-color: rgba(255, 255, 255, .6);
        }

        .newsletter-cta .nl-form button {
            background: var(--accent-color);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px 30px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all .3s;
        }

        .newsletter-cta .nl-form button:hover {
            background: color-mix(in srgb, var(--accent-color), black 10%);
            transform: translateY(-2px);
        }

        /* ===== FOOTER-16 ===== */
        .footer-16 {
            background: var(--background-color);
            color: var(--default-color);
            font-size: 15px;
            padding: 100px 0 0;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 92%);
        }

        .footer-16 .footer-main {
            margin-bottom: 80px;
        }

        .footer-16 .brand-section .logo {
            text-decoration: none;
        }

        .footer-16 .brand-section .logo .sitename {
            font-family: var(--heading-font);
            font-size: 28px;
            font-weight: 700;
            color: var(--heading-color);
            letter-spacing: -0.5px;
        }

        .footer-16 .brand-section .logo .sitename span {
            color: var(--accent-color);
        }

        .footer-16 .brand-section .brand-description {
            font-size: 16px;
            line-height: 1.7;
            color: color-mix(in srgb, var(--default-color), transparent 25%);
            font-weight: 300;
            max-width: 340px;
            margin: 16px 0 0;
        }

        .footer-16 .brand-section .contact-info {
            margin-top: 24px;
        }

        .footer-16 .brand-section .contact-info .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 14px;
            font-size: 14px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
        }

        .footer-16 .brand-section .contact-info .contact-item i {
            font-size: 15px;
            color: var(--accent-color);
            margin-right: 10px;
            margin-top: 2px;
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
            font-size: 15px;
            font-weight: 600;
            color: var(--heading-color);
            margin-bottom: 20px;
            letter-spacing: .3px;
        }

        .footer-16 .nav-column .footer-nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-16 .nav-column .footer-nav a {
            color: color-mix(in srgb, var(--default-color), transparent 30%);
            text-decoration: none;
            font-size: 14px;
            font-weight: 300;
            transition: all .3s ease;
            line-height: 1.4;
        }

        .footer-16 .nav-column .footer-nav a:hover {
            color: var(--accent-color);
            transform: translateX(4px);
        }

        .footer-16 .footer-social {
            padding: 40px 0;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 94%);
            border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 94%);
        }

        .footer-16 .footer-social .social-links {
            display: flex;
            gap: 28px;
            align-items: center;
            flex-wrap: wrap;
        }

        .footer-16 .footer-social .social-links .social-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
            font-size: 13px;
            font-weight: 400;
            transition: all .3s ease;
        }

        .footer-16 .footer-social .social-links .social-link i {
            font-size: 18px;
        }

        .footer-16 .footer-social .social-links .social-link:hover {
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
            text-decoration: none;
            font-weight: 300;
            transition: color .3s ease;
        }

        .footer-16 .footer-bottom .legal-links a:hover {
            color: var(--accent-color);
        }

        @media(max-width:768px) {
            .footer-16 {
                padding: 60px 0 0;
            }
        }

        /* ===== HIDDEN POSTS for JS filter ===== */
        .bc[data-cat]:not([data-cat="all"]) {
            display: flex;
        }
    </style>


    <!-- ===== SCROLL TOP ===== -->
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center" id="scrollTop">
        <i class="bi bi-arrow-up-short"></i>
    </a>
    <main class="main">

        {{-- ===== BLOG HERO ===== --}}
        <section class="blog-hero">
            <div class="container hero-inner">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="eyebrow"><i class="bi bi-journal-richtext"></i> Our Stories</div>
                        <h1>Behind the <em>Curtain</em> &<br>Beyond the Stage</h1>
                        <p>Casting wins, workshops, student spotlights, and behind-the-scenes from Jaipur's #1 screen
                            acting school for kids.</p>
                        <div class="hero-stats">
                            <div class="hs">
                                <span class="num">{{ $totalBlogs }}+</span>
                                <span class="lbl">Articles</span>
                            </div>
                            <div class="hs">
                                <span class="num">{{ $categories->count() }}</span>
                                <span class="lbl">Categories</span>
                            </div>
                            <div class="hs">
                                <span class="num">1000+</span>
                                <span class="lbl">Students Featured</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                        {{-- Decorative mosaic - show recent blog images --}}
                        @php $mosaicBlogs = \App\Models\Blog::where('status',1)->whereNotNull('image')->latest()->limit(4)->get(); @endphp
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;width:380px;opacity:.85;">
                            @foreach ($mosaicBlogs as $mi => $mb)
                                <img src="{{ asset('img/' . $mb->image) }}"
                                    style="border-radius:16px;height:{{ $mi % 2 === 0 ? '180' : '140' }}px;object-fit:cover;width:100%;{{ $mi === 1 ? 'margin-top:30px;' : ($mi === 2 ? 'margin-top:-30px;' : '') }}"
                                    alt="{{ $mb->title }}">
                            @endforeach
                            {{-- Fallback placeholders if fewer than 4 images --}}
                            @for ($fi = $mosaicBlogs->count(); $fi < 4; $fi++)
                                <div
                                    style="border-radius:16px;height:{{ $fi % 2 === 0 ? '180' : '140' }}px;background:linear-gradient(135deg,#175cdd22,#175cdd44);width:100%;">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            {{-- Category Filter Bar --}}
            <div class="category-bar">
                <div class="container">
                    <div class="cat-tabs">
                        <button class="cat-tab {{ !request('category') ? 'active' : '' }}"
                            onclick="filterPosts('all',this)">
                            All Posts <span class="cat-count">{{ $totalBlogs }}</span>
                        </button>
                        @foreach ($categories as $cat)
                            <button class="cat-tab {{ request('category') === $cat->slug ? 'active' : '' }}"
                                onclick="filterPosts('{{ $cat->slug }}',this)" data-slug="{{ $cat->slug }}">
                                {{ $cat->category_name }}
                                <span class="cat-count">{{ $cat->blogs_count }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== FEATURED POST ===== --}}
        @if ($featured)
            <section class="featured-post-section">
                <div class="container">
                    <div class="featured-label"><i class="bi bi-star-fill"></i> Featured Story</div>
                    <div class="featured-card">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="fc-img" style="height:100%;min-height:340px;">
                                    @if ($featured->image)
                                        <img src="{{ asset('img/' . $featured->image) }}" alt="{{ $featured->title }}"
                                            style="height:100%;min-height:340px;" />
                                    @else
                                        <div
                                            style="height:100%;min-height:340px;background:linear-gradient(135deg,#175cdd,#0d3a8e);">
                                        </div>
                                    @endif
                                    <div class="fc-overlay"></div>
                                    @if ($featured->category)
                                        <span class="fc-badge">{{ $featured->category->category_name }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="fc-body d-flex flex-column h-100 justify-content-center">
                                    <div class="fc-meta">
                                        <span class="meta-item">
                                            <i class="bi bi-calendar3"></i>
                                            {{ $featured->created_at->format('M j, Y') }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="bi bi-clock"></i>
                                            {{ max(1, (int) (str_word_count(strip_tags($featured->description ?? '')) / 200)) }}
                                            min read
                                        </span>
                                    </div>
                                    <h2>{{ $featured->title }}</h2>
                                    <p>{{ Str::limit(strip_tags($featured->short_description ?? $featured->description), 200) }}
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                        @if ($featured->author)
                                            <div class="fc-author">
                                                @if ($featured->author->image)
                                                    <img src="{{ asset('img/authors/' . $featured->author->image) }}"
                                                        class="avatar"
                                                        style="width:44px;height:44px;border-radius:50%;object-fit:cover;"
                                                        alt="{{ $featured->author->name }}">
                                                @else
                                                    <div class="avatar">
                                                        {{ strtoupper(substr($featured->author->name, 0, 2)) }}</div>
                                                @endif
                                                <div class="au-info">
                                                    <span class="au-name">{{ $featured->author->name }}</span>
                                                    <span
                                                        class="au-role">{{ $featured->author->designation ?? 'Author' }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        <a href="{{ route('frontend.blog.details', $featured->slug) }}"
                                            class="btn-read-more">
                                            Read More <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- ===== BLOG GRID + SIDEBAR ===== --}}
        <section class="blog-grid-section light-background">
            <div class="container">
                <div class="blog-layout">

                    {{-- LEFT: GRID --}}
                    <div>
                        <div class="blog-card-wrap" id="blogGrid">
                            @forelse($blogs as $blog)
                                <div class="bc" data-cat="{{ $blog->category->slug ?? 'uncategorized' }}">
                                    <div class="bc-img">
                                        @if ($blog->image)
                                            <img src="{{ asset('img/' . $blog->image) }}" alt="{{ $blog->title }}" />
                                        @else
                                            <div
                                                style="height:220px;background:linear-gradient(135deg,#175cdd22,#175cdd55);display:flex;align-items:center;justify-content:center;">
                                                <i class="bi bi-journal-richtext"
                                                    style="font-size:3rem;color:#175cdd44;"></i>
                                            </div>
                                        @endif
                                        @if ($blog->category)
                                            <span class="bc-cat" style="background:var(--accent-color);">
                                                {{ $blog->category->category_name }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="bc-body">
                                        <div class="bc-meta">
                                            <span><i class="bi bi-calendar3"></i>
                                                {{ $blog->created_at->format('M j, Y') }}</span>
                                            <span><i class="bi bi-clock"></i>
                                                {{ max(1, (int) (str_word_count(strip_tags($blog->description ?? '')) / 200)) }}
                                                min read
                                            </span>
                                        </div>
                                        <h3>{{ $blog->title }}</h3>
                                        <p>{{ Str::limit(strip_tags($blog->short_description ?? $blog->description), 120) }}
                                        </p>
                                        <div class="bc-footer">
                                            <div class="bc-author">
                                                @if ($blog->author)
                                                    @if ($blog->author->image)
                                                        <img src="{{ asset('img/authors/' . $blog->author->image) }}"
                                                            class="av" style="border-radius:50%;object-fit:cover;"
                                                            alt="{{ $blog->author->name }}">
                                                    @else
                                                        <div class="av">
                                                            {{ strtoupper(substr($blog->author->name, 0, 2)) }}</div>
                                                    @endif
                                                    <span>{{ $blog->author->name }}</span>
                                                @else
                                                    <div class="av">AA</div>
                                                    <span>Act to Action</span>
                                                @endif
                                            </div>
                                            <a href="{{ route('frontend.blog.details', $blog->slug) }}" class="bc-link">
                                                Read <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:#888;">
                                    <i class="bi bi-journal-x"
                                        style="font-size:3rem;display:block;margin-bottom:16px;"></i>
                                    No blog posts found.
                                </div>
                            @endforelse
                        </div>

                        {{-- Pagination --}}
                        @if ($blogs->hasPages())
                            <div class="text-center mt-5">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    {{-- Previous --}}
                                    @if ($blogs->onFirstPage())
                                        <span class="blog-page-btn disabled">&laquo;</span>
                                    @else
                                        <a href="{{ $blogs->previousPageUrl() }}" class="blog-page-btn">&laquo;</a>
                                    @endif

                                    {{-- Page numbers --}}
                                    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                        @if ($page == $blogs->currentPage())
                                            <span class="blog-page-btn active">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}" class="blog-page-btn">{{ $page }}</a>
                                        @endif
                                    @endforeach

                                    {{-- Next --}}
                                    @if ($blogs->hasMorePages())
                                        <a href="{{ $blogs->nextPageUrl() }}" class="blog-page-btn">&raquo;</a>
                                    @else
                                        <span class="blog-page-btn disabled">&raquo;</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>{{-- end LEFT --}}

                    {{-- RIGHT: SIDEBAR --}}
                    <aside class="sidebar">

                        {{-- Search --}}
                        <div class="sidebar-card">
                            <form action="#" method="GET">
                                <div style="position:relative;">
                                    <input type="text" name="q" value="{{ request('q') }}"
                                        placeholder="Search articles…"
                                        style="width:100%;border:1.5px solid color-mix(in srgb,#3c4049,transparent 80%);border-radius:50px;padding:12px 50px 12px 20px;font-size:14px;outline:none;color:#3c4049;transition:border-color .3s;"
                                        onfocus="this.style.borderColor='#175cdd'"
                                        onblur="this.style.borderColor='color-mix(in srgb,#3c4049,transparent 80%)'">
                                    <button type="submit"
                                        style="position:absolute;right:18px;top:50%;transform:translateY(-50%);background:none;border:none;padding:0;cursor:pointer;">
                                        <i class="bi bi-search" style="color:#175cdd;font-size:15px;"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Categories --}}
                        <div class="sidebar-card">
                            <h5>Categories</h5>
                            <ul class="cat-list">
                                <li>
                                    <a href="#" class="{{ !request('category') ? 'active' : '' }}">
                                        All Posts <span class="badge">{{ $totalBlogs }}</span>
                                    </a>
                                </li>
                                @foreach ($categories as $cat)
                                    <li>
                                        <a href="{{ route('frontend.blog.category', $cat->slug) }}"
                                            class="{{ request('category') === $cat->slug ? 'active' : '' }}">
                                            {{ $cat->category_name }}
                                            <span class="badge">{{ $cat->blogs_count }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Recent Posts --}}
                        <div class="sidebar-card">
                            <h5>Recent Posts</h5>
                            @foreach ($recentPosts as $rp)
                                <a href="#" class="text-decoration-none">
                                    <div class="recent-post">
                                        @if ($rp->image)
                                            <img src="{{ asset('img/' . $rp->image) }}" alt="{{ $rp->title }}" />
                                        @else
                                            <div
                                                style="width:70px;height:60px;border-radius:8px;background:linear-gradient(135deg,#175cdd22,#175cdd55);flex-shrink:0;">
                                            </div>
                                        @endif
                                        <div class="rp-info">
                                            <h6>{{ Str::limit($rp->title, 60) }}</h6>
                                            <span>{{ $rp->created_at->format('M j, Y') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        {{-- Tags --}}
                        <div class="sidebar-card">
                            <h5>Popular Tags</h5>
                            <div class="tag-cloud">
                                @foreach ($tags as $tag)
                                    <a href="#">{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>

                        {{-- About Widget --}}
                        <div class="sidebar-card">
                            <h5>About This Blog</h5>
                            <p style="font-size:13px;line-height:1.7;color:color-mix(in srgb,#3c4049,transparent 20%);">
                                Stories from India's first screen acting school for children (ages 3–29). Founded in
                                2019 by
                                Kritesh Agarwal. Registered with Startup India &amp; iStart Rajasthan.
                            </p>
                            <a href="#enroll"
                                style="display:inline-flex;align-items:center;gap:8px;background:var(--accent-color);color:#fff;padding:10px 22px;border-radius:50px;font-size:13px;font-weight:600;margin-top:12px;transition:all .3s;">
                                <i class="bi bi-person-plus-fill"></i> Enroll Today
                            </a>
                        </div>

                        {{-- Newsletter --}}
                        <div class="sidebar-newsletter">
                            <h5>Stay Updated</h5>
                            <p>Get the latest stories, casting news and workshop updates delivered to your inbox.</p>
                            <input type="email" class="ns-input" placeholder="Your email address" />
                            <button class="ns-btn"><i class="bi bi-send-fill me-2"></i>Subscribe</button>
                        </div>

                    </aside>
                </div>
            </div>
        </section>

        {{-- ===== NEWSLETTER CTA ===== --}}
        <section class="newsletter-cta">
            <div class="container">
                <div class="inner">
                    <div
                        style="display:inline-block;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.8);font-size:12px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:6px 18px;border-radius:50px;margin-bottom:20px;">
                        Never Miss a Story
                    </div>
                    <h2>Get the Latest from<br>Act to Action</h2>
                    <p>Casting wins, workshops, student spotlights &amp; school updates — delivered fresh.</p>
                    <div class="nl-form">
                        <input type="email" placeholder="Enter your email address" />
                        <button><i class="bi bi-send-fill me-2"></i> Subscribe Free</button>
                    </div>
                    <p style="font-size:12px;color:rgba(255,255,255,.45);margin-top:14px;">
                        No spam. Unsubscribe anytime. 500+ parents already subscribed.
                    </p>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('script')
    <script>
        // ===== CATEGORY FILTER (client-side for instant feel) =====
        function filterPosts(cat, btn) {
            // Update tab active state
            document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
            if (btn) btn.classList.add('active');

            const cards = document.querySelectorAll('#blogGrid .bc');
            let shown = 0;
            cards.forEach(c => {
                const cardCat = c.getAttribute('data-cat');
                if (cat === 'all' || cardCat === cat) {
                    c.style.display = '';
                    c.style.animation = 'fadeInUp .4s ease';
                    shown++;
                } else {
                    c.style.display = 'none';
                }
            });
        }

        // ===== FADE IN ON SCROLL =====
        const style = document.createElement('style');
        style.textContent = `
    @keyframes fadeInUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
    .blog-page-btn {
        display:inline-flex;align-items:center;justify-content:center;
        width:40px;height:40px;border-radius:8px;border:1.5px solid #ddd;
        color:#3c4049;text-decoration:none;font-size:14px;font-weight:600;transition:all .2s;
    }
    .blog-page-btn:hover { background:#175cdd;color:#fff;border-color:#175cdd; }
    .blog-page-btn.active { background:#175cdd;color:#fff;border-color:#175cdd; }
    .blog-page-btn.disabled { opacity:.4;pointer-events:none; }
`;
        document.head.appendChild(style);

        const observer = new IntersectionObserver(entries => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) {
                    e.target.style.animationDelay = (i * 0.07) + 's';
                    e.target.style.animation = 'fadeInUp .5s ease forwards';
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.bc').forEach(c => observer.observe(c));

        // ===== MOBILE NAV =====
        const mnt = document.querySelector('.mobile-nav-toggle');
        if (mnt) mnt.addEventListener('click', () => {
            document.body.classList.toggle('mobile-nav-active');
            mnt.classList.toggle('bi-list');
            mnt.classList.toggle('bi-x');
        });
    </script>
@endsection
