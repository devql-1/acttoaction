<script>
    // Banner Slides Data - Static
    const bannerSlidesData = [{
            id: 1,
            image: "{{ asset('courseassets/img/homebanner/IMG_3987.JPEG') }}",
            title: "Learn Programming",
            url: "{{ route('index.course') }}"
        },
        {
            id: 2,
            image: "https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80",
            title: "Free Skill Assessment",
            url: "{{ route('frontend.tests') }}"
        },
        {
            id: 3,
            image: "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&q=80",
            title: "Summer Camp 2026",
            url: "{{ route('summercamp') }}"
        },
        {
            id: 4,
            image: "https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80",
            title: "Special Offer - 30% Off",
            url: "{{ route('index.course') }}"
        }
    ];

    let currentSlideIndex = 0;
    let isDragging = false;
    let offsetX = 0;
    let offsetY = 0;

    // Create Draggable Bell + Banner Slider
    function createBellAndSlider() {
        const bellHTML = `
            <div class="bell-notification-wrapper" id="bellWrapper" draggable="false">
                <button class="bell-icon" id="bellIcon" aria-label="Notifications">
                    <i class="fas fa-bell"></i>
                    <span class="bell-badge">${bannerSlidesData.length}</span>
                </button>
            </div>
        `;

        const sliderHTML = `
            <!-- Banner Slider Modal -->
            <div class="banner-slider-backdrop" id="bannerBackdrop" onclick="closeBannerSlider(event)"></div>
            
            <div class="banner-slider-container" id="bannerSliderContainer">
                <!-- Close Button -->
                <button class="banner-slider-close" onclick="closeBannerSlider(event)" aria-label="Close">✕</button>

                <!-- Slider Wrapper -->
                <div class="banner-slider-wrapper">
                    <div class="banner-slides" id="bannerSlides">
                        ${bannerSlidesData.map((slide, index) => `
                            <div class="banner-slide" onclick="goToBannerPage('${slide.url}')">
                                <img src="${slide.image}" alt="${slide.title}">
                                <div class="banner-slide-overlay">
                                    <p>${slide.title}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>

                    <!-- Navigation Arrows -->
                    <button class="banner-arrow banner-arrow-prev" onclick="prevBannerSlide()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="banner-arrow banner-arrow-next" onclick="nextBannerSlide()">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Dots Indicator -->
                <div class="banner-dots" id="bannerDots">
                    ${bannerSlidesData.map((_, index) => `
                        <span class="banner-dot ${index === 0 ? 'active' : ''}" onclick="goToSlide(${index})"></span>
                    `).join('')}
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', bellHTML);
        document.body.insertAdjacentHTML('beforeend', sliderHTML);
        addBellAndSliderStyles();
        setupDragListeners();

        // Add click listener to bell icon
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
                0%, 100% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.15);
                }
            }

            /* ===== BANNER SLIDER MODAL ===== */
            .banner-slider-backdrop {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.6);
                z-index: 998;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.35s ease, pointer-events 0.35s ease;
            }

            .banner-slider-backdrop.open {
                opacity: 1;
                pointer-events: auto;
            }

            .banner-slider-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 900px;
                height: 500px;
                background: #ffffff;
                border-radius: 20px;
                z-index: 999;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                display: flex;
                flex-direction: column;
                opacity: 0;
                pointer-events: none;
                overflow: hidden;
                transition: opacity 0.4s ease, pointer-events 0.4s ease;
            }

            .banner-slider-container.open {
                opacity: 1;
                pointer-events: auto;
            }

            .banner-slider-close {
                position: absolute;
                top: 15px;
                right: 15px;
                background: #0f2747;
                color: #ffffff;
                border: none;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                font-size: 20px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10;
                transition: background 0.2s ease;
            }

            .banner-slider-close:hover {
                background: #ff6a00;
            }

            .banner-slider-wrapper {
                flex: 1;
                position: relative;
                overflow: hidden;
            }

            .banner-slides {
                display: flex;
                height: 100%;
                transition: transform 0.5s ease;
            }

            .banner-slide {
                min-width: 100%;
                height: 100%;
                position: relative;
                cursor: pointer;
                overflow: hidden;
            }

            .banner-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
            }

            .banner-slide:hover img {
                transform: scale(1.05);
            }

            .banner-slide-overlay {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(transparent, rgba(15, 39, 71, 0.8));
                padding: 30px 20px 20px;
                color: #ffffff;
            }

            .banner-slide-overlay p {
                font-size: 18px;
                font-weight: 600;
                margin: 0;
            }

            /* Navigation Arrows */
            .banner-arrow {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: rgba(255, 106, 0, 0.85);
                color: #ffffff;
                border: none;
                width: 45px;
                height: 45px;
                border-radius: 50%;
                font-size: 18px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 5;
                transition: all 0.3s ease;
            }

            .banner-arrow:hover {
                background: #ff6a00;
                transform: translateY(-50%) scale(1.1);
            }

            .banner-arrow-prev {
                left: 15px;
            }

            .banner-arrow-next {
                right: 15px;
            }

            /* Dots Indicator */
            .banner-dots {
                display: flex;
                justify-content: center;
                gap: 8px;
                padding: 16px;
                background: #f8f9fb;
            }

            .banner-dot {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: #d0d5dd;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .banner-dot.active {
                background: #ff6a00;
                width: 28px;
                border-radius: 5px;
            }

            .banner-dot:hover {
                background: #ff6a00;
            }

            /* ===== MOBILE RESPONSIVE ===== */
            @media (max-width: 900px) {
                .bell-icon {
                    width: 45px;
                    height: 45px;
                    font-size: 18px;
                }

                .banner-slider-container {
                    height: 350px;
                    max-width: 85%;
                }

                .banner-slide-overlay {
                    padding: 20px 15px 15px;
                }

                .banner-slide-overlay p {
                    font-size: 15px;
                }

                .banner-arrow {
                    width: 38px;
                    height: 38px;
                    font-size: 16px;
                }
            }

            @media (max-width: 600px) {
                .bell-icon {
                    width: 44px;
                    height: 44px;
                    font-size: 16px;
                }

                .bell-badge {
                    width: 20px;
                    height: 20px;
                    font-size: 10px;
                }

                .banner-slider-container {
                    height: 300px;
                    width: 95%;
                    max-width: none;
                    border-radius: 16px;
                }

                .banner-arrow {
                    width: 34px;
                    height: 34px;
                    font-size: 14px;
                }

                .banner-arrow-prev {
                    left: 8px;
                }

                .banner-arrow-next {
                    right: 8px;
                }

                .banner-slide-overlay {
                    padding: 16px 12px 12px;
                }

                .banner-slide-overlay p {
                    font-size: 13px;
                }

                .banner-dots {
                    padding: 12px;
                    gap: 6px;
                }

                .banner-dot {
                    width: 8px;
                    height: 8px;
                }

                .banner-dot.active {
                    width: 24px;
                }
            }

            @media (max-width: 380px) {
                .bell-icon {
                    width: 40px;
                    height: 40px;
                    font-size: 14px;
                }

                .bell-badge {
                    width: 18px;
                    height: 18px;
                    font-size: 9px;
                }

                .banner-slider-container {
                    height: 250px;
                }

                .banner-slide-overlay p {
                    font-size: 12px;
                }
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

        let clickCount = 0;
        let clickTimeout;

        // Mouse drag
        bellWrapper.addEventListener('mousedown', (e) => {
            if (e.button !== 0) return; // Only left click

            clickCount++;
            if (clickCount === 1) {
                clickTimeout = setTimeout(() => {
                    // Single click - just toggle modal
                    clickCount = 0;
                }, 300);
                return;
            }

            // Prevent default drag behavior
            e.preventDefault();
            clearTimeout(clickTimeout);
            clickCount = 0;

            isDragging = true;
            offsetX = e.clientX - bellWrapper.getBoundingClientRect().left;
            offsetY = e.clientY - bellWrapper.getBoundingClientRect().top;
            bellWrapper.classList.add('dragging');
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;

            const bellWrapper = document.getElementById('bellWrapper');
            if (!bellWrapper) return;

            let newX = e.clientX - offsetX;
            let newY = e.clientY - offsetY;

            // Keep bell within viewport
            const maxX = window.innerWidth - 50;
            const maxY = window.innerHeight - 50;

            newX = Math.max(0, Math.min(newX, maxX));
            newY = Math.max(0, Math.min(newY, maxY));

            bellWrapper.style.left = newX + 'px';
            bellWrapper.style.top = newY + 'px';
            bellWrapper.style.bottom = 'auto';
        });

        document.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                const bellWrapper = document.getElementById('bellWrapper');
                if (bellWrapper) {
                    bellWrapper.classList.remove('dragging');
                }
            }
        });

        // Touch support for mobile
        bellWrapper.addEventListener('touchstart', (e) => {
            isDragging = true;
            const touch = e.touches[0];
            const rect = bellWrapper.getBoundingClientRect();
            offsetX = touch.clientX - rect.left;
            offsetY = touch.clientY - rect.top;
            bellWrapper.classList.add('dragging');
        }, false);

        document.addEventListener('touchmove', (e) => {
            if (!isDragging) return;

            const bellWrapper = document.getElementById('bellWrapper');
            if (!bellWrapper) return;

            const touch = e.touches[0];
            let newX = touch.clientX - offsetX;
            let newY = touch.clientY - offsetY;

            const maxX = window.innerWidth - 50;
            const maxY = window.innerHeight - 50;

            newX = Math.max(0, Math.min(newX, maxX));
            newY = Math.max(0, Math.min(newY, maxY));

            bellWrapper.style.left = newX + 'px';
            bellWrapper.style.top = newY + 'px';
            bellWrapper.style.bottom = 'auto';
        }, false);

        document.addEventListener('touchend', () => {
            isDragging = false;
            const bellWrapper = document.getElementById('bellWrapper');
            if (bellWrapper) {
                bellWrapper.classList.remove('dragging');
            }
        }, false);
    }

    // Toggle Banner Slider
    function toggleBannerSlider() {
        const container = document.getElementById('bannerSliderContainer');
        const backdrop = document.getElementById('bannerBackdrop');

        if (container && backdrop) {
            const isOpen = container.classList.contains('open');
            if (isOpen) {
                container.classList.remove('open');
                backdrop.classList.remove('open');
            } else {
                container.classList.add('open');
                backdrop.classList.add('open');
            }
        }
    }

    // Close Banner Slider
    function closeBannerSlider(e) {
        if (e) {
            e.stopPropagation();
        }

        const container = document.getElementById('bannerSliderContainer');
        const backdrop = document.getElementById('bannerBackdrop');

        if (container) container.classList.remove('open');
        if (backdrop) backdrop.classList.remove('open');
    }

    // Next Slide
    function nextBannerSlide() {
        currentSlideIndex = (currentSlideIndex + 1) % bannerSlidesData.length;
        updateSlide();
    }

    // Previous Slide
    function prevBannerSlide() {
        currentSlideIndex = (currentSlideIndex - 1 + bannerSlidesData.length) % bannerSlidesData.length;
        updateSlide();
    }

    // Go to Specific Slide
    function goToSlide(index) {
        currentSlideIndex = index;
        updateSlide();
    }

    // Update Slide Display
    function updateSlide() {
        const slidesContainer = document.getElementById('bannerSlides');
        const dots = document.querySelectorAll('.banner-dot');

        if (slidesContainer) {
            slidesContainer.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
        }

        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlideIndex);
        });
    }

    // Go to Banner Page
    function goToBannerPage(url) {
        if (url && url !== '#') {
            window.location.href = url;
        }
    }

    // Initialize on Page Load
    document.addEventListener('DOMContentLoaded', function() {
        createBellAndSlider();

        // Auto-advance slides every 5 seconds (only when modal is open)
        setInterval(() => {
            try {
                const container = document.getElementById('bannerSliderContainer');
                if (container && container.classList.contains('open')) {
                    nextBannerSlide();
                }
            } catch (err) {
                console.log('Auto-advance error:', err);
            }
        }, 5000);

        // Make functions globally accessible
        window.toggleBannerSlider = toggleBannerSlider;
        window.closeBannerSlider = closeBannerSlider;
        window.nextBannerSlide = nextBannerSlide;
        window.prevBannerSlide = prevBannerSlide;
        window.goToSlide = goToSlide;
        window.goToBannerPage = goToBannerPage;
    });
</script>
