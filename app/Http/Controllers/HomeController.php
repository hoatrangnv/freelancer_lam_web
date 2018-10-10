<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card_card;
use Config;

class HomeController extends Controller
{

 
    public function index()
    {
        $CARD_STATUS = Config::get('constants.CARD_STATUS');
        $result = Card_card::all();
        return view('home',compact('result'));
    }

    public function getListCard()
    {
        

    }
}
