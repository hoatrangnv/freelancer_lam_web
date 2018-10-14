<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Card_card;
use App\Card;
use App\Payment;
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

    
}
