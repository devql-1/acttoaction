{{-- resources/views/frontend/Summercamp/workshopdetails.blade.php --}}
@extends('frontend.course.layout')
<style>
    .page-title {
        color: var(--default-color);
        background-color: var(--background-color);
        position: relative;
        padding-top: 100px;
    }
</style>
@section('title', $school->name . ' – Act To Action')


<style>
    .btn-add-child {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 32px;
        border-radius: 50px;
        background: linear-gradient(135deg, #ff7a18, #ffb347);
        color: #fff;
        font-size: 1.05rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(255, 122, 24, 0.3);
    }

    .btn-add-child i {
        font-size: 1.3rem;
    }

    .btn-add-child:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 12px 25px rgba(255, 122, 24, 0.4);
    }

    .btn-add-child:active {
        transform: scale(0.97);
    }

    .btn-add-child:focus {
        outline: none;
    }

    /* ── Price highlight ── */
    .price-highlight {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--accent-color);
        margin-bottom: 1rem;
    }

    .price-highlight small {
        font-size: 1rem;
        color: var(--default-color);
        font-weight: 400;
    }

    /* ── Schedule / feature boxes ── */
    .schedule-table {
        background: var(--surface-color);
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .schedule-table table {
        width: 100%;
    }

    .schedule-table th {
        color: var(--heading-color);
        font-weight: 600;
        padding: 1rem;
        border-bottom: 2px solid color-mix(in srgb, var(--default-color), transparent 90%);
    }

    .schedule-table td {
        padding: 1rem;
        border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 95%);
    }

    .feature-box {
        background: var(--surface-color);
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--accent-color);
    }

    .feature-box h5 {
        color: var(--heading-color);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .feature-box p {
        margin: 0;
        color: color-mix(in srgb, var(--default-color), transparent 20%);
    }

    /* ── Inline validation ── */
    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc2626 !important;
        background-image: none;
    }

    .form-control.is-valid,
    .form-select.is-valid {
        border-color: #16a34a !important;
        background-image: none;
    }

    /* field-error: hidden by default, shown via .show */
    .field-error {
        display: none;
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 4px;
    }

    .field-error.show {
        display: block;
    }

    /* ── Submit button ── */
    #regSubmitBtn {
        transition: all 0.3s;
    }

    #regSubmitBtn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    #regSubmitBtn:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .15);
    }

    /* ── Child cards ── */
    .child-card {
        background: color-mix(in srgb, var(--accent-color), transparent 96%);
        border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 80%);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        position: relative;
    }

    .child-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        font-weight: 600;
        color: var(--heading-color);
        font-size: 0.95rem;
    }

    .btn-remove-child {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s;
        line-height: 1.5;
    }

    .btn-remove-child:hover {
        background: #dc2626;
        color: white;
    }

    /* ── Add-child button — FIXED ── */
    .btn-add-child {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        margin-top: 8px;
        padding: 12px 16px;
        background: transparent;
        border: 2px dashed color-mix(in srgb, var(--accent-color), transparent 45%);
        border-radius: 10px;
        color: var(--accent-color);
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.25s, border-style 0.25s, box-shadow 0.25s;
        /* prevent browser UA button styles from overriding */
        -webkit-appearance: none;
        appearance: none;
        text-align: center;
        box-sizing: border-box;
    }

    .btn-add-child:hover {
        background: color-mix(in srgb, var(--accent-color), transparent 90%);
        border-style: solid;
        box-shadow: 0 2px 8px color-mix(in srgb, var(--accent-color), transparent 75%);
    }

    .btn-add-child i {
        font-size: 1rem;
    }

    /* ── Total price badge ── */
    #totalPriceBadge {
        background: linear-gradient(135deg, var(--accent-color), #1e40af);
        color: white;
        border-radius: 10px;
        padding: 14px 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.95rem;
    }

    #totalPriceBadge strong {
        font-size: 1.3rem;
    }

    /* ══════════════════════════════════════
                                       CONFIRMATION / FAILURE OVERLAY — FIXED
                                    ══════════════════════════════════════ */
    #confirmationOverlay {
        display: none;
        /* hidden by default */
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        /* use flex only when .show is added */
    }

    #confirmationOverlay.show {
        display: flex;
    }

    .confirmation-box {
        background: white;
        border-radius: 20px;
        padding: 48px 40px;
        max-width: 480px;
        width: 90%;
        text-align: center;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        animation: popIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        /* prevent re-animation on re-show if overlay was never hidden */
        animation-fill-mode: both;
    }

    @keyframes popIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Force re-animation each time overlay is shown */
    #confirmationOverlay.show .confirmation-box {
        animation: popIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) both;
    }

    /* ── Success icon ── */
    .confirmation-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .confirmation-icon.success {
        background: #dcfce7;
    }

    .confirmation-icon.failure {
        background: #fee2e2;
    }

    .confirmation-box h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--heading-color);
        margin-bottom: 8px;
    }

    .confirmation-box p {
        color: #6b7280;
        margin-bottom: 6px;
        font-size: 0.95rem;
    }

    .confirmation-detail {
        background: #f9fafb;
        border-radius: 10px;
        padding: 16px;
        margin: 16px 0;
        text-align: left;
    }

    .confirmation-detail div {
        display: flex;
        justify-content: space-between;
        padding: 4px 0;
        font-size: 0.9rem;
    }

    .confirmation-detail .key {
        color: #6b7280;
    }

    .confirmation-detail .val {
        font-weight: 600;
        color: var(--heading-color);
    }

    .btn-confirm-close {
        border: none;
        padding: 14px 36px;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 8px;
        width: 100%;
        transition: all 0.3s;
        color: white;
    }

    .btn-confirm-close.success {
        background: var(--accent-color);
    }

    .btn-confirm-close.failure {
        background: #dc2626;
    }

    .btn-confirm-close:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    /* ── Payment-failed inline banner (inside form) ── */
    #paymentFailedBanner {
        display: none;
        background: #fee2e2;
        border: 1px solid #fca5a5;
        border-left: 4px solid #dc2626;
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 16px;
        font-size: 0.925rem;
        color: #b91c1c;
    }

    #paymentFailedBanner.show {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    #paymentFailedBanner i {
        flex-shrink: 0;
        margin-top: 2px;
        font-size: 1rem;
    }
</style>


@section('content')
    <main class="main">

        {{-- ── Hero / Overview ── --}}
        <section class="department-details section" style="padding-top: 150px; padding-bottom: 60px;">
            <div class="container">
                <nav aria-label="breadcrumb" data-aos="fade-up">
                    <ol class="breadcrumb" style="background: none; padding: 0; margin-bottom: 30px;">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: var(--accent-color); text-decoration: none;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('workshops') }}"
                                style="color: var(--accent-color); text-decoration: none;">Workshops</a>
                        </li>
                        @if ($school->ageGroup && $school->city)
                            <li class="breadcrumb-item">
                                <a href="{{ route('workshops', ['age_group_id' => $school->age_group_id, 'city_id' => $school->city_id]) }}"
                                    style="color: var(--accent-color); text-decoration: none;">
                                    {{ $school->ageGroup->name }} · {{ $school->city->name }}
                                </a>
                            </li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">{{ $school->name }}</li>
                    </ol>
                </nav>

                <div class="row gy-4">
                    {{-- Left --}}
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="mb-5">
                            <div style="border-radius:16px;overflow:hidden;height:450px;">
                                @if ($school->image_url)
                                    <img src="{{ $school->image_url }}" alt="{{ $school->name }}"
                                        class="img-fluid w-100 h-100" style="object-fit:cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                        style="background:linear-gradient(135deg,color-mix(in srgb,var(--accent-color),transparent 80%),color-mix(in srgb,var(--accent-color),transparent 60%));">
                                        <i class="bi bi-building"
                                            style="font-size:5rem;color:var(--accent-color);opacity:0.3;"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="department-hero">
                            <div class="badge-wrap">
                                @if ($school->ageGroup)
                                    <span class="specialty-badge">
                                        <i class="bi bi-people-fill me-2"></i>{{ $school->ageGroup->name }}
                                    </span>
                                @endif
                                @if ($school->city?->name)
                                    <span class="specialty-badge">
                                        <i class="bi bi-building me-2"></i>{{ $school->city->name }}
                                    </span>
                                @endif
                            </div>
                            <h1 class="department-title">{{ $school->name }}</h1>
                            @if ($school->description)
                                <p class="department-intro">{{ $school->description }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Right --}}
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        @if ($school->timings)
                            <div
                                style="background:var(--surface-color);padding:20px;border-radius:12px;margin-bottom:16px;border-left:4px solid var(--accent-color);">
                                <h5 style="color:var(--heading-color);font-weight:600;margin-bottom:8px;font-size:1rem;">
                                    <i class="bi bi-calendar-week me-2" style="color:var(--accent-color);"></i>Class
                                    Schedule
                                </h5>
                                <p style="margin:0;font-size:0.9rem;">{{ $school->timings }}</p>
                            </div>
                        @endif
                        @if ($school->city)
                            <div
                                style="background:var(--surface-color);padding:20px;border-radius:12px;margin-bottom:16px;border-left:4px solid var(--accent-color);">
                                <h5 style="color:var(--heading-color);font-weight:600;margin-bottom:8px;font-size:1rem;">
                                    <i class="bi bi-geo-alt-fill me-2" style="color:var(--accent-color);"></i>City
                                </h5>
                                <p style="margin:0;font-size:0.9rem;">{{ $school->city->name }}</p>
                            </div>
                        @endif
                        @if ($school->fees)
                            <div
                                style="background:var(--surface-color);padding:20px;border-radius:12px;margin-bottom:16px;border-left:4px solid var(--accent-color);">
                                <h5 style="color:var(--heading-color);font-weight:600;margin-bottom:8px;font-size:1rem;">
                                    <i class="bi bi-currency-rupee me-2" style="color:var(--accent-color);"></i>Fees
                                </h5>
                                <p style="margin:0;font-size:1.2rem;font-weight:600;color:var(--accent-color);">
                                    ₹ {{ number_format($school->fees) }}
                                    <small style="font-size:0.8rem;color:#6b7280;">per child</small>
                                </p>
                            </div>
                        @endif
                        <div
                            style="background:color-mix(in srgb,var(--accent-color),transparent 95%);padding:24px;border-radius:12px;text-align:center;">
                            <i class="bi bi-telephone-fill"
                                style="font-size:2rem;color:var(--accent-color);margin-bottom:12px;display:block;"></i>
                            <h5 style="font-size:1.1rem;margin-bottom:8px;">Have Questions?</h5>
                            <p
                                style="font-size:0.9rem;margin-bottom:16px;color:color-mix(in srgb,var(--default-color),transparent 20%);">
                                Call us for any queries
                            </p>
                            <a href="tel:+919024164323"
                                style="display:inline-block;background:var(--accent-color);color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:500;">
                                Call: +91 90241 64323
                            </a>
                            <p
                                style="font-size:0.85rem;margin-top:12px;margin-bottom:0;color:color-mix(in srgb,var(--default-color),transparent 40%);">
                                Mon-Sat: 11 AM – 7 PM
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── Location ── --}}
        @if ($school->address)
            <section class="section" style="padding:80px 0;">
                <div class="container">
                    <div class="row align-items-center gy-4">
                        <div class="col-lg-8" data-aos="fade-up">
                            <h3 style="font-size:2rem;font-weight:300;margin-bottom:24px;">Workshop Location</h3>
                            <div style="border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);">
                                <iframe src="https://maps.google.com/maps?q={{ urlencode($school->address) }}&output=embed"
                                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
                                </iframe>
                            </div>
                        </div>
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                            <div style="background:var(--surface-color);padding:32px;border-radius:16px;">
                                <div class="mb-4">
                                    <div
                                        style="width:50px;height:50px;background:color-mix(in srgb,var(--accent-color),transparent 90%);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                                        <i class="bi bi-geo-alt-fill"
                                            style="font-size:1.5rem;color:var(--accent-color);"></i>
                                    </div>
                                    <h5 style="font-size:1.1rem;margin-bottom:8px;">Address</h5>
                                    <p
                                        style="margin:0;line-height:1.6;color:color-mix(in srgb,var(--default-color),transparent 20%);">
                                        {{ $school->address }}
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <div
                                        style="width:50px;height:50px;background:color-mix(in srgb,var(--accent-color),transparent 90%);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                                        <i class="bi bi-telephone-fill"
                                            style="font-size:1.5rem;color:var(--accent-color);"></i>
                                    </div>
                                    <h5 style="font-size:1.1rem;margin-bottom:8px;">Phone</h5>
                                    <p style="margin:0;">+91 90241 64323</p>
                                </div>
                                <div>
                                    <div
                                        style="width:50px;height:50px;background:color-mix(in srgb,var(--accent-color),transparent 90%);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                                        <i class="bi bi-envelope-fill"
                                            style="font-size:1.5rem;color:var(--accent-color);"></i>
                                    </div>
                                    <h5 style="font-size:1.1rem;margin-bottom:8px;">Email</h5>
                                    <p style="margin:0;">info@acttoaction.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- ── Registration Form ── --}}
        <section class="section" id="registration"
            style="padding:80px 0;background:linear-gradient(135deg,color-mix(in srgb,var(--accent-color),transparent 97%) 0%,var(--surface-color) 100%);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="text-center mb-5" data-aos="fade-up">
                            <h2 style="font-size:2.5rem;font-weight:300;margin-bottom:16px;">Register for the Workshop</h2>
                            <p class="lead">Fill out the form below to secure your spot.</p>
                        </div>

                        <div style="background:var(--surface-color);padding:48px;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.06);"
                            data-aos="fade-up" data-aos-delay="100">

                            {{-- Progress Steps --}}
                            <div class="row mb-5">
                                <div class="col-md-4 mb-3 mb-md-0 text-center">
                                    <div
                                        style="width:60px;height:60px;background:var(--accent-color);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                                        <i class="bi bi-person-fill" style="font-size:1.5rem;color:white;"></i>
                                    </div>
                                    <h6 style="margin-bottom:4px;font-weight:500;">Fill Details</h6>
                                    <small style="color:color-mix(in srgb,var(--default-color),transparent 40%);">Provide
                                        information</small>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0 text-center">
                                    <div id="step2Icon"
                                        style="width:60px;height:60px;background:color-mix(in srgb,var(--accent-color),transparent 80%);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;transition:all 0.4s;">
                                        <i class="bi bi-check-circle-fill"
                                            style="font-size:1.5rem;color:var(--accent-color);"></i>
                                    </div>
                                    <h6 style="margin-bottom:4px;font-weight:500;">Confirmation</h6>
                                    <small style="color:color-mix(in srgb,var(--default-color),transparent 40%);">Receive
                                        confirmation</small>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div id="step3Icon"
                                        style="width:60px;height:60px;background:color-mix(in srgb,var(--accent-color),transparent 80%);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;transition:all 0.4s;">
                                        <i class="bi bi-credit-card-fill"
                                            style="font-size:1.5rem;color:var(--accent-color);"></i>
                                    </div>
                                    <h6 style="margin-bottom:4px;font-weight:500;">Payment</h6>
                                    <small style="color:color-mix(in srgb,var(--default-color),transparent 40%);">Complete
                                        payment</small>
                                </div>
                            </div>

                            <form id="workshopRegForm" novalidate autocomplete="off">
                                @csrf

                                {{-- Parent / Guardian --}}
                                <div class="mb-4">
                                    <h5
                                        style="margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid color-mix(in srgb,var(--default-color),transparent 95%);">
                                        <i class="bi bi-person me-2" style="color:var(--accent-color);"></i>Parent /
                                        Guardian Information
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <input type="text" id="f_parent_name" name="parent_name"
                                                class="form-control" placeholder="Parent/Guardian Name *"
                                                style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);">
                                            <div class="field-error" id="err_parent_name">Please enter parent/guardian
                                                name.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" id="f_email" name="email" class="form-control"
                                                placeholder="Email Address *"
                                                style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);">
                                            <div class="field-error" id="err_email">Please enter a valid email address.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="tel" id="f_phone" name="phone" class="form-control"
                                                placeholder="Phone Number * (10 digits)"
                                                style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);">
                                            <div class="field-error" id="err_phone">Please enter a valid 10-digit phone
                                                number.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="tel" id="f_whatsapp" name="whatsapp" class="form-control"
                                                placeholder="WhatsApp Number (optional)"
                                                style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);">
                                            <div class="field-error" id="err_whatsapp">Please enter a valid WhatsApp
                                                number.</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Children --}}
                                <div class="mb-4">
                                    <h5
                                        style="margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid color-mix(in srgb,var(--default-color),transparent 95%);">
                                        <i class="bi bi-mortarboard me-2" style="color:var(--accent-color);"></i>Student
                                        Information
                                        <small style="font-size:0.8rem;font-weight:400;color:#6b7280;margin-left:8px;">You
                                            can add multiple children</small>
                                    </h5>

                                    <div id="childrenContainer"></div>

                                    <button type="button" class="btn-add-child" id="btnAddChild">
                                        <i class="bi bi-plus-circle"></i>
                                        <span>Add Another Child</span>
                                    </button>
                                </div>

                                {{-- Workshop Details --}}
                                <div class="mb-4">
                                    <h5
                                        style="margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid color-mix(in srgb,var(--default-color),transparent 95%);">
                                        <i class="bi bi-calendar-event me-2"
                                            style="color:var(--accent-color);"></i>Workshop Details
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" value="{{ $school->name }}"
                                                readonly
                                                style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);background:color-mix(in srgb,var(--accent-color),transparent 96%);">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"
                                                value="{{ $school->city?->name ?? '' }}" readonly
                                                style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);background:color-mix(in srgb,var(--accent-color),transparent 96%);">
                                        </div>
                                        <div class="col-12">
                                            <textarea name="message" class="form-control" rows="3"
                                                placeholder="Any special requirements or questions? (Optional)"
                                                style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);resize:vertical;"></textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- Total price badge (paid only) --}}
                                @if ($school->fees > 0)
                                    <div id="totalPriceBadge">
                                        <span>Total Amount (<span id="childCountLabel">1</span> child ×
                                            ₹{{ number_format($school->fees) }})</span>
                                        <strong>₹<span id="totalAmount">{{ number_format($school->fees) }}</span></strong>
                                    </div>
                                @endif

                                {{-- Terms --}}
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="termsCheck">
                                        <label class="form-check-label" for="termsCheck" style="font-size:0.95rem;">
                                            I agree to the
                                            <a href="#"
                                                style="color:var(--accent-color);text-decoration:none;">terms and
                                                conditions</a>
                                            and understand the refund policy
                                        </label>
                                    </div>
                                    <div class="field-error" id="err_terms">You must agree to the terms and conditions.
                                    </div>
                                </div>

                                {{-- Payment failed inline banner --}}
                                <div id="paymentFailedBanner">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <div id="paymentFailedMsg"></div>
                                </div>

                                {{-- Generic loading / error feedback --}}
                                <div id="regLoading"
                                    style="display:none;text-align:center;color:var(--accent-color);margin-bottom:16px;">
                                    <span class="spinner-border spinner-border-sm me-2"></span>Processing your
                                    registration…
                                </div>
                                <div id="regError"
                                    style="display:none;background:#fee2e2;color:#b91c1c;padding:14px 18px;border-radius:8px;margin-bottom:16px;font-size:0.925rem;border-left:4px solid #dc2626;">
                                </div>

                                {{-- Submit --}}
                                <div class="text-center">
                                    <button type="submit" id="regSubmitBtn"
                                        style="background:var(--accent-color);color:white;border:none;padding:16px 48px;border-radius:50px;font-size:1.1rem;font-weight:600;cursor:pointer;min-width:240px;">
                                        @if ($school->fees > 0)
                                            <i class="bi bi-lock-fill me-2"></i>Proceed to Payment
                                        @else
                                            <i class="bi bi-check-circle me-2"></i>Submit Registration
                                        @endif
                                    </button>
                                </div>

                            </form>

                            <div class="mt-4 text-center"
                                style="padding:20px;background:color-mix(in srgb,var(--accent-color),transparent 95%);border-radius:12px;">
                                <p style="margin:0;font-size:0.95rem;">
                                    <i class="bi bi-info-circle-fill me-2" style="color:var(--accent-color);"></i>
                                    Need help? Call <strong style="color:var(--accent-color);">+91 90241 64323</strong>
                                    (Mon-Sat: 11 AM – 7 PM)
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── Related Workshops ── --}}
        @if ($relatedSchools->isNotEmpty())
            <section class="section light-background" style="padding:80px 0;">
                <div class="container">
                    <div class="text-center mb-5" data-aos="fade-up">
                        <h2 style="font-size:2.5rem;font-weight:300;margin-bottom:16px;">
                            Other Workshops in {{ $school->city?->name }}
                        </h2>
                    </div>
                    <div class="row g-4">
                        @foreach ($relatedSchools as $rel)
                            <div class="col-md-4" data-aos="fade-up">
                                <a href="{{ route('workshops.show', $rel) }}"
                                    style="text-decoration:none;color:inherit;">
                                    <div style="background:var(--surface-color);border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);transition:transform 0.3s;"
                                        onmouseover="this.style.transform='translateY(-4px)'"
                                        onmouseout="this.style.transform='translateY(0)'">
                                        <div style="height:180px;overflow:hidden;background:#e8e0d8;">
                                            @if ($rel->image_url)
                                                <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}"
                                                    class="w-100 h-100" style="object-fit:cover;">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-building"
                                                        style="font-size:3rem;color:var(--accent-color);opacity:0.3;"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div style="padding:20px;">
                                            <h5 style="font-weight:600;margin-bottom:6px;">{{ $rel->name }}</h5>
                                            @if ($rel->timings)
                                                <p
                                                    style="margin:0;font-size:0.9rem;color:color-mix(in srgb,var(--default-color),transparent 30%);">
                                                    <i class="bi bi-clock me-1"
                                                        style="color:var(--accent-color);"></i>{{ $rel->timings }}
                                                </p>
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

        {{-- ══════════════════════════════════════
             CONFIRMATION / FAILURE OVERLAY
        ══════════════════════════════════════ --}}
        <div id="confirmationOverlay" role="dialog" aria-modal="true" aria-labelledby="confTitle">
            <div class="confirmation-box">
                {{-- Icon injected by JS --}}
                <div class="confirmation-icon success" id="confIconWrap">
                    {{-- SVG swapped by JS --}}
                </div>
                <h3 id="confTitle">Registration Confirmed!</h3>
                <p id="confSubtitle">Your spot has been secured.</p>
                <div class="confirmation-detail" id="confDetail"></div>
                <p id="confFooter" style="font-size:0.85rem;color:#9ca3af;margin-top:12px;">
                    A confirmation will be sent to your email. For queries call
                    <strong>+91 90241 64323</strong>.
                </p>
                <button class="btn-confirm-close success" id="confCloseBtn" onclick="closeConfirmation()">Done</button>
            </div>
        </div>

        {{-- ══════════════════════════════════════
             SCRIPTS
        ══════════════════════════════════════ --}}
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            // All server-side values exposed as JS constants ─ no raw PHP in logic below
            var WS_SUBMIT_URL = '{{ route('frontend.summercamp.register.submit', $school) }}';
            var WS_VERIFY_URL = '{{ route('frontend.summercamp.register.verify', ['registration' => '__ID__']) }}';
            var WS_RZP_KEY = '{{ config('services.razorpay.key') }}';
            var WS_FEE = {{ (float) $school->fees }};
            var WS_IS_FREE = {{ $school->fees == 0 ? 'true' : 'false' }};
            var WS_CSRF = '{{ csrf_token() }}';
            var WS_WORKSHOP = '{{ addslashes($school->name) }}';
            var WS_CITY = '{{ addslashes($school->city?->name ?? '') }}';
            var WS_AGEGROUP = '{{ addslashes($school->ageGroup?->name ?? '') }}';
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                var form = document.getElementById('workshopRegForm');
                var submitBtn = document.getElementById('regSubmitBtn');
                var loadingEl = document.getElementById('regLoading');
                var errorEl = document.getElementById('regError');
                var childCount = 0;

                if (!form) {
                    console.error('workshopRegForm not found');
                    return;
                }

                /* ══════════════════════════════════════
                   CHILD CARD BUILDER
                ══════════════════════════════════════ */
                function buildChildCard(idx, num) {
                    var card = document.createElement('div');
                    card.className = 'child-card';
                    card.id = 'child_' + idx;

                    var removeBtn = idx > 0 ?
                        '<button type="button" class="btn-remove-child" data-idx="' + idx + '">✕ Remove</button>' :
                        '';

                    card.innerHTML =
                        '<div class="child-card-header">' +
                        '<span><i class="bi bi-person-badge me-2" style="color:var(--accent-color);"></i>Child ' + num +
                        '</span>' +
                        removeBtn +
                        '</div>' +
                        '<div class="row g-3">' +
                        '<div class="col-md-6">' +
                        '<input type="text" name="children[' + idx + '][student_name]" ' +
                        'class="form-control child-student-name" ' +
                        'placeholder="Student Name *" ' +
                        'style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);">' +
                        '<div class="field-error child-err-name">Please enter the student\'s name.</div>' +
                        '</div>' +
                        '<div class="col-md-6">' +
                        '<input type="date" name="children[' + idx + '][dob]" ' +
                        'class="form-control" ' +
                        'style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);">' +
                        '</div>' +
                        '<div class="col-md-6">' +
                        '<input type="text" class="form-control" value="' + escapeHtml(WS_AGEGROUP) + '" readonly ' +
                        'style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);background:color-mix(in srgb,var(--accent-color),transparent 96%);">' +
                        '</div>' +
                        '<div class="col-md-6">' +
                        '<input type="text" name="children[' + idx + '][school_name]" ' +
                        'class="form-control" placeholder="School Name (optional)" ' +
                        'style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);">' +
                        '</div>' +
                        '<div class="col-12">' +
                        '<select name="children[' + idx + '][experience]" class="form-select" ' +
                        'style="padding:14px;border-radius:8px;border:1px solid color-mix(in srgb,var(--default-color),transparent 85%);">' +
                        '<option value="">Previous Acting Experience (Optional)</option>' +
                        '<option value="none">No prior experience</option>' +
                        '<option value="beginner">Beginner (less than 1 year)</option>' +
                        '<option value="intermediate">Intermediate (1-2 years)</option>' +
                        '<option value="advanced">Advanced (2+ years)</option>' +
                        '</select>' +
                        '</div>' +
                        '</div>';

                    return card;
                }

                // Safe HTML escape — prevents XSS from WS_* variables injected into innerHTML
                function escapeHtml(str) {
                    var d = document.createElement('div');
                    d.appendChild(document.createTextNode(str));
                    return d.innerHTML;
                }

                function addChild() {
                    if (childCount >= 5) return;
                    var idx = childCount; // 0-based index
                    childCount++;
                    var card = buildChildCard(idx, childCount);
                    document.getElementById('childrenContainer').appendChild(card);
                    document.getElementById('btnAddChild').style.display = childCount >= 5 ? 'none' : 'flex';
                    updateTotal();
                }

                // Delegated remove handler (avoids window pollution / onclick in HTML)
                document.getElementById('childrenContainer').addEventListener('click', function(e) {
                    var btn = e.target.closest('.btn-remove-child');
                    if (!btn) return;

                    var card = btn.closest('.child-card');
                    if (card) card.remove();
                    childCount--;

                    // Re-number remaining cards & fix input names
                    document.querySelectorAll('.child-card').forEach(function(c, i) {
                        c.id = 'child_' + i;
                        c.querySelector('.child-card-header span').innerHTML =
                            '<i class="bi bi-person-badge me-2" style="color:var(--accent-color);"></i>Child ' +
                            (i + 1);

                        c.querySelectorAll('input[name], select[name]').forEach(function(el) {
                            el.name = el.name.replace(/children\[\d+\]/, 'children[' + i + ']');
                        });

                        // First card must never have a remove button
                        if (i === 0) {
                            var rb = c.querySelector('.btn-remove-child');
                            if (rb) rb.remove();
                        }
                    });

                    childCount = document.querySelectorAll('.child-card').length;
                    document.getElementById('btnAddChild').style.display = childCount >= 5 ? 'none' : 'flex';
                    updateTotal();
                });

                function updateTotal() {
                    var countEl = document.getElementById('childCountLabel');
                    var totalEl = document.getElementById('totalAmount');
                    if (countEl) countEl.textContent = childCount;
                    if (totalEl) totalEl.textContent = (WS_FEE * childCount).toLocaleString('en-IN');
                }

                document.getElementById('btnAddChild').addEventListener('click', addChild);

                // Render first child immediately
                addChild();

                /* ══════════════════════════════════════
                   VALIDATION
                ══════════════════════════════════════ */
                var parentRules = {
                    parent_name: {
                        el: 'f_parent_name',
                        err: 'err_parent_name',
                        test: function(v) {
                            return v.trim().length >= 2;
                        }
                    },
                    email: {
                        el: 'f_email',
                        err: 'err_email',
                        test: function(v) {
                            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim());
                        }
                    },
                    phone: {
                        el: 'f_phone',
                        err: 'err_phone',
                        test: function(v) {
                            return /^[6-9]\d{9}$/.test(v.replace(/\D/g, ''));
                        }
                    },
                    whatsapp: {
                        el: 'f_whatsapp',
                        err: 'err_whatsapp',
                        test: function(v) {
                            return v === '' || /^[6-9]\d{9}$/.test(v.replace(/\D/g, ''));
                        }
                    }
                };

                function validateParent() {
                    var ok = true;
                    Object.keys(parentRules).forEach(function(name) {
                        var rule = parentRules[name];
                        var input = document.getElementById(rule.el);
                        var errEl = document.getElementById(rule.err);
                        var valid = rule.test(input ? input.value : '');
                        if (input) {
                            input.classList.toggle('is-invalid', !valid);
                            input.classList.toggle('is-valid', valid);
                        }
                        if (errEl) errEl.classList.toggle('show', !valid);
                        if (!valid) ok = false;
                    });
                    return ok;
                }

                function validateChildren() {
                    var ok = true;
                    document.querySelectorAll('.child-card').forEach(function(card) {
                        var nameInput = card.querySelector('.child-student-name');
                        var errEl = card.querySelector('.child-err-name');
                        var valid = nameInput && nameInput.value.trim().length >= 2;
                        if (nameInput) {
                            nameInput.classList.toggle('is-invalid', !valid);
                            nameInput.classList.toggle('is-valid', valid);
                        }
                        if (errEl) errEl.classList.toggle('show', !valid);
                        if (!valid) ok = false;
                    });
                    return ok;
                }

                // Live blur / input on parent fields
                Object.keys(parentRules).forEach(function(name) {
                    var input = document.getElementById(parentRules[name].el);
                    if (!input) return;
                    input.addEventListener('blur', function() {
                        validateParent();
                    });
                    input.addEventListener('input', function() {
                        if (input.classList.contains('is-invalid')) validateParent();
                    });
                });

                /* ══════════════════════════════════════
                   UI HELPERS
                ══════════════════════════════════════ */
                function setLoading(yes) {
                    submitBtn.disabled = yes;
                    loadingEl.style.display = yes ? 'block' : 'none';
                    submitBtn.style.opacity = yes ? '0.7' : '1';
                    submitBtn.style.cursor = yes ? 'not-allowed' : 'pointer';
                }

                function showError(msg) {
                    var safe = (typeof msg === 'string' && msg.length < 400) ? msg :
                        'Something went wrong. Please try again or call +91 90241 64323.';
                    errorEl.innerHTML = '<i class="bi bi-exclamation-circle-fill me-2"></i>' + safe;
                    errorEl.style.display = 'block';
                    errorEl.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }

                function showPaymentFailed(msg) {
                    var safe = (typeof msg === 'string' && msg.length < 400) ? msg :
                        'Payment failed. Please try again or call +91 90241 64323.';
                    var banner = document.getElementById('paymentFailedBanner');
                    document.getElementById('paymentFailedMsg').innerHTML = safe;
                    banner.classList.add('show');
                    banner.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }

                function clearPaymentFailed() {
                    var banner = document.getElementById('paymentFailedBanner');
                    banner.classList.remove('show');
                    document.getElementById('paymentFailedMsg').innerHTML = '';
                }

                function activateStep(n) {
                    var el = document.getElementById('step' + n + 'Icon');
                    if (el) {
                        el.style.background = 'var(--accent-color)';
                        el.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
                    }
                }

                function clearValidation() {
                    form.querySelectorAll('.is-valid,.is-invalid').forEach(function(el) {
                        el.classList.remove('is-valid', 'is-invalid');
                    });
                    form.querySelectorAll('.field-error.show').forEach(function(el) {
                        el.classList.remove('show');
                    });
                }

                function handleServerErrors(errors) {
                    var first = null;
                    Object.keys(errors).forEach(function(field) {
                        var errEl = document.getElementById('err_' + field);
                        var input = document.getElementById('f_' + field);
                        if (errEl) {
                            errEl.textContent = errors[field][0];
                            errEl.classList.add('show');
                        }
                        if (input) {
                            input.classList.add('is-invalid');
                            if (!first) first = input;
                        }
                    });
                    if (first) first.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }

                /* ══════════════════════════════════════
                   CONFIRMATION / FAILURE OVERLAY
                ══════════════════════════════════════ */
                var SUCCESS_SVG =
                    '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" ' +
                    'stroke="#16a34a" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>';

                var FAILURE_SVG =
                    '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" ' +
                    'stroke="#dc2626" stroke-width="2.5">' +
                    '<line x1="18" y1="6" x2="6" y2="18"/>' +
                    '<line x1="6"  y1="6" x2="18" y2="18"/></svg>';

                function showConfirmation(parentName, email, childNames, workshopName, isPaid) {
                    var overlay = document.getElementById('confirmationOverlay');
                    var iconWrap = document.getElementById('confIconWrap');
                    var closeBtn = document.getElementById('confCloseBtn');

                    // Swap icon & colour scheme
                    iconWrap.className = 'confirmation-icon success';
                    iconWrap.innerHTML = SUCCESS_SVG;
                    closeBtn.className = 'btn-confirm-close success';

                    document.getElementById('confTitle').textContent =
                        isPaid ? 'Payment Successful! 🎉' : 'Registration Confirmed! 🎉';
                    document.getElementById('confSubtitle').textContent =
                        childNames.length > 1 ?
                        childNames.length + ' children have been registered.' :
                        'Your child\'s spot has been secured.';
                    document.getElementById('confFooter').style.display = '';

                    var detail = '';
                    detail += '<div><span class="key">Parent</span><span class="val">' + escapeHtml(parentName) +
                        '</span></div>';
                    detail += '<div><span class="key">Email</span><span class="val">' + escapeHtml(email) +
                        '</span></div>';
                    detail += '<div><span class="key">Workshop</span><span class="val">' + escapeHtml(workshopName) +
                        '</span></div>';
                    childNames.forEach(function(name, i) {
                        detail += '<div><span class="key">Child ' + (i + 1) + '</span><span class="val">' +
                            escapeHtml(name) + '</span></div>';
                    });
                    document.getElementById('confDetail').innerHTML = detail;

                    // Force re-animation by removing then re-adding .show
                    overlay.classList.remove('show');
                    requestAnimationFrame(function() {
                        requestAnimationFrame(function() {
                            overlay.classList.add('show');
                        });
                    });
                }

                function showPaymentFailureOverlay(paymentId) {
                    var overlay = document.getElementById('confirmationOverlay');
                    var iconWrap = document.getElementById('confIconWrap');
                    var closeBtn = document.getElementById('confCloseBtn');

                    iconWrap.className = 'confirmation-icon failure';
                    iconWrap.innerHTML = FAILURE_SVG;
                    closeBtn.className = 'btn-confirm-close failure';

                    document.getElementById('confTitle').textContent = 'Payment Failed';
                    document.getElementById('confSubtitle').textContent = 'Your payment could not be processed.';
                    document.getElementById('confFooter').style.display = 'none';

                    var detail =
                        '<div><span class="key">Status</span><span class="val" style="color:#dc2626;">Failed / Cancelled</span></div>';
                    if (paymentId) {
                        detail += '<div><span class="key">Payment ID</span><span class="val">' + escapeHtml(paymentId) +
                            '</span></div>';
                    }
                    detail +=
                        '<div style="margin-top:8px;font-size:0.85rem;color:#6b7280;display:block;">Please try again or call <strong>+91 90241 64323</strong>.</div>';
                    document.getElementById('confDetail').innerHTML = detail;

                    overlay.classList.remove('show');
                    requestAnimationFrame(function() {
                        requestAnimationFrame(function() {
                            overlay.classList.add('show');
                        });
                    });
                }

                window.closeConfirmation = function() {
                    document.getElementById('confirmationOverlay').classList.remove('show');
                    // Reset form only on success (if still loading or failed, keep data)
                    var title = document.getElementById('confTitle').textContent;
                    if (title.indexOf('Failed') === -1) {
                        form.reset();
                        clearValidation();
                        clearPaymentFailed();
                        document.getElementById('childrenContainer').innerHTML = '';
                        childCount = 0;
                        addChild();
                        updateTotal();
                        // Reset step icons
                        ['step2Icon', 'step3Icon'].forEach(function(id) {
                            var el = document.getElementById(id);
                            if (el) {
                                el.style.background =
                                    'color-mix(in srgb, var(--accent-color), transparent 80%)';
                                el.style.boxShadow = '';
                            }
                        });
                    }
                };

                // Close overlay on backdrop click
                document.getElementById('confirmationOverlay').addEventListener('click', function(e) {
                    if (e.target === this) window.closeConfirmation();
                });

                /* ══════════════════════════════════════
                   FORM SUBMIT
                ══════════════════════════════════════ */
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var parentOk = validateParent();
                    var childrenOk = validateChildren();
                    var terms = document.getElementById('termsCheck');
                    var termsErr = document.getElementById('err_terms');

                    termsErr.classList.toggle('show', !terms.checked);

                    if (!parentOk || !childrenOk || !terms.checked) {
                        var bad = form.querySelector('.is-invalid, .field-error.show');
                        if (bad) bad.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        return;
                    }

                    errorEl.style.display = 'none';
                    clearPaymentFailed();
                    setLoading(true);

                    // Collect child names for confirmation overlay
                    var childNames = [];
                    document.querySelectorAll('.child-student-name').forEach(function(el) {
                        childNames.push(el.value.trim());
                    });

                    var parentName = document.getElementById('f_parent_name').value.trim();
                    var email = document.getElementById('f_email').value.trim();
                    var phone = document.getElementById('f_phone').value.trim();

                    fetch(WS_SUBMIT_URL, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': WS_CSRF,
                                'Accept': 'application/json'
                            },
                            body: new FormData(form),
                        })
                        .then(function(res) {
                            return res.json().then(function(data) {
                                return {
                                    status: res.status,
                                    data: data
                                };
                            });
                        })
                        .then(function(result) {
                            var status = result.status;
                            var data = result.data;

                            if (status === 422 && data.errors) {
                                handleServerErrors(data.errors);
                                setLoading(false);
                                return;
                            }

                            if (status >= 400) {
                                showError(data.error || data.message || null);
                                setLoading(false);
                                return;
                            }

                            // ── Free workshop ─────────────────────────────────
                            if (data.is_free) {
                                activateStep(2);
                                setLoading(false);
                                showConfirmation(parentName, email, childNames, WS_WORKSHOP, false);
                                return;
                            }

                            // ── Paid — open Razorpay ──────────────────────────
                            activateStep(3);
                            setLoading(false);

                            var verifyUrl = WS_VERIFY_URL.replace('__ID__', data.registration_id);

                            var rzp = new Razorpay({
                                key: WS_RZP_KEY,
                                amount: data.amount,
                                currency: data.currency || 'INR',
                                name: 'Act To Action',
                                description: data.workshop_name + (childNames.length > 1 ? ' (' +
                                    childNames.length + ' children)' : ''),
                                order_id: data.order_id,
                                prefill: {
                                    name: parentName,
                                    email: email,
                                    contact: phone
                                },
                                theme: {
                                    color: '#175cdd'
                                },

                                modal: {
                                    ondismiss: function() {
                                        // User closed the Razorpay modal without paying
                                        showPaymentFailed(
                                            'Payment was cancelled. You can try again below.'
                                        );
                                    }
                                },

                                handler: function(rzpResponse) {
                                    setLoading(true);
                                    fetch(verifyUrl, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': WS_CSRF,
                                                'Accept': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                razorpay_order_id: rzpResponse
                                                    .razorpay_order_id,
                                                razorpay_payment_id: rzpResponse
                                                    .razorpay_payment_id,
                                                razorpay_signature: rzpResponse
                                                    .razorpay_signature,
                                            }),
                                        })
                                        .then(function(r) {
                                            return r.json();
                                        })
                                        .then(function(vData) {
                                            if (vData.success) {
                                                activateStep(2);
                                                showConfirmation(parentName, email,
                                                    childNames, WS_WORKSHOP, true);
                                            } else {
                                                // Verification failed (signature mismatch etc.)
                                                showPaymentFailureOverlay(rzpResponse
                                                    .razorpay_payment_id);
                                                showPaymentFailed(vData.message ||
                                                    'Payment verification failed. Please contact support.'
                                                );
                                            }
                                        })
                                        .catch(function() {
                                            // Network error during verify — give user the payment ID
                                            showPaymentFailureOverlay(rzpResponse
                                                .razorpay_payment_id);
                                            showPaymentFailed(
                                                'Network error during verification. Please save your Payment ID: <strong>' +
                                                escapeHtml(rzpResponse
                                                    .razorpay_payment_id) +
                                                '</strong> and call us on +91 90241 64323.'
                                            );
                                        })
                                        .finally(function() {
                                            setLoading(false);
                                        });
                                },
                            });

                            rzp.on('payment.failed', function(resp) {
                                // Razorpay SDK reports a hard failure (card declined etc.)
                                var reason = (resp.error && resp.error.description) ? resp.error
                                    .description : null;
                                showPaymentFailureOverlay(resp.error && resp.error.metadata && resp
                                    .error.metadata.payment_id);
                                showPaymentFailed(reason ||
                                    'Payment failed. Please try again or call us on +91 90241 64323.'
                                );
                                setLoading(false);
                            });

                            rzp.open();
                        })
                        .catch(function() {
                            showError(null);
                            setLoading(false);
                        });
                });

            }); // end DOMContentLoaded
        </script>

    </main>
@endsection
