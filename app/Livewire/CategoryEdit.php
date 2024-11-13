<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\OrderingService;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Spatie\Permission\Models\Role;

class CategoryEdit extends Component
{
    use WithFileUploads;

    public ?string $name, $name_ar, $id, $image_url;
    public $show_in_home_page;
    public $image;

    public ?Category $category;

    public function render()
    {
        $this->id = $this->id ?? request()?->id;
        $this->category = Category::findOrFail($this->id);
        $this->name = $this->category->name;
        $this->name_ar = $this->category->name_ar;
        $this->show_in_home_page = $this->category->show_in_home_page ? true : false;
        $this->image_url = url($this->category->image ? "uploads/categories/".$this->category->image : "dist/img/no-thumb.jpg");
        return view('components.addCategory');
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required', 'unique:categories,name,' . $this->category->id . ',id'],
            'name_ar' => ['required', 'unique:categories,name_ar,' . $this->category->id . ',id'],
            'image' => ['sometimes', 'nullable', 'file', 'mimes:jpeg,png,jpg,jpg,svg'],
            'show_in_home_page' => ['required', 'boolean'],
        ]);
        $image = false;
        if($this->image){
            $image = FileUploadService::upload($this->image, 'categories' , 'image');
        }
        $update = [
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'show_in_home_page' => $this->show_in_home_page
        ];
        if($image !== false) $update["image"] = $image;
        $this->category->update($update);
        ResponseService::flash("updated successfully", "message");
    }

}