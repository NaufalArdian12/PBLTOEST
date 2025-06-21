<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
  <table style="max-width: 600px; margin: auto; background-color: white; padding: 20px; border-radius: 8px;">
    <tr>
      <td>
        <h2 style="color: #2d3748;">Permintaan Reset Password</h2>
        <p>Hai,</p>
        <p>Kami menerima permintaan untuk mereset password akun kamu. Klik tombol di bawah untuk mengatur ulang password:</p>

        <p style="text-align: center; margin: 30px 0;">
          <a href="{{ $resetLink }}" style="background-color: #3b82f6; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px;">Reset Password</a>
        </p>

        <p>Jika kamu tidak meminta reset password, abaikan email ini.</p>
        <p style="margin-top: 40px;">Salam hangat,<br><strong>Tim Aplikasi Kamu</strong></p>
      </td>
    </tr>
  </table>
</body>
</html>
