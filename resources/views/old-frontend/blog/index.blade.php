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

                     
 <div class="row col-lg-8 col-md-8" id="blogs-container">
    
{{-- box  --}}

@include('frontend.blog.partials.blogs_list',['blogs' => $blogs])




</div>
<div class="col-lg-4">
 <div class="service-details-sidebar ">
    <div class="sidebar-services-list">
    <div class="search-box transition">
 <form id="blog-search-form" class="search-form">
    <input type="text" id="blog-search-input" class="form-control shadow-none rounded-0" placeholder="Search any blog...">
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
    <li>
           <a href="javascript:void(0)" class="category-filter active d-block w-100" data-id="all">
               All <span>{{ \App\Models\Blog::where('status',1)->count() }}</span>
           </a>
           
       </li>
        @foreach ($blogcategories as $blogcategory )
       <li>
           <a href="javascript:void(0)" class="category-filter d-block w-100"  data-id="{{ $blogcategory->id }}">
               {{ $blogcategory->category_name }}  <span>{{ \App\Models\Blog::where('status',1)->where('category_id',$blogcategory->id)->count() }}</span>
           </a>
           
       </li>
      @endforeach
                                  
                                </ul>
                            </div>
                        </div>
                    </div>






                    <div class="col-lg-12 col-md-12" id="pagination-container">
                        @include('frontend.blog.partials.blogs_pagination',['blogs' => $blogs])
                    </div>
                </div>



            </div>
        </div>
        <!-- End Blog -->


@endsection