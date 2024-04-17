<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AamUser extends Authenticatable
{
    use HasFactory;
    //protected $guard = 'aamuser';

    protected $table = 'aamusers';
    protected $primaryKey = "aamusers_id";


    protected $fillable = [
        'aamusers_name',
        'aamusers_email',
        'aamusers_password',
    ];


    protected $hidden = [
        'aamusers_password',
    ];

}
