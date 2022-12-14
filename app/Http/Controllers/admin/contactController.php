<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contact;
use Illuminate\Support\Facades\Mail;

class contactController extends Controller
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
        $list = contact::orderBy('isViews', 'ASC')->get();

        return view('admin.contact.list', compact('list'));
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
        $list = contact::find($id);

        return view('admin.contact.form', compact('list'));
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
     
        $ct = contact::find($id);

     
        $ct->isViews = 1;
        $ct->repplay = $request->repplay;

        $e = $ct->email;

        Mail::send('email.ContactEmail', compact('ct'), function ($email) use ($e) {
            $email->subject('T&PTimes - Tr??? l???i li??n h???');
            $email->to($e, 'Qu?? kh??ch');
            
        });

        $flag = $ct->save();

        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'C???p nh???t th??nh c??ng']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'Ch???nh s???a kh??ng th??nh c??ng']);
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
        $ct = contact::find($id);
        $flag = $ct->delete();

        if($flag == true){
            return redirect()->back()->with(['flash_level'=>'success' , 'message' => 'X??a th??nh c??ng']);
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger' , 'message' => 'X??a kh??ng th??nh c??ng']);
        }
    }
}
