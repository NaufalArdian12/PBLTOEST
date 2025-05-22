<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css') <!-- Laravel Vite integration -->

    <style>
        .login-container {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/login-bg.png') }}');
        }
    </style>
</head>

<body class="min-h-screen flex">

    <!-- Left Section with Background Image -->
    <div class="hidden md:block w-1/2 login-container bg-cover bg-center relative">
        <!-- Back Button -->
        <a href="{{ route('home') }}">
            <button
                class="fixed top-8 left-8 bg-black bg-opacity-50 text-white rounded-full py-2 px-4 flex items-center text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to website
            </button>
        </a>

        <!-- Bottom Text -->
        <div class="fixed bottom-8 left-8 right-8 text-white">
            <p class="text-xl font-medium mb-2">With professional and experienced teachers</p>
            <p class="text-lg">The best teacher for children</p>
        </div>
    </div>

    <!-- Right Section with Login Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Register</h1>
            <p class="text-gray-600 mb-8">Already have an account? <a href="{{ route('login') }}"
                    class="text-blue-600 font-medium hover:underline">Login</a></p>

            <form class="space-y-6">
                <!-- Email Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                    <input type="email" placeholder="Email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Username Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Username</label>
                    <input type="text" placeholder="Username"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                    <input type="password" placeholder="Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <!-- Confirm Password Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Password Confirm</label>
                    <input type="password" placeholder="Password Confirm"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Register
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-8">
                <div class="flex-grow h-px bg-gray-200"></div>
                <span class="px-4 text-gray-500 text-sm">atau register dengan</span>
                <div class="flex-grow h-px bg-gray-200"></div>
            </div>

            <!-- Google Login Button -->
            <a href="{{ route('auth.redirect') }}"
                class="flex items-center justify-center w-full border border-gray-300 rounded-lg py-3 px-4 font-medium text-gray-700 hover:bg-gray-50 transition-colors mb-8">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="#4285F4"
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                    <path fill="#34A853"
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                    <path fill="#FBBC05"
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                    <path fill="#EA4335"
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                </svg>
                Google
            </a>
        </div>
    </div>

</body>

</html>
