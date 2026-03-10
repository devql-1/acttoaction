{{-- resources/views/backend/test_graph_configs/edit.blade.php --}}
@extends('backend.layout.app')
@section('content')
<div class="container-fluid py-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('test-graph-configs.index') }}" class="btn btn-sm btn-light border">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0">✏️ Edit Graph Config</h4>
            <p class="text-muted small mb-0">
                Updating config for: <strong>{{ $config->test->test_name }}</strong>
            </p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">

            {{-- Current test info banner --}}
            <div class="alert alert-light border d-flex align-items-center gap-3 mb-4">
                <div style="font-size:28px;">📝</div>
                <div>
                    <div class="fw-semibold">{{ $config->test->test_name }}</div>
                    <div class="text-muted small">Test ID: {{ $config->test_id }} · Config ID: {{ $config->id }}</div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('test-graph-configs.update', $config->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

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
                                           {{ old('graph_type', $config->graph_type) === $value ? 'checked' : '' }}
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
                                       {{ old('is_active', $config->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Active — show graph on result page
                                </label>
                            </div>
                        </div>

                        {{-- Timestamps --}}
                        <div class="row text-muted small mb-4">
                            <div class="col-6">
                                <i class="bi bi-clock me-1"></i>
                                Created: {{ $config->created_at->format('d M Y, h:i A') }}
                            </div>
                            <div class="col-6">
                                <i class="bi bi-pencil me-1"></i>
                                Updated: {{ $config->updated_at->format('d M Y, h:i A') }}
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-floppy me-1"></i> Update Config
                            </button>
                            <a href="{{ route('test-graph-configs.index') }}"
                               class="btn btn-light border px-4">Cancel</a>

                            {{-- Quick delete --}}
                            <form method="POST"
                                  action="{{ route('test-graph-configs.destroy', $config->id) }}"
                                  class="ms-auto"
                                  onsubmit="return confirm('Delete this config?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger px-3">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
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