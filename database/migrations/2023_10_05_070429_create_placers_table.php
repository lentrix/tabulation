<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('placers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('place_id')->unsigned();
            $table->bigInteger('competition_id')->unsigned();
            $table->bigInteger('team_id')->unsigned();
            $table->timestamps();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placers');
    }
};
