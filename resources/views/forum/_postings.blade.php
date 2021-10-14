<div id="overlay" class="overlay-user" style="display:none;">
    <div class="spinner"></div>
    <br />
    Loading...
</div>
<div id="post">
    @foreach ($forum_user as $index)
    <div class="container mb-2">
        <div class="comment-forum p-4 ">
            <div class="d-flex justify-content-between mb-1 ">
                <div class="profile-forum">
                    <img src="{{ asset('assets/img/avatar.png') }}" alt="Avatar " class="float-left mr-3 ">
                    <div class="d-flex flex-column mt-2 ">
                        <h6>{{ $index->nama_pengirim }} @if ($account->status_member == 'Non-Member')
                            @else
                            <img src="{{ asset('assets/img/crown_user.png') }}" alt="Crown">
                            @endif
                        </h6>
                        <p class="mt-2">
                            {{ date('d m Y - H.i', strtotime($index->tgl_post)) }}
                        </p>

                    </div>
                </div>
                <!-- hamburger dot -->
                <div class="dropdown hamburger-dot ">
                    <a class="btn dropdown" href="#" id="deletedropdowm" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('assets/img/3dot.png') }}" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="delete">
                        @if ($index->nama_pengirim == $account->nama)
                        <a class="dropdown-item d-flex text-center"
                            href="{{ route('forum.delete', $index->post_uuid) }}">
                            <h6 class="mx-auto my-auto">Delete</h6>
                        </a>
                        <a class="dropdown-item d-flex text-center"
                            href="{{ route('forum.delete', $index->post_uuid) }}">
                            <h6 class="mx-auto my-auto">Laporkan</h6>
                        </a>
                        @else
                        <a class="dropdown-item d-flex text-center"
                            href="{{ route('forum.delete', $index->post_uuid) }}">
                            <h6 class="mx-auto my-auto">Laporkan</h6>
                        </a>
                        @endif
                    </div>
                </div>
                <!-- end hamburger dot -->
            </div>
            <h5>{{ $index->judul }}</h5>
            <h6 class="text-tag ">{{ $index->tema }}</h6>
            <p>{{ $index->deskripsi }}</p>
            @if (@!isset($index->gambar))
            @else
            <div class="card-deck">
                <div class="d-flex ">
                    @foreach ($index->gambar as $gambaritem)
                    <a><img src="{{ $gambaritem->url_gambar }}" alt="No Image" class="img-comment mx-2"></a>
                    @endforeach
                </div>
            </div>

            @endif
            <div class="d-flex mt-3 like-comment ">
                @if ($index->user_like == 'True')
                <a href="{{ route('forum.unlike_post', $index->post_uuid) }}" style="text-decoration: none" class="btn">
                    <i class="fas fa-heart active"></i>
                </a>
                @elseif($index->user_like=='False')
                <a href="{{ route('forum.like_post', $index->post_uuid) }}" style="text-decoration: none" class="btn">
                    <i class="far fa-heart"></i>
                </a>
                @endif
                <p class="mr-4 my-auto ">{{ $index->jml_like }} Suka</p>
                <i class="far fa-comment-alt fa-flip-horizontal mr-2 my-auto "></i>
                <a href="{{ route('forum.detail', $index->post_uuid) }}" style="text-decoration: none">
                    <p class="my-auto ">{{ $index->jml_komen }} Comments</p>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- pagination -->
<nav aria-label="Page navigation example pt-5">
    <ul class="pagination pagination-user justify-content-center">
        <li class="page-item"><a class="page-link page-prev-next" href="{{route('forum.index')}}"
                data-page="{{$pageUser-1 > 0 ? $pageUser-1 : 1}}">Prev</a>
        </li>
        @foreach ($pageNumberUser as $number)
        @if ($number == "...")
        <li class="page-item"><a class="page-link page-number"
                style="pointer-events: none;cursor: default;">{{$number}}</a></li>
        @else
        <li class="page-item"><a class="page-link page-number" href="{{route('forum.index')}}"
                data-page="{{$number}}">{{$number}}</a></li>
        @endif

        @endforeach
        <li class="page-item"><a class="page-link page-prev-next" href="{{route('forum.index')}}"
                data-page="{{$pageUser+1 < $total_page_user ? $pageUser+1 : $total_page_user}}">Next</a>
        </li>
    </ul>
</nav>
<!-- End Pagination -->