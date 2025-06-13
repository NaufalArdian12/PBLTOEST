@extends('layouts.admin.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">TOEIC Test Details</h2>
                <span
                    class="px-3 py-1 bg-{{ $toeicTests->status_color }}-100 text-{{ $toeicTests->status_color }}-800 rounded-full text-sm">
                    {{ strtoupper($toeicTests->status) }}
                </span>
            </div>

            <!-- Test Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Basic Information</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Date:</span> {{ $toeicTests->date }}</p>
                        <p><span class="font-medium">Time:</span> {{ $toeicTests->date}}</p>
                        <p><span class="font-medium">Max Participants:</span> {{ $toeicTests->max_participants }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Zoom Information</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Meeting ID:</span> {{ $toeicTests->zoom_link }}</p>
                        <a href="{{ $toeicTests->zoom_link }}" target="_blank"
                            class="inline-flex items-center text-blue-600 hover:underline">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Join Zoom Meeting
                        </a>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="flex justify-end">
                <a href="{{ route('toeic.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 mr-2">
                    Back to List
                </a>

                <!-- Edit Button -->
                <a href="{{ route('toeic.edit', $toeicTests->id) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Edit Test
                </a>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @push('modals')
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-6 max-w-md w-full">
                <h3 class="text-lg font-medium mb-4">Confirm Deletion</h3>
                <p class="mb-6">Are you sure you want to delete this test? All participant data will be permanently removed.</p>
                <div class="flex justify-end space-x-3">
                    <button onclick="closeModal()" class="btn-gray">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-red">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            function confirmDelete(id) {
                document.getElementById('deleteForm').action = `/admin/toeic/${id}`;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('deleteModal').classList.add('hidden');
            }
        </script>
    @endpush
@endsection
