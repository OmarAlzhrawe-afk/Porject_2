<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home_work extends Model
{
    use HasFactory;
    protected $table = 'home_works';
    public $timestamps = true;
    protected $fillable = array(
        'id',
        'teacher_id',
        'class_id',
        'description',
        'homework_url',
        'last_date',
        'created_at'
    );
    protected static function newFactory()
    {
        return \Database\Factories\HomeworkFactory::new();
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function class()
    {
        return $this->belongsTo(Class_room::class, 'class_id');
    }
    public function solvings()
    {
        return $this->hasMany(Homeworksolving::class, 'homework_id');
    }
}
