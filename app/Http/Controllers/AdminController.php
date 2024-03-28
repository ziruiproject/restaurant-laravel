<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }

    public function menu()
    {
        return view('admin.menu')->with([
            'foods' => Food::all(),
            'categories' => Category::all()
        ]);
    }
}
