<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
	protected $fillable = [

        'client_name', 'client_address', 'client_tax_number','client_phone','invoice_number','invoice_date','total_amount','pdf_path'
        ,'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('client_name', 'like', '%' . $search . '%')
            ->orWhere('client_address', 'like', '%' . $search . '%')
            ->orWhere('client_tax_number', 'like', '%' . $search . '%')
            ->orWhere('client_phone', 'like', '%' . $search . '%')
            ->orWhere('invoice_number', 'like', '%' . $search . '%')
            ->orWhere('total_amount', 'like', '%' . $search . '%')
            ->orWhere('invoice_date', 'like', '%' . $search . '%')
            //branch name
            ->orWhereHas('branch', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
    }

}
