<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Event;
use App\Models\Product;
use App\Models\Type;
use App\Services\FileUploadService;
use App\Services\OrderingService;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddProduct extends Component
{

    use WithFileUploads;
    
    public string $name, $name_ar, $description, $description_ar , $default_price,
        $story, $story_ar,
        $calories , $serving_size , $fact_detail , $fact_detail_ar;
    public $price_after_discount = null;
    public $default_rate;
    public ?string $default_image_url = null;
    public $visibility;
    public array $savedCalories = [], $formModel = [], $caloriesForm = [
        'title' => [
            'name' => 'title',
            'type' => 'text',
        ],
        'title_ar' => [
            'name' => 'عنوان',
            'type' => 'text',
        ],
        'description' => [
            'name' => 'description',
            'type' => 'textarea',
        ],
        'description_ar' => [
            'name' => 'وصف',
            'type' => 'textarea',
        ],
        'value' => [
            'name' => 'value',
            'type' => 'text',
        ],
    ];

    public array $images;

    public $default_image;
    public ?array $categories = [];
    public Collection $allCategories;


    public function render()
    {
        $this->formModel = [];
        foreach ($this->caloriesForm as $key => $calories) $this->formModel[$key] = '';
        $this->allCategories = Category::all();
        return view('components.addProduct');
    }

    public function addCalories()
    {
        $this->savedCalories[] = $this->formModel;
    }

    public function deleteCalories($index)
    {
        unset($this->savedCalories[$index]);
    }

    public function add()
    {
        
        if($this->visibility == null) $this->visibility = false;
        $this->validate([
            'name' => ['required'],
            'name_ar' => ['required'],
            'calories' => ['required'], 
            'serving_size' => ['required'],
            'default_price' => ['required', 'numeric', 'min:1'],
            'price_after_discount' => ['sometimes', 'nullable', 'numeric', 'min:1'],
            'story' => ['required'],
            'story_ar' => ['required'],
            'description' => ['required'],
            'description_ar' => ['required'],
            'fact_detail' => ['required'],
            'fact_detail_ar' => ['required'],
            'default_rate' => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:5'],
            'default_image' => ['required', 'file', 'mimes:jpeg,png,jpg,svg,webp'],
            'images' => ['sometimes', 'nullable', 'array'],
            'images.*' => ['required', 'file', 'mimes:jpeg,png,jpg,svg,webp'],
            'visibility' => ['sometimes', 'boolean'],
        ]);
        $OrderingService = new OrderingService(Product::class , 'order' , 'id');
        $image = FileUploadService::upload($this->default_image, 'products' , 'image');
        // $imageName = uniqid() . '.' . $this->default_image->getClientOriginalExtension();
        // $image = $this->default_image->storeAs('products/'.$imageName);
        $images = [];
        if(count($this->images)){
            foreach ($this->images as $img){
                // $imageName = uniqid() . '.' . $img->getClientOriginalExtension();
                // $images[] = $img->storeAs('products/'.$imageName);
                $images[] = FileUploadService::upload($img, 'products' , 'image'); 
            }
        }
        if($this->price_after_discount == null){
            $this->price_after_discount = $this->default_price;
        }
        $product = Product::create([
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'calories' => $this->calories,
            'serving_size' => $this->serving_size,
            'fact_detail' => $this->fact_detail,
            'fact_detail_ar' => $this->fact_detail_ar,
            'default_image' => $image,
            'default_price' => $this->default_price,
            'price_after_discount' => $this->price_after_discount ,
            'story' => $this->story,
            'story_ar' => $this->story_ar,
            'description' => $this->description,
            'description_ar' => $this->description_ar,
            'default_rate' => $this->default_rate ? $this->default_rate : 5,
            'images' => !empty($images) ? json_encode($images) : null,
            'visibility' => $this->visibility ? true : false,
            'order' => $OrderingService->newOrder(false)
        ]);
        $product->productCategories()->createMany(
            array_map(fn($i) => ['category_id' => $i], $this->categories)
        );
        foreach ($this->savedCalories as $calories){
            $product->dailyValue()->create($calories);
        }
        $this->resetForm();
        ResponseService::flash("added successfully", "message");
    }

    // reset form       
    public function resetForm()
    {
        $this->name = '';
        $this->name_ar = '';
        $this->description = '';
        $this->description_ar = '';
        $this->default_price = '';
        $this->price_after_discount = '';
        $this->default_rate = '';
        $this->default_image = '';
        $this->calories = '';
        $this->story = '';
        $this->story_ar = '';
        $this->serving_size = '';
        $this->fact_detail = '';
        $this->fact_detail_ar = '';
        $this->images = [];
        $this->categories = [];
        $this->savedCalories = [];
        $this->visibility = true;
    }

}
