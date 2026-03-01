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
                        Projects
                    </h2>
                    <ul class="p-0 m-0 list-unstyled text-white">
                        <li class="d-inline-block position-relative">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="d-inline-block position-relative">
                            Projects
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
        
        <!-- Projects -->
        <div class="projects-area ptb-150">
            <div class="container">
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
                <nav class="pagination-area">
                    <ul class="pagination p-0 align-items-center justify-content-center">
                        <li class="page-item">
                            <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('project') }}">
                                <i class="ri-arrow-left-long-line"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link active d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('project') }}">
                                1
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('project') }}">
                                2
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('project') }}">
                                3
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link d-flex align-items-center justify-content-center shadow-none rounded-circle p-0" href="{{ route('project') }}">
                                <i class="ri-arrow-right-long-line"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Projects -->
        



@endsection