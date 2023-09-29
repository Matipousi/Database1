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
        Schema::create('revision' , function (Blueprint $table) {
          
            $table->id();
            $table->string('detalle', 255);
            $table->foreign('tarea_id')->references('id')->on('tarea');
            $table->unsignedBigInteger('tarea_id');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at');
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision');
    }
};
