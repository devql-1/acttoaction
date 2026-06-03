@extends('frontend.course.layout')

@section('content')
    <style>
        :root {
            --reg-ink: #0d1b2a;
            --reg-blue: #1750d4;
            --reg-green: #059669;
            --reg-border: #dde5f5;
            --reg-light: #f0f5ff;
            --reg-muted: #64748b;
            --reg-font-head: 'Sora', sans-serif;
            --reg-font-body: 'DM Sans', sans-serif;
        }

        .success-page {
            min-height: 100vh;
            background: #f7f9ff;
            font-family: var(--reg-font-body);
            display: flex;
            align-items: center;
            padding: 200px 0 60px;
        }

        .success-card {
            background: #fff;
            border-radius: 24px;
            border: 1.5px solid var(--reg-border);
            overflow: hidden;
            box-shadow: 0 8px 50px rgba(17, 80, 212, .1);
            max-width: 560px;
            margin: 0 auto;
            width: 100%;
        }

        .success-banner {
            background: linear-gradient(135deg, #059669, #10b981);
            padding: 44px 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .success-banner::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, .07);
            border-radius: 50%;
            top: -60px;
            right: -60px;
        }

        .success-banner::after {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            background: rgba(255, 255, 255, .05);
            border-radius: 50%;
            bottom: -40px;
            left: -30px;
        }

        .success-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            border: 3px solid rgba(255, 255, 255, .4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #fff;
            margin: 0 auto 18px;
            position: relative;
            z-index: 1;
        }

        .success-banner h2 {
            font-family: var(--reg-font-head);
            font-size: 26px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 6px;
            position: relative;
            z-index: 1;
        }

        .success-banner p {
            font-size: 14px;
            color: rgba(255, 255, 255, .8);
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .reg-number-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 20px;
            padding: 6px 16px;
            color: #fff;
            font-family: var(--reg-font-head);
            font-size: 13px;
            font-weight: 700;
            margin-top: 12px;
            position: relative;
            z-index: 1;
        }

        .success-body {
            padding: 30px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 11px 0;
            border-bottom: 1px dashed #e2e8f0;
            gap: 10px;
            font-size: 14px;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row .dk {
            color: var(--reg-muted);
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
        }

        .detail-row .dk i {
            color: var(--reg-blue);
            font-size: 13px;
        }

        .detail-row .dv {
            font-family: var(--reg-font-head);
            font-weight: 700;
            color: var(--reg-ink);
            text-align: right;
        }

        .total-row {
            background: var(--reg-light);
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
        }

        .total-row .tk {
            font-family: var(--reg-font-head);
            font-size: 13px;
            font-weight: 700;
            color: var(--reg-muted);
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .total-row .tv {
            font-family: var(--reg-font-head);
            font-size: 22px;
            font-weight: 900;
            color: var(--reg-blue);
        }

        .total-row .tv.free {
            color: var(--reg-green);
        }

        .success-actions {
            padding: 0 30px 30px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-wa {
            width: 100%;
            padding: 13px;
            background: #25d366;
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: var(--reg-font-head);
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            text-decoration: none;
            transition: background .2s, transform .15s;
        }

        .btn-wa:hover {
            background: #1fba58;
            transform: translateY(-2px);
            color: #fff;
        }

        .btn-outline {
            width: 100%;
            padding: 12px;
            background: #fff;
            color: var(--reg-ink);
            border: 1.5px solid var(--reg-border);
            border-radius: 14px;
            font-family: var(--reg-font-head);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: border-color .2s;
        }

        .btn-outline:hover {
            border-color: var(--reg-blue);
            color: var(--reg-blue);
        }

        .note-box {
            margin: 0 30px 28px;
            background: #fefce8;
            border: 1px solid #fde68a;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            color: #92400e;
            display: flex;
            align-items: flex-start;
            gap: 9px;
        }

        .note-box i {
            color: #f59e0b;
            flex-shrink: 0;
            margin-top: 2px;
        }
    </style>
    {{-- resources/views/frontend/events/register-success.blade.php --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800;900&family=DM+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">

    <div class="success-page">
        <div class="container">
            <div class="success-card">

                <div class="success-banner">
                    <div class="success-icon"><i class="bi bi-check2-circle"></i></div>
                    <h2>You're Registered!</h2>
                    <p>Your spot has been reserved successfully</p>
                    <div class="reg-number-pill">
                        <i class="bi bi-tag-fill"></i>
                        {{ $registration->registration_number }}
                    </div>
                </div>

                <div class="success-body">
                    <div
                        style="font-family:var(--reg-font-head);font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--reg-muted);margin-bottom:12px;">
                        Booking Details
                    </div>

                    <div class="detail-row">
                        <span class="dk"><i class="bi bi-calendar-event"></i>Event</span>
                        <span class="dv">{{ $registration->event->title }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="dk"><i class="bi bi-collection"></i>Session</span>
                        <span class="dv">{{ $registration->subEvent->title }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="dk"><i class="bi bi-calendar3"></i>Date</span>
                        <span
                            class="dv">{{ \Carbon\Carbon::parse($registration->subEvent->event_date)->format('M j, Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="dk"><i class="bi bi-person"></i>Name</span>
                        <span class="dv">{{ $registration->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="dk"><i class="bi bi-phone"></i>Phone</span>
                        <span class="dv">{{ $registration->phone }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="dk"><i class="bi bi-geo-alt"></i>Location</span>
                        <span class="dv">{{ $registration->city }}, {{ $registration->state }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="dk"><i class="bi bi-ticket-perforated"></i>Tickets</span>
                        <span class="dv">{{ $registration->tickets }}</span>
                    </div>

                    <div class="total-row">
                        <span class="tk">Total Amount</span>
                        <span class="tv {{ $registration->total_amount == 0 ? 'free' : '' }}">
                            {{ $registration->total_amount == 0 ? 'FREE' : '₹' . number_format($registration->total_amount, 0) }}
                        </span>
                    </div>

                </div>

                <div class="note-box">
                    <i class="bi bi-info-circle-fill"></i>
                    <div>Our team will reach out on <strong>+{{ $registration->phone }}</strong> via WhatsApp to confirm
                        your registration. Please save our number — <strong>+91 80790 34973</strong>.</div>
                </div>

                <div class="success-actions">
                    <a href="https://wa.me/918079034973" target="_blank" class="btn-wa">
                        <i class="bi bi-whatsapp"></i> Chat with Us on WhatsApp
                    </a>
                    <a href="{{ url('/') }}" class="btn-outline">
                        <i class="bi bi-house"></i> Back to Home
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
