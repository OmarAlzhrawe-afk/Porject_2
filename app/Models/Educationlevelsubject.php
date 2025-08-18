<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educationlevelsubject extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return \Database\Factories\EducationalLevelSubjectFactory::new();
    }
    protected $table = 'educational_level_subjects';
    public $timestamps = true;
    protected $fillable = array(
        'id',
        'education_level_id',
        'subject_id'
    );
}
