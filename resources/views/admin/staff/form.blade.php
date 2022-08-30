@extends('layouts.app')
@if(!isset($user))
    @section('title', 'Trang thêm nhân viên')
@else
    @section('title', 'Trang cập nhật nhân viên')
@endif
@section('staff', 'active')
@section('content')
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">       
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Quản lý nhân viên</h6>           
                            @if(isset($user))                           
                                {!! Form::open(['route'=> ['staff.update', $user->id], 'method'=>'put']) !!}         
                            @else
                                {!! Form::open(['route'=> 'staff.store', 'method'=>'post']) !!}  
                            @endif
                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                            <div class="form-group">

                                {!! Form::label('name', 'Họ và tên') !!} <span class="sao"> *</span><Br>
                                {!! Form::text('name',  isset($user) ? $user->name : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>            
                             
                                {!! Form::label('email', 'Tên email') !!}<span class="sao"> *</span><Br>
                                {!! Form::text('email',  isset($user) ? $user->email : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>            
                             
                                {!! Form::label('address', 'Địa chỉ') !!} <span class="sao"> *</span><Br>
                                {!! Form::text('address',  isset($user) ? $user->address : '' , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>            
                             
                                {!! Form::label('phone', 'Số điện thoại') !!} <span class="sao"> *</span><Br>
                                {!! Form::text('phone',  isset($user) ? $user->phone : '', ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>            
                                
                                @if(isset($user))
                                         
                                    {!! Form::label('password', 'Mật khẩu') !!}<Br>
                                    {!! Form::text('password',null , ['class'=>'form-control', 'placeholder' => 'Để trống trường này nếu không muốn thay đổi mật khẩu']) !!}<Br>            
                                @else
                                    {!! Form::label('password', 'Mật khẩu') !!}<span class="sao"> *</span><Br>
                                    {!! Form::text('password',null , ['class'=>'form-control', 'placeholder' => 'Nhập vào dữ liệu...']) !!}<Br>            
                                @endif
                                <select name="position" id="" class="form-control" placeholder="Chọn chức vụ">
                                    <option value="">Chọn chức vụ nhân viên...</option>
                                    @foreach($user_position as $key => $lv)                             
                                       @if(isset($user))
                                         <option value="{{$lv->id}}"  @if($lv->id == $user->position ) selected @endif >{{$lv->name_position}}</option>
                                        @else
                                            <option value="{{$lv->id}}"   >{{$lv->name_position}}</option>
                                        @endif
                                    @endforeach
                                </select><br>

                                @if(isset($user))
                                    <select name="status" id="" class="form-control" placeholder="Chọn chức vụ">
                                        <option value="">Chọn bật/tắt tài khoản...</option>                                    
                                    @if($user->status == 0)
                                        <option value="0" selected>Hoạt động</option>
                                        <option value="1"  >Tắt hoạt động</option>      
                                    @else
                                        <option value="0" >Hoạt động</option>
                                        <option value="1" selected >Tắt hoạt động</option>      
                                    @endif                           
                                    </select><br>
                                @endif
                            @if(!isset($user))
                                {!! Form::submit('Xác nhận', ['class'=>'btn btn-primary']) !!}
                            @else
                                {!! Form::submit('Cập nhật', ['class'=>'btn btn-primary']) !!}
                            @endif
                                <a href="{{route('staff.index')}}" class="btn btn-primary">Danh sách nhân viên</a>
                            </div>
                       
                        {!! Form::close() !!}
                        </div>
                    </div>
                   
                
                </div>
            </div>
            <!-- Form End -->
    <style>
        .sao{
            color:  red
        }
   
    </style>

@endsection
