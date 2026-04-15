@php
    $notifBanners = \App\Models\NotificationBanner::active()->get()->map(function ($b) {
        return [
            'id'    => $b->id,
            'image' => $b->image ? asset($b->image) : null,
            'title' => $b->title,
            'url'   => $b->url ?: '#',
        ];
    })->values()->toArray();
@endphp
<script>
    // Banner Slides Data - loaded from database
    const bannerSlidesData = @json($notifBanners);

    let currentSlideIndex = 0;
    let isDragging = false;
    let offsetX = 0;
    let offsetY = 0;

    // Create Draggable Bell + Banner Slider
    function createBellAndSlider() {

        if (!bannerSlidesData || bannerSlidesData.length === 0) return;

        const bellHTML = `
            <div class="bell-notification-wrapper" id="bellWrapper" draggable="false">
                <button class="bell-icon" id="bellIcon" aria-label="Notifications">
                    <i class="fas fa-bell"></i>
                    <span class="bell-badge">${bannerSlidesData.length}</span>
                </button>
            </div>
        `;

        const slides = bannerSlidesData.map((slide) => {
            if (slide.image) {
                // blurred background layer + crisp contain image on top
                return `
                <div class="banner-slide" onclick="goToBannerPage('${slide.url}')">
                    <div class="banner-slide-blur" style="background-image:url('${slide.image}')"></div>
                    <img src="${slide.image}" alt="${slide.title}">
                    <div class="banner-slide-overlay">
                        <p>${slide.title}</p>
                    </div>
                </div>`;
            } else {
                return `
                <div class="banner-slide" onclick="goToBannerPage('${slide.url}')">
                    <div class="banner-slide-empty"><i class="fa fa-image"></i></div>
                    <div class="banner-slide-overlay">
                        <p>${slide.title}</p>
                    </div>
                </div>`;
            }
        }).join('');

        const dots = bannerSlidesData.map((_, i) =>
            `<span class="banner-dot ${i === 0 ? 'active' : ''}" onclick="goToSlide(${i})"></span>`
        ).join('');

        const sliderHTML = `
            <div class="banner-slider-backdrop" id="bannerBackdrop" onclick="closeBannerSlider(event)"></div>
            <div class="banner-slider-container" id="bannerSliderContainer">
                <button class="banner-slider-close" onclick="closeBannerSlider(event)" aria-label="Close">✕</button>
                <div class="banner-slider-wrapper">
                    <div class="banner-slides" id="bannerSlides">${slides}</div>
                    ${bannerSlidesData.length > 1 ? `
                    <button class="banner-arrow banner-arrow-prev" onclick="prevBannerSlide()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="banner-arrow banner-arrow-next" onclick="nextBannerSlide()">
                        <i class="fas fa-chevron-right"></i>
                    </button>` : ''}
                </div>
                ${bannerSlidesData.length > 1 ? `<div class="banner-dots" id="bannerDots">${dots}</div>` : ''}
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', bellHTML);
        document.body.insertAdjacentHTML('beforeend', sliderHTML);
        addBellAndSliderStyles();
        setupDragListeners();

        const bellIcon = document.getElementById('bellIcon');
        if (bellIcon) {
            bellIcon.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleBannerSlider();
            });
        }
    }

    // Add Styles
    function addBellAndSliderStyles() {
        const styles = `
            /* ===== DRAGGABLE BELL NOTIFICATION ===== */
            .bell-notification-wrapper {
                position: fixed;
                bottom: 100px;
                left: 25px;
                z-index: 150;
                cursor: grab;
                user-select: none;
                touch-action: none;
            }

            .bell-notification-wrapper.dragging {
                cursor: grabbing;
            }

            .bell-icon {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background: linear-gradient(135deg, #ff6a00, #ff8533);
                color: #ffffff;
                border: none;
                font-size: 20px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                box-shadow: 0 4px 15px rgba(255, 106, 0, 0.35);
                transition: all 0.3s ease;
                pointer-events: auto;
            }

            .bell-icon:hover {
                transform: scale(1.1) rotate(15deg);
                box-shadow: 0 6px 20px rgba(255, 106, 0, 0.45);
            }

            .bell-icon:active {
                transform: scale(0.95);
            }

            .bell-badge {
                position: absolute;
                top: -8px;
                right: -8px;
                background: #ff3b3b;
                color: #ffffff;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 11px;
                font-weight: 700;
                border: 2px solid #ffffff;
                animation: bellPulse 2s infinite;
                pointer-events: none;
            }

            @keyframes bellPulse {
                0%, 100% { transform: scale(1); }
                50%       { transform: scale(1.15); }
            }

            /* ===== BANNER SLIDER MODAL ===== */
            .banner-slider-backdrop {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.6);
                z-index: 998;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.35s ease;
            }
            .banner-slider-backdrop.open {
                opacity: 1;
                pointer-events: auto;
            }

            /* ── Container: fluid width + aspect-ratio so no fixed height needed ── */
            .banner-slider-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0.95);
                /* fluid: 92vw on small screens, capped at 860px on desktop */
                width: min(92vw, 860px);
                /* 16:9 aspect ratio — adjusts height automatically with the width */
                aspect-ratio: 16 / 9;
                /* never taller than 88% of viewport so it stays on screen */
                max-height: 88vh;
                background: #111;
                border-radius: 20px;
                z-index: 999;
                box-shadow: 0 24px 64px rgba(0, 0, 0, 0.45);
                display: flex;
                flex-direction: column;
                opacity: 0;
                pointer-events: none;
                overflow: hidden;
                transition: opacity 0.35s ease, transform 0.35s ease;
            }
            .banner-slider-container.open {
                opacity: 1;
                pointer-events: auto;
                transform: translate(-50%, -50%) scale(1);
            }

            .banner-slider-close {
                position: absolute;
                top: 12px;
                right: 12px;
                background: rgba(15, 39, 71, 0.85);
                color: #ffffff;
                border: none;
                width: 34px; height: 34px;
                border-radius: 50%;
                font-size: 18px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10;
                backdrop-filter: blur(4px);
                transition: background 0.2s ease;
            }
            .banner-slider-close:hover { background: #ff6a00; }

            .banner-slider-wrapper {
                flex: 1;
                position: relative;
                overflow: hidden;
                /* min-height:0 needed so flex child doesn't overflow */
                min-height: 0;
            }

            .banner-slides {
                display: flex;
                height: 100%;
                transition: transform 0.5s cubic-bezier(.4,0,.2,1);
            }

            /* ── Each slide ── */
            .banner-slide {
                min-width: 100%;
                height: 100%;
                position: relative;
                cursor: pointer;
                overflow: hidden;
                background: #111;
            }

            /* Blurred background layer — fills the letterbox areas */
            .banner-slide-blur {
                position: absolute;
                inset: -20px;           /* slightly larger than container */
                background-size: cover;
                background-position: center;
                filter: blur(18px) brightness(0.45);
                transform: scale(1.05); /* hide blur edge artefacts */
                z-index: 0;
            }

            /* Crisp image sits on top, fully visible with contain */
            .banner-slide img {
                position: relative;
                z-index: 1;
                width: 100%;
                height: 100%;
                object-fit: contain;    /* never crops — full image always visible */
                display: block;
            }

            /* Placeholder when no image */
            .banner-slide-empty {
                position: absolute;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #e9ecef;
                font-size: 2rem;
                color: #aaa;
                z-index: 0;
            }

            .banner-slide-overlay {
                position: absolute;
                bottom: 0; left: 0; right: 0;
                background: linear-gradient(transparent, rgba(10, 20, 40, 0.82));
                padding: clamp(14px, 3vw, 28px) clamp(14px, 3vw, 24px) clamp(12px, 2vw, 20px);
                color: #ffffff;
                z-index: 2;
            }
            .banner-slide-overlay p {
                font-size: clamp(13px, 2vw, 18px);
                font-weight: 600;
                margin: 0;
                text-shadow: 0 1px 4px rgba(0,0,0,.6);
            }

            /* ── Arrows ── */
            .banner-arrow {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: rgba(255, 106, 0, 0.82);
                color: #ffffff;
                border: none;
                width: clamp(32px, 4vw, 44px);
                height: clamp(32px, 4vw, 44px);
                border-radius: 50%;
                font-size: clamp(14px, 1.8vw, 18px);
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 5;
                backdrop-filter: blur(4px);
                transition: all 0.25s ease;
            }
            .banner-arrow:hover {
                background: #ff6a00;
                transform: translateY(-50%) scale(1.1);
            }
            .banner-arrow-prev { left: clamp(8px, 2vw, 16px); }
            .banner-arrow-next { right: clamp(8px, 2vw, 16px); }

            /* ── Dots ── */
            .banner-dots {
                display: flex;
                justify-content: center;
                gap: 7px;
                padding: clamp(8px, 1.2vw, 14px);
                background: rgba(0,0,0,0.65);
                flex-shrink: 0;
            }
            .banner-dot {
                width: 8px; height: 8px;
                border-radius: 50%;
                background: rgba(255,255,255,0.4);
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .banner-dot.active {
                background: #ff6a00;
                width: 24px;
                border-radius: 4px;
            }
            .banner-dot:hover { background: rgba(255,255,255,0.8); }

            /* ── Mobile: bell size only (layout already handled by min/clamp) ── */
            @media (max-width: 600px) {
                .bell-icon { width: 44px; height: 44px; font-size: 16px; }
                .bell-badge { width: 20px; height: 20px; font-size: 10px; }
                .banner-slider-container { border-radius: 14px; }
            }
            @media (max-width: 380px) {
                .bell-icon { width: 40px; height: 40px; font-size: 14px; }
                .bell-badge { width: 18px; height: 18px; font-size: 9px; }
            }
        `;
        const styleTag = document.createElement('style');
        styleTag.textContent = styles;
        document.head.appendChild(styleTag);
    }

    // Setup Drag Listeners
    function setupDragListeners() {
        const bellWrapper = document.getElementById('bellWrapper');
        if (!bellWrapper) return;

        // Mouse drag
        bellWrapper.addEventListener('mousedown', (e) => {
            if (e.button !== 0) return;
            e.preventDefault();
            isDragging = true;
            offsetX = e.clientX - bellWrapper.getBoundingClientRect().left;
            offsetY = e.clientY - bellWrapper.getBoundingClientRect().top;
            bellWrapper.classList.add('dragging');
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            const w = document.getElementById('bellWrapper');
            if (!w) return;
            let newX = Math.max(0, Math.min(e.clientX - offsetX, window.innerWidth - 50));
            let newY = Math.max(0, Math.min(e.clientY - offsetY, window.innerHeight - 50));
            w.style.left   = newX + 'px';
            w.style.top    = newY + 'px';
            w.style.bottom = 'auto';
        });

        document.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                const w = document.getElementById('bellWrapper');
                if (w) w.classList.remove('dragging');
            }
        });

        // Touch
        bellWrapper.addEventListener('touchstart', (e) => {
            isDragging = true;
            const t = e.touches[0];
            const r = bellWrapper.getBoundingClientRect();
            offsetX = t.clientX - r.left;
            offsetY = t.clientY - r.top;
            bellWrapper.classList.add('dragging');
        }, { passive: true });

        document.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            const w = document.getElementById('bellWrapper');
            if (!w) return;
            const t = e.touches[0];
            let newX = Math.max(0, Math.min(t.clientX - offsetX, window.innerWidth - 50));
            let newY = Math.max(0, Math.min(t.clientY - offsetY, window.innerHeight - 50));
            w.style.left   = newX + 'px';
            w.style.top    = newY + 'px';
            w.style.bottom = 'auto';
        }, { passive: true });

        document.addEventListener('touchend', () => {
            isDragging = false;
            const w = document.getElementById('bellWrapper');
            if (w) w.classList.remove('dragging');
        });
    }

    function toggleBannerSlider() {
        const c = document.getElementById('bannerSliderContainer');
        const b = document.getElementById('bannerBackdrop');
        if (!c || !b) return;
        c.classList.toggle('open');
        b.classList.toggle('open');
    }

    function closeBannerSlider(e) {
        if (e) e.stopPropagation();
        document.getElementById('bannerSliderContainer')?.classList.remove('open');
        document.getElementById('bannerBackdrop')?.classList.remove('open');
    }

    function nextBannerSlide() {
        currentSlideIndex = (currentSlideIndex + 1) % bannerSlidesData.length;
        updateSlide();
    }

    function prevBannerSlide() {
        currentSlideIndex = (currentSlideIndex - 1 + bannerSlidesData.length) % bannerSlidesData.length;
        updateSlide();
    }

    function goToSlide(index) {
        currentSlideIndex = index;
        updateSlide();
    }

    function updateSlide() {
        const s = document.getElementById('bannerSlides');
        if (s) s.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
        document.querySelectorAll('.banner-dot').forEach((d, i) => {
            d.classList.toggle('active', i === currentSlideIndex);
        });
    }

    function goToBannerPage(url) {
        if (url && url !== '#') window.location.href = url;
    }

    document.addEventListener('DOMContentLoaded', function () {
        createBellAndSlider();

        // Auto-advance when open
        setInterval(() => {
            const c = document.getElementById('bannerSliderContainer');
            if (c && c.classList.contains('open') && bannerSlidesData.length > 1) {
                nextBannerSlide();
            }
        }, 5000);

        window.toggleBannerSlider = toggleBannerSlider;
        window.closeBannerSlider  = closeBannerSlider;
        window.nextBannerSlide    = nextBannerSlide;
        window.prevBannerSlide    = prevBannerSlide;
        window.goToSlide          = goToSlide;
        window.goToBannerPage     = goToBannerPage;
    });
</script>
