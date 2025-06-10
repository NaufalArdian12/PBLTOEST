@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">

        <!-- Main Card -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <div class="px-8 py-10">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('Set Your Password') }}</h2>
                    <div class="w-16 h-1 bg-blue-600 mx-auto rounded-full"></div>
                    <p class="text-gray-600 mt-4">Create a strong password to secure your account</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('password.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10"
                                placeholder="Enter your password" required>
                            <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="flex items-center mt-2 text-sm text-red-500">
                                <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10"
                                placeholder="Confirm your password" required>
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Password Requirements -->
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                        <div class="flex">
                            <svg class="h-5 w-5 text-blue-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-sm text-blue-700 font-medium mb-1">Password harus memenuhi:</p>
                                <ul class="text-sm text-blue-600 space-y-1">
                                    <li>• Minimum 8 characters</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="NIK" class="block text-sm font-medium text-gray-700">Citizen ID/ NIK <span class="text-red-500">*</span></label>
                        <input type="text" name="NIK" id="NIK" maxlength="16"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-blue-500" value="{{ old('NIK') }}" required>
                        @error('NIK') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Study Program -->
                    <div>
                        <label for="study_program_id" class="block text-sm font-medium text-gray-700">Study Program <span class="text-red-500">*</span></label>
                        <select name="study_program_id" id="study_program_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-blue-500" required>
                            <option value="">Select Study Program</option>
                            @foreach ($studyPrograms as $program)
                                <option value="{{ $program->id }}" {{ old('study_program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->study_program_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('study_program_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Current Address -->
                    <div>
                        <label for="current_address" class="block text-sm font-medium text-gray-700">Current address <span class="text-red-500">*</span></label>
                        <input type="text" name="current_address" id="current_address"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-blue-500" value="{{ old('current_address') }}" required>
                        @error('current_address') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Origin Address -->
                    <div>
                        <label for="origin_address" class="block text-sm font-medium text-gray-700">Home address <span class="text-red-500">*</span></label>
                        <input type="text" name="origin_address" id="origin_address"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-blue-500" value="{{ old('origin_address') }}" required>
                        @error('origin_address') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="telephone_number" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" name="telephone_number" id="telephone_number" maxlength="15"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-blue-500" value="{{ old('telephone_number') }}" required>
                        @error('telephone_number') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- File Uploads -->
                    <div>
                        <label for="scan_ktp" class="block text-sm font-medium text-gray-700">Scan ID Card <span class="text-red-500">*</span></label>
                        <input type="file" name="scan_ktp" id="scan_ktp"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3" required>
                    </div>
                    <div>
                        <label for="scan_ktm" class="block text-sm font-medium text-gray-700">Scan Student ID card <span class="text-red-500">*</span></label>
                        <input type="file" name="scan_ktm" id="scan_ktm"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3" required>
                    </div>
                    <div>
                        <label for="pas_photo" class="block text-sm font-medium text-gray-700">Passport photo <span class="text-red-500">*</span></label>
                        <input type="file" name="pas_photo" id="pas_photo"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3" required>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full flex justify-center items-center px-6 py-3 text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('Set Password') }}
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-4 text-center text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">Login Here</a>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="text-center text-sm text-gray-500">
            🔒 Your data is secure and encrypted with leading-edge security technology
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
    }

    // Placeholder for future real-time validation
    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        // Add validation logic if needed
    });
</script>
@endsection
