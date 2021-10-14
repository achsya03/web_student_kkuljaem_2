@extends('layouts.dashboard')

@section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
@endsection

@section('title')
    {{ env('APP_NAME') }} | Search
@endsection

@section('content')
    <!-- hero-dashboard -->
    <div id="hero-dashboard" class="container">
        @if ($account->status_member == 'Non-Member')
            <div class="row">
                <div class="col-lg-12 mx-auto banner-market">
                    <img src="{{ asset('assets/img/Bannerpromo.png') }}" height="auto" width="100%" alt="" srcset="">
                </div>
            </div>
        @else

        @endif

    </div>
    <!-- close-hero-dashboard -->
    <div id="title-bar" class="my-3">
        @if (!empty($data))
            <div class="container">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-forum" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            <h3>Forum ({{ $data->jml_forum }})</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-qna" role="tab"
                            aria-controls="pills-profile" aria-selected="false">
                            <h3>QnA({{ $data->jml_qna }})</h3>
                        </a>
                    </li>
                </ul>
            </div>
        @else
            <div class="container">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-forum" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            <h3>Forum (0)</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-qna" role="tab"
                            aria-controls="pills-profile" aria-selected="false">
                            <h3>QnA(0)</h3>
                        </a>
                    </li>
                </ul>
            </div>
    </div>
    @endif
    

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-forum" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="container">
            <div id="hasil-pencarian" class="container my-1">

                <h3>Hasil Pencarian untuk {{ Request::get('keyword') }} ({{ $data->jml_forum }})</h3>
            </div>
            @if ($data->jml_forum==0)
            <div id="hero-comment" class="container my-4" style="height: 500px">
              <div class="pict-kosong">
                <center><img src="{{ asset('assets/img/NoItem.png') }}" > </center>
              </div>
            </div>

            @else
            <div id="hero-comment" class="container mt-3">
              @foreach ($data->forum as $forum)
              
                <div class="komentar">
                    <div class="profil-comentar">
                        <div class="row">
                          <div class="col-lg-1">
                            <img src="{{ asset('assets/img/profile-1.png') }}" alt="Profile">
                        </div>
                        <div class="col-lg-10">
                            <h5>{{ $forum->nama_pengirim }} <img src="{{ asset('assets/img/crown_user.png') }}"
                                    alt="Profile"></h5>
                            <h6>{{ date('d m Y - H.i', strtotime($forum->tgl_post)) }}</h6>
                        </div>
                        </div>
                    </div>                    
                    <h4>{{ $forum->judul }}</h4>
                    <h6># <a href="#">{{ $forum->tema }}</a></h6>
                    <div class="like-comment">
                        <div class="row">
                            <i class="far fa-heart"></i>
                            <h7>{{ $forum->jml_like }} Suka </h7>
                            <i class="far fa-comment-alt-dots"> </i>
                            <h7>{{ $forum->jml_komen }}  Comments</h7>
                        </div>
                    </div>
                </div>               
                    
                @endforeach
            </div>
            <div class="lainnya mt-3 mb-3" width="100%">
                <center><button type='button' class='btn btn-lainnya text-center py-2 my-1'> Lainnya </button>
                </center>
            </div>
            @endif
        </div>
        </div>
        <div class="tab-pane fade" id="pills-qna" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div id="hasil-pencarian" class="container my-1">
                <h3>Hasil Pencarian untuk {{ Request::get('keyword') }} ({{ $data->jml_qna }})</h3>
            </div>
            @if ( $data->jml_qna ==0)
            <div id="hero-comment" class="container mt-3">
              <div class="pict-kosong">
                <center><img src="{{ asset('assets/img/NoItem.png') }}" align=" " alt="" srcset=""> </center>
              </div>
            </div>

            @else
            <div id="hero-comment" class="container mt-3">
              @foreach ($data->qna as $qna)
                <div class="komentar">
                    <div class="profil-comentar">
                        <div class="row">
                          <div class="col-lg-1">
                            <img src="{{ asset('assets/img/profile-1.png') }}" alt="Profile">
                        </div>
                        <div class="col-lg-10">
                            <h5>{{ $qna->nama_pengirim }} <img src="{{ asset('assets/img/crown_user.png') }}"
                                    alt="Profile"></h5>
                            <h6>{{ date('d m Y - H.i', strtotime($qna->tgl_post)) }}</h6>
                        </div>
                        </div>
                    </div>                    
                    <h4>{{ $qna->judul }}</h4>
                    <h6>di <a href="#">{{ $qna->tema }}</a></h6>
                    <div class="like-comment">
                        <div class="row">
                            <i class="far fa-heart"></i>
                            <h7>{{ $qna->jml_like }} Suka </h7>
                            <i class="far fa-comment-alt-dots"> </i>
                            <h7>{{ $qna->jml_komen }}  Comments</h7>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="lainnya mt-3 mb-3" width="100%">
                <center><button type='button' class='btn btn-lainnya text-center py-2 my-1'> Lainnya </button>
                </center>
            </div>
        </div>
    </div>
    @endif
    </div>

    
@endsection
