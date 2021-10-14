@extends('layouts.dashboard') @section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/class.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/detail-video.css') }}"> @endsection @section('title')
{{ env('APP_NAME') }} | Detail Kelas @endsection

@section('content')

    <!-- hero-dashboard -->
    <div id="hero-dashboard" class="container">
        <div class="mt-4">
            <img class="gambar-detail-kelas mx-auto" src="{{ $class->url_mobile }}" width="1146px" height="516px" alt=""
                srcset="">
        </div>
    </div>
    <!-- close-hero-dashboard -->

    <div id="hero-detail" class="container mb-4">
        <h1 class="font-weight-bold">{{ $class->class_nama }}</h1>
        <p>{{ $class->class_desc }}</p>
        <div class="profil-mentor">
            <div class="row">
                <div class="col-lg-1">
                    <img src="{{ asset('assets/img/profile-1.png') }}" alt="Profile">
                </div>
                <div class="col-lg-10">
                    <a href="{{ route('class.mentor', $class->mentor_uuid) }}"
                        style="text-decoration: none; color: black">
                        <h5>{{ $class->mentor_nama }} <i class="fas fa-check-circle"></i>
                        </h5>
                        <h5 class="text-secondary">12 10 2021 - 10.00AM</h5>
                    </a>

                </div>
            </div>
        </div>
    </div>

    @if ($account->status_member == 'Non-Member')
        <div id="hero-promo" class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto banner">
                    <img src="{{ asset('assets/img/Bannerpromo.png') }}" height="200px" alt="" srcset="">
                </div>
            </div>
        </div>
    @else
    @endif


    <div id="hero-pelajaran" class="container ">
        <div class="tittle-kelas my-4 pt-4">
            <h1> <strong> Daftar Materi </strong> </h1>
            <h4>{{ $class->jml_video }} video pembelajaran & {{ $class->jml_quiz }} quiz</h4>
        </div>
        @if ($account->status_member == 'Non-Member')
            <div class="row">
                <div class="col-lg-12 button-video">
                    <div class="button-pelajaran">
                        @foreach ($class->content as $index => $item)
                            @if ($index < 4)
                                @if ($item->type == 'video')
                                    <div class="list-button-video">
                                        <a >
                                            <button class="btn-word">
                                                <div class="row">
                                                    <div class="col-lg-8 word-korea justify-content-center">
                                                        <p class="d-flex"><img class="mr-2" width="50px"
                                                                height="50px" src="  @if ($item->type == 'video')
                                                            {{ asset('assets/img/Play-video.png') }}
                                                        @else
                                                            {{ asset('assets/img/quiz-icon.png') }}
                                                            @endif "> <strong
                                                                class="pl-2">{{ $item->judul }}</strong></p>
                                                    </div>
                                                    <div class="col-lg-4 d-flex align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="mt-2 mr-4 text-right">{{ $item->jml_latihan }}
                                                                Latihan
                                                                {{ $item->jml_shadowing }} Shadowing
                                                            </h6>
                                                        </div>

                                                    </div>
                                                </div>
                                            </button>
                                        </a>
                                    </div>
                                @else
                                    <div class="list-button-video">
                                        <a href="#">
                                            <button class="btn-word">
                                                <div class="row">
                                                    <div class="col-lg-8 word-korea justify-content-center">
                                                        <p><img src="      @if ($item->type ==
                                                            'video')
                                                            {{ asset('assets/img/Play-video.png') }}
                                                        @else
                                                            {{ asset('assets/img/quiz-icon.png') }}
                                                            @endif "> <strong>{{ $item->judul }}</strong></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h6 class="mt-2 mr-4 text-right">{{ $item->jml_soal }} Soal</h6>
                                                    </div>
                                                </div>
                                            </button>
                                        </a>
                                    </div>
                                @endif
                            @else
                            @endif
                        @endforeach
                        <div class="lainnya mt-3 mb-3" width="100%">
                            <center>
                                <?php
                            try {  ?>
                                <button type='button'
                                    onclick="window.location='{{ URL::route('class.video', $class->content[0]->content_video_uuid) }}'"
                                    class='btn btn-lainnya text-center py-2 my-1'> Materi Lainnya </button>
                                <?php  } catch (\Throwable $th) {
                            } ?>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-12 button-video">
                    <div class="button-pelajaran">
                        @foreach ($class->content as $index => $item)
                            @if ($index < 4)
                                @if ($item->type == 'video')
                                    <div class="list-button-video">
                                        <a href="{{ route('class.video', $item->content_video_uuid) }}">
                                            <button class="btn-word">
                                                <div class="row">
                                                    <div class="col-lg-8 word-korea justify-content-center">
                                                        <p class="d-flex"><img class="mr-2" width="50px"
                                                                height="50px" src="  @if ($item->type == 'video')
                                                            {{ asset('assets/img/Play-video.png') }}
                                                        @else
                                                            {{ asset('assets/img/quiz-icon.png') }}
                                                            @endif "> <strong
                                                                class="pl-2">{{ $item->judul }}</strong></p>
                                                    </div>
                                                    <div class="col-lg-4 d-flex align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="mt-2 mr-4 text-right">{{ $item->jml_latihan }}
                                                                Latihan
                                                                {{ $item->jml_shadowing }} Shadowing
                                                            </h6>
                                                        </div>

                                                    </div>
                                                </div>
                                            </button>
                                        </a>
                                    </div>
                                @else
                                    <div class="list-button-video">
                                        <a href="{{ route('class.quiz', $item->content_quiz_uuid) }}">
                                            <button class="btn-word">
                                                <div class="row">
                                                    <div class="col-lg-8 word-korea justify-content-center">
                                                        <p><img src="      @if ($item->type ==
                                                            'video')
                                                            {{ asset('assets/img/Play-video.png') }}
                                                        @else
                                                            {{ asset('assets/img/quiz-icon.png') }}
                                                            @endif "> <strong>{{ $item->judul }}</strong></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h6 class="mt-2 mr-4 text-right">{{ $item->jml_soal }} Soal</h6>
                                                    </div>
                                                </div>
                                            </button>
                                        </a>
                                    </div>
                                @endif
                            @else
                            @endif
                        @endforeach
                        <div class="lainnya mt-3 mb-3" width="100%">
                            <center>
                                <?php
                            try {  ?>
                                <button type='button'
                                    onclick="window.location='{{ URL::route('class.video', $class->content[0]->content_video_uuid) }}'"
                                    class='btn btn-lainnya text-center py-2 my-1'> Materi Lainnya </button>
                                <?php  } catch (\Throwable $th) {
                            } ?>
                            </center>
                        </div>
                    </div>
                </div>
            </div>


        @endif
    </div>
    <div id="hero-kelas" class="container ">
        <div class="tittle-kelas">
            <h3><a href="#"> Kelas Lainnya </a></h3>
            <p>Lihat kelas lainnya yuk yang tidak kalah menarik!</p>
        </div>
        <div class="kelas-utama">
            <div class="pilihan-kelas">
                <div class="card-deck">
                    @foreach ($lain->class_list as $item => $no)
                        @foreach ($no->classroom as $children => $child)
                            <button class="kelas">
                                <div class="row py-4">
                                    <div class="col-lg-4">
                                        <img class="gambar-kelas mt-1" src="{{ $child->url_web }}" width="160px"
                                            height="160px" srcset="">
                                    </div>
                                    <div class="col-lg-5 ml-2 text-left deskripsi">
                                        <div class="nama-kelas">
                                            <a href="{{ route('class.detail', $child->class_uuid) }}"
                                                style="text-decoration: none; color: black">
                                                <h5 class="font-weight-bold">{{ $child->class_nama }}</h5>
                                            </a>
                                        </div>
                                        <div class="nama-guru">
                                            <h5>{{ $child->mentor_nama ?? '-' }} <i class="fas fa-check-circle"></i>
                                            </h5>
                                        </div>
                                        <div class="jumlah-materi">
                                            <h5>{{ $child->jml_materi }} Materi</h5>
                                        </div>
                                    </div>
                                </div>
                            </button> @if ($children == 1) @break @endif @endforeach @if ($item == 0) @break @endif @endforeach
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
