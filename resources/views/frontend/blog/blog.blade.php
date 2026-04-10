@extends('frontend.course.layout')
@section('content')
    <style>
        /* ===================== CSS VARIABLES (inherit from main) ===================== */
        /* These variables must be defined in :root of your main CSS:
           --accent-color, --heading-color, --default-color, --surface-color,
           --background-color, --contrast-color, --heading-font, --nav-font, --default-font
        */

        /* ===================== BASE ===================== */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        a {
            color: var(--accent-color);
            text-decoration: none;
            transition: color .3s ease;
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
            margin: 0 0 .5em;
        }

        /* ===================== SCROLL TOP ===================== */
        .scroll-top {
            position: fixed;
            visibility: hidden;
            opacity: 0;
            right: 20px;
            bottom: -20px;
            z-index: 99999;
            background-color: var(--accent-color);
            width: 46px;
            height: 46px;
            border-radius: 50%;
            transition: all .4s cubic-bezier(.34, 1.56, .64, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px color-mix(in srgb, var(--accent-color), transparent 50%);
        }

        .scroll-top i {
            font-size: 22px;
            color: var(--contrast-color);
            line-height: 0;
        }

        .scroll-top:hover {
            background-color: color-mix(in srgb, var(--accent-color), transparent 15%);
            transform: translateY(-4px);
            box-shadow: 0 10px 28px color-mix(in srgb, var(--accent-color), transparent 40%);
        }

        .scroll-top.active {
            visibility: visible;
            opacity: 1;
            bottom: 20px;
        }

        /* ===================== KEYFRAMES ===================== */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(28px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(.94);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 0 0 0 color-mix(in srgb, var(--accent-color), transparent 70%);
            }

            50% {
                box-shadow: 0 0 0 8px color-mix(in srgb, var(--accent-color), transparent 90%);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        /* ===================== BLOG HERO ===================== */
        .blog-hero {
            background: linear-gradient(135deg, var(--heading-color) 0%, color-mix(in srgb, var(--accent-color), #112344 40%) 100%);
            padding: 90px 0 0;
            position: relative;
            overflow: hidden;
        }

        .blog-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1503095396549-807759245b35?w=1400&q=20') center/cover no-repeat;
            opacity: .08;
        }

        /* Decorative animated circles */
        .blog-hero::after {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, color-mix(in srgb, var(--accent-color), transparent 60%) 0%, transparent 70%);
            top: -200px;
            right: -100px;
            pointer-events: none;
            animation: float 8s ease-in-out infinite;
        }

        .blog-hero .hero-inner {
            position: relative;
            z-index: 1;
            padding-bottom: 56px;
            margin-top: 50px;
            animation: fadeInUp .7s ease both;
        }

        .blog-hero .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: color-mix(in srgb, var(--accent-color), transparent 75%);
            border: 1px solid color-mix(in srgb, var(--accent-color), transparent 50%);
            color: #a8c4ff;
            padding: 7px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-bottom: 22px;
            animation: fadeInDown .6s ease both;
            backdrop-filter: blur(6px);
        }

        .blog-hero h1 {
            font-size: clamp(2rem, 5vw, 3.6rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.12;
            margin-bottom: 18px;
            animation: fadeInUp .7s .1s ease both;
        }

        .blog-hero h1 em {
            color: #a8c4ff;
            font-style: normal;
            background: linear-gradient(90deg, #a8c4ff, #c9d9ff, #a8c4ff);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s linear infinite;
        }

        .blog-hero p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, .72);
            max-width: 520px;
            line-height: 1.75;
            animation: fadeInUp .7s .2s ease both;
        }

        .blog-hero .hero-stats {
            display: flex;
            gap: 36px;
            margin-top: 36px;
            flex-wrap: wrap;
            animation: fadeInUp .7s .3s ease both;
        }

        .blog-hero .hero-stats .hs {
            text-align: center;
            position: relative;
            padding-right: 36px;
        }

        .blog-hero .hero-stats .hs:not(:last-child)::after {
            content: "";
            position: absolute;
            right: 0;
            top: 10%;
            height: 80%;
            width: 1px;
            background: rgba(255, 255, 255, .2);
        }

        .blog-hero .hero-stats .hs .num {
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            display: block;
            line-height: 1;
            font-family: var(--heading-font);
        }

        .blog-hero .hero-stats .hs .lbl {
            font-size: 11px;
            color: rgba(255, 255, 255, .55);
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-top: 5px;
            display: block;
        }

        /* Category Filter Bar */
        .blog-hero .category-bar {
            background: rgba(255, 255, 255, .07);
            border-top: 1px solid rgba(255, 255, 255, .1);
            backdrop-filter: blur(12px);
            margin-top: 44px;
            animation: fadeInUp .7s .4s ease both;
        }

        .blog-hero .category-bar .cat-tabs {
            display: flex;
            gap: 0;
            overflow-x: auto;
            scrollbar-width: none;
            -webkit-overflow-scrolling: touch;
        }

        .blog-hero .category-bar .cat-tabs::-webkit-scrollbar {
            display: none;
        }

        .blog-hero .category-bar .cat-tab {
            padding: 17px 26px;
            font-size: 13.5px;
            font-weight: 600;
            font-family: var(--nav-font);
            color: rgba(255, 255, 255, .58);
            border: none;
            background: transparent;
            cursor: pointer;
            white-space: nowrap;
            position: relative;
            transition: color .25s ease;
            border-bottom: 3px solid transparent;
            letter-spacing: .2px;
        }

        .blog-hero .category-bar .cat-tab::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, .06);
            opacity: 0;
            transition: opacity .25s;
        }

        .blog-hero .category-bar .cat-tab:hover {
            color: rgba(255, 255, 255, .9);
        }

        .blog-hero .category-bar .cat-tab:hover::before {
            opacity: 1;
        }

        .blog-hero .category-bar .cat-tab.active {
            color: #fff;
            border-bottom-color: var(--accent-color);
            font-weight: 700;
        }

        .blog-hero .category-bar .cat-tab .cat-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--accent-color), transparent 68%);
            font-size: 11px;
            margin-left: 7px;
            transition: background .25s;
        }

        .blog-hero .category-bar .cat-tab.active .cat-count {
            background: var(--accent-color);
        }

        /* ===================== FEATURED POST ===================== */
        .featured-post-section {
            background: var(--background-color);
            padding: 70px 0 48px;
        }

        .featured-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 6px;
            margin-bottom: 26px;
            border-left: 3px solid var(--accent-color);
            animation: slideInLeft .6s ease both;
        }

        .featured-card {
            background: var(--surface-color);
            border-radius: 22px;
            overflow: hidden;
            box-shadow:
                0 4px 6px color-mix(in srgb, var(--default-color), transparent 94%),
                0 20px 60px color-mix(in srgb, var(--default-color), transparent 88%);
            transition: transform .4s cubic-bezier(.25, .46, .45, .94),
                box-shadow .4s ease;
            animation: scaleIn .7s ease both;
        }

        .featured-card:hover {
            transform: translateY(-8px);
            box-shadow:
                0 8px 16px color-mix(in srgb, var(--default-color), transparent 90%),
                0 32px 80px color-mix(in srgb, var(--default-color), transparent 82%);
        }

        .featured-card .fc-img {
            position: relative;
            height: 440px;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .featured-card .fc-img {
                height: 240px;
            }
        }

        .featured-card .fc-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .6s cubic-bezier(.25, .46, .45, .94);
            display: block;
        }

        .featured-card:hover .fc-img img {
            transform: scale(1.05);
        }

        .featured-card .fc-img .fc-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17, 35, 68, .85) 0%, rgba(17, 35, 68, .1) 55%, transparent 100%);
        }

        .featured-card .fc-img .fc-badge {
            position: absolute;
            top: 22px;
            left: 22px;
            background: var(--accent-color);
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 50px;
            box-shadow: 0 4px 12px color-mix(in srgb, var(--accent-color), transparent 50%);
            animation: pulseGlow 3s ease infinite;
        }

        .featured-card .fc-body {
            padding: 40px 44px 44px;
        }

        @media (max-width: 768px) {
            .featured-card .fc-body {
                padding: 24px 22px 28px;
            }
        }

        .featured-card .fc-meta {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 18px;
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
            font-size: clamp(1.35rem, 2.5vw, 2rem);
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 14px;
            line-height: 1.28;
        }

        .featured-card p {
            font-size: 1rem;
            line-height: 1.75;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            margin-bottom: 28px;
        }

        .featured-card .fc-author {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .featured-card .fc-author .avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--accent-color), transparent 85%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--accent-color);
            font-size: 14px;
            flex-shrink: 0;
            border: 2px solid color-mix(in srgb, var(--accent-color), transparent 70%);
            transition: border-color .3s;
        }

        .featured-card:hover .fc-author .avatar {
            border-color: var(--accent-color);
        }

        .featured-card .fc-author .au-info .au-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--heading-color);
            display: block;
            margin-bottom: 2px;
        }

        .featured-card .fc-author .au-info .au-role {
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 45%);
        }

        /* Read More Button */
        .btn-read-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-color);
            color: var(--contrast-color);
            padding: 13px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
            text-decoration: none;
            box-shadow: 0 4px 15px color-mix(in srgb, var(--accent-color), transparent 55%);
            white-space: nowrap;
        }

        .btn-read-more:hover {
            background: color-mix(in srgb, var(--accent-color), black 12%);
            color: var(--contrast-color);
            transform: translateY(-3px);
            gap: 13px;
            box-shadow: 0 8px 24px color-mix(in srgb, var(--accent-color), transparent 45%);
        }

        .btn-read-more i {
            font-size: 13px;
            transition: transform .3s ease;
        }

        .btn-read-more:hover i {
            transform: translateX(4px);
        }

        /* ===================== BLOG GRID ===================== */
        .blog-grid-section {
            background: var(--background-color);
            padding: 48px 0 90px;
        }

        .blog-card-wrap {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        @media (max-width: 992px) {
            .blog-card-wrap {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
        }

        @media (max-width: 576px) {
            .blog-card-wrap {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* Blog Card */
        .bc {
            background: var(--surface-color);
            border-radius: 18px;
            overflow: hidden;
            box-shadow:
                0 2px 4px color-mix(in srgb, var(--default-color), transparent 95%),
                0 6px 20px color-mix(in srgb, var(--default-color), transparent 93%);
            transition: transform .35s cubic-bezier(.25, .46, .45, .94),
                box-shadow .35s ease,
                border-color .35s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 92%);
            animation: fadeInUp .5s ease both;
        }

        /* Stagger animation for cards */
        .bc:nth-child(1) {
            animation-delay: .05s;
        }

        .bc:nth-child(2) {
            animation-delay: .12s;
        }

        .bc:nth-child(3) {
            animation-delay: .19s;
        }

        .bc:nth-child(4) {
            animation-delay: .26s;
        }

        .bc:nth-child(5) {
            animation-delay: .33s;
        }

        .bc:nth-child(6) {
            animation-delay: .40s;
        }

        .bc:hover {
            transform: translateY(-10px);
            box-shadow:
                0 4px 8px color-mix(in srgb, var(--default-color), transparent 93%),
                0 24px 50px color-mix(in srgb, var(--default-color), transparent 85%);
            border-color: color-mix(in srgb, var(--accent-color), transparent 75%);
        }

        .bc .bc-img {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: color-mix(in srgb, var(--accent-color), transparent 92%);
        }

        .bc .bc-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .45s cubic-bezier(.25, .46, .45, .94);
            display: block;
        }

        .bc:hover .bc-img img {
            transform: scale(1.08);
        }

        .bc .bc-img .bc-cat {
            position: absolute;
            top: 14px;
            left: 14px;
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: .9px;
            text-transform: uppercase;
            padding: 5px 13px;
            border-radius: 50px;
            background: var(--accent-color);
            color: #fff;
            box-shadow: 0 3px 10px color-mix(in srgb, var(--accent-color), transparent 55%);
            backdrop-filter: blur(4px);
            transition: transform .3s ease;
        }

        .bc:hover .bc-img .bc-cat {
            transform: scale(1.05);
        }

        .bc .bc-body {
            padding: 24px 26px 26px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .bc .bc-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 13px;
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
            font-size: 1.06rem;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 11px;
            line-height: 1.45;
            transition: color .25s ease;
        }

        .bc:hover h3 {
            color: var(--accent-color);
        }

        .bc p {
            font-size: .875rem;
            line-height: 1.68;
            color: color-mix(in srgb, var(--default-color), transparent 25%);
            margin-bottom: 18px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .bc-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 12px;
        }

        .bc-tag {
            font-size: 11px;
            padding: 3px 11px;
            border-radius: 50px;
            background: color-mix(in srgb, var(--accent-color), transparent 88%);
            color: var(--accent-color);
            font-weight: 700;
            transition: all .2s ease;
            text-decoration: none;
            letter-spacing: .3px;
        }

        .bc-tag:hover {
            background: var(--accent-color);
            color: #fff;
            transform: translateY(-1px);
        }

        .bc .bc-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            padding-top: 16px;
            margin-top: auto;
        }

        .bc .bc-author {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .bc .bc-author .av {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--accent-color), transparent 85%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
            color: var(--accent-color);
            flex-shrink: 0;
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 70%);
        }

        .bc .bc-author span {
            font-size: 12px;
            font-weight: 600;
            color: var(--heading-color);
        }

        .bc .bc-link {
            font-size: 13px;
            font-weight: 700;
            color: var(--accent-color);
            display: flex;
            align-items: center;
            gap: 5px;
            transition: gap .25s ease, color .25s ease;
            text-decoration: none;
        }

        .bc .bc-link:hover {
            gap: 9px;
            color: color-mix(in srgb, var(--accent-color), black 12%);
        }

        /* ===================== LOAD MORE ===================== */
        .load-more-wrap {
            text-align: center;
            margin-top: 56px;
        }

        .load-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 44px;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            border-radius: 50px;
            font-weight: 700;
            font-size: 15px;
            background: transparent;
            cursor: pointer;
            transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .load-more-btn::before {
            content: "";
            position: absolute;
            inset: 0;
            background: var(--accent-color);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s ease;
            z-index: 0;
        }

        .load-more-btn span,
        .load-more-btn i {
            position: relative;
            z-index: 1;
            transition: color .3s ease;
        }

        .load-more-btn:hover {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px color-mix(in srgb, var(--accent-color), transparent 55%);
        }

        .load-more-btn:hover::before {
            transform: scaleX(1);
        }

        .load-more-btn.loading {
            pointer-events: none;
            opacity: .65;
        }

        .load-more-btn .lm-spinner {
            width: 17px;
            height: 17px;
            border: 2px solid currentColor;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin .7s linear infinite;
            display: none;
        }

        .load-more-btn.loading .lm-spinner {
            display: inline-block;
        }

        .load-more-btn.loading .lm-text {
            display: none;
        }

        .load-more-count {
            display: block;
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
            margin-top: 16px;
        }

        /* ===================== BLOG LAYOUT (main + sidebar) ===================== */
        .blog-layout {
            display: grid;
            grid-template-columns: 1fr 330px;
            gap: 44px;
            align-items: start;
        }

        @media (max-width: 1100px) {
            .blog-layout {
                grid-template-columns: 1fr;
            }
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 28px;
            position: sticky;
            top: 24px;
        }

        @media (max-width: 1100px) {
            .sidebar {
                position: static;
            }
        }

        .sidebar-card {
            background: var(--surface-color);
            border-radius: 18px;
            padding: 28px 28px 26px;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            box-shadow: 0 4px 20px color-mix(in srgb, var(--default-color), transparent 94%);
            transition: box-shadow .3s ease;
            animation: fadeInUp .5s ease both;
        }

        .sidebar-card:hover {
            box-shadow: 0 8px 32px color-mix(in srgb, var(--default-color), transparent 88%);
        }

        .sidebar-card h5 {
            font-size: 15px;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 20px;
            padding-bottom: 13px;
            border-bottom: 2px solid color-mix(in srgb, var(--accent-color), transparent 80%);
            position: relative;
            letter-spacing: .2px;
        }

        .sidebar-card h5::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 42px;
            height: 2px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        /* Category list */
        .cat-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .cat-list li a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            border-radius: 10px;
            color: var(--default-color);
            font-size: 14px;
            font-weight: 500;
            transition: all .25s ease;
            background: color-mix(in srgb, var(--default-color), transparent 96%);
            text-decoration: none;
        }

        .cat-list li a:hover,
        .cat-list li a.active {
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
            padding-left: 18px;
        }

        .cat-list li a .badge {
            background: var(--accent-color);
            color: #fff;
            font-size: 10.5px;
            padding: 2px 9px;
            border-radius: 50px;
            font-weight: 700;
        }

        /* Recent posts */
        .recent-post {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding: 13px 0;
            border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            transition: transform .25s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .recent-post:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .recent-post:hover {
            transform: translateX(4px);
        }

        .recent-post img {
            width: 66px;
            height: 54px;
            object-fit: cover;
            border-radius: 9px;
            flex-shrink: 0;
            transition: transform .3s ease;
        }

        .recent-post:hover img {
            transform: scale(1.05);
        }

        .recent-post .rp-info h6 {
            font-size: 13px;
            font-weight: 600;
            color: var(--heading-color);
            margin: 0 0 5px;
            line-height: 1.4;
            transition: color .25s ease;
        }

        .recent-post .rp-info span {
            font-size: 11px;
            color: color-mix(in srgb, var(--default-color), transparent 45%);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .recent-post:hover .rp-info h6 {
            color: var(--accent-color);
        }

        /* Tag cloud */
        .tag-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag-cloud a {
            font-size: 12px;
            padding: 5px 14px;
            border-radius: 50px;
            background: color-mix(in srgb, var(--default-color), transparent 93%);
            color: var(--default-color);
            font-weight: 500;
            transition: all .25s ease;
            text-decoration: none;
        }

        .tag-cloud a:hover {
            background: var(--accent-color);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px color-mix(in srgb, var(--accent-color), transparent 60%);
        }

        .tag-cloud .tag-count {
            opacity: .45;
            font-size: 10px;
            margin-left: 3px;
        }

        /* Newsletter sidebar widget */
        .sidebar-newsletter {
            background: linear-gradient(135deg, var(--heading-color), color-mix(in srgb, var(--accent-color), #112344 30%));
            border-radius: 18px;
            padding: 28px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .sidebar-newsletter::before {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--accent-color), transparent 75%);
            bottom: -80px;
            right: -60px;
            pointer-events: none;
        }

        .sidebar-newsletter h5 {
            color: #fff;
            border-bottom-color: rgba(255, 255, 255, .18);
            position: relative;
            z-index: 1;
        }

        .sidebar-newsletter h5::after {
            background: #a8c4ff;
        }

        .sidebar-newsletter p {
            font-size: 13px;
            color: rgba(255, 255, 255, .7);
            margin-bottom: 18px;
            line-height: 1.65;
            position: relative;
            z-index: 1;
        }

        .sidebar-newsletter .ns-input {
            width: 100%;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 9px;
            padding: 11px 16px;
            color: #fff;
            font-size: 13px;
            margin-bottom: 10px;
            outline: none;
            transition: border-color .25s, background .25s;
            position: relative;
            z-index: 1;
        }

        .sidebar-newsletter .ns-input::placeholder {
            color: rgba(255, 255, 255, .42);
        }

        .sidebar-newsletter .ns-input:focus {
            border-color: rgba(255, 255, 255, .55);
            background: rgba(255, 255, 255, .16);
        }

        .sidebar-newsletter .ns-btn {
            width: 100%;
            background: var(--accent-color);
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: 11px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 14px color-mix(in srgb, var(--accent-color), transparent 50%);
        }

        .sidebar-newsletter .ns-btn:hover {
            background: color-mix(in srgb, var(--accent-color), black 12%);
            transform: translateY(-2px);
            box-shadow: 0 7px 20px color-mix(in srgb, var(--accent-color), transparent 40%);
        }

        /* ===================== NEWSLETTER CTA ===================== */
        .newsletter-cta {
            background: linear-gradient(135deg, var(--heading-color) 0%, color-mix(in srgb, var(--accent-color), #112344 40%) 100%);
            padding: 90px 0;
            position: relative;
            overflow: hidden;
        }

        .newsletter-cta::before {
            content: "";
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1598899134739-24c46f58b8c0?w=1200&q=15') center/cover no-repeat;
            opacity: .05;
        }

        /* Decorative circles */
        .newsletter-cta::after {
            content: "";
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .06);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .newsletter-cta .inner {
            position: relative;
            z-index: 1;
            text-align: center;
            animation: fadeInUp .7s ease both;
        }

        .newsletter-cta h2 {
            color: #fff;
            font-size: clamp(1.6rem, 3vw, 2.6rem);
            font-weight: 800;
            margin-bottom: 14px;
            line-height: 1.2;
        }

        .newsletter-cta p {
            color: rgba(255, 255, 255, .7);
            font-size: 1.05rem;
            margin-bottom: 36px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
        }

        .newsletter-cta .nl-form {
            display: flex;
            gap: 12px;
            max-width: 540px;
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
            padding: 14px 24px;
            color: #fff;
            font-size: 15px;
            outline: none;
            transition: border-color .25s, background .25s;
            backdrop-filter: blur(6px);
        }

        .newsletter-cta .nl-form input::placeholder {
            color: rgba(255, 255, 255, .48);
        }

        .newsletter-cta .nl-form input:focus {
            border-color: rgba(255, 255, 255, .65);
            background: rgba(255, 255, 255, .16);
        }

        .newsletter-cta .nl-form button {
            background: var(--accent-color);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px 32px;
            font-weight: 800;
            font-size: 15px;
            cursor: pointer;
            transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
            box-shadow: 0 4px 16px color-mix(in srgb, var(--accent-color), transparent 50%);
            white-space: nowrap;
        }

        .newsletter-cta .nl-form button:hover {
            background: color-mix(in srgb, var(--accent-color), black 12%);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px color-mix(in srgb, var(--accent-color), transparent 40%);
        }

        /* ===================== RESPONSIVE UTILITIES ===================== */
        @media (max-width: 768px) {
            .blog-hero {
                padding-top: 70px;
            }

            .blog-hero .hero-stats {
                gap: 20px;
            }

            .blog-hero .hero-stats .hs {
                padding-right: 20px;
            }

            .featured-post-section {
                padding: 50px 0 36px;
            }

            .blog-grid-section {
                padding: 36px 0 70px;
            }

            .sidebar {
                gap: 22px;
            }

            .newsletter-cta {
                padding: 70px 0;
            }
        }
    </style>
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
                        <p>Casting wins, workshops, student spotlights, and behind-the-scenes from Jaipur's #1 screen acting
                            school for kids.</p>
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
                        @php $mosaicBlogs = \App\Models\Blog::where('status',1)->whereNotNull('image')->latest()->limit(4)->get(); @endphp
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;width:380px;opacity:.85;">
                            @foreach ($mosaicBlogs as $mi => $mb)
                                <img src="{{ asset('img/' . $mb->image) }}"
                                    style="border-radius:16px;height:{{ $mi % 2 === 0 ? '180' : '140' }}px;object-fit:cover;width:100%;{{ $mi === 1 ? 'margin-top:30px;' : ($mi === 2 ? 'margin-top:-30px;' : '') }}"
                                    alt="{{ $mb->title }}">
                            @endforeach
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
                        <button class="cat-tab {{ !request('category') && !request('tag') ? 'active' : '' }}"
                            onclick="window.location='{{ route('frontend.blog.index') }}'">
                            All Posts <span class="cat-count">{{ $totalBlogs }}</span>
                        </button>
                        @foreach ($categories as $cat)
                            <button class="cat-tab {{ request('category') === $cat->slug ? 'active' : '' }}"
                                onclick="window.location='{{ route('frontend.blog.index', ['category' => $cat->slug]) }}'">
                                {{ $cat->category_name }}
                                <span class="cat-count">{{ $cat->blogs_count ?? 0 }}</span>
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
                                                style="height:210px;background:linear-gradient(135deg,#175cdd22,#175cdd55);display:flex;align-items:center;justify-content:center;">
                                                <i class="bi bi-journal-richtext"
                                                    style="font-size:3rem;color:#175cdd44;"></i>
                                            </div>
                                        @endif
                                        @if ($blog->category)
                                            <span class="bc-cat">{{ $blog->category->category_name }}</span>
                                        @endif
                                    </div>
                                    <div class="bc-body">
                                        <div class="bc-meta">
                                            <span><i class="bi bi-calendar3"></i>
                                                {{ $blog->created_at->format('M j, Y') }}</span>
                                            <span><i class="bi bi-clock"></i>
                                                {{ max(1, (int) (str_word_count(strip_tags($blog->description ?? '')) / 200)) }}
                                                min read</span>
                                        </div>
                                        <h3>{{ $blog->title }}</h3>

                                        {{-- Tag pills --}}
                                        @if ($blog->tags->count())
                                            <div class="bc-tags">
                                                @foreach ($blog->tags as $tag)
                                                    <a href="#" class="bc-tag">#{{ $tag->name }}</a>
                                                @endforeach
                                            </div>
                                        @endif

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

                        {{-- ===== LOAD MORE BUTTON ===== --}}
                        @if ($blogs->hasMorePages())
                            <div class="load-more-wrap">
                                <button class="load-more-btn" id="loadMoreBtn"
                                    data-next-page="{{ $blogs->currentPage() + 1 }}"
                                    data-base-url="{{ url()->current() }}" data-category="{{ request('category') }}"
                                    data-tag="{{ request('tag') }}">
                                    <span class="lm-text"><i class="bi bi-arrow-down-circle me-1"></i> Load More
                                        Posts</span>
                                    <span class="lm-spinner"></span>
                                </button>
                                <span class="load-more-count d-block">
                                    Showing {{ $blogs->count() }} of {{ $blogs->total() }} posts
                                </span>
                            </div>
                        @else
                            {{-- All posts loaded — show total --}}
                            @if ($blogs->total() > 0)
                                <div class="load-more-wrap">
                                    <span class="load-more-count">All {{ $blogs->total() }} posts loaded</span>
                                </div>
                            @endif
                        @endif

                    </div>{{-- end LEFT --}}

                    {{-- RIGHT: SIDEBAR --}}
                    <aside class="sidebar">

                        {{-- Search --}}
                        <div class="sidebar-card">
                            <form action="{{ route('frontend.blog.index') }}" method="GET">
                                @if (request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                <div style="position:relative;">
                                    <input type="text" name="q" value="{{ request('q') }}"
                                        placeholder="Search articles…"
                                        style="width:100%;border:1.5px solid color-mix(in srgb,var(--default-color),transparent 80%);border-radius:50px;padding:12px 50px 12px 20px;font-size:14px;outline:none;background:transparent;color:var(--default-color);transition:border-color .3s;"
                                        onfocus="this.style.borderColor='var(--accent-color)'"
                                        onblur="this.style.borderColor='color-mix(in srgb,var(--default-color),transparent 80%)'">
                                    <button type="submit"
                                        style="position:absolute;right:18px;top:50%;transform:translateY(-50%);background:none;border:none;padding:0;cursor:pointer;">
                                        <i class="bi bi-search" style="color:var(--accent-color);font-size:15px;"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Categories --}}
                        <div class="sidebar-card">
                            <h5>Categories</h5>
                            <ul class="cat-list">
                                <li>
                                    <a href="{{ route('frontend.blog.index') }}"
                                        class="{{ !request('category') && !request('tag') ? 'active' : '' }}">
                                        All Posts <span class="badge">{{ $totalBlogs }}</span>
                                    </a>
                                </li>
                                @foreach ($categories as $cat)
                                    <li>
                                        <a href="{{ route('frontend.blog.index', ['category' => $cat->slug]) }}"
                                            class="{{ request('category') === $cat->slug ? 'active' : '' }}">
                                            {{ $cat->category_name }}
                                            <span class="badge">{{ $cat->blogs_count ?? 0 }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Recent Posts --}}
                        <div class="sidebar-card">
                            <h5>Recent Posts</h5>
                            @foreach ($recentPosts as $rp)
                                <a href="{{ route('frontend.blog.details', $rp->slug) }}" class="text-decoration-none">
                                    <div class="recent-post">
                                        @if ($rp->image)
                                            <img src="{{ asset('img/' . $rp->image) }}" alt="{{ $rp->title }}" />
                                        @else
                                            <div
                                                style="width:64px;height:52px;border-radius:8px;background:linear-gradient(135deg,#175cdd22,#175cdd55);flex-shrink:0;">
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

                        {{-- Popular Tags — with sidebar-card wrapper --}}
                        @if ($tags->count())
                            <div class="sidebar-card">
                                <h5>Popular Tags</h5>
                                <div class="tag-cloud">
                                    @foreach ($tags as $tag)
                                        <a href="#">
                                            {{ $tag->name }}
                                            <span class="tag-count">({{ $tag->blogs_count }})</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- About Widget --}}
                        <div class="sidebar-card">
                            <h5>About This Blog</h5>
                            <p
                                style="font-size:13px;line-height:1.7;color:color-mix(in srgb,var(--default-color),transparent 20%);">
                                Stories from India's first screen acting school for children (ages 3–29). Founded in 2019 by
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
        // ===== FADE IN ON SCROLL =====
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

        // ===== LOAD MORE BUTTON =====
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', async function() {
                const btn = this;
                const page = btn.dataset.nextPage;
                const baseUrl = btn.dataset.baseUrl;
                const cat = btn.dataset.category;
                const tag = btn.dataset.tag;

                // Build URL with existing filters
                const params = new URLSearchParams();
                params.set('page', page);
                if (cat) params.set('category', cat);
                if (tag) params.set('tag', tag);

                btn.classList.add('loading');

                try {
                    const res = await fetch(`${baseUrl}?${params.toString()}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const html = await res.text();

                    // Parse the returned HTML and extract new cards
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newCards = doc.querySelectorAll('#blogGrid .bc');
                    const grid = document.getElementById('blogGrid');

                    newCards.forEach(card => {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        grid.appendChild(card);
                        // Trigger animation
                        requestAnimationFrame(() => {
                            card.style.transition = 'opacity .4s ease, transform .4s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        });
                        observer.observe(card);
                    });

                    // Check if next page exists
                    const nextBtn = doc.getElementById('loadMoreBtn');
                    if (nextBtn) {
                        btn.dataset.nextPage = nextBtn.dataset.nextPage;
                        // Update count text
                        const countEl = document.querySelector('.load-more-count');
                        const newCountEl = doc.querySelector('.load-more-count');
                        if (countEl && newCountEl) countEl.textContent = newCountEl.textContent;
                    } else {
                        // No more pages — replace button with "all loaded" message
                        const wrap = btn.closest('.load-more-wrap');
                        wrap.innerHTML = '<span class="load-more-count">All posts loaded</span>';
                    }

                } catch (err) {
                    console.error('Load more failed:', err);
                } finally {
                    btn.classList.remove('loading');
                }
            });
        }

        // ===== MOBILE NAV =====
        const mnt = document.querySelector('.mobile-nav-toggle');
        if (mnt) mnt.addEventListener('click', () => {
            document.body.classList.toggle('mobile-nav-active');
            mnt.classList.toggle('bi-list');
            mnt.classList.toggle('bi-x');
        });

        // ===== SCROLL TOP =====
        window.addEventListener('scroll', () => {
            const st = document.getElementById('scrollTop');
            if (st) st.classList.toggle('active', window.scrollY > 300);
        });
    </script>
@endsection
