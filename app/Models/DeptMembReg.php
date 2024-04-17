<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptMembReg extends Model
{
    use HasFactory;

    protected $table = "deptmembregs";
    protected $primaryKey = "deptmembregs_id";
}
