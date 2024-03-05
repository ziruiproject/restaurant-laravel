<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Image;
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
            'food' => Food::findOrfail($id),
            'amount' => 1
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

        $food = Food::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);

        $image = Image::create([
            'path' => $imageName
        ]);

        $food->images()->attach($image->id);

        return redirect()->route('food.index');
    }
}
