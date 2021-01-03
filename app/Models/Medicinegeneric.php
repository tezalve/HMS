<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicinegeneric extends Model
{
    use HasFactory;

    protected $table = "medicine_generic_names";
    public $timestamps = false;
    protected $guarded = [];

}
