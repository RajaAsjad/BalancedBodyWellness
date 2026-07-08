<?php

/**
 * Service landing page behaviour.
 *
 * Navigation and page content are managed via admin → Service Pages (database).
 * SERVICE_PAGES_DB_NAV is kept for backwards compatibility; DB is always used when the table exists.
 */
return [
    'use_db_nav' => env('SERVICE_PAGES_DB_NAV', true),
];
