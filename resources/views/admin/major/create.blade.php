@extends('layouts.admin.admin')

@section('title', 'Create Major')
@section('header', 'Create Major')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">

            <form action="{{ route('major.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    <!-- Major Name -->
                    <div>
                        <label for="major_name" class="block text-sm font-medium text-gray-700">
                            Nama Major <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="major_name" id="major_name"
                            class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3
                                                                  focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="{{ old('major_name') }}" required>
                        @error('major_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
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
                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('major.index') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Add Major
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
