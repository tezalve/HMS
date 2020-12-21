<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;
    protected $primaryKey='id';
	protected $table = 'investigation';
	public $timestamps = false;
	public function moduleName(){
        // return $this->hasMany('Modulename');
        return $this->belongsTo('Modulename','moduleName_id');
    }
}
