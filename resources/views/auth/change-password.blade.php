@extends('layouts.auth')

@section('title')
{{env('APP_NAME')}} | Ubah Password
@endsection

@section('content')
<div id="hero-login" class="container ">
    <div class="row">
        <div class="col-lg-7 justify-content-center slider">
            <div class="col-lg-12 mx-auto banner">
                <img src="../Assets/img/Property1.png" height="auto" alt="" srcset="">
                <h1>Metode Belajar Yang Seru</h1>
                <p>Belajar tidak harus menegangkan dan menyulitkan</p>
            </div>
            <div class="col-lg-12 mx-auto banner justify-content-center">
                <img src="../Assets/img/Property2.png" height="auto" alt="" srcset="">
                <h1>Asah Kemampuanmu</h1>
                <p>Belajar Bahasa Korea makin seru dengan berbagai fitur di dalam satu aplikasi</p>
            </div>
            <div class="col-lg-12 mx-auto banner">
                <img src="../Assets/img/Property3.png" height="auto" alt="" srcset="">
                <h1>Mari Mulai Semua</h1>
                <p>bergabung lah dengan komunitas belajar bahasa Korea No. 1 Indonesia</p>
            </div>
        </div>
        <div class="col-lg-5 justify-content-center log-in d-flex flex-column">
            <div class="title-bar">
                <h2 class="font-weight-bold mb-0">Ubah Kata Sandi</h2>
                <p>Masukan Kata sandi anda yang baru.</p>
            </div>
            @if ($errors->any())
            <div class="notifikasi-login">
              {!! implode('', $errors->all('<h2>:message</h2>')) !!}
            </div>
            @endif
            <form action="{{route('change-password.process')}}" method="POST" autocomplete="off">
            
                @csrf
                <input type="hidden" name="token" value="{{$token ?? ''}}" id="">
                <div class="form-group">
                    <label for="InputSandi">Kata Sandi Baru</label>
                    <input type="password" id="inputSandi" name="password" class="form-control" placeholder="Masukkan Kata sandi min. 8 karakter" required="">
                    <span id="mybutton" onclick="change()"><i class="fas fa-eye"></i></span>
                </div>
                <div class="form-group">
                    <label for="InputSandi2">Verifikasi Kata Sandi Baru</label>
                    <input type="password" id="inputSandi2" name="password2" class="form-control" placeholder="Masukan ulang kata sandi baru Anda" required="">
                    <span id="mybutton2" onclick="change2()"><i class="fas fa-eye" ></i></span>
                </div>

                <button type="submit" class="btn-masuk">Ubah Kata Sandi</button>
            </form>
        </div>
    </div>
</div>
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

