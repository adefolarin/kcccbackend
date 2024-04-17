<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentGallery extends Model
{
    use HasFactory;

    protected $table = "departmentgalleries";
    protected $primaryKey = "departmentgalleries_id";
}
