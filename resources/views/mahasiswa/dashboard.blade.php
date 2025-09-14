@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-blue-100/40 via-white to-purple-50">
    <div class="container mx-auto px-4 py-6">
        <!-- Enhanced Header -->
        <div class="sticky top-0 z-50 bg-white/80 backdrop-blur-md shadow-lg rounded-2xl mb-8 border border-white/20">
            <div class="flex justify-between items-center px-8 py-6 z-40">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="w-28 h-auto drop-shadow-md">
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative items-center gap-6 z-40">
                        <!-- Enhanced User Profile Dropdown -->
                        <div class="relative group">
                            <div
                                class="flex items-center gap-3 cursor-pointer py-3 px-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-all duration-300 border border-blue-100">
                                <div
                                    class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center text-blue-600 font-semibold text-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                <div class="text-left">
                                    <span class="text-gray-800 font-medium block">Hi, {{ auth()->user()->name }}</span>
                                    <span class="text-gray-500 text-xs">Welcome back!</span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-all duration-200 group-hover:rotate-180"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <!-- Enhanced Dropdown Menu - FIXED Z-INDEX -->
                            <div
                                class="absolute right-0 top-full mt-3 w-64 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 transform translate-y-2 group-hover:translate-y-0">
                                <div class="p-2">
                                    <!-- Profile Option -->
                                    <a href="/profile"
                                        class="flex items-center gap-4 px-4 py-3 text-gray-700 hover:bg-blue-50 transition-all duration-200 rounded-xl group/item">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center group-hover/item:scale-110 transition-transform">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-sm text-gray-800">Profile Settings</div>
                                            <div class="text-xs text-gray-500">Update your information</div>
                                        </div>
                                    </a>

                                    <div class="border-t border-gray-100 my-2"></div>

                                    <!-- Logout Option -->
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-4 px-4 py-3 text-red-600 hover:bg-red-50 transition-all duration-200 rounded-xl text-left group/item">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center group-hover/item:scale-110 transition-transform">
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-sm">Sign Out</div>
                                                <div class="text-xs text-red-400">Logout from your account</div>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Success Message -->
        @if (session('success'))
            <div
                class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="h-6 w-6 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-green-800">Success!</h3>
                        <p class="text-green-700 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Error Message -->
        @if (session('error'))
            <div class="mb-8 bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-2xl p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="h-6 w-6 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-red-800">Error!</h3>
                        <p class="text-red-700 mt-1">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
            <!-- TOEIC Tests Section -->
            <div class="xl:col-span-3">
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-8 shadow-lg border border-white/20">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">Available TOEIC Tests</h1>
                            {{-- <p class="text-gray-600">Choose your preferred test schedule</p> --}}
                        </div>
                        <div class="bg-blue-50 rounded-2xl p-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Enhanced Test Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($toeicTests as $test)
                            <div
                                class="group relative bg-white rounded-2xl p-6 shadow-md border border-gray-100 hover:shadow-2xl hover:scale-105 transition-all duration-300 cursor-pointer overflow-hidden">
                                <!-- Gradient Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-purple-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <!-- Card Content -->
                                <div class="relative z-10">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-xl font-bold text-gray-800">TOEIC Test</h3>
                                        <div
                                            class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    </div>

                                    {{-- <!-- Date Info -->
                                    <div class="flex items-center mb-6 p-3 bg-purple-50 rounded-xl">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-800 text-sm">
                                                {{ \Carbon\Carbon::parse($test->date)->translatedFormat('l, d F Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500">Test Date</div>
                                        </div>
                                    </div> --}}

                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            class="text-xs px-3 py-2 rounded-full bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 font-semibold">🌐
                                            Offline</span>
                                        <span
                                            class="text-xs px-3 py-2 rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-700 font-semibold">💸
                                            Free</span>

                                        {{-- dan ketika waktunya melewati buat dia jadi not available --}}
                                        @if ($test->date < now())
                                            <span
                                                class="text-xs px-3 py-2 rounded-full bg-gradient-to-r from-red-100 to-red-200 text-red-700 font-semibold">❌
                                                Expired</span>
                                        @endif
                                        {{-- ketika expired buat dia jadi not available --}}
                                        @if ($test->date > now() && $registeredTestId === null)
                                            <span
                                                class="text-xs px-3 py-2 rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-700 font-semibold">✅
                                                Available</span>
                                        @endif
                                    </div>

                                    <!-- Progress Bar -->
                                    <div class="mt-4">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Registration Progress</span>
                                            <span>{{ round(($test->registrations_count / $test->max_participants) * 100) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-500 h-2 rounded-full transition-all duration-500"
                                                style="width: {{ ($test->registrations_count / $test->max_participants) * 100 }}%">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tombol Registrasi -->
                                    @if ($test->id == $registeredTestId)
                                        {{-- Sudah daftar di tes ini --}}
                                        <div class="mt-6 space-y-2">
                                            <div
                                                class="bg-green-100 text-green-800 px-4 py-2 rounded-full flex items-center justify-center w-full">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Registered</span>
                                            </div>
                                            <div
                                                class="bg-white text-black px-4 py-2 rounded-full flex items-center justify-center w-full">
                                                <a href="https://itc-indonesia.com/biaya-tes-2/" target="_blank">
                                                <span>Paid Test</span>
                                                </a>
                                            </div>
                                            {{-- Zoom Link --}}
                                            @if ($test->zoom_link)
                                                <a href="{{ $test->zoom_link }}" target="_blank"
                                                    class="block text-center text-blue-600 hover:underline font-medium">
                                                    🔗 Join Zoom Meeting
                                                </a>
                                            @endif
                                        </div>
                                    @elseif($registeredTestId === null && $test->date > now())
                                        {{-- Belum daftar dan tes masih berlaku --}}
                                        <div class="mt-6">
                                            <form action="{{ route('toeic.autoRegister', $test->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-blue-500 w-full py-3 text-white rounded-full hover:bg-blue-800 transition-colors duration-300">
                                                    Register Now
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        {{-- Sudah daftar di test lain atau tes expired --}}
                                        <div class="mt-6">
                                            <button class="w-full py-3 text-white rounded-full bg-gray-300 cursor-not-allowed"
                                                disabled>
                                                Registration Unavailable
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Enhanced Sidebar -->
            <div class="xl:col-span-1 space-y-6 ">
                <!-- Enhanced Calendar Widget - FIXED Z-INDEX -->
                <div
                    class="bg-white/80 backdrop-blur-sm shadow-lg rounded-2xl border border-white/20 overflow-hidden z-10 relative">
                    <div class="bg-blue-600 p-6 text-white">
                        <h3 class="text-xl font-bold mb-2">Calendar</h3>
                        <p class="text-blue-100 text-sm">Track your test dates</p>
                    </div>

                    <div class="p-6">
                        <!-- Calendar Header -->
                        <div class="flex items-center justify-between mb-6">
                            <button id="prevMonth" class="p-2 hover:bg-blue-50 rounded-xl transition-colors group">
                                <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <h3 id="currentMonth" class="text-lg font-bold text-gray-800"></h3>
                            <button id="nextMonth" class="p-2 hover:bg-blue-50 rounded-xl transition-colors group">
                                <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <!-- Calendar Grid -->
                        <div class="grid grid-cols-7 gap-1 mb-2">
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">Su</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">Mo</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">Tu</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">We</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">Th</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">Fr</div>
                            <div class="text-center text-xs font-semibold text-gray-500 py-2">Sa</div>
                        </div>

                        <div id="calendarDays" class="grid grid-cols-7 gap-1">
                            <!-- Days populated by JavaScript -->
                        </div>
                    </div>
                </div>

                <!-- Enhanced Reminders Widget -->
                <div class="bg-white/80 backdrop-blur-sm shadow-lg rounded-2xl border border-white/20 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold mb-2">Reminders</h3>
                                <p class="text-orange-100 text-sm">Don't miss important dates</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-xl p-4 border-l-4 border-red-400">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-800">Toeic Test</div>
                                    <div class="text-red-600 text-sm font-medium">Overdue: Sunday, 29-09-2025</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    function generateCalendar(month, year) {
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();

        // Update month/year display - FIXED TEMPLATE LITERAL
        document.getElementById('currentMonth').textContent = `${months[month]} ${year}`;

        // Clear previous calendar
        const calendarDays = document.getElementById('calendarDays');
        calendarDays.innerHTML = '';

        // Add days from previous month
        for (let i = 0; i < firstDay; i++) {
            const emptyDay = document.createElement('div');
            const prevMonthDays = new Date(year, month, 0).getDate();
            emptyDay.textContent = prevMonthDays - firstDay + i + 1;
            emptyDay.className = 'h-10 w-10 flex items-center justify-center text-gray-300 text-sm hover:bg-gray-50 rounded-lg transition-colors cursor-pointer';
            calendarDays.appendChild(emptyDay);
        }

        // Add days of current month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            const isToday = year === today.getFullYear() && month === today.getMonth() && day === today.getDate();

            dayElement.className = isToday
                ? 'h-10 w-10 flex items-center justify-center text-sm cursor-pointer rounded-lg bg-blue-500 text-white font-bold shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-200'
                : 'h-10 w-10 flex items-center justify-center text-sm cursor-pointer rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 hover:scale-110';

            dayElement.textContent = day;

            dayElement.addEventListener('click', function () {
                document.querySelectorAll('#calendarDays > div').forEach(d => {
                    if (!d.classList.contains('from-blue-500')) {
                        d.classList.remove('bg-blue-100', 'text-blue-800', 'font-semibold', 'ring-2', 'ring-blue-300');
                    }
                });

                if (!this.classList.contains('from-blue-500')) {
                    this.classList.add('bg-blue-100', 'text-blue-800', 'font-semibold', 'ring-2', 'ring-blue-300');
                }
            });

            calendarDays.appendChild(dayElement);
        }

        // Add days from next month to fill 6 rows (42 cells)
        const totalCells = calendarDays.children.length;
        const remainingCells = 42 - totalCells;

        for (let day = 1; day <= remainingCells; day++) {
            const nextMonthDay = document.createElement('div');
            nextMonthDay.textContent = day;
            nextMonthDay.className = 'h-10 w-10 flex items-center justify-center text-gray-300 text-sm hover:bg-gray-50 rounded-lg transition-colors cursor-pointer';
            calendarDays.appendChild(nextMonthDay);
        }
    }

    generateCalendar(currentMonth, currentYear);

    document.getElementById('prevMonth').addEventListener('click', function () {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear);
    });

    document.getElementById('nextMonth').addEventListener('click', function () {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    });
</script>
