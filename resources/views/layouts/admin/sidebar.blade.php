<!-- resources/views/layouts/admin/sidebar.blade.php -->
<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex flex-col h-full">
        <!-- Logo/Brand -->
        <div class="flex items-center justify-between px-6 py-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-lg">T</span>
                </div>
                <div>
                    <span class="text-xl font-bold text-gray-900">Toest</span>
                    <p class="text-xs text-gray-500">Admin Panel</p>
                </div>
            </div>
            <button id="closeSidebar" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto py-6">
            <!-- General Section -->
            <div class="px-6 mb-6">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">General</h3>
                <ul class="space-y-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm border-l-4 border-blue-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Dashboard</span>
                            @if(request()->routeIs('dashboard'))
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @endif
                        </a>
                    </li>

                    <!-- Student -->
                    <li>
                        <a href="{{ route('student.index') }}"
                           class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('student.*') ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm border-l-4 border-blue-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex-shrink-0 {{ request()->routeIs('student.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="flex-1">Students</span>
                            @if(request()->routeIs('student.*'))
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @endif
                        </a>
                    </li>

                    <!-- Registration -->
                    <li>
                        <a href="{{ route('registration.index') }}"
                           class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('registration.*') ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm border-l-4 border-blue-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex-shrink-0 {{ request()->routeIs('registration.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="flex-1">Registration</span>
                            @if(request()->routeIs('registration.*'))
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Academic Section -->
            <div class="px-6 mb-6">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Academic</h3>
                <ul class="space-y-2">
                    <!-- Toeic Test -->
                    <li>
                        <a href="{{ route('toeic.index') ?? '#' }}"
                           class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('toeic.*') ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm border-l-4 border-blue-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex-shrink-0 {{ request()->routeIs('toeic.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <span class="flex-1">TOEIC Tests</span>
                            @if(request()->routeIs('toeic.*'))
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @endif
                        </a>
                    </li>

                    <!-- Major -->
                    <li>
                        <a href="{{ route('major.index') }}"
                           class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('major.*') ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm border-l-4 border-blue-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex-shrink-0 {{ request()->routeIs('major.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <span class="flex-1">Majors</span>
                            @if(request()->routeIs('major.*'))
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @endif
                        </a>
                    </li>

                    <!-- Study Program -->
                    <li>
                        <a href="{{ route('studyprogram.index') }}"
                           class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('studyprogram.*') ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm border-l-4 border-blue-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex-shrink-0 {{ request()->routeIs('studyprogram.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                </svg>
                            </div>
                            <span class="flex-1">Study Programs</span>
                            @if(request()->routeIs('studyprogram.*'))
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @endif
                        </a>
                    </li>

                    <!-- Campus -->
                    <li>
                        <a href="{{ route('campus.index') }}"
                           class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('campus.*') ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm border-l-4 border-blue-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex-shrink-0 {{ request()->routeIs('campus.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <span class="flex-1">Campus</span>
                            @if(request()->routeIs('campus.*'))
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Management Section -->
            <div class="px-6 mb-6">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Management</h3>
                <ul class="space-y-2">
                    <!-- Admin -->
                    <li>
                        <a href="{{ route('admin.index') }}"
                           class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm border-l-4 border-blue-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex-shrink-0 {{ request()->routeIs('admin.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="flex-1">Admin Users</span>
                            @if(request()->routeIs('admin.*'))
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @endif
                        </a>
                    </li>

                    <!-- Education Staff -->
                    <li>
                        <a href="{{ route('educationalstaff.index') }}"
                           class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('educationalstaff.*') ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm border-l-4 border-blue-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex-shrink-0 {{ request()->routeIs('educationalstaff.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="flex-1">Education Staff</span>
                            @if(request()->routeIs('educationalstaff.*'))
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

    </div>
</aside>

<!-- Mobile overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden"></div>
