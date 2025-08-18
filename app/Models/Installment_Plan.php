<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Installment_payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Installment_Plan extends Model
{
	use HasFactory;
	protected $table = 'installment_plans';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'name',
		'education_level_id',
		'total_amount',
		'number_of_installments',
		'count_of_days_per_each_installment',
		'description'
	);
	protected static function newFactory()
	{
		return \Database\Factories\InstallmentPlanFactory::new();
	}

	public function intsalment_payments()
	{
		return $this->hasMany(Installment_payment::class);
	}
}
