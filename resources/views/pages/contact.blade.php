@extends('layouts.client')

@section('title', $pageinfo->metaTitle)

@section('description', $pageinfo->metaDescription)

@section('keywords', $pageinfo->metaKeyword)

@section('url', url('/' . $pageinfo->slug))


@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card" data-aos="fade-up">
                        <div class="card-body">
                            <div class="aboutus-wrapper">
                                <h1 class="mt-5 text-center mb-5">
                                    Liên hệ với chúng tôi
                                </h1>
                                <div class="row">
                                    <div class="col-lg-12 mb-5 mb-sm-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea style="resize: none" class="form-control textarea" placeholder="Nội dụng *" id="message"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="name"
                                                        aria-describedby="name" placeholder="Họ và tên *" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="email"
                                                        aria-describedby="email" placeholder="Địa chỉ email *" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                           
                                            <div class="col-sm-12">
                                                <div id="inf"></div>                                               

                                                <div class="form-group">
                                                    <button id="submit"
                                                        class="btn btn-lg btn-dark font-weight-bold mt-3">Gửi tin</button>
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
        </div>
    </div>
@endsection
