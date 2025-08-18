<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book_loan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cultural_book extends Model
{
	use HasFactory;
	protected $table = 'cultural_books';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'title',
		'author',
		'publisher',
		'publication_year',
		'type',
		'format_url',
		'copies_available',
		'avg_student_rating',
		'avg_teacher_rating',
		'total_student_reviews',
		'total_teacher_reviews',
		'description'
	);
	protected static function newFactory()
	{
		return \Database\Factories\CulturalBookFactory::new();
	}
	public function loan_books()
	{
		return $this->hasMany(Book_loan::class);
	}
}
