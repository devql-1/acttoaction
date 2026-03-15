@extends('frontend.course.layout')
@section('content')
    <style>
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

        /* ── HERO ── */
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

        .course-hero .hero-photo::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(17, 35, 68, .28) 0%, rgba(17, 35, 68, .55) 60%, rgba(17, 35, 68, .88) 100%);
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
            background: rgba(23, 92, 221, .7);
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
            color: #7aaeff;
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
            color: #7aaeff;
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
            background: var(--accent-color);
        }

        .btn-enroll:hover {
            background: color-mix(in srgb, var(--accent-color), black 12%);
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

        /* ── SWITCHER BAR ── */
        .switcher-bar {
            background: #fff;
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
            cursor: pointer;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            color: color-mix(in srgb, var(--default-color), transparent 45%);
            white-space: nowrap;
            transition: all .3s;
        }

        .sw-btn:hover {
            color: var(--default-color);
        }

        .sw-btn.active {
            color: var(--accent-color);
            border-bottom-color: var(--accent-color);
        }

        .sw-btn .sw-chip {
            font-size: 10px;
            font-weight: 800;
            padding: 2px 9px;
            border-radius: 50px;
            background: color-mix(in srgb, var(--accent-color), transparent 88%);
            color: var(--accent-color);
        }

        .sw-btn.active .sw-chip {
            background: var(--accent-color);
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

        /* ── COURSES SECTION ── */
        .courses-section {
            padding: 70px 0 90px;
        }

        /* ── ATP CARD ── */
        .atp-feature-card {
            background: var(--surface-color);
            border-radius: 24px;
            overflow: hidden;
            border: 1.5px solid color-mix(in srgb, var(--default-color), transparent 88%);
            box-shadow: 0 8px 40px color-mix(in srgb, var(--default-color), transparent 92%);
            display: flex;
            transition: all .4s;
        }

        .atp-feature-card:hover {
            box-shadow: 0 28px 70px color-mix(in srgb, var(--default-color), transparent 82%);
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
            overflow: hidden;
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
            transition: transform .5s;
        }

        .atp-feature-card:hover .fc-img img {
            transform: scale(1.05);
        }

        .fc-scrim {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, transparent 60%, rgba(255, 255, 255, .12));
        }

        .fc-badge {
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
            padding: 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
        }

        @media(max-width:768px) {
            .atp-feature-card .fc-body {
                padding: 28px 24px;
            }
        }

        .fc-tag {
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

        /* CKEditor HTML */
        .ck-description {
            font-size: .9rem;
            line-height: 1.75;
            color: color-mix(in srgb, var(--default-color), transparent 18%);
            margin-bottom: 22px;
        }

        .ck-description p {
            margin: 0 0 10px;
        }

        .ck-description ul,
        .ck-description ol {
            padding-left: 20px;
            margin-bottom: 10px;
        }

        .ck-description ul {
            list-style: disc;
        }

        .ck-description ol {
            list-style: decimal;
        }

        .ck-description li {
            margin-bottom: 4px;
        }

        .ck-description strong {
            font-weight: 700;
        }

        .ck-description em {
            font-style: italic;
        }

        .ck-description h2,
        .ck-description h3,
        .ck-description h4 {
            margin: 14px 0 8px;
        }

        .ck-description a {
            color: var(--accent-color);
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
            margin-top: 8px;
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
            border: 1.5px solid color-mix(in srgb, var(--default-color), transparent 72%);
            color: var(--default-color);
        }

        .btn-card-outline:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        /* ── STP GRID ── */
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
            transition: all .38s;
            display: flex;
            flex-direction: column;
        }

        .stp-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 28px 66px color-mix(in srgb, var(--default-color), transparent 83%);
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
            transition: transform .45s;
            display: block;
        }

        .stp-card:hover .sc-img img {
            transform: scale(1.07);
        }

        .sc-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17, 35, 68, .65) 0%, transparent 55%);
        }

        .sc-label {
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

        .sc-duration {
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

        /* ── INFO STRIP ── */
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

        /* ── SECTION TITLE ── */
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

        /* ── GALLERY ── */
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
            transition: transform .5s;
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

        /* ── TESTIMONIALS ── */
        .testimonials-section {
            padding: 80px 0;
        }

        .testimonial-item {
            background: var(--surface-color);
            border-radius: 18px;
            padding: 32px;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            box-shadow: 0 6px 24px color-mix(in srgb, var(--default-color), transparent 92%);
            height: 100%;
            transition: all .32s;
        }

        .testimonial-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 52px color-mix(in srgb, var(--default-color), transparent 83%);
        }

        .testimonial-item .stars {
            color: #f7b50d;
            margin-bottom: 14px;
        }

        .testimonial-item .stars i {
            font-size: 15px;
            margin-right: 1px;
        }

        .testimonial-item blockquote {
            font-size: .9rem;
            line-height: 1.76;
            color: color-mix(in srgb, var(--default-color), transparent 12%);
            font-style: italic;
            margin: 0 0 20px;
        }

        .t-author {
            display: flex;
            align-items: center;
            gap: 12px;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            padding-top: 16px;
        }

        .t-author .av {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            flex-shrink: 0;
            background: color-mix(in srgb, var(--accent-color), transparent 85%);
            color: var(--accent-color);
        }

        .t-author .name {
            font-size: 14px;
            font-weight: 700;
            color: var(--heading-color);
            display: block;
        }

        .t-author .role {
            font-size: 12px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
        }

        /* ── CTA BAND ── */
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

        .fade-in {
            animation: fadeUp .6s ease both;
        }
    </style>

    <main class="main">

        {{-- ═══ HERO ═══ --}}
        <section class="course-hero" id="courseHero">
            <div class="hero-breadcrumb">
                <div class="container">
                    <div class="bc-inner">
                        <a href="{{ route('home') }}">Home</a>
                        <span class="sep">/</span>
                        <a href="{{ route('index.course') }}">Courses</a>
                        <span class="sep">/</span>
                        <span class="cur">{{ $currentCategory->name }}</span>
                    </div>
                </div>
            </div>
            <div class="hero-photo">
                @php $heroCourse = $currentCategory->courses->first(); @endphp
                <img src="{{ $heroCourse && $heroCourse->banner_image ? asset($heroCourse->banner_image) : 'https://images.unsplash.com/photo-1503095396549-807759245b35?w=1600&q=85' }}"
                    alt="{{ $currentCategory->name }}" />
            </div>
            <div class="container hero-text">
                <div class="row">
                    <div class="col-lg-7">
                        <span class="hero-cat-badge">
                            <i class="bi bi-mortarboard-fill"></i> {{ $currentCategory->name }}
                        </span>
                        <h1>{{ $currentCategory->name }}</h1>
                        @if ($currentCategory->description)
                            <p class="hero-desc">{{ Str::limit(strip_tags($currentCategory->description), 160) }}</p>
                        @endif
                        @if ($heroCourse)
                            <div class="hero-meta-row">
                                @if ($heroCourse->duration)
                                    <div class="hm"><i class="bi bi-clock"></i> {{ $heroCourse->duration }}</div>
                                @endif
                                @if ($heroCourse->age_group)
                                    <div class="hm"><i class="bi bi-people"></i> Age {{ $heroCourse->age_group }}</div>
                                @endif
                                @if ($heroCourse->mode)
                                    <div class="hm"><i class="bi bi-camera-video"></i> {{ $heroCourse->mode }}</div>
                                @endif
                                @if ($currentCategory->courses->count() > 1)
                                    <div class="hm"><i class="bi bi-lightning-fill"></i>
                                        {{ $currentCategory->courses->count() }} Courses</div>
                                @endif
                            </div>
                        @endif
                        <div class="hero-actions">
                            <a href="{{ route('course.details', $heroCourse->id ?? 0) }}" class="btn-enroll">
                                <i class="bi bi-person-plus-fill"></i> Enroll Now
                            </a>
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" class="btn-wa" target="_blank">
                                <i class="bi bi-whatsapp"></i> Ask Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ═══ COURSES SECTION ═══ --}}
        <section class="courses-section">
            <div class="container">

                {{-- ── CATEGORY SWITCHER ── --}}
                <div class="switcher-bar" style="margin-bottom:40px;">
                    <div class="sb-inner">
                        @foreach ($allCategories as $cat)
                            <button class="sw-btn {{ $cat->id === $currentCategory->id ? 'active' : '' }}"
                                onclick="window.location='{{ route('course.show', $cat->id) }}'">
                                <i class="bi bi-mortarboard-fill sw-icon"></i>
                                {{ $cat->name }}
                                @php $cnt = $cat->courses->count(); @endphp
                                @if ($cnt)
                                    <span class="sw-chip">{{ $cnt }} Course{{ $cnt > 1 ? 's' : '' }}</span>
                                @endif
                            </button>
                        @endforeach
                        <button class="sw-back" onclick="window.location='{{ route('index.course') }}'">
                            <i class="bi bi-arrow-left"></i> All Categories
                        </button>
                    </div>
                </div>

                {{-- ── SINGLE COURSE → ATP feature-card layout ── --}}
                @if ($currentCategory->courses->count() === 1)
                    @php $course = $currentCategory->courses->first(); @endphp

                    <div class="atp-feature-card fade-in">
                        <div class="fc-img">
                            <img src="{{ $course->banner_image ? asset($course->banner_image) : 'https://images.unsplash.com/photo-1503095396549-807759245b35?w=900&q=85' }}"
                                alt="{{ $course->title }}" />
                            <div class="fc-scrim"></div>
                            <span class="fc-badge">{{ $currentCategory->name }}</span>
                        </div>
                        <div class="fc-body">
                            <div class="fc-tag">
                                <i class="bi bi-mortarboard-fill"></i> {{ $currentCategory->name }}
                            </div>
                            <h3>
                                {{ $course->title }}
                                @if ($course->age_group)
                                    <br><small style="font-weight:400;font-size:1rem;">Ages
                                        {{ $course->age_group }}</small>
                                @endif
                            </h3>

                            {{-- CKEditor HTML description --}}
                            <div class="ck-description">{!! $course->description !!}</div>

                            <div class="fc-meta-row">
                                @if ($course->duration)
                                    <span class="fm"><i class="bi bi-clock"></i> {{ $course->duration }}</span>
                                @endif
                                @if ($course->sessions)
                                    <span class="fm"><i class="bi bi-collection-play"></i> {{ $course->sessions }}
                                        Sessions</span>
                                @endif
                                @if ($course->age_group)
                                    <span class="fm"><i class="bi bi-people"></i> Age {{ $course->age_group }}</span>
                                @endif
                                @if ($course->mode)
                                    <span class="fm"><i class="bi bi-camera-video"></i> {{ $course->mode }}</span>
                                @endif
                                @if ($course->fees)
                                    <span class="fm"><i class="bi bi-currency-rupee"></i> {{ $course->fees }}</span>
                                @endif
                            </div>

                            <div class="fc-actions">
                                <a href="{{ route('course.details', $course->id) }}" class="btn-card-primary atp-btn">
                                    <i class="bi bi-person-plus-fill"></i> Enroll Now
                                </a>
                                @if ($course->highlights_link)
                                    <a href="{{ $course->highlights_link }}" target="_blank" class="btn-card-outline">
                                        <i class="bi bi-play-circle"></i> Watch Highlights
                                    </a>
                                @endif
                                @foreach ($course->documents as $doc)
                                    <a href="{{ asset($doc->file) }}" target="_blank" class="btn-card-outline">
                                        <i class="bi bi-download"></i> {{ $doc->title ?? 'Syllabus PDF' }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="info-strip atp-strip">
                        <div class="is-icon"><i class="bi bi-info-circle-fill"></i></div>
                        <div class="is-text">
                            <strong>New batches starting every quarter</strong>
                            <p>Limited seats per batch. Enroll early to secure your child's spot at the centre nearest to
                                you.</p>
                        </div>
                        <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="is-action">
                            <i class="bi bi-whatsapp"></i> Check Seats
                        </a>
                    </div>

                    {{-- ── MULTIPLE COURSES → STP grid-card layout ── --}}
                @else
                    @php $firstCourse = $currentCategory->courses->first(); @endphp

                    <div class="stp-grid">
                        @foreach ($currentCategory->courses as $course)
                            <div class="stp-card fade-in" style="animation-delay:{{ $loop->index * 0.1 }}s">
                                <div class="sc-img">
                                    <img src="{{ $course->banner_image ? asset($course->banner_image) : 'https://images.unsplash.com/photo-1588702547954-4800eb827c08?w=700&q=80' }}"
                                        alt="{{ $course->title }}" />
                                    <div class="sc-overlay"></div>
                                    <span class="sc-label">{{ $currentCategory->name }}</span>
                                    @if ($course->duration || $course->sessions)
                                        <div class="sc-duration">
                                            <i class="bi bi-clock"></i>
                                            {{ $course->duration }}{{ $course->duration && $course->sessions ? ' · ' : '' }}{{ $course->sessions ? $course->sessions . ' Sessions' : '' }}
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
                                    {{-- strip_tags for CKEditor content in card preview --}}
                                    <p class="sc-desc">{{ Str::limit(strip_tags($course->description), 200) }}</p>

                                    <div class="sc-footer">
                                        <div class="stp-sessions">
                                            <i class="bi bi-collection-play"></i>
                                            {{ $course->sessions ?? '10' }} Sessions
                                        </div>
                                        <a href="{{ route('course.details', $course->id) }}"
                                            class="btn-card-primary stp-btn">
                                            <i class="bi bi-person-plus-fill"></i> Enroll
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="info-strip stp-strip">
                        <div class="is-icon"><i class="bi bi-lightbulb-fill"></i></div>
                        <div class="is-text">
                            <strong>Can't decide which course to pick?</strong>
                            <p>All {{ $currentCategory->courses->count() }} courses run independently — enrol in multiple
                                tracks or start with the one that excites you most!</p>
                        </div>
                        <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="is-action">
                            <i class="bi bi-whatsapp"></i> Ask Counsellor
                        </a>
                    </div>

                    @php $course = $firstCourse; @endphp
                @endif

            </div>
        </section>

        {{-- ═══ GALLERY ═══ --}}
        <section class="gallery-section light-background">
            <div class="container">
                <div class="section-title">
                    <h2>Life at Act to Action</h2>
                    <p>Workshops, showcases, casting wins and everyday magic from our classrooms.</p>
                </div>
                <div class="gallery-grid">
                    <div class="g-item span-2">
                        <img src="https://images.unsplash.com/photo-1503095396549-807759245b35?w=900&q=80"
                            alt="Showcase" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Annual Graduation Showcase 2024</div>
                    </div>
                    <div class="g-item">
                        <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&q=80"
                            alt="Workshop" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Screen Acting Workshop</div>
                    </div>
                    <div class="g-item">
                        <img src="https://images.unsplash.com/photo-1549737221-bef65e2604a6?w=500&q=80" alt="DramATA" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">DramATA 2025</div>
                    </div>
                    <div class="g-item">
                        <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?w=500&q=80"
                            alt="Summer Camp" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Summer Camp 2024</div>
                    </div>
                    <div class="g-item">
                        <img src="https://images.unsplash.com/photo-1560523159-4a9692d222ef?w=500&q=80" alt="Awards" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Star Achievers Award Night</div>
                    </div>
                    <div class="g-item span-2">
                        <img src="https://images.unsplash.com/photo-1588702547954-4800eb827c08?w=900&q=80"
                            alt="Filmmaking" />
                        <div class="g-overlay"><i class="bi bi-zoom-in"></i></div>
                        <div class="g-caption">Mobile Filmmaking — Behind the Camera</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ═══ TESTIMONIALS ═══ --}}
        <section class="testimonials-section">
            <div class="container">
                <div class="section-title">
                    <h2>What Parents Say</h2>
                    <p>Real words from families who've seen the transformation firsthand.</p>
                </div>
                <div class="row g-4">
                    @php
                        $testimonials = [
                            [
                                'init' => 'PR',
                                'name' => 'Priya Rathore',
                                'role' => 'Parent · ATP Student, Age 8',
                                'stars' => 5,
                                'q' =>
                                    'My daughter joined ATP at age 7 and within 6 months she was shortlisted for a Zee TV audition. The confidence she has built here is beyond anything I expected.',
                            ],
                            [
                                'init' => 'AK',
                                'name' => 'Amit Kumar',
                                'role' => 'Parent · STP Public Speaking, Age 14',
                                'stars' => 5,
                                'q' =>
                                    'The Short Term Program in Public Speaking completely transformed how my son communicates. He now speaks at assemblies and has won two inter-school competitions.',
                            ],
                            [
                                'init' => 'SM',
                                'name' => 'Sunita Meena',
                                'role' => 'Parent · STP Mythology, Age 5',
                                'stars' => 5,
                                'q' =>
                                    'The Mythology & Shlok program is a hidden gem. My 5-year-old now recites Bhagavad Gita shlokas and understands their meaning. Kritesh sir and team are phenomenal.',
                            ],
                            [
                                'init' => 'DS',
                                'name' => 'Deepak Sharma',
                                'role' => 'Parent · ATP Student, Age 11',
                                'stars' => 5,
                                'q' =>
                                    'Aadvika has appeared in two brand campaigns after completing ATP. The curriculum is incredibly thorough — from voice to on-camera presence to audition technique.',
                            ],
                            [
                                'init' => 'RG',
                                'name' => 'Rahul Gupta',
                                'role' => 'Parent · STP Filmmaking, Age 13',
                                'stars' => 5,
                                'q' =>
                                    'The Mobile Filmmaking STP gave my son a complete film shoot experience. He shot, directed, edited and screened his own short film at age 13. So hands-on!',
                            ],
                            [
                                'init' => 'NJ',
                                'name' => 'Nisha Jain',
                                'role' => 'Parent · ATP Twins, Age 9',
                                'stars' => 5,
                                'q' =>
                                    'I enrolled my twins in ATP and the transformation is visible in everything — posture, voice, how they connect with people. Genuinely changing young lives.',
                            ],
                        ];
                    @endphp
                    @foreach ($testimonials as $t)
                        <div class="col-md-6 col-lg-4">
                            <div class="testimonial-item">
                                <div class="stars">
                                    @for ($s = 0; $s < $t['stars']; $s++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                </div>
                                <blockquote>"{{ $t['q'] }}"</blockquote>
                                <div class="t-author">
                                    <div class="av">{{ $t['init'] }}</div>
                                    <div>
                                        <span class="name">{{ $t['name'] }}</span>
                                        <span class="role">{{ $t['role'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ═══ CTA BAND ═══ --}}
        <div class="cta-band">
            <div class="cta-photo">
                <img src="https://images.unsplash.com/photo-1598899134739-24c46f58b8c0?w=1400&q=60" alt="CTA" />
            </div>
            <div class="container cta-inner">
                <h2>Ready to Start the Journey?</h2>
                <p>Join 1000+ students already performing, growing and shining across Jaipur.</p>
                <div class="cta-btns">
                    <a href="{{ route('course.details', $course->id) }}" class="btn-cta-solid">
                        <i class="bi bi-person-plus-fill"></i> Enroll Now
                    </a>
                    <a href="https://wa.me/message/PE3X4SUC2OJTB1" class="btn-cta-ghost" target="_blank">
                        <i class="bi bi-whatsapp"></i> WhatsApp Us
                    </a>
                </div>
            </div>
        </div>

    </main>
@endsection
