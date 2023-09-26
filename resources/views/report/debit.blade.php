@extends('components.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('from') is-invalid @enderror" id="range"
                            placeholder="YYYY-MM-DD" autocomplete="off">
                    </div>
                    <div class="col-sm-4">
                        <select id="status" class="form-control">
                            <option {{ request('status') == 'paid' ? 'selected' : '' }} value="paid">Paid</option>
                            <option {{ request('status') == 'unpaid' ? 'selected' : '' }} value="unpaid">Unpaid</option>
                        </select>
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
                                            <th class="text-center">No. DN</th>
                                            <th class="text-center">Debit Note Date</th>
                                            <th class="text-center">Received From</th>
                                            <th class="text-center">For</th>
                                            <th class="text-center">Total Price</th>
                                            <th class="text-center">VAT</th>
                                            <th class="text-center">WHT</th>
                                            <th class="text-center">Tax Invoice Serial No</th>
                                            <th class="text-center">Tax Invoice Date</th>
                                            <th class="text-center">WHT No</th>
                                            <th class="text-center">WHT Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            @php
                                                $vat_value = 0;
                                                $wht_value = 0;
                                                $total = 0;
                                                $grand_total = 0;
                                                if ($item->vat > 0) {
                                                    $vat_value = ($item->totalreg * $item->vat) / 100;
                                                }
                                                if ($item->wht) {
                                                    $wht_value = ($item->totalreg * $item->wht->value) / 100;
                                                }
                                                $total = $item->total + $vat_value - $wht_value;
                                                $grand_total = $item->total + $item->bank_charge + $vat_value - $wht_value;
                                            @endphp

                                            <tr>
                                                <td class="text-center">{{ $item->no_debit_note }}</td>
                                                <td class="text-center">
                                                    {{ date('d-M-Y', strtotime($item->debit_note_date)) }}</td>
                                                <td class="text-center">{{ $item->received_from }}</td>
                                                <td class="text-center">{{ $item->for }}</td>
                                                <td class="text-center">
                                                    {{ $grand_total > 0 ? number_format($grand_total, 0, ',', ',') : 0 }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $vat_value > 0 ? number_format($vat_value, 0, ',', ',') : 0 }}</td>
                                                <td class="text-center">
                                                    {{ $wht_value > 0 ? number_format($wht_value, 0, ',', ',') : 0 }}</td>
                                                <td class="text-center">{{ $item->tax_invoice_serial_no }}</td>
                                                <td class="text-center">
                                                    {{ date('d-M-Y', strtotime($item->tax_invoice_date)) }}</td>
                                                <td class="text-center">{{ $item->wht_no }}</td>
                                                <td class="text-center">{{ date('d-M-Y', strtotime($item->wht_date)) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Data not Found!</strong>
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
        <input type="hidden" name="status" id="input_status">
    </form>

    @error('from')
        <script>
            alert('from')
        </script>
    @enderror

    @error('to')
        <script>
            alert('to')
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

    @php
        $fromDate = request('from') ?? now()->startOfMonth();
        $toDate = request('to') ?? now();
        $formattedFromDate = \Carbon\Carbon::parse($fromDate)->format('Y-m-d');
        $formattedToDate = \Carbon\Carbon::parse($toDate)->format('Y-m-d');
    @endphp
    <script>
        $(document).ready(function() {

            document.title =
                "{{ $title }} {{ $formattedFromDate }} - {{ $formattedToDate }}"

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
                let status = $('#status').val();

                $('#input_from').val(from)
                $('#input_to').val(to)
                $('#input_status').val(status)
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
                    buttons: ["csv", "excel", {
                        extend: 'pdf',
                        orientation: 'landscape',
                        title: `Report Debit Note
                                    {{ $formattedFromDate }} - {{ $formattedToDate }}`,
                        pageSize: 'A4',
                        customize: function(doc) {
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split(
                                    '');
                            doc.styles.tableBodyEven.alignment = 'center';
                            doc.styles.tableBodyOdd.alignment = 'center';
                            doc.defaultStyle.fontSize = 8
                            doc.styles.tableHeader.fillColor = '#ffffff';
                            doc.styles.tableHeader.color = '#000000';

                        },
                    }, {
                        extend: "print",
                        text: 'Print',
                        title: '',
                        customize: function(doc) {
                            doc.defaultStyle.fontSize = 8
                        },
                        messageTop: function() {
                            return `Report Debit Note
                                    {{ $formattedFromDate }} - {{ $formattedToDate }}`
                        },
                    }]
                }).buttons().container().appendTo('.col-md-6:eq(0)');

            }

        })
    </script>
@endpush
