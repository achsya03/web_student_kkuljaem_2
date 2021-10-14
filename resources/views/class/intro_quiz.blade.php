        
@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/quiz.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection

@section('title')
    {{ env('APP_NAME') }} | Detail Quiz
@endsection

@section('content')
   <!-- Main -->
   
   <div class="container">
    <div class="row content-main ">
        <div class="col-6">
            <img src="{{ asset('assets/img/introillus.png') }}" width="500px" height="353px" alt="IntroIllustrasion">
        </div>
        
        <div class="col-6">
            @foreach ($quiz as $key => $value)
            
            <h2 class="text-title font-weight-bold mt-5">{{$value->judul_quiz}}</h2>
            @if ($key = 1)
            @break
            @endif
            @endforeach
            
            <p class="text-p mt-2">Kamu dapat mengulang lagi latihan ini sampai <br> kamu benar-benar menguasai materinya <br> dengan baik.</p>
            <a href="{{route('class.startquiz', $id)}}" class="btn btn-start mx-auto mt-5">Mulai</a>
        </div>

    </div>
</div>

<!-- End Main -->
@endsection
