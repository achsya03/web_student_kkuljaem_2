@extends('layouts.auth')

@section('title')
{{env('APP_NAME')}} | Register
@endsection

@section('content')
<div id="hero-register" class="container selamat">
    <div class="content-register d-flex justify-content-center">
        <div class="flex-column" style="width: 60%;">
            <div class="img-register text-center mb-4">
                <img src="{{asset('assets/img/Logo-register.png')}}" alt="Logo">
            </div>
            <h2 class="font-weight-bold pt-4">Selamat Akun Anda Berhasil dibuat</h2>
            <p>Kamu telah terdaftar dengan email  <p class="email-user">@if (session('email'))
                {{session('email')}}
            @endif  </p>
            </p>
           
            <a class="d-flex align-items-center justify-content-center btn btn-masuk mb-4" href="{{ route('login.index') }}">Masuk dengan Browser </a>
            
            <button type="submit" class="btn-masuk-browser">Masuk dengan Aplikasi</button>

        </div>

    </div>
</div>

@endsection


