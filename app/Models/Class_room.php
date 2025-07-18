<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Class_session;
use App\Models\Education_content;

class Class_room extends Model
{

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
	protected $guarded = [];
	protected $visible = array('name', 'capacity', 'current_count', 'floor');

	public function sessions()
	{
		return $this->hasMany(Class_session::class);
	}
	public function education_level()
	{
		return $this->belongsTo(Class_session::class, "education_level_id");
	}
	public function education_contents()
	{
		return $this->hasMany(Education_content::class);
	}
}
