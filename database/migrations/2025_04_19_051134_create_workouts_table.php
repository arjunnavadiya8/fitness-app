<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutsTable extends Migration
{
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('duration'); // in minutes
            $table->string('intensity');
            $table->string('equipment')->nullable();
            $table->string('muscle_groups'); // Can be stored as CSV or JSON
            $table->text('instructions')->nullable();
            $table->string('image')->nullable(); // Image file path
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('workouts');
    }
}
