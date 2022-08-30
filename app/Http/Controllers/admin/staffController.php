<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\user_position;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 

class staffController extends Controller
{

    public function __construct()
    {
        $noti = contact::select('id')->where('isViews', 0)->count();
        view()->share('noti', $noti);

        $notiContent = contact::where('isViews', 0)->get();
        view()->share('notiContent', $notiContent);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('users as a')
        ->join('user_position as b', 'a.position', '=', 'b.id')
        ->selectRaw('a.id, a.name, a.address, a.email, a.phone ,a.position, b.name_position, a.status')->where('position','=', 1)->orWhere('position','=', 2)->get();


        return view('admin.staff.list',compact('data'));
        
    }
    public function list_user()
    {
        
        $data_user = DB::table('users as a')
        ->join('user_position as b', 'a.position', '=', 'b.id')
        ->selectRaw('a.id, a.name, a.address, a.email, a.phone ,a.position, b.name_position, a.status')->where('position','=', 3)->get();

        return view('admin.staff.list_user',compact('data_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_position = user_position::where('status', 0)->get();

        return view('admin.staff.form',compact('user_position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->name == '' || $request->address == '' || $request->phone == '' || $request->email == '' || $request->password == '' || $request->position =='' ){
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Vui lòng điền vào các trường có * và chọn chức vụ']);
        }

        $user = new User();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->status = 0;
        $user->email = $request->email;
        $user->position = $request->position;
        $user->password = Hash::make($request->password);

        $flag = $user->save();

        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Thêm nhân viên thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Lỗi thêm thành viên']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id); 

        $user_position = user_position::where('status', 0)->get();

        return view('admin.staff.form',compact('user','user_position'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id); 
        $user_position = user_position::where('status', 0)->get();
        return view('admin.staff.form', compact('user','user_position' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->name == '' || $request->address == '' || $request->phone == '' ){
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Vui lòng điền vào các trường có *']);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->position = $request->position;

        if(isset($request->password) && $request->password != ''){
            $user->password = Hash::make($request->password);
        };
        
        $flag = $user->save();

        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Cập nhật thông tin tài khoản thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Chỉnh sửa thông tin tài khoản không thành công']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id)->delete();
        
        if($data == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Xóa nhân viên thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Lỗi xóa thành viên']);
        }
    }
}
