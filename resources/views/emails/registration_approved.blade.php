<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TOEIC Registration Approved</title>
</head>
<body style="background-color: #f3f4f6; padding: 40px 16px; font-family: sans-serif;">

    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 32px; border: 1px solid #e5e7eb;">
        <h1 style="font-size: 24px; font-weight: bold; color: #16a34a; margin-bottom: 16px;">
            🎉 Pendaftaran TOEIC Disetujui / TOEIC Registration Approved
        </h1>

        <p style="color: #1f2937; margin-bottom: 16px;">
            Halo / Hello <span style="font-weight: 600; color: #2563eb;">{{ $registration->student->user->name }}</span>,
        </p>

        <p style="color: #374151; margin-bottom: 16px;">
            📅 <strong>Tanggal Pendaftaran / Registration Date:</strong> {{ \Carbon\Carbon::parse($registration->registration_date)->format('d M Y') }}
        </p>

        <p style="color: #374151; margin-bottom: 16px;">
            🇮🇩 Selamat! Pendaftaran TOEIC kamu telah <strong style="color: #16a34a;">disetujui</strong> oleh admin.<br>
            🇺🇸 Congratulations! Your TOEIC registration has been <strong style="color: #16a34a;">approved</strong> by the admin.
        </p>

        <p style="color: #374151; margin-bottom: 16px;">
            🇮🇩 Silakan login ke sistem untuk melihat detail lebih lanjut atau mencetak kartu ujianmu.<br>
            🇺🇸 Please log in to the system to view further details or print your exam card.
        </p>

        <div style="text-align: center; margin: 24px 0;">
            <a href="{{ url('/login') }}" style="display: inline-block; background-color: #2563eb; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500;">
                🔗 Buka Website / Open Website
            </a>
        </div>

        <p style="font-size: 14px; color: #6b7280; margin-top: 32px;">
            🇮🇩 Email ini dikirim otomatis oleh sistem TOEIC. Jika kamu merasa tidak melakukan pendaftaran, abaikan saja email ini.<br>
            🇺🇸 This email was sent automatically by the TOEIC system. If you did not register, please ignore this email.
        </p>
    </div>

</body>
</html>
