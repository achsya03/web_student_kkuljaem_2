<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('assets/img/Logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/CDNSFree2/Plyr/plyr.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />

    <link href="{{asset('assets/vendor/fontawesome/css/fontawesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendor/fontawesome/css/light.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendor/fontawesome/css/regular.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet" />
    <title>Kkuljaem Korea</title>
</head>

<body>
    <header id="header" class="bg-light fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo mr-auto my-auto">
                <a href="#">
                    <img src="{{ asset('assets/img/Logo.png') }}" alt="" srcset="" /></a>
            </h1>
            <form class="pr-4 mr-4" style="width: 700px;">
                <div class="input-group border rounded-pill my-1 mr-4 bg-white py-2">
                    <input type="search" placeholder="Search..." aria-describedby="button-addon3"
                        class="form-control ml-3 bg-none border-0">
                    <div class="input-group-append border-0">
                        <button id="button-addon3" type="button" class="btn btn-link text-success"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link my-1 mx-2" href="{{ route('register.index') }}">Daftar</a>
                </li>
                <li class="nav-item btn-login">
                    <a class="nav-link my-1 mx-2 " href="{{ route('login.index') }}">
                        <h7>Login</h7>
                    </a>
                </li>

            </ul>
        </div>
    </header>

    <div id="main">

        <!-- hero-dashboard -->
        <div id="hero-dashboard mb-4" class="container">
            <div class="row">
                <div class="slider">
                    @foreach ($data->banner as $item)

                        <div>
                            <button type=" button" class="btn col-lg-12 mx-auto banner"
                                id="btn-market{{ $item->banner_uuid }}" data-toggle="modal"
                                data-target="#banner-market{{ $item->banner_uuid }}">
                                <img src="{{ $item->url_web }}" height="auto" alt="" srcset="" /></button>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- close-hero-dashboard -->
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
                    <p class="px-4">{{ $item->url_mobile }}</p>
                    <button class="btn-gabung" width="300px"
                        onclick="window.location='{{ URL::route('class.index') }}'">
                        Cek Selengkapnya </button>
                </div>
            </div>
        </div>
    @endforeach

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
                    {{-- <video id='my-video' controls controlsList="nodownload" preload='auto'>
                        <source src='{{ $data->video[0]->url_video }}' type='video/mp4'> --}}
                    {{-- </video>  --}}
                </div>
            </div>
            <div class="col-lg-4 button-video">
                <div class="button-pelajaran">
                    <div class="hangeul-scroll">
                        @foreach ($data->word as $item => $word)
                            <div class="list-button-video">
                                <button id="btn-voice{{ $word->kata_uuid }}" data-toggle="modal"
                                    data-target="#voice-kata{{ $word->kata_uuid }}" class="btn-word">
                                    <div class="row">
                                        <div class="col-lg-8 word-korea justify-content-center">
                                            <p>{{ $word->hangeul }}</p>
                                            <h1>({{ $word->pelafalan }})</h1>

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
                                        </audio>
                                        <div id="button-sound{{ $item->kata_uuid }}" class="mt-2">
                                            <img src="{{ asset('assets/img/IconPlay.png') }}" width='40px'
                                                height='40px'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="pl-4">Penjelasan</h5>
                        <p class="p-4"> {{ $item->penjelasan }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="container my-4">
        <img src="{{ asset('assets/img/banner-promo.png') }}" alt="Banner Promo" width="1100px"
            class="banner-promo">
    </div>

    </div>




    <footer id="footer" class="mastfoot mt-auto">
        <div class="inner">
            <div class="d-flex">
                <div class="col-4 logo justify-content-center">
                    <div class="row">
                        <i class="icon fab fa-instagram"></i>
                        <i class="icon fab fa-youtube"></i>
                        <i class="icon fas fa-globe-asia"></i>
                    </div>
                </div>
                <div class="col-4 justify-content-center">
                    <img src="{{ asset('assets/img/Logo2.png') }}" alt="" srcset="">
                </div>
                <div class="col-4 justify-content-center">
                    <h4 class="copyright">Copyright 2021</h4>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/gh/CDNSFree2/Plyr/plyr.js"></script>
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
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                infinite: true,
                dots: true,
            });
        });
    </script>

</body>

</html>
