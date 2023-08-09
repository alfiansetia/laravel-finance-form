@extends('components.template')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                            <a href="{{ route('payment.create') }}" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus mr-2"></i>Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($reject > 0)
                            <div class="alert alert-danger" role="alert">
                                Ada <b>{{ $reject }}</b> Payment Request yang di reject!
                            </div>
                        @endif
                        <div class="form-row mb-3">
                            <div class="col-7">
                                <select id="status_filter" class="form-control">
                                    <option value="">All Status</option>
                                    @foreach ($status as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col  col-lg-2">
                                <button type="button" id="btn_filter" class="btn btn-primary btn-block">
                                    <i class="fas fa-filter mr-1"></i>Filter
                                </button>
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
                                                <font color="{{ $item->status->color }}">
                                                    <i class="fas fa-circle"></i>{{ $item->status->name }}
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
                                                    <a href="{{ route('payment.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form id="form{{ $item->id }}"
                                                        action="{{ route('payment.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="deleteData('{{ $item->id }}');"
                                                            class="btn btn-sm btn-danger" title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
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
