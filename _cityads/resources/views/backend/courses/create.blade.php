@extends('backend.layout.app')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Add Course</h3>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Create Course</div>
                        </div>

                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                {{-- TITLE --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Course Title</label></div>
                                    <div class="col-md-9">
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                </div>

                                {{-- DESCRIPTION --}}
                                {{-- DESCRIPTION --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Description</label></div>
                                    <div class="col-md-9">
                                        <textarea name="description" id="descriptionEditor" class="form-control"></textarea>
                                    </div>
                                </div>

                                {{-- DURATION --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Duration</label></div>
                                    <div class="col-md-9">
                                        <input type="text" name="duration" class="form-control" placeholder="1 Month">
                                    </div>
                                </div>

                                {{-- TOTAL SESSIONS --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Total Sessions</label></div>
                                    <div class="col-md-9">
                                        <input type="number" name="total_sessions" class="form-control">
                                    </div>
                                </div>

                                {{-- MODE --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Mode</label></div>
                                    <div class="col-md-9">
                                        <select name="mode" class="form-control">
                                            <option value="online">Online</option>
                                            <option value="offline">Offline</option>
                                            <option value="both">Both</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- AGE GROUP --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Age Group</label></div>
                                    <div class="col-md-9">
                                        <input type="text" name="age_group" class="form-control" placeholder="3-15 Years">
                                    </div>
                                </div>

                                {{-- FEES --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Fees</label></div>
                                    <div class="col-md-9">
                                        <input type="number" name="fees" class="form-control">
                                    </div>
                                </div>

                                {{-- INSTAGRAM --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Instagram Link</label></div>
                                    <div class="col-md-9">
                                        <input type="text" name="instagram_link" class="form-control">
                                    </div>
                                </div>

                                {{-- HIGHLIGHTS --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Highlights Link</label></div>
                                    <div class="col-md-9">
                                        <input type="text" name="highlights_link" class="form-control">
                                    </div>
                                </div>

                                <hr>

                                <h5>Course Sessions</h5>

                                <div id="sessions">
                                    <div class="session mb-3">
                                        <input type="text" name="session_title[]" class="form-control mb-2"
                                            placeholder="Session Title">
                                        <textarea name="session_description[]" class="form-control"
                                            placeholder="Session Description"></textarea>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary mt-2" onclick="addSession()">+ Add
                                    Session</button>

                                <hr>

                                {{-- PDF DOCUMENTS --}}
                                <div class="form-group row mt-4">
                                    <div class="col-md-3"><label>Documents (PDF)</label></div>
                                    <div class="col-md-9">
                                        <input type="file" name="documents[]" multiple class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="card-action text-center">
                                <button class="btn btn-success">Submit</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addSession() {
            let html = `
                                                                                            <div class="session mb-3">
                                                                                                <input type="text" name="session_title[]" class="form-control mb-2" placeholder="Session Title">
                                                                                                <textarea name="session_description[]" class="form-control" placeholder="Session Description"></textarea>
                                                                                            </div>`;
            document.getElementById('sessions').insertAdjacentHTML('beforeend', html);
        }
    </script>

    <script>
        tinymce.init({
            selector: '#descriptionEditor',
            height: 300,
            plugins: 'lists link image table code help wordcount',
            toolbar: `
                                undo redo | styles |
                                bold italic underline |
                                alignleft aligncenter alignright alignjustify |
                                bullist numlist |
                                link image |
                                table |
                                code help
                            `,
            menubar: false,
            branding: false
        });
    </script>
@endsection