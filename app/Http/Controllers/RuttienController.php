<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Bank;
use App\BankAccount;
use App\WithDraw;
use Config;
use Auth;
class RuttienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rut-tien.index');
    }

    //rut tien
    public function withDraw(Request $request)
    {
        $CHO_DUYET = Config::get('constants.CHO_DUYET');
        
        $user = Auth::user()->id;
        $password2 = Auth::user()->password2;
        $user_price = Auth::user()->money_1;
        if($user_price > $request->get('money_rut') )
            if($password2  == $request->get('password2_rut') && $user_price > $request->get('money_rut')) {
                $bank_id = $request->get('back_user');

                $bank = BankAccount::find($bank_id);
                $bank_list = Bank::find($bank['bank_id']);
          

                $result = WithDraw::create([
                    'user_id' => $user,
                    'bank_id'=> $bank['bank_id'],
                    'bank_name' => $bank_list['bank_name'],
                    'bank_branch' => $bank['bank_branch'],
                    'bank_account_id' => $bank['id'],
                    'bank_account_name' => $bank['account_name'],
                    'bank_account_number' => $bank['account_number'],
                    'amount' => $request->get('money_rut'),
                    'withdraw_status'=> $CHO_DUYET
                ]);  
                return redirect()->back()->with('thanhcong', 'Gửi yêu cầu rút tiền thành công, vui lòng chờ xác nhận từ Admin!');

            } else {
                return redirect()->back()->with('error', 'Mật khẩu cấp 2 không đúng!');
            }
        else {
            return redirect()->back()->with('error', 'Số tiền trong tài khoản của bạn không đủ!');
        }    

    }

    public function bankList()
    {
        $bank = Bank::all();
        return response($bank);
    }
    
    // add tai khoan

    public function addAccount(Request $request)
    {
        $STATUS_ACTICE = Config::get('constants.STATUS_ACTICE');
        $province = Auth::user()->tinh;
        $result = BankAccount::create([
            'user_id' =>$request->get('user_id'),
            'bank_id' => $request->get('back_type'),
            'province_id'=> $province ,
            'bank_branch' => $request->get('chi_nhanh'),
            'account_name' => $request->get('account_name') ,
            'account_number' => $request->get('account_number'),
            'status' => $STATUS_ACTICE,
        ]);
        return redirect()->back()->with('message', 'Thêm tài khoản ngân hàng thành công!');

    }
    
    //onlye get bank
    public function getBank()
    {
       $user = Auth::user()->id;
        $result = DB::table('bank_account as back_c')
                    ->leftJoin('banks as b', 'back_c.bank_id', '=', 'b.id')  
                    ->select('back_c.id','b.bank_name')  
                    ->where('back_c.user_id','=',$user)
                    ->get();     
        return response($result);            
    }
}
