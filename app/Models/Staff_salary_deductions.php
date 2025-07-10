<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Staff_salary_deductions extends Model
{

	protected $table = 'staff_salary_deductions';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'user_type',
		'amount',
		'reason'
	);
	protected $visible = array(
		'id',
		'role',
		'amount',
		'reason'
	);

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
