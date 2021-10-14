@extends('layouts.auth')

@section('title')
{{env('APP_NAME')}} | Register
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
          <h2>Daftar</h2>
          <p>Isi Forum berikut untuk mendaftar.</p>
        </div>
        @if ($errors->any())
            <div class="notifikasi-login">
              {!! implode('', $errors->all('<h2>:message</h2>')) !!}
            </div>
        @endif
        <form action="{{route('register.process')}}" method="POST" autocomplete="off">
          @csrf
          <div class="form-group">
            <label for="InputEmail">Email</label>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Masukan email Anda yang aktif" required=""
              autofocus="">
          </div>
          <div class="form-group">
            <label for="InputSandi">Kata Sandi</label>
            <input type="password" id="inputSandi" name="password" class="form-control" placeholder="Kata sandi min. 8 karakter"
              required="" >
              <span id="mybutton" onclick="change()"><i class="fas fa-eye"></i></span>
          </div>
          <div class="form-group">
            <label for="InputSandi2">Verifikasi Kata Sandi</label>
            <input type="password" id="inputSandi2" name="password2" class="form-control" placeholder="Masukan ulang kata sandi"
              required="" >
              <span id="mybutton2" onclick="change2()"><i class="fas fa-eye" ></i></span>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="syarat">
            <label class="form-check-label" for="defaultCheck1">
                Saya menyetujui <span><a href="http://"> syarat dan ketentuan </a></span> 
                yang berlaku
            </label>
          </div>
          <button type="submit" class="btn-login">Daftar</button>
        </form>
      </div>
    </div></div>
    
@endsection
@section('page-js')
<script type="text/javascript">
    function change() {
        var x = document.getElementById('inputSandi').type;

        if (x == 'password') {
            document.getElementById('inputSandi').type = 'text';
            document.getElementById('mybutton').innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            document.getElementById('inputSandi').type = 'password';
            document.getElementById('mybutton').innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
</script>
<script type="text/javascript">
    function change2() {
        var x = document.getElementById('inputSandi2').type;

        if (x == 'password') {
            document.getElementById('inputSandi2').type = 'text';
            document.getElementById('mybutton2').innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            document.getElementById('inputSandi2').type = 'password';
            document.getElementById('mybutton2').innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
</script>
@endsection

