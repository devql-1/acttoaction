{{-- resources/views/frontend/workshops.blade.php --}}
@extends('frontend.course.layout')


@section('title', 'Workshops — Act To Action')

@section('content')
    <style>
        .service-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            padding: 16px 42px;
            border-radius: 60px;

            background: linear-gradient(135deg, #36d1dc, #5b86e5);
            color: #fff;

            font-size: 1.05rem;
            font-weight: 600;
            letter-spacing: 0.3px;

            border: none;
            cursor: pointer;

            position: relative;
            transition: all 0.35s ease;

            box-shadow: 0 10px 25px rgba(91, 134, 229, 0.35);
        }

        /* Arrow animation */
        .service-btn i {
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        /* Hover effect */
        .service-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 35px rgba(91, 134, 229, 0.45);
        }

        /* Arrow moves */
        .service-btn:hover i {
            transform: translateX(8px);
        }

        /* Click feel */
        .service-btn:active {
            transform: scale(0.96);
        }

        /* Soft glow effect */
        .service-btn::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 60px;
            background: linear-gradient(135deg, #36d1dc, #5b86e5);
            filter: blur(18px);
            opacity: 0.5;
            z-index: -1;
        }
    </style>
    {{-- ── Page Title ── --}}
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Our Workshops</h1>
                        <p class="mb-0">Empowering children with professional skill courses aligned with Skill India
                            Mission &amp; National Education Policy 2020</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Workshops</li>
                </ol>
            </div>
        </nav>
    </div>

    {{-- ── Filter Form ── --}}
    <section class="find-a-doctor section">
        <div class="container">

            <div class="search-section text-center">
                <h2 class="search-title">Find Your Perfect Workshop</h2>
                <p class="search-subtitle">Select an age group and city to discover workshops near you</p>

                <form method="GET" action="{{ route('workshops') }}" id="workshopFilterForm">
                    <div class="row justify-content-center g-3 mt-2">

                        <div class="col-lg-4 col-md-5">
                            <div class="search-input-group">
                                <div class="select-wrapper">
                                    <i class="bi bi-people"></i>
                                    <select name="age_group_id" id="ageGroupSelect" class="form-select"
                                        onchange="this.form.submit()">
                                        <option value="">Select Age Group</option>
                                        @foreach ($ageGroups as $group)
                                            <option value="{{ $group->id }}"
                                                {{ $selectedAgeGroupId == $group->id ? 'selected' : '' }}>
                                                {{ $group->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        @if ($selectedAgeGroupId)
                            <div class="col-lg-4 col-md-5">
                                <div class="search-input-group">
                                    <div class="select-wrapper">
                                        <i class="bi bi-geo-alt"></i>
                                        @if ($cities->isNotEmpty())
                                            <select name="city_id" id="citySelect" class="form-select"
                                                onchange="this.form.submit()">
                                                <option value="">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ $selectedCityId == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select class="form-select" disabled>
                                                <option>No cities available yet</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </form>

                {{-- Selection breadcrumb trail --}}
                @if ($selectedAgeGroup || $selectedCity)
                    <div class="mt-3">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('workshops') }}">All Workshops</a>
                            </li>
                            @if ($selectedAgeGroup)
                                <li class="breadcrumb-item {{ !$selectedCity ? 'active' : '' }}">
                                    @if ($selectedCity)
                                        <a href="{{ route('workshops', ['age_group_id' => $selectedAgeGroupId]) }}">
                                            {{ $selectedAgeGroup->name }}
                                        </a>
                                    @else
                                        {{ $selectedAgeGroup->name }}
                                    @endif
                                </li>
                            @endif
                            @if ($selectedCity)
                                <li class="breadcrumb-item active">{{ $selectedCity->name }}</li>
                            @endif
                        </ol>
                    </div>
                @endif

            </div>


            @if ($selectedAgeGroupId && $selectedCityId)

                {{-- Results header --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-5 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">
                            Workshops in {{ $selectedCity->name }}
                        </h4>
                        <p class="text-muted small mb-0">
                            Age Group: {{ $selectedAgeGroup->name }}
                            @if ($selectedAgeGroup->description)
                                &mdash; {{ $selectedAgeGroup->description }}
                            @endif
                        </p>
                    </div>
                    <span class="badge bg-primary px-3 py-2" style="font-size:14px;">
                        {{ $schools->count() }}
                        Workshop{{ $schools->count() !== 1 ? 's' : '' }} Found
                    </span>
                </div>

                @if ($schools->isNotEmpty())

                    <div class="row gy-4">
                        @foreach ($schools as $school)
                            <div class="col-lg-4 col-md-6">
                                <div class="service-item">

                                    {{-- School image --}}
                                    <div class="service-image">
                                        @if ($school->image_url)
                                            <img src="{{ $school->image_url }}" alt="{{ $school->name }}"
                                                class="img-fluid">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light"
                                                style="height:220px;">
                                                <i class="bi bi-building" style="font-size:3.5rem;color:#ccc;"></i>
                                            </div>
                                        @endif
                                        <div class="service-overlay">
                                            <i class="bi bi-building"></i>
                                        </div>
                                    </div>

                                    {{-- School details --}}
                                    <div class="service-content">

                                        <div class="mb-3">
                                            <span class="badge bg-primary">
                                                {{ $selectedAgeGroup->name }}
                                            </span>
                                            @if ($school->timings)
                                                <span class="badge bg-success ms-2">
                                                    <i class="bi bi-clock me-1"></i>{{ $school->timings }}
                                                </span>
                                            @endif
                                        </div>

                                        <h3>{{ $school->name }}</h3>

                                        @if ($school->description)
                                            <p>{{ Str::limit($school->description, 501) }}</p>
                                        @endif

                                        <div class="service-features">
                                            <div class="feature-item">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                <span>{{ $selectedCity->name }}</span>
                                            </div>
                                            @if ($school->address)
                                                <div class="feature-item">
                                                    <i class="bi bi-pin-map-fill"></i>
                                                    <span>{{ $school->address }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <a href="{{ route('workshops.show', $school->id) }}" target="_blank"
                                            rel="noopener">
                                            <button type="button"
                                                style="
            background: var(--accent-color);
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        ">
                                                Register Now
                                                <i class="bi bi-arrow-right"></i>
                                            </button>
                                        </a>


                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Age + city selected but no schools added yet --}}
                    <div class="text-center py-5">
                        <i class="bi bi-search" style="font-size:3.5rem;color:#ccc;"></i>
                        <h4 class="mt-3">No Workshops Found</h4>
                        <p class="text-muted">
                            No workshops are available in
                            <strong>{{ $selectedCity->name }}</strong>
                            for <strong>{{ $selectedAgeGroup->name }}</strong> yet.<br>
                            Please check back soon or contact us directly.
                        </p>
                        <a href="tel:9119118844" class="btn btn-primary mt-2">
                            <i class="bi bi-telephone-fill me-1"></i> Call Us
                        </a>
                    </div>

                @endif
            @elseif($selectedAgeGroupId && !$selectedCityId)
                {{-- Age selected, waiting for city --}}
                <div class="text-center py-5 mt-4">
                    <i class="bi bi-geo-alt" style="font-size:3rem;color:#ddd;"></i>
                    <p class="text-muted mt-3">
                        Now select a <strong>city</strong> above to see available workshops
                        for <strong>{{ $selectedAgeGroup->name ?? '' }}</strong>.
                    </p>
                </div>
            @else
                {{-- Nothing selected --}}
                <div class="text-center py-5 mt-4">
                    <i class="bi bi-arrow-up-circle" style="font-size:3rem;color:#ddd;"></i>
                    <p class="text-muted mt-3">
                        Please select an <strong>age group</strong> above to get started.
                    </p>
                </div>

            @endif

        </div>
    </section>

    {{-- ── CTA ── --}}
    <section class="call-to-action section light-background">
        <div class="container">
            <div class="contact-block">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="contact-content">
                            <h2>Not Sure Which Workshop to Choose?</h2>
                            <p>Our team is here to help you find the perfect workshop for your child's interests and
                                development goals.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-actions">
                            <a href="tel:9119118844" class="emergency-call">
                                <i class="bi bi-telephone-fill"></i>
                                <span>Call Us: +91 91191 88844</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
