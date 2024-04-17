<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rating extends Authenticatable
{
    use HasFactory;
    //protected $guard = 'aamuser';

    protected $table = 'ratings';
    protected $primaryKey = "ratings_id";


}
