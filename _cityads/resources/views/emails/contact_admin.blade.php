@component('mail::message')
# 📥 New CA Service Enquiry Received

---

### 🧾 **Service Details**
**Service Name:** {{ $contact->service->title ?? 'N/A' }}

---

### 👤 **Customer Information**
- **Name:** {{ $contact->username ?? 'N/A' }}
- **Email:** {{ $contact->email ?? 'N/A' }}
- **Phone:** {{ $contact->phone ?? 'N/A' }}

---

### 💬 **Customer Query**
{{ $contact->message ?? 'N/A' }}

---

Thanks & Regards,  
**{{ config('app.name') }} Team**
@endcomponent



