<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login_code extends Model
{
    use HasFactory;

    protected $table = 'login_codes';
    public $timestamps = false;
    protected $fillable = array(
        'email',
        'code',
        'created_at'
    );
}
