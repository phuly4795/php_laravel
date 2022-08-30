@extends('layouts.app')
@if(!isset($page))
    @section('title', 'Thêm danh mục tin')
@else
    @section('title', 'Cập nhật trang')
@endif
@section('page', 'active')
@section('content')
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            @if(!isset($page))
                                <h6 class="mb-4">Thêm trang</h6>
                            @else
                                <h6 class="mb-4">Cập nhật trang</h6>
                            @endif
                        @if(isset($page))
                            {!! Form::open(['route'=> ['page.update', $page->id], 'method'=>'put', 'enctype' =>'multipart/form-data']) !!}    
                        @else
                            {!! Form::open(['route'=> 'page.store', 'method'=>'post']) !!}    
                        @endif
                            <div class="form-group">
                                {!! Form::label('name', 'Tên trang') !!}<Br>
                                {!! Form::text('name', isset($page) ? $page->name : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...', 'id'=>'slug','onkeyup'=> 'ChangeToSlug()']) !!}<Br>
                               
                                {!! Form::label('slug', 'Tên phụ' ) !!}<Br>
                                {!! Form::text('slug',  isset($page) ? $page->slug : '' , ['class'=>'form-control', 'id'=>'convert_slug' ]) !!}<Br>
                                
                                {!! Form::label('font', 'Font' ) !!}<Br>
                                {!! Form::text('font',  isset($page) ? $page->font : '' , ['class'=>'form-control' ]) !!}<Br>
                                       
                                {!! Form::label('sort', 'Vị trí' ) !!}<Br>
                                {!! Form::text('sort',  isset($page) ? $page->sort : '' , ['class'=>'form-control' ]) !!}<Br>           
                                             
                                {!! Form::label('title', 'Thẻ meta title' ) !!}<Br>
                                {!! Form::text('title',  isset($page) ? $page->metaTitle : '' , ['class'=>'form-control' ]) !!}<Br>

                                {!! Form::label('description', 'Thẻ meta description' ) !!}<Br>
                                {!! Form::text('description',  isset($page) ? $page->metaDescription : '' , ['class'=>'form-control' ]) !!}<Br>

                                {!! Form::label('keyword', 'Thẻ meta keyword' ) !!}<Br>
                                {!! Form::text('keyword',  isset($page) ? $page->metaKeyword : '' , ['class'=>'form-control' ]) !!}<Br>

                                {!! Form::label('mota', 'Mô tả trang' ) !!}<Br>
                                {{-- {!! Form::text('mota',  isset($page) ? $page->mota : '' , ['class'=>'form-control', 'id' =>'ckeditor' ]) !!}<Br> --}}
                                    <textarea name="mota" id="ckeditor" cols="30" rows="10">{{isset($page) ? $page->mota : ''}}</textarea>
                                <label for="">Trạng thái</label>
                                <select name="status" id="" class="form-control" >
                                    <option >Chọn Trạng thái</option>                                                              
                                    <option value="1" @if($page->status == 1) selected @endif>Đang bật</option>
                                    <option value="0" @if($page->status == 0) selected @endif >Đã tắt</option>      
                                </select><br>

                    
                                @if(isset($page))
                                    {!! Form::submit('Cập nhật trang', ['class'=>'btn btn-primary']) !!}
                                @else
                                    {!! Form::submit('Thêm trang', ['class'=>'btn btn-primary']) !!}
                                @endif
                                <a href="{{route('page.index')}}" class="btn btn-primary">Danh sách trang</a>
                            </div>
                       
                        {!! Form::close() !!}
                        </div>
                    </div>
                   
                
                </div>
            </div>
            <!-- Form End -->

@endsection
