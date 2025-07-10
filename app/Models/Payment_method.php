<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions;

class Payment_method extends Model
{

	protected $table = 'payment_methods';
	public $timestamps = true;
	protected $fillable = array('id', 'name', 'description');
	protected $visible = array('name', 'description');




	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}
}
