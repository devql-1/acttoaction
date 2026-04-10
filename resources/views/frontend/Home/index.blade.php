<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action UI</title>
    <link rel="stylesheet" href="{{ asset('frontendassets/css/style.css') }}">
    <!-- Font Awesome Latest CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('courseassets/img/faviconsdf.png') }}">
</head>


<body>
    <style>
        .action-link {
            display: flex;
            align-items: center;
            gap: 8px;
            /* space between icon and text */
            text-decoration: none;
            color: inherit;
        }

        .icon i {
            font-size: 20px;
        }

        .title {
            margin: 0;
            font-size: 18px;
        }
    </style>
    <!-- HEADER -->
    <header class="topbar">
        <div class="logo">ActToAction</div>
        {{-- <button class="login-btn">Login</button> --}}
    </header>
    <div class="container">

        <div class="action add">
            <a href="{{ route('index.course') }}" class="action-link">
                <div class="icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h1 class="title">Courses</h1>
            </a>
        </div>

        <div class="action send">
            <a href="{{ route('frontend.tests') }}" class="action-link">
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <h1>Skill Assessment</h1>
            </a>
        </div>

        <div class="action exchange">
            <a href="{{ route('summercamp') }}" class="action-link">
                <div class="icon"><i class="fas fa-campground"></i></div>
                <h1>Summer Camp</h1>
            </a>
        </div>

    </div>
    <style>
        .bottom-nav a {
            text-decoration: none;
            /* removes underline */
            color: inherit;
            /* keeps original text color */
            display: inline-block;
            /* makes entire div clickable */
        }

        .bottom-nav a div {
            cursor: pointer;
            /* shows pointer on hover */
        }
    </style>
    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <a href="{{ route('frontend.blog.index') }}">
            <div>Blog</div>
        </a>
        <a href="{{ route('event') }}">
            <div>Events</div>
        </a>
        <a href="{{ route('aboutus') }}">
            <div>About us</div>
        </a>
    </div>

    <div class="support">💬 Support</div>
    {{-- @include('frontend.partialspages.testimonials-section', [
        'videos' => $videos,
        'tabs' => $tabs,
    ]) --}}
</body>

</html>
