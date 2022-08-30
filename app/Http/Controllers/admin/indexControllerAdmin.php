<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use App\Models\newsletter;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\system;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class indexControllerAdmin extends Controller
{
    public function __construct()
    {
        $noti = contact::select('id')->where('isViews', 0)->count();
        view()->share('noti', $noti);

        $notiContent = contact::where('isViews', 0)->get();
        view()->share('notiContent', $notiContent);
        
    }


    public function home()
    {
        $sumView = Post::selectRaw('view')->get();
        $sumPost = Post::selectRaw('id')->get()->count();     
        $sumContact = contact::selectRaw('id')->get()->count(); 
        $sumNL = newsletter::selectRaw('id')->get()->count();
       
        return view('admin.homeadmin', compact('sumView','sumPost','sumContact','sumNL'));
    }


    public function index()
    {

        $name = system::where('status', 1)->where('code','name')->first();
        $logo = system::where('status', 1)->where('code','logo')->first();
        $favicon = system::where('status', 1)->where('code','favicon')->first();
        $email = system::where('status', 1)->where('code','email')->first();
        $phone = system::where('status', 1)->where('code','phone')->first();
        $address = system::where('status', 1)->where('code','address')->first();
        $copyright = system::where('status', 1)->where('code','copyright')->first();
        return view('admin.system.system', compact('logo', 'name','favicon', 'email','phone','address','copyright'));
    }
    public function system_post(Request $request)
    {
        if($request->name == '' || $request->address == '' || $request->phone == '' ){
            return redirect('admin/system')->back()->with(['flash_level'=>'danger' , 'message' => 'Vui lòng điền vào các trường có *']);
        }

        system::where('status', 1)
        ->where('code', 'name')
        ->update(['description' => $request->name ]);
        
        system::where('status', 1)
        ->where('code','email')
        ->update(['description' => $request->email ]);

        system::where('status', 1)
        ->where('code','phone')
        ->update(['description' => $request->phone ]);

        system::where('status', 1)
        ->where('code','address')
        ->update(['description' => $request->address ]);

        system::where('status', 1)
        ->where('code','copyright')
        ->update(['description' => $request->coppy]);

        // logo
        if(!empty($request->file('logo'))){
            $logo = system::where('status', 1 )->where('code', 'logo')->first();
            $path = 'logo/'.$logo->description;

            if(File::exists($path)){
                File::delete($path);
            }

            // upload image
            $name = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move('logo/', $name);

            $logo->description = $name;
            $logo->save();


        }
            // favico
            if(!empty($request->file('favicon'))){
            $favicon = system::where('status', 1 )->where('code', 'favicon')->first();
            $path = 'favicon/'.$favicon->description;

            if(File::exists($path)){
                File::delete($path);
            }

            // upload image
            $name = $request->file('favicon')->getClientOriginalName();
            $request->file('favicon')->move('favicon/', $name);

            $favicon->description = $name;
            $favicon->save();
            
        };

        return redirect('admin/system')->with(['flash_level'=>'success' , 'message' => 'Chỉnh sửa thành công']);


    }


    public function getTest()
    {
        $list = DB::table('categories as a')
        ->join('posts as b', 'a.id', '=','b.id_cate')
        ->selectRaw('a.category_name, count(a.id) as countPost')
        ->where('b.active', 0)
        ->groupBy('a.id')
        ->get();

        return response($list, 200);

    }
    public function getView()
    {
        $list = Post::all()->take(5);

        return response($list, 200);

    }

}
