<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Activity;
use App\Models\Student;

class Activity_participants extends Model
{

	protected $table = 'activity_participants';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'activity_id',
		'Student_id',
		'payment_status',
		'attendance',
		'payment_method',
		'notes'
	);
	protected $visible = array(
		'id',
		'activity_id',
		'Student_id',
		'payment_status',
		'attendance',
		'payment_method',
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
