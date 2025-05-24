@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 px-6 py-4 bg-white shadow-sm rounded-xl">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="w-24">
                <h4 class="text-xl font-semibold m-0"></h4>
            </div>
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/bell-alert.png') }}" alt="Notification" class="w-5 h-5">

                <!-- User Profile Dropdown -->
                <div class="relative group">
                    <div class="flex items-center gap-2 cursor-pointer py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-700 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <!-- Profile Option -->
                            <a href="{{ route('mahasiswa.profile') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <div>
                                    <div class="font-medium text-sm">Profile</div>
                                    <div class="text-xs text-gray-500">Update your information</div>
                                </div>
                            </a>

                            <!-- Divider -->
                            <div class="border-t border-gray-100 my-1"></div>

                            <!-- Logout Option -->
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 transition-colors duration-150 text-left">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <div>
                                        <div class="font-medium text-sm">Logout</div>
                                        <div class="text-xs text-red-400">Sign out of your account</div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Section: Schedule and Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Schedule Table and Congratulation -->
            <div class="lg:col-span-2">
                <!-- Schedule -->
                <div class="bg-white shadow-sm rounded-2xl p-4 mb-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-center">
                            <thead>
                                <tr class="border-b border-gray-200 bg-white text-gray-600">
                                    <th class="py-3 px-4 font-medium">Sesi</th>
                                    <th class="py-3 px-4 font-medium">Kelas</th>
                                    <th class="py-3 px-4 font-medium">Waktu</th>
                                    <th class="py-3 px-4 font-medium">Tempat</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-4">1.</td>
                                    <td class="py-3 px-4">S1B 1A, 1B</td>
                                    <td class="py-3 px-4">Saturday 12 January (07:00-09:00)</td>
                                    <td class="py-3 px-4">RT 1, 2, 3</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-4">2.</td>
                                    <td class="py-3 px-4">S1B 1C, 1D</td>
                                    <td class="py-3 px-4">Saturday 12 January (07:00-09:00)</td>
                                    <td class="py-3 px-4">RT 1, 2, 3</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-4">3.</td>
                                    <td class="py-3 px-4">S1B 1E, 1F</td>
                                    <td class="py-3 px-4">Saturday 12 January (07:00-09:00)</td>
                                    <td class="py-3 px-4">RT 1, 2, 3</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4">4.</td>
                                    <td class="py-3 px-4">S1B 1G</td>
                                    <td class="py-3 px-4">Saturday 12 January (07:00-09:00)</td>
                                    <td class="py-3 px-4">RT 1, 2, 3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Congratulation Section -->
                <div class="bg-white text-center p-8 shadow-sm border border-blue-200 rounded-2xl">
                    <div class="mb-4">
                        <img src="{{ asset('images/congrat.png') }}" alt="celebration" class="w-36 mx-auto">
                    </div>
                    <h2 class="text-2xl font-bold mb-3">Congratulation!</h2>
                    <p class="text-gray-500 text-sm mb-4">
                        You have done your Toest test. You can download your certificate below.
                    </p>
                    <a href="{{ route('mahasiswa.sertifikat') }}"
                        class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200">
                        <img src="{{ asset('images/Subtract.png') }}" alt="Download" class="w-5 h-5">
                        <span>Get your certificate</span>
                    </a>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="lg:col-span-1">
                <!-- Dynamic Calendar -->
                <div class="bg-white shadow-sm rounded-xl mb-6">
                    <div class="p-4">
                        <!-- Calendar Header -->
                        <div class="flex items-center justify-between mb-4">
                            <button id="prevMonth" class="p-1 hover:bg-gray-100 rounded-lg transition-colors">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <h3 id="currentMonth" class="text-lg font-semibold text-gray-800"></h3>
                            <button id="nextMonth" class="p-1 hover:bg-gray-100 rounded-lg transition-colors">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Calendar Grid -->
                        <div class="grid grid-cols-7 gap-1 mb-2">
                            <!-- Day Headers -->
                            <div class="text-center text-xs font-medium text-gray-500 py-2">Su</div>
                            <div class="text-center text-xs font-medium text-gray-500 py-2">Mo</div>
                            <div class="text-center text-xs font-medium text-gray-500 py-2">Tu</div>
                            <div class="text-center text-xs font-medium text-gray-500 py-2">We</div>
                            <div class="text-center text-xs font-medium text-gray-500 py-2">Th</div>
                            <div class="text-center text-xs font-medium text-gray-500 py-2">Fr</div>
                            <div class="text-center text-xs font-medium text-gray-500 py-2">Sa</div>
                        </div>

                        <!-- Calendar Days -->
                        <div id="calendarDays" class="grid grid-cols-7 gap-1">
                            <!-- Days will be populated by JavaScript -->
                        </div>
                    </div>
                </div>

                <!-- Reminder -->
                <div class="bg-white shadow-sm rounded-xl p-4 mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-lg font-semibold">Reminder</h5>
                        <img src="{{ asset('images/notification-solid.png') }}" alt="bell" class="w-6 h-6">
                    </div>
                    <div class="space-y-3">
                        <div class="bg-gray-50 rounded-xl p-3">
                            <div class="font-semibold text-gray-800">Lorem</div>
                            <div class="text-gray-500 text-sm">Overdue at: Sunday | 29-09-2024</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3">
                            <div class="font-semibold text-gray-800">Ipsum</div>
                            <div class="text-gray-500 text-sm">Overdue at: Sunday | 30-09-2024</div>
                        </div>
                    </div>
                </div>

                <!-- Another Test -->
                <div class="bg-white shadow-sm rounded-xl p-4">
                    <p class="font-semibold text-gray-800 mb-2">Want to do another test?</p>
                    <p class="text-gray-500 text-sm mb-3">You can click link below for other test</p>
                    <a href="#" class="text-blue-600 hover:text-blue-700 text-sm italic transition-colors duration-200">Get in touch</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar JS -->
    <script>
        // Modern Calendar Implementation
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

            // Update month/year display
            document.getElementById('currentMonth').textContent = `${months[month]} ${year}`;

            // Clear previous calendar
            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';

            // Add empty cells for days before month starts
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'h-10 w-10 flex items-center justify-center text-gray-300 text-sm';
                const prevMonthDays = new Date(year, month, 0).getDate();
                emptyDay.textContent = prevMonthDays - firstDay + i + 1;
                calendarDays.appendChild(emptyDay);
            }

            // Add days of current month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'h-10 w-10 flex items-center justify-center text-sm cursor-pointer rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-600';

                // Highlight today
                if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
                    dayElement.className += ' bg-blue-600 text-white font-semibold hover:bg-blue-700';
                }

                dayElement.textContent = day;
                dayElement.addEventListener('click', function() {
                    // Remove previous selection
                    document.querySelectorAll('#calendarDays > div').forEach(d => {
                        if (!d.classList.contains('bg-blue-600')) {
                            d.classList.remove('bg-blue-100', 'text-blue-800', 'font-semibold');
                        }
                    });

                    // Add selection to clicked day (if not today)
                    if (!this.classList.contains('bg-blue-600')) {
                        this.classList.add('bg-blue-100', 'text-blue-800', 'font-semibold');
                    }
                });

                calendarDays.appendChild(dayElement);
            }

            // Add days from next month to fill the grid
            const totalCells = calendarDays.children.length;
            const remainingCells = 42 - totalCells; // 6 rows × 7 days

            for (let day = 1; day <= remainingCells && remainingCells < 7; day++) {
                const nextMonthDay = document.createElement('div');
                nextMonthDay.className = 'h-10 w-10 flex items-center justify-center text-gray-300 text-sm';
                nextMonthDay.textContent = day;
                calendarDays.appendChild(nextMonthDay);
            }
        }

        // Event listeners for navigation
        document.getElementById('prevMonth').addEventListener('click', function() {
            currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
            if (currentMonth === 11) currentYear--;
            generateCalendar(currentMonth, currentYear);
        });

        document.getElementById('nextMonth').addEventListener('click', function() {
            currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
            if (currentMonth === 0) currentYear++;
            generateCalendar(currentMonth, currentYear);
        });

        // Initialize calendar when page loads
        document.addEventListener('DOMContentLoaded', function() {
            generateCalendar(currentMonth, currentYear);
        });
    </script>
@endsection
