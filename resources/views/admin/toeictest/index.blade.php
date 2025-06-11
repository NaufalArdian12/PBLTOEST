@extends('layouts.admin.admin')

@section('title', 'Toeic Test Management')
@section('header', 'Manage TOEIC Tests')

@section('content')
    <div class="flex h-screen bg-gray-100">
        <div class="flex-1 overflow-auto">
            <div class="p-5">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Manage TOEIC Tests</h1>
                        <p class="mt-1 text-sm text-gray-600">Create, view, and manage TOEIC tests for students</p>
                    </div>
                </div>

                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <!-- Add New Button -->
                        <a href="{{ route('toeic.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add New Toeic Test
                        </a>

                        <!-- Bulk Actions -->
                        <div class="relative">
                            <button type="button" id="bulkActionBtn"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                                disabled>
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Bulk Delete (<span id="selectedCount">0</span>)
                            </button>
                        </div>
                    </div>

                    <!-- Filter and Search -->
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <!-- toeic Filter -->
                        <select id="toeicFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm">
                            <option value="">All Test</option>
                            @foreach($toeicTests as $test)
                                <option value="{{ $test->id }}">{{ $test->id }}</option>
                            @endforeach
                        </select>

                        <!-- Search Input -->
                        <div class="relative">
                            <input type="text" placeholder="Search Test..." id="searchtest"
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm min-w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <!-- Clear Search Button -->
                            <button type="button" id="clearSearch" class="absolute inset-y-0 right-0 pr-3 hidden items-center">
                                <svg class="h-4 w-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- TOEIC Test Table -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-medium text-gray-900">Toeic Tests</h2>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Test Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zoom Link</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Max Participants</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($toeicTests as $index => $toeicTest)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $toeicTest->date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <a href="{{ $toeicTest->zoom_link }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Zoom Link</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $toeicTest->max_participants }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $toeicTest->admin->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center space-x-3">
                                                <!-- View Button -->
                                                <a href="{{ route('toeic.show', $toeicTest->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150"
                                                    title="View Details">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>

                                                <!-- Edit Button -->
                                                <a href="{{route('toeic.edit', $toeicTest->id)}}"
                                                    class="text-yellow-600 hover:text-yellow-900 transition-colors duration-150"
                                                    title="Edit">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>

                                                <!-- Delete Button -->
                                                <button type="button"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-150 delete-btn"
                                                    title="Delete" data-id="{{ $toeicTest->id }}"
                                                    data-name="{{ $toeicTest->date }}">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600/50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Confirm Delete</h3>
            </div>
            <div class="px-6 py-4">
                <p class="text-sm text-gray-600 mb-4">
                    Are you sure you want to delete "<span id="deleteItemName" class="font-semibold"></span>"?
                    This action cannot be undone.
                </p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" id="cancelDelete"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
     document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const searchInput = document.getElementById('searchstudyprogram');
    const clearSearchBtn = document.getElementById('clearSearch');
    const campusFilter = document.getElementById('campusFilter');
    const tableBody = document.getElementById('studyProgramTableBody');
    const noResultsMessage = document.getElementById('noResultsMessage');
    const visibleCountSpan = document.getElementById('visibleCount');
    const selectAllCheckbox = document.getElementById('selectAll');
    const selectAllHeaderCheckbox = document.getElementById('selectAllHeader');
    const bulkActionBtn = document.getElementById('bulkActionBtn');
    const selectedCountSpan = document.getElementById('selectedCount');
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const deleteItemName = document.getElementById('deleteItemName');
    const cancelDeleteBtn = document.getElementById('cancelDelete');

    let currentDeleteId = null;

    // Search functionality
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCampus = campusFilter.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr');
        let visibleCount = 0;

        rows.forEach(row => {
            if (row.children.length === 1) return; // Skip empty state row

            const text = row.textContent.toLowerCase();
            const campus = row.dataset.campus?.toLowerCase() || '';

            const matchesSearch = searchTerm === '' || text.includes(searchTerm);
            const matchesCampus = selectedCampus === '' || campus.includes(selectedCampus);

            if (matchesSearch && matchesCampus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update visible count
        visibleCountSpan.textContent = visibleCount;

        // Show/hide no results message
        const hasVisibleRows = visibleCount > 0;
        noResultsMessage.classList.toggle('hidden', hasVisibleRows);

        // Show/hide clear search button
        clearSearchBtn.classList.toggle('hidden', searchTerm === '');
        clearSearchBtn.classList.toggle('flex', searchTerm !== '');
    }

    // Event listeners for search and filter
    searchInput.addEventListener('input', performSearch);
    campusFilter.addEventListener('change', performSearch);

    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        performSearch();
        searchInput.focus();
    });

    // Checkbox functionality
    function updateBulkActions() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');

        selectedCountSpan.textContent = checkedBoxes.length;
        bulkActionBtn.disabled = checkedBoxes.length === 0;

        // Update select all checkboxes
        const allChecked = checkboxes.length > 0 && checkedBoxes.length === checkboxes.length;
        const someChecked = checkedBoxes.length > 0;

        selectAllCheckbox.checked = allChecked;
        selectAllHeaderCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = someChecked && !allChecked;
        selectAllHeaderCheckbox.indeterminate = someChecked && !allChecked;
    }

    // Select all functionality
    function toggleAllCheckboxes(checked) {
        const visibleCheckboxes = Array.from(document.querySelectorAll('.row-checkbox'))
            .filter(cb => cb.closest('tr').style.display !== 'none');

        visibleCheckboxes.forEach(cb => cb.checked = checked);
        updateBulkActions();
    }

    selectAllCheckbox.addEventListener('change', (e) => toggleAllCheckboxes(e.target.checked));
    selectAllHeaderCheckbox.addEventListener('change', (e) => toggleAllCheckboxes(e.target.checked));

    // Individual checkbox change
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('row-checkbox')) {
            updateBulkActions();
        }
    });

    // Delete functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            const btn = e.target.closest('.delete-btn');
            const id = btn.dataset.id;
            const name = btn.dataset.name;

            currentDeleteId = id;
            deleteItemName.textContent = name;
            deleteForm.action = `/studyprogram/${id}`;
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        }
    });

    // Cancel delete
    cancelDeleteBtn.addEventListener('click', function() {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
        currentDeleteId = null;
    });

    // Close modal on outside click
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            cancelDeleteBtn.click();
        }
    });

    // Bulk delete functionality
    bulkActionBtn.addEventListener('click', function() {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        const names = Array.from(checkedBoxes).map(cb => cb.dataset.name);

        if (confirm(`Are you sure you want to delete ${checkedBoxes.length} study program(s)?\n\n${names.join('\n')}\n\nThis action cannot be undone.`)) {
            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            // Create and submit bulk delete form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            ids.forEach(id => {
                const idField = document.createElement('input');
                idField.type = 'hidden';
                idField.name = 'ids[]';
                idField.value = id;
                form.appendChild(idField);
            });

            document.body.appendChild(form);
            form.submit();
        }
    });

    // Sort functionality
    let sortDirection = 'asc';
    let currentSortField = null;

    function sortTable(field, columnIndex) {
        const rows = Array.from(tableBody.querySelectorAll('tr')).filter(row => row.children.length > 1);

        // Toggle sort direction
        if (currentSortField === field) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortDirection = 'asc';
            currentSortField = field;
        }

        rows.sort((a, b) => {
            let aVal = a.children[columnIndex].textContent.trim().toLowerCase();
            let bVal = b.children[columnIndex].textContent.trim().toLowerCase();

            if (sortDirection === 'asc') {
                return aVal.localeCompare(bVal);
            } else {
                return bVal.localeCompare(aVal);
            }
        });

        // Clear table body and append sorted rows
        tableBody.innerHTML = '';
        rows.forEach(row => tableBody.appendChild(row));

        // Update sort indicators
        document.querySelectorAll('[id^="sortBy"]').forEach(btn => {
            const svg = btn.querySelector('svg');
            svg.classList.remove('text-blue-500');
            svg.classList.add('text-gray-400');
        });

        const currentSortBtn = document.getElementById(`sortBy${field}`);
        if (currentSortBtn) {
            const svg = currentSortBtn.querySelector('svg');
            svg.classList.remove('text-gray-400');
            svg.classList.add('text-blue-500');

            // Rotate arrow based on direction
            if (sortDirection === 'desc') {
                svg.style.transform = 'rotate(180deg)';
            } else {
                svg.style.transform = 'rotate(0deg)';
            }
        }
    }

    // Sort event listeners
    document.getElementById('sortByName')?.addEventListener('click', () => sortTable('Name', 2));
    document.getElementById('sortByCampus')?.addEventListener('click', () => sortTable('Campus', 4));

    // Initialize
    updateBulkActions();
    performSearch();

    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('[class*="bg-green-50"], [class*="bg-red-50"]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
            searchInput.select();
        }

        // Escape to clear search or close modal
        if (e.key === 'Escape') {
            if (!deleteModal.classList.contains('hidden')) {
                cancelDeleteBtn.click();
            } else if (searchInput.value) {
                clearSearchBtn.click();
            }
        }

        // Ctrl/Cmd + A to select all visible
        if ((e.ctrlKey || e.metaKey) && e.key === 'a' && e.target === document.body) {
            e.preventDefault();
            toggleAllCheckboxes(true);
        }
    });

    // Tooltip functionality for truncated text
    document.querySelectorAll('[title]').forEach(element => {
        element.addEventListener('mouseenter', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'absolute z-50 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg';
            tooltip.textContent = this.getAttribute('title');
            tooltip.style.top = this.getBoundingClientRect().bottom + 5 + 'px';
            tooltip.style.left = this.getBoundingClientRect().left + 'px';
            document.body.appendChild(tooltip);

            this.addEventListener('mouseleave', function() {
                tooltip.remove();
            }, { once: true });
        });
    });

    // Loading states for buttons
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                `;
            }
        });
    });

});


    </script>
@endsection
