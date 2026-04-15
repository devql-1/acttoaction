<!doctype html>
<html lang="en">

@include('frontend.Summercamp.partials.nav')

<body>
    <style>
/* ===== PARTNER PAGE STYLES ===== */
    .partner-sec {
        padding: 80px 0;
        background: white;
    }

    .partner-category {
        margin-bottom: 60px;
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .partner-category:nth-of-type(1) {
        animation-delay: 0s;
    }

    .partner-category:nth-of-type(2) {
        animation-delay: .2s;
    }

    .partner-category:nth-of-type(3) {
        animation-delay: .4s;
    }

    .category-title {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--head);
        margin-bottom: 40px;
        letter-spacing: 1px;
        text-transform: capitalize;
    }

    .partner-logos-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
        margin-bottom: 40px;
        align-items: center;
        justify-items: center;
    }

    .co-host-grid {
        grid-template-columns: repeat(2, 1fr);
        max-width: 700px;
        margin: 0 auto 40px;
    }

    .gold-partner-grid {
        grid-template-columns: repeat(3, 1fr);
        max-width: 900px;
        margin: 0 auto;
    }

    .partner-logo-item {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        background: #f9f9f9;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
        animation: zoomIn 0.6s ease-out forwards;
        opacity: 0;
        transition: all .4s cubic-bezier(.25, .46, .45, .94);
        border: 1px solid rgba(0, 0, 0, .08);
    }

    .partner-logo-item:hover {
        transform: translateY(-8px) scale(1.05);
        box-shadow: 0 20px 50px rgba(0, 0, 0, .15);
        border-color: var(--accent);
    }

    .partner-logo-item img {
        width: 100%;
        height: auto;
        max-height: 180px;
        object-fit: contain;
        transition: transform .4s ease;
    }

    .partner-logo-item a {
        display: contents;
    }

    .partner-logo-item:hover img {
        transform: scale(1.08);
    }

    .two-column-partners {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 60px;
        margin-bottom: 60px;
    }

    .two-column-partners .partner-category {
        margin-bottom: 0;
    }

    .two-column-partners .partner-logos-grid {
        margin-bottom: 0;
    }

    .divider {
        border: none;
        height: 2px;
        background: linear-gradient(to right, transparent, #ddd, transparent);
        margin: 60px 0;
        animation: slideInRight .8s ease-out forwards;
        opacity: 0;
    }

    .scroll-top {
        position: fixed;
        right: 16px;
        bottom: -20px;
        z-index: 9999;
        width: 44px;
        height: 44px;
        background: var(--accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: .4s;
        text-decoration: none;
    }

    .scroll-top i {
        font-size: 22px;
        color: #fff;
    }

    .scroll-top.show {
        bottom: 16px;
        opacity: 1;
        visibility: visible;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @media (max-width: 991px) {
        .two-column-partners {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .gold-partner-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 767px) {
        .partner-sec {
            padding: 50px 0;
        }

        .partner-logos-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .co-host-grid,
        .gold-partner-grid {
            grid-template-columns: 1fr;
        }

        .category-title {
            font-size: 1.4rem;
            margin-bottom: 30px;
        }

        .divider {
            margin: 40px 0;
        }
    }
    </style>

    <!-- ===== ANNOUNCEMENT BAR ===== -->
    @include('frontend.partialspages.ann_bar')

    <!-- ===== HEADER ===== -->
    @include('frontend.Summercamp.partials.header')

    <!-- ===== HERO ===== -->
    <section class="hero"
        style="height:380px;margin-top:0;background:linear-gradient(135deg,#112344 0%,#1e3a6e 60%,#ff6a00 100%);display:flex;align-items:center;justify-content:center;text-align:center;">
        <div>
            <div
                style="display:inline-block;background:rgba(255,106,0,.15);color:#ff6a00;padding:6px 20px;border-radius:20px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:20px;">
                Summer Camp 2025
            </div>
            <h1
                style="font-size:clamp(2.2rem,6vw,4rem);font-weight:900;color:#fff;letter-spacing:2px;text-transform:uppercase;margin:0 0 16px;">
                Our Partners
            </h1>
            <p style="color:rgba(255,255,255,.75);font-size:16px;max-width:520px;margin:0 auto;line-height:1.7;">
                The organisations and institutions who made Summer Camp 2025 possible.
            </p>
        </div>
    </section>

    <!-- ===== PARTNERS ===== -->
    <section class="partner-sec">
        <div class="container">

            @php
                $hasAny = collect($partners)->filter(fn($cat) => $cat['partners']->isNotEmpty())->isNotEmpty();
            @endphp

            @if (!$hasAny)
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-people" style="font-size:3rem;opacity:.3;"></i>
                    <p class="mt-3">Partner details coming soon.</p>
                </div>
            @else
                @php $visibleCategories = collect($partners)->filter(fn($cat) => $cat['partners']->isNotEmpty()); @endphp

                @foreach ($visibleCategories as $slug => $cat)
                    @php $isLast = $loop->last; @endphp

                    <div class="partner-category">
                        <h3 class="category-title">{{ $cat['label'] }}</h3>
                        <div class="partner-logos-grid">
                            @foreach ($cat['partners'] as $partner)
                                <div class="partner-logo-item">
                                    @if ($partner->website_url)
                                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener">
                                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" />
                                        </a>
                                    @else
                                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" />
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if (!$isLast)
                        <hr class="divider" />
                    @endif
                @endforeach
            @endif

        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    @include('frontend.Summercamp.partials.footer')

    <!-- Scroll to Top -->
    <a href="#" class="scroll-top" id="scrollTop"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            scrollTopBtn.classList.toggle('show', window.scrollY > 120);
        });
        scrollTopBtn.addEventListener('click', e => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>
