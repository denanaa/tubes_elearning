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
        Schema::create('videos', function (Blueprint $table) {
            $table->id('id_video'); // id_video (Primary Key) - Big Integer
            $table->unsignedBigInteger('id_module'); // id_module (Foreign Key) - Unsigned Big Integer
            $table->string('title_video', 150); // title_video - Varchar (max length 150)
            $table->string('link_video'); // link_video - Varchar (URL)
            $table->string('thumbnail_video')->nullable(); // thumbnail_video - Varchar (nullable)
            $table->text('description_video')->nullable(); // description_video - Text (nullable)
            $table->timestamps(); // created_at and updated_at - Timestamps

            // Foreign key relation to modules table
            $table->foreign('id_module')->references('id_module')->on('modules')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
