<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StoreUser extends Authenticatable
{
    use HasFactory;
    //protected $guard = 'aamuser';

    protected $table = 'storeusers';
    protected $primaryKey = "storeusers_id";


    protected $fillable = [
        'storeusers_fname',
        'storeusers_lname',
        'storeusers_gender',
        'storeusers_email',
        'storeusers_password',
    ];


    protected $hidden = [
        'storeusers_password',
    ];

}
