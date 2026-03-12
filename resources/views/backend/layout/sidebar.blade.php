{{-- resources/views/backend/layout/sidebar.blade.php --}}

<div class="sidebar" data-background-color="dark">

    {{-- ── Logo ── --}}
    <div class="sidebar-logo pt-2">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin') }}" class="logo">
                <img src="{{ asset('img/' . get_setting('system_logo_black')) }}" class="navbar-brand rounded-3 bg-white"
                    width="110">
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                {{-- ══════════════════════════════════════════
                     DASHBOARD
                ══════════════════════════════════════════ --}}
                <li class="nav-item {{ request()->routeIs('admin') ? 'active' : '' }}">
                    <a href="{{ route('admin') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: CONTENT MANAGEMENT
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Content Management</h4>
                </li>

                {{-- Slider --}}
                <li class="nav-item {{ request()->routeIs('admin.slider') ? 'active' : '' }}">
                    <a href="{{ route('admin.slider') }}">
                        <i class="fas fa-sliders-h"></i>
                        <p>Slider</p>
                    </a>
                </li>

                {{-- About Us --}}
                <li class="nav-item {{ request()->routeIs('admin.about*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#about"
                        class="{{ request()->routeIs('admin.about*') ? '' : 'collapsed' }}">
                        <i class="fas fa-info-circle"></i>
                        <p>About Us</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.about*') ? 'show' : '' }}" id="about">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('admin.about') }}"><span class="sub-item">All About</span></a></li>
                            <li><a href="{{ route('admin.about-create') }}"><span class="sub-item">Add New</span></a>
                            </li>
                            <li><a href="{{ route('admin.about-category') }}"><span
                                        class="sub-item">Categories</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- Services --}}
                <li class="nav-item {{ request()->routeIs('admin.service*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#service"
                        class="{{ request()->routeIs('admin.service*') ? '' : 'collapsed' }}">
                        <i class="fas fa-cogs"></i>
                        <p>Services</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.service*') ? 'show' : '' }}" id="service">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('admin.service') }}"><span class="sub-item">All Services</span></a>
                            </li>
                            <li><a href="{{ route('admin.service-create') }}"><span class="sub-item">Add New</span></a>
                            </li>
                            <li><a href="{{ route('admin.service-category') }}"><span
                                        class="sub-item">Categories</span></a></li>
                            <li><a href="{{ route('admin.service-subcategory') }}"><span class="sub-item">Sub
                                        Categories</span></a></li>
                            <li><a href="{{ route('admin.service-faq') }}"><span class="sub-item">FAQs</span></a></li>
                            <li><a href="{{ route('admin.service-benefits') }}"><span
                                        class="sub-item">Benefits</span></a></li>
                            <li><a href="{{ route('admin.service-features') }}"><span
                                        class="sub-item">Features</span></a></li>
                            <li><a href="{{ route('admin.service-essentials') }}"><span
                                        class="sub-item">Essentials</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- Industry --}}
                <li class="nav-item {{ request()->routeIs('admin.industry*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#industry"
                        class="{{ request()->routeIs('admin.industry*') ? '' : 'collapsed' }}">
                        <i class="fas fa-industry"></i>
                        <p>Industry</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.industry*') ? 'show' : '' }}" id="industry">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('admin.industry') }}"><span class="sub-item">All
                                        Industries</span></a></li>
                            <li><a href="{{ route('admin.industry-create') }}"><span class="sub-item">Add
                                        New</span></a></li>
                            <li><a href="{{ route('admin.industry-service') }}"><span class="sub-item">Industry
                                        Services</span></a></li>
                            <li><a href="{{ route('admin.industry-faq') }}"><span class="sub-item">Industry
                                        FAQs</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: ACADEMIC
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Academic</h4>
                </li>

                {{-- Course Categories --}}
                <li class="nav-item {{ request()->routeIs('course-categories-*') ? 'active' : '' }}">
                    <a href="{{ route('course-categories-index') }}">
                        <i class="fas fa-tags"></i>
                        <p>Course Categories</p>
                    </a>
                </li>

                {{-- Courses --}}
                <li class="nav-item {{ request()->routeIs('courses*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#courses"
                        class="{{ request()->routeIs('courses*') ? '' : 'collapsed' }}">
                        <i class="fas fa-book-open"></i>
                        <p>Courses</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('courses*') ? 'show' : '' }}" id="courses">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('courses') }}"><span class="sub-item">All Courses</span></a></li>
                            <li><a href="{{ route('courses.create') }}"><span class="sub-item">Add New</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Enrollments --}}
                <li class="nav-item {{ request()->routeIs('enrollments.*') ? 'active' : '' }}">
                    <a href="{{ route('enrollments.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <p>Enrollments</p>
                    </a>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: EVENTS & ACTIVITIES
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Events & Activities</h4>
                </li>

                {{-- Events --}}
                <li
                    class="nav-item {{ request()->routeIs('events-*') || request()->routeIs('sub-events-*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#events"
                        class="{{ request()->routeIs('events-*') || request()->routeIs('sub-events-*') ? '' : 'collapsed' }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Events</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('events-*') || request()->routeIs('sub-events-*') ? 'show' : '' }}"
                        id="events">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('events-index') }}"><span class="sub-item">All Events</span></a>
                            </li>
                            <li><a href="{{ route('events-create') }}"><span class="sub-item">Add New</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- Quiz / Psych Tests --}}
                <li
                    class="nav-item {{ request()->routeIs('quiz-tests.*') || request()->routeIs('quiz-categories.*') || request()->routeIs('quiz-questions.*') || request()->routeIs('test-result-ranges.*') || request()->routeIs('test-graph-configs.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#quiz"
                        class="{{ request()->routeIs('quiz-tests.*') || request()->routeIs('quiz-categories.*') || request()->routeIs('quiz-questions.*') || request()->routeIs('test-result-ranges.*') || request()->routeIs('test-graph-configs.*') ? '' : 'collapsed' }}">
                        <i class="fas fa-brain"></i>
                        <p>Quiz / Psych Tests</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('quiz-tests.*') || request()->routeIs('quiz-categories.*') || request()->routeIs('quiz-questions.*') || request()->routeIs('test-result-ranges.*') || request()->routeIs('test-graph-configs.*') ? 'show' : '' }}"
                        id="quiz">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('quiz-tests.index') }}"><span class="sub-item">All Tests</span></a>
                            </li>
                            <li><a href="{{ route('quiz-tests.create') }}"><span class="sub-item">Create
                                        Test</span></a></li>
                            <li><a href="{{ route('test-result-ranges.tests') }}"><span class="sub-item">Result
                                        Ranges</span></a></li>
                            <li><a href="{{ route('test-graph-configs.index') }}"><span class="sub-item">Graph
                                        Configs</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: BLOG
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Blog</h4>
                </li>

                {{-- Blog --}}
                <li
                    class="nav-item {{ request()->routeIs('admin.blog*') || request()->routeIs('admin.blog-author*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#blogs"
                        class="{{ request()->routeIs('admin.blog*') || request()->routeIs('admin.blog-author*') ? '' : 'collapsed' }}">
                        <i class="fas fa-blog"></i>
                        <p>Blogs</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.blog*') || request()->routeIs('admin.blog-author*') ? 'show' : '' }}"
                        id="blogs">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('admin.blog') }}"><span class="sub-item">All Posts</span></a></li>
                            <li><a href="{{ route('admin.blog-create') }}"><span class="sub-item">Add New
                                        Post</span></a></li>
                            <li><a href="{{ route('admin.blog-category') }}"><span
                                        class="sub-item">Categories</span></a></li>
                            <li><a href="{{ route('admin.blog-author.index') }}"><span
                                        class="sub-item">Authors</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: MEDIA & PEOPLE
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Media & People</h4>
                </li>

                {{-- Team Members --}}
                <li class="nav-item {{ request()->routeIs('admin.team_members*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#team"
                        class="{{ request()->routeIs('admin.team_members*') ? '' : 'collapsed' }}">
                        <i class="fas fa-user-friends"></i>
                        <p>Team Members</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.team_members*') ? 'show' : '' }}"
                        id="team">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('admin.team_members') }}"><span class="sub-item">All
                                        Members</span></a></li>
                            <li><a href="{{ route('admin.team_members-create') }}"><span class="sub-item">Add
                                        New</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- Testimonials --}}
                <li class="nav-item {{ request()->routeIs('admin.testimonial*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#testimonial"
                        class="{{ request()->routeIs('admin.testimonial*') ? '' : 'collapsed' }}">
                        <i class="fas fa-quote-left"></i>
                        <p>Testimonials</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.testimonial*') ? 'show' : '' }}"
                        id="testimonial">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('admin.testimonial') }}"><span class="sub-item">All
                                        Testimonials</span></a></li>
                            <li><a href="{{ route('admin.testimonial-create') }}"><span class="sub-item">Add
                                        New</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- Brands --}}
                <li class="nav-item {{ request()->routeIs('admin.brands*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brands') }}">
                        <i class="fas fa-certificate"></i>
                        <p>Brands</p>
                    </a>
                </li>

                {{-- Video Gallery --}}
                <li
                    class="nav-item {{ request()->routeIs('admin.video_gallery*') || request()->routeIs('youtubeVideo*') || request()->routeIs('youtubeCategory*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#gallery"
                        class="{{ request()->routeIs('admin.video_gallery*') || request()->routeIs('youtubeVideo*') || request()->routeIs('youtubeCategory*') ? '' : 'collapsed' }}">
                        <i class="fas fa-photo-video"></i>
                        <p>Gallery</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.video_gallery*') || request()->routeIs('youtubeVideo*') || request()->routeIs('youtubeCategory*') ? 'show' : '' }}"
                        id="gallery">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('admin.video_gallery') }}"><span class="sub-item">Video
                                        Gallery</span></a></li>
                            <li><a href="{{ route('youtubeVideos.index') }}"><span class="sub-item">YouTube
                                        Videos</span></a></li>
                            <li><a href="{{ route('youtubeCategory.index') }}"><span class="sub-item">YouTube
                                        Categories</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: LOCATIONS
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Locations</h4>
                </li>

                {{-- States --}}
                <li class="nav-item {{ request()->routeIs('states-*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#states"
                        class="{{ request()->routeIs('states-*') ? '' : 'collapsed' }}">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>States</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('states-*') ? 'show' : '' }}" id="states">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('states-index') }}"><span class="sub-item">All States</span></a>
                            </li>
                            <li><a href="{{ route('states-create') }}"><span class="sub-item">Add New</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- Centers --}}
                <li class="nav-item {{ request()->routeIs('centers-*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#centers"
                        class="{{ request()->routeIs('centers-*') ? '' : 'collapsed' }}">
                        <i class="fas fa-building"></i>
                        <p>Centers</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('centers-*') ? 'show' : '' }}" id="centers">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('centers-index') }}"><span class="sub-item">All Centers</span></a>
                            </li>
                            <li><a href="{{ route('centers-create') }}"><span class="sub-item">Add New</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: ENQUIRIES
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Enquiries</h4>
                </li>

                {{-- Admission Short Form --}}
                <li class="nav-item {{ request()->routeIs('admin.admission_short_form*') ? 'active' : '' }}">
                    <a href="{{ route('admin.admission_short_form') }}">
                        <i class="fas fa-file-alt"></i>
                        <p>Admission Forms</p>
                    </a>
                </li>

                {{-- Services Enquiries --}}
                <li class="nav-item {{ request()->routeIs('admin.enquiries*') ? 'active' : '' }}">
                    <a href="{{ route('admin.enquiries') }}">
                        <i class="fas fa-bullhorn"></i>
                        <p>Service Enquiries</p>
                        <span id="enquiry-count" class="badge bg-danger ms-1">0</span>
                    </a>
                </li>

                {{-- Contact Enquiries --}}
                <li class="nav-item {{ request()->routeIs('admin.contactus_enquiry*') ? 'active' : '' }}">
                    <a href="{{ route('admin.contactus_enquiry') }}">
                        <i class="fas fa-headset"></i>
                        <p>Contact Enquiries</p>
                    </a>
                </li>

                {{-- Volunteer --}}
                <li class="nav-item">
                    <a href="{{ route('volunteer') }}">
                        <i class="fas fa-hands-helping"></i>
                        <p>Volunteers</p>
                    </a>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: SYSTEM SETTINGS
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">System Settings</h4>
                </li>

                {{-- Website Setup --}}
                <li class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Website Setup</p>
                    </a>
                </li>

                {{-- Contact Information --}}
                <li class="nav-item {{ request()->routeIs('admin.contact-info.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.contact-info.edit') }}">
                        <i class="fas fa-address-book"></i>
                        <p>Contact Information</p>
                    </a>
                </li>

                {{-- Admin Profile --}}
                <li class="nav-item {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-cog"></i>
                        <p>My Profile</p>
                    </a>
                </li>

                {{-- Logout --}}
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

</div>
{{-- End Sidebar --}}
