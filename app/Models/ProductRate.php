<?php

namespace App\Models;

use App\Traits\SearchIndexer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductRate extends Model
{
    use HasFactory, SearchIndexer;

    protected $fillable = [
        'product_id',
        'user_id',
        'rate',
        'comment',
    ];

    public array $formFields = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
