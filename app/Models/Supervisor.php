<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{

	protected $table = 'supervisors';
	public $timestamps = true;
	protected $fillable = array('id', 'user_id', 'status');
	protected $visible = array('id', 'user_id', 'status');

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
