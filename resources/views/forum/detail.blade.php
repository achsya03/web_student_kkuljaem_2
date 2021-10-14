@extends('layouts.dashboard')

@section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/forum.css') }}" rel="stylesheet" />


@endsection

@section('title')
    {{ env('APP_NAME') }} | Forum
@endsection

@section('content')
    <!-- Detail Comment QnA -->
    <div class="container my-4">
        @foreach ($forum->posting as $item)

            <div class="comment-qna p-4 detail" id="qna-detail">
                <div class="d-flex justify-content-between mb-1 ">
                    <div class="profile-qna">
                        <img src="{{ asset('assets/img/avatar.png') }}" alt="Avatar " class="float-left mr-3 img-comment">
                        <div class="d-flex flex-column mt-2 ">
                        <h6 class="font-weight-bold">{{ $item->nama_pengirim }} @if ($account->status_member == 'Non-Member') @else
                                    <img src="{{ asset('assets/img/crown_user.png') }}" alt="Profile">
                                @endif
                            </h6>
                            <p>{{ date('d m Y - H.i', strtotime($item->tgl_post)) }}</p>

                        </div>
                    </div>
                    <!-- hamburger dot -->

                    <!-- end hamburger dot -->
                </div>
                <h5 class="font-weight-bold">{{ $item->judul }}</h5>
                <h6 class="text-tag">{{ $item->tema }}</h6>
                <p>{{ $item->deskripsi }}</p>
                @if (@!isset($item->gambar))
                        @else
                            <div class="card-deck">
                                <div class="d-flex ">
                                    @foreach ($item->gambar as $gambaritem)
                                        <a><img src="{{ $gambaritem->url_gambar }}" alt="No Image"
                                                class="img-comment mx-2"></a>
                                    @endforeach
                                </div>
                            </div>

                        @endif
                <!-- like and comment -->
                <div class="d-flex mt-3 like-comment ">
                    @if ($item->user_like == 'True')
                        <a href="{{ route('forum.unlike_post', $item->post_uuid) }}" style="text-decoration: none"
                            class="btn">
                            <i class="fas fa-heart active"></i>
                        </a>
                    @elseif($item->user_like=='False')
                        <a href="{{ route('forum.like_post', $item->post_uuid) }}" style="text-decoration: none"
                            class="btn">
                            <i class="far fa-heart"></i>
                        </a>
                    @endif
                    <p class="mr-4 my-auto ">{{ $item->jml_like }} Suka</p>
                    <button type="button " class="btn">
                        <i class="far fa-comment-alt-dots fa-flip-horizontal"></i>
                    </button>

                    <p class="my-auto ">{{ $item->jml_komen }} Comments</p>
                </div>
                <!-- end like and comment -->
            </div>
        @endforeach
        <!-- Form Send -->
        <form action="{{ route('forum.create_comment') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="d-flex justify-content-between align-items-center form-send">
                <img src="{{ asset('assets/img/avatar.png') }}" alt="Avatar " class="img-comment">
                <textarea class="form-control" name="komentar" id="" required placeholder="Tulis Jawabanmu..."></textarea>
                <button type="submit" class="btn btn-send-circle rounded-circle"><img
                        src="{{ asset('assets/img/send-icon.png') }}" alt="send" class="rounded-circle p-2"></button>

            </div>
        </form>
        <!-- End Form Send -->
    </div>

    <!-- Detail Comment -->
    <div class="container ">
        @foreach ($forum->comment as $value)
            <div class="all-list-detail-comment">
                <div class="detail-comment p-2">
                    <div class="d-flex justify-content-between mb-1 ">
                        <div class="profile-qna">
                            <img src="{{ $value->user_foto }}" alt="Avatar2 "
                                class="rounded-circle float-left mr-3 img-detail-comment">
                            <div class="d-flex flex-column mt-2 ">
                            <h6 class="font-weight-bold">{{ $value->comment_nama }} @if ($account->status_member == 'Non-Member') @else
                                        <img src="{{ asset('assets/img/crown_user.png') }}" alt="crown">
                                    @endif
                                </h6>
                                <p>{{ date('d m Y - H.i', strtotime($value->comment_tgl)) }}</p>
                            </div>
                        </div>
                        <!-- hamburger dot -->

                        <!-- hamburger dot -->
                        <div class="hamburger-dot ">
                            <a class="nav-link" href="#" id="deletedropdowm" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <button class="btn">
                                    <img src="{{ asset('assets/img/3dot.png') }}" alt="">
                                </button>
                            </a>

                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="delete">
                                @if ($value->comment_nama == $account->nama)
                                    <form action="{{ route('forum.delete_comment') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $value->comment_uuid }}">
                                        <input type="hidden" name="detail_id" value="{{ $id }}">
                                        <button type="submit" class="dropdown-item d-flex text-center">
                                            <h6 class="mx-auto my-auto">Delete</h6>
                                        </button>
                                    </form>
                                    <form action="{{ route('forum.delete_comment') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $value->comment_uuid }}">
                                        <input type="hidden" name="detail_id" value="{{ $id }}">
                                        <button type="submit" class="dropdown-item d-flex text-center">
                                            <h6 class="mx-auto my-auto">Laporkan</h6>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('forum.delete_comment') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $value->comment_uuid }}">
                                        <input type="hidden" name="detail_id" value="{{ $id }}">
                                        <button type="submit" class="dropdown-item d-flex text-center">
                                            <h6 class="mx-auto my-auto">Laporkan</h6>
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                        <!-- end hamburger dot -->



                        <!-- end hamburger dot -->
                    </div>
                    <p><b>{{ $value->comment_isi }}</b>
                    </p>
                </div>
        @endforeach

    </div>
    </div>
    <!-- End Detail Comment -->

@endsection
