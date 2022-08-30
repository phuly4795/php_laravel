@extends('layouts.app')
@section('title', 'Trang thông tin cá nhân')

@section('content')
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
            
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Thông tin người quản trị</h6>
                            
                            {!! Form::open(['route'=> 'updateAdmin', 'method'=>'post', 'enctype' =>'multipart/form-data']) !!}    
                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                            
                            <div class="form-group">
                                {!! Form::label('name', 'Họ và tên') !!} <span class="sao"> *</span><Br>
                                {!! Form::text('name',  Auth::user()->name , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>            
                             
                                {!! Form::label('email', 'Tên email') !!}<Br>
                                {!! Form::text('email',  Auth::user()->email , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...', 'disabled']) !!}<Br>            
                             
                                {!! Form::label('address', 'Địa chỉ') !!} <span class="sao"> *</span><Br>
                                {!! Form::text('address',  Auth::user()->address , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>            
                             
                                {!! Form::label('phone', 'Số điện thoại') !!} <span class="sao"> *</span><Br>
                                {!! Form::text('phone',  Auth::user()->phone , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>            
                             
                                {!! Form::label('password', 'Mật khẩu') !!}<Br>
                                {!! Form::text('password',null , ['class'=>'form-control', 'placeholder' => 'Để trống trường này nếu không muốn thay đổi mật khẩu']) !!}<Br>            

                                {!! Form::label('image', 'Hình ảnh') !!}<Br>
                                {!! Form::file('image', ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<br>
                                    
                                <img src="/uploads/imgAdmin/{{Auth::user()->image}}" alt="{{Auth::user()->image}}" width="100px" ><br><br>

                                {{-- {!! Form::text('image',  Auth::user()->image , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>             --}}
                             
                                {!! Form::submit('Chỉnh sửa', ['class'=>'btn btn-primary']) !!}
                           
                            </div>
                       
                        {!! Form::close() !!}
                        </div>
                    </div>
                   
                
                </div>
            </div>
            <!-- Form End -->
    <style>
        .sao{
            color:  red
        }
        
    </style>

@endsection
