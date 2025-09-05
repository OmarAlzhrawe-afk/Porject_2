<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Class_session;
use App\Models\Education_content;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Class_room extends Model
{
	use HasFactory;
	protected $table = 'class_rooms';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'education_level_id',
		'name',
		'capacity',
		'current_count',
		'floor'
	);
	protected static function newFactory()
	{
		return \Database\Factories\ClassRoomFactory::new();
	}
	public function sessions()
	{
		return $this->hasMany(Class_session::class, 'class_room_id');
	}
	public function education_level()
	{
		return $this->belongsTo(Education_level::class, "education_level_id");
	}
	public function education_contents()
	{
		return $this->hasMany(Education_content::class);
	}
	public function activities()
	{
		return $this->hasMany(Activity::class, 'class_room_id');
	}
	public function home_work()
	{
		return $this->hasMany(Home_work::class, 'class_id');
	}
	public function students()
	{
		return $this->hasMany(Student::class, 'class_id', 'id');
	}
}
