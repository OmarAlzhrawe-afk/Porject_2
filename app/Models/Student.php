<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Class_session;
use App\Models\Student_profile;
use App\Models\Activity_participants;
use App\Models\Mark;
use App\Models\Student_textbook_sale;
use App\Models\Installment_payment;

class Student extends Model
{

	protected $table = 'students';
	public $timestamps = true;
	protected $fillable = array('user_id', 'class_id', 'Student_number', 'status');
	protected $visible = array('user_id', 'class_id', 'Student_number', 'status');




	protected static function boot()
	{
		parent::boot();

		static::creating(function ($student) {
			// احضر آخر رقم تم توليده
			$lastStudent = self::orderBy('id', 'desc')->first();

			// إذا لم يكن هناك أي طالب سابق
			$lastNumber = $lastStudent ? intval($lastStudent->student_number) : 1000;

			// زيادة الرقم بمقدار 1
			$student->student_number = (string)($lastNumber + 1);
		});
	}
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	public function class()
	{
		return $this->belongsTo(User::class, 'class_id');
	}
	public function sessions()
	{
		return $this->hasMany(Class_session::class, 'student_id');
	}

	public function profile()
	{
		return $this->hasOne(Student_profile::class);
	}

	public function Activities()
	{
		return $this->hasMany(Activity_participants::class);
	}

	public function marks()
	{
		return $this->hasMany(Mark::class);
	}

	public function book_sales()
	{
		return $this->hasMany(Student_textbook_sale::class);
	}

	public function intstallments()
	{
		return $this->hasMany(Installment_payment::class);
	}
}
