<header class="sh" id="siteHeader">
    <div class="sh-container">
        <div class="sh-brand">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="sh-logo">
                <img src="{{ asset('img/logo/logo.png') }}" alt="ActToAction Logo">
            </a>

            {{-- Right side: socials + nav + hamburger --}}
            <div class="sh-right">

                {{-- Social icons (hidden on mobile) --}}
                <div class="sh-soc">
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                </div>

                {{-- Mobile drawer wrapper --}}
                <div class="sh-drawer" id="shDrawer">
                    <nav class="sh-nav">

                        {{-- Drawer close button (mobile only) --}}
                        <button class="sh-close" id="shClose" aria-label="Close menu">&#x2715;</button>

                        @php
                            $aboutActive = request()->is('aboutus')
                                || request()->routeIs('volunteer')
                                || request()->routeIs('contactus');
                        @endphp
                        <ul class="sh-menu">
                            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'sh-active' : '' }}">Home</a></li>
                            <li><a href="{{ route('index.course') }}" class="{{ request()->routeIs('index.course') ? 'sh-active' : '' }}">Threat Academy</a></li>
                            <li><a href="{{ route('event') }}" class="{{ request()->routeIs('event') ? 'sh-active' : '' }}">Event</a></li>
                            <li><a href="{{ route('quiz-test') }}" class="{{ request()->routeIs('quiz-test') ? 'sh-active' : '' }}">Skill Assessment</a></li>
                            <li><a href="{{ route('frontend.blog.index') }}" class="{{ request()->routeIs('frontend.blog.*') ? 'sh-active' : '' }}">Blog</a></li>
                            <li><a href="{{ route('merchandise') }}" class="{{ request()->routeIs('merchandise') ? 'sh-active' : '' }}">Merchandise</a></li>

                            {{-- About dropdown --}}
                            <li class="sh-has-drop">
                                <a href="#" class="{{ $aboutActive ? 'sh-active' : '' }}">
                                    About <i class="bi bi-chevron-down sh-arrow"></i>
                                </a>
                                <ul class="sh-drop">
                                    <li><a href="{{ route('aboutus') }}" class="sh-leaf {{ request()->is('aboutus') ? 'sh-active' : '' }}">About Us</a></li>
                                    <li><a href="{{ route('volunteer') }}" class="sh-leaf {{ request()->routeIs('volunteer') ? 'sh-active' : '' }}">Join Us</a></li>
                                    <li><a href="{{ route('contactus') }}" class="sh-leaf {{ request()->routeIs('contactus') ? 'sh-active' : '' }}">Contact Us</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('summercamp') }}"
                                    class="sh-cta {{ request()->routeIs('summercamp', 'summercamp.partners', 'event.summercamp', 'summercamp.event', 'frontend.events.subevent-detail') ? 'sh-active' : '' }}">
                                    Cyber AI Threat Conclave <i class="bi bi-arrow-right"></i>
                                </a>
                            </li>
                        </ul>

                    </nav>
                </div>

                {{-- Hamburger (mobile only) --}}
                <button class="sh-toggle" id="shToggle" aria-label="Open menu">&#9776;</button>

            </div>
        </div>
    </div>
</header>





<script>
    (function() {
        'use strict';

        const BP = 1099; // mobile breakpoint
        let openDrop = null;
        let openSub = null;
        let subTimer = null;

        /* ── helpers ── */
        function closeDrop() {
            if (!openDrop) return;
            openDrop.classList.remove('is-open');
            openDrop = null;
            closeSub();
        }

        function closeSub() {
            clearTimeout(subTimer);
            if (!openSub) return;
            openSub.sub.classList.remove('is-open');
            openSub.row.classList.remove('is-active-sub');
            openSub = null;
        }

        function openSubPanel(row, sub) {
            if (openSub && openSub.sub !== sub) closeSub();
            clearTimeout(subTimer);
            row.classList.add('is-active-sub');
            sub.classList.add('is-open');
            openSub = {
                row,
                sub
            };
        }

        /* ── DESKTOP: hover flyouts ── */
        document.querySelectorAll('.sh-has-drop').forEach(li => {
            const link = li.querySelector(':scope > a');
            const drop = li.querySelector(':scope > .sh-drop');
            if (!drop) return;

            const show = () => {
                if (window.innerWidth <= BP) return;
                if (openDrop && openDrop !== drop) openDrop.classList.remove('is-open');
                drop.classList.add('is-open');
                openDrop = drop;
                const arr = link?.querySelector('.sh-arrow');
                if (arr) arr.style.transform = 'rotate(180deg)';
            };

            const hide = () => {
                if (window.innerWidth <= BP) return;
                drop.classList.remove('is-open');
                openDrop = null;
                closeSub();
                const arr = link?.querySelector('.sh-arrow');
                if (arr) arr.style.transform = '';
            };

            li.addEventListener('mouseenter', show);
            li.addEventListener('mouseleave', hide);

            /* ── lvl 2 hover ── */
            drop.querySelectorAll('.sh-has-sub').forEach(subLi => {
                const row = subLi.querySelector('.sh-row');
                const sub = subLi.querySelector('.sh-sub');
                if (!row || !sub) return;

                row.addEventListener('mouseenter', () => {
                    if (window.innerWidth <= BP) return;
                    clearTimeout(subTimer);
                    openSubPanel(row, sub);
                });
                sub.addEventListener('mouseenter', () => {
                    if (window.innerWidth <= BP) return;
                    clearTimeout(subTimer);
                });
                row.addEventListener('mouseleave', () => {
                    if (window.innerWidth <= BP) return;
                    subTimer = setTimeout(closeSub, 120);
                });
                sub.addEventListener('mouseleave', () => {
                    if (window.innerWidth <= BP) return;
                    subTimer = setTimeout(closeSub, 120);
                });
            });
        });

        /* Close when clicking outside */
        document.addEventListener('click', e => {
            if (!e.target.closest('.sh')) closeDrop();
        });

        /* ── MOBILE: drawer open / close ── */
        const toggle = document.getElementById('shToggle');
        const drawer = document.getElementById('shDrawer');
        const closeBtn = document.getElementById('shClose');

        toggle?.addEventListener('click', () => drawer.classList.add('open'));
        closeBtn?.addEventListener('click', () => drawer.classList.remove('open'));
        drawer?.addEventListener('click', e => {
            if (e.target === drawer) drawer.classList.remove('open');
        });

        /* ── MOBILE: accordion lvl1 ── */
        document.querySelectorAll('.sh-has-drop > a').forEach(link => {
            link.addEventListener('click', e => {
                if (window.innerWidth > BP) return;
                e.preventDefault();

                const drop = link.parentElement.querySelector(':scope > .sh-drop');
                if (!drop) return;

                const isOpen = drop.classList.contains('mob-open');

                // collapse all open drops
                document.querySelectorAll('.sh-drop.mob-open').forEach(d => {
                    d.classList.remove('mob-open');
                    d.querySelectorAll('.sh-sub.mob-open').forEach(s => s.classList.remove(
                        'mob-open'));
                    d.querySelectorAll('.sh-row.is-active-sub').forEach(r => r.classList
                        .remove('is-active-sub'));
                });

                if (!isOpen) drop.classList.add('mob-open');
            });
        });

        /* ── MOBILE: accordion lvl2 ── */
        document.querySelectorAll('.sh-has-sub > .sh-row').forEach(row => {
            row.addEventListener('click', e => {
                if (window.innerWidth > BP) return;

                const sub = row.parentElement.querySelector('.sh-sub');
                if (!sub) return;

                const isOpen = sub.classList.contains('mob-open');

                // collapse sibling subs
                row.parentElement.closest('.sh-drop')?.querySelectorAll('.sh-sub.mob-open').forEach(
                    s => s.classList.remove('mob-open'));
                row.parentElement.closest('.sh-drop')?.querySelectorAll('.sh-row.is-active-sub')
                    .forEach(r => r.classList.remove('is-active-sub'));

                if (!isOpen) {
                    sub.classList.add('mob-open');
                    row.classList.add('is-active-sub');
                    e.preventDefault(); // first tap = expand only
                }
                // second tap = navigate (default href)
            });
        });

        /* Close drawer when leaf link is tapped */
        drawer?.querySelectorAll('.sh-leaf, .sh-drop-foot a, .sh-events a').forEach(a => {
            a.addEventListener('click', () => {
                if (window.innerWidth <= BP) drawer.classList.remove('open');
            });
        });

        /* ── Active link highlight ── */
        const curPath = window.location.pathname;
        document.querySelectorAll('.sh-nav a').forEach(a => {
            try {
                const lp = new URL(a.href, location.origin).pathname;
                if (lp && lp !== '/' && curPath.startsWith(lp)) {
                    a.classList.add('sh-active');
                    a.closest('.sh-has-drop')?.querySelector(':scope > a')?.classList.add('sh-active');
                }
            } catch (_) {}
        });

    })();
</script>
<style>
/* ================================================================
   SITE HEADER  —  sh = site-header prefix
   All class names are scoped so they never clash with page styles.
================================================================ */

    /* ── Box model reset ── */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    /* ── Shell ── */
    .sh {
        background: #fff;
        border-bottom: 1px solid #efefef;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
        position: sticky;
        top: var(--ann-h, 0px);
        z-index: 1000;
        transition: box-shadow .3s, top .3s;
    }

    /* ── Inner container ── */
    .sh-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* ── Brand row ── */
    .sh-brand {
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    /* ── Logo ── */
    .sh-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        flex-shrink: 0;
        line-height: 1;
    }

    .sh-logo img {
        height: 48px;
        width: auto;
        display: block;
    }

    .sh-logo h1 {
        margin: 0;
        font-size: 26px;
        font-weight: 800;
        color: #112344;
        white-space: nowrap;
    }

    /* ── Right cluster ── */
    .sh-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* ── Social icons ── */
    .sh-soc {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-right: 16px;
        border-right: 1px solid #ebebeb;
    }

    .sh-soc a {
        color: #c0c0c0;
        font-size: 15px;
        line-height: 0;
        text-decoration: none;
        transition: color .2s;
    }

    .sh-soc a:hover {
        color: #7C3AED;
    }

    /* ── Hamburger button (desktop: hidden) ── */
    .sh-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 26px;
        color: #3c4049;
        cursor: pointer;
        padding: 4px 6px;
        line-height: 1;
    }

    /* ── Close button (always hidden; shown via mobile media query) ── */
    .sh-close {
        display: none;
        background: none;
        border: none;
        font-size: 22px;
        color: #3c4049;
        cursor: pointer;
        position: absolute;
        top: 14px;
        right: 14px;
    }

    /* ================================================================
   DESKTOP NAV  ≥ 1100px
================================================================ */
    @media (min-width: 1100px) {

        /* Drawer is always visible on desktop, no overlay */
        .sh-drawer {
            display: block;
        }

        .sh-nav {
            display: flex;
            align-items: center;
        }

        /* ── Menu list ── */
        .sh-menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .sh-menu>li {
            position: relative;
        }

        /* ── Nav links ── */
        .sh-menu>li>a:not(.sh-cta) {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 24px 13px;
            font-size: 14px;
            font-weight: 600;
            color: #3c4049;
            text-decoration: none;
            white-space: nowrap;
            transition: color .25s;
            position: relative;
        }

        /* Animated underline */
        .sh-menu>li>a:not(.sh-cta)::after {
            content: '';
            position: absolute;
            bottom: 14px;
            left: 13px;
            right: 13px;
            height: 2px;
            background: #7C3AED;
            border-radius: 2px;
            transform: scaleX(0);
            transition: transform .25s ease;
        }

        .sh-menu>li>a:not(.sh-cta):hover,
        .sh-menu>li>a.sh-active {
            color: #7C3AED;
        }

        .sh-menu>li>a:not(.sh-cta):hover::after,
        .sh-menu>li>a.sh-active::after {
            transform: scaleX(1);
        }

        /* ── CTA pill (Quiz-Test) ── */
        .sh-cta {
            background: #7C3AED;
            color: #fff !important;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 13.5px;
            font-weight: 700;
            white-space: nowrap;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background .2s, transform .15s;
            margin-left: 6px;
        }

        .sh-cta:hover {
            background: #e05d00;
            transform: translateY(-1px);
        }

        .sh-cta::after {
            display: none !important;
        }

        /* ── Dropdown panel (lvl 1) ── */
        .sh-drop {
            list-style: none;
            margin: 0;
            padding: 6px 0;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            min-width: 220px;
            background: #fff;
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, .11);
            white-space: nowrap;
            /* hidden by default */
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(6px);
            transition: opacity .2s, visibility .2s, transform .2s;
        }

        /* Open state — JS adds .is-open */
        .sh-drop.is-open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0);
        }

        /* ── Submenu panel (lvl 2) ── */
        .sh-sub {
            list-style: none;
            margin: 0;
            padding: 6px 0;
            position: absolute;
            top: -6px;
            left: 100%;
            margin-left: 4px;
            min-width: 200px;
            background: #fff;
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, .11);
            white-space: nowrap;
            /* hidden by default */
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateX(-6px);
            transition: opacity .2s, visibility .2s, transform .2s;
        }

        .sh-sub.is-open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateX(0);
        }

        /* Anchor for submenu */
        .sh-has-sub {
            position: relative;
        }
    }

    /* ── Chevron arrows ── */
    .sh-arrow {
        font-size: 10px;
        margin-left: 2px;
        transition: transform .25s;
        display: inline-block;
    }

    .sh-subarrow {
        font-size: 10px;
        color: #bbb;
        margin-left: auto;
        flex-shrink: 0;
        transition: color .2s, transform .25s;
    }

    /* ── Dropdown row (age group / category row) ── */
    .sh-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 600;
        color: #2c3040;
        text-decoration: none;
        cursor: pointer;
        transition: background .15s, color .15s;
    }

    .sh-row:hover,
    .sh-row.is-active-sub {
        background: #fff5f0;
        color: #7C3AED;
    }

    .sh-row:hover .sh-subarrow,
    .sh-row.is-active-sub .sh-subarrow {
        color: #7C3AED;
    }

    .sh-row-inner {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sh-row-icon {
        font-size: 16px;
        line-height: 1;
        flex-shrink: 0;
    }

    .sh-row-text {
        line-height: 1.3;
    }

    /* ── Divider inside dropdown ── */
    .sh-sep {
        height: 1px;
        background: #f0f0f0;
        margin: 4px 12px;
        list-style: none;
    }

    /* ── "View all" footer inside dropdown ── */
    .sh-drop-foot {
        border-top: 1px solid #ebebeb;
        margin-top: 4px;
    }

    .sh-drop-foot a {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 9px 14px;
        font-size: 11px;
        font-weight: 700;
        color: #7C3AED;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: .8px;
    }

    .sh-drop-foot a:hover {
        opacity: .7;
    }

    /* ── City / leaf link row ── */
    .sh-leaf {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 500;
        color: #3c4049;
        text-decoration: none;
        transition: background .15s, color .15s, padding-left .15s;
    }

    .sh-leaf:hover {
        background: #fff5f0;
        color: #7C3AED;
        padding-left: 20px;
    }

    .sh-leaf-icon {
        font-size: 14px;
        width: 20px;
        text-align: center;
        flex-shrink: 0;
        color: #999;
    }

    .sh-leaf.sh-leaf-all {
        color: #7C3AED;
        font-weight: 600;
    }

    .sh-leaf.sh-leaf-all .sh-leaf-icon {
        color: #7C3AED;
    }

    /* ── Event list inside dropdown ── */
    .sh-events li>a {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 500;
        color: #3c4049;
        text-decoration: none;
        transition: background .15s, color .15s, padding-left .15s;
    }

    .sh-events li>a:hover {
        background: #fff5f0;
        color: #7C3AED;
        padding-left: 20px;
    }

    .sh-events li>a>i {
        color: #7C3AED;
        font-size: 13px;
        width: 15px;
        flex-shrink: 0;
    }

    /* ================================================================
   MOBILE NAV  ≤ 1099px
================================================================ */
    @media (max-width: 1099px) {

        /* Show hamburger */
        .sh-toggle {
            display: block;
        }

        /* Hide socials */
        .sh-soc {
            display: none !important;
        }

        /* Drawer = full-screen dark overlay, hidden by default */
        .sh-drawer {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .52);
            z-index: 9000;
        }

        .sh-drawer.open {
            display: block;
        }

        /* Nav panel slides in from the right */
        .sh-nav {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: min(300px, 88vw);
            background: #fff;
            z-index: 9001;
            overflow-y: auto;
            padding: 54px 0 24px;
            box-shadow: -6px 0 24px rgba(0, 0, 0, .13);
        }

        /* Show close button on mobile */
        .sh-close {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Stack menu vertically */
        .sh-menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .sh-menu>li>a:not(.sh-cta) {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 20px;
            font-size: 15px;
            font-weight: 600;
            color: #3c4049;
            text-decoration: none;
            border-bottom: 1px solid #f2f2f2;
            width: 100%;
            transition: color .2s;
        }

        .sh-menu>li>a:not(.sh-cta)::after {
            display: none !important;
        }

        .sh-menu>li>a:not(.sh-cta):hover {
            color: #7C3AED;
        }

        /* CTA pill on mobile */
        .sh-cta {
            display: flex !important;
            justify-content: center;
            margin: 14px 20px !important;
            border-radius: 10px !important;
            padding: 11px 16px !important;
            background: #7C3AED;
            color: #fff !important;
            font-weight: 700;
            text-decoration: none;
            font-size: 15px;
            align-items: center;
            gap: 6px;
        }

        /* ── Dropdown panels on mobile: static, hidden until .mob-open ── */
        .sh-drop,
        .sh-sub {
            display: none;
            position: static;
            border: none;
            border-radius: 0;
            box-shadow: none;
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: none;
            transition: none;
            padding: 0;
            min-width: 0;
            white-space: normal;
        }

        .sh-drop.mob-open {
            display: block;
            background: #f7f8fa;
        }

        .sh-sub.mob-open {
            display: block;
            background: #eef0f5;
        }

        /* Age rows on mobile */
        .sh-row {
            padding: 12px 20px;
            font-size: 14px;
            border-bottom: 1px solid #ebebeb;
        }

        .sh-row.is-active-sub {
            background: #fff5f0;
        }

        .sh-row.is-active-sub .sh-subarrow {
            transform: rotate(90deg);
            color: #7C3AED;
        }

        /* Leaf / city rows on mobile — indented */
        .sh-leaf {
            padding: 11px 20px 11px 38px;
            font-size: 14px;
            border-bottom: 1px solid #e4e4e4;
        }

        .sh-leaf:hover {
            padding-left: 42px;
        }

        .sh-leaf.sh-leaf-all {
            padding-left: 38px;
        }

        .sh-drop-foot a {
            padding: 12px 20px;
        }

        .sh-sep {
            margin: 0;
        }

        /* Events rows on mobile */
        .sh-events li>a {
            padding: 11px 20px 11px 28px;
            font-size: 14px;
            border-bottom: 1px solid #ebebeb;
        }

        .sh-events li>a:hover {
            padding-left: 32px;
        }
    }
</style>
