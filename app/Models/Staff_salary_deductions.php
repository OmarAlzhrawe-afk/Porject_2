<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff_salary_deductions extends Model
{
	use HasFactory;
	protected $table = 'staff_salary_deductions';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		// 'user_type',
		'user_id',
		'amount',
		'type',
		'reason'
	);
	protected static function newFactory()
	{
		return \Database\Factories\DeductionFactory::new();
	}
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
