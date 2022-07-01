<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RequestsModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $table= "request";

    public $timestamps = false;

    protected $primaryKey = "no_request";

    protected $fillable = [
        'no_request',
        'requestcol',
        'type_buildingpermit',
        'type_planningcertificate',
        'type_implantationpermit',
        'type_autorizationtontosubdivide',
        'type_demolitionpermit',
        'type_certificateofconformity',
        'date_request',
        'progress',
        'pending',
        'completed',
        'user_id_user',
    ];

    protected $hidden = [
        'password',
    ];
}
