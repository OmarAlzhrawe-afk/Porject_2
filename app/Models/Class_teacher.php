<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Teacher;
use App\Models\Class_room;

class Class_teacher extends Model
{

	protected $table = 'class_teachers';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'class_id',
		'teacher_id',
		'notes',
		'is_primary_teacher',
		'weekly_lessons_count'
	);
	protected $visible = array('class_id', 'teacher_id', 'notes', 'is_primary_teacher', 'weekly_lessons_count');

	public function class()
	{
		return $this->belongsTo(Class_room::class, 'class_id');
	}

	public function teacher()
	{
		return $this->belongsTo(Teacher::class, 'teacher_id');
	}
}
