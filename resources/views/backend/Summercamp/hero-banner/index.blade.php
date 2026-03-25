@extends('backend.layout.app')

@section('content')

    <div class="container">
        <div class="page-inner">

            {{-- PAGE HEADER --}}
            <div class="page-header">
                <h3 class="fw-bold mb-3">Hero Banners</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Hero Banners</a></li>
                </ul>
            </div>

            {{-- HEADER ACTION --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="text-muted mb-0">
                    Only one banner can be active at a time. It appears at the top of the homepage.
                </p>
                <a href="{{ route('hero-banner.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-1"></i> Upload New Banner
                </a>
            </div>

            {{-- FLASH MESSAGE --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- CARD --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-title">All Hero Banners</div>
                </div>

                <div class="card-body">

                    @if ($banners->isEmpty())
                        <div class="text-center py-5">
                            <i class="fa fa-image fa-3x text-muted"></i>
                            <p class="mt-3 text-muted">No banners uploaded yet.</p>
                            <a href="{{ route('hero-banner.create') }}" class="btn btn-primary">
                                Upload First Banner
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Preview</th>
                                        <th>Alt Text</th>
                                        <th>Status</th>
                                        <th>Uploaded</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($banners as $banner)
                                        <tr>

                                            {{-- ID --}}
                                            <td class="text-muted small">{{ $banner->id }}</td>

                                            {{-- IMAGE --}}
                                            <td>
                                                <img src="{{ $banner->image_url }}" alt="{{ $banner->alt_text }}"
                                                    class="rounded" style="width:180px; height:80px; object-fit:cover;">
                                            </td>

                                            {{-- ALT TEXT --}}
                                            <td>{{ $banner->alt_text }}</td>

                                            {{-- STATUS --}}
                                            <td>
                                                @if ($banner->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>

                                            {{-- DATE --}}
                                            <td class="small text-muted">
                                                {{ $banner->created_at->format('d M Y') }}
                                            </td>

                                            {{-- ACTIONS --}}
                                            <td>
                                                <div class="d-flex gap-2 flex-wrap">

                                                    {{-- SET ACTIVE --}}
                                                    @unless ($banner->is_active)
                                                        <form action="{{ route('hero-banner.activate', $banner) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-success"
                                                                title="Set Active">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @endunless

                                                    {{-- EDIT --}}
                                                    <a href="{{ route('hero-banner.edit', $banner) }}"
                                                        class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    {{-- DELETE --}}
                                                    <form action="{{ route('hero-banner.destroy', $banner) }}"
                                                        method="POST" onsubmit="return confirm('Delete this banner?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

@endsection
