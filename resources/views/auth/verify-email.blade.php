@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            {{ __('Verify Your Email Address') }}
        </h2>

        @if (session('resent'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p class="text-gray-700 mb-4">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </p>
        <p class="text-gray-700 mb-4">
            {{ __('If you did not receive the email') }},
        </p>

        <form method="POST" action="{{ route('auth.resend') }}">
            @csrf
            <button type="submit"
                class="text-blue-600 hover:underline font-medium">
                {{ __('Re-send email') }}
            </button>
        </form>
    </div>
</div>
@endsection
