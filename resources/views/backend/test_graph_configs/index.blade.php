@extends('backend.layout.app')
@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-0">📊 Test Graph Configurations</h4>
                <p class="text-muted small mb-0">Control which chart type displays on each test result page.</p>
            </div>
            <a href="{{ route('test-graph-configs.create') }}" class="btn btn-primary btn-sm px-4">
                <i class="bi bi-plus-lg me-1"></i> Add Config
            </a>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Table --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8faff;">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Test Name</th>
                            <th>Graph Type</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tests as $test)
                            @php $cfg = $test->graphConfig; @endphp
                            <tr>
                                <td class="ps-4 text-muted small">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $test->test_name }}</span>
                                    <div class="text-muted small">ID: {{ $test->id }}</div>
                                </td>
                                <td>
                                    @if($cfg)
                                        @php
                                            $icons = ['bar' => '📊', 'radar' => '🕸️', 'pie' => '🥧', 'line' => '📈', 'none' => '🚫'];
                                            $colors = ['bar' => 'primary', 'radar' => 'purple', 'pie' => 'warning', 'line' => 'info', 'none' => 'secondary'];
                                        @endphp
                                        <span class="badge bg-{{ $colors[$cfg->graph_type] ?? 'secondary' }} px-3 py-2"
                                            style="font-size:12px;">
                                            {{ $icons[$cfg->graph_type] ?? '' }} {{ ucfirst($cfg->graph_type) }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-muted px-3 py-2" style="font-size:12px;">
                                            Not configured
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($cfg)
                                        @if($cfg->is_active)
                                            <span class="badge bg-success-subtle text-success px-3 py-2" style="font-size:12px;">
                                                <i class="bi bi-circle-fill me-1" style="font-size:8px;"></i> Active
                                            </span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary px-3 py-2" style="font-size:12px;">
                                                <i class="bi bi-circle me-1" style="font-size:8px;"></i> Inactive
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="text-muted small">
                                    {{ $cfg?->created_at?->format('d M Y') ?? '—' }}
                                </td>
                                <td class="text-end pe-4">
                                    @if($cfg)
                                        <a href="{{ route('test-graph-configs.edit', $cfg->id) }}"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('test-graph-configs.destroy', $cfg->id) }}"
                                            class="d-inline"
                                            onsubmit="return confirm('Delete config for {{ addslashes($test->name) }}?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('test-graph-configs.create') }}?test_id={{ $test->id }}"
                                            class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-plus"></i> Add
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <div style="font-size:36px;">📭</div>
                                    <div class="mt-2">No tests found. <a href="{{ route('test-graph-configs.create') }}">Add
                                            first config</a></div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($tests->hasPages())
                <div class="card-footer bg-white d-flex justify-content-end">
                    {{ $tests->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection