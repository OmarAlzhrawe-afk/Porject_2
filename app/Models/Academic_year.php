<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_year extends Model
{
    use HasFactory;
    protected $table = 'academic_years';
    public $timestamps = true;
    protected $fillable = array(
        'id',
        'name',
        'start_date',
        'is_current',
        'end_date',
    );
    public function terms()
    {
        return $this->hasMany(Term::class);
    }
}
