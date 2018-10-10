<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NaptienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('naptien.index');
    }

    //function nap tien
    public function NapTien(Request $request)
    {
        return response($request->all());
    }
}
