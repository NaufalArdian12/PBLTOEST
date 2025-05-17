<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
    <style>
        .register-container {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/login-bg.png') }}');
        }
    </style>
</head>

<body class="min-h-screen flex">
    <!-- Left Section with Background Image -->
    <div class="hidden md:block w-1/2 register-container bg-cover bg-center relative">
        <!-- Back Button -->
        <a href="{{ route('home') }}">
            <button
                class="absolute top-8 left-8 bg-black bg-opacity-50 text-white rounded-full py-2 px-4 flex items-center text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to website
            </button>
        </a>

        <!-- Bottom Text -->
        <div class="absolute bottom-8 left-8 right-8 text-white">
            <p class="text-xl font-medium mb-2">Dengan guru yang profesional dan berpengalaman</p>
            <p class="text-lg">Guru terbaik untuk anak</p>
        </div>
    </div>

    <div class="w-full md:w-1/2 flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun yuk</h1>
            <p class="text-gray-600 mb-8">Udah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Langsung login ya</a></p>

                {{-- Pesan Error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <!-- Username Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Username</label>
                    <input name="name" type="text" placeholder="username"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                    <input name="email" type="email" placeholder="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                    <input name="password" type="password" placeholder="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Confirm Password</label>
                    <input name="password_confirmation" type="password" placeholder="Confirm Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <a href="#" class="text-blue-600 text-sm mt-2 inline-block hover:underline">Lupa password?</a>
                </div>

                <!-- Register Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Register
                </button>
            </form>
        </div>
    </div>
</body>

</html>