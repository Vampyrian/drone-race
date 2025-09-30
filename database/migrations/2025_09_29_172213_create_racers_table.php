<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('racers', static function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('email')->nullable();
            $table->string('age')->nullable();
            $table->string('flight_license')->nullable();
            $table->string('license_plate')->nullable();
            $table->unsignedBigInteger('race_id');

            $table->foreign('race_id')
                ->references('id')
                ->on('races')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('racers');
    }
};
