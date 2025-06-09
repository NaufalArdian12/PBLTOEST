@extends('layouts.admin.admin')

@section('title', 'Edit Mahasiswa')
@section('header', 'Edit Mahasiswa')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Student Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Student Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('name', $student->user->name) }}" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('email', $student->user->email) }}" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirm Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- NIM -->
                    <div>
                        <label for="NIM" class="block text-sm font-medium text-gray-700">
                            NIM <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="NIM" id="NIM"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('NIM', $student->NIM) }}" required>
                        @error('NIM')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="NIK" class="block text-sm font-medium text-gray-700">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="NIK" id="NIK"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('NIK', $student->NIK) }}" required>
                        @error('NIK')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Study Program -->
                    <div>
                        <label for="study_program_id" class="block text-sm font-medium text-gray-700">
                            Program Studi <span class="text-red-500">*</span>
                        </label>
                        <select name="study_program_id" id="study_program_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Pilih Program Studi</option>
                            @foreach ($studyPrograms as $program)
                                <option value="{{ $program->id }}" {{ old('study_program_id', $student->study_program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->study_program_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('study_program_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Address -->
                    <div>
                        <label for="current_address" class="block text-sm font-medium text-gray-700">
                            Alamat Sekarang <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="current_address" id="current_address"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('current_address', $student->current_address) }}" required>
                        @error('current_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Origin Address -->
                    <div>
                        <label for="origin_address" class="block text-sm font-medium text-gray-700">
                            Alamat Asal <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="origin_address" id="origin_address"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('origin_address', $student->origin_address) }}" required>
                        @error('origin_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="telephone_number" class="block text-sm font-medium text-gray-700">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="telephone_number" id="telephone_number"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('telephone_number', $student->telephone_number) }}" required>
                        @error('telephone_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Scan KTP -->
                    <div>
                        <label for="scan_ktp" class="block text-sm font-medium text-gray-700">
                            Scan KTP <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="scan_ktp" id="scan_ktp"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Scan KTM -->
                    <div>
                        <label for="scan_ktm" class="block text-sm font-medium text-gray-700">
                            Scan KTM <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="scan_ktm" id="scan_ktm"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Passport Photo -->
                    <div>
                        <label for="pas_photo" class="block text-sm font-medium text-gray-700">
                            Foto Paspor <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="pas_photo" id="pas_photo"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('student.index') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Student
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
