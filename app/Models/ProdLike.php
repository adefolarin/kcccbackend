<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdLike extends Model
{
    use HasFactory;
    protected $table = "prodlikes";
    protected $primaryKey = "prodlikes_id";
}
