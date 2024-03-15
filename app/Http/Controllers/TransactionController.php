<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Food;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $foods = session()->get('cart');

        $gross_amount = 0;

        foreach ($foods as $id => $food) {
            $transaction = Transaction::create([
                'meja_id' => 1,
                'food_id' => $id,
                'amount' => $food['amount'],
                'price' => $food['price'],
                'status' => 'pending',
            ]);

            $gross_amount += ($food['amount'] * $food['price']);
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $gross_amount,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;
        $transaction->save();

        return redirect()->route('checkout', ['id' => $transaction->id]);
    }

    public function checkout($id)
    {
        return view('checkout')->with([
            'transaction' => Transaction::find($id)
        ]);
    }
}
