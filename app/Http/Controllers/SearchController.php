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

        $user =  DB::table('card_auto as c')
            ->leftjoin('users as u','c.user_id','=','u.id')
            ->where('serial',$request->search)
            ->get();
        $check = CardAuto::where('serial', $request->get('search'))
                            ->count();
            // return $user;
        if($check === 1){
            return response()->json([
                'code' => 200,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'code' => 300,
                'data' => "Thẻ không tồn tại"
            ]);
        }

    }


}
