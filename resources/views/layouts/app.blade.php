<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('favicon/favicon.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('am/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('am/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('am/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('am/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style>
        .alert {
            margin-top: 3%
        }

        .btn-close {
            float: right;
        }
    </style>
</head>

<body>

    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="{{ url('admin/') }}" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>T&PTimes</h3>
                </a>
                
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="/uploads/imgAdmin/{{ Auth::user()->image }}"
                            alt="{{ Auth::user()->image }}" style="width: 40px; height: 40px;">
                          
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"> {{ Auth::user()->name }}</h6>
                        <span>
                            @if (Auth::user()->position == 1)
                                Administrator
                            @else
                                SEO Content
                            @endif
                        </span>
                    </div>
                </div>
                @if (Auth::user()->position == 1)
                    <div class="navbar-nav w-100">
                        <a href="{{ url('admin/') }}" class="nav-item nav-link @yield('home')"> <i
                                class="bi bi-house-fill"></i>Trang chủ</a>
                        <a href="{{ route('system') }}" class="nav-item nav-link @yield('system')"><i
                                class="fa fa-tachometer-alt me-2"></i>Cấu hình hệ thống</a>
                        <a href="{{ route('newsletter.index') }}" class="nav-item nav-link @yield('newsletter')"><i
                                class="bi bi-receipt-cutoff"></i>Quản lý nhận tin </a>
                        <a href="{{ route('page.index') }}" class="nav-item nav-link @yield('page')"><i
                                class="bi bi-file-earmark-break-fill"></i>Quản lý trang</a>
                        <a href="{{route('comment.index')}}" class="nav-item nav-link @yield('comment')"><i class="bi bi-share-fill"></i></i>Quản lý bình luận</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle @yield('post')"
                                data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Quản lý tin tức</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('post.create') }}" class="dropdown-item">Thêm tin</a>
                                <a href="{{ route('post.index') }}" class="dropdown-item">Danh sách tin</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle @yield('cate')"
                                data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i></i>Quản lý Danh
                                mục</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('category.create') }}" class="dropdown-item">Thêm danh mục
                                    tin</a>
                                <a href="{{ route('category.index') }}" class="dropdown-item">Danh sách danh
                                    mục</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle @yield('staff')"
                                data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i>Quản lý thành viên</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('staff.create') }}" class="dropdown-item">Thêm nhân viên</a>
                                <a href="{{ route('staff.index') }}" class="dropdown-item">Danh sách nhân viên</a>
                                <a href="{{ route('list_user') }}" class="dropdown-item">Danh sách khách hàng</a>
                            </div>
                        </div>
                        <a href="{{ route('contact.index') }}" class="nav-item nav-link @yield('contact')"><i
                                class="bi bi-bell-fill"></i>Quản lý Liên hệ </a>
                        <a href="{{ url('/') }}" class="nav-item nav-link"><i
                                class="bi bi-people-fill"></i>Trang người dùng</a>
                    </div>
                @else
                    <div class="navbar-nav w-100">
                        <a href="{{ url('admin/') }}" class="nav-item nav-link @yield('home')"> <i
                                class="bi bi-house-fill"></i>Trang chủ</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle @yield('post')"
                                data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Quản lý tin tức</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('post.create') }}" class="dropdown-item">Thêm tin</a>
                                <a href="{{ route('post.index') }}" class="dropdown-item">Danh sách tin</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle @yield('cate')"
                                data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i></i>Quản lý Danh
                                mục</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('category.create') }}" class="dropdown-item">Thêm danh mục
                                    tin</a>
                                <a href="{{ route('category.index') }}" class="dropdown-item">Danh sách danh
                                    mục</a>
                            </div>
                        </div>

                        <a href="{{ url('/') }}" class="nav-item nav-link"><i
                                class="bi bi-people-fill"></i>Trang người dùng</a>
                    </div>
                @endif
        </div>
        </nav>
    </div>
    <!-- Sidebar End -->


    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>

            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

                        <i class="fa fa-bell me-lg-2"><span style="color:orangered">{{$noti}}</span></i>
                        <span class="d-none d-lg-inline-flex">Thông báo</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        @foreach ($notiContent as $item)

                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">{{Str::limit($item->content, $limit = 18,'...')}}</h6>
                            <small>{{date('d/m/Y',strtotime($item->created_at))}} </small>
                        </a>
                        
                        <hr class="dropdown-divider">
                        @endforeach
                                    
                        <a href="{{route('contact.index')}}" class="dropdown-item text-center">Xem tất cả</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="/uploads/imgAdmin/{{ Auth::user()->image }}"
                            alt="{{ Auth::user()->image }}" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="{{ route('profile') }}" class="dropdown-item">Hồ sơ cá nhân</a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            {{ __('Đăng xuất') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
        <div class="container">
            @if (Session::has('message'))
                <div class="alert alert-{!! Session::get('flash_level') !!}" role="alert">
                    {!! Session::get('message') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        @yield('content')
    </div>

    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- JavaScript Libraries -->

    <script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('am/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('am/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('am/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('am/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('am/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('am/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('am/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('am/js/main.js') }}"></script>
    <script src="{{ asset('am/js/custom.js') }}"></script>
</body>

<script>
    CKEDITOR.replace('ckeditor');
</script>

</html>
