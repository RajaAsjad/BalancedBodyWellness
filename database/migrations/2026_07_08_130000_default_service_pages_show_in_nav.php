<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Legacy import set show_in_nav=0 for all pages. Default is show in nav;
        // only pages explicitly set to Nav=No should be hidden.
        DB::table('service_pages')
            ->whereIn('status', [1, '1'])
            ->update(['show_in_nav' => 1]);
    }

    public function down(): void
    {
        // No rollback — nav visibility is managed in admin.
    }
};
