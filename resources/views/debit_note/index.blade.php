@extends('components.template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                        <a href="{{ route('debit.create') }}" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-plus mr-2"></i>Add
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 30px;">No.</th>
                                    <th class="text-center">Invoice Date</th>
                                    <th class="text-center">No Debit Note</th>
                                    <th class="text-center">Received Bank</th>
                                    <th class="text-center">Received From</th>
                                    <th class="text-center">For</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td class="text-center"> {{ $key++ }} </td>
                                        <td class="text-center"> {{ date('d-M-Y', strtotime($item->invoice_date)) }} </td>
                                        <td class="text-center">{{ $item->no_debit_note }}</td>
                                        <td class="text-center">{{ $item->received_bank }}</td>
                                        <td class="text-center">{{ $item->received_from }}</td>
                                        <td class="text-center">{{ $item->for }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('debit.edit', $item->id) }}"
                                                    class="btn btn-sm btn-secondary" title="Download" target="_blank"><i
                                                        class="fas fa-file-pdf"></i></a>
                                                <a href="{{ route('debit.edit', $item->id) }}" class="btn btn-sm btn-info"
                                                    title="Detail" target="_blank"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('debit.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning" title="Edit"><i
                                                        class="fas fa-edit"></i></a>
                                                <form action="{{ route('debit.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Delete Data?')"
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
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": [6]
                    },
                    {
                        "searchable": false,
                        "targets": [6]
                    },
                ]
            });
        });
    </script>
@endpush
