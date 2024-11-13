<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'description_ar',
        'image',
        'order',
        'show_in_home_page',
        'views'
    ];

    protected $casts = [
        'show_in_home_page' => 'boolean'
    ];

    public function productCategories(): HasMany
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, ProductCategory::class, 'category_id', 'id', 'id', 'product_id');
    }

    public function scopeSearch($query, $search){
        if(!$search) return;
        $query->where('name', 'LIKE', "%$search%");
    }

    public function scopeAPISearch($query, $request){
        if($request->search){
            $query->where('name', 'LIKE', "%$request->search%");
        }
    }

}
