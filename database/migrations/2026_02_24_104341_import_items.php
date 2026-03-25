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
        $table = Schema::create('import_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Item_id');
            $table->foreign('Item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('quantity');
            $table->unsignedBigInteger('import_id');
            $table->foreign('import_id')->references('id')->on('imports')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table = Schema::dropIfExists('import_items');

    }
};
