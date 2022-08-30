@extends('layouts.app')
@section('title', 'Trang danh sách liên hệ')
@section('contact', 'active')
@section('content')

    
<div class="container-fluid pt-4 px-4">
    <div class="row g-12">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Danh sách liên hệ</h6>
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Họ và tên</th>           
                                <th scope="col">Email</th>           
                                <th scope="col">Nội dung</th>           
                                <th scope="col">Trạng thái</th>                                               
                                <th scope="col">Xử lý</th>
                            </tr>
                        </thead>
                        @foreach ($list as $key => $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->content}}</td>
                                             
                            <td>
                                @if($item->isViews == 1)
                                    <span style="color: green">Đã trả lời</span>
                                @else
                                    <span  style="color:orangered">Chưa xem</span>  
                                @endif    
                            </td>                
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['contact.destroy', $item->id],
                                    'onsubmit' => 'return confirm("Bạn muốn xóa?")'
                                ]) !!}
                                {!! Form::submit('Xóa',  ['class'=> 'btn btn-danger', 'title'=>'Xóa']) !!}
                                <a href="{{route('contact.edit', $item->id)}}" title="Chỉnh sửa" class="btn btn-warning">Trả lời</a>
                                {!! Form::close() !!}
                            </td>
                            
                        </tr>
                        @endforeach 
                    </table>
                </div>
               
            </div>
        </div>
    </div>
</div>

@endsection