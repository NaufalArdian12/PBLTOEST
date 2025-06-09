@extends('layouts.admin.admin')

@section('title', 'Tambah Program Studi')
@section('header', 'Tambah Program Studi')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">

            <form action="{{ route('studyprogram.store') }}" method="POST">
                @csrf

                <div class="space-y-6">

                    <!-- Campus Selection -->
                    <div>
                        <label for="campus_id" class="block text-sm font-medium text-gray-700">
                            Pilih Kampus <span class="text-red-500">*</span>
                        </label>
                        <select name="campus_id" id="campus_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">-- Pilih Kampus --</option>
                            @foreach ($campuses as $campus)
                                <option value="{{ $campus->id }}" {{ old('campus_id') == $campus->id ? 'selected' : '' }}>
                                    {{ $campus->campus_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('campus_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Major Selection (Visible only if "State Polytechnic of Malang" is selected) -->
                    <div id="major-section" style="display:none;">
                        <label for="major_id" class="block text-sm font-medium text-gray-700">
                            Pilih Major <span class="text-red-500">*</span>
                        </label>
                        <select name="major_id" id="major_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Major --</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>
                                    {{ $major->major_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('major_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Study Program Name -->
                    <div>
                        <label for="study_program_name" class="block text-sm font-medium text-gray-700">
                            Nama Program Studi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="study_program_name" id="study_program_name"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3
                                                                  focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="{{ old('study_program_name') }}" required>
                        @error('study_program_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('studyprogram.index') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Add Study Program
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to show/hide major selection based on campus selection
        document.getElementById('campus_id').addEventListener('change', function() {
            var campusSelect = this.value;
            var majorSection = document.getElementById('major-section');

            // Check if the selected campus is "State Polytechnic of Malang" (campus ID check)
            if (campusSelect && campusSelect == '4') {
                majorSection.style.display = 'block'; // Show Major Selection
            } else {
                majorSection.style.display = 'none'; // Hide Major Selection
            }
        });
    </script>
@endsection
