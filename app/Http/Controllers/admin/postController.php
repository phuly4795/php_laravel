<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Mail\PostEmail;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\category;
use App\Models\contact;
use App\Models\newsletter;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class postController extends Controller
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

        
        $list = DB::table('posts as a')
        ->join('categories as b', 'a.id_cate', '=', 'b.id' )
        ->selectRaw('a.*, b.category_name')->get();

        return view('admin.product.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $category_select = category::pluck('category_name','id');

        return view('admin.product.form', compact('category_select'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->title == '' || $request->summary == '' || $request->content == '' 
            || $request->image == '' || $request->id_cate == '' || $request->hot == '' || $request->active == '' ){
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Vui lòng không bỏ trống các trường']);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->summary = $request->summary;
        $post->content = $request->content;
        $post->image = $request->image;    
        $post->id_cate = $request->id_cate;
        $post->view = 0;
        $post->hot = $request->hot;
        $post->active = $request->active;
        $post->tags = $request->tags;
        $post->metatitle = $request->metatitle;
        $post->metakeyword = $request->metakeyword;
        $post->metadescription = $request->metadescription;
       
        // Thêm hình ảnh
       
        $file = $request->file('image');        
        $name = time().'-'.$file->getClientOriginalName();  // hinhanh1.jpg
        $duoi = strtolower($file->getClientOriginalExtension());

        if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg' && $duoi != 'gif' ){
            return back()->with(['flash_level' => 'danger', 'message' => 'Định dạng hình ảnh không phù hợp']);
        }

        Storage::disk('public')->put($name,File::get($file));

        $post->image = $name;
               
        // gửi email

        if($request->hot == 0){

            $newsletter = newsletter::all();
        
            $data = [];
            
            foreach ($newsletter as $v) {

                $data['email'][] = $v->email;

            }
         
            $PostEmail = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->selectRaw('b.slug as slugCate')
            ->where('b.id', $request->id_cate)
            ->first();


            Mail::send('email.PostEmail', compact('post','PostEmail'), function ($email) use ($data) {
                $email->subject('T&PTimes - Tin HOT nè');
                $email->to($data['email']);            
            });
        }

        $flag = $post->save();

        if($flag == true){
                return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Thêm bài viết thành công']);
            }
            else{
                return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Lỗi thêm bài viết']);
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
        $category_select = category::pluck('category_name','id');
        $post = Post::find($id);
        return view('admin.product.form', compact('post','category_select'));
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
        if($request->title == '' || $request->summary == ''   || $request->id_cate == '' || $request->hot == '' || $request->active == '' ){
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Vui lòng không bỏ trống các trường']);
        }

        $post = post::find($id);
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->summary = $request->summary;
        $post->content = $request->content;       
        $post->id_cate = $request->id_cate;
        $post->hot = $request->hot;
        $post->active = $request->active;
        $post->tags = $request->tags;
        $post->metaTitle = $request->metatitle;
        $post->metaDescription = $request->metadescription;
        $post->metaKeyword = $request->metakeyword;

         // Thêm hình ảnh
        
         if($request->image){
          
            $file = $request->image;        
            $name = time().'-'.$file->getClientOriginalName();  // hinhanh1.jpg
            $duoi = strtolower($file->getClientOriginalExtension());
    
            if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg' && $duoi != 'gif' ){
                return back()->with(['flash_level' => 'danger', 'message' => 'Định dạng hình ảnh không phù hợp']);
            }

            // if(!empty($post->image)){  

            //     unlink('uploads/news/'.$post->image);

            // }

            Storage::disk('public')->put($name,File::get($file));
            
            $post->image = $name;
            
         }

         if($request->banner){
          
            $file = $request->banner;        
            $name = $request->file('banner')->getClientOriginalName();
            $duoi = strtolower($file->getClientOriginalExtension());
            if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg'){
                return back()->with(['flash_level' => 'danger', 'message' => 'Định dạng hình ảnh không phù hợp']);
            }

        
            if(!empty($post->banner)){  

                unlink('uploads/banner/'.$post->banner);

            }

            // upload image
           
            $request->file('banner')->move('uploads/banner', $name);

            $post->banner = $name;
        
        }
         
         $flag = $post->save();

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
         $flag = post::find($id);
            // dd($flag->image);
         if(!empty($flag->image)){  

            unlink('uploads/news/'.$flag->image);

        }
        $flag->delete();
        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'Xóa thành công']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Xóa thất bại']);
        }
       
    }
}
