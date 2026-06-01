@extends('frontend.course.layout')
@section('content')
    <style>
        /* ─── NEWS / IN THE NEWS ─── */
        .news-section {
            padding: 60px 0;
            background: #f4f8ff;
        }

        .news-label {
            font-family: var(--nav-font);
            font-size: 12px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Scrolling marquee logos */
        .logo-marquee-wrap {
            overflow: hidden;
            position: relative;
        }

        .logo-marquee-wrap::before,
        .logo-marquee-wrap::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 80px;
            z-index: 2;
        }

        .logo-marquee-wrap::before {
            left: 0;
            background: linear-gradient(to right, #f4f8ff, transparent);
        }

        .logo-marquee-wrap::after {
            right: 0;
            background: linear-gradient(to left, #f4f8ff, transparent);
        }

        .logo-marquee {
            display: flex;
            gap: 16px;
            animation: marquee 28s linear infinite;
            width: max-content;
        }

        .logo-marquee:hover {
            animation-play-state: paused;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .logo-pill {
            display: flex;
            align-items: center;
            gap: 9px;
            background: #fff;
            border: 1.5px solid #e0e8f5;
            border-radius: 10px;
            padding: 11px 22px;
            white-space: nowrap;
            font-family: var(--heading-font);
            font-size: 13px;
            font-weight: 700;
            color: var(--heading-color);
            transition: border-color .2s, box-shadow .2s;
        }

        .logo-pill:hover {
            border-color: var(--accent-color);
            box-shadow: 0 4px 18px rgba(23, 92, 221, .1);
        }

        .logo-pill i {
            font-size: 15px;
            color: var(--accent-color);
        }

        /* News quotes slider */
        .news-quotes {
            margin-top: 42px;
        }

        .quote-card {
            background: #fff;
            border: 1.5px solid #e0e8f5;
            border-radius: 16px;
            padding: 28px 30px;
            position: relative;
            height: 100%;
        }

        .quote-source {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--accent-color);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 12px;
            margin-bottom: 14px;
        }

        .quote-card blockquote {
            font-size: 14px;
            line-height: 1.65;
            color: var(--default-color);
            font-style: italic;
            margin: 0;
        }

        .quote-big {
            position: absolute;
            top: 14px;
            right: 18px;
            font-size: 40px;
            color: #e8edf5;
            line-height: 1;
        }

        /* ─── FOR SCHOOLS / BUSINESS ─── */
        .business-section {

            padding: 80px 0;
            background: linear-gradient(135deg, var(--heading-color) 0%, #112344 60%, #2b539e 100%);
            position: relative;
            overflow: hidden;
        }

        .business-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1543269664-7eef42226a21?w=1400&q=50') center/cover;
            opacity: .06;
        }

        .biz-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #b8d4ff;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .business-section h2 {
            font-size: 38px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 14px;
        }

        .business-section p {
            font-size: 16px;
            color: rgba(255, 255, 255, .75);
            line-height: 1.7;
            margin-bottom: 30px;
            max-width: 540px;
        }

        .biz-feature-row {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .biz-feature-row .biz-ico {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #93c5fd;
            flex-shrink: 0;
        }

        .biz-feature-row h6 {
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .biz-feature-row p {
            color: rgba(255, 255, 255, .65);
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
        }

        .btn-white-solid {
            background: #fff;
            color: var(--accent-color);
            padding: 13px 30px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            font-family: var(--heading-font);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background .2s, transform .15s;
            cursor: pointer;
        }

        .btn-white-solid:hover {
            background: #f0f5ff;
            transform: translateY(-2px);
        }

        .biz-visual {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .biz-stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .biz-stat-card {
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 16px;
            padding: 24px 20px;
            text-align: center;
            backdrop-filter: blur(4px);
        }

        .biz-stat-card .bsn {
            font-family: var(--heading-font);
            font-size: 34px;
            font-weight: 900;
            color: #fff;
        }

        .biz-stat-card .bsn span {
            color: #60a5fa;
        }

        .biz-stat-card .bsl {
            font-size: 12px;
            color: rgba(255, 255, 255, .6);
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-top: 4px;
        }

        /* ===================== CSS VARIABLES ===================== */
        /* ===================== GLOBAL ===================== */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            color: var(--default-color);
            background-color: var(--background-color);
            font-family: var(--default-font);
        }

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
            width: 40px;
            height: 40px;
            background: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s;
            box-shadow: 0 4px 15px rgba(23, 92, 221, 0.35);
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

        .header .topbar .separator {
            margin: 0 10px;
            opacity: 0.5;
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

        .header .logo img {
            max-height: 40px;
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



        .page-title h1 {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 10px;
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
            color: var(--default-color);
        }

        .page-title .breadcrumb-item.active {
            color: var(--accent-color);
            font-weight: 600;
        }

        .page-title .breadcrumb-item+.breadcrumb-item::before {
            color: var(--accent-color);
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

        /* ===================== ABOUT SECTION ===================== */
        .about .about-img {
            position: relative;
        }

        .about .about-img img {
            border-radius: 20px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        .about .about-img .experience-badge {
            position: absolute;
            bottom: -20px;
            right: -20px;
            background: var(--accent-color);
            color: #fff;
            padding: 20px 25px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(23, 92, 221, 0.4);
        }

        .about .about-img .experience-badge span {
            display: block;
            font-size: 42px;
            font-weight: 800;
            line-height: 1;
            font-family: var(--heading-font);
        }

        .about .about-img .experience-badge p {
            margin: 0;
            font-size: 13px;
            font-weight: 600;
            opacity: 0.9;
        }

        .about .about-content h3 {
            font-size: 30px;
            font-weight: 800;
            color: var(--heading-color);
            margin-bottom: 8px;
        }

        .about .about-content .subtitle {
            color: var(--accent-color);
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 15px;
        }

        .about .about-content p {
            line-height: 1.8;
            color: var(--default-color);
        }

        .about .about-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .about .about-stats .stat-item {
            background: color-mix(in srgb, var(--accent-color), transparent 94%);
            border-radius: 12px;
            padding: 20px;
            border-left: 4px solid var(--accent-color);
            transition: 0.3s;
        }

        .about .about-stats .stat-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(23, 92, 221, 0.15);
        }

        .about .about-stats .stat-item .num {
            font-size: 32px;
            font-weight: 800;
            color: var(--accent-color);
            font-family: var(--heading-font);
            line-height: 1;
        }

        .about .about-stats .stat-item p {
            margin: 4px 0 0;
            font-size: 13px;
            font-weight: 600;
            color: var(--heading-color);
        }

        .about .cta-btn {
            background: var(--accent-color);
            color: #fff;
            padding: 13px 32px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
            box-shadow: 0 6px 20px rgba(23, 92, 221, 0.35);
            margin-top: 10px;
        }

        .about .cta-btn:hover {
            background: color-mix(in srgb, var(--accent-color), #000 15%);
            color: #fff;
            transform: translateY(-2px);
        }

        /* ===================== VALUES ===================== */
        .values .value-card {
            background: var(--surface-color);
            border-radius: 16px;
            padding: 35px 30px;
            text-align: center;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
            transition: 0.3s;
            height: 100%;
            border-bottom: 3px solid transparent;
        }

        .values .value-card:hover {
            transform: translateY(-8px);
            border-bottom-color: var(--accent-color);
            box-shadow: 0 15px 40px rgba(23, 92, 221, 0.12);
        }

        .values .value-card .icon {
            width: 70px;
            height: 70px;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
            color: var(--accent-color);
            transition: 0.3s;
        }

        .values .value-card:hover .icon {
            background: var(--accent-color);
            color: #fff;
        }

        .values .value-card h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .values .value-card p {
            font-size: 14px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            line-height: 1.7;
            margin: 0;
        }

        /* ===================== CERTIFICATIONS ===================== */
        .certifications .cert-item {
            display: flex;
            align-items: center;
            gap: 20px;
            background: var(--surface-color);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
            margin-bottom: 20px;
        }

        .certifications .cert-item:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 30px rgba(23, 92, 221, 0.1);
        }

        .certifications .cert-item .cert-icon {
            width: 55px;
            height: 55px;
            flex-shrink: 0;
            background: var(--accent-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
        }

        .certifications .cert-item h5 {
            margin: 0 0 4px;
            font-size: 16px;
            font-weight: 700;
        }

        .certifications .cert-item p {
            margin: 0;
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 30%);
        }

        /* ===================== DOCTORS ===================== */
        .doctors .doctor-card {
            background: var(--surface-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
            height: 100%;
        }

        .doctors .doctor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(23, 92, 221, 0.15);
        }

        .doctors .doctor-card .img-wrap {
            position: relative;
            overflow: hidden;
        }

        .doctors .doctor-card .img-wrap img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            transition: 0.5s;
        }

        .doctors .doctor-card:hover .img-wrap img {
            transform: scale(1.05);
        }

        .doctors .doctor-card .img-wrap .social-overlay {
            position: absolute;
            bottom: -60px;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(23, 92, 221, 0.85), transparent);
            padding: 30px 20px 15px;
            display: flex;
            justify-content: center;
            gap: 10px;
            transition: 0.4s;
        }

        .doctors .doctor-card:hover .img-wrap .social-overlay {
            bottom: 0;
        }

        .doctors .doctor-card .img-wrap .social-overlay a {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            backdrop-filter: blur(4px);
            transition: 0.3s;
        }

        .doctors .doctor-card .img-wrap .social-overlay a:hover {
            background: #fff;
            color: var(--accent-color);
        }

        .doctors .doctor-card .info {
            padding: 20px;
            text-align: center;
        }

        .doctors .doctor-card .info h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .doctors .doctor-card .info .specialty {
            color: var(--accent-color);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .doctors .doctor-card .info .btn-appt {
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
            border: 1px solid color-mix(in srgb, var(--accent-color), transparent 60%);
            padding: 8px 22px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 700;
            transition: 0.3s;
        }

        .doctors .doctor-card .info .btn-appt:hover {
            background: var(--accent-color);
            color: #fff;
        }

        /* ===================== DEPARTMENTS ===================== */
        .departments .dept-card {
            background: var(--surface-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            transition: 0.3s;
            height: 100%;
        }

        .departments .dept-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(23, 92, 221, 0.13);
        }

        .departments .dept-card .img-wrap {
            position: relative;
            overflow: hidden;
        }

        .departments .dept-card .img-wrap img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: 0.5s;
        }

        .departments .dept-card:hover .img-wrap img {
            transform: scale(1.05);
        }

        .departments .dept-card .img-wrap .icon-overlay {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 50px;
            height: 50px;
            background: var(--accent-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
            box-shadow: 0 5px 15px rgba(23, 92, 221, 0.4);
        }

        .departments .dept-card .content {
            padding: 20px;
        }

        .departments .dept-card .content h4 {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .departments .dept-card .content p {
            font-size: 13px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            margin: 0;
            line-height: 1.6;
        }

        /* ===================== TESTIMONIALS ===================== */
        .testimonials {
            background: linear-gradient(135deg, var(--heading-color) 0%, color-mix(in srgb, var(--heading-color), #1a3a7c 60%) 100%);
            color: #fff;
        }

        .testimonials .section-title h2 {
            color: #fff;
        }

        .testimonials .section-title h2::before {
            background: rgba(255, 255, 255, 0.2);
        }

        .testimonials .section-title h2::after {
            background: #fff;
        }

        .testimonials .section-title p {
            color: rgba(255, 255, 255, 0.75);
        }

        .testimonials .swiper {
            padding-bottom: 50px;
        }

        .testimonials .testimonial-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 35px 30px;
            height: 100%;
            position: relative;
        }

        .testimonials .testimonial-card .quote-icon {
            position: absolute;
            top: 25px;
            right: 25px;
            font-size: 40px;
            color: rgba(255, 255, 255, 0.1);
            line-height: 1;
        }

        .testimonials .testimonial-card .stars {
            color: #ffc107;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .testimonials .testimonial-card p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 25px;
            font-style: italic;
        }

        .testimonials .testimonial-card .author {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .testimonials .testimonial-card .author img {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .testimonials .testimonial-card .author h5 {
            color: #fff;
            font-size: 16px;
            margin: 0 0 3px;
        }

        .testimonials .testimonial-card .author span {
            color: rgba(255, 255, 255, 0.6);
            font-size: 12px;
        }

        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.4);
            opacity: 1;
        }

        .swiper-pagination-bullet-active {
            background: #fff;
            width: 20px;
            border-radius: 4px;
        }

        /* ===================== FAQ ===================== */
        .faq .accordion-item {
            border: 1px solid color-mix(in srgb, var(--accent-color), transparent 80%);
            border-radius: 12px !important;
            overflow: hidden;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .faq .accordion-button {
            font-family: var(--heading-font);
            font-size: 16px;
            font-weight: 600;
            color: var(--heading-color);
            background: #fff;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .faq .accordion-button .faq-num {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
        }

        .faq .accordion-button:not(.collapsed) {
            color: var(--accent-color);
            background: color-mix(in srgb, var(--accent-color), transparent 96%);
            box-shadow: none;
        }

        .faq .accordion-button:not(.collapsed) .faq-num {
            background: var(--accent-color);
            color: #fff;
        }

        .faq .accordion-button::after {
            display: none;
        }

        .faq .accordion-button .toggle-icon {
            margin-left: auto;
            font-size: 18px;
            color: var(--accent-color);
            transition: 0.3s;
        }

        .faq .accordion-button.collapsed .toggle-icon::before {
            content: "\f4fe";
            font-family: "bootstrap-icons";
        }

        .faq .accordion-button .toggle-icon::before {
            content: "\f2ea";
            font-family: "bootstrap-icons";
        }

        .faq .accordion-body {
            padding: 20px 25px 20px 72px;
            color: var(--default-color);
            line-height: 1.8;
            background: #fff;
        }

        /* ===================== CONTACT / CTA ===================== */
        .cta-section {
            background: var(--accent-color);
            color: #fff;
            padding: 60px 0;
        }

        .cta-section h2 {
            color: #fff;
            font-size: 34px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .cta-section p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 16px;
            max-width: 500px;
        }

        .cta-section .btn-white {
            background: #fff;
            color: var(--accent-color);
            padding: 13px 32px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .cta-section .btn-white:hover {
            background: var(--heading-color);
            color: #fff;
            transform: translateY(-2px);
        }

        .cta-section .emergency-call {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 14px;
            padding: 18px 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .cta-section .emergency-call .icon {
            font-size: 32px;
        }

        .cta-section .emergency-call span {
            font-size: 12px;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-section .emergency-call strong {
            font-size: 22px;
            font-weight: 800;
            display: block;
        }

        /* ===================== GALLERY ===================== */
        .gallery .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .gallery .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: 0.5s;
        }

        .gallery .gallery-item:hover img {
            transform: scale(1.08);
        }

        .gallery .gallery-item .overlay {
            position: absolute;
            inset: 0;
            background: rgba(17, 35, 68, 0.7);
            opacity: 0;
            transition: 0.4s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .gallery .gallery-item:hover .overlay {
            opacity: 1;
        }

        .gallery .gallery-item .overlay a {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            backdrop-filter: blur(5px);
            transition: 0.3s;
        }

        .gallery .gallery-item .overlay a:hover {
            background: var(--accent-color);
        }

        /* ===================== CONTACT ===================== */
        .contact .info-item {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 30px;
        }

        .contact .info-item .icon-wrap {
            width: 50px;
            height: 50px;
            flex-shrink: 0;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--accent-color);
            transition: 0.3s;
        }

        .contact .info-item:hover .icon-wrap {
            background: var(--accent-color);
            color: #fff;
        }

        .contact .info-item h5 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .contact .info-item p {
            margin: 0;
            font-size: 14px;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
        }

        .contact .contact-form {
            background: var(--surface-color);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .contact .contact-form .form-control {
            border: 1px solid color-mix(in srgb, var(--accent-color), transparent 75%);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            transition: 0.3s;
        }

        .contact .contact-form .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent-color), transparent 85%);
        }

        .contact .contact-form .btn-submit {
            background: var(--accent-color);
            color: #fff;
            padding: 13px 35px;
            border-radius: 30px;
            font-weight: 700;
            border: none;
            transition: 0.3s;
            width: 100%;
        }

        .contact .contact-form .btn-submit:hover {
            background: color-mix(in srgb, var(--accent-color), #000 15%);
            transform: translateY(-2px);
        }

        /* ===================== FOOTER ===================== */




        /* ===================== UTILITIES ===================== */
        .badge-accent {
            background: var(--accent-color);
            color: #fff;
        }

        .text-accent {
            color: var(--accent-color);
        }

        @media (max-width: 768px) {
            .section {
                padding: 60px 0;
            }

            .about .about-img .experience-badge {
                right: 0;
                bottom: -10px;
            }

            .about .about-stats {
                grid-template-columns: 1fr 1fr;
            }

            .page-title h1 {
                font-size: 30px;
            }

            .business-section h2 {
                font-size: 28px;
            }
        }

        @media (max-width: 576px) {
            .about .about-stats {
                grid-template-columns: 1fr;
            }

            .business-section {
                padding: 50px 0;
            }

            .business-section h2 {
                font-size: 24px;
            }

            .doctors .doctor-card .img-wrap img {
                height: 200px;
            }

            .founder-avatar {
                width: 150px !important;
                height: 150px !important;
                margin-bottom: 16px !important;
                border-width: 4px !important;
            }
        }
    </style>
    <main class="main">
        <!-- =================== PAGE TITLE =================== -->
        <div class="page-title">

        </div>

        <!-- End Page Title -->

        <!-- =================== ABOUT SECTION =================== -->

        <section class="about section" id="about">
            <div class="container">
                <div class="row gy-5 align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="about-img">
                            <img src="YOUR_IMAGE_URL_HERE" alt="ThreatXpert Cybersecurity Training">
                            <div class="experience-badge">
                                <span>2020</span>
                                <p>Est. in<br>India</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                        <div class="about-content">
                            <p class="subtitle"><i class="bi bi-shield-lock me-2"></i>India's Most Trusted Cybersecurity
                                Training Institute
                            </p>
                            <h3>Building India's Cyber Warriors — One Expert at a Time</h3>
                            <p>ThreatXpert fulfills the growing demand for skilled cybersecurity professionals in an
                                increasingly dangerous digital world. As a premier cybersecurity training and solutions
                                company, ThreatXpert delivers practical, advanced, and industry-aligned programs that
                                prepare individuals and organizations to defend against modern cyber threats.</p>
                            <p>Not just training — ThreatXpert provides end-to-end <strong>Cybersecurity Services</strong>
                                including secure web development, penetration testing, digital forensics, and threat
                                intelligence, along with career-focused certifications and <strong>100% placement
                                    support</strong> for our students.</p>
                            <p>Dedicated to empowering the digital world, contributing to India's cybersecurity workforce,
                                and building a safer internet for all. Registered as <strong>Threat Expert Cyber Solutions
                                    Pvt. Ltd.</strong> and recognized across India's leading cybersecurity platforms.</p>
                            <div class="about-stats">
                                <div class="stat-item">
                                    <div class="num">500+</div>
                                    <p>Trained Professionals</p>
                                </div>
                                <div class="stat-item">
                                    <div class="num">10+</div>
                                    <p>Cybersecurity Courses</p>
                                </div>
                                <div class="stat-item">
                                    <div class="num">100%</div>
                                    <p>Placement Support</p>
                                </div>
                                <div class="stat-item">
                                    <div class="num">50+</div>
                                    <p>Corporate Clients Served</p>
                                </div>
                            </div>
                            <a href="https://wa.me/918079034973" target="_blank" class="cta-btn"><i
                                    class="bi bi-whatsapp"></i> Book Your Free Demo Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="news-section">
            <div class="container">
                <p class="news-label">ThreatXpert — Recognized By</p>
                <div class="logo-marquee-wrap">
                    <div class="logo-marquee">
                        @php
                            $newsLogos = [
                                ['icon' => 'bi-shield-check', 'name' => 'EC-Council'],
                                ['icon' => 'bi-award', 'name' => 'CompTIA'],
                                ['icon' => 'bi-globe', 'name' => 'NASSCOM'],
                                ['icon' => 'bi-building', 'name' => 'Startup India'],
                                ['icon' => 'bi-flag', 'name' => 'Skill India'],
                                ['icon' => 'bi-laptop', 'name' => 'CERT-In'],
                                ['icon' => 'bi-newspaper', 'name' => 'Rajasthan Patrika'],
                                ['icon' => 'bi-newspaper', 'name' => 'Dainik Bhaskar'],
                                ['icon' => 'bi-trophy', 'name' => 'CyberSec India Awards'],
                                ['icon' => 'bi-people', 'name' => 'ISACA'],
                                ['icon' => 'bi-mortarboard', 'name' => 'ISC2'],
                                ['icon' => 'bi-star', 'name' => 'Internshala Top Company'],
                            ];
                        @endphp
                        {{-- First set --}}
                        @foreach ($newsLogos as $logo)
                            <div class="logo-pill"><i class="bi {{ $logo['icon'] }}"></i> {{ $logo['name'] }}</div>
                        @endforeach
                        {{-- Duplicate for seamless loop --}}
                        @foreach ($newsLogos as $logo)
                            <div class="logo-pill"><i class="bi {{ $logo['icon'] }}"></i> {{ $logo['name'] }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="news-quotes">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="quote-card">
                                <i class="bi bi-quote quote-big"></i>
                                <div class="quote-source"><i class="bi bi-newspaper"></i> Rajasthan Patrika</div>
                                <blockquote>"ThreatXpert is redefining how India approaches cybersecurity education —
                                    hands-on, practical, and genuinely career-ready from day one."</blockquote>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="quote-card">
                                <i class="bi bi-quote quote-big"></i>
                                <div class="quote-source"><i class="bi bi-people"></i> Industry Partner Review</div>
                                <blockquote>"The quality of talent coming out of ThreatXpert's programs is exceptional —
                                    their graduates are job-ready and technically sharp from the very first day."
                                </blockquote>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="quote-card">
                                <i class="bi bi-quote quote-big"></i>
                                <div class="quote-source"><i class="bi bi-trophy"></i> CyberSec India 2023</div>
                                <blockquote>"ThreatXpert's commitment to practical learning and real-world threat simulation
                                    sets them apart as one of India's most impactful cybersecurity training providers."
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =================== OUR VALUES =================== -->
        <section class="values section section-alt">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>What Sets Us Apart</h2>
                    <p>Our hands-on approach goes far beyond theory — we train real defenders through an advanced curriculum
                        that blends offensive techniques, defensive strategy, and industry-standard tools.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="value-card">
                            <div class="icon"><i class="bi bi-bug"></i></div>
                            <h4>Ethical Hacking &amp; Penetration Testing</h4>
                            <p>Master the mindset of an attacker. Our offensive security training covers web app pentesting,
                                network exploitation, and vulnerability assessment using industry-standard tools like Kali
                                Linux and Metasploit.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="value-card">
                            <div class="icon"><i class="bi bi-shield-lock"></i></div>
                            <h4>Secure Web Development</h4>
                            <p>Build digital assets that can't be broken. Our secure development training covers OWASP Top
                                10, encryption protocols, authentication hardening, and security-first coding practices for
                                developers.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="value-card">
                            <div class="icon"><i class="bi bi-search"></i></div>
                            <h4>Digital Forensics &amp; Incident Response</h4>
                            <p>Investigate breaches, recover evidence, and respond to active threats. Our DFIR curriculum is
                                co-designed with certified forensic investigators to simulate real-world attack scenarios.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="value-card">
                            <div class="icon"><i class="bi bi-trophy"></i></div>
                            <h4>100% Placement Guarantee</h4>
                            <p>Every student who completes our program receives dedicated placement support — resume
                                building, mock interviews, and direct connections with our hiring partner network across
                                India's top IT and security firms.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== MEET THE FOUNDER =================== -->
        <section class="certifications section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Meet the Founder</h2>
                    <p>The cybersecurity veteran and educator behind ThreatXpert's practical, career-focused training
                        methodology and threat-intelligence-driven curriculum.</p>
                </div>
                <div class="row gy-5 align-items-center">
                    <div class="col-lg-4 text-center" data-aos="fade-right">
                        <img src="YOUR_FOUNDER_IMAGE_URL_HERE" alt="ThreatXpert Founder" class="founder-avatar"
                            style="width:220px;height:220px;border-radius:50%;object-fit:cover;border:6px solid #fff;box-shadow:0 16px 50px rgba(23,92,221,0.2);margin-bottom:24px;max-width:100%;">
                        <h3 style="font-size:26px;font-weight:800;margin-bottom:4px;">[Founder Name]</h3>
                        <p style="font-size:14px;font-weight:700;color:var(--accent-color);margin-bottom:4px;">Cybersecurity
                            Expert &amp; Trainer</p>
                        <p style="font-size:13px;color:var(--default-color);margin-bottom:20px;font-style:italic;">Founder
                            &amp; CEO, Threat Expert Cyber Solutions Pvt. Ltd.</p>
                        <a href="https://wa.me/918079034973" target="_blank"
                            class="about cta-btn d-inline-flex align-items-center gap-2"
                            style="background:var(--accent-color);color:#fff;padding:12px 28px;border-radius:30px;font-weight:700;box-shadow:0 6px 20px rgba(23,92,221,0.3);">
                            <i class="bi bi-whatsapp"></i> Connect with Us
                        </a>
                    </div>

                    <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                        <p
                            style="font-size:13px;font-weight:700;color:var(--accent-color);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:10px;">
                            <i class="bi bi-shield-lock me-2"></i>Certified Ethical Hacker · Penetration Tester ·
                            Cybersecurity Educator
                        </p>
                        <p style="font-size:16px;line-height:1.8;margin-bottom:16px;">The founder of ThreatXpert is a
                            seasoned cybersecurity professional and educator with deep expertise in offensive security,
                            threat intelligence, and digital forensics. With a passion for building India's next generation
                            of cyber defenders, they established ThreatXpert as a platform where practical skills meet
                            industry-ready training.</p>
                        <p style="font-size:15px;line-height:1.8;margin-bottom:24px;">Their work sits at the intersection
                            of real-world threat research, structured pedagogy, and career development. By combining
                            hands-on labs, live attack simulations, and mentorship from active security professionals,
                            ThreatXpert's curriculum is built to deliver confident, skilled cybersecurity practitioners from
                            the very first day of employment.</p>

                        <p style="font-size:16px;line-height:1.8;margin-bottom:16px;">Under their leadership, ThreatXpert
                            has trained over 500 cybersecurity professionals, delivered enterprise security assessments for
                            clients across sectors including BFSI, healthcare, and e-commerce, and has built a growing
                            network of hiring partners ensuring 100% placement support for every graduate. The company has
                            also partnered with leading educational institutions to integrate cybersecurity awareness into
                            academic curricula.</p>
                        <p style="font-size:15px;line-height:1.8;">Recognized across India's cybersecurity ecosystem and
                            committed to the mission of a safer digital India, the ThreatXpert founder continues to lead
                            from the front — training, consulting, and building the security talent pipeline our nation
                            urgently needs.</p>
                    </div>
                </div>
                <section class="news-section" style="background: #fff">
                    <div class="container">
                        <p class="news-label">Founder Achievements</p>
                        <div class="logo-marquee-wrap">
                            <div class="logo-marquee">
                                @php
                                    $newsLogos = [
                                        ['icon' => 'bi-shield-check', 'name' => 'CEH Certified'],
                                        ['icon' => 'bi-award', 'name' => 'CompTIA Security+'],
                                        ['icon' => 'bi-globe', 'name' => 'NASSCOM Member'],
                                        ['icon' => 'bi-building', 'name' => 'Startup India'],
                                        ['icon' => 'bi-flag', 'name' => 'Skill India'],
                                        ['icon' => 'bi-laptop', 'name' => 'CERT-In Empanelled'],
                                        ['icon' => 'bi-newspaper', 'name' => 'Rajasthan Patrika'],
                                        ['icon' => 'bi-newspaper', 'name' => 'Dainik Bhaskar'],
                                        ['icon' => 'bi-trophy', 'name' => 'CyberSec India Awards'],
                                        ['icon' => 'bi-people', 'name' => 'ISACA Member'],
                                        ['icon' => 'bi-mortarboard', 'name' => 'ISC2 Associate'],
                                        ['icon' => 'bi-star', 'name' => 'Top Cybersecurity Trainer'],
                                    ];
                                @endphp
                                {{-- First set --}}
                                @foreach ($newsLogos as $logo)
                                    <div class="logo-pill"><i class="bi {{ $logo['icon'] }}"></i> {{ $logo['name'] }}
                                    </div>
                                @endforeach
                                {{-- Duplicate for seamless loop --}}
                                @foreach ($newsLogos as $logo)
                                    <div class="logo-pill"><i class="bi {{ $logo['icon'] }}"></i> {{ $logo['name'] }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <!-- =================== LEGACY & IMPACT =================== -->
        <section class="certifications section section-alt">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Legacy &amp; Impact</h2>
                    <p>From global threat research to grassroots cybersecurity education — ThreatXpert's journey and
                        credentials that power India's most practical security curriculum.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="cert-item">
                            <div class="cert-icon"><i class="bi bi-mortarboard"></i></div>
                            <div>
                                <h5>Academic &amp; Certification Pedigree</h5>
                                <p>Industry-recognized certifications including CEH, CompTIA Security+, OSCP, and more ·
                                    Curriculum aligned with EC-Council, NASSCOM, and CERT-In standards · Advanced modules on
                                    Cloud Security, SIEM, SOC Operations, and Red Teaming developed with active security
                                    practitioners.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="cert-item">
                            <div class="cert-icon"><i class="bi bi-globe-americas"></i></div>
                            <div>
                                <h5>National Impact — 500+ Professionals Trained Across India</h5>
                                <p>Training programs designed to support India's cybersecurity workforce demands, with
                                    graduates placed across IT companies, banks, healthcare organizations, and government
                                    agencies. ThreatXpert alumni now protect some of India's most critical digital
                                    infrastructure.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="cert-item">
                            <div class="cert-icon"><i class="bi bi-shield-exclamation"></i></div>
                            <div>
                                <h5>Real-World Security Services</h5>
                                <p>Beyond training, ThreatXpert actively delivers cybersecurity services — VAPT, secure web
                                    development, digital forensics, and threat intelligence — for MNCs, SMEs, healthcare
                                    institutions, NGOs, and government awareness campaigns across India.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="cert-item">
                            <div class="cert-icon"><i class="bi bi-flag"></i></div>
                            <div>
                                <h5>Contributing to Digital India &amp; Skill India</h5>
                                <p>Dedicated to building India's cybersecurity talent pipeline in alignment with the
                                    National Cyber Security Policy and NEP 2020. ThreatXpert actively works with educational
                                    institutions to embed cybersecurity literacy into India's next generation of digital
                                    citizens.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== MEET THE CO-FOUNDER =================== -->
        <section class="certifications section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Meet the Co-Founder</h2>
                    <p>The strategic mind behind ThreatXpert's operations, partnerships, and industry-aligned program
                        delivery.</p>
                </div>
                <div class="row gy-5 align-items-center">
                    <div class="col-lg-4 text-center" data-aos="fade-right">
                        <img src="YOUR_COFOUNDER_IMAGE_URL_HERE" alt="ThreatXpert Co-Founder" class="founder-avatar"
                            style="width:220px;height:220px;border-radius:50%;object-fit:cover;border:6px solid #fff;box-shadow:0 16px 50px rgba(23,92,221,0.2);margin-bottom:24px;max-width:100%;">
                        <h3 style="font-size:26px;font-weight:800;margin-bottom:4px;">[Co-Founder Name]</h3>
                        <p style="font-size:14px;font-weight:700;color:var(--accent-color);margin-bottom:4px;">Security
                            Consultant &amp; Operations Lead</p>
                        <p style="font-size:13px;color:var(--default-color);margin-bottom:20px;font-style:italic;">
                            Co-Founder, Threat Expert Cyber Solutions Pvt. Ltd.</p>
                        <a href="https://wa.me/918079034973" target="_blank"
                            class="about cta-btn d-inline-flex align-items-center gap-2"
                            style="background:var(--accent-color);color:#fff;padding:12px 28px;border-radius:30px;font-weight:700;box-shadow:0 6px 20px rgba(23,92,221,0.3);">
                            <i class="bi bi-whatsapp"></i> Connect with Us
                        </a>
                    </div>

                    <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                        <p
                            style="font-size:13px;font-weight:700;color:var(--accent-color);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:10px;">
                            <i class="bi bi-shield-lock me-2"></i>Security Operations · Corporate Training · Program Design
                        </p>
                        <p style="font-size:16px;line-height:1.8;margin-bottom:16px;">ThreatXpert's Co-Founder is a
                            strategic operations leader with a strong background in cybersecurity consulting, corporate
                            training delivery, and program development. Their expertise lies in designing learning journeys
                            that are structured, measurable, and directly tied to industry hiring requirements.</p>
                        <p style="font-size:15px;line-height:1.8;margin-bottom:24px;">Over the course of building
                            ThreatXpert, they have played a pivotal role in forging industry partnerships, establishing
                            placement pipelines, and ensuring that every batch of graduates meets the bar set by top-tier
                            employers in the cybersecurity domain. Their operational rigor and attention to student outcomes
                            make ThreatXpert's programs among the most reliable in India.</p>
                        <p style="font-size:15px;line-height:1.8;">Recognized for bridging the gap between training and
                            employment, the Co-Founder leads ThreatXpert's corporate outreach, client services, and career
                            development initiatives — ensuring that every student's journey from learning to landing a job
                            is seamless, supported, and successful.</p>
                    </div>
                </div>
                <section class="news-section" style="background: #fff">
                    <div class="container">
                        <p class="news-label">Co-Founder Achievements</p>
                        <div class="logo-marquee-wrap">
                            <div class="logo-marquee">
                                @php
                                    $newsLogos = [
                                        ['icon' => 'bi-shield-check', 'name' => 'CEH Certified'],
                                        ['icon' => 'bi-award', 'name' => 'CompTIA Security+'],
                                        ['icon' => 'bi-globe', 'name' => 'NASSCOM Member'],
                                        ['icon' => 'bi-building', 'name' => 'Startup India'],
                                        ['icon' => 'bi-flag', 'name' => 'Skill India'],
                                        ['icon' => 'bi-laptop', 'name' => 'CERT-In Empanelled'],
                                        ['icon' => 'bi-newspaper', 'name' => 'Rajasthan Patrika'],
                                        ['icon' => 'bi-newspaper', 'name' => 'Dainik Bhaskar'],
                                        ['icon' => 'bi-trophy', 'name' => 'CyberSec India Awards'],
                                        ['icon' => 'bi-people', 'name' => 'ISACA Member'],
                                        ['icon' => 'bi-mortarboard', 'name' => 'ISC2 Associate'],
                                        ['icon' => 'bi-star', 'name' => 'Top Cybersecurity Trainer'],
                                    ];
                                @endphp
                                {{-- First set --}}
                                @foreach ($newsLogos as $logo)
                                    <div class="logo-pill"><i class="bi {{ $logo['icon'] }}"></i> {{ $logo['name'] }}
                                    </div>
                                @endforeach
                                {{-- Duplicate for seamless loop --}}
                                @foreach ($newsLogos as $logo)
                                    <div class="logo-pill"><i class="bi {{ $logo['icon'] }}"></i> {{ $logo['name'] }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <!-- =================== OUR CENTRES =================== -->
        <section class="departments section section-alt">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Our Training Centres</h2>
                    <p>ThreatXpert operates from multiple centres — making world-class cybersecurity education accessible to
                        students and professionals across India.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="dept-card">
                            <div class="img-wrap">
                                <img src="YOUR_CENTRE1_IMAGE_URL_HERE" alt="ThreatXpert Main Training Centre">
                                <div class="icon-overlay"><i class="bi bi-geo-alt-fill"></i></div>
                            </div>
                            <div class="content">
                                <h4>Main Training Centre</h4>
                                <p>Jaipur, Rajasthan — our flagship centre equipped with dedicated cyber labs, live attack
                                    simulation environments, and expert-led classroom training.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="dept-card">
                            <div class="img-wrap">
                                <img src="YOUR_CENTRE2_IMAGE_URL_HERE" alt="ThreatXpert Online Learning Hub">
                                <div class="icon-overlay"><i class="bi bi-geo-alt-fill"></i></div>
                            </div>
                            <div class="content">
                                <h4>Online Learning Hub</h4>
                                <p>Pan-India online batches — delivering the same lab-intensive, mentor-led experience to
                                    cybersecurity learners anywhere in the country.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="dept-card">
                            <div class="img-wrap">
                                <img src="YOUR_CENTRE3_IMAGE_URL_HERE" alt="ThreatXpert Corporate Training">
                                <div class="icon-overlay"><i class="bi bi-geo-alt-fill"></i></div>
                            </div>
                            <div class="content">
                                <h4>Corporate Training Wing</h4>
                                <p>On-site and customized corporate cybersecurity training delivered at client premises —
                                    tailored to your team's threat landscape and compliance requirements.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="dept-card">
                            <div class="img-wrap">
                                <img src="YOUR_CENTRE4_IMAGE_URL_HERE" alt="ThreatXpert University Partnership">
                                <div class="icon-overlay"><i class="bi bi-geo-alt-fill"></i></div>
                            </div>
                            <div class="content">
                                <h4>University Partnership Centres</h4>
                                <p>Embedded cybersecurity labs and training programs within partner colleges and
                                    universities — building security awareness from the ground up.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Register Centre Banner -->
                <div class="mt-5 rounded-4 p-4 text-center text-white"
                    style="background:linear-gradient(135deg,var(--heading-color),#1a3a7c);" data-aos="fade-up">
                    <div class="row align-items-center gy-3">
                        <div class="col-lg-8 text-lg-start">
                            <h4 class="text-white fw-bold mb-1">Bring ThreatXpert to Your Institution or Organisation</h4>
                            <p style="color:rgba(255,255,255,0.8);margin:0;">Want to run ThreatXpert cybersecurity programs
                                at your college, IT firm, or enterprise? Partner with India's most trusted cybersecurity
                                training provider.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="https://wa.me/918079034973" target="_blank"
                                class="d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill fw-bold"
                                style="background:#fff;color:var(--accent-color);font-size:15px;text-decoration:none;">
                                <i class="bi bi-building-add"></i> Partner With Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== MEET THE TEAM =================== -->
        <section class="doctors section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Meet the Team</h2>
                    <p>ThreatXpert aspires to be India's leading cybersecurity training and solutions provider — delivering
                        everything under one roof. We work with the vision of building India's most capable generation of
                        cyber defenders.</p>
                </div>
                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="doctor-card">
                            <div class="img-wrap">
                                <img src="YOUR_TEAM1_IMAGE_URL_HERE" alt="Lead Security Trainer">
                                <div class="social-overlay">
                                    <a href="#" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="info">
                                <h4>[Lead Trainer Name]</h4>
                                <p class="specialty">Offensive Security &amp; Penetration Testing Lead</p>
                                <p style="font-size:13px;color:var(--default-color);margin-bottom:14px;">A certified
                                    ethical hacker and penetration tester with years of experience in red team operations,
                                    bug bounty research, and delivering hands-on offensive security training to students and
                                    corporate teams across India.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="doctor-card">
                            <div class="img-wrap">
                                <img src="YOUR_TEAM2_IMAGE_URL_HERE" alt="Digital Forensics Trainer">
                                <div class="social-overlay">
                                    <a href="#" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="info">
                                <h4>[Forensics Trainer Name]</h4>
                                <p class="specialty">Digital Forensics &amp; Incident Response</p>
                                <p style="font-size:13px;color:var(--default-color);margin-bottom:14px;">Specializing in
                                    digital forensics, malware analysis, and incident response, with a background in
                                    assisting law enforcement and corporate clients in investigating cybercrime and data
                                    breach events.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="doctor-card">
                            <div class="img-wrap">
                                <img src="YOUR_TEAM3_IMAGE_URL_HERE" alt="Cloud Security Expert">
                                <div class="social-overlay">
                                    <a href="#" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="info">
                                <h4>[Cloud Security Expert Name]</h4>
                                <p class="specialty">Cloud Security &amp; SOC Operations</p>
                                <p style="font-size:13px;color:var(--default-color);margin-bottom:14px;">An expert in cloud
                                    security architecture, SIEM/SOAR implementation, and SOC operations — training the next
                                    generation of security analysts to monitor, detect, and respond to threats in real time.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Join Our Team -->
                <div class="mt-5 rounded-4 p-5 text-white" style="background:var(--accent-color);" data-aos="fade-up">
                    <div class="row align-items-center gy-3">
                        <div class="col-lg-8">
                            <h3 class="text-white fw-bold mb-2">Join Our Team</h3>
                            <p style="color:rgba(255,255,255,0.85);margin:0;">Be part of something impactful. We're looking
                                for passionate cybersecurity professionals, trainers, and educators to grow with us. Help us
                                build India's most capable cyber defense workforce.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="https://wa.me/918079034973" target="_blank"
                                class="d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill fw-bold"
                                style="background:#fff;color:var(--accent-color);font-size:15px;text-decoration:none;transition:0.3s;">
                                <i class="bi bi-arrow-right-circle"></i> Join Our Team
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== GALLERY =================== -->
        <section class="gallery section section-alt">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Our Programmes &amp; Events</h2>
                    <p>From intensive bootcamps and certification ceremonies to corporate workshops and live CTF
                        competitions — a glimpse of life at ThreatXpert.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="gallery-item">
                            <img src="YOUR_GALLERY1_IMAGE_URL_HERE" alt="Certification Ceremony">
                            <div class="overlay">
                                <a href="YOUR_GALLERY1_IMAGE_URL_HERE" class="glightbox" data-gallery="gallery"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="gallery-item">
                            <img src="YOUR_GALLERY2_IMAGE_URL_HERE" alt="Hands-on Lab Training">
                            <div class="overlay">
                                <a href="YOUR_GALLERY2_IMAGE_URL_HERE" class="glightbox" data-gallery="gallery"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="gallery-item">
                            <img src="YOUR_GALLERY3_IMAGE_URL_HERE" alt="CTF Competition">
                            <div class="overlay">
                                <a href="YOUR_GALLERY3_IMAGE_URL_HERE" class="glightbox" data-gallery="gallery"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="gallery-item">
                            <img src="YOUR_GALLERY4_IMAGE_URL_HERE" alt="Corporate Workshop">
                            <div class="overlay">
                                <a href="YOUR_GALLERY4_IMAGE_URL_HERE" class="glightbox" data-gallery="gallery"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="gallery-item">
                            <img src="YOUR_GALLERY5_IMAGE_URL_HERE" alt="Bootcamp Session">
                            <div class="overlay">
                                <a href="YOUR_GALLERY5_IMAGE_URL_HERE" class="glightbox" data-gallery="gallery"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="350">
                        <div class="gallery-item">
                            <img src="YOUR_GALLERY6_IMAGE_URL_HERE" alt="Awareness Seminar">
                            <div class="overlay">
                                <a href="YOUR_GALLERY6_IMAGE_URL_HERE" class="glightbox" data-gallery="gallery"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="gallery-item">
                            <img src="YOUR_GALLERY7_IMAGE_URL_HERE" alt="Placement Drive">
                            <div class="overlay">
                                <a href="YOUR_GALLERY7_IMAGE_URL_HERE" class="glightbox" data-gallery="gallery"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== TESTIMONIALS =================== -->
        <section class="testimonials section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>What Our Students &amp; Clients Say</h2>
                    <p>Real stories from cybersecurity professionals and organizations who have experienced the ThreatXpert
                        difference — skills, confidence, and career transformation.</p>
                </div>
                <div class="swiper testimonialsSwiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon"><i class="bi bi-quote"></i></div>
                                <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i></div>
                                <p>"I had zero cybersecurity background when I joined ThreatXpert. Within 4 months of
                                    completing their Ethical Hacking program, I had my CEH certification and a job offer at
                                    a leading IT security firm. The hands-on labs made all the difference."</p>
                                <div class="author">
                                    <div
                                        style="width:50px;height:50px;border-radius:50%;background:var(--accent-color);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;">
                                        A</div>
                                    <div>
                                        <h5>Arjun Mehta</h5>
                                        <span>Security Analyst, Jaipur</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon"><i class="bi bi-quote"></i></div>
                                <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i></div>
                                <p>"ThreatXpert conducted a VAPT for our fintech startup and identified critical
                                    vulnerabilities we had no idea existed. Their report was detailed, actionable, and
                                    professional. They are now our go-to security partner."</p>
                                <div class="author">
                                    <div
                                        style="width:50px;height:50px;border-radius:50%;background:var(--accent-color);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;">
                                        R</div>
                                    <div>
                                        <h5>Riya Singhania</h5>
                                        <span>CTO, Fintech Startup, Mumbai</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon"><i class="bi bi-quote"></i></div>
                                <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i></div>
                                <p>"The Digital Forensics course at ThreatXpert was unlike any other training I've taken.
                                    Real case studies, live tools, and mentors who have actually worked in the field. I feel
                                    genuinely prepared to handle real incidents."</p>
                                <div class="author">
                                    <div
                                        style="width:50px;height:50px;border-radius:50%;background:var(--accent-color);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;">
                                        S</div>
                                    <div>
                                        <h5>Saurabh Verma</h5>
                                        <span>Forensics Analyst, Delhi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon"><i class="bi bi-quote"></i></div>
                                <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i></div>
                                <p>"We partnered with ThreatXpert to run a cybersecurity awareness workshop for our entire
                                    staff. The session was engaging, practical, and immediately impacted how our team
                                    handles phishing and data handling. Highly recommended."</p>
                                <div class="author">
                                    <div
                                        style="width:50px;height:50px;border-radius:50%;background:var(--accent-color);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;">
                                        V</div>
                                    <div>
                                        <h5>Vikram Joshi</h5>
                                        <span>HR Director, Corporate Partner, Jaipur</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <!-- =================== FAQ =================== -->
        <section class="faq section section-alt">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Frequently Asked Questions</h2>
                    <p>Got questions? We've got answers. Here's everything students and professionals commonly ask about
                        ThreatXpert's programs, admissions, and cybersecurity services.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9" data-aos="fade-up" data-aos-delay="100">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq1">
                                        <span class="faq-num">01</span>
                                        Who can enrol in ThreatXpert's programs?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Anyone aged 18 and above can enrol — students, IT
                                        professionals, developers, and career changers. No prior cybersecurity experience is
                                        required for our foundation programs. Advanced tracks require a basic understanding
                                        of networking and operating systems.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq2">
                                        <span class="faq-num">02</span>
                                        Who are your trainers and faculty?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">All our trainers are industry-active cybersecurity
                                        professionals — certified ethical hackers, penetration testers, forensic
                                        investigators, and security architects. Their full profiles and certifications are
                                        shared with enrolled students before training begins.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq3">
                                        <span class="faq-num">03</span>
                                        Will I receive a certificate upon completion?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Yes. Students receive a ThreatXpert completion certificate
                                        upon finishing the program, provided they maintain a minimum 70% attendance. We also
                                        guide students through the process of earning globally recognized certifications
                                        such as CEH and CompTIA Security+.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq4">
                                        <span class="faq-num">04</span>
                                        How many students are in each batch?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Batches are intentionally kept small — a maximum of 15
                                        students per batch — to ensure every learner gets dedicated attention, personalized
                                        mentorship, and adequate lab time during hands-on sessions.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq5">
                                        <span class="faq-num">05</span>
                                        What happens if I miss a class?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Session recordings and study materials are shared after
                                        every class. If additional help is needed, a one-on-one virtual session can be
                                        arranged with your trainer to ensure you stay on track and cover everything you
                                        missed.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq6">
                                        <span class="faq-num">06</span>
                                        Are classes available online and offline?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Yes — both online and offline batches are available. Our
                                        online programs include live interactive sessions with the same lab-intensive
                                        curriculum as our in-person training, accessible from anywhere in India.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq7">
                                        <span class="faq-num">07</span>
                                        What do the courses cover?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Our programs cover Ethical Hacking, Penetration Testing,
                                        Digital Forensics, Incident Response, Secure Web Development, Cloud Security, SOC
                                        Operations, SIEM/SOAR, Malware Analysis, and Cybersecurity Awareness — with a strong
                                        focus on practical, tool-based learning throughout.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq8">
                                        <span class="faq-num">08</span>
                                        What tools and technologies will I learn?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Students train with industry-standard tools including Kali
                                        Linux, Metasploit, Burp Suite, Wireshark, Nmap, Nessus, Autopsy, Splunk, and more —
                                        the same tools used by professional security teams and red teamers worldwide.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq9">
                                        <span class="faq-num">09</span>
                                        What materials and resources are provided?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Students receive access to our dedicated lab environment,
                                        comprehensive study notes, practice CTF challenges, session recordings, a
                                        professional course completion portfolio, and career support resources including a
                                        CV template and interview preparation guide.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq10">
                                        <span class="faq-num">10</span>
                                        What is the refund or cancellation policy?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Due to limited batch sizes, refunds are not generally
                                        available after enrolment. However, within the first two weeks, if you are not
                                        satisfied with the program, a refund of the remaining fees can be processed with
                                        mutual consent. Please contact us to discuss your situation.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== CALL TO ACTION =================== -->
        <section class="cta-section">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-8" data-aos="fade-right">
                        <h2>New Batch Enrollments Now Open!</h2>
                        <p>ThreatXpert offers the perfect blend of technical depth, hands-on labs, and career placement
                            support — building a strong foundation for a future-proof cybersecurity career. Enrol today to
                            gain the skills, certifications, and industry connections you need to stay ahead of every
                            threat.</p>
                        <div class="d-flex flex-wrap gap-3 mt-3">
                            <a href="https://wa.me/918079034973" target="_blank" class="btn-white"><i
                                    class="bi bi-whatsapp"></i> Book Free Demo Now</a>
                            <a href="https://www.threatxpert.com/courses" target="_blank" class="btn-white"
                                style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.3);"><i
                                    class="bi bi-mortarboard"></i> View All Courses</a>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-lg-end" data-aos="fade-left" data-aos-delay="100">
                        <div class="emergency-call">
                            <div class="icon text-warning"><i class="bi bi-tag-fill"></i></div>
                            <div>
                                <span>Early Bird Discount</span>
                                <strong>Limited Seats Per Batch</strong>
                                <small style="display:block;opacity:0.7;font-size:12px;margin-top:2px;">Register before the
                                    batch fills up</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== CONTACT =================== -->
        <section class="contact section" id="contact">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Get In Touch</h2>
                    <p>Have questions about our courses or services? Our team is available Monday through Saturday. Reach
                        out for course enquiries, corporate training proposals, or cybersecurity consultations.</p>
                </div>
                <div class="row gy-5">
                    <div class="col-lg-4" data-aos="fade-right">
                        <div class="info-item">
                            <div class="icon-wrap"><i class="bi bi-geo-alt-fill"></i></div>
                            <div>
                                <h5>Our Location</h5>
                                <p>ThreatXpert Training Centre,<br>Jaipur, Rajasthan, India</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon-wrap"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <h5>Phone Numbers</h5>
                                <p>+91 80790 34973</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon-wrap"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <h5>Email Address</h5>
                                <p>training@threatxpert.com</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon-wrap"><i class="bi bi-clock-fill"></i></div>
                            <div>
                                <h5>Working Hours</h5>
                                <p>Mon – Sat: 10:00 AM – 7:00 PM<br>Sunday: By Appointment Only</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                        <div class="contact-form">
                            <h4 class="mb-4">Send Us a Message</h4>
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Your Full Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Your Email Address" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text" style="font-weight:600;font-size:14px;">+91</span>
                                        <input type="tel" class="form-control" placeholder="10-digit number"
                                            maxlength="10" inputmode="numeric">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control">
                                        <option value="" disabled selected>Select Interest</option>
                                        <option>Ethical Hacking &amp; Penetration Testing</option>
                                        <option>Digital Forensics &amp; Incident Response</option>
                                        <option>Secure Web Development</option>
                                        <option>Cloud Security</option>
                                        <option>Corporate Training</option>
                                        <option>VAPT / Security Audit</option>
                                        <option>General Enquiry</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="Subject">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="5" placeholder="Your Message or Question..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn-submit">Send Message <i class="bi bi-send ms-1"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Map -->
                <div class="mt-5 rounded-4 overflow-hidden" style="height:350px;box-shadow:0 10px 40px rgba(0,0,0,0.1);"
                    data-aos="fade-up">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.3825624477!2d75.71877344531249!3d26.88514083509063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1620000000000"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>

    </main>
@endsection
