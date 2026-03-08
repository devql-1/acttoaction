 @extends('frontend.course.layout')
 @section('content')
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 data-aos="fade-right" data-aos-delay="300">
                            Excellence in <span class="highlight">Acting</span> With Professional Guidance
                        </h1>
                        <p class="hero-description" data-aos="fade-right" data-aos-delay="400">
                            Discover your true potential on stage and screen. Our expert-led acting courses are
                            designed to transform beginners into confident performers and refine the skills of
                            experienced actors.
                        </p>
                        <div class="hero-stats mb-4" data-aos="fade-right" data-aos-delay="500">
                            <div class="stat-item">
                                <h3><span data-purecounter-start="0" data-purecounter-end="12"
                                        data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                <p>Years Experience</p>
                            </div>
                            <div class="stat-item">
                                <h3><span data-purecounter-start="0" data-purecounter-end="3800"
                                        data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                <p>Students Trained</p>
                            </div>
                            <div class="stat-item">
                                <h3><span data-purecounter-start="0" data-purecounter-end="40"
                                        data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                <p>Expert Instructors</p>
                            </div>
                        </div>
                        <div class="hero-actions" data-aos="fade-right" data-aos-delay="600">
                            <a href="appointment.html" class="btn btn-primary">Enroll Now</a>
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-outline glightbox">
                                <i class="bi bi-play-circle me-2"></i>Watch Our Story
                            </a>
                        </div>
                        <div class="emergency-contact" data-aos="fade-right" data-aos-delay="700">
                            <div class="emergency-icon"><i class="bi bi-telephone-fill"></i></div>
                            <div class="emergency-info">
                                <small>Admissions Hotline</small>
                                <strong>+1 (555) 911-2468</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                        <div class="main-image">
                            <img src="{{ asset('courseassets/img/health/staff-10.webp') }}" alt="Acting Performance"
                                class="img-fluid" />
                        </div>
                    </div>
                    <div class="background-elements">
                        <div class="element element-1"></div>
                        <div class="element element-2"></div>
                        <div class="element element-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Hero Section -->

    <!-- Home About Section -->
    <section id="home-about" class="home-about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                    <div class="about-content">
                        <h2 class="section-heading">Passionate Training, Professional Results</h2>
                        <p class="lead-text">
                            For over a decade, we've been dedicated to nurturing performing artists who combine
                            raw talent with disciplined craft and the courage to tell real stories.
                        </p>
                        <p>
                            Our faculty of working professionals collaborates closely with every student to unlock
                            their unique voice. From foundational technique to advanced scene study, we maintain
                            the highest standards of artistic excellence while fostering a bold and supportive
                            creative environment.
                        </p>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-number purecounter" data-purecounter-start="0"
                                    data-purecounter-end="3800" data-purecounter-duration="1"></div>
                                <div class="stat-label">Students Trained</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number purecounter" data-purecounter-start="0"
                                    data-purecounter-end="12" data-purecounter-duration="1"></div>
                                <div class="stat-label">Years of Excellence</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number purecounter" data-purecounter-start="0"
                                    data-purecounter-end="40" data-purecounter-duration="1"></div>
                                <div class="stat-label">Expert Instructors</div>
                            </div>
                        </div>
                        <div class="cta-section">
                            <a href="about.html" class="btn-primary">Learn More About Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="about-visual">
                        <div class="main-image">
                            <img src="{{ asset('courseassets/img/health/facilities-9.webp') }}" alt="Acting studio"
                                class="img-fluid" />
                        </div>
                        <div class="floating-card">
                            <div class="card-content">
                                <div class="icon"><i class="bi bi-heart-pulse"></i></div>
                                <div class="card-text">
                                    <h4>Open Rehearsal Studios</h4>
                                    <p>Available every day for all students</p>
                                </div>
                            </div>
                        </div>
                        <div class="experience-badge">
                            <div class="badge-content">
                                <span class="years">12+</span>
                                <span class="text">Years of Trusted Training</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Home About Section -->

    <!-- Featured Courses Section -->
    <section id="featured-departments" class="featured-departments section">

        <div class="container section-title" data-aos="fade-up">
            <h2>Offerings</h2>
            <p>Explore our most popular categories designed for all skill levels — from beginners to working
                professionals</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-5">

                @forelse($categories as $cat)

                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">

                        <div class="specialty-card">

                            <div class="specialty-content">

                                <div class="specialty-meta">
                                    <span class="specialty-label">
                                        {{ $cat->name ?? 'Category' }}
                                    </span>
                                </div>

                                @if($cat->description)
                                    {!! $cat->description !!}
                                @endif

                                <a href="#!" class="specialty-link">
                                    Explore Category <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                            <div class="specialty-visual">
                                <img src="{{ asset('courseassets/img/health/cardiology-1.webp') }}"
                                    alt="{{ $cat->name }}" class="img-fluid">

                                <div class="visual-overlay">
                                    <i class="bi bi-grid"></i>
                                </div>
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12 text-center text-muted py-5">
                        <i class="bi bi-folder-x" style="font-size:3rem; opacity:0.3; display:block;"></i>
                        <p class="mt-3">No categories available.</p>
                    </div>

                @endforelse

            </div>

        </div>

    </section>
    <!-- /Featured Courses Section -->

    <!-- All Courses Section -->
    <section id="all-courses" class="featured-services section">
        <div class="container section-title" data-aos="fade-up">
            <h2>All Courses</h2>
            <p>Browse our complete catalog across all categories</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            {{-- Category Tabs with count --}}
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
                <button class="btn btn-sm btn-outline-primary all-tab active" onclick="filterAll('all', this)">
                    All <span class="badge ms-1"
                        style="background:var(--accent-color);">{{ $allCourses->count() }}</span>
                </button>
                @foreach($categories as $cat)
                    <button class="btn btn-sm btn-outline-primary all-tab" data-cat-id="{{ $cat->id }}"
                        onclick="filterAll({{ $cat->id }}, this)">
                        {{ $cat->name }}
                        <span class="badge ms-1"
                            style="background:var(--accent-color);">{{ $cat->courses->count() }}</span>
                    </button>
                @endforeach
            </div>

            <div class="specialties-grid">
                <div class="row g-4 align-items-stretch" id="allCourseGrid">
                    @forelse($allCourses as $course)
                        <div class="col-lg-3 col-md-6 all-course-item" data-category="{{ $course->category_id }}">
                            <div class="specialty-card h-100">
                                <div class="specialty-image">
                                    <img src="{{ asset('courseassets/img/health/cardiology-1.webp') }}"
                                        alt="{{ $course->title }}" class="img-fluid" loading="lazy" />
                                </div>
                                <div class="specialty-content">
                                    @if($course->category)
                                        <span
                                            style="font-size:11px; font-weight:700; color:var(--accent-color); text-transform:uppercase; letter-spacing:0.5px; display:block; margin-bottom:6px;">
                                            {{ $course->category->name }}
                                        </span>
                                    @endif
                                    <h5>{{ $course->title }}</h5>
                                    <span>
                                        @if($course->fees > 0)
                                            &#8377;{{ number_format($course->fees, 2) }}
                                        @else
                                            <span style="color:#22c55e; font-weight:700;">Free</span>
                                        @endif
                                        @if($course->duration)
                                            &nbsp;&bull;&nbsp;{{ $course->duration }}
                                        @endif
                                    </span>
                                    <div class="mt-2">
                                        <a href="#!" class="specialty-link" style="font-size:13px;">
                                            Enroll Now <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5">
                            <i class="bi bi-journal-x" style="font-size:3rem; opacity:0.3; display:block;"></i>
                            <p class="mt-3">No courses available yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="#!" class="btn-view-all">
                    View All Courses <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>
    </section>
    <!-- /All Courses Section -->

    <!-- Featured Programs Section -->
    <section id="featured-services" class="featured-services section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>Featured Programs</h2>
            <p>From beginner workshops to professional intensives — every program is crafted by working industry
                artists</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-0">
                <div class="col-lg-8" data-aos="fade-right" data-aos-delay="200">
                    <div class="featured-service-main">
                        <div class="service-image-wrapper">
                            <img src="{{ asset('courseassets/img/health/consultation-4.webp') }}"
                                alt="Acting Programs" class="img-fluid" loading="lazy" />
                            <div class="service-overlay">
                                <div class="service-badge">
                                    <i class="bi bi-camera-video"></i>
                                    <span>Screen Acting</span>
                                </div>
                            </div>
                        </div>
                        <div class="service-details">
                            <h2>Comprehensive Performance Training</h2>
                            <p>Our programs are built on a foundation of proven technique and forward-thinking
                                practice. We give students the tools, space, and challenge to discover who they
                                truly are as artists.</p>
                            <a href="#!" class="main-cta">Explore Our Programs</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
                    <div class="services-sidebar">
                        <div class="service-item" data-aos="fade-up" data-aos-delay="400">
                            <div class="service-icon-wrapper"><i class="bi bi-film"></i></div>
                            <div class="service-info">
                                <h4>On-Camera Workshop</h4>
                                <p>Intensive on-camera sessions focused on audition technique, self-taping, and
                                    commercial acting for TV and film.</p>
                                <a href="#!" class="service-link">Learn More</a>
                            </div>
                        </div>
                        <div class="service-item" data-aos="fade-up" data-aos-delay="500">
                            <div class="service-icon-wrapper"><i class="bi bi-mask"></i></div>
                            <div class="service-info">
                                <h4>Scene Study Lab</h4>
                                <p>Deep scene work exploring subtext, character relationships, and emotional truth
                                    in contemporary and classical scripts.</p>
                                <a href="#!" class="service-link">Learn More</a>
                            </div>
                        </div>
                        <div class="service-item" data-aos="fade-up" data-aos-delay="600">
                            <div class="service-icon-wrapper"><i class="bi bi-person-badge"></i></div>
                            <div class="service-info">
                                <h4>Industry Showcase</h4>
                                <p>Showcases attended by casting directors, agents, and producers from major studios
                                    and professional theatres.</p>
                                <a href="#!" class="service-link">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Featured Programs Section -->

    <!-- Find An Instructor Section -->
    <section id="courses" class="find-a-doctor section">

        <div class="container section-title" data-aos="fade-up">
            <h2>Our Courses</h2>
            <p>Explore our professional acting and performance courses designed by industry experts</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <!-- CATEGORY FILTER -->
            <div class="text-center mb-4">

                <button class="btn btn-outline-primary filter-btn" data-filter="all">
                    All
                </button>

                @foreach($categories as $cat)
                    <button class="btn btn-outline-primary filter-btn" data-filter="{{ $cat->id }}">
                        {{ $cat->name }}
                    </button>
                @endforeach

            </div>


            <div class="doctors-grid" data-aos="fade-up" data-aos-delay="300">

                @foreach($allCourses as $course)

                    <div class="doctor-profile course-card" data-category="{{ $course->category_id }}"
                        data-aos="zoom-in">
                        <div class="profile-header">

                            <div class="doctor-avatar">
                                <img src="{{ asset($course->banner_image) }}" class="img-fluid"
                                    alt="{{ $course->title }}">
                            </div>
                            <div class="doctor-details">

                                <h4>{{ $course->title }}</h4>

                                <!-- CATEGORY LABEL -->
                                <span class="specialty-tag">
                                    {{ $course->category->name ?? 'Course' }}
                                </span>

                                <div class="experience-info">
                                    <i class="bi bi-clock"></i>
                                    <span>{{ $course->duration ?? 'Course Duration' }}</span>
                                </div>

                            </div>

                        </div>

                        <div class="rating-section">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>

                            <span class="rating-score">
                                {{ $course->rating ?? '4.5' }}
                            </span>

                            <span class="review-count">
                                ({{ $course->students ?? '0' }} students)
                            </span>
                        </div>

                        <div class="action-buttons">
                            <a href="#" class="btn-secondary">
                                Course Details
                            </a>

                            <a href="#" class="btn-primary">
                                Enroll Now
                            </a>
                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>
    <!-- /Find An Instructor Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="hero-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content-wrapper" data-aos="fade-up" data-aos-delay="200">
                            <h1>Excellence in Performing Arts, Every Day</h1>
                            <p>Whether you're stepping on stage for the first time or deepening your professional
                                craft — StageLight Academy has a program that will challenge and inspire you to
                                grow.</p>
                            <div class="cta-wrapper">
                                <a href="appointment.html" class="primary-cta"><span>Enroll Today</span><i
                                        class="bi bi-arrow-right"></i></a>
                                <a href="services.html" class="secondary-cta"><span>Explore Programs</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="image-container" data-aos="fade-left" data-aos-delay="300">
                            <img src="{{ asset('courseassets/img/health/facilities-9.webp') }}"
                                alt="Acting Excellence" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="features-section">
                <div class="row g-0">
                    <div class="col-lg-4">
                        <div class="feature-block" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-icon"><i class="bi bi-camera-video"></i></div>
                            <h3>Professional Studios</h3>
                            <p>Industry-standard black box theatre, sound stage, and dedicated rehearsal rooms
                                available to all enrolled students.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="feature-block" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-icon"><i class="bi bi-clock"></i></div>
                            <h3>Flexible Schedules</h3>
                            <p>Morning, evening, and weekend intensives designed to fit around working adults,
                                students, and full-time performers.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="feature-block" data-aos="fade-up" data-aos-delay="400">
                            <div class="feature-icon"><i class="bi bi-people"></i></div>
                            <h3>Industry Connections</h3>
                            <p>Regular showcases attended by casting directors, agents, and producers from major
                                studios and professional theatres.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-block">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="contact-content" data-aos="fade-up" data-aos-delay="200">
                            <h2>Ready to Start Your Acting Journey?</h2>
                            <p>Our admissions team is available Monday to Saturday to guide you through course
                                selection, enrollment, and everything you need to get started.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-actions" data-aos="fade-up" data-aos-delay="300">
                            <a href="tel:5551234567" class="emergency-call"><i
                                    class="bi bi-telephone"></i><span>(555) 123-4567</span></a>
                            <a href="contact.html" class="contact-link">Find Our Studio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Call To Action Section -->

</main>

 @endsection
