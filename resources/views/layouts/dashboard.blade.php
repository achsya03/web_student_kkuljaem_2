<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('assets/img/Logo.png') }}" type="image/x-icon">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <!-- Docs styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/CDNSFree2/Plyr/plyr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/vendor/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/fontawesome/css/light.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/fontawesome/css/regular.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" />

    @yield('css')
</head>

<body>
    <header id="header" class="bg-light fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo mr-auto my-auto">
                <a href="/">
                    <img src="{{ asset('assets/img/Logo.png') }}" alt="" srcset="" /></a>
            </h1>
            <form action="{{ route('dashboard.search') }}" method="POST" style="width: 500px;">
                <div class="input-group border rounded-pill my-1 mr-4 bg-white py-1">

                    @csrf
                    <input type="text" name="keyword" placeholder="Search..." aria-describedby="button-addon3"
                        class="form-control ml-3 bg-none border-0">
                    <div class="input-group-append border-0">
                        <button id="button-addon3" type="submit" class="btn btn-link text-success"><i
                                class="fa fa-search"></i></button>
                    </div>

                </div>
            </form>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link my-1 mx-2 {{ Request::routeIs('') ? 'active' : '' }}"
                        href="{{ route('dashboard.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link my-1 mx-2 {{ Request::routeIs('class') ? 'active' : '' }}"
                        href="{{ route('class.index') }}">Class</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link my-1 mx-2 {{ Request::routeIs('forum') ? 'active' : '' }}"
                        href="{{ route('forum.index') }}">Forum</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link my-1 mx-2 {{ Request::routeIs('qna') ? 'active' : '' }}"
                        href="{{ route('qna.index') }}">QnA</a>
                </li>
                <li class="nav-item dropdown no-arrow my-1 mx-2">
                    <a class="nav-link" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-bell" style="color:#ef9c23"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-counter "><i class="fas fa-circle"
                                style="color:#ef9c23"></i></i></span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <div class="row">
                            <div class="col-lg-5 ml-4 p-3">
                                <h6>Notifikasi</h6>
                            </div>
                            <div class="col-lg-6 justify-content-end mr-2 py-3 px-4">
                                <h6 class="text-right">
                                    Baru <span>(3)</span>
                                </h6>
                            </div>
                        </div>
                        <div class="notif-scroll">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle">
                                        <i class="far fa-bell" style="color:#fff"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500 font-weight-bold">10 Komentar baru</div>
                                    <h6>$290.29 has been deposited into your account!</h6>
                                </div>
                                <div>
                                    <h6 class="p-3">13Mnt</h6>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle">
                                        <i class="far fa-bell" style="color:#fff"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500 font-weight-bold">10 Komentar baru</div>
                                    <h6>$290.29 has been deposited into your account!</h6>
                                </div>
                                <div>
                                    <h6 class="p-3">13Mnt</h6>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle">
                                        <i class="far fa-bell" style="color:#fff"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500 font-weight-bold">10 Komentar baru</div>
                                    <h6>$290.29 has been deposited into your account!</h6>
                                </div>
                                <div>
                                    <h6 class="p-3">13Mnt</h6>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle">
                                        <i class="far fa-bell" style="color:#fff"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500 font-weight-bold">10 Komentar baru</div>
                                    <h6>$290.29 has been deposited into your account!</h6>
                                </div>
                                <div>
                                    <h6 class="p-3">13Mnt</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('profil.index') }}">
                        <img class="img-profile rounded-circle" src="{{ asset('assets/img/profile.png') }}">
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div id="main">
        <div id="app">
            @yield('content')
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    <script src="{{ asset('assets/js/player.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/CDNSFree2/Plyr/plyr.js"></script>
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                infinite: true,
                dots: true,
                autoplay: true,
                autoplaySpeed: 800,
            });
        });
    </script>
    @yield('page-js')
</body>

</html>
