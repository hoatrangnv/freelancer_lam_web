$price  = $request->get('card_price');
                $P_status = $CHO_DUYET;
                $user = User::find($request->get('user_id'));
            //get discount
                 $q = Card_card::where('card_code',$request->get('card_type'))->get();
                 $card_discount = null;
                 $card_id = null;
                 $username = $user->name;
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
                     'link_id' => null,
                     'ip_request' => $request->get('getip'),
                     'price' => $price,
                     'amount' => 0,
                     'rate' => $card_discount,
                     'transaction_id' => str_random(10),
                     'balance' => 0,
                     'requestId' => null,
                     'topup_type' => 0,
                     'is_image' =>  $NOT_IMAGES,
                     'image_url' => null,
                     'notes' => $request->get('notes'),
                     'payment_status' =>  $P_status,
                     'is_deleted' => $CHUA_XOA,
                     'getlink' => $request->get('getlink'),
                     'getlanguage' => $request->get('getlanguage'),
                     'getagent' => $request->get('getagent')
                 ]);
                 return redirect()->back()->with('status', 'Nạp thẻ thành công');
