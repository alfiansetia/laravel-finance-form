@extends('components.template')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                            <a href="{{ route('vendor.create') }}" class="btn btn-primary btn-round ml-auto">
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
                                        <th class="text-center">Name Beneficary</th>
                                        <th class="text-center">Bank Account</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td class="text-center"> {{ $key + 1 }} </td>
                                            <td class="text-center">{{ $item->beneficary }}</td>
                                            <td class="text-center">{{ $item->bank }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('vendor.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form id="form{{ $item->id }}"
                                                        action="{{ route('vendor.destroy', $item->id) }}" method="POST">
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
            $('#table').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": [3]
                    },
                    {
                        "searchable": false,
                        "targets": [3]
                    },
                ]
            });
        });

        function deleteData(idform) {
            swal({
                title: 'Delete Data?',
                icon: "warning",
                type: 'warning',
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
