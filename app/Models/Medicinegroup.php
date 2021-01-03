<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicinegroup extends Model
{
    use HasFactory;

    protected $table = "medicine_groups";
    public $timestamps = false;
    protected $guarded = [];
}
