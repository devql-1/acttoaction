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
                <h2>1. Introduction</h2>
                <p>At <strong>Act To Action</strong>, we are committed to protecting the privacy of our students, parents, volunteers, and website visitors. This Privacy Policy explains how we collect, use, and safeguard your personal information when you use our website and services.</p>

                <h2>2. Information We Collect</h2>
                <p>We may collect the following types of information:</p>
                <ul>
                    <li><strong>Personal details:</strong> name, email address, phone number, WhatsApp number, and address provided during enrollment or registration.</li>
                    <li><strong>Student information:</strong> child's name, age, school, and age group for workshops and courses.</li>
                    <li><strong>Payment information:</strong> processed securely through third-party payment gateways; we do not store card details on our servers.</li>
                    <li><strong>Technical data:</strong> IP address, browser type, device type, and cookies used to improve your experience.</li>
                </ul>

                <h2>3. How We Use Your Information</h2>
                <ul>
                    <li>To process enrollments, workshop registrations, and payments.</li>
                    <li>To communicate important updates, schedules, and reminders about our programs.</li>
                    <li>To send newsletters, marketing messages, and promotional offers (only with your consent).</li>
                    <li>To improve our website, courses, and overall user experience.</li>
                    <li>To comply with legal obligations.</li>
                </ul>

                <h2>4. Sharing of Information</h2>
                <p>We do not sell or rent your personal information. We may share limited data with trusted third parties such as payment gateways, SMS/email providers, and hosting services strictly for the purpose of delivering our services.</p>

                <h2>5. Data Security</h2>
                <p>We use reasonable technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.</p>

                <h2>6. Cookies</h2>
                <p>Our website uses cookies to remember preferences, analyze traffic, and improve functionality. You can disable cookies through your browser settings, but some features of the site may not work as intended.</p>

                <h2>7. Children's Privacy</h2>
                <p>Our programs are intended for children, and we collect children's information only through their parents or guardians during the enrollment process. Parents may request access, correction, or deletion of their child's information at any time.</p>

                <h2>8. Your Rights</h2>
                <p>You have the right to access, update, or request deletion of your personal data. To exercise these rights, please contact us at <strong>info@acttoaction.com</strong>.</p>

                <h2>9. Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated revision date.</p>

                <h2>10. Contact Us</h2>
                <p>If you have any questions about this Privacy Policy, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> info@acttoaction.com</li>
                    <li><strong>Phone:</strong> +91-91191-92811, +91-91191-82511</li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection
