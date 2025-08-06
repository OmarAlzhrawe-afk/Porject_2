<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homeworksolving extends Model
{
    use HasFactory;
    protected $table = 'homework_solvings';
    public $timestamps = true;
    protected $fillable = array(
        'id',
        'homework_id',
        'student_id',
        'solve_url'

    );
    public function homework()
    {
        return $this->belongsTo(Teacher::class, 'homework_id');
    }

    public function student()
    {
        return $this->belongsTo(Class_room::class, 'student_id');
    }
}
