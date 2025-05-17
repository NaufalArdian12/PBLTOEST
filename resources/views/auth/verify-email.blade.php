<!-- resources/views/auth/verify-email.blade.php -->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <!-- Tambahkan CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen py-6">

    <div class="bg-white p-8 rounded-lg shadow-md w-full sm:w-96">
        <h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">Verifikasi Email</h1>

        @if (session('message'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <p class="text-gray-700 mb-4">
            Terima kasih telah mendaftar! Sebelum memulai, kami perlu memastikan bahwa alamat email Anda valid.
            Silakan periksa inbox email Anda dan klik link verifikasi yang telah kami kirimkan.
        </p>

        <form action="/email/resend" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Resend Email
            </button>
        </form>


    </div>

</body>

</html>
