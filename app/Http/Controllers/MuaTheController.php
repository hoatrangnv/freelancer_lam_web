<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Card_card;
use App\Card;
use App\Payment;
use App\BuyCard;
use Config;
use Auth;
class MuaTheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = "select * from cat_cards where card_type= 1";
        $result = DB::select($q);
        $CARD_STATUS = Config::get('constants.CARD_STATUS');
        $card = Card_card::all();
        return view('muathe.index',compact(['result','card']));
    }


    // /xu ly napt the
    public function buyCard(Request $request)
    {
    //    return $request->all();
       $CHUA_XOA = Config::get('constants.CHUA_XOA');
       $CHO_DUYET = Config::get('constants.CHO_DUYET');

       //get discount
       $cat_code = $request->get('card_type');
        $cat_card = DB::table('cat_cards')
                        ->where('card_code',$cat_code )
                        ->get();
        $discount = 0;                
        foreach($cat_card as $value) {
            $discount = $value->card_discount_buy;
        } 
        $member = $request->get('member');
        $price = $request->get('card_price');
        $qty = $request->get('qty');
        $get_price = $price * $qty;
        //tinh toan tong tien
        $amount =  $get_price - ($get_price * ($discount - $member)) /100;

        $result = BuyCard::create([
            'user_id' => $request->get('user_id'),
            'card_provider_code' => $cat_code,
            'card_provider_name'=> $value->card_name,
            'card_discount'=> $discount,
            'card_amount'=>$amount,
            'card_amount_discount' => $discount,
            'card_qty' =>  $qty,
            'card_prices' => $price,
            'card_prices_discounted' => 0,
            'money_before' => null,
            'money_after' =>null,
            'card_notes' => null,
            'card_info' => null,
            'card_pin'=> null,
            'card_serial' =>null,
            'status' => $CHO_DUYET,
            'is_deleted'=>$CHUA_XOA
       ]);
       return redirect()->back()->with('message', 'Gửi yêu cầu mua thẻ thành công!');
    }
}
