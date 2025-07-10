<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Installment_Plan;

class Installment_payment extends Model
{

	protected $table = 'installment_payments';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'student_id',
		'plan_id',
		'due_date',
		'amount',
		'paid',
		'payment_date'
	);
	protected $visible = array(
		'id',
		'student_id',
		'plan_id',
		'due_date',
		'amount',
		'paid',
		'payment_date'
	);

	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id');
	}

	public function plan()
	{
		return $this->belongsTo(Installment_Plan::class, 'plan_id');
	}
}
