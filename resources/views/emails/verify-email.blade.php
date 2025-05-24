<x-mail::message>

{{-- Logo --}}
<p style="text-align: center;">
  <img src="https://toest.com/storage/Logo.png" alt="{{ config('app.name') }}" style="max-width: 150px; margin-bottom: 20px;">
</p>

# Verify Your Email

Hello,  
Thank you for joining **{{ config('app.name') }}**.

To start using your account, please click the button below to verify your email address:

<x-mail::button :url="$url">
Verify Now
</x-mail::button>

---

If you receive a suspicious email asking for your account information, **do not click any links**, and report it immediately to the {{ config('app.name') }} team for further investigation.

<x-slot:subcopy>
Can’t click the button? Copy and paste this URL into your browser:

[{{ $url }}]({{ $url }})
</x-slot:subcopy>

Warm regards,  
The {{ config('app.name') }} Team

</x-mail::message>
