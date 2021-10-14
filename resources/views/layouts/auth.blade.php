<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('assets/img/Logo.png')}}" type="image/gif">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <link href="{{asset('assets/css/login-register.css')}}" rel="stylesheet" /> 
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" /> 
    <link href="{{asset('assets/vendor/fontawesome/css/fontawesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendor/fontawesome/css/light.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendor/fontawesome/css/regular.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
</head>

<body>
    <header id="header" class="bg-light">
        <div class="container d-flex align-items-center">
            <h1 class="logo mr-auto my-auto">
                <a href="/">
                    <img src="{{asset('assets/img/Logo.png')}}" alt="" srcset="" /></a>
            </h1>
            <nav class="navbar-menu navbar-expand-sm">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link my-auto " href="#">
                Tentang <i class="fal fa-question-circle my-auto"></i>
            </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    @yield('content')

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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(document).ready(function() {
            $('.slider').slick({
                infinite: true,
                dots: true,
                autoplay: true,
                autoplaySpeed: 1000,
            });
        });
    </script>
     @yield('page-js')
</body>

</html>
