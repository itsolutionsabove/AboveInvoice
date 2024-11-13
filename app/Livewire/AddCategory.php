<?php

namespace App\Livewire;

use App\Models\Category;
use App\Services\FileUploadService;
use App\Services\OrderingService;
use App\Services\Response\ResponseService;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddCategory extends Component
{

    use WithFileUploads;

    public string $name;

    public $image;

    public ?string $image_url = null;

    public function render()
    {
        return view('components.addCategory');
    }

    public function add()
    {
        $this->validate([
            'name' => ['required', 'unique:categories,name'],

        ]);
//        $image = FileUploadService::upload($this->image, 'categories' , 'image');
        $OrderingService = new OrderingService(Category::class , 'order' , 'id');

        Category::create([
            'name' => $this->name,
            'order' => $OrderingService->newOrder(false)
        ]);
        $this->resetForm();
        ResponseService::flash("added successfully", "message");
    }

    public function resetForm()
    {
        $this->name = '';

    }

}
