@extends('components.template')

@push('css')
    <style>
        .track-line {
            height: 4px !important;
            background-color: #488978;
            opacity: 1;
        }

        .dot {
            height: 20px;
            width: 20px;
            margin-left: 3px;
            margin-right: 3px;
            margin-top: 0px;
            background-color: #488978;
            border-radius: 50%;
            display: inline-block
        }

        .big-dot {
            height: 25px;
            width: 25px;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
            background-color: #488978;
            border-radius: 50%;
            display: inline-block;
        }

        .big-dot i {
            font-size: 12px;
        }

        .card-stepper {
            z-index: 0
        }
    </style>
@endpush

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                            @if (auth()->user()->role != 'supervisor')
                                <a href="{{ route('payment.create') }}" class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-plus mr-2"></i>Add
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($reject > 0)
                            <div class="alert alert-danger" role="alert">
                                There are <b>{{ $reject }}</b> Payment Requests that were rejected!
                            </div>
                        @endif
                        <div class="form-row mb-3">

                            <div class="card-body p-4">

                                <div
                                    class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line"><span class="dot"></span>
                                    <hr class="flex-fill track-line"><span class="dot"></span>
                                    <hr class="flex-fill track-line"><span
                                        class="d-flex justify-content-center align-items-center big-dot dot">
                                        <i class="fa fa-check text-white"></i></span>
                                </div>

                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Pending</span>
                                        <button class="btn btn-info btn-sm mt-1" id="btn1">Pending</button>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <span>Processing</span>
                                        <button class="btn btn-warning btn-sm mt-1" id="btn2">Processing</button>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <span>Reject</span>
                                        <button class="btn btn-danger btn-sm mt-1" id="btn3">Reject</button>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <span>Paid</span>
                                        <button class="btn btn-success btn-sm mt-1" id="btn4">Paid</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 30px;">No.</th>
                                        <th class="text-center">Division</th>
                                        <th class="text-center">PR Voucher Date</th>
                                        <th class="text-center">No PR Voucher</th>
                                        <th class="text-center">Name Beneficiary</th>
                                        <th class="text-center">Bank A/C</th>
                                        <th class="text-center">For</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td class="text-center"> {{ $key + 1 }} </td>
                                            <td class="text-center">{{ $item->division->name }}</td>
                                            <td class="text-center">{{ date('d-M-Y', strtotime($item->date_pr)) }}</td>
                                            <td class="text-center">{{ $item->no_pr }}</td>
                                            <td class="text-center">{{ $item->vendor->beneficary }}</td>
                                            <td class="text-center">{{ substr($item->vendor->bank, 0, 30) }}</td>
                                            <td class="text-center">{{ $item->for }}</td>
                                            <td class="text-center">
                                                <font color="{{ $item->status->color }}">{{ $item->status->name }}
                                                </font>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @if ($item->status_id == 4)
                                                        <a href="{{ route('payment.download', $item->id) }}"
                                                            class="btn btn-sm btn-secondary" title="Download"
                                                            target="_blank"><i class="fas fa-file-pdf"></i></a>
                                                    @endif
                                                    <a href="{{ route('payment.show', $item->id) }}"
                                                        class="btn btn-sm btn-info" title="Detail"><i
                                                            class="fas fa-eye"></i></a>

                                                    @if (auth()->user()->role == 'admin')
                                                        @if ($item->status_id != 4)
                                                            <a href="{{ route('payment.edit', $item->id) }}"
                                                                class="btn btn-sm btn-warning" title="Edit"><i
                                                                    class="fas fa-edit"></i></a>
                                                        @endif
                                                        @if ($item->status_id != 2)
                                                            <form id="form{{ $item->id }}"
                                                                action="{{ route('payment.destroy', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    onclick="deleteData('{{ $item->id }}');"
                                                                    class="btn btn-sm btn-danger" title="Delete">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif

                                                    @if (auth()->user()->role == 'user')
                                                        @if ($item->status_id != 4)
                                                            <a href="{{ route('payment.edit', $item->id) }}"
                                                                class="btn btn-sm btn-warning" title="Edit"><i
                                                                    class="fas fa-edit"></i></a>
                                                        @endif
                                                        @if ($item->status_id == 3)
                                                            <form id="form{{ $item->id }}"
                                                                action="{{ route('payment.destroy', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    onclick="deleteData('{{ $item->id }}');"
                                                                    class="btn btn-sm btn-danger" title="Delete">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
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
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": [8]
                    },
                    {
                        "searchable": false,
                        "targets": [8]
                    },
                ]
            });

            $('#btn_filter').click(function() {
                var selectedStatus = $('#status_filter').val();
                table.column(7).search(selectedStatus).draw();
            });

            $('#btn1').click(function() {
                table.column(7).search('Pending Approval').draw();
            });

            $('#btn2').click(function() {
                table.column(7).search('Processing').draw();
            });

            $('#btn3').click(function() {
                table.column(7).search('Reject').draw();
            });

            $('#btn4').click(function() {
                table.column(7).search('Paid').draw();
            });


        });

        function deleteData(idform) {
            swal({
                title: 'Delete Data?',
                icon: "warning",
                buttons: {
                    confirm: {
                        text: 'Yes',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((value) => {
                if (value) {
                    $('#form' + idform).submit();
                } else {
                    swal.close();
                }
            });
        }
    </script>
@endpush
