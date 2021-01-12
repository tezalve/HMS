<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicinePurchaseDetail extends Model
{
    use HasFactory;
    protected $table = "medicine_purchase_details";
    public $timestamps = false;
    protected $guarded = [];
}
