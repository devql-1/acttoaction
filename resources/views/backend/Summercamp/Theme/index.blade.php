{{-- resources/views/backend/themes/index.blade.php --}}
@extends('backend.layout.app')

@section('content')
    <div class="container">
        <h3 class="mb-3">Themes</h3>

        <a href="{{ route('themes.create') }}" class="btn btn-primary mb-3">+ Add Theme</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Tag</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($themes as $key => $theme)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{!! $theme->icon !!}</td>
                        <td>{{ $theme->title }}</td>
                        <td>{{ $theme->tag }}</td>
                        <td>
                            <span class="badge {{ $theme->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $theme->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('themes.edit', $theme->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('themes.delete', $theme->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete?')" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
