<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from demo.nsatheme.com/html/cityads/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Nov 2025 07:19:22 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ get_setting('website_name') }} | {{ get_setting('site_motto') }}</title>
        <link rel="icon" type="image/png" href="{{asset('img/'.get_setting('site_logo'))}}">

        <!-- CSS Links -->
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/scrollCue.css')}}">
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/remixicon.css')}}">
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/magnific-popup.min.css')}}">
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/MangoGrotesque.css')}}">
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/PolySans.css')}}">
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('webtheme/assets/css/responsive.css')}}">
                <!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    </head>
    <body>

       @include('frontend.layout.header')
       @yield('content')
       @include('frontend.layout.footer')
        
        <!-- Back To Top -->
        <div class="back-to-top position-fixed cursor-pointer d-flex align-items-center justify-content-center transition">
            <img src="{{asset('webtheme/assets/images/icons/bold-right-arrow.svg')}}" alt="bold-right-arrow">
        </div>
        <!-- End Back To Top -->

        <!-- JS Links -->
        <script src="{{asset('webtheme/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('webtheme/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('webtheme/assets/js/magnific-popup.min.js')}}"></script>
        <script src="{{asset('webtheme/assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('webtheme/assets/js/scrollCue.min.js')}}"></script>
        <script src="{{asset('webtheme/assets/js/gsap.min.js')}}"></script>
        <script src="{{asset('webtheme/assets/js/ScrollTrigger.min.js')}}"></script>
        <script src="{{asset('webtheme/assets/js/SplitText.min.js')}}"></script>
        <script src="{{asset('webtheme/assets/js/smooth-scroll.js')}}"></script>
        <script src="{{asset('webtheme/assets/js/custom.js')}}"></script>

        <script>
  const filterBaseUrl = "{{ url('blogs/filter') }}";
  document.addEventListener('click', function(e) {
    const el = e.target.closest('.category-filter');
    if (!el) return;

    e.preventDefault();
    const id = el.dataset.id;

    // UI: set active class
    document.querySelectorAll('.category-filter').forEach(x => x.classList.remove('active'));
    el.classList.add('active');

    // Fetch filtered HTML via AJAX (fetch API)
    fetch(`${filterBaseUrl}/${id}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => {
      if (!res.ok) throw new Error('Network response was not ok: ' + res.status);
      return res.json();
    })
    .then(data => {
      document.getElementById('blogs-container').innerHTML = data.html;
    })
    .catch(err => {
      console.error('Filter error:', err);
    });
  });

  // SEARCH FORM SUBMIT
document.getElementById('blog-search-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let keyword = document.getElementById('blog-search-input').value;

    fetch("{{ route('home.blogs_search') }}?q=" + encodeURIComponent(keyword), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('blogs-container').innerHTML = data.html;
    })
    .catch(err => console.error('Search error:', err));
});

// for pagination
$(document).on('click', '.pagination-wrap a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');

    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#blogs-container').html(response.html);
            $('#pagination-container').html(response.pagination);
        },
        error: function() {
            alert('Something went wrong, please try again.');
        }
    });
});

</script>




 <script>
$(function () {
    $('.ajaxForms').on('submit', function (e) {
        e.preventDefault();

        let form = this;
        let actionUrl = $(form).attr('action');

        $.ajax({
            url: actionUrl,
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (response) {
                if (response.status === false) {
                    $.each(response.errors, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    $('#successMsg')
                        .removeClass('d-none')
                        .text(response.message)
                        .fadeIn();

                    form.reset();

                    setTimeout(() => {
                        $('#successMsg').fadeOut();
                    }, 3000);
                }
            },
            error: function () {
                alert('Something went wrong, please try again.');
            }
        });
    });
});
</script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".services-slider", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 2,
            },
        },
    });
</script>

<script>

      // Settings
    $(document).ready(function () {
        const themeSettingsHTML = `
           <div class="theme-settings-menu">
            <ul class="p-0 m-0 list-unstyled">
                <li>
                    <a href="https://wa.me/918209863402" 
                       target="_blank" 
                       data-bs-toggle="tooltip" 
                       data-bs-placement="top" 
                       data-bs-title="Chat on WhatsApp"
                       style="display:inline-flex; align-items:center; justify-content:center; 
                              width:80px; height:80px; border-radius:50%; 
                              background-color:#25D366; color:#fff; 
                              font-size:40px; text-decoration:none;">
                        <i class="ri-whatsapp-fill"></i>
                    </a>
                </li>
            </ul>
        </div>
        `;
        
        // Append to body
        $('body').append(themeSettingsHTML);

        // Reinitialize Bootstrap tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

    </body>

<!-- Mirrored from demo.nsatheme.com/html/cityads/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Nov 2025 07:20:58 GMT -->
</html>