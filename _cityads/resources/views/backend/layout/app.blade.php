<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ get_setting('website_name') }} | ADMIN PANEL</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{asset('img/'.get_setting('site_logo'))}}"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- CSS switch toggle -->
    <link rel="stylesheet" href="{{asset('assets/css/switchtoggle.css')}}" />

    <!-- CSS file-upload -->
    <link rel="stylesheet" href="{{ asset('assets/css/file-upload.css') }}">

    <!-- CSS multi-file-upload -->
    <link rel="stylesheet" href="{{ asset('assets/css/multi-file-upload.css') }}">


    <!-- CSS select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  </head>
  <style>
    .form-control:focus {
        border-color: #31ce36;
    }
</style>
  <body>
    <div class="wrapper">

    @include('backend.layout.sidebar')
    @include('backend.layout.header')
    @yield('content')
    @include('backend.layout.footer')


    <!-- Custom template | don't include it in your project! -->
      <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
          <div class="switcher">
            <div class="switch-block">
              <h4>Logo Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="selected changeLogoHeaderColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Navbar Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="selected changeTopBarColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Sidebar</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="white"
                ></button>
                <button
                  type="button"
                  class="selected changeSideBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="dark2"
                ></button>
              </div>
            </div>
          </div>
        </div>
        <div class="custom-toggle">
          <i class="icon-settings"></i>
        </div>
      </div>
      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->

    @yield('modal')

    @yield('script')
    
    <script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/jsvectormap/world.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{asset('assets/js/setting-demo.js')}}"></script>
    <script src="{{asset('assets/js/demo.js')}}"></script>

    <!-- file-upload JS -->
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>

    <!-- multi-file-upload JS -->
    <script src="{{ asset('assets/js/multi-file-upload.js') }}"></script>

    <!-- select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   

   <!-- RateYo CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.css">

<!-- jQuery FIRST -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<!-- RateYo JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.js"></script>


<script>
$(function () {
  let initialRating = parseFloat($("#rating").val()) || 0;

  $("#rateYo").rateYo({
    rating: initialRating,
    halfStar: true,
    starWidth: "30px",
    ratedFill: "#f39c12",
    normalFill: "#dcdcdc",
    onSet: function (rating) {
      $("#rating").val(rating);

      // Select hone par message dikhana
      $("#rating-message").text("✨ You have selected " + rating + " stars!");
    }
  });

  // Agar edit mode me rating pehle se hai to message show karna
  if (initialRating > 0) {
    $("#rating-message").text("✨ You have selected " + initialRating + " stars!");
  }
});
</script>

<script>
$(function () {
    $(".star-display").each(function () {
        let rating = parseFloat($(this).data("rating"));
        $(this).rateYo({
            rating: rating,
            readOnly: true,
            starWidth: "25px",
            ratedFill: "#f39c12",
            normalFill: "#ddd"
        });
    });
});
</script>


    <script>
      $(document).ready(function() {
          $('#category_id').select2({
              allowClear: true
          });
      });
    </script>

<script>
$(document).ready(function () {
    function loadIcons(selectedIcon = null) {
        $.getJSON("{{ asset('icons.json') }}", function (data) {
            // remove duplicates
            let uniqueIcons = [...new Set(data)];

            let iconsData = [
                { id: '', text: '✨ Select an Icon' },
                ...uniqueIcons.map(icon => ({
                    id: icon,
                    text: icon,
                    html: `<i class="${icon}"></i> ${icon}`,
                    title: icon
                }))
            ];

            $("#icon").empty().select2({
                tags: true,
                data: iconsData,
                createTag: function (params) {
                    let term = $.trim(params.term);
                    if (term === '') return null;

                    let iconClass = term.startsWith("fa") ? term : `fa fa-${term}`;
                    return {
                        id: iconClass,
                        text: iconClass,
                        newOption: true
                    };
                },
                templateResult: function (data) {
                    if (data.loading) return data.text;
                    if (!data.id) return $('<span class="text-muted">✨ Select an Icon</span>');
                    return $(`<span><i class="fa ${data.id}"></i> ${data.text}</span>`);
                },
                templateSelection: function (data) {
                    if (!data.id) return $('<span class="text-muted">✨ Select an Icon</span>');
                    return $(`<span><i class="fa ${data.id}"></i> ${data.text}</span>`);
                },
                escapeMarkup: function (markup) { return markup; }
            });

            if (selectedIcon) {
                $("#icon").val(selectedIcon).trigger("change");
            }
        });
    }

    // Initial Load
    loadIcons($("#icon").data("selected"));

    // Save new icon
    $("#icon").on("select2:select", function (e) {
        let data = e.params.data;
        if (data.newOption) {
            $.ajax({
                url: "{{ route('icons.add') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    icon: data.id
                },
                success: function (res) {
                    if (res.success) {
                        loadIcons(res.icon);
                    } else {
                        // Show duplicate notify
                        $.notify({
                            message: res.message,
                            icon: 'fa fa-exclamation-circle'
                        }, {
                            type: "danger",
                            placement: { from: "top", align: "center" },
                            delay: 2000,
                        });
                        loadIcons(); // reload cleaned list
                    }
                }
            });
        }
    });
});
</script>



<script>
$(document).ready(function () {
    // Initialize Select2
    $('.select2').select2();

    function loadSubcategories(categoryId, selectedSubcategoryId = null) {
        if (categoryId) {
            $.ajax({
                url: "{{ route('admin.getservice-subcategories') }}",
                type: "GET",
                data: { category_id: categoryId },
                success: function (data) {
                    // Reset & rebuild subcategory select
                    $('#subcategory_id').empty().append('<option value="">-- Select Sub Category --</option>');

                    $.each(data, function (key, subcategory) {
                        let selected = (subcategory.id == selectedSubcategoryId) ? 'selected' : '';
                        $('#subcategory_id').append(
                            '<option value="' + subcategory.id + '" ' + selected + '>' + subcategory.subcategory_name + '</option>'
                        );
                    });

                    // Refresh Select2 after data change
                    $('#subcategory_id').trigger('change.select2');
                }
            });
        } else {
            $('#subcategory_id').empty().append('<option value="">-- Select Sub Category --</option>');
            $('#subcategory_id').trigger('change.select2');
        }
    }

    // On category change
    $('#servicecategory_id').on('change', function () {
        var categoryId = $(this).val();
        loadSubcategories(categoryId);
    });

    // ==== For Edit Case ====
    var selectedCategoryId = $('#servicecategory_id').data('selected');   // pass from blade
    var selectedSubcategoryId = $('#subcategory_id').data('selected');   // pass from blade

    if (selectedCategoryId) {
        $('#servicecategory_id').val(selectedCategoryId).trigger('change.select2');
        loadSubcategories(selectedCategoryId, selectedSubcategoryId);
    }
});
</script>


    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>

    <script>
    $(document).ready(function() {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
            pageLength: 5,
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column
                                    .search(val ? "^" + val + "$" : "", true, false)
                                    .draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append(
                                    '<option value="' + d + '">' + d + "</option>"
                                );
                            });
                    });
            },
        });

        // Add Row
        $("#add-row").DataTable({
            pageLength: 5,
        });

        var action =
            '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function() {
            $("#add-row")
                .dataTable()
                .fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action,
                ]);
            $("#addRowModal").modal("hide");
        });
    });
</script>

<script>
$(document).on("click", ".delete-record", function (e) {
    e.preventDefault();

    let url = $(this).data("url");
    let id = $(this).data("id");
    let row = $("#record-row-" + id);

    swal({
        title: "Are you sure?",
        text: "This record will be permanently deleted!",
        icon: "warning",
        buttons: ["Cancel", "Yes, Delete!"],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    if (response.success) {
                        // ✅ directly DataTable se row remove karo
                        let table = $("#basic-datatables").DataTable();
                        table.row(row).remove().draw(false);
                        row.fadeOut(400, function () {
                            $(this).remove();
                        });

                    }
                }
            });
        }
    });
});


$(document).on("change", ".toggle-status", function () {
    let id = $(this).data("id");
    let url = $(this).data("url");
    let status = $(this).is(":checked") ? 1 : 0;

    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: id,
            status: status
        },
        success: function (response) {
            if (response.success) {
                $.notify(
                    {
                        message: "Published status updated successfully!",
                        title: "Success",
                        icon: "fa fa-check"
                    },
                    {
                        type: "success",
                        placement: {
                            from: "top",
                            align: "center"
                        },
                        time: 3000,
                        delay: 2000
                    }
                );
            }
        }
    });
});


</script>


    @if(session('success'))
    <script>
        $.notify({
            message: "{{ session('success') }}",
            icon: 'fa fa-check-circle'
        },{
            type: "success",
            placement: { from: "top", align: "center" },
            delay: 3000,
        });
        </script>
    @endif

    @if(session('error'))
    <script>
        $.notify({
            message: "{{ session('error') }}",
            icon: 'fa fa-exclamation-circle'
        },{
            type: "danger",
            placement: { from: "top", align: "center" },
            delay: 3000,
        });
        </script>
    @endif


<script src="{{asset('tinymce\tinymce.min.js')}}"></script>

<script>
    tinymce.init({
      selector: '#myeditor',
      height: 300,
      license_key: 'gpl', // ✅ No API key required
      menubar: false,
      plugins: 'lists link image code',
      toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code',
    });
  </script>

<script>
    $(document).ready(function(){
        $('#add_social').change(function(){
            if($(this).is(':checked')){
                $('#social-fields').slideDown();
            } else {
                $('#social-fields').slideUp();
            }
        });
    });
</script>



<script>
let lastCount = 0;

// 🔹 Count + notifications fetch
function fetchEnquiryCount() {
    $.get("{{ url('/admin/enquiries/latest') }}", function (data) {
        // Sidebar badge
        $('#enquiry-count').text(data.count);

        // Header badge
        $('#header-enquiry-count').text(data.count);

        // Dropdown title
        $('#notif-total').text(data.count);

        // Header dropdown list
        let html = '';
        data.notifications.forEach(function(n) {
            html += `
                <a href="{{ url('/admin/enquiries') }}">
                    <div class="notif-icon notif-primary">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="notif-content">
                        <span class="block">${n.username} sent enquiry</span>
                        <span class="time">${new Date(n.created_at).toLocaleString()}</span>
                    </div>
                </a>`;
        });
        $('#notif-list').html(html);

        // Agar nayi enquiry aayi
        if (data.count > lastCount) {
            // Browser notification
            if (Notification.permission === "granted") {
                new Notification("New CA Services Enquiry!", {
                    body: "You have a new enquiry.",
                    icon: "{{ asset('bell-icon.webp') }}"
                });
            }

            // Sound play
            let audio = new Audio("{{ asset('sounds/notify.mp3') }}");
            audio.play();
        }

        lastCount = data.count;
    });
}

// 🔹 First load + repeat every 15 sec
fetchEnquiryCount();
setInterval(fetchEnquiryCount, 15000);

// 🔹 Browser notification permission request
if (Notification.permission !== "granted") {
    Notification.requestPermission();
}


</script>

<script>
$(document).on('click', '.toggle-details', function () {
    const id = $(this).data('id');
    const detailsRow = $('#details-' + id);
    const icon = $(this).find('i');

    // Toggle visibility
    detailsRow.slideToggle(200);

    // Toggle icon between + and -
    icon.toggleClass('fa-plus fa-minus');
});
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>