@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add Chatbot FAQ</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.chatbot-faq') }}">Chatbot FAQs</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add New</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add FAQ for Chatbot</div>
                    </div>
                    <form action="{{ route('admin.chatbot-faq-store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="question">Question <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text"
                                                name="question"
                                                id="question"
                                                class="form-control @error('question') is-invalid @enderror"
                                                value="{{ old('question') }}"
                                                placeholder="Enter the FAQ question">
                                            @error('question')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="answer">Answer <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="answer"
                                                id="answer"
                                                class="form-control @error('answer') is-invalid @enderror"
                                                rows="5"
                                                placeholder="Enter the FAQ answer">{{ old('answer') }}</textarea>
                                            @error('answer')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                            <small class="form-text text-muted">Plain text answer shown in the chatbot.</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="sort_order">Sort Order</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number"
                                                name="sort_order"
                                                id="sort_order"
                                                class="form-control"
                                                value="{{ old('sort_order', 0) }}"
                                                min="0"
                                                placeholder="0">
                                            <small class="form-text text-muted">Lower numbers appear first. Default: 0</small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-action text-center">
                            <button class="btn btn-success" type="submit">Save FAQ</button>
                            <a href="{{ route('admin.chatbot-faq') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
