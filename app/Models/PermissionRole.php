<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
	public $timestamps 		= false;
	protected $table 		= 'role_has_permissions';
	protected $primaryKey	= 'id';
}
