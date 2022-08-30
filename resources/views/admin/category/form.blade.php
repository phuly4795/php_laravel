@extends('layouts.app')
@if(!isset($category))
    @section('title', 'Thêm danh mục tin')
@else
    @section('title', 'Cập nhật danh mục tin')
@endif
@section('cate', 'active')

@section('content')

            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            @if(!isset($category))
                                <h6 class="mb-4">Thêm danh mục</h6>
                            @else
                                <h6 class="mb-4">Cập nhật danh mục</h6>
                            @endif
                        @if(isset($category))
                            {!! Form::open(['route'=> ['category.update', $category->id], 'method'=>'put']) !!}    
                        @else
                            {!! Form::open(['route'=> 'category.store', 'method'=>'post']) !!}    
                        @endif
                            <div class="form-group">
                                {!! Form::label('category_name', 'Tên danh mục') !!}<Br>
                                {!! Form::text('category_name', isset($category) ? $category->category_name : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...', 'id'=>'slug','onkeyup'=> 'ChangeToSlug()']) !!}<Br>
                                {!! Form::label('slug', 'Tên phụ' ) !!}<Br>
                                {!! Form::text('slug',  isset($category) ? $category->slug : '' , ['class'=>'form-control', 'id'=>'convert_slug' ]) !!}<Br>
                             @if(isset($category))
                                <select name="status" id="" class="form-control" >
                                    <option >Chọn Trạng thái</option>                                                              
                                    <option value="1" @if($category->status == 1) selected @endif>Đang bật</option>
                                    <option value="0" @if($category->status == 0) selected @endif >Đã tắt</option>      
                                </select><br>
                                @endif

                                @if(isset($category))
                                    {!! Form::submit('Cập nhật', ['class'=>'btn btn-primary']) !!}
                                @else
                                    {!! Form::submit('Thêm danh mục', ['class'=>'btn btn-primary']) !!}
                                @endif
                                <a href="{{route('category.index')}}" class="btn btn-primary">Danh sách</a>
                            </div>
                       
                        {!! Form::close() !!}
                        </div>
                    </div>
                   
                
                </div>
            </div>
            <!-- Form End -->

@endsection
