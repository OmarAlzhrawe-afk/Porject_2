<?php

namespace App\Models;

use App\Models\Education_level;
use Illuminate\Database\Eloquent\Model;

use App\Models\Text_book;

class Subject extends Model
{

	protected $table = 'subjects';
	public $timestamps = false;
	protected $fillable = array('name');
	protected $visible = array('name');
	public function teachers()
	{
		return $this->hasMany(Teacher::class);
	}
	public function books()
	{
		return $this->hasMany(Text_book::class, 'subject_id');
	}
	public function educationalLevels()
	{
		return $this->belongsToMany(Education_level::class, 'educational_level_subjects');
	}
}
