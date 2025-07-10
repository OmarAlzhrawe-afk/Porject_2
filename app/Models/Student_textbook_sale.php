<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Text_book;
use App\Models\Student;

class Student_textbook_sale extends Model
{

	protected $table = 'student_textbook_sales';
	public $timestamps = true;
	protected $fillable = array('student_id', 'textbook_id', 'sale_date', 'quantity', 'total_price');
	protected $visible = array('student_id', 'textbook_id', 'sale_date', 'quantity', 'total_price');

	public function book()
	{
		return $this->belongsTo(Text_book::class);
	}

	public function student()
	{
		return $this->belongsTo(Student::class);
	}
}
