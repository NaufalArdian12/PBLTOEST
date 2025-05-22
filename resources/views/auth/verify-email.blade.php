<<<<<<< HEAD
@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            {{ __('Verify Your Email Address') }}
        </h2>

        @if (session('resent'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
=======
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
>>>>>>> e1253e9b29705f0ebb0ce30325b8a5a93925a030
            </div>
        @endif

        <p class="text-gray-700 mb-4">
<<<<<<< HEAD
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </p>
        <p class="text-gray-700 mb-4">
            {{ __('If you did not receive the email') }},
        </p>

        <form method="POST" action="{{ route('auth.resend') }}">
            @csrf
            <button type="submit"
                class="text-blue-600 hover:underline font-medium">
                {{ __('Re-send email') }}
            </button>
        </form>
    </div>
</div>
@endsection
=======
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
>>>>>>> e1253e9b29705f0ebb0ce30325b8a5a93925a030
