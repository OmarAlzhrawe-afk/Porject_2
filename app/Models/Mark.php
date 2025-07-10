<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Teacher;

class Mark extends Model
{
	protected $table = 'marks';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'student_id',
		'teacher_id',
		'exam_type',
		'score',
		'max_score',
		'date',
		'teacher_note'
	);
	protected $visible = array(
		'id',
		'student_id',
		'teacher_id',
		'exam_type',
		'score',
		'max_score',
		'date',
		'teacher_note'
	);

	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id');
	}


	public function teacher()
	{
		return $this->belongsTo(Teacher::class, 'teacher_id');
	}
}
