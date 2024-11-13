<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opinion extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'name_ar',
        'rate',
        'comment',
        'comment_ar',
        'show_in_home_page',
        'order'
    ];

    protected $casts = [
        'rate' => 'integer'
    ];

}
