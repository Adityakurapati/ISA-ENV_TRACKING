<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;
    
    protected $table = 'temperature'; // Assuming your table name is 'temperature'
    
    protected $fillable = ['temp_value']; // Define fillable attributes
}