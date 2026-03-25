@extends('backend.layout.app')

@section('content')

    <div class="container">
        <div class="page-inner">

            {{-- Header --}}
            <div class="page-header">
                <h3 class="fw-bold mb-3">About Section List</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">About Section</a></li>
                </ul>
            </div>

            {{-- Add Button --}}
            <div class="mb-3 text-end">
                <a href="{{ route('about-section-create') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-1"></i> Add New
                </a>
            </div>

            {{-- Table --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Heading</th>
                                    <th>Mini Stats</th>
                                    <th>Status</th>
                                    <th width="180">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($aboutSections as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        {{-- Image --}}
                                        <td>
                                            @if ($item->image)
                                                <img src="{{ asset($item->image) }}"
                                                    style="height:60px; width:80px; object-fit:cover; border-radius:6px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>

                                        {{-- Heading --}}
                                        <td>
                                            <strong>{{ $item->heading }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                {{ \Illuminate\Support\Str::limit($item->lead_text, 50) }}
                                            </small>
                                        </td>

                                        {{-- Mini Stats --}}
                                        <td>
                                            @if ($item->mini_stat_num && $item->mini_stat_label)
                                                @foreach (json_decode($item->mini_stat_num) as $i => $num)
                                                    <div>
                                                        <strong>{{ $num }}</strong>
                                                        <small class="text-muted">
                                                            {{ json_decode($item->mini_stat_label)[$i] ?? '' }}
                                                        </small>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>

                                        {{-- Status --}}
                                        <td>
                                            @if ($item->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>

                                        {{-- Actions --}}
                                        <td>
                                            <a href="{{ route('about-section-edit', $item->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            {{-- <form action="{{ route('about-section-delete', $item->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form> --}}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            No records found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $aboutSections->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
