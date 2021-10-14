@extends('layouts.dashboard')

@section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/qna.css') }}" rel="stylesheet" />
@endsection

@section('title')
    {{ env('APP_NAME') }} | Qna
@endsection

@section('content')

    <div class="container mt-5">
        <ul class="nav top-menu mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link mr-4 ml-2 active" id="pills-jelajah-tab" data-toggle="pill" href="#jelajahi" role="tab">
                    <h3 class="top-menu font-weight-bold active">Jelajahi</h3>
                </a>
            </li>
            @php
                use Illuminate\Support\Facades\Auth;
                
            @endphp
            @if (Auth::guest())
                <li class="nav-item">
                    <a class="nav-link mr-4" id="pills-qna-tab" data-toggle="pill" href="#qna-saya" role="tab">
                        <h3 class="top-menu font-weight-bold">QnA Saya</h3>
                    </a>
                </li>
            @else
            @endif
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!-- .content-jelajahi -->
            <div class="tab-pane fade show active" id="jelajahi" role="tabpanel">
                @if ($account->status_member == 'Non-Member')
                    <div id="hero-promo">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <img src="Assets/img/Bannerpromo.png" height="200px" width="100%" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                @else

                @endif

                <!-- Pilih Kelas -->
                <div class="container">
                    <div class="row pilih-kelas">
                        <div class="col-4 p-0">
                            <div class="left">
                                <div class="form-group px-3 pt-3 pb-2 ">
                                    <label for="list-kelas">Level</label>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="dropdown list-list">
                                            <a class="dropdown-toggle form-control px-3 d-flex justify-content-between align-items-center "
                                                data-toggle="dropdown" id="list-kelas">--
                                                Pilih Level -- <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                @php
                                                    $tab = 1;
                                                    $taba = 1;
                                                @endphp
                                                @foreach ($qnaFilter as $index => $item)
                                                    <li>
                                                        <a class="d-inline-block w-100" href="#tab{{ $tab++ }}" role="tab" data-toggle="tab"
                                                           >{{ $item->category_nama }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                               
                                <div class="materi-scroll">
                                    <div class="tab-content" >
                                        @php
                                            $tabisi = 1;
                                            $videolist = 1;
                                            $videolistid = 1;
                                        @endphp
                                        @foreach ($qnaFilter as $index => $item)

                                            <div class="tab-pane " id="tab{{ $tabisi++ }}" >
                                                @foreach ($item->classes as $itemclass)

                                                    <h5 class="font-weight-bold ml-3">{{ $itemclass->class_nama }}</h5>
                                                    <a class=" list-group-item-action" role="tab" aria-controls="home">
                                                        <div class="d-flex flex-column py-2 px-3">
                                                            @foreach ($itemclass->videos as $classvideo)
                                                                <div class="listmateri my-2 px-2 rounded">
                                                                    <div id="myBtnContainer ">
                                                                        <button
                                                                            class="btn btn-filter d-flex align-items-center"
                                                                            id="{{ $classvideo->video_uuid }}">
                                                                            <i
                                                                                class="d-flex flex-column justify-content-center fas fa-play-circle fa-2x mr-3 "></i>
                                                                            <h6 class="d-flex text-left">
                                                                                {{ $classvideo->video_judul }}</h6>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 p-0">
                            <div class="container right">
                                <div id="parent">
                                    @forelse ($qna as $item)
                                        <div class="box {{ $item->video_uuid }}">
                                            <div class="container mb-2 ">
                                                <div class="comment-qna p-4 ">
                                                    <!-- profile and hamburger -->
                                                    <div class="d-flex justify-content-between mb-1 ">
                                                        <!-- profile -->
                                                        <div class="profile-qna">
                                                            <img src="../Assets/img/avatar.png " alt="Avatar "
                                                                class="float-left mr-3 ">
                                                            <div class="d-flex flex-column mt-2 ">
                                                                <h6> {{ $item->nama_pengirim }} <img
                                                                        src="../Assets/img/crown.png " alt="crown "></h6>
                                                                <p>{{ $item->tgl_post }}</p>
                                                            </div>
                                                        </div>
                                                        <!-- end profile -->

                                                        <!-- hamburger dot -->
                                                        <div class="dropdown hamburger-dot ">
                                                            <a class="btn dropdown" href="#" id="deletedropdowm"
                                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <img src="{{ asset('assets/img/3dot.png') }}" alt="">
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="delete">
                                                                @if ($item->nama_pengirim == $account->nama)
                                                                    <a class="dropdown-item d-flex text-center">
                                                                        <h6 class="mx-auto my-auto">Delete</h6>
                                                                    </a>
                                                                    <a class="dropdown-item d-flex text-center">
                                                                        <h6 class="mx-auto my-auto">Laporkan</h6>
                                                                    </a>
                                                                @else
                                                                    <a class="dropdown-item d-flex text-center">
                                                                        <h6 class="mx-auto my-auto">Laporkan</h6>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- end hamburger dot -->
                                                    </div>
                                                    <!-- end profile and hamburger -->

                                                    <h5>{{ $item->deskripsi }}</h5>
                                                    <div class="d-flex">
                                                        <h6 class="text-tag ml-1"> {{ $item->video_judul }}</h6>

                                                    </div>
                                                    <!-- like and comment -->
                                                    <div class="d-flex mt-3 like-comment ">
                                                        <button type="button " class="btn">
                                                            <i class="fas fa-heart active"></i>
                                                        </button>
                                                        <p class="mr-4 my-auto ">{{ $item->jml_like }} Suka</p>
                                                        <button type="button " class="btn">
                                                            <i class="far fa-comment-alt fa-flip-horizontal"></i>
                                                        </button>

                                                        <p class="my-auto ">{{ $item->jml_komen }} Comments</p>
                                                    </div>
                                                    <!-- end like and comment -->
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <div id="hero-comment" class="container mt-3">
                                            <div class="pict-kosong">
                                                <center><img src="Assets/img/NoItem.png" align=" " alt="" srcset="">
                                                </center>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            {{-- <!-- pagination -->
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
                            <!-- End Pagination --> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="qna-saya" role="tabpanel" aria-labelledby="pills-profile-tab">
                <!-- Title QnA -->
                <div class="container my-4">
                    <h4 class="font-weight-bold">Pertanyaan Saya (5)</h4>
                </div>
                <!-- End Title QnA -->
                @if (Auth::guest())
                @else
                    <div id="hero-promo" class="container">
                        <div class="row">
                            <div class="col-lg-12 mx-auto banner">
                                <img src="Assets/img/Bannerpromo.png" height="200px" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Comment QnA -->
                <div class="container mb-2">
                    <div class="comment-qna p-4 ">
                        <!-- profile and hamburger -->
                        <div class="d-flex justify-content-between mb-1 ">
                            <!-- profile -->
                            <div class="profile-qna">
                                <img src="{{ asset('assets/img/avatar.png') }} " alt="Avatar " class="float-left mr-3 ">
                                <div class="d-flex flex-column mt-2 ">
                                    <h6>Nanda Mohammad<img src="{{ asset('assets/img/crown.png') }} " alt="crown ">
                                    </h6>
                                    <p>12 10 2021 - 10.00AM</p>
                                </div>
                            </div>
                            <!-- end profile -->

                            <!-- hamburger dot -->
                            <div class="dropdown hamburger-dot ">
                                <a class="btn dropdown" href="#" id="deletedropdowm" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('assets/img/3dot.png') }}" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="delete">
                                    {{-- @if ($index->nama_pengirim == $account->nama) --}}
                                    <a class="dropdown-item d-flex text-center" href="#">
                                        <h6 class="mx-auto my-auto">Delete</h6>
                                    </a>
                                    <a class="dropdown-item d-flex text-center" href="#">
                                        <h6 class="mx-auto my-auto">Laporkan</h6>
                                    </a>
                                    {{-- @else --}}
                                    <a class="dropdown-item d-flex text-center" href="#">
                                        <h6 class="mx-auto my-auto">Laporkan</h6>
                                    </a>
                                    {{-- @endif --}}
                                </div>
                            </div>
                            <!-- end hamburger dot -->
                        </div>
                        <!-- end profile and hamburger -->

                        <h5>Bagaimana menghitung dalam bahasa Korea?</h5>
                        <div class="d-flex">
                            <h6>di </h6>
                            <h6 class="text-tag ml-1"> Pelajaran 12</h6>

                        </div>
                        <!-- like and comment -->
                        <div class="d-flex mt-3 like-comment ">
                            <button type="button " class="btn">
                                <i class="fas fa-heart active"></i>
                            </button>
                            <p class="mr-4 my-auto ">10 rb Suka</p>
                            <button type="button " class="btn">
                                <i class="far fa-comment-alt fa-flip-horizontal"></i>
                            </button>

                            <p class="my-auto ">10 rb Comments</p>
                        </div>
                        <!-- end like and comment -->
                    </div>
                </div>



                <!-- End Comment Qna -->

                {{-- <!-- pagination -->
                <nav aria-label="Page navigation example ">
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
                <!-- End Pagination --> --}}

            </div>
            <!-- end content qna saya -->
        </div>
    </div>
    </div>
@endsection

@section('page-js')
<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script>
        var $btns = $('.btn-filter').click(function() {
            if (this.id == 'all') {
                $('#parent > div').fadeIn(450);
            } else {
                var $el = $('.' + this.id).fadeIn(450);
                $('#parent > div').not($el).hide();
            }
            $btns.removeClass('active');
            $(this).addClass('active');
        })
    </script>

    {{-- <script>
        $('#demo').pagination({
            dataSource: [1, 2, 3, 4, 5, 6, 7, ..., 195],
            callback: function(data, pagination) {
                // template method of yourself
                var html = template(data);
                dataContainer.html(html);
            }
        })
    </script> --}}
@endsection
