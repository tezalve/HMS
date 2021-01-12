<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineStockMaster extends Model
{
    use HasFactory;
    protected $table = "medicine_stock_masters";
    public $timestamps = false;
    protected $guarded = [];
}
