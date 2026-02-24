
 <!-- Preloader -->
        <div class="preloader position-fixed top-0 start-0 end-0 bottom-0 text-center">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div>
                    <div class="loader mx-auto"></div>
                    <br>
                    <img class="signage-logo" src="{{asset('img/'.get_setting('system_logo_white'))}}" alt="logo">
                    <img class="signage-logo d-none" src="{{asset('img/'.get_setting('system_logo_white'))}}"  alt="white-logo">
                </div>
            </div>
        </div>
        <!-- End Preloader -->


        <!-- Top Header -->
        <div class="top-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="top-header-info">
                            <ul class="list-unstyled p-0 mb-0">
                                {{-- <li class="position-relative d-inline-block">
                                    <img src="{{asset('webtheme/assets/images/icons/location.svg')}}" alt="location">
                                    {{ $contactInfo->address }}
                                </li> --}}
                                <li class="position-relative d-inline-block">
                                    <img  src="{{asset('webtheme/assets/images/icons/email.svg')}}" alt="email">
                                    <a href="mailto:{{ $contactInfo->email }}">
                                       {{ $contactInfo->email }}
                                    </a>
                                </li>
                                <li class="position-relative d-inline-block">
                                    <img src="{{asset('webtheme/assets/images/icons/call.svg')}}" alt="call">
                                    <a href="tel:{{ $contactInfo->phone }}">
                                        {{ $contactInfo->phone }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top-header-socials d-flex align-items-center justify-content-center justify-content-lg-end">
                            <a href="#" target="_blank" class="rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-instagram-fill"></i>
                            </a>
                            <a href="#" target="_blank" class="rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-linkedin-fill"></i>
                            </a>
                            <a href="#" target="_blank" class="rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-twitter-x-fill"></i>
                            </a>
                            <a href="#" target="_blank" class="rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-facebook-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Header -->
        
        <style>
            .signage-logo {
                width: 100px;
                border-radius: 50%;
                padding: 5px;
            }
        </style>

        <!-- Navbar -->
        <div class="navbar-area" id="navbarArea">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img class="signage-logo" src="{{asset('img/'.get_setting('system_logo_white'))}}" alt="logo">
                    </a>
                    <a class="navbar-brand d-none" href="{{route('home')}}">
                        <img class="signage-logo" src="{{asset('img/'.get_setting('system_logo_white'))}}" alt="white-logo">
                    </a>
                    <button class="navbar-toggler shadow-none p-0 border-0" type="button">
                        <span class="toggler-menu">
                            <span class="d-block"></span>
                            <span class="d-block"></span>
                            <span class="d-block"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item position-relative">
                                <a class="nav-link position-relative dropdown-toggle active" href="{{ route('home') }}">
                                    Home
                                </a>
                                {{-- <ul class="dropdown-menu border-0 d-block text-start rounded-0">
                                    <li class="nav-item position-relative">
                                        <a href="index.html" class="nav-link position-relative active">
                                            Main Home
                                        </a>
                                    </li>
                                    <li class="nav-item position-relative">
                                        <a href="index-2.html" class="nav-link position-relative">
                                            Outdoor Advertising Home
                                        </a>
                                    </li>
                                    <li class="nav-item position-relative">
                                        <a href="index-3.html" class="nav-link position-relative">
                                            Billboard Agency Home
                                        </a>
                                    </li>
                                    <li class="nav-item position-relative">
                                        <a href="index-4.html" class="nav-link position-relative">
                                            Ads Listing Home
                                        </a>
                                    </li>
                                </ul> --}}
                            </li>
                            <li class="nav-item position-relative">
                                <a class="nav-link position-relative dropdown-toggle" href="{{ route('service') }}">
                                    Services
                                </a>
                                {{-- <ul class="dropdown-menu border-0 d-block text-start rounded-0">
                                    <li class="nav-item position-relative">
                                        <a href="{{ route('service') }}" class="nav-link position-relative">
                                            Services
                                        </a>
                                    </li>
                                    <li class="nav-item position-relative">
                                        <a href="# class="nav-link position-relative">
                                            Service Details
                                        </a>
                                    </li>
                                </ul> --}}
                            </li>
                            <li class="nav-item position-relative">
                                <a class="nav-link position-relative dropdown-toggle" href="{{ route('project') }}">
                                    Projects
                                </a>
                                {{-- <ul class="dropdown-menu border-0 d-block text-start rounded-0">
                                    <li class="nav-item position-relative">
                                        <a href="projects.html" class="nav-link position-relative">
                                            Projects
                                        </a>
                                    </li>
                                    <li class="nav-item position-relative">
                                        <a href="projects-2.html" class="nav-link position-relative">
                                            Projects 2
                                        </a>
                                    </li>
                                    <li class="nav-item position-relative">
                                        <a href="project-details.html" class="nav-link position-relative">
                                            Project Details
                                        </a>
                                    </li>
                                </ul> --}}
                            </li>
                            <li class="nav-item position-relative">
                                <a class="nav-link position-relative dropdown-toggle" href="{{ route('aboutus') }}">
                                    About Us
                                </a>
                            </li>
                            <li class="nav-item position-relative">
                                <a class="nav-link position-relative dropdown-toggle" href="{{ route('gallery') }}">
                                    Gallery
                                </a>
                            </li>
                            
                        
                            <li class="nav-item position-relative">
                                <a class="nav-link position-relative dropdown-toggle" href="{{ route('blog') }}">
                                    Blog
                                </a>
                            </li>
                            <li class="nav-item position-relative">
                                <a class="nav-link position-relative dropdown-toggle" href="{{ route('contactus') }}">
                                    Contact Us
                                </a>
                                {{-- <ul class="dropdown-menu border-0 d-block text-start rounded-0">
                                    <li class="nav-item position-relative">
                                        <a href="contact.html" class="nav-link position-relative">
                                            Contact Us
                                        </a>
                                    </li>
                                    <li class="nav-item position-relative">
                                        <a href="contact-2.html" class="nav-link position-relative">
                                            Contact Us 2
                                        </a>
                                    </li>
                                </ul> --}}
                            </li>
                        </ul>
                        <div class="nav-alternatives d-flex align-items-center">
                            {{-- <div class="item position-relative">
                                <button type="button" class="search-btn p-0 bg-transparent border-0 lh-1 transition" id="searchBtn">
                                    <i class="ri-search-2-line"></i>
                                </button>
                                <div class="search-box transition">
                                    <h3 class="text-uppercase">
                                        What are You Looking For?
                                    </h3>
                                    <form>
                                        <input type="text" class="form-control shadow-none rounded-0" placeholder="Search...">
                                        <button type="submit" class="p-0 bg-transparent border-0 lh-1 transition">
                                            <i class="ri-search-2-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </div> --}}
                            {{-- <div class="item">
                                <button type="button" class="menu-btn fw-light position-relative bg-transparent border-0 lh-1 transition">
                                    Menu <i class="ri-bar-chart-horizontal-line"></i>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    <button type="button" class="light-dark-btn d-inline-block p-0 bg-transparent border-0 lh-1" id="light-dark-btn">
                        <i class="ri-sun-line"></i>
                    </button>
                </nav>
            </div>
        </div>
        <!-- End Navbar -->
        
        <!-- Start Menu Popup Area -->
        <div class="menu-popup-area position-fixed start-0 end-0 top-0 bottom-0">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-12">
                                <div class="meanu-popup-nav">
                                    <div class="accordion" id="navbarAccordion">
                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                            <a href="{{ route('home') }}">
                                                <button class="accordion-button d-block w-100 shadow-none position-relative text-decoration-none bg-transparent fw-semibold collapsed active" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapseOne" aria-expanded="false" aria-controls="navbarCollapseOne">
                                                Home
                                            </button>
                                            </a>
                                            {{-- <div id="navbarCollapseOne" class="accordion-collapse collapse" data-bs-parent="#navbarAccordion">
                                                <div class="accordion-body">
                                                    <div class="accordion">
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a class="accordion-link fw-medium text-decoration-none active" href="index.html">
                                                                Main Home
                                                            </a>
                                                        </div>
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a class="accordion-link fw-medium text-decoration-none" href="index-2.html">
                                                                Outdoor Advertising Home
                                                            </a>
                                                        </div>
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a class="accordion-link fw-medium text-decoration-none" href="index-3.html">
                                                                Billboard Agency Home
                                                            </a>
                                                        </div>
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a class="accordion-link fw-medium text-decoration-none" href="index-4.html">
                                                                Ads Listing Home
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                            <a href="{{ route('service') }}">
                                                <button class="accordion-button d-block w-100 shadow-none position-relative text-decoration-none bg-transparent fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapseTwo" aria-expanded="false" aria-controls="navbarCollapseTwo">
                                                Services
                                            </button>
                                            </a>
                                            {{-- <div id="navbarCollapseTwo" class="accordion-collapse collapse" data-bs-parent="#navbarAccordion">
                                                <div class="accordion-body">
                                                    <div class="accordion">
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a href="services.html" class="accordion-link fw-medium text-decoration-none">
                                                                Services
                                                            </a>
                                                        </div>
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a href="service-details.html" class="accordion-link fw-medium text-decoration-none">
                                                                Service Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                            <a href="{{ route('project') }}">
                                                <button class="accordion-button d-block w-100 shadow-none position-relative text-decoration-none bg-transparent fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapseThree" aria-expanded="false" aria-controls="navbarCollapseThree">
                                                Projects
                                            </button>
                                            </a>
                                            
                                        </div>
                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                            <a href="{{ route('aboutus') }}">
                                                <button class="accordion-button d-block w-100 shadow-none position-relative text-decoration-none bg-transparent fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapseThree" aria-expanded="false" aria-controls="navbarCollapseThree">
                                                About Us
                                            </button>
                                            </a>
                                        </div>

                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                            <a href="{{ route('gallery') }}">
                                                <button class="accordion-button d-block w-100 shadow-none position-relative text-decoration-none bg-transparent fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapseThree" aria-expanded="false" aria-controls="navbarCollapseThree">
                                                Gallery
                                            </button>
                                            </a>
                                        </div>
                                        
                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                            <a href="{{ route('blog') }}">
                                                <button class="accordion-button d-block w-100 shadow-none position-relative text-decoration-none bg-transparent fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapseFive" aria-expanded="false" aria-controls="navbarCollapseFive">
                                                Blog
                                            </button>
                                            </a>
                                            {{-- <div id="navbarCollapseFive" class="accordion-collapse collapse" data-bs-parent="#navbarAccordion">
                                                <div class="accordion-body">
                                                    <div class="accordion">
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a href="blog.html" class="accordion-link fw-medium text-decoration-none">
                                                                Blog List
                                                            </a>
                                                        </div>
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a href="blog-2.html" class="accordion-link fw-medium text-decoration-none">
                                                                Blog Grid
                                                            </a>
                                                        </div>
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a href="blog-details.html" class="accordion-link fw-medium text-decoration-none">
                                                                Blog Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                            <a href="{{ route('contactus') }}">
                                                <button class="accordion-button d-block w-100 shadow-none position-relative text-decoration-none bg-transparent fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapseSix" aria-expanded="false" aria-controls="navbarCollapseSix">
                                                Contact
                                            </button>
                                            </a>
                                            {{-- <div id="navbarCollapseSix" class="accordion-collapse collapse" data-bs-parent="#navbarAccordion">
                                                <div class="accordion-body">
                                                    <div class="accordion">
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a href="contact.html" class="accordion-link fw-medium text-decoration-none">
                                                                Contact Us
                                                            </a>
                                                        </div>
                                                        <div class="accordion-item border-0 rounded-0 bg-transparent">
                                                            <a href="contact-2.html" class="accordion-link fw-medium text-decoration-none">
                                                                Contact Us 2
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="menu-contact-info">
                                    <div class="location">
                                        <h5>
                                            {{ get_setting('website_name') }}
                                        </h5>
                                        <p>
                                            {{-- {{ $contactInfo->address }} --}}
                                        </p>
                                    </div>
                                    <h4>
                                        {{ $contactInfo->email }}
                                    </h4>
                                    <div class="socials">
                                        <a href="#" class="d-inline-block" target="_blank">
                                            <i class="ri-facebook-circle-fill"></i>
                                        </a>
                                        <a href="#" class="d-inline-block" target="_blank">
                                            <i class="ri-instagram-line"></i>
                                        </a>
                                        <a href="#" class="d-inline-block" target="_blank">
                                            <i class="ri-threads-line"></i>
                                        </a>
                                        <a href="#" class="d-inline-block" target="_blank">
                                            <i class="ri-twitter-x-line"></i>
                                        </a>
                                        <a href="#" class="d-inline-block" target="_blank">
                                            <i class="ri-youtube-fill"></i>
                                        </a>
                                    </div>
                                    <div class="menu-popup-search-box d-lg-none">
                                        <h3 class="text-uppercase">
                                            What are You Looking For?
                                        </h3>
                                        <form>
                                            <input type="text" class="form-control shadow-none rounded-0" placeholder="Search...">
                                            <button type="submit" class="p-0 bg-transparent border-0 lh-1 transition">
                                                <i class="ri-search-2-line"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="menu-popup-close-btn position-absolute rounded-circle text-center border-0 p-0">
                <i class="ri-close-line"></i>
            </button>
        </div>
        <!-- End Menu Popup Area -->