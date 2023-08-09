@extends('components.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="range" class="col-sm-3 col-form-label">Range Tanggal</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control @error('from') is-invalid @enderror" id="range"
                            placeholder="YYYY-MM-DD" autocomplete="off">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-block" id="apply">Apply</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($data ?? []) > 0)
                            <div class="table-responsive">
                                <table id="table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 30px;">No. PR</th>
                                            <th class="text-center">PR Voucher</th>
                                            <th class="text-center">Name Beneficiary</th>
                                            <th class="text-center">Bank A/C</th>
                                            <th class="text-center">For</th>
                                            <th class="text-center">Total Price</th>
                                            <th class="text-center">VAT</th>
                                            <th class="text-center">WHT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->no_pr }}</td>
                                                <td>{{ date('d-M-Y', strtotime($item->date_pr)) }}</td>
                                                <td>{{ $item->vendor->beneficary }}</td>
                                                <td>{{ substr($item->vendor->bank, 0, 30) }}</td>
                                                <td>{{ $item->for }}</td>
                                                <td>{{ $item->total }}</td>
                                                <td>{{ $item->vat }}</td>
                                                <td>{{ $item->wht->value ?? 0 }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Data tidak tersedia!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="GET" id="form_get_data">
        <input type="hidden" name="from" id="input_from">
        <input type="hidden" name="to" id="input_to">
    </form>

    @error('from')
        <script>
            alert('from')
        </script>
    @enderror

    @error('to')
        <script>
            alert('from')
        </script>
    @enderror
@endsection

@push('js')
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            if ($("#range").length) {
                $('#range').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                    maxSpan: {
                        days: 31
                    },
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                        'Last 31 Days': [moment().subtract(30, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment()],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                                'month')
                            .endOf('month')
                        ],
                    },
                    showDropdowns: true,
                    startDate: "{{ request('from') ?: now()->startOfMonth() }}",
                    endDate: "{{ request('to') ?: now() }}",
                    maxDate: moment(),
                });
            }

            $('#apply').click(function() {
                let from = $('#range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                let to = $('#range').data('daterangepicker').endDate.format('YYYY-MM-DD');

                $('#input_from').val(from)
                $('#input_to').val(to)
                $('#form_get_data').submit()
            })

            if ($("#table").length) {
                $("#table").DataTable({
                    paging: false,
                    lengthChange: false,
                    searching: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    responsive: true,
                    // order: [[1, 'asc']],
                    buttons: ["csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('.col-md-6:eq(0)');

            }

        })
    </script>
@endpush
