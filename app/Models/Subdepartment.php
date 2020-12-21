<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdepartment extends Model
{
    use HasFactory;
    protected $primaryKey='id';
	protected $table = 'sub_department';
	public $timestamps = false;
}
