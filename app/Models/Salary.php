<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Salary extends Model
{

	protected $table = 'salaries';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'user_id',
		'Base_salary',
		'bonus',
		'deductions',
		'net_salary',
		'pay_date',
		'status',
		'notes'
	);
	protected $visible = array('user_id', 'Base_salary', 'bonus', 'deductions', 'net_salary', 'pay_date', 'status', 'notes');

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
