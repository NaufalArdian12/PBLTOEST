@extends('layouts.admin.admin')

@section('title', 'Tambah Pendaftaran Baru')
@section('header', 'Tambah Pendaftaran Baru')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">

            <form action="{{ route('registration.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    <!-- Student Selection -->
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700">
                            Pilih Siswa <span class="text-red-500">*</span>
                        </label>
                        <select name="student_id" id="student_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->user->name }} ({{ $student->id }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- TOEIC Test Selection -->
                    <div>
                        <label for="toeic_test_id" class="block text-sm font-medium text-gray-700">
                            Pilih Tes TOEIC <span class="text-red-500">*</span>
                        </label>
                        <select name="toeic_test_id" id="toeic_test_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Tes TOEIC --</option>
                            @foreach ($toeicTests as $toeicTest)
                                <option value="{{ $toeicTest->id }}" {{ old('toeic_test_id') == $toeicTest->id ? 'selected' : '' }}>
                                    {{ $toeicTest->test_name }} ({{ $toeicTest->id }})
                                </option>
                            @endforeach
                        </select>
                        @error('toeic_test_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Registration Date -->
                    <div>
                        <label for="registration_date" class="block text-sm font-medium text-gray-700">
                            Tanggal Pendaftaran <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="registration_date" id="registration_date"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="{{ old('registration_date') }}" required>
                        @error('registration_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Selection -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">
                            Status Pendaftaran <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Add Registration
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
