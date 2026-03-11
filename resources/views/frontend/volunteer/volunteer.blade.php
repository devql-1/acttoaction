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
            padding: 70px 0 55px;
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

        /* ===================== TESTIMONIALS MINI ===================== */
        .team-voices .voice-card {
            background: #fff;
            border-radius: 18px;
            padding: 30px 26px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
            height: 100%;
            border-left: 4px solid var(--accent-color);
            transition: 0.3s;
        }

        .team-voices .voice-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(23, 92, 221, 0.1);
        }

        .team-voices .voice-card .quote {
            font-size: 38px;
            color: color-mix(in srgb, var(--accent-color), transparent 75%);
            line-height: 1;
            margin-bottom: 10px;
        }

        .team-voices .voice-card p {
            font-size: 14px;
            line-height: 1.75;
            font-style: italic;
            color: color-mix(in srgb, var(--default-color), transparent 15%);
            margin-bottom: 20px;
        }

        .team-voices .voice-card .author {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .team-voices .voice-card .author .avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-color);
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .team-voices .voice-card .author h6 {
            font-size: 14px;
            font-weight: 800;
            margin: 0 0 2px;
        }

        .team-voices .voice-card .author span {
            font-size: 12px;
            color: var(--accent-color);
            font-weight: 600;
        }



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
        }
    </style>

    <main class="main">
        <div style="margin-top: 80px;"></div>
        <section class="why-join section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Why Join Act to Action?</h2>
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
                            <p>Receive an official Act to Action volunteer certificate, letter of recommendation, and
                                recognition in our nationally appreciated events and programmes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== OPEN ROLES =================== -->
        <section class="roles section section-alt">
            <div class="container">
                <div class="row gy-5 align-items-start">
                    <div class="col-lg-5" data-aos="fade-right">
                        <div class="section-title text-start pb-4">
                            <h2 class="text-start">Open Roles &amp; Opportunities</h2>
                        </div>
                        <p style="font-size:15px;line-height:1.8;margin-bottom:18px;">Whether you're a creative
                            professional, a student, a teacher, or simply someone who believes in the power of children —
                            there's a place for you at Act to Action.</p>
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
                                    document the Act to Action journey.</p>
                            </div>
                        </div>
                        <div class="role-item">
                            <div class="role-icon"><i class="bi bi-megaphone"></i></div>
                            <div>
                                <div class="badge-role">Marketing</div>
                                <h5>Social Media &amp; PR Volunteer</h5>
                                <p>Create content, manage social channels, assist in outreach events, and help spread the
                                    word about Act to Action's work across India.</p>
                            </div>
                        </div>
                        <div class="role-item">
                            <div class="role-icon"><i class="bi bi-calendar-event"></i></div>
                            <div>
                                <div class="badge-role">Events</div>
                                <h5>Event Coordinator / Volunteer</h5>
                                <p>Support our exhibitions, theatre shows, fashion shows, film festivals, summer camps, and
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

        <!-- =================== HOW IT WORKS (STEPS) =================== -->
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

        <!-- =================== VOLUNTEER FORM =================== -->
        <section class="volunteer-form-section section section-alt" id="join-form">

            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Submit Your Application</h2>
                    <p>Ready to make a difference? Fill in your details below and our team will soon contact you. We look
                        forward to having you on board!</p>
                </div>
                <div class="row gy-5">

                    <!-- Form -->
                    <div class="col-lg-8" data-aos="fade-right">
                        <div class="form-wrapper">
                            <h3><i class="bi bi-person-plus-fill me-2" style="color:var(--accent-color)"></i>Join Our Team
                            </h3>
                            <p class="form-subtitle">Fill in the form below and our team will soon contact you. All fields
                                marked <span style="color:var(--accent-color);font-weight:700;">*</span> are required.</p>

                            <form id="volunteerForm" method="POST" novalidate>
                                @csrf

                                <!-- Personal Info -->
                                <p
                                    style="font-size:12px;font-weight:800;text-transform:uppercase;letter-spacing:1.5px;color:var(--accent-color);margin-bottom:16px;">
                                    <i class="bi bi-person me-1"></i> Personal Information
                                </p>

                                <div class="row gy-3 mb-3">

                                    <div class="col-md-6">
                                        <label class="form-label">First Name <span class="req">*</span></label>
                                        <input type="text" name="first_name" class="form-control" placeholder="e.g. Rahul">
                                        <small class="text-danger first_name_error"></small>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Last Name <span class="req">*</span></label>
                                        <input type="text" name="last_name" class="form-control" placeholder="e.g. Sharma">
                                        <small class="text-danger last_name_error"></small>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email Address <span class="req">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="yourname@email.com">
                                        <small class="text-danger email_error"></small>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Phone Number <span class="req">*</span></label>
                                        <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210">
                                        <small class="text-danger phone_error"></small>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Age <span class="req">*</span></label>
                                        <input type="number" name="age" class="form-control" placeholder="e.g. 24" min="16"
                                            max="60">
                                    </div>

                                    <div class="col-md-8">
                                        <label class="form-label">City / Address <span class="req">*</span></label>
                                        <input type="text" name="city" class="form-control"
                                            placeholder="e.g. Vaishali Nagar, Jaipur">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">State <span class="req">*</span></label>
                                        <select name="state" class="form-select">
                                            <option value="" disabled selected>Select your state</option>
                                            <option>Rajasthan</option>
                                            <option>Delhi</option>
                                            <option>Maharashtra</option>
                                            <option>Gujarat</option>
                                            <option>Uttar Pradesh</option>
                                            <option>Madhya Pradesh</option>
                                            <option>Karnataka</option>
                                            <option>Tamil Nadu</option>
                                            <option>West Bengal</option>
                                            <option>Haryana</option>
                                            <option>Punjab</option>
                                            <option>Telangana</option>
                                            <option>Andhra Pradesh</option>
                                            <option>Kerala</option>
                                            <option>Bihar</option>
                                            <option>Other</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Current Occupation</label>
                                        <input type="text" name="occupation" class="form-control"
                                            placeholder="e.g. Student, Teacher, Freelancer">
                                    </div>

                                </div>

                                <hr class="divider">

                                <!-- Role Selection -->

                                <p
                                    style="font-size:12px;font-weight:800;text-transform:uppercase;letter-spacing:1.5px;color:var(--accent-color);margin-bottom:16px;">
                                    <i class="bi bi-briefcase me-1"></i> Area of Interest <span class="req">*</span>
                                </p>

                                <div class="role-checkbox-group mb-3">

                                    <label class="role-check-item">
                                        <input type="checkbox" name="role[]" value="acting-trainer">
                                        <span><i class="bi bi-camera-video me-1"></i> Acting Trainer</span>
                                    </label>

                                    <label class="role-check-item">
                                        <input type="checkbox" name="role[]" value="photographer">
                                        <span><i class="bi bi-camera me-1"></i> Photographer / Videographer</span>
                                    </label>

                                    <label class="role-check-item">
                                        <input type="checkbox" name="role[]" value="social-media">
                                        <span><i class="bi bi-megaphone me-1"></i> Social Media & PR</span>
                                    </label>

                                    <label class="role-check-item">
                                        <input type="checkbox" name="role[]" value="event-coordinator">
                                        <span><i class="bi bi-calendar-event me-1"></i> Event Coordinator</span>
                                    </label>

                                    <label class="role-check-item">
                                        <input type="checkbox" name="role[]" value="child-dev">
                                        <span><i class="bi bi-heart-pulse me-1"></i> Child Development</span>
                                    </label>

                                    <label class="role-check-item">
                                        <input type="checkbox" name="role[]" value="other">
                                        <span><i class="bi bi-three-dots me-1"></i> Other</span>
                                    </label>

                                </div>

                                <hr class="divider">

                                <!-- Availability & Message -->

                                <p
                                    style="font-size:12px;font-weight:800;text-transform:uppercase;letter-spacing:1.5px;color:var(--accent-color);margin-bottom:16px;">
                                    <i class="bi bi-chat-dots me-1"></i> Tell Us More
                                </p>

                                <div class="row gy-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Availability</label>
                                        <select name="availability" class="form-select">
                                            <option value="" disabled selected>How available are you?</option>
                                            <option>Weekends only</option>
                                            <option>Weekdays only</option>
                                            <option>Flexible / Both</option>
                                            <option>Online only</option>
                                            <option>Full-time</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">How did you hear about us?</label>
                                        <select name="hear_about" class="form-select">
                                            <option value="" disabled selected>Select an option</option>
                                            <option>Instagram</option>
                                            <option>WhatsApp</option>
                                            <option>Friend / Referral</option>
                                            <option>School / Event</option>
                                            <option>Google Search</option>
                                            <option>Other</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Why do you want to join Act to Action?</label>
                                        <textarea name="message" class="form-control" rows="4"
                                            placeholder="Tell us about yourself, your passion, and what you'd love to contribute to Act to Action..."></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Any relevant experience or skills?</label>
                                        <textarea name="experience" class="form-control" rows="3"
                                            placeholder="e.g. 2 years teaching theatre, event management at college, photography skills..."></textarea>
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn-submit">
                                        <i class="bi bi-send-fill"></i> Submit My Application
                                    </button>
                                </div>

                                <!-- Success message -->
                                <div class="success-msg" id="successMsg" style="display:none;">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <h5>Application Submitted Successfully! 🎉</h5>
                                    <p>Thank you for your interest in joining Act to Action. Our team will soon contact you
                                        via WhatsApp or phone.</p>
                                </div>

                            </form>

                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4" data-aos="fade-left" data-aos-delay="100">
                        <div class="info-sidebar">

                            <!-- What to Expect -->
                            <div class="info-card">
                                <h5><i class="bi bi-list-check"></i> What to Expect</h5>
                                <ul>
                                    <li><i class="bi bi-check-circle-fill"></i> Our team will review your application within
                                        2–3 working days</li>
                                    <li><i class="bi bi-check-circle-fill"></i> You'll be contacted via WhatsApp or phone
                                        call</li>
                                    <li><i class="bi bi-check-circle-fill"></i> A brief orientation session before
                                        onboarding</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Official volunteer certificate upon
                                        completion</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Letter of recommendation for dedicated
                                        volunteers</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Access to Act to Action events and shows
                                    </li>
                                </ul>
                            </div>

                            <!-- Office Hours -->
                            <div class="info-card">
                                <h5><i class="bi bi-clock"></i> Operating Hours</h5>
                                <ul>
                                    <li><i class="bi bi-calendar-week"></i>
                                        <div><strong>Tue – Sat</strong><br>11:00 AM – 7:00 PM</div>
                                    </li>
                                    <li><i class="bi bi-calendar-week"></i>
                                        <div><strong>Sunday</strong><br>10:00 AM – 4:00 PM</div>
                                    </li>
                                    <li><i class="bi bi-geo-alt-fill"></i>
                                        <div>Rising Passion Studio, Vaishali Nagar, Jaipur – 302021</div>
                                    </li>
                                </ul>
                            </div>

                            <!-- WhatsApp Contact -->
                            <div class="contact-card">
                                <h5>Have a Question?</h5>
                                <p>Not sure which role is right for you? Chat directly with our team on WhatsApp before
                                    applying — we'll help guide you to the best fit.</p>
                                <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-wa">
                                    <i class="bi bi-whatsapp"></i> Chat on WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- =================== TEAM VOICES =================== -->
        <section class="team-voices section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>From Our Team</h2>
                    <p>Hear from the passionate people already making a difference at Act to Action.</p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="voice-card">
                            <div class="quote"><i class="bi bi-quote"></i></div>
                            <p>"Being a part of Act to Action has been the most rewarding experience of my career. Watching
                                children transform from shy to stage-confident in just months is indescribable."</p>
                            <div class="author">
                                <div class="avatar">D</div>
                                <div>
                                    <h6>Deepak Chandel</h6>
                                    <span>Photographer &amp; Cinematographer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="voice-card">
                            <div class="quote"><i class="bi bi-quote"></i></div>
                            <p>"Act to Action doesn't just teach acting — it builds people. As someone with a journalism
                                background, the storytelling and creativity here is unlike anything I've experienced."</p>
                            <div class="author">
                                <div class="avatar">K</div>
                                <div>
                                    <h6>Kriti Gupta</h6>
                                    <span>PR &amp; Event Head</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="voice-card">
                            <div class="quote"><i class="bi bi-quote"></i></div>
                            <p>"Collaborating with Act to Action from a neurotherapy perspective has opened my eyes to how
                                deeply the arts can support child development. Science and art are powerful together."</p>
                            <div class="author">
                                <div class="avatar">B</div>
                                <div>
                                    <h6>Dr. Bhumika Soni</h6>
                                    <span>Child Neuro Therapist</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>

        $(document).ready(function () {

            $('#volunteerForm').submit(function (e) {

                e.preventDefault();

                let formData = new FormData(this);

                $('.text-danger').text('');

                $.ajax({

                    url: "{{ route('volunteer.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function (response) {

                        if (response.status == 200) {

                            toastr.success(response.message);

                            $('#volunteerForm')[0].reset();

                            $('#successMsg').fadeIn();

                        }

                    },

                    error: function (xhr) {

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function (key, value) {

                                $('.' + key + '_error').text(value[0]);

                            });

                            toastr.error("Please fix the errors");

                        }

                    }

                });

            });

        });

    </script>

@endsection