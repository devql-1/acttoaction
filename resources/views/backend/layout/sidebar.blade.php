{{-- resources/views/backend/layout/sidebar.blade.php --}}

<div class="sidebar" data-background-color="dark">

    {{-- ── Logo ── --}}
    <div class="sidebar-logo pt-2">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin') }}" class="logo">
                <img src="{{ asset('img/logo/logo.png') }}" class="navbar-brand rounded-3 bg-white"
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
                {{-- <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Content Management</h4>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.slider') ? 'active' : '' }}">
                    <a href="{{ route('admin.slider') }}">
                        <i class="fas fa-sliders-h"></i>
                        <p>Slider</p>
                    </a>
                </li>

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
                </li> --}}

                {{-- ══════════════════════════════════════════
                     SECTION: CONTENT MANAGEMENT
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Content Management</h4>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.notification-banners.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.notification-banners.index') }}">
                        <i class="fas fa-bell"></i>
                        <p>Notification Banners</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.announcement-bar.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.announcement-bar.index') }}">
                        <i class="fas fa-bullhorn"></i>
                        <p>Announcement Bar</p>
                    </a>
                </li>

                {{-- Action Items — temporarily disabled
                <li class="nav-item {{ request()->routeIs('action-items.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#actionItems"
                        class="{{ request()->routeIs('action-items.*') ? '' : 'collapsed' }}">
                        <i class="fas fa-tasks"></i>
                        <p>Action Items</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('action-items.*') ? 'show' : '' }}" id="actionItems">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('action-items.index') }}"><span class="sub-item">All Action
                                        Items</span></a></li>
                            <li><a href="{{ route('action-items.create') }}"><span class="sub-item">Add New</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                --}}

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
                     SECTION: EVENTS
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Events</h4>
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

                {{-- Event Registrations --}}
                <li class="nav-item {{ request()->routeIs('event-registrations.*') ? 'active' : '' }}">
                    <a href="{{ route('event-registrations.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Event Registrations</p>
                    </a>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: CYBER AI THREAT CONCLAVE
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Cyber AI Threat Conclave</h4>
                </li>

                {{-- Cyber AI Threat Conclave Main Menu --}}
                <li
                    class="nav-item {{ request()->routeIs('people-*', 'workshop-*', 'gallery-*', 'stats-*', 'about-section-*', 'themes.*', 'summer-events.*', 'summer-sub-events.*', 'summer-partners.*', 'summer-partner-categories.*', 'school-partners.*', 'school-partner-categories.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#summercamp"
                        class="{{ request()->routeIs('people-*', 'workshop-*', 'gallery-*', 'stats-*', 'about-section-*', 'themes.*', 'summer-events.*', 'summer-sub-events.*', 'summer-partners.*', 'summer-partner-categories.*', 'school-partners.*', 'school-partner-categories.*') ? '' : 'collapsed' }}">
                        <i class="fas fa-sun"></i>
                        <p>Camp Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('people-*', 'workshop-*', 'gallery-*', 'stats-*', 'about-section-*', 'themes.*', 'summer-events.*', 'summer-sub-events.*', 'summer-partners.*', 'summer-partner-categories.*', 'school-partners.*', 'school-partner-categories.*') ? 'show' : '' }}"
                        id="summercamp">
                        <ul class="nav nav-collapse">

                            {{-- Events & Sub Events --}}
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#summerEvents"
                                    class="{{ request()->routeIs('summer-events.*', 'summer-sub-events.*') ? '' : 'collapsed' }}">
                                    <i class="fas fa-calendar-check"></i>
                                    <span class="sub-item">Events</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('summer-events.*', 'summer-sub-events.*') ? 'show' : '' }}"
                                    id="summerEvents">
                                    <ul class="nav nav-collapse">
                                        <li><a href="{{ route('summer-events.index') }}"><span class="sub-item">All
                                                    Events</span></a></li>
                                        <li><a href="{{ route('summer-events.create') }}"><span class="sub-item">Add
                                                    New Event</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Workshop Configuration --}}
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#workshopConfig"
                                    class="{{ request()->routeIs('workshop-*') || request()->routeIs('merchandise.*') ? '' : 'collapsed' }}">
                                    <i class="fas fa-tools"></i>
                                    <span class="sub-item">Workshop Config</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('workshop-*') || request()->routeIs('merchandise.*') ? 'show' : '' }}"
                                    id="workshopConfig">
                                    <ul class="nav nav-collapse">
                                        <li><a href="{{ route('workshop-age-groups-index') }}"><span
                                                    class="sub-item">Age Groups</span></a></li>
                                        <li><a href="{{ route('workshop-cities-index') }}"><span
                                                    class="sub-item">Cities</span></a></li>
                                        <li><a href="{{ route('workshop-schools-index') }}"><span
                                                    class="sub-item">Schools</span></a></li>
                                        <li><a href="{{ route('merchandise.index') }}"><span
                                                    class="sub-item">Merchandise</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- People / Mentors --}}
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#peopleMenu"
                                    class="{{ request()->routeIs('people-*') ? '' : 'collapsed' }}">
                                    <i class="fas fa-user-circle"></i>
                                    <span class="sub-item">People</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('people-*') ? 'show' : '' }}" id="peopleMenu">
                                    <ul class="nav nav-collapse">
                                        <li><a href="{{ route('people-index') }}"><span class="sub-item">All People</span></a></li>
                                        <li><a href="{{ route('people-index') }}?section=mentor"><span class="sub-item">Mentors</span></a></li>
                                        <li><a href="{{ route('people-index') }}?section=speaker"><span class="sub-item">Speakers</span></a></li>
                                        <li><a href="{{ route('people-index') }}?section=guest"><span class="sub-item">Guests</span></a></li>
                                        <li><a href="{{ route('people-index') }}?section=faculty"><span class="sub-item">Faculty</span></a></li>
                                        <li><a href="{{ route('people-create') }}"><span class="sub-item">Add New</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Partners & Categories --}}
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#summerPartners"
                                   class="{{ request()->routeIs('summer-partners.*', 'summer-partner-categories.*') ? '' : 'collapsed' }}">
                                    <i class="fas fa-handshake"></i>
                                    <span class="sub-item">Partners</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('summer-partners.*', 'summer-partner-categories.*') ? 'show' : '' }}"
                                     id="summerPartners">
                                    <ul class="nav nav-collapse">
                                        <li><a href="{{ route('summer-partners.index') }}"><span class="sub-item">All Partners</span></a></li>
                                        <li><a href="{{ route('summer-partners.create') }}"><span class="sub-item">Add Partner</span></a></li>
                                        <li><a href="{{ route('summer-partner-categories.index') }}"><span class="sub-item">Categories</span></a></li>
                                        <li><a href="{{ route('summer-partner-categories.create') }}"><span class="sub-item">Add Category</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- School Partners → Sections → Categories → Schools --}}
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#schoolSections"
                                   class="{{ request()->routeIs('school-sections.*', 'school-partners.*', 'school-partner-categories.*') ? '' : 'collapsed' }}">
                                    <i class="fas fa-school"></i>
                                    <span class="sub-item">School Partners</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('school-sections.*', 'school-partners.*', 'school-partner-categories.*') ? 'show' : '' }}"
                                     id="schoolSections">
                                    <ul class="nav nav-collapse">
                                        <li style="padding:5px 16px 1px;font-size:10px;font-weight:700;text-transform:uppercase;color:#aaa;letter-spacing:.7px;">Sections</li>
                                        <li><a href="{{ route('school-sections.index') }}"><span class="sub-item">All Sections</span></a></li>
                                        <li><a href="{{ route('school-sections.create') }}"><span class="sub-item">Add Section</span></a></li>

                                        <li style="padding:5px 16px 1px;font-size:10px;font-weight:700;text-transform:uppercase;color:#aaa;letter-spacing:.7px;">Categories</li>
                                        <li><a href="{{ route('school-partner-categories.index') }}"><span class="sub-item">All Categories</span></a></li>
                                        <li><a href="{{ route('school-partner-categories.create') }}"><span class="sub-item">Add Category</span></a></li>

                                        <li style="padding:5px 16px 1px;font-size:10px;font-weight:700;text-transform:uppercase;color:#aaa;letter-spacing:.7px;">Schools</li>
                                        <li><a href="{{ route('school-partners.index') }}"><span class="sub-item">All Schools</span></a></li>
                                        <li><a href="{{ route('school-partners.create') }}"><span class="sub-item">Add School</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Gallery --}}
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#summerGallery"
                                    class="{{ request()->routeIs('gallery-*') ? '' : 'collapsed' }}">
                                    <i class="fas fa-images"></i>
                                    <span class="sub-item">Gallery</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('gallery-*') ? 'show' : '' }}"
                                    id="summerGallery">
                                    <ul class="nav nav-collapse">
                                        <li><a href="{{ route('gallery-categories-index') }}"><span
                                                    class="sub-item">Categories</span></a></li>
                                        <li><a href="{{ route('gallery-images-index') }}"><span
                                                    class="sub-item">Images</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li style="padding:6px 16px 2px;font-size:10px;font-weight:700;text-transform:uppercase;color:#aaa;letter-spacing:.7px;">Content</li>

                            <li class="nav-item {{ request()->routeIs('hero-banner.*') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#heroBanner"
                                    class="{{ request()->routeIs('hero-banner.*') ? '' : 'collapsed' }}">
                                    <i class="fas fa-image"></i>
                                    <span class="sub-item">Hero Banner</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('hero-banner.*') ? 'show' : '' }}"
                                    id="heroBanner">
                                    <ul class="nav nav-collapse">
                                        <li><a href="{{ route('hero-banner.index') }}"><span class="sub-item">All
                                                    Banners</span></a>
                                        </li>
                                        <li><a href="{{ route('hero-banner.create') }}"><span class="sub-item">Add
                                                    New</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Statistics --}}
                            <li class="nav-item {{ request()->routeIs('stats-*') ? 'active' : '' }}">
                                <a href="{{ route('stats-index') }}">
                                    <i class="fas fa-chart-bar"></i>
                                    <span class="sub-item">Statistics</span>
                                </a>
                            </li>

                            {{-- About Section --}}
                            <li class="nav-item {{ request()->routeIs('about-section-*') ? 'active' : '' }}">
                                <a href="{{ route('about-section-index') }}">
                                    <i class="fas fa-align-left"></i>
                                    <span class="sub-item">About Section</span>
                                </a>
                            </li>

                            {{-- Themes --}}
                            <li class="nav-item {{ request()->routeIs('themes.*') ? 'active' : '' }}">
                                <a href="{{ route('themes.index') }}">
                                    <i class="fas fa-palette"></i>
                                    <span class="sub-item">Themes</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                {{-- Workshop Registrations --}}
                <li class="nav-item {{ request()->routeIs('workshop-registrations.*') ? 'active' : '' }}">
                    <a href="{{ route('workshop-registrations.index') }}">
                        <i class="fas fa-paint-brush"></i>
                        <p>Workshop Registrations</p>
                    </a>
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
                     SECTION: MEDIA
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Media</h4>
                </li>

                {{-- Team Members --}}
                {{-- <li class="nav-item {{ request()->routeIs('admin.team_members*') ? 'active' : '' }}">
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
                </li> --}}

                {{-- Testimonials --}}
                {{-- <li class="nav-item {{ request()->routeIs('admin.testimonial*') ? 'active' : '' }}">
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
                </li> --}}

                {{-- Brands --}}
                {{-- <li class="nav-item {{ request()->routeIs('admin.brands*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brands') }}">
                        <i class="fas fa-certificate"></i>
                        <p>Brands</p>
                    </a>
                </li> --}}

                {{-- Video Gallery --}}
                <li
                    class="nav-item {{ request()->routeIs('admin.video_gallery*') || request()->routeIs('youtubeVideo*') || request()->routeIs('youtubeCategory*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#gallery"
                        class="{{ request()->routeIs('admin.video_gallery*') || request()->routeIs('youtubeVideo*') || request()->routeIs('youtubeCategory*') ? '' : 'collapsed' }}">
                        <i class="fas fa-photo-video"></i>
                        <p>Video Gallery</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.video_gallery*') || request()->routeIs('youtubeVideo*') || request()->routeIs('youtubeCategory*') ? 'show' : '' }}"
                        id="gallery">
                        <ul class="nav nav-collapse">
                            {{-- <li><a href="{{ route('admin.video_gallery') }}"><span class="sub-item">Video
                                        Gallery</span></a></li> --}}
                            <li><a href="{{ route('youtubeVideos.index') }}"><span class="sub-item">YouTube
                                        Videos</span></a></li>
                            <li><a href="{{ route('youtubeCategory.index') }}"><span class="sub-item">YouTube
                                        Categories</span></a></li>
                        </ul>
                    </div>
                </li>

                {{-- Gallery Categories & Images (Resource) --}}
                <li
                    class="nav-item {{ request()->routeIs('galleryCategories.*') || request()->routeIs('galleries.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#galleryResource"
                        class="{{ request()->routeIs('galleryCategories.*') || request()->routeIs('galleries.*') ? '' : 'collapsed' }}">
                        <i class="fas fa-images"></i>
                        <p>Photo Gallery</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('galleryCategories.*') || request()->routeIs('galleries.*') ? 'show' : '' }}"
                        id="galleryResource">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('galleryCategories.index') }}">
                                    <span class="sub-item">Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('galleries.index') }}">
                                    <span class="sub-item">All Images</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('galleries.create') }}">
                                    <span class="sub-item">Add New</span>
                                </a>
                            </li>
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
                     SECTION: COMMUNICATION
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Communication</h4>
                </li>

                {{-- Admission Short Form --}}
                {{-- <li class="nav-item {{ request()->routeIs('admin.admission_short_form*') ? 'active' : '' }}">
                    <a href="{{ route('admin.admission_short_form') }}">
                        <i class="fas fa-file-alt"></i>
                        <p>Admission Forms</p>
                    </a>
                </li> --}}

                {{-- Services Enquiries --}}
                {{-- <li class="nav-item {{ request()->routeIs('admin.enquiries*') ? 'active' : '' }}">
                    <a href="{{ route('admin.enquiries') }}">
                        <i class="fas fa-bullhorn"></i>
                        <p>Service Enquiries</p>
                        <span id="enquiry-count" class="badge bg-danger ms-1">0</span>
                    </a>
                </li> --}}

                {{-- Contact Enquiries --}}
                <li class="nav-item {{ request()->routeIs('admin.contactus_enquiry*') ? 'active' : '' }}">
                    <a href="{{ route('admin.contactus_enquiry') }}">
                        <i class="fas fa-headset"></i>
                        <p>Contact Enquiries</p>
                    </a>
                </li>

                {{-- Newsletter Subscribers --}}
                <li class="nav-item {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.newsletters.index') }}">
                        <i class="fas fa-envelope-open-text"></i>
                        <p>Newsletter Subscribers</p>
                    </a>
                </li>

                {{-- Chatbot --}}
                <li class="nav-item {{ request()->routeIs('admin.chatbot*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#chatbot"
                        class="{{ request()->routeIs('admin.chatbot*') ? '' : 'collapsed' }}">
                        <i class="fas fa-robot"></i>
                        <p>Chatbot</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.chatbot*') ? 'show' : '' }}" id="chatbot">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.chatbot-faq') }}">
                                    <span class="sub-item">FAQs</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.chatbot-faq-create') }}">
                                    <span class="sub-item">Add FAQ</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.chatbot-tickets') }}">
                                    <span class="sub-item">Support Tickets</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Volunteer --}}
                <li class="nav-item {{ request()->routeIs('admin.volunteers.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.volunteers.index') }}">
                        <i class="fas fa-hands-helping"></i>
                        <p>Volunteers</p>
                    </a>
                </li>

                {{-- Email --}}
                <li class="nav-item {{ request()->routeIs('email-templates.*') || request()->routeIs('email-logs.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#emailMenu"
                        class="{{ request()->routeIs('email-templates.*') || request()->routeIs('email-logs.*') ? '' : 'collapsed' }}">
                        <i class="fas fa-envelope"></i>
                        <p>Email</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('email-templates.*') || request()->routeIs('email-logs.*') ? 'show' : '' }}" id="emailMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('email-templates.*') ? 'active' : '' }}">
                                <a href="{{ route('email-templates.index') }}">
                                    <span class="sub-item">Templates</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('email-logs.*') ? 'active' : '' }}">
                                <a href="{{ route('email-logs.index') }}">
                                    <span class="sub-item">Logs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: FINANCE
                ══════════════════════════════════════════ --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Finance</h4>
                </li>

                {{-- Payment --}}
                <li class="nav-item {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                    <a href="{{ route('payments.index') }}">
                        <i class="fas fa-credit-card"></i>
                        <p>Payment</p>
                    </a>
                </li>

                {{-- ══════════════════════════════════════════
                     SECTION: SYSTEM SETTINGS
                ══════════════════════════════════════════ --}}
                {{-- <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">System Settings</h4>
                </li>


                <li class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Website Setup</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.contact-info.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.contact-info.edit') }}">
                        <i class="fas fa-address-book"></i>
                        <p>Contact Information</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-cog"></i>
                        <p>My Profile</p>
                    </a>
                </li> --}}

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
