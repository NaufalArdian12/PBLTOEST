@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-blue-50 px-4">
    <div class="max-w-xl w-full bg-white shadow-xl rounded-lg p-8 text-center">
        <h1 class="text-7xl font-extrabold text-blue-600">403</h1>
        <h2 class="mt-4 text-2xl font-semibold text-gray-800">Access Denied</h2>
        <p class="mt-2 text-gray-600">
            You do not have permission to access this page.
        </p>

        <a href="{{ url()->previous() }}"
           class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow transition">
            ← Kembali
        </a>

        <p class="mt-4 text-sm text-gray-400">Contact admin if you think this is a mistake.</p>
    </div>
</div>
@endsection
