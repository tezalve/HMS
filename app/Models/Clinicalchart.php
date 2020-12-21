<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinicalchart extends Model
{
    use HasFactory;
    protected $primaryKey='id';
	protected $table = 'clinical_chart';
	public $timestamps = false;
}
