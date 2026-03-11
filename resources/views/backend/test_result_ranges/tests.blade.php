@extends('backend.layout.app')

@section('content')

    <div class="container">
        <div class="page-inner">

            <div class="page-header">
                <h3 class="fw-bold mb-3">Result Ranges</h3>
            </div>

            <div class="row">

                @foreach($tests as $test)

                    <div class="col-md-4">

                        <div class="card card-round">

                            <div class="card-body">

                                <h5>{{ $test->test_name }}</h5>

                                <a href="{{ route('test-result-ranges.index', $test->id) }}" class="btn btn-primary btn-sm">

                                    Manage Ranges

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>
    </div>

@endsection