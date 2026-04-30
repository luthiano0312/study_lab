<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();                          // id BIGINT AUTO_INCREMENT PRIMARY KEY
            $table->string('title', 255)->default('Sem título');
            $table->longText('content')->default('');
            $table->timestamps();                  // created_at + updated_at automático
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};