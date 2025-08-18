<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $table = 'terms';
    public $timestamps = true;
    protected $fillable = array(
        'id',
        'academic_year_id',
        'name',
        'start_date',
        'is_current',
        'end_date',
    );
    public function academicYear()
    {
        return $this->belongsTo(Academic_year::class);
    }
}
