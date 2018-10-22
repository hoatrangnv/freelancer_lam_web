<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Payment;
use App\Log;
use App\Link;
use Config;
use Auth;
use App\Card_card;
use App\Card;
use App\TermUser;
use App\LogPayment;

class FrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $user_id = Auth::user()->id;
        $result = Link::where('user_id',$user_id)->get();
        return view('frame.index',compact(['result'])); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFrame(Request $request)
    {
       $id =  random_int(1, 9999);
        $CHUA_XOA = Config::get('constants.CHUA_XOA');
        $url =  url('/')."/embed/".$id;
        $frame = "<iframe src=".$url." style='width:1200px;height:300px'></iframe>";
        $price = $request->get('price');
        $title = $request->get('title');
        $content = $request->get('content');
        $user_id = Auth::user()->id;
        $link = Link::create([
            'id' => $id,
            'title' =>$title,
            'content'=>$content,
            'price'=>$price,
            'user_id'=> $user_id,
            'active'=>$CHUA_XOA,
            'frame' => $frame
        ]);
        return redirect()->back()->with('message', 'Tích hợp vào website thành công!');

    }

    public function updateLink(Request $request)
    {
        $id = $request->get('id');
        $result = Link::find($id);
        $result->title = $request->get('title');
        $result->content = $request->get('content');
        $result->price = $request->get('price');
        $result->save();
        return redirect()->back()->with('message', 'Update website thành công!');
    }

    public function naptheFrame()
    {
        return view('frame.napthe');
    }

    public function naptheConfirm()
    {
        return view('frame.confirm');
    }

    public function createNap(Request $request)
    {
        // return $request->all();
        $IMAGES = Config::get('constants.IS_IMAGE');
        $NOT_IMAGES = Config::get('constants.NOT_IMAGES');
        $CHO_DUYET = Config::get('constants.CHO_DUYET');
        $CHUA_XOA = Config::get('constants.CHUA_XOA');
        $link_id = $request->get('link_id');
        //get link id
        $link = Link::find($link_id);
        
        $price  = $request->get('card_price');
   
       
        if(!empty($link)) {
           
                $user = User::find($link->user_id);
                //get discount
                $q = Card_card::where('card_code',$request->get('card_type'))->get();
                $card_discount = null;
                $card_id = null;
                $username = $user->name;
                $link_price = $link->price;
                $card_name = null;

                foreach($q as $value) {
                    $card_discount = $value['card_discount'];
                    $card_id = $value['cat_id'];
                    $card_name = $value['card_name'];
                }
                $result = Payment::create([
                    'phone' => $request->get('phone'),
                    'card_type_id' => $card_id,
                    'pin' => $request->get('card_pin'),
                    'serial' => $request->get('card_seria'),
                    'provider' => $request->get('card_type'),
                    'user_id' => $user->id ,
                    'link_id' => $link->id,
                    'ip_request' => $link->id,
                    'price' => $request->get('card_price'),
                    'amount' => 0,
                    'rate' => $card_discount,
                    'transaction_id' => str_random(10),
                    'balance' => 0,
                    'requestId' => null,
                    'topup_type' => 0,
                    'is_image' =>  $NOT_IMAGES,
                    'image_url' => null,
                    'notes' => null,
                    'payment_status' =>  $CHO_DUYET,
                    'is_deleted' => $CHUA_XOA,            
                ]);
                //thong bao tien trong link price
                  //luu tien vao term_user
                  //check phone 
                  $term_find = TermUser::where('phone', $request->get('phone'))->count();

                 if($term_find > 0) {
                     $check = TermUser::where('phone', $request->get('phone'))->first();
                     $price_term = $check->price_term;
                     $price_total_term = $price_term + $request->get('card_price');

                     $term_update = TermUser::where('phone',$request->get('phone'))
                     ->update(['price_term' => $price_total_term]);
                 } else {
                    $term = TermUser::create([
                        'phone' =>  $request->get('phone'),
                        'price_term' => $request->get('card_price'),
                        'price' => $link_price
                        ]);
                 }
                 
                $term_sosanh = TermUser::where('phone','=', $request->get('phone'))->firstOrFail();
                $price_t = $term_sosanh->price; //price trong term
                $price_term = $term_sosanh->price_term; 
                $price_pn = $price_t - $price_term;
               
                 if($price_term >= $price_t) {
                     $mess = "Bạn đã nạp thẻ thành công,vui lòng chờ hệ thống xử lý trong 5, 10 phút, nhập số điện thoại để hiện kết quả.";
 
                 } else {
                     $mess = "Bạn vừa nạp vào tài khoản số tiền ".number_format($price_term)." số tiền còn phải nạp là: " .number_format($price_pn);
                 }
                    
               
                // return $result;
                 return view('frame.confirm',compact(['username','result','price_of_link','card_name','mess','link_id']));
            
        }
        return redirect()->back()->with('error', 'Frame id không tồn tại, vui lòng kiểm tra lại.');

    }

    public function naptheCreate($id)
    {
        $result = Link::find($id);
        if($result) {
            $q = "select * from cat_cards where card_status= 1";
            $card = DB::select($q);
            return view('frame.napthe',compact(['card','result']));
        }
    }

    public function search(Request $request)
    {
        $phone = $request->phone_number;

        $link_id = $request->get('link_id');
        $result = DB::table('payments')
                      ->leftJoin('users', 'payments.user_id', '=', 'users.id')
                      ->leftJoin('cat_cards', 'payments.provider', '=', 'cat_cards.card_code')
                      ->where('payments.link_id', '=', $link_id)
                      ->where('payments.phone', '=', $phone)
                      ->orderByRaw('payments.payment_id - payments.created_at ASC')
                      ->paginate(10);
        return  response($result);              
    } 
}
