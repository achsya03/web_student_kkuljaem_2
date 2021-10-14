@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/quiz.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection

@section('title')
{{ env('APP_NAME') }} | Latihan
@endsection

@section('content')
<div class="container" style="min-height: 65vh;">
    <div class="row content-main">
        <div class="col-6">
            <img src="{{ asset('assets/img/introillus.png')}}" width="500px" height="353px" alt="IntroIllustrasion">
        </div>
        <div class="col-6">
            <h2 class="text-title font-weight-bold mt-5">Apakah kamu sudah siap?</h2>
            <p class="text-p mt-2">Kamu dapat mengulang lagi latihan ini sampai <br> kamu benar-benar menguasai materinya <br> dengan baik.</p>
            <a href="{{ route('class.latihan', $id) }}" class="btn-start">Mulai</a>
        </div>

    </div>
</div>
@if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
@endsection