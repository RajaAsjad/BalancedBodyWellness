<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix deleted_at for SoftDeletes: must be nullable timestamp, not string.
     */
    public function up()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('testimonials', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('deleted_at')->nullable();
        });
    }
};
