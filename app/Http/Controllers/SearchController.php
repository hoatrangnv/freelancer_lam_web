<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\ListFrame;
use App\CardAuto;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function index()
    {
        return view('admin.my-search');
    }

    public function mySearch(Request $request)
    {

        $users =  DB::table('card_auto as c')
            ->leftjoin('users as u','c.user_id','=','u.id')
            ->where('serial',$request->search)
            ->get();
        if($users){
            return response($users);
        }
        return "Không tìm thấy";
    }


}
