@extends('frontend.course.layout')
@section('title', 'Refund Policy – Act To Action')

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
    .refund-table {
        width: 100%;
        border-collapse: collapse;
        margin: 12px 0 18px;
        font-size: 0.92rem;
    }
    .refund-table th, .refund-table td {
        border: 1px solid color-mix(in srgb, var(--default-color), transparent 85%);
        padding: 10px 14px;
        text-align: left;
    }
    .refund-table th {
        background: color-mix(in srgb, var(--accent-color), transparent 92%);
        color: var(--heading-color);
        font-weight: 700;
    }
    @media (max-width: 576px) {
        .legal-card { padding: 28px 22px; }
        .legal-header { padding: 30px 24px; }
        .legal-header h1 { font-size: 1.5rem; }
    }
</style>

<main class="main">
    <div class="legal-page">
        <div class="legal-wrap">
            <div class="legal-header">
                <h1>Refund Policy</h1>
                <p>Last updated: {{ date('F Y') }}</p>
            </div>

            <div class="legal-card">
                <h2>1. Overview</h2>
                <p>At <strong>Act To Action</strong>, we understand that plans can change. This Refund Policy explains when and how refunds are processed for our courses, workshops, and summer camps. Please read this policy carefully before making a payment.</p>

                <h2>2. Eligibility for Refund</h2>
                <p>Refund requests are eligible only if they meet the following conditions:</p>
                <ul>
                    <li>The request is made in writing via email to <strong>info@acttoaction.com</strong>.</li>
                    <li>The request is submitted within the applicable refund window (see the table below).</li>
                    <li>The participant has not already attended a significant portion of the course or workshop.</li>
                </ul>

                <h2>3. Refund Timelines</h2>
                <table class="refund-table">
                    <thead>
                        <tr>
                            <th>Request Timing</th>
                            <th>Refund Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>7 or more days before the start date</td>
                            <td>90% refund (10% processing fee)</td>
                        </tr>
                        <tr>
                            <td>3 – 6 days before the start date</td>
                            <td>50% refund</td>
                        </tr>
                        <tr>
                            <td>Less than 3 days before the start date</td>
                            <td>No refund</td>
                        </tr>
                        <tr>
                            <td>After the program has started</td>
                            <td>No refund</td>
                        </tr>
                    </tbody>
                </table>

                <h2>4. Cancellation by Act To Action</h2>
                <p>If a workshop, course, or event is cancelled by Act To Action due to unforeseen circumstances (such as low enrollment, instructor unavailability, or force majeure), participants will be offered either:</p>
                <ul>
                    <li>A full refund of the fees paid, or</li>
                    <li>The option to transfer to another program of equal value.</li>
                </ul>

                <h2>5. Non-Refundable Items</h2>
                <ul>
                    <li>Registration fees and processing charges are non-refundable.</li>
                    <li>Merchandise, kits, and materials already dispatched or handed over are non-refundable.</li>
                    <li>Discounted or promotional enrollments are non-refundable unless stated otherwise.</li>
                </ul>

                <h2>6. Refund Process</h2>
                <ul>
                    <li>Approved refunds will be processed within <strong>7–14 business days</strong> of approval.</li>
                    <li>Refunds will be credited back to the original payment method used at the time of purchase.</li>
                    <li>Any bank or gateway charges incurred during the refund will be borne by the customer.</li>
                </ul>

                <h2>7. Transfers &amp; Rescheduling</h2>
                <p>In lieu of a refund, you may request to transfer your enrollment to another batch or a different participant (subject to availability and approval). Transfer requests must be made at least 3 days before the program start date.</p>

                <h2>8. Disputes</h2>
                <p>Any disputes arising from this Refund Policy shall be subject to the exclusive jurisdiction of the courts in Jaipur, Rajasthan.</p>

                <h2>9. Contact Us</h2>
                <p>For refund requests or any questions about this policy, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> info@acttoaction.com</li>
                    <li><strong>Phone:</strong> +91-91191-92811, +91-91191-82511</li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection
