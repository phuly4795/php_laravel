<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\contact;

class categoryController extends Controller
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
        $list = category::orderBy('id','DESC')->get();
        return view('admin.category.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->category_name == '' || $request->slug == ''  ){
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Vui lòng điền vào các trường có * và chọn chức vụ']);
        }

        $category = new category();
        $category->category_name= $request->category_name;
        $category->slug = $request->slug;
       
     
        $flag = $category->save();


        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Thêm danh mục thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Lỗi thêm danh mục']);
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
        $category = category::find($id);

        return view('admin.category.form', compact('category'));
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
       if($request->category_name == '' || $request->slug == '' || $request->status == ''  ){
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Vui lòng điền vào các trường có * và chọn chức vụ']);
        }
        $category = category::find($id);
        $category->category_name= $request->category_name;
        $category->slug= $request->slug;
        $category->status = $request->status;
        $flag = $category->save();

        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Thêm danh mục thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Lỗi thêm danh mục']);
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
        category::find($id)->delete();
        return redirect()->back();

    }
}
