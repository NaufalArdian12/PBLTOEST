@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="sticky top-0 z-50 bg-white/80 backdrop-blur-md shadow-lg rounded-2xl mb-8 border border-white/20">
            <div class="flex justify-between items-center px-8 py-6 z-40">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="w-28 h-auto drop-shadow-md">
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative items-center gap-6 z-40">
                        <!-- Enhanced User Profile Dropdown -->
                        <div class="relative group">
                            <div
                                class="flex items-center gap-3 cursor-pointer py-3 px-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-all duration-300 border border-blue-100">
                                <div
                                    class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center text-blue-600 font-semibold text-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                <div class="text-left">
                                    <span class="text-gray-800 font-medium block">Hi, {{ auth()->user()->name }}</span>
                                    <span class="text-gray-500 text-xs">Welcome back!</span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-all duration-200 group-hover:rotate-180"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <!-- Enhanced Dropdown Menu - FIXED Z-INDEX -->
                            <div
                                class="absolute right-0 top-full mt-3 w-64 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 transform translate-y-2 group-hover:translate-y-0">
                                <div class="p-2">
                                    <!-- Profile Option -->
                                    <a href="/profile"
                                        class="flex items-center gap-4 px-4 py-3 text-gray-700 hover:bg-blue-50 transition-all duration-200 rounded-xl group/item">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center group-hover/item:scale-110 transition-transform">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-sm text-gray-800">Profile Settings</div>
                                            <div class="text-xs text-gray-500">Update your information</div>
                                        </div>
                                    </a>

                                    <div class="border-t border-gray-100 my-2"></div>

                                    <!-- Logout Option -->
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-4 px-4 py-3 text-red-600 hover:bg-red-50 transition-all duration-200 rounded-xl text-left group/item">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center group-hover/item:scale-110 transition-transform">
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-sm">Sign Out</div>
                                                <div class="text-xs text-red-400">Logout from your account</div>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- message -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 text-green-700">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Profile Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Form -->
            <div class="lg:col-span-4">
                <div class="bg-white shadow-sm rounded-xl p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Profile Information</h2>
                        <p class="text-gray-500">Update your personal information and account settings.</p>
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIM -->
                            <div>
                                <label for="NIM" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                                <input type="text" id="NIM" name="NIM" value="{{ auth()->user()->students->NIM }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('NIM')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIK -->
                            <div>
                                <label for="NIK" class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                <input type="text" id="NIK" name="NIK" value="{{ auth()->user()->students->NIK }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('NIK')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- telephone Number -->
                            <div>
                                <label for="telephone_number" class="block text-sm font-medium text-gray-700 mb-2">Phone
                                    Number</label>
                                <input type="text" id="telephone_number" name="telephone_number"
                                    value="{{ auth()->user()->students->telephone_number }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- origin address -->
                            <div>
                                <label for="origin_address" class="block text-sm font-medium text-gray-700 mb-2">Origin
                                    Address</label>
                                <input type="text" id="origin_address" name="origin_address"
                                    value="{{ auth()->user()->students->origin_address }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('origin_address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- curent address -->
                            <div>
                                <label for="current_address" class="block text-sm font-medium text-gray-700 mb-2">Current
                                    Address</label>
                                <input type="text" id="current_address" name="current_address"
                                    value="{{ auth()->user()->students->current_address }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('current_address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Campus (selalu tampil) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Campus</label>
                                <input type="text" id="campus_display"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                                    readonly>
                            </div>

                            <!-- Major (readonly, tampil jika ada major) -->
                            <div id="major-wrapper" style="display: none;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Major</label>
                                <input type="text" id="major_display"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                                    readonly>
                            </div>
                            <div>
                                <label for="study_program_id" class="block text-sm font-medium text-gray-700 mb-2">Program
                                    Study</label>
                                <select id="study_program_id" name="study_program_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option disabled selected>Select Study Program</option>
                                    @foreach ($studyPrograms as $program)
                                        <option value="{{ $program->id }}" data-major="{{ $program->major->major_name ?? '' }}"
                                            data-campus="{{ $program->campus->campus_name ?? '' }}" {{ auth()->user()->students->study_program_id == $program->id ? 'selected' : '' }}>
                                            {{ $program->study_program_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('study_program_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                    Address</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" readonly
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Profile Picture -->
                            <div class="md:col-span-2">
                                <label for="pas_photo" class="block text-sm font-medium text-gray-700 mb-2">Pas
                                    Photo</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" id="pas_photo" name="pas_photo" accept="image/*" 
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Maximum file size: 2MB. Supported formats: JPG, PNG,
                                    GIF</p>
                                @if(auth()->user()->students && auth()->user()->students->pas_photo)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Get this file: <span class="font-medium">Uploaded</span>
                                    </p>
                                    <a href="{{ route('student.showPasPhoto', auth()->user()->students->id) }}" target="_blank"
                                        class="text-blue-500 underline text-sm">
                                        See File
                                    </a>
                                @endif
                                @error('pas_photo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Scan KTP -->
                            <div>
                                <label for="scan_ktp" class="block text-sm font-medium text-gray-700 mb-2">Scan KTP</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" id="scan_ktp" name="scan_ktp" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Maximum file size: 2MB. Supported formats: JPG, PNG,
                                    GIF</p>
                                @if(auth()->user()->students && auth()->user()->students->scan_ktp)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Get this file: <span class="font-medium">Uploaded</span>
                                    </p>
                                    <a href="{{ route('student.showKtp', auth()->user()->students->id) }}" target="_blank"
                                        class="text-blue-500 underline text-sm">
                                        See FIle
                                    </a>
                                @endif
                                @error('scan_ktp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Scan KTM -->
                            <div class="">
                                <label for="scan_ktm" class="block text-sm font-medium text-gray-700 mb-2">Scan KTM</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" id="scan_ktm" name="scan_ktm" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Maximum file size: 2MB. Supported formats: JPG, PNG,
                                    GIF</p>
                                @if(auth()->user()->students && auth()->user()->students->scan_ktm)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Get this file: <span class="font-medium">Uploaded</span>
                                    </p>
                                    <a href="{{ route('student.showKtm', auth()->user()->students->id) }}" target="_blank"
                                        class="text-blue-500 underline text-sm">
                                        See FIle
                                    </a>
                                @endif

                                @error('scan_ktm')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="border-t border-gray-200 mt-8 pt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="current_password"
                                        class="block text-sm font-medium text-gray-700 mb-2">Current
                                        Password</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    @error('current_password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div></div>
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New
                                        Password</label>
                                    <input type="password" id="password" name="password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Confirm
                                        New Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    @error('password_confirmation')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 mt-8 pt-8 flex justify-end">
                            <!-- back Button -->
                            <div class="mt-8 flex justify-end">
                                <a href="{{ route('dashboard') }}"
                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 mr-2">
                                    Back to Dashboard
                                </a>
                            </div>
                            <!-- Submit Button -->
                            <div class="mt-8 flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-200">Save
                                    Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateMajorAndCampusDisplay() {
            const select = document.getElementById('study_program_id');
            const selectedOption = select.options[select.selectedIndex];

            const major = selectedOption.getAttribute('data-major');
            const campus = selectedOption.getAttribute('data-campus');

            const majorWrapper = document.getElementById('major-wrapper');
            const majorInput = document.getElementById('major_display');
            const campusInput = document.getElementById('campus_display');

            // Tampilkan Major jika ada
            if (major && major.trim() !== '') {
                majorWrapper.style.display = 'block';
                majorInput.value = major;
            } else {
                majorWrapper.style.display = 'none';
                majorInput.value = '';
            }

            // Selalu update Campus
            campusInput.value = campus || 'Unknown';
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateMajorAndCampusDisplay();

            document.getElementById('study_program_id').addEventListener('change', function () {
                updateMajorAndCampusDisplay();
            });
        });
    </script>

@endsection
