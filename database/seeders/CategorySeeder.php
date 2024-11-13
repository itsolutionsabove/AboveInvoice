<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(
            [
                'name' => 'Jordan',
                'order' => 1
            ]
        );

        Category::create(
            [
                'name' => 'Saudi Arabia',
                'order' => 2
            ]
        );
    }
}
