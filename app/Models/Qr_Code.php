<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Class_room;

class Qr_Code extends Model
{

	protected $table = 'qr_codes';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'class_id',
		'user_id',
		'expires_at',
		'Unique_code',
		'Code_type',
		'is_Active'
	);
	protected $visible = array('class_id', 'user_id', 'expires_at', 'Unique_code', 'Code_type', 'is_Active');
	protected $dates = ['expires_at'];

	public function classRoom()
	{
		return $this->belongsTo(Class_room::class);
	}

	public function creator()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
