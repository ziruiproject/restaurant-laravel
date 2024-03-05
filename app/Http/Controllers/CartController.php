<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $food = Food::find($request->id);
        $food->users()->attach(1, ['amount' => $request->amount]);

        return redirect()->route('food.index');
    }
}
