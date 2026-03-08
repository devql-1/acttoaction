@extends('frontend.course.layout')

@section('content')

    @php
        use Carbon\Carbon;

        $now = Carbon::now();

        $eventStart = Carbon::parse($event->event_date);
        $eventEnd = $event->event_end_date
            ? Carbon::parse($event->event_end_date)
            : $eventStart->copy()->endOfDay();

        if ($now->lt($eventStart)) {
            $statusLabel = 'Upcoming';
            $statusColor = '#0d6efd';
        } elseif ($now->between($eventStart, $eventEnd)) {
            $statusLabel = 'Ongoing';
            $statusColor = '#198754';
        } else {
            $statusLabel = 'Past';
            $statusColor = '#6c757d';
        }
    @endphp


    {{-- HERO --}}
    <div class="page-title">

        <div class="heading" style="background:url('{{ $event->banner_image ? asset($event->banner_image) : asset('assets/img/health/cardiology-2.webp') }}') center/cover no-repeat;
                                        min-height:360px;position:relative;display:flex;align-items:center;">

            <div style="position:absolute;inset:0;background:linear-gradient(120deg,rgba(0,0,0,0.75),rgba(0,0,0,0.3));">
            </div>

            <div class="container text-center" style="position:relative;z-index:2">

                <span class="badge" style="background:{{ $statusColor }};
                                        padding:6px 18px;font-size:13px;border-radius:25px;">
                    {{ $statusLabel }}
                </span>

                <h1 class="text-white mt-3 fw-bold">
                    {{ $event->title }}
                </h1>

                <p class="text-white mt-2 fs-6">

                    <i class="fas fa-calendar-alt me-2"></i>

                    {{ $eventStart->format('d M Y') }}

                    @if($event->event_end_date)
                        - {{ $eventEnd->format('d M Y') }}
                    @endif

                </p>

            </div>
        </div>

        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('home') }}">Home</a></li>
                    <li><a href="{{ route('event') }}">Events</a></li>
                    <li class="current">{{ Str::limit($event->title, 40) }}</li>
                </ol>
            </div>
        </nav>

    </div>



    {{-- EVENT DESCRIPTION --}}
    <section class="section py-5">
        <div class="container">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <h2 class="fw-bold mb-3">
                        {{ $event->title }}
                    </h2>

                    <div class="mb-4 text-muted" style="line-height:1.9;">
                        {!! $event->description !!}
                    </div>

                    <div class="row g-3">

                        <div class="col-6">
                            <div class="p-3 border rounded shadow-sm bg-light">
                                <i class="fas fa-calendar text-primary"></i>
                                <div class="small text-muted">Start Date</div>
                                <strong>{{ $eventStart->format('d M Y') }}</strong>
                            </div>
                        </div>

                        @if($event->event_end_date)
                            <div class="col-6">
                                <div class="p-3 border rounded shadow-sm bg-light">
                                    <i class="fas fa-calendar-check text-success"></i>
                                    <div class="small text-muted">End Date</div>
                                    <strong>{{ $eventEnd->format('d M Y') }}</strong>
                                </div>
                            </div>
                        @endif

                        <div class="col-6">
                            <div class="p-3 border rounded shadow-sm bg-light">
                                <i class="fas fa-layer-group text-warning"></i>
                                <div class="small text-muted">Sub Events</div>
                                <strong>{{ $event->subEvents->count() }}</strong>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="p-3 border rounded shadow-sm bg-light">
                                <i class="fas fa-info-circle text-info"></i>
                                <div class="small text-muted">Status</div>
                                <strong>{{ $statusLabel }}</strong>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="col-lg-6 text-center">

                    <img class="img-fluid rounded shadow" style="max-height:420px;object-fit:cover"
                        src="{{ $event->banner_image ? asset($event->banner_image) : asset('assets/img/health/cardiology-2.webp') }}">

                </div>

            </div>

        </div>
    </section>



    {{-- SUB EVENTS --}}
    @if($event->subEvents->count())

        <section class="section bg-light py-5">

            <div class="container">

                <div class="text-center mb-5">
                    <h2 class="fw-bold">Sub Events</h2>
                    <p class="text-muted">Explore sessions inside this event</p>
                </div>


                <div class="row g-4">

                    @foreach($event->subEvents as $sub)

                        @php

                            $subDate = Carbon::parse($sub->event_date);

                            $subStart = $sub->start_time
                                ? Carbon::parse($sub->event_date)->setTimeFromTimeString($sub->start_time)
                                : $subDate->copy()->startOfDay();

                            $subEnd = $sub->end_time
                                ? Carbon::parse($sub->event_date)->setTimeFromTimeString($sub->end_time)
                                : $subDate->copy()->endOfDay();

                            if ($now->lt($subStart)) {
                                $subStatus = 'Upcoming';
                                $subColor = '#0d6efd';
                            } elseif ($now->lte($subEnd)) {
                                $subStatus = 'Ongoing';
                                $subColor = '#198754';
                            } else {
                                $subStatus = 'Past';
                                $subColor = '#6c757d';
                            }

                        @endphp


                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 border-0 shadow-sm">

                                @if($sub->banner_image)
                                    <img src="{{ asset($sub->banner_image) }}" class="card-img-top"
                                        style="height:200px;object-fit:cover">
                                @endif

                                <div class="card-body">

                                    <h5 class="fw-bold">{{ $sub->title }}</h5>

                                    <span class="badge mb-3" style="background:{{ $subColor }}">
                                        {{ $subStatus }}
                                    </span>

                                    @if($sub->description)
                                        <p class="text-muted small">
                                            {{ Str::limit(strip_tags($sub->description), 120) }}
                                        </p>
                                    @endif

                                    {{-- Sub Event Details --}}
                                    <ul class="list-unstyled small text-muted">

                                        <li class="mb-2">
                                            <i class="fas fa-calendar me-2 text-primary"></i>
                                            {{ $subDate->format('d M Y') }}
                                        </li>

                                        @if($sub->start_time)
                                            <li class="mb-2">
                                                <i class="fas fa-clock me-2 text-warning"></i>
                                                {{ Carbon::parse($sub->start_time)->format('h:i A') }}
                                                @if($sub->end_time)
                                                    - {{ Carbon::parse($sub->end_time)->format('h:i A') }}
                                                @endif
                                            </li>
                                        @endif

                                        @if($sub->fees !== null)
                                            <li class="mb-2">
                                                <i class="fas fa-tag me-2 text-success"></i>
                                                {{ $sub->fees == 0 ? 'Free' : '₹' . number_format($sub->fees) }}
                                            </li>
                                        @endif

                                        @if($sub->max_seats)
                                            <li class="mb-2">
                                                <i class="fas fa-chair me-2 text-info"></i>
                                                {{ $sub->max_seats }} seats
                                            </li>
                                        @endif

                                        {{-- Centers --}}
                                        @if($sub->centers->count())
                                            <li class="mb-2">
                                                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                                                @foreach($sub->centers as $center)
                                                    <span class="badge bg-light text-dark me-1 mb-1">
                                                        {{ $center->name }}
                                                    </span>
                                                @endforeach
                                            </li>
                                        @endif

                                    </ul>

                                    {{-- Register / Closed --}}
                                    @if($subStatus != 'Past')
                                        <a href="#register-{{ $sub->id }}" class="btn btn-primary btn-sm w-100">
                                            Register Now
                                        </a>
                                    @else
                                        <button class="btn btn-secondary btn-sm w-100" disabled>
                                            Closed
                                        </button>
                                    @endif

                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

        </section>

    @endif



    {{-- BACK BUTTON --}}
    <section class="section text-center pb-5">

        <a href="{{ route('event') }}" class="btn btn-lg btn-outline-primary px-4">

            <i class="fas fa-arrow-left me-2"></i>

            Back to Events

        </a>

    </section>


@endsection