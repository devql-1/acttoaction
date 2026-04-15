@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Chatbot FAQs</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Chatbot</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">FAQs</a></li>
            </ul>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Chatbot FAQ List</div>
                            <a href="{{ route('admin.chatbot-faq-create') }}" class="btn btn-dark ms-auto">
                                <i class="fa fa-plus"></i> Add FAQ
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Question</th>
                                        <th class="text-center">Sort Order</th>
                                        <th class="text-center">Published</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faqs as $faq)
                                    <tr id="record-row-{{ $faq->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            {{ $faq->question }}
                                        </th>
                                        <td class="text-center">{{ $faq->sort_order }}</td>
                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox"
                                                    class="toggle-status"
                                                    data-id="{{ $faq->id }}"
                                                    data-url="{{ route('admin.chatbot-faq-status') }}"
                                                    {{ $faq->status == 1 ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-button-action">
                                                <a href="{{ route('admin.chatbot-faq-edit', $faq->id) }}"
                                                   class="btn btn-link btn-primary btn-lg me-3">
                                                   <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="btn btn-link btn-danger btn-lg delete-record"
                                                   data-id="{{ $faq->id }}"
                                                   data-url="{{ route('admin.chatbot-faq-destroy', $faq->id) }}">
                                                   <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
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
