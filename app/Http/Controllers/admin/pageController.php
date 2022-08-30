<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;
use App\Models\pageModel;

use Illuminate\Support\Facades\File;
class pageController extends Controller
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
        //
        $list = pageModel::get();
        return view('admin.pages.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.pages.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
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
        //

        $page = pageModel::find($id);


        return view('admin.pages.form', compact('page'));

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
        if($request->name == ''  || $request->sort == '' || $request->status == ''){
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Vui lòng không bỏ trống các trường']);
        }

        $page = pageModel::find($id);
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->font = $request->font;
        $page->sort = $request->sort;
        $page->metaTitle = $request->title;
        $page->metaDescription = $request->description;
        $page->metaKeyword = $request->keyword;
        $page->mota = $request->mota;
        $page->status = $request->status;
    
        $flag = $page->save();

        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Cập nhật thành công']);
        }else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Chỉnh sửa thất bại']);
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

        $page = pageModel::find($id)->delete();


        if($page == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Xóa thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Lỗi xóa ']);
        }
        
    }
}
