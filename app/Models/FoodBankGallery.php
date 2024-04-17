<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodBankGallery extends Model
{
    use HasFactory;

    protected $table = "foodbankgalleries";
    protected $primaryKey = "foodbankgalleries_id";
}
