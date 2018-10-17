<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payment;
use App\Log;
use App\Link;
use Config;
use Auth;

class FrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $result = Link::where('user_id',$user_id)->get();
        return view('frame.index',compact('result')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $CHUA_XOA = Config::get('constants.CHUA_XOA');
        
        $price = $request->get('price');
        $title = $request->get('title');
        $content = $request->get('content');
        $user_id = Auth::user()->id;
        $link = Link::create([
            'title' =>$title,
            'content'=>$content,
            'price'=>$price,
            'user_id'=> $user_id,
            'active'=>$CHUA_XOA
        ]);
        return redirect()->back()->with('message', 'Tích hợp vào website thành công!');

    }

    public function updateLink(Request $request)
    {
        $id = $request->get('id');
        $result = Link::find($id);
        $result->title = $request->get('title');
        $result->content = $request->get('content');
        $result->price = $request->get('price');
        $result->save();
        return redirect()->back()->with('message', 'Update website thành công!');
    }

    public function naptheFrame()
    {
        return view('frame.napthe');
    }
}
