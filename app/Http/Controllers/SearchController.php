<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\ListFrame;
use App\CardAuto;

class SearchController extends Controller
{

    public function index()
    {
        return view('admin.my-search');
    }

    public function mySearch(Request $request)
    {

        $users = CardAuto::where('serial',$request->get('search'))
        ->paginate(10);
        // return $users;
        if($users){
            return response()->json($users);
        }
        return "Không tìm thấy";
    }


}
