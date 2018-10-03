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
       $q = "select *, d.card_name, u.`name` FROM cards c
       LEFT JOIN cat_cards d ON c.card_provider = d.card_code
       LEFT JOIN users u ON c.order_id = u.id";
        $result = DB::select($q);
        if($result) {
            return view('admin.danh-sach-the-nap',compact('result'));
        }
        return false;
    }

   
}
