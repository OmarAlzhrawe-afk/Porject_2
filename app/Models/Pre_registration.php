<?php

namespace App\Models;

use App\Models\Education_content;
use Illuminate\Database\Eloquent\Model;

class Pre_registration extends Model
{

	protected $table = 'pre_registrations';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'education_level_id',
		'installment_plan_id',
		'payment_reference',
		'payment_status',
		'student_name',
		'student_email',
		'parent_name',
		'parent_email',
		'phone_number',
		'status',
		'created_at',
		'documents'
	);
	protected $casts = [
		'documents' => 'array',
	];
	public function education_level()
	{
		return $this->belongsTo(Education_content::class, 'education_level_id');
	}
	public function installment_plan()
	{
		return $this->belongsTo(Installment_payment::class, 'installment_plan_id');
	}
}
