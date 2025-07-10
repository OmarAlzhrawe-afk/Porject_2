<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Student;
use App\Models\Class_room;
use App\Models\Education_level;
use App\Models\Activity_participants;

class Activity extends Model
{

	protected $table = 'activities';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'class_id',
		'education_level_id',
		'Title',
		'Description',
		'date',
		'location',
		'target_group',
		'is_paid',
		'cost',
		'seats_limit',
		'registration_deadline',
		'is_open',
		'gallery_urls',
		'required_skills',
		'auto_filter_participants'
	);
	protected $visible = array(
		'id',
		'class_id',
		'education_level_id',
		'Title',
		'Description',
		'date',
		'location',
		'target_group',
		'is_paid',
		'cost',
		'seats_limit',
		'registration_deadline',
		'is_open',
		'gallery_urls',
		'required_skills',
		'auto_filter_participants'
	);

	public function classes()
	{
		return $this->belongsTo(Class_room::class, 'class_id');
	}
	public function education_levels()
	{
		return $this->belongsTo(Education_level::class, 'education_level_id');
	}
	public function students()
	{
		return $this->hasMany(Student::class);
	}
	public function participants()
	{
		return $this->hasMany(Activity_participants::class, 'activity_id');
	}
}
