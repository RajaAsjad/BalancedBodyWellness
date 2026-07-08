<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nav_label')->nullable();
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('hero')->nullable();
            $table->json('overview')->nullable();
            $table->json('drip_menu')->nullable();
            $table->json('supports')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('show_in_nav')->default(true);
            $table->boolean('is_legacy')->default(false);
            $table->string('status')->default(1)->comment('0=inactive, 1=active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_pages');
    }
};
