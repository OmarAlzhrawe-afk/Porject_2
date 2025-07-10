<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School_post extends Model
{

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
	protected $visible = array('title', 'description', 'post_type', 'file_url', 'is_public');
}
