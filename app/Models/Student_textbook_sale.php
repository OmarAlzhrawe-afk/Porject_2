<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Text_book;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student_textbook_sale extends Model
{
	use HasFactory;
	protected $table = 'student_textbook_sales';
	public $timestamps = true;
	protected $fillable = array('id', 'student_id', 'textbook_id', 'sale_date', 'quantity', 'total_price');
	protected static function newFactory()
	{
		return \Database\Factories\StudentTextbookSaleFactory::new();
	}
	public function book()
	{
		return $this->belongsTo(Text_book::class, 'textbook_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id');
	}
}
