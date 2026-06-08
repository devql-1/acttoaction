@extends('frontend.course.layout')
@section('content')

    <style>
        :root {
            --cu-accent: var(--accent-color, #0d6efd);
            --cu-surface: var(--surface-color, #ffffff);
            --cu-text: var(--default-color, #495057);
            --cu-heading: var(--heading-color, #212529);
        }

        .cu-hero {
            position: relative;
            padding: 219px 0 90px 0;
            background:
                radial-gradient(circle at 15% 20%, color-mix(in srgb, var(--cu-accent), transparent 80%) 0%, transparent 45%),
                radial-gradient(circle at 85% 80%, color-mix(in srgb, var(--cu-accent), transparent 85%) 0%, transparent 40%),
                linear-gradient(135deg, #f8fbff 0%, #eef4ff 100%);
            overflow: hidden;
        }

        .cu-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(color-mix(in srgb, var(--cu-accent), transparent 85%) 1px, transparent 1px);
            background-size: 22px 22px;
            opacity: .4;
            pointer-events: none;
        }

        .cu-hero-inner {
            position: relative;
            text-align: center;
            max-width: 760px;
            margin: 0 auto;
        }

        .cu-hero .cu-eyebrow {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 999px;
            background: color-mix(in srgb, var(--cu-accent), transparent 88%);
            color: var(--cu-accent);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .cu-hero h1 {
            font-size: 48px;
            font-weight: 800;
            color: var(--cu-heading);
            margin-bottom: 16px;
            line-height: 1.15;
        }

        .cu-hero h1 span {
            color: var(--cu-accent);
        }

        .cu-hero p {
            font-size: 17px;
            color: color-mix(in srgb, var(--cu-text), transparent 15%);
            margin-bottom: 28px;
        }

        .cu-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: color-mix(in srgb, var(--cu-text), transparent 30%);
        }

        .cu-breadcrumb a {
            color: var(--cu-accent);
            text-decoration: none;
        }

        .cu-breadcrumb i {
            font-size: 12px;
        }

        /* Quick action cards */
        .cu-quick {
            margin-top: -60px;
            position: relative;
            z-index: 3;
        }

        .cu-quick-card {
            background: #fff;
            border-radius: 18px;
            padding: 28px 26px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
            transition: transform .3s ease, box-shadow .3s ease;
            height: 100%;
            text-decoration: none;
            color: inherit;
            display: block;
            border: 1px solid color-mix(in srgb, var(--cu-accent), transparent 92%);
        }

        .cu-quick-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 30px 60px rgba(15, 23, 42, 0.12);
            color: inherit;
        }

        .cu-quick-card .cu-ic {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: color-mix(in srgb, var(--cu-accent), transparent 88%);
            color: var(--cu-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
            transition: .3s;
        }

        .cu-quick-card:hover .cu-ic {
            background: var(--cu-accent);
            color: #fff;
        }

        .cu-quick-card h6 {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: color-mix(in srgb, var(--cu-text), transparent 40%);
            margin-bottom: 6px;
        }

        .cu-quick-card .cu-val {
            font-size: 16px;
            font-weight: 700;
            color: var(--cu-heading);
            word-break: break-word;
        }

        /* Main grid */
        .cu-main {
            padding: 80px 0 60px;
        }

        .cu-info-card {
            background: #fff;
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 10px 40px rgba(15, 23, 42, 0.06);
            height: 100%;
        }

        .cu-info-card h3 {
            font-size: 22px;
            font-weight: 800;
            color: var(--cu-heading);
            margin-bottom: 8px;
        }

        .cu-info-card>p {
            color: color-mix(in srgb, var(--cu-text), transparent 20%);
            font-size: 14px;
            margin-bottom: 26px;
        }

        .cu-info-row {
            display: flex;
            gap: 16px;
            padding: 18px 0;
            border-bottom: 1px dashed color-mix(in srgb, var(--cu-text), transparent 80%);
        }

        .cu-info-row:last-of-type {
            border-bottom: none;
            padding-bottom: 0;
        }

        .cu-info-row .cu-ic-sm {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            border-radius: 12px;
            background: color-mix(in srgb, var(--cu-accent), transparent 90%);
            color: var(--cu-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .cu-info-row h6 {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin: 0 0 4px;
            color: color-mix(in srgb, var(--cu-text), transparent 40%);
        }

        .cu-info-row p {
            margin: 0;
            font-size: 15px;
            color: var(--cu-heading);
            font-weight: 600;
            line-height: 1.5;
        }

        .cu-socials {
            display: flex;
            gap: 10px;
            margin-top: 26px;
            padding-top: 22px;
            border-top: 1px dashed color-mix(in srgb, var(--cu-text), transparent 80%);
        }

        .cu-socials a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--cu-accent), transparent 92%);
            color: var(--cu-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: .3s;
            font-size: 16px;
        }

        .cu-socials a:hover {
            background: var(--cu-accent);
            color: #fff;
            transform: translateY(-3px);
        }

        /* Form card */
        .cu-form-card {
            background: #fff;
            border-radius: 20px;
            padding: 42px 38px;
            box-shadow: 0 10px 40px rgba(15, 23, 42, 0.06);
        }

        .cu-form-card h3 {
            font-size: 24px;
            font-weight: 800;
            color: var(--cu-heading);
            margin-bottom: 6px;
        }

        .cu-form-card .cu-form-sub {
            color: color-mix(in srgb, var(--cu-text), transparent 20%);
            font-size: 14px;
            margin-bottom: 28px;
        }

        .cu-field {
            position: relative;
        }

        .cu-field label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--cu-heading);
            margin-bottom: 8px;
        }

        .cu-field .form-control,
        .cu-field .input-group {
            border-radius: 12px;
        }

        .cu-field .form-control {
            border: 1.5px solid color-mix(in srgb, var(--cu-accent), transparent 85%);
            padding: 13px 16px;
            font-size: 14px;
            background: #fafbff;
            transition: .25s;
        }

        .cu-field .form-control:focus {
            border-color: var(--cu-accent);
            background: #fff;
            box-shadow: 0 0 0 4px color-mix(in srgb, var(--cu-accent), transparent 88%);
        }

        .cu-field .input-group-text {
            background: color-mix(in srgb, var(--cu-accent), transparent 90%);
            border: 1.5px solid color-mix(in srgb, var(--cu-accent), transparent 85%);
            color: var(--cu-accent);
            font-weight: 700;
            font-size: 14px;
            border-right: none;
        }

        .cu-field .input-group .form-control {
            border-left: none;
        }

        .cu-field small.text-danger {
            display: block;
            margin-top: 6px;
            font-size: 12px;
        }

        .cu-submit {
            background: var(--cu-accent);
            color: #fff;
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 700;
            border: none;
            transition: .3s;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .cu-submit:hover {
            background: color-mix(in srgb, var(--cu-accent), #000 15%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px color-mix(in srgb, var(--cu-accent), transparent 65%);
        }

        .cu-submit:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }

        /* Map */
        .cu-map {
            padding: 0 0 90px;
        }

        .cu-map-wrap {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.1);
            background: #fff;
        }

        .cu-map-wrap iframe {
            display: block;
            width: 100%;
            height: 420px;
            border: 0;
        }

        .cu-map-fallback {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 34px 38px;
            flex-wrap: wrap;
        }

        .cu-map-fallback .cu-mf-text h4 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 6px;
            color: var(--cu-heading);
        }

        .cu-map-fallback .cu-mf-text p {
            margin: 0;
            color: color-mix(in srgb, var(--cu-text), transparent 20%);
            font-size: 14px;
        }

        .cu-map-fallback .btn-directions {
            background: var(--cu-accent);
            color: #fff;
            padding: 12px 26px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: .3s;
        }

        .cu-map-fallback .btn-directions:hover {
            background: color-mix(in srgb, var(--cu-accent), #000 15%);
            transform: translateY(-2px);
            color: #fff;
        }

        @media (max-width: 991px) {
            .cu-hero {
                padding: 90px 0 70px;
            }

            .cu-hero h1 {
                font-size: 38px;
            }

            .cu-form-card,
            .cu-info-card {
                padding: 30px 24px;
            }
        }

        @media (max-width: 575px) {
            .cu-hero h1 {
                font-size: 30px;
            }

            .cu-hero p {
                font-size: 15px;
            }

            .cu-quick {
                margin-top: -40px;
            }

            .cu-map-wrap iframe {
                height: 320px;
            }

            .cu-map-fallback {
                padding: 24px;
            }

            /* Prevent iOS zoom-on-focus + comfortable tap targets */
            .cu-field .form-control,
            .cu-field textarea.form-control {
                font-size: 16px;
                min-height: 44px;
            }

            .cu-field .input-group-text {
                font-size: 14px;
            }

            .cu-form-card,
            .cu-info-card {
                padding: 24px 18px;
            }
        }
    </style>
    @include('frontend.partialspages.contact-info')



    <main class="main">
        <!-- Hero -->
        <section class="cu-hero">
            <div class="container cu-hero-inner" data-aos="fade-up">
                <span class="cu-eyebrow">Contact Us</span>
                <h1>We'd Love To <span>Hear From You</span></h1>
                <p>Got a question about courses, certifications, or corporate training? Send us a message or reach out
                    directly — our team usually responds within one business day.</p>
                <div class="cu-breadcrumb">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Contact Us</span>
                </div>
            </div>
        </section>

        <!-- Quick action cards -->
        <section class="cu-quick">
            <div class="container">
                <div class="row g-4">
                    @if ($phone)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="50">
                            <a href="tel:{{ $phoneDigits }}" class="cu-quick-card">
                                <div class="cu-ic"><i class="bi bi-telephone-fill"></i></div>
                                <h6>Call Us</h6>
                                <div class="cu-val">{{ $phone }}</div>
                            </a>
                        </div>
                    @endif
                    @if ($whatsapp)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                            <a href="https://wa.me/91{{ $whatsappDigits }}" target="_blank" rel="noopener"
                                class="cu-quick-card">
                                <div class="cu-ic"><i class="bi bi-whatsapp"></i></div>
                                <h6>WhatsApp</h6>
                                <div class="cu-val">{{ $whatsapp }}</div>
                            </a>
                        </div>
                    @endif
                    @if ($email)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
                            <a href="mailto:{{ $email }}" class="cu-quick-card">
                                <div class="cu-ic"><i class="bi bi-envelope-fill"></i></div>
                                <h6>Email Us</h6>
                                <div class="cu-val">{{ $email }}</div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Main grid: info + form -->
        <section class="cu-main">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-5" data-aos="fade-right">
                        <div class="cu-info-card">
                            <h3>Reach Out To Us</h3>
                            <p>Visit our training centre, drop us a line, or connect on social — we're happy to help.</p>

                            <div class="cu-info-row">
                                <div class="cu-ic-sm"><i class="bi bi-geo-alt-fill"></i></div>
                                <div>
                                    <h6>Our Location</h6>
                                    <p>{{ $address }}</p>
                                </div>
                            </div>

                            <div class="cu-info-row">
                                <div class="cu-ic-sm"><i class="bi bi-telephone-fill"></i></div>
                                <div>
                                    <h6>Call or WhatsApp</h6>
                                    <p>
                                        @foreach ($chatPhones as $ph)
                                            <a href="tel:{{ preg_replace('/\D/', '', $ph) }}"
                                                style="color:inherit;text-decoration:none;">{{ $ph }}</a>
                                            @if (!$loop->last)
                                                ,
                                                <br>
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                            </div>

                            <div class="cu-info-row">
                                <div class="cu-ic-sm"><i class="bi bi-clock-fill"></i></div>
                                <div>
                                    <h6>Operating Hours</h6>
                                    <p>
                                        @foreach ($workingHours as $wh)
                                            {{ $wh }}@if (!$loop->last)
                                                <br>
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                            </div>

                            <div class="cu-info-row">
                                <div class="cu-ic-sm"><i class="bi bi-envelope-fill"></i></div>
                                <div>
                                    <h6>Email Support</h6>
                                    <p><a href="mailto:{{ $email }}"
                                            style="color:inherit;text-decoration:none;">{{ $email }}</a></p>
                                </div>
                            </div>

                            @if ($fbUrl || $instaUrl || $linkedinUrl)
                                <div class="cu-socials">
                                    @if ($fbUrl)
                                        <a href="{{ $fbUrl }}" target="_blank" rel="noopener"
                                            aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                    @endif
                                    @if ($instaUrl)
                                        <a href="{{ $instaUrl }}" target="_blank" rel="noopener"
                                            aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                    @endif
                                    @if ($linkedinUrl)
                                        <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener"
                                            aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                        <div class="cu-form-card">
                            <h3>Send Us A Message</h3>
                            <p class="cu-form-sub">Fill in the details below and we'll get back to you shortly.</p>

                            <form id="cuContactForm" novalidate>
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="cu-field">
                                            <label for="cu-name">Full Name</label>
                                            <input type="text" id="cu-name" name="name" class="form-control"
                                                placeholder="Your full name" required>
                                            <small class="text-danger name_error"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cu-field">
                                            <label for="cu-email">Email Address</label>
                                            <input type="email" id="cu-email" name="email" class="form-control"
                                                placeholder="you@example.com" required>
                                            <small class="text-danger email_error"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cu-field">
                                            <label for="cu-mobile">Mobile Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text">+91</span>
                                                <input type="tel" id="cu-mobile" name="mobile" class="form-control"
                                                    placeholder="10-digit number" maxlength="10" inputmode="numeric"
                                                    required>
                                            </div>
                                            <small class="text-danger mobile_error"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cu-field">
                                            <label for="cu-subject">Subject</label>
                                            <input type="text" id="cu-subject" name="subject" class="form-control"
                                                placeholder="Course enquiry, VAPT, corporate training…" required>
                                            <small class="text-danger subject_error"></small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="cu-field">
                                            <label for="cu-message">Your Message</label>
                                            <textarea id="cu-message" name="message" class="form-control" rows="5"
                                                placeholder="Tell us what you're looking for — we'll help you find the right program or service."></textarea>
                                            <small class="text-danger message_error"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <button type="submit" class="cu-submit" id="cuSubmitBtn">
                                            <span class="cu-submit-label">Send Message</span>
                                            <i class="bi bi-send"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($mapLink)
            <!-- Map -->
            <section class="cu-map">
                <div class="container">
                    <div class="cu-map-wrap" data-aos="fade-up">
                        @if ($isEmbedMap)
                            <iframe src="{{ $mapLink }}" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @else
                            <div class="cu-map-fallback">
                                <div class="cu-mf-text">
                                    <h4><i class="bi bi-geo-alt-fill text-accent me-2"></i>Find Us On The Map</h4>
                                    <p>{{ $address ?: 'Click the button to view our location on Google Maps.' }}</p>
                                </div>
                                <a href="{{ $mapLink }}" target="_blank" rel="noopener" class="btn-directions">
                                    <i class="bi bi-geo-alt-fill"></i> Get Directions
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif
    </main>

    <script>
        (function() {
            document.addEventListener('DOMContentLoaded', function() {
                var form = document.getElementById('cuContactForm');
                if (!form) return;

                var mobile = document.getElementById('cu-mobile');
                if (mobile) {
                    mobile.addEventListener('input', function() {
                        this.value = this.value.replace(/\D/g, '').slice(0, 10);
                    });
                }

                var btn = document.getElementById('cuSubmitBtn');
                var btnLabel = btn.querySelector('.cu-submit-label');

                $('#cuContactForm').on('submit', function(e) {
                    e.preventDefault();
                    $('#cuContactForm .text-danger').text('');
                    btn.disabled = true;
                    btnLabel.textContent = 'Sending...';

                    $.ajax({
                        url: "{{ route('home.contactus.store') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === true) {
                                toastr.success(response.message ||
                                    'Your message has been sent!');
                                form.reset();
                            } else if (response.status === false && response.errors) {
                                $.each(response.errors, function(key, value) {
                                    $('#cuContactForm .' + key + '_error').text(
                                        value[0]);
                                });
                                toastr.error('Please fix the errors below.');
                            }
                        },
                        error: function() {
                            toastr.error('Something went wrong. Please try again.');
                        },
                        complete: function() {
                            btn.disabled = false;
                            btnLabel.textContent = 'Send Message';
                        }
                    });
                });
            });
        })();
    </script>
@endsection
