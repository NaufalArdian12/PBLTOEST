@extends('layouts.admin.admin')

@section('title', 'Add New Student')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <div class="p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Add New Student</h1>
            </div>

            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="NIM" class="block text-sm font-medium text-gray-700">Student ID (NIM)</label>
                        <input type="text" name="NIM" id="NIM" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="major_id" class="block text-sm font-medium text-gray-700">Major</label>
                        <select name="major_id" id="major_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @foreach($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="study_program_id" class="block text-sm font-medium text-gray-700">Study Program</label>
                        <select name="study_program_id" id="study_program_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @foreach($studyPrograms as $program)
                                <option value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Add Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
