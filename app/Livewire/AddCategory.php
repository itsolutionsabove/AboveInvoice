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

    public string $name, $name_ar;
    public $show_in_home_page;
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
            'name_ar' => ['required', 'unique:categories,name_ar'],
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg,svg'],
            'show_in_home_page' => ['required', 'boolean'],
        ]);
        $image = FileUploadService::upload($this->image, 'categories' , 'image');
        $OrderingService = new OrderingService(Category::class , 'order' , 'id');
        
        Category::create([
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'image' => $image,
            'show_in_home_page' => $this->show_in_home_page,
            'order' => $OrderingService->newOrder(false)
        ]);
        $this->resetForm();
        ResponseService::flash("added successfully", "message");
    }

    public function resetForm()
    {
        $this->name = '';
        $this->name_ar = '';
        $this->image = '';
        $this->show_in_home_page = true;
    }

}