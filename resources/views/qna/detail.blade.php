@extends('layouts.dashboard')

@section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/qna.css') }}" rel="stylesheet" />


@endsection

@section('title')
    {{ env('APP_NAME') }} | Qna
@endsection

@section('content')
<!-- Detail Comment QnA -->
<div class="container my-4">
    @foreach ($qna->posting as $item)        
    
    <div class="comment-qna p-4 detail" id="qna-detail">
        <div class="d-flex justify-content-between mb-1 ">
            <div class="profile-qna">
                <img src="{{ asset('assets/img/avatar.png') }}" alt="Avatar " class="float-left mr-3 img-comment">
                <div class="d-flex flex-column mt-2 ">
                    <h6>{{$item->nama_pengirim}}<img src="{{ asset('assets/img/crown.png') }}" alt="crown "></h6>
                    <p>{{ date('d m Y - H.i', strtotime($item->tgl_post)) }}</p>

                </div>
            </div>
            <!-- hamburger dot -->
            
            <!-- end hamburger dot -->
        </div>
        <h5>{{$item->judul}}</h5>
        <div class="d-flex">
            <h6>di </h6>
            <h6 class="text-tag ml-1"> {{$item->video_judul}}</h6>
        </div>
        <p>{{$item->deskripsi}}</p>
        <div class="d-flex ">
            <a href="">
                <img src="{{ $item->gambar->url_gambar ?? '' }}" alt="No Image"
                    class="img-comment ">
            </a>
        </div>
        <!-- like and comment -->
        <div class="d-flex mt-3 like-comment ">
            @if($item->user_like=='True')
                        <a href="{{route('qna.unlike_comment', $item->post_uuid)}}" style="text-decoration: none" class="btn">
                        <i class="fas fa-heart active"></i>
                        </a> 
                        @elseif($item->user_like=='False')
                        <a href="{{route('qna.like_comment', $item->post_uuid)}}" style="text-decoration: none" class="btn">
                        <i class="far fa-heart"></i>
                        </a> 
                        @endif
            <p class="mr-4 my-auto ">{{$item->jml_like}} Suka</p>
            <button type="button " class="btn">
                <i class="far fa-comment-alt-dots fa-flip-horizontal"></i>
            </button>

            <p class="my-auto ">{{$item->jml_komen}} Comments</p>
        </div>
        <!-- end like and comment -->
    </div>
    @endforeach
    <!-- Form Send -->
    <form
    action="{{ route('qna.create_comment') }}" method="POST">
    @csrf
        <input type="hidden" name="id" value="{{$id}}">
        <div class="d-flex justify-content-between align-items-center form-send">
            <img src="{{asset('assets/img/avatar.png') }}" alt="Avatar " class="img-comment">
            <textarea class="form-control" name="komentar" id="" required placeholder="Tulis Jawabanmu..."></textarea>
            <button type="submit" class="btn btn-send-circle rounded-circle"><img src="{{asset('assets/img/send-icon.png') }}"
                    alt="send" class="rounded-circle p-2"></button>

        </div>
    </form>
    <!-- End Form Send -->
</div>

<!-- Detail Comment -->
<div class="container ">
    @foreach ($qna->comment as $value)
    <div class="all-list-detail-comment">
        <div class="detail-comment p-2">
            <div class="d-flex justify-content-between mb-1 ">
                <div class="profile-qna">
                    <img src="{{$value->user_foto}}" alt="Avatar2 " class="float-left mr-3 img-detail-comment">
                    <div class="d-flex flex-column mt-2 ">
                        <h6>{{$value->comment_nama}} <img src="{{asset('assets/img/blue-check.png') }}" alt="crown "></h6>
                        <p>{{ date('d m Y - H.i', strtotime($value->comment_tgl)) }}</p>
                    </div>
                </div>
                <!-- hamburger dot -->
                @if ($value->comment_nama == $account->nama)
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
                        <form
                            action="{{ route('qna.delete_comment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$value->comment_uuid}}">
                            <input type="hidden" name="detail_id" value="{{$id}}">
                        <button type="submit" class="dropdown-item d-flex text-center">
                            <h6 class="mx-auto my-auto">Delete</h6>
                        </button>
                    </form>
                    </div>
                </div>
                <!-- end hamburger dot -->
            

            @endif
                <!-- end hamburger dot -->
            </div>
            <p><b>{{$value->comment_isi}}</b>
            </p>
        </div>
        @endforeach
        
    </div>
</div>
<!-- End Detail Comment -->

@endsection