{{-- resources/views/frontend/Summercamp/register.blade.php --}}
@extends('frontend.course.layout')
@section('title', 'Register – ' . $school->name . ' – Act To Action')

@section('content')


    <style>
/* ── Page wrapper ── */
.reg-page {
    min-height: 100vh;
    background: linear-gradient(135deg,
        color-mix(in srgb, var(--accent-color), transparent 96%) 0%,
        #f8faff 50%,
        color-mix(in srgb, var(--accent-color), transparent 94%) 100%);
    padding-top: 185px;
    padding-bottom: 80px;
}

/* ── Workshop summary banner ── */
.ws-summary-banner {
    background: linear-gradient(135deg, #0a1432 0%, #1a2e5c 100%);
    border-radius: 16px;
    padding: 28px 32px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
}
.ws-summary-banner::before {
    content: "";
    position: absolute;
    top: -40px; right: -40px;
    width: 180px; height: 180px;
    background: var(--accent-color);
    border-radius: 50%;
    opacity: 0.07;
}
.ws-banner-left h3 {
    font-weight: 700;
    font-size: 1.35rem;
    margin-bottom: 6px;
}
.ws-banner-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    margin-top: 6px;
}
.ws-banner-meta span {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 0.85rem;
    color: rgba(255,255,255,0.75);
}
.ws-banner-meta i { color: var(--accent-color); }
.ws-banner-fee {
    text-align: right;
    white-space: nowrap;
}
.ws-banner-fee .fee-label { font-size: 0.78rem; opacity: 0.65; letter-spacing: 0.5px; text-transform: uppercase; }
.ws-banner-fee .fee-value { font-size: 2rem; font-weight: 800; line-height: 1.1; }
.ws-banner-fee .fee-sub { font-size: 0.8rem; opacity: 0.65; }

/* ── Steps ── */
.reg-steps {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    margin-bottom: 36px;
}
.reg-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    flex: 1;
    max-width: 160px;
    position: relative;
}
.reg-step:not(:last-child)::after {
    content: "";
    position: absolute;
    top: 22px;
    left: calc(50% + 22px);
    width: calc(100% - 44px);
    height: 2px;
    background: color-mix(in srgb, var(--accent-color), transparent 80%);
}
.reg-step-circle {
    width: 44px; height: 44px;
    border-radius: 50%;
    background: color-mix(in srgb, var(--accent-color), transparent 88%);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    color: var(--accent-color);
    transition: all 0.4s;
    position: relative; z-index: 1;
}
.reg-step-circle.active {
    background: var(--accent-color);
    color: #fff;
    box-shadow: 0 4px 14px color-mix(in srgb, var(--accent-color), transparent 55%);
}
.reg-step-label { font-size: 0.78rem; font-weight: 600; color: #9ca3af; text-align: center; }
.reg-step-label.active { color: var(--heading-color); }

/* ── Card wrapper ── */
.reg-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 48px rgba(0,0,0,0.08);
    padding: 48px;
    margin-bottom: 24px;
}
@media(max-width:576px) { .reg-card { padding: 24px 20px; } }

.section-divider {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--heading-color);
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid color-mix(in srgb, var(--default-color), transparent 92%);
    display: flex;
    align-items: center;
    gap: 10px;
}
.section-divider i { color: var(--accent-color); font-size: 1.15rem; }

/* ── Form inputs ── */
.reg-input {
    padding: 13px 16px;
    border-radius: 10px;
    border: 1.5px solid color-mix(in srgb, var(--default-color), transparent 82%);
    font-size: 0.95rem;
    transition: border-color 0.2s, box-shadow 0.2s;
    width: 100%;
    background: #fff;
}
.reg-input:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent-color), transparent 85%);
}
.reg-input.is-invalid { border-color: #dc2626 !important; }
.reg-input.is-valid   { border-color: #16a34a !important; }
.reg-input[readonly]  { background: color-mix(in srgb, var(--accent-color), transparent 96%); cursor: default; }

/* ── Field errors ── */
.field-error { display: none; color: #dc2626; font-size: 0.8rem; margin-top: 4px; }
.field-error.show { display: block; }

/* ── Child cards ── */
.child-card {
    background: color-mix(in srgb, var(--accent-color), transparent 96%);
    border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 82%);
    border-radius: 14px;
    padding: 22px;
    margin-bottom: 16px;
}
.child-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    font-weight: 700;
    color: var(--heading-color);
    font-size: 0.95rem;
}
.btn-remove-child {
    background: #fee2e2; color: #dc2626;
    border: none; border-radius: 8px;
    padding: 4px 12px; font-size: 0.8rem;
    cursor: pointer; transition: all 0.2s;
}
.btn-remove-child:hover { background: #dc2626; color: #fff; }
.btn-add-child {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 12px 16px; margin-top: 8px;
    background: transparent;
    border: 2px dashed color-mix(in srgb, var(--accent-color), transparent 45%);
    border-radius: 10px;
    color: var(--accent-color);
    font-size: 0.95rem; font-weight: 600;
    cursor: pointer;
    transition: background 0.25s, border-style 0.25s, box-shadow 0.25s;
    -webkit-appearance: none; appearance: none;
}
.btn-add-child:hover {
    background: color-mix(in srgb, var(--accent-color), transparent 92%);
    border-style: solid;
    box-shadow: 0 2px 8px color-mix(in srgb, var(--accent-color), transparent 78%);
}

/* ── Merchandise cards ── */
.merch-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px;
}
.merch-card {
    border: 2px solid color-mix(in srgb, var(--default-color), transparent 88%);
    border-radius: 14px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
    user-select: none;
    position: relative;
    background: #fff;
}
.merch-card:hover {
    border-color: color-mix(in srgb, var(--accent-color), transparent 55%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
.merch-card.selected {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent-color), transparent 82%);
}
.merch-check-badge {
    position: absolute;
    top: 10px; right: 10px;
    width: 26px; height: 26px;
    border-radius: 50%;
    background: var(--accent-color);
    color: #fff;
    display: none;
    align-items: center; justify-content: center;
    font-size: 0.85rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    z-index: 2;
}
.merch-card.selected .merch-check-badge { display: flex; }
.merch-img {
    width: 100%;
    height: 130px;
    object-fit: cover;
    background: color-mix(in srgb, var(--accent-color), transparent 92%);
    display: block;
}
.merch-img-placeholder {
    width: 100%; height: 130px;
    background: color-mix(in srgb, var(--accent-color), transparent 92%);
    display: flex; align-items: center; justify-content: center;
}
.merch-img-placeholder i { font-size: 2.5rem; color: var(--accent-color); opacity: 0.4; }
.merch-body { padding: 14px; }
.merch-name { font-weight: 700; font-size: 0.92rem; color: var(--heading-color); margin-bottom: 4px; }
.merch-desc { font-size: 0.78rem; color: #9ca3af; margin-bottom: 10px; line-height: 1.4; }
.merch-price { font-size: 1.05rem; font-weight: 800; color: var(--accent-color); }
.merch-qty-row {
    display: none;
    align-items: center;
    justify-content: space-between;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
}
.merch-card.selected .merch-qty-row { display: flex; }
.qty-btn {
    width: 28px; height: 28px;
    border-radius: 50%;
    border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 50%);
    background: transparent;
    color: var(--accent-color);
    font-size: 1rem; font-weight: 700;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    transition: all 0.2s;
    line-height: 1;
}
.qty-btn:hover { background: var(--accent-color); color: #fff; border-color: var(--accent-color); }
.qty-value { font-weight: 700; font-size: 1rem; color: var(--heading-color); min-width: 20px; text-align: center; }

/* ── No merchandise notice ── */
.no-merch-notice {
    text-align: center;
    padding: 32px 20px;
    color: #9ca3af;
    background: color-mix(in srgb, var(--default-color), transparent 97%);
    border-radius: 12px;
    border: 2px dashed color-mix(in srgb, var(--default-color), transparent 85%);
}
.no-merch-notice i { font-size: 2rem; display: block; margin-bottom: 8px; }

/* ── Order summary ── */
.order-summary {
    background: #fff;
    border-radius: 16px;
    border: 1.5px solid color-mix(in srgb, var(--default-color), transparent 88%);
    overflow: hidden;
    position: sticky;
    top: 80px;
}
.order-summary-header {
    background: linear-gradient(135deg, var(--accent-color), color-mix(in srgb, var(--accent-color), #000 15%));
    padding: 18px 22px;
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    display: flex; align-items: center; gap: 8px;
}
.order-summary-body { padding: 20px 22px; }
.order-line {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    font-size: 0.9rem;
    border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 93%);
}
.order-line:last-of-type { border-bottom: none; }
.order-line .key { color: #6b7280; }
.order-line .val { font-weight: 600; color: var(--heading-color); }
.order-total-line {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0 0;
    border-top: 2px solid color-mix(in srgb, var(--default-color), transparent 88%);
    margin-top: 8px;
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--heading-color);
}
.order-total-line .total-amt { color: var(--accent-color); font-size: 1.35rem; }

/* ── Merch summary items ── */
#summaryMerchList { margin-top: 4px; }
.merch-summary-item {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
    padding: 3px 0;
}
.merch-summary-item .key { color: #9ca3af; }
.merch-summary-item .val { color: var(--heading-color); font-weight: 500; }

/* ── Terms ── */
.terms-block { padding: 18px 0 0; }

/* ── Submit ── */
.btn-submit {
    display: inline-flex; align-items: center; justify-content: center; gap: 10px;
    width: 100%;
    padding: 16px 24px;
    border-radius: 50px;
    background: var(--accent-color);
    color: #fff;
    font-size: 1.1rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 6px 22px color-mix(in srgb, var(--accent-color), transparent 60%);
    letter-spacing: 0.2px;
}
.btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 30px color-mix(in srgb, var(--accent-color), transparent 50%); }
.btn-submit:disabled { opacity: 0.65; cursor: not-allowed; transform: none; }

/* ── Banners ── */
#regError {
    display: none;
    background: #fee2e2; color: #b91c1c;
    padding: 14px 18px; border-radius: 10px;
    margin-bottom: 16px; font-size: 0.925rem;
    border-left: 4px solid #dc2626;
}
#regLoading {
    display: none;
    text-align: center;
    color: var(--accent-color);
    margin-bottom: 16px;
    font-size: 0.95rem;
}
#paymentFailedBanner {
    display: none;
    background: #fee2e2;
    border: 1px solid #fca5a5;
    border-left: 4px solid #dc2626;
    border-radius: 10px;
    padding: 14px 18px;
    margin-bottom: 16px;
    font-size: 0.925rem;
    color: #b91c1c;
}
#paymentFailedBanner.show { display: flex; align-items: flex-start; gap: 10px; }

/* ── Confirmation overlay ── */
#confirmationOverlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 9999;
    align-items: center; justify-content: center;
}
#confirmationOverlay.show { display: flex; }
.confirmation-box {
    background: #fff; border-radius: 20px;
    padding: 48px 40px; max-width: 480px; width: 90%;
    text-align: center;
    box-shadow: 0 25px 60px rgba(0,0,0,0.3);
    animation: popIn 0.4s cubic-bezier(0.34,1.56,0.64,1) both;
}
#confirmationOverlay.show .confirmation-box { animation: popIn 0.4s cubic-bezier(0.34,1.56,0.64,1) both; }
@keyframes popIn {
    from { transform: scale(0.8); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}
.confirmation-icon {
    width: 80px; height: 80px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
}
.confirmation-icon.success { background: #dcfce7; }
.confirmation-icon.failure { background: #fee2e2; }
.confirmation-box h3 { font-size: 1.5rem; font-weight: 700; color: var(--heading-color); margin-bottom: 8px; }
.confirmation-box p { color: #6b7280; margin-bottom: 6px; font-size: 0.95rem; }
.confirmation-detail {
    background: #f9fafb; border-radius: 10px;
    padding: 16px; margin: 16px 0; text-align: left;
}
.confirmation-detail .cd-row {
    display: flex; justify-content: space-between;
    padding: 4px 0; font-size: 0.9rem;
}
.confirmation-detail .key { color: #6b7280; }
.confirmation-detail .val { font-weight: 600; color: var(--heading-color); }
.btn-confirm-close {
    border: none; padding: 14px 36px;
    border-radius: 50px; font-size: 1rem; font-weight: 600;
    cursor: pointer; margin-top: 8px; width: 100%;
    transition: all 0.3s; color: white;
}
.btn-confirm-close.success { background: var(--accent-color); }
.btn-confirm-close.failure { background: #dc2626; }
.btn-confirm-close:hover { opacity: 0.9; transform: translateY(-2px); }
    </style>
<main class="main">
<div class="reg-page">
<div class="container">

    {{-- ── Breadcrumb ── --}}
    <nav aria-label="breadcrumb" style="margin-bottom: 24px;">
        <ol class="breadcrumb" style="background:none;padding:0;margin:0;">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:var(--accent-color);text-decoration:none;">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('workshops') }}" style="color:var(--accent-color);text-decoration:none;">Workshops</a></li>
            <li class="breadcrumb-item"><a href="{{ route('workshops.show', $school) }}" style="color:var(--accent-color);text-decoration:none;">{{ $school->name }}</a></li>
            <li class="breadcrumb-item active">Register</li>
        </ol>
    </nav>

    {{-- ── Workshop summary banner ── --}}
    <div class="ws-summary-banner" data-aos="fade-up">
        <div class="ws-banner-left">
            <h3>{{ $school->name }}</h3>
            <div class="ws-banner-meta">
                @if($school->city)
                    <span><i class="bi bi-geo-alt-fill"></i>{{ $school->city->name }}</span>
                @endif
                @if($school->timings)
                    <span><i class="bi bi-calendar-week"></i>{{ $school->timings }}</span>
                @endif
                @if($school->ageGroup)
                    <span><i class="bi bi-people-fill"></i>{{ $school->ageGroup->name }}</span>
                @endif
            </div>
        </div>
        <div class="ws-banner-fee">
            <div class="fee-label">Workshop Fee</div>
            @if($school->fees > 0)
                <div class="fee-value">₹{{ number_format($school->fees) }}</div>
                <div class="fee-sub">per child</div>
            @else
                <div class="fee-value" style="color:#86efac;">Free</div>
            @endif
        </div>
    </div>

    {{-- ── Progress steps ── --}}
    <div class="reg-steps" data-aos="fade-up">
        <div class="reg-step">
            <div class="reg-step-circle active"><i class="bi bi-person-fill"></i></div>
            <div class="reg-step-label active">Your Details</div>
        </div>
        <div class="reg-step">
            <div class="reg-step-circle" id="step2Icon"><i class="bi bi-check-circle-fill"></i></div>
            <div class="reg-step-label" id="step2Label">Confirmation</div>
        </div>
        <div class="reg-step">
            <div class="reg-step-circle" id="step3Icon"><i class="bi bi-credit-card-fill"></i></div>
            <div class="reg-step-label" id="step3Label">Payment</div>
        </div>
    </div>

    <div class="row g-4 align-items-start">

        {{-- ── Left: form ── --}}
        <div class="col-lg-8" data-aos="fade-up">
            <form id="workshopRegForm" novalidate autocomplete="off">
                @csrf

                {{-- ── Parent info ── --}}
                <div class="reg-card">
                    <div class="section-divider"><i class="bi bi-person"></i> Parent / Guardian Information</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" id="f_parent_name" name="parent_name"
                                class="reg-input form-control" placeholder="Parent / Guardian Name *">
                            <div class="field-error" id="err_parent_name">Please enter parent/guardian name.</div>
                        </div>
                        <div class="col-md-6">
                            <input type="email" id="f_email" name="email"
                                class="reg-input form-control" placeholder="Email Address *">
                            <div class="field-error" id="err_email">Please enter a valid email address.</div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text" style="font-weight:600;font-size:14px;">+91</span>
                                <input type="tel" id="f_phone" name="phone"
                                    class="reg-input form-control" placeholder="10-digit number" maxlength="10" inputmode="numeric">
                            </div>
                            <div class="field-error" id="err_phone">Please enter a valid 10-digit phone number.</div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text" style="font-weight:600;font-size:14px;">+91</span>
                                <input type="tel" id="f_whatsapp" name="whatsapp"
                                    class="reg-input form-control" placeholder="10-digit number (optional)" maxlength="10" inputmode="numeric">
                            </div>
                            <div class="field-error" id="err_whatsapp">Please enter a valid WhatsApp number.</div>
                        </div>
                    </div>
                </div>

                {{-- ── Children ── --}}
                <div class="reg-card">
                    <div class="section-divider">
                        <i class="bi bi-mortarboard"></i> Student Information
                        <small style="font-size:0.78rem;font-weight:400;color:#9ca3af;margin-left:4px;">Up to 5 children</small>
                    </div>
                    <div id="childrenContainer"></div>
                    <button type="button" class="btn-add-child" id="btnAddChild">
                        <i class="bi bi-plus-circle"></i>
                        <span>Add Another Child</span>
                    </button>
                </div>

                {{-- ── Merchandise ── --}}
                <div class="reg-card">
                    <div class="section-divider"><i class="bi bi-bag-heart-fill"></i> Merchandise <small style="font-size:0.78rem;font-weight:400;color:#9ca3af;margin-left:4px;">Optional — add to your order</small></div>

                    @if($merchandises->isNotEmpty())
                        <div class="merch-grid" id="merchGrid">
                            @foreach($merchandises as $item)
                                <div class="merch-card"
                                     data-id="{{ $item->id }}"
                                     data-name="{{ $item->name }}"
                                     data-price="{{ (float) $item->price }}"
                                     onclick="toggleMerch(this)">
                                    <div class="merch-check-badge"><i class="bi bi-check"></i></div>
                                    @if($item->image_url)
                                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="merch-img">
                                    @else
                                        <div class="merch-img-placeholder">
                                            <i class="bi bi-bag"></i>
                                        </div>
                                    @endif
                                    <div class="merch-body">
                                        <div class="merch-name">{{ $item->name }}</div>
                                        @if($item->description)
                                            <div class="merch-desc">{{ Str::limit($item->description, 60) }}</div>
                                        @endif
                                        <div class="merch-price">₹{{ number_format($item->price, 0) }}</div>
                                        <div class="merch-qty-row" onclick="event.stopPropagation()">
                                            <button type="button" class="qty-btn btn-qty-minus" onclick="changeQty(this, -1)">−</button>
                                            <span class="qty-value">1</span>
                                            <button type="button" class="qty-btn btn-qty-plus" onclick="changeQty(this, 1)">+</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p style="font-size:0.82rem;color:#9ca3af;margin-top:12px;margin-bottom:0;">
                            <i class="bi bi-info-circle me-1"></i>Tap a product to select it. Adjust quantity using the +/− buttons.
                        </p>
                    @else
                        <div class="no-merch-notice">
                            <i class="bi bi-bag-x"></i>
                            No merchandise available at this time. Check back soon!
                        </div>
                    @endif

                    {{-- Hidden inputs populated by JS before submit ── --}}
                    <div id="merchHiddenInputs"></div>
                </div>

                {{-- ── Workshop info (readonly) ── --}}
                <div class="reg-card">
                    <div class="section-divider"><i class="bi bi-calendar-event"></i> Workshop Details</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="reg-input form-control" value="{{ $school->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="reg-input form-control" value="{{ $school->city?->name ?? '' }}" readonly>
                        </div>
                        <div class="col-12">
                            <textarea name="message" class="reg-input form-control" rows="3"
                                placeholder="Any special requirements or questions? (Optional)"
                                style="resize:vertical;"></textarea>
                        </div>
                    </div>
                </div>

                {{-- ── Terms + submit ── --}}
                <div class="reg-card">
                    {{-- Payment failure banner ── --}}
                    <div id="paymentFailedBanner">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div id="paymentFailedMsg"></div>
                    </div>

                    {{-- Generic error ── --}}
                    <div id="regError"></div>

                    {{-- Loading ── --}}
                    <div id="regLoading">
                        <span class="spinner-border spinner-border-sm me-2"></span>Processing your registration…
                    </div>

                    <div class="terms-block mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="termsCheck">
                            <label class="form-check-label" for="termsCheck" style="font-size:0.93rem;">
                                I agree to the
                                <a href="#" style="color:var(--accent-color);text-decoration:none;">terms and conditions</a>
                                and understand the refund policy.
                            </label>
                        </div>
                        <div class="field-error" id="err_terms">You must agree to the terms and conditions.</div>
                    </div>

                    <button type="submit" id="regSubmitBtn" class="btn-submit">
                        @if($school->fees > 0)
                            <i class="bi bi-lock-fill"></i> Proceed to Payment
                        @else
                            <i class="bi bi-check-circle-fill"></i> Submit Registration
                        @endif
                    </button>

                    <p style="text-align:center;font-size:0.82rem;color:#9ca3af;margin-top:14px;margin-bottom:0;">
                        <i class="bi bi-shield-check me-1" style="color:var(--accent-color);"></i>
                        Your information is secure and will never be shared.
                    </p>
                </div>
            </form>
        </div>

        {{-- ── Right: order summary ── --}}
        <div class="col-lg-4 d-none d-lg-block" data-aos="fade-up" data-aos-delay="100">
            <div class="order-summary">
                <div class="order-summary-header">
                    <i class="bi bi-receipt"></i> Order Summary
                </div>
                <div class="order-summary-body">
                    <div class="order-line">
                        <span class="key">Workshop</span>
                        <span class="val" style="font-size:0.82rem;max-width:150px;text-align:right;">{{ $school->name }}</span>
                    </div>
                    <div class="order-line">
                        <span class="key">Children</span>
                        <span class="val" id="summaryChildCount">1</span>
                    </div>
                    <div class="order-line">
                        <span class="key">Fee/child</span>
                        <span class="val">
                            @if($school->fees > 0)
                                ₹{{ number_format($school->fees) }}
                            @else
                                Free
                            @endif
                        </span>
                    </div>
                    <div class="order-line">
                        <span class="key">Workshop total</span>
                        <span class="val" id="summaryWorkshopTotal">
                            @if($school->fees > 0)
                                ₹{{ number_format($school->fees) }}
                            @else
                                ₹0
                            @endif
                        </span>
                    </div>

                    {{-- Merchandise lines ── --}}
                    <div id="summaryMerchSection" style="display:none;">
                        <div style="font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#9ca3af;margin:10px 0 4px;">Merchandise</div>
                        <div id="summaryMerchList"></div>
                        <div class="order-line">
                            <span class="key">Merch subtotal</span>
                            <span class="val" id="summaryMerchTotal">₹0</span>
                        </div>
                    </div>

                    <div class="order-total-line">
                        <span>Total</span>
                        <span class="total-amt" id="summaryGrandTotal">
                            @if($school->fees > 0)
                                ₹{{ number_format($school->fees) }}
                            @else
                                ₹0
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div style="background:color-mix(in srgb,var(--accent-color),transparent 95%);border-radius:14px;padding:20px;margin-top:16px;text-align:center;">
                <i class="bi bi-info-circle-fill" style="color:var(--accent-color);font-size:1.2rem;margin-bottom:8px;display:block;"></i>
                <p style="margin:0;font-size:0.88rem;line-height:1.6;">
                    Need help? Call <strong style="color:var(--accent-color);">+91 90241 64323</strong><br>
                    <span style="font-size:0.8rem;color:#9ca3af;">Mon–Sat: 11 AM – 7 PM</span>
                </p>
            </div>
        </div>

    </div>{{-- /row --}}
</div>{{-- /container --}}
</div>{{-- /reg-page --}}

{{-- ── Confirmation/Failure Overlay ── --}}
<div id="confirmationOverlay" role="dialog" aria-modal="true" aria-labelledby="confTitle">
    <div class="confirmation-box">
        <div class="confirmation-icon success" id="confIconWrap"></div>
        <h3 id="confTitle">Registration Confirmed!</h3>
        <p id="confSubtitle">Your spot has been secured.</p>
        <div class="confirmation-detail" id="confDetail"></div>
        <p id="confFooter" style="font-size:0.85rem;color:#9ca3af;margin-top:12px;">
            A confirmation email has been sent. For queries call <strong>+91 90241 64323</strong>.
        </p>
        <button class="btn-confirm-close success" id="confCloseBtn" onclick="closeConfirmation()">Done</button>
    </div>
</div>

</main>

{{-- ── Scripts ── --}}
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var WS_SUBMIT_URL  = '{{ route('frontend.summercamp.register.submit', $school) }}';
var WS_VERIFY_URL  = '{{ route('frontend.summercamp.register.verify', ['registration' => '__ID__']) }}';
var WS_RZP_KEY     = '{{ config('services.razorpay.key') }}';
var WS_FEE         = {{ (float) $school->fees }};
var WS_IS_FREE     = {{ $school->fees == 0 ? 'true' : 'false' }};
var WS_CSRF        = '{{ csrf_token() }}';
var WS_WORKSHOP    = '{{ addslashes($school->name) }}';
var WS_CITY        = '{{ addslashes($school->city?->name ?? '') }}';
var WS_AGEGROUP    = '{{ addslashes($school->ageGroup?->name ?? '') }}';
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── DOM refs ── */
    var form      = document.getElementById('workshopRegForm');
    var submitBtn = document.getElementById('regSubmitBtn');
    var loadingEl = document.getElementById('regLoading');
    var errorEl   = document.getElementById('regError');
    var childCount = 0;

    /* ─────────────────────────────────────────────
       MERCHANDISE STATE
    ───────────────────────────────────────────── */
    // { id: { name, price, qty } }
    var selectedMerch = {};

    function toggleMerch(card) {
        var id    = card.dataset.id;
        var name  = card.dataset.name;
        var price = parseFloat(card.dataset.price);

        if (card.classList.contains('selected')) {
            card.classList.remove('selected');
            delete selectedMerch[id];
        } else {
            card.classList.add('selected');
            selectedMerch[id] = { name: name, price: price, qty: 1 };
            card.querySelector('.qty-value').textContent = '1';
        }
        updateTotal();
    }
    window.toggleMerch = toggleMerch;

    function changeQty(btn, delta) {
        var card  = btn.closest('.merch-card');
        var id    = card.dataset.id;
        var qtyEl = card.querySelector('.qty-value');
        var qty   = parseInt(qtyEl.textContent) + delta;
        if (qty < 1) qty = 1;
        if (qty > 10) qty = 10;
        qtyEl.textContent = qty;
        if (selectedMerch[id]) selectedMerch[id].qty = qty;
        updateTotal();
    }
    window.changeQty = changeQty;

    function getMerchTotal() {
        return Object.values(selectedMerch).reduce(function (sum, m) {
            return sum + m.price * m.qty;
        }, 0);
    }

    /* ─────────────────────────────────────────────
       CHILD CARDS
    ───────────────────────────────────────────── */
    function buildChildCard(idx, num) {
        var card = document.createElement('div');
        card.className = 'child-card';
        card.id = 'child_' + idx;

        var removeBtn = idx > 0
            ? '<button type="button" class="btn-remove-child" data-idx="' + idx + '">✕ Remove</button>'
            : '';

        card.innerHTML =
            '<div class="child-card-header">' +
            '<span><i class="bi bi-person-badge me-2" style="color:var(--accent-color);"></i>Child ' + num + '</span>' +
            removeBtn +
            '</div>' +
            '<div class="row g-3">' +
              '<div class="col-md-6">' +
                '<input type="text" name="children[' + idx + '][student_name]" ' +
                  'class="reg-input form-control child-student-name" placeholder="Student Name *">' +
                '<div class="field-error child-err-name">Please enter the student\'s name.</div>' +
              '</div>' +
              '<div class="col-md-6">' +
                '<input type="date" name="children[' + idx + '][dob]" class="reg-input form-control" ' +
                  'style="color-scheme:light;">' +
              '</div>' +
              '<div class="col-md-6">' +
                '<input type="text" class="reg-input form-control" value="' + escapeHtml(WS_AGEGROUP) + '" readonly>' +
              '</div>' +
              '<div class="col-md-6">' +
                '<input type="text" name="children[' + idx + '][school_name]" ' +
                  'class="reg-input form-control" placeholder="School Name (optional)">' +
              '</div>' +
              '<div class="col-12">' +
                '<select name="children[' + idx + '][experience]" class="reg-input form-select">' +
                  '<option value="">Previous Acting Experience (optional)</option>' +
                  '<option value="none">No prior experience</option>' +
                  '<option value="beginner">Beginner (less than 1 year)</option>' +
                  '<option value="intermediate">Intermediate (1–2 years)</option>' +
                  '<option value="advanced">Advanced (2+ years)</option>' +
                '</select>' +
              '</div>' +
            '</div>';

        return card;
    }

    function escapeHtml(str) {
        var d = document.createElement('div');
        d.appendChild(document.createTextNode(str));
        return d.innerHTML;
    }

    function addChild() {
        if (childCount >= 5) return;
        var idx = childCount;
        childCount++;
        var card = buildChildCard(idx, childCount);
        document.getElementById('childrenContainer').appendChild(card);
        document.getElementById('btnAddChild').style.display = childCount >= 5 ? 'none' : 'flex';
        updateTotal();
    }

    document.getElementById('childrenContainer').addEventListener('click', function (e) {
        var btn = e.target.closest('.btn-remove-child');
        if (!btn) return;
        btn.closest('.child-card').remove();
        childCount--;

        document.querySelectorAll('.child-card').forEach(function (c, i) {
            c.id = 'child_' + i;
            c.querySelector('.child-card-header span').innerHTML =
                '<i class="bi bi-person-badge me-2" style="color:var(--accent-color);"></i>Child ' + (i + 1);
            c.querySelectorAll('input[name], select[name]').forEach(function (el) {
                el.name = el.name.replace(/children\[\d+\]/, 'children[' + i + ']');
            });
            if (i === 0) {
                var rb = c.querySelector('.btn-remove-child');
                if (rb) rb.remove();
            }
        });
        childCount = document.querySelectorAll('.child-card').length;
        document.getElementById('btnAddChild').style.display = childCount >= 5 ? 'none' : 'flex';
        updateTotal();
    });

    document.getElementById('btnAddChild').addEventListener('click', addChild);
    addChild(); // first child on load

    /* ─────────────────────────────────────────────
       TOTAL CALCULATION
    ───────────────────────────────────────────── */
    function fmtINR(n) {
        return n.toLocaleString('en-IN', { maximumFractionDigits: 0 });
    }

    function updateTotal() {
        var workshopTotal = WS_FEE * childCount;
        var merchTotal    = getMerchTotal();
        var grand         = workshopTotal + merchTotal;

        /* Order summary sidebar */
        var el = document.getElementById('summaryChildCount');
        if (el) el.textContent = childCount;
        el = document.getElementById('summaryWorkshopTotal');
        if (el) el.textContent = '₹' + fmtINR(workshopTotal);
        el = document.getElementById('summaryGrandTotal');
        if (el) el.textContent = '₹' + fmtINR(grand);

        /* Merchandise section */
        var merchSection = document.getElementById('summaryMerchSection');
        var merchList    = document.getElementById('summaryMerchList');
        var merchTotalEl = document.getElementById('summaryMerchTotal');
        if (merchSection && merchList && merchTotalEl) {
            var keys = Object.keys(selectedMerch);
            if (keys.length > 0) {
                merchSection.style.display = '';
                var html = '';
                keys.forEach(function (id) {
                    var m = selectedMerch[id];
                    html += '<div class="merch-summary-item"><span class="key">' +
                        escapeHtml(m.name) + ' × ' + m.qty +
                        '</span><span class="val">₹' + fmtINR(m.price * m.qty) + '</span></div>';
                });
                merchList.innerHTML = html;
                merchTotalEl.textContent = '₹' + fmtINR(merchTotal);
            } else {
                merchSection.style.display = 'none';
                merchList.innerHTML = '';
            }
        }
    }

    /* ─────────────────────────────────────────────
       VALIDATION
    ───────────────────────────────────────────── */
    var parentRules = {
        parent_name: { el: 'f_parent_name', err: 'err_parent_name', test: function (v) { return v.trim().length >= 2; } },
        email:       { el: 'f_email',       err: 'err_email',       test: function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()); } },
        phone:       { el: 'f_phone',       err: 'err_phone',       test: function (v) { return v.replace(/\D/g, '').length === 10; } },
        whatsapp:    { el: 'f_whatsapp',    err: 'err_whatsapp',    test: function (v) { return v === '' || v.replace(/\D/g, '').length === 10; } },
    };

    function validateParent() {
        var ok = true;
        Object.keys(parentRules).forEach(function (name) {
            var rule  = parentRules[name];
            var input = document.getElementById(rule.el);
            var errEl = document.getElementById(rule.err);
            var valid = rule.test(input ? input.value : '');
            if (input) { input.classList.toggle('is-invalid', !valid); input.classList.toggle('is-valid', valid); }
            if (errEl)   errEl.classList.toggle('show', !valid);
            if (!valid)  ok = false;
        });
        return ok;
    }

    function validateChildren() {
        var ok = true;
        document.querySelectorAll('.child-card').forEach(function (card) {
            var nameInput = card.querySelector('.child-student-name');
            var errEl     = card.querySelector('.child-err-name');
            var valid     = nameInput && nameInput.value.trim().length >= 2;
            if (nameInput) { nameInput.classList.toggle('is-invalid', !valid); nameInput.classList.toggle('is-valid', valid); }
            if (errEl)       errEl.classList.toggle('show', !valid);
            if (!valid)      ok = false;
        });
        return ok;
    }

    Object.keys(parentRules).forEach(function (name) {
        var input = document.getElementById(parentRules[name].el);
        if (!input) return;
        input.addEventListener('blur',  function () { validateParent(); });
        input.addEventListener('input', function () { if (input.classList.contains('is-invalid')) validateParent(); });
    });

    // Restrict phone/whatsapp inputs to digits only
    ['f_phone', 'f_whatsapp'].forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
    });

    /* ─────────────────────────────────────────────
       UI HELPERS
    ───────────────────────────────────────────── */
    function setLoading(yes) {
        submitBtn.disabled        = yes;
        loadingEl.style.display   = yes ? 'block' : 'none';
        submitBtn.style.opacity   = yes ? '0.7' : '1';
        submitBtn.style.cursor    = yes ? 'not-allowed' : 'pointer';
    }
    function showError(msg) {
        var safe = (typeof msg === 'string' && msg.length < 400) ? msg : 'Something went wrong. Please try again or call +91 90241 64323.';
        errorEl.innerHTML = '<i class="bi bi-exclamation-circle-fill me-2"></i>' + safe;
        errorEl.style.display = 'block';
        errorEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    function showPaymentFailed(msg) {
        var safe = (typeof msg === 'string' && msg.length < 400) ? msg : 'Payment failed. Please try again or call +91 90241 64323.';
        var banner = document.getElementById('paymentFailedBanner');
        document.getElementById('paymentFailedMsg').innerHTML = safe;
        banner.classList.add('show');
        banner.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    function clearPaymentFailed() {
        var banner = document.getElementById('paymentFailedBanner');
        banner.classList.remove('show');
        document.getElementById('paymentFailedMsg').innerHTML = '';
    }
    function activateStep(n) {
        var circle = document.getElementById('step' + n + 'Icon');
        var label  = document.getElementById('step' + n + 'Label');
        if (circle) { circle.classList.add('active'); }
        if (label)  { label.classList.add('active'); }
    }
    function clearValidation() {
        form.querySelectorAll('.is-valid,.is-invalid').forEach(function (el) { el.classList.remove('is-valid', 'is-invalid'); });
        form.querySelectorAll('.field-error.show').forEach(function (el) { el.classList.remove('show'); });
    }
    function handleServerErrors(errors) {
        var first = null;
        Object.keys(errors).forEach(function (field) {
            var errEl = document.getElementById('err_' + field);
            var input = document.getElementById('f_' + field);
            if (errEl) { errEl.textContent = errors[field][0]; errEl.classList.add('show'); }
            if (input) { input.classList.add('is-invalid'); if (!first) first = input; }
        });
        if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    /* ─────────────────────────────────────────────
       CONFIRMATION OVERLAY
    ───────────────────────────────────────────── */
    var SUCCESS_SVG = '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>';
    var FAILURE_SVG = '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';

    function showConfirmation(parentName, email, childNames, workshopName, isPaid, grandTotal) {
        var overlay  = document.getElementById('confirmationOverlay');
        var iconWrap = document.getElementById('confIconWrap');
        var closeBtn = document.getElementById('confCloseBtn');
        iconWrap.className = 'confirmation-icon success';
        iconWrap.innerHTML = SUCCESS_SVG;
        closeBtn.className = 'btn-confirm-close success';

        document.getElementById('confTitle').textContent    = isPaid ? 'Payment Successful! 🎉' : 'Registration Confirmed! 🎉';
        document.getElementById('confSubtitle').textContent = childNames.length > 1
            ? childNames.length + ' children have been registered.'
            : 'Your child\'s spot has been secured.';
        document.getElementById('confFooter').style.display = '';

        var detail = '';
        detail += '<div class="cd-row"><span class="key">Parent</span><span class="val">'   + escapeHtml(parentName)   + '</span></div>';
        detail += '<div class="cd-row"><span class="key">Email</span><span class="val">'    + escapeHtml(email)        + '</span></div>';
        detail += '<div class="cd-row"><span class="key">Workshop</span><span class="val">' + escapeHtml(workshopName) + '</span></div>';
        childNames.forEach(function (name, i) {
            detail += '<div class="cd-row"><span class="key">Child ' + (i + 1) + '</span><span class="val">' + escapeHtml(name) + '</span></div>';
        });
        if (grandTotal > 0) {
            detail += '<div class="cd-row"><span class="key">Amount Paid</span><span class="val" style="color:var(--accent-color);">₹' + fmtINR(grandTotal) + '</span></div>';
        }
        document.getElementById('confDetail').innerHTML = detail;

        overlay.classList.remove('show');
        requestAnimationFrame(function () { requestAnimationFrame(function () { overlay.classList.add('show'); }); });
    }

    function showPaymentFailureOverlay(paymentId) {
        var overlay  = document.getElementById('confirmationOverlay');
        var iconWrap = document.getElementById('confIconWrap');
        var closeBtn = document.getElementById('confCloseBtn');
        iconWrap.className = 'confirmation-icon failure';
        iconWrap.innerHTML = FAILURE_SVG;
        closeBtn.className = 'btn-confirm-close failure';
        document.getElementById('confTitle').textContent    = 'Payment Failed';
        document.getElementById('confSubtitle').textContent = 'Your payment could not be processed.';
        document.getElementById('confFooter').style.display = 'none';
        var detail = '<div class="cd-row"><span class="key">Status</span><span class="val" style="color:#dc2626;">Failed / Cancelled</span></div>';
        if (paymentId) detail += '<div class="cd-row"><span class="key">Payment ID</span><span class="val">' + escapeHtml(paymentId) + '</span></div>';
        detail += '<div style="margin-top:8px;font-size:0.85rem;color:#6b7280;display:block;">Please try again or call <strong>+91 90241 64323</strong>.</div>';
        document.getElementById('confDetail').innerHTML = detail;
        overlay.classList.remove('show');
        requestAnimationFrame(function () { requestAnimationFrame(function () { overlay.classList.add('show'); }); });
    }

    window.closeConfirmation = function () {
        document.getElementById('confirmationOverlay').classList.remove('show');
        var title = document.getElementById('confTitle').textContent;
        if (title.indexOf('Failed') === -1) {
            form.reset();
            clearValidation();
            clearPaymentFailed();
            document.getElementById('childrenContainer').innerHTML = '';
            selectedMerch = {};
            document.querySelectorAll('.merch-card.selected').forEach(function (c) { c.classList.remove('selected'); });
            childCount = 0;
            addChild();
            updateTotal();
            ['step2Icon','step3Icon'].forEach(function (id) {
                var el = document.getElementById(id);
                if (el) { el.classList.remove('active'); }
                var lbl = document.getElementById(id.replace('Icon','Label'));
                if (lbl) lbl.classList.remove('active');
            });
        }
    };

    document.getElementById('confirmationOverlay').addEventListener('click', function (e) {
        if (e.target === this) window.closeConfirmation();
    });

    /* ─────────────────────────────────────────────
       BUILD MERCHANDISE HIDDEN INPUTS
    ───────────────────────────────────────────── */
    function buildMerchInputs() {
        var container = document.getElementById('merchHiddenInputs');
        container.innerHTML = '';
        var keys = Object.keys(selectedMerch);
        keys.forEach(function (id, idx) {
            var m = selectedMerch[id];
            ['id','name','price','qty'].forEach(function (field) {
                var inp = document.createElement('input');
                inp.type  = 'hidden';
                inp.name  = 'merchandise[' + idx + '][' + field + ']';
                inp.value = field === 'id' ? id : (field === 'name' ? m.name : (field === 'price' ? m.price : m.qty));
                container.appendChild(inp);
            });
        });
    }

    /* ─────────────────────────────────────────────
       FORM SUBMIT
    ───────────────────────────────────────────── */
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var parentOk   = validateParent();
        var childrenOk = validateChildren();
        var terms      = document.getElementById('termsCheck');
        var termsErr   = document.getElementById('err_terms');
        termsErr.classList.toggle('show', !terms.checked);

        if (!parentOk || !childrenOk || !terms.checked) {
            var bad = form.querySelector('.is-invalid, .field-error.show');
            if (bad) bad.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

        errorEl.style.display = 'none';
        clearPaymentFailed();
        buildMerchInputs();
        setLoading(true);

        var childNames = [];
        document.querySelectorAll('.child-student-name').forEach(function (el) { childNames.push(el.value.trim()); });

        var parentName = document.getElementById('f_parent_name').value.trim();
        var email      = document.getElementById('f_email').value.trim();
        var rawPhone   = document.getElementById('f_phone').value.replace(/\D/g, '');
        var rawWhatsapp = document.getElementById('f_whatsapp').value.replace(/\D/g, '');
        var phone      = '+91' + rawPhone;
        var grandTotal = WS_FEE * childCount + getMerchTotal();

        // Prepend +91 to phone fields before building FormData
        document.getElementById('f_phone').value = '+91' + rawPhone;
        if (rawWhatsapp) document.getElementById('f_whatsapp').value = '+91' + rawWhatsapp;

        fetch(WS_SUBMIT_URL, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': WS_CSRF, 'Accept': 'application/json' },
            body: new FormData(form),
        })
        .then(function (res) {
            return res.json().then(function (data) { return { status: res.status, data: data }; });
        })
        .then(function (result) {
            var status = result.status;
            var data   = result.data;

            if (status === 422 && data.errors) { handleServerErrors(data.errors); setLoading(false); return; }
            if (status >= 400)                 { showError(data.error || data.message || null); setLoading(false); return; }

            /* ── Free ── */
            if (data.is_free) {
                activateStep(2);
                setLoading(false);
                showConfirmation(parentName, email, childNames, WS_WORKSHOP, false, 0);
                return;
            }

            /* ── Paid — Razorpay ── */
            activateStep(3);
            setLoading(false);

            var verifyUrl = WS_VERIFY_URL.replace('__ID__', data.registration_id);

            var rzp = new Razorpay({
                key:         WS_RZP_KEY,
                amount:      data.amount,
                currency:    data.currency || 'INR',
                name:        'Act To Action',
                description: data.workshop_name + (childNames.length > 1 ? ' (' + childNames.length + ' children)' : ''),
                order_id:    data.order_id,
                prefill:     { name: parentName, email: email, contact: phone },
                theme:       { color: '#175cdd' },
                modal: {
                    ondismiss: function () {
                        showPaymentFailed('Payment was cancelled. You can try again below.');
                    }
                },
                handler: function (rzpResponse) {
                    setLoading(true);
                    fetch(verifyUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': WS_CSRF, 'Accept': 'application/json' },
                        body: JSON.stringify({
                            razorpay_order_id:   rzpResponse.razorpay_order_id,
                            razorpay_payment_id: rzpResponse.razorpay_payment_id,
                            razorpay_signature:  rzpResponse.razorpay_signature,
                        }),
                    })
                    .then(function (r) { return r.json(); })
                    .then(function (vData) {
                        if (vData.success) {
                            activateStep(2);
                            showConfirmation(parentName, email, childNames, WS_WORKSHOP, true, grandTotal);
                        } else {
                            showPaymentFailureOverlay(rzpResponse.razorpay_payment_id);
                            showPaymentFailed(vData.message || 'Payment verification failed. Please contact support.');
                        }
                    })
                    .catch(function () {
                        showPaymentFailureOverlay(rzpResponse.razorpay_payment_id);
                        showPaymentFailed('Network error. Save your Payment ID: <strong>' + escapeHtml(rzpResponse.razorpay_payment_id) + '</strong> and call +91 90241 64323.');
                    })
                    .finally(function () { setLoading(false); });
                },
            });

            rzp.on('payment.failed', function (resp) {
                var reason = (resp.error && resp.error.description) ? resp.error.description : null;
                showPaymentFailureOverlay(resp.error && resp.error.metadata && resp.error.metadata.payment_id);
                showPaymentFailed(reason || 'Payment failed. Please try again or call +91 90241 64323.');
                setLoading(false);
            });

            rzp.open();
        })
        .catch(function () { showError(null); setLoading(false); });
    });

}); // end DOMContentLoaded
</script>
@endsection
