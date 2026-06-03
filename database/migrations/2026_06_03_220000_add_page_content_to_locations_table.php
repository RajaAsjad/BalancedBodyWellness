<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('slug');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('hero_eyebrow')->nullable()->after('meta_description');
            $table->string('hero_title')->nullable()->after('hero_eyebrow');
            $table->text('hero_lead')->nullable()->after('hero_title');
            $table->string('welcome_label')->nullable()->after('hero_lead');
            $table->string('welcome_title')->nullable()->after('welcome_label');
            $table->json('welcome_paragraphs')->nullable()->after('welcome_title');
            $table->json('welcome_highlights')->nullable()->after('welcome_paragraphs');
            $table->json('welcome_services')->nullable()->after('welcome_highlights');
            $table->string('process_label')->nullable()->after('welcome_services');
            $table->string('process_title')->nullable()->after('process_label');
            $table->json('process_items')->nullable()->after('process_title');
            $table->unsignedInteger('sort_order')->default(0)->after('process_items');
        });
    }

    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn([
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
            ]);
        });
    }
};
