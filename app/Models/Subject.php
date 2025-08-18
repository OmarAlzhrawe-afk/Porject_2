<?php

namespace App\Models;

use App\Models\Education_level;
use Illuminate\Database\Eloquent\Model;

use App\Models\Text_book;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
	use HasFactory;
	protected $table = 'subjects';
	public $timestamps = false;
	protected $fillable = array('name');
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
