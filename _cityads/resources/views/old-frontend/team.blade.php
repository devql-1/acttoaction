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
                        Our Team
                    </h2>
                    <ul class="p-0 m-0 list-unstyled text-white">
                        <li class="d-inline-block position-relative">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            Our Team
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Team -->
        <div class="team-area position-relative z-1 pt-150 pb-125">
            <div class="container style-two">
                <div class="section-title text-center mx-auto">
                    <h2 class="mb-0 text-uppercase text_animation">
                        MEET OUR Professional TEAM
                    </h2>
                </div>
                <div class="row justify-content-center">
                          @foreach ($teams as $team )
                              
                          
                    <div class="col-lg-4 col-sm-6">
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
            </div>
            <div class="shape-box1"></div>
            <div class="shape-box2"></div>
        </div>
        <!-- End Team -->




@endsection