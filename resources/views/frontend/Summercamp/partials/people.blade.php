{{-- resources/views/frontend/partials/people.blade.php --}}
{{-- Requires: $people = ['mentors'=>..., 'speakers'=>..., 'guests'=>..., 'faculty'=>...] --}}

{{-- ① MENTORS --}}
@if ($people['mentors']->isNotEmpty())
    <section class="people-section" id="mentors">
        <div class="container">
            <div class="row align-items-end mb-2">
                <div class="col-md-8">
                    <div class="ppl-label"><i class="bi bi-mortarboard-fill"></i> Mentors</div>
                    <h2 class="ppl-heading">Our Guiding Mentors</h2>
                    <p class="ppl-sub">The visionaries and leaders who shaped the direction of Summer Camp and inspired
                        every child.</p>
                </div>
                <div class="col-md-4 d-flex justify-content-md-end">
                    <div class="ppl-nav">
                        <button class="ppl-arrow" id="mentorPrev"><i class="bi bi-chevron-left"></i></button>
                        <button class="ppl-arrow" id="mentorNext"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="swiper ppl-swiper" id="mentorSwiper">
                <div class="swiper-wrapper">
                    @foreach ($people['mentors'] as $person)
                        <div class="swiper-slide">
                            @include('frontend.Summercamp.partials._person-card', ['person' => $person])
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endif

{{-- ② SPEAKERS --}}
@if ($people['speakers']->isNotEmpty())
    <section class="people-section bg-alt" id="speakers">
        <div class="container">
            <div class="row align-items-end mb-2">
                <div class="col-md-8">
                    <div class="ppl-label"><i class="bi bi-mic-fill"></i> Speakers</div>
                    <h2 class="ppl-heading">Featured Speakers</h2>
                    <p class="ppl-sub">Inspiring voices who addressed the camp — from keynote addresses to motivational
                        masterclasses.</p>
                </div>
                <div class="col-md-4 d-flex justify-content-md-end">
                    <div class="ppl-nav">
                        <button class="ppl-arrow" id="speakerPrev"><i class="bi bi-chevron-left"></i></button>
                        <button class="ppl-arrow" id="speakerNext"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="swiper ppl-swiper" id="speakerSwiper">
                <div class="swiper-wrapper">
                    @foreach ($people['speakers'] as $person)
                        <div class="swiper-slide">
                            @include('frontend.Summercamp.partials._person-card', ['person' => $person])
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endif

{{-- ③ GUESTS --}}
@if ($people['guests']->isNotEmpty())
    <section class="people-section" id="guests">
        <div class="container">
            <div class="row align-items-end mb-2">
                <div class="col-md-8">
                    <div class="ppl-label"><i class="bi bi-star-fill"></i> Guests</div>
                    <h2 class="ppl-heading">Distinguished Guests</h2>
                    <p class="ppl-sub">Honoured guests who graced the camp — from Rajasthan's top officials to acclaimed
                        performing artists.</p>
                </div>
                <div class="col-md-4 d-flex justify-content-md-end">
                    <div class="ppl-nav">
                        <button class="ppl-arrow" id="guestPrev"><i class="bi bi-chevron-left"></i></button>
                        <button class="ppl-arrow" id="guestNext"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="swiper ppl-swiper" id="guestSwiper">
                <div class="swiper-wrapper">
                    @foreach ($people['guests'] as $person)
                        <div class="swiper-slide">
                            @include('frontend.Summercamp.partials._person-card', ['person' => $person])
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endif

{{-- ④ FACULTY --}}
@if ($people['faculty']->isNotEmpty())
    <section class="people-section bg-alt" id="faculty">
        <div class="container">
            <div class="row align-items-end mb-2">
                <div class="col-md-8">
                    <div class="ppl-label"><i class="bi bi-people-fill"></i> Faculty</div>
                    <h2 class="ppl-heading">Our Expert Faculty</h2>
                    <p class="ppl-sub">The dedicated coaches who worked day-in, day-out to bring out the best in every
                        child.</p>
                </div>
                <div class="col-md-4 d-flex justify-content-md-end">
                    <div class="ppl-nav">
                        <button class="ppl-arrow" id="facultyPrev"><i class="bi bi-chevron-left"></i></button>
                        <button class="ppl-arrow" id="facultyNext"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="swiper ppl-swiper" id="facultySwiper">
                <div class="swiper-wrapper">
                    @foreach ($people['faculty'] as $person)
                        <div class="swiper-slide">
                            @include('frontend.Summercamp.partials._person-card', ['person' => $person])
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endif

{{-- ── Swiper init for all 4 carousels ── --}}
<script>
    (function() {
        const swiperConfig = {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: false,
            pagination: {
                clickable: true
            },
            breakpoints: {
                480: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 24
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 28
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 28
                },
            }
        };

        [{
                id: 'mentorSwiper',
                prev: 'mentorPrev',
                next: 'mentorNext'
            },
            {
                id: 'speakerSwiper',
                prev: 'speakerPrev',
                next: 'speakerNext'
            },
            {
                id: 'guestSwiper',
                prev: 'guestPrev',
                next: 'guestNext'
            },
            {
                id: 'facultySwiper',
                prev: 'facultyPrev',
                next: 'facultyNext'
            },
        ].forEach(cfg => {
            const el = document.getElementById(cfg.id);
            if (!el) return;
            const sw = new Swiper('#' + cfg.id, {
                ...swiperConfig,
                pagination: {
                    el: '#' + cfg.id + ' .swiper-pagination',
                    clickable: true
                },
            });
            document.getElementById(cfg.prev)?.addEventListener('click', () => sw.slidePrev());
            document.getElementById(cfg.next)?.addEventListener('click', () => sw.slideNext());
        });
    })();
</script>
