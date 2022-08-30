@extends('layouts.app')
@section('title', 'Danh sách danh mục tin')
@section('cate', 'active')
@section('content')

    <div class="container-fluid pt-4 px-4">
        <div class="row g-12">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Danh sách danh mục</h6>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên danh mục</th>           
                                    <th scope="col">Tên phụ</th>           
                                    <th scope="col">Trạng thái</th>           
                                    <th scope="col">Xử lý</th>
                                </tr>
                            </thead>
                            @foreach ($list as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$item->category_name}}</td>
                                <td>{{$item->slug}}</td>                 
                                <td>
                                    @if($item->status == 1)
                                        Đang bật
                                    @else
                                        Đã tắt
                                    @endif    
                                </td>                 
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['category.destroy', $item->id],
                                        'onsubmit' => 'return confirm("Bạn muốn xóa?")'
                                    ]) !!}
                                    {!! Form::submit('Xóa', ['class'=> 'btn btn-danger']) !!}
                                    <a href="{{route('category.edit', $item->id)}}" class="btn btn-warning">Sửa</a>
                                    {!! Form::close() !!}
                                </td>
                                
                            </tr>
                            @endforeach 
                        </table>
                    </div>
                    <a href="{{route('category.create')}}" class="btn btn-primary">Thêm danh mục</a>
                </div>
            </div>
        </div>
    </div>
    

    
@endsection
