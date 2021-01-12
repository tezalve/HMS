<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineStockDetail extends Model
{
    use HasFactory;
    protected $table = "medicine_stock_details";
    public $timestamps = false;
    protected $guarded = [];
}
