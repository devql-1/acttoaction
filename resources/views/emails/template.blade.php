{{-- resources/views/emails/template.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $emailSubject }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f6fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #222;
        }

        .wrap {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .08);
        }

        .header {
            background: linear-gradient(135deg, #0e1c35, #175cdd);
            padding: 32px 40px;
            text-align: center;
        }

        .header h1 {
            color: #fff;
            font-size: 22px;
            margin: 0;
            font-weight: 700;
        }

        .body {
            padding: 36px 40px;
            font-size: 15px;
            line-height: 1.8;
            color: #333;
        }

        .body a {
            color: #175cdd;
        }

        .footer {
            background: #f4f6fb;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
        }

        .footer a {
            color: #175cdd;
            text-decoration: none;
        }

        @media(max-width: 620px) {
            .wrap {
                margin: 0;
                border-radius: 0;
            }

            .header,
            .body,
            .footer {
                padding: 24px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="header">
            <h1>🎭 Act To Action</h1>
        </div>
        <div class="body">
            {!! $htmlBody !!}
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Act To Action · India's First Screen Acting School<br>
            <a href="https://www.acttoaction.com">www.acttoaction.com</a> ·
            <a href="https://wa.me/919352023276">WhatsApp Support</a>
        </div>
    </div>
</body>

</html>
