<?php

namespace App\Models;

use App\Models\Education_content;
use Illuminate\Database\Eloquent\Model;

class Pre_registration extends Model
{

	protected $table = 'pre_registrations';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'education_level_id',
		'student_name',
		'student_email',
		'parent_name',
		'parent_email',
		'phone_number',
		'status',
		'documents'
	);
	protected $visible = array(
		'id',
		'education_level_id',
		'student_name',
		'student_email',
		'parent_name',
		'parent_email',
		'phone_number',
		'status',
		'documents'
	);

	public function education_level()
	{
		return $this->belongsTo(Education_content::class, 'education_level_id');
	}
}
