@extends('layouts.client')

@section('title', $newsDetail->metaTitle)

@section('description', $newsDetail->metaDescription)

@section('keywords', $newsDetail->metaKeyword)

@section('url', url('/' . $newsDetail->slug . '.html'))

@section('content')
    <style>
        p>img {
            max-width: 100% !important;
        }

        .cate {

            font-size: 15px;
            color: #2D67AD;
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            font-weight: 700;
            margin-right: 1%
        }

        .a {
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
        }

        a {
            color: #1B2A63;
            text-underline-position: none;

            cursor: pointer !important;
        }

        a:hover {
            text-decoration: none;
            cursor: pointer !important;
        }

        iframe {
            width: 100%;
            height: 500;
            border: none;
        }

        .d-lg-flex span .a {
            border-radius: 20px;
            cursor: pointer;
        }

        .d-lg-flex span .h {
            border-radius: 20px;
            cursor: pointer;
        }

        .d-lg-flex span {
            border-radius: 20px;
            cursor: pointer;
        }

        .d-lg-flex .a:hover {
            background-color: red;
            color: white;
            border: none
        }

        .d-lg-flex .h:hover {
            background-color: #cccccc !important;
            color: black !important;
            border: none
        }

        .d-lg-flex span i {
            font-size: 20px !important;
            margin-left: 16%;
        }
    </style>
    <div class="content-wrapper">
        <div class="container">
            @if (Session::has('message'))
                <div class="alert alert-{!! Session::get('flash_level') !!}" role="alert">
                    {!! Session::get('message') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="container">
            <div class="col-sm-12">
                <div class="card" data-aos="fade-up">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <input type="hidden" id="id_post" value="{{ $newsDetail->id }}">
                                    <h1 class="font-weight-600 mb-1" style="text-align: center; padding-bottom:3%">
                                        {{ $newsDetail->title }}
                                    </h1>
                                    <p class="fs-13 text-muted mb-0 a">
                                        <span class="cate">{{ $newsDetail->category_name }}</span>

                                        <span class="mr-2 any">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16"
                                                style="padding-right: 2%">
                                                <path
                                                    d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                                <path
                                                    d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                            </svg>
                                            {{ date('d/m/Y H:i:s', strtotime($newsDetail->created_at)) }}

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"
                                                style="padding-right: 2%">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                            {{ $newsDetail->view }}
                                        </span>
                                    </p>
                                    <hr>
                                    <div class="d-lg-flex">
                                        @if (!isset($wishlist))
                                            <span>
                                                <input type="hidden" class="post_id" value="{{ $newsDetail->id }}">

                                                <button class="badge badge-outline-dark mr-2 mb-1 addtowishlist a"
                                                    title="Thêm yêu thích">
                                                    <i class="fa-solid fa-heart"></i>
                                                </button>

                                            </span>
                                        @else
                                            <span>
                                                <input type="hidden" value="{{ $newsDetail->id }}" class="post_id">
                                                <button class="badge badge-outline-dark mr-2 mb-1 delewl h"
                                                    style="background-color: red;color: white; border:none"
                                                    title="Hủy yêu thích">
                                                    <i class="fa-solid fa-heart"></i>
                                                </button>
                                            </span>
                                        @endif
                                        @php
                                            $current = Request::url();
                                            
                                         
                                            
                                        @endphp

                                        <div class="fb-share-button" data-href="{{ $current }}" data-layout="button"
                                            data-size="large"><a target="_blank"
                                                href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F127.0.0.1%3A8000%2Fcate%2Fvideo%2Fspacex-cua-elon-musk-sap-vot-len-thanh-cong-ty-nghin-ty-usd.html&amp;src=sdkpreparse"
                                                class="fb-xfbml-parse-ignore">Chia sẻ</a>
                                        </div>


                                      

                                    </div>
                                    <div>
                                        <div style="padding-bottom: 2%;"><b>{{ $newsDetail->summary }}</b></div>
                                        <p class="mb-4 fs-15" style="text-align: center">
                                            {!! $newsDetail->content !!}
                                        </p>
                                    </div>
                                    <div class="d-lg-flex">                                   
                                        @if ($newsDetail->tags != null)
                                        <span class="fs-16 font-weight-600 mr-2 mb-1">Chủ đề:</span>
                                            @php
                                                $tags = [];
                                                $tags = explode(',', $newsDetail->tags);
                                            @endphp
                                            @foreach ($tags as $tag)
                                                <span class="badge badge-outline-dark mr-2 mb-1 tag">
                                                    <a href="{{ url('tags/' . $tag) }}">{{ $tag }}</a>
                                                </span>
                                            @endforeach
                                       
                                        @endif
                                    </div>
                                    <div class="post-comment-section">
                                        <h3 class="font-weight-600">Bài viết liên quan</h3>
                                        <div class="row">
                                            @foreach ($matchcate as $m)
                                                <div class="col-sm-6">
                                                    <a href="{{ url('/cate/' . $m->slugCate . '/' . $m->slug) }}.html"
                                                        title="{{ $m->title }}">
                                                        <div class="post-author">
                                                            <div class="rotate-img">
                                                                <img src="{{ asset('uploads/news/'.$m->image)}}"
                                                                    style="    min-height: 45vh;" alt="{{ $m->image }}"
                                                                    class="img-fluid" />
                                                            </div>
                                                            <div class="post-author-content">
                                                                <h5 class="mb-1">
                                                                    {{ Str::limit($m->title, $limit = 30, '...') }}
                                                                </h5>
                                                                <p class="fs-13 text-muted mb-0">
                                                                    <span class="mr-2">{{ $m->category_name }}
                                                                    </span>{{ $m->created_at }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>


                                        <div class="comment-section">
                                            <h5 class="font-weight-600">Bình luận</h5>

                                            @if(Auth::check())
                                                <div class="comment-box">                                                
                                                    <div class="add_comment">
                                                        <img src="{{ asset('uploads/img/'.Auth()->user()->image)}}"
                                                            alt="">
                                                        <input class="form-control" id="content"
                                                            placeholder="Viết bình luận...">
                                                    </div>
                                                    <button class="btn btn-primary" id="add_comment"
                                                        style="margin-top:2%;margin-left:7% ">Thêm bình luận</button>
                                                    <div id="noifi"></div>
                                                </div>
                                                
                                            @else   
                                            
                                               <h6> Bạn cần <a href="{{route('login')}}" style="color:#1B2A63">đăng nhập</a> để có thể bình luận</h6>
                                              
                                            @endif


                                            <div id="loadComment"></div>


                                           
                                            

                                                                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* .rep_comment-box {
            display: none;
        } */

        .add_comment {
            display: flex;

        }

        .add_comment img {
            border-radius: 30px
        }

        .add_comment input {
            border-radius: 30px;
            margin-left: 2%
        }
        .get_comment {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: flex-start;
            align-items: center;
        }

        .get_comment img {
            max-width: 5%;
            border-radius: 30px
        }

        .get_one {
            display: flex;
            flex-direction: column;
            align-content: flex-end;
            align-items: flex-start;
            justify-content: center;
            flex-wrap: nowrap;
            margin-left: 15px;
            margin-top: 25px;
            background: #F8F8F8;
            width: 100%;
            padding: 15px;
            border-radius: 30px;

        }


        /* .rep_add_comment {
            display: flex;
            margin-left: 5%;
            margin-top: 1%
        } */

        /* .rep_add_comment img {
            max-width: 5%;
            border-radius: 30px
        }

        .rep_add_comment input {
            border-radius: 30px;
            margin-left: 2%
        } */

 

        /* .rep_get_comment {
         
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: flex-start;
            align-items: center;
            margin-left: 5%;
        }

        .rep_get_comment img {
            max-width: 5%;
            border-radius: 30px
        }

        .rep_get_one {
            display: flex;
            flex-direction: column;
            align-content: flex-end;
            align-items: flex-start;
            justify-content: center;
            flex-wrap: nowrap;
            margin-left: 15px;
            margin-top: 25px;
            background: #F8F8F8;
            width: 100%;
            padding: 15px;
            border-radius: 30px;

        }

        .repplay {
            margin-left: 8%; */
        }
    </style>

@endsection

