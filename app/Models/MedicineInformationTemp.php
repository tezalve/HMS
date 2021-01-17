<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineInformationTemp extends Model
{
    use HasFactory;

    protected $table = "medicine_informations_temp";
    public $timestamps = false;
    protected $guarded = [];
}
