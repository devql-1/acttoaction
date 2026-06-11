@extends('frontend.course.layout')
@section('title', 'Cancellation Policy – ThreatExpert')

@section('content')


    <style>
.legal-page {
        min-height: 60vh;
        padding-top: 185px;
        padding-bottom: 80px;
        background: linear-gradient(135deg,
            color-mix(in srgb, var(--accent-color), transparent 96%) 0%,
            #f8faff 50%,
            color-mix(in srgb, var(--accent-color), transparent 94%) 100%);
    }
    .legal-wrap {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .legal-header {
        background: linear-gradient(135deg, #0a1432 0%, #1a2e5c 100%);
        color: #fff;
        border-radius: 16px;
        padding: 40px 36px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }
    .legal-header::before {
        content: "";
        position: absolute;
        top: -40px; right: -40px;
        width: 180px; height: 180px;
        background: var(--accent-color);
        border-radius: 50%;
        opacity: 0.12;
    }
    .legal-header h1 {
        font-weight: 800;
        font-size: 2rem;
        margin-bottom: 6px;
        position: relative;
        color: #fff;
    }
    .legal-header p {
        margin: 0;
        opacity: 0.85;
        font-size: 0.92rem;
        position: relative;
        color: #fff;
    }
    .legal-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 48px rgba(0, 0, 0, 0.08);
        padding: 44px 48px;
    }
    .legal-card h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--heading-color);
        margin-top: 28px;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 2px solid color-mix(in srgb, var(--accent-color), transparent 85%);
    }
    .legal-card h2:first-child { margin-top: 0; }
    .legal-card p, .legal-card li {
        color: #4b5563;
        font-size: 0.95rem;
        line-height: 1.75;
        margin-bottom: 12px;
    }
    .legal-card ul {
        padding-left: 22px;
        margin-bottom: 14px;
    }
    .legal-card strong { color: var(--heading-color); }
<main class="main">
    <div class="legal-page">
        <div class="legal-wrap">
            <div class="legal-header">
                <h1>Refund Policy</h1>
                <p>Last updated: {{ date('F Y') }}</p>
            </div>

            <div class="legal-card">
                <p>At ThreatExpert, customer satisfaction is our priority. Our cancellation policy is as follows:</p>

                <h2>1. Service Cancellation</h2>
                <ul>
                    <li>Customers may cancel their subscriptions or services by contacting our support team at least 7 days before the renewal date.</li>
                    <li>Cancellations requested after the renewal date will apply to the next billing cycle.</li>
                </ul>

                <h2>2. Effect of Cancellation</h2>
                <ul>
                    <li>Upon cancellation, access to ThreatExpert's services will be revoked at the end of the billing cycle.</li>
                    <li>Data associated with canceled accounts may be permanently deleted after a retention period.</li>
                </ul>

                <h2>3. No Partial Refunds</h2>
                <ul>
                    <li>ThreatExpert does not offer partial refunds for unused portions of a service period.</li>
                    <li>Users on prepaid plans will not receive refunds for the remaining period.</li>
                </ul>

                <h2>4. How to Cancel</h2>
                <ul>
                    <li>Send a cancellation request to <strong>info@threatxpert.com</strong> with your account details.</li>
                    <li>Our team will process your cancellation and confirm within 3 business days.</li>
                    <li>For further assistance, please contact our support team at <strong>info@threatxpert.com</strong>.</li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection
