<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctorsledger extends Model
{
    use HasFactory;
    protected $table 		= 'doctors_ledger';
	public $timestamps 		= false;
	protected $primaryKey	='id';
}
