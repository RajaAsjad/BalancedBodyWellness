<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            if (! Schema::hasColumn('faqs', 'page_key')) {
                $table->string('page_key', 50)->default('faqs')->after('created_by');
            }

            if (! Schema::hasColumn('faqs', 'sort_order')) {
                $table->unsignedInteger('sort_order')->default(0)->after('page_key');
            }
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            if (Schema::hasColumn('faqs', 'sort_order')) {
                $table->dropColumn('sort_order');
            }

            if (Schema::hasColumn('faqs', 'page_key')) {
                $table->dropColumn('page_key');
            }
        });
    }
};
