<div class="d-flex justify-content-end align-items-center gap-3 mb-3 vid-controls-row">
    <div class="vid-nav">
        <button class="vid-nav-btn" id="vidPrev"><i class="bi bi-chevron-left"></i></button>
        <button class="vid-nav-btn" id="vidNext"><i class="bi bi-chevron-right"></i></button>
    </div>
</div>

{{-- Slider wrapper --}}
<div class="vid-slider-outer">
    <div id="vidTrack" class="vid-track">
        @foreach ($videos as $video)
            <div class="vid-slide">
                <div class="video-card" onclick="openVideo('{{ $video['id'] }}')">
                    <div class="vid-thumb">
                        <img src="{{ $video['thumb'] }}" alt="{{ $video['title'] }}" loading="lazy" />
                        <div class="vid-play">
                            <div class="vid-play-btn">
                                <i class="bi bi-play-fill" style="color:#ff0000;font-size:15px;margin-left:2px;"></i>
                            </div>
                        </div>
                        @if ($video['duration'])
                            <div class="vid-duration">{{ $video['duration'] }}</div>
                        @endif
                    </div>
                    <div class="vid-info">
                        <h5>{{ $video['title'] }}</h5>
                        <p>{{ $video['desc'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Dots --}}
<div class="d-flex justify-content-center gap-2 mt-3" id="vidDots"></div>
</div>
<div id="videoModal" onclick="closeVideo(event)">
    <div class="modal-inner" onclick="event.stopPropagation()">
        <button class="modal-close-btn" onclick="closeVideo()"><i class="bi bi-x-lg"></i></button>
        <div class="modal-player">
            <div class="vid-frame-wrap">
                <iframe id="videoFrame" src=""
                    allow="accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <p id="videoTitle"></p>
        </div>
        <div class="rec-sidebar">
            <p class="rec-label">Recommended</p>
            <div id="recommendedList"></div>
        </div>
    </div>
</div>

<style>
    /* ── Slider core ── */
    .vid-slider-outer {
        overflow: hidden;
        width: 100%;
    }

    .vid-track {
        display: flex;
        gap: 16px;
        transition: transform .5s cubic-bezier(.25, .46, .45, .94);
        will-change: transform;
    }

    /* Desktop: 4 cards */
    .vid-slide {
        flex: 0 0 calc(25% - 12px);
        min-width: 0;
    }

    /* Tablet: 2 cards */
    @media (max-width: 991px) {
        .vid-slide {
            flex: 0 0 calc(50% - 8px);
        }
    }

    /* Mobile: 1 card full width */
    @media (max-width: 575px) {
        .vid-slide {
            flex: 0 0 100%;
        }

        .vid-controls-row {
            justify-content: center !important;
        }
    }

    /* ── Video card ── */
    .video-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0, 0, 0, .08);
        cursor: pointer;
        transition: transform .2s, box-shadow .2s;
    }

    .video-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 28px rgba(0, 0, 0, .14);
    }

    .vid-thumb {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #000;
    }

    .vid-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .3s;
    }

    .video-card:hover .vid-thumb img {
        transform: scale(1.04);
    }

    .vid-play {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .25);
        transition: background .2s;
    }

    .video-card:hover .vid-play {
        background: rgba(0, 0, 0, .38);
    }

    .vid-play-btn {
        width: 44px;
        height: 44px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .3);
    }

    .vid-duration {
        position: absolute;
        bottom: 8px;
        right: 8px;
        background: rgba(0, 0, 0, .75);
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 4px;
    }

    .vid-info {
        padding: 14px 16px 16px;
    }

    .vid-info h5 {
        font-size: 14px;
        font-weight: 700;
        color: var(--ink, #1a1a2e);
        margin: 0 0 4px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .vid-info p {
        font-size: 12px;
        color: var(--muted, #6b7280);
        margin: 0;
    }

    /* ── Nav buttons ── */
    .vid-nav {
        display: flex;
        gap: 8px;
    }

    .vid-nav-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        border: 1.5px solid #e5e7eb;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background .2s, border-color .2s;
        font-size: 15px;
        color: #374151;
    }

    .vid-nav-btn:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
    }

    .vid-nav-btn:disabled {
        opacity: .35;
        cursor: default;
    }

    /* ── Dots ── */
    .vid-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #d1d5db;
        border: none;
        padding: 0;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .vid-dot.active {
        background: var(--blue, #175cdd);
        transform: scale(1.3);
    }

    /* ── Modal ── */
    #videoModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .88);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    #videoModal.open {
        display: flex;
    }

    .modal-inner {
        display: flex;
        gap: 20px;
        max-width: 1100px;
        width: 100%;
        position: relative;
    }

    .modal-player {
        flex: 1;
        min-width: 0;
    }

    .vid-frame-wrap {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        border-radius: 12px;
        overflow: hidden;
        background: #000;
    }

    .vid-frame-wrap iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    #videoTitle {
        color: #fff;
        font-size: 15px;
        font-weight: 600;
        margin: 12px 0 0;
    }

    .modal-close-btn {
        position: absolute;
        top: -48px;
        right: 0;
        background: rgba(255, 255, 255, .12);
        border: none;
        color: #fff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
        transition: background .2s;
    }

    .modal-close-btn:hover {
        background: rgba(255, 255, 255, .24);
    }

    /* Rec sidebar */
    .rec-sidebar {
        width: 240px;
        flex-shrink: 0;
        max-height: 70vh;
        overflow-y: auto;
    }

    .rec-label {
        color: rgba(255, 255, 255, .6);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 12px;
    }

    /* ── Modal mobile ── */
    @media (max-width: 767px) {
        #videoModal {
            padding: 12px;
            padding-top: 60px;
            align-items: flex-start;
            overflow-y: auto;
        }

        .modal-inner {
            flex-direction: column;
        }

        .modal-close-btn {
            top: -44px;
            right: 0;
        }

        .rec-sidebar {
            display: none;
        }
    }
</style>

<script>
    (function() {
        var videos = @json($videos);
        var track = document.getElementById('vidTrack');
        var dotsWrap = document.getElementById('vidDots');
        var btnPrev = document.getElementById('vidPrev');
        var btnNext = document.getElementById('vidNext');
        var currentIdx = 0;
        var autoTimer = null;
        var AUTOPLAY_MS = 3500; // change speed here

        function perPage() {
            if (window.innerWidth <= 575) return 1;
            if (window.innerWidth <= 991) return 2;
            return 4;
        }

        function totalPages() {
            return Math.ceil(videos.length / perPage());
        }

        function buildDots() {
            dotsWrap.innerHTML = '';
            var pages = totalPages();
            for (var i = 0; i < pages; i++) {
                var btn = document.createElement('button');
                btn.className = 'vid-dot' + (i === currentIdx ? ' active' : '');
                btn.dataset.idx = i;
                btn.setAttribute('aria-label', 'Go to page ' + (i + 1));
                btn.addEventListener('click', function() {
                    stopAuto();
                    goTo(parseInt(this.dataset.idx));
                    startAuto();
                });
                dotsWrap.appendChild(btn);
            }
        }

        function updateDots() {
            dotsWrap.querySelectorAll('.vid-dot').forEach(function(d, i) {
                d.classList.toggle('active', i === currentIdx);
            });
        }

        function goTo(idx) {
            var pages = totalPages();
            // Loop around
            if (idx >= pages) idx = 0;
            if (idx < 0) idx = pages - 1;
            currentIdx = idx;

            var slides = track.querySelectorAll('.vid-slide');
            if (!slides.length) return;
            var slideW = slides[0].offsetWidth;
            var gap = 16;
            var pp = perPage();
            var offset = currentIdx * pp * (slideW + gap);
            var maxOff = (slides.length - pp) * (slideW + gap);
            if (maxOff < 0) maxOff = 0;
            offset = Math.min(offset, maxOff);

            track.style.transform = 'translateX(-' + offset + 'px)';
            updateDots();
            btnPrev.disabled = false; // always enabled because we loop
            btnNext.disabled = false;
        }

        function startAuto() {
            stopAuto();
            autoTimer = setInterval(function() {
                goTo(currentIdx + 1);
            }, AUTOPLAY_MS);
        }

        function stopAuto() {
            if (autoTimer) {
                clearInterval(autoTimer);
                autoTimer = null;
            }
        }

        // Pause on hover
        track.addEventListener('mouseenter', stopAuto);
        track.addEventListener('mouseleave', startAuto);

        btnPrev.addEventListener('click', function() {
            stopAuto();
            goTo(currentIdx - 1);
            startAuto();
        });
        btnNext.addEventListener('click', function() {
            stopAuto();
            goTo(currentIdx + 1);
            startAuto();
        });

        // Touch / swipe
        var touchStartX = 0;
        track.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
            stopAuto();
        }, {
            passive: true
        });
        track.addEventListener('touchend', function(e) {
            var diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) goTo(diff > 0 ? currentIdx + 1 : currentIdx - 1);
            startAuto();
        }, {
            passive: true
        });

        // Pause when tab is hidden, resume when visible
        document.addEventListener('visibilitychange', function() {
            document.hidden ? stopAuto() : startAuto();
        });

        // Rebuild on resize
        var resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                stopAuto();
                currentIdx = 0;
                buildDots();
                goTo(0);
                startAuto();
            }, 200);
        });

        // Init
        buildDots();
        goTo(0);
        startAuto();

        // ── Modal ──
        window.openVideo = function(id) {
            stopAuto(); // pause while modal is open
            var v = videos.find(function(x) {
                return x.id === id;
            });
            document.getElementById('videoFrame').src =
                'https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0';
            document.getElementById('videoTitle').textContent = v ? v.title : '';

            var recList = document.getElementById('recommendedList');
            recList.innerHTML = '';
            videos.filter(function(x) {
                return x.id !== id;
            }).slice(0, 6).forEach(function(rv) {
                var div = document.createElement('div');
                div.style.cssText =
                    'display:flex;gap:10px;align-items:center;margin-bottom:12px;cursor:pointer;';
                div.innerHTML =
                    '<img src="' + rv.thumb +
                    '" style="width:80px;height:50px;object-fit:cover;border-radius:6px;flex-shrink:0;" />' +
                    '<div style="font-size:12px;color:#fff;font-weight:500;line-height:1.4;">' + rv
                    .title + '</div>';
                div.addEventListener('click', function() {
                    openVideo(rv.id);
                });
                recList.appendChild(div);
            });

            document.getElementById('videoModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        };

        window.closeVideo = function(e) {
            if (e && e.target !== document.getElementById('videoModal')) return;
            document.getElementById('videoFrame').src = '';
            document.getElementById('videoModal').classList.remove('open');
            document.body.style.overflow = '';
            startAuto(); // resume after modal closes
        };

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('videoFrame').src = '';
                document.getElementById('videoModal').classList.remove('open');
                document.body.style.overflow = '';
                startAuto();
            }
        });
    })();
</script>
