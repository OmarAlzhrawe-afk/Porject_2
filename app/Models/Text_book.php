<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Text_book extends Model
{
	/**
	 * 
	 * 
	 * 
	 */
	protected $table = 'text_books';
	public $timestamps = true;
	protected $fillable = [
		'subject_id',
		'education_level_id',
		'title',
		'total_quantity',
		'sold_quantity',
		'price',
		'available_quantity'
	];
	protected $visible = array('subject_id', 'education_level_id', 'title', 'total_quantity', 'sold_quantity', 'price', 'available_quantity');

	public function EducationLevel()
	{
		return $this->belongsTo(Education_level::class, 'education_level_id');
	}
	public function subject()
	{
		return $this->belongsTo(Subject::class, 'subject_id');
	}
	public function sales()
	{
		return $this->hasMany('Student_textbook_sale', 'textbook_id');
	}
}
