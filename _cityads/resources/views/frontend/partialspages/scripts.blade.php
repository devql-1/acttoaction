<!-- Vendor JS Files -->
<script src="{{ asset('courseassets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('courseassets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('courseassets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('courseassets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('courseassets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('courseassets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('courseassets/js/main.js') }}"></script>

<script>
    // Filter Featured Courses
    function filterFeatured(catId, btn) {
        document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.featured-item').forEach(item => {
            item.style.display = (catId === 'all' || item.dataset.category == catId) ? '' : 'none';
        });
    }

    // Filter All Courses
    function filterAll(catId, btn) {
        document.querySelectorAll('.all-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.all-course-item').forEach(item => {
            item.style.display = (catId === 'all' || item.dataset.category == catId) ? '' : 'none';
        });
    }
</script>