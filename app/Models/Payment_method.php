<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment_method extends Model
{
	use HasFactory;
	protected $table = 'payment_methods';
	public $timestamps = true;
	protected $fillable = array('id', 'name', 'description');
	protected $visible = array('name', 'description');
	protected static function newFactory()
	{
		return \Database\Factories\PaymentMethodFactory::new();
	}
	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}
}
