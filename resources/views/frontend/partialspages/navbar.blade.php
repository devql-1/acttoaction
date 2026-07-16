<header id="header" class="header fixed-top">
    @include('frontend.partialspages.contact-info')
    @include('frontend.partialspages.ann_bar')
    <div class="topbar d-flex align-items-center dark-background">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center">
                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                </i>
                @if($phone || $whatsapp)
                <i class="bi bi-whatsapp d-flex align-items-center ms-4">
                    @if($phone)
                        <a href="tel:{{ $phoneDigits }}">{{ $phone }}</a>
                    @endif
                    @if($phone && $whatsapp)
                        <span class="ms-2">|</span>
                    @endif
                    @if($whatsapp)
                        <a href="https://wa.me/{{ $whatsappDigits }}" target="_blank" class="ms-2">WhatsApp</a>
                    @endif
                </i>
                @endif
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="https://twitter.com/threatxpert" target="_blank" rel="noopener" aria-label="ThreatXpert on X" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="https://facebook.com/threatxpert" target="_blank" rel="noopener" aria-label="ThreatXpert on Facebook" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://instagram.com/threatxpert" target="_blank" rel="noopener" aria-label="ThreatXpert on Instagram" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://linkedin.com/company/threatxpert" target="_blank" rel="noopener" aria-label="ThreatXpert on LinkedIn" class="linkedin"><i class="bi bi-linkedin"></i></a>
                <a href="https://youtube.com/@threatxpert" target="_blank" rel="noopener" aria-label="ThreatXpert on YouTube" class="youtube"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <div class="logo">
                    <img src="{{ asset('img/logo/logo.png') }}" alt="ActToAction Logo">
                </div>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('threat-academy') }}"
                            class="{{ request()->routeIs('threat-academy', 'course.*') ? 'active' : '' }}">
                            Threat Academy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('event') }}" class="{{ request()->routeIs('event', 'frontend.events.*') ? 'active' : '' }}">
                            Event
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quiz-test') }}"
                            class="{{ request()->routeIs('quiz-test') ? 'active' : '' }}">
                            Skill Assessment
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.blog.index') }}"
                            class="{{ request()->routeIs('frontend.blog.*') ? 'active' : '' }}">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('merchandise') }}"
                            class="{{ request()->routeIs('merchandise') ? 'active' : '' }}">
                            Merchandise
                        </a>
                    </li>

                    {{-- About dropdown: groups About Us + Join Us + Contact Us --}}
                    @php
                        $aboutActive =
                            request()->is('aboutus') ||
                            request()->routeIs('volunteer') ||
                            request()->routeIs('contactus');
                    @endphp
                    <li class="dropdown">
                        <a href="#" class="{{ $aboutActive ? 'active' : '' }}">
                            <span>About</span><i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('aboutus') }}"
                                    class="{{ request()->is('aboutus') ? 'active' : '' }}">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('volunteer') }}"
                                    class="{{ request()->routeIs('volunteer') ? 'active' : '' }}">
                                    Join Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contactus') }}"
                                    class="{{ request()->routeIs('contactus') ? 'active' : '' }}">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('summercamp') }}"
                            class="{{ request()->routeIs('summercamp') ? 'active' : '' }}"
                            style="
            background: var(--accent-color);
            color: #fff;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
       ">
                            Cyber AI Threat Conclave
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
</header>
<style>
    /* Keep the orange topbar (email + phone) visible on scroll.
   Overrides main.css .scrolled .header .topbar { height: 0; visibility: hidden; } */
    .scrolled .header .topbar {
        height: 40px !important;
        visibility: visible !important;
        overflow: visible !important;
    }

    .navmenu a {
        text-decoration: none !important;
    }

    .logo img {
        height: 120px;
    }

    @media (max-width: 768px) {
        .logo img {
            height: 60px;
        }
    }

    @media (max-width: 480px) {
        .logo img {
            height: 50px;
        }
    }

    /* ===== ANNOUNCEMENT BAR (Below Header) ===== */
    .ann-bar {
        background: #0e1c38;
        display: flex;
        align-items: center;
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 12px;
        border-bottom: 1px solid rgba(255, 106, 0, 0.25);
        transition: max-height 0.3s ease, opacity 0.3s ease, padding 0.3s ease;
        max-height: 60px;
        opacity: 1;
        overflow: hidden;
    }

    .ann-bar.hidden {
        max-height: 0;
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
        padding: 12px 40px;
    }

    .ann-dot {
        width: 6px;
        height: 6px;
        background: #7C3AED;
        border-radius: 50%;
        flex-shrink: 0;
        animation: dotPulse 1.8s infinite;
    }

    @keyframes dotPulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.25;
        }
    }

    .ann-msg {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.8);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 640px;
    }

    .ann-msg strong {
        color: #7C3AED;
        font-weight: 700;
    }

    .ann-cta {
        background: #7C3AED;
        color: #ffffff;
        border: none;
        padding: 6px 14px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        white-space: nowrap;
        flex-shrink: 0;
        transition: background 0.2s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .ann-cta:hover {
        background: #6D28D9;
    }

    .ann-close {
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.35);
        font-size: 14px;
        cursor: pointer;
        padding: 0;
        position: absolute;
        right: 12px;
        line-height: 1;
        transition: color 0.2s ease;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ann-close:hover {
        color: #ffffff;
    }

    /* ===== TABLET (601px – 900px) ===== */
    @media (max-width: 900px) and (min-width: 601px) {
        .ann-bar {
            font-size: 11px;
            max-height: 56px;
        }

        .ann-inner {
            padding: 10px 30px;
            gap: 10px;
        }

        .ann-msg {
            max-width: 500px;
        }

        .ann-cta {
            padding: 5px 12px;
            font-size: 9px;
        }
    }

    /* ===== MOBILE (≤ 600px) ===== */
    @media (max-width: 600px) {
        .ann-bar {
            font-size: 10.5px;
            max-height: 80px;
        }

        .ann-inner {
            padding: 10px 40px 10px 12px;
            gap: 8px;
            flex-wrap: wrap;
        }

        .ann-msg {
            max-width: 100%;
            font-size: 10px;
            line-height: 1.4;
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
        }

        .ann-cta {
            display: none;
        }

        .ann-dot {
            width: 5px;
            height: 5px;
        }

        .ann-close {
            right: 6px;
            font-size: 12px;
        }
    }

    /* ===== SMALL MOBILE (≤ 380px) ===== */
    @media (max-width: 380px) {
        .ann-bar {
            font-size: 9.5px;
            max-height: 100px;
        }

        .ann-inner {
            padding: 8px 36px 8px 8px;
            gap: 6px;
        }

        .ann-msg {
            font-size: 9px;
        }

        .ann-close {
            right: 4px;
            width: 20px;
            height: 20px;
            font-size: 11px;
        }
    }

    /* ===== TOPBAR CONTACT INFO (email + phones + location) ===== */
    .header .topbar .contact-info {
        flex-wrap: wrap;
        gap: 6px 18px;
    }

    .header .topbar .contact-info i.bi-whatsapp {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0 6px;
    }

    .header .topbar .contact-info i.bi-whatsapp a {
        color: inherit;
        text-decoration: none;
    }

    .header .topbar .contact-info i.bi-whatsapp a:hover {
        text-decoration: underline;
    }

    .header .topbar .contact-info i.topbar-location {
        max-width: 260px;
    }

    .header .topbar .contact-info i.topbar-location span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .header .topbar .social-links {
        gap: 12px;
    }

    .header .topbar .social-links a {
        color: #ffffff;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        transition: background 0.2s ease, color 0.2s ease;
    }

    .header .topbar .social-links a:hover {
        background: #ffffff;
        color: #0d1b2a;
        text-decoration: none;
    }

    @media (max-width: 1100px) {
        .header .topbar .contact-info i.topbar-location {
            display: none !important;
        }
    }

    @media (max-width: 991px) {
        .header .topbar .contact-info i.bi-whatsapp a:nth-of-type(3) {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .header .topbar {
            height: auto !important;
            padding: 8px 0 !important;
        }

        .header .topbar .contact-info {
            flex-direction: column;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            line-height: 1.3;
        }

        .header .topbar .contact-info i.bi-whatsapp {
            margin-left: 0 !important;
            justify-content: center;
        }

        .header .topbar .contact-info i a,
        .header .topbar .contact-info i span {
            font-size: 13px !important;
            padding-left: 4px;
        }

        /* Show location back on mobile, stacked */
        .header .topbar .contact-info i.topbar-location {
            display: flex !important;
            margin-left: 0 !important;
            max-width: 92vw;
            justify-content: center;
        }

        .header .topbar .contact-info i.topbar-location span {
            white-space: normal;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .header .topbar .contact-info {
            font-size: 12px;
        }

        .header .topbar .contact-info i a,
        .header .topbar .contact-info i span {
            font-size: 12px !important;
        }

        .header .topbar .contact-info i.bi-whatsapp a:nth-of-type(2) {
            display: none;
        }
    }
</style>
