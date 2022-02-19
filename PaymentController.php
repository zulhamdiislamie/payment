<?php

namespace App\Http\Controllers;

use App\Models\Daftar;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-_JqYKTatvfCD-4zxGBCBtANT';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 150000,
            ),
            'item_details' => array(
                [
                    "id" => "a1",
                    "price" => 50000,
                    "quantity" => 1,
                    "name" => "Bahasa Asing"
                ],
                [
                    "id" => "a2",
                    "price" => 100000,
                    "quantity" => 1,
                    "name" => "Bahasa Indoensia"
            ]
            ),
            'customer_details' => array(
                'first_name' => $request->get('uname') ,
                'last_name' => '',
                'email' => $request->get('email'),
                'phone' => $request->get('number'),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment', ['snap_token'=>$snapToken]);
    }

    public function payment_post(Request $request){
      return $request;
    }
}
