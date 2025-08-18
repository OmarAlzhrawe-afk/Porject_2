<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Cultural_book;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book_loan extends Model
{
	use HasFactory;
	protected $table = 'book_loans';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'user_id',
		'cultural_book_id',
		'type',
		'status'
	);
	protected static function newFactory()
	{
		return \Database\Factories\BookLoanFactory::new();
	}
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function book_loan()
	{
		return $this->belongsTo(Cultural_book::class, 'cultural_book_id');
	}
}
