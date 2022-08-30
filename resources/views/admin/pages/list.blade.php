@extends('layouts.app')
@section('title', 'Quản lý trang')
@section('page', 'active')
@section('content')

    
<div class="container-fluid pt-4 px-4">
    <div class="row g-12">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Danh sách trang</h6>
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên trang</th>           
                                <th scope="col">Font</th>           
                                <th scope="col">Thứ tự</th>           
                                <th scope="col">Trạng thái</th>                                               
                                <th scope="col">Xử lý</th>
                            </tr>
                        </thead>
                        @foreach ($list as $key => $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->font}}</td>
                            <td>{{$item->sort}}</td>
                                             
                            <td>
                                @if($item->status == 1)
                                    <span style="color: green">Bật</span>
                                @else
                                    <span  style="color:orangered">Tắt</span>  
                                @endif    
                            </td>                
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['page.destroy', $item->id],
                                    'onsubmit' => 'return confirm("Bạn muốn xóa?")'
                                ]) !!}
                                {!! Form::submit('Xóa',  ['class'=> 'btn btn-danger', 'title'=>'Xóa']) !!}
                                <a href="{{route('page.edit', $item->id)}}" title="Chỉnh sửa" class="btn btn-warning">Sửa</a>
                                {!! Form::close() !!}
                            </td>
                            
                        </tr>
                        @endforeach 
                    </table>
                    {{-- <a href="{{route('page.create')}}" class="btn btn-primary">Thêm trang</a> --}}
                </div>
               
            </div>
        </div>
    </div>
</div>

@endsection