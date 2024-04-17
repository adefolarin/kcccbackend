<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolCategory extends Model
{
    use HasFactory;

    protected $table = "volcategories";
    protected $primaryKey = "volcategories_id";
}
