<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;
use App\Models\newsletter;

class newsletterController extends Controller
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

        $list = newsletter::get();
        return view('admin.newsletter.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $list = newsletter::find($id);

        return view('admin.newsletter.form', compact('list'));

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
        if($request->email == '' || $request->isviews == '' ){
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Vui lòng không bỏ trống các trường']);
        }
        $nl = newsletter::find($id);
        $nl->email = $request->email;
        $nl->isViews = $request->isviews;
               
        $flag = $nl->save();

        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Cập nhật thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Chỉnh sửa không thành công']);
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
        //
        $nl = newsletter::find($id);
        $flag = $nl->delete();

        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Xóa thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Xóa không thành công']);
        }
    
    }
}
