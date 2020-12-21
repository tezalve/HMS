<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unitinfo extends Model
{
    use HasFactory;
    protected $primaryKey='id';
	protected $table = 'unit_info';
	public $timestamps = false;
}
