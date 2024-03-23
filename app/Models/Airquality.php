<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airquality extends Model
{
    use HasFactory;
    
    // Assuming you have a "airquality" table in your database
    protected $table = 'airquality';

    // Define mass-assignable attributes
    protected $fillable = ['gas_value', 'h2ppm', 'lpg', 'ch4', 'co', 'alcohol'];
}