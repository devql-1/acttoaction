@extends('backend.layout.app')

@section('title', 'Result Ranges — ' . $test->test_name)

@section('content')

    <div class="container">

        <div class="page-inner">

            <!-- PAGE HEADER -->

            <div class="page-header d-flex justify-content-between align-items-center">

                <div>
                    <h3 class="fw-bold mb-3">Result Ranges</h3>

                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="#"><i class="icon-home"></i></a>
                        </li>

                        <li class="separator"><i class="icon-arrow-right"></i></li>

                        <li class="nav-item">
                            <a href="#">Tests</a>
                        </li>

                        <li class="separator"><i class="icon-arrow-right"></i></li>

                        <li class="nav-item">
                            <a href="#">{{ $test->test_name }}</a>
                        </li>

                        <li class="separator"><i class="icon-arrow-right"></i></li>

                        <li class="nav-item">
                            <a href="#">Result Ranges</a>
                        </li>
                    </ul>
                </div>

                <!-- Back Button -->
                >

            </div>

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">

                    <!-- COVERAGE BAR -->

                    @if($ranges->count())

                        <div class="card card-round mb-4">
                            <div class="card-body">

                                <div class="fw-semibold mb-2">
                                    Coverage Map (0% → 100%)
                                </div>

                                <div style="height:36px;background:#f0f4fb;border-radius:10px;overflow:hidden;display:flex;">

                                    @foreach($ranges as $r)

                                        <div style="
                                                                                                                                        width:{{ $r->max_percent - $r->min_percent }}%;
                                                                                                                                        background:{{ $r->color }};
                                                                                                                                        display:flex;
                                                                                                                                        align-items:center;
                                                                                                                                        justify-content:center;
                                                                                                                                        font-size:11px;
                                                                                                                                        font-weight:700;
                                                                                                                                        color:#fff;
                                                                                                                                        margin-left:{{ $loop->first ? $r->min_percent : 0 }}%;
                                                                                                                                        "
                                            title="{{ $r->label }} {{ $r->min_percent }}%-{{ $r->max_percent }}%">

                                            {{ $r->emoji }} {{ $r->label }}

                                        </div>

                                    @endforeach

                                </div>

                                <div class="d-flex justify-content-between small text-muted mt-1">
                                    <span>0%</span>
                                    <span>50%</span>
                                    <span>100%</span>
                                </div>

                            </div>
                        </div>

                    @endif

                    <!-- RANGES TABLE -->

                    <div class="card card-round">

                        <div class="card-header">

                            <div class="card-head-row card-tools-still-right">

                                <div class="card-title">
                                    Ranges for {{ $test->test_name }}
                                </div>

                                <div class="card-tools">
                                    <a href="{{ route('test-result-ranges.create', $test->id) }}"
                                        class="btn btn-success btn-sm">
                                        <i class="fa fa-plus"></i> Add Range
                                    </a>
                                </div>

                            </div>

                        </div>

                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table class="table table-hover align-middle mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Range</th>
                                            <th>Label</th>
                                            <th>Tagline</th>
                                            <th>Course</th>
                                            <th>Tags</th>
                                            <th>Color</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($ranges as $range)

                                            <tr>

                                                <td>

                                                    <span class="badge" style="
                                                                                                            background:{{ $range->color }}20;
                                                                                                            color:{{ $range->color }};
                                                                                                            padding:6px 10px;
                                                                                                            font-weight:600;
                                                                                                            ">

                                                        {{ $range->min_percent }}% - {{ $range->max_percent }}%

                                                    </span>

                                                </td>

                                                <td>

                                                    <span style="font-size:18px;">
                                                        {{ $range->emoji }}
                                                    </span>

                                                    <strong class="ms-1">
                                                        {{ $range->label }}
                                                    </strong>

                                                </td>

                                                <td class="text-muted small">
                                                    {{ $range->tagline }}
                                                </td>

                                                <td class="text-muted small">
                                                    {{ $range->recommended_course ?? '--' }}
                                                </td>

                                                <td>

                                                    @if($range->tags)

                                                        @foreach($range->tags as $tag)

                                                            <span class="badge bg-light text-dark">
                                                                {{ $tag }}
                                                            </span>

                                                        @endforeach

                                                    @else

                                                        <span class="text-muted">--</span>

                                                    @endif

                                                </td>

                                                <td>

                                                    <span style="
                                                                                                            display:inline-block;
                                                                                                            width:28px;
                                                                                                            height:28px;
                                                                                                            border-radius:6px;
                                                                                                            background:{{ $range->color }};
                                                                                                            border:1px solid #ddd;
                                                                                                            "> </span>

                                                </td>

                                                <td class="text-center">

                                                    <div class="d-flex justify-content-center gap-2">

                                                        <a href="{{ route('test-result-ranges.edit', [$test->id, $range->id]) }}"
                                                            class="btn btn-sm btn-primary">

                                                            <i class="fa fa-edit"></i>

                                                        </a>

                                                        <form method="POST"
                                                            action="{{ route('test-result-ranges.destroy', [$test->id, $range->id]) }}"
                                                            onsubmit="return confirm('Delete this range?')">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-sm btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>

                                                        </form>

                                                    </div>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="7" class="text-center text-muted py-4">

                                                    No ranges yet.

                                                    <a href="{{ route('test-result-ranges.create', $test->id) }}">
                                                        Add first range
                                                    </a>

                                                </td>

                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection