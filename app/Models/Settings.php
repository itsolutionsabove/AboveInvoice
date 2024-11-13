<?php

namespace App\Models;

use App\Traits\SearchIndexer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory, SearchIndexer;

    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    protected $casts = [
        'is_multiple' => 'boolean',
    ];

    public array $formFields = [];
}