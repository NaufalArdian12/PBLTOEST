@extends('layouts.admin.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="flex h-screen bg-gray-50">
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-6">
                <!-- Header with Actions -->
                <div class="mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                            <p class="mt-1 text-sm text-gray-500">Manage student registrations and monitor statistics</p>
                        </div>
                        <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                            <button onclick="exportData()"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Export Data
                            </button>
                            <button onclick="refreshData()"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Refresh
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Students -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 mb-1">Total Students</p>
                                <p class="text-3xl font-bold text-gray-900">{{ number_format($totalMahasiswa) }}</p>
                                <div class="flex items-center mt-2">
                                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 17l9.2-9.2M17 7H7v10"></path>
                                    </svg>
                                    <span>{{ number_format($totalMahasiswa) }}</span>
                                    <span class="text-sm text-gray-500 ml-1">from last month</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Student Enrollment -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 mb-1">Student Enrollment</p>
                                <p class="text-3xl font-bold text-gray-900">{{ number_format($mahasiswaMendaftar) }}</p>
                                <div class="flex items-center mt-2">
                                    <div class="w-4 h-4 bg-gray-400 rounded-full mr-1"></div>
                                    <span class="text-sm text-gray-500">No change from last month</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Students Not Accepted -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 mb-1">Pending Review</p>
                                <p class="text-3xl font-bold text-gray-900">{{ number_format($mahasiswaBelumAcc) }}</p>
                                <div class="flex items-center mt-2">
                                    <div class="w-4 h-4 bg-yellow-400 rounded-full mr-1"></div>
                                    <span class="text-sm text-yellow-600">Requires attention</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acceptance Rate -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 mb-1">Acceptance Rate</p>
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ $totalMahasiswa > 0 ? number_format((($totalMahasiswa - $mahasiswaBelumAcc) / $totalMahasiswa) * 100, 1) : 0 }}%
                                </p>
                                <div class="flex items-center mt-2">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full"
                                            style="width: {{ $totalMahasiswa > 0 ? (($totalMahasiswa - $mahasiswaBelumAcc) / $totalMahasiswa) * 100 : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Enhanced Student Registration Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Student Registration Management</h2>
                                <p class="text-sm text-gray-600 mt-1">Review and process student applications</p>
                            </div>
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                <!-- Status Filter -->
                                <select id="statusFilter" onchange="filterByStatus()"
                                    class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm">
                                    <option value="">All Status</option>
                                    <option value="active">Approved</option>
                                    <option value="inactive">Rejected</option>
                                    <option value="pending">Pending</option>
                                </select>

                                <!-- Search Input -->
                                <div class="relative">
                                    <input type="text" id="searchInput" placeholder="Search students..."
                                        class="pl-10 pr-4 py-2 w-full sm:w-64 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bulk Actions -->
                    <div id="bulkActions" class="hidden px-6 py-3 bg-blue-50 border-b border-blue-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-sm text-blue-700 font-medium" id="selectedCount">0 selected</span>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="bulkApprove()"
                                    class="inline-flex items-center px-3 py-1 border border-transparent shadow-sm text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Approve Selected
                                </button>
                                <button onclick="bulkReject()"
                                    class="inline-flex items-center px-3 py-1 border border-transparent shadow-sm text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Reject Selected
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left">
                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()"
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                                        onclick="sortTable(1)">
                                        No
                                        <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                                        onclick="sortTable(2)">
                                        Test ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                                        onclick="sortTable(3)">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                                        onclick="sortTable(4)">
                                        NIM
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                                        onclick="sortTable(5)">
                                        Registration Date
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                                @forelse($registrations as $index => $registration)
                                    <tr class="hover:bg-gray-50 transition-colors" data-status="{{ $registration->status }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" name="selected_registrations[]"
                                                value="{{ $registration->id }}" onchange="updateBulkActions()"
                                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="font-mono bg-gray-100 px-2 py-1 rounded">
                                                {{ $registration->toeic_test_id ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-gray-600">
                                                            {{ strtoupper(substr($registration->student->user->name ?? 'N', 0, 1)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $registration->student->user->name ?? 'N/A' }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $registration->student->user->email ?? '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="font-mono">{{ $registration->student->NIM ?? 'N/A' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex flex-col">
                                                <span>{{ $registration->created_at->format('d M Y') }}</span>
                                                <span
                                                    class="text-xs text-gray-500">{{ $registration->created_at->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($registration->status == 'active')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Approved
                                                </span>
                                            @elseif($registration->status == 'inactive')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Rejected
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    <svg class="w-3 h-3 mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                            stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center gap-2">
                                                @if($registration->status !== 'active')
                                                    <form action="{{ route('registration.approve', $registration->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" onclick="showApproveModal('{{ $registration->id }}')"
                                                            class="inline-flex items-center px-3 py-1 border border-green-300 shadow-sm text-xs font-medium rounded-md text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Approve
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($registration->status !== 'inactive')
                                                    <form action="{{ route('registration.reject', $registration->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" onclick="showRejectModal('{{ $registration->id }}')"
                                                            class="inline-flex items-center px-3 py-1 border border-red-300 shadow-sm text-xs font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Reject
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('student.show', $registration->student->id) }}">
                                                    <button class="text-gray-400 hover:text-blue-600 transition-colors"
                                                        title="View Details">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="noDataRow">
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <h3 class="text-lg font-medium text-gray-900 mb-1">No registrations found</h3>
                                                <p class="text-gray-500 mb-4">There are no student registrations to display at
                                                    the moment.</p>
                                                <button onclick="refreshData()"
                                                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                        </path>
                                                    </svg>
                                                    Refresh Data
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div id="approveModal"
                        class="fixed inset-0 z-50 hidden bg-gray-900/50 flex justify-center items-center">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Are you sure?</h3>
                            <p class="text-sm text-gray-600 mb-6">This action cannot be undone. Do you want to approve this
                                registration?</p>
                            <div class="flex justify-end space-x-3">
                                <button onclick="closeModal()"
                                    class="px-4 py-2 bg-gray-300 rounded-md text-sm font-medium text-gray-800 hover:bg-gray-400 focus:outline-none">Cancel</button>
                                <button id="confirmApproveButton"
                                    class="px-4 py-2 bg-green-600 rounded-md text-sm font-medium text-white hover:bg-green-700 focus:outline-none"
                                    onclick="approveRegistration()">Confirm</button>
                            </div>
                        </div>
                    </div>
                    <!-- Reject Confirmation Modal -->
                    <div id="rejectModal" class="fixed inset-0 z-50 hidden bg-gray-900/50 flex justify-center items-center">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Are you sure?</h3>
                            <p class="text-sm text-gray-600 mb-6">This action cannot be undone. Do you want to reject this
                                registration?</p>
                            <div class="flex justify-end space-x-3">
                                <button onclick="closeRejectModal()"
                                    class="px-4 py-2 bg-gray-300 rounded-md text-sm font-medium text-gray-800 hover:bg-gray-400 focus:outline-none">Cancel</button>
                                <button id="confirmRejectButton"
                                    class="px-4 py-2 bg-red-600 rounded-md text-sm font-medium text-white hover:bg-red-700 focus:outline-none"
                                    onclick="rejectRegistration()">Confirm</button>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Pagination -->
                    @if($registrations instanceof \Illuminate\Pagination\Paginator || $registrations instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-500">
                                        Showing {{ $registrations->firstItem() ?? 0 }} to {{ $registrations->lastItem() ?? 0 }}
                                        of
                                        {{ $registrations->total() }} results
                                    </div>
                                    <div>
                                        {{ $registrations->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
    </div>

    <!-- Success or Error Toasts -->
    <div id="toastSuccess" class="fixed bottom-4 left-4 z-20 hidden bg-green-600 text-white px-4 py-2 rounded-lg shadow-md">
        <p>Action successfully completed!</p>
    </div>

    <div id="toastError" class="fixed bottom-4 left-4 z-20 hidden bg-red-600 text-white px-4 py-2 rounded-lg shadow-md">
        <p>Something went wrong, please try again!</p>
    </div>

    <script>
        let rejectButton; // This will store the button that will trigger the reject action

        // Function to handle the reject action after confirmation
        function rejectRegistration() {
            const confirmButton = document.getElementById('confirmRejectButton');

            // Prevent form submission until confirmation
            confirmButton.disabled = true;  // Disable the button to prevent multiple clicks
            confirmButton.innerHTML = 'Processing...'; // Change the button text to "Processing..."

            // Perform the reject action via AJAX after confirmation
            fetch(`/registration/reject/${rejectButton}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Handle success - show success toast and reload the page
                        showToastSuccess();
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        // Show error toast
                        showToastError();
                    }
                })
                .catch(error => {
                    // Show error toast if something goes wrong
                    showToastError();
                })
                .finally(() => {
                    // Re-enable the button after the request is complete
                    confirmButton.disabled = false;
                    confirmButton.innerHTML = 'Confirm';  // Reset button text
                });
        }

        function showApproveModal(registrationId) {
            // Store the registrationId to use for the AJAX request
            window.registrationId = registrationId;
        }

        function approveRegistration() {
            const confirmButton = document.getElementById('confirmApproveButton');

            // Prevent form submission until confirmation
            confirmButton.disabled = true;  // Disable the button to prevent multiple clicks
            confirmButton.innerHTML = 'Processing...'; // Change the button text to "Processing..."

            // Perform the approve action via AJAX after confirmation
            fetch(`/registration/approve/${window.registrationId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Handle success - show success toast and reload the page
                        showToastSuccess();
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        // Show error toast
                        showToastError();
                    }
                })
                .catch(error => {
                    // Show error toast if something goes wrong
                    showToastError();
                })
                .finally(() => {
                    // Re-enable the button after the request is complete
                    confirmButton.disabled = false;
                    confirmButton.innerHTML = 'Confirm';  // Reset button text
                });
        }

        // Function to show success toast
        function showToastSuccess() {
            document.getElementById('toastSuccess').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('toastSuccess').classList.add('hidden');
            }, 3000);
        }

        // Function to show error toast
        function showToastError() {
            document.getElementById('toastError').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('toastError').classList.add('hidden');
            }, 3000);
        }

        // Function to filter the table based on search input
        function filterBySearch() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#tableBody tr');

            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');

                // Assuming columns are ordered like this:
                // Column 2 = Test ID
                // Column 3 = Name
                // Column 4 = NIM
                // Column 5 = Registration Date

                const testId = cells[2].textContent.toLowerCase();
                const name = cells[3].textContent.toLowerCase();  // Assuming Name is in column 3
                const nim = cells[4].textContent.toLowerCase();   // Assuming NIM is in column 4
                const regDate = cells[5].textContent.toLowerCase(); // Assuming Registration Date is in column 5

                // If the search input matches any part of the name, test ID, NIM, or registration date, show the row
                if (testId.includes(searchInput) || name.includes(searchInput) || nim.includes(searchInput) || regDate.includes(searchInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Bind the search input to the filtering function
        document.getElementById('searchInput').addEventListener('input', filterBySearch);

        // Function to filter the table rows by status
        function filterByStatus() {
            const filterValue = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('#tableBody tr');

            rows.forEach(row => {
                const status = row.getAttribute('data-status');  // Assuming status is stored as data-attribute on the row

                // If the row matches the selected filter value, show it, otherwise hide it
                if (!filterValue || status === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Bind the filter dropdown to the filtering function
        document.getElementById('statusFilter').addEventListener('change', filterByStatus);
    </script>

@endsection
