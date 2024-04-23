@extends('layouts.main', ['title' => 'Login', 'login' => true])

@section('content')

<div class="login-logo">
    <a href="/"><b>Admin</b>{{ config('app.name') }}</a>
</div>

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Selamat datang, silakan masuk</p>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group">
                <input name="username" class="form-control @error('username') is-invalid @enderror"
                    placeholder="Username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-user"></span>
                    </div>
                </div>
                @error('username')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group mt-3">
                <input name="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class='fas fa-lock'></span>
                    </div>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mt-3">
                <div class="col-8">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                        <label class="custom-control-label" for="remember">Ingat Saya</label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
