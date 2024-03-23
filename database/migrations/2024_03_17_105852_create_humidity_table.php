<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHumidityTable extends Migration
{
    public function up()
    {
        Schema::create('humidity', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 8, 2); // Adjust the precision according to your sensor data
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('humidity');
    }
}
