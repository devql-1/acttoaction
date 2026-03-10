{{-- resources/views/backend/test_graph_configs/create.blade.php --}}
@extends('backend.layout.app')
@section('content')
<div class="container-fluid py-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('test-graph-configs.index') }}" class="btn btn-sm btn-light border">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">➕ Add Graph Config</h4>
            <p class="text-muted small mb-0">Assign a chart type to a test's result page.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('test-graph-configs.store') }}" method="POST">
                        @csrf

                        {{-- Test selector --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Select Test <span class="text-danger">*</span>
                            </label>
                            <select name="test_id" class="form-select @error('test_id') is-invalid @enderror" required>
                                <option value="">— Choose a test —</option>
                                @foreach($tests as $test)
                                    <option value="{{ $test->id }}" {{ old('test_id') == $test->id ? 'selected' : '' }}>
                                        {{ $test->test_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('test_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($tests->isEmpty())
                                <div class="form-text text-warning">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    All tests already have a graph config.
                                </div>
                            @endif
                        </div>

                        {{-- Graph type cards --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Graph Type <span class="text-danger">*</span>
                            </label>
                            <div class="row g-3">
                                @php
                                    $graphOptions = [
                                        'bar'   => ['icon'=>'📊','label'=>'Bar Chart',    'desc'=>'Side-by-side column comparison'],
                                        'radar' => ['icon'=>'🕸️','label'=>'Radar/Spider', 'desc'=>'Spider web talent profile'],
                                        'pie'   => ['icon'=>'🥧','label'=>'Pie/Doughnut', 'desc'=>'Percentage share distribution'],
                                        'line'  => ['icon'=>'📈','label'=>'Line/Area',    'desc'=>'Score flow across sections'],
                                        'none'  => ['icon'=>'🚫','label'=>'No Graph',     'desc'=>'Text result only, no chart'],
                                    ];
                                @endphp
                                @foreach($graphOptions as $value => $opt)
                                <div class="col-6 col-md-4">
                                    <input type="radio" class="btn-check" name="graph_type"
                                           id="gt_{{ $value }}" value="{{ $value }}"
                                           {{ old('graph_type', 'bar') === $value ? 'checked' : '' }}
                                           required>
                                    <label class="graph-option-card w-100 text-center p-3" for="gt_{{ $value }}"
                                           style="cursor:pointer;border:2px solid #e5e9f2;border-radius:14px;
                                                  transition:all .2s;display:block;user-select:none;">
                                        <div style="font-size:28px;line-height:1;margin-bottom:6px;">
                                            {{ $opt['icon'] }}
                                        </div>
                                        <div class="fw-semibold" style="font-size:13px;">{{ $opt['label'] }}</div>
                                        <div class="text-muted" style="font-size:11px;margin-top:3px;">{{ $opt['desc'] }}</div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @error('graph_type')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Active toggle --}}
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active"
                                       id="is_active" value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Active — show graph on result page
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-floppy me-1"></i> Save Config
                            </button>
                            <a href="{{ route('test-graph-configs.index') }}"
                               class="btn btn-light border px-4">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn-check:checked + .graph-option-card {
    border-color: #175cdd !important;
    background: #eff6ff;
    box-shadow: 0 0 0 3px rgba(23,92,221,.15);
}
.graph-option-card:hover {
    border-color: #93b4f5 !important;
    background: #f8fbff;
}
</style>
@endsection