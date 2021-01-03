<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicineinformation extends Model
{
    use HasFactory;

    protected $table = "medicine_informations";
    public $timestamps = false;
    protected $guarded = [];
}
