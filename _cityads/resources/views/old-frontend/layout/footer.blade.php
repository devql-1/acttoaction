   <!-- Footer -->
        <footer class="footer-area pt-150 position-relative z-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="footer-content">
                            <h2 class="mb-0 text-uppercase text-white text_animation">
                                Let's make it happen together.
                            </h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer-text">
                            <p class="text-white">
                                Billboard advertising is a powerful marketing tool that he businesses gain visibility and reach their target audience.
                            </p>
                            <a href="{{ route('contactus') }}" class="primary-btn d-inline-block fw-medium text-uppercase">
                                <span class="d-inline-block position-relative">
                                    Start a conversation
                                    <img src="{{asset('webtheme/assets/images/icons/black-bold-right-arrow.svg')}}" alt="black-bold-right-arrow">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="footer-socials-links text-center">
                    <a href="#" class="d-inline-block position-relative" target="_blank">
                        Email <img src="{{asset('webtheme/assets/images/icons/top-right-arrow.svg')}}" alt="top-right-arrow">
                    </a>
                    <a href="#" class="d-inline-block position-relative" target="_blank">
                        Instagram <img src="{{asset('webtheme/assets/images/icons/top-right-arrow.svg')}}" alt="top-right-arrow">
                    </a>
                    <a href="#" class="d-inline-block position-relative" target="_blank">
                        Twitter (X) <img src="{{asset('webtheme/assets/images/icons/top-right-arrow.svg')}}" alt="top-right-arrow">
                    </a>
                    <a href="#" class="d-inline-block position-relative" target="_blank">
                        LinkedIn <img src="{{asset('webtheme/assets/images/icons/top-right-arrow.svg')}}" alt="top-right-arrow">
                    </a>
                    <a href="#" class="d-inline-block position-relative" target="_blank">
                        Medium <img src="{{asset('webtheme/assets/images/icons/top-right-arrow.svg')}}" alt="top-right-arrow">
                    </a>
                    <a href="#" class="d-inline-block position-relative" target="_blank">
                        Spotify <img src="{{asset('webtheme/assets/images/icons/top-right-arrow.svg')}}" alt="top-right-arrow">
                    </a>
                </div>
                <div class="pt-150"></div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <a href="{{ route('home') }}" class="logo d-inline-block">
                                <img src="{{asset('img/'.get_setting('system_logo_black'))}}" alt="white-logo">
                            </a>
                            <ul class="footer-contact-info p-0 mb-0 list-unstyled text-white">
                                <li class="d-flex align-items-center">
                                    <div class="icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-phone-line"></i>
                                    </div>
                                    <div>
                                        <span class="d-block">
                                            Phone Number
                                        </span>
                                        <a href="tel:{{ $contactInfo->phone }}">
                                           {{ $contactInfo->phone }}
                                        </a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-mail-open-line"></i>
                                    </div>
                                    <div>
                                        <span class="d-block">
                                            Email
                                        </span>
                                        <a href="mailto:{{ $contactInfo->email }}">
                                            {{ $contactInfo->email }}
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <h3 class="text-uppercase fw-light text-white">
                                QUICK LINKS
                            </h3>
                            <ul class="custom-links p-0 mb-0 list-unstyled text-white">
                                <li>
                                    <a href="{{ route('service') }}">
                                        Service
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('project') }}">
                                        Project
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('aboutus') }}">
                                        About  us
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('gallery') }}">
                                        Gallery
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('blog') }}">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <h3 class="text-uppercase fw-light text-white">
                                Support
                            </h3>
                            <ul class="custom-links p-0 mb-0 list-unstyled text-white">
                                <li>
                                    <a href="{{ route('privacy') }}">
                                        Stock Info
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('privacy') }}">
                                        Financial
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('privacy') }}">
                                        Govermance
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('contactus') }}">
                                        Contact
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <h3 class="text-uppercase fw-light text-white">
                                Utility Pages
                            </h3>
                            <ul class="custom-links p-0 mb-0 list-unstyled text-white">
                                <li>
                                    <a href="{{ route('privacy') }}">
                                        Licenses
                                    </a>
                                </li>
                                <li>
                                    <a href="terms-conditions.html">
                                        Changelog
                                    </a>
                                </li>
                                <li>
                                    <a href="terms-conditions.html">
                                        Style Guide
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('privacy') }}">
                                        Privacy Policy
                                    </a>
                                </li>
                                <li>
                                    <a href="terms-conditions.html">
                                        Terms & Conditions
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="pb-125"></div>
                <div class="copyright-area">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <p class="text-white">
                                © <strong>Cityads</strong> 2025 | All Rights Reserved
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <ul class="mb-0 p-0 list-unstyled text-white">
                                <li class="d-inline-block position-relative">
                                    <a href="{{ route('privacy') }}">
                                        Privacy Policy
                                    </a>
                                </li>
                                <li class="d-inline-block position-relative">
                                    <a href="terms-conditions.html">
                                        Terms & conditions
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vector-shape">
                <img src="{{asset('webtheme/assets/images/vector.webp')}}" alt="vector">
            </div>
        </footer>
        <!-- End Footer -->