@extends('layouts.dashboard') @section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/class.css') }}"> @endsection @section('title')
    {{ env('APP_NAME') }} | Kelas @endsection @section('content')

    <div id="title-bar" class="my-3">
        <div class="container pl-0">
            <ul class="nav nav-pills mb-3 top-menu" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mr-4 ml-3 active" id="pills-jelajah-tab" data-toggle="pill" href="#pills-jelajah"
                        role="tab" aria-controls="pills-jelajah" aria-selected="true">
                        <h3 class="font-weight-bold">Level Kelas</h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-histori-tab" data-toggle="pill" href="#pills-histori" role="tab"
                        aria-controls="pills-histori" aria-selected="false">
                        <h3 class="font-weight-bold">Riwayat</h3>
                    </a>
                </li>

            </ul>
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

        <div id="whykkuljaem" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-body ">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="row my-4">
                            <div class="col-lg-5 mx-2 my-3">
                                <img src="{{ asset('assets/img/whykklujaem.png') }}">
                            </div>
                            <div class="col-lg-6 mx-auto my-2 ">
                                <h2 class="text-center">Why Kkuljaem?</h2>
                                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget
                                    sagittis ac eu molestie cursus.</p>
                                <button class="btn btn-about mb-2 mx-4 ">
                                    About Kkuljaem Korean
                                </button>
                                <button class="btn-langganan my-2 mx-4 ">
                                    Langganan Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @else
    @endif
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-jelajah" role="tabpanel" aria-labelledby="pills-jelajah-tab">

            @foreach ($class->class_list as $item)
            @if (empty($item->classroom)) 
            @else
                    <div id="hero-kelas" class="container ">
                        <div class="tittle-kelas my-3">
                            <h3><a href="{{ route('class.kategori', $item->category_uuid) }}"> {{ $item->category }}
                                </a>
                            </h3>
                            <p>{{ $item->category_detail }}</p>
                        </div>

                        <div class="container">
                            <div class="kelas-utama">
                                <div class="pilihan-kelas">
                                    <div class="card-deck">
                                        @foreach ($item->classroom as $index => $children)
                                            @if ($index < 4) @if ($children->jml_materi == '0')
                                            <button
                                            class="kelas">
                                            <div class="row py-4">
                                                <div class="col-lg-4">
                                                    <img class="gambar-kelas" src="{{ asset('assets/img/img-example-rectangle.png') }}"
                                                        width="160px" height="160px" srcset="">
                                                </div>
                                                <div class="col-lg-6 py-6 text-left deskripsi">
                                                    <div class="nama-kelas">
                                                            <h5 class="font-weight-bold">
                                                                Coming Soon</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                            @else
                                            <button
                                            class="kelas">
                                            <div class="row py-4">
                                                <div class="col-lg-4">
                                                    <img class="gambar-kelas" src="{{ $children->url_web }}"
                                                        width="160px" height="160px" srcset="">
                                                </div>
                                                <div class="col-lg-6 py-6 text-left deskripsi">
                                                    <div class="nama-kelas">
                                                        <a href="{{ route('class.detail', $children->class_uuid) }}"
                                                            style="text-decoration: none; color: black">
                                                            <h5 class="font-weight-bold">
                                                                {{ $children->class_nama }}</h5>
                                                        </a>
                                                    </div>
                                                    <div class="nama-guru">
                                                        <a href="{{ route('class.mentor', $children->mentor_uuid) }}"
                                                            style="text-decoration: none; color: black">
                                                            <h6>{{ $children->mentor_nama ?? '-' }} <i
                                                                    class="fas fa-check-circle"></i></h6>
                                                        </a>

                                                    </div>
                                                    <div class="jumlah-materi">
                                                        <h6>{{ $children->jml_materi }} Materi</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                            @endif
                                            @else @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($item->classroom as $index => $children)
                            @if ($index == 4)
                                <div class="lainnya mt-3 mb-3" width="100%">
                                    <center><button type='button'
                                            onclick="{{ route('class.kategori', $item->category_uuid) }}"
                                            class='btn btn-lainnya text-center py-2 my-1'> Lainnya </button>
                                    </center>
                                </div>
                            @else
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach

        </div>
        <div class="tab-pane fade" id="pills-histori" role="tabpanel" aria-labelledby="pills-histori-tab">

            <div id="hero-kelas" class="container">
                <div class="tittle-kelas">
                    <h3><a href="#"> Kelas Terakhir</a></h3>
                    <p>Lanjutkan belajarmu</p>
                </div>
                <div class="kelas-utama mb-3">
                    <div class="pilihan-kelas">
                        <div class="card-deck">
                            @foreach ($history->class_terdaftar as $item)
                                <button class="kelas">
                                    <div class="row py-4">
                                        <div class="col-lg-4">
                                            <img class="gambar-kelas" src="{{ $item->class_url_web }}" width="160px"
                                                height="160px" srcset="">
                                        </div>
                                        <div class="col-lg-6 py-6 text-left deskripsi">
                                            <div class="nama-kelas">
                                                <a href="{{ route('class.detail', $children->class_uuid) }}"
                                                    style="text-decoration: none; color: black">
                                                    <h5 class="font-weight-bold">{{ $item->class_nama }}</h5>
                                                </a>
                                            </div>
                                            <div class="nama-guru">
                                                <h6>{{ $item->mentor_nama ?? '-' }} <i class="fas fa-check-circle"></i>
                                                </h6>
                                            </div>
                                            <div class="jumlah-materi">
                                                <h6>{{ $item->class_jml_materi }} Materi</h6>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div id="hero-kelas" class="container ">
                <div class="tittle-kelas my-4">
                    <h3><a href="#"> Kelas Yang Tersedia </a></h3>
                    <p>Puluhan kelas yang bisa kamu ambil</p>
                </div>
                <div class="kelas-utama mb-3">
                    <div class="pilihan-kelas">
                        <div class="card-deck">
                            @foreach ($history->class_tidak_terdaftar as $index => $item)
                                @if ($index < 6) <button class="kelas">
                                        <div class="row py-4">
                                            <div class="col-lg-4">
                                                <img class="gambar-kelas" src="{{ $item->class_url_web }}"
                                                    width="160px" height="160px" srcset="">
                                            </div>
                                            <div class="col-lg-6 py-6 text-left">
                                                <div class="nama-kelas">
                                                    <a href="{{ route('class.detail', $children->class_uuid) }}"
                                                        style="text-decoration: none; color: black">
                                                        <h5 class="font-weight-bold">{{ $item->class_nama }}</h5>
                                                    </a>
                                                </div>
                                                <div class="nama-guru">
                                                    <h5> {{ $item->mentor_nama }} <i class="fas fa-check-circle"></i>
                                                    </h5>

                                                </div>
                                                <div class="jumlah-materi">
                                                    <h5>{{ $item->class_jml_materi }} Materi</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                @else @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @if (count($history->class_tidak_terdaftar) >= 7)
                        <div class="lainnya mt-3 mb-3" width="100%">
                            <center><button type='button' onclick="{{ route('class.index') }}"
                                    class='btn btn-lainnya text-center py-2 my-1'> Lainnya </button>
                            </center>
                        </div>
                @endif
            </div>
        </div>
    </div>
    @endsection @section('page-js')
    <script>
        $('#whykkuljaem').modal('show');
    </script>
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                infinite: true,
                dots: true,
            });
        });
    </script>
@endsection
