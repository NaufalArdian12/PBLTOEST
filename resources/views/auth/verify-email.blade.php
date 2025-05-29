@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo Section -->
            <div class="text-center">
                <div class="mx-auto h-20 w-20 bg-blue-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                    <!-- Replace this div with your actual logo -->
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <!-- Alternative: Use your logo image -->
                    <!-- <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo"> -->
                </div>
            </div>

            <!-- Main Card -->
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="px-8 py-10">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">
                            {{ __('Verify Your Email Address') }}
                        </h2>
                        <div class="w-16 h-1 bg-blue-600 mx-auto rounded-full"></div>
                    </div>

                    <!-- Success Message -->
                    @if (session('resent'))
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg" role="alert">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700 font-medium">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Main Content -->
                    <div class="space-y-6">
                        <!-- Email Icon -->
                        <div class="flex justify-center">
                            <div class="bg-blue-50 p-3 rounded-full">
                                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="text-center space-y-4">
                            <p class="text-gray-600 leading-relaxed">
                                Thank you for signing up! Before we get started, we need to make sure that your email
                                address is valid.
                            </p>
                            <p class="text-gray-600 leading-relaxed">
                                Please check your email inbox and click the verification link we have sent you.
                            </p>
                        </div>

                        <!-- Action Button -->
                        <form action="/email/resend" method="POST" class="mt-8">
                            @csrf
                            <button type="submit"
                                class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                {{ __('Send Verification Email') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-8 py-4">
                    <p class="text-center text-sm text-gray-500">
                        Not receiving emails? Check your spam folder or
                        <a href="https://wa.me/+6282338928137"
                            class="font-medium text-blue-600 hover:text-blue-500 transition duration-200" target="_blank"
                            rel="noopener noreferrer">
                            <br>call support
                        </a>
                    </p>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="text-center">
                <p class="text-sm text-gray-500">
                    Have you verified your email?
                    <a href="{{ route('login') }}"
                        class="font-medium text-blue-600 hover:text-blue-500 transition duration-200">
                        Back to login
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
