<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Student;
use App\Models\Class_room;
use App\Models\Education_level;
use App\Models\Activity_participants;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
	use HasFactory;
	protected $table = 'activities';
	public $timestamps = true;
	protected $fillable = array(
		'Title',
		'class_room_id',
		'education_level_id',
		'term_id',
		'Description',
		'activity_type',
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
	protected $casts = [
		'gallery_urls' => 'array',
		'required_skills' => 'array',
	];

	public function class_room()
	{
		return $this->belongsTo(Class_room::class, 'class_room_id');
	}
	public function education_levels()
	{
		return $this->belongsTo(Education_level::class, 'education_level_id');
	}
	public function term()
	{
		return $this->belongsTo(Term::class, 'term_id');
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
