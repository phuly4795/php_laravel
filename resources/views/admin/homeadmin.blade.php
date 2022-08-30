@extends('layouts.app')
@section('home', 'active')
@section('title', 'Trang quản trị website')

@section('content')

    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
             
                    <div class="ms-3">
                        <p class="mb-2">Tổng số lượt xem</p>
                        <h6 class="mb-0"> {{ $sumView->sum('view') }}</h6>          
                    </div>
                 
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <a href="{{route('post.index')}}">
                    <div class="ms-3">
                        <p class="mb-2">Tổng số bài viết</p>
                        <h6 class="mb-0">{{ $sumPost }}</h6>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <a href="{{route('newsletter.index')}}">
                    <div class="ms-3">
                        <p class="mb-2">Số lượng nhận tin sớm</p>
                        <h6 class="mb-0">{{ $sumNL }}</h6>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <a href="{{route('contact.index')}}">
                    <div class="ms-3">
                        <p class="mb-2">Số lượng tin liên hệ</p>
                        <h6 class="mb-0">{{ $sumContact }}</h6>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->


    <!-- Sales Chart Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <canvas id="myChart"></canvas>
                    </div>
                    <p>Số bài viết theo danh mục</p>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <canvas id="myChartView"></canvas>
                    </div>
                 <p>Top 5 bài viết được xem nhiều</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Chart End -->



    <!-- Footer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="#">T&PTimes</a>, All Right Reserved.
                </div>

            </div>
        </div>
    </div>
    <!-- Footer End -->


@endsection
