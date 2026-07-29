<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('faqs', 'blog_slug')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->string('blog_slug', 120)->nullable()->after('location_slug');
                $table->index(['page_key', 'blog_slug']);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('faqs', 'blog_slug')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->dropIndex(['page_key', 'blog_slug']);
                $table->dropColumn('blog_slug');
            });
        }
    }
};
