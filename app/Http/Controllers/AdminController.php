<?php

namespace App\Http\Controllers;

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
        $result = Card::all();
        return view('admin.danh-sach-the-nap',compact('result'));
    }

   
}
