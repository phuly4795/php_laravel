<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\user_position;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 


class staff extends Controller
{
    public function __construct()
    {
        $noti = contact::select('id')->where('isViews', 0)->count();
        view()->share('noti', $noti);

        $notiContent = contact::where('isViews', 0)->get();
        view()->share('notiContent', $notiContent);
        
    }
    public function index()
    {
        return view('admin.staff.profile');
    }

    public function updateAdmin(Request $request)
    {
        if($request->name == '' || $request->address == '' || $request->phone == '' ){
            return redirect('admin/profile')->with(['flash_level'=>'danger' , 'message' => 'Vui lòng điền vào các trường có *']);
        }

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
    
        // Thêm hình ảnh
        $get_image = $request->file('image');
        $path = 'uploads/imgAdmin/'; 

        if($get_image){

           if(!empty($user->image)){
               unlink('uploads/imgAdmin/'.$user->image);
           }

            $get_name_image = $get_image->getClientOriginalName();  // hinhanh1.jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension(); //hinhanh12345.jpg
            $get_image->move($path,$new_image);
            $user->image = $new_image;
            
        }

        if(isset($request->password) && $request->password != ''){
            $user->password = Hash::make($request->password);
        };
        
        $flag = $user->save();

        if($flag == true){
            return redirect('admin/profile')->with(['flash_level'=>'success' , 'message' => 'Cập nhật thông tin tài khoản thành công']);
        }
        else{
            return redirect('admin/profile')->with(['flash_level'=>'danger' , 'message' => 'Chỉnh sửa thông tin tài khoản không thành công']);
        }
    }

    
}
