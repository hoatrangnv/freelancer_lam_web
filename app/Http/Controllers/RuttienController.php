<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RuttienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->all();
    }

    
}
