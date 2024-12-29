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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_category'); // id_category (Primary Key) - Big Integer
            $table->string('image_category')->nullable(); // image_category - Varchar (nullable)
            $table->string('name_category', 100); // name_category - Varchar (max length 100)
            $table->text('description_category')->nullable(); // description_category - Text (nullable)
            $table->timestamps(); // created_at and updated_at - Timestamps
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
