<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mark extends Model
{
	use HasFactory;
	protected $table = 'marks';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'student_id',
		'teacher_id',
		'term_id',
		'exam_type',
		'score',
		'max_score',
		'date',
		'teacher_note'
	);
	protected static function newFactory()
	{
		return \Database\Factories\MarksFactory::new();
	}
	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id');
	}
	public function term()
	{
		return $this->belongsTo(Term::class, 'term_id');
	}
	public function teacher()
	{
		return $this->belongsTo(Teacher::class, 'teacher_id');
	}
}
