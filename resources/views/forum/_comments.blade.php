<div id="overlay" style="display:none;">
    <div class="spinner"></div>
    <br />
    Loading...
</div>
<div id="comment" style="position: relative;">
    @foreach ($forums as $index => $forum)
    <div class="container mb-2">
        <div class="comment-forum p-4 ">
            <div class="d-flex justify-content-between mb-1 ">
                <div class="profile-forum">
                    <img src="{{ asset('assets/img/avatar.png') }}" alt="Avatar " class="float-left mr-3 ">
                    <div class="d-flex flex-column mt-2 ">
                        <h6>{{ $forum->nama_pengirim }} @if ($account->status_member == 'Non-Member') @else
                            <img src="{{ asset('assets/img/crown_user.png') }}" alt="Crown">
                            @endif
                            <p class="mt-2">{{ date('d m Y - H.i', strtotime($forum->tgl_post)) }}
                            </p>

                    </div>
                </div>
                <!-- hamburger dot -->
                <div class="dropdown show hamburger-dot ">
                    <a class="btn dropdown" href="#" id="deletedropdowm" role="button" data-toggle="dropdown">
                        <img src="{{ asset('assets/img/3dot.png') }}" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="delete">
                        @if ($forum->nama_pengirim == $account->nama)
                        <a class="dropdown-item d-flex text-center"
                            href="{{ route('forum.delete', $forum->post_uuid) }}">
                            <h6 class="mx-auto my-auto">Delete</h6>
                        </a>
                        <a class="dropdown-item d-flex text-center"
                            href="{{ route('forum.delete', $forum->post_uuid) }}">
                            <h6 class="mx-auto my-auto">Laporkan</h6>
                        </a>
                        @else
                        <a class="dropdown-item d-flex text-center"
                            href="{{ route('forum.delete', $forum->post_uuid) }}">
                            <h6 class="mx-auto my-auto">Laporkan</h6>
                        </a>
                        @endif
                    </div>
                </div>
                <!-- end hamburger dot -->
            </div>
            <h5>{{ $forum->judul }}</h5>
            <h6 class="text-tag ">{{ $forum->tema }}</h6>
            <p>{{ $forum->deskripsi }}
            </p>
            @if (@!isset($forum->gambar))
            @else
            <div class="card-deck">
                <div class="d-flex ">
                    @foreach ($forum->gambar as $gambaritem)
                    <a><img src="{{ $gambaritem->url_gambar }}" alt="No Image" class="img-comment mx-2"></a>
                    @endforeach
                </div>
            </div>

            @endif
            <div class="d-flex mt-3 like-comment ">
                @if ($forum->user_like == 'True')
                <a href="{{ route('forum.unlike_post', $forum->post_uuid) }}" style="text-decoration: none" class="btn">
                    <i class="fas fa-heart active"></i>
                </a>
                @elseif($forum->user_like=='False')
                <a href="{{ route('forum.like_post', $forum->post_uuid) }}" style="text-decoration: none" class="btn">
                    <i class="far fa-heart"></i>
                </a>
                @endif
                <p class="mr-4 mt-2 ">{{ $forum->jml_like }} Suka</p>

                <a href="{{ route('forum.detail', $forum->post_uuid) }}" style="text-decoration: none" class="btn">
                    <div class="d-flex">
                        <i class="far fa-comment-alt fa-flip-horizontal mr-2"></i>
                        <p class="">{{ $forum->jml_komen }} Comments</p>
                    </div>
                </a>


            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- pagination -->
<nav aria-label="Page navigation example pt-5">
    <ul class="pagination pagination-forum justify-content-center">
        <li class="page-item"><a class="page-link page-prev-next" href="{{route('forum.index')}}" data-page="{{$page-1 > 0 ? $page-1 : 1}}">Prev</a>
        </li>
            @foreach ($pageNumber as $number)
                @if ($number == "...")
                <li class="page-item"><a class="page-link page-number" style="pointer-events: none;cursor: default;">{{$number}}</a></li>
                @else
                <li class="page-item"><a class="page-link page-number" href="{{route('forum.index')}}" data-page="{{$number}}">{{$number}}</a></li>    
                @endif
                
            @endforeach
            <li class="page-item"><a class="page-link page-prev-next" href="{{route('forum.index')}}" data-page="{{$page+1 < $total_page_forum ? $page+1 : $total_page_forum}}">Next</a>
            </li>
    </ul>
</nav>
<!-- End Pagination -->