<?php

namespace Database\Seeders;

use App\Models\Branch;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create(
            [
                'name' => 'Jordan',
               
            ]
        );

        Branch::create(
            [
                'name' => 'Saudi Arabia',
                
            ]
        );
    }
}
