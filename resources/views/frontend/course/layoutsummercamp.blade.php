@include('frontend.partialspages.head')

<body class="index-page">
<style>
/* ── Announcement bar ── */
    :root { --ann-h: 40px; }

    body {
        padding-top: var(--ann-h, 40px);
        transition: padding-top 0.3s ease;
    }

    .ann-bar {
        background: #0e1c38;
        height: var(--ann-h, 40px);
        display: flex;
        align-items: center;
        position: fixed;
        top: 0; left: 0; right: 0;
        z-index: 1002;
        font-size: 12px;
        font-family: Arial, sans-serif;
        border-bottom: 1px solid rgba(255, 106, 0, 0.25);
        transition: height 0.3s ease, opacity 0.3s ease;
        overflow: hidden;
    }

    .ann-bar.hidden { height: 0; opacity: 0; pointer-events: none; }

    .ann-inner {
        display: flex; align-items: center; justify-content: center;
        width: 100%; gap: 12px; position: relative; padding: 0 40px;
    }

    .ann-dot {
        width: 6px; height: 6px; background: #ff6a00;
        border-radius: 50%; flex-shrink: 0; animation: annDotPulse 1.8s infinite;
    }

    @keyframes annDotPulse { 0%,100%{opacity:1} 50%{opacity:.25} }

    .ann-msg {
        font-weight: 500; color: rgba(255,255,255,.8);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 640px;
    }

    .ann-msg strong { color: #ff6a00; font-weight: 700; }

    .ann-cta {
        background: #ff6a00; color: #fff; border: none;
        padding: 3px 12px; border-radius: 12px; font-size: 10px;
        font-weight: 700; text-transform: uppercase; letter-spacing: .6px;
        white-space: nowrap; flex-shrink: 0; cursor: pointer;
        text-decoration: none; display: inline-block; transition: background .2s;
    }

    .ann-cta:hover { background: #e05d00; color: #fff; }

    .ann-close {
        background: none; border: none; color: rgba(255,255,255,.35);
        font-size: 12px; cursor: pointer; position: absolute; right: 12px;
        line-height: 1; transition: color .2s; padding: 0;
        width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;
    }

    .ann-close:hover { color: #fff; }

    @media (max-width: 575px) {
        .ann-cta { display: none; }
        .ann-msg { font-size: 10.5px; max-width: 100%; }
    }
</style>
    {{-- ── Announcement bar ── --}}
    @include('frontend.partialspages.ann_bar')

    {{-- ── Sticky header ── --}}
    @include('frontend.Summercamp.partials.header')

    @yield('content')

    @include('frontend.partialspages.footer')

    <!-- Scroll Top -->
    <a href="#!" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    @include('frontend.partialspages.scripts')

</body>
<script>
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function () {
            let filter = this.getAttribute('data-filter');
            document.querySelectorAll('.course-card').forEach(card => {
                if (filter === 'all') {
                    card.style.display = "block";
                    return;
                }
                card.style.display = (card.getAttribute('data-category') === filter) ? "block" : "none";
            });
        });
    });
</script>

</html>
