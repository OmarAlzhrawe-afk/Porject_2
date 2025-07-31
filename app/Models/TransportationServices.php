<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationService extends Model
{
    use HasFactory;
    protected $table = 'transportation_services';

    public $timestamps = true;
    protected $fillable = [
        'name',
        'price',
        'description',
    ];
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    // public function payment_method()
    // {
    //     return $this->belongsTo(Payment_method::class, 'payment_method_id');
    // }
}
