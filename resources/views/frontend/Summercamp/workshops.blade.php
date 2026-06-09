{{-- resources/views/frontend/workshops.blade.php --}}
@extends('frontend.course.layoutsummercamp')

@section('title', 'Workshops — Act To Action')

{{-- ── Styles ── --}}

@section('content')


    <style>
        /* ── Page title ── */
        .page-title {
            color: var(--default-color);
            background-color: var(--background-color);
            position: relative;
            padding-top: 100px;
        }

        /* ── Register button ── */
        .register-btn {
            background: var(--accent-color);
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s ease;
        }

        .register-btn:hover {
            opacity: 0.88;
        }

        /* ── Service button ── */
        .service-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 42px;
            border-radius: 60px;
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            color: #fff;
            font-size: 1.05rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            border: none;
            cursor: pointer;
            position: relative;
            transition: all 0.35s ease;
            box-shadow: 0 10px 25px rgba(232, 88, 0, 0.35);
        }

        .service-btn i {
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .service-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 35px rgba(232, 88, 0, 0.45);
        }

        .service-btn:hover i {
            transform: translateX(8px);
        }

        .service-btn:active {
            transform: scale(0.96);
        }

        .service-btn::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 60px;
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            filter: blur(18px);
            opacity: 0.5;
            z-index: -1;
        }

        /* ── Hero section ── */
        .workshops-hero {
            position: relative;
            min-height: 520px;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(135deg, #112344 0%, #112344 50%, #1a2e4a 100%);
            padding: 100px 0 70px;
        }

        .workshops-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 80% 50%, rgba(255, 106, 0, 0.18) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 10% 80%, rgba(232, 88, 0, 0.2) 0%, transparent 60%);
            pointer-events: none;
        }

        .workshops-hero::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 70px;
            background: var(--background-color, #fff);
            clip-path: ellipse(55% 100% at 50% 100%);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 106, 0, 0.18);
            border: 1px solid rgba(255, 106, 0, 0.35);
            color: #A78BFA;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 40px;
            margin-bottom: 20px;
        }

        .hero-badge span.dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #7C3AED;
            display: inline-block;
            animation: pulse-dot 1.8s ease-in-out infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(0.7);
            }
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.4rem);
            font-weight: 800;
            line-height: 1.15;
            color: #fff;
            margin-bottom: 20px;
        }

        .hero-title .highlight {
            background: linear-gradient(90deg, #7C3AED, #A78BFA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.75);
            max-width: 520px;
            line-height: 1.7;
            margin-bottom: 36px;
        }

        .hero-stats {
            display: flex;
            gap: 36px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .hero-stat {
            text-align: left;
        }

        .hero-stat .stat-number {
            font-size: 1.9rem;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .hero-stat .stat-label {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 4px;
        }

        .hero-visual {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-float-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 18px;
            padding: 22px 28px;
            color: #fff;
            max-width: 290px;
            animation: float-card 4s ease-in-out infinite;
        }

        @keyframes float-card {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .hero-float-card .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 14px;
        }

        .hero-float-card h5 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: #fff;
        }

        .hero-float-card p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
        }

        .hero-float-card-sm {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 14px;
            padding: 14px 18px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 16px;
            max-width: 260px;
            margin-left: auto;
            animation: float-card 4s ease-in-out 2s infinite;
        }

        .hero-float-card-sm .sm-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255, 106, 0, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .hero-float-card-sm .sm-text {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.85);
        }

        .hero-float-card-sm .sm-text strong {
            display: block;
            font-size: 0.92rem;
            color: #fff;
            margin-bottom: 2px;
        }

        /* ── Why choose section ── */
        .why-choose-section {
            padding: 90px 0 80px;
            background: var(--background-color, #fff);
        }

        .section-eyebrow {
            display: inline-block;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--accent-color, #112344);
            margin-bottom: 14px;
        }

        .section-title {
            font-size: clamp(1.6rem, 3.5vw, 2.4rem);
            font-weight: 800;
            color: var(--heading-color, #112344);
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .section-desc {
            font-size: 1rem;
            color: var(--default-color, #555);
            max-width: 560px;
            line-height: 1.7;
        }

        .why-feature-card {
            padding: 36px 30px;
            border-radius: 20px;
            background: #f8faff;
            border: 1px solid #e8edf8;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .why-feature-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #7C3AED, #6D28D9);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
            border-radius: 4px 4px 0 0;
        }

        .why-feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(17, 35, 68, 0.1);
            border-color: #ffbf99;
        }

        .why-feature-card:hover::before {
            transform: scaleX(1);
        }

        .why-icon-wrap {
            width: 62px;
            height: 62px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(255, 106, 0, 0.15), rgba(232, 88, 0, 0.15));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 22px;
            color: #112344;
        }

        .why-feature-card h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--heading-color, #112344);
            margin-bottom: 10px;
        }

        .why-feature-card p {
            font-size: 0.92rem;
            color: var(--default-color, #666);
            line-height: 1.65;
            margin: 0;
        }

        /* ── Testimonials ── */
        .testimonials-section {
            padding: 90px 0 80px;
            background: linear-gradient(135deg, #fff4ee 0%, #fff0e8 100%);
            position: relative;
            overflow: hidden;
        }

        .testimonials-section::before {
            content: "";
            position: absolute;
            top: -80px;
            right: -80px;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 106, 0, 0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .testimonials-section::after {
            content: "";
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(232, 88, 0, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .testimonial-card {
            background: #fff;
            border-radius: 20px;
            padding: 34px 30px;
            height: 100%;
            border: 1px solid rgba(232, 88, 0, 0.12);
            box-shadow: 0 4px 24px rgba(17, 35, 68, 0.06);
            transition: all 0.3s ease;
            position: relative;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 48px rgba(17, 35, 68, 0.12);
        }

        .testimonial-quote-icon {
            font-size: 3.5rem;
            line-height: 1;
            color: #ffd5b8;
            font-family: Georgia, serif;
            margin-bottom: 6px;
            display: block;
        }

        .testimonial-stars {
            color: #f59e0b;
            font-size: 0.9rem;
            margin-bottom: 16px;
            letter-spacing: 2px;
        }

        .testimonial-text {
            font-size: 0.96rem;
            color: #555;
            line-height: 1.75;
            margin-bottom: 24px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 14px;
            border-top: 1px solid #eef1f8;
            padding-top: 20px;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .testimonial-author-info .name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #112344;
            margin-bottom: 2px;
        }

        .testimonial-author-info .role {
            font-size: 0.82rem;
            color: #888;
        }

        .testimonial-tag {
            position: absolute;
            top: 22px;
            right: 22px;
            background: linear-gradient(135deg, rgba(255, 106, 0, 0.12), rgba(232, 88, 0, 0.12));
            color: #112344;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid rgba(232, 88, 0, 0.2);
        }

        /* ── How it works ── */
        .how-it-works-section {
            padding: 90px 0 80px;
            background: #f8faff;
            position: relative;
            overflow: hidden;
        }

        .how-it-works-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #7C3AED, #6D28D9);
        }

        .step-connector {
            display: none;
        }

        @media (min-width: 992px) {
            .step-connector {
                display: flex;
                align-items: center;
                justify-content: center;
                padding-top: 32px;
            }

            .step-connector-line {
                flex: 1;
                height: 2px;
                background: linear-gradient(90deg, #7C3AED 0%, #6D28D9 100%);
                border-radius: 2px;
                margin: 0 8px;
            }
        }

        .step-card {
            background: #fff;
            border-radius: 20px;
            padding: 36px 28px 30px;
            text-align: center;
            border: 1px solid #fde8d8;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
        }

        .step-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 48px rgba(17, 35, 68, 0.1);
            border-color: #ffbf99;
        }

        .step-number {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            color: #fff;
            font-size: 1.3rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(232, 88, 0, 0.3);
        }

        .step-card h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: #112344;
            margin-bottom: 10px;
        }

        .step-card p {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.65;
            margin: 0;
        }

        .step-icon-badge {
            position: absolute;
            top: -14px;
            right: 20px;
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border: 1px solid #bae6fd;
            border-radius: 10px;
            padding: 6px 10px;
            font-size: 1.3rem;
            line-height: 1;
        }

        /* ── FAQ ── */
        .faq-section {
            padding: 90px 0 80px;
            background: #fff;
        }

        .faq-accordion .accordion-button {
            font-weight: 600;
            font-size: 0.97rem;
            color: #112344;
            background: #f8faff;
            border-radius: 12px !important;
            box-shadow: none !important;
        }

        .faq-accordion .accordion-button:not(.collapsed) {
            color: #112344;
            background: linear-gradient(135deg, rgba(255, 106, 0, 0.08), rgba(232, 88, 0, 0.08));
        }

        .faq-accordion .accordion-button::after {
            filter: none;
        }

        .faq-accordion .accordion-item {
            border: 1px solid #fde8d8;
            border-radius: 12px !important;
            margin-bottom: 12px;
            overflow: hidden;
        }

        .faq-accordion .accordion-body {
            font-size: 0.93rem;
            color: #555;
            line-height: 1.75;
            background: #fff;
            padding: 18px 24px;
        }

        .faq-side-card {
            background: linear-gradient(135deg, #112344, #1a2e4a);
            border-radius: 22px;
            padding: 40px 34px;
            color: #fff;
            position: sticky;
            top: 100px;
        }

        .faq-side-card h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .faq-side-card p {
            font-size: 0.93rem;
            color: rgba(255, 255, 255, 0.78);
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .faq-contact-item {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 12px;
            text-decoration: none;
            color: #fff;
            transition: background 0.2s;
        }

        .faq-contact-item:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
        }

        .faq-contact-item i {
            font-size: 1.3rem;
            flex-shrink: 0;
            color: #A78BFA;
        }

        .faq-contact-item span {
            font-size: 0.9rem;
        }

        .faq-contact-item strong {
            display: block;
            font-size: 0.97rem;
        }

        /* ── Hero CTA button ── */
        .hero-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            padding: 14px 34px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(232, 88, 0, 0.4);
            margin-top: 32px;
            border: none;
            cursor: pointer;
        }

        .hero-cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 36px rgba(232, 88, 0, 0.5);
            color: #fff;
        }

        .hero-cta-btn i {
            transition: transform 0.3s;
        }

        .hero-cta-btn:hover i {
            transform: translateX(5px);
        }

        /* ── Workshop Filter Card ── */
        .wk-filter-wrap {
            background: #fff;
            border-radius: 20px;
            padding: 40px 40px 36px;
            box-shadow: 0 8px 40px rgba(17, 35, 68, .1);
            border: 1px solid #fde8d8;
            max-width: 760px;
            margin: 0 auto 48px;
        }

        .wk-filter-wrap .filter-label {
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #112344;
            margin-bottom: 8px;
            display: block;
        }

        .wk-filter-wrap select {
            width: 100%;
            padding: 13px 18px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: .95rem;
            font-weight: 500;
            color: #333;
            background: #fafafa;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%237C3AED' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 44px;
        }

        .wk-filter-wrap select:focus {
            outline: none;
            border-color: #7C3AED;
            box-shadow: 0 0 0 3px rgba(255, 106, 0, .12);
            background-color: #fff;
        }

        .wk-filter-wrap select:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .wk-filter-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 28px;
            color: #ccc;
            font-size: 1.3rem;
        }

        /* ── Workshop Card ── */
        .wk-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #f0e8e0;
            box-shadow: 0 4px 20px rgba(17, 35, 68, .07);
            transition: transform .3s ease, box-shadow .3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .wk-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 48px rgba(17, 35, 68, .13);
        }

        .wk-card-img-wrap {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: linear-gradient(135deg, #fde8d8, #ffd5b8);
        }

        .wk-card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }

        .wk-card:hover .wk-card-img-wrap img {
            transform: scale(1.05);
        }

        .wk-card-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffbf99;
            font-size: 3.5rem;
        }

        .wk-card-age-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: #112344;
            color: #fff;
            font-size: .74rem;
            font-weight: 700;
            letter-spacing: .5px;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .wk-card-body {
            padding: 22px 24px 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .wk-card-timing {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #fff4ee;
            border: 1px solid #ffd5b8;
            color: #6D28D9;
            font-size: .78rem;
            font-weight: 600;
            padding: 4px 11px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .wk-card-title {
            font-size: 1.12rem;
            font-weight: 800;
            color: #112344;
            margin: 0 0 8px;
            line-height: 1.3;
        }

        .wk-card-desc {
            font-size: .88rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 14px;
            flex: 1;
        }

        .wk-card-meta {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 18px;
        }

        .wk-card-meta-item {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            font-size: .84rem;
            color: #555;
        }

        .wk-card-meta-item i {
            color: #7C3AED;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .wk-card-fees {
            background: #fff4ee;
            border-radius: 10px;
            padding: 10px 16px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .wk-card-fees .fees-label {
            font-size: .78rem;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .wk-card-fees .fees-value {
            font-size: 1rem;
            font-weight: 800;
            color: #6D28D9;
            margin-left: auto;
        }

        .wk-card-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            color: #fff;
            font-size: .92rem;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: opacity .2s, transform .2s;
        }

        .wk-card-btn:hover {
            opacity: .9;
            transform: translateY(-1px);
            color: #fff;
        }

        /* ── Results header ── */
        .wk-results-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 2px solid #fde8d8;
        }

        .wk-results-header h4 {
            font-size: 1.3rem;
            font-weight: 800;
            color: #112344;
            margin: 0;
        }

        .wk-results-header p {
            font-size: .87rem;
            color: #888;
            margin: 4px 0 0;
        }

        .wk-count-badge {
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            color: #fff;
            font-size: .85rem;
            font-weight: 700;
            padding: 6px 18px;
            border-radius: 20px;
            white-space: nowrap;
        }
    </style>
    {{-- ── Hero Section ── --}}
    <section class="workshops-hero">
        <div class="container position-relative">
            <div class="row align-items-center">

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-badge">
                        <span class="dot"></span>
                        Skill India Mission &amp; NEP 2020
                    </div>
                    <h1 class="hero-title">
                        Discover Workshops That <span class="highlight">Transform Children</span>
                    </h1>
                    <p class="hero-subtitle">
                        Hands-on professional skill workshops designed for young minds — empowering kids with real-world
                        abilities, creativity, and confidence from an early age.
                    </p>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="stat-number">50+</div>
                            <div class="stat-label">Workshops</div>
                        </div>
                        <div class="hero-stat">
                            <div class="stat-number">20+</div>
                            <div class="stat-label">Cities</div>
                        </div>
                        <div class="hero-stat">
                            <div class="stat-number">10K+</div>
                            <div class="stat-label">Children Trained</div>
                        </div>
                        <div class="hero-stat">
                            <div class="stat-number">98%</div>
                            <div class="stat-label">Parent Satisfaction</div>
                        </div>
                    </div>

                    <a href="#workshopFilter" class="hero-cta-btn">
                        Find a Workshop Near You <i class="bi bi-arrow-down-circle"></i>
                    </a>
                </div>

                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div>
                            <div class="hero-float-card">
                                <div class="card-icon">
                                    <i class="bi bi-stars"></i>
                                </div>
                                <h5>NEP 2020 Aligned Curriculum</h5>
                                <p>Every workshop follows India's National Education Policy 2020 for holistic child
                                    development.</p>
                            </div>
                            <div class="hero-float-card-sm">
                                <div class="sm-icon">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <div class="sm-text">
                                    <strong>Certified Trainers</strong>
                                    Expert educators with proven track records
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Why Choose Section ── --}}
    <section class="why-choose-section">
        <div class="container">

            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-7">
                    <span class="section-eyebrow">Why Act To Action</span>
                    <h2 class="section-title">Why Parents Trust Our Workshops</h2>
                    <p class="section-desc mx-auto">
                        We blend structured learning with hands-on fun, ensuring every child gains skills they'll carry for
                        life.
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <h4>Government-Backed Curriculum</h4>
                        <p>Workshops designed in alignment with Skill India Mission and NEP 2020 — trusted by thousands of
                            schools and parents nationwide.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4>Age-Appropriate Learning</h4>
                        <p>Every workshop is carefully tailored to specific age groups, ensuring the content, pace, and
                            activities are just right for your child.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-lightbulb-fill"></i>
                        </div>
                        <h4>Hands-On, Practical Skills</h4>
                        <p>No rote learning — children engage in real projects, activities, and challenges that build
                            critical thinking and creativity.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h4>Available Across India</h4>
                        <p>With workshops in 20+ cities and growing, we bring quality skill training to your neighbourhood —
                            offline and accessible.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <h4>Expert Certified Trainers</h4>
                        <p>Our educators are trained, certified professionals who specialise in child development and
                            experiential learning methodologies.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="why-feature-card">
                        <div class="why-icon-wrap">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Safe &amp; Supportive Environment</h4>
                        <p>Every workshop is conducted in a safe, inclusive, and encouraging space where children feel
                            confident to explore and grow.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Workshop Filter + Cards (AJAX) ── --}}
    <section class="section" id="workshopFilter" style="padding-top:70px;padding-bottom:70px;background:#fff8f4;">
        <div class="container">

            {{-- Section heading --}}
            <div class="text-center mb-5">
                <span class="section-eyebrow">Explore by Age &amp; Location</span>
                <h2 class="section-title">Find Your Perfect Workshop</h2>
                <p class="section-desc mx-auto">Choose an age group and city — we'll show the best workshops near you.</p>
            </div>

            {{-- Filter card --}}
            <div class="wk-filter-wrap">
                <div class="row g-4 align-items-end">
                    <div class="col-md-6">
                        <label class="filter-label"><i class="bi bi-people-fill me-1" style="color:#7C3AED"></i> Age
                            Group</label>
                        <select id="ageGroupSelect">
                            <option value="">— Select Age Group —</option>
                            @foreach ($ageGroups as $group)
                                <option value="{{ $group->id }}" data-name="{{ $group->name }}">{{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 wk-filter-divider d-none d-md-flex">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                    <div class="col-md-5">
                        <label class="filter-label"><i class="bi bi-geo-alt-fill me-1" style="color:#7C3AED"></i>
                            City</label>
                        <select id="citySelect" disabled>
                            <option value="">— Select City —</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Results rendered by JS --}}
            <div id="workshopResults">
                <div class="text-center py-5">
                    <i class="bi bi-search" style="font-size:3rem;color:#ffbf99"></i>
                    <p class="text-muted mt-3 mb-0">Select an <strong>age group</strong> above to discover workshops.</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ── How It Works ── --}}
    <section class="how-it-works-section">
        <div class="container">

            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-7">
                    <span class="section-eyebrow">Simple 4-Step Process</span>
                    <h2 class="section-title">How to Register for a Workshop</h2>
                    <p class="section-desc mx-auto">
                        Enrolling your child takes less than 3 minutes. Here's how it works.
                    </p>
                </div>
            </div>

            <div class="row g-4 align-items-start">

                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <span class="step-icon-badge">👶</span>
                        <div class="step-number">1</div>
                        <h4>Choose Age Group</h4>
                        <p>Select the right age category for your child — workshops are designed for specific developmental
                            stages.</p>
                    </div>
                </div>

                <div class="col-lg-auto d-none d-lg-flex step-connector">
                    <div class="step-connector-line"></div>
                    <i class="bi bi-chevron-right" style="color:#6D28D9;font-size:1.1rem;"></i>
                    <div class="step-connector-line"></div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <span class="step-icon-badge">📍</span>
                        <div class="step-number">2</div>
                        <h4>Select Your City</h4>
                        <p>Pick the city nearest to you. We have workshops running across 20+ locations all over India.</p>
                    </div>
                </div>

                <div class="col-lg-auto d-none d-lg-flex step-connector">
                    <div class="step-connector-line"></div>
                    <i class="bi bi-chevron-right" style="color:#6D28D9;font-size:1.1rem;"></i>
                    <div class="step-connector-line"></div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <span class="step-icon-badge">🏫</span>
                        <div class="step-number">3</div>
                        <h4>Pick a Workshop</h4>
                        <p>Browse the available workshops for your chosen city and age group, check timings and fees.</p>
                    </div>
                </div>

                <div class="col-lg-auto d-none d-lg-flex step-connector">
                    <div class="step-connector-line"></div>
                    <i class="bi bi-chevron-right" style="color:#6D28D9;font-size:1.1rem;"></i>
                    <div class="step-connector-line"></div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <span class="step-icon-badge">✅</span>
                        <div class="step-number">4</div>
                        <h4>Register &amp; Pay</h4>
                        <p>Fill in your child's details and complete the secure payment online. Get confirmation instantly
                            by email.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- ── Testimonials Section ── --}}
    <section class="testimonials-section">
        <div class="container position-relative">

            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-7">
                    <span class="section-eyebrow">Testimonials</span>
                    <h2 class="section-title">What Parents &amp; Kids Are Saying</h2>
                    <p class="section-desc mx-auto">
                        Real stories from families who've experienced the Act To Action difference firsthand.
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Coding Workshop</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            My daughter came home on Day 1 and built a mini app herself. I was stunned. The trainers make
                            complex ideas feel so natural for kids. Best investment we've made in her education.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">PR</div>
                            <div class="testimonial-author-info">
                                <div class="name">Priya Rajput</div>
                                <div class="role">Parent &mdash; Jaipur</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Communication Skills</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            My son used to be very shy. After just two weekends at the communication workshop,
                            he gave a speech at his school assembly. The difference was remarkable and lasting.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">AM</div>
                            <div class="testimonial-author-info">
                                <div class="name">Amit Mehta</div>
                                <div class="role">Parent &mdash; Delhi</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Art &amp; Design</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            The Art &amp; Design workshop was incredible. My twins learned about colour theory,
                            design thinking, and even created their own brand logos. Truly professional quality.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">SK</div>
                            <div class="testimonial-author-info">
                                <div class="name">Sunita Kapoor</div>
                                <div class="role">Parent &mdash; Mumbai</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Financial Literacy</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            My 12-year-old now manages his pocket money with a budget and even started
                            a small savings goal. The financial literacy workshop gave him real life skills.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">RV</div>
                            <div class="testimonial-author-info">
                                <div class="name">Rakesh Verma</div>
                                <div class="role">Parent &mdash; Pune</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Leadership Camp</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            The leadership workshop was phenomenal. My daughter leads her school project teams
                            with confidence and empathy now. The facilitators were truly world-class.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">NS</div>
                            <div class="testimonial-author-info">
                                <div class="name">Neha Sharma</div>
                                <div class="role">Parent &mdash; Bengaluru</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <span class="testimonial-tag">Science &amp; Robotics</span>
                        <span class="testimonial-quote-icon">"</span>
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">
                            My son built his first robot at age 9. He calls it his greatest achievement. The
                            science and robotics workshop sparked a curiosity in him that no school had managed to ignite.
                        </p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">DG</div>
                            <div class="testimonial-author-info">
                                <div class="name">Deepak Gupta</div>
                                <div class="role">Parent &mdash; Hyderabad</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── FAQ Section ── --}}
    <section class="faq-section">
        <div class="container">

            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-7">
                    <span class="section-eyebrow">FAQ</span>
                    <h2 class="section-title">Frequently Asked Questions</h2>
                    <p class="section-desc mx-auto">
                        Everything parents ask before registering their child.
                    </p>
                </div>
            </div>

            <div class="row g-4 align-items-start">

                {{-- Accordion --}}
                <div class="col-lg-8">
                    <div class="accordion faq-accordion" id="workshopFaq">

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    What age groups are the workshops designed for?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#workshopFaq">
                                <div class="accordion-body">
                                    Our workshops are organised into specific age groups — typically ranging from early
                                    childhood (4–7 years) through to pre-teens and teens (13–17 years). Each group has a
                                    tailored curriculum so the pace, activities and complexity are always just right for
                                    your child's stage of development.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2">
                                    How long does each workshop last?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#workshopFaq">
                                <div class="accordion-body">
                                    Most workshops run over 2–3 days (typically on a weekend), with sessions of 3–4 hours
                                    per day. Specific timings are shown on each workshop listing. Some intensive programs
                                    run over a full week — details are mentioned on the individual workshop page.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3">
                                    Can I register more than one child at a time?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#workshopFaq">
                                <div class="accordion-body">
                                    Yes! You can register up to 5 children in a single booking. Each child's details are
                                    entered separately during the registration process and a combined payment is made in one
                                    step. Sibling discounts may apply — contact us for details.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4">
                                    Is online payment secure?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#workshopFaq">
                                <div class="accordion-body">
                                    Absolutely. All payments are processed through Razorpay — India's most trusted payment
                                    gateway — using bank-grade 256-bit SSL encryption. We never store your card details.
                                    You'll receive an instant email confirmation with a payment receipt once the transaction
                                    is complete.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq5">
                                    What is the refund or cancellation policy?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#workshopFaq">
                                <div class="accordion-body">
                                    Registrations can be cancelled up to 48 hours before the workshop start date for a full
                                    refund. Cancellations within 48 hours are eligible for a credit note valid for 6 months.
For queries, contact us at <a href="mailto:info@threatxpert.com">info@threatxpert.com</a>
                                     or call our helpline.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq6">
                                    Do children receive a certificate after completing the workshop?
                                </button>
                            </h2>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#workshopFaq">
                                <div class="accordion-body">
                                    Yes! Every child who completes a workshop receives a digitally signed Certificate of
                                    Achievement from Act To Action. The certificate mentions the skill area, hours
                                    completed, and is aligned with the Skill India Mission framework — making it a
                                    meaningful addition to your child's portfolio.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Side contact card --}}
                <div class="col-lg-4">
                    <div class="faq-side-card">
                        <h4>Still have questions?</h4>
                        <p>Our team is available Mon–Sat, 9 AM to 7 PM. We're happy to help you pick the right workshop for
                            your child.</p>

                        <a href="tel:9119118844" class="faq-contact-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span>
                                <strong>+91 91191 88844</strong>
                                Call our helpline
                            </span>
                        </a>

                        <a href="https://wa.me/919119118844" target="_blank" rel="noopener" class="faq-contact-item">
                            <i class="bi bi-whatsapp"></i>
                            <span>
                                <strong>WhatsApp Us</strong>
                                Quick replies on WhatsApp
                            </span>
                        </a>

                        <a href="mailto:info@threatxpert.com" class="faq-contact-item">
                            <i class="bi bi-envelope-fill"></i>
                            <span>
                                <strong>info@threatxpert.com</strong>
                                Email us anytime
                            </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── CTA ── --}}
    <section class="call-to-action section light-background">
        <div class="container">
            <div class="contact-block">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="contact-content">
                            <h2>Not Sure Which Workshop to Choose?</h2>
                            <p>Our team is here to help you find the perfect workshop for your child's interests and
                                development goals.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-actions">
                            <a href="tel:9119118844" class="emergency-call">
                                <i class="bi bi-telephone-fill"></i>
                                <span>Call Us: +91 91191 88844</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        (function() {
            'use strict';

            var WORKSHOPS_URL = '{{ route('workshops') }}';

            var ageGroupSelect = document.getElementById('ageGroupSelect');
            var citySelect = document.getElementById('citySelect');
            var resultsEl = document.getElementById('workshopResults');

            // ── Age-group dropdown change ─────────────────────────────────────────────
            ageGroupSelect.addEventListener('change', function() {
                var ageGroupId = this.value;

                // Reset city
                citySelect.innerHTML = '<option value="">— Select City —</option>';
                citySelect.disabled = true;

                if (!ageGroupId) {
                    showPlaceholder(
                        '<i class="bi bi-search" style="font-size:3rem;color:#ffbf99"></i><p class="text-muted mt-3 mb-0">Select an <strong>age group</strong> above to discover workshops.</p>'
                        );
                    return;
                }

                var ageName = ageGroupSelect.options[ageGroupSelect.selectedIndex].dataset.name;
                showPlaceholder(
                    '<div class="spinner-border" style="color:#7C3AED;width:2rem;height:2rem;" role="status"></div><p class="text-muted mt-3">Loading cities…</p>'
                    );

                fetch(WORKSHOPS_URL + '?age_group_id=' + ageGroupId, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(function(r) {
                        return r.json();
                    })
                    .then(function(data) {
                        if (!data.cities || data.cities.length === 0) {
                            showPlaceholder(
                                '<i class="bi bi-geo-alt" style="font-size:3rem;color:#ffbf99"></i><p class="text-muted mt-3">No cities available for <strong>' +
                                esc(ageName) + '</strong> yet.</p>');
                            return;
                        }
                        data.cities.forEach(function(city) {
                            var opt = document.createElement('option');
                            opt.value = city.id;
                            opt.textContent = city.name;
                            citySelect.appendChild(opt);
                        });
                        citySelect.disabled = false;
                        showPlaceholder(
                            '<i class="bi bi-geo-alt-fill" style="font-size:3rem;color:#ffbf99"></i><p class="text-muted mt-3">Now select a <strong>city</strong> to see workshops for <strong>' +
                            esc(ageName) + '</strong>.</p>');
                    })
                    .catch(function() {
                        showPlaceholder(
                            '<i class="bi bi-exclamation-circle" style="font-size:3rem;color:#ccc"></i><p class="text-muted mt-3">Could not load cities. Please try again.</p>'
                            );
                    });
            });

            // ── City select → load workshops ──────────────────────────────────────────
            citySelect.addEventListener('change', function() {
                var cityId = this.value;
                var ageGroupId = ageGroupSelect.value;

                if (!cityId || !ageGroupId) return;

                showLoading();

                fetch(WORKSHOPS_URL + '?age_group_id=' + ageGroupId + '&city_id=' + cityId, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(function(r) {
                        return r.json();
                    })
                    .then(function(data) {
                        renderWorkshops(data);
                    })
                    .catch(function() {
                        showPlaceholder(
                            '<i class="bi bi-exclamation-circle" style="font-size:3rem;color:#ccc"></i><p class="text-muted mt-3">Could not load workshops. Please try again.</p>'
                            );
                    });
            });

            // ── Render workshop cards ──────────────────────────────────────────────────
            function renderWorkshops(data) {
                if (data.count === 0) {
                    resultsEl.innerHTML =
                        '<div class="text-center py-5">' +
                        '<i class="bi bi-building-x" style="font-size:3.5rem;color:#ffbf99"></i>' +
                        '<h4 class="mt-3" style="color:#112344">No Workshops Found</h4>' +
                        '<p class="text-muted">No workshops in <strong>' + esc(data.city_name) +
                        '</strong> for <strong>' + esc(data.age_group_name) + '</strong> yet. Check back soon!</p>' +
                        '<a href="tel:9119118844" class="wk-card-btn d-inline-block mt-2" style="width:auto;padding:12px 28px"><i class="bi bi-telephone-fill me-2"></i>Call Us</a>' +
                        '</div>';
                    return;
                }

                // Results header
                var html =
                    '<div class="wk-results-header">' +
                    '<div>' +
                    '<h4>Workshops in ' + esc(data.city_name) + '</h4>' +
                    '<p>Age Group: <strong>' + esc(data.age_group_name) + '</strong>' + (data.age_group_desc ?
                        ' &mdash; ' + esc(data.age_group_desc) : '') + '</p>' +
                    '</div>' +
                    '<span class="wk-count-badge"><i class="bi bi-grid-3x3-gap-fill me-1"></i>' + data.count +
                    ' Workshop' + (data.count !== 1 ? 's' : '') + '</span>' +
                    '</div>' +
                    '<div class="row g-4">';

                data.schools.forEach(function(s) {
                    // Image or placeholder
                    var imgHtml = s.image_url ?
                        '<img src="' + esc(s.image_url) + '" alt="' + esc(s.name) + '">' :
                        '<div class="wk-card-img-placeholder"><i class="bi bi-building"></i></div>';

                    // Timing badge
                    var timingHtml = s.timings ?
                        '<span class="wk-card-timing"><i class="bi bi-clock-fill"></i>' + esc(s.timings) +
                        '</span>' :
                        '';

                    // Description (truncated)
                    var descHtml = s.description ?
                        '<p class="wk-card-desc">' + esc(s.description).substring(0, 130) + (s.description
                            .length > 130 ? '…' : '') + '</p>' :
                        '<p class="wk-card-desc" style="color:#bbb;font-style:italic">No description available.</p>';

                    // Address
                    var addrHtml = s.address ?
                        '<div class="wk-card-meta-item"><i class="bi bi-pin-map-fill"></i><span>' + esc(s
                            .address) + '</span></div>' :
                        '';

                    // City line
                    var cityHtml = '<div class="wk-card-meta-item"><i class="bi bi-geo-alt-fill"></i><span>' +
                        esc(data.city_name) + '</span></div>';

                    // Fees
                    var feesHtml = s.fees ?
                        '<div class="wk-card-fees"><span class="fees-label"><i class="bi bi-tag-fill me-1"></i>Fees</span><span class="fees-value">' +
                        esc(s.fees) + '</span></div>' :
                        '';

                    html +=
                        '<div class="col-lg-4 col-md-6">' +
                        '<div class="wk-card">' +
                        '<div class="wk-card-img-wrap">' + imgHtml + '<span class="wk-card-age-badge">' + esc(
                            data.age_group_name) + '</span></div>' +
                        '<div class="wk-card-body">' +
                        timingHtml +
                        '<h3 class="wk-card-title">' + esc(s.name) + '</h3>' +
                        descHtml +
                        '<div class="wk-card-meta">' + cityHtml + addrHtml + '</div>' +
                        feesHtml +
                        '<a href="' + esc(s.url) +
                        '" class="wk-card-btn">Register Now &nbsp;<i class="bi bi-arrow-right"></i></a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                });

                html += '</div>';
                resultsEl.innerHTML = html;
            }

            // ── Helpers ───────────────────────────────────────────────────────────────
            function showLoading() {
                resultsEl.innerHTML =
                    '<div class="text-center py-5">' +
                    '<div class="spinner-border" style="color:#7C3AED;width:2.8rem;height:2.8rem;border-width:3px;" role="status"></div>' +
                    '<p class="text-muted mt-3 mb-0" style="font-size:.95rem">Finding workshops near you…</p>' +
                    '</div>';
            }

            function showPlaceholder(inner) {
                resultsEl.innerHTML = '<div class="text-center py-5">' + inner + '</div>';
            }

            function esc(str) {
                if (str == null) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;');
            }
        }());
    </script>

@endsection
