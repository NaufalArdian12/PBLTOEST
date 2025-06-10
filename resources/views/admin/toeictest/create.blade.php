@extends('layouts.admin.admin')

@section('title', 'Create TOEIC Test')
@section('header', 'Create TOEIC Test')

@section('content')
    <div class="container mx-auto px-4 sm:px-6">
        <h2 class="text-3xl leading-9 font-bold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
            Create TOEIC Test
        </h2>

        @if ($errors->any())
            <div class="mt-4 bg-red-50 border-l-4 border-red-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm leading-5 font-medium text-red-800">
                            There were {{ $errors->count() }} errors with your submission
                        </h3>
                        <div class="mt-2 text-sm leading-5 text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('toeic.store') }}" class="mt-6 space-y-8">
            @csrf

            <div class="space-y-8">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <div class="mt-1">
                        <input type="date" name="date" id="date" value="{{ old('date') }}" class="block w-full px-5 py-3 text-base text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('date') border-red-500 @enderror" />
                        @error('date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="zoom_link" class="block text-sm font-medium text-gray-700">Zoom Link</label>
                    <div class="mt-1">
                        <input type="text" name="zoom_link" id="zoom_link" value="{{ old('zoom_link') }}" class="block w-full px-5 py-3 text-base text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('zoom_link') border-red-500 @enderror" />
                        @error('zoom_link')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="max_participants" class="block text-sm font-medium text-gray-700">Max Participants</label>
                    <div class="mt-1">
                        <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants') }}" class="block w-full px-5 py-3 text-base text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('max_participants') border-red-500 @enderror" />
                        @error('max_participants')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-right mt-5">
                <a href="{{ route('toeic.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>

                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
