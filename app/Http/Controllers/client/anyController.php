<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\PostEmail;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Comment;
use App\Models\contact;
use App\Models\pageModel;
use App\Models\Post;
use App\Models\system;
use Illuminate\Support\Facades\DB;
use App\Models\newsletter;
use App\Models\parenComment;
use App\Models\User;
use App\Models\wishlist;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class anyController extends Controller
{
    public function api_id_comment()
    {

        $list = Comment::select('id')->get();

        return response()->json($list, 200);
    }
    public function __construct()
    {

        //logo
        $logo = system::select('description')->where('code', 'logo')->first();
        view()->share('logo', $logo);

        //favicon
        $favicon = system::select('description')->where('code', 'favicon')->first();
        view()->share('favicon', $favicon);

        //coppyright
        $copyright = system::select('description')->where('code', 'copyright')->first();
        view()->share('copyright', $copyright);

        //menu
        $menu = pageModel::where('status', '1')->selectRaw('name, font, slug')->orderBy('Sort', 'ASC')->get();
        view()->share('menu', $menu);

        $footer = pageModel::where('status', 1)->selectRaw('mota')->first();
        view()->share('footer', $footer);


        $getNewsLatest = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->selectRaw('a.*, b.slug as slugCate, b.category_name')
            ->where('a.active', 0)
            ->where('id_cate', 15)
            ->take(5)
            ->orderBy('id', 'DESC')
            ->get();

        view()->share('getNewsLatest', $getNewsLatest);

        $getCate = category::where('status', 1)->get();

        view()->share('getCate', $getCate);
    }
    public function index()
    {
        // index 
        $pageinfo = pageModel::where('status', 1)->where('slug', '/')
            ->selectRaw('name, slug, metaTitle, metaDescription, metaKeyword')->first();


        $newsHot = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->selectRaw('a.*, b.category_name,b.slug as slugCate')
            ->where('a.hot', 0)
            ->where('a.active', 0)
            ->take(4)
            ->get();


        $newsLatest = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->selectRaw('a.*, b.slug as slugCate, b.category_name')
            ->where('a.active', 0)
            ->where('a.id_cate', 15)
            ->take(3)
            ->orderBy('id', 'DESC')
            ->get();

        $newsViews = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->selectRaw('a.*, b.category_name, b.slug as slugCate')
            ->where('a.active', 0)
            ->orderBy('a.view', 'DESC')
            ->take(6)
            ->get();

        //banner
        $banner = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->selectRaw('a.*, b.category_name, b.slug as slugCate')
            ->where('a.active', 0)
            ->where('a.hot', 0)
            ->orderBy('a.id', 'DESC')
            ->take(1)
            ->get();


        $videoHot = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->selectRaw('a.*, b.slug as slugCate, b.category_name')
            ->where('a.active', 0)
            ->where('a.id_cate', 10)
            ->take(4)
            ->orderBy('id', 'DESC')
            ->get();


        $videoViews = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->selectRaw('a.*, b.category_name, b.slug as slugCate')
            ->where('a.active', 0)
            ->where('a.id_cate', 10)
            ->orderBy('a.view', 'DESC')
            ->take(6)
            ->get();

        return view('pages.home', compact('pageinfo', 'banner', 'newsHot', 'newsLatest', 'newsViews', 'videoHot', 'videoViews'));
    }


    public function subEmail(Request $request)
    {
        if ($request->txtEmailSub != '') {

            $newsLetter = newsletter::where('email', $request->txtEmailSub)->get();

            if (isset($newsLetter) && count($newsLetter) > 0) {

                echo 'error_exit_email';
            } else {

                $newsLetter = new newsletter;

                $newsLetter->email = $request->txtEmailSub;

                $mailData = $request->txtEmailSub;

                Mail::to("phuly4795@gmail.com")->send(new PostEmail($mailData));

                $flag = $newsLetter->save();

                if ($flag == true) {
                    echo 'finish';
                } else {
                    echo 'error';
                }
            }
        } else {
            echo 'error';
        }
    }

    public function contact()
    {

        $pageinfo = pageModel::where('status', 1)->where('slug', 'lien-he')
            ->selectRaw('name, slug, metaTitle, metaDescription, metaKeyword')->first();

        return view('pages.contact', compact('pageinfo'));
    }


    public function subcontact(Request $request)
    {
        if ($request->email != '' &&  $request->name != '' && $request->message != '') {

            $contact = new contact;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->content = $request->message;
            $flag = $contact->save();


            if ($flag == true) {
                echo 'finish';
            } else {
                echo 'error';
            }
        } else {
            echo 'error_empty';
        }
    }


    public function aboutus()
    {
        // index 
        $pageinfo = pageModel::where('status', 1)->where('slug', 've-chung-toi')
            ->selectRaw('name, slug, metaTitle, metaDescription, metaKeyword, mota')->first();

        return view('pages.about', compact('pageinfo'));
    }
    public function tags($tag)
    {

        $tags = DB::table('posts as a')
            ->join('categories as b', 'b.id', '=', 'a.id_cate')
            ->where('a.tags', 'LIKE', '%' . $tag . '%')
            ->selectRaw('a.*, b.category_name, b.slug as slugCate')
            ->orderBy('a.id', 'DESC')
            ->paginate(5);
        $tag = $tag;
        return view('pages.tags', compact('tags', 'tag'));
    }

    public function pageCate($slug)
    {
        if (isset($slug) && $slug != null) {

            $pageCate = pageModel::where('status', 1)->where('slug', $slug)->first();

            $list = DB::table('posts as a')
                ->join('categories as b', 'a.id_cate', '=', 'b.id')
                ->where('a.active', 0)
                ->where('b.slug', $slug)
                ->selectRaw('a.*, b.category_name')
                ->paginate(4);

            return view('pages.cateNews', compact('pageCate', 'list'));
        }
    }

    public function detail($slug, $slug1, Request $request)
    {

        $view = DB::table('posts')->where('slug', $slug1)->first();

        $increView = DB::table('posts')
            ->where('slug', $slug1)
            ->update(['view' =>  $view->view + 1]);

        $newsDetail = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->where('a.active', 0)
            ->where('a.slug', $slug1)
            ->selectRaw('a.*, b.category_name, b.id as id_cate, b.slug as slugCate')
            ->first();

        $wishlist = DB::table('wishlist')->where('id_post', $view->id)->where('id_user', Auth::id())->first();

        $matchcate = DB::table('posts as a')
            ->join('categories as b', 'a.id_cate', '=', 'b.id')
            ->where('a.id_cate', $view->id_cate)
            ->whereNotIn('a.slug', [$slug1])
            ->selectRaw('a.*, b.category_name, b.id as id_cate, b.slug as slugCate')
            ->orderBy(DB::raw('RAND()'))
            ->take(2)
            ->get();



        return view('pages.detailNews', compact('newsDetail', 'wishlist', 'matchcate'));
    }

    public function search(Request $request)
    {
        $pageinfo = pageModel::where('status', 0)->where('slug', 'tim-kiem')
            ->selectRaw('name, slug, metaTitle, metaDescription, metaKeyword')->first();

        if (isset($request->q) && $request->q != NULL) {
            $searchList = DB::table('posts as a')
                ->join('categories as b', 'a.id_cate', '=', 'b.id')
                ->where('a.active', 0)
                ->where('a.title', 'like', '%' . $request->q . '%')
                ->selectRaw('a.*, b.category_name, b.slug as slugCate')
                ->paginate(5);
        } else {
            $searchList = NULL;
        }

        return view('pages.search', compact('pageinfo', 'searchList'));
    }

    public function wishlist()
    {
        $wishlish = DB::table('posts as a')
            ->join('wishlist as b', 'a.id', '=', 'b.id_post')
            ->join('categories as c', 'c.id', '=', 'a.id_cate')
            ->where('b.id_user', Auth::id())
            ->selectRaw('a.*, c.category_name, c.slug as slugCate')
            ->paginate(4);
        return view('pages.wishlist', compact('wishlish'));
    }

    public function addwishlist(Request $request)
    {
        if (Auth::check()) {

            $id = $request->input('post_id');

            if (Post::find($id)) {

                $wish = new wishlist();
                $wish->id_post = $id;
                $wish->id_user = Auth::id();
                $wish->save();


                echo 'success';
            } else {
                echo 'đã xảy ra lỗi';
            }
        } else {

            echo 'login';
        }
    }
    public function delewishlist(Request $request)
    {
        if (Auth::check()) {

            $id = $request->input('post_id');

            if (wishlist::where('id_post', $id)->where('id_user', Auth::id())->exists()) {

                $wish = wishlist::where('id_post', $id)->where('id_user', Auth::id())->first();

                $wish->delete();

                echo 'success';
            }
        } else {
            echo 'login';
        }
    }


    public function profile()
    {

        $profile = User::where('id', Auth::id())->first();


        return view('pages.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {

        if ($request->name == '' || $request->address == '' || $request->phone == '') {
            return redirect()->back()->with(['flash_level' => 'danger', 'message' => 'Vui lòng điền vào các trường có *']);
        }


        $user = User::find(Auth::id());

        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;

        if (isset($request->password) && $request->password != '') {
            $user->password = Hash::make($request->password);
        };

        $flag = $user->save();

        if ($flag == true) {
            return redirect()->back()->with(['flash_level' => 'success', 'message' => 'Cập nhật thông tin tài khoản thành công']);
        } else {
            return redirect()->back()->with(['flash_level' => 'danger', 'message' => 'Chỉnh sửa thông tin tài khoản không thành công']);
        }
    }

    public function autocomplete(Request $request)
    {

        $data = $request->all();

        if ($data['query']) {

            $post = Post::where('active', 0)->where('title', 'LIKE', '%' . $data['query'] . '%')->get();

            $output = '
                <ul class="dropdown-menu" style="display:block, position:relative">
            ';

            foreach ($post as $p) {
                $output .= ' <li style="line-height: 30px; padding-left: 1%;" class="li_search_ajax"><a href="#">' . $p->title . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function email()
    {
        $name = 'Test name for email';
        Mail::send('email.PostEmail', compact('name'), function ($message) {
            $message->to('phuly4795@gmail.com', 'Thành Phú');
        });
    }

    public function addComment(Request $request)
    {
        if ($request->txtContent != '') {

            $comment = new Comment();
            $comment->id_post = $request->txtIdPost;
            $comment->id_user = Auth::user()->id;
            $comment->content = $request->txtContent;
            $comment->id_parent_comment = $request->id_parent;
            $flag = $comment->save();

            if ($flag == true) {
                echo 'finish';
            } else {
                echo 'error';
            }
        } else {
            echo 'error_empty';
        }
    }
    public function addRepComment(Request $request)
    {
        if ($request->txtContent != '') {

            $rep_comment = new Comment();
            $rep_comment->id_post = $request->txtIdPost;
            $rep_comment->id_parent_comment = $request->id_parent;
            $rep_comment->id_user = Auth::user()->id;
            $rep_comment->content = $request->txtContent;
            $flag = $rep_comment->save();

            if ($flag == true) {
                echo 'repfinish';
            } else {
                echo 'reperror';
            }
        } else {
            echo 'reperror_empty';
        }
    }






    public function loadComment(Request $request)
    {
        $post_id = $request->IdPost;

        $getComment = DB::table('comment as a')
            ->join('users as b', 'a.id_user', '=', 'b.id')
            ->where('a.id_post', $post_id) 
            ->selectRaw('a.content,a.created_at as time , a.id, b.image, b.name')
            ->orderBy('a.id', 'DESC')
            ->get();

        $output = '';

        foreach ($getComment as $c) {
         
                $output .= ' 
                <input type="hidden" id="id_comment" value ="' . $c->id . '">
    
                <div class="get_comment">
                    <img src="' . asset('uploads/img/' . $c->image) . '" alt="hình ảnh đại diện">
                    <div class="get_one">
                        <h3 style="margin-bottom: 10px;">' . $c->name . '</h3>
                        <p>' . $c->content . '</p>      
                        <i>'.date('d/m/Y',strtotime($c->time)).'</i>                                             
                    </div>                                                           
                </div> ';

          
        //     <div class="repplay">
        //     <a class="repplay_com" id="repplay_com" style="margin-right: 10px" onclick="activeRepply(' . $c->id . ')">Phản hồi</a>                                      
        // </div>
            // foreach ($getComment as $rep_comment) {
            //     if ($rep_comment->id_parent_comment == $c->id) {

            //         $output .= ' 
            
            // <div class="rep_get_comment"  id="repplay_comment">
            //     <img src="' . asset('uploads/img/' . $rep_comment->image) . '" alt="hình ảnh đại diện">
            // <div class="rep_get_one">
            //         <h3 style="margin-bottom: 10px;">'.$rep_comment->name.'</h3>
            //         <p>' . $rep_comment->content . '</p>                                                 
            //     </div>                                                           
            // </div>
            //         ';
            //     }
            // }

            // $output .= ' 
                
            //     <div class="rep_comment-box" id="rep_comment-box_' . $c->id . '">
            //     <div class="rep_add_comment">
            //         <img src="' . asset('uploads/img/' . Auth()->user()->image . '') . '"
            //             alt="hình ảnh đại diện">
            //         <input class="form-control" id="content_rep"
            //             placeholder="Viết bình luận...">
            //     </div>
            //     <button class="btn btn-primary" onclick="rep_comment()" style="margin-top:2%;margin-left:12% ">Trả lời bình luận</button>
            // </div>            
        // ';
        }

        echo $output;
    }
}
