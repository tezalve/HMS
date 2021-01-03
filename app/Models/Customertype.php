<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customertype extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $table = 'customer_type';
	public $timestamps = false;
}
