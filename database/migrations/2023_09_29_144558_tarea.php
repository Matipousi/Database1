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
        Schema::create('tarea' , function (Blueprint $table) {
          
            $table->id();
            $table->string('titulo', 150);
            $table->string('contenido', 255);
            $table->string('estado', 50);
            $table->foreign('usuario_id')->references('id')->on('usuario');
            $table->unsignedBigInteger('usuario_id');
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
        Schema::dropIfExists('tarea');
    }
};
