<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'subscription';

    protected $fillable = [
        'title',
        'title_ar',
        'count',
        'image',
        'default_price',
        'price_after_discount',
        'description',
        'description_ar',
        'order'
    ];


    public function scopeSearch($query, $search){
        if(!$search){
            return;
        }else{
            $query->where('title', 'LIKE', "%$search%")
                ->orWhere('title_ar', 'LIKE', "%$search%")
                ->orWhere('count', 'LIKE', "%$search%")
                ->orWhere('default_price', 'LIKE', "%$search%")
                ->orWhere('price_after_discount', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->orWhere('description_ar', 'LIKE', "%$search%");
        }
    }
}
