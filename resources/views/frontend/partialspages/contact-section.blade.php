@php
    $ci = $contactInfo ?? null;
    $phone      = $ci->phone ?? '';
    $whatsapp   = $ci->whatsapp ?? '';
    $email      = $ci->email ?? '';
    $address    = $ci->address ?? '';
    $mapLink    = $ci->map_link ?? '';
@endphp

<section class="contact section" id="contact">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Get In Touch</h2>
            <p>Have questions or need to reach us? Our support team is available Monday through Saturday.
                Send us a message and we'll get back to you as soon as possible.</p>
        </div>
        <div class="row gy-5">
            <div class="col-lg-4" data-aos="fade-right">
                @if($address)
                    <div class="info-item">
                        <div class="icon-wrap"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h5>Our Location</h5>
                            <p>{!! nl2br(e($address)) !!}</p>
                        </div>
                    </div>
                @endif
                @if($phone || $whatsapp)
                    <div class="info-item">
                        <div class="icon-wrap"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <h5>Phone Numbers</h5>
                            <p>
                                @if($phone)
                                    Call: <a href="tel:{{ $phone }}" class="text-decoration-none">{{ $phone }}</a><br>
                                @endif
                                @if($whatsapp)
                                    WhatsApp: <a href="https://wa.me/{{ preg_replace('/\D/', '', $whatsapp) }}" target="_blank" class="text-decoration-none">{{ $whatsapp }}</a>
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
                @if($email)
                    <div class="info-item">
                        <div class="icon-wrap"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <h5>Email Address</h5>
                            <p><a href="mailto:{{ $email }}" class="text-decoration-none">{{ $email }}</a></p>
                        </div>
                    </div>
                @endif
                <div class="info-item">
                    <div class="icon-wrap"><i class="bi bi-clock-fill"></i></div>
                    <div>
                        <h5>Working Hours</h5>
                        <p>Mon – Fri: 9:00 AM – 7:00 PM<br>Sat: 10:00 AM – 5:00 PM</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="contact-form">
                    <h4 class="mb-4">Send Us a Message</h4>
                    <form id="frontendContactForm" novalidate>
                        @csrf
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Full Name" required>
                                <small class="text-danger name_error"></small>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Your Email Address" required>
                                <small class="text-danger email_error"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" style="font-weight:600;font-size:14px;">+91</span>
                                    <input type="tel" name="mobile" id="frontendContactMobile" class="form-control" placeholder="10-digit number" maxlength="10" inputmode="numeric" required>
                                </div>
                                <small class="text-danger mobile_error"></small>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                                <small class="text-danger subject_error"></small>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" rows="5" placeholder="Your Message or Question..."></textarea>
                                <small class="text-danger message_error"></small>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-submit">Send Message <i class="bi bi-send ms-1"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if($mapLink)
            <div class="mt-5 rounded-4 overflow-hidden" style="height:350px;box-shadow:0 10px 40px rgba(0,0,0,0.1);"
                data-aos="fade-up">
                <iframe src="{{ $mapLink }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        @endif
    </div>
</section>

<script>
    (function () {
        if (window.__frontendContactInit) return;
        window.__frontendContactInit = true;

        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('frontendContactForm');
            if (!form) return;

            var mobileInput = document.getElementById('frontendContactMobile');
            if (mobileInput) {
                mobileInput.addEventListener('input', function () {
                    this.value = this.value.replace(/\D/g, '').slice(0, 10);
                });
            }

            $('#frontendContactForm').on('submit', function (e) {
                e.preventDefault();
                $('.text-danger').text('');

                $.ajax({
                    url: "{{ route('home.contactus.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status === true) {
                            toastr.success(response.message || 'Message sent successfully!');
                            form.reset();
                        } else if (response.status === false && response.errors) {
                            $.each(response.errors, function (key, value) {
                                $('.' + key + '_error').text(value[0]);
                            });
                            toastr.error('Please fix the errors below.');
                        }
                    },
                    error: function () {
                        toastr.error('Something went wrong. Please try again.');
                    }
                });
            });
        });
    })();
</script>
