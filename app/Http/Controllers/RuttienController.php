<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\BankAccount;
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

    public function bankList()
    {
        $bank = Bank::all();
        return response($bank);
    }

    // add tai khoan

    public function addAccount()
    {
        
    }
    
}
