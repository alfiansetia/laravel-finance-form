@extends('components.template')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                    {{-- <h5 class="text-white op-7 mb-2">Free Bootstrap 4 Admin Dashboard</h5> --}}
                </div>
                {{-- <div class="ml-md-auto py-2 py-md-0">
                    <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
                    <a href="#" class="btn btn-secondary btn-round">Add Customer</a>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Overall statistics</div>
                        <div class="card-category">Statistics this Month</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-1"></div>
                                <h6 class="fw-bold mt-3 mb-0">Payment Request</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-2"></div>
                                <h6 class="fw-bold mt-3 mb-0">Debit Note</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Statistics this year</div>
                        <div class="row py-3">
                            <div class="col-md-12">
                                <div id="chart-container">
                                    <canvas id="totalIncomeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <script>
        Circles.create({
            id: 'circles-1',
            radius: 45,
            value: "{{ $data['payment_month'] }}",
            maxValue: "{{ $data['debit_all'] }}" + "{{ $data['payment_all'] }}",
            width: 7,
            text: "{{ $data['payment_month'] }}",
            colors: ['#f1f1f1', '#FF9E27'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        Circles.create({
            id: 'circles-2',
            radius: 45,
            value: "{{ $data['debit_month'] }}",
            maxValue: "{{ $data['debit_all'] }}" + "{{ $data['payment_all'] }}",
            width: 7,
            text: "{{ $data['debit_month'] }}",
            colors: ['#f1f1f1', '#2BB930'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

        var mytotalIncomeChart = new Chart(totalIncomeChart, {
            type: 'bar',
            data: {
                labels: @json($data['label']),
                datasets: [{
                    label: "Payment Request",
                    backgroundColor: '#ff9e27',
                    borderColor: 'rgb(23, 125, 255)',
                    data: @json($data['payment']['value']),
                }, {
                    label: "Debit Note",
                    backgroundColor: '#AAFF00',
                    borderColor: 'rgb(170, 255, 0)',
                    data: @json($data['debit']['value']),
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            drawBorder: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false
                        }
                    }]
                },
            }
        });
    </script>
@endpush
