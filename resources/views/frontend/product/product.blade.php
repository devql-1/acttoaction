@extends('frontend.course.layout')
@section('content')

<style>
    /* ========== MERCHANDISE PAGE ========== */
    .merch-wrap {
        background: #fafbfc;
        padding-bottom: 80px;
    }

    /* ---------- Hero ---------- */
    .merch-hero {
        position: relative;
        padding: 210px 20px 80px;
        background: linear-gradient(135deg, #0e1c38 0%, #1a3a6b 55%, #ff6a00 130%);
        color: #fff;
        text-align: center;
        overflow: hidden;
    }
    .merch-hero::before,
    .merch-hero::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        opacity: 0.15;
        pointer-events: none;
    }
    .merch-hero::before {
        width: 360px; height: 360px;
        background: #ff6a00;
        top: -120px; right: -80px;
    }
    .merch-hero::after {
        width: 280px; height: 280px;
        background: #fff;
        bottom: -120px; left: -60px;
    }
    .merch-hero .container {
        position: relative;
        z-index: 2;
        max-width: 780px;
    }
    .merch-hero .tagline {
        display: inline-block;
        background: rgba(255, 106, 0, 0.2);
        color: #ffd3b3;
        padding: 6px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 106, 0, 0.4);
    }
    .merch-hero h1 {
        font-size: 48px;
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 18px;
        letter-spacing: -0.5px;
    }
    .merch-hero h1 span {
        color: #ffb37e;
    }
    .merch-hero p {
        font-size: 17px;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.85);
        margin: 0 auto;
        max-width: 560px;
    }

    /* ---------- Grid ---------- */
    .merch-grid-section {
        padding: 60px 20px 20px;
    }
    .merch-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 28px;
        max-width: 1280px;
        margin: 0 auto;
    }
    .merch-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 22px rgba(14, 28, 56, 0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    .merch-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 38px rgba(14, 28, 56, 0.12);
    }
    .merch-card-thumb {
        position: relative;
        height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .merch-card-thumb i {
        font-size: 88px;
        color: #fff;
        filter: drop-shadow(0 4px 16px rgba(0, 0, 0, 0.2));
        transition: transform 0.35s ease;
    }
    .merch-card:hover .merch-card-thumb i {
        transform: scale(1.12) rotate(-6deg);
    }
    .thumb-orange { background: linear-gradient(135deg, #ff6a00 0%, #ff9a4d 100%); }
    .thumb-navy   { background: linear-gradient(135deg, #0e1c38 0%, #2d4a7a 100%); }
    .thumb-teal   { background: linear-gradient(135deg, #0f766e 0%, #2dd4bf 100%); }
    .thumb-rose   { background: linear-gradient(135deg, #be123c 0%, #fb7185 100%); }
    .thumb-amber  { background: linear-gradient(135deg, #b45309 0%, #fbbf24 100%); }
    .thumb-indigo { background: linear-gradient(135deg, #3730a3 0%, #818cf8 100%); }
    .thumb-emerald{ background: linear-gradient(135deg, #065f46 0%, #34d399 100%); }
    .thumb-plum   { background: linear-gradient(135deg, #581c87 0%, #c084fc 100%); }

    .merch-card-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: #fff;
        color: #0e1c38;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }
    .merch-card-badge.new    { background: #10b981; color: #fff; }
    .merch-card-badge.hot    { background: #ef4444; color: #fff; }
    .merch-card-badge.limited{ background: #fbbf24; color: #0e1c38; }

    .merch-card-body {
        padding: 22px 22px 26px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .merch-card-cat {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.4px;
        color: #ff6a00;
        text-transform: uppercase;
        margin-bottom: 6px;
    }
    .merch-card-title {
        font-size: 17px;
        font-weight: 700;
        color: #0e1c38;
        line-height: 1.3;
        margin: 0 0 8px;
    }
    .merch-card-desc {
        font-size: 13px;
        color: #5e6a80;
        line-height: 1.55;
        margin-bottom: 18px;
        flex: 1;
    }
    .merch-card-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .merch-card-price {
        font-size: 20px;
        font-weight: 800;
        color: #0e1c38;
    }
    .merch-card-price .old {
        font-size: 13px;
        color: #98a2b3;
        text-decoration: line-through;
        font-weight: 500;
        margin-left: 6px;
    }
    .merch-card-cta {
        background: #0e1c38;
        color: #fff;
        border: none;
        padding: 10px 18px;
        border-radius: 28px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.25s ease, transform 0.25s ease;
    }
    .merch-card-cta:hover {
        background: #ff6a00;
        transform: translateY(-2px);
    }

    /* ---------- CTA banner ---------- */
    .merch-cta {
        margin: 70px auto 0;
        max-width: 1280px;
        padding: 0 20px;
    }
    .merch-cta-inner {
        background: linear-gradient(135deg, #0e1c38 0%, #1a3a6b 100%);
        border-radius: 24px;
        padding: 50px 40px;
        color: #fff;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .merch-cta-inner::before {
        content: "";
        position: absolute;
        width: 400px; height: 400px;
        background: rgba(255, 106, 0, 0.18);
        border-radius: 50%;
        top: -200px; right: -150px;
    }
    .merch-cta-inner h2 {
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }
    .merch-cta-inner p {
        font-size: 15px;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 24px;
        max-width: 520px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        z-index: 2;
    }
    .merch-cta-btn {
        background: #ff6a00;
        color: #fff !important;
        border: none;
        padding: 13px 34px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
        position: relative;
        z-index: 2;
        box-shadow: 0 10px 28px rgba(255, 106, 0, 0.4);
    }
    .merch-cta-btn:hover {
        background: #e55c00;
        transform: translateY(-3px);
        box-shadow: 0 14px 32px rgba(255, 106, 0, 0.5);
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 1100px) {
        .merch-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .merch-hero { padding: 170px 20px 50px; }
        .merch-hero h1 { font-size: 34px; }
        .merch-hero p { font-size: 15px; }
        .merch-grid { grid-template-columns: repeat(2, 1fr); gap: 18px; }
        .merch-card-thumb { height: 180px; }
        .merch-card-thumb i { font-size: 64px; }
        .merch-card-body { padding: 18px; }
        .merch-card-title { font-size: 15px; }
        .merch-card-desc { font-size: 12.5px; }
        .merch-card-price { font-size: 17px; }
        .merch-card-cta { padding: 8px 14px; font-size: 12px; }
        .merch-cta-inner h2 { font-size: 24px; }
        .merch-cta-inner { padding: 38px 24px; }
    }
    @media (max-width: 480px) {
        .merch-grid { grid-template-columns: 1fr; }
    }
</style>

<main class="main merch-wrap">

    {{-- ============== HERO ============== --}}
    <section class="merch-hero">
        <div class="container">
            <span class="tagline">Official Merchandise</span>
            <h1>Gear Up With <span>Act&nbsp;To&nbsp;Action</span></h1>
            <p>Rep the community. Premium apparel, accessories, and essentials designed for young performers and changemakers.</p>
        </div>
    </section>

    {{-- ============== PRODUCT GRID ============== --}}
    <section class="merch-grid-section">
        <div class="merch-grid" id="merchGrid">

            <div class="merch-card" data-cat="apparel">
                <div class="merch-card-thumb thumb-orange">
                    <span class="merch-card-badge new">New</span>
                    <i class="bi bi-emoji-sunglasses-fill"></i>
                </div>
                <div class="merch-card-body">
                    <div class="merch-card-cat">Apparel</div>
                    <h3 class="merch-card-title">Classic Logo T-Shirt</h3>
                    <p class="merch-card-desc">100% premium cotton, pre-shrunk tee with embroidered logo on the chest.</p>
                    <div class="merch-card-foot">
                        <div class="merch-card-price">₹599 <span class="old">₹799</span></div>
                        <button class="merch-card-cta">Buy <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="merch-card" data-cat="apparel">
                <div class="merch-card-thumb thumb-navy">
                    <span class="merch-card-badge hot">Hot</span>
                    <i class="bi bi-heart-fill"></i>
                </div>
                <div class="merch-card-body">
                    <div class="merch-card-cat">Apparel</div>
                    <h3 class="merch-card-title">Signature Hoodie</h3>
                    <p class="merch-card-desc">Heavyweight fleece-lined hoodie with front pouch pocket and drawstring hood.</p>
                    <div class="merch-card-foot">
                        <div class="merch-card-price">₹1,299</div>
                        <button class="merch-card-cta">Buy <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="merch-card" data-cat="accessories">
                <div class="merch-card-thumb thumb-teal">
                    <i class="bi bi-award-fill"></i>
                </div>
                <div class="merch-card-body">
                    <div class="merch-card-cat">Accessories</div>
                    <h3 class="merch-card-title">Explorer Dad Cap</h3>
                    <p class="merch-card-desc">Adjustable cotton cap with embroidered monogram. One size fits most.</p>
                    <div class="merch-card-foot">
                        <div class="merch-card-price">₹449</div>
                        <button class="merch-card-cta">Buy <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="merch-card" data-cat="accessories">
                <div class="merch-card-thumb thumb-rose">
                    <i class="bi bi-droplet-fill"></i>
                </div>
                <div class="merch-card-body">
                    <div class="merch-card-cat">Accessories</div>
                    <h3 class="merch-card-title">Insulated Water Bottle</h3>
                    <p class="merch-card-desc">Double-wall stainless steel, 750ml capacity. Keeps drinks cold for 24 hrs.</p>
                    <div class="merch-card-foot">
                        <div class="merch-card-price">₹799 <span class="old">₹999</span></div>
                        <button class="merch-card-cta">Buy <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="merch-card" data-cat="stationery">
                <div class="merch-card-thumb thumb-amber">
                    <span class="merch-card-badge new">New</span>
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div class="merch-card-body">
                    <div class="merch-card-cat">Stationery</div>
                    <h3 class="merch-card-title">Premium Notebook</h3>
                    <p class="merch-card-desc">A5 hardcover notebook with 200 pages of dotted premium paper, ribbon marker.</p>
                    <div class="merch-card-foot">
                        <div class="merch-card-price">₹349</div>
                        <button class="merch-card-cta">Buy <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="merch-card" data-cat="accessories">
                <div class="merch-card-thumb thumb-indigo">
                    <i class="bi bi-bag-heart-fill"></i>
                </div>
                <div class="merch-card-body">
                    <div class="merch-card-cat">Accessories</div>
                    <h3 class="merch-card-title">Canvas Tote Bag</h3>
                    <p class="merch-card-desc">Heavy-duty 12oz canvas, reinforced straps. Perfect for daily carry.</p>
                    <div class="merch-card-foot">
                        <div class="merch-card-price">₹399</div>
                        <button class="merch-card-cta">Buy <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="merch-card" data-cat="stationery">
                <div class="merch-card-thumb thumb-emerald">
                    <i class="bi bi-stickies-fill"></i>
                </div>
                <div class="merch-card-body">
                    <div class="merch-card-cat">Stationery</div>
                    <h3 class="merch-card-title">Sticker Pack (12pcs)</h3>
                    <p class="merch-card-desc">Waterproof vinyl stickers. Stick them on laptops, bottles, notebooks — anywhere.</p>
                    <div class="merch-card-foot">
                        <div class="merch-card-price">₹149</div>
                        <button class="merch-card-cta">Buy <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="merch-card" data-cat="limited">
                <div class="merch-card-thumb thumb-plum">
                    <span class="merch-card-badge limited">Limited</span>
                    <i class="bi bi-cup-hot-fill"></i>
                </div>
                <div class="merch-card-body">
                    <div class="merch-card-cat">Limited Edition</div>
                    <h3 class="merch-card-title">Anniversary Ceramic Mug</h3>
                    <p class="merch-card-desc">Matte-finish 350ml ceramic mug, commemorative edition. Only 200 made.</p>
                    <div class="merch-card-foot">
                        <div class="merch-card-price">₹499</div>
                        <button class="merch-card-cta">Buy <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ============== CTA BANNER ============== --}}
    <section class="merch-cta">
        <div class="merch-cta-inner">
            <h2>Join the Act To Action Crew</h2>
            <p>Be the first to know about new drops, limited editions, and member-only discounts.</p>
            <a href="#!" class="merch-cta-btn">Notify Me</a>
        </div>
    </section>

</main>

@endsection
