<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Card;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function listCard()
    {
       $q = "SELECT *,p.image_url as src,p.id as payment_id,u.name as username, u.id as user_id, c.card_name as card_name FROM payments p
       LEFT JOIN users u ON p.user_id = u.id  
       LEFT JOIN cat_cards c ON p.provider = c.card_code
       ORDER BY  payment_id ASC
       ";
        $result = DB::select($q);
        if($result) {
            return view('admin.danh-sach-the-nap',compact('result'));
        }
        return false;
    }

    //function xu ly hanh dong nap the
    function addCard(Request $request) {
        dd($request->all());
    }
   
}
