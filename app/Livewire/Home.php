<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Services\Response\ResponseService;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {

        //most products viewed

//        $mostViewedProducts = Product::orderBy('views', 'desc')->take(5)->get();


        return view('components.home' ,  [
//            'mostViewedProducts' => $mostViewedProducts,
        ]);
    }

}
