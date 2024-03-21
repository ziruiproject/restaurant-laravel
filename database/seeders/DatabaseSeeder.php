<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Food;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Category::create([
            'name' => 'Rice'
        ]);

        Category::create([
            'name' => 'Burger'
        ]);

        Category::create([
            'name' => 'Snack'
        ]);

        Category::create([
            'name' => 'Drinks'
        ]);

        $image1 = Image::create([
            'path' => "images/BRBRAwZlVd2qcyT2hQwFhSsSwNlLKRWgp1gSBO2M.jpg"
        ]);

        $image2 = Image::create([
            'path' => "images/vVFf8vJOPb2bYGKH1FKNJheElUxXD2kASEoZaiGg.jpg"
        ]);

        $food1 = Food::create([
            'name' => 'Nasi Goreng',
            'price' => 15000,
            'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem nesciunt placeat tenetur dolore doloremque ex, iste quos modi voluptatum impedit quidem unde illum labore fuga explicabo. Est temporibus reiciendis accusamus?"
        ]);

        $food2 = Food::create([
            'name' => 'Nasi Tumis',
            'price' => 13000,
            'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem nesciunt placeat tenetur dolore doloremque ex, iste quos modi voluptatum impedit quidem unde illum labore fuga explicabo. Est temporibus reiciendis accusamus?"
        ]);

        $food1->images()->attach($image1->id);
        $food2->images()->attach($image2->id);

        $food1->categories()->attach(1);
        $food2->categories()->attach(1);
    }
}
