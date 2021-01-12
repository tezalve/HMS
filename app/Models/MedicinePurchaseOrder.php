<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicinePurchaseOrder extends Model
{
    use HasFactory;
    protected $table = "medicine_purchase_orders";
    public $timestamps = true;
    protected $guarded = [];
}
