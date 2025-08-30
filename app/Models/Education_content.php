<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Teacher;
use App\Models\class;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education_content extends Model
{
	use HasFactory;
	protected $table = 'education_contents';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'teacher_id',
		'class_id',
		'title',
		'description',
		'content_type',
		'file_url',
		'created_at'
	);

	protected static function newFactory()
	{
		return \Database\Factories\EducationContentFactory::new();
	}
	public function teacher()
	{
		return $this->belongsTo(Teacher::class, 'teacher_id');
	}

	public function class()
	{
		return $this->belongsTo(Class_room::class, 'class_id');
	}
}
