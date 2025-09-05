<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Teacher;
use App\Models\Class_room;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Class_session extends Model
{
	use HasFactory;
	protected $table = 'class_sessions';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'teacher_id',
		'class_room_id',
		'subject_id',
		'session_day',
		'start_time',
		'end_time'
	);
	protected static function newFactory()
	{
		return \Database\Factories\ClassSessionFactory::new();
	}
	public function class()
	{
		return $this->belongsTo(Class_room::class, 'class_room_id');
	}
	public function teacher()
	{
		return $this->belongsTo(Teacher::class, 'teacher_id');
	}
}
