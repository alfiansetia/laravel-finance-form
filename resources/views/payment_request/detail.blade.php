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
                            <h4 class="card-title">Action</h4>
                        </div>
                    </div>
                    <div class="card-body text-center">

                        @if ($data->status_id == 1)
                            <button class="btn btn-warning btn-round" onclick="processed()">
                                <i class="fas fa-thumbs-up mr-1"></i>PR will be processed</button>
                        @endif

                        @if ($data->status_id == 2 && $data->status_id != 4)
                            <button id="set_paid" class="btn btn-success btn-round" data-toggle="modal"
                                data-target="#exampleModal3">
                                <i class="fas fa-thumbs-up mr-1"></i>Set Paid</button>
                        @endif

                        @if ($data->status_id == 4)
                            <a href="{{ route('payment.download', $data->id) }}" class="btn btn-primary btn-round ml-2"
                                target="_blank">
                                <i class="fas fa-file-pdf mr-1"></i>Download
                            </a>
                        @endif
                        @if ($data->status_id != 4)
                            <a href="{{ route('payment.edit', $data->id) }}" class="btn btn-secondary btn-round ml-2">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            {{-- <button type="button" class="btn btn-info btn-round ml-2" data-toggle="modal"
                                data-target="#exampleModal2">
                                <i class="fas fa-upload mr-1"></i>Upload File
                            </button> --}}
                        @endif
                    </div>
                </div>

                @if (!empty($data->note))
                    <div class="alert alert-danger" role="alert">
                        {{ $data->note }}
                    </div>
                @endif

                {{-- <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">File</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" style="width: 100%;">
                            <tbody>
                                @forelse ($data->filepr as $item)
                                    <tr>
                                        <td style="width: 40px;"><i class="fas fa-file-pdf text-danger"></i></td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('filepr.show', $item->id) }}" target="_blank">
                                                    <i class="fas fa-download text-primary"></i>
                                                </a>
                                                    <form id="form{{ $item->id }}" method="POST"
                                                        action="{{ route('filepr.destroy', $item->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <i class="fas fa-trash-alt text-danger ml-2"
                                                            onclick="deleteData('{{ $item->id }}')"
                                                            style="cursor: pointer;"></i>
                                                    </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger" role="alert">
                                        File belum tersedia!
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> --}}

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">
                                Detail {{ $title }} {{ $data->no_pr }} <span class="badge ml-2"
                                    style="background-color: {{ $data->status->color }};">
                                    <font color="white"><i class="fas fa-circle mr-1"></i>{{ $data->status->name }}</font>
                                </span>
                            </h4>
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


    {{-- <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('filepr.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment" id="payment" value="{{ $data->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModal2Label">Upload File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">File</label>
                            <div class="custom-file">
                                <input name="file" type="file" id="file" required
                                    class="custom-file-input @error('file') is-invalid @enderror">
                                <label class="custom-file-label" for="file">Choose file</label>
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}



    @if ($data->status_id == 2 && $data->status_id != 4)
        <form method="POST" action="{{ route('payment.set.paid', $data->id) }}">
            @csrf
            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModal3Label">Change Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Paid Date</label>
                                <input type="date" class="form-control" name="date" id="" required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" name="note" id="note" rows="3" maxlength="150">{{ $data->note }}</textarea>
                            </div> --}}
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

    <form id="form_set_paid" action="{{ route('payment.set.paid', $data->id) }}" method="POST">
        @csrf
    </form>

    <form id="form_set_processed" action="{{ route('payment.status', $data->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="2">
    </form>
@endsection
@push('js')
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        bsCustomFileInput.init();

        // $('#set_paid').click(function() {
        //     swal({
        //         title: 'Set Paid?',
        //         icon: "warning",
        //         buttons: {
        //             confirm: {
        //                 text: 'Yes',
        //                 className: 'btn btn-success'
        //             },
        //             cancel: {
        //                 visible: true,
        //                 className: 'btn btn-danger'
        //             }
        //         }
        //     }).then((value) => {
        //         if (value) {
        //             $('#form_set_paid').submit();
        //         } else {
        //             swal.close();
        //         }
        //     });
        // })
        function processed(idform) {
            swal({
                title: 'Processed Data?',
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
                    $('#form_set_processed').submit();
                } else {
                    swal.close();
                }
            });
        }

        function deleteData(idform) {
            swal({
                title: 'Delete File?',
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

    @if ($errors->has('file'))
        <script>
            $(document).ready(function() {
                $('#exampleModal2').modal('show');
            });
        </script>
    @endif

@endpush
