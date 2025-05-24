@extends('layouts.app') 

@section('content')
<div class="container mx-auto p-4">
    {{-- Breadcrumb --}}
    <div class="text-sm text-gray-600 mb-4">
        @foreach ($breadcrumb->list as $item)
            {{ $loop->first ? '' : ' / ' }}<span>{{ $item }}</span>
        @endforeach
    </div>

    {{-- Title --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $page->title }}</h1>
    </div>

    {{-- Filter by Study Program --}}
    <div class="mb-4">
        <label for="filter_study_program" class="block mb-1 text-gray-700">Filter by Study Program:</label>
        <select id="filter_study_program" class="w-full md:w-1/3 p-2 border rounded">
            <option value="">-- All Study Programs --</option>
            @foreach ($study_program as $sp)
                <option value="{{ $sp->study_program_id }}">{{ $sp->study_program_name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Button Tambah --}}
    <div class="mb-4">
        <button onclick="modalAction('{{ url('/major/create_ajax') }}')" 
                class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">
            + Add New Major
        </button>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow-md rounded overflow-x-auto">
        <table id="datatable" class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Major Name</th>
                    <th class="px-4 py-2 text-left">Study Program</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

{{-- Modal --}}
<div id="modal" class="fixed z-50 inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div id="modal-content" class="bg-white rounded shadow-md p-6 w-full max-w-2xl">
        <button onclick="closeModal()" class="text-red-500 float-right mb-4">✖ Close</button>
        <div id="modal-body"></div>
    </div>
</div>
@endsection

@push('scripts')
{{-- DataTables CDN --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("/major/list") }}',
                data: function (d) {
                    d.study_program_id = $('#filter_study_program').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'major_name', name: 'major_name' },
                { data: 'study_program', name: 'study_program' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#filter_study_program').on('change', function () {
            table.ajax.reload();
        });
    });

    function modalAction(url) {
        $('#modal').removeClass('hidden').addClass('flex');
        $('#modal-body').html('<p>Loading...</p>');
        $.get(url, function (data) {
            $('#modal-body').html(data);
        });
    }

    function closeModal() {
        $('#modal').addClass('hidden').removeClass('flex');
        $('#modal-body').html('');
    }
</script>
@endpush
