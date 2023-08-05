@extends('components.template')
@push('css')
    <style>
        .bold-right {
            text-align: right;
        }

        .bold-no-border {
            /* width: 46.25pt; */
            border-top: none;
            border-bottom: none;
            border-left: 1pt solid black;
            border-image: initial;
            border-right: 1pt solid black;
            padding: 0mm;
            height: 12.6pt;
            vertical-align: bottom;
            margin: 0mm;
            font-size: 15px;
            font-family: "Calibri", sans-serif;
            margin-top: 1.15pt;
            text-indent: 5.0pt;
            text-align: right;
            /* padding-right: 8pt; */
        }

        .bold-border {
            /* width: 76.05pt; */
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid black;
            border-right: 1pt solid black;
            padding: 0mm;
            height: 12.6pt;
            vertical-align: bottom;
            margin: 0mm;
            font-size: 15px;
            font-family: "Calibri", sans-serif;
            margin-top: 1.15pt;
            margin-right: 2.8pt;
            margin-bottom: .0001pt;
            margin-left: 0mm;
            text-align: right;
        }

        .pd-xs {
            white-space: nowrap;
            font-family: "Calibri", sans-serif;
            padding-left: 5pt;
            padding-right: 5pt;
            margin-right: 3pt;
            font-size: 9px;
        }

        .pd-small {
            white-space: nowrap;
            font-family: "Calibri", sans-serif;
            padding-left: 5pt;
            padding-right: 5pt;
            font-size: 10px;
        }

        .pd-big {
            white-space: nowrap;
            font-family: "Calibri", sans-serif;
            padding-left: 5pt;
            padding-right: 5pt;
            font-size: 11px;
        }

        .pd-header {
            white-space: nowrap;
            padding-left: 60px;
            padding-right: 1pt;
            font-size: 19px;
            margin: 0;
            margin-top: 0;
            padding-top: 0;
            font-weight: bold;
            margin-bottom: 15pt;
            margin-right: 5pt;
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
                            <h4 class="card-title">Detail {{ $title }} {{ $data->no_pr }} <span
                                    class="badge badge-info">{{ $data->status }}</span></h4>

                            @if ($data->status != 'paid')
                                <button class="btn btn-warning btn-round ml-auto" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <i class="fas fa-thumbs-up mr-1"></i>State</button>
                            @endif
                            <a href="{{ route('payment.edit', $data->id) }}"
                                class="btn btn-secondary btn-round ml-2 {{ $data->status != 'paid' ? '' : 'ml-auto' }}">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <a href="{{ route('payment.download', $data->id) }}" class="btn btn-primary btn-round ml-2"
                                target="_blank">
                                <i class="fas fa-file-pdf mr-1"></i>Download
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table style="border-collapse:collapse;border:none; margin-left: auto;margin-right: auto;">
                                @include('payment_request.content')
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($data->status != 'paid')
        <form method="POST" action="{{ route('payment.status', $data->id) }}">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <div class="form-inline">
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="radio" name="status" id="status1"
                                            value="pending" {{ $data->status == 'pending' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status1">Pending</label>
                                    </div>
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="radio" name="status" id="status2"
                                            value="processing" {{ $data->status == 'processing' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status2">Processing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status3"
                                            value="paid" {{ $data->status == 'paid' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status3">Paid</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status4"
                                            value="reject" {{ $data->status == 'reject' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status4">Reject</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" name="note" id="note" rows="3" maxlength="150"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection
