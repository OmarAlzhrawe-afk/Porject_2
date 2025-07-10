<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Public_content extends Model
{

	protected $table = 'public_contents';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'content_type',
		'content'
	);
	protected $visible = array('content_type', 'content');
}
