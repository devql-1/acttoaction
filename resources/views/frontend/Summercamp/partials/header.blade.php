<header class="site-header" id="siteHeader">
    <div class="container">
        <div class="brand">

            <a href="{{ url('/') }}" class="logo">
                <img src="https://static.wixstatic.com/media/495d44_61ec90165a4341cb9bb1dde53c1657c6~mv2.png"
                    alt="Act To Action" />
                <h1>Act To Action</h1>
            </a>

            <div class="header-right">

                <div class="header-soc">
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                </div>

                <div class="nav-wrap" id="navWrap">
                    <nav class="navmenu">
                        <button class="mob-close" id="navClose">✕</button>

                        <ul class="nav-ul">

                            <li><a href="{{ url('/courses') }}">Courses</a></li>

                            <!-- WORKSHOPS -->
                            <li class="has-drop">
                                <a href="{{ url('/workshops') }}">
                                    Workshops <span class="drop-arrow">⌄</span>
                                </a>

                                <ul class="lvl1">
                                    @foreach ($navAgeGroups ?? [] as $ageGroup)
                                        <li class="has-sub">
                                            <a class="age-row" href="#">
                                                {{ $ageGroup->label }}
                                                @if ($ageGroup->cities->count())
                                                    <span class="sub-arr">›</span>
                                                @endif
                                            </a>

                                            @if ($ageGroup->cities->count())
                                                <ul class="lvl2">
                                                    @foreach ($ageGroup->cities as $city)
                                                        <li>
                                                            <a class="city-row"
                                                                href="{{ url('/workshops') }}?age={{ $ageGroup->range_key }}&city={{ urlencode($city->name) }}">
                                                                {{ $city->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li><a href="{{ url('/blog') }}">Blog</a></li>
                            <li><a href="{{ url('/about') }}">About</a></li>

                        </ul>
                    </nav>
                </div>

                <button class="mob-toggle" id="mobToggle">☰</button>
            </div>
        </div>
    </div>
</header>


<style>
    /* ── reset ── */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    /* Hide by default */
    .lvl1,
    .lvl2 {
        display: none;
        position: absolute;
        z-index: 999;
    }

    /* SHOW STATES (Desktop) */
    .lvl1.is-open {
        display: block !important;
    }

    .lvl2.is-open {
        display: block !important;
    }

    /* MOBILE STATES */
    .lvl1.mob-open {
        display: block !important;
        position: static;
    }

    .lvl2.mob-open {
        display: block !important;
        position: static;
    }

    /* ── shell ── */
    .site-header {
        background: #fff;
        border-bottom: 1px solid #efefef;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .site-header .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .site-header .brand {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    /* ── logo ── */
    .site-header .logo {
        display: flex;
        align-items: center;
        gap: 9px;
        text-decoration: none;
        flex-shrink: 0;
    }

    .site-header .logo img {
        height: 34px;
    }

    .site-header .logo h1 {
        font-size: 17px;
        font-weight: 800;
        color: #112344;
        margin: 0;
        white-space: nowrap;
    }

    /* ── right cluster ── */
    .header-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ── socials ── */
    .header-soc {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-right: 12px;
        margin-right: 4px;
        border-right: 1px solid #ebebeb;
    }

    .header-soc a {
        color: #c0c0c0;
        font-size: 15px;
        text-decoration: none;
        transition: color .2s;
    }

    .header-soc a:hover {
        color: #ff6a00;
    }

    /* ── top-level nav ── */
    .nav-ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
    }

    .nav-ul>li {
        position: relative;
    }

    .nav-ul>li>.nav-link,
    .nav-ul>li>a:not(.nav-cta) {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 20px 12px;
        font-size: 13.5px;
        font-weight: 600;
        color: #3c4049;
        text-decoration: none;
        white-space: nowrap;
        transition: color .2s;
        position: relative;
    }

    /* underline */
    .nav-ul>li>a:not(.nav-cta)::after {
        content: '';
        position: absolute;
        bottom: 12px;
        left: 12px;
        right: 12px;
        height: 2px;
        background: #ff6a00;
        border-radius: 2px;
        transform: scaleX(0);
        transition: transform .25s;
    }

    .nav-ul>li>a:not(.nav-cta):hover,
    .nav-ul>li>a.is-active {
        color: #ff6a00;
    }

    .nav-ul>li>a:not(.nav-cta):hover::after,
    .nav-ul>li>a.is-active::after {
        transform: scaleX(1);
    }

    /* drop / sub chevrons */
    .drop-arrow {
        font-size: 10px;
        margin-left: 1px;
        transition: transform .25s;
    }

    .sub-arr {
        font-size: 10px;
        color: #bbb;
        margin-left: auto;
        flex-shrink: 0;
        transition: color .2s, transform .25s;
    }

    /* Call Now pill */
    .nav-cta {
        background: #ff6a00 !important;
        color: #fff !important;
        padding: 8px 16px !important;
        border-radius: 20px !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        white-space: nowrap;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .2s !important;
    }

    .nav-cta:hover {
        background: #e05d00 !important;
    }

    /* ──────────────────────────────────────────────────────────
   DROPDOWN PANELS  — desktop only
   Both lvl1 and lvl2 are hidden by default.
   JS adds/removes .is-open to show them.
────────────────────────────────────────────────────────── */
    .lvl1,
    .lvl2 {
        list-style: none;
        margin: 0;
        padding: 6px 0;
        position: absolute;
        background: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 12px;
        box-shadow: 0 8px 28px rgba(0, 0, 0, .11);
        min-width: 215px;
        white-space: nowrap;

        /* hidden state */
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: translateY(4px);
        transition: opacity .2s, visibility .2s, transform .2s;
    }

    /* SHOW */
    .lvl1.is-open,
    .lvl2.is-open {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateY(0);
    }

    /* lvl1 drops below its nav item */
    .lvl1 {
        top: calc(100% + 2px);
        left: 0;
    }

    /* lvl2 flies out to the RIGHT of the age row
   It sits as a child of .has-sub <li>, so left:100% is relative to that li */
    .lvl2 {
        top: -6px;
        /* vertically aligned with the age row */
        left: 100%;
        /* to the right of lvl1 */
        margin-left: 4px;
        min-width: 190px;
        transform: translateX(-4px);
        /* slide in from left */
    }

    .lvl2.is-open {
        transform: translateX(0);
    }

    /* has-sub needs position:relative so lvl2 is anchored to it */
    .has-sub {
        position: relative;
    }

    /* ── divider ── */
    .dd-sep {
        height: 1px;
        background: #f0f0f0;
        margin: 4px 12px;
        list-style: none;
    }

    /* ── age rows (lvl1 items) ── */
    .age-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 600;
        color: #2c3040;
        text-decoration: none;
        transition: background .15s, color .15s;
        cursor: pointer;
    }

    .age-row:hover,
    .age-row.is-active-sub {
        background: #fff5f0;
        color: #ff6a00;
    }

    .age-row:hover .sub-arr,
    .age-row.is-active-sub .sub-arr {
        color: #ff6a00;
    }

    .age-inner {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .age-icon {
        font-size: 16px;
        line-height: 1;
        flex-shrink: 0;
    }

    .age-text {
        line-height: 1.3;
    }

    /* footer row inside lvl1 */
    .lvl1-foot {
        border-top: 1px solid #ebebeb;
        margin-top: 4px;
    }

    .lvl1-foot a {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 9px 14px;
        font-size: 11.5px;
        font-weight: 700;
        color: #ff6a00;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: .7px;
    }

    .lvl1-foot a:hover {
        opacity: .7;
    }

    /* ── city rows (lvl2 items) ── */
    .city-row {
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

    .city-row:hover {
        background: #fff5f0;
        color: #ff6a00;
        padding-left: 20px;
    }

    .city-flag {
        font-size: 15px;
        width: 20px;
        text-align: center;
        flex-shrink: 0;
        color: #999;
    }

    .city-all {
        color: #ff6a00;
        font-weight: 600;
    }

    .city-all .city-flag {
        color: #ff6a00;
    }

    /* ── events lvl1 ── */
    .events-lvl1 li>a {
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

    .events-lvl1 li>a:hover {
        background: #fff5f0;
        color: #ff6a00;
        padding-left: 20px;
    }

    .events-lvl1 li>a>i {
        color: #ff6a00;
        font-size: 13px;
        width: 15px;
        flex-shrink: 0;
    }

    /* ── mobile buttons ── */
    .mob-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 24px;
        color: #3c4049;
        cursor: pointer;
        padding: 4px 6px;
    }

    .mob-close {
        display: none;
        position: absolute;
        top: 14px;
        right: 14px;
        background: none;
        border: none;
        font-size: 22px;
        color: #3c4049;
        cursor: pointer;
    }

    /* ──────────────────────────────────────────────────────────
   MOBILE  ≤ 1099px
────────────────────────────────────────────────────────── */
    @media (max-width: 1099px) {
        .mob-toggle {
            display: block;
        }

        .header-soc {
            display: none !important;
        }

        .nav-wrap {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .52);
            z-index: 9000;
        }

        .nav-wrap.open {
            display: block;
        }

        .navmenu {
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

        .mob-close {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* stack nav */
        .nav-ul {
            flex-direction: column;
            align-items: stretch;
        }

        .nav-ul>li>a:not(.nav-cta) {
            padding: 13px 20px;
            font-size: 15px;
            border-bottom: 1px solid #f2f2f2;
            width: 100%;
            justify-content: space-between;
        }

        .nav-ul>li>a::after {
            display: none !important;
        }

        /* override desktop absolute panels */
        .lvl1,
        .lvl2 {
            position: static;
            border: none;
            border-radius: 0;
            box-shadow: none;
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: none;
            transition: none;
            display: none;
            /* hidden until JS adds .mob-open */
            padding: 0;
            min-width: 0;
            white-space: normal;
        }

        .lvl1.mob-open {
            display: block;
            background: #f7f8fa;
        }

        .lvl2.mob-open {
            display: block;
            background: #eef0f5;
        }

        /* age rows — mobile */
        .age-row {
            padding: 12px 20px;
            font-size: 14px;
            border-bottom: 1px solid #ebebeb;
        }

        .age-row.is-active-sub {
            background: #fff5f0;
        }

        /* rotate chevron when sub open */
        .age-row.is-active-sub .sub-arr {
            transform: rotate(90deg);
            color: #ff6a00;
        }

        /* city rows — mobile, indented */
        .city-row {
            padding: 11px 20px 11px 38px;
            font-size: 14px;
            border-bottom: 1px solid #e4e4e4;
        }

        .city-row:hover {
            padding-left: 42px;
        }

        .city-all {
            padding-left: 38px;
        }

        .lvl1-foot a {
            padding: 12px 20px;
        }

        .dd-sep {
            margin: 0;
        }

        /* events rows — mobile */
        .events-lvl1 li>a {
            padding: 11px 20px 11px 28px;
            font-size: 14px;
            border-bottom: 1px solid #ebebeb;
        }

        .events-lvl1 li>a:hover {
            padding-left: 32px;
        }

        /* Call Now */
        .nav-cta {
            display: flex !important;
            justify-content: center;
            margin: 14px 20px !important;
            border-radius: 10px !important;
            padding: 11px 16px !important;
        }
    }
</style>


<script>
    (function() {
        'use strict';

        const MOBILE_BP = 1099;
        let openLvl1 = null; // currently open lvl1 panel
        let openSub = null; // currently open lvl2 panel + its age-row
        let subTimer = null; // debounce timer for lvl2

        /* ─── helpers ─────────────────────────────────────── */
        function closeLvl1() {
            if (!openLvl1) return;
            openLvl1.classList.remove('is-open');
            openLvl1 = null;
            closeSub();
        }

        function closeSub() {
            clearTimeout(subTimer);
            if (!openSub) return;
            openSub.lvl2.classList.remove('is-open');
            openSub.row.classList.remove('is-active-sub');
            openSub = null;
        }

        function openSubPanel(row, lvl2) {
            // close previous sub if different
            if (openSub && openSub.lvl2 !== lvl2) closeSub();
            clearTimeout(subTimer);
            row.classList.add('is-active-sub');
            lvl2.classList.add('is-open');
            openSub = {
                row,
                lvl2
            };
        }

        /* ─── DESKTOP flyout logic ─────────────────────────
           Pure JS hover events — far more reliable than the
           CSS sibling selector trick across all browsers.
        ─────────────────────────────────────────────────── */
        document.querySelectorAll('.has-drop').forEach(li => {
            const triggerLink = li.querySelector(':scope > a');
            const lvl1 = li.querySelector(':scope > .lvl1');
            if (!lvl1) return;

            // Show lvl1 when nav link is hovered
            [li, triggerLink].forEach(el => {
                el.addEventListener('mouseenter', () => {
                    if (window.innerWidth <= MOBILE_BP) return;
                    if (openLvl1 && openLvl1 !== lvl1) openLvl1.classList.remove('is-open');
                    lvl1.classList.add('is-open');
                    openLvl1 = lvl1;
                    // rotate chevron
                    const arr = triggerLink.querySelector('.drop-arrow');
                    if (arr) arr.style.transform = 'rotate(180deg)';
                });
            });

            // Hide lvl1 + lvl2 when cursor leaves entire nav item
            li.addEventListener('mouseleave', () => {
                if (window.innerWidth <= MOBILE_BP) return;
                lvl1.classList.remove('is-open');
                openLvl1 = null;
                closeSub();
                // reset chevron
                const arr = triggerLink.querySelector('.drop-arrow');
                if (arr) arr.style.transform = '';
            });

            // ── lvl2 (age rows inside workshops dropdown) ──
            lvl1.querySelectorAll('.has-sub').forEach(subLi => {
                const ageRow = subLi.querySelector('.age-row');
                const lvl2 = subLi.querySelector('.lvl2');
                if (!ageRow || !lvl2) return;

                // Hover age row → show its cities
                ageRow.addEventListener('mouseenter', () => {
                    if (window.innerWidth <= MOBILE_BP) return;
                    clearTimeout(subTimer);
                    openSubPanel(ageRow, lvl2);
                });

                // Entering lvl2 panel itself → keep it open
                lvl2.addEventListener('mouseenter', () => {
                    if (window.innerWidth <= MOBILE_BP) return;
                    clearTimeout(subTimer);
                });

                // Leaving age row → small delay before closing
                // (gives cursor time to travel to lvl2 without it disappearing)
                ageRow.addEventListener('mouseleave', () => {
                    if (window.innerWidth <= MOBILE_BP) return;
                    subTimer = setTimeout(closeSub, 120);
                });

                // Leaving lvl2 → close it
                lvl2.addEventListener('mouseleave', () => {
                    if (window.innerWidth <= MOBILE_BP) return;
                    subTimer = setTimeout(closeSub, 120);
                });
            });
        });

        // Close everything when clicking outside the header
        document.addEventListener('click', e => {
            if (!e.target.closest('.site-header')) {
                closeLvl1();
            }
        });

        /* ─── MOBILE drawer open / close ──────────────────── */
        const toggle = document.getElementById('mobToggle');
        const wrap = document.getElementById('navWrap');
        const closeBtn = document.getElementById('navClose');

        toggle?.addEventListener('click', () => wrap.classList.add('open'));
        closeBtn?.addEventListener('click', () => wrap.classList.remove('open'));
        wrap?.addEventListener('click', e => {
            if (e.target === wrap) wrap.classList.remove('open');
        });

        /* ─── MOBILE two-level accordion ──────────────────── */

        // Level 1: tap "Workshops" or "Events"
        document.querySelectorAll('.has-drop > a').forEach(link => {
            link.addEventListener('click', e => {
                if (window.innerWidth > MOBILE_BP) return;
                e.preventDefault();

                const parentLi = link.parentElement;
                const lvl1 = parentLi.querySelector(':scope > .lvl1');
                if (!lvl1) return;

                const isOpen = lvl1.classList.contains('mob-open');

                // collapse all lvl1 panels and their subs
                document.querySelectorAll('.lvl1.mob-open').forEach(p => {
                    p.classList.remove('mob-open');
                    p.querySelectorAll('.lvl2.mob-open').forEach(s => s.classList.remove(
                        'mob-open'));
                    p.querySelectorAll('.age-row.is-active-sub').forEach(r => r.classList
                        .remove('is-active-sub'));
                });

                if (!isOpen) lvl1.classList.add('mob-open');
            });
        });

        // Level 2: tap an age row
        document.querySelectorAll('.has-sub > .age-row').forEach(row => {
            row.addEventListener('click', e => {
                if (window.innerWidth > MOBILE_BP) return;

                const subLi = row.parentElement;
                const lvl2 = subLi.querySelector('.lvl2');
                if (!lvl2) return;

                const isOpen = lvl2.classList.contains('mob-open');

                // collapse all sibling subs
                subLi.closest('.lvl1')?.querySelectorAll('.lvl2.mob-open').forEach(p => {
                    p.classList.remove('mob-open');
                });
                subLi.closest('.lvl1')?.querySelectorAll('.age-row.is-active-sub').forEach(r => {
                    r.classList.remove('is-active-sub');
                });

                if (!isOpen) {
                    lvl2.classList.add('mob-open');
                    row.classList.add('is-active-sub');
                    e.preventDefault(); // expand only (don't navigate yet)
                }
                // second tap → navigate to age page (default browser action)
            });
        });

        // Close drawer when a leaf link is tapped
        wrap?.querySelectorAll('.city-row, .lvl1-foot a, .events-lvl1 a').forEach(a => {
            a.addEventListener('click', () => {
                if (window.innerWidth <= MOBILE_BP) wrap.classList.remove('open');
            });
        });

        /* ─── Active nav link highlight ───────────────────── */
        const curPath = window.location.pathname;
        document.querySelectorAll('.navmenu a').forEach(a => {
            try {
                const lp = new URL(a.href, location.origin).pathname;
                if (lp !== '/' && curPath.startsWith(lp)) {
                    a.classList.add('is-active');
                    a.closest('.has-drop')?.querySelector(':scope > a')?.classList.add('is-active');
                }
            } catch (_) {}
        });

    })();
</script>
