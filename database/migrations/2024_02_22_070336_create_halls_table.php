<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // название зала
            $table->text('config')->nullable(); // конфигурация зала
            $table->integer('standart_price')->default(500); // стоимость обычного места
            $table->integer('vip_price')->default(700); // стоимость vip места
            $table->integer('rows')->default(5); // количество рядов
            $table->integer('seats')->default(5); // количество мест в ряду
            $table->string('active_hall')->default('off'); // статус зала
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
