@extends('frontend.course.layout')
@section('content')

    <main class="main">

        {{-- ══════════════════════════════════
        1. PAGE TITLE
        ══════════════════════════════════ --}}
        <div class="page-title">
            <div class="heading" style="
                                                                                            background-image: url('assets/img/health/cardiology-2.webp');
                                                                                            background-size: cover;
                                                                                            background-position: center;
                                                                                            position: relative;
                                                                                        ">
                {{-- Dark overlay --}}
                <div style="
                                                                                                position: absolute; inset: 0;
                                                                                                background: rgba(17, 35, 68, 0.65);
                                                                                            "></div>

                <div class="container" style="position: relative; z-index: 1;">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title" style="color:#fff;">Our Events</h1>
                            <p class="mb-0" style="color:rgba(255,255,255,0.8);">
                                Stay connected with our latest programs, workshops, and community gatherings crafted just
                                for you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Events</li>
                    </ol>
                </div>
            </nav>
        </div>

        {{-- ══════════════════════════════════
        4. DYNAMIC EVENTS — uses .services .service-item
        ══════════════════════════════════ --}}
        <section id="services" class="services section light-background">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="section-title">
                    <h2>All Events</h2>
                    <p>Browse and register for our upcoming programs and gatherings</p>
                </div>

                <div class="row gy-4">

                    @forelse($events as $index => $event)
                        @php
                            $delay = 100 + ($index * 50);
                            $start = \Carbon\Carbon::parse($event->event_date);
                            $now = now();
                            $end = $event->event_end_date
                                ? \Carbon\Carbon::parse($event->event_end_date)
                                : $start->copy()->endOfDay();

                            if ($now->lt($start)) {
                                $statusLabel = 'Upcoming';
                                $icon = 'fa-calendar-alt';
                            } elseif ($now->between($start, $end)) {
                                $statusLabel = 'Ongoing';
                                $icon = 'fa-calendar-check';
                            } else {
                                $statusLabel = 'Past';
                                $icon = 'fa-calendar-times';
                            }
                        @endphp

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                            <div class="service-item">

                                <div class="service-image">
                                    @if($event->banner_image)
                                        <img src="{{ asset($event->banner_image) }}" alt="{{ $event->title }}" class="img-fluid">
                                    @else
                                        <img src="assets/img/health/cardiology-2.webp" alt="{{ $event->title }}" class="img-fluid">
                                    @endif
                                    <div class="service-overlay">
                                        <i class="fas {{ $icon }}"></i>
                                    </div>
                                </div>

                                <div class="service-content">
                                    <h3>{{ $event->title }}</h3>
                                    <p>{!! Str::limit(strip_tags($event->description), 500) !!}</p>

                                    <div class="service-features">
                                        <span class="feature-item">
                                            <i class="fas fa-check"></i> {{ $start->format('M j, Y') }}
                                        </span>
                                        <span class="feature-item">
                                            <i class="fas fa-check"></i> {{ $statusLabel }}
                                        </span>
                                    </div>

                                    <a href="{{ route('frontend.events.subevent', $event->id) }}" class="service-btn">
                                        <span>Apply Now</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-calendar-times mb-3 d-block"
                                style="font-size:48px;color:color-mix(in srgb,var(--default-color),transparent 70%);"></i>
                            <p>No events available at the moment. Check back soon!</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>

        {{-- ══════════════════════════════════
        2. WHY JOIN US — uses .departments-tabs .service-item
        ══════════════════════════════════ --}}
        <section class="section" data-aos="fade-up">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Why Join Our Events</h2>
                    <p>More than just an event — an experience worth remembering</p>
                </div>

                <div class="departments-tabs">
                    <div class="row gy-4">

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item d-flex align-items-start">
                                <div class="service-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Community &amp; Connection</h4>
                                    <p>Meet like-minded people, form lasting bonds and grow your network in a welcoming
                                        environment.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                            <div class="service-item d-flex align-items-start">
                                <div class="service-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Learn &amp; Grow</h4>
                                    <p>Hands-on workshops and sessions led by experts designed to inspire and expand your
                                        skills.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="service-item d-flex align-items-start">
                                <div class="service-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Unforgettable Moments</h4>
                                    <p>From opening ceremonies to closing celebrations — every moment is crafted with care.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                            <div class="service-item d-flex align-items-start">
                                <div class="service-icon">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Capture the Memory</h4>
                                    <p>Professional coverage, live highlights, and an online gallery to relive every moment.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="service-item d-flex align-items-start">
                                <div class="service-icon">
                                    <i class="fas fa-certificate"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Certified Participation</h4>
                                    <p>Every participant receives a certificate recognising their involvement and
                                        contribution.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                            <div class="service-item d-flex align-items-start">
                                <div class="service-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Multiple Locations</h4>
                                    <p>Events held across cities so you can always find one near you and participate with
                                        ease.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        {{-- ══════════════════════════════════
        3. GALLERY — uses .gallery .gallery-item
        ══════════════════════════════════ --}}
        {{-- Fancybox CSS --}}


        <section class="gallery section light-background" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Event Gallery</h2>
                    <p>Moments &amp; highlights from our past events</p>
                </div>



                <div style="overflow:hidden;">
                    <div id="evTrack"
                        style="display:flex; gap:16px;
                                                                                                         transition:transform 0.6s cubic-bezier(0.25,0.46,0.45,0.94);">

                        <div class="gallery-item" style="flex:0 0 calc(33.333% - 11px);">
                            <a href="assets/img/health/cardiology-2.webp" data-fancybox="gallery"
                                data-caption="Opening Ceremony">
                                <img src="assets/img/health/cardiology-2.webp" alt="Opening Ceremony" class="img-fluid">
                                <div class="gallery-links d-flex align-items-end justify-content-center pb-3">
                                    <span style="color:#fff;font-size:13px;font-weight:500;">Opening Ceremony</span>
                                </div>
                            </a>
                        </div>

                        <div class="gallery-item" style="flex:0 0 calc(33.333% - 11px);">
                            <a href="assets/img/health/neurology-3.webp" data-fancybox="gallery"
                                data-caption="Workshop Sessions">
                                <img src="assets/img/health/neurology-3.webp" alt="Workshop Sessions" class="img-fluid">
                                <div class="gallery-links d-flex align-items-end justify-content-center pb-3">
                                    <span style="color:#fff;font-size:13px;font-weight:500;">Workshop Sessions</span>
                                </div>
                            </a>
                        </div>

                        <div class="gallery-item" style="flex:0 0 calc(33.333% - 11px);">
                            <a href="assets/img/health/orthopedics-1.webp" data-fancybox="gallery"
                                data-caption="Community Gathering">
                                <img src="assets/img/health/orthopedics-1.webp" alt="Community Gathering" class="img-fluid">
                                <div class="gallery-links d-flex align-items-end justify-content-center pb-3">
                                    <span style="color:#fff;font-size:13px;font-weight:500;">Community Gathering</span>
                                </div>
                            </a>
                        </div>

                        <div class="gallery-item" style="flex:0 0 calc(33.333% - 11px);">
                            <a href="assets/img/health/pediatrics-4.webp" data-fancybox="gallery"
                                data-caption="Award Night">
                                <img src="assets/img/health/pediatrics-4.webp" alt="Award Night" class="img-fluid">
                                <div class="gallery-links d-flex align-items-end justify-content-center pb-3">
                                    <span style="color:#fff;font-size:13px;font-weight:500;">Award Night</span>
                                </div>
                            </a>
                        </div>

                        <div class="gallery-item" style="flex:0 0 calc(33.333% - 11px);">
                            <a href="assets/img/health/emergency-2.webp" data-fancybox="gallery"
                                data-caption="Cultural Program">
                                <img src="assets/img/health/emergency-2.webp" alt="Cultural Program" class="img-fluid">
                                <div class="gallery-links d-flex align-items-end justify-content-center pb-3">
                                    <span style="color:#fff;font-size:13px;font-weight:500;">Cultural Program</span>
                                </div>
                            </a>
                        </div>

                        <div class="gallery-item" style="flex:0 0 calc(33.333% - 11px);">
                            <a href="assets/img/health/laboratory-3.webp" data-fancybox="gallery"
                                data-caption="Closing Ceremony">
                                <img src="assets/img/health/laboratory-3.webp" alt="Closing Ceremony" class="img-fluid">
                                <div class="gallery-links d-flex align-items-end justify-content-center pb-3">
                                    <span style="color:#fff;font-size:13px;font-weight:500;">Closing Ceremony</span>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-3" id="evDots"></div>

            </div>
        </section>

        {{-- ══════════════════════════════════
        YOUTUBE VIDEOS SECTION
        ══════════════════════════════════ --}}
        <section class="section light-background" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Parents Testimonials</h2>
                    <p>Real stories from our event participants</p>
                </div>
                @php
                    $videos = [
                        [
                            'id' => 'VIDEO_ID_1',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_1/mqdefault.jpg',
                            'title' => 'Breaking Beauty Stereotypes | Dark Complexion to Stage Star | Parent Feedback',
                            'desc' => 'It\'s not the skin tone, it\'s the talent that shines! A parent shares the inspiring journey.',
                            'duration' => '2:30',
                        ],
                        [
                            'id' => 'VIDEO_ID_2',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_2/mqdefault.jpg',
                            'title' => 'Working Mom\'s Journey | Weekend Classes Made Dreams Possible | Act to Action',
                            'desc' => 'When dreams are strong, challenges don\'t matter. The inspiring story of a working mother.',
                            'duration' => '2:47',
                        ],
                        [
                            'id' => 'VIDEO_ID_3',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_3/mqdefault.jpg',
                            'title' => 'Dausa Ratna Awardee Aadvika Sharma Success Journey | Parents Feedback',
                            'desc' => 'From Classroom to the Spotlight! Presenting the inspiring journey of Aadvika Sharma.',
                            'duration' => '2:53',
                        ],
                        [
                            'id' => 'VIDEO_ID_4',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_4/mqdefault.jpg',
                            'title' => 'First Time in Family Pranay Malpani did TV Shows, Films & Advertisements',
                            'desc' => 'Breaking Barriers, Creating Firsts! Meet Pranay Malpani, a trailblazer in his family.',
                            'duration' => '2:01',
                        ],
                        [
                            'id' => 'VIDEO_ID_5',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_5/mqdefault.jpg',
                            'title' => 'Benefits of Early Start at Act to Action | Aanya Galav | Kota to Jaipur Every Sunday',
                            'desc' => 'From Kota to Jaipur — Every Sunday. Meet Aanya Galav, a shining example.',
                            'duration' => '3:12',
                        ],
                        [
                            'id' => 'VIDEO_ID_6',
                            'thumb' => 'https://img.youtube.com/vi/VIDEO_ID_6/mqdefault.jpg',
                            'title' => 'Success Story | From Stage Fear to Confidence | Parent Testimonial',
                            'desc' => 'Watch how our events transformed this child\'s confidence and stage presence.',
                            'duration' => '1:55',
                        ],
                    ];
                @endphp
                {{-- VIDEO GRID --}}
                {{-- Prev / Next controls --}}
                <div class="d-flex justify-content-end gap-2 mb-3">
                    <button class="btn btn-sm px-3" id="vidPrev"
                        style="background:var(--accent-color);color:#fff;border:none;">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button class="btn btn-sm px-3" id="vidNext"
                        style="background:var(--accent-color);color:#fff;border:none;">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                {{-- Scrollable track --}}
                <div style="overflow:hidden;">
                    <div id="vidTrack" style="display:flex; gap:16px;
                                                        transition:transform 0.5s cubic-bezier(0.25,0.46,0.45,0.94);">

                        @foreach($videos as $video)
                            <div style="flex:0 0 calc(25% - 12px); min-width:0;">
                                <div class="video-card" onclick="openVideo('{{ $video['id'] }}')"
                                    style="cursor:pointer; background:var(--surface-color);
                                                                                                       border-radius:10px; overflow:hidden;
                                                                                                       box-shadow:0 5px 20px rgba(0,0,0,0.08);
                                                                                                       transition:transform 0.3s, box-shadow 0.3s;"
                                    onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 15px 35px rgba(0,0,0,0.15)'"
                                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">

                                    {{-- Thumbnail --}}
                                    <div style="position:relative; overflow:hidden;">
                                        <img src="{{ $video['thumb'] }}" alt="{{ $video['title'] }}" class="img-fluid w-100"
                                            style="aspect-ratio:16/9; object-fit:cover; display:block;">

                                        {{-- Play overlay --}}
                                        <div
                                            style="position:absolute;inset:0;
                                                                                                                background:rgba(0,0,0,0.25);
                                                                                                                display:flex;align-items:center;justify-content:center;">
                                            <div
                                                style="width:44px;height:44px;border-radius:50%;
                                                                                                                    background:rgba(255,255,255,0.95);
                                                                                                                    display:flex;align-items:center;justify-content:center;
                                                                                                                    box-shadow:0 4px 15px rgba(0,0,0,0.3);">
                                                <i class="fas fa-play"
                                                    style="color:#ff0000;font-size:15px;margin-left:3px;"></i>
                                            </div>
                                        </div>

                                        {{-- Duration --}}
                                        <div
                                            style="position:absolute;bottom:6px;right:8px;
                                                                                                                background:rgba(0,0,0,0.8);color:#fff;
                                                                                                                font-size:11px;font-weight:600;
                                                                                                                padding:2px 6px;border-radius:3px;">
                                            {{ $video['duration'] }}
                                        </div>
                                    </div>

                                    {{-- Info --}}
                                    <div style="padding:12px 14px 16px;">
                                        <h5
                                            style="font-size:13px;font-weight:600;
                                                                                                               color:var(--heading-color);line-height:1.4;
                                                                                                               margin-bottom:5px;
                                                                                                               display:-webkit-box;-webkit-line-clamp:2;
                                                                                                               -webkit-box-orient:vertical;overflow:hidden;">
                                            {{ $video['title'] }}
                                        </h5>
                                        <p
                                            style="font-size:11px;color:color-mix(in srgb,var(--default-color),transparent 35%);
                                                                                                              line-height:1.5;margin:0;
                                                                                                              display:-webkit-box;-webkit-line-clamp:2;
                                                                                                              -webkit-box-orient:vertical;overflow:hidden;">
                                            {{ $video['desc'] }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- Dots --}}
                <div class="d-flex justify-content-center gap-2 mt-3" id="vidDots"></div>
            </div>
        </section>

        {{-- ══════════════════════════════════
        VIDEO MODAL WITH RECOMMENDATIONS
        ══════════════════════════════════ --}}
        <div id="videoModal" style="display:none; position:fixed; inset:0; z-index:99999;
                                                background:rgba(0,0,0,0.92); align-items:center; justify-content:center;
                                                padding:20px;" onclick="closeVideo(event)">

            <div style="position:relative; width:100%; max-width:1100px;
                                                    display:flex; gap:16px; align-items:flex-start;"
                onclick="event.stopPropagation()">

                {{-- Close button --}}
                <button onclick="closeVideo()" style="position:absolute;top:-40px;right:0;
                                                           background:none;border:none;color:#fff;
                                                           font-size:28px;cursor:pointer;line-height:1;z-index:1;">
                    <i class="fas fa-times"></i>
                </button>

                {{-- LEFT: Main video player --}}
                <div style="flex:1; min-width:0;">
                    <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;
                                                            border-radius:10px;box-shadow:0 20px 60px rgba(0,0,0,0.5);">
                        <iframe id="videoFrame" src=""
                            style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                                                                   gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    {{-- Playing title --}}
                    <p id="videoTitle" style="color:#fff;font-size:14px;font-weight:600;
                                                          margin-top:12px;line-height:1.4;"></p>
                </div>

                {{-- RIGHT: Recommended sidebar --}}
                <div
                    style="width:300px; flex-shrink:0;
                                                        max-height:75vh; overflow-y:auto;
                                                        scrollbar-width:thin; scrollbar-color:rgba(255,255,255,0.2) transparent;">

                    <p style="color:rgba(255,255,255,0.6);font-size:12px;
                                                          font-weight:600;text-transform:uppercase;
                                                          letter-spacing:1px;margin-bottom:12px;">
                        Recommended
                    </p>

                    <div id="recommendedList"></div>

                </div>

            </div>
        </div>


        <script>
            // ── your full videos array (same as the grid above) ──
            const allVideos = @json($videos); { { --passes PHP $videos array to JS-- } }

            let currentVideoId = null;

            function openVideo(videoId) {
                const modal = document.getElementById('videoModal');
                const frame = document.getElementById('videoFrame');
                const titleEl = document.getElementById('videoTitle');

                currentVideoId = videoId;
                frame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;

                // set title
                const found = allVideos.find(v => v.id === videoId);
                titleEl.textContent = found ? found.title : '';

                // build recommended list (all except current)
                buildRecommended(videoId);

                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function buildRecommended(excludeId) {
                const list = document.getElementById('recommendedList');
                list.innerHTML = '';

                const recs = allVideos.filter(v => v.id !== excludeId);

                recs.forEach(v => {
                    const item = document.createElement('div');
                    item.style.cssText = [
                        'display:flex', 'gap:10px', 'align-items:flex-start',
                        'margin-bottom:12px', 'cursor:pointer', 'border-radius:8px',
                        'padding:6px', 'transition:background 0.2s'
                    ].join(';');
                    item.onmouseover = () => item.style.background = 'rgba(255,255,255,0.08)';
                    item.onmouseout = () => item.style.background = 'transparent';
                    item.onclick = () => switchVideo(v.id);

                    item.innerHTML = `
                                                <div style="position:relative;flex-shrink:0;width:120px;">
                                                    <img src="${v.thumb}"
                                                         style="width:120px;height:68px;object-fit:cover;
                                                                border-radius:6px;display:block;">
                                                    <div style="position:absolute;bottom:4px;right:5px;
                                                                background:rgba(0,0,0,0.8);color:#fff;
                                                                font-size:10px;font-weight:600;padding:1px 5px;border-radius:3px;">
                                                        ${v.duration}
                                                    </div>
                                                    <div style="position:absolute;inset:0;display:flex;
                                                                align-items:center;justify-content:center;">
                                                        <div style="width:28px;height:28px;border-radius:50%;
                                                                    background:rgba(255,255,255,0.9);
                                                                    display:flex;align-items:center;justify-content:center;">
                                                            <i class="fas fa-play"
                                                               style="color:#ff0000;font-size:10px;margin-left:2px;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="flex:1;min-width:0;">
                                                    <p style="color:#fff;font-size:12px;font-weight:600;
                                                               line-height:1.4;margin:0 0 4px;
                                                               display:-webkit-box;-webkit-line-clamp:2;
                                                               -webkit-box-orient:vertical;overflow:hidden;">
                                                        ${v.title}
                                                    </p>
                                                    <p style="color:rgba(255,255,255,0.45);font-size:11px;margin:0;
                                                               display:-webkit-box;-webkit-line-clamp:2;
                                                               -webkit-box-orient:vertical;overflow:hidden;">
                                                        ${v.desc}
                                                    </p>
                                                </div>
                                            `;

                    list.appendChild(item);
                });
            }

            function switchVideo(videoId) {
                const frame = document.getElementById('videoFrame');
                const titleEl = document.getElementById('videoTitle');

                currentVideoId = videoId;
                frame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;

                const found = allVideos.find(v => v.id === videoId);
                titleEl.textContent = found ? found.title : '';

                // refresh recommended list
                buildRecommended(videoId);

                // scroll sidebar back to top
                document.getElementById('recommendedList').parentElement.scrollTop = 0;
            }

            function closeVideo(event) {
                if (event && event.target !== document.getElementById('videoModal')) return;
                document.getElementById('videoFrame').src = '';
                document.getElementById('videoModal').style.display = 'none';
                document.body.style.overflow = '';
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    document.getElementById('videoFrame').src = '';
                    document.getElementById('videoModal').style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
        </script>
    </main>

    <script>
        function openVideo(videoId) {
            const modal = document.getElementById('videoModal');
            const frame = document.getElementById('videoFrame');

            // autoplay=1 starts video immediately, rel=0 hides unrelated recommendations
            frame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // prevent background scroll
        }

        function closeVideo(event) {
            // if called from overlay click, only close if clicking the backdrop itself
            if (event && event.target !== document.getElementById('videoModal')) return;

            const modal = document.getElementById('videoModal');
            const frame = document.getElementById('videoFrame');

            frame.src = '';  // stops the video
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('videoModal');
                if (modal.style.display === 'flex') {
                    document.getElementById('videoFrame').src = '';
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/5.0.36/fancybox/fancybox.umd.js"></script>
    <script>
        (function () {
            // ── Init Fancybox ──
            Fancybox.bind('[data-fancybox="gallery"]', {
                Thumbs: { type: 'modern' },
                Toolbar: {
                    display: {
                        left: ['infobar'],
                        middle: [],
                        right: ['slideshow', 'fullscreen', 'thumbs', 'close'],
                    },
                },
            });

            // ── Carousel ──
            const track = document.getElementById('evTrack');
            const dotsEl = document.getElementById('evDots');
            const prevBtn = document.getElementById('galPrev');
            const nextBtn = document.getElementById('galNext');
            const toggleBtn = document.getElementById('galToggle');
            const toggleIcon = document.getElementById('galToggleIcon');
            const toggleText = document.getElementById('galToggleText');

            if (!track) return;

            const slides = Array.from(track.children);
            let current = 0;
            let autoTimer = null;
            let isPlaying = true;

            function visible() {
                const w = track.parentElement.offsetWidth;
                if (w < 576) return 1;
                if (w < 992) return 2;
                return 3;
            }

            function maxIdx() { return Math.max(0, slides.length - visible()); }

            function buildDots() {
                dotsEl.innerHTML = '';
                for (let i = 0; i <= maxIdx(); i++) {
                    const d = document.createElement('div');
                    d.style.cssText = [
                        'width:8px', 'height:8px', 'border-radius:50%',
                        'cursor:pointer', 'transition:all 0.25s', 'display:inline-block',
                        `background:${i === 0 ? 'var(--accent-color)' : '#ccc'}`
                    ].join(';');
                    d.addEventListener('click', () => { goTo(i); resetAuto(); });
                    dotsEl.appendChild(d);
                }
            }

            function goTo(idx) {
                current = idx > maxIdx() ? 0 : idx < 0 ? maxIdx() : idx;
                track.style.transform = `translateX(-${current * (slides[0].offsetWidth + 16)}px)`;
                Array.from(dotsEl.children).forEach((d, i) => {
                    d.style.background = i === current ? 'var(--accent-color)' : '#ccc';
                    d.style.transform = i === current ? 'scale(1.4)' : 'scale(1)';
                });
            }

            function startAuto() {
                autoTimer = setInterval(() => goTo(current + 1), 3000);
                isPlaying = true;
                toggleIcon.className = 'fas fa-pause';
                toggleText.textContent = 'Pause';
            }

            function stopAuto() {
                clearInterval(autoTimer);
                isPlaying = false;
                toggleIcon.className = 'fas fa-play';
                toggleText.textContent = 'Play';
            }

            function resetAuto() {
                if (isPlaying) { stopAuto(); startAuto(); }
            }

            prevBtn && prevBtn.addEventListener('click', () => { goTo(current - 1); resetAuto(); });
            nextBtn && nextBtn.addEventListener('click', () => { goTo(current + 1); resetAuto(); });
            toggleBtn && toggleBtn.addEventListener('click', () => isPlaying ? stopAuto() : startAuto());

            buildDots();
            startAuto(); // ← auto-play starts immediately

            window.addEventListener('resize', () => {
                buildDots();
                goTo(Math.min(current, maxIdx()));
            });
        })();
    </script>
    <script>
        (function () {
            const track = document.getElementById('evTrack');
            const dotsEl = document.getElementById('evDots');
            const prevBtn = document.getElementById('galPrev');
            const nextBtn = document.getElementById('galNext');
            if (!track) return;

            const slides = Array.from(track.children);
            let current = 0;

            function visible() {
                const w = track.parentElement.offsetWidth;
                if (w < 576) return 1;
                if (w < 992) return 2;
                return 3;
            }

            function maxIdx() { return Math.max(0, slides.length - visible()); }

            function buildDots() {
                dotsEl.innerHTML = '';
                for (let i = 0; i <= maxIdx(); i++) {
                    const d = document.createElement('div');
                    d.style.cssText = [
                        'width:8px', 'height:8px', 'border-radius:50%',
                        'cursor:pointer', 'transition:all 0.25s', 'display:inline-block',
                        `background:${i === 0 ? 'var(--accent-color)' : '#ccc'}`
                    ].join(';');
                    d.addEventListener('click', () => goTo(i));
                    dotsEl.appendChild(d);
                }
            }

            function goTo(idx) {
                current = Math.max(0, Math.min(idx, maxIdx()));
                track.style.transform = `translateX(-${current * (slides[0].offsetWidth + 16)}px)`;
                Array.from(dotsEl.children).forEach((d, i) => {
                    d.style.background = i === current ? 'var(--accent-color)' : '#ccc';
                    d.style.transform = i === current ? 'scale(1.4)' : 'scale(1)';
                });
            }

            prevBtn && prevBtn.addEventListener('click', () => goTo(current - 1));
            nextBtn && nextBtn.addEventListener('click', () => goTo(current + 1));

            buildDots();
            window.addEventListener('resize', () => { buildDots(); goTo(Math.min(current, maxIdx())); });
        })();
    </script>

@endsection