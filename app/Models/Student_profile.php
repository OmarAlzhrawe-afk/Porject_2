<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Education_level;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student_profile extends Model
{
	use HasFactory;
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
		'health_notes' => 'array',
		'activities_participated' => 'array',
		'achievements' => 'array',
		'skills' => 'array',
		'teacher_feedback' => 'array',
		'guardian_feedback' => 'array',
	];
	protected static function newFactory()
	{
		return \Database\Factories\StudentProfileFactory::new();
	}
	public function student()
	{
		return $this->belongsTo(Student::class);
	}
	public function educationLevel()
	{
		return $this->belongsTo(Education_level::class);
	}
}
