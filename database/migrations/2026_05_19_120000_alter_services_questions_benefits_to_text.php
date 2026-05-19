<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->text('questions')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->text('benefits')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('questions')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('benefits')->nullable()->change();
        });
    }
};
