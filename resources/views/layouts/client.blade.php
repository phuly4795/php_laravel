<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <meta name="description" content="width=device-width, initial-scale=1.0, @yield('description')">
    <meta name="keywords" content="width=device-width, initial-scale=1.0, @yield('keywords')">
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/aos/dist/aos.css/aos.css') }}" />
    <link rel="canoical" href="@yield('url')">
    <!-- End plugin css for this page -->
    <link rel="shortcut icon" href="{{ asset('favicon/' . $favicon->description) }}" />
    <meta property="og:url" content="@yield('url')">
    <meta property="og:type" content="article">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script>
        var url = "{!! url('/') !!}";
    </script>
    <!-- endinject -->

</head>

<body>
    <div id="spinner" style="display: none !important"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div class="container-scroller">
        <div class="main-panel">
            <!-- partial:partials/_navbar.html -->
            <header id="header">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <ul class="navbar-top-left-menu">
                                    <li class="nav-item">
                                        <a class="nav-link">{{ now() }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/tin-yeu-thich') }}" class="nav-link">Tin yêu thích
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                            </svg>
                                        </a>
                                    </li>

                                </ul>
                                <ul class="navbar-top-right-menu">
                                   
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="openSearch()"><i
                                                class="mdi mdi-magnify"></i></a>

                                        <div id="myOverlay" class="overlay">

                                            <span class="closebtn" onclick="closeSearch()"
                                                title="Close Overlay">x</span>

                                            <div class="overlay-content">
                                                <form action="{{ url('/tim-kiem') }}" method="GET">
                                                    {{csrf_field()}}
                                                    <input type="text" placeholder="Tin cần tìm..." autocomplete="off" id="k"
                                                        name="q" required>
                                                    <div id="search_ajax"></div>
                                                    <button type="submit"><i class="fa fa-search"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>

                                    @if (isset(Auth::user()->id))
                                        <li class="nav-item">
                                            @if (Auth::user()->position == 1 || Auth::user()->position == 2)
                                                <a href="{{ url('thong-tin-nguoi-dung') }}" class="nav-link">Xin chào:
                                                    {{ Auth::user()->name }}</a>
                                                <a href="/admin" class="nav-link">Đăng nhập admin</a>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                  this.closest('form').submit();"
                                                        style="color: white !important">
                                                        {{ __('Đăng xuất') }}
                                                    </x-dropdown-link>
                                                </form>
                                            @else
                                                <a href="{{ url('thong-tin-nguoi-dung') }}" title="Thông tin cá nhân"
                                                    class="nav-link">Xin chào:

                                                    {{ Auth::user()->name }}</a>

                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                  this.closest('form').submit();"
                                                        style="color: white !important">
                                                        {{ __('Đăng xuất') }}
                                                    </x-dropdown-link>
                                                </form>
                                            @endif
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ route('login') }}" class="nav-link">Đăng nhập</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('register') }}" class="nav-link">Đăng ký</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="navbar-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a class="navbar-brand" href="{{ url('/') }}" title="Trang chủ"><img
                                            src="{{ asset('logo/' . $logo->description) }}"
                                            alt="{{ $logo->description }}" /></a>
                                </div>
                                <div>
                                    <button class="navbar-toggler" type="button"
                                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="navbar-collapse justify-content-center collapse"
                                        id="navbarSupportedContent">
                                        <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                            <li>
                                                <button class="navbar-close">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </li>
                                            @if (isset($menu) && count($menu) > 0)
                                                @foreach ($menu as $key => $m)
                                                    <li class="nav-item">
                                                        @if ($m->slug == '/')
                                                            <a href="{{ url('/') }}"
                                                                title="{{ $m->title }}" class="nav-link">
                                                                {!! $m->font !!} TRANG CHỦ
                                                            </a>
                                                        @elseif($m->slug == 'cong-nghe' || $m->slug == 'video')
                                                            <a class="nav-link" title="{{ $m->name }}"
                                                                href="{{ url('/cate/' . $m->slug) }}">{{ $m->name }}</a>
                                                        @else
                                                            <a class="nav-link" title="{{ $m->name }}"
                                                                href="{{ url('/' . $m->slug) }}">{{ $m->name }}</a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>

            <!-- partial -->


            @yield('content')

            <!-- main-panel ends -->
            <!-- container-scroller ends -->

            <!-- partial:partials/_footer.html -->
            <footer>
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5">
                                <a href="{{ url('/') }}"><img width="250px"
                                        src="{{ asset('logo/' . $logo->description) }}" title="Trang chủ"
                                        class="footer-logo" alt="{{ $logo->description }}" />
                                </a>
                                <h5 class="font-weight-normal mt-4 mb-5">
                                    {!! $footer->mota !!}
                                </h5>

                            </div>
                            <div class="col-sm-4">
                                <h3 class="font-weight-bold mb-3">BÀI VIẾT MỚI</h3>
                                <div class="row">
                                    <div class="col-sm-12">

                                        @foreach ($getNewsLatest as $v)
                                            <a href="{{ url('/cate/' . $v->slugCate . '/' . $v->slug) }}.html"
                                                title="{{ $v->title }}">
                                                <div class="footer-border-bottom pb-2">
                                                    <style>
                                                        .row .col-9 .as:hover {
                                                            color: #2D67AD !important;
                                                        }
                                                    </style>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <img src="{{ asset('uploads/news/' . $v->image) }}"
                                                                title="{{ $v->title }}"
                                                                alt="{{ $v->image }}" class="img-fluid" />
                                                        </div>
                                                        <div class="col-9">


                                                            <h5 class="font-weight-600 as"
                                                                style="color:white !important">
                                                                {{ $v->title }}
                                                            </h5>
                                                        </div>
                                                    </div>

                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <h3 class="font-weight-bold mb-3">DANH MỤC TIN</h3>
                                @foreach ($getCate as $v)
                                    <div class="footer-border-bottom pb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ '/cate/' . $v->slug }}" style="color: white">
                                                <h5 class="mb-0 font-weight-600">{{ $v->category_name }}</h5>
                                            </a>
                                            <div class="count">{{ $v->id }}</div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="fs-14 font-weight-600">

                                        {{ $copyright->description }}


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- partial -->
        </div>
    </div>
    <script src="https://kit.fontawesome.com/b3b5e31b35.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script src="{{ url('assets/js/main.js') }}"></script>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ asset('assets/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easeScroll.js') }}"></script>
    <!-- End custom js for this page-->

    <script>
        function openSearch() {
            document.getElementById("myOverlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("myOverlay").style.display = "none";
        }
    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=1116966072224119&autoLogAppEvents=1"
        nonce="rWwzFZzQ"></script>


</body>
<style>
    i {
        margin-right: 10px;
    }
</style>

</html>
