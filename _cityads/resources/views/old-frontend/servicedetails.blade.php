@extends('frontend.layout.app')
@section('content')

<!-- Page Banner -->
<div class="page-banner-area">
    <div class="container">
        <div
            class="page-banner-inner-area text-center position-relative z-1"
            style="background-image: url({{ $servicedetails->image ? asset('img/'.$servicedetails->image) : asset('assets/img/placeholder-image-3.jpg') }});"
        >
            <h2 class="text-uppercase text-white text_animation">
                {{ $servicedetails->title }}
            </h2>
            <ul class="p-0 m-0 list-unstyled text-white">
                <li class="d-inline-block position-relative">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="d-inline-block position-relative">
                    <a href="{{ route('service') }}">Services</a>
                </li>
                <li class="d-inline-block position-relative">
                    Service Details
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Banner -->

<!-- Service Details -->
<div class="service-details-area ptb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="service-details-desc">

                    @php
                        $images = json_decode($servicedetails->multiple_images);
                    @endphp

                    @if($images && count($images) > 0)
                    <div id="serviceImageSlider" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="3000">
                        
                        <div class="carousel-indicators">
                            @foreach($images as $index => $img)
                                <button type="button" data-bs-target="#serviceImageSlider" data-bs-slide-to="{{ $index }}" 
                                    class="{{ $index == 0 ? 'active' : '' }}" 
                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>

                        <!-- Slides -->
                        <div class="carousel-inner">
                            @foreach($images as $index => $img)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ $img ? asset('img/'.$img) : asset('assets/img/placeholder-image-3.jpg') }}" 
                                         class="d-block w-100" 
                                         alt="service-image-{{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#serviceImageSlider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#serviceImageSlider" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    @else
                        <div class="image text-center mb-4">
                            <img src="{{ $servicedetails->image ? asset('img/'.$servicedetails->image) : asset('assets/img/placeholder-image-3.jpg') }}" 
                                 class="d-block w-100 rounded shadow-sm" 
                                 alt="service-details-image">
                        </div>
                    @endif

                    {{-- Title + Description --}}
                    <h3 class="text-uppercase mt-4">{{ $servicedetails->title }} - overview</h3>
                    <p>{!! $servicedetails->description !!}</p>

                    {{-- Advantages --}}
                    @if(!empty($servicedetails->advantages))
                        <ul class="custom-list p-0 list-unstyled">
                            @foreach(explode("\n", $servicedetails->advantages ?? '') as $adv)
                                @if(trim($adv) !== '')
                                    <li class="position-relative mb-2">
                                        <div class="icon d-flex align-items-center justify-content-center rounded-circle">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <h4 class="text-uppercase">{{ trim($adv) }}</h4>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif

                    {{-- FAQs --}}
                    @if($servicedetails->faqs()->count() > 0)
                        <h3 class="text-uppercase">Questions? You Need Answer</h3>
                        <div class="accordion" id="serviceDetailsAccordion">
                            @foreach ($servicedetails->faqs as $key => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $key }}">
                                        <button 
                                            class="accordion-button {{ $key !== 0 ? 'collapsed' : '' }}" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapse{{ $key }}" 
                                            aria-expanded="{{ $key === 0 ? 'true' : 'false' }}" 
                                            aria-controls="collapse{{ $key }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div 
                                        id="collapse{{ $key }}" 
                                        class="accordion-collapse collapse {{ $key === 0 ? 'show' : '' }}" 
                                        aria-labelledby="heading{{ $key }}" 
                                        data-bs-parent="#serviceDetailsAccordion">
                                        <div class="accordion-body">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* 🌄 Slider Styling */
#serviceImageSlider {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

#serviceImageSlider img {
    height: 500px;
    object-fit: cover;
    border-radius: 10px;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0,0,0,0.6);
    border-radius: 50%;
    padding: 20px;
}

.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #999;
}

.carousel-indicators .active {
    background-color: #333;
}

@media (max-width: 768px) {
    #serviceImageSlider img {
        height: 300px;
    }
}
</style>

@endsection
