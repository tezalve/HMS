<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicelist extends Model
{
    use HasFactory;
    protected $primaryKey='id';
	protected $table = 'details';
	public $timestamps = false;
}
