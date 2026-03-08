@include('frontend.partialspages.head')

<body class="index-page">
    @include('frontend.partialspages.navbar')

    @yield('content')


    @include('frontend.partialspages.footer')
    <!-- Scroll Top -->
    <a href="#!" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    @include('frontend.partialspages.scripts')
</body>
<script>

    document.querySelectorAll('.filter-btn').forEach(button => {

        button.addEventListener('click', function () {

            let filter = this.getAttribute('data-filter');

            document.querySelectorAll('.course-card').forEach(card => {

                if (filter === 'all') {
                    card.style.display = "block";
                    return;
                }

                if (card.getAttribute('data-category') === filter) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }

            });

        });

    });

</script>

</html>