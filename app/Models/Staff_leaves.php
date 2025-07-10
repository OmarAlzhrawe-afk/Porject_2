<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Staff_leaves extends Model
{

	protected $table = 'staff_leaves';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'user_id',
		'start_date',
		'End_date',
		'leave_type',
		'status',
		'notes'
	);
	protected $visible = array('user_id', 'start_date', 'End_date', 'leave_type', 'status', 'notes');

	public function employee()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
