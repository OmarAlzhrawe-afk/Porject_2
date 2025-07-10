<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Cultural_book;

class Book_loan extends Model
{

	protected $table = 'book_loans';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'user_id',
		'book_id',
		'name'
	);
	protected $visible = array(
		'id',
		'user_id',
		'book_id',
		'name'
	);

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function book_cloan()
	{
		return $this->belongsTo(Cultural_book::class, 'book_id');
	}
}
