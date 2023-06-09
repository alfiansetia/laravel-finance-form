@extends('components.template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $title }} Profile</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ auth()->user()->name }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                    class="form-control @error('email') is-invalid @enderror" min="0" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <a href="{{ route('home') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
                                    class="fas fa-backward mr-1"></i>Back</a>
                            <button type="submit" class="btn btn-md btn-primary float-right"><i
                                    class="fab fa-telegram-plane mr-1"></i>Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $title }} Password</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.password.update') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">New Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" autocomplete="off"
                                    required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="form-control @error('confirm_password') is-invalid @enderror" autocomplete="off"
                                    required>
                                @error('confirm_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <a href="{{ route('home') }}" class="btn btn-md btn-secondary ml-auto mr-2"><i
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
