@if ($galleryCategories->isNotEmpty())

    @php
        $allImages = $galleryCategories->flatMap(fn($c) => $c->images)->values();
        $row1 = $allImages->where('strip_row', 1)->values();
        $row2 = $allImages->where('strip_row', 2)->values();
        $row3 = $allImages->where('strip_row', 3)->values();
        $featured = $allImages->where('is_featured', true)->take(5)->values();
        $hasStrips = $row1->isNotEmpty() || $row2->isNotEmpty() || $row3->isNotEmpty();
    @endphp

    {{-- ===================== STYLES ===================== --}}
    

    {{-- ===================== HTML ===================== --}}
    <section class="mgal-section" id="gallery">

        <div class="mgal-header">
            <div class="mgal-eyebrow"><span></span> Our Moments <span></span></div>
            <h2>Memories We've Created</h2>
            <p>Snapshots from our Cyber AI Threat Conclave programs, performances &amp; workshops</p>
        </div>

        {{-- Tabs --}}
        <div class="mgal-tabs">
            <button class="mgal-tab is-active" data-target="mgal-all">All</button>
            @foreach ($galleryCategories as $cat)
                @if ($cat->images->isNotEmpty())
                    <button class="mgal-tab" data-target="mgal-cat-{{ $cat->id }}">{{ $cat->name }}</button>
                @endif
            @endforeach
        </div>

        {{-- ALL Panel --}}
        <div class="mgal-panel is-active" id="mgal-all">

            @if ($hasStrips)

                @if ($row1->isNotEmpty())
                    <div class="mgal-strip-wrap">
                        <div class="mgal-strip-track go-fwd">
                            @foreach (array_merge($row1->all(), $row1->all()) as $img)
                                <div class="mgal-thumb {{ $img->size ?? '' }}" data-src="{{ $img->image_url }}"
                                    data-alt="{{ $img->alt_text ?? ($img->label ?? '') }}">
                                    <img src="{{ $img->image_url }}" alt="{{ $img->alt_text ?? ($img->label ?? '') }}">
                                    <div class="mgal-thumb-over"><i class="bi bi-zoom-in"></i></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($row2->isNotEmpty())
                    <div class="mgal-strip-wrap">
                        <div class="mgal-strip-track go-bwd">
                            @foreach (array_merge($row2->all(), $row2->all()) as $img)
                                <div class="mgal-thumb {{ $img->size ?? '' }}" data-src="{{ $img->image_url }}"
                                    data-alt="{{ $img->alt_text ?? ($img->label ?? '') }}">
                                    <img src="{{ $img->image_url }}"
                                        alt="{{ $img->alt_text ?? ($img->label ?? '') }}">
                                    <div class="mgal-thumb-over"><i class="bi bi-zoom-in"></i></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($row3->isNotEmpty())
                    <div class="mgal-strip-wrap">
                        <div class="mgal-strip-track go-fwd2">
                            @foreach (array_merge($row3->all(), $row3->all()) as $img)
                                <div class="mgal-thumb {{ $img->size ?? '' }}" data-src="{{ $img->image_url }}"
                                    data-alt="{{ $img->alt_text ?? ($img->label ?? '') }}">
                                    <img src="{{ $img->image_url }}"
                                        alt="{{ $img->alt_text ?? ($img->label ?? '') }}">
                                    <div class="mgal-thumb-over"><i class="bi bi-zoom-in"></i></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($featured->count() >= 3)
                    <div class="mgal-featured">
                        <div class="mgal-feat-item is-hero" data-src="{{ $featured[0]->image_url }}"
                            data-alt="{{ $featured[0]->alt_text ?? '' }}">
                            <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->alt_text ?? '' }}">
                            <div class="mgal-feat-over"><i class="bi bi-zoom-in"></i></div>
                            @if ($featured[0]->label)
                                <div class="mgal-feat-caption">{{ $featured[0]->label }}</div>
                            @endif
                        </div>
                        @foreach ($featured->slice(1) as $fi)
                            <div class="mgal-feat-item" data-src="{{ $fi->image_url }}"
                                data-alt="{{ $fi->alt_text ?? '' }}">
                                <img src="{{ $fi->image_url }}" alt="{{ $fi->alt_text ?? '' }}">
                                <div class="mgal-feat-over"><i class="bi bi-zoom-in"></i></div>
                                @if ($fi->label)
                                    <div class="mgal-feat-caption">{{ $fi->label }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="mgal-masonry">
                    @foreach ($allImages as $img)
                        <div class="mgal-masonry-item" data-src="{{ $img->image_url }}"
                            data-alt="{{ $img->alt_text ?? ($img->label ?? '') }}">
                            <img src="{{ $img->image_url }}" alt="{{ $img->alt_text ?? ($img->label ?? '') }}"
                                onerror="this.closest('.mgal-masonry-item').style.display='none'">
                            <div class="mgal-masonry-over"><i class="bi bi-zoom-in"></i></div>
                            @if ($img->label)
                                <div class="mgal-masonry-label">{{ $img->label }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>

            @endif

        </div>

        {{-- Category Panels --}}
        @foreach ($galleryCategories as $cat)
            @if ($cat->images->isNotEmpty())
                <div class="mgal-panel" id="mgal-cat-{{ $cat->id }}">
                    <div class="mgal-masonry">
                        @foreach ($cat->images as $img)
                            <div class="mgal-masonry-item" data-src="{{ $img->image_url }}"
                                data-alt="{{ $img->alt_text ?? ($img->label ?? '') }}">
                                <img src="{{ $img->image_url }}" alt="{{ $img->alt_text ?? ($img->label ?? '') }}"
                                    onerror="this.closest('.mgal-masonry-item').style.display='none'">
                                <div class="mgal-masonry-over"><i class="bi bi-zoom-in"></i></div>
                                @if ($img->label)
                                    <div class="mgal-masonry-label">{{ $img->label }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        <div class="mgal-footer">
            <a href="{{ route('workshops') }}"><i class="bi bi-arrow-right"></i> See Our Workshops</a>
        </div>

    </section>

    {{-- Lightbox --}}
    <div class="mgal-lb" id="mgal-lb">
        <button class="mgal-lb-prev" id="mgal-lb-prev"><i class="bi bi-chevron-left"></i></button>
        <div class="mgal-lb-box">
            <button class="mgal-lb-close" id="mgal-lb-close"><i class="bi bi-x"></i></button>
            <img src="" alt="" id="mgal-lb-img">
            <div class="mgal-lb-counter" id="mgal-lb-counter"></div>
        </div>
        <button class="mgal-lb-next" id="mgal-lb-next"><i class="bi bi-chevron-right"></i></button>
    </div>

    {{-- ===================== JS ===================== --}}
    <script>
        (function() {
            'use strict';

            /* ---------- Tab logic ---------- */
            var tabs = document.querySelectorAll('.mgal-tab');
            var panels = document.querySelectorAll('.mgal-panel');

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    var target = tab.getAttribute('data-target');

                    // hide all panels, deactivate all tabs
                    tabs.forEach(function(t) {
                        t.classList.remove('is-active');
                    });
                    panels.forEach(function(p) {
                        p.classList.remove('is-active');
                    });

                    // show target
                    tab.classList.add('is-active');
                    var panel = document.getElementById(target);
                    if (panel) {
                        panel.classList.add('is-active');
                    }
                });
            });

            /* ---------- Lightbox logic ---------- */
            var lb = document.getElementById('mgal-lb');
            var lbImg = document.getElementById('mgal-lb-img');
            var lbCtr = document.getElementById('mgal-lb-counter');
            var lbClose = document.getElementById('mgal-lb-close');
            var lbPrev = document.getElementById('mgal-lb-prev');
            var lbNext = document.getElementById('mgal-lb-next');

            var stack = []; // array of {src, alt}
            var cur = 0;

            function getItems() {
                var panel = document.querySelector('.mgal-panel.is-active');
                if (!panel) return [];
                var nodes = panel.querySelectorAll('[data-src]');
                var list = [];
                nodes.forEach(function(n) {
                    var s = n.getAttribute('data-src');
                    if (s) list.push({
                        src: s,
                        alt: n.getAttribute('data-alt') || ''
                    });
                });
                return list;
            }

            function show() {
                if (!stack.length) return;
                var item = stack[cur];
                lbImg.src = item.src;
                lbImg.alt = item.alt;
                lbCtr.textContent = (cur + 1) + ' / ' + stack.length;
            }

            function open(srcToFind) {
                stack = getItems();
                cur = stack.findIndex(function(i) {
                    return i.src === srcToFind;
                });
                if (cur < 0) cur = 0;
                show();
                lb.classList.add('is-open');
                document.body.style.overflow = 'hidden';
            }

            function close() {
                lb.classList.remove('is-open');
                lbImg.src = '';
                document.body.style.overflow = '';
            }

            function nav(dir) {
                if (!stack.length) return;
                cur = (cur + dir + stack.length) % stack.length;
                show();
            }

            // attach click to every [data-src] element (now and future panels already rendered)
            document.querySelectorAll('[data-src]').forEach(function(el) {
                el.addEventListener('click', function() {
                    open(el.getAttribute('data-src'));
                });
            });

            lbClose.addEventListener('click', close);
            lbPrev.addEventListener('click', function() {
                nav(-1);
            });
            lbNext.addEventListener('click', function() {
                nav(1);
            });

            lb.addEventListener('click', function(e) {
                if (e.target === lb) close();
            });

            document.addEventListener('keydown', function(e) {
                if (!lb.classList.contains('is-open')) return;
                if (e.key === 'ArrowLeft') nav(-1);
                if (e.key === 'ArrowRight') nav(1);
                if (e.key === 'Escape') close();
            });

        })();
    </script>

@endif
<style>
/* ---------- Section ---------- */
        .mgal-section {
            background: #0a0a0a;
            padding: 0 0 60px;
            position: relative;
            overflow: hidden;
        }

        /* ---------- Header ---------- */
        .mgal-header {
            text-align: center;
            padding: 70px 20px 40px;
        }

        .mgal-eyebrow {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: #f97316;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .mgal-eyebrow span {
            display: block;
            width: 40px;
            height: 1px;
            background: #f97316;
        }

        .mgal-header h2 {
            color: #fff;
            font-size: clamp(28px, 5vw, 52px);
            font-weight: 800;
            margin: 0 0 12px;
            line-height: 1.1;
        }

        .mgal-header p {
            color: #888;
            font-size: 15px;
            margin: 0;
        }

        /* ---------- Tabs ---------- */
        .mgal-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            padding: 0 20px 40px;
        }

        .mgal-tab {
            background: transparent;
            border: 1.5px solid #333;
            color: #aaa;
            padding: 8px 22px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .mgal-tab:hover {
            border-color: #f97316;
            color: #f97316;
        }

        .mgal-tab.is-active {
            background: #f97316;
            border-color: #f97316;
            color: #fff;
            font-weight: 700;
        }

        /* ---------- Panels ---------- */
        .mgal-panel {
            display: none;
        }

        .mgal-panel.is-active {
            display: block;
        }

        /* ---------- Scroll Strips ---------- */
        .mgal-strip-wrap {
            overflow: hidden;
            margin-bottom: 14px;
        }

        .mgal-strip-track {
            display: flex;
            gap: 12px;
            width: max-content;
        }

        .mgal-strip-track.go-fwd {
            animation: mgalFwd 30s linear infinite;
        }

        .mgal-strip-track.go-bwd {
            animation: mgalBwd 30s linear infinite;
        }

        .mgal-strip-track.go-fwd2 {
            animation: mgalFwd 22s linear infinite;
        }

        @keyframes mgalFwd {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        @keyframes mgalBwd {
            from {
                transform: translateX(-50%);
            }

            to {
                transform: translateX(0);
            }
        }

        .mgal-strip-track:hover {
            animation-play-state: paused;
        }

        .mgal-thumb {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            flex-shrink: 0;
            height: 180px;
            width: 260px;
        }

        .mgal-thumb.sz-wide {
            width: 360px;
        }

        .mgal-thumb.sz-tall {
            width: 200px;
        }

        .mgal-section .mgal-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .mgal-section .mgal-thumb:hover img {
            transform: scale(1.06);
        }

        .mgal-thumb-over {
            position: absolute;
            inset: 0;
            background: rgba(249, 115, 22, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mgal-thumb:hover .mgal-thumb-over {
            opacity: 1;
        }

        .mgal-thumb-over i {
            color: #fff;
            font-size: 24px;
        }

        /* ---------- Featured Grid ---------- */
        .mgal-featured {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr;
            grid-template-rows: 220px 220px;
            gap: 12px;
            padding: 20px 20px 0;
            max-width: 1200px;
            margin: 0 auto;
        }

        .mgal-feat-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
        }

        .mgal-feat-item.is-hero {
            grid-row: 1 / 3;
        }

        .mgal-section .mgal-feat-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .mgal-section .mgal-feat-item:hover img {
            transform: scale(1.05);
        }

        .mgal-feat-over {
            position: absolute;
            inset: 0;
            background: rgba(249, 115, 22, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mgal-feat-item:hover .mgal-feat-over {
            opacity: 1;
        }

        .mgal-feat-over i {
            color: #fff;
            font-size: 26px;
        }

        .mgal-feat-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.75));
            color: #fff;
            font-size: 13px;
            padding: 18px 12px 10px;
        }

        /* ---------- Masonry Grid ---------- */
        .mgal-masonry {
            columns: 4;
            column-gap: 12px;
            padding: 20px;
            max-width: 1300px;
            margin: 0 auto;
        }

        @media (max-width: 1100px) {
            .mgal-masonry {
                columns: 3;
            }
        }

        @media (max-width: 700px) {
            .mgal-masonry {
                columns: 2;
            }
        }

        @media (max-width: 420px) {
            .mgal-masonry {
                columns: 1;
            }
        }

        .mgal-masonry-item {
            break-inside: avoid;
            margin-bottom: 12px;
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
        }

        .mgal-section .mgal-masonry-item img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.4s ease;
        }

        .mgal-section .mgal-masonry-item:hover img {
            transform: scale(1.04);
        }

        .mgal-masonry-over {
            position: absolute;
            inset: 0;
            background: rgba(249, 115, 22, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mgal-masonry-item:hover .mgal-masonry-over {
            opacity: 1;
        }

        .mgal-masonry-over i {
            color: #fff;
            font-size: 22px;
        }

        .mgal-masonry-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            color: #fff;
            font-size: 12px;
            padding: 16px 10px 8px;
        }

        /* ---------- Footer ---------- */
        .mgal-footer {
            text-align: center;
            padding: 40px 20px 0;
        }

        .mgal-footer a {
            color: #aaa;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s;
        }

        .mgal-footer a:hover {
            color: #f97316;
        }

        /* ---------- Lightbox ---------- */
        .mgal-lb {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(0, 0, 0, 0.92);
            align-items: center;
            justify-content: center;
        }

        .mgal-lb.is-open {
            display: flex;
        }

        .mgal-lb-box {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #mgal-lb .mgal-lb-box img {
            max-width: 90vw;
            max-height: 85vh;
            border-radius: 10px;
            display: block;
            object-fit: contain;
            transition: none !important;
            transform: none !important;
        }

        .mgal-lb-close {
            position: absolute;
            top: -40px;
            right: 0;
            background: none;
            border: none;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
            line-height: 1;
        }

        .mgal-lb-counter {
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            color: #aaa;
            font-size: 13px;
            white-space: nowrap;
        }

        .mgal-lb-prev,
        .mgal-lb-next {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            z-index: 10000;
        }

        .mgal-lb-prev {
            left: 16px;
        }

        .mgal-lb-next {
            right: 16px;
        }

        .mgal-lb-prev:hover,
        .mgal-lb-next:hover {
            background: #f97316;
        }
</style>
