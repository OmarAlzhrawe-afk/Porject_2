<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Activity;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity_participants extends Model
{
	use HasFactory;

	protected $table = 'activity_participants';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'activity_id',
		'user_id',
		'payment_status',
		'attendance',
		'payment_method',
		'payment_reference',
		'notes'
	);

	public function activity()
	{
		return $this->belongsTo(Activity::class, 'activity_id');
	}
	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id');
	}
}
