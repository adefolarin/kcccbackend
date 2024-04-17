<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptGallery extends Model
{
    use HasFactory;

    protected $table = "deptgalleries";
    protected $primaryKey = "deptgalleries_id";
}
