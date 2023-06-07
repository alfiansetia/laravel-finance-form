@extends('components.template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Add {{ $title }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('wht.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="value">Value</label>
                                <div class="input-group">
                                    <input type="number" id="value" name="value" value="{{ old('value', 0) }}"
                                        class="form-control @error('value') is-invalid @enderror" min="0" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="inputGroupPrepend3">%</span>
                                    </div>
                                    @error('value')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <a href="{{ route('wht.index') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
                                    class="fas fa-backward mr-1"></i>Back</a>
                            <button type="submit" class="btn btn-md btn-primary float-right"><i
                                    class="fab fa-telegram-plane mr-1"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
