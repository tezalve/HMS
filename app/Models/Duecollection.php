<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duecollection extends Model
{
    use HasFactory;
    protected $primaryKey='id';
	protected $table = 'duecollection';
	public $timestamps = false;
    protected $guarded = [];
}
