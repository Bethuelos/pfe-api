<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomersModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table= "customer";

    public $timestamps = false;

    protected $primaryKey = "id_customer";

    protected $fillable = [
        'id_customer',
        'name',
        'first_name',
        'email',
        'boring_year',
        'gender',
        'phone_number',
        'password',
        'address',
        'nationality',
        'postal_code',
    ];

    protected $hidden = [
        'password',
    ];
}
