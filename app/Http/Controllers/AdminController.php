<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Card;
use App\User;
use App\Payment;
use App\Log;
use Config;
use App\WithDraw;

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
        $CHUA_XOA = Config::get('constants.CHUA_XOA');
        $result =  DB::table('payments')
                      ->leftJoin('users', 'payments.user_id', '=', 'users.id')
                      ->leftJoin('cat_cards', 'payments.provider', '=', 'cat_cards.card_code')
                      ->where('payments.is_deleted', '=', $CHUA_XOA)
                      ->orderByRaw('payments.payment_id - payments.created_at ASC')
                      ->paginate(10);
        if($result) {
            return view('admin.danh-sach-the-nap',compact('result'));
        }
        return false;
    }

    //function xu ly hanh dong nap the
    function addCard(Request $request) {
        //DEFILE HANG
        $CHAP_NHAN = Config::get('constants.CHAP_NHAN');
        $CHO_DUYET = Config::get('constants.CHO_DUYET');
        $XOA = Config::get('constants.XOA');

        //NEU CHAP NHAN THI CONG TIEN
        if($request->get('status') == $CHAP_NHAN) {
            //chiet khau
            $user_id = $request->get('user_id');
            $member = $request->get('member');
            $price = $request->get('price');
            $discount = $request->get('rate');
            $amount = $price - ($price * ($discount - $member)) /100;

            //update tien vao payment
            if(!empty($user_id)) {
                $payment_id = $request->get('payment_id');
                $q = "UPDATE payments
                SET 
                payment_status =  $CHAP_NHAN,
                amount = $amount
                WHERE payment_id = $payment_id ";
                $result =  DB::select(DB::raw($q));

            // cong tien cho user 
            $get_user = User::find($user_id);
            $money_cu = $get_user['money_1'];
            $money_moi = $money_cu + $amount;
            
            $user = "UPDATE users
                SET 
                money_1 = $money_moi
                WHERE id = $user_id ";
                
                $result_user = DB::select(DB::raw($user));
            } else {
                return redirect()->back()->with('message', 'Tài khoản không tồn tại!');
            }
            
            //log
            $mess = "Nạp tiền vào tài khoản thẻ mệnh giá: ". $request->get('price'). "loại thẻ: " . $request->get('card_name');
            $log = Log::create([
                'log_user_id' =>$request->get('user_id'),
                'log_content' => $mess,
                'log_amount'=> $amount,
                'log_time'=>1,
                'log_type' => "NAP TIEN",
                'log_read' => 1
            ]);
            
        } 
        else if ($request->get('status') == $XOA) {
            $payment_id = $request->get('payment_id');
            $q = "UPDATE Payments
            SET is_deleted = $XOA
            WHERE payment_id = $payment_id ";
             $result =  DB::select(DB::raw($q));
        }
        else {
            $payment_id = $request->get('payment_id');
            $status = $request->get('status');
            $q = "UPDATE Payments
                    SET payment_status =$status
                    WHERE payment_id =  $payment_id";

            $result =  DB::select(DB::raw($q));
        }
        return redirect()->back()->with('message', 'Xử lý thành công!');
                
        // LOG

        // XOA THI XOA
    }
   

    //function listWithDraw
    public function listWithDraw()
    {
        $result =  DB::table('withdraws')
        ->leftJoin('users', 'withdraws.user_id', '=', 'users.id')
        ->paginate(10);

        return view('admin.danh-sach-rut-tien',compact('result'));
    }
    //xu ly rut tien
    public function withDraw(Request $request)
    {
        $RUT_TIEN = Config::get('constants.RUT_TIEN');
        $CHAP_NHAN = Config::get('constants.CHAP_NHAN');
       
        // change status
        $status = $request->get('status');
        $width_id = $request->get('widthraw_id');
        $user_id = $request->get('user_id');
        $user_name= User::find( $user_id);
        $amount = $request->get('amount');
     
        $q = "UPDATE withdraws
                SET withdraw_status = $status
                WHERE widthraw_id = $width_id";
        $result =  DB::select(DB::raw($q));

       if($status == $CHAP_NHAN) {
        // log\
        $mess = "Tài khoản.$user_name->name.rút tiền.$amount.";
        $log = Log::create([
            'log_user_id'=>$user_id,
            'log_content'=>$mess,
            'log_amount'=>$amount,
            'log_type' => "RUT-TIEN",
            'log_read' => $RUT_TIEN,
            'log_time' =>0
        ]);
       }
       
        return redirect()->back()->with('message', 'Xử lý thành công!');

    }
}
