<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected  $primaryKey = 'banner_id';

    protected $fillable = [
        'banner_type',
        'banner_name',
        'banner_desc',
        'banner_file',
        'banner_date'
    ];
}
