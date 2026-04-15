@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Testimonial Rating Demo</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Testimonials</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Rating Form</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">RateYo Test Form</div>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="rating" class="form-label fw-bold">Rating</label>
                                    <div id="rateYo" class="mb-2"></div>
                                    <input type="hidden" name="rating" id="rating" value="">
                                    <small class="text-muted">Choose a star rating to test the field behavior.</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/3.2.0/jquery.rateyo.min.js"></script>
    <script>
        $(function() {
            $("#rateYo").rateYo({
                rating: $("#rating").val() || 0,
                halfStar: true,
                starWidth: "30px",
                ratedFill: "#f39c12",
                normalFill: "#dcdcdc",
                onSet: function(rating) {
                    $("#rating").val(rating);
                }
            });
        });
    </script>
@endsection
