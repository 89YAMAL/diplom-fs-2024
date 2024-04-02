<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('session_start');
            $table->integer('minute_start');
            $table->integer('minute_finish');
            $table->unsignedBigInteger('hall_id');
            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade');
            $table->string('name_hall');
            $table->text('config_hall')->nullable();
            $table->unsignedBigInteger('film_id');
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->string('name_film');
            $table->integer('duration');
            $table->string('active_hall')->default('off');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
