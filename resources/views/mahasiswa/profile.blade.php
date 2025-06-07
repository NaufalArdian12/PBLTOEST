@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 px-6 py-4 bg-white shadow-sm rounded-xl">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="w-24">
            </div>
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/bell-alert.png') }}" alt="Notification" class="w-5 h-5">

                <!-- User Profile Dropdown -->
                <div class="relative group">
                    <div class="flex items-center gap-2 cursor-pointer py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-700 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <!-- Profile Option -->
                            <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 text-blue-600 bg-blue-50 transition-colors duration-150">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <div>
                                    <div class="font-medium text-sm">Profile</div>
                                    <div class="text-xs text-blue-400">Update your information</div>
                                </div>
                            </a>

                            <!-- Divider -->
                            <div class="border-t border-gray-100 my-1"></div>

                            <!-- Logout Option -->
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 transition-colors duration-150 text-left">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-sm">Logout</div>
                                        <div class="text-xs text-red-400">Sign out of your account</div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Profile Form -->
            <div class="lg:col-span-4">
                <div class="bg-white shadow-sm rounded-xl p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Profile Information</h2>
                        <p class="text-gray-500">Update your personal information and account settings.</p>
                    </div>

                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Student ID -->
                            <div>
                                <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">Student ID</label>
                                <input type="text" id="student_id" name="student_id" value="{{ auth()->user()->nim }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" readonly>
                                <p class="text-xs text-gray-500 mt-1">Student ID cannot be changed</p>
                            </div>

                            <!-- Address -->
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <textarea id="address" name="address" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">{{ old('address', 'Jl. Contoh No. 123, Jakarta Selatan, DKI Jakarta') }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Profile Picture -->
                            <div class="md:col-span-2">
                                <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">Passport Photo</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" id="profile_picture" name="pas_photo" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Maximum file size: 2MB. Supported formats: JPG, PNG, GIF</p>
                                @error('profile_picture')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Profile Picture -->
                            <div class="md:col-span-2">
                                <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">Scan KTP</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" id="profile_picture" name="scan_ktp" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Maximum file size: 2MB. Supported formats: JPG, PNG, GIF</p>
                                @error('profile_picture')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Profile Picture -->
                            <div class="md:col-span-2">
                                <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">Scan KTM</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" id="profile_picture" name="scan_ktm" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Maximum file size: 2MB. Supported formats: JPG, PNG, GIF</p>
                                @error('profile_picture')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="border-t border-gray-200 mt-8 pt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    @error('current_password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div></div>
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                    <input type="password" id="password" name="password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('dashboard') }}"
                                class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
                                Cancel
                            </a>
                            <div class="space-x-3">
                                <button type="reset"
                                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors duration-200">
                                    Reset
                                </button>
                                <button type="submit"
                                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors duration-200">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div id="successMessage" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="errorMessage" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <script>
        // Auto hide success/error messages
        setTimeout(function() {
            const successMsg = document.getElementById('successMessage');
            const errorMsg = document.getElementById('errorMessage');

            if (successMsg) {
                successMsg.style.opacity = '0';
                setTimeout(() => successMsg.remove(), 300);
            }
            if (errorMsg) {
                errorMsg.style.opacity = '0';
                setTimeout(() => errorMsg.remove(), 300);
            }
        }, 4000);

        // Profile picture preview
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // You can add preview functionality here
                    console.log('File selected:', file.name);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
