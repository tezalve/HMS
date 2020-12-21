<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bedgroup extends Model
{
    use HasFactory;

    protected $table = 'bed_group';

    public $timestamps = false;

    protected $guarded = [];
}
