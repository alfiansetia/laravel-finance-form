@extends('components.template')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add {{ $title }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('validator.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="prepared">Prepared <font style="color: red;">*</font></label>
                                    <input type="text" id="prepared" name="prepared"
                                        class="form-control @error('prepared') is-invalid @enderror"
                                        value="{{ old('prepared') }}" required>
                                    @error('prepared')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="checked">Checked <font style="color: red;">*</font></label>
                                    <input type="text" id="checked" name="checked"
                                        class="form-control @error('checked') is-invalid @enderror"
                                        value="{{ old('checked') }}" required>
                                    @error('checked')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="approved">Approved <font style="color: red;">*</font></label>
                                    <input type="text" id="approved" name="approved"
                                        class="form-control @error('approved') is-invalid @enderror"
                                        value="{{ old('approved') }}" required>
                                    @error('approved')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <a href="{{ route('validator.index') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
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
