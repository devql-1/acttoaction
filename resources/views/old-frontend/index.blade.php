@extends('frontend.layout.app')
@section('content')
   
<!-- Banner -->
        <div class="banner-area pb-150">
            <div class="container">
                <div class="banner-content" data-cue="slideInUp">
                    <div class="title position-relative lh-1 d-flex align-items-center text-uppercase fw-medium">
                        Bi
                        <div class="position-relative">
                            <img src="{{asset('webtheme/assets/images/banners/banner1.jpg')}}" alt="banner1-image">
                            <a href="https://www.youtube.com/watch?v=ObKsCs5mYGQ" class="video-btn popup-video d-flex align-items-center justify-content-center rounded-circle text-uppercase fw-medium">
                                Play
                            </a>
                        </div>
                        <span>
                            llboard
                        </span>
                        <span class="tag1 fw-semibold text-uppercase d-inline-block">
                            Advertising
                        </span>
                        <span class="tag2 fw-semibold text-uppercase d-inline-block">
                            Billboard
                        </span>
                    </div>
                    <div class="title2 position-relative lh-1 d-flex align-items-center text-uppercase fw-medium">
                        <div class="position-relative">
                            <img src="{{asset('webtheme/assets/images/banners/banner1.jpg')}}" alt="banner-image">
                        </div>
                        Advertising
                        <span class="tag fw-semibold text-uppercase d-inline-block">
                            Marketing
                        </span>
                    </div>
                    <div class="banner-text">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <p>
                                    Billboard advertising is an effective marketing strategy that helps businesses increase visibility and connect with their target audience.
                                </p>
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                <a href="{{ route('contactus') }}" class="primary-btn d-inline-block fw-medium text-uppercase">
                                    <span class="d-inline-block position-relative">
                                        Start a conversation
                                        <img src="{{asset('webtheme/assets/images/icons/bold-right-arrow.svg')}}" alt="bold-right-arrow">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-image d-lg-none">
                    <div class="image position-relative">
                        <img src="{{asset('webtheme/assets/images/banners/banner1.jpg')}}" alt="banner-image">
                        <a href="https://www.youtube.com/watch?v=ObKsCs5mYGQ" class="video-btn popup-video d-flex align-items-center justify-content-center rounded-circle text-uppercase fw-medium">
                            Play
                        </a>
                    </div>
                    <div class="image position-relative">
                        <img src="{{asset('webtheme/assets/images/banners/banner2.jpg')}}" alt="banner-image">
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner -->
        
        <!-- Features -->
        <div class="features-area">
            <div class="container">
                <div class="section-title text-center mx-auto">
                    <span class="sub-title d-block">
                        Together, We Transform
                    </span>
                    <h2 class="mb-0 text-uppercase text_animation">
                        Make a Big Impression with Powerful Billboards
                    </h2>
                </div>
                <div class="features-list d-lg-flex">
                    <div class="feature-item position-relative overflow-hidden transition">
                        <div class="title transition d-flex align-items-center text-center h-100 z-1 position-relative cursor-pointer">
                            <div class="icon">
                                <img src="{{asset('webtheme/assets/images/icons/tv.svg')}}" alt="tv">
                            </div>
                            <span class="text-uppercase fw-semibold">
                                Exposure Express
                            </span>
                        </div>
                        <div class="details transition">
                            <div class="bg-image" style="background-image: url(webtheme/assets/images/features/feature1.jpg);"></div>
                            <div class="content">
                                <img src="{{asset('webtheme/assets/images/icons/white-tv.svg')}}" alt="white-tv">
                                <h3 class="mb-0 text-uppercase">
                                    Exposure Express
                                </h3>
                            </div>
                            <div class="text">
                                <p>
                                    Billboard advertising is a powerful marketing tool that he businesses gain visibility and reach their target audience Billboard advertising is a powerful marketing tool
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="feature-item position-relative overflow-hidden transition">
                        <div class="title transition d-flex align-items-center text-center h-100 z-1 position-relative cursor-pointer">
                            <div class="icon">
                                <img src="{{asset('webtheme/assets/images/icons/tv.svg')}}" alt="tv">
                            </div>
                            <span class="text-uppercase fw-semibold">
                                Billboard Advantage
                            </span>
                        </div>
                        <div class="details transition">
                            <div class="bg-image" style="background-image: url(webtheme/assets/images/features/feature1.jpg);"></div>
                            <div class="content">
                                <img src="{{asset('webtheme/assets/images/icons/white-tv.svg')}}" alt="white-tv">
                                <h3 class="mb-0 text-uppercase">
                                    Billboard Advantage
                                </h3>
                            </div>
                            <div class="text">
                                <p>
                                    Billboard advertising is a powerful marketing tool that he businesses gain visibility and reach their target audience Billboard advertising is a powerful marketing tool
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="feature-item position-relative overflow-hidden transition active">
                        <div class="title transition d-flex align-items-center text-center h-100 z-1 position-relative cursor-pointer">
                            <div class="icon">
                                <img src="{{asset('webtheme/assets/images/icons/tv.svg')}}" alt="tv">
                            </div>
                            <span class="text-uppercase fw-semibold">
                                Prime Billboard Services
                            </span>
                        </div>
                        <div class="details transition">
                            <div class="bg-image" style="background-image: url(webtheme/assets/images/features/feature3.jpg);"></div>
                            <div class="content">
                                <img src="{{asset('webtheme/assets/images/icons/white-tv.svg')}}" alt="white-tv">
                                <h3 class="mb-0 text-uppercase">
                                    Prime Billboard Services
                                </h3>
                            </div>
                            <div class="text">
                                <p>
                                    Billboard advertising is a powerful marketing tool that he businesses gain visibility and reach their target audience Billboard advertising is a powerful marketing tool
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="feature-item position-relative overflow-hidden transition">
                        <div class="title transition d-flex align-items-center text-center h-100 z-1 position-relative cursor-pointer">
                            <div class="icon">
                                <img src="{{asset('webtheme/assets/images/icons/tv.svg')}}" alt="tv">
                            </div>
                            <span class="text-uppercase fw-semibold">
                                Hoarding Board
                            </span>
                        </div>
                        <div class="details transition">
                            <div class="bg-image" style="background-image: url(webtheme/assets/images/features/feature1.jpg);"></div>
                            <div class="content">
                                <img src="{{asset('webtheme/assets/images/icons/white-tv.svg')}}" alt="white-tv">
                                <h3 class="mb-0 text-uppercase">
                                    Hoarding Board
                                </h3>
                            </div>
                            <div class="text">
                                <p>
                                    Billboard advertising is a powerful marketing tool that he businesses gain visibility and reach their target audience Billboard advertising is a powerful marketing tool
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Features -->
        
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
                            <a href="#services" class="link-btn d-inline-block position-relative">
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
                                <a href="{{ route('aboutus') }}" class="primary-btn d-inline-block fw-medium text-uppercase">
                                    <span class="d-inline-block position-relative">
                                        About Us
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
        
        <!-- Services -->
        

<div class="services-area pb-150 position-relative" id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title text-center position-sticky">
                    <span class="sub-title d-block">Our Services</span>
                    <h2 class="mb-0 text-uppercase text_animation">
                        Empowering brands through creativity.
                    </h2>
                </div>
            </div>
<style>


.want_dark {
    opacity: var(--swiper-pagination-bullet-opacity, 1);
    background: #e80303;
}

</style>
            <div class="col-lg-7">
                <div class="swiper services-slider">
                    <div class="swiper-wrapper">
                        @foreach ($services as $service)
                            <div class="swiper-slide">
                                <div class="service-item position-relative">
                                    <a href="{{ route('servicedetails', $service->slug) }}" class="image d-block overflow-hidden">
                                        <img src="{{ $service->image ? asset('img/' . $service->image) : asset('assets/img/placeholder-image-3.jpg') }}" alt="service-image">
                                    </a>
                                    {{-- <div class="arrow">
                                        <img src="{{ asset('webtheme/assets/images/icons/right-round-arrow.svg') }}" alt="right-round-arrow">
                                    </div> --}}
                                    <div class="content position-relative">
                                        
                                        <h3 class="text-uppercase position-relative mt-3 d-inline-block">
                                            <a href="{{ route('servicedetails', $service->slug) }}">
                                                {{ $service->title }}
                                            </a>
                                            <span class="d-inline-block">Marketing</span>
                                        </h3>
                                        <p>{{ $service->short_description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="swiper-pagination mt-3"></div>

                </div>
            </div>
        </div>
    </div>
</div>



        <div class="view-all-services-btn transition bg-050505 fw-medium position-relative text-uppercase">
            <div class="container">
                <div class="d-lg-flex align-items-center justify-content-between">
                    View all Services
                    <img src="{{asset('webtheme/assets/images/icons/bold-right-arrow.svg')}}" alt="bold-right-arrow">
                </div>
            </div>
            <a href="{{ route('service') }}" class="position-absolute start-0 end-0 top-0 bottom-0 z-1"></a>
        </div>
        <!-- End Services -->
        
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
                <form class="contact-box ajaxForms" action="{{ route('home.contactus.store') }}" method="POST">
                    <div class="row g-0 align-items-end">
                        <div class="col-lg-8">
                            <div class="contact-form">
                                <h3 class="text-uppercase text_animation">
                                    Contact us
                                </h3>
                                 <div class="row g-0">
                                 <div class="col-lg-6">
                                     <input type="text" name="name" class="form-control shadow-none rounded-0"
                                         placeholder="Your name">
                                     <span class="text-danger error-text name_error"></span>
                                 </div>
                                 <div class="col-lg-6">
                                     <input type="text" name="email" class="form-control shadow-none rounded-0"
                                         placeholder="Your email">
                                     <span class="text-danger error-text email_error"></span>
                                 </div>
                                 <div class="col-lg-6">
                                     <input type="text" name="mobile" class="form-control shadow-none rounded-0"
                                         placeholder="Your number">
                                     <span class="text-danger error-text mobile_error"></span>
                                 </div>
                                 <div class="col-lg-6">
                                     <input type="text" name="subject" class="form-control shadow-none rounded-0"
                                         placeholder="Your area">
                                     <span class="text-danger error-text subject_error"></span>
                                 </div>
                                 <div class="col-lg-12">
                                     <textarea name="message" class="form-control shadow-none rounded-0" placeholder="How can we help you?"></textarea>
                                 </div>
                                 <div class="col-lg-12">
                                     <div
                                         class="agree-with-privacy-policy d-flex align-items-center justify-content-between">
                                         <div class="form-check">
                                             <input class="form-check-input" type="checkbox" id="agreeWithPrivacyPolicy">
                                             <label class="form-check-label" for="agreeWithPrivacyPolicy">
                                                 I agree to the privacy policy and give my permission to process my personal
                                                 data for the purposes specified in the Privacy Policy.
                                             </label>
                                         </div>
                                         <div class="bg-card"></div>
                                     </div>
                                 </div>
                             </div>
                            </div>
                        </div>

                         <div class="form-group">
                         <div id="successMsg" class="alert alert-success d-none mt-2"></div>
                     </div>

                        <div class="col-lg-4">
                            <div class="contact-form-button">
                                <button type="submit" class="primary-btn text-start d-block w-100 fw-medium text-uppercase">
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
        
        <!-- Projects -->
        <div class="projects-area pb-150">
            <div class="container">
                <div class="section-title style-two">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <span class="sub-title d-block">
                                Our Projects
                            </span>
                            <h2 class="mb-0 text-uppercase text_animation">
                                Building trust through exceptional work
                            </h2>
                        </div>
                        <div class="col-lg-6">
                            <div class="text">
                                <p>
                                    Billboard advertising is a powerful marketing tool that he businesses gain visibility and reach their target audience.
                                </p>
                                <a href="{{ route('project') }}" class="primary-btn d-inline-block fw-medium text-uppercase">
                                    <span class="d-inline-block position-relative">
                                        Our Works
                                        <img src="{{asset('webtheme/assets/images/icons/bold-right-arrow.svg')}}" alt="bold-right-arrow">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="project-item">
                    <a href="{{ route('projectdetails') }}" class="image d-block text-center overflow-hidden">
                        <img src="{{asset('webtheme/assets/images/projects/project1.webp')}}" alt="project-image">
                    </a>
                    <div class="content">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <h3 class="text-uppercase mb-0">
                                <a href="{{ route('projectdetails') }}">
                                    Outdoor The Most Advertising
                                </a>
                            </h3>
                            <div class="tags">
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Advertising
                                </a>
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Billboard
                                </a>
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Marketing
                                </a>
                            </div>
                        </div>
                        <p>
                            Billboard advertising is a powerful marketing tool that businesses use to gain visibility.
                        </p>
                    </div>
                </div>
                <div class="project-item">
                    <a href="{{ route('projectdetails') }}" class="image d-block text-center overflow-hidden">
                        <img src="{{asset('webtheme/assets/images/projects/project1.webp')}}" alt="project-image">
                    </a>
                    <div class="content">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <h3 class="text-uppercase mb-0">
                                <a href="{{ route('projectdetails') }}">
                                    Creative Billboard Campaign
                                </a>
                            </h3>
                            <div class="tags">
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Billboard
                                </a>
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Campaign
                                </a>
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Creative
                                </a>
                            </div>
                        </div>
                        <p>
                            Creative billboard campaigns boost brand visibility and audience reach.
                        </p>
                    </div>
                </div>
                <div class="project-item">
                    <a href="{{ route('projectdetails') }}" class="image d-block text-center overflow-hidden">
                        <img src="{{asset('webtheme/assets/images/projects/project1.webp')}}" alt="project-image">
                    </a>
                    <div class="content">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <h3 class="text-uppercase mb-0">
                                <a href="{{ route('projectdetails') }}">
                                    Innovative Billboard Solutions
                                </a>
                            </h3>
                            <div class="tags">
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Solutions
                                </a>
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Billboard
                                </a>
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Innovative
                                </a>
                            </div>
                        </div>
                        <p>
                            Innovative billboards use creativity and technology to boost brand exposure.
                        </p>
                    </div>
                </div>
                <div class="project-item">
                    <a href="{{ route('projectdetails') }}" class="image d-block text-center overflow-hidden">
                        <img src="{{asset('webtheme/assets/images/projects/project1.webp')}}" alt="project-image">
                    </a>
                    <div class="content">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <h3 class="text-uppercase mb-0">
                                <a href="{{ route('projectdetails') }}">
                                    Modern Billboard Innovations
                                </a>
                            </h3>
                            <div class="tags">
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Digital
                                </a>
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Creative
                                </a>
                                <a href="{{ route('project') }}" class="text-uppercase">
                                    Agency
                                </a>
                            </div>
                        </div>
                        <p>
                            Modern billboards use digital tech and creative design for greater impact.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Projects -->
        
        <!-- Testimonials -->
        <div class="testimonials-area ptb-150 bg-f7f7f7">
            <div class="container">
                <div class="section-title style-two">
                    <div class="row align-items-center">
                        <div class=" text-center col-xxl-10 col-lg-12">
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
        
        <!-- Blog -->
        <div class="blog-area ptb-150">
            <div class="container">
                <div class="section-title style-two">
                    <div class="row align-items-center">
                        <div class="col-xxl-12 col-lg-12">
                            <span class="sub-title d-block">
                                Latest News
                            </span>
                            <h2 class="mb-0 text-uppercase text_animation">
                                Your Go-To Hub for Ideas, Inspiration, & Advice.
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="blog-posts-list">

                    @foreach ($blogs as $blog )
                        
                    
                    <div class="blog-post position-relative">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="content">
                                    <ul class="info p-0 m-0 list-unstyled">
                                        <li class="d-inline-block position-relative">
                                            <img src="{{asset('webtheme/assets/images/icons/calendar.svg')}}" alt="calendar">
                                            {{ date('M d, Y', strtotime($blog->created_at)) }}
                                        </li>
                                        {{-- <li class="d-inline-block position-relative">
                                            <img src="{{asset('webtheme/assets/images/icons/clock.svg')}}" alt="clock">
                                            1 min read
                                        </li> --}}
                                    </ul>
                                    <h3 class="text-uppercase mb-0">
                                        <a href="{{ route('blogdetails',$blog->slug) }}">
                                            {{ $blog->title  }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <a href="{{ route('blogdetails',$blog->slug) }}" class="image transition position-relative d-block">
                                    <img src="{{ $blog->image ? asset('img/'.$blog->image) : asset('assets/img/placeholder-image-3.jpg') }}" alt="blog-image">
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('blogdetails',$blog->slug) }}" class="link-btn fw-medium d-inline-block text-uppercase">
                            Read More
                            <img src="{{asset('webtheme/assets/images/icons/primary-right-arrow.svg')}}" alt="primary-right-arrow">
                        </a>
                    </div>
                   @endforeach
                </div>
            </div>
        </div>
        <!-- End Blog -->
        
@endsection

       



