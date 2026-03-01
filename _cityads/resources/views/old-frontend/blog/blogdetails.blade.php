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
                        {{ $blogdetails->title }}
                    </h2>
                    <ul class="p-0 m-0 list-unstyled text-white">
                        <li class="d-inline-block position-relative">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            <a href="{{ route('home') }}">
                                Blog
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            Blog Details
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
        
        <!-- Blog Details -->
        <div class="blog-details-area ptb-150">
            <div class="container">
                <div class="blog-details-info mx-auto text-center">
                    <h3 class="text-uppercase">
                        {{ $blogdetails->title }}
                    </h3>
                    <p>
                      {{ $blogdetails->short_description }} 
                    </p>
                    <ul class="info p-0 mb-0 list-unstyled">
                        <li class="d-inline-block position-relative">
                            <img src="{{asset('webtheme/assets/images/icons/calendar.svg')}}" alt="calendar">
                            {{ date('M d, Y', strtotime($blogdetails->created_at)) }}
                        </li>
                        <li class="d-inline-block position-relative">
                             {{ $blogdetails->category->category_name  }}
                        </li>
                    </ul>
                </div>
                <div class="blog-details-image mx-auto text-center">
                    <img src="{{ $blogdetails->image ? asset('img/'.$blogdetails->image) : asset('assets/img/placeholder-image-3.jpg') }}" alt="blog-details-image">
                </div>
                <div class="blog-details-desc mx-auto">
                    <h3 class="text-uppercase">
                       {{ $blogdetails->short_description }}
                    </h3>
                    <p>
                       {!!  $blogdetails->description  !!}
                    </p>
                   
                </div>
                
               
            </div>
        </div>
        <!-- End Blog Details -->


        @endsection