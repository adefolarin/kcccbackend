<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodBankCategory extends Model
{
    use HasFactory;

    protected $table = "foodbankcategories";
    protected $primaryKey = "foodbankcategories_id";
}
