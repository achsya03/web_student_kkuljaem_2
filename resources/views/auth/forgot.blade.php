@extends('layouts.auth')

@section('title')
    {{env('APP_NAME')}} | Lupa Password
@endsection

@section('content')
  <div id="hero-login" class="container">
    <div class="row">
      <div class="col-lg-7 justify-content-center slider">
        <div class="col-lg-12 mx-auto banner">
          <img src="assets/img/Property1.png" height="auto" alt="" srcset="">
          <h1>Metode Belajar Yang Seru</h1>
          <p>Belajar tidak harus menegangkan dan menyulitkan</p>
        </div>
        <div class="col-lg-12 mx-auto banner justify-content-center">
          <img src="assets/img/Property2.png" height="auto" alt="" srcset="">
          <h1>Asah Kemampuanmu</h1>
          <p>Belajar Bahasa Korea makin seru dengan berbagai fitur di dalam satu aplikasi</p>
        </div>
        <div class="col-lg-12 mx-auto banner">
          <img src="assets/img/Property3.png" height="auto" alt="" srcset="">
          <h1>Mari Mulai Semua</h1>
          <p>bergabung lah dengan komunitas belajar bahasa Korea No. 1 Indonesia</p>
        </div>
      </div>
      <div class="col-lg-5 justify-content-center log-in">
        <div class="title-bar">
          <h2>Lupa kata sandi</h2>
          <p>Masukan email anda dan kami akan mengirimkan email pemulihan.</p>
        </div>
        @if ($errors->any())
            <div class="notifikasi-login">
                  <div class="notifikasi-login">
                    {!! implode('', $errors->all('<h2>:message</h2>')) !!}
                  </div>
            </div>
        @endif
        <form action="{{route('forgot.forgotProcess')}}" method="POST" autocomplete="off">
            
          @csrf
          <div class="form-group">
            <label for="InputEmail">Email</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Masukkan email Anda" required
              autofocus="">
          </div>
          <button type="submit" class="btn-login">Kirim Email Pemulihan</button>
        </form>
        <h5><a href="{{route('change-password.index')}}">Masuk</a></h5>
      </div>
    </div>
  </div>
@endsection