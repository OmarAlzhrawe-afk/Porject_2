<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Qr_Code;
use App\Models\User;

class Staff_attendance extends Model
{

	protected $table = 'staff_attendances';
	public $timestamps = true;
	protected $fillable = array(
		'id',
		'QR_id',
		'user_id',
		'Attendance_status',
		'nots'
	);
	protected $visible = array('QR_id', 'user_id', 'Attendance_status', 'nots');

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function Qr_code()
	{
		return $this->belongsTo(Qr_Code::class, 'QR_id');
	}
}
