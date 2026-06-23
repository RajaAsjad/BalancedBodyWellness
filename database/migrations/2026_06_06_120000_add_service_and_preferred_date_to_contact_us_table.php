<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            if (! Schema::hasColumn('contact_us', 'service_of_interest')) {
                $table->string('service_of_interest', 150)->nullable()->after('phone');
            }

            if (! Schema::hasColumn('contact_us', 'preferred_date')) {
                $table->date('preferred_date')->nullable()->after('service_of_interest');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            if (Schema::hasColumn('contact_us', 'preferred_date')) {
                $table->dropColumn('preferred_date');
            }

            if (Schema::hasColumn('contact_us', 'service_of_interest')) {
                $table->dropColumn('service_of_interest');
            }
        });
    }
};
