@extends('frontend.layout.app')
@section('content')

 <!-- Page Banner -->
        <div class="page-banner-area">
            <div class="container">
                <div
                    class="page-banner-inner-area text-center position-relative z-1"
                    style="background-image: url(webtheme/assets/images/page-banner-bg.webp);"
                >
                    <h2 class="text-uppercase text-white text_animation">
                        About Us
                    </h2>
                    <ul class="p-0 m-0 list-unstyled text-white">
                        <li class="d-inline-block position-relative">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            About Us
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
        
        <!-- Let's Collaborate -->
        <div class="lets-collaborate-area ptb-150">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="lets-collaborate-content text_animation">
                            <h3 class="mb-0 fw-light">
                                We create unique <img src="{{asset('webtheme/assets/images/woman-on-smile.jpg')}}" alt="woman-on-smile"> strategies to elevate brands and craft impactful designs.
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="lets-collaborate-info">
                            <a href="{{ route('contactus') }}" class="primary-btn d-inline-block fw-medium text-uppercase">
                                <div class="d-flex align-items-center justify-content-center">
                                    Let’s Collaborate
                                    <img src="{{asset('webtheme/assets/images/users/user1.jpg')}}" class="rounded-circle" alt="user-image">
                                </div>
                            </a>
                            <br>
                            <a href="{{ route('contactus') }}" class="link-btn d-inline-block position-relative">
                                / Discover Our Services <img src="{{asset('webtheme/assets/images/icons/arrow-down.svg')}}" alt="arrow-down">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Let's Collaborate -->
        
        <!-- About Us -->
        <div class="about-area ptb-150 bg-050505">
            <div class="container">
                <div class="about-image text-center">
                    <img src="{{asset('webtheme/assets/images/about.jpg')}}" alt="about-image">
                </div>
                <div class="about-content">
                    <div class="row align-items-end">
                        <div class="col-xl-8 col-md-7">
                            <p>
                                Billboard advertising is a highly effective marketing tool that helps businesses boost visibility and connect with their target audience, making it an essential strategy for impactful promotion. Billboard advertising is a powerful marketing tool that helps businesses gain visibility and effectively reach their target audience.
                            </p>
                        </div>
                        <div class="col-xl-4 col-md-5">
                            <div class="about-box position-relative">
                                <a href="https://www.youtube.com/watch?v=ObKsCs5mYGQ" class="video-btn text-center d-inline-block popup-video rounded-circle">
                                    <i class="ri-play-fill"></i>
                                </a>
                                <h3 class="text-uppercase text_animation">
                                    The digital cybsecure the transfor
                                </h3>
                                <a href="{{ route('contactus') }}" class="primary-btn d-inline-block fw-medium text-uppercase">
                                    <span class="d-inline-block position-relative">
                                        Contact Us
                                        <img src="{{asset('webtheme/assets/images/icons/bold-right-arrow.svg')}}" alt="bold-right-arrow">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Us -->
        
        <!-- Funfacts -->
        <div class="funfacts-area pt-150 pb-125">
            <div class="container">
                <div class="funfacts-title">
                    <h2 class="mb-0 text-uppercase text_animation">
                        Work Info
                    </h2>
                </div>
                <div class="funfacts-list d-flex justify-content-between" data-cues="slideInUp" data-group="funfactsList">
                    <div class="funfact-item">
                        <h3 class="lh-1">
                            <span class="count-number">
                                150
                            </span>
                            +
                        </h3>
                        <span class="d-block">
                            Project Completed
                        </span>
                    </div>
                    <div class="funfact-item">
                        <h3 class="lh-1">
                            <span class="count-number">
                                12
                            </span>
                            M+
                        </h3>
                        <span class="d-block">
                            Weekly Impressions
                        </span>
                    </div>
                    <div class="funfact-item">
                        <h3 class="lh-1">
                            <span class="count-number">
                                200
                            </span>
                            K+
                        </h3>
                        <span class="d-block">
                            Screens Place
                        </span>
                    </div>
                    <div class="funfact-item">
                        <h3 class="lh-1">
                            <span class="count-number">
                                49
                            </span>
                            +
                        </h3>
                        <span class="d-block">
                            Country Cover
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Funfacts -->
        
        <!-- Testimonials -->
        <div class="testimonials-area ptb-150 bg-f7f7f7">
            <div class="container">
                <div class="section-title style-two">
                    <div class="row align-items-center">
                        <div class="col-xxl-5 col-lg-6">
                            <span class="sub-title d-block">
                                Testimonials
                            </span>
                            <h2 class="mb-0 text-uppercase text_animation">
                                Hear what our clients say about us
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="testimonials-content text-center">
                            <img src="{{asset('webtheme/assets/images/icons/ico.svg')}}" alt="ico">
                            <h3 class="text-uppercase mx-auto">
                                Helping the <br class="d-none d-xl-block">world with creative advertising.
                            </h3>
                            <div class="ratings">
                                <div class="lh-1 d-flex align-items-center justify-content-center">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                </div>
                                <span class="d-block">
                                    (40+ reviews)
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="testimonials-slides owl-carousel owl-theme">
                            <div class="testimonial-item">
                                <div class="quote lh-1">
                                    <i class="ri-double-quotes-l"></i>
                                </div>
                                <p>
                                    “Lorem ipsum dolor sit temame tconsectetur adipis cingelit seddo eiusmod fugiat irurte mpor incidi dunt ut labo dolore magna aliqua 
                                    et dolore magna aliqua.”
                                </p>
                                <div class="user-info d-flex align-items-center">
                                    <img src="{{asset('webtheme/assets/images/users/user1.jpg')}}" class="rounded-circle" alt="user-image">
                                    <div>
                                        <h3 class="fw-light">
                                            Kristin Watson
                                        </h3>
                                        <span class="d-block">
                                            Operations Manager
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <div class="quote lh-1">
                                    <i class="ri-double-quotes-l"></i>
                                </div>
                                <p>
                                    “Lorem ipsum dolor sit temame tconsectetur adipis cingelit seddo eiusmod fugiat irurte mpor incidi dunt ut labo dolore magna aliqua 
                                    et dolore magna aliqua.”
                                </p>
                                <div class="user-info d-flex align-items-center">
                                    <img src="{{asset('webtheme/assets/images/users/user1.jpg')}}" class="rounded-circle" alt="user-image">
                                    <div>
                                        <h3 class="fw-light">
                                            Johnny Jhon
                                        </h3>
                                        <span class="d-block">
                                            Co-Founder
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <div class="quote lh-1">
                                    <i class="ri-double-quotes-l"></i>
                                </div>
                                <p>
                                    “Lorem ipsum dolor sit temame tconsectetur adipis cingelit seddo eiusmod fugiat irurte mpor incidi dunt ut labo dolore magna aliqua 
                                    et dolore magna aliqua.”
                                </p>
                                <div class="user-info d-flex align-items-center">
                                    <img src="{{asset('webtheme/assets/images/users/user1.jpg')}}" class="rounded-circle" alt="user-image">
                                    <div>
                                        <h3 class="fw-light">
                                            Emily Johnson
                                        </h3>
                                        <span class="d-block">
                                            Creative Director
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Testimonials -->
        
        <!-- Partners -->
        <div class="partners-area ptb-150">
            <div class="container">
                <div class="partners-section-title">
                    <h2 class="fw-light text_animation">
                        Recognized as a leader by those in the know
                    </h2>
                    <p>
                        Year after year, Cityads has been counted among best-in-class companies by the industry’s most respected institutions.
                    </p>
                </div>
                <div class="row align-items-center justify-content-center row-cols-3 row-cols-sm-4 row-cols-md-5 row-cols-lg-8">
                    <div class="col">
                        <div class="partner-item">
                            <img src="{{asset('webtheme/assets/images/partners/partner1.svg')}}" alt="partner-image">
                        </div>
                    </div>
                    <div class="col">
                        <div class="partner-item">
                            <img src="{{asset('webtheme/assets/images/partners/partner1.svg')}}" alt="partner-image">
                        </div>
                    </div>
                    <div class="col">
                        <div class="partner-item">
                            <img src="{{asset('webtheme/assets/images/partners/partner1.svg')}}" alt="partner-image">
                        </div>
                    </div>
                    <div class="col">
                        <div class="partner-item">
                            <img src="{{asset('webtheme/assets/images/partners/partner1.svg')}}" alt="partner-image">
                        </div>
                    </div>
                    <div class="col">
                        <div class="partner-item">
                            <img src="{{asset('webtheme/assets/images/partners/partner1.svg')}}" alt="partner-image">
                        </div>
                    </div>
                    <div class="col">
                        <div class="partner-item">
                            <img src="{{asset('webtheme/assets/images/partners/partner1.svg')}}" alt="partner-image">
                        </div>
                    </div>
                    <div class="col">
                        <div class="partner-item">
                            <img src="{{asset('webtheme/assets/images/partners/partner1.svg')}}" alt="partner-image">
                        </div>
                    </div>
                    <div class="col">
                        <div class="partner-item">
                            <img src="{{asset('webtheme/assets/images/partners/partner1.svg')}}" alt="partner-image">
                        </div>
                    </div>
                </div>
                <form class="contact-box">
                    <div class="row g-0 align-items-end">
                        <div class="col-lg-8">
                            <div class="contact-form">
                                <h3 class="text-uppercase text_animation">
                                    Contact us
                                </h3>
                                <div class="row g-0">
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control shadow-none rounded-0" placeholder="Your name">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control shadow-none rounded-0" placeholder="Your email">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control shadow-none rounded-0" placeholder="Your number">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control shadow-none rounded-0" placeholder="Your area">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea class="form-control shadow-none rounded-0" placeholder="How can we help you?"></textarea>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="agree-with-privacy-policy d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="agreeWithPrivacyPolicy">
                                                <label class="form-check-label" for="agreeWithPrivacyPolicy">
                                                    I agree to the privacy policy and give my permission to process my personal data for the purposes specified in the Privacy Policy.
                                                </label>
                                            </div>
                                            <div class="bg-card"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="contact-form-button">
                                <button type="button" class="primary-btn text-start d-block w-100 fw-medium text-uppercase">
                                    <span class="d-block position-relative">
                                        Leave a message
                                        <img src="{{asset('webtheme/assets/images/icons/bold-right-arrow.svg')}}" alt="bold-right-arrow">
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Partners -->

        <!-- Team -->
        <div class="team-area bg-f7f7f7 position-relative z-1 ptb-150">
            <div class="container">
                <div class="section-title text-center mx-auto">
                    <h2 class="mb-0 text-uppercase text_animation">
                        MEET OUR EXPERT TEAM
                    </h2>
                </div>
                <div class="row justify-content-center">
                    @foreach ($teams as $team )
                        
                   
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-box text-center">
                            <div class="image position-relative">
                                <img src="{{ $team->image ? asset('img/'.$team->image) : asset('assets/img/placeholder-image-3.jpg') }}" alt="team-image">
                                <ul class="socials m-0 p-0 list-unstyled">
                                    <li>
                                        <a href="#" class="d-flex align-items-center justify-content-center rounded-circle">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex align-items-center justify-content-center rounded-circle">
                                            <i class="ri-twitter-x-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex align-items-center justify-content-center rounded-circle">
                                            <i class="ri-linkedin-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex align-items-center justify-content-center rounded-circle">
                                            <i class="ri-instagram-fill"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="content">
                                <h3 class="text-uppercase">
                                    {{ $team->name }}
                                </h3>
                                <span class="d-block">
                                    {{ $team->designation }}
                                </span>
                            </div>
                        </div>
                    </div>
                     @endforeach
                    
                </div>
                <div class="explore-more-btn text-center">
                    <a href="{{ route('team') }}" class="optional-btn d-inline-block">
                        <span class="d-inline-block position-relative">
                            Explore More <i class="ri-arrow-right-long-fill"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="shape-box1"></div>
            <div class="shape-box2"></div>
        </div>
        <!-- End Team -->




@endsection