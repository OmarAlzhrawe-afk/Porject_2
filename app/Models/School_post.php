<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School_post extends Model
{
	use HasFactory;
	protected $table = 'school_posts';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'title',
		'description',
		'post_type',
		'file_url',
		'is_public'
	);
	protected static function newFactory()
	{
		return \Database\Factories\PostFactory::new();
	}
	// protected $visible = array('title', 'description', 'post_type', 'file_url', 'is_public');
}
