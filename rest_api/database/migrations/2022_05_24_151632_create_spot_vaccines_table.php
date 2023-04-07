<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spot_vaccines', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->foreignId('vaccine_id')->constrained('vaccines');
            $table->foreignId('spot_id')->constrained('spots');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spot_vaccines');
    }
};
