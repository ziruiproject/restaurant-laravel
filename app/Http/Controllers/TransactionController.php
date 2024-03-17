<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $foods = session()->get('cart');

        $gross_amount = 0;
        $orderId = rand();

        foreach ($foods as $id => $food) {
            $transaction = Transaction::create([
                'meja_id' => 1,
                'food_id' => $id,
                'amount' => $food['amount'],
                'price' => $food['price'],
                'status' => 'pending',
                'order_id' => $orderId
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
                'order_id' => $orderId,
                'gross_amount' => $gross_amount,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        Transaction::where('order_id', $orderId)->update(['snap_token' => $snapToken]);

        return redirect()->route('checkout', ['id' => $orderId]);
    }

    public function checkout($id)
    {
        return view('checkout')->with(
            [
                'transaction' => DB::table('transactions')
                    ->where('order_id', '=', $id)
                    ->limit(1)
                    ->get()
                    ->first()
            ]
        );
    }

    public function success($id)
    {
        Transaction::where('order_id', $id)->update(['status' => 'success']);

        return view('transaction.success');
    }

    public function failed($id)
    {
        Transaction::where('order_id', $id)->update(['status' => 'failed']);

        return view('transaction.failed');
    }
}
