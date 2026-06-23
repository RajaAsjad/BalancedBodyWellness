<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('faqs', 'service_slug')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->string('service_slug', 120)->nullable()->after('service_id');
                $table->index(['page_key', 'service_slug']);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('faqs', 'service_slug')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->dropIndex(['page_key', 'service_slug']);
                $table->dropColumn('service_slug');
            });
        }
    }
};
