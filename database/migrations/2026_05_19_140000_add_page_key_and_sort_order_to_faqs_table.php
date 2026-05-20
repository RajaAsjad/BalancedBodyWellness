<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('page_key', 50)->default('faqs')->after('created_by');
            $table->unsignedInteger('sort_order')->default(0)->after('page_key');
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['page_key', 'sort_order']);
        });
    }
};
