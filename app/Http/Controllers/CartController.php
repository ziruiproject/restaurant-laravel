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

        if (isset($cart[$request->id])) {
            $cart[$request->id]['amount']++;
        } else {
            $cart[$request->id] = [
                'name' => $food->name,
                'amount' => 1,
                'price' => $food->price,
                'image' => $food->images()->first()->path
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('food.index');
    }

    public function show()
    {
        return view('cart.show')->with([
            'foods' => User::find(1)->foods()->get()
        ]);
    }
}
