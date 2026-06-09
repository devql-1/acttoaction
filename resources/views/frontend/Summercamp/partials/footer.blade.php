<footer class="footer">
    @include('frontend.partialspages.contact-info')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <a href="{{ url('/') }}"><img src="{{ asset('img/logo/logo.png') }}"
                        alt="Threat Expert" style="height:40px;" /></a>
                <p class="brand-desc">Developing globally competent young performers through age-structured,
                    experiential, skill - based learning, supported by on-demand, personalised programs for academic
                    institutions and individual learners.</p>
                <p class="brand-desc">Office Visits :- Only Appointment Based</p>
                <div class="fc-item"><i class="bi bi-geo-alt-fill"></i>{{ $address }}</div>
                <div class="fc-item"><i class="bi bi-telephone-fill"></i><a href="tel:{{ $phoneDigits }}" style="color:#666">
                        Chat with us: {{ $phone ?: '+91 91191-18844, +91 91191-87311, +91 91191-87411' }}</a></div>
                <div class="fc-item"><i class="bi bi-clock-fill"></i>{{ implode('<br>', $workingHours) }}</div>
            </div>
            <div class="col-lg-8 footer-nav-wrap">
                <div class="row">
                    <div class="col-6 col-md-3 mb-4">
                        <h6>Quick Links</h6>
                        <ul class="fn-list">
                            <li><a href="{{ route('threat-academy') }}">Admissions</a></li>
                            <li><a href="{{ route('threat-academy') }}">Courses</a></li>
                            <li><a href="{{ route('event') }}">Events</a></li>
                            <li><a href="{{ route('volunteer') }}">Join Us</a></li>
                            <li><a href="{{ route('frontend.blog.index') }}">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h6>Cyber AI Threat Conclave</h6>
                        <ul class="fn-list">
                            <li><a href="#about">About</a></li>
                            <li><a href="#gallery">Gallery</a></li>
                            <li><a href="#speakers">Speakers</a></li>
                            <li><a href="#dignitaries">Dignitaries</a></li>
                            <li><a href="#register">Register 2026</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h6>Legal</h6>
                        <ul class="fn-list">
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms') }}">Terms</a></li>
                            <li><a href="{{ route('refund') }}">Refund Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h6>Follow Us</h6>
                        <ul class="fn-list">
                            <li>
                                <a href="https://www.instagram.com/threatexpert_" target="_blank">
                                    <i class="bi bi-instagram me-2"></i>Instagram
                                </a>
                            </li>

                            <li>
                                <a href="https://youtube.com/@acttoaction-21?si=Qz1Or7FLOiVJDVtv" target="_blank">
                                    <i class="bi bi-youtube me-2"></i>YouTube Act To Action
                                </a>
                            </li>

                            <li>
                                <a href="https://x.com/ThreatXpert" target="_blank">
                                    <i class="bi bi-twitter-x me-2"></i>X (Twitter)
                                </a>
                            </li>

                            <li>
                                <a href="https://www.facebook.com/threatexpert/" target="_blank">
                                    <i class="bi bi-facebook me-2"></i>Facebook
                                </a>
                            </li>

                            <li>
                                <a href="https://www.linkedin.com/company/threatexpert/" target="_blank">
                                    <i class="bi bi-linkedin me-2"></i>LinkedIn
                                </a>
                            </li>

                            <li>
                                <a href="https://www.twitch.tv/threatexpert_" target="_blank">
                                    <i class="bi bi-twitch me-2"></i>Twitch
                                </a>
                            </li>

                            <li>
                                <a href="https://chat.whatsapp.com/F4tpTdMQCKlJ6CuBXJivXs?mode=gi_t" target="_blank">
                                    <i class="bi bi-whatsapp me-2"></i>WhatsApp Community (Volunteers)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>©2025 All Rights Reserved · <span>Act To Action</span></p>
            <div class="legal-links">
                <a href="{{ route('privacy') }}">Privacy</a>
                <a href="{{ route('terms') }}">Terms</a>
                <a href="{{ route('refund') }}">Refund</a>
                <span class="credits">Template: <a href="https://bootstrapmade.com" target="_blank"
                        style="color:var(--accent)">BootstrapMade</a></span>
            </div>
        </div>
    </div>
</footer>
