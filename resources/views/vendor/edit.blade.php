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
                        <form action="{{ route('vendor.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name_beneficary">Name Beneficary <font style="color: red;">*</font></label>
                                    <input type="text" id="name_beneficary" name="name_beneficary"
                                        class="form-control @error('name_beneficary') is-invalid @enderror"
                                        value="{{ $data->beneficary }}" placeholder="Input Name Beneficary" maxlength="50"
                                        required>
                                    @error('name_beneficary')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bank">Bank Account <font style="color: red;">*</font></label>
                                    <input type="text" id="bank" name="bank"
                                        class="form-control @error('bank') is-invalid @enderror" value="{{ $data->bank }}"
                                        placeholder="Input Bank Account" maxlength="150" required>
                                    @error('bank')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="detail">Detail Account <font style="color: red;">*</font></label>
                                    <textarea placeholder="Input Detail Account" name="detail" id="detail"
                                        class="form-control @error('detail') is-invalid @enderror">{{ $data->detail }}</textarea>
                                    @error('detail')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <a href="{{ route('vendor.index') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
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
