@extends('frontend.course.layout')
@section('title', 'Terms & Conditions – ThreatExpert')

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
                <h1>Terms &amp; Conditions</h1>
                <p>Last updated: {{ date('F Y') }}</p>
            </div>

            <div class="legal-card">
                <h2>1. Acceptance of Terms</h2>
                <p>By accessing or using the <strong>Act To Action</strong> website, enrolling in any Threat Academy program, or registering for a workshop, you agree to be bound by these Terms &amp; Conditions. If you do not agree to these terms, please do not use our services.</p>

                <h2>2. Services</h2>
                <p>Act To Action provides Threat Academy courses, Cyber AI Threat Conclave programs, workshops, skill assessments, and related educational programs for children and young learners. We reserve the right to modify, add, or discontinue any program at any time.</p>

                <h2>3. Enrollment &amp; Registration</h2>
                <ul>
                    <li>All enrollments and registrations are subject to availability and confirmation.</li>
                    <li>Parents or guardians must provide accurate information when registering a child.</li>
                    <li>We reserve the right to refuse enrollment at our sole discretion.</li>
                </ul>

                <h2>4. Payment</h2>
                <ul>
                    <li>Course and workshop fees must be paid in full at the time of registration unless otherwise specified.</li>
                    <li>All payments are processed through secure third-party payment gateways.</li>
                    <li>Prices are inclusive of applicable taxes unless stated otherwise.</li>
                </ul>

                <h2>5. Attendance &amp; Conduct</h2>
                <p>Students are expected to attend sessions regularly and follow the code of conduct shared by our instructors. Disruptive behavior may result in suspension or termination of enrollment without a refund.</p>

                <h2>6. Intellectual Property</h2>
                <p>All content on this website — including text, graphics, logos, images, videos, and course materials — is the property of Act To Action and protected by copyright laws. You may not reproduce, distribute, or use any content without prior written permission.</p>

                <h2>7. Photography &amp; Media</h2>
                <p>Act To Action may capture photographs or videos during workshops and events for promotional purposes. By registering, you consent to the use of such media unless you notify us in writing to opt out.</p>

                <h2>8. Limitation of Liability</h2>
                <p>Act To Action shall not be held liable for any indirect, incidental, or consequential damages resulting from participation in our programs or use of our website. Parents/guardians are responsible for ensuring the safety and well-being of their children during travel to and from our venues.</p>

                <h2>9. Cancellation by Act To Action</h2>
                <p>We reserve the right to cancel or reschedule any workshop, course, or event due to unforeseen circumstances. In such cases, participants will be offered a rescheduled session or a full refund.</p>

                <h2>10. Governing Law</h2>
                <p>These Terms &amp; Conditions are governed by the laws of India. Any disputes arising out of or related to these terms shall be subject to the exclusive jurisdiction of the courts in Jaipur, Rajasthan.</p>

                <h2>11. Changes to Terms</h2>
                <p>We may update these Terms &amp; Conditions from time to time. Continued use of our services after any changes constitutes your acceptance of the revised terms.</p>

                <h2>12. Contact Us</h2>
                <p>For any questions regarding these Terms &amp; Conditions, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> training@threatxpert.com</li>
                    <li><strong>Phone:</strong> +91-91191-92811, +91-91191-82511</li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection
