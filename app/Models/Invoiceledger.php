<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoiceledger extends Model
{
    use HasFactory;
    protected $primaryKey='id';
	protected $table = 'invoice_ledger';
	public $timestamps = false;
}
