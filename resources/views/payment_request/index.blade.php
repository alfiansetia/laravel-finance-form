@extends('components.template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Payment Request</h4>
                        <a href="{{ route('add_payment_request') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-plus mr-2"></i>Add
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Division</th>
                                    <th class="text-center">PR Voucher Date</th>
                                    <th class="text-center">No PR Voucher</th>
                                    <th class="text-center">Name Beneficiary</th>
                                    <th class="text-center">Bank A/C</th>
                                    <th class="text-center">Bank</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td class="text-center"> {{ $key + 1 }} </td>
                                        <td class="text-center">{{ $item->division->name }}</td>
                                        <td class="text-center"> {{ date('d-M-Y', strtotime($item->date_pr)) }} </td>
                                        <td class="text-center">{{ $item->no_pr }}</td>
                                        <td class="text-center">{{ $item->name_beneficiary }}</td>
                                        <td class="text-center">{{ $item->bank_account }}</td>
                                        <td class="text-center">{{ $item->beneficiary_bank }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('print_payment_request', $item->id) }}"
                                                    class="btn btn-sm btn-secondary" title="Download"><i
                                                        class="fas fa-file-pdf"></i></a>
                                                <a href="{{ route('print_payment_request', $item->id) }}"
                                                    class="btn btn-sm btn-info" title="Detail" target="_blank"><i
                                                        class="fas fa-eye"></i></a>
                                                <a href="{{ route('edit_payment_request', $item->id) }}"
                                                    class="btn btn-sm btn-warning" title="Edit"><i
                                                        class="fas fa-edit"></i></a>
                                                <form action="{{ route('delete_payment_request', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Delete Data?')" class="btn btn-sm btn-danger" title="Delete">
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
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": [7]
                    },
                    {
                        "searchable": false,
                        "targets": [7]
                    },
                ]
            });
        });
    </script>
@endpush
