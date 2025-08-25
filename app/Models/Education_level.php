<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pre_registration;
use App\Models\Student_profile;
use App\Models\Text_book;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education_level extends Model
{
	use HasFactory;
	protected $table = 'education_levels';
	public $timestamps = true;
	protected $fillable = array('id', 'is_fully', 'price', 'academic_year_id', 'supervisor_id', 'name', 'description');
	protected static function newFactory()
	{
		return \Database\Factories\EducationLevelFactory::new();
	}
	public function students_profiles()
	{
		return $this->hasMany(Student_profile::class);
	}
	public function Installment_plans()
	{
		return $this->hasMany(Installment_Plan::class, 'education_level_id');
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
	public function classes()
	{
		return $this->hasMany(Class_room::class, 'education_level_id');
	}
}
