@extends('frontend.course.layout')
@section('content')
    


    <style>
a {
            color: var(--accent-color);
            text-decoration: none;
            transition: 0.3s;
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

        /* ===================== PRELOADER ===================== */
        #preloader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }

        #preloader.loaded {
            opacity: 0;
            visibility: hidden;
        }

        #preloader .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid color-mix(in srgb, var(--accent-color), transparent 70%);
            border-top-color: var(--accent-color);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ===================== SCROLL TOP ===================== */
        .scroll-top {
            position: fixed;
            bottom: 15px;
            right: 15px;
            z-index: 99999;
            width: 44px;
            height: 44px;
            background: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(.34, 1.56, .64, 1);
            box-shadow: 0 4px 18px rgba(23, 92, 221, 0.38);
        }

        .scroll-top.active {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            background: color-mix(in srgb, var(--accent-color), #000 15%);
            color: #fff;
            transform: translateY(-3px);
        }

        /* ===================== KEYFRAMES ===================== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-24px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes pulseRing {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.35);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }

        @keyframes shimmerText {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        /* ===================== WORKSHOP BANNER ===================== */
        .workshop-banner {
            background: linear-gradient(100deg, #0d1f4a 0%, #175cdd 60%, #2563eb 100%);
            padding: 0;
            position: relative;
            overflow: hidden;
            border-bottom: 3px solid rgba(255, 255, 255, 0.08);
        }

        .workshop-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Decorative glow blob */
        .workshop-banner::after {
            content: '';
            position: absolute;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(96, 165, 250, 0.18) 0%, transparent 70%);
            right: -80px;
            top: -120px;
            pointer-events: none;
        }

        .workshop-banner .wb-inner {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 22px 0;
            flex-wrap: wrap;
        }

        .workshop-banner .wb-left {
            display: flex;
            align-items: center;
            gap: 18px;
            animation: fadeInLeft .6s ease both;
        }

        .workshop-banner .wb-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.14);
            border: 1.5px solid rgba(255, 255, 255, 0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #ffd96a;
            flex-shrink: 0;
            backdrop-filter: blur(6px);
            animation: pulseRing 2.5s ease infinite;
        }

        .workshop-banner .wb-text .wb-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #a8c4ff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .workshop-banner .wb-text h3 {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            margin: 0 0 3px;
            line-height: 1.25;
            font-family: var(--heading-font);
        }

        .workshop-banner .wb-text h3 em {
            font-style: normal;
            background: linear-gradient(90deg, #ffd96a, #ffb020, #ffd96a);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmerText 2.5s linear infinite;
        }

        .workshop-banner .wb-text p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.68);
            margin: 0;
            line-height: 1.5;
        }

        .workshop-banner .wb-right {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
            animation: fadeInUp .6s .15s ease both;
        }

        .workshop-banner .wb-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 10px;
            padding: 10px 16px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            font-weight: 600;
            backdrop-filter: blur(6px);
        }

        .workshop-banner .wb-badge i {
            color: #ffd96a;
            font-size: 15px;
        }

        .workshop-banner .btn-workshop {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: #ffd96a;
            color: #0d1f4a;
            padding: 13px 28px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 14px;
            transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
            box-shadow: 0 5px 18px rgba(255, 217, 106, 0.4);
            white-space: nowrap;
            text-decoration: none;
        }

        .workshop-banner .btn-workshop:hover {
            background: #ffca28;
            color: #0d1f4a;
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 10px 28px rgba(255, 217, 106, 0.55);
            gap: 13px;
        }

        .workshop-banner .btn-workshop i {
            font-size: 13px;
            transition: transform .3s;
        }

        .workshop-banner .btn-workshop:hover i {
            transform: translateX(3px);
        }

        @media (max-width: 768px) {
            .workshop-banner .wb-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
                padding: 18px 0;
            }

            .workshop-banner .wb-right {
                width: 100%;
                justify-content: space-between;
            }

            .workshop-banner .wb-badge {
                display: none;
            }

            .workshop-banner .btn-workshop {
                width: 100%;
                justify-content: center;
            }
        }

        /* ===================== HEADER ===================== */
        .header {
            background-color: var(--background-color);
            padding: 0;
            transition: all 0.5s;
            z-index: 997;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        }

        .header.scrolled {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12);
        }

        .header .topbar {
            background-color: var(--accent-color);
            color: #fff;
            padding: 8px 0;
            font-size: 13px;
        }

        .header .topbar a {
            color: rgba(255, 255, 255, 0.85);
        }

        .header .topbar a:hover {
            color: #fff;
        }

        .header .branding {
            padding: 14px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header .logo span {
            font-family: var(--heading-font);
            font-size: 22px;
            font-weight: 700;
            color: var(--heading-color);
        }

        .header .logo span em {
            color: var(--accent-color);
            font-style: normal;
        }

        /* ===================== PAGE TITLE ===================== */
        .page-title {
            padding: 185px 0 55px;
            text-align: center;
            position: relative;
            background: linear-gradient(135deg, #0d1f4a 0%, #175cdd 100%);
            overflow: hidden;
        }

        .page-title::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .page-title .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #fff;
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
            position: relative;
        }

        .page-title h1 {
            font-size: 50px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 16px;
            position: relative;
            line-height: 1.15;
        }

        .page-title h1 em {
            color: #ffd96a;
            font-style: normal;
        }

        .page-title p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 17px;
            max-width: 560px;
            margin: 0 auto 28px;
            line-height: 1.7;
            position: relative;
        }

        .page-title .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            justify-content: center;
            position: relative;
        }

        .page-title .breadcrumb-item {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }

        .page-title .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.95);
            font-weight: 600;
        }

        .page-title .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.4);
        }

        .page-title .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.7);
        }

        .page-title .breadcrumb-item a:hover {
            color: #fff;
        }

        /* ===================== SECTIONS ===================== */
        .section {
            padding: 80px 0;
        }

        .section-alt {
            background-color: color-mix(in srgb, var(--accent-color), transparent 96%);
        }

        .section-title {
            text-align: center;
            padding-bottom: 50px;
            position: relative;
        }

        .section-title h2 {
            font-size: 36px;
            font-weight: 800;
            position: relative;
            padding-bottom: 20px;
            margin-bottom: 15px;
        }

        .section-title p {
            color: color-mix(in srgb, var(--default-color), transparent 25%);
            max-width: 680px;
            margin: 0 auto;
            font-size: 16px;
            line-height: 1.7;
        }

        /* ===================== WHY JOIN CARDS ===================== */
        .why-join .reason-card {
            background: #fff;
            border-radius: 20px;
            padding: 36px 28px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.06);
            transition: 0.35s;
            height: 100%;
            border-bottom: 3px solid transparent;
            position: relative;
            overflow: hidden;
            animation: fadeInUp .5s ease both;
        }

        .why-join .reason-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-color), color-mix(in srgb, var(--accent-color), #7eb8ff 50%));
            transform: scaleX(0);
            transform-origin: left;
            transition: 0.4s;
        }

        .why-join .reason-card:hover::before {
            transform: scaleX(1);
        }

        .why-join .reason-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(23, 92, 221, 0.13);
        }

        .why-join .reason-card .icon {
            width: 68px;
            height: 68px;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: var(--accent-color);
            margin-bottom: 22px;
            transition: 0.3s;
        }

        .why-join .reason-card:hover .icon {
            background: var(--accent-color);
            color: #fff;
        }

        .why-join .reason-card h4 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .why-join .reason-card p {
            font-size: 14px;
            line-height: 1.75;
            color: color-mix(in srgb, var(--default-color), transparent 15%);
            margin: 0;
        }

        /* ===================== ROLES ===================== */
        .roles .role-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            background: #fff;
            border-radius: 16px;
            padding: 26px 24px;
            box-shadow: 0 3px 18px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
            margin-bottom: 20px;
        }

        .roles .role-item:hover {
            transform: translateX(6px);
            box-shadow: 0 8px 30px rgba(23, 92, 221, 0.1);
        }

        .roles .role-item:last-child {
            margin-bottom: 0;
        }

        .roles .role-item .role-icon {
            width: 54px;
            height: 54px;
            flex-shrink: 0;
            background: var(--accent-color);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
        }

        .roles .role-item h5 {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .roles .role-item p {
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            margin: 0;
            line-height: 1.65;
        }

        .roles .role-item .badge-role {
            display: inline-block;
            background: color-mix(in srgb, var(--accent-color), transparent 88%);
            color: var(--accent-color);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===================== STEPS ===================== */
        .steps-section .step-card {
            text-align: center;
            padding: 10px 20px;
            position: relative;
        }

        .steps-section .step-card .step-num {
            width: 60px;
            height: 60px;
            background: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 900;
            color: #fff;
            margin: 0 auto 18px;
            font-family: var(--heading-font);
            box-shadow: 0 6px 20px rgba(23, 92, 221, 0.35);
            position: relative;
            z-index: 1;
        }

        .steps-section .step-card h5 {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .steps-section .step-card p {
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            margin: 0;
            line-height: 1.6;
        }

        .steps-section .connector {
            flex: 1;
            height: 2px;
            background: color-mix(in srgb, var(--accent-color), transparent 70%);
            margin-top: -32px;
            position: relative;
            top: -35px;
        }

        /* ===================== SCHOOL PARTNERSHIP SLIDER ===================== */
        .school-partners {
            padding: 70px 0 80px;
            background: #f4f8ff;
            overflow: hidden;
        }

        .school-partners .section-title {
            padding-bottom: 40px;
        }

        .school-partners .section-title h2 {
            font-size: 34px;
        }

        .school-partners .section-title .partner-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
            font-size: 11px;
            font-weight: 800;
            padding: 5px 16px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 16px;
            border-left: 3px solid var(--accent-color);
        }

        /* Marquee track */
        .partners-marquee-wrap {
            position: relative;
            overflow: hidden;
        }

        /* Fade edges */
        .partners-marquee-wrap::before,
        .partners-marquee-wrap::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100px;
            z-index: 2;
            pointer-events: none;
        }

        .partners-marquee-wrap::before {
            left: 0;
            background: linear-gradient(to right, #f4f8ff, transparent);
        }

        .partners-marquee-wrap::after {
            right: 0;
            background: linear-gradient(to left, #f4f8ff, transparent);
        }

        .partners-marquee {
            display: flex;
            gap: 20px;
            animation: marquee 30s linear infinite;
            width: max-content;
        }

        .partners-marquee:hover {
            animation-play-state: paused;
        }

        /* Logo card — full image style */
        .partner-logo-card {
            background: #fff;
            border: 1.5px solid #e0e8f5;
            border-radius: 16px;
            overflow: hidden;
            width: 200px;
            height: 130px;
            flex-shrink: 0;
            transition: border-color .25s, box-shadow .25s, transform .25s;
            cursor: default;
            position: relative;
        }

        .partner-logo-card:hover {
            border-color: var(--accent-color);
            box-shadow: 0 8px 26px rgba(23, 92, 221, 0.14);
            transform: translateY(-5px);
        }

        /* Full-size image fills the card */
        .partner-logo-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            filter: grayscale(20%);
            transition: filter .3s, transform .4s;
        }

        .partner-logo-card:hover img {
            filter: grayscale(0%);
            transform: scale(1.05);
        }

        /* School name overlay at bottom */
        .partner-logo-card .ph-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(13, 31, 74, 0.82), transparent);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            text-align: center;
            padding: 14px 8px 8px;
            line-height: 1.3;
            letter-spacing: 0.2px;
        }

        /* Stats row below slider */
        .partners-stats {
            display: flex;
            justify-content: center;
            gap: 48px;
            margin-top: 48px;
            flex-wrap: wrap;
        }

        .partners-stats .ps-item {
            text-align: center;
        }

        .partners-stats .ps-item .ps-num {
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--accent-color);
            font-family: var(--heading-font);
            display: block;
            line-height: 1;
        }

        .partners-stats .ps-item .ps-lbl {
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 30%);
            margin-top: 5px;
            display: block;
            font-weight: 500;
        }

        /* ===================== PARTNER CATEGORY TABS ===================== */
        .partner-cat-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin: 18px 0 28px;
        }

        .pcat-btn {
            padding: 7px 22px;
            border-radius: 50px;
            border: 2px solid var(--accent-color);
            background: transparent;
            color: var(--accent-color);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.25s, color 0.25s;
        }

        .pcat-btn:hover,
        .pcat-btn.active {
            background: var(--accent-color);
            color: #fff;
        }

        /* ===================== SCHOOL CATEGORY GRID ===================== */
        .school-cat-section {
            padding: 70px 0 50px;
            background: #f8faff;
        }

        .school-cat-section .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: color-mix(in srgb, var(--accent-color), transparent 88%);
            color: var(--accent-color);
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .5px;
            margin-bottom: 14px;
        }

        .school-cat-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin: 28px 0 36px;
        }

        .scat-btn {
            display: inline-block;
            padding: 9px 26px;
            border-radius: 50px;
            border: 2px solid var(--accent-color);
            background: transparent;
            color: var(--accent-color);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.25s, color 0.25s, transform 0.2s;
        }

        .scat-btn:hover {
            color: var(--accent-color);
            transform: translateY(-2px);
        }

        .scat-btn.active {
            background: var(--accent-color);
            color: #fff;
        }

        .scat-btn.active:hover { color: #fff; }

        .school-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(175px, 1fr));
            gap: 20px;
        }

        .school-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0,0,0,.07);
            transition: transform 0.25s, box-shadow 0.25s;
            text-align: center;
            cursor: default;
        }

        .school-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 32px rgba(0,0,0,.12);
        }

        .school-card .sc-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            display: block;
        }

        .school-card .sc-body {
            padding: 12px 10px 14px;
        }

        .school-card .sc-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--heading-color);
            line-height: 1.4;
        }

        .school-card .sc-cat-badge {
            display: inline-block;
            margin-top: 6px;
            font-size: 10px;
            font-weight: 600;
            background: color-mix(in srgb, var(--accent-color), transparent 88%);
            color: var(--accent-color);
            border-radius: 50px;
            padding: 2px 10px;
        }

        @media (max-width: 576px) {
            .school-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
        }

        /* ===================== VOLUNTEER FORM ===================== */
        .volunteer-form-section .form-wrapper {
            background: #fff;
            border-radius: 24px;
            padding: 50px 50px;
            box-shadow: 0 15px 60px rgba(0, 0, 0, 0.09);
        }

        .volunteer-form-section .form-wrapper h3 {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .volunteer-form-section .form-wrapper .form-subtitle {
            font-size: 15px;
            color: color-mix(in srgb, var(--default-color), transparent 25%);
            margin-bottom: 36px;
            line-height: 1.6;
        }

        .volunteer-form-section .form-control,
        .volunteer-form-section .form-select {
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 78%);
            border-radius: 12px;
            padding: 13px 16px;
            font-size: 14px;
            color: var(--default-color);
            transition: 0.3s;
            background: #fff;
        }

        .volunteer-form-section .form-control:focus,
        .volunteer-form-section .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 4px color-mix(in srgb, var(--accent-color), transparent 88%);
            outline: none;
        }

        .volunteer-form-section .form-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 6px;
        }

        .volunteer-form-section .form-label .req {
            color: var(--accent-color);
        }

        .volunteer-form-section .role-checkbox-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .volunteer-form-section .role-check-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: color-mix(in srgb, var(--accent-color), transparent 95%);
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 80%);
            border-radius: 10px;
            padding: 12px 14px;
            cursor: pointer;
            transition: 0.25s;
        }

        .volunteer-form-section .role-check-item:has(input:checked) {
            background: color-mix(in srgb, var(--accent-color), transparent 88%);
            border-color: var(--accent-color);
        }

        .volunteer-form-section .role-check-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            accent-color: var(--accent-color);
        }

        .volunteer-form-section .role-check-item span {
            font-size: 13px;
            font-weight: 600;
            color: var(--heading-color);
        }

        .volunteer-form-section .divider {
            border: none;
            border-top: 1.5px dashed color-mix(in srgb, var(--accent-color), transparent 75%);
            margin: 30px 0;
        }

        .volunteer-form-section .btn-submit {
            background: var(--accent-color);
            color: #fff;
            padding: 15px 0;
            border-radius: 14px;
            font-weight: 800;
            font-size: 16px;
            border: none;
            width: 100%;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 8px 25px rgba(23, 92, 221, 0.35);
            letter-spacing: 0.3px;
        }

        .volunteer-form-section .btn-submit:hover {
            background: var(--heading-color);
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(17, 35, 68, 0.3);
        }

        .volunteer-form-section .success-msg {
            display: none;
            background: color-mix(in srgb, #22c55e, transparent 88%);
            border: 1.5px solid color-mix(in srgb, #22c55e, transparent 55%);
            border-radius: 14px;
            padding: 22px 26px;
            text-align: center;
            margin-top: 20px;
        }

        .volunteer-form-section .success-msg i {
            font-size: 40px;
            color: #16a34a;
            display: block;
            margin-bottom: 10px;
        }

        .volunteer-form-section .success-msg h5 {
            font-size: 18px;
            font-weight: 800;
            color: #15803d;
            margin-bottom: 6px;
        }

        .volunteer-form-section .success-msg p {
            font-size: 14px;
            color: #166534;
            margin: 0;
        }

        /* SIDEBAR */
        .volunteer-form-section .info-sidebar .info-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px 28px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
            margin-bottom: 24px;
        }

        .volunteer-form-section .info-sidebar .info-card h5 {
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .volunteer-form-section .info-sidebar .info-card h5 i {
            color: var(--accent-color);
        }

        .volunteer-form-section .info-sidebar .info-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .volunteer-form-section .info-sidebar .info-card ul li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13.5px;
            color: var(--default-color);
            padding: 8px 0;
            border-bottom: 1px solid color-mix(in srgb, var(--accent-color), transparent 90%);
            line-height: 1.5;
        }

        .volunteer-form-section .info-sidebar .info-card ul li:last-child {
            border-bottom: none;
        }

        .volunteer-form-section .info-sidebar .info-card ul li i {
            color: var(--accent-color);
            font-size: 15px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .volunteer-form-section .info-sidebar .contact-card {
            background: linear-gradient(135deg, var(--heading-color), color-mix(in srgb, var(--heading-color), #1a3a7c 50%));
            border-radius: 20px;
            padding: 30px 28px;
            color: #fff;
        }

        .volunteer-form-section .info-sidebar .contact-card h5 {
            color: #fff;
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .volunteer-form-section .info-sidebar .contact-card p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            line-height: 1.65;
            margin-bottom: 20px;
        }

        .volunteer-form-section .info-sidebar .contact-card .btn-wa {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: #25d366;
            color: #fff;
            padding: 13px 20px;
            border-radius: 30px;
            font-weight: 800;
            font-size: 14px;
            transition: 0.3s;
        }

        .volunteer-form-section .info-sidebar .contact-card .btn-wa:hover {
            background: #1da851;
            color: #fff;
            transform: translateY(-2px);
        }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 34px;
            }

            .section {
                padding: 60px 0;
            }

            .volunteer-form-section .form-wrapper {
                padding: 30px 22px;
            }

            .volunteer-form-section .role-checkbox-group {
                grid-template-columns: 1fr;
            }

            .partners-stats {
                gap: 28px;
            }
        }
    </style>
    <main class="main">
        <div style="margin-top: 185px;"></div>

        {{-- =================== JAIPUR WORKSHOP BANNER =================== --}}


        {{-- =================== WHY JOIN =================== --}}
        <section class="why-join section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Why Join Threat Expert?</h2>
                    <p>We're not just a school — we're a movement. Joining us means directly contributing to the growth and
                        confidence of thousands of children across India.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="reason-card">
                            <div class="icon"><i class="bi bi-rocket-takeoff"></i></div>
                            <h4>Make Real Impact</h4>
                            <p>Directly influence the lives of 1000+ children. Your skills and energy help kids build
                                confidence, creativity, and character that lasts a lifetime.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="reason-card">
                            <div class="icon"><i class="bi bi-mortarboard"></i></div>
                            <h4>Grow Your Skills</h4>
                            <p>Work alongside industry professionals, child psychologists, and filmmakers. Gain hands-on
                                experience in education, media, events, and more.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="reason-card">
                            <div class="icon"><i class="bi bi-people"></i></div>
                            <h4>Build Your Network</h4>
                            <p>Connect with 25+ top educational institutes, Bollywood casting agencies, and MNCs that Act to
                                Action is proudly associated with.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="reason-card">
                            <div class="icon"><i class="bi bi-award"></i></div>
                            <h4>Certificate & Recognition</h4>
                            <p>Receive an official Threat Expert volunteer certificate, letter of recommendation, and
                                recognition in our nationally appreciated events and programmes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- =================== OPEN ROLES =================== --}}
        <section class="roles section section-alt">
            <div class="container">
                <div class="row gy-5 align-items-start">
                    <div class="col-lg-5" data-aos="fade-right">
                        <div class="section-title text-start pb-4">
                            <h2 class="text-start">Open Roles &amp; Opportunities</h2>
                        </div>
                        <p style="font-size:15px;line-height:1.8;margin-bottom:18px;">Whether you're a creative
                            professional, a student, a teacher, or simply someone who believes in the power of children —
                            there's a place for you at Threat Expert.</p>
                        <p style="font-size:15px;line-height:1.8;margin-bottom:28px;">We're actively looking for passionate
                            individuals across multiple roles. Every contribution, big or small, helps us build a brighter
                            future for the children of India.</p>
                        <div style="background:var(--accent-color);border-radius:16px;padding:22px 24px;color:#fff;">
                            <p
                                style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;opacity:0.8;margin-bottom:8px;">
                                Currently Active In</p>
                            <p style="font-size:16px;font-weight:800;margin:0;color:#fff;">Jaipur, Rajasthan &amp; Online
                            </p>
                            <p style="font-size:13px;opacity:0.8;margin:5px 0 0;">Expanding to more cities soon</p>
                        </div>
                    </div>
                    <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                        <div class="role-item">
                            <div class="role-icon"><i class="bi bi-camera-video"></i></div>
                            <div>
                                <div class="badge-role">Creative</div>
                                <h5>Acting Trainer / Theatre Facilitator</h5>
                                <p>Guide children in screen acting, stage performance, monologue delivery, and camera
                                    confidence. Passion for performing arts required.</p>
                            </div>
                        </div>
                        <div class="role-item">
                            <div class="role-icon"><i class="bi bi-camera"></i></div>
                            <div>
                                <div class="badge-role">Media</div>
                                <h5>Photographer / Videographer</h5>
                                <p>Capture our events, workshops, graduation ceremonies, and student performances. Help
                                    document the Threat Expert journey.</p>
                            </div>
                        </div>
                        <div class="role-item">
                            <div class="role-icon"><i class="bi bi-megaphone"></i></div>
                            <div>
                                <div class="badge-role">Marketing</div>
                                <h5>Social Media &amp; PR Volunteer</h5>
                                <p>Create content, manage social channels, assist in outreach events, and help spread the
                                    word about Threat Expert's work across India.</p>
                            </div>
                        </div>
                        <div class="role-item">
                            <div class="role-icon"><i class="bi bi-calendar-event"></i></div>
                            <div>
                                <div class="badge-role">Events</div>
                                <h5>Event Coordinator / Volunteer</h5>
                                <p>Support our exhibitions, theatre shows, fashion shows, film festivals, Cyber AI Threat Conclave programs, and
                                    graduation ceremonies as an on-ground team member.</p>
                            </div>
                        </div>
                        <div class="role-item">
                            <div class="role-icon"><i class="bi bi-heart-pulse"></i></div>
                            <div>
                                <div class="badge-role">Wellbeing</div>
                                <h5>Child Development Specialist</h5>
                                <p>Child psychologists, neurotherapists, or counsellors who want to contribute to our
                                    neuro-psychological curriculum and student wellbeing programmes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- =================== HOW IT WORKS (STEPS) =================== --}}
        <section class="steps-section section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>How It Works</h2>
                    <p>Joining our team is simple. Fill in the form, and our team will take care of the rest.</p>
                </div>
                <div class="row justify-content-center align-items-center gy-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="step-card">
                            <div class="step-num">1</div>
                            <h5>Fill the Form</h5>
                            <p>Submit your details and area of interest below</p>
                        </div>
                    </div>
                    <div class="d-none d-lg-block col-lg-1">
                        <div class="connector"></div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="step-card">
                            <div class="step-num">2</div>
                            <h5>We Review</h5>
                            <p>Our team reviews your application within 2–3 days</p>
                        </div>
                    </div>
                    <div class="d-none d-lg-block col-lg-1">
                        <div class="connector"></div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="step-card">
                            <div class="step-num">3</div>
                            <h5>We Contact You</h5>
                            <p>Our team reaches out via WhatsApp or phone</p>
                        </div>
                    </div>
                    <div class="d-none d-lg-block col-lg-1">
                        <div class="connector"></div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="step-card">
                            <div class="step-num">4</div>
                            <h5>Welcome Aboard!</h5>
                            <p>Get onboarded and start making a difference</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- =================== SCHOOLS BY CATEGORY GRID =================== --}}
        <section class="school-cat-section" data-aos="fade-up">
            <div class="container">
                <div class="text-center mb-2">
                    <span class="school-cat-section section-badge">
                        <i class="bi bi-buildings"></i> Our School Network
                    </span>
                    <h2 class="fw-bold mt-1" style="color:var(--heading-color)">Schools We Work With</h2>
                    <p class="text-muted mx-auto" style="max-width:560px;font-size:.95rem;">
                        Browse our partner schools by category — every school represents a community we proudly serve.
                    </p>
                </div>

                @if($schoolsByCategory)
                    @php
                        $totalSchools = collect($schoolsByCategory)->flatMap(fn($c) => $c['schools']->all())->count();
                    @endphp

                    {{-- Category tabs --}}
                    <div class="school-cat-tabs" data-aos="fade-up" data-aos-delay="60">
                        @foreach($schoolsByCategory as $slug => $cat)
                            @if($cat['schools']->count() > 0)
                                <span class="scat-btn active">
                                    {{ $cat['label'] }}
                                    <span style="font-size:11px;opacity:.75;margin-left:4px;">({{ $cat['schools']->count() }})</span>
                                </span>
                            @endif
                        @endforeach
                    </div>

                    <div class="school-grid" data-aos="fade-up" data-aos-delay="120">
                        @forelse($schoolsByCategory as $slug => $cat)
                            @foreach($cat['schools'] as $school)
                                <div class="school-card">
                                    @if($school->logo_path)
                                        <img class="sc-img" src="{{ $school->logo_url }}"
                                             alt="{{ $school->name }}" loading="lazy"
                                             onerror="this.src='https://placehold.co/400x240?text={{ urlencode($school->name) }}'">
                                    @else
                                        <div class="sc-img d-flex align-items-center justify-content-center"
                                             style="background:color-mix(in srgb,var(--accent-color),transparent 90%);">
                                            <i class="bi bi-building" style="font-size:2.5rem;color:var(--accent-color);opacity:.5;"></i>
                                        </div>
                                    @endif
                                    <div class="sc-body">
                                        <div class="sc-name">{{ $school->name }}</div>
                                        <span class="sc-cat-badge">{{ $cat['label'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @empty
                            <div class="text-center text-muted py-5 col-span-full" style="font-size:.9rem;grid-column:1/-1;">
                                No schools found in this category yet.
                            </div>
                        @endforelse
                    </div>
                @endif
            </div>
        </section>

        {{-- =================== SCHOOL PARTNERSHIPS (marquee) =================== --}}
        <section class="school-partners" data-aos="fade-up">
            @php
                $allSchools = collect($schoolsByCategory)->flatMap(fn($c) => $c['schools']->all());
            @endphp

            <div class="container">
                <div class="section-title">
                    <div class="partner-badge">
                        <i class="bi bi-building"></i> School Partnerships
                    </div>
                    <h2>Trusted by {{ $allSchools->count() > 0 ? $allSchools->count() . '+' : '25+' }} Schools Across India</h2>
                    <p>Threat Expert proudly collaborates with leading schools, educational institutes, and child
                        development organisations to nurture every child's potential.</p>
                </div>

                {{-- Category filter tabs — shown only when 2+ categories have schools --}}
                @if(count($schoolsByCategory) > 1)
                    <div class="partner-cat-tabs" data-aos="fade-up" data-aos-delay="80">
                        <button class="pcat-btn active" data-cat="all">All</button>
                        @foreach($schoolsByCategory as $slug => $cat)
                            @if($cat['schools']->count() > 0)
                                <button class="pcat-btn" data-cat="{{ $slug }}">{{ $cat['label'] }}</button>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Auto-scrolling marquee tracks --}}
            @if($allSchools->count())
                {{-- ALL track (visible by default) --}}
                <div class="partners-marquee-wrap" data-cat-wrap="all">
                    <div class="partners-marquee">
                        @foreach($allSchools as $school)
                            <div class="partner-logo-card">
                                <img src="{{ $school->logo_url }}" alt="{{ $school->name }}"
                                    loading="lazy" onerror="this.style.display='none'">
                                <div class="ph-name">{{ $school->name }}</div>
                            </div>
                        @endforeach
                        {{-- duplicate for seamless loop --}}
                        @foreach($allSchools as $school)
                            <div class="partner-logo-card" aria-hidden="true">
                                <img src="{{ $school->logo_url }}" alt="{{ $school->name }}"
                                    loading="lazy" onerror="this.style.display='none'">
                                <div class="ph-name">{{ $school->name }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Per-category tracks (hidden by default) --}}
                @foreach($schoolsByCategory as $slug => $cat)
                    @if($cat['schools']->count() > 0)
                        <div class="partners-marquee-wrap" data-cat-wrap="{{ $slug }}" style="display:none;">
                            <div class="partners-marquee">
                                @foreach($cat['schools'] as $school)
                                    <div class="partner-logo-card">
                                        <img src="{{ $school->logo_url }}" alt="{{ $school->name }}"
                                            loading="lazy" onerror="this.style.display='none'">
                                        <div class="ph-name">{{ $school->name }}</div>
                                    </div>
                                @endforeach
                                @foreach($cat['schools'] as $school)
                                    <div class="partner-logo-card" aria-hidden="true">
                                        <img src="{{ $school->logo_url }}" alt="{{ $school->name }}"
                                            loading="lazy" onerror="this.style.display='none'">
                                        <div class="ph-name">{{ $school->name }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="container text-center py-4" style="color:#999;font-size:.9rem;">
                    School partners coming soon.
                </div>
            @endif

            {{-- Partner stats --}}
            <div class="container">
                <div class="partners-stats" data-aos="fade-up" data-aos-delay="150">
                    <div class="ps-item">
                        <span class="ps-num">{{ $allSchools->count() > 0 ? $allSchools->count() . '+' : '25+' }}</span>
                        <span class="ps-lbl">Partner Schools</span>
                    </div>
                    <div class="ps-item">
                        <span class="ps-num">1000+</span>
                        <span class="ps-lbl">Children Reached</span>
                    </div>
                    <div class="ps-item">
                        <span class="ps-num">6+</span>
                        <span class="ps-lbl">Cities Active</span>
                    </div>
                    <div class="ps-item">
                        <span class="ps-num">5★</span>
                        <span class="ps-lbl">Avg. School Rating</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- Category-tab switching JS --}}
        <script>
        (function () {
            const btns = document.querySelectorAll('.pcat-btn');
            const wraps = document.querySelectorAll('[data-cat-wrap]');
            if (!btns.length) return;

            btns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const cat = this.dataset.cat;
                    btns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    wraps.forEach(w => {
                        w.style.display = (w.dataset.catWrap === cat) ? '' : 'none';
                    });
                });
            });
        })();
        </script>


        {{-- =================== Workshop Banner (replaces Team Voices) =================== --}}
        <section class="container">
            <div class="workshop-banner">
                <div class="container">
                    <div class="wb-inner">
                        <div class="wb-left">
                            <div class="wb-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="wb-text">
                                <div class="wb-label">
                                    <i class="bi bi-lightning-charge-fill"></i>
                                    Now Live in Jaipur
                                </div>
                                <h3>Top Jaipur <em>Workshops</em> — Find Yours!</h3>
                                <p>Acting, theatre, public speaking & confidence-building workshops for kids near you.</p>
                            </div>
                        </div>
                        <div class="wb-right">
                            <div class="wb-badge">
                                <i class="bi bi-calendar-check-fill"></i>
                                <span>New batches starting soon</span>
                            </div>
                            <a href="#" class="btn-workshop">
                                Browse Workshops <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
