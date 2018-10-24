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
use App\Deposit;
use App\BuyCard;
use App\TermUser;

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
        $DANG_XU_LY = Config::get('constants.DANG_XU_LY');
        $XOA = Config::get('constants.XOA');
        $phone = $request->get('phone');
        $link_id = $request->get('link_id');
        $price = $request->get('price');
        //NEU CHAP NHAN THI CONG TIEN
        if($request->get('status') == $CHAP_NHAN) {
            //chiet khau
            $user_id = $request->get('user_id');
            $member = $request->get('member');
            $chiet_khau_frame = $request->get('chiet_khau_frame');
           
            $discount = $request->get('rate');
            $chiet_khau = 0;
            if($request->link_id > 0)  
            {
                $amount = $price - ($price * ($discount +  $chiet_khau_frame)) /100;
            } else {
                $amount = $price - ($price * ($discount - $member)) /100;
            }
            

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
            $mess = "Số tiền củ ".$money_cu."Nạp thẻ: ". $request->get('price'). "loại thẻ: " . $request->get('card_name'). "Cộng số tiền mới " .$money_moi."  ".date('Y-m-d H:i:s');
            $log = Log::create([
                'log_user_id' =>$request->get('user_id'),
                'log_content' => $mess,
                'log_amount'=> $amount,
                'log_time'=>1,
                'log_type' => "NAP TIEN",
                'log_read' => 1
            ]);
            //neu ton tai link_id moi la nap qua frame
            if($request->link_id > 0)   
            {
                 //xu ly cong tien money term_user
                 $get_money_term = TermUser::where('link_id',$link_id)
                                            ->where('phone', $phone)
                                            ->first();
                 $price_term_old = $get_money_term->price_term;
                 $price_term = $price_term_old - $price;
 
                 $money = $get_money_term->money + $price;
                 $term = TermUser::where('phone',$phone)
                         ->update(['money'=> $money]);      
             // tru tien price_term
                 $term_p = TermUser::where('link_id',$link_id)
                                     ->where('phone', $phone)
                 ->update(['price_term' => $price_term]);      
            } 
                    
            
        } 
        else if ($request->get('status') == $XOA) {
            $payment_id = $request->get('payment_id');
            $q = "UPDATE payments
            SET is_deleted = $XOA
            WHERE payment_id = $payment_id ";
             $result =  DB::select(DB::raw($q));

             if($request->link_id > 0)   
             {
             
             // tru tien price_term neu huy
              // tru tien price_term
              $get_money_term = TermUser::where('link_id',$link_id)
                                 ->where('phone', $phone)
                                 ->first();
              $price_term_old = $get_money_term->price_term;
              $price_term = $price_term_old - $price;
 
              $term_p = TermUser::where('link_id',$link_id)
                                  ->where('phone', $phone)
              ->update(['price_term' => $price_term]); 
             }
        }
        else if ($request->get('status') ==  $DANG_XU_LY) {
            $payment_id = $request->get('payment_id');
            $q = "UPDATE payments
            SET is_deleted = $DANG_XU_LY
            WHERE payment_id = $payment_id ";
             $result =  DB::select(DB::raw($q));
        }
        else {
            $payment_id = $request->get('payment_id');
            $status = $request->get('status');
            $q = "UPDATE payments
                    SET payment_status =$status
                    WHERE payment_id =  $payment_id";

            $result =  DB::select(DB::raw($q));
            if($request->link_id > 0)   
            {
            // tru tien price_term neu huy
             // tru tien price_term
             $get_money_term = TermUser::where('link_id',$link_id)
                                ->where('phone', $phone)
                                ->first();
             $price_term_old = $get_money_term->price_term;
             $price_term = $price_term_old - $price;

             $term_p = TermUser::where('link_id',$link_id)
                                 ->where('phone', $phone)
             ->update(['price_term' => $price_term]); 
            }
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
        $get_money_1 = $user_name->money_1;
        $get_tam_giu = $user_name->tam_giu;
     

        $amount = $request->get('amount');

       if($status == $CHAP_NHAN) {
            $q = "UPDATE withdraws
            SET withdraw_status = $status
            WHERE widthraw_id = $width_id";
            $result =  DB::select(DB::raw($q));
            // tru tien tam giu
            $mess_tam_giu = "Trừ tiền tạm giữ, rút tiền thành công";
            $user = User::find($user_id);
            $user->tam_giu = 0;
            $user->save();
            // tru tien tam giu
            //log tru tien
            $log = Log::create([
                'log_user_id'=>$user_id,
                'log_content'=>$mess_tam_giu,
                'log_amount'=>0,
                'log_type' => "RUT-TIEN",
                'log_read' => $RUT_TIEN,
                'log_time' =>0
            ]);
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
            
            return redirect()->back()->with('message', 'Rút tiền thành công!');
       } else {
           //change status
            $q = "UPDATE withdraws
            SET withdraw_status = $status
            WHERE widthraw_id = $width_id";
            $result =  DB::select(DB::raw($q));
            //return lai tien
            $mess_huy = "Hủy rút tiền, trả lại tiền vào tk chính";
            $user = User::find($user_id);
            $user->tam_giu = 0;
            $user->money_1 =  $get_money_1 + $get_tam_giu;
            $user->save();

            //log
            $log = Log::create([
                'log_user_id'=>$user_id,
                'log_content'=>$mess_huy,
                'log_amount'=> $get_money_1 + $get_tam_giu,
                'log_type' => "RUT-TIEN",
                'log_read' => $RUT_TIEN,
                'log_time' =>0
            ]);
            return redirect()->back()->with('message', 'Hủy thành công!');

       }
    }

    //function nap tien
    public function listNapTien() {
        $result = Deposit::paginate(10);
        return view('admin.danh-sach-nap-tien',compact('result'));
    }

    //function xu ly nap tien
    public function confirmAddMoney(Request $request) 
    {
        $DA_NAP_TIEN = Config::get('constants.DA_NAP_TIEN');
        $HUY = Config::get('constants.HUY');
        $NAP_TIEN = Config::get('constants.NAP_TIEN');
        

        $user_id = $request->get('user_id');
        $get_money_1 = $request->get('money_1');
        $get_deposit_amount = $request->get('deposit_amount');

        $status = $request->get('status');
        if($status == 1) {
            $return = Deposit::find($request->get('id'));
            $return->deposit_status = $DA_NAP_TIEN ;
            $return->save();

            // cong tien
            $user = User::find($user_id);
            $user->money_1 = $get_money_1 + $get_deposit_amount;
            $user->save();
            //log
            $mess = "Cộng tiền nạp tiền: ". $get_deposit_amount;
            $log = Log::create([
                'log_user_id' => $user_id,
                'log_content' => $mess,
                'log_amount'=> $get_deposit_amount,
                'log_time'=> $NAP_TIEN,
                'log_type' => "NAP_TIEN",
                'log_read' => $NAP_TIEN
            ]);
            return redirect()->back()->with('message', 'Xác nhận thành công!');
        } else {
            $return = Deposit::find($request->get('id'));
            $return->deposit_status = $HUY ;
            $return->save();
            return redirect()->back()->with('message', 'Hủy thành công!');
        }
       
    }

    //mua the
    public function listMuathe()
    {
     
       $result = DB::table('buy_cards as b')
                ->leftjoin('users as u','b.user_id','=','u.id')
                ->select('b.id as buy_id','u.id as user_id','u.name','u.email','b.card_provider_name','b.card_amount','b.card_prices','b.card_discount','b.status','b.card_qty','b.card_pin','b.card_serial','b.card_notes')
                ->paginate(10);
       return view('admin.danh-sach-mua-the',compact('result'));
    }

    //xu ly mua the
    public function BuyCard(Request $request)
    {
        $CHAP_NHAN = Config::get('constants.CHAP_NHAN');
        $CHO_DUYET = Config::get('constants.CHO_DUYET');
        $HUY = Config::get('constants.HUY');
        $MUA_THE = Config::get('constants.MUA_THE');
        $get_price = $request->get('card_prices');

        $buy_id = $request->get('buy_id');
        $get_money = $request->get('money_1');
        $tam_giu = $request->get('tam_giu');
        $status = $request->get('status');

       if($status == $CHAP_NHAN) {
        //update 
        $result = BuyCard::find($buy_id);
        $result->card_pin = $request->get('so_the');
        $result->card_serial = $request->get('serial');
        $result->card_notes = $request->get('note');
        $result->status = $CHAP_NHAN;
        $result->save();
        //tru tien tam giu
        $mess = "Gửi mã thẻ thành công, trừ tiền tạm giữ: ". $get_price;
        $user_id = $request->get('user_id');
        $user = User::find($user_id);
        $user->tam_giu = $tam_giu - $get_price;
        $user->save();
        //log
        $log = Log::create([
            'log_user_id' => $user_id,
            'log_content' => $mess,
            'log_amount'=> $get_price,
            'log_time'=> $MUA_THE,
            'log_type' => "MUA THE",
            'log_read' => 3
        ]);
        return redirect()->back()->with('message', 'Xác nhận thành công!');

       } else{
         //update 
         $result = BuyCard::find($buy_id);
         $result->status = $HUY;
         $result->card_notes = $request->get('note');
         $result->save();
         //tru tien tam giu
         $mess = "Hủy thành công,return lại tiền tk chính, trừ tiền tạm giữ: ". $get_price;
         $user_id = $request->get('user_id');
         $user = User::find($user_id);
         $user->tam_giu = $tam_giu - $get_price;
         $user->money_1 = $get_money + $get_price;
         $user->save();
         //log
         $log = Log::create([
             'log_user_id' => $user_id,
             'log_content' => $mess,
             'log_amount'=> $get_price,
             'log_time'=> $HUY,
             'log_type' => "MUA THE",
             'log_read' => 3
         ]);
        return redirect()->back()->with('message', 'Hủy thành công!');
       }
    }
}
