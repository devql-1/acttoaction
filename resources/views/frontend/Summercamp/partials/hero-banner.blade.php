{{-- resources/views/frontend/partials/hero-banner.blade.php --}}
{{-- Include in your main page: @include('frontend.partials.hero-banner') --}}

@if ($heroBanner)
    <section class="hero" id="hero">
        <img class="hero-banner-img" src="{{ asset($heroBanner->image_url) }}" alt="{{ $heroBanner->alt_text }}"
            width="1376" height="495" loading="eager" fetchpriority="high" />
    </section>
@else
    {{-- Fallback when no banner is configured in admin yet --}}
    <section class="hero hero--fallback" id="hero">
        <div class="hero-fallback-content">
            <div class="hero-fallback-inner">
                <span class="hero-fallback-tag">🎭 Act To Action</span>
                <h2>Summer Camp 2026</h2>
                <p>Jaipur's Biggest Performing Arts Camp</p>
            </div>
        </div>
    </section>
@endif

{{-- ── Styles (scoped to this partial only) ── --}}
<style>
    /* Hero banner — pure image, no text */
    .hero {
        width: 100%;
        height: 92vh;
        min-height: 500px;
        position: relative;
        overflow: hidden;
        display: block;
    }

    .hero-banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    /* Subtle vignette at bottom */
    .hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 160px;
        background: linear-gradient(to top, rgba(0, 0, 0, .3), transparent);
        pointer-events: none;
    }

    /* Fallback state */
    .hero--fallback {
        background: linear-gradient(135deg, #112344, #1c3d75);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-fallback-content {
        text-align: center;
        color: #fff;
        padding: 0 20px;
    }

    .hero-fallback-tag {
        display: inline-block;
        background: rgba(255, 106, 0, .2);
        border: 1px solid rgba(255, 106, 0, .4);
        color: #ff6a00;
        padding: 6px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }

    .hero-fallback-content h2 {
        font-size: clamp(2rem, 6vw, 4rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 12px;
    }

    .hero-fallback-content p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, .65);
        margin: 0;
    }

    @media (max-width: 767px) {
        .hero {
            height: 55vw;
            min-height: 260px;
        }
    }
</style>
