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
        'term_id',
        'class_room_id',
        'date',
        'excused',
    );
    protected static function newFactory()
    {
        return \Database\Factories\StudentAttendanceFactory::new();
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
    public function class()
    {
        return $this->belongsTo(Class_room::class, 'class_room_id');
    }
}
