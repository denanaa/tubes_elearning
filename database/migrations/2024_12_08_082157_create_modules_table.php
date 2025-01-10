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
        Schema::create('modules', function (Blueprint $table) {
            $table->id('id_module'); // id_module (Primary Key) - Big Integer
            $table->unsignedBigInteger('id_category'); // id_category (Foreign Key) - Unsigned Big Integer
            $table->string('name_module'); // name_module - Varchar (max length 100)
            $table->timestamps(); // created_at and updated_at - Timestamps

            // Foreign key relation to categories table
            $table->foreign('id_category')
            ->references('id_category')
            ->on('categories')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
