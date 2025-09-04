<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';
    public $timestamps = true;
    protected $guard_name = 'api';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'hire_date',
        'ID_documents',
        'phone_number',
        'birth_date',
        'gender',
        'address',
        'salary'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'ID_documents' => 'array',
    ];
    public function transactions()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }
    public function supervisor()
    {
        return $this->hasOne(Supervisor::class);
    }
    public function leaves()
    {
        return $this->hasMany(Staff_leaves::class, 'user_id');
    }
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_participants', 'user_id', 'activity_id');
    }
}
