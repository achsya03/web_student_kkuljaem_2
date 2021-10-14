@extends('layouts.dashboard')

@section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/forum.css') }}" rel="stylesheet" />


@endsection

@section('title')
    {{ env('APP_NAME') }} | Topik
@endsection

@section('content')
    <!-- End Navbar -->
    <div class="container mt-4">
        <h3 class="font-weight-bold">{{ $data->theme->judul }}</h2>
    </div>

    <!-- Top Menu -->
    <div id="title-bar" class="my-3">
        <div class="container">
            <ul class="nav top-menu nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item mr-4">
                    <a class="nav-link active" id="pills-terpopuler-tab" data-toggle="pill" href="#pills-terpopuler"
                        role="tab" aria-controls="pills-terpopuler" aria-selected="true">
                        <h3 class="font-weight-bold">Terpopuler</h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-terbaru-tab" data-toggle="pill" href="#pills-terbaru" role="tab"
                        aria-controls="pills-terbaru" aria-selected="false">
                        <h3 class="font-weight-bold">Terbaru</h3>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- End Top Menu -->

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-terpopuler" role="tabpanel" aria-labelledby="pills-terpopuler-tab">
            <!-- Banner Promo -->
            @if ($account->status_member == 'Non-Member')
                <div id="hero-promo" class="container">
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <img src="{{ asset('assets/img/Bannerpromo.png') }}" width="100%" height="200px" alt=""
                                srcset="">
                        </div>
                    </div>
                </div>
            @else

            @endif
            <!-- End Banner Promo -->

            <!-- Comment Forum -->
            @foreach ($data->forum as $index => $value)

                <div class="container mb-2">
                    <div class="comment-forum p-4 ">
                        <div class="d-flex justify-content-between mb-1 ">
                            <div class="profile-forum">
                                <img src="{{ asset('assets/img/avatar.png') }}" alt="Avatar " class="float-left mr-3 ">
                                <div class="d-flex flex-column mt-2 ">
                                    <h6>{{ $value->nama_pengirim ?? '' }}<img src="{{ asset('assets/img/crown.png') }}"
                                            alt="crown "></h6>
                                    <p>{{ date('d m Y - H.i', strtotime($value->tgl_post)) ?? '' }}</p>

                                </div>
                            </div>
                            @if ($value->nama_pengirim == $account->nama)
                                <!-- hamburger dot -->
                                <div class="hamburger-dot ">
                                    <a class="nav-link" href="#" id="deletedropdowm" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn">
                                            <img src="{{ asset('assets/img/3dot.png') }}" alt="">
                                        </button>
                                    </a>
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="delete">
                                        <a class="dropdown-item d-flex text-center"
                                            href="{{ route('forum.delete', $value->post_uuid) }}">
                                            <h6 class="mx-auto my-auto">Delete</h6>
                                        </a>
                                    </div>
                                </div>
                                <!-- end hamburger dot -->


                            @endif

                        </div>
                        <h5>{{ $value->judul }}a</h5>
                        <h6 class="text-tag ">{{ $value->tema }}</h6>
                        <p>{{ $value->deskripsi }}
                        </p>
                        @if (@!isset($value->gambar))
                        @else
                            <div class="pict-comentar ml-3">
                                <div class="card-deck">
                                    @foreach ($value->gambar as $gambaritem)
                                        <img class="rounded mr-3" src="{{ $gambaritem->url_gambar }}" width="150px"
                                            height="120px" alt="">
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="d-flex mt-3 like-comment ">

                            @if ($value->user_like == 'True')
                                <a href="{{ route('forum.unlike_post', $value->post_uuid) }}"
                                    style="text-decoration: none" class="btn">
                                    <i class="fas fa-heart active"></i>
                                </a>
                            @elseif($value->user_like=='False')
                                <a href="{{ route('forum.like_post', $value->post_uuid) }}" style="text-decoration: none"
                                    class="btn">
                                    <i class="far fa-heart"></i>
                                </a>
                            @endif


                            <p class="mr-4 my-auto ">{{ $value->jml_like }} Suka</p>
                            <button type="button " class="btn">
                                <i class="far fa-comment-alt-dots fa-flip-horizontal mr-2 my-auto "></i>
                            </button>

                            <a href="{{ route('forum.detail', $value->post_uuid) }}" style="text-decoration: none">
                                <p class="my-auto ">{{ $value->jml_komen }} Comments</p>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
            <!-- End Comment Forum -->

            <!-- pagination -->
            <nav aria-label="Page navigation example pt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link page-prev-next" href="#">Prev</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">1</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">...</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">11</a></li>
                    <li class="page-item"><a class="page-link page-number active" href="#">12</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">13</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">...</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">15</a></li>
                    <li class="page-item"><a class="page-link page-prev-next" href="#">Next</a></li>
                </ul>
            </nav>
            <!-- End Pagination -->

            <!-- Title Forum -->
            <div class="container mt-5">
                <h4 class="font-weight-bold">Topik Lainnya</h4>
                <p class="">Bacaan yang tidak kalah menarik</p>
            </div>
            <!-- End Title Forum -->

            <div class="
                    container hastag">

                <div class="kelas-utama">
                    <div class="pilihan-kelas">
                        <div class="card-deck">
                            @foreach ($themes as $index => $theme)
                                @if ($index < 3)
                                    <a href="{{ route('forum.topik', $theme->theme_uuid) }}" class="topik-tag"
                                        style="background-image: url({{ asset('assets/img/topik-tag.png)') }}; text-decoration: none">


                                        <h3 class="text-white">{{ $theme->judul }}</h3>
                                    </a>
                                @else
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
                @foreach ($themes as $index => $theme)
                    @if ($index > 2)
                        <div class="d-flex mt-4">
                            <h5 class=" text-hastag"><a href="">#04 Kpop</a></h5>
                            <h5 class=" text-hastag"><a href="">#05 Kdrama</a></h5>
                            <h5 class=" text-hastag"><a href="">More</a></h5>
                        </div>
                    @else
                    @endif
                @endforeach
            </div>

        </div>




        <!-- end content terpopuler -->


        <!-- content posting saya -->
        <div class="tab-pane fade show" id="pills-terbaru" role="tabpanel" aria-labelledby="pills-terbaru-tab">

            <!-- Banner Promo -->
            @if ($account->status_member == 'Non-Member')
                <div id="hero-promo" class="container">
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <img src="{{ asset('assets/img/Bannerpromo.png') }}" width="100%" height="200px" alt=""
                                srcset="">
                        </div>
                    </div>
                </div>
            @else

            @endif
            <!-- End Banner Promo -->

            <!-- Comment Forum -->
            @foreach ($data->forum as $index => $value)

                <div class="container mb-2">
                    <div class="comment-forum p-4 ">
                        <div class="d-flex justify-content-between mb-1 ">
                            <div class="profile-forum">
                                <img src="{{ asset('assets/img/avatar.png') }}" alt="Avatar " class="float-left mr-3 ">
                                <div class="d-flex flex-column mt-2 ">
                                    <h6>{{ $value->nama_pengirim ?? '' }}<img
                                            src="{{ asset('assets/img/crown.png') }}" alt="crown "></h6>
                                    <p>{{ date('d m Y - H.i', strtotime($value->tgl_post)) ?? '' }}</p>

                                </div>
                            </div>
                            @if ($value->nama_pengirim == $account->nama)
                                <!-- hamburger dot -->
                                <div class="hamburger-dot ">
                                    <a class="nav-link" href="#" id="deletedropdowm" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn">
                                            <img src="{{ asset('assets/img/3dot.png') }}" alt="">
                                        </button>
                                    </a>
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="delete">
                                        <a class="dropdown-item d-flex text-center"
                                            href="{{ route('forum.delete', $value->post_uuid) }}">
                                            <h6 class="mx-auto my-auto">Delete</h6>
                                        </a>
                                    </div>
                                </div>
                                <!-- end hamburger dot -->


                            @endif

                        </div>
                        <h5>{{ $value->judul }}a</h5>
                        <h6 class="text-tag ">{{ $value->tema }}</h6>
                        <p>{{ $value->deskripsi }}
                        </p>
                        @if (@!isset($value->gambar))
                        @else
                            <div class="pict-comentar ml-3">
                                <div class="card-deck">
                                    @foreach ($value->gambar as $gambaritem)
                                        <img class="rounded mr-3" src="{{ $gambaritem->url_gambar }}" width="150px"
                                            height="120px" alt="">
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="d-flex mt-3 like-comment ">

                            @if ($value->user_like == 'True')
                                <a href="{{ route('forum.unlike_post', $value->post_uuid) }}"
                                    style="text-decoration: none" class="btn">
                                    <i class="fas fa-heart active"></i>
                                </a>
                            @elseif($value->user_like=='False')
                                <a href="{{ route('forum.like_post', $value->post_uuid) }}" style="text-decoration: none"
                                    class="btn">
                                    <i class="far fa-heart"></i>
                                </a>
                            @endif


                            <p class="mr-4 my-auto ">{{ $value->jml_like }} Suka</p>
                            <button type="button " class="btn">
                                <i class="far fa-comment-alt-dots fa-flip-horizontal mr-2 my-auto "></i>
                            </button>

                            <a href="{{ route('forum.detail', $value->post_uuid) }}" style="text-decoration: none">
                                <p class="my-auto ">{{ $value->jml_komen }} Comments</p>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach

            <nav aria-label="Page navigation example pt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link page-prev-next" href="#">Prev</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">1</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">...</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">11</a></li>
                    <li class="page-item"><a class="page-link page-number active" href="#">12</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">13</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">...</a></li>
                    <li class="page-item"><a class="page-link page-number" href="#">15</a></li>
                    <li class="page-item"><a class="page-link page-prev-next" href="#">Next</a></li>
                </ul>
            </nav>
        </div>

        <!-- End Comment Forum -->

        <!-- pagination -->

        <!-- End Pagination -->

    </div>

    </div>
    <!-- end content posting saya -->

    </div>
    <!-- end tab content -->
    </div>
    <!-- End Top Menu -->

    <!-- End Top Menu -->

@endsection
