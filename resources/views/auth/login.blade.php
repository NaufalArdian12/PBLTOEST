<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    <style>
        .login-container {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/login-bg.png') }}');
        }
    </style>
</head>

<body class="min-h-screen flex">
    <!-- Enhanced Success Message -->

    <!-- Left Section with Background Image -->
    <div class="hidden md:block w-1/2 login-container bg-cover bg-center relative">
        <!-- Back Button -->
        <a href="{{ route('home') }}">
            <button
                class="absolute top-8 left-8 bg-black/50 text-white rounded-full py-2 px-4 flex items-center text-sm">
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
            <p class="text-xl font-medium mb-2">With professional and experienced teachers</p>
            <p class="text-lg">The best teacher for children</p>
        </div>
    </div>

    <!-- Right Section with Login Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Login</h1>
            @if (session('success'))
                <div
                    class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-green-800">Success!</h3>
                            <p class="text-green-700 mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Enhanced Error Message -->
            @if (session('error'))
                <div class="mb-8 bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-red-800">Error!</h3>
                            <p class="text-red-700 mt-1">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form login -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <!-- Email Field -->
                <div>
                    <label for="NIM" class="block text-gray-700 text-sm font-medium mb-1">NIM</label>
                    <input type="NIM" name="NIM" id="NIM" placeholder="NIM"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('NIM') }}" required>
                    @error('NIM')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <a href="{{ route('password.request') }}"
                        class="text-blue-600 text-sm mt-2 inline-block hover:underline">Forgot password?</a>
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Login
                </button>
            </form>

        </div>
    </div>
</body>

</html>
