<style>
    .logo img {
        height: 120px;
    }
</style>
<header id="header" class="header fixed-top">
    <div class="topbar d-flex align-items-center dark-background">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center">
                    <a href="mailto:info@acttoaction.com">info@acttoaction.com</a>
                </i>
                <i class="bi bi-whatsapp d-flex align-items-center ms-4">
                    <span>+91-91191-92811</span>
                    <span>+91-91191-82511 </span>
                </i>
            </div>
            {{-- <div class="social-links d-none d-md-flex align-items-center">
                <a href="#!" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#!" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#!" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#!" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div> --}}
        </div>
    </div>

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <div class="logo">
                    <img src="{{ asset('img/logo/IMG_6008.PNG') }}" alt="ActToAction Logo">
                </div>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('index.course') }}"
                            class="{{ request()->routeIs('index.course') ? 'active' : '' }}">
                            Course
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('event') }}" class="{{ request()->routeIs('event') ? 'active' : '' }}">
                            Event
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('aboutus') }}" class="{{ request()->is('aboutus') ? 'active' : '' }}">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.tests') }}"
                            class="{{ request()->routeIs('frontend.tests') ? 'active' : '' }}">
                            Skill Assessment
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('volunteer') }}"
                            class="{{ request()->routeIs('volunteer') ? 'active' : '' }}">
                            Join Us
                        </a>
                    </li>



                    <!-- Dropdown -->
                    {{-- <li class="dropdown">
                        <a href="#"><span>More Pages</span><i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="department-details.html">Course Details</a></li>
                            <li><a href="service-details.html">Program Details</a></li>
                            <li><a href="appointment.html">Enrollment</a></li>
                            <li><a href="testimonials.html">Testimonials</a></li>
                            <li><a href="faq.html">Frequently Asked Questions</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li><a href="terms.html">Terms</a></li>
                            <li><a href="privacy.html">Privacy</a></li>
                            <li><a href="404.html">404</a></li>
                        </ul>
                    </li> --}}

                    {{-- <li>
                        <a href="contact.html" class="{{ request()->is('contact.html') ? 'active' : '' }}">
                            Contact
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('summercamp') }}"
                            class="{{ request()->routeIs('summercamp') ? 'active' : '' }}"
                            style="
            background: var(--accent-color);
            color: #fff;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
       ">
                            Summer-Camp
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
</header>
