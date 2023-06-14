@extends('components.template')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Edit {{ $title }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bank.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="division">Division <font style="color: red;">*</font></label>
                                    <select class="form-control @error('division') is-invalid @enderror" id="division"
                                        name="division" required>
                                        <option value="">Select Division</option>
                                        @foreach ($division as $item)
                                            <option {{ $data->division_id == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('division')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $data->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <a href="{{ route('bank.index') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
                                        class="fas fa-backward mr-1"></i>Back</a>
                                <button type="submit" class="btn btn-md btn-primary float-right"><i
                                        class="fab fa-telegram-plane mr-1"></i>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
