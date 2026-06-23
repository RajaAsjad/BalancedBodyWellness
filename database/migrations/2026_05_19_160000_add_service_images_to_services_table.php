<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (! Schema::hasColumn('services', 'description_image')) {
                $table->string('description_image')->nullable()->after('description');
            }

            if (! Schema::hasColumn('services', 'benefit_image')) {
                $table->string('benefit_image')->nullable()->after('benefits');
            }

            if (! Schema::hasColumn('services', 'question_image')) {
                $table->string('question_image')->nullable()->after('questions');
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $columns = array_filter([
                Schema::hasColumn('services', 'description_image') ? 'description_image' : null,
                Schema::hasColumn('services', 'benefit_image') ? 'benefit_image' : null,
                Schema::hasColumn('services', 'question_image') ? 'question_image' : null,
            ]);

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
