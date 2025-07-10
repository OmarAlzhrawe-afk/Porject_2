<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_profile extends Model
{

	protected $table = 'student_profiles';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'student_id',
		'education_level_id',
		'total_absences',
		'unexcused_absences',
		'score',
		'behavior_notes',
		'health_notes',
		'interests',
		'activities_participated',
		'achievements',
		'guardian_feedback',
		'teacher_feedback',
		'skills'
	);
	protected $visible = array(
		'id',
		'student_id',
		'education_level_id',
		'total_absences',
		'unexcused_absences',
		'score',
		'behavior_notes',
		'health_notes',
		'interests',
		'activities_participated',
		'achievements',
		'guardian_feedback',
		'teacher_feedback',
		'skills'
	);

	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id');
	}

	public function education_level()
	{
		return $this->belongsTo(Education_level::class, 'education_level_id');
	}
}
