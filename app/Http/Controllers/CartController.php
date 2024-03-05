<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function increment(Request $request)
    {
        $amount = $request->session()->get('amount', 1);
        $amount++;
        $request->session()->put('amount', $amount);

        return response()->json(['amount' => $amount]);
    }
}
