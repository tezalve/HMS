<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicineunit extends Model
{
    use HasFactory;

    protected $table = "medicine_units";
    public $timestamps = false;
    protected $guarded = [];
}
