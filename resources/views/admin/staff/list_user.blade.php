@extends('layouts.app')
@section('title', 'Trang danh sách khách hàng')

@section('staff', 'active')
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-12">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Danh sách khách hàng</h6>
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Họ và tên</th>           
                                <th scope="col">Cấp bậc</th>   
                                <th scope="col">Email</th>   
                                <th scope="col">Số điện thoại</th>                   
                                <th scope="col">Trạng thái</th>                   
                                <th scope="col">Xử lý</th>
                            </tr>
                        </thead>
                        @foreach ($data_user as $key => $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->name_position}}</td>                 
                            <td>{{$item->email}}</td>                 
                            <td>{{$item->phone}}</td>  
                            <td>
                                @if($item->status == 0)
                                    Hoạt động
                                @else
                                    Tắt hoạt động
                                @endif    
                            </td>                
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['staff.destroy', $item->id],
                                    'onsubmit' => 'return confirm("Bạn muốn xóa?")'
                                ]) !!}
                                {!! Form::submit('Xóa',  ['class'=> 'btn btn-danger', 'title'=>'Xóa']) !!}
                                <a href="{{route('staff.edit', $item->id)}}" title="Chỉnh sửa" class="btn btn-warning">Sửa</a>
                                {!! Form::close() !!}
                            </td>
                            
                        </tr>
                        @endforeach 
                    </table>
                </div>
                <a href="{{route('staff.index')}}" class="btn btn-primary">Danh sách nhân viên</a>
            </div>
        </div>
    </div>
</div>
@endsection