<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qr_Code extends Model
{

	protected $table = 'qr_codes';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'Unique_code',
		'Code_type',
		'Class_Name',
		'is_Active'
	);
	protected $visible = array('Unique_code', 'Code_type', 'Class_Name', 'Active_code');
}
