@extends('layouts.admin.admin')

@section('title', 'Tambah Kampus Baru')
@section('header', 'Tambah Kampus Baru')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">

            <form action="{{ route('campus.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    <!-- Campus Name -->
                    <div>
                        <label for="campus_name" class="block text-sm font-medium text-gray-700">
                            Nama Kampus <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="campus_name" id="campus_name" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3
                                                      focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('campus_name') }}" required>
                        @error('campus_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('campus.index') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Add Campus
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
