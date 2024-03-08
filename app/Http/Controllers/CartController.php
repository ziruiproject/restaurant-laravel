<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $food = Food::find($request->id);
        $cart = session()->get('cart', []);
        $total = session()->get('total', 0);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['amount']++;
            $total += $request->price;
        } else {
            $cart[$request->id] = [
                'name' => $food->name,
                'amount' => $request->amount,
                'price' => $food->price,
                'image' => $food->images()->first()->path
            ];
            $total += ($request->price * $request->amount);
        }

        session()->put('cart', $cart);
        session()->put('total', $total);

        return redirect()->route('food.index');
    }

    public function show()
    {
        return view('cart.show');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->amount) {
            $cart = session()->get('cart');
            $total = session()->get('total');

            $cart[$request->id]['amount'] = $request->amount;
            $total = $request->total;

            session()->put('cart', $cart);
            session()->put('total', $total);

            session()->flash('success', 'Cart updated successfully');

            return response(200);
        }
        return response(404);
    }
}
