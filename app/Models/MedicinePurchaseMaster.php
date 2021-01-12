<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicinePurchaseMaster extends Model
{
    use HasFactory;
    protected $table = "medicine_purchse_master";
    public $timestamps = false;
    protected $guarded = [];
}
