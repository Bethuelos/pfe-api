<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilesModel extends Model
{
    use HasFactory;

    // protected $table= "upload";

    // public $timestamps = false;

    // protected $primaryKey = "id_upload";

    protected $fillable = [
        'title',
        'path'
    ];

}
