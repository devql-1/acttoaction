@extends('frontend.layout.app')
@section('content')
  
  <!-- Page Banner -->
        <div class="page-banner-area">
            <div class="container">
                <div
                    class="page-banner-inner-area style-two position-relative z-1"
                    style="background-image: url(webtheme/assets/images/page-banner-bg.webp);"
                >
                    <h2 class="text-uppercase text-white text_animation">
                        Our Blog
                    </h2>
                    <ul class="p-0 m-0 list-unstyled text-white">
                        <li class="d-inline-block position-relative">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            Our Blog
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
        
        <!-- Blog -->
        <div class="insights-area ptb-150">
            <div class="container style-two">
                <div class="section-title text-center mx-auto">
                    <span class="sub-title text-primary d-block">
                        Latest Updated
                    </span>
                    <h2 class="mb-0 text-uppercase text_animation">
                        Insights to Inspire Your Advertising Journey
                    </h2>
                </div>
                <div class="row">

                     
 <div class="row col-lg-8 col-md-8">
    
@foreach ($blogs as $blog )
    

    <div class="col-lg-6 col-md-6">
        <div class="insight-post-item">
            <a href="{{ route('blogdetails',$blog->slug) }}" class="image position-relative d-block overflow-hidden">
                <img src="{{ $blog->image ? asset('img/'.$blog->image) : asset('assets/img/placeholder-image-3.jpg') }}" alt="blog-image">
                <i class="ri-arrow-right-long-fill"></i>
            </a>
            <div class="content">
                <ul class="info m-0 list-unstyled">
                    <li class="d-inline-block position-relative">
                        <img src="{{asset('webtheme/assets/images/icons/calendar.svg')}}" alt="calendar">
                        {{ date('M d, Y', strtotime($blog->created_at)) }}
                    </li>
                    <li class="d-inline-block position-relative">
                        <img src="{{asset('webtheme/assets/images/icons/clock.svg')}}" alt="clock">
                        2 mins read
                    </li>
                </ul>
                <h3 class="text-uppercase mb-0">
                    <a href="{{ route('blogdetails',$blog->slug) }}">
                        {{ $blog->title }}
                    </a>
                </h3>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="col-lg-4">
 <div class="service-details-sidebar ">
    <div class="sidebar-services-list">
    <div class="search-box transition">
 <form>
    <input type="text" class="form-control shadow-none rounded-0" placeholder="Search any blog...">
    <button type="submit" class="p-0 bg-transparent border-0 lh-1 transition">
                                           
  </button>
  </form>
</div>
</div>
 <div class="sidebar-services-list">
  <h3 class="text-uppercase">
      Blogs category
  </h3>

   <ul class="p-0 m-0 list-unstyled">
        @foreach ($blogcategories as $blogcategory )
       <li>
           <a href="#" class="d-block w-100">
               {{ $blogcategory->category_name }}
           </a>
       </li>
      @endforeach
                                  
                                </ul>
                            </div>
                        </div>
                    </div>






                    <div class="col-lg-12 col-md-12">
                        <nav class="pagination-area style-two">
                            <ul class="pagination p-0 align-items-center justify-content-center">
                                <li class="page-item">
                                    <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="blog-2.html">
                                        <i class="ri-arrow-left-long-line"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link active d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="blog-2.html">
                                        1
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="blog-2.html">
                                        2
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="blog-2.html">
                                        3
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="blog-2.html">
                                        <i class="ri-arrow-right-long-line"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>



            </div>
        </div>
        <!-- End Blog -->


@endsection