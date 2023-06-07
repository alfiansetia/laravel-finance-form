@extends('components.template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                        <a href="{{ route('wht.create') }}" class="btn btn-primary btn-round ml-auto">
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
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Value</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td class="text-center"> {{ $key + 1 }} </td>
                                        <td class="text-center">{{ $item->name }}</td>
                                        <td class="text-center">{{ $item->value }}%</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('wht.edit', $item->id) }}" class="btn btn-sm btn-warning"
                                                    title="Edit"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('wht.destroy', $item->id) }}" method="POST">
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
                        "targets": [3]
                    },
                    {
                        "searchable": false,
                        "targets": [3]
                    },
                ]
            });
        });
    </script>
@endpush
