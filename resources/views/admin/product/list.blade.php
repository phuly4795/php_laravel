@extends('layouts.app')
@section('title', 'Danh sách bài viết')
@section('post', 'active')
@section('content')

    <div class="container-fluid pt-4 px-4">
        <div class="row g-12">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Danh sách bài viết</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên bài viết</th>   
                                    <th scope="col">Hình ảnh</th>        
                                    <th scope="col">Tóm tắt</th>                                     
                                    <th scope="col">Danh mục</th>                                 
                                    <th scope="col">Trạng thái</th>                               
                                    <th scope="col">Thao tác</th>

                                </tr>
                            </thead>
                            @foreach ($list as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{Str::limit($item->title, $limit = 50 , '...') }}</td>
                                <td><img src="{{asset('uploads/news/'.$item->image)}}" alt="{{$item->image}}" width="80px"></td>                         
                                <td>{{Str::limit($item->summary, $limit = 50, $end = '...')}}</td>                 
                                <td>{{$item->category_name}}</td>                                                       
                                <td>
                                    @if($item->active == 0)
                                        Hiện
                                    @else
                                        Ẩn
                                    @endif    
                                </td>                          
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['post.destroy', $item->id],
                                        'onsubmit' => 'return confirm("Bạn muốn xóa?")'
                                    ]) !!}
                                    {!! Form::submit('Xóa', ['class'=> 'btn btn-danger']) !!}
                                    <a href="{{route('post.edit', $item->id)}}" class="btn btn-warning">Sửa</a>
                                    {!! Form::close() !!}
                                </td>
                               
                            </tr>
                            @endforeach 
                        </table>
                    </div>
                    <a href="{{route('post.create')}}" class="btn btn-primary">Thêm bài viết</a>
                </div>
            </div>
        </div>
    </div>
    

    
@endsection
