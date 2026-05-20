<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable()->after('page_key');
            $table->index(['page_key', 'service_id']);
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropIndex(['page_key', 'service_id']);
            $table->dropColumn('service_id');
        });
    }
};
