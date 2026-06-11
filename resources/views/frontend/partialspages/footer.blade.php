<footer id="footer" class="footer-16 footer position-relative">
    @include('frontend.partialspages.contact-info')
    <div class="container">
        <div class="footer-main" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-start">

                <!-- Brand / About -->
                <div class="col-lg-4">
                    <div class="brand-section mb-4">
                        <a href="https://threatxpert.com" class="logo d-flex align-items-center mb-3">
                            <img src="{{ asset('img/logo/logo.png') }}" alt="Threat Expert" style="height:50px;">
                        </a>
                        <p class="brand-description">
                            Cyber Solutions<br>
                            Leading cybersecurity training institute providing world-class education and certification
                            programs.
                        </p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="col-lg-8">
                    <div class="footer-nav-wrapper">
                        <div class="row">

                            <!-- Company -->
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Company</h6>
                                    <nav class="footer-nav">
                                        <a href="https://threatxpert.com/company">About Us</a>
                                        <a href="https://threatxpert.com/contact">Contact Us</a>
                                    </nav>
                                </div>
                            </div>

                            <!-- Services -->
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Services</h6>
                                    <nav class="footer-nav">
                                        <a href="https://threatxpert.com/cotraining">Corporate Training</a>
                                        <a href="https://threatxpert.com/internship">Placement</a>
                                        <a href="https://threatxpert.com/events">Events</a>
                                        <a href="https://threatxpert.com/internship">Internship</a>
                                    </nav>
                                </div>
                            </div>

                            <!-- Legal -->
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Legal</h6>
                                    <nav class="footer-nav">
                                        <a href="{{ route('terms') }}">Terms of Service</a>
                                        <a href="{{ route('privacy') }}">Privacy Policy</a>
                                        <a href="{{ route('refund') }}">Cancellation Policy</a>
                                        <a href="{{ route('refund') }}">Refund Policy</a>
                                    </nav>
                                </div>
                            </div>

                            <!-- Support -->
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Support</h6>
                                    <nav class="footer-nav">
                                        <a href="https://threatxpert.com/contact">Support Center</a>
                                        <a href="https://threatxpert.com/contact">Security</a>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Copyright -->
            <div class="row mt-4 pt-3 border-top">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2026 Threat Expert Cyber Solutions PVT LTD. All rights reserved.</p>
                </div>
            </div>

        </div>
    </div>
</footer>
