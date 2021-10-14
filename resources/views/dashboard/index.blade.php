@extends('layouts.dashboard') @section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" /> @endsection @section('title') Kkuljaem Korea |
    Home @endsection @section('content')

    <!-- hero-dashboard -->
    <div id="hero-dashboard" class="container">
        <div class="row">
            <div class="slider">
                @foreach ($data->banner as $item)

                    <div class="">
                <button type=" button" class="btn col-lg-12 mx-auto banner"
                        id="btn-market{{ $item->banner_uuid }}" data-toggle="modal"
                        data-target="#banner-market{{ $item->banner_uuid }}">
                        <img src="{{ $item->url_web }}" height="auto" alt="" srcset="" /></button>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
    @foreach ($data->banner as $item)

        <div class="modal fade" id="banner-market{{ $item->banner_uuid }}" tabindex="-1" role="dialog"
            aria-labelledby="banner-market" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <button type="button" class="close float-right text-right px-4 py-2"
                        data-dismiss="modal">&times;</button>
                    <div class="modal-body">

                        <img src="{{ $item->url_web }}" class="mt-2" width="750px" height="300px" alt="">
                    </div>

                    <h2 class="px-4">{{ $item->judul_banner }}</h2>
                    <p class="px-4">{{ $item->deskripsi }}</p>
                    <button class="btn-gabung" width="300px"
                        onclick="window.location='{{ URL::route('class.index') }}'"> Cek
                        Selengkapnya </button>
                </div>
            </div>
        </div>
    @endforeach

    <!-- close-hero-dashboard -->


    <div id="hero-pelajaran" class="container ">
        <div class="row">
            <div class="col-lg-8 video">
                <div class="embed-responsive embed-responsive-16by9">
                    <div class="plyr__video-embed" id="player">
                        <iframe src="{{ $data->video[0]->url_video }}"
                            allowfullscreen
                            allowtransparency
                            allow="autoplay">
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 button-video">
                <div class="button-pelajaran">
                    <div class="hangeul-scroll">
                        @foreach ($data->word as $item)
                            <div class="list-button-video">
                                <button id="btn-voice{{ $item->kata_uuid }}" data-toggle="modal"
                                    data-target="#voice-kata{{ $item->kata_uuid }}" class="btn-word">
                                    <div class="row">
                                        <div class="col-lg-8 word-korea justify-content-center">
                                            <p>{{ $item->hangeul }}</p>
                                            <h1>({{ $item->pelafalan }})</h1>

                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <div id="button-sound1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @foreach ($data->word as $item)
        <div class="modal fade" id="voice-kata{{ $item->kata_uuid }}" tabindex="-1" role="dialog"
            aria-labelledby="voice-kata" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-title p-4">
                        <button href="#" class="btn-modal-word">
                            <div class="row">
                                <div class="col-lg-8 word-korea justify-content-center">
                                    <p>{{ $item->hangeul }}</p>
                                    <h1>({{ $item->pelafalan }})</h1>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <audio id="player-sound{{ $item->kata_uuid }}">
                                            <source src="{{ $item->url_pengucapan }}" type="audio/mp3">
                                            <source src="{{ $item->url_pengucapan }}" type="audio/mp4">
                                        </audio>
                                        <div id="button-sound{{ $item->kata_uuid }}" class="mt-2">
                                            <img src="{{ asset('assets/img/IconPlay.png') }}" width='40px' height='40px'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="pl-4">Penjelasan</h5>
                        <p class="p-4">{{ $item->penjelasan }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div id="hero-kelas" class="container mt-3">
        <div class="tittle-kelas">
            <h3 class="font-weight-bold"><a href="#"> Kelas Pilihan </a></h3>
            <p>Kelas terbaik yang direkomendasikan</p>
        </div>
        <div class="kelas-utama">
            <div class="pilihan-kelas">
                <div class="card-deck">
                    @foreach ($data->class as $item)
                        <button class="kelas">
                            <div class="row">
                                <div class="col-lg-4 ">
                                    <img class="gambar-kelas mx-auto" src="{{ $item->url_web }}" width="160px"
                                        height="160px">
                                </div>
                                <div class="col-lg-6 py-4 text-left deskripsi">
                                    <div class="nama-kelas ">
                                        <h5 class="font-weight-bold">{{ $item->nama_kelas }}</h5>
                                    </div>
                                    <div class="nama-guru">
                                        <h6>{{ $item->nama_mentor ?? '-' }} <i class="fas fa-check-circle"></i></h6>
                                    </div>
                                    <div class="jumlah-materi">
                                        <h6>{{ $item->jml_materi }} Materi</h6>
                                    </div>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="lainnya mt-3 mb-3" width="100%">
                <center><button type='button' onclick="window.location='{{ URL::route('class.index') }}'"
                        class='btn btn-lainnya text-center py-2 my-1'> Lainnya </button>
                </center>
            </div>
        </div>
    </div>

    <div id="hero-kelas" class="container mt-3">
        <div class="tittle-kelas">
            <h3><a href="#"> Diskusi Populer </a></h3>
            <p>Berbagai topik seru untuk kamu baca</p>
        </div>
        <div class="container">
            <div class="kelas-utama">
                <div class="pilihan-kelas">
                    <div class="card-deck">
                        @foreach ($data->theme as $index => $theme)
                            @if ($index == 0) <button class="topik-tag" href="#"
                                    style="background-image: url({{ asset('assets/img/tag-makanan.jpg)') }};">
                                    <h3 class="text-white">#{{ $theme->topik }}</h3>
                                </button>
                            @elseif ($index == 1)
                                <button class="topik-tag" href="#"
                                    style="background-image: url({{ asset('assets/img/tag-aktor.jpg)') }};">
                                    <h3 class="text-white">#{{ $theme->topik }}</h3>
                                </button>
                            @elseif ($index == 2)
                                <button class="topik-tag" href="#"
                                    style="background-image: url({{ asset('assets/img/tag-artis.jpg)') }};">
                                    <h3 class="text-white">#{{ $theme->topik }}</h3>
                                </button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="hero-comment" class="container mt-3">
        @foreach ($data->post as $item)

            <div class="komentar">
                <div class="profil-comentar">
                    <div class="row">
                        <div class="col-lg-1">
                            <img class="rounded-circle" src="{{ asset('assets/img/profile-1.png') }}" alt="Profile">
                        </div>
                        <div class="col-lg-10">
                        <h5>{{ $item->nama_pengirim }} @if ($account->status_member == 'Non-Member') @else
                                    <img src="{{ asset('assets/img/crown_user.png') }}" alt="Profile">
                                @endif
                            </h5>
                            <h6>{{ date('d m Y - H.i', strtotime($item->tgl_post)) }}</h6>
                        </div>
                    </div>
                </div>
                <h4>{{ $item->tema }}</h4>
                <h6><a href="#">#LifeStyle</a></h6>
                <p>{{ $item->deskripsi }}</p>
                @if (@!isset($item->gambar))
                @else
                    <div class="pict-comentar">
                        <div class="card-deck">
                            @foreach ($item->gambar as $gambaritem)
                                <img class="rounded" src="{{ $gambaritem->url_gambar }}" width="150px"
                                    height="120px" alt="">
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="like-comment">
                    <div class="row">
                        <i class="far fa-heart"></i>
                        <h7>{{ $item->jml_like }} Suka </h7>
                        <i class="far fa-comment-alt-dots"> </i>
                        <h7>{{ $item->jml_komen }} Comments</h7>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="lainnya mt-3 mb-3" width="100%">
        <center><button type='button' onclick="window.location='{{ URL::route('forum.index') }}'"
                class='btn btn-lainnya text-center py-2 my-1'> Lainnya </button>
        </center>
    </div>

@endsection
@section('page-js')
    @foreach ($data->word as $item)
        <script>
            $(document).ready(function() {
                let button{{ $item->kata_uuid }} = document.getElementById("button-sound{{ $item->kata_uuid }}");

                let audio{{ $item->kata_uuid }} = document.getElementById("player-sound{{ $item->kata_uuid }}");

                button{{ $item->kata_uuid }}.addEventListener("click", function() {
                    if (audio{{ $item->kata_uuid }}.paused) {
                        audio{{ $item->kata_uuid }}.play();
                        button{{ $item->kata_uuid }}.innerHTML =
                            "<img src='assets/img/IconPause.png' width='40px' height='40px'>";
                    } else {
                        audio{{ $item->kata_uuid }}.pause();
                        button{{ $item->kata_uuid }}.innerHTML =
                            "<img src='assets/img/IconPlay.png' width='40px' height='40px'>";
                    }
                });

                audio{{ $item->kata_uuid }}.onended = function() {
                    button{{ $item->kata_uuid }}.innerHTML =
                        "<img src='assets/img/IconPlay.png' width='40px' height='40px'>";
                };
            });
        </script>
    @endforeach
@endsection
