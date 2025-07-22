<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_attendance extends Model
{
    use HasFactory;
    protected $table = 'student_attendances';
    public $timestamps = true;
    protected $fillable = array(
        'id',
        'student_id',
        'class_room_id',
        'date',
        'excused',
    );
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function class()
    {
        return $this->belongsTo(Class_room::class);
    }
}
