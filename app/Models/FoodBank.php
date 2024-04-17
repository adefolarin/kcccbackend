<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodBank extends Model
{
    use HasFactory;

    protected $table = "foodbanks";
    protected $primaryKey = "foodbanks_id";
}
