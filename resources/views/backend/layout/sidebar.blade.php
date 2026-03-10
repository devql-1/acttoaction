<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo pt-2">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="{{route('admin')}}" class="logo">
        <img src="{{asset('img/' . get_setting('system_logo_black'))}}" alt="navbar brand"
          class="navbar-brand rounded-3 bg-white" height="auto" width="110px" />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item active">
          <a href="{{route('admin')}}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
            <!-- <span class="caret"></span> -->
          </a>
          <!-- <div class="collapse" id="dashboard">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="../demo1/{{route('admin')}}">
                        <span class="sub-item">Dashboard 1</span>
                      </a>
                    </li>
                  </ul>
                </div> -->
        </li>


        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Components</h4>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.slider')}}">
            <i class="fas fa-sliders-h"></i>
            <p>Slider</p>
            <!-- <span class="badge badge-success">1</span> -->
          </a>
        </li>

        {{--<li class="nav-item">
          <a href="{{route('admin.service')}}">
            <i class="icon-equalizer"></i>
            <p>Programs</p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#states">
            <i class="fas fa-map-marker-alt"></i>
            <p>States</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="states">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('states-index') }}">
                  <span class="sub-item">Add States</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        {{-- Centers --}}
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#centers">
            <i class="fas fa-building"></i>
            <p>Centers</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="centers">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('centers-index') }}">
                  <span class="sub-item">Add center</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{ route('course-categories-index') }}">
            <i class="fas fa-tags"></i>
            <p>Course Categories</p>
          </a>
        </li>
        {{-- Courses --}}
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#courses">
            <i class="fas fa-book-open"></i>
            <p>Courses</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="courses">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('courses') }}">
                  <span class="sub-item">All Courses</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        {{-- Events --}}
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#events">
            <i class="fas fa-calendar-alt"></i>
            <p>Events</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="events">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('events-index') }}">
                  <span class="sub-item">All Events</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.test-graph-configs.*') ? 'active' : '' }}"
            href="{{ route('test-graph-configs.index') }}">
            <i class="bi bi-bar-chart-fill me-2"></i> Graph Configs
          </a>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#service">
            <i class="fas fa-folder-open"></i>
            <p>Services</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="service">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('admin.service')}}">
                  <span class="sub-item">All Service</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.service-category')}}">
                  <span class="sub-item">Category</span>
                </a>
              </li>

              {{-- States --}}

              {{--<li>
                <a href="{{route('admin.service-subcategory')}}">
                  <span class="sub-item">Sub Category</span>
                </a>
              </li>--}}
              <li>
                <a href="{{route('admin.service-faq')}}">
                  <span class="sub-item">FAQ</span>
                </a>
              </li>
              {{--<li>
                <a href="{{route('admin.service-benefits')}}">
                  <span class="sub-item">Benefits</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.service-features')}}">
                  <span class="sub-item">Features</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.service-essentials')}}">
                  <span class="sub-item">Essentials</span>
                </a>
              </li>--}}
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a href="{{route('admin.about')}}">
            <i class="fas fa-bars"></i>
            <p>About Us</p>
            <!-- <span class="badge badge-success">1</span> -->
          </a>
        </li>

        {{-- <li class="nav-item">
          <a data-bs-toggle="collapse" href="#about">
            <i class="fas fa-bars"></i>
            <p>About Us</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="about">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('admin.about')}}">
                  <span class="sub-item">All About Post</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.about-category')}}">
                  <span class="sub-item">Category</span>
                </a>
              </li>
            </ul>
          </div>
        </li> --}}

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#quiz-tests-menu">
            <i class="fas fa-brain"></i>
            <p>Quiz Tests</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="quiz-tests-menu">
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

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#blogs">
            <i class="fas fa-folder-open"></i>
            <p>Blogs</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="blogs">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('admin.blog')}}">
                  <span class="sub-item">All Posts</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.blog-category')}}">
                  <span class="sub-item">Category</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        {{--<li class="nav-item">
          <a href="{{route('admin.brands')}}">
            <i class="fas fa-handshake"></i>
            <p>Brands</p>
            <!-- <span class="badge badge-success">1</span> -->
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="{{route('admin.testimonial')}}">
            <i class="fa fa-users"></i>
            <p>Testimonials</p>

          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a data-bs-toggle="collapse" href="#industry">
            <i class="fas fa-building"></i>
            <p>Industry</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="industry">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('admin.industry')}}">
                  <span class="sub-item">All Industry</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.industry-service')}}">
                  <span class="sub-item">Industry Service</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.industry-features')}}">
                  <span class="sub-item">Industry Features</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.industry-faq')}}">
                  <span class="sub-item">Industry FAQ</span>
                </a>
              </li>
            </ul>
          </div>
        </li> --}}
        <li class="nav-item">
          <a href="{{route('admin.team_members')}}">
            <i class="fas fa-user-friends"></i>
            <p>Team Members</p>

          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.video_gallery')}}">
            <i class="fas fa-images"></i>
            <p>Video Gallery</p>

          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/enquiries') }}" id="enquiry-link">
            <i class="fas fa-bullhorn"></i>
            <p>Services Enquiries</p>
            <span id="enquiry-count" class="badge bg-danger">0</span>
          </a>
        </li>

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#admission">
            <i class="fas fa-graduation-cap"></i>
            <p>Youtube Videos </p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="admission">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('youtubeCategory.index')}}">
                  <span class="sub-item">Youtube Category</span>
                </a>
              </li>

              <li>
                <a href="{{route('youtubeVideos.index')}}">
                  <span class="sub-item">Youtube Video</span>
                </a>
              </li>

            </ul>
          </div>
        </li>



        <li class="nav-item">
          <a href="{{route('admin.contactus_enquiry')}}">
            <i class="fas fa-headset"></i>
            <p>Contact Us Enquiries</p>
            <!-- <span id="enquiry-count" class="badge bg-danger">0</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('admin.settings.index')}}">
            <i class="fas fa-desktop"></i>
            <p>Website Setup</p>
            <!-- <span class="badge badge-success">1</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('admin.contact-info.edit')}}">
            <i class="fas fa-desktop"></i>
            <p>Contact Information</p>
            <!-- <span class="badge badge-success">1</span> -->
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->