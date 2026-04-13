<!doctype html>
<html lang="en">

@include('frontend.Summercamp.partials.nav')
<style>
    .swiper-wrapper {
        display: flex !important;
    }

    .swiper-slide {
        height: auto !important;
    }
</style>

<body>
    <div id="preloader"></div>

    <!-- ===== ANNOUNCEMENT BAR ===== -->
    <div class="ann-bar" id="annBar">
        <div class="container">
            <div class="inner">
                <span class="dot"></span>
                <span class="msg">🎭 &nbsp;<strong>Summer Camp 2026</strong> — Jaipur's Biggest Performing Arts Camp
                    is Coming! &nbsp;|&nbsp; Drama · Dance · Music · Storytelling</span>
                <a href="tel:9119118844" class="cta">Register Interest</a>
                <button class="close-btn" id="annClose" title="Close"><i class="bi bi-x-lg"></i></button>
            </div>
        </div>
    </div>

    <!-- ===== HEADER ===== -->
    @include('frontend.Summercamp.partials.header')
    {{-- <header class="site-header" id="siteHeader">
        <div class="container">
            <div class="brand">
                <!-- Logo -->
                <a href="https://www.acttoaction.com" class="logo">
                    <img src="https://static.wixstatic.com/media/495d44_61ec90165a4341cb9bb1dde53c1657c6~mv2.png/v1/fill/w_132,h_74,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/4k%20Act%20To%20Action.png"
                        alt="Act To Action" />
                    <h1>Act To Action</h1>
                </a>

                <div class="header-right">
                    <!-- Social icons (desktop only) -->
                    <div class="header-soc">
                        <a href="https://www.instagram.com/acttoaction_" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                        <a href="https://youtube.com/@risingpassion" target="_blank"><i class="bi bi-youtube"></i></a>
                        <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank"><i
                                class="bi bi-whatsapp"></i></a>
                    </div>

                    <!-- Nav -->
                    <div class="nav-wrap" id="navWrap">
                        <nav class="navmenu">
                            <button class="mob-close" id="navClose"><i class="bi bi-x-lg"></i></button>
                            <ul>
                                <li><a href={{ route('workshops') }}>Workshop</a></li>
                                <li><a href="https://www.acttoaction.com/team-4-1">Courses</a></li>

                                <!-- ① WORKSHOPS DROPDOWN -->
                                <li class="has-drop" id="workshopDrop">
                                    <a href="#activities">Workshops <i class="bi bi-chevron-down drop-arrow"></i></a>
                                    <div class="dropdown">
                                        <a href="#activities"><i class="bi bi-mask"></i>Drama &amp; Acting</a>
                                        <a href="#activities"><i class="bi bi-music-note-beamed"></i>Music &amp;
                                            Singing</a>
                                        <a href="#activities"><i class="bi bi-person-hearts"></i>Dance</a>
                                        <a href="#activities"><i class="bi bi-book-half"></i>Storytelling</a>
                                        <a href="#activities"><i class="bi bi-mic-fill"></i>Public Speaking</a>
                                        <a href="#activities"><i class="bi bi-camera-video"></i>Film Acting</a>
                                        <div class="sep"></div>
                                        <a href="#themes"><i class="bi bi-stars"></i>All Programs</a>
                                    </div>
                                </li>

                                <!-- ② EVENTS DROPDOWN -->
                                <li class="has-drop" id="eventsDrop">
                                    <a href="#gallery">Events <i class="bi bi-chevron-down drop-arrow"></i></a>
                                    <div class="dropdown">
                                        <a href="https://www.acttoaction.com/events-1"><i
                                                class="bi bi-calendar-event"></i>Upcoming Events</a>
                                        <a href="#gallery"><i class="bi bi-camera"></i>Summer Camp 2025</a>
                                        <a href="#register"><i class="bi bi-pencil-square"></i>Register 2026</a>
                                        <div class="sep"></div>
                                        <a href="https://www.acttoaction.com/castings"><i class="bi bi-film"></i>Casting
                                            Club</a>
                                    </div>
                                </li>

                                <li><a href="https://www.acttoaction.com/blog">Blog</a></li>
                                <li><a href="https://www.acttoaction.com/about-us-1">About</a></li>
                                <li><a href="#" class="active">Summer Camp</a></li>
                                <li><a href="tel:9119118844" class="nav-register"><i class="bi bi-telephone-fill"></i>
                                        Call Now</a></li>
                            </ul>
                        </nav>
                    </div>
                    <button class="mob-toggle" id="mobToggle"><i class="bi bi-list"></i></button>
                </div>
            </div>
        </div>
    </header> --}}

    <!-- ===== HERO — PURE IMAGE BANNER (no text, no buttons) ===== -->
    @include('frontend.Summercamp.partials.hero-banner')

    <!-- ===== STATS ===== -->
    @include('frontend.Summercamp.partials.stats')
    {{-- <section class="stats-sec" id="stats">
        <div class="container">
            <div class="row g-0">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-ico"><i class="bi bi-people-fill"></i></div><span class="ctr"
                            data-target="500">0<span class="sfx">+</span></span><span class="stat-lbl">Kids
                            Trained</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-ico"><i class="bi bi-geo-alt-fill"></i></div><span class="ctr"
                            data-target="15">0<span class="sfx">+</span></span><span class="stat-lbl">Venue
                            Partners</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-ico"><i class="bi bi-star-fill"></i></div><span class="ctr"
                            data-target="200">0<span class="sfx">+</span></span><span class="stat-lbl">Parent
                            Reviews</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-ico"><i class="bi bi-trophy-fill"></i></div><span class="ctr"
                            data-target="4">0<span class="sfx">+</span></span><span class="stat-lbl">Art
                            Forms</span>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- ===== ABOUT ===== -->
    @include('frontend.Summercamp.partials.about')
    {{-- <section class="about-sec" id="about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <h2 class="section-heading">Performing Arts Summer Camp for Young Dreamers — Jaipur 2025</h2>
                    <p class="lead-p">Act To Action's Summer Camp 2025 brought together young performers from across
                        Jaipur for a transformative journey into performing arts.</p>
                    <p class="body-p">From drama workshops to dance sessions, our expert faculty guided children aged
                        5–17 through immersive experiences that built confidence, creativity and lifelong friendships.
                        The camp was held across 15+ prestigious partner venues — personally recognised by Rajasthan's
                        Deputy CM and Education Minister.</p>
                    <div class="mini-stats">
                        <div class="mini-stat"><span class="num">500</span><span class="lbl">Kids
                                Participated</span></div>
                        <div class="mini-stat"><span class="num">15</span><span class="lbl">Venues in
                                Jaipur</span></div>
                        <div class="mini-stat"><span class="num">4</span><span class="lbl">Art Forms</span>
                        </div>
                    </div>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="tel:9119118844" class="btn-fill"><i class="bi bi-telephone-fill"></i>Call Us Now</a>
                        <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="btn-ghost"><i
                                class="bi bi-whatsapp"></i>WhatsApp</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="about-visual">
                        <div class="about-badge"><span class="yr">2025</span><span class="txt">Summer
                                Camp</span></div>
                        <div class="about-img">
                            <img src="https://static.wixstatic.com/media/495d44_3d0904880d89405289048b015862cffc~mv2.jpg/v1/fill/w_980,h_653,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/495d44_3d0904880d89405289048b015862cffc~mv2.jpg"
                                alt="Exhibition Gate" />
                        </div>
                        <div class="about-fc">
                            <div class="content">
                                <div class="ico"><i class="bi bi-patch-check-fill"></i></div>
                                <div>
                                    <h4>Recognised by Govt. of Rajasthan</h4>
                                    <p>Deputy CM &amp; Education Minister attended</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- ===== THEMES ===== -->
    <section class="themes-sec sec bg-light2" id="themes">
        <div class="container">
            <div class="sec-title">
                <h2>Camp Themes &amp; Categories</h2>
                <p>Explore the diverse performing arts disciplines and creative streams at Summer Camp 2025.</p>
            </div>
            <div class="row g-4">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="theme-card">
                        <div class="theme-ico" style="background:rgba(255,106,0,.1)">🎭</div>
                        <h4>Drama</h4>
                        <p>Stage acting, improvisation &amp; character work</p><span class="theme-tag"
                            style="background:rgba(255,106,0,.1);color:var(--accent)">Performing Arts</span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="theme-card">
                        <div class="theme-ico" style="background:rgba(17,35,68,.08)">💃</div>
                        <h4>Dance</h4>
                        <p>Classical, folk &amp; contemporary styles</p><span class="theme-tag"
                            style="background:rgba(17,35,68,.08);color:#112344">Movement Arts</span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="theme-card">
                        <div class="theme-ico" style="background:rgba(247,181,13,.12)">🎵</div>
                        <h4>Music</h4>
                        <p>Vocals, rhythm &amp; ensemble performance</p><span class="theme-tag"
                            style="background:rgba(247,181,13,.12);color:#b8860b">Sonic Arts</span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="theme-card">
                        <div class="theme-ico" style="background:rgba(5,150,82,.1)">📖</div>
                        <h4>Storytelling</h4>
                        <p>Creative writing &amp; oral narration</p><span class="theme-tag"
                            style="background:rgba(5,150,82,.1);color:#059652">Narrative Arts</span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="theme-card">
                        <div class="theme-ico" style="background:rgba(102,126,234,.1)">🎤</div>
                        <h4>Public Speaking</h4>
                        <p>Confidence &amp; stage presence</p><span class="theme-tag"
                            style="background:rgba(102,126,234,.1);color:#667eea">Communication</span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="theme-card">
                        <div class="theme-ico" style="background:rgba(220,53,69,.1)">🎬</div>
                        <h4>Film Acting</h4>
                        <p>Screen presence &amp; camera techniques</p><span class="theme-tag"
                            style="background:rgba(220,53,69,.1);color:#dc3545">Screen Arts</span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="theme-card">
                        <div class="theme-ico" style="background:rgba(255,106,0,.07)">🎨</div>
                        <h4>Creative Arts</h4>
                        <p>Costume, props &amp; stage design</p><span class="theme-tag"
                            style="background:rgba(255,106,0,.07);color:var(--accent)">Visual Arts</span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="theme-card">
                        <div class="theme-ico" style="background:rgba(17,35,68,.08)">🏆</div>
                        <h4>Grand Finale</h4>
                        <p>Live showcase before dignitaries</p><span class="theme-tag"
                            style="background:rgba(17,35,68,.08);color:#112344">Showcase</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== ACTIVITIES ===== -->
    <section class="sec" id="activities">
        <div class="container">
            <div class="sec-title">
                <h2>Camp Activities &amp; Programs</h2>
                <p>Rich performing arts disciplines designed to nurture every child's unique talent and confidence.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="act-card">
                        <div class="act-ico"><i class="bi bi-mask"></i></div>
                        <h4>Drama &amp; Acting</h4>
                        <p>Stage performances, character building and improvisation for all ages.</p>
                        <ul class="act-list">
                            <li>Character development</li>
                            <li>Stage confidence</li>
                            <li>Script &amp; dialogue</li>
                            <li>Live performances</li>
                        </ul><a href="tel:9119118844" class="act-cta">Enroll Now →</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="act-card">
                        <div class="act-ico"><i class="bi bi-music-note-beamed"></i></div>
                        <h4>Music &amp; Singing</h4>
                        <p>Vocal training, rhythm and ensemble performance in a fun setting.</p>
                        <ul class="act-list">
                            <li>Vocal technique</li>
                            <li>Rhythm &amp; melody</li>
                            <li>Group harmony</li>
                            <li>Recitals &amp; showcases</li>
                        </ul><a href="tel:9119118844" class="act-cta">Enroll Now →</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="act-card">
                        <div class="act-ico"><i class="bi bi-person-hearts"></i></div>
                        <h4>Dance</h4>
                        <p>Classical, folk and contemporary dance by expert choreographers.</p>
                        <ul class="act-list">
                            <li>Classical &amp; folk forms</li>
                            <li>Choreography skills</li>
                            <li>Body coordination</li>
                            <li>Stage performances</li>
                        </ul><a href="tel:9119118844" class="act-cta">Enroll Now →</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="act-card">
                        <div class="act-ico"><i class="bi bi-book-half"></i></div>
                        <h4>Storytelling</h4>
                        <p>Creative writing, oral storytelling and narrative expression.</p>
                        <ul class="act-list">
                            <li>Creative writing</li>
                            <li>Oral narration</li>
                            <li>Imagination exercises</li>
                            <li>Public speaking</li>
                        </ul><a href="tel:9119118844" class="act-cta">Enroll Now →</a>
                    </div>
                </div>
            </div>
            <div class="act-banner mt-5">
                <div class="row align-items-center g-4">
                    <div class="col-md-8">
                        <h3>Summer Camp 2026 is Coming Soon!</h3>
                        <p>Be the first to know when registrations open. Call us or chat on WhatsApp to join the
                            priority list.</p>
                    </div>
                    <div class="col-md-4 text-md-end"><a href="tel:9119118844" class="act-btn"><i
                                class="bi bi-telephone-fill"></i>+91 91191 88844</a></div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== GALLERY ===== -->

    {{-- <section class="gallery-sec" id="gallery">
        <div class="gallery-header">
            <div class="g-eyebrow"><span></span>Photo Gallery<span></span></div>
            <h2>Summer Camp 2025 — Memories</h2>
            <p>Click any photo to view full size &nbsp;·&nbsp; Hover to pause scrolling</p>
        </div>
        <div class="gallery-tabs">
            <button class="gtab active" data-tab="all">✨ All Photos</button>
            <button class="gtab" data-tab="opening">🎉 Opening Day</button>
            <button class="gtab" data-tab="activities">🎭 Activities</button>
            <button class="gtab" data-tab="finale">🏆 Grand Finale</button>
            <button class="gtab" data-tab="dignitaries">⭐ Dignitaries</button>
        </div>

        <!-- ALL -->
        <div class="gallery-panel active" id="tab-all">
            <div class="scroll-strip">
                <div class="scroll-track fwd" id="strip1"></div>
            </div>
            <div class="scroll-strip" style="margin-top:8px">
                <div class="scroll-track bwd" id="strip2"></div>
            </div>
            <div class="scroll-strip" style="margin-top:8px">
                <div class="scroll-track fwd2" id="strip3"></div>
            </div>
        </div>

        <!-- OPENING DAY -->
        <div class="gallery-panel" id="tab-opening">
            <div class="g-featured layout-1">
                <div class="gf-item gf-hero"><img
                        src="https://static.wixstatic.com/media/495d44_3d0904880d89405289048b015862cffc~mv2.jpg/v1/fill/w_980,h_653,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/495d44_3d0904880d89405289048b015862cffc~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gf-over"><i class="bi bi-zoom-in"></i></div>
                    <div class="gf-caption">🏛️ Exhibition Gate — Opening Day</div>
                </div>
                <div class="gf-item"><img
                        src="https://static.wixstatic.com/media/495d44_163571d9312a4ca7a5c6fbdf118e969d~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gf-over"><i class="bi bi-zoom-in"></i></div>
                    <div class="gf-caption">Welcome Ceremony</div>
                </div>
                <div class="gf-item"><img
                        src="https://static.wixstatic.com/media/495d44_f87011fbba8d4d36b3c5d8c59f081bb9~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gf-over"><i class="bi bi-zoom-in"></i></div>
                    <div class="gf-caption">Opening Moments</div>
                </div>
                <div class="gf-item"><img
                        src="https://static.wixstatic.com/media/495d44_6085428d3a894fada8c6c17c076f27ad~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gf-over"><i class="bi bi-zoom-in"></i></div>
                    <div class="gf-caption">Young Performers</div>
                </div>
                <div class="gf-item"><img
                        src="https://static.wixstatic.com/media/495d44_ef037c9c3a954b80b527b5dc66c86d9a~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gf-over"><i class="bi bi-zoom-in"></i></div>
                    <div class="gf-caption">First Day Energy</div>
                </div>
            </div>
        </div>

        <!-- ACTIVITIES -->
        <div class="gallery-panel" id="tab-activities">
            <div class="g-masonry">
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_42fb48ae47be4e809a3015afee67e25d~mv2.jpg/v1/fill/w_980,h_652,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/495d44_42fb48ae47be4e809a3015afee67e25d~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Drama
                        Session</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_870cf27ca182402086d7d842a45c2c40~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Dance
                        Practice</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_3ae60b4311eb4ac0b88771f8bbedcd74~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Music
                        Workshop</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_48c11cecdbed42e1a85e9ca816c84a7e~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Acting
                        Class</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_c4580477f5b641e281509db654cc1a5f~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span
                        class="gm-label">Storytelling</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_d08531b8eac04125a23020ffd72de421~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Stage
                        Rehearsal</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_f6b0a5ff844342d79d2b50fb08828af8~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Group
                        Performance</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_01c4bbd9aac54554ae1726725c6099fa~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Voice
                        Training</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_fe0f5cbcf68741a1b7e868fdbb6d2fe9~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span
                        class="gm-label">Choreography</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_d190f5f58b2b403abdb89986e5f5969f~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Creative
                        Writing</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_6c3a8b405200468b8967ba20505ffd28~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Script
                        Reading</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_25a1eb5fa42a4f6a984c03e27c442b83~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Stage
                        Confidence</span>
                </div>
            </div>
        </div>

        <!-- GRAND FINALE -->
        <div class="gallery-panel" id="tab-finale">
            <div style="padding:8px 16px 0">
                <div class="gf-item" style="border-radius:12px;overflow:hidden;height:300px;cursor:pointer">
                    <img src="https://static.wixstatic.com/media/495d44_64b07e4b9b3d48b4836d731743282713~mv2.jpg/v1/fill/w_980,h_550,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/495d44_64b07e4b9b3d48b4836d731743282713~mv2.jpg"
                        style="width:100%;height:100%;object-fit:cover;display:block;transition:.4s" loading="lazy"
                        alt="Grand Finale" />
                    <div class="gf-over"><i class="bi bi-zoom-in"></i></div>
                    <div class="gf-caption">🏆 Grand Finale — Summer Camp 2025</div>
                </div>
            </div>
            <div class="scroll-strip" style="margin-top:8px">
                <div class="scroll-track fwd" id="finaleStrip"></div>
            </div>
        </div>

        <!-- DIGNITARIES -->
        <div class="gallery-panel" id="tab-dignitaries">
            <div class="g-masonry" style="columns:3 200px">
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_aa799d19592843bdb0447450efa3e356~mv2.jpg/v1/fill/w_490,h_327,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/download%20(4).jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Deputy CM
                        Visit</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_5bfd7fe09d924795b3aeec24eba8217d~mv2.jpg/v1/crop/x_0,y_176,w_1600,h_1044/fill/w_490,h_320,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/download%20(5).jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Education
                        Minister</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_d2447492adaf40a4ad3fc1b10049df68~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Official
                        Ceremony</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_c7f6f4c50b8740cabb3232cee1cac7ab~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Award
                        Ceremony</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_b82d5022d5184fffbb77a6921106e754~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span
                        class="gm-label">Felicitation</span>
                </div>
                <div class="gm-item"><img
                        src="https://static.wixstatic.com/media/495d44_042be3d12ca741be9106d65518303874~mv2.jpg"
                        loading="lazy" alt="" />
                    <div class="gm-over"><i class="bi bi-zoom-in"></i></div><span class="gm-label">Dignitaries &amp;
                        Faculty</span>
                </div>
            </div>
        </div>

        <div class="g-footer">
            <a href="https://www.instagram.com/acttoaction_" target="_blank"><i class="bi bi-instagram"></i> View
                more on Instagram @acttoaction_</a>
        </div>
    </section> --}}


    <div class="lb-back" id="lb">
        <button class="lb-prev" id="lbPrev"><i class="bi bi-chevron-left"></i></button>
        <div class="lb-inner">
            <button class="lb-close" id="lbClose"><i class="bi bi-x-lg"></i></button>
            <img id="lbImg" src="" alt="" />
            <div class="lb-counter" id="lbCounter"></div>
        </div>
        <button class="lb-next" id="lbNext"><i class="bi bi-chevron-right"></i></button>
    </div>

    <!-- ===== MENTORS ===== -->
    <section class="people-section" id="mentors">
        <div class="container">
            <div class="row align-items-end mb-2">
                <div class="col-md-8">
                    <div class="ppl-label"><i class="bi bi-mortarboard-fill"></i> Mentors</div>
                    <h2 class="ppl-heading">Our Guiding Mentors</h2>
                    <p class="ppl-sub">The visionaries and leaders who shaped the direction of Summer Camp 2025 and
                        inspired every child.</p>
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
                    <div class="swiper-slide">
                        <div class="ppl-card">
                            <div class="ppl-photo"><span class="ppl-role-badge">Chief Mentor</span><img
                                    src="https://static.wixstatic.com/media/495d44_aa799d19592843bdb0447450efa3e356~mv2.jpg/v1/fill/w_490,h_327,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/download%20(4).jpg"
                                    alt="" />
                                <div class="ppl-hover-overlay">
                                    <div class="ppl-hover-name">Sh. Premchand Bairwa</div>
                                    <div class="ppl-hover-links"><a href="https://dainik.bhaskar.com/NYl94V9hPSb"
                                            target="_blank" class="ppl-link"><i
                                                class="bi bi-newspaper"></i>Press</a><a
                                            href="https://www.instagram.com/acttoaction_" target="_blank"
                                            class="ppl-link"><i class="bi bi-instagram"></i>Instagram</a></div>
                                </div>
                            </div>
                            <div class="ppl-body">
                                <h4>Sh. Premchand Bairwa</h4><span class="ppl-desig">Deputy Chief Minister,
                                    Rajasthan</span>
                                <p>Personally graced the camp and inspired hundreds of young artists with his vision for
                                    creative education.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ppl-card">
                            <div class="ppl-photo"><span class="ppl-role-badge">Policy Mentor</span><img
                                    src="https://static.wixstatic.com/media/495d44_5bfd7fe09d924795b3aeec24eba8217d~mv2.jpg/v1/crop/x_0,y_176,w_1600,h_1044/fill/w_490,h_320,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/download%20(5).jpg"
                                    alt="" />
                                <div class="ppl-hover-overlay">
                                    <div class="ppl-hover-name">Sh. Madan Dilawar</div>
                                    <div class="ppl-hover-links"><a href="https://dainik.bhaskar.com/eLW8C7eqFSb"
                                            target="_blank" class="ppl-link"><i
                                                class="bi bi-newspaper"></i>Press</a><a
                                            href="https://www.instagram.com/acttoaction_" target="_blank"
                                            class="ppl-link"><i class="bi bi-instagram"></i>Instagram</a></div>
                                </div>
                            </div>
                            <div class="ppl-body">
                                <h4>Sh. Madan Dilawar</h4><span class="ppl-desig">Education Minister, Rajasthan</span>
                                <p>Attended the grand finale and praised children's performances — a state-level
                                    milestone.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ppl-card">
                            <div class="ppl-photo"><span class="ppl-role-badge">Creative Mentor</span><img
                                    src="https://static.wixstatic.com/media/495d44_64b07e4b9b3d48b4836d731743282713~mv2.jpg/v1/fill/w_490,h_327,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/495d44_64b07e4b9b3d48b4836d731743282713~mv2.jpg"
                                    alt="" />
                                <div class="ppl-hover-overlay">
                                    <div class="ppl-hover-name">Act To Action Director</div>
                                    <div class="ppl-hover-links"><a href="https://www.instagram.com/acttoaction_"
                                            target="_blank" class="ppl-link"><i
                                                class="bi bi-instagram"></i>Instagram</a><a
                                            href="https://youtube.com/@risingpassion" target="_blank"
                                            class="ppl-link"><i class="bi bi-youtube"></i>YouTube</a></div>
                                </div>
                            </div>
                            <div class="ppl-body">
                                <h4>Act To Action Director</h4><span class="ppl-desig">Founder, Rising Passion
                                    Studio</span>
                                <p>The visionary behind the camp's curriculum — 10+ years building performing arts
                                    education in Jaipur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ppl-card">
                            <div class="ppl-photo"><span class="ppl-role-badge">Lead Mentor</span><img
                                    src="https://static.wixstatic.com/media/495d44_42fb48ae47be4e809a3015afee67e25d~mv2.jpg/v1/fill/w_490,h_327,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/495d44_42fb48ae47be4e809a3015afee67e25d~mv2.jpg"
                                    alt="" />
                                <div class="ppl-hover-overlay">
                                    <div class="ppl-hover-name">Senior Arts Trainer</div>
                                    <div class="ppl-hover-links"><a href="https://www.instagram.com/acttoaction_"
                                            target="_blank" class="ppl-link"><i
                                                class="bi bi-instagram"></i>Instagram</a></div>
                                </div>
                            </div>
                            <div class="ppl-body">
                                <h4>Senior Performing Arts Trainer</h4><span class="ppl-desig">Drama &amp; Script
                                    Coach</span>
                                <p>Guided 200+ children through drama and storytelling with passion and creativity.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="act-banner mt-5">
                <div class="row align-items-center g-4">
                    <div class="col-md-8">
                        <h3>Explore Our Summer Camp Partners</h3>
                        <p>Discover our trusted partners and find the perfect summer camp for your child.</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="#" class="act-btn">
                            <i class="bi bi-people-fill"></i>
                            View Partners
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <!-- ===== SPEAKERS ===== -->
    @include('frontend.Summercamp.partials.people')


    <!-- ===== VIDEOS ===== -->
    <section class="video-sec" id="videos">
        <div class="container">
            <div class="sec-title" style="padding-bottom: 0%;">
                <h2>Videos &amp; Media Coverage</h2>
                <p>Watch highlights from Summer Camp 2025 — performances, moments and media features.</p>
            </div>
            @include('frontend.partialspages.youtube', ['videos' => $videos])
            {{-- <p class="text-center mt-3" style="font-size:13px;color:#aaa;">Replace the YouTube embed URLs in each
                <code>onclick="openVid(...)"</code> with your actual video IDs.</p> --}}
        </div>
    </section>

    @include('frontend.Summercamp.partials.gallery')
    <!-- ===== CTA ===== -->
    <section class="cta-sec" id="register">
        <div class="container">
            <div class="row align-items-center g-5 mb-5">
                <div class="col-lg-6">
                    <h1>Ready for Summer Camp 2026?</h1>
                    <p class="desc">Registrations are opening soon. Call us today to secure your child's spot and be
                        part of Jaipur's biggest performing arts summer camp.</p>
                    <div class="cta-links">
                        <a href="tel:9119118844" class="cta-link-main"><i class="bi bi-telephone-fill"></i>Call Now:
                            +91 91191 88844 <i class="bi bi-arrow-right"></i></a>
                        <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="cta-link-sub"><i
                                class="bi bi-whatsapp"></i>Chat on WhatsApp <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://static.wixstatic.com/media/495d44_64b07e4b9b3d48b4836d731743282713~mv2.jpg/v1/fill/w_980,h_550,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/495d44_64b07e4b9b3d48b4836d731743282713~mv2.jpg"
                        style="width:100%;height:420px;object-fit:cover;border-radius:12px;" alt="Grand Finale" />
                </div>
            </div>
            <div class="feat-row">
                <div class="feat-blk"><i class="bi bi-award-fill"></i>
                    <h3>Expert Faculty</h3>
                    <p>Trained performing arts professionals guiding your child through every step.</p>
                </div>
                <div class="feat-blk"><i class="bi bi-geo-alt-fill"></i>
                    <h3>15+ Venues</h3>
                    <p>Held across prestigious schools and institutions throughout Jaipur.</p>
                </div>
                <div class="feat-blk"><i class="bi bi-people-fill"></i>
                    <h3>500+ Kids</h3>
                    <p>A large community of young artists building friendships and creativity.</p>
                </div>
                <div class="feat-blk"><i class="bi bi-patch-check-fill"></i>
                    <h3>Govt. Recognised</h3>
                    <p>Recognised by the Government of Rajasthan, featured in leading media.</p>
                </div>
            </div>
            <div class="cta-contact">
                <div class="row align-items-center">
                    <div class="col-lg-8 mb-3 mb-lg-0">
                        <h2>Secure Your Child's Spot for Summer Camp 2026</h2>
                        <p>Don't miss out — slots fill up fast. Contact us today to register your interest.</p>
                    </div>
                    <div class="col-lg-4">
                        <div class="cta-actions">
                            <a href="tel:9119118844" class="cta-phone"><i class="bi bi-telephone-fill"></i>+91 91191
                                88844</a>
                            <a href="https://wa.me/message/PE3X4SUC2OJTB1" target="_blank" class="cta-wa"><i
                                    class="bi bi-whatsapp me-1"></i>Chat on WhatsApp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONIALS ===== -->
    <section class="test-sec sec" id="testimonials">
        <div class="container">
            <div class="sec-title">
                <h2>What Parents Say</h2>
                <p>Hear from families whose children transformed through Act To Action Summer Camp 2025.</p>
            </div>
            <div class="swiper ts-swiper" id="tsSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="test-item">
                            <div class="test-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i></div>
                            <p class="test-text">"My daughter came home every day glowing with excitement. The drama
                                sessions built her confidence in ways I never imagined."</p>
                            <div class="test-profile"><img
                                    src="https://static.wixstatic.com/media/495d44_163571d9312a4ca7a5c6fbdf118e969d~mv2.jpg"
                                    alt="" />
                                <div>
                                    <h4>Priya Sharma <i class="bi bi-patch-check-fill"></i></h4><span>Parent ·
                                        Vaishali Nagar, Jaipur</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="test-item">
                            <div class="test-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i></div>
                            <p class="test-text">"My son was very shy before camp. After storytelling and music
                                sessions, he was performing on stage in front of hundreds. Truly life-changing."</p>
                            <div class="test-profile"><img
                                    src="https://static.wixstatic.com/media/495d44_f87011fbba8d4d36b3c5d8c59f081bb9~mv2.jpg"
                                    alt="" />
                                <div>
                                    <h4>Rajesh Gupta <i class="bi bi-patch-check-fill"></i></h4><span>Parent · Malviya
                                        Nagar, Jaipur</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="test-item">
                            <div class="test-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i></div>
                            <p class="test-text">"The faculty was exceptional. The fact that the Deputy CM and
                                Education Minister personally attended says it all!"</p>
                            <div class="test-profile"><img
                                    src="https://static.wixstatic.com/media/495d44_6085428d3a894fada8c6c17c076f27ad~mv2.jpg"
                                    alt="" />
                                <div>
                                    <h4>Sunita Agarwal <i class="bi bi-patch-check-fill"></i></h4><span>Parent ·
                                        C-Scheme, Jaipur</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="test-item">
                            <div class="test-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i></div>
                            <p class="test-text">"We enrolled both our kids — one in dance, one in acting. They made
                                new friends and came back with a completely different level of confidence."</p>
                            <div class="test-profile"><img
                                    src="https://static.wixstatic.com/media/495d44_ef037c9c3a954b80b527b5dc66c86d9a~mv2.jpg"
                                    alt="" />
                                <div>
                                    <h4>Amit &amp; Kavita Joshi <i class="bi bi-patch-check-fill"></i></h4>
                                    <span>Parents · Mansarovar, Jaipur</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- ===== PARTNERS + CONTACT ===== -->
    <section class="partner-sec sec bg-light2" id="partners">
        <div class="container">
            <div class="sec-title">
                <h2>Venue Partners</h2>
                <p>Summer Camp 2025 was hosted across prestigious schools, institutions and studios across Jaipur.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="ci-item">
                        <div class="ci-icon"><i class="bi bi-building"></i></div>
                        <div>
                            <h3>School &amp; Institutional Partners</h3>
                            <p>Mayoor · Vedanta · The Little Starlings · Xavier · SRN School · Kalaneri · Remana · MGIS
                                · Riya International · Royal · Sanskar · Creative Cubs</p>
                        </div>
                    </div>
                    <div class="ci-item">
                        <div class="ci-icon"><i class="bi bi-stars"></i></div>
                        <div>
                            <h3>Associate Partners</h3>
                            <p>Creare · ATA · Gemini · Skillonation</p>
                        </div>
                    </div>
                    <div class="ci-item">
                        <div class="ci-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h3>Studio Location</h3>
                            <p>Rising Passion Studio, Hoshiar Singh Marg, Moti Nagar, Vaishali Nagar, Jaipur – 302021
                            </p>
                        </div>
                    </div>
                    <div class="ci-item">
                        <div class="ci-icon"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <h3>Operating Hours</h3>
                            <p>Tuesday – Saturday: 11am – 7pm &nbsp;·&nbsp; Sunday: 10am – 4pm</p>
                        </div>
                    </div>
                    <div class="ci-item">
                        <div class="ci-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <h3>Phone</h3>
                            <p><a href="tel:9119118844">+91 91191 88844</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-form-card">
                        <h2>Get in Touch</h2>
                        <p class="sub">Interested in Summer Camp 2026? Send us a message.</p>
                        <input type="text" class="form-control" placeholder="Your Child's Name" />
                        <input type="text" class="form-control" placeholder="Parent's Phone Number" />
                        <input type="email" class="form-control" placeholder="Email Address" />
                        <textarea class="form-control" placeholder="Art Form Interest / Message"></textarea>
                        <button class="btn-submit" onclick="alert('Thank you! We will contact you soon.')">Send
                            Enquiry</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->

    @include('frontend.Summercamp.partials.footer')
    <a href="#" class="scroll-top" id="scrollTop"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        /* ── PRELOADER ── */
        window.addEventListener('load', () => {
            const p = document.getElementById('preloader');
            if (p) {
                p.style.opacity = '0';
                setTimeout(() => p.style.display = 'none', 600);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {

            /* ── ANNOUNCEMENT BAR ── */
            const annBar = document.getElementById('annBar');
            const annClose = document.getElementById('annClose');
            const siteHdr = document.getElementById('siteHeader');

            if (annClose && annBar && siteHdr) {
                annClose.addEventListener('click', () => {
                    annBar.classList.add('hidden');
                    siteHdr.classList.add('ann-gone');
                    document.body.classList.add('ann-gone');
                    document.documentElement.style.setProperty('--ann-h', '0px');
                });
            }

            /* ── SCROLL TOP ── */
            const scrollTopBtn = document.getElementById('scrollTop');
            if (scrollTopBtn) {
                window.addEventListener('scroll', () => {
                    scrollTopBtn.classList.toggle('show', window.scrollY > 120);
                });

                scrollTopBtn.addEventListener('click', e => {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            /* ── MOBILE NAV ── */
            const mobToggle = document.getElementById('mobToggle');
            const navWrap = document.getElementById('navWrap');
            const navClose = document.getElementById('navClose');

            mobToggle?.addEventListener('click', () => navWrap?.classList.add('open'));
            navClose?.addEventListener('click', () => navWrap?.classList.remove('open'));

            navWrap?.addEventListener('click', e => {
                if (e.target === navWrap) navWrap.classList.remove('open');
            });

            document.querySelectorAll('.has-drop > a').forEach(link => {
                link.addEventListener('click', e => {
                    if (window.innerWidth <= 1099) {
                        e.preventDefault();
                        link.parentElement.classList.toggle('open');
                    }
                });
            });

            /* ── LIGHTBOX KEYBOARD ── */
            document.addEventListener('keydown', function(e) {
                const lb = document.getElementById('lb');
                if (!lb || !lb.classList.contains('open')) return;

                if (e.key === 'ArrowLeft') document.getElementById('lbPrev')?.click();
                if (e.key === 'ArrowRight') document.getElementById('lbNext')?.click();
                if (e.key === 'Escape') closeLB();
            });

            /* ── LIGHTBOX ── */
            let lbImages = [],
                lbIndex = 0;

            window.openLB = function(src, imgs) {
                lbImages = imgs.filter(Boolean);
                lbIndex = Math.max(0, lbImages.indexOf(src));
                showLB();
                document.getElementById('lb').classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function showLB() {
                document.getElementById('lbImg').src = lbImages[lbIndex];
                document.getElementById('lbCounter').textContent = `${lbIndex + 1} / ${lbImages.length}`;
            }

            window.closeLB = function() {
                document.getElementById('lb').classList.remove('open');
                document.body.style.overflow = '';
            }

            document.getElementById('lbClose')?.addEventListener('click', closeLB);
            document.getElementById('lbPrev')?.addEventListener('click', () => {
                lbIndex = (lbIndex - 1 + lbImages.length) % lbImages.length;
                showLB();
            });
            document.getElementById('lbNext')?.addEventListener('click', () => {
                lbIndex = (lbIndex + 1) % lbImages.length;
                showLB();
            });

            /* ── SAFE SWIPER FUNCTION ── */
            function safeSwiper(selector, config) {
                const el = document.querySelector(selector);
                if (!el) return null;
                return new Swiper(el, config);
            }

            /* ── MENTOR SWIPER ── */
            const mentorSwiper = safeSwiper('#mentorSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                speed: 600,

                pagination: {
                    el: '#mentorSwiper .swiper-pagination',
                    clickable: true
                },

                breakpoints: {
                    480: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },
                    1280: {
                        slidesPerView: 4
                    }
                }
            });

            document.getElementById('mentorPrev')?.addEventListener('click', () => mentorSwiper?.slidePrev());
            document.getElementById('mentorNext')?.addEventListener('click', () => mentorSwiper?.slideNext());

            /* ── TESTIMONIAL SWIPER ── */
            safeSwiper('#tsSwiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '#tsSwiper .swiper-pagination',
                    clickable: true
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2
                    },
                    1200: {
                        slidesPerView: 3
                    }
                }
            });

            /* ── COUNTER ── */
            const statsSec = document.getElementById('stats');
            if (statsSec) {
                let counted = false;

                new IntersectionObserver(entries => {
                    if (entries[0].isIntersecting && !counted) {
                        counted = true;

                        document.querySelectorAll('.ctr[data-target]').forEach(el => {
                            const target = +el.getAttribute('data-target');
                            let cur = 0;
                            const step = Math.ceil(target / 60);

                            const t = setInterval(() => {
                                cur = Math.min(cur + step, target);
                                el.innerHTML = cur;
                                if (cur >= target) clearInterval(t);
                            }, 22);
                        });
                    }
                }, {
                    threshold: 0.3
                }).observe(statsSec);
            }

            /* ── VIDEO MODAL ── */
            window.openVid = function(url) {
                document.getElementById('vidFrame').src = url + '?autoplay=1';
                document.getElementById('vidModal').classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            window.closeVid = function() {
                document.getElementById('vidFrame').src = '';
                document.getElementById('vidModal').classList.remove('open');
                document.body.style.overflow = '';
            }

        });
    </script>
</body>

</html>
