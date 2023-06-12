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
                        <form action="{{ route('user.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name <font style="color: red;">*</font></label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ $data->name }}"
                                        required maxlength="50">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email <font style="color: red;">*</font></label>
                                    <input type="email" id="email" name="email" value="{{ $data->email }}"
                                        class="form-control @error('email') is-invalid @enderror" maxlength="50" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="text" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" minlength="5">
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Kosongkan jika tidak ingin mengganti password
                                    </small>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="role">Role <font style="color: red;">*</font></label>
                                    <select name="role" id="role"
                                        class="form-control @error('role') is-invalid @enderror" required>
                                        <option {{ $data->role == 'admin' ? 'selected' : '' }} value="admin">admin</option>
                                        <option {{ $data->role == 'user' ? 'selected' : '' }} value="user">user</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <a href="{{ route('user.index') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
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
