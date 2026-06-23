<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            if (! Schema::hasColumn('locations', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('slug');
            }

            if (! Schema::hasColumn('locations', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }

            if (! Schema::hasColumn('locations', 'hero_eyebrow')) {
                $table->string('hero_eyebrow')->nullable()->after('meta_description');
            }

            if (! Schema::hasColumn('locations', 'hero_title')) {
                $table->string('hero_title')->nullable()->after('hero_eyebrow');
            }

            if (! Schema::hasColumn('locations', 'hero_lead')) {
                $table->text('hero_lead')->nullable()->after('hero_title');
            }

            if (! Schema::hasColumn('locations', 'welcome_label')) {
                $table->string('welcome_label')->nullable()->after('hero_lead');
            }

            if (! Schema::hasColumn('locations', 'welcome_title')) {
                $table->string('welcome_title')->nullable()->after('welcome_label');
            }

            if (! Schema::hasColumn('locations', 'welcome_paragraphs')) {
                $table->json('welcome_paragraphs')->nullable()->after('welcome_title');
            }

            if (! Schema::hasColumn('locations', 'welcome_highlights')) {
                $table->json('welcome_highlights')->nullable()->after('welcome_paragraphs');
            }

            if (! Schema::hasColumn('locations', 'welcome_services')) {
                $table->json('welcome_services')->nullable()->after('welcome_highlights');
            }

            if (! Schema::hasColumn('locations', 'process_label')) {
                $table->string('process_label')->nullable()->after('welcome_services');
            }

            if (! Schema::hasColumn('locations', 'process_title')) {
                $table->string('process_title')->nullable()->after('process_label');
            }

            if (! Schema::hasColumn('locations', 'process_items')) {
                $table->json('process_items')->nullable()->after('process_title');
            }

            if (! Schema::hasColumn('locations', 'sort_order')) {
                $table->unsignedInteger('sort_order')->default(0)->after('process_items');
            }
        });
    }

    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $columns = [
                'meta_title',
                'meta_description',
                'hero_eyebrow',
                'hero_title',
                'hero_lead',
                'welcome_label',
                'welcome_title',
                'welcome_paragraphs',
                'welcome_highlights',
                'welcome_services',
                'process_label',
                'process_title',
                'process_items',
                'sort_order',
            ];

            $existing = array_values(array_filter($columns, fn (string $column) => Schema::hasColumn('locations', $column)));

            if ($existing !== []) {
                $table->dropColumn($existing);
            }
        });
    }
};
