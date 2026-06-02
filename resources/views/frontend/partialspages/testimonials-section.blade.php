@php
    $sectionTitle = $sectionTitle ?? 'Parents Testimonials';
    $sectionDesc =
        $sectionDesc ??
        'Real stories from families whose children found their voice, confidence and craft at Act to Action.';
    $ytChannel = $ytChannel ?? 'https://youtube.com/@risingpassion';
    $igHandle = $igHandle ?? '@acttoaction_';
    $igUrl = 'https://www.instagram.com/' . ltrim($igHandle, '@');
    $showInstagram = $showInstagram ?? true;

    $igPosts = [
        [
            'img' =>
                'https://scontent-den2-1.cdninstagram.com/v/t51.71878-15/641419806_1555713928850209_1082800630066777592_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=110&ccb=7-5&_nc_sid=18de74&_nc_ohc=7Dh6VQtYzZwQ7kNvwGsKPcP&_nc_ht=scontent-den2-1.cdninstagram.com&oh=00_AfzKP_64ZCsr31CQ1jMMi5jSj4xTEaJXh6deJRy4mxh6rA&oe=69B85501',
            'fb' => 'https://images.unsplash.com/photo-1503095396549-807759245b35?w=600',
            'cap' =>
                "There's no power like the power of a story told together.\n\nWe came, we performed, and we're just getting started!",
            'tags' => ['#ActToAction', '#KuchBadaKaro', '#StreetPlay', '#NukkadNatak'],
            'type' => 'reel',
        ],
        [
            'img' =>
                'https://scontent-den2-1.cdninstagram.com/v/t51.71878-15/642995574_1434865508019922_6831886684256629567_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=100&ccb=7-5&_nc_sid=18de74&_nc_ohc=_GXls7-bm0gQ7kNvwHEUFGW&_nc_ht=scontent-den2-1.cdninstagram.com&oh=00_AfxJnrOBLuZrsAvUZ_FTzZ4atbpr4PgDvKG6SxLDCMeIGA&oe=69B870E9',
            'fb' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600',
            'cap' => 'The buzz around the Act to Action booth was incredible!',
            'tags' => ['#ActToAction', '#EmpoweringYouth', '#FICCIFLOJaipur'],
            'type' => 'reel',
        ],
        [
            'img' =>
                'https://scontent-den2-1.cdninstagram.com/v/t51.82787-15/642489611_18133815724518628_7670526883441129105_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=111&ccb=7-5&_nc_sid=18de74&_nc_ohc=WFpfVx1EuSkQ7kNvwGhurYj&_nc_ht=scontent-den2-1.cdninstagram.com&oh=00_AfxwjRKnWCf5CCWnDye7r-ESL3N8sjyC8Fdlu_RUyo55eg&oe=69B861B5',
            'fb' => 'https://images.unsplash.com/photo-1549737221-bef65e2604a6?w=600',
            'cap' => 'When Gen Alpha meets legacy entrepreneurs.',
            'tags' => ['#ActToAction', '#HumanIntelligence', '#GenAlpha'],
            'type' => 'carousel',
        ],
        [
            'img' =>
                'https://scontent-den2-1.cdninstagram.com/v/t51.71878-15/629205528_940446055174611_240539305886177698_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=105&ccb=7-5&_nc_sid=18de74&_nc_ohc=eCRKQe5NsaYQ7kNvwFDxm8a&_nc_ht=scontent-den2-1.cdninstagram.com&oh=00_AfyCo1ZZYJswGr3qCXW26neV68nfwREja6094nSeHIMAbA&oe=69B87ED1',
            'fb' => 'https://images.unsplash.com/photo-1588702547954-4800eb827c08?w=600',
            'cap' => 'The cosmos dances to the rhythm of Mahadev. 🔱',
            'tags' => ['#acttoaction', '#nanhekalakar', '#shiva'],
            'type' => 'reel',
        ],
        [
            'img' =>
                'https://scontent-den2-1.cdninstagram.com/v/t51.71878-15/622025181_875874845188741_2864669811760520803_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=104&ccb=7-5&_nc_sid=18de74&_nc_ohc=2naZBQWzZcAQ7kNvwFMWSn2&_nc_ht=scontent-den2-1.cdninstagram.com&oh=00_AfwmmQhPt4xte1t501PEbgR_lkrP4nqGNn-mqigf-Ev43g&oe=69B87B65',
            'fb' => 'https://images.unsplash.com/photo-1560523159-4a9692d222ef?w=600',
            'cap' => 'When real cinema becomes the classroom. 🎬',
            'tags' => ['#ActToAction', '#NukkadNatakKarwan', '#YoungActors'],
            'type' => 'reel',
        ],
        [
            'img' =>
                'https://scontent-den2-1.cdninstagram.com/v/t51.71878-15/623037715_1424572239251577_5102042722729972561_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=111&ccb=7-5&_nc_sid=18de74&_nc_ohc=f_lNdC5t7scQ7kNvwHPvR8Q&_nc_ht=scontent-den2-1.cdninstagram.com&oh=00_Afy_AjaMF-rJhSG4W5Jq_rnyRGCBlZM3B2mj61MORKp5eQ&oe=69B87FC7',
            'fb' => 'https://images.unsplash.com/photo-1616469829526-7057a1427626?w=600',
            'cap' => 'Scene work with Bollywood filmmakers in Jaipur.',
            'tags' => ['#ActToAction', '#SceneWork', '#JaipurActing'],
            'type' => 'reel',
        ],
        [
            'img' => 'https://images.unsplash.com/photo-1605296867304-46d5465a13f1?w=600',
            'fb' => 'https://images.unsplash.com/photo-1605296867304-46d5465a13f1?w=600',
            'cap' => 'Cyber AI Threat Conclave 2024 was magical! ✨',
            'tags' => ['#SummerCamp', '#ActToAction', '#Jaipur'],
            'type' => 'photo',
        ],
        [
            'img' => 'https://images.unsplash.com/photo-1503095396549-807759245b35?w=600',
            'fb' => 'https://images.unsplash.com/photo-1503095396549-807759245b35?w=600',
            'cap' => 'Graduation Ceremony 2024 — every parent beaming with pride. 🎓',
            'tags' => ['#Graduation', '#ActToAction', '#GraduationCeremony2024'],
            'type' => 'carousel',
        ],
    ];
@endphp

{{-- ══════════════════════════════════════
     CSS — injected once per page
══════════════════════════════════════ --}}




{{-- ══════════════════════════════════════
     YOUTUBE SECTION
══════════════════════════════════════ --}}
<section class="t-yt-sec">
    <div class="t-wrap">

        <div class="t-sec-title">
            <h2>{{ $sectionTitle }}</h2>
            <p>{{ $sectionDesc }}</p>
        </div>

        <div class="t-tabs" id="tTabRow">
            <button class="t-tab active" data-cat="all" onclick="tFilter(this,'all')">
                <i class="bi bi-grid-3x3-gap-fill"></i> All Videos
            </button>

            @foreach ($tabs ?? [] as $tab)
                @php $icon = ($tab['key'] === 'parent') ? 'person-heart' : 'star-fill'; @endphp
                <button class="t-tab" data-cat="{{ $tab['key'] }}" onclick="tFilter(this, '{{ $tab['key'] }}')">
                    <i class="bi bi-{{ $icon }}"></i>
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>

        <div class="t-car-wrap" onmouseenter="tPause('yt')" onmouseleave="tResume('yt')">
            <button class="t-arr prev" onclick="tMove('yt',-1)">
                <i class="bi bi-chevron-left"></i>
            </button>

            <div class="t-vp">
                <div class="t-track" id="tYtTrack">
                    @foreach ($videos ?? [] as $i => $video)
                        <div class="t-yt-card" data-card="{{ $i }}" data-cat="{{ $video->video_category }}"
                            onclick='tOpenYt(@json($video->youtube_video_id))'>

                            <div class="t-thumb">
                                <img src="https://i.ytimg.com/vi/{{ $video->youtube_video_id }}/maxresdefault.jpg"
                                    onerror="this.src='https://i.ytimg.com/vi/{{ $video->youtube_video_id }}/mqdefault.jpg'"
                                    alt="{{ $video->title }}" loading="lazy" />

                                <div class="t-scrim"></div>
                                <div class="t-yt-badge">
                                    <i class="bi bi-youtube"></i> YouTube
                                </div>

                                <div class="t-play-btn">
                                    <i class="bi bi-play-fill"></i>
                                </div>

                                @if (!empty($video->duration))
                                    <div class="t-dur">{{ $video->duration }}</div>
                                @endif

                                <div class="t-cat-tag {{ $video->video_category }}">
                                    {{ $video->category_label }}
                                </div>
                            </div>

                            <div class="t-card-body">
                                <h4>{{ $video->title }}</h4>
                                <p>{{ $video->description }}</p>

                                <div class="t-card-foot">
                                    <div class="t-channel">
                                        <div class="t-ch-ico">A</div>
                                        {{ $video->channel_name }}
                                    </div>

                                    <a class="t-watch-btn" href="{{ $video->watch_link }}" target="_blank"
                                        onclick="event.stopPropagation()">
                                        <i class="bi bi-youtube"></i> Watch
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button class="t-arr next" onclick="tMove('yt',1)">
                <i class="bi bi-chevron-right"></i>
            </button>

            <div class="t-dots" id="tYtDots"></div>

            <div class="t-mob-nav">
                <button class="t-mob-btn" onclick="tMove('yt',-1)">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="t-mob-btn" onclick="tMove('yt',1)">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>

            <div class="t-prog">
                <div class="t-prog-bar" id="tYtBar"></div>
            </div>
        </div>

        <div class="t-view-all">
            <a href="{{ $ytChannel }}" target="_blank" class="t-view-all-btn">
                <i class="bi bi-youtube" style="color:#ff0000"></i>
                View All on YouTube
                <i class="bi bi-arrow-up-right"></i>
            </a>
        </div>

    </div>
</section>

@if ($showInstagram)
    <section class="t-ig-sec">
        <div class="t-wrap">

            <div class="t-ig-head">
                <div class="t-ig-head-left">
                    <div class="t-ig-logo"><i class="bi bi-instagram"></i></div>
                    <div class="t-ig-meta">
                        <h3>{{ $igHandle }}</h3>
                        <span>Follow for daily reels, castings &amp; behind-the-scenes</span>
                    </div>
                </div>
                <a href="{{ $igUrl }}" target="_blank" class="t-ig-follow">
                    <i class="bi bi-instagram"></i> Follow on Instagram
                </a>
            </div>

            <div class="t-car-wrap" onmouseenter="tPause('ig')" onmouseleave="tResume('ig')">
                <button class="t-arr prev" onclick="tMove('ig',-1)"><i class="bi bi-chevron-left"></i></button>
                <div class="t-vp">
                    <div class="t-track" id="tIgTrack">
                        @foreach ($igPosts ?? [] as $i => $post)
                            @php
                                if ($post['type'] === 'reel') {
                                    $igIcon = 'play-circle-fill';
                                } elseif ($post['type'] === 'carousel') {
                                    $igIcon = 'images';
                                } else {
                                    $igIcon = 'image';
                                }
                            @endphp
                            <div class="t-ig-card" data-card="{{ $i }}"
                                onclick="tOpenIg({{ $i }})">
                                <img src="{{ $post['img'] }}" onerror="this.src='{{ $post['fb'] }}'"
                                    alt="Instagram" loading="lazy" />

                                @if ($post['type'] === 'reel')
                                    <div class="t-ig-badge-v"><i class="bi bi-play-fill"></i></div>
                                @elseif ($post['type'] === 'carousel')
                                    <div class="t-ig-badge-c"><i class="bi bi-images"></i></div>
                                @endif

                                <div class="t-ig-ov">
                                    <i class="bi bi-{{ $igIcon }} t-ig-oi"></i>
                                    <span class="t-ig-cap-ov">{{ Str::limit($post['cap'], 75) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button class="t-arr next" onclick="tMove('ig',1)"><i class="bi bi-chevron-right"></i></button>
                <div class="t-dots" id="tIgDots"></div>
                <div class="t-mob-nav">
                    <button class="t-mob-btn" onclick="tMove('ig',-1)"><i class="bi bi-chevron-left"></i></button>
                    <button class="t-mob-btn" onclick="tMove('ig', 1)"><i class="bi bi-chevron-right"></i></button>
                </div>
                <div class="t-prog">
                    <div class="t-prog-bar" id="tIgBar"></div>
                </div>
            </div>

            <div class="t-ig-more">
                <button class="t-ig-more-btn" onclick="window.open('{{ $igUrl }}','_blank')">
                    <i class="bi bi-instagram"></i> Load More on Instagram
                </button>
            </div>

        </div>
    </section>
@endif

{{-- YouTube Modal --}}
<div class="t-yt-modal" id="tYtModal" onclick="if(event.target===this)tCloseYt()">
    <div class="t-yt-mwrap">
        <div class="t-yt-mplayer">
            <button class="t-m-back" onclick="tCloseYt()"><i class="bi bi-arrow-left"></i> Back</button>
            <div class="t-player-fr">
                <iframe id="tYtFrame" src="" allow="autoplay; encrypted-media; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="t-pinfo">
                <div class="t-pmeta">
                    <span id="tPDur"><i class="bi bi-clock"></i></span>
                    <span id="tPCat" class="t-pcat"></span>
                </div>
                <h3 id="tPTitle"></h3>
                <p id="tPDesc"></p>
            </div>
        </div>
        <div class="t-suggs">
            <div class="t-sugg-ttl" id="tSuggTtl">Up Next</div>
            <div class="t-sugg-list" id="tSuggList"></div>
        </div>
    </div>
</div>

@if ($showInstagram)
    {{-- Instagram Modal --}}
    <div class="t-ig-modal" id="tIgModal" onclick="if(event.target===this)tCloseIg()">
        <div class="t-ig-mbox">
            <div class="t-ig-mmedia" id="tIgMedia">
                <img id="tIgMImg" src="" alt="" />
                <div class="t-ig-mnav">
                    <button onclick="tIgNav(-1);event.stopPropagation()"><i class="bi bi-chevron-left"></i></button>
                    <button onclick="tIgNav( 1);event.stopPropagation()"><i class="bi bi-chevron-right"></i></button>
                </div>
            </div>
            <div class="t-ig-mpanel">
                <div class="t-ig-mph">
                    <div class="t-ig-muser">
                        <div class="t-ig-mav">
                            <img src="https://images.unsplash.com/photo-1503095396549-807759245b35?w=60&q=80"
                                alt="" />
                        </div>
                        <div>
                            <span class="t-ig-mname">{{ $igHandle }}</span>
                            <span class="t-ig-mhandle">Act to Action · Jaipur</span>
                        </div>
                    </div>
                    <button class="t-ig-mx" onclick="tCloseIg()"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="t-ig-mcap">
                    <p id="tIgMCap"></p>
                    <div class="t-ig-mtags" id="tIgMTags"></div>
                </div>
                <div class="t-ig-mdots" id="tIgMDots"></div>
                <div class="t-ig-mfoot">
                    <div class="t-ig-macts">
                        <div class="t-ig-mabtns">
                            <button class="t-ig-mab"
                                onclick="this.classList.toggle('liked');this.querySelector('i').className=this.classList.contains('liked')?'bi bi-heart-fill':'bi bi-heart'">
                                <i class="bi bi-heart"></i><span>Like</span>
                            </button>
                            <button class="t-ig-mab"><i class="bi bi-chat"></i><span>Comment</span></button>
                            <button class="t-ig-mab"><i class="bi bi-send"></i><span>Share</span></button>
                        </div>
                        <button class="t-ig-mab"><i class="bi bi-bookmark"></i></button>
                    </div>
                    <a class="t-ig-open" id="tIgMLink" href="{{ $igUrl }}" target="_blank">
                        <i class="bi bi-instagram"></i> Open in Instagram
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif


{{-- ══════════════════════════════════════
     JS — data comes entirely from PHP
     $videos->map->toCarouselArray() outputs
     the array the carousel JS needs.
══════════════════════════════════════ --}}
@push('scripts')
    <script>
        @php
            $jsVids = ($videos ?? collect())->map(function ($v) {
                return method_exists($v, 'toCarouselArray') ? $v->toCarouselArray() : [];
            });
            $jsPosts = $igPosts ?? [];
        @endphp
            (function() {
                /* All video data from PHP — no fetch, no API */
                const VIDS = @json($jsVids);
                const POSTS = @json($jsPosts);

                /* Carousel state */
                const C = {
                    yt: {
                        cur: 0,
                        total: 0,
                        items: [],
                        timer: null,
                        paused: false,
                        interval: 4500,
                        prog: 0,
                        progT: null
                    },
                    ig: {
                        cur: 0,
                        total: 0,
                        items: [],
                        timer: null,
                        paused: false,
                        interval: 3500,
                        prog: 0,
                        progT: null
                    },
                };

                function vis(t) {
                    const w = window.innerWidth;
                    return t === 'yt' ? (w <= 600 ? 1 : w <= 1100 ? 2 : 3) : (w <= 600 ? 2 : w <= 992 ? 3 : 4);
                }
                const trackEl = t => document.getElementById(t === 'yt' ? 'tYtTrack' : 'tIgTrack');
                const barEl = t => document.getElementById(t === 'yt' ? 'tYtBar' : 'tIgBar');
                const dotsEl = t => document.getElementById(t === 'yt' ? 'tYtDots' : 'tIgDots');

                function update(t) {
                    const c = C[t],
                        tr = trackEl(t);
                    if (!tr) return;
                    const v = vis(t),
                        gap = 20,
                        cw = (tr.parentElement.offsetWidth - gap * (v - 1)) / v;
                    c.total = Math.max(0, c.items.length - v);
                    c.cur = Math.min(c.cur, c.total);
                    tr.style.transform = `translateX(-${c.cur*(cw+gap)}px)`;
                    tr.querySelectorAll('[data-card]').forEach(el => {
                        el.style.flex = `0 0 ${cw}px`;
                        el.style.minWidth = `${cw}px`;
                    });
                    const page = Math.floor(c.cur / v);
                    dotsEl(t).querySelectorAll('.t-dot').forEach((d, i) => d.classList.toggle('active', i === page));
                }

                function buildDots(t) {
                    const v = vis(t),
                        pages = Math.ceil(C[t].items.length / v);
                    dotsEl(t).innerHTML = Array.from({
                            length: pages
                        }, (_, i) =>
                        `<button class="t-dot${i===0?' active':''}" onclick="tGoPage('${t}',${i})"></button>`
                    ).join('');
                }

                window.tGoPage = (t, p) => {
                    C[t].cur = Math.min(p * vis(t), C[t].total);
                    update(t);
                    rProg(t);
                };
                window.tMove = (t, d) => {
                    const c = C[t];
                    c.cur = Math.max(0, Math.min(c.cur + d, c.total));
                    update(t);
                    rProg(t);
                };
                window.tPause = t => {
                    if (C[t]) C[t].paused = true;
                };
                window.tResume = t => {
                    if (C[t]) C[t].paused = false;
                };

                function startAuto(t) {
                    const c = C[t];
                    rProg(t);
                    c.timer = setInterval(() => {
                        if (c.paused) return;
                        if (c.cur >= c.total) c.cur = -1;
                        tMove(t, 1);
                    }, c.interval);
                }

                function rProg(t) {
                    const c = C[t],
                        bar = barEl(t);
                    clearInterval(c.progT);
                    c.prog = 0;
                    if (bar) bar.style.width = '0%';
                    const step = 100 / (c.interval / 50);
                    c.progT = setInterval(() => {
                        if (c.paused) return;
                        c.prog = Math.min(c.prog + step, 100);
                        if (bar) bar.style.width = c.prog + '%';
                    }, 50);
                }

                /* Swipe */
                function swipe(trackId, t) {
                    const el = document.getElementById(trackId);
                    if (!el) return;
                    let sx, sy;
                    el.parentElement.addEventListener('touchstart', e => {
                        sx = e.touches[0].clientX;
                        sy = e.touches[0].clientY;
                    }, {
                        passive: true
                    });
                    el.parentElement.addEventListener('touchend', e => {
                        const dx = sx - e.changedTouches[0].clientX,
                            dy = sy - e.changedTouches[0].clientY;
                        if (Math.abs(dx) > Math.abs(dy) && Math.abs(dx) > 40) tMove(t, dx > 0 ? 1 : -1);
                    }, {
                        passive: true
                    });
                }


                function initCar(t) {
                    const items = Array.from(trackEl(t).querySelectorAll('[data-card]'));
                    C[t].items = items;
                    buildDots(t);
                    update(t);
                    startAuto(t);
                }

                /* Tab filter — show/hide existing DOM cards */
                window.tFilter = function(btn, cat) {
                    document.querySelectorAll('#tTabRow .t-tab').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    const tr = trackEl('yt');
                    Array.from(tr.querySelectorAll('[data-card]')).forEach(card => {
                        card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
                    });
                    C.yt.items = Array.from(tr.querySelectorAll('[data-card]')).filter(c => c.style.display !==
                        'none');
                    C.yt.cur = 0;
                    buildDots('yt');
                    update('yt');
                    rProg('yt');
                };

                /* YT Modal */
                window.tOpenYt = function(id) {
                    const v = VIDS.find(x => x.id === id);
                    if (!v) return;
                    document.getElementById('tYtFrame').src =
                        `https://www.youtube.com/embed/${id}?autoplay=1&rel=0`;
                    document.getElementById('tPTitle').textContent = v.title;
                    document.getElementById('tPDesc').textContent = v.desc || '';
                    document.getElementById('tPDur').innerHTML = `<i class="bi bi-clock"></i> ${v.dur||''}`;
                    const b = document.getElementById('tPCat');
                    b.className = 't-pcat ' + v.cat;
                    b.textContent = v.label || v.cat;
                    const same = VIDS.filter(x => x.cat === v.cat && x.id !== id);
                    const suggs = [...same, ...VIDS.filter(x => x.cat !== v.cat && x.id !== id)].slice(0, 5);
                    document.getElementById('tSuggTtl').textContent = same.length ? 'More Like This' : 'Up Next';
                    document.getElementById('tSuggList').innerHTML = suggs.map(s => `
      <div class="t-sugg-card" onclick="tSwitchVid('${s.id}')">
        <div class="t-sugg-th"><img src="https://i.ytimg.com/vi/${s.id}/mqdefault.jpg" alt=""/>
          <div class="t-splay"><i class="bi bi-play-fill"></i></div>
          <div class="t-sdur">${s.dur||''}</div></div>
        <div class="t-sugg-info"><h5>${s.title}</h5><span>${s.label||s.cat}</span></div>
      </div>`).join('');
                    document.getElementById('tYtModal').classList.add('open');
                    document.body.style.overflow = 'hidden';
                    tPause('yt');
                };
                window.tSwitchVid = id => {
                    tCloseYt();
                    setTimeout(() => tOpenYt(id), 120);
                };
                window.tCloseYt = () => {
                    document.getElementById('tYtFrame').src = '';
                    document.getElementById('tYtModal').classList.remove('open');
                    document.body.style.overflow = '';
                    tResume('yt');
                };

                /* IG Modal */
                let igIdx = 0;
                window.tOpenIg = i => {
                    igIdx = i;
                    renderIg();
                    document.getElementById('tIgModal').classList.add('open');
                    document.body.style.overflow = 'hidden';
                    tPause('ig');
                };

                function renderIg() {
                    const p = POSTS[igIdx];
                    const img = document.getElementById('tIgMImg');
                    img.src = p.img;
                    img.onerror = () => {
                        img.src = p.fb;
                    };
                    document.getElementById('tIgMCap').textContent = p.cap;
                    document.getElementById('tIgMTags').innerHTML = p.tags.map(t => `<span>${t}</span>`).join(' ');
                    document.getElementById('tIgMDots').innerHTML = POSTS.map((_, i) =>
                        `<div class="t-ig-mdot${i===igIdx?' active':''}"></div>`).join('');
                }
                window.tIgNav = d => {
                    const m = document.getElementById('tIgMedia');
                    m.style.cssText =
                        `transition:opacity .18s,transform .18s;opacity:0;transform:translateX(${d>0?'22px':'-22px'})`;
                    setTimeout(() => {
                        igIdx = (igIdx + d + POSTS.length) % POSTS.length;
                        renderIg();
                        m.style.cssText = `transition:none;transform:translateX(${d>0?'-22px':'22px'})`;
                        requestAnimationFrame(() => requestAnimationFrame(() => {
                            m.style.cssText =
                                'transition:opacity .22s,transform .22s;opacity:1;transform:translateX(0)';
                        }));
                    }, 180);
                };
                window.tCloseIg = () => {
                    document.getElementById('tIgModal').classList.remove('open');
                    document.body.style.overflow = '';
                    tResume('ig');
                };

                /* Keyboard */
                document.addEventListener('keydown', e => {
                    if (e.key === 'Escape') {
                        tCloseYt();
                        tCloseIg();
                    }
                    if (document.getElementById('tIgModal')?.classList.contains('open')) {
                        if (e.key === 'ArrowRight') tIgNav(1);
                        if (e.key === 'ArrowLeft') tIgNav(-1);
                    }
                });

                /* Resize */
                window.addEventListener('resize', () => {
                    ['yt', 'ig'].forEach(t => {
                        const tr = trackEl(t);
                        if (!tr) return;
                        tr.classList.add('no-anim');
                        update(t);
                        buildDots(t);
                        requestAnimationFrame(() => tr.classList.remove('no-anim'));
                    });
                });

                /* Init */
                swipe('tYtTrack', 'yt');
                swipe('tIgTrack', 'ig');
                initCar('yt');
                initCar('ig');
            })();
    </script>
@endpush
<style>
:root {
        --t-default-font: "Roboto", sans-serif;
        --t-heading-font: "Montserrat", sans-serif;
        --t-nav-font: "Lato", sans-serif;
        --t-color: #3c4049;
        --t-heading: #112344;
        --t-accent: #175cdd;
    }

    .t-wrap {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 clamp(16px, 4vw, 40px)
    }

    /* Section title */
    .t-sec-title {
        text-align: center;
        padding-bottom: 40px
    }

    .t-sec-title h2 {
        font-size: clamp(22px, 4vw, 34px);
        font-weight: 800;
        margin-bottom: 18px;
        padding-bottom: 18px;
        position: relative;
        display: inline-block;
        letter-spacing: -.5px;
        font-family: var(--t-heading-font);
        color: var(--t-heading)
    }

    .t-sec-title h2::before {
        content: "";
        position: absolute;
        width: 160px;
        height: 1px;
        background: color-mix(in srgb, var(--t-color), transparent 65%);
        left: 0;
        right: 0;
        bottom: 1px;
        margin: auto
    }

    .t-sec-title h2::after {
        content: "";
        position: absolute;
        width: 60px;
        height: 3px;
        background: var(--t-accent);
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto
    }

    .t-sec-title p {
        color: color-mix(in srgb, var(--t-color), transparent 28%);
        font-size: .97rem;
        line-height: 1.75;
        max-width: 520px;
        margin: 0 auto;
        font-family: var(--t-default-font)
    }

    /* Carousel */
    .t-car-wrap {
        position: relative;
        padding: 0 4px
    }

    .t-track {
        display: flex;
        gap: 20px;
        transition: transform .55s cubic-bezier(.4, 0, .2, 1);
        will-change: transform
    }

    .t-track.no-anim {
        transition: none
    }

    .t-vp {
        overflow: hidden;
        border-radius: 4px
    }

    .t-arr {
        position: absolute;
        top: 42%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #fff;
        border: 1.5px solid color-mix(in srgb, var(--t-color), transparent 82%);
        color: var(--t-heading);
        font-size: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all .3s;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .1);
        -webkit-tap-highlight-color: transparent
    }

    .t-arr:hover {
        background: var(--t-accent);
        color: #fff;
        border-color: var(--t-accent)
    }

    .t-arr.prev {
        left: -22px
    }

    .t-arr.next {
        right: -22px
    }

    @media(max-width:600px) {
        .t-arr {
            display: none
        }
    }

    .t-dots {
        display: flex;
        justify-content: center;
        gap: 7px;
        margin-top: 22px;
        flex-wrap: wrap
    }

    .t-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: color-mix(in srgb, var(--t-color), transparent 80%);
        cursor: pointer;
        transition: all .3s;
        border: none;
        padding: 0;
        -webkit-tap-highlight-color: transparent
    }

    .t-dot.active {
        background: var(--t-accent);
        width: 24px;
        border-radius: 4px
    }

    .t-mob-nav {
        display: none;
        justify-content: center;
        align-items: center;
        gap: 18px;
        margin-top: 16px
    }

    @media(max-width:600px) {
        .t-mob-nav {
            display: flex
        }
    }

    .t-mob-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #fff;
        border: 1.5px solid color-mix(in srgb, var(--t-color), transparent 80%);
        color: var(--t-heading);
        font-size: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all .3s;
        -webkit-tap-highlight-color: transparent
    }

    .t-mob-btn:active {
        background: var(--t-accent);
        color: #fff;
        border-color: var(--t-accent)
    }

    .t-prog {
        height: 3px;
        background: color-mix(in srgb, var(--t-color), transparent 88%);
        border-radius: 2px;
        margin-top: 12px;
        overflow: hidden
    }

    .t-prog-bar {
        height: 100%;
        background: var(--t-accent);
        border-radius: 2px;
        transition: width .1s linear
    }

    /* Tab pills */
    .t-tabs {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 36px
    }

    .t-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        border: 1.5px solid color-mix(in srgb, var(--t-color), transparent 80%);
        background: transparent;
        color: color-mix(in srgb, var(--t-color), transparent 40%);
        cursor: pointer;
        transition: all .3s;
        font-family: var(--t-nav-font);
        white-space: nowrap;
        -webkit-tap-highlight-color: transparent
    }

    .t-tab:hover,
    .t-tab:active {
        border-color: var(--t-accent);
        color: var(--t-accent)
    }

    .t-tab.active {
        background: var(--t-accent);
        border-color: var(--t-accent);
        color: #fff
    }

    @media(max-width:400px) {
        .t-tab {
            font-size: 11px;
            padding: 7px 13px
        }
    }

    /* YT section */
    .t-yt-sec {
        padding: clamp(50px, 8vw, 90px) 0 clamp(40px, 6vw, 80px);
        background: #fff
    }

    .t-yt-card {
        flex: 0 0 calc(33.333% - 14px);
        min-width: 0;
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid color-mix(in srgb, var(--t-color), transparent 90%);
        box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
        transition: all .35s;
        cursor: pointer;
        display: flex;
        flex-direction: column
    }

    .t-yt-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 48px rgba(0, 0, 0, .12)
    }

    @media(max-width:1100px) {
        .t-yt-card {
            flex: 0 0 calc(50% - 10px)
        }
    }

    @media(max-width:600px) {
        .t-yt-card {
            flex: 0 0 100%
        }
    }

    .t-thumb {
        position: relative;
        padding-top: 56.25%;
        overflow: hidden;
        background: #111
    }

    .t-thumb img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s, opacity .3s
    }

    .t-yt-card:hover .t-thumb img {
        transform: scale(1.04);
        opacity: .82
    }

    .t-scrim {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, .65) 0%, transparent 55%);
        pointer-events: none
    }

    .t-yt-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
        background: rgba(0, 0, 0, .7);
        backdrop-filter: blur(4px);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px
    }

    .t-yt-badge i {
        color: #ff0000;
        font-size: 13px
    }

    .t-play-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .93);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 22px rgba(0, 0, 0, .3);
        transition: transform .3s
    }

    .t-play-btn i {
        font-size: 20px;
        color: #ff0000;
        margin-left: 3px
    }

    .t-yt-card:hover .t-play-btn {
        transform: translate(-50%, -50%) scale(1.12)
    }

    .t-dur {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, .8);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 5px
    }

    .t-cat-tag {
        position: absolute;
        bottom: 10px;
        left: 10px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .8px;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 50px;
        color: #fff
    }

    .t-cat-tag.parent {
        background: rgba(23, 92, 221, .82)
    }

    .t-cat-tag.student {
        background: rgba(42, 157, 143, .82)
    }

    .t-card-body {
        padding: 16px 18px 18px;
        flex: 1;
        display: flex;
        flex-direction: column
    }

    .t-card-body h4 {
        font-size: .86rem;
        font-weight: 700;
        color: var(--t-heading);
        line-height: 1.5;
        margin-bottom: 8px;
        font-family: var(--t-heading-font);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden
    }

    .t-card-body p {
        font-size: .78rem;
        line-height: 1.7;
        color: color-mix(in srgb, var(--t-color), transparent 30%);
        margin-bottom: 14px;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden
    }

    .t-card-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid color-mix(in srgb, var(--t-color), transparent 90%);
        padding-top: 10px;
        margin-top: auto;
        gap: 8px
    }

    .t-channel {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 11px;
        font-weight: 600;
        color: color-mix(in srgb, var(--t-color), transparent 38%)
    }

    .t-ch-ico {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--t-accent);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 800;
        color: #fff;
        flex-shrink: 0
    }

    .t-watch-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        background: #ff0000;
        color: #fff;
        transition: all .3s;
        white-space: nowrap
    }

    .t-watch-btn:hover {
        background: #c00;
        color: #fff
    }

    .t-view-all {
        text-align: center;
        margin-top: 32px
    }

    .t-view-all-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 26px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        border: 2px solid var(--t-accent);
        color: var(--t-accent);
        background: transparent;
        transition: all .3s
    }

    .t-view-all-btn:hover {
        background: var(--t-accent);
        color: #fff;
        transform: translateY(-2px)
    }

    /* IG section */
    .t-ig-sec {
        padding: clamp(50px, 8vw, 90px) 0;
        background: #f4f8ff
    }

    .t-ig-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 32px
    }

    .t-ig-head-left {
        display: flex;
        align-items: center;
        gap: 12px
    }

    .t-ig-logo {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        background: linear-gradient(45deg, #f9ce34, #ee2a7b, #6228d7);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0
    }

    .t-ig-logo i {
        color: #fff;
        font-size: 24px
    }

    .t-ig-meta h3 {
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--t-heading);
        margin: 0;
        font-family: var(--t-heading-font)
    }

    .t-ig-meta span {
        font-size: 12px;
        color: color-mix(in srgb, var(--t-color), transparent 38%)
    }

    .t-ig-follow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 20px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        background: linear-gradient(45deg, #f9ce34, #ee2a7b, #6228d7);
        color: #fff;
        transition: all .3s;
        box-shadow: 0 4px 18px rgba(238, 42, 123, .3);
        white-space: nowrap
    }

    .t-ig-follow:hover {
        opacity: .9;
        transform: translateY(-2px);
        color: #fff
    }

    .t-ig-card {
        flex: 0 0 calc(25% - 15px);
        min-width: 0;
        position: relative;
        aspect-ratio: 1/1;
        overflow: hidden;
        border-radius: 14px;
        cursor: pointer;
        background: #dde6f5;
        box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
        transition: transform .35s, box-shadow .35s
    }

    .t-ig-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 18px 44px rgba(0, 0, 0, .14)
    }

    @media(max-width:992px) {
        .t-ig-card {
            flex: 0 0 calc(33.333% - 14px)
        }
    }

    @media(max-width:600px) {
        .t-ig-card {
            flex: 0 0 calc(50% - 10px)
        }
    }

    .t-ig-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s
    }

    .t-ig-card:hover img {
        transform: scale(1.06)
    }

    .t-ig-ov {
        position: absolute;
        inset: 0;
        background: rgba(17, 35, 68, .65);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        opacity: 0;
        transition: opacity .3s;
        padding: 14px
    }

    .t-ig-card:hover .t-ig-ov {
        opacity: 1
    }

    @media(hover:none) {
        .t-ig-card:active .t-ig-ov {
            opacity: 1
        }
    }

    .t-ig-oi {
        font-size: 26px;
        color: #fff
    }

    .t-ig-cap-ov {
        font-size: 11px;
        color: rgba(255, 255, 255, .85);
        text-align: center;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden
    }

    .t-ig-badge-v {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0, 0, 0, .62);
        color: #fff;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px
    }

    .t-ig-badge-c {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0, 0, 0, .58);
        color: #fff;
        border-radius: 6px;
        padding: 2px 6px;
        font-size: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 3px
    }

    .t-ig-more {
        text-align: center;
        margin-top: 28px
    }

    .t-ig-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 26px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        background: linear-gradient(45deg, #f9ce34, #ee2a7b, #6228d7);
        color: #fff;
        transition: all .3s;
        box-shadow: 0 4px 20px rgba(238, 42, 123, .28);
        border: none;
        cursor: pointer
    }

    .t-ig-more-btn:hover {
        opacity: .9;
        color: #fff;
        transform: translateY(-2px)
    }

    /* YT Modal */
    .t-yt-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9000;
        background: rgba(0, 0, 0, .93);
        backdrop-filter: blur(10px);
        padding: 16px;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch
    }

    .t-yt-modal.open {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        animation: t-fd .25s ease
    }

    .t-yt-mwrap {
        display: flex;
        gap: 20px;
        width: 100%;
        max-width: 1080px;
        margin: auto;
        padding: 16px 0
    }

    @media(max-width:860px) {
        .t-yt-mwrap {
            flex-direction: column
        }
    }

    .t-yt-mplayer {
        flex: 1;
        min-width: 0
    }

    .t-m-back {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        background: rgba(255, 255, 255, .1);
        border: 1.5px solid rgba(255, 255, 255, .25);
        color: #fff;
        padding: 7px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all .3s
    }

    .t-m-back:hover {
        background: rgba(255, 255, 255, .22)
    }

    .t-player-fr {
        position: relative;
        padding-top: 56.25%;
        border-radius: 12px;
        overflow: hidden;
        background: #000
    }

    .t-player-fr iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: none
    }

    .t-pinfo {
        margin-top: 12px
    }

    .t-pinfo h3 {
        font-size: .98rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 8px;
        line-height: 1.4;
        font-family: var(--t-heading-font)
    }

    .t-pinfo p {
        font-size: .82rem;
        color: rgba(255, 255, 255, .6);
        line-height: 1.65;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden
    }

    .t-pmeta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
        flex-wrap: wrap
    }

    .t-pmeta span {
        font-size: 12px;
        color: rgba(255, 255, 255, .5);
        display: flex;
        align-items: center;
        gap: 5px
    }

    .t-pcat {
        font-size: 11px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 50px
    }

    .t-pcat.parent {
        background: var(--t-accent);
        color: #fff
    }

    .t-pcat.student {
        background: #2a9d8f;
        color: #fff
    }

    .t-suggs {
        width: 300px;
        flex-shrink: 0
    }

    @media(max-width:860px) {
        .t-suggs {
            width: 100%
        }
    }

    .t-sugg-ttl {
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .5px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .5);
        margin-bottom: 12px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, .1)
    }

    .t-sugg-list {
        display: flex;
        flex-direction: column;
        gap: 9px
    }

    .t-sugg-card {
        display: flex;
        gap: 10px;
        cursor: pointer;
        padding: 9px;
        border-radius: 10px;
        border: 1px solid transparent;
        transition: all .25s
    }

    .t-sugg-card:hover {
        background: rgba(255, 255, 255, .07);
        border-color: rgba(255, 255, 255, .12)
    }

    .t-sugg-th {
        position: relative;
        width: 110px;
        flex-shrink: 0;
        border-radius: 8px;
        overflow: hidden;
        aspect-ratio: 16/9;
        background: #222
    }

    .t-sugg-th img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .t-splay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .85);
        display: flex;
        align-items: center;
        justify-content: center
    }

    .t-splay i {
        font-size: 10px;
        color: #ff0000;
        margin-left: 2px
    }

    .t-sdur {
        position: absolute;
        bottom: 3px;
        right: 4px;
        background: rgba(0, 0, 0, .8);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 1px 5px;
        border-radius: 3px
    }

    .t-sugg-info h5 {
        font-size: .78rem;
        font-weight: 700;
        color: rgba(255, 255, 255, .88);
        line-height: 1.4;
        margin-bottom: 5px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden
    }

    .t-sugg-info span {
        font-size: 11px;
        color: rgba(255, 255, 255, .42)
    }

    /* IG Modal */
    .t-ig-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9100;
        background: rgba(0, 0, 0, .9);
        backdrop-filter: blur(12px);
        align-items: center;
        justify-content: center;
        padding: 14px
    }

    .t-ig-modal.open {
        display: flex;
        animation: t-fd .25s ease
    }

    .t-ig-mbox {
        background: #1a1a2e;
        border-radius: 18px;
        overflow: hidden;
        width: 100%;
        max-width: 860px;
        display: flex;
        box-shadow: 0 40px 100px rgba(0, 0, 0, .7);
        max-height: 92vh
    }

    @media(max-width:680px) {
        .t-ig-mbox {
            flex-direction: column;
            overflow-y: auto;
            max-height: 95vh;
            border-radius: 14px
        }
    }

    .t-ig-mmedia {
        width: 52%;
        flex-shrink: 0;
        position: relative;
        background: #000;
        transition: opacity .2s, transform .2s
    }

    @media(max-width:680px) {
        .t-ig-mmedia {
            width: 100%;
            aspect-ratio: 1/1
        }
    }

    .t-ig-mmedia img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block
    }

    .t-ig-mnav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 9px;
        pointer-events: none
    }

    .t-ig-mnav button {
        pointer-events: all;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .22);
        border: none;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        transition: background .25s;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .t-ig-mnav button:hover {
        background: rgba(255, 255, 255, .42)
    }

    .t-ig-mpanel {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden
    }

    .t-ig-mph {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255, 255, 255, .08)
    }

    .t-ig-muser {
        display: flex;
        align-items: center;
        gap: 10px
    }

    .t-ig-mav {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(45deg, #f9ce34, #ee2a7b, #6228d7);
        padding: 2px;
        flex-shrink: 0
    }

    .t-ig-mav img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #1a1a2e
    }

    .t-ig-mname {
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        display: block
    }

    .t-ig-mhandle {
        font-size: 11px;
        color: rgba(255, 255, 255, .45)
    }

    .t-ig-mx {
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .2);
        color: rgba(255, 255, 255, .7);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 14px;
        transition: all .25s;
        flex-shrink: 0
    }

    .t-ig-mx:hover {
        background: rgba(255, 255, 255, .22);
        color: #fff
    }

    .t-ig-mcap {
        flex: 1;
        padding: 14px 16px;
        overflow-y: auto;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        -webkit-overflow-scrolling: touch
    }

    .t-ig-mcap p {
        font-size: .84rem;
        color: rgba(255, 255, 255, .78);
        line-height: 1.75;
        white-space: pre-line
    }

    .t-ig-mtags {
        margin-top: 10px;
        font-size: .78rem;
        line-height: 1.8
    }

    .t-ig-mtags span {
        color: #7aaeff;
        margin-right: 4px
    }

    .t-ig-mdots {
        display: flex;
        justify-content: center;
        gap: 5px;
        padding: 9px 0
    }

    .t-ig-mdot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .2);
        transition: background .3s
    }

    .t-ig-mdot.active {
        background: #fff
    }

    .t-ig-mfoot {
        padding: 12px 16px;
        display: flex;
        flex-direction: column;
        gap: 11px
    }

    .t-ig-macts {
        display: flex;
        align-items: center;
        justify-content: space-between
    }

    .t-ig-mabtns {
        display: flex;
        gap: 12px
    }

    .t-ig-mab {
        background: none;
        border: none;
        color: rgba(255, 255, 255, .65);
        font-size: 20px;
        cursor: pointer;
        transition: all .3s;
        display: flex;
        align-items: center;
        gap: 5px;
        -webkit-tap-highlight-color: transparent
    }

    .t-ig-mab:hover {
        color: #fff;
        transform: scale(1.1)
    }

    .t-ig-mab.liked {
        color: #ff3366
    }

    .t-ig-mab span {
        font-size: 11px;
        color: rgba(255, 255, 255, .5)
    }

    .t-ig-open {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(45deg, #f9ce34, #ee2a7b, #6228d7);
        color: #fff;
        padding: 9px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        width: 100%;
        justify-content: center;
        transition: all .3s
    }

    .t-ig-open:hover {
        opacity: .9;
        color: #fff
    }

    @keyframes t-fd {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }
</style>
