<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendortype extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $table = 'vendor_type';
	public $timestamps = false;
}
