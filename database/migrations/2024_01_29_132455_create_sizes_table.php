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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->text("system");
            $table->tinyText("height");
            $table->tinyText("weight");
            $table->float("flight_modifier", 2,0);
            $table->float("stealth_modifier", 2,0);
            $table->float("attack_modifier", 2,0);
            $table->float("defense_modifier", 2,0);
            $table->float("damage_modifier", 2,0);
            $table->float("damage_reduction_modifier", 2,0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
