<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReg extends Model
{
    use HasFactory;

    protected $table = "eventregs";
    protected $primaryKey = "eventregs_id";
}
