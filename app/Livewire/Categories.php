<?php

namespace App\Livewire;

use App\Models\Category;
use App\Services\OrderingService;

class Categories extends DataListingComponent
{
    public function __construct()
    {
        $this->title = "Categories";
        $this->orderBy = 'order';
        parent::__construct(Category::class, 'components.categories');
    }

    //function to move up the category
    public function down($id)
    {
        $OrderingService = new OrderingService(Category::class , 'order' , 'id');
        $OrderingService->moveUp($id);
    }
    public function up($id)
    {
        $OrderingService = new OrderingService(Category::class , 'order' , 'id');
        $OrderingService->moveDown($id);
    }

}
