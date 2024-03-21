<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Image;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        return view('food.index')->with([
            'foods' => Food::all(),
            'categories' => Category::all()
        ]);
    }

    public function show($id)
    {
        $food = Food::findOrfail($id);
        return view('food.show')->with([
            'food' => $food,
            'amount' => 1,
            'price' => 'Rp' . number_format($food->price, 0, '.', '.'),
            'categories' => $food->categories()->get()
        ]);
    }

    public function create()
    {
        return view('food.create');
    }

    public function store(Request $request)
    {
        dd($request->all()['image']->hashName());
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


    public function search(Request $request)
    {
        $foodQuery = Food::query();

        $searchParams = $request->query('name');

        if ($searchParams) {
            $foodQuery = Food::search($searchParams);
        }

        $foods = $foodQuery->get();

        return view('food.index')->with([
            'foods' => $foods,
            'categories' => Category::all()
        ]);
    }
}
