<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('faqs', 'location_slug')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->string('location_slug', 120)->nullable()->after('service_slug');
                $table->index(['page_key', 'location_slug']);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('faqs', 'location_slug')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->dropIndex(['page_key', 'location_slug']);
                $table->dropColumn('location_slug');
            });
        }
    }
};
