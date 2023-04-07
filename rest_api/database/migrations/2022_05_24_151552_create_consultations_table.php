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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'accepted', 'rejected']);
            $table->string('disease_history')->nullable();
            $table->string('current_symptoms')->nullable();
            $table->string('doctor_notes')->nullable();
            $table->foreignId('society_id')->constrained('societies');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors');
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
        Schema::dropIfExists('consultations');
    }
};
