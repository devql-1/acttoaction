@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">People</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">People</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Mentors · Speakers · Guests · Faculty</div>
                                <div class="card-tools">
                                    <a href="{{ route('people-create') }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus me-1"></i> Add Person
                                    </a>
                                </div>
                            </div>

                            {{-- Section filter tabs --}}
                            <div class="mt-3">
                                <ul class="nav nav-pills nav-sm" id="sectionTabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#" data-section="all">
                                            All
                                            <span class="badge badge-secondary ms-1">
                                                {{ collect($people)->flatten()->count() }}
                                            </span>
                                        </a>
                                    </li>
                                    @foreach ($sections as $key => $label)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-section="{{ $key }}">
                                                {{ $label }}
                                                <span class="badge badge-secondary ms-1">
                                                    {{ isset($people[$key]) ? $people[$key]->count() : 0 }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id="basic-datatables">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th class="text-center">Section</th>
                                            <th class="text-center">Role Badge</th>
                                            <th class="text-center">Sort</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(collect($people)->flatten(1) as $person)
                                            <tr id="record-row-{{ $person->id }}" data-section="{{ $person->section }}">

                                                <td>{{ $loop->iteration }}</td>

                                                {{-- Photo --}}
                                                <td>
                                                    <a data-fancybox="people-gallery" href="{{ $person->photo_url }}">
                                                        <img src="{{ $person->photo_url }}" alt="{{ $person->name }}"
                                                            style="width:50px;height:50px;object-fit:cover;
                                                            border-radius:8px;
                                                            box-shadow:0 4px 12px rgba(0,0,0,0.15);
                                                            transition:transform 0.3s;">
                                                    </a>
                                                </td>

                                                {{-- Name + designation --}}
                                                <td>
                                                    <strong>{{ $person->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $person->designation }}</small>
                                                    {{-- Social links --}}
                                                    <div class="mt-1">
                                                        @if ($person->instagram_url)
                                                            <a href="{{ $person->instagram_url }}" target="_blank"
                                                                class="text-danger me-2" style="font-size:11px;">
                                                                <i class="fa fa-instagram"></i> Instagram
                                                            </a>
                                                        @endif
                                                        @if ($person->youtube_url)
                                                            <a href="{{ $person->youtube_url }}" target="_blank"
                                                                class="text-danger me-2" style="font-size:11px;">
                                                                <i class="fa fa-youtube-play"></i> YouTube
                                                            </a>
                                                        @endif
                                                        @if ($person->press_url)
                                                            <a href="{{ $person->press_url }}" target="_blank"
                                                                class="text-primary" style="font-size:11px;">
                                                                <i class="fa fa-newspaper-o"></i>
                                                                {{ $person->press_label ?? 'Press' }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>

                                                {{-- Section badge --}}
                                                <td class="text-center">
                                                    @php
                                                        $colors = [
                                                            'mentor' => 'badge-warning',
                                                            'speaker' => 'badge-info',
                                                            'guest' => 'badge-success',
                                                            'faculty' => 'badge-primary',
                                                        ];
                                                    @endphp
                                                    <span
                                                        class="badge {{ $colors[$person->section] ?? 'badge-secondary' }}">
                                                        {{ ucfirst($person->section) }}
                                                    </span>
                                                </td>

                                                {{-- Role badge --}}
                                                <td class="text-center">
                                                    <small class="text-muted">{{ $person->role_badge }}</small>
                                                </td>

                                                {{-- Sort order --}}
                                                <td class="text-center">
                                                    <span class="badge badge-secondary">{{ $person->sort_order }}</span>
                                                </td>

                                                {{-- Status toggle --}}
                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-status"
                                                            data-id="{{ $person->id }}"
                                                            data-url="{{ route('people-status') }}"
                                                            {{ $person->status == 1 ? 'checked' : '' }}>
                                                        <span class="record-toggle"></span>
                                                    </label>
                                                </td>

                                                {{-- Actions --}}
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-1">

                                                        <a href="{{ route('people-edit', $person->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fa fa-edit me-1"></i> Edit
                                                        </a>

                                                        <form id="delete-form-{{ $person->id }}"
                                                            action="{{ route('people-destroy', $person->id) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $person->id }}, '{{ addslashes($person->name) }}')">
                                                            <i class="fa fa-trash me-1"></i> Delete
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted py-4">
                                                    No people found.
                                                    <a href="{{ route('people-create') }}">Add your first person</a>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // ── Section filter tabs ──────────────────────────────────
        document.querySelectorAll('#sectionTabs .nav-link').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('#sectionTabs .nav-link').forEach(t => t.classList.remove(
                    'active'));
                this.classList.add('active');

                const section = this.dataset.section;
                document.querySelectorAll('tbody tr[data-section]').forEach(row => {
                    if (section === 'all' || row.dataset.section === section) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // ── Delete confirm ───────────────────────────────────────
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Deleting "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}'
            });
        @endif
    </script>
@endsection
