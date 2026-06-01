@extends('frontend.course.layout')

@section('content')
    <style>
        .confirmed-wrap {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f5ff;
            padding: 200px 20px 40px;
        }

        .confirmed-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(14, 28, 53, .10);
            padding: 48px 40px;
            max-width: 520px;
            width: 100%;
            text-align: center;
        }

        .confirmed-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 36px;
        }

        .confirmed-title {
            font-size: 26px;
            font-weight: 800;
            color: #0e1c35;
            margin-bottom: 8px;
        }

        .confirmed-sub {
            font-size: 15px;
            color: #6b7a99;
            margin-bottom: 28px;
        }

        .ref-box {
            background: #f0fdf4;
            border: 1.5px solid #86efac;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 28px;
        }

        .ref-label {
            font-size: 11px;
            font-weight: 700;
            color: #166534;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .ref-value {
            font-size: 22px;
            font-weight: 800;
            color: #16a34a;
            letter-spacing: 1px;
            margin-top: 4px;
        }

        .detail-grid {
            text-align: left;
            margin-bottom: 28px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #dde5f4;
            font-size: 14px;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-key {
            color: #6b7a99;
            font-weight: 500;
        }

        .detail-val {
            color: #0e1c35;
            font-weight: 600;
        }

        .btn-home {
            display: inline-block;
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            transition: opacity .2s;
        }

        .btn-home:hover {
            opacity: .88;
            color: #fff;
        }

        @media (max-width: 576px) {
            .confirmed-wrap {
                padding: 140px 14px 32px;
                min-height: 70vh;
            }

            .confirmed-card {
                padding: 32px 22px;
                border-radius: 16px;
            }

            .confirmed-icon {
                width: 64px;
                height: 64px;
                font-size: 28px;
                margin-bottom: 18px;
            }

            .confirmed-title {
                font-size: 22px;
            }

            .confirmed-sub {
                font-size: 14px;
            }

            .ref-value {
                font-size: 18px;
            }

            .detail-row {
                font-size: 13px;
                flex-wrap: wrap;
            }

            .btn-home {
                padding: 12px 24px;
                font-size: 14px;
            }
        }
    </style>
    <div class="confirmed-wrap">
        <div class="confirmed-card">
            <div class="confirmed-icon">✅</div>
            <div class="confirmed-title">Enrollment Confirmed!</div>
            <div class="confirmed-sub">Your payment was successful. Our team will be in touch within 24 hours to confirm your
                batch details.</div>

            <div class="ref-box">
                <div class="ref-label">Your Reference ID</div>
                <div class="ref-value">{{ $enrollment->reference_id }}</div>
            </div>

            <div class="detail-grid">
                <div class="detail-row">
                    <span class="detail-key">Name</span>
                    <span class="detail-val">{{ $enrollment->first_name }} {{ $enrollment->last_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-key">Course</span>
                    <span class="detail-val">{{ $enrollment->course }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-key">Centre</span>
                    <span class="detail-val">{{ $enrollment->centre }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-key">Amount Paid</span>
                    <span class="detail-val">₹{{ number_format($enrollment->fee) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-key">Email</span>
                    <span class="detail-val">{{ $enrollment->email }}</span>
                </div>
            </div>

            <p style="font-size:13px;color:#6b7a99;margin-bottom:24px;">
                A confirmation email has been sent to <strong>{{ $enrollment->email }}</strong>.
                Please keep your reference ID safe for future correspondence with Threat Expert.
            </p>

            <a href="{{ route('home') }}" class="btn-home">Back to Home</a>
        </div>
    </div>
@endsection
