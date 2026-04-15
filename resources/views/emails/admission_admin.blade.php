@component('mail::message')
# New Admission Application

A new admission application has been submitted.

---

### Applicant
- **Name:** {{ $admission->name ?? 'N/A' }}
- **Email:** {{ $admission->email ?? 'N/A' }}
- **Mobile:** {{ $admission->mobile ?? 'N/A' }}
- **Gender:** {{ $admission->gender ?? 'N/A' }}
- **Date of Birth:** {{ $admission->dob_year ?? 'N/A' }}
- **Place of Birth:** {{ $admission->place_birth ?? 'N/A' }}

### Family
- **Father:** {{ $admission->father_name ?? 'N/A' }} ({{ $admission->father_occupation ?? 'N/A' }})
- **Mother:** {{ $admission->mother_name ?? 'N/A' }} ({{ $admission->mother_occupation ?? 'N/A' }})

### Admission Details
- **School:** {{ $admission->school ?? 'N/A' }}
- **Class:** {{ $admission->classname ?? 'N/A' }}
- **Category:** {{ $admission->category ?? 'N/A' }}
- **Religion:** {{ $admission->religion ?? 'N/A' }}
- **Aadhar:** {{ $admission->aadhar_card ?? 'N/A' }}

### Address
{{ $admission->address ?? 'N/A' }}, {{ $admission->district ?? '' }}, {{ $admission->state ?? '' }} — {{ $admission->pin_code ?? '' }}

---

Thanks,
**{{ config('app.name') }} Team**
@endcomponent
