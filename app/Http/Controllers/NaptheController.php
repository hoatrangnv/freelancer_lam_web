<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Card_card;
use App\Card;
use App\Payment;
use Config;
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

    //function nap the tu web
    function napthecao(Request $request) {
        //get discount
        $q = Card_card::where('card_code',$request->get('card_type'))->get();
        $card_discount = null;
        foreach($q as $value) {
            $card_discount = $value['card_discount'];
        }
       $result = Payment::create([
            'phone' => $request->get('user_phone'),
            'card_type_id' => $request->get('card_price'),
            'pin' => $request->get('card_pin'),
            'serial' => $request->get('card_seria'),
            'provider' => $request->get('card_type'),
            'user_id' => $request->get('user_id'),
            'link_id' => null,
            'ip_request' => null,
            'price' => $request->get('card_price'),
            'amount' => 0,
            'rate' => $card_discount,
            'transaction_id' => str_random(10),
            'balance' => 0,
            'requestId' => null,
            'topup_type' => 0,
            'is_image' => Config::get('constants.NOT_IMAGES'),
            'image_url' => null,
            'notes' => null,
            'payment_status' => Config::get('constants.PENDING_ACCEPT'),
            'is_deleted' => 0,            
       ]);
       if($result) {
        return redirect()->back()->with('message', 'Nạp thẻ thành công, vui lòng chờ hệ thống xác nhận!');
       }
       return false;
    }
}
