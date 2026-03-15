@extends('backend.layout.app')

@section('content')

    <div class="container">

        <div class="page-inner">

            <!-- Page Header -->

            <div class="page-header">
                <h3 class="fw-bold mb-3">Test Graph Configurations</h3>

                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Tests</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Graph Configurations</a></li>
                </ul>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">

                    <div class="card card-round">

                        <!-- Card Header -->

                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">

                                <div class="card-title">Test Graph Configurations</div>

                                <div class="card-tools">
                                    <a href="{{ route('test-graph-configs.create') }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus me-1"></i> Add Config
                                    </a>
                                </div>

                            </div>
                        </div>

                        <!-- Card Body -->

                        <div class="card-body p-2">

                            <div class="table-responsive">

                                <table class="table table-hover table-striped align-middle mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Test Name</th>
                                            <th class="text-center">Graph Type</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Created</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($tests as $test)
                                            @php $cfg = $test->graphConfig; @endphp

                                            <tr>

                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    <strong>{{ $test->test_name }}</strong>
                                                    <div class="text-muted small">ID: {{ $test->id }}</div>
                                                </td>

                                                <td class="text-center">

                                                    @if ($cfg)
                                                        @php
                                                            $icons = [
                                                                'bar' => '📊',
                                                                'radar' => '🕸️',
                                                                'pie' => '🥧',
                                                                'line' => '📈',
                                                                'none' => '🚫',
                                                            ];
                                                        @endphp

                                                        <span class="badge bg-primary">
                                                            {{ $icons[$cfg->graph_type] ?? '' }}
                                                            {{ ucfirst($cfg->graph_type) }}
                                                        </span>
                                                    @else
                                                        <span class="badge bg-light text-muted">
                                                            Not configured
                                                        </span>
                                                    @endif

                                                </td>

                                                <td class="text-center">

                                                    @if ($cfg)
                                                        @if ($cfg->is_active)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-secondary">Inactive</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif

                                                </td>

                                                <td class="text-center text-muted small">
                                                    {{ $cfg?->created_at?->format('d M Y') ?? '--' }}
                                                </td>

                                                <!-- Action Buttons -->

                                                <td class="text-center">

                                                    @if ($cfg)
                                                        <div class="d-flex justify-content-center gap-2">


                                                            <a href="{{ route('test-graph-configs.edit', $cfg->id) }}"
                                                                class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i>
                                                            </a>

                                                            <form id="delete-form-{{ $cfg->id }}"
                                                                action="{{ route('test-graph-configs.destroy', $cfg->id) }}"
                                                                method="POST" style="display:none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>

                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="confirmDelete({{ $cfg->id }}, '{{ addslashes($test->test_name) }}')">

                                                                <i class="fa fa-trash"></i>

                                                            </button>

                                                        </div>
                                                    @else
                                                        <a href="{{ route('test-graph-configs.create') }}?test_id={{ $test->id }}"
                                                            class="btn btn-sm btn-success"> <i class="fa fa-plus"></i> Add
                                                        </a>
                                                    @endif

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    No tests found.
                                                    <a href="{{ route('test-graph-configs.create') }}">Add first config</a>
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        @if ($tests->hasPages())
                            <div class="card-footer bg-white d-flex justify-content-end">
                                {{ $tests->links() }}
                            </div>
                        @endif

                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- SweetAlert2 -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id, name) {

            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete "' + name + '". This cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }

            });

        }
    </script>

@endsection
