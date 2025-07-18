<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pre_registration;
use App\Models\Student_profile;
use App\Models\Text_book;

class Education_level extends Model
{

	protected $table = 'education_levels';
	public $timestamps = true;
	protected $fillable = array('id', 'supervisor_id', 'name', 'description');
	protected $visible = array('id', 'supervisor_id', 'name', 'description');

	public function students()
	{
		return $this->hasMany(Student_profile::class);
	}

	public function Regesterations()
	{
		return $this->hasMany(Pre_registration::class);
	}

	public function books()
	{
		return $this->hasMany(Text_book::class);
	}
	public function subjects()
	{
		return $this->belongsToMany(Subject::class, 'educational_level_subjects');
	}
}
