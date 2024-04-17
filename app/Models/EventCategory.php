<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;
    protected $table = "eventcategories";
    protected $primaryKey = "eventcategories_id";

    /*protected $fillable = [
        'eventcategories_name',
    ];*/
}
