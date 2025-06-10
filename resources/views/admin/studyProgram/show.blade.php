@extends('layouts.admin.admin')

@section('title', 'Detail Program Studi')
@section('header', 'Detail Program Studi')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">

            <!-- Program Studi Details -->
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Program Studi</label>
                    <p class="mt-1 text-gray-900">{{ $studyProgram->study_program_name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pilih Kampus</label>
                    <p class="mt-1 text-gray-900">{{ $studyProgram->campus->campus_name }}</p>
                </div>

                @if ($studyProgram->campus->campus_name == 'State Polytechnic of Malang')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pilih Major</label>
                        <p class="mt-1 text-gray-900">{{ $studyProgram->major->major_name }}</p>
                    </div>
                @endif
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('studyprogram.index') }}"
                    class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Back
                </a>
                <a href="{{ route('studyprogram.edit', $studyProgram->id) }}"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection
