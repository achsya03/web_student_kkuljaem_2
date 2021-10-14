@extends('layouts.auth')

@section('title')
{{env('APP_NAME')}} | Register
@endsection

@section('content')
<div id="hero-login" class="container ">
  <div class="row">
      <div class="col-lg-7 justify-content-center slider">
          <div class="col-lg-12 mx-auto banner">
              <img src="{{ asset('assets/img/Property1.png')}}" height="auto" alt="" srcset="">
              <h1>Metode Belajar Yang Seru</h1>
              <p>Belajar tidak harus menegangkan dan menyulitkan</p>
          </div>
          <div class="col-lg-12 mx-auto banner justify-content-center">
              <img src="{{ asset('assets/img/Property2.png')}}" height="auto" alt="" srcset="">
              <h1>Asah Kemampuanmu</h1>
              <p>Belajar Bahasa Korea makin seru dengan berbagai fitur di dalam satu aplikasi</p>
          </div>
          <div class="col-lg-12 mx-auto banner">
              <img src="{{ asset('assets/img/Property3.png')}}" height="auto" alt="" srcset="">
              <h2>Mari Mulai Semua</h2>
              <p>bergabung lah dengan komunitas belajar bahasa Korea No. 1 Indonesia</p>
          </div>
      </div>
      <div class="col-lg-5 justify-content-center log-in d-flex flex-column">
          <div class="register-cek">
              <h2 class="title-register-cek">Berhasil! Tinggal selangkah lagi untuk Anda</h2>
              <p>Kami telah mengirimkan email ke</p>
              <p class="email-user">
              @if (session('email'))
                  {{session('email')}}
              @endif  
              </p>
              <p>Apakah kamu tidak mendapatkannya? Coba cek folder spam atau coba lagi</p>
              <a class="d-flex align-items-center justify-content-center btn btn-masuk" href="{{ route('login.index') }}">Masuk</a>

          </div>
      </div>
  </div>
</div>

    
@endsection


