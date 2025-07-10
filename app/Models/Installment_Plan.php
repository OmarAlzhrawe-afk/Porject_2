<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Installment_payment;

class Installment_Plan extends Model
{

	protected $table = 'installment_plans';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'name',
		'total_amount',
		'number_of_installments',
		'count_of_days_per_each_installment',
		'description'
	);
	protected $visible = array('name', 'total_amount', 'number_of_installments', 'count_of_days_per_each_installment', 'description');

	public function intsalment_payments()
	{
		return $this->hasMany(Installment_payment::class);
	}
}
