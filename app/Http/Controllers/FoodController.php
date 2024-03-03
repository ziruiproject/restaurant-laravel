<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        return view('food.index')->with([
            'foods' => Food::all()
        ]);
    }

    public function show($id)
    {
        return view('food.show')->with([
            'food' => Food::findOrfail($id)
        ]);
    }

    public function create()
    {
        return view('food.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|'
        ]);

        $imageName = $request->file('image')->store('images');

        Food::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imageName,
            'description' => $request->description
        ]);

        return redirect()->route('food.index');
    }
}
