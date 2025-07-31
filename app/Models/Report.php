<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    public $timestamps = true;
    protected $fillable = array(
        'id',
        'report_type',
        'report_url',
        'report_description',
        'report_date'
    );
}
