{{-- resources/views/frontend/Summercamp/workshopdetails.blade.php --}}
@extends('frontend.course.layout')
@section('title', $school->name . ' – Act To Action')

<style>
/* ── Hero ── */
.ws-hero {
    position: relative;
    min-height: 500px;
    display: flex;
    align-items: flex-end;
    overflow: hidden;
    padding-top: 185px;
}
.ws-hero-img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.ws-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,20,50,0.92) 0%, rgba(10,20,50,0.4) 55%, transparent 100%);
}
.ws-hero-content {
    position: relative;
    z-index: 2;
    padding: 0 0 48px;
    width: 100%;
}
.ws-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.25);
    color: #fff;
    font-size: 0.82rem;
    font-weight: 600;
    padding: 5px 14px;
    border-radius: 30px;
    margin-bottom: 14px;
    letter-spacing: 0.4px;
}
.ws-hero-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.2;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.ws-hero-desc {
    font-size: 1.05rem;
    color: rgba(255,255,255,0.85);
    max-width: 680px;
    margin-bottom: 28px;
    line-height: 1.7;
}
.ws-hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}
.btn-register-hero {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 36px;
    border-radius: 50px;
    background: var(--accent-color);
    color: #fff;
    font-size: 1.05rem;
    font-weight: 700;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 8px 24px rgba(0,0,0,0.25);
    letter-spacing: 0.2px;
}
.btn-register-hero:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 32px rgba(0,0,0,0.3);
    color: #fff;
    text-decoration: none;
}
.btn-register-hero i { font-size: 1.1rem; }

/* ── Sticky CTA bar ── */
.ws-sticky-bar {
    position: sticky;
    top: 0;
    z-index: 900;
    background: rgba(255,255,255,0.97);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(0,0,0,0.08);
    padding: 12px 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
}
.ws-sticky-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
}
.ws-sticky-title {
    font-weight: 700;
    color: var(--heading-color);
    font-size: 1rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 360px;
}
.ws-sticky-meta {
    display: flex;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
}
.ws-sticky-meta span {
    font-size: 0.88rem;
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 5px;
}
.ws-sticky-meta i { color: var(--accent-color); }
.btn-register-sticky {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 26px;
    border-radius: 50px;
    background: var(--accent-color);
    color: #fff;
    font-size: 0.92rem;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    transition: all 0.25s;
    box-shadow: 0 4px 14px rgba(0,0,0,0.15);
}
.btn-register-sticky:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; text-decoration: none; }

/* ── Info cards ── */
.info-card {
    background: var(--surface-color);
    border-radius: 16px;
    padding: 24px;
    border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
    height: 100%;
    transition: box-shadow 0.25s, transform 0.25s;
}
.info-card:hover { box-shadow: 0 8px 28px rgba(0,0,0,0.08); transform: translateY(-2px); }
.info-card-icon {
    width: 48px; height: 48px;
    background: color-mix(in srgb, var(--accent-color), transparent 88%);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 14px;
}
.info-card-icon i { font-size: 1.4rem; color: var(--accent-color); }
.info-card-label { font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; color: #9ca3af; margin-bottom: 4px; }
.info-card-value { font-size: 1.05rem; font-weight: 600; color: var(--heading-color); }
.info-card-value.price { font-size: 1.5rem; color: var(--accent-color); }

/* ── Section titles ── */
.ws-section-title {
    font-size: 1.65rem;
    font-weight: 700;
    color: var(--heading-color);
    margin-bottom: 8px;
}
.ws-section-title::after {
    content: "";
    display: block;
    width: 40px; height: 3px;
    background: var(--accent-color);
    border-radius: 2px;
    margin-top: 10px;
}

/* ── About block ── */
.about-block {
    background: var(--surface-color);
    border-radius: 16px;
    padding: 36px;
    border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
}
.about-block p {
    font-size: 1.02rem;
    line-height: 1.8;
    color: color-mix(in srgb, var(--default-color), transparent 15%);
    margin-bottom: 0;
}

/* ── Contact card ── */
.contact-card {
    background: linear-gradient(135deg, var(--accent-color), color-mix(in srgb, var(--accent-color), #000 20%));
    border-radius: 16px;
    padding: 32px;
    color: #fff;
    text-align: center;
    position: sticky;
    top: 80px;
}
.contact-card h4 { font-weight: 700; margin-bottom: 8px; font-size: 1.2rem; }
.contact-card p { opacity: 0.85; font-size: 0.9rem; margin-bottom: 16px; }
.btn-call {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.2);
    border: 2px solid rgba(255,255,255,0.5);
    color: #fff;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s;
    backdrop-filter: blur(4px);
}
.btn-call:hover { background: rgba(255,255,255,0.3); color: #fff; text-decoration: none; transform: translateY(-2px); }

/* ── Related cards ── */
.related-card {
    background: var(--surface-color);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: transform 0.3s, box-shadow 0.3s;
    text-decoration: none;
    color: inherit;
    display: block;
}
.related-card:hover { transform: translateY(-5px); box-shadow: 0 12px 32px rgba(0,0,0,0.12); text-decoration: none; color: inherit; }
.related-card-img { height: 180px; overflow: hidden; background: color-mix(in srgb, var(--accent-color), transparent 88%); }
.related-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
.related-card:hover .related-card-img img { transform: scale(1.05); }
.related-card-body { padding: 20px; }
.related-card-body h5 { font-weight: 700; margin-bottom: 6px; font-size: 1rem; }

/* ── Feature badges ── */
.feature-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: color-mix(in srgb, var(--accent-color), transparent 92%);
    color: var(--accent-color);
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 600;
    margin: 4px;
}

/* ── CTA Bottom ── */
.ws-cta-bottom {
    background: linear-gradient(135deg, #0a1432 0%, #1a2e5c 100%);
    border-radius: 20px;
    padding: 60px 40px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.ws-cta-bottom::before {
    content: "";
    position: absolute;
    top: -60px; right: -60px;
    width: 220px; height: 220px;
    background: var(--accent-color);
    border-radius: 50%;
    opacity: 0.08;
}
.ws-cta-bottom::after {
    content: "";
    position: absolute;
    bottom: -40px; left: -40px;
    width: 160px; height: 160px;
    background: var(--accent-color);
    border-radius: 50%;
    opacity: 0.06;
}
.ws-cta-bottom h2 { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; margin-bottom: 12px; position: relative; z-index: 1; }
.ws-cta-bottom p { font-size: 1.05rem; opacity: 0.8; margin-bottom: 28px; position: relative; z-index: 1; }
.btn-register-cta {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 16px 48px;
    border-radius: 50px;
    background: var(--accent-color);
    color: #fff;
    font-size: 1.1rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 8px 28px rgba(0,0,0,0.3);
    position: relative; z-index: 1;
}
.btn-register-cta:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(0,0,0,0.4); color: #fff; text-decoration: none; }

/* ── Merchandise ── */
.merch-section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 32px;
}
.merch-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: color-mix(in srgb, var(--accent-color), transparent 90%);
    color: var(--accent-color);
    font-size: 0.75rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    margin-bottom: 8px;
}
.merch-card {
    background: var(--surface-color);
    border-radius: 16px;
    overflow: hidden;
    border: 1.5px solid color-mix(in srgb, var(--default-color), transparent 90%);
    transition: box-shadow 0.25s, transform 0.2s, border-color 0.25s;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.merch-card:hover {
    box-shadow: 0 14px 40px rgba(0,0,0,0.10);
    transform: translateY(-5px);
    border-color: var(--accent-color);
}
.merch-card-img {
    width: 100%;
    height: 190px;
    object-fit: cover;
    display: block;
}
.merch-card-placeholder {
    width: 100%;
    height: 190px;
    background: color-mix(in srgb, var(--accent-color), transparent 92%);
    display: flex;
    align-items: center;
    justify-content: center;
}
.merch-card-placeholder i { font-size: 3rem; color: var(--accent-color); opacity: 0.35; }
.merch-card-body {
    padding: 20px 18px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.merch-card-name {
    font-size: 1rem;
    font-weight: 700;
    color: var(--heading-color);
    margin-bottom: 5px;
}
.merch-card-desc {
    font-size: 0.82rem;
    color: #9ca3af;
    line-height: 1.5;
    flex: 1;
    margin-bottom: 14px;
}
.merch-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 12px;
    border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 92%);
}
.merch-card-price {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--accent-color);
}
.merch-card-price sup { font-size: 0.7rem; font-weight: 600; vertical-align: super; }
.merch-add-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--accent-color);
    background: color-mix(in srgb, var(--accent-color), transparent 90%);
    padding: 5px 12px;
    border-radius: 20px;
}
.merch-note {
    margin-top: 24px;
    padding: 16px 20px;
    background: color-mix(in srgb, var(--accent-color), transparent 94%);
    border-radius: 12px;
    border-left: 4px solid var(--accent-color);
    font-size: 0.875rem;
    color: color-mix(in srgb, var(--default-color), transparent 10%);
    display: flex;
    align-items: center;
    gap: 10px;
}
.merch-note i { color: var(--accent-color); flex-shrink: 0; font-size: 1rem; }

@media (max-width: 767px) {
    .ws-sticky-title { max-width: 180px; font-size: 0.88rem; }
    .ws-sticky-meta { display: none; }
    .about-block { padding: 24px; }
    .ws-cta-bottom { padding: 40px 24px; }
    .btn-register-cta { padding: 14px 32px; font-size: 1rem; }
}
</style>

@section('content')
<style>.ws-hero { padding-top: 185px !important; }</style>
<main class="main">

    {{-- ── Hero ── --}}
    <section class="ws-hero">
        @if($school->image_url)
            <img src="{{ $school->image_url }}" alt="{{ $school->name }}" class="ws-hero-img">
        @else
            <div class="ws-hero-img" style="background: linear-gradient(135deg, #0a1432 0%, #1a2e5c 100%);"></div>
        @endif
        <div class="ws-hero-overlay"></div>
        <div class="container ws-hero-content">
            <nav aria-label="breadcrumb" style="margin-bottom: 16px;">
                <ol class="breadcrumb" style="background:none;padding:0;margin:0;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,0.7);text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('workshops') }}" style="color:rgba(255,255,255,0.7);text-decoration:none;">Workshops</a></li>
                    @if($school->ageGroup && $school->city)
                        <li class="breadcrumb-item">
                            <a href="{{ route('workshops', ['age_group_id' => $school->age_group_id, 'city_id' => $school->city_id]) }}" style="color:rgba(255,255,255,0.7);text-decoration:none;">
                                {{ $school->ageGroup->name }} · {{ $school->city->name }}
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,0.5);">{{ $school->name }}</li>
                </ol>
            </nav>

            <div class="d-flex flex-wrap gap-2 mb-3">
                @if($school->ageGroup)
                    <span class="ws-hero-badge"><i class="bi bi-people-fill"></i>{{ $school->ageGroup->name }}</span>
                @endif
                @if($school->city?->name)
                    <span class="ws-hero-badge"><i class="bi bi-geo-alt-fill"></i>{{ $school->city->name }}</span>
                @endif
                @if($school->fees > 0)
                    <span class="ws-hero-badge"><i class="bi bi-currency-rupee"></i>₹{{ number_format($school->fees) }} per child</span>
                @else
                    <span class="ws-hero-badge" style="background:rgba(22,163,74,0.3);border-color:rgba(22,163,74,0.5);"><i class="bi bi-gift-fill"></i>Free Workshop</span>
                @endif
            </div>

            <h1 class="ws-hero-title">{{ $school->name }}</h1>

            @if($school->description)
                <p class="ws-hero-desc">{{ Str::limit($school->description, 180) }}</p>
            @endif

            <div class="ws-hero-actions">
                <a href="{{ route('workshops.register', $school) }}" class="btn-register-hero">
                    <i class="bi bi-pencil-square"></i>
                    Register Now
                </a>
                <a href="#about" class="btn-call" style="background:rgba(255,255,255,0.1);border-color:rgba(255,255,255,0.35);">
                    <i class="bi bi-info-circle"></i> Learn More
                </a>
            </div>
        </div>
    </section>

    {{-- ── Sticky bar ── --}}
    <div class="ws-sticky-bar">
        <div class="container ws-sticky-inner">
            <span class="ws-sticky-title">{{ $school->name }}</span>
            <div class="ws-sticky-meta">
                @if($school->timings)
                    <span><i class="bi bi-clock"></i>{{ $school->timings }}</span>
                @endif
                @if($school->city)
                    <span><i class="bi bi-geo-alt"></i>{{ $school->city->name }}</span>
                @endif
                @if($school->fees > 0)
                    <span><i class="bi bi-currency-rupee"></i>₹{{ number_format($school->fees) }}/child</span>
                @endif
            </div>
            <a href="{{ route('workshops.register', $school) }}" class="btn-register-sticky">
                <i class="bi bi-arrow-right-circle-fill"></i> Register Now
            </a>
        </div>
    </div>

    {{-- ── Info Cards ── --}}
    <section class="section" style="padding: 60px 0 40px;">
        <div class="container">
            <div class="row g-3">
                @if($school->timings)
                <div class="col-6 col-md-3">
                    <div class="info-card">
                        <div class="info-card-icon"><i class="bi bi-calendar-week"></i></div>
                        <div class="info-card-label">Schedule</div>
                        <div class="info-card-value">{{ $school->timings }}</div>
                    </div>
                </div>
                @endif
                @if($school->city)
                <div class="col-6 col-md-3">
                    <div class="info-card">
                        <div class="info-card-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div class="info-card-label">Location</div>
                        <div class="info-card-value">{{ $school->city->name }}</div>
                    </div>
                </div>
                @endif
                @if($school->ageGroup)
                <div class="col-6 col-md-3">
                    <div class="info-card">
                        <div class="info-card-icon"><i class="bi bi-people-fill"></i></div>
                        <div class="info-card-label">Age Group</div>
                        <div class="info-card-value">{{ $school->ageGroup->name }}</div>
                    </div>
                </div>
                @endif
                <div class="col-6 col-md-3">
                    <div class="info-card">
                        <div class="info-card-icon"><i class="bi bi-currency-rupee"></i></div>
                        <div class="info-card-label">Fees</div>
                        <div class="info-card-value price">
                            @if($school->fees > 0)
                                ₹{{ number_format($school->fees) }}
                                <span style="font-size:0.75rem;font-weight:400;color:#9ca3af;display:block;">per child</span>
                            @else
                                <span style="color:#16a34a;">Free</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── About + Contact ── --}}
    <section id="about" class="section" style="padding: 40px 0 60px;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8" data-aos="fade-up">
                    @if($school->description)
                        <div class="about-block mb-4">
                            <h2 class="ws-section-title">About This Workshop</h2>
                            <p style="margin-top: 24px;">{{ $school->description }}</p>
                        </div>
                    @endif

                    {{-- Feature highlights ── --}}
                    <div class="d-flex flex-wrap mt-2">
                        <span class="feature-pill"><i class="bi bi-award-fill"></i> Professional Trainers</span>
                        <span class="feature-pill"><i class="bi bi-camera-video-fill"></i> Practical Learning</span>
                        <span class="feature-pill"><i class="bi bi-shield-check"></i> Safe Environment</span>
                        <span class="feature-pill"><i class="bi bi-trophy-fill"></i> Certificate</span>
                        @if($school->fees == 0)
                            <span class="feature-pill"><i class="bi bi-gift-fill"></i> Completely Free</span>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-card">
                        <i class="bi bi-telephone-fill" style="font-size:2rem;margin-bottom:12px;opacity:0.9;display:block;"></i>
                        <h4>Have Questions?</h4>
                        <p>Our team is here to help you Mon–Sat, 11 AM – 7 PM</p>
                        <a href="tel:+919024164323" class="btn-call mb-3">
                            <i class="bi bi-telephone-fill"></i> +91 90241 64323
                        </a>
                        <div style="border-top:1px solid rgba(255,255,255,0.15);padding-top:16px;margin-top:8px;">
                            <a href="{{ route('workshops.register', $school) }}" class="btn-register-hero" style="width:100%;justify-content:center;margin-top:12px;">
                                <i class="bi bi-pencil-square"></i> Register Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Location ── --}}
    @if($school->address)
        <section class="section light-background" style="padding: 60px 0;">
            <div class="container">
                <div class="text-center mb-4" data-aos="fade-up">
                    <h2 class="ws-section-title d-inline-block">Workshop Location</h2>
                </div>
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-8" data-aos="fade-up">
                        <div style="border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);height:380px;">
                            <iframe
                                src="https://maps.google.com/maps?q={{ urlencode($school->address) }}&output=embed"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="about-block h-100 d-flex flex-column justify-content-center gap-4">
                            <div>
                                <div class="info-card-icon mb-2"><i class="bi bi-geo-alt-fill"></i></div>
                                <p class="info-card-label">Address</p>
                                <p style="margin:0;line-height:1.6;color:color-mix(in srgb,var(--default-color),transparent 20%);">{{ $school->address }}</p>
                            </div>
                            <div>
                                <div class="info-card-icon mb-2"><i class="bi bi-telephone-fill"></i></div>
                                <p class="info-card-label">Phone</p>
                                <p style="margin:0;font-weight:600;">+91 90241 64323</p>
                            </div>
                            <div>
                                <div class="info-card-icon mb-2"><i class="bi bi-envelope-fill"></i></div>
                                <p class="info-card-label">Email</p>
                                <p style="margin:0;font-weight:600;">info@acttoaction.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ── Merchandise ── --}}
    @if($merchandises->isNotEmpty())
    <section class="section" style="padding: 60px 0; background: color-mix(in srgb, var(--accent-color), transparent 97%);">
        <div class="container">
            <div class="merch-section-header" data-aos="fade-up">
                <div>
                    <div class="merch-badge"><i class="bi bi-bag-heart-fill"></i> Official Merchandise</div>
                    <h2 class="ws-section-title" style="margin-bottom: 0;">Add Merchandise to Your Order</h2>
                    <p style="color:#6b7280; margin-top: 8px; font-size: 0.95rem;">
                        Select items when you register — fees are added to your total automatically.
                    </p>
                </div>
                <a href="{{ route('workshops.register', $school) }}" class="btn-register-hero" style="white-space:nowrap;">
                    <i class="bi bi-pencil-square"></i> Register &amp; Add Items
                </a>
            </div>

            <div class="row g-4">
                @foreach($merchandises as $item)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up">
                        <div class="merch-card">
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="merch-card-img">
                            @else
                                <div class="merch-card-placeholder">
                                    <i class="bi bi-bag"></i>
                                </div>
                            @endif
                            <div class="merch-card-body">
                                <div class="merch-card-name">{{ $item->name }}</div>
                                @if($item->description)
                                    <div class="merch-card-desc">{{ Str::limit($item->description, 70) }}</div>
                                @endif
                                <div class="merch-card-footer">
                                    <div class="merch-card-price">
                                        <sup>₹</sup>{{ number_format($item->price, 0) }}
                                    </div>
                                    <span class="merch-add-tag">
                                        <i class="bi bi-plus-circle-fill"></i> Add on Register
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="merch-note" data-aos="fade-up">
                <i class="bi bi-info-circle-fill"></i>
                Merchandise is optional. You can select items and quantities on the registration page — the price will be added to your workshop fee before payment.
            </div>
        </div>
    </section>
    @endif

    {{-- ── Bottom CTA ── --}}
    <section class="section" style="padding: 60px 0;">
        <div class="container">
            <div class="ws-cta-bottom" data-aos="fade-up">
                <h2>Ready to Join {{ $school->name }}?</h2>
                <p>Secure your child's spot today — limited seats available!</p>
                <a href="{{ route('workshops.register', $school) }}" class="btn-register-cta">
                    <i class="bi bi-pencil-square"></i> Register Now
                    @if($school->fees > 0)
                        — ₹{{ number_format($school->fees) }}/child
                    @else
                        — It's Free!
                    @endif
                </a>
            </div>
        </div>
    </section>

    {{-- ── Related Workshops ── --}}
    @if($relatedSchools->isNotEmpty())
        <section class="section light-background" style="padding: 60px 0;">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="ws-section-title d-inline-block">
                        More in {{ $school->city?->name }}
                    </h2>
                </div>
                <div class="row g-4">
                    @foreach($relatedSchools as $rel)
                        <div class="col-md-4" data-aos="fade-up">
                            <a href="{{ route('workshops.show', $rel) }}" class="related-card">
                                <div class="related-card-img">
                                    @if($rel->image_url)
                                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-building" style="font-size:3rem;color:var(--accent-color);opacity:0.3;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="related-card-body">
                                    <h5>{{ $rel->name }}</h5>
                                    <div class="d-flex flex-wrap gap-2 mt-2">
                                        @if($rel->timings)
                                            <span class="feature-pill" style="font-size:0.78rem;padding:4px 10px;">
                                                <i class="bi bi-clock"></i>{{ $rel->timings }}
                                            </span>
                                        @endif
                                        @if($rel->fees > 0)
                                            <span class="feature-pill" style="font-size:0.78rem;padding:4px 10px;">
                                                <i class="bi bi-currency-rupee"></i>₹{{ number_format($rel->fees) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</main>
@endsection
