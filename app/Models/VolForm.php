<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolForm extends Model
{
    use HasFactory;

    protected $table = "volforms";
    protected $primaryKey = "volforms_id";
}
