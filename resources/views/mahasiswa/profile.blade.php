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
                    <div
                        class="flex items-center gap-2 cursor-pointer py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-700 transition-transform duration-200 group-hover:rotate-180"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <!-- Profile Option -->
                            <a href="/profile"
                                class="flex items-center gap-3 px-4 py-3 text-blue-600 bg-blue-50 transition-colors duration-150">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
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
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 transition-colors duration-150 text-left">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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

                            <!-- Program Study -->
                            <div>
                                <label for="study_program_id" class="block text-sm font-medium text-gray-700 mb-2">Program
                                    Study</label>
                                <select id="study_program_id" name="study_program_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="study_program_id" disabled selected>
                                        {{ auth()->user()->students->studyprogram->study_program_name ?? 'Select Study Program' }}
                                    </option>
                                    @foreach ($studyPrograms as $program)
                                        <option value="{{ $program->id }}" {{ auth()->user()->students && auth()->user()->students->study_program_id == $program->id ? 'selected' : '' }}>
                                            {{ $program->study_program_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('study_program')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                    Address</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" readonly
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Profile Picture -->
                            <div>
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
                                        File saat ini: <span class="font-medium">Sudah diunggah</span>
                                    </p>
                                    <a href="{{ route('student.showPasPhoto', auth()->user()->students->id) }}" target="_blank"
                                        class="text-blue-500 underline text-sm">
                                        Lihat file
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
                                        File saat ini: <span class="font-medium">Sudah diunggah</span>
                                    </p>
                                    <a href="{{ route('student.showKtp', auth()->user()->students->id) }}" target="_blank"
                                        class="text-blue-500 underline text-sm">
                                        Lihat file
                                    </a>
                                @endif
                                @error('scan_ktp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Scan KTM -->
                            <div class="md:col-span-2">
                                <label for="scan_ktm" class="block text-sm font-medium text-gray-700 mb-2">Scan KTM</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" id="scan_ktm" name="scan_ktm" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Maximum file size: 2MB. Supported formats: JPG, PNG,
                                    GIF</p>
                                @if(auth()->user()->students && auth()->user()->students->scan_ktm)
                                    <p class="text-sm text-gray-600 mt-1">
                                        File saat ini: <span class="font-medium">Sudah diunggah</span>
                                    </p>
                                    <a href="{{ route('student.showKtm', auth()->user()->students->id) }}" target="_blank"
                                        class="text-blue-500 underline text-sm">
                                        Lihat file
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
                                        class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
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
                                        class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
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
@endsection
