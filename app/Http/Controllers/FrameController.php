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
        $url =  url('/')."/embeb/".$id;
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
        $IMAGES = Config::get('constants.IS_IMAGE');
        $NOT_IMAGES = Config::get('constants.NOT_IMAGES');
        $CHO_DUYET = Config::get('constants.CHO_DUYET');
        $CHUA_XOA = Config::get('constants.CHUA_XOA');

        $link_id = $request->get('link_id');
        //get link id
        $link = Link::find($link_id);
        
        $price  = $request->get('card_price');
   
       
        if(!empty($link)) {
            if($link->price > $price ) {
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
                    'phone' => $user->phone_number,
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
                //tru tien price link
                $price_mess = $link_price - $price;
                $link->price = $price_mess;
                $link->save();
                $price_of_link = $link->price;    
                $mess = "Bạn vừa nạp vào tài khoản số tiền ".number_format($price)." số tiền còn phải nạp là: " .number_format($price_mess);
               
                // return $result;
                 return view('frame.confirm',compact(['username','result','price_of_link','card_name','mess']));

            }
            return redirect()->back()->with('error', 'Số tiền trong frame nhỏ hơn số tiền nạp vào.');

            
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
}
