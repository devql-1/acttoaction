@extends('frontend.course.layout')
@section('title', 'Privacy Policy – Act To Action')

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
    @media (max-width: 576px) {
        .legal-card { padding: 24px 18px; }
        .legal-card h2 { font-size: 1.1rem; }
        .legal-card p, .legal-card li { font-size: 0.9rem; }
        .legal-header { padding: 30px 24px; }
        .legal-header h1 { font-size: 1.5rem; }
    }
    </style>
<main class="main">
    <div class="legal-page">
        <div class="legal-wrap">
            <div class="legal-header">
                <h1>Privacy Policy</h1>
                <p>Last updated: {{ date('F Y') }}</p>
            </div>

            <div class="legal-card">
                <p>ThreatExpert is committed to protecting your privacy. This Privacy Policy outlines how we collect, use, and protect your personal information.</p>

                <h2>1. Information We Collect</h2>
                <ul>
                    <li>Personal information such as name, email, and contact details.</li>
                    <li>Payment information for subscription-based services.</li>
                    <li>Technical data including IP address, browser type, and usage statistics.</li>
                </ul>

                <h2>2. Use of Information</h2>
                <ul>
                    <li>We use your information to improve our services, process transactions, and provide customer support.</li>
                    <li>Your data may be used to send security updates, newsletters, or promotional offers (opt-out available).</li>
                </ul>

                <h2>3. Data Security</h2>
                <p>We implement robust security measures, including encryption and firewalls, to protect your personal information. However, no data transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>

                <h2>4. Third-Party Sharing</h2>
                <ul>
                    <li>We do not sell, trade, or rent your personal information to third parties.</li>
                    <li>Some third-party tools may collect anonymized usage data to improve user experience.</li>
                </ul>

                <h2>5. Your Rights</h2>
                <p>You have the right to access, modify, or delete your personal data upon request.</p>
                <p>Contact <strong>info@threatxpert.com</strong> to exercise these rights.</p>
            </div>
        </div>
    </div>
</main>
@endsection
