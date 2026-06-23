<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            if (! Schema::hasColumn('contact_us', 'captcha_code')) {
                $table->string('captcha_code', 10)->nullable()->after('message');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            if (Schema::hasColumn('contact_us', 'captcha_code')) {
                $table->dropColumn('captcha_code');
            }
        });
    }
};
