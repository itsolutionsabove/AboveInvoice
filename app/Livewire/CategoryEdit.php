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

//        $this->image_url = url($this->category->image ? "uploads/categories/".$this->category->image : "dist/img/no-thumb.jpg");
        return view('components.addCategory');
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required', 'unique:categories,name,' . $this->category->id . ',id'],
        ]);
        $update = [
            'name' => $this->name,
        ];
        $this->category->update($update);
        ResponseService::flash("updated successfully", "message");
    }

}
