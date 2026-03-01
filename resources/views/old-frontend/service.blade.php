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
                        Services
                    </h2>
                    <ul class="p-0 m-0 list-unstyled text-white">
                        <li class="d-inline-block position-relative">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            Services
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Solutions -->
        <div class="solutions-area pt-150 pb-90">
            <div class="container">
                <div class="row justify-content-center">
   @foreach ($services as $service )
       <div class="col-lg-4 col-sm-6">
                        <div class="solution-item">
                            <div class="number d-flex align-items-center justify-content-center rounded-circle">
                                {{ $loop->iteration }}
                            </div>
                            <h3 class="text-uppercase">
                                <a href="{{ route('servicedetails',$service->slug) }}">
                                    <h4> {{ $service->title }} </h4>
                                </a>
                            </h3>
                            <p>
                                {{ $service->short_description }} 
                            </p>
                            <a href="{{ route('servicedetails',$service->slug) }}" class="image d-block text-center overflow-hidden">
                                <img src="{{ $service->image ? asset('img/'.$service->image) : asset('assets/img/placeholder-image-3.jpg') }}" alt="solution-image">
                            </a>
                        </div>
                    </div>
   @endforeach

                    



                    
                </div>
                <nav class="pagination-area mt-0">
                    <ul class="pagination p-0 align-items-center justify-content-center">
                        <li class="page-item">
                            <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('service') }}">
                                <i class="ri-arrow-left-long-line"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link active d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('service') }}">
                                1
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('service') }}">
                                2
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('service') }}">
                                3
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('service') }}">
                                <i class="ri-arrow-right-long-line"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Solutions -->


        @endsection