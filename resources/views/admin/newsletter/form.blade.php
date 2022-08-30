@extends('layouts.app')
@section('title', 'Quản lý nhận tin sớm')

@section('content')
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Chỉnh sửa nhận tin sớm</h6>
                          
                            {!! Form::open(['route'=> ['newsletter.update', $list->id], 'method'=>'put']) !!}                           
                            <div class="form-group">
                                {!! Form::label('email', 'Tên email') !!}<Br>
                                {!! Form::text('email', isset($list) ? $list->email : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>                           
                            </div>          
                            <div class="form-group">   
                                {!! Form::label('isviews', 'Trạng thái email') !!}<Br>
                                <select name="isviews" id="" class="form-control" >
                                    <option >Chọn Trạng thái</option>                                                              
                                    <option value="0" @if($list->isViews == 0) selected @endif>Đã xem</option>
                                    <option value="1" @if($list->isViews == 1) selected @endif >Chưa xem</option>      
                                </select><br>
                                {!! Form::submit('Cập nhật', ['class'=>'btn btn-primary']) !!}    
                                                 
                                <a href="{{route('newsletter.index')}}" class="btn btn-primary">Danh sách</a>
                            </div>
                       
                        {!! Form::close() !!}
                        </div>
                    </div>
                   
                
                </div>
            </div>
            <!-- Form End -->


@endsection
