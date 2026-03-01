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
                        A vertical traditional
                    </h2>
                    <ul class="p-0 m-0 list-unstyled text-white">
                        <li class="d-inline-block position-relative">
                            <a href="index.html">
                                Home
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            <a href="projects.html">
                                Projects
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            Project Details
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
        
        <!-- Project Details -->
        <div class="project-details-area ptb-150">
            <div class="container">
                <div class="project-details-image text-center">
                    <img src="{{asset('webtheme/assets/images/projects/project-details.webp')}}" alt="project-details-image">
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="project-details-desc">
                            <h3 class="text-uppercase">
                                Project overview
                            </h3>
                            <p>
                                Aliquam eros justo, posuere loborti viverra lao ullamcorper posuere viverra. Aliquam eros justo, posuere lobortis non, viverra laoreet augue mattis start fermentum ullamcor viverra laoreet.
                            </p>
                            <ul class="custom-list p-0 list-unstyled">
                                <li class="position-relative">
                                    <img src="{{asset('webtheme/assets/images/icons/primary-right-arrow2.svg')}}" alt="primary-right-arrow">
                                    Amplify Your Brand’s Reach with Powerful Billboard Campaigns
                                </li>
                                <li class="position-relative">
                                    <img src="{{asset('webtheme/assets/images/icons/primary-right-arrow2.svg')}}" alt="primary-right-arrow">
                                    Boost Your Business Visibility and Dominate the Streets with Billboards
                                </li>
                                <li class="position-relative">
                                    <img src="{{asset('webtheme/assets/images/icons/primary-right-arrow2.svg')}}" alt="primary-right-arrow">
                                    Unlock Maximum Exposure with Billboard Advertising
                                </li>
                            </ul>
                            <p>
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using lorem ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use lorem ipsum as their default model text.
                            </p>
                            <p>
                                There are many variations of passages of lorem ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="project-details-sidebar">
                            <h3 class="text-uppercase">
                                Project Information
                            </h3>
                            <ul class="p-0 m-0 list-unstyled">
                                <li>
                                    <span>Category:</span> Business Consulting
                                </li>
                                <li>
                                    <span>Customer:</span> David Johnson
                                </li>
                                <li>
                                    <span>Start Date:</span> 28 September 2025
                                </li>
                                <li>
                                    <span>End Date:</span> 28 September 2025
                                </li>
                                <li>
                                    <span>Rating:</span>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Project Details -->


        @endsection