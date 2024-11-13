<?php

namespace App\Livewire;

use App\Models\Product;

class Products extends DataListingComponent
{
    public function __construct()
    {
        $this->title = "Products";
        $this->orderBy = 'order';
        parent::__construct(Product::class, 'components.products');
    }
}
