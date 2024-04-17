<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GivingCategory extends Model
{
    use HasFactory;

    protected $table = "givingcategories";
    protected $primaryKey = "givingcategories_id";
}
