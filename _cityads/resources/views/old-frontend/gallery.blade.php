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
                        Gallery
                    </h2>
                    <ul class="p-0 m-0 list-unstyled text-white">
                        <li class="d-inline-block position-relative">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            Gallery
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
        
        <!-- Gallery -->
        <div class="gallery-area pt-150 pb-125">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6">
                        <a href="assets/images/gallery/gallery1.html" class="gallery-item d-block overflow-hidden popup-gallery">
                            <img src="{{asset('webtheme/assets/images/gallery/gallery1.webp')}}" alt="gallery-image">
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="assets/images/gallery/gallery2.html" class="gallery-item d-block overflow-hidden popup-gallery">
                            <img src="{{asset('webtheme/assets/images/gallery/gallery2.webp')}}" alt="gallery-image">
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="assets/images/gallery/gallery7.html" class="gallery-item d-block overflow-hidden popup-gallery">
                            <img src="{{asset('webtheme/assets/images/gallery/gallery7.webp')}}" alt="gallery-image">
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="assets/images/gallery/gallery3.html" class="gallery-item d-block overflow-hidden popup-gallery">
                            <img src="{{asset('webtheme/assets/images/gallery/gallery3.webp')}}" alt="gallery-image">
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="assets/images/gallery/gallery4.html" class="gallery-item d-block overflow-hidden popup-gallery">
                            <img src="{{asset('webtheme/assets/images/gallery/gallery4.webp')}}" alt="gallery-image">
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="assets/images/gallery/gallery5.html" class="gallery-item d-block overflow-hidden popup-gallery">
                            <img src="{{asset('webtheme/assets/images/gallery/gallery5.webp')}}" alt="gallery-image">
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="assets/images/gallery/gallery6.html" class="gallery-item d-block overflow-hidden popup-gallery">
                            <img src="{{asset('webtheme/assets/images/gallery/gallery7.webp')}}" alt="gallery-image">
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="assets/images/gallery/gallery8.html" class="gallery-item d-block overflow-hidden popup-gallery">
                            <img src="{{asset('webtheme/assets/images/gallery/gallery8.webp')}}" alt="gallery-image">
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="assets/images/gallery/gallery9.html" class="gallery-item d-block overflow-hidden popup-gallery">
                            <img src="{{asset('webtheme/assets/images/gallery/gallery9.webp')}}" alt="gallery-image">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Gallery -->




@endsection