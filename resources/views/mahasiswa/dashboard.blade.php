@extends('layouts.app')

@section('content')
    <!-- Kalender CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        .datepicker td, .datepicker th {
            width: 40px;
            height: 40px;
            font-size: 14px;
            text-align: center;
            vertical-align: middle;
            border-radius: 50%;
            transition: all 0.2s ease-in-out;
        }

        .datepicker td:hover {
            background-color: #0d6efd;
            color: white;
            cursor: pointer;
        }

        .datepicker .active,
        .datepicker .active:hover {
            background-color: #0d6efd !important;
            color: white !important;
        }

        .datepicker-inline {
            width: 100%;
        }
    </style>

    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 px-4 py-3 shadow-sm"
            style="background-color: white; color: #333; border-radius: 12px;">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" style="width: 100px;">
                <h4 class="m-0"></h4>
            </div>
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('images/bell-alert.png') }}" alt="Notification" style="width: 20px; height: 20px;">
                <span>Hi, Jupri</span>
                <img src="{{ asset('images/images.jpg') }}" alt="Profile"
                    style="width: 40px; height: 40px; border-radius: 50%;">
            </div>
        </div>

        <!-- Bagian Utama: Jadwal dan Sidebar -->
        <div class="row gx-4">
            <!-- Tabel Jadwal dan Congratulation -->
            <div class="col-md-8">
                <!-- Jadwal -->
                <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
                    <table class="table table-borderless text-center mb-0">
                        <thead class="table-light">
                            <tr style="border-bottom: 1px solid #dee2e6;">
                                <th>Session</th>
                                <th>Class</th>
                                <th>Time</th>
                                <th>Place</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>S1B 1A, 1B</td>
                                <td>Sabtu 12 Januari (07:00-09:00)</td>
                                <td>RT 1, 2, 3</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>S1B 1C, 1D</td>
                                <td>Sabtu 12 Januari (07:00-09:00)</td>
                                <td>RT 1, 2, 3</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>S1B 1E, 1F</td>
                                <td>Sabtu 12 Januari (07:00-09:00)</td>
                                <td>RT 1, 2, 3</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>S1B 1G</td>
                                <td>Sabtu 12 Januari (07:00-09:00)</td>
                                <td>RT 1, 2, 3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Congratulation Section -->
                <div class="card text-center p-5 shadow-sm border border-4 rounded-4">
                    <div class="mb-3">
                        <img src="{{ asset('images/congrat.png') }}" alt="celebration" style="width: 150px;">
                    </div>
                    <h2 class="fw-bold mb-2" style="font-size: 24px;">Congratulation!</h2>
                    <p class="text-muted" style="font-size: 13px;">
                        You have done your Toest test. You can download your certificate below.
                    </p>
                    <a href="{{ route('mahasiswa.sertifikat') }}"
                        class="btn btn-primary mt-2 d-inline-flex align-items-center justify-content-center gap-2"
                        style="padding: 10px 20px;">
                        <img src="{{ asset('images/Frame download.png') }}" alt="Download"
                            style="width: 20px; height: 20px;">
                        <span class="align-middle">Get your certificate</span>
                    </a>
                </div>
            </div>

            <!-- Sidebar Kanan -->
            <div class="col-md-4">
                <!-- Kalender Dinamis -->
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-0">
                        <h5 class="m-0"></h5>
                    </div>
                    <div class="card-body p-3">
                        <div id="datepicker" class="datepicker-inline w-100"></div>
                    </div>
                </div>

                <!-- Reminder -->
                <div class="card mb-3 border-0 shadow-sm rounded-3 p-3">
                    <h5 class="mb-3 fw-semibold d-flex justify-content-between align-items-center">
                        Reminder
                        <img src="{{ asset('images/notification-solid.png') }}" alt="bell" style="width: 24px;">
                    </h5>
                    <div class="card mb-2 border-0 shadow-sm rounded-3 p-3">
                        <strong>Lorem</strong>
                        <div class="text-muted small">Overdue at: Sunday | 29-09-2024</div>
                    </div>
                    <div class="card mb-2 border-0 shadow-sm rounded-3 p-3">
                        <strong>Ipsum</strong>
                        <div class="text-muted small">Overdue at: Sunday | 30-09-2024</div>
                    </div>
                </div>

                <!-- Another Test -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <p class="fw-semibold">Want to do another test?</p>
                        <p class="text-muted mb-2" style="font-size: 14px;">You can click link below for other test</p>
                        <a href="#" class="btn btn-link p-0 fst-italic">Get in touch</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kalender JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#datepicker').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                todayHighlight: true,
                language: 'id',
                inline: true
            });
        });
    </script>
@endsection
