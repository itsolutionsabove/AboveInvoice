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

}
