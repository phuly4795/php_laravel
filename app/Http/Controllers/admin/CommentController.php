<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
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

        $list = DB::table('users as a' )
        ->join('comment as b', 'a.id', '=', 'b.id_user')
        ->join('posts as c', 'b.id_post', '=', 'c.id')
        ->join('categories as d', 'd.id', '=', 'c.id_cate')
        ->selectRaw('a.name, b.content, b.id, c.title, d.category_name')
        ->get();
      
        return view('admin.comment.list', compact('list'));
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
        //
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
        $comment = Comment::find($id)->delete();

        if($comment == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Xóa bình luận thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Lỗi xóa ']);
        }

    }
}
