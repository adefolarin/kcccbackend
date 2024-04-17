<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembReg extends Model
{
    use HasFactory;

    protected $table = "membregs";
    protected $primaryKey = "membreg_id";
}
