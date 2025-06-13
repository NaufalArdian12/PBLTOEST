@extends('layouts.admin.admin')

@section('title', 'Edit Major')
@section('header', 'Edit Major')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Heading Section -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Edit Major: {{ $major->major_name }}</h2>
            </div>

            <!-- Edit Major Form -->
            <form action="{{ route('major.update', $major->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Major Name -->
                    <div>
                        <label for="major_name" class="block text-sm font-medium text-gray-700">Major Name <span class="text-red-500">*</span></label>
                        <input type="text" name="major_name" id="major_name"
                            value="{{ old('major_name', $major->major_name) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                        @error('major_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campus Selection -->
                    <div>
                        <label for="campus_id" class="block text-sm font-medium text-gray-700">Select Campus <span class="text-red-500">*</span></label>
                        <select name="campus_id" id="campus_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">-- Select Campus --</option>
                            @foreach ($campuses as $campus)
                                <option value="{{ $campus->id }}" {{ old('campus_id', $major->campus_id) == $campus->id ? 'selected' : '' }}>
                                    {{ $campus->campus_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('campus_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('major.index') }}"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Major
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
