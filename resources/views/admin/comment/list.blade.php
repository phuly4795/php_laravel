@extends('layouts.app')
@section('title', 'Danh sách bình luận')
@section('comment', 'active')
@section('content')

    <div class="container-fluid pt-4 px-4">
        <div class="row g-12">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Danh sách bình luận</h6>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Họ và tên </th>           
                                    <th scope="col">Nội dung</th>           
                                    <th scope="col">Tin bình luận</th>           
                                    <th scope="col">Danh mục tin bình luận</th>           
                                    <th scope="col">Xử lý</th>
                                </tr>
                            </thead>
                            @foreach ($list as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->content}}</td>                 
                                <td>{{Str::limit($item->title, $limit = 30 , '...') }}</td>                 
                                <td>{{Str::limit($item->category_name, $limit = 30 , '...') }}</td>                 
                                            
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['comment.destroy', $item->id],
                                        'onsubmit' => 'return confirm("Bạn muốn xóa?")'
                                    ]) !!}
                                    {!! Form::submit('Xóa', ['class'=> 'btn btn-danger']) !!}
                           
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
