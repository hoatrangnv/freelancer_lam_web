<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Card;
use App\Payment;
use App\Log;

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
        //NEU CHAP NHAN THI CONG TIEN
        if($request->get('status') == 2) {
            //chiet khau
            $member = $request->get('member');
            $price = $request->get('price');
            $discount = $request->get('rate');
            $amount = $price - ($price * ($discount - $member)) /100;

            $result = Payment::find($request->get('payment_id'));
            $result->payment_status = 2;
            $result->price = 1000000;
            $result->amount = $amount;
            $result->save();
             $mess = "Nạp tiền vào tài khoản thẻ mệnh giá: ". $request->get('price'). "loại thẻ: " . $request->get('card_name');
            //log
            $log = Log::create([
                'log_user_id' =>$request->get('user_id'),
                'log_content' => $mess,
                'log_amount'=> $amount,
                'log_time'=>1,
                'log_type' => "NAP TIEN",
                'log_read' => 1
            ]);
            
        } 
        else if ($request->get('status') == 6) {
                $result = Payment::find($request->get('payment_id'));
                $result->is_deleted = 1; //xoa record
                $result->save();
        }
        else {
            $result = Payment::find($request->get('payment_id'));
            $result->payment_status = $request->get('status'); //xoa record
            $result->save();
        }
        return redirect()->back()->with('message', 'Nạp thẻ thành công, vui lòng chờ hệ thống xác nhận!');
                
        // LOG

        // XOA THI XOA
    }
   
}
