<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyValue extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'daily_value';

    protected $fillable = [
        'product_id',
        'title',
        'title_ar',
        'description',
        'description_ar',
        'value',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('title_ar', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('description_ar', 'like', '%' . $search . '%')
            ->orWhere('value', 'like', '%' . $search . '%');
    }
}
