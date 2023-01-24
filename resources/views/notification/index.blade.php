@extends('layouts.app')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <h5 class="card-title"> {{ $title ?? 'Laravel Project' }} </h5>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                    @if(count($datatable) > 0)
                                        <a href="#remove" data-toggle="confirm-remove" data-address="{{ url('notification/delete-all/') }}" type="button" class="btn btn-light-danger btn-sm ml-3">Clear All Notifications </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary d-flex align-items-center p-5 mb-3">
                                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                                    <i class="bi bi-question-circle fs-2hx text-primary"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <span class="fs-6">Hanya menampilkan 500 notifikasi terbaru </span>
                                </div>
                            </div>
                            <table id="kt_datatable" class="table table-striped table-row-bordered gy-5 gs-7 border rounded" >
                                <thead style="display:none">
                                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                        <th style="max-width:5px;">No</th>
                                        <th >Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;?>
                                    @foreach ($datatable as $row)
                                        <tr>
                                            <td style="display:none">{{ $no }}</td>
                                            <td>
                                                <a href="{{ url('notification/view/' . $row->id) }}" style="text-decoration:none;">
                                                    <div class="d-flex flex-stack py-4 ">
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-4 position-relative">
                                                                <span class="symbol-label bg-light-{{ $row->type }}">
                                                                    <span class="svg-icon svg-icon-2 svg-icon-{{ $row->type }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"/>
                                                                            <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"/>
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                                {!! $row->is_seen == 0 ? '<span class="bullet bullet-dot bg-danger h-8px w-8px position-absolute translate-middle top-0 start-100 animation-blink-nonactive"></span>' : '' !!}
                                                            </div>
                                                            <div class="mb-0 me-2">
                                                                <div class="fs-6 text-gray-800 text-hover-{{ $row->type }} fw-bolder">{{ $row->title }}</div>
                                                                <div class="text-gray-400 fs-7">{{ $row->message }}</div>
                                                                <span class="badge badge-light mt-1 ">{{ $row->created_at }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a> 
                                            </td>
                                        </tr>
                                        <?php $no++;?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptcss')
    <link href="{{ asset('src/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scriptjs')
    <script src="{{ asset('src/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $("#kt_datatable").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom":
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
            });
    </script>
@endsection
