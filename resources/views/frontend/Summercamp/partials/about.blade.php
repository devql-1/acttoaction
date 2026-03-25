{{-- resources/views/frontend/partials/about.blade.php --}}
{{-- Requires: $about (AboutSection model instance or null) --}}

@if ($about)
    <section class="about-sec" id="about">
        <div class="container">
            <div class="row align-items-center g-5">

                {{-- Left: Text content --}}
                <div class="col-lg-6 order-2 order-lg-1">

                    <h2 class="section-heading">{{ $about->heading }}</h2>

                    @if ($about->lead_text)
                        <p class="lead-p">{{ $about->lead_text }}</p>
                    @endif

                    @if ($about->body_text)
                        <p class="body-p">{{ $about->body_text }}</p>
                    @endif

                    {{-- Mini stats --}}
                    @if (!empty($about->mini_stats))
                        <div class="mini-stats">
                            @foreach ($about->mini_stats as $ms)
                                <div class="mini-stat">
                                    <span class="num">{{ $ms['num'] }}</span>
                                    <span class="lbl">{{ $ms['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Action buttons --}}
                    <div class="d-flex gap-3 flex-wrap">
                        @if ($about->btn1_label && $about->btn1_url)
                            <a href="{{ $about->btn1_url }}" class="btn-fill">
                                <i class="bi bi-telephone-fill"></i>
                                {{ $about->btn1_label }}
                            </a>
                        @endif
                        @if ($about->btn2_label && $about->btn2_url)
                            <a href="{{ $about->btn2_url }}" target="_blank" class="btn-ghost">
                                <i class="bi bi-whatsapp"></i>
                                {{ $about->btn2_label }}
                            </a>
                        @endif
                    </div>

                </div>

                {{-- Right: Image + floating elements --}}
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="about-visual">

                        {{-- Orange badge --}}
                        @if ($about->badge_year || $about->badge_text)
                            <div class="about-badge">
                                @if ($about->badge_year)
                                    <span class="yr">{{ $about->badge_year }}</span>
                                @endif
                                @if ($about->badge_text)
                                    <span class="txt">{{ $about->badge_text }}</span>
                                @endif
                            </div>
                        @endif

                        {{-- Main image --}}
                        @if ($about->image_url)
                            <div class="about-img">
                                <img src="{{ $about->image_url }}" alt="{{ $about->heading }}" />
                            </div>
                        @endif

                        {{-- Floating info card --}}
                        @if ($about->fc_title || $about->fc_subtitle)
                            <div class="about-fc">
                                <div class="content">
                                    <div class="ico">
                                        <i class="bi bi-patch-check-fill"></i>
                                    </div>
                                    <div>
                                        @if ($about->fc_title)
                                            <h4>{{ $about->fc_title }}</h4>
                                        @endif
                                        @if ($about->fc_subtitle)
                                            <p>{{ $about->fc_subtitle }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>
@endif
