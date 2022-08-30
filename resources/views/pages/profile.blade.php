@extends('layouts.client')

@section('title', 'Trang thông tin cá nhân')

@section('content')
    <style>
        a {
            color: #1B2A63;
            text-underline-position: none;

        }

        a:hover {
            text-decoration: none;
        }

        .form-group input {
            border-radius: 20px;
        }

        .form-group label {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 600
        }

        .col-lg-12 button {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 600;

            border-radius: 10px;
        }
    </style>
    <div class="content-wrapper">
        <div class="container">
            @if(Session::has('message'))
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
                            <div class="col-sm-12">

                                <h4 class="font-weight-600 mb-4" style="text-align: center;font-size:20px">Thông tin cá nhân
                                </h4>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                @if(Auth::user()->email_verified_at != null)                               
                                    <button style="background: green;color:white; text-align:left" disabled class="form-control">Đã xác thực<i class="fa-solid fa-check" style="margin-left: 1%"></i></button>
                                @else
                                    <button style="background: orangered;color:white; text-align:left" disabled class="form-control">Chưa xác thực<i class="fa-solid fa-x" style="margin-left: 1%"></i></button>
                                    <div class="mt-4 flex items-center justify-between">
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                            
                                            <div>
                                                <x-button>
                                                    {{ __('Resend Verification Email') }}
                                                </x-button>
                                            </div>
                                        </form>
                                           
                                    </div>
                                @endif
                                {!! Form::open(['route' => 'updateProfile', 'method' => 'post']) !!}

                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                         

                                {!! Form::label('name', 'Họ và tên') !!} <span class="sao"> *</span><Br>
                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>

                                {!! Form::label('email', 'Tên email') !!}<Br>
                                {!! Form::text('email', Auth::user()->email, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                    'disabled',
                                ]) !!}<Br>

                                {!! Form::label('address', 'Địa chỉ') !!} <span class="sao"> *</span><Br>
                                {!! Form::text('address', Auth::user()->address, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                ]) !!}<Br>

                                {!! Form::label('phone', 'Số điện thoại') !!} <span class="sao"> *</span><Br>
                                {!! Form::text('phone', Auth::user()->phone, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                ]) !!}<Br>

                                {!! Form::label('password', 'Mật khẩu') !!}<Br>
                                {!! Form::text('password', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Để trống trường này nếu không muốn thay đổi mật khẩu',
                                ]) !!}<Br>

                                {!! Form::submit('Cập nhật', ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .alert{
            margin-top: 3%
        }
        .btn-close{
            float: right;
        }
        .sao{
            color:  red
        }
    </style>
@endsection
