   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/5.0.36/fancybox/fancybox.min.css" />




   @if ($galleryCategories->isEmpty())
       <div class="gal-empty-state">
           <div class="gal-empty-icon">🖼️</div>
           <p>No gallery images yet. Check back soon!</p>
       </div>
   @else
       @foreach ($galleryCategories as $catIndex => $cat)
           @php $images = $cat->galleries; @endphp

           <div class="gal-category-block" data-aos="fade-up" data-aos-delay="{{ $catIndex * 100 }}">

               {{-- Category Header --}}
               <div class="gal-cat-header">
                   <div class="gal-cat-left">
                       <div class="gal-cat-number">{{ str_pad($catIndex + 1, 2, '0', STR_PAD_LEFT) }}</div>
                       <div>
                           <h3 class="gal-cat-name">{{ $cat->name }}</h3>
                           <span class="gal-cat-meta">{{ $images->count() }}
                               {{ Str::plural('photo', $images->count()) }}</span>
                       </div>
                   </div>
                   <div class="gal-cat-line"></div>
               </div>

               {{-- Dynamic Grid Layout based on image count --}}
               @php $count = $images->count(); @endphp

               @if ($count === 1)
                   {{-- Single image: full width hero --}}
                   <div class="gal-layout-single">
                       @foreach ($images->take(1) as $img)
                           @if ($img->image)
                               <a href="{{ asset('storage/' . $img->image) }}"
                                   data-fancybox="gallery-{{ $cat->slug }}" data-caption="{{ $img->title }}">
                                   <div class="gal-card gal-hero">
                                       <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->title }}"
                                           loading="lazy"
                                           onerror="this.src='https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=800&q=80'" />
                                       <div class="gal-overlay">
                                           <i class="bi bi-zoom-in"></i>
                                           <span>{{ $img->title }}</span>
                                       </div>
                                   </div>
                               </a>
                           @endif
                   </div>
               @elseif($count === 2)
                   {{-- Two images: side by side --}}
                   <div class="gal-layout-two">
                       @foreach ($images->take(2) as $img)
                           @if ($img->image)
                               <a href="{{ asset('storage/' . $img->image) }}"
                                   data-fancybox="gallery-{{ $cat->slug }}" data-caption="{{ $img->title }}">
                                   <div class="gal-card">
                                       <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->title }}"
                                           loading="lazy"
                                           onerror="this.src='https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=600&q=80'" />
                                       <div class="gal-overlay">
                                           <i class="bi bi-zoom-in"></i>
                                           <span>{{ $img->title }}</span>
                                       </div>
                                   </div>
                               </a>
                           @endif
                   </div>
               @elseif($count === 3)
                   {{-- Three: one big left, two stacked right --}}
                   <div class="gal-layout-three">
                       <a href="{{ asset('storage/' . $images[0]->image) }}"
                           data-fancybox="gallery-{{ $cat->slug }}" data-caption="{{ $images[0]->title }}"
                           class="gal-three-main">
                           <div class="gal-card gal-tall">
                               <img src="{{ asset('storage/' . $images[0]->image) }}" alt="{{ $images[0]->title }}"
                                   loading="lazy" />
                               <div class="gal-overlay"><i
                                       class="bi bi-zoom-in"></i><span>{{ $images[0]->title }}</span></div>
                           </div>
                       </a>
                       <div class="gal-three-stack">
                           @foreach ($images->skip(1)->take(2) as $img)
                               <a href="{{ asset('storage/' . $img->image) }}"
                                   data-fancybox="gallery-{{ $cat->slug }}" data-caption="{{ $img->title }}">
                                   <div class="gal-card">
                                       <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->title }}"
                                           loading="lazy" />
                                       <div class="gal-overlay"><i
                                               class="bi bi-zoom-in"></i><span>{{ $img->title }}</span>
                                       </div>
                                   </div>
                               </a>
                           @endforeach
                       </div>
                   </div>
               @elseif($count === 4)
                   {{-- Four: 2x2 grid --}}
                   <div class="gal-layout-four">
                       @foreach ($images->take(4) as $img)
                           <a href="{{ asset('storage/' . $img->image) }}" data-fancybox="gallery-{{ $cat->slug }}"
                               data-caption="{{ $img->title }}">
                               <div class="gal-card">
                                   <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->title }}"
                                       loading="lazy" />
                                   <div class="gal-overlay"><i
                                           class="bi bi-zoom-in"></i><span>{{ $img->title }}</span></div>
                               </div>
                           </a>
                       @endforeach
                   </div>
               @else
                   {{-- 5+: featured first image large, rest in grid, +N more badge --}}
                   @php
                       $featured = $images->first();
                       $rest = $images->skip(1)->take(4);
                       $remaining = $images->count() - 5;
                   @endphp
                   <div class="gal-layout-featured">
                       <a href="{{ asset('storage/' . $featured->image) }}"
                           data-fancybox="gallery-{{ $cat->slug }}" data-caption="{{ $featured->title }}"
                           class="gal-featured-main">
                           <div class="gal-card gal-tall">
                               <img src="{{ asset('storage/' . $featured->image) }}" alt="{{ $featured->title }}"
                                   loading="lazy" />
                               <div class="gal-overlay"><i
                                       class="bi bi-zoom-in"></i><span>{{ $featured->title }}</span></div>
                           </div>
                       </a>
                       <div class="gal-featured-grid">
                           @foreach ($rest as $rIndex => $img)
                               <a href="{{ asset('storage/' . $img->image) }}"
                                   data-fancybox="gallery-{{ $cat->slug }}" data-caption="{{ $img->title }}"
                                   class="gal-featured-small {{ $rIndex === 3 && $remaining > 0 ? 'gal-more-wrap' : '' }}">
                                   <div class="gal-card">
                                       <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->title }}"
                                           loading="lazy" />
                                       <div class="gal-overlay"><i
                                               class="bi bi-zoom-in"></i><span>{{ $img->title }}</span>
                                       </div>
                                       @if ($rIndex === 3 && $remaining > 0)
                                           <div class="gal-more-badge">+{{ $remaining }} more</div>
                                       @endif
                                   </div>
                               </a>
                           @endforeach
                           {{-- Hidden images for fancybox (so +N more still opens in lightbox) --}}
                           @foreach ($images->skip(5) as $img)
                               <a href="{{ asset('storage/' . $img->image) }}"
                                   data-fancybox="gallery-{{ $cat->slug }}" data-caption="{{ $img->title }}"
                                   style="display:none;">
                               </a>
                           @endforeach
                       </div>
                   </div>
               @endif

           </div>
       @endforeach
   @endif





   <script src="https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/5.0.36/fancybox/fancybox.umd.js"></script>
   <script>
       (function() {
           @php
               $allSlugs = \App\Models\Gallerycat::pluck('slug');
           @endphp

           @foreach ($allSlugs as $slug)
               Fancybox.bind('[data-fancybox="gallery-{{ $slug }}"]', {
                   Toolbar: {
                       display: {
                           left: ['infobar'],
                           middle: [],
                           right: ['slideshow', 'fullscreen', 'close'],
                       },
                   },
                   Images: {
                       zoom: true
                   },
                   Carousel: {
                       infinite: true
                   },
               });
           @endforeach
       })();
   </script>
   <style>
       /* ── Section ── */
       .gallery-section {
           padding: 80px 0;
           background: #f8faff;
       }

       /* ── Category Block ── */
       .gal-category-block {
           margin-bottom: 64px;
       }

       .gal-category-block:last-child {
           margin-bottom: 0;
       }

       /* ── Category Header ── */
       .gal-cat-header {
           display: flex;
           align-items: center;
           gap: 20px;
           margin-bottom: 24px;
       }

       .gal-cat-left {
           display: flex;
           align-items: center;
           gap: 14px;
           flex-shrink: 0;
       }

       .gal-cat-number {
           font-size: 13px;
           font-weight: 800;
           color: var(--blue, #175cdd);
           background: #eff6ff;
           border: 1.5px solid #bfdbfe;
           border-radius: 8px;
           padding: 4px 10px;
           letter-spacing: .5px;
           font-family: monospace;
       }

       .gal-cat-name {
           font-size: 20px;
           font-weight: 800;
           color: var(--ink, #1a1a2e);
           margin: 0;
           line-height: 1.2;
       }

       .gal-cat-meta {
           font-size: 12px;
           color: var(--muted, #6b7280);
           font-weight: 500;
       }

       .gal-cat-line {
           flex: 1;
           height: 1.5px;
           background: linear-gradient(to right, #e5e7eb, transparent);
           border-radius: 2px;
       }

       /* ── Shared Card ── */
       .gal-card {
           position: relative;
           border-radius: 14px;
           overflow: hidden;
           background: #e5e7eb;
           box-shadow: 0 2px 16px rgba(0, 0, 0, .08);
           transition: transform .3s, box-shadow .3s;
           cursor: pointer;
       }

       .gal-card:hover {
           transform: translateY(-5px);
           box-shadow: 0 16px 40px rgba(0, 0, 0, .16);
       }

       .gal-card img {
           width: 100%;
           height: 100%;
           object-fit: cover;
           display: block;
           transition: transform .4s;
       }

       .gal-card:hover img {
           transform: scale(1.06);
       }

       .gal-tall {
           height: 100%;
       }

       /* ── Overlay ── */
       .gal-overlay {
           position: absolute;
           inset: 0;
           background: linear-gradient(to top, rgba(0, 0, 0, .8) 0%, rgba(0, 0, 0, .1) 55%, transparent 100%);
           opacity: 0;
           transition: opacity .3s;
           display: flex;
           flex-direction: column;
           align-items: center;
           justify-content: center;
           gap: 8px;
           padding: 16px;
       }

       .gal-card:hover .gal-overlay {
           opacity: 1;
       }

       .gal-overlay i {
           font-size: 26px;
           color: #fff;
           background: rgba(255, 255, 255, .15);
           border: 1.5px solid rgba(255, 255, 255, .4);
           border-radius: 50%;
           width: 52px;
           height: 52px;
           display: flex;
           align-items: center;
           justify-content: center;
           backdrop-filter: blur(4px);
       }

       .gal-overlay span {
           color: #fff;
           font-size: 13px;
           font-weight: 600;
           text-align: center;
           line-height: 1.4;
           text-shadow: 0 1px 4px rgba(0, 0, 0, .5);
       }

       /* ── More badge ── */
       .gal-more-badge {
           position: absolute;
           inset: 0;
           background: rgba(0, 0, 0, .55);
           display: flex;
           align-items: center;
           justify-content: center;
           color: #fff;
           font-size: 22px;
           font-weight: 800;
           letter-spacing: -.5px;
           backdrop-filter: blur(2px);
           border-radius: 14px;
       }

       /* ── Layout: Single ── */
       .gal-layout-single a {
           display: block;
       }

       .gal-layout-single .gal-card {
           height: 420px;
       }

       @media (max-width: 767px) {
           .gal-layout-single .gal-card {
               height: 240px;
           }
       }

       /* ── Layout: Two ── */
       .gal-layout-two {
           display: grid;
           grid-template-columns: 1fr 1fr;
           gap: 16px;
       }

       .gal-layout-two a {
           display: block;
       }

       .gal-layout-two .gal-card {
           height: 320px;
       }

       @media (max-width: 575px) {
           .gal-layout-two {
               grid-template-columns: 1fr;
           }

           .gal-layout-two .gal-card {
               height: 220px;
           }
       }

       /* ── Layout: Three ── */
       .gal-layout-three {
           display: grid;
           grid-template-columns: 1fr 1fr;
           gap: 16px;
           align-items: stretch;
       }

       .gal-three-main {
           display: block;
       }

       .gal-three-main .gal-card {
           height: 100%;
           min-height: 320px;
       }

       .gal-three-stack {
           display: flex;
           flex-direction: column;
           gap: 16px;
       }

       .gal-three-stack a {
           display: block;
           flex: 1;
       }

       .gal-three-stack .gal-card {
           height: 100%;
           min-height: 140px;
       }

       @media (max-width: 575px) {
           .gal-layout-three {
               grid-template-columns: 1fr;
           }

           .gal-three-main .gal-card {
               min-height: 220px;
           }

           .gal-three-stack {
               flex-direction: row;
           }

           .gal-three-stack .gal-card {
               min-height: 120px;
           }
       }

       /* ── Layout: Four ── */
       .gal-layout-four {
           display: grid;
           grid-template-columns: 1fr 1fr;
           gap: 16px;
       }

       .gal-layout-four a {
           display: block;
       }

       .gal-layout-four .gal-card {
           height: 260px;
       }

       @media (max-width: 575px) {
           .gal-layout-four .gal-card {
               height: 180px;
           }
       }

       /* ── Layout: Featured (5+) ── */
       .gal-layout-featured {
           display: grid;
           grid-template-columns: 1fr 1fr;
           gap: 16px;
           align-items: stretch;
       }

       .gal-featured-main {
           display: block;
       }

       .gal-featured-main .gal-card {
           height: 100%;
           min-height: 400px;
       }

       .gal-featured-grid {
           display: grid;
           grid-template-columns: 1fr 1fr;
           gap: 16px;
       }

       .gal-featured-small {
           display: block;
       }

       .gal-featured-small .gal-card {
           height: 188px;
       }

       @media (max-width: 991px) {
           .gal-layout-featured {
               grid-template-columns: 1fr;
           }

           .gal-featured-main .gal-card {
               min-height: 280px;
           }

           .gal-featured-small .gal-card {
               height: 150px;
           }
       }

       @media (max-width: 480px) {
           .gal-featured-grid {
               grid-template-columns: 1fr 1fr;
           }

           .gal-featured-small .gal-card {
               height: 120px;
           }
       }

       /* ── Empty State ── */
       .gal-empty-state {
           text-align: center;
           padding: 80px 0;
           color: #6b7280;
       }

       .gal-empty-icon {
           font-size: 56px;
           margin-bottom: 16px;
       }

       .gal-empty-state p {
           font-size: 15px;
       }

       /* ── Fancybox ── */
       .fancybox__caption {
           font-size: 14px;
           font-weight: 600;
           text-align: center;
       }
   </style>
