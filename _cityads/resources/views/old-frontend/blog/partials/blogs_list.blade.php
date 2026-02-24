@if($blogs->count() > 0)
@foreach ($blogs as $blog )
    

    <div class="col-lg-6 col-md-6">
        <div class="insight-post-item">
            <a href="{{ route('blogdetails',$blog->slug) }}" class="image position-relative d-block overflow-hidden">
                <img src="{{ $blog->image ? asset('img/'.$blog->image) : asset('assets/img/placeholder-image-3.jpg') }}" alt="blog-image">
                <i class="ri-arrow-right-long-fill"></i>
            </a>
            <div class="content">
                <ul class="info m-0 list-unstyled">
                    <li class="d-inline-block position-relative">
                        <img src="{{asset('webtheme/assets/images/icons/calendar.svg')}}" alt="calendar">
                        {{ date('M d, Y', strtotime($blog->created_at)) }}
                    </li>
                    <li class="d-inline-block position-relative">
                        {{ $blog->category->category_name  }}
                    </li>
                </ul>
                <h3 class="text-uppercase mb-0">
                    <a href="{{ route('blogdetails',$blog->slug) }}">
                        {{ $blog->title }}
                    </a>
                </h3>
            </div>
        </div>
    </div>
    @endforeach
@else
<img class="h-50 rounded-5" src="{{asset('assets/img/no-data.webp')}}" alt="no-data-found">
@endif
