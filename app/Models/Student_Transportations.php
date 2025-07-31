<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Transportations extends Model
{
    use HasFactory;
    protected $table = 'student__transportations';
    public $timestamps = true;
    protected $fillable = [
        'student_id',
        'transportation_service_id',
        'status',
        'start_date',
        'end_date',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function transportation_service()
    {
        return $this->belongsTo(TransportationService::class, 'transportation_service_id');
    }
}
