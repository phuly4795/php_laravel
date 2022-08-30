@extends('layouts.app')
@if(!isset($post))
    @section('title', 'Thêm bài viết')
@else
    @section('title', 'Cập nhật bài viết')
@endif
@section('post', 'active')
@section('content')
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            
                        @if(isset($post))
                            <h6 class="mb-4">Cập nhật bài viết</h6>
                            {!! Form::open(['route'=> ['post.update', $post->id], 'method'=>'put', 'enctype' =>'multipart/form-data' ]) !!}    
                        @else
                            <h6 class="mb-4">Thêm bài viết</h6>
                            {!! Form::open(['route'=> 'post.store', 'method'=>'post' , 'enctype' =>'multipart/form-data' ]) !!}    
                        @endif
                            <div class="form-group">
                                {!! Form::label('title', 'Tên bài viết') !!}<Br>
                                {!! Form::text('title', isset($post) ? $post->title : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...', 'id'=>'slug','onkeyup'=> 'ChangeToSlug()'])!!}<Br>
                               
                                {!! Form::label('slug', 'Tên phụ' ) !!}<Br>
                                {!! Form::text('slug',  isset($post) ? $post->slug : '' , ['class'=>'form-control', 'id'=>'convert_slug' ]) !!}<Br>

                                {!! Form::label('summary', 'Tóm tắt bài viết') !!}<Br>
                                {!! Form::text('summary', isset($post) ? $post->summary : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...'])!!}<Br>
                               
                                {!! Form::label('content', 'Nội dung bài viết') !!}<Br>

                                @if( isset($post) && $post->id_cate == 10)
                                    {!! Form::text('content', isset($post) ? $post->content : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...'])!!}<Br>
                                @else
                                    <textarea name="content" id="ckeditor" cols="30" rows="10">{{isset($post) ? $post->content : ''}}</textarea>
                                @endif

                                {!! Form::label('image', 'Hình ảnh bài viết') !!}<Br>
                                {!! Form::file('image', ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<br>
                                @if(isset($post))
                                    <img src="{{asset('uploads/news/'.$post->image)}}" alt="{{$post->image}}" width="100px"><Br>
                                @endif
                                {!! Form::label('id_cate', 'Danh mục bài viết') !!}<Br>
                                {!! Form::select('id_cate', $category_select ,isset($post) ? $post->id_cate : '' , ['class'=>'form-control','placeholder' => 'Chọn danh mục tin'] ) !!}<Br>
                                                        
                                {!! Form::label('hot', 'Bài viết HOT') !!}<Br>
                                {!! Form::select('hot', ['0'=> 'Tin HOT', '1'=> 'Tin thường'] ,isset($post) ? $post->hot : '' , ['class'=>'form-control','placeholder' => 'Chọn loại tin'] ) !!}<Br>
                                  
                                {!! Form::label('active', 'Ẩn/Hiện Bài viết') !!}<Br>
                                {!! Form::select('active', ['0'=> 'Hiện', '1'=> 'Ẩn'] ,isset($post) ? $post->active : '' , ['class'=>'form-control','placeholder' => 'Ẩn/Hiện Bài viết'] ) !!}<Br>
                                
                                {!! Form::label('tags', 'Chủ đề' ) !!}<Br>                              
                                <textarea name="tags" id="" cols="30" rows="10" class="form-control" style="resize: none">{{isset($post) ? $post->tags : '' }}</textarea>
                                       
                                {!! Form::label('title', 'Thẻ meta title' ) !!}<Br>
                                {!! Form::text('metatitle',  isset($post) ? $post->metaTitle : '' , ['class'=>'form-control' ]) !!}<Br>

                                {!! Form::label('description', 'Thẻ meta description' ) !!}<Br>
                                {!! Form::text('metadescription',  isset($post) ? $post->metaDescription : '' , ['class'=>'form-control' ]) !!}<Br>

                                {!! Form::label('keyword', 'Thẻ meta keyword' ) !!}<Br>
                                {!! Form::text('metakeyword',  isset($post) ? $post->metaKeyword : '' , ['class'=>'form-control' ]) !!}<Br>


                                @if(isset($post))
                                    {!! Form::submit('Cập nhật bài viết', ['class'=>'btn btn-primary']) !!}
                                @else
                                    {!! Form::submit('Thêm bài viết', ['class'=>'btn btn-primary']) !!}
                                @endif
                                <a href="{{route('post.index')}}" class="btn btn-primary">Danh sách</a>
                            </div>
                       
                        {!! Form::close() !!}
                        </div>
                    </div>
                   
                
                </div>
            </div>
            <!-- Form End -->


@endsection
