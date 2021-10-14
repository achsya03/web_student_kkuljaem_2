@extends('layouts.dashboard')

@section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/forum.css') }}" rel="stylesheet" />


@endsection

@section('title')
    {{ env('APP_NAME') }} | Forum
@endsection

@section('content')

    <!-- Top Menu -->
    <div id="title-bar" class="my-3">
        <div class="container">
            <ul class="nav top-menu nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active  " id="pills-jelajahi-tab" data-toggle="pill" href="#pills-jelajahi" role="tab"
                        aria-controls="pills-jelajahi" aria-selected="true">
                        <h3 class="top-menu font-weight-bold active">Jelajahi</h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ml-3" id="pills-postingan-tab" data-toggle="pill" href="#pills-postingan" role="tab"
                        aria-controls="pills-postingan" aria-selected="false">
                        <h3 class="top-menu font-weight-bold">Postingan Saya</h3>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- End Top Menu -->

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-jelajahi" role="tabpanel" aria-labelledby="pills-jelajahi-tab">
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

            <!-- Title Forum -->
            <div class="container mt-4">
                <h4 class="font-weight-bold">Topik Terpopuler</h4>
                <p class="">Bacaan terpopuler saat ini</p>
        </div>
        <!-- End Title Forum -->

        <!-- Hastag -->

        <div class="
                    container hastag">
                <div class="kelas-utama">
                    <div class="pilihan-kelas">
                        <div class="container">
                            <div class="card-deck">
                                @foreach ($themes as $index => $theme)
                                    @if ($index == 0)
                                        <a href="{{ route('forum.topik', $theme->theme_uuid) }}" class="topik-tag"
                                            style="background-image: url({{ asset('assets/img/tag-makanan.jpg)') }}; text-decoration: none">
                                            <h3 class="text-white">#{{ $theme->judul }}</h3>
                                        </a>
                                    @elseif ($index == 1)
                                        <a href="{{ route('forum.topik', $theme->theme_uuid) }}" class="topik-tag"
                                            style="background-image: url({{ asset('assets/img/tag-aktor.jpg)') }}; text-decoration: none">
                                            <h3 class="text-white">#{{ $theme->judul }}</h3>
                                        </a>
                                    @elseif ($index == 2)
                                        <a href="{{ route('forum.topik', $theme->theme_uuid) }}" class="topik-tag"
                                            style="background-image: url({{ asset('assets/img/tag-artis.jpg)') }}; text-decoration: none">
                                            <h3 class="text-white">#{{ $theme->judul }}</h3>
                                        </a>
                                    @elseif ($index > 2)
                                        <div class="d-flex mt-4">
                                            <h5 class="text-hastag"><a
                                                    href="{{ route('forum.topik', $theme->theme_uuid) }}">{{ $theme->judul }}</a>
                                            </h5>
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>
                {{-- @foreach ($themes as $index => $theme)
                    
                    @else
                    @endif
                @endforeach --}}
            </div>


            <!-- End Hastag -->

            <!-- Title Forum Comment -->
            <div class="container mt-5 pt-4">
                <h4 class="font-weight-bold ">Forum Terpilih</h4>
                <p class=" mb-4">Bacaan pilihan editor</p>
            </div>
            <!-- End Title Forum Comment -->

            <!-- Comment Forum -->
            <section class="comments">
                @include('forum._comments')
            </section>

        </div>
        <div class="tab-pane fade show" id="pills-postingan" role="tabpanel" aria-labelledby="pills-postingan-tab">
            <div class="container">
                <div class="form-pengisian mt-3 p-4">
                    <h4 class="font-weight-bold">Buat Postingan Baru</h4>
                    <form enctype="multipart/form-data" class="form theme-form pb-5 f1"
                        action="{{ route('forum.create_post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" required name="judul" class="form-control" id=""
                                        placeholder="Masukkan judul postingan">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <select id="inputtag" name="theme" class="form-control">
                                        @foreach ($themes as $index => $theme)
                                            <option value="{{ $theme->theme_uuid }}">
                                                {{ $theme->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control mb-2" id="text-area-postingan" name="deskripsi" rows="5"
                                        placeholder="Masukkan isi dari postingan"></textarea>
                                    <small id="chars"></small><small> huruf</small>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="row">
                                <div class="form-group increment">
                                    <div class="input-group">
                                        <div class="tambah-gambar d-flex flex-column align-items-center">
                                            <input type="file" id="photo" name="post_image[]" onchange="loadFile(event)">
                                            {{-- <label for="photo" class="btn-choose text-center">Choose File</label> --}}
                                            <img src="{{ asset('assets/img/plus-foto.png') }}" class="btn-add"
                                                id="output" width="100px" height="100px" />
                                        </div>
                                    </div>
                                    <div class="clone invisible">
                                        <div class="input-group">
                                            <div class="tambah-gambar d-flex flex-column align-items-center">
                                                <input type="file" id="photo" name="post_image[]"
                                                    onchange="loadFile(event)">
                                                {{-- <label for="photo" class="btn-choose text-center">Choose File</label> --}}
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-danger btn-remove">
                                                        <i class="fas fa-minus-square"></i>

                                                    </button>
                                                    {{-- <img src="{{ asset('assets/img/plus-foto.png') }}"
                                                class="btn-remove" id="output"
                                                width="100px" height="100px" /> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-posting mt-auto">Posting</button>
                        </div>
                    </form>

                </div>
                <!-- Title Forum Comment -->
                <div class="container mt-5 mb-2 pt-4">
                    <h4 class="font-weight-bold ">Posting Saya ({{ $forum_user_count }})</h4>
                </div>
                <!-- End Title Forum Comment -->
                <section class="posts">
                    @include('forum._postings')
                </section>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var loadFil = function(event) {
            var output = document.getElementById('outpu');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
    <script>
        window.action = "submit"
        jQuery(document).ready(function() {
            jQuery(".btn-add").click(function() {
                let markup = jQuery(".invisible").html();
                jQuery(".increment").append(markup);
            });
            jQuery("body").on("click", ".btn-remove", function() {
                jQuery(this).parents(".input-group").remove();
            })
        })
    </script>
    <script>
        (function($) {
            $.fn.extend({
                limiter: function(limit, elem) {
                    $(this).on("keyup focus", function() {
                        setCount(this, elem);
                    });

                    function setCount(src, elem) {
                        var chars = src.value.length;
                        if (chars > limit) {
                            src.value = src.value.substr(0, limit);
                            chars = limit;
                        }
                        elem.html(limit - chars);
                    }
                    setCount($(this)[0], elem);
                }
            });
        })(jQuery);

        var elem = $("#chars");
        $("#text-area-postingan").limiter(200, elem);
    </script>
    <script type="text/javascript">
        $(function() {
            $('body').on('click', '.pagination-forum a', function(e) {
                e.preventDefault();

                $('#comment').remove();
                $('#overlay').fadeIn();
                var url = $(this).attr('href');
                let page = $(this).data('page');
                getArticles(url, page);
                window.history.pushState("", "", url);
            });

            function getArticles(url, page) {
                console.log("https:" + url);
                // $.ajax({
                //     url: url
                // });
                $.ajax({
                    url: url,
                    data: {
                        page: page,
                        parent: 'comments'
                    }
                }).done(function(data) {
                    // console.log(data);
                    $('#overlay').fadeOut();
                    $('.comments').html(data);
                }).fail(function() {
                    alert('Data could not be loaded.');
                });
            }

            //hanlde pagination user post forum
            $('body').on('click', '.pagination-user a', function(e) {
                e.preventDefault();

                $('#post').remove();
                $('.overlay-user').fadeIn();
                var url = $(this).attr('href');
                let page = $(this).data('page');
                getPosts(url, page);
                window.history.pushState("", "", url);
            });

            function getPosts(url, page) {
                console.log("https:" + url);
                // $.ajax({
                //     url: url
                // });
                $.ajax({
                    url: url,
                    data: {
                        page_user: page,
                        parent: 'posts'
                    }
                }).done(function(data) {
                    $('#overlay').fadeOut();
                    $('.posts').html(data);
                }).fail(function() {
                    alert('Data could not be loaded.');
                });
            }
        });
    </script>
@endsection
