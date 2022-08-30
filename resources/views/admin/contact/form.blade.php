@extends('layouts.app')
@section('title', 'Quản lý liên hệ')

@section('content')
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Trả lời liên hệ</h6>
                          
                            {!! Form::open(['route'=> ['contact.update', $list->id], 'method'=>'put']) !!}                           
                            <div class="form-group">
                                {!! Form::label('name', 'Họ và tên') !!}<Br>
                                {!! Form::text('name', isset($list) ? $list->name : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...' ,"disabled"]) !!}<Br>                           
                            </div>          
                            <div class="form-group">
                                {!! Form::label('email', 'Tên email') !!}<Br>
                                {!! Form::text('email', isset($list) ? $list->email : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...', "disabled"]) !!}<Br>                           
                            </div>          
                            <div class="form-group">
                                {!! Form::label('content', 'Nội dung') !!}<Br>
                                <textarea name="content" style="resize: none" class="form-control" disabled cols="30" rows="10">{{isset($list) ? $list->content : '' }}</textarea><Br>
                            </div>     

                            <div class="form-group">
                                {!! Form::label('repplay', 'Trả lời email') !!}<Br>
                                <textarea name="repplay" style="resize: none" class="form-control"  cols="30" rows="10">{{isset($list) ? $list->repplay : '' }}</textarea><Br>
                            </div>          
                                
                           
                            {!! Form::submit('Xác nhận', ['class'=>'btn btn-primary']) !!}    
                                                 
                            <a href="{{route('contact.index')}}" class="btn btn-primary">Danh sách</a>
                       
                       
                        {!! Form::close() !!}
                        </div>
                    </div>              
                </div>
            </div>
            <!-- Form End -->


@endsection
