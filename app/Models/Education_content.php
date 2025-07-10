<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Teacher;
use App\Models\class;

class Education_content extends Model
{

	protected $table = 'education_contents';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'teacher_id',
		'class_id',
		'title',
		'description',
		'content_type',
		'file_url'
	);
	protected $visible = array(
		'id',
		'teacher_id',
		'class_id',
		'title',
		'description',
		'content_type',
		'file_url'
	);

	public function teacher()
	{
		return $this->belongsTo(Teacher::class, 'teacher_id');
	}

	public function class()
	{
		return $this->belongsTo(Class_room::class, 'class_id');
	}
}
