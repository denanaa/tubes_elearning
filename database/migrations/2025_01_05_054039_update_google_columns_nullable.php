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
    Schema::table('users', function ($table) {
        $table->string('google_id')->nullable()->change();
        $table->string('google_token')->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('users', function ($table) {
        $table->string('google_id')->nullable(false)->change();
        $table->string('google_token')->nullable(false)->change();
    });
}

};
