<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Card_card;
use App\Card;
class NaptheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $q = "select * from cat_cards where card_status= 1";
        $result = DB::select($q);
        return view('napthe.index',compact('result'));
    }

    //function nap the
    function napthecao(Request $request) {
       $result = Card::create([
            'order_id' => $request->get('user_id'),
            'card_pin' => $request->get('card_pin'),
            'card_serial' => $request->get('card_seria'),
            'card_notes' => "Chưa xác nhận",
            'card_provider' => $request->get('card_type'),
            'card_delivered' => 1,
            'card_price' => $request->get('card_price'),
       ]);
       if($result) {
        return redirect()->back()->with('message', 'Nạp thẻ thành công, vui lòng chờ hệ thống xác nhận!');
       }
       return false;
    }
}
