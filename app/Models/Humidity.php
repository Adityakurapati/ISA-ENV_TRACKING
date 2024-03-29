<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Humidity extends Model
{
    use HasFactory;

    // Assuming you have a "humidity" table in your database
    protected $table = 'humidity';

    // Define mass-assignable attributes
    protected $fillable = ['value'];
}