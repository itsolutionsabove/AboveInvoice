<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUsMessage extends Model
{
    use HasFactory , SoftDeletes;
    
    protected $fillable = ['name', 'email', 'phone', 'message'];
    
    
    // scope search
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('message', 'like', '%' . $search . '%');
    }
}