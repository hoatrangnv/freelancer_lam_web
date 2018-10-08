<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Card;
use App\User;
use App\Payment;
use App\Log;
use Config;

class ChuyenTienController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chuyenTien(Request $request)
    {
        $user_id = $request->get('user_id');
        $get_ma_xac_nhan = $request->get('password2');
        $type = $request->get('chuyen_tien');
        $money_chuyen = $request->get('money_chuyentien');
        $user = User::find($user_id);
        $get_password2 = $user['password2'];

        //SET MONEY
        $get_money = $user['money_1'];
        $get_money2 = $user['money_2'];

        //cong tien
        $money_old = $get_money -  $money_chuyen;
  
        $mess = "Chuyển tiền sang tài khoản 2:  " .$money_chuyen ."đ";

        //chuyen tk1 sang 2
        if($get_ma_xac_nhan == $get_password2 && $get_money >  $money_chuyen )    {
            if($type == "cung_tai_khoan") {
               
                $user->money_1 = $money_old;
                $user->money_2 = $money_chuyen + $get_money2;
                $user->save();
                //log
                $log = Log::create([
                    'log_user_id' =>  $user_id,
                    'log_content' => $mess,
                    'log_amount' => $money_chuyen,
                    'log_time' => 0,
                    'log_type' => "CHUYỂN_TIỀN_CÙNG_TÀI_KHOẢN",
                    'log_read' => 0
                ]);
                return redirect()->back()->with('message', 'Chuyển tiền thành công');
                
            } else if ($type = "khac_tai_khoan") {

               //cong tien cho user nhan
                    $get_phone_number = $request->get('user_nhan_tien');

                    $result = User::where('phone_number',$get_phone_number)
                        ->first();
                   
                    $phone_number = $result->phone_number;
                    $user_nhan = User::find($result->id);
                    $money_old = $user_nhan->money_1;
                    $user_nhan->money_1 = $money_old + $money_chuyen;
                    $user_nhan->save();
                    
               // tru tien user
                    $user->money_1 =  $get_money - $money_chuyen;
                    $user->save();
               //log
               $mess = "Chuyển tiền từ tài khoản:  " . $user->name ."sang tài khoản  " .$user_nhan->name."số tiền: ". $money_chuyen;

                $log = Log::create([
                    'log_user_id' =>  $user_id,
                    'log_content' => $mess,
                    'log_amount' =>  $money_chuyen,
                    'log_time' => 0,
                    'log_type' => "CHUYỂN_TIỀN_SANG_TÀI_KHOẢN_KHÁC",
                    'log_read' => 0
                ]);
                return redirect()->back()->with('message', 'Chuyển tiền thành công');
            }
        }
        return redirect()->back()->with('error', 'Mật khẩu cấp 2 không đúng hoặc số tiền trong tài khoản không đủ,vui lòng thử lại.');            

    }

   
}
