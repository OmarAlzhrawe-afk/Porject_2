<?php

namespace App\Models;

use App\Models\User;
use App\Models\Education_content;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
	/**
	 */
	protected $table = 'teachers';
	public $timestamps = true;
	protected $fillable = [
		'user_id',
		'subject_id',
		'Academic_qualification',
		'Employment_status',
		'Payment_type',
		'Contract_type',
		'The_beginning_of_the_contract',
		'End_of_contract',
		'number_of_lesson_in_week',
		'wages_per_lesson'

	];
	// protected $visible = array('user_id', 'subject_id', 'Academic_qualification', 'Employment_status', 'Payment_type', 'Contract_type', 'The_beginning_of_the_contract', 'End_of_contract', 'number_of_lesson_in_week', 'wages_per_lesson');

	public function sessions()
	{
		return $this->hasMany(Class_session::class);
	}

	public function marks()
	{
		return $this->hasMany(Mark::class);
	}

	public function education_contents()
	{
		return $this->hasMany(Education_content::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
