<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Services\FileUploadService;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProductEdit extends Component
{

    use WithFileUploads;

    public ?string $name, $name_ar, $default_price,
                 $default_rate, $description, $description_ar,
                  $id, $price_after_discount, $story, $story_ar,
                 $calories, $serving_size, $fact_detail, $fact_detail_ar;
    public ?string $default_image_url = null;
    public $visibility;
    public array $images;
    public ?Product $product = null;

    public $default_image;
    public ?array $categories = [];
    public ?array $savedCalories = [], $formModel , $caloriesForm = [
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

    public Collection $allCategories;

    public function render()
    {
        $this->id = $this->id ?? request()?->id;
        if(!$this->product) $this->load();
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

    public function load(): void
    {
        $this->product = Product::findOrFail($this->id);
        $this->name = $this->product->name;
        $this->name_ar = $this->product->name_ar;
        $this->default_price = $this->product->default_price;
        $this->price_after_discount = $this->product->price_after_discount;
        $this->description = $this->product->description;
        $this->description_ar = $this->product->description_ar;
        $this->default_rate = $this->product->default_rate;
        $this->calories = $this->product->calories;
        $this->story = $this->product->story;
        $this->story_ar = $this->product->story_ar;
        $this->serving_size = $this->product->serving_size;
        $this->fact_detail = $this->product->fact_detail;
        $this->fact_detail_ar = $this->product->fact_detail_ar;
        $this->visibility = $this->product->visibility ? true : false;
        $this->savedCalories  = $this->product->dailyValue->toArray();
        $this->categories = $this->product->productCategories->pluck('category_id')->toArray();
        $this->images = [];
        $this->default_image = null;
        $this->default_image_url = url($this->product->default_image ? "uploads/products/".$this->product->default_image : "dist/img/no-thumb.jpg");
        $this->allCategories = Category::all();
    }

    public function edit(): void
    {

        $this->validate([
            'name' => ['required'],
            'name_ar' => ['required'],
            'default_price' => ['required', 'numeric', 'min:1'],
            'price_after_discount' => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'story' => ['required'],
            'story_ar' => ['required'],
            'description' => ['required'],
            'description_ar' => ['required'],
            'default_rate' => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:5'],
            'default_image' => ['sometimes', 'nullable', 'file', 'mimes:jpeg,png,jpg,svg,webp'],
            'images' => ['sometimes', 'nullable', 'array'],
            'images.*' => ['required', 'file', 'mimes:jpeg,png,jpg,svg,webp'],
            'calories' => ['required'],
            'serving_size' => ['required'],
            'fact_detail' => ['required'],
            'fact_detail_ar' => ['required'],
            'visibility' => ['required', 'boolean'],
        ]);
        $image = false;
        if($this->default_image){
            // $imageName = uniqid() . '.' . $this->default_image->getClientOriginalExtension();
            // $image = $this->default_image->storeAs('products/'.$imageName);
            $image = FileUploadService::upload($this->default_image, 'products' , 'image');
        }
        $update = [
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'default_price' => $this->default_price,
            'price_after_discount' => $this->price_after_discount ?: $this->default_price,
            'story' => $this->story,
            'story_ar' => $this->story_ar,
            'description' => $this->description,
            'description_ar' => $this->description_ar,
            'default_rate' => $this->default_rate,
            'calories' => $this->calories,
            'serving_size' => $this->serving_size,
            'fact_detail' => $this->fact_detail,
            'fact_detail_ar' => $this->fact_detail_ar,
            'visibility' => $this->visibility,
        ];
        if($image) $update['default_image'] = $image;
        $images = [];
        if(count($this->images)){
            foreach ($this->images as $img){
                // $imageName = uniqid() . '.' . $img->getClientOriginalExtension();
                // $images[] = $img->storeAs('products/'.$imageName);
                $images[] = FileUploadService::upload($img, 'products' , 'image');
            }
        }
        if(count($images)) $update['images'] = json_encode($images);
        $this->product->update($update);
        if(count($this->categories)){
            $this->product->productCategories()->whereNotIn('category_id', $this->categories)->delete();
            $categoryToCreate = array_diff($this->categories, $this->product->productCategories->pluck('category_id')->toArray());
            $this->product->productCategories()->createMany(
                array_map(fn($i) => ['category_id' => $i], $categoryToCreate)
            );
        }else{
            $this->product->productCategories()->delete();
        }

        if(count($this->savedCalories)){
            $this->product->dailyValue()->delete();
            $this->product->dailyValue()->createMany($this->savedCalories);
        }else{
            $this->product->dailyValue()->delete();
        }
        
        $this->product->refresh();
        $this->load();
        ResponseService::flash("updated successfully", "message");
    }

}
