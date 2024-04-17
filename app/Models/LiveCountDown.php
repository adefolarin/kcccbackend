<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveCountDown extends Model
{
    use HasFactory;

    protected $table = "livecountdowns";
    protected $primaryKey = "livecountdowns_id";
}
