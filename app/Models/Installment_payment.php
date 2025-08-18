<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Installment_Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Installment_payment extends Model
{
	use HasFactory;
	protected $table = 'installment_payments';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'student_id',
		'installment_plan_id',
		'due_date',
		'amount',
		'paid',
		'payment_date'
	);
	protected static function newFactory()
	{
		return \Database\Factories\InstallmentPaymentFactory::new();
	}
	public function student()
	{
		return $this->belongsTo(Student::class, 'student_id');
	}

	public function plan()
	{
		return $this->belongsTo(Installment_Plan::class, 'plan_id');
	}
}
