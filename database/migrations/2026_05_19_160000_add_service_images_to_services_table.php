<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('description_image')->nullable()->after('description');
            $table->string('benefit_image')->nullable()->after('benefits');
            $table->string('question_image')->nullable()->after('questions');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['description_image', 'benefit_image', 'question_image']);
        });
    }
};
