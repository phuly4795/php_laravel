@extends('layouts.app')
@section('title', 'Cấu hình hệ thống')
@section('system', 'active')
@section('content')
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Cấu hình hệ thống</h6>
                            
                            {!! Form::open(['route'=> 'system_post', 'method'=>'post' , 'enctype' =>'multipart/form-data' ]) !!}    
                       
                            <div class="form-group">
                                {!! Form::label('name', 'Tên công ty') !!}<span class="sao"> *</span><Br>
                                {!! Form::text('name',  $name->description, ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...', 'id'=>'slug','onkeyup'=> 'ChangeToSlug()']) !!}<Br>
                            
                                {!! Form::label('logo', 'Logo') !!}<Br>
                                {!! Form::file('logo', ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<br>
                                @if(isset($logo))
                                    <img src="{{asset('logo/'.$logo->description)}}" alt="{{$logo->description}}" width="100px"><Br>
                                @endif
                                {!! Form::label('favicon', 'Favicon') !!}<Br>
                                {!! Form::file('favicon', ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<br>
                                @if(isset($favicon))
                                    <img src="{{asset('favicon/'.$favicon->description)}}" alt="{{$favicon->description}}" width="100px"><Br>
                                @endif

                                {!! Form::label('email', 'email') !!}<span class="sao"> *</span><Br>
                                {!! Form::text('email',   $email->description, ['class'=>'form-control', 'id'=>'convert_slug']) !!}<Br>
                             
                                {!! Form::label('phone', 'Số điện thoại') !!}<span class="sao"> *</span><Br>
                                {!! Form::text('phone',   $phone->description , ['class'=>'form-control', 'id'=>'convert_slug']) !!}<Br>
                             
                                {!! Form::label('address', 'Địa chỉ') !!}<span class="sao"> *</span><Br>
                                {!! Form::text('address',  $address->description, ['class'=>'form-control', 'id'=>'convert_slug']) !!}<Br>
                               
                                {!! Form::label('coppy', 'Coppyright') !!}<Br>
                                {!! Form::text('coppy',   $copyright->description , ['class'=>'form-control', 'id'=>'convert_slug']) !!}<Br>
                             
                                    
                               
                                {!! Form::submit('Xác nhận', ['class'=>'btn btn-primary']) !!}
                              
                                {{-- <a href="{{route('category.index')}}" class="btn btn-primary">Danh sách</a> --}}
                            </div>
                       
                        {!! Form::close() !!}
                        </div>
                    </div>
                   
                
                </div>
            </div>
          

            <style>
                .sao{
                    color:  red
                }
           
            </style>
@endsection
