<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Public_content extends Model
{
	use HasFactory;
	protected $table = 'public_contents';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'content_type',
		'content'
	);
	protected static function newFactory()
	{
		return \Database\Factories\PublicContentFactory::new();
	}
}
