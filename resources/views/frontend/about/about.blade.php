@extends('frontend.course.layout')
@section('content')
    <style>
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
                            <img src="https://static.wixstatic.com/media/495d44_bc860d09a55747d4a8cba6868ea9900f~mv2.jpg/v1/fill/w_599,h_750,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/download%20(3).jpg"
                                alt="Act to Action Students">
                            <div class="experience-badge">
                                <span>2019</span>
                                <p>Est. in<br>India</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                        <div class="about-content">
                            <p class="subtitle"><i class="bi bi-stars me-2"></i>India's First Choice Screen Acting School
                            </p>
                            <h3>Building India's Future Talent — One Child at a Time</h3>
                            <p>Act to Action fulfills the needs of every child preparing themselves for the world of 2045
                                with best skill courses. Since 2019, Act to Action is India's first choice and trusted
                                screen acting school, delivering the best talent to the film industry, mainstream
                                advertisements, popular clothing brands, and most-heard music labels.</p>
                            <p>Not just that — Act to Action provides best-in-class personality development, stage
                                confidence, public speaking and filmmaking skills, along with fundamental principles of the
                                <strong>Bhagavad Gita</strong> for inner strength of the child and right character building
                                for the future of our country.
                            </p>
                            <p>Dedicated to the mission of <strong>Viksit Bharat</strong>, contributing to Skill India and
                                implementation of NEP 2020. Registered with <strong>Startup India</strong> (Central
                                Government) &amp; <strong>iStart</strong> (Government of Rajasthan).</p>
                            <div class="about-stats">
                                <div class="stat-item">
                                    <div class="num">1000+</div>
                                    <p>Happy Clients &amp; Families</p>
                                </div>
                                <div class="stat-item">
                                    <div class="num">10</div>
                                    <p>Professional Skill Courses</p>
                                </div>
                                <div class="stat-item">
                                    <div class="num">250+</div>
                                    <p>Prominent Castings</p>
                                </div>
                                <div class="stat-item">
                                    <div class="num">25+</div>
                                    <p>Top Educational Institutes</p>
                                </div>
                            </div>
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="cta-btn"><i
                                    class="bi bi-whatsapp"></i> Book Your Appointment Now</a>
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
                    <p>Our holistic approach goes far beyond acting — we nurture the whole child through an award-winning
                        curriculum that blends art, science, and ancient wisdom.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="value-card">
                            <div class="icon"><i class="bi bi-camera-video"></i></div>
                            <h4>Screen Acting Excellence</h4>
                            <p>Camera acting techniques, monologue delivery, and on-screen performance skills trained with
                                industry-standard methods used across Bollywood and mainstream media.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="value-card">
                            <div class="icon"><i class="bi bi-book"></i></div>
                            <h4>Bhagavad Gita Principles</h4>
                            <p>Inner strength, discipline, and right values through Shlok Recitation and the timeless
                                teachings of the Gita — character building for the future of our nation.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="value-card">
                            <div class="icon"><i class="bi bi-heart-pulse"></i></div>
                            <h4>Neuro-Psychological Growth</h4>
                            <p>Programs co-designed with child development experts and neurotherapists to address physical,
                                mental, emotional, and intellectual growth in every child.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="value-card">
                            <div class="icon"><i class="bi bi-trophy"></i></div>
                            <h4>Award-Winning Outcomes</h4>
                            <p>Children awarded at national &amp; international film festivals, Dausa Ratna, school awards,
                                and featured in state and national newspapers across India.</p>
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
                    <p>The visionary architect behind Act to Action's formula-driven pedagogy and child-centric creative
                        education philosophy.</p>
                </div>
                <div class="row gy-5 align-items-center">
                    <div class="col-lg-4 text-center" data-aos="fade-right">
                        <img src="https://static.wixstatic.com/media/f6a8d9_034eaf05abd04f2291659c9ee18f92ea~mv2.jpg/v1/fill/w_247,h_247,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Kritesh%20Image.jpg"
                            alt="Kritesh Agarwal"
                            style="width:220px;height:220px;border-radius:50%;object-fit:cover;border:6px solid #fff;box-shadow:0 16px 50px rgba(23,92,221,0.2);margin-bottom:24px;">
                        <h3 style="font-size:26px;font-weight:800;margin-bottom:4px;">Kritesh Agarwal</h3>
                        <p style="font-size:14px;font-weight:700;color:var(--accent-color);margin-bottom:4px;">Filmmaker
                            &amp; Acting Coach</p>
                        <p style="font-size:13px;color:var(--default-color);margin-bottom:20px;font-style:italic;">Founder
                            &amp; MD, Rising Passion Pvt. Ltd.</p>
                        <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank"
                            class="about cta-btn d-inline-flex align-items-center gap-2"
                            style="background:var(--accent-color);color:#fff;padding:12px 28px;border-radius:30px;font-weight:700;box-shadow:0 6px 20px rgba(23,92,221,0.3);">
                            <i class="bi bi-whatsapp"></i> Connect with Us
                        </a>
                    </div>
                    <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                        <p
                            style="font-size:13px;font-weight:700;color:var(--accent-color);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:10px;">
                            <i class="bi bi-stars me-2"></i>Formula-driven pedagogy · Child development science · Holistic
                            mental health
                        </p>
                        <p style="font-size:16px;line-height:1.8;margin-bottom:16px;">Kritesh Agarwal is a trailblazing
                            expert in child-centric creative education, renowned for his innovative approach to nurturing
                            young minds through performing arts and holistic development. As the architect of Act to Action,
                            he merges scientific child psychology with artistic training to foster confidence, creativity,
                            and emotional resilience in children.</p>
                        <p style="font-size:15px;line-height:1.8;margin-bottom:24px;">Kritesh's proprietary methodologies
                            integrate medical insights (via collaborations with child development experts) and theatre
                            techniques to address physical, mental, emotional, and intellectual growth. His programs use
                            Shlok Recitation, Theatre exercises, Medical Therapies and Practice protocol to transform
                            abstract concepts into tangible skills — ensuring learning is experiential and impactful.</p>
                        <p style="font-size:15px;line-height:1.8;">Over the years, Kritesh has donned multiple hats —
                            casting head, director, acting coach, mentor, assistant producer, and art director. Currently,
                            he serves as the Founder &amp; Managing Director of <strong>Rising Passion Pvt. Ltd.</strong>,
                            actively leading Act to Action with vision and commitment.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== FOUNDER LEGACY & IMPACT =================== -->
        <section class="certifications section section-alt">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Legacy &amp; Impact</h2>
                    <p>From global film festivals to grassroots skill development — Kritesh's journey and credentials that
                        power Act to Action's world-class curriculum.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="cert-item">
                            <div class="cert-icon"><i class="bi bi-mortarboard"></i></div>
                            <div>
                                <h5>Academic &amp; Workshop Pedigree</h5>
                                <p>Journalism &amp; Mass Communication (MUJ) · MA in Entertainment Media &amp; Advertisement
                                    (KC College, Mumbai) · MBA (Symbiosis) · Short workshops of FTII Filmmaking Modules, NSD
                                    Theatre Productions and Child Psychology Workshops with medical professionals.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="cert-item">
                            <div class="cert-icon"><i class="bi bi-globe-americas"></i></div>
                            <div>
                                <h5>Global Impact — 3,000+ Students Across India &amp; UAE</h5>
                                <p>Programs designed to support UN Sustainable Development Goals (via My Captain), impacting
                                    students across India and UAE. Trained 100+ child artists now influencing film and TV
                                    with socially conscious performances.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="cert-item">
                            <div class="cert-icon"><i class="bi bi-film"></i></div>
                            <div>
                                <h5>Award-Winning Filmmaker</h5>
                                <p>Visited Cannes Film Festival (France) · Rajasthan International Film Festival · Dada
                                    Saheb Phalke Film Festival 2022. Kritesh has served as casting head, director, acting
                                    coach, mentor, assistant producer, and art director.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="cert-item">
                            <div class="cert-icon"><i class="bi bi-flag"></i></div>
                            <div>
                                <h5>Contributing to Viksit Bharat &amp; Skill India</h5>
                                <p>Dedicated to NEP 2020 implementation by producing the best young talent in the country.
                                    Serving MNCs, television industry, production houses, health institutions, government
                                    awareness campaigns, and NGOs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- =================== OUR CENTRES =================== -->
        <section class="departments section section-alt">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Our Centres</h2>
                    <p>Act to Action operates from multiple centres across Jaipur — making world-class creative education
                        accessible to children all over the city.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="dept-card">
                            <div class="img-wrap">
                                <img src="https://static.wixstatic.com/media/495d44_2eb23deea8754bda9cdf9b7189e1b6a6~mv2.jpg/v1/fill/w_359,h_282,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Rising%20Passion.jpg"
                                    alt="Rising Passion Studio">
                                <div class="icon-overlay"><i class="bi bi-geo-alt-fill"></i></div>
                            </div>
                            <div class="content">
                                <h4>Rising Passion Studio</h4>
                                <p>Vaishali Nagar, Jaipur — our flagship centre and main studio space for all major
                                    productions and training.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="dept-card">
                            <div class="img-wrap">
                                <img src="https://static.wixstatic.com/media/495d44_c5a0ab3020724ef7bbfb5625689c5193~mv2.jpg/v1/crop/x_120,y_0,w_1360,h_1068/fill/w_359,h_282,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Sun%20India.jpg"
                                    alt="Sun India Pre School">
                                <div class="icon-overlay"><i class="bi bi-geo-alt-fill"></i></div>
                            </div>
                            <div class="content">
                                <h4>Sun India Pre School</h4>
                                <p>Malviya Nagar, Jaipur — serving the youngest learners with age-appropriate, joyful
                                    creative education.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="dept-card">
                            <div class="img-wrap">
                                <img src="https://static.wixstatic.com/media/495d44_0736d8b1317c409b95ffffc51a75a735~mv2.jpg/v1/fill/w_310,h_282,al_c,lg_1,q_80,enc_avif,quality_auto/Palace%20School.jpg"
                                    alt="The Palace School">
                                <div class="icon-overlay"><i class="bi bi-geo-alt-fill"></i></div>
                            </div>
                            <div class="content">
                                <h4>The Palace School</h4>
                                <p>Old City, Jaipur — bringing creative arts education to the heart of Jaipur's heritage
                                    neighbourhood.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="dept-card">
                            <div class="img-wrap">
                                <img src="https://static.wixstatic.com/media/495d44_034c65d443c6430f847020bdb3a7d3dc~mv2.jpg/v1/fill/w_310,h_282,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Mayoor%20School.jpg"
                                    alt="Mayoor School Sitapura">
                                <div class="icon-overlay"><i class="bi bi-geo-alt-fill"></i></div>
                            </div>
                            <div class="content">
                                <h4>Mayoor School — Sitapura</h4>
                                <p>Sitapura, Jaipur — expert-led screen acting and personality development for school-going
                                    children.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Register Centre Banner -->
                <div class="mt-5 rounded-4 p-4 text-center text-white"
                    style="background:linear-gradient(135deg,var(--heading-color),#1a3a7c);" data-aos="fade-up">
                    <div class="row align-items-center gy-3">
                        <div class="col-lg-8 text-lg-start">
                            <h4 class="text-white fw-bold mb-1">Also at Royal Jaipur Skill Academy &amp; Little Starlings,
                                Ambabari</h4>
                            <p style="color:rgba(255,255,255,0.8);margin:0;">Want to bring Act to Action to your school or
                                centre? Partner with India's most trusted screen acting school.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank"
                                class="d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill fw-bold"
                                style="background:#fff;color:var(--accent-color);font-size:15px;text-decoration:none;">
                                <i class="bi bi-building-add"></i> Register Your Centre
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
                    <p>Act to Action aspires to be a leading acting academy in India that provides a lot under one umbrella.
                        We work with the vision of creating a place where we build important personalities of the future.
                    </p>
                </div>
                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="doctor-card">
                            <div class="img-wrap">
                                <img src="https://static.wixstatic.com/media/495d44_e00c60e82b4648339b9a1f4c18e19a1c~mv2.jpg/v1/crop/x_0,y_15,w_540,h_447/fill/w_403,h_334,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Deepak%20Bhaiya.jpg"
                                    alt="Deepak Chandel">
                                <div class="social-overlay">
                                    <a href="https://www.instagram.com/deepak_chandel_photography" target="_blank"
                                        rel="noopener"><i class="bi bi-instagram"></i></a>
                                </div>
                            </div>
                            <div class="info">
                                <h4>Deepak Chandel</h4>
                                <p class="specialty">Photographer &amp; Cinematographer</p>
                                <p style="font-size:13px;color:var(--default-color);margin-bottom:14px;">A passionate
                                    photographer with over a decade of experience in celebrity events, grand weddings, and
                                    creative fashion shoots. His expertise with children allows him to capture their most
                                    natural and expressive moments.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="doctor-card">
                            <div class="img-wrap">
                                <img src="https://static.wixstatic.com/media/495d44_4b14b64cccde4ee797cfd36583c43a9f~mv2.jpg/v1/crop/x_0,y_39,w_408,h_338/fill/w_403,h_334,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Kriti%20Gupta.jpg"
                                    alt="Kriti Gupta">
                                <div class="social-overlay">
                                    <a href="https://www.instagram.com/kritigupta_1507" target="_blank" rel="noopener"><i
                                            class="bi bi-instagram"></i></a>
                                    <a href="https://www.linkedin.com/in/kriti-gupta-38bb7522a" target="_blank"
                                        rel="noopener"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="info">
                                <h4>Kriti Gupta</h4>
                                <p class="specialty">Public Relation &amp; Event Head</p>
                                <p style="font-size:13px;color:var(--default-color);margin-bottom:14px;">With a background
                                    in Journalism &amp; Mass Communication, Kriti brings creativity and leadership to every
                                    project. Her ability to think ahead and adapt ensures every challenge is met with
                                    innovative solutions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="doctor-card">
                            <div class="img-wrap">
                                <img src="https://static.wixstatic.com/media/495d44_99266368241a4cffafcfb142897c1012~mv2.jpg/v1/fill/w_403,h_334,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Dr_%20Bhumika%20Ma'am.jpg"
                                    alt="Dr. Bhumika Soni">
                                <div class="social-overlay">
                                    <a href="https://www.instagram.com/pediatricneurotherapist" target="_blank"
                                        rel="noopener"><i class="bi bi-instagram"></i></a>
                                    <a href="https://www.linkedin.com/in/bhumika-soni-500a6928b" target="_blank"
                                        rel="noopener"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="info">
                                <h4>Dr. Bhumika Soni</h4>
                                <p class="specialty">Child Neuro Therapist</p>
                                <p style="font-size:13px;color:var(--default-color);margin-bottom:14px;">A skilled child
                                    neurotherapist specializing in developmental delays and sensory integration challenges,
                                    providing evidence-based interventions to enhance children's growth and potential.</p>
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
                                for passionate, creative, and driven individuals to grow with us. Explore exciting
                                opportunities and make a difference.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank"
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
                    <p>From grand graduation ceremonies and summer camps to national film festivals and parenting workshops
                        — a glimpse of life at Act to Action.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="gallery-item">
                            <img src="https://static.wixstatic.com/media/495d44_09883de720124c82807e2c6c308333f4~mv2.jpg/v1/fill/w_526,h_615,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Ceremony.jpg"
                                alt="Graduation Ceremony">
                            <div class="overlay">
                                <a href="https://static.wixstatic.com/media/495d44_09883de720124c82807e2c6c308333f4~mv2.jpg"
                                    class="glightbox" data-gallery="gallery"><i class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="gallery-item">
                            <img src="https://static.wixstatic.com/media/495d44_bc860d09a55747d4a8cba6868ea9900f~mv2.jpg/v1/fill/w_599,h_750,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/download%20(3).jpg"
                                alt="Students in Action">
                            <div class="overlay">
                                <a href="https://static.wixstatic.com/media/495d44_bc860d09a55747d4a8cba6868ea9900f~mv2.jpg"
                                    class="glightbox" data-gallery="gallery"><i class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="gallery-item">
                            <img src="https://static.wixstatic.com/media/495d44_2eb23deea8754bda9cdf9b7189e1b6a6~mv2.jpg/v1/fill/w_359,h_282,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Rising%20Passion.jpg"
                                alt="Rising Passion Studio">
                            <div class="overlay">
                                <a href="https://static.wixstatic.com/media/495d44_2eb23deea8754bda9cdf9b7189e1b6a6~mv2.jpg"
                                    class="glightbox" data-gallery="gallery"><i class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="gallery-item">
                            <img src="https://static.wixstatic.com/media/495d44_034c65d443c6430f847020bdb3a7d3dc~mv2.jpg/v1/fill/w_310,h_282,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Mayoor%20School.jpg"
                                alt="Mayoor School Centre">
                            <div class="overlay">
                                <a href="https://static.wixstatic.com/media/495d44_034c65d443c6430f847020bdb3a7d3dc~mv2.jpg"
                                    class="glightbox" data-gallery="gallery"><i class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="gallery-item">
                            <img src="https://static.wixstatic.com/media/495d44_8006536376234a728a539f6015222395~mv2.jpg/v1/fill/w_310,h_282,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Mayoor%20School%20.jpg"
                                alt="Royal Jaipur Skill Academy">
                            <div class="overlay">
                                <a href="https://static.wixstatic.com/media/495d44_8006536376234a728a539f6015222395~mv2.jpg"
                                    class="glightbox" data-gallery="gallery"><i class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="350">
                        <div class="gallery-item">
                            <img src="https://static.wixstatic.com/media/495d44_b1cfaa2755d7476ea22e412597641abf~mv2.jpg/v1/crop/x_0,y_141,w_1097,h_998/fill/w_310,h_282,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Lasr.jpg"
                                alt="Little Starlings Centre">
                            <div class="overlay">
                                <a href="https://static.wixstatic.com/media/495d44_b1cfaa2755d7476ea22e412597641abf~mv2.jpg"
                                    class="glightbox" data-gallery="gallery"><i class="bi bi-zoom-in"></i></a>
                                <a href="#"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="gallery-item">
                            <img src="https://static.wixstatic.com/media/495d44_0736d8b1317c409b95ffffc51a75a735~mv2.jpg/v1/fill/w_310,h_282,al_c,lg_1,q_80,enc_avif,quality_auto/Palace%20School.jpg"
                                alt="The Palace School">
                            <div class="overlay">
                                <a href="https://static.wixstatic.com/media/495d44_0736d8b1317c409b95ffffc51a75a735~mv2.jpg"
                                    class="glightbox" data-gallery="gallery"><i class="bi bi-zoom-in"></i></a>
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
                    <h2>What Parents &amp; Students Say</h2>
                    <p>Real stories from families who have experienced the Act to Action difference — confidence,
                        creativity, and life-changing growth in their children.</p>
                </div>
                <div class="swiper testimonialsSwiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="quote-icon"><i class="bi bi-quote"></i></div>
                                <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i></div>
                                <p>"My daughter was extremely shy before joining Act to Action. Within just 3 months, she
                                    performed confidently on stage at the school annual function. The transformation has
                                    been nothing short of incredible. Kritesh sir's method works!"</p>
                                <div class="author">
                                    <div
                                        style="width:50px;height:50px;border-radius:50%;background:var(--accent-color);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;">
                                        P</div>
                                    <div>
                                        <h5>Priya Sharma</h5>
                                        <span>Parent, Vaishali Nagar</span>
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
                                <p>"My son got his first commercial advertisement within 4 months of training at Act to
                                    Action. The casting connections and professional grooming they provide is unmatched
                                    anywhere else in Jaipur. Highly recommend to every parent."</p>
                                <div class="author">
                                    <div
                                        style="width:50px;height:50px;border-radius:50%;background:var(--accent-color);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;">
                                        R</div>
                                    <div>
                                        <h5>Rajesh Agarwal</h5>
                                        <span>Parent, Malviya Nagar</span>
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
                                <p>"The Bhagavad Gita principles integrated into the curriculum are what really sets Act to
                                    Action apart. My child not only improved her acting but also developed a stronger sense
                                    of values and discipline. A truly holistic program."</p>
                                <div class="author">
                                    <div
                                        style="width:50px;height:50px;border-radius:50%;background:var(--accent-color);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;">
                                        S</div>
                                    <div>
                                        <h5>Sunita Gupta</h5>
                                        <span>Parent, Sitapura</span>
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
                                <p>"Act to Action's summer camp was the highlight of our child's year. The activities, the
                                    graduation ceremony, and the friendships formed were unforgettable. Our school trusts
                                    them completely and will continue to partner with them."</p>
                                <div class="author">
                                    <div
                                        style="width:50px;height:50px;border-radius:50%;background:var(--accent-color);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;">
                                        A</div>
                                    <div>
                                        <h5>Amit Joshi</h5>
                                        <span>School Principal, Jaipur</span>
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
                    <p>Got questions? We've got answers. Here's everything parents and students commonly ask about Act to
                        Action's programs, admissions, and policies.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9" data-aos="fade-up" data-aos-delay="100">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq1">
                                        <span class="faq-num">01</span>
                                        What age group is the course for?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">3–29 years. Our programs are thoughtfully designed to cater
                                        to every stage — from toddlers building confidence to young adults honing their
                                        professional craft.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq2">
                                        <span class="faq-num">02</span>
                                        Who are your teachers or faculty?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Different experts from specific subjects will visit, and
                                        their complete profile will be shared with parents before the session begins — so
                                        you always know who is teaching your child.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq3">
                                        <span class="faq-num">03</span>
                                        Will the student get a certificate at the end of the course?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Yes! Students will receive a certificate upon course
                                        completion, provided they maintain a minimum attendance of 70%.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq4">
                                        <span class="faq-num">04</span>
                                        How many students are there in each batch?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">We keep batches small — a maximum of 20 students per batch —
                                        to ensure every child receives personalized attention and guidance from our faculty.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq5">
                                        <span class="faq-num">05</span>
                                        What happens if a student misses a class?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Class material is shared after every session. If extra help
                                        is required, a personal virtual call can be scheduled to help the student catch up
                                        at their own pace.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq6">
                                        <span class="faq-num">06</span>
                                        What is the mode of delivery for the classes?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Both Online and Offline batches are available, making it
                                        convenient for students regardless of location.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq7">
                                        <span class="faq-num">07</span>
                                        What does the course cover?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">The course uniquely combines Theatre in Education, Bhagavad
                                        Gita Principles, various acting techniques, personality development, and
                                        neuro-psychological growth — with a strong focus on camera acting and stage
                                        performance skills for kids.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq8">
                                        <span class="faq-num">08</span>
                                        Who are the inspirers of the entire program?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Lord Krishna, Bharatmuni, HH Pramukh Swami Maharaj,
                                        Maharishi Patanjali, Stanford Meisner, Lee Strasberg, Konstantin Stanislavski, and
                                        Augusto Boal.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq9">
                                        <span class="faq-num">09</span>
                                        What materials will be provided to the students?
                                        <i class="toggle-icon bi"></i>
                                    </button>
                                </h2>
                                <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Students will receive Monologues, a Bhagavad Gita Jar, the
                                        official Act to Action Uniform, and a Portfolio to share at casting calls.</div>
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
                                    <div class="accordion-body">Due to limited seats, there is generally no refund. However,
                                        within the first month, if the child is not comfortable with the class or acting as
                                        a subject, a refund of the remaining fees can be processed with mutual consent of
                                        the parent and mentor.</div>
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
                        <h2>Annual Batch Registration Now Open!</h2>
                        <p>Act to Action offers the perfect blend of skill development and lasting childhood memories,
                            shaping a strong foundation for future success. Start today to build confidence, discipline, and
                            on-camera excellence.</p>
                        <div class="d-flex flex-wrap gap-3 mt-3">
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-white"><i
                                    class="bi bi-whatsapp"></i> Book Appointment Now</a>
                            <a href="https://www.acttoaction.com/admissions" target="_blank" class="btn-white"
                                style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.3);"><i
                                    class="bi bi-mortarboard"></i> View Admissions</a>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-lg-end" data-aos="fade-left" data-aos-delay="100">
                        <div class="emergency-call">
                            <div class="icon text-warning"><i class="bi bi-tag-fill"></i></div>
                            <div>
                                <span>Early Bird Discount</span>
                                <strong>Limited Seats Available</strong>
                                <small style="display:block;opacity:0.7;font-size:12px;margin-top:2px;">Register before
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
                    <p>Have questions or need to reach us? Our support team is available Monday through Saturday. For
                        emergencies, please call our 24/7 hotline immediately.</p>
                </div>
                <div class="row gy-5">
                    <div class="col-lg-4" data-aos="fade-right">
                        <div class="info-item">
                            <div class="icon-wrap"><i class="bi bi-geo-alt-fill"></i></div>
                            <div>
                                <h5>Our Location</h5>
                                <p>123 Medical Center Drive<br>New York, NY 10001, USA</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon-wrap"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <h5>Phone Numbers</h5>
                                <p>General: +1 800 123 4567<br>Emergency: +1 800 911 HELP</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon-wrap"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <h5>Email Address</h5>
                                <p>info@healthclinic.com<br>appointments@healthclinic.com</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="icon-wrap"><i class="bi bi-clock-fill"></i></div>
                            <div>
                                <h5>Working Hours</h5>
                                <p>Mon – Fri: 8:00 AM – 8:00 PM<br>Sat: 9:00 AM – 5:00 PM</p>
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
                                    <input type="tel" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control">
                                        <option value="" disabled selected>Select Department</option>
                                        <option>Cardiology</option>
                                        <option>Neurology</option>
                                        <option>Orthopedics</option>
                                        <option>Pediatrics</option>
                                        <option>General Medicine</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="Subject">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="5"
                                        placeholder="Your Message or Question..."></textarea>
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
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215209132737!2d-73.98784368459315!3d40.75775394258374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1620000000000"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>

    </main>

@endsection