<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Education_level;

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
	protected $casts = [
		'interests' => 'array',
		'activities_participated' => 'array',
		'achievements' => 'array',
		'skills' => 'array',
	];
	public function student()
	{
		return $this->belongsTo(Student::class);
	}
	public function educationLevel()
	{
		return $this->belongsTo(Education_level::class);
	}
}
