<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labreport extends Model
{
    use HasFactory;
    protected $primaryKey='id';
	protected $table = 'labreport';
	public $timestamps = false;
}
