<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;
    
    protected $fillable = [
        'name',
        'name_ar',
        'default_price',
        'price_after_discount',
        'default_image',
        'images',
        'default_rate',
        'calories',
        'serving_size',
        'story',
        'story_ar',
        'description',
        'description_ar',
        'fact_detail',
        'fact_detail_ar',
        'visibility',
        'varieties',
        'order',
        'views'
    ];
    
    public function categories()
    {
        return $this->belongsToMany(Category::class , 'product_categories');
    }
    public function productCategories(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'product_id');
    }

    // relation with WishList 
    public function wishList()
    {
        return $this->hasMany(WishList::class);
    }

    public function relatedProducts()
    {
        return self::with([])->WhereHas('productCategories', fn($q) => $q->whereIn('category_id',
           $this->categories->pluck('id')->toArray()
        ));
    }

    // relation with product rate
    public function rates(): HasMany
    {
        return $this->hasMany(ProductRate::class);
    }

    // relation with daily value
    public function dailyValue()
    {
        return $this->hasMany(DailyValue::class);
    }
    public function scopeAPI($query): void
    {
        $query->where('visibility', true);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('default_price', 'like', '%' . $search . '%');
    }

    public function scopeAPISearch($query, $request){

        if(is_array($request['categories'] ?? null))
            $query->whereHas('productCategories', fn($q) => $q->whereIn('category_id', $request['categories']));

        if($request['price'] ?? null) $query->where('default_price', '<=', $request['price']);

        if($request['search'] ?? null)
            $query->where('name', 'LIKE', "%{$request['search']}%")
                ->orWhere('name_ar', 'LIKE', "%{$request['search']}%");

    }
}