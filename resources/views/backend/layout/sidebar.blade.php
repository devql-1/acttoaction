<!-- Sidebar -->

<div class="sidebar" data-background-color="dark">

```
<!-- Logo -->
<div class="sidebar-logo pt-2">
    <div class="logo-header" data-background-color="dark">
        <a href="{{ route('admin') }}" class="logo">
            <img src="{{ asset('img/' . get_setting('system_logo_black')) }}"
                 class="navbar-brand rounded-3 bg-white"
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

            <!-- Dashboard -->
            <li class="nav-item {{ request()->routeIs('admin') ? 'active' : '' }}">
                <a href="{{ route('admin') }}">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>


            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Content Management</h4>
            </li>


            <!-- Slider -->
            <li class="nav-item {{ request()->routeIs('admin.slider') ? 'active' : '' }}">
                <a href="{{ route('admin.slider') }}">
                    <i class="fas fa-sliders-h"></i>
                    <p>Slider</p>
                </a>
            </li>


            <!-- States -->
            <li class="nav-item {{ request()->routeIs('states-*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#states"
                   class="{{ request()->routeIs('states-*') ? '' : 'collapsed' }}">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>States</p>
                    <span class="caret"></span>
                </a>

                <div class="collapse {{ request()->routeIs('states-*') ? 'show' : '' }}" id="states">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('states-index') }}">
                                <span class="sub-item">Add States</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Centers -->
            <li class="nav-item {{ request()->routeIs('centers-*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#centers">
                    <i class="fas fa-building"></i>
                    <p>Centers</p>
                    <span class="caret"></span>
                </a>

                <div class="collapse {{ request()->routeIs('centers-*') ? 'show' : '' }}" id="centers">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('centers-index') }}">
                                <span class="sub-item">Add Center</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Course Categories -->
            <li class="nav-item {{ request()->routeIs('course-categories-*') ? 'active' : '' }}">
                <a href="{{ route('course-categories-index') }}">
                    <i class="fas fa-tags"></i>
                    <p>Course Categories</p>
                </a>
            </li>


            <!-- Courses -->
            <li class="nav-item {{ request()->routeIs('courses*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#courses">
                    <i class="fas fa-book-open"></i>
                    <p>Courses</p>
                    <span class="caret"></span>
                </a>

                <div class="collapse {{ request()->routeIs('courses*') ? 'show' : '' }}" id="courses">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('courses') }}">
                                <span class="sub-item">All Courses</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Events -->
            <li class="nav-item {{ request()->routeIs('events-*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#events">
                    <i class="fas fa-calendar-alt"></i>
                    <p>Events</p>
                    <span class="caret"></span>
                </a>

                <div class="collapse {{ request()->routeIs('events-*') ? 'show' : '' }}" id="events">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('events-index') }}">
                                <span class="sub-item">All Events</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Quiz Tests -->
            <li class="nav-item {{ request()->routeIs('quiz-tests.*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#quiz">
                    <i class="fas fa-brain"></i>
                    <p>Quiz Tests</p>
                    <span class="caret"></span>
                </a>

                <div class="collapse {{ request()->routeIs('quiz-tests.*') ? 'show' : '' }}" id="quiz">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('quiz-tests.index') }}">
                                <span class="sub-item">All Tests</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('quiz-tests.create') }}">
                                <span class="sub-item">Create Test</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Blog -->
            <li class="nav-item {{ request()->routeIs('admin.blog*') || request()->routeIs('admin.blog-author*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#blogs">
                    <i class="fas fa-blog"></i>
                    <p>Blogs</p>
                    <span class="caret"></span>
                </a>

                <div class="collapse {{ request()->routeIs('admin.blog*') || request()->routeIs('admin.blog-author*') ? 'show' : '' }}" id="blogs">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('admin.blog') }}">
                                <span class="sub-item">All Posts</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.blog-category') }}">
                                <span class="sub-item">Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.blog-author.index') }}">
                                <span class="sub-item">Authors</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Services -->
            <li class="nav-item {{ request()->routeIs('admin.service*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#service">
                    <i class="fas fa-cogs"></i>
                    <p>Services</p>
                    <span class="caret"></span>
                </a>

                <div class="collapse {{ request()->routeIs('admin.service*') ? 'show' : '' }}" id="service">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('admin.service') }}">
                                <span class="sub-item">All Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.service-category') }}">
                                <span class="sub-item">Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.service-faq') }}">
                                <span class="sub-item">FAQ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">System</h4>
            </li>


            <!-- Team -->
            <li class="nav-item {{ request()->routeIs('admin.team_members') ? 'active' : '' }}">
                <a href="{{ route('admin.team_members') }}">
                    <i class="fas fa-user-friends"></i>
                    <p>Team Members</p>
                </a>
            </li>


            <!-- Gallery -->
            <li class="nav-item {{ request()->routeIs('admin.video_gallery') ? 'active' : '' }}">
                <a href="{{ route('admin.video_gallery') }}">
                    <i class="fas fa-images"></i>
                    <p>Video Gallery</p>
                </a>
            </li>


            <!-- Enquiries -->
            <li class="nav-item">
                <a href="{{ url('admin/enquiries') }}">
                    <i class="fas fa-bullhorn"></i>
                    <p>Services Enquiries</p>
                    <span id="enquiry-count" class="badge bg-danger">0</span>
                </a>
            </li>


            <!-- Contact -->
            <li class="nav-item {{ request()->routeIs('admin.contactus_enquiry') ? 'active' : '' }}">
                <a href="{{ route('admin.contactus_enquiry') }}">
                    <i class="fas fa-headset"></i>
                    <p>Contact Enquiries</p>
                </a>
            </li>


            <!-- Website Setup -->
            <li class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-desktop"></i>
                    <p>Website Setup</p>
                </a>
            </li>


            <!-- Contact Info -->
            <li class="nav-item {{ request()->routeIs('admin.contact-info.*') ? 'active' : '' }}">
                <a href="{{ route('admin.contact-info.edit') }}">
                    <i class="fas fa-address-book"></i>
                    <p>Contact Information</p>
                </a>
            </li>


        </ul>

    </div>
</div>
```

</div>
<!-- End Sidebar -->
