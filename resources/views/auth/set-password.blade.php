@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full space-y-6">
            <!-- Main Card -->
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="px-6 py-8 sm:px-10 sm:py-10">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                            {{ __('Complete Your Profile') }}
                        </h2>
                        <div class="w-16 h-1 bg-blue-600 mx-auto rounded-full"></div>
                        <p class="text-gray-600 mt-4 text-sm sm:text-base">
                            Please fill in your details and set a password to secure your account
                        </p>
                    </div>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Main Content -->
                    <div class="space-y-6">
                        <!-- Form -->
                        <form method="POST" action="{{ route('password.store') }}" class="space-y-6"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Grid Layout for Personal Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Full Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- NIM -->
                                <div>
                                    <label for="NIM" class="block text-sm font-medium text-gray-700">Student ID</label>
                                    <input type="text" id="NIM" name="NIM" value="{{ auth()->user()->students->NIM }}"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('NIM')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- NIK -->
                                <div>
                                    <label for="NIK" class="block text-sm font-medium text-gray-700">Citizen ID</label>
                                    <input type="text" id="NIK" name="NIK" value="{{ auth()->user()->students->NIK }}"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('NIK')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div>
                                    <label for="telephone_number" class="block text-sm font-medium text-gray-700">Phone
                                        Number</label>
                                    <input type="text" id="telephone_number" name="telephone_number"
                                        value="{{ auth()->user()->students->telephone_number }}"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('telephone_number')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Study Program -->
                                <div class="md:col-span-2">
                                    <label for="study_program_id" class="block text-sm font-medium text-gray-700">
                                        Study Program <span class="text-red-500">*</span>
                                    </label>
                                    <select name="study_program_id" id="study_program_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        required>
                                        <option value="">Select Study Program</option>
                                        @foreach ($studyPrograms as $program)
                                            <option value="{{ $program->id }}" {{ old('study_program_id') == $program->id ? 'selected' : '' }}>
                                                {{ $program->study_program_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('study_program_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Current Address -->
                                <div class="md:col-span-2">
                                    <label for="current_address" class="block text-sm font-medium text-gray-700">Current
                                        Address</label>
                                    <input type="text" id="current_address" name="current_address"
                                        value="{{ auth()->user()->students->current_address }}"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('current_address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Origin Address -->
                                <div class="md:col-span-2">
                                    <label for="origin_address" class="block text-sm font-medium text-gray-700">Origin
                                        Address</label>
                                    <input type="text" id="origin_address" name="origin_address"
                                        value="{{ auth()->user()->students->origin_address }}"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('origin_address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- Email -->
                            <div>
                                <div class="md:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        Address</label>
                                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" readonly
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Email cannot be changed</p>
                            </div>

                            <!-- File Uploads Section -->
                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Document Uploads</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Scan KTP -->
                                    <div>
                                        <label for="scan_ktp" class="block text-sm font-medium text-gray-700">
                                            Scan KTP <span class="text-red-500">*</span>
                                        </label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="scan_ktp"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                        <span>Upload a file</span>
                                                        <input id="scan_ktp" name="scan_ktp" type="file" class="sr-only"
                                                            required>
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    PNG, JPG, PDF up to 5MB
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Scan KTM -->
                                    <div>
                                        <label for="scan_ktm" class="block text-sm font-medium text-gray-700">
                                            Scan KTM <span class="text-red-500">*</span>
                                        </label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="scan_ktm"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                        <span>Upload a file</span>
                                                        <input id="scan_ktm" name="scan_ktm" type="file" class="sr-only"
                                                            required>
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    PNG, JPG, PDF up to 5MB
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Photo -->
                                    <div>
                                        <label for="pas_photo" class="block text-sm font-medium text-gray-700">
                                            Passport Photo <span class="text-red-500">*</span>
                                        </label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="pas_photo"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                        <span>Upload a file</span>
                                                        <input id="pas_photo" name="pas_photo" type="file" class="sr-only"
                                                            required>
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    PNG, JPG up to 2MB
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Section -->
                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Password Settings</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Password Field -->
                                    <div class="space-y-2">
                                        <label for="password" class="block text-sm font-medium text-gray-700">
                                            {{ __('Password') }} <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="password" name="password" id="password"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm pr-10"
                                                placeholder="Enter your password" required>
                                            <button type="button" onclick="togglePassword('password')"
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                                <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="flex items-center mt-2">
                                                <svg class="h-4 w-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password Field -->
                                    <div class="space-y-2">
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                            {{ __('Confirm Password') }} <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm pr-10"
                                                placeholder="Confirm your password" required>
                                            <button type="button" onclick="togglePassword('password_confirmation')"
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                                <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Requirements -->
                                <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-blue-700 font-medium mb-2">Password must meet these
                                                requirements:</p>
                                            <ul class="text-sm text-blue-600 space-y-1">
                                                <li class="flex items-center">
                                                    <svg class="h-4 w-4 mr-1.5 text-blue-500" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Minimum 8 characters long
                                                </li>
                                                <li class="flex items-center">
                                                    <svg class="h-4 w-4 mr-1.5 text-blue-500" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    At least one uppercase letter
                                                </li>
                                                <li class="flex items-center">
                                                    <svg class="h-4 w-4 mr-1.5 text-blue-500" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    At least one number
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-6">
                                <button type="submit"
                                    class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ __('Complete Registration') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-8 py-4">
                    <p class="text-center text-sm text-gray-500">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-medium text-blue-600 hover:text-blue-500 transition duration-150 ease-in-out">
                            Login Here
                        </a>
                    </p>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="text-center">
                <p class="text-xs sm:text-sm text-gray-500">
                    🔒 Your data is secure and encrypted with leading-edge security technology
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);

            // Update the icon
            const icon = field.nextElementSibling.querySelector('svg');
            if (type === 'text') {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }

        // Real-time password validation
        document.getElementById('password').addEventListener('input', function (e) {
            const password = e.target.value;
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                number: /[0-9]/.test(password)
            };

            // Update requirement indicators
            document.querySelectorAll('.password-requirement').forEach(item => {
                const type = item.getAttribute('data-requirement');
                const icon = item.querySelector('svg');
                if (requirements[type]) {
                    icon.classList.remove('text-gray-400');
                    icon.classList.add('text-green-500');
                    icon.innerHTML = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />';
                } else {
                    icon.classList.add('text-gray-400');
                    icon.classList.remove('text-green-500');
                    icon.innerHTML = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />';
                }
            });
        });
    </script>
@endsection
