<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action UI</title>
    <link rel="stylesheet" href="{{ asset('frontendassets/css/style.css') }}">
    <!-- Font Awesome Latest CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        <button class="login-btn">Login</button>
    </header>
    <div class="container">

        <div class="action add">
            <a href="{{ route('index.course') }}" class="action-link">
                <div class="icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h1 class="title">Offering</h1>
            </a>
        </div>

        <div class="action send">
            <div class="icon"><i class="fas fa-calendar-check"></i></div>
            <h1>Event</h1>
        </div>

        <div class="action exchange">
            <div class="icon"><i class="fas fa-campground"></i></div>
            <h1>Summer Camp</h1>
        </div>

    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div>🏠 Personal</div>
        <div>Business ↗</div>
        <div>Company ▾</div>
        <div>Take Quiz</div>
    </div>

    <div class="support">💬 Support</div>

</body>

</html>