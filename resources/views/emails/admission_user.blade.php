@component('mail::message')
# Thank you for applying to {{ config('app.name') }}

Hi {{ $admission->name ?? 'Applicant' }},

We've received your admission application for **{{ $admission->classname ?? 'N/A' }}** at **{{ $admission->school ?? config('app.name') }}**. Our admissions team will review your details and get in touch with you soon.

---

### Your submitted details
- **Name:** {{ $admission->name ?? 'N/A' }}
- **Email:** {{ $admission->email ?? 'N/A' }}
- **Mobile:** {{ $admission->mobile ?? 'N/A' }}
- **Class:** {{ $admission->classname ?? 'N/A' }}
- **School:** {{ $admission->school ?? 'N/A' }}

---

If you have any urgent questions, reach us at
**{{ config('mail.from.address') }}**

Warm regards,
**{{ config('app.name') }} Team**
@endcomponent
