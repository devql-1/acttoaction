@component('mail::message')
# 🎉 Thank You for Contacting {{ config('app.name') }}

Hi {{ $contact->username ?? 'Dear Applicant' }},

We’ve successfully received your query request regarding the **{{ $contact->service->title ?? 'N/A' }}** service.  
Our team will review your details and get in touch with you soon.

---

### 📝 **Submitted Details**
- **Service Name:** {{ $contact->service->title ?? 'N/A' }}
- **Your Name:** {{ $contact->username ?? 'N/A' }}
- **Your E-Mail:** {{ $contact->email ?? 'N/A' }}
- **Your Phone No.:** {{ $contact->phone ?? 'N/A' }}
- **Your Message:** {{ $contact->message ?? 'N/A' }}

---

If you have any urgent questions, feel free to reach us directly at  
📧 **{{ config('mail.from.address') }}**

Thanks again for choosing **{{ config('app.name') }}**.  

Warm regards,  
**{{ config('app.name') }} Team**
@endcomponent
