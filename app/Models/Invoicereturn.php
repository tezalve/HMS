<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicereturn extends Model
{
    use HasFactory;
    protected $primaryKey	='id';
	protected $table 		= 'invoice_return';
	public $timestamps 		= false;
}
