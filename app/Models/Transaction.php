<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment_method;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	/**
	 * 
	 
	 * 
	 */
	protected $table = 'transactions';

	public $timestamps = true;
	protected $fillable = [
		'user_id',
		'payment_method_id',
		'amount',
		'type',
		'transaction_source',
		'status',
		'installment_number',
		'payment_reference',
		'is_installment'

	];
	protected $visible = array('user_id', 'payment_method_id', 'amount', 'type', 'transaction_source', 'status', 'installment_number', 'payment_reference', 'is_installment');

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function payment_method()
	{
		return $this->belongsTo(Payment_method::class, 'payment_method_id');
	}
}
