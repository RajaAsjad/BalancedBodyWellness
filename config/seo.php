<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Public website SEO (Balanced Body IV Wellness)
    |--------------------------------------------------------------------------
    */

    'site_name' => env('SEO_SITE_NAME', 'Balanced Body IV Wellness'),

    'canonical_url' => rtrim(env('SEO_CANONICAL_URL', env('APP_URL', 'https://balancedbodyivwellness.com')), '/'),

    'default_description' => env(
        'SEO_DEFAULT_DESCRIPTION',
        'Experience advanced IV therapy and wellness solutions in NYC. Offering NAD+ therapy, IV infusions, peptide therapy, and medical weight loss treatments. Book your consultation with Balanced Body IV Wellness today.'
    ),

    'default_og_image' => env('SEO_OG_IMAGE', ''),

    'default_logo' => env('SEO_LOGO', 'admin/assets/images/page/13052026235412.png'),

    'default_favicon' => env('SEO_FAVICON', 'assets/website/favicon.svg'),

    'twitter_handle' => env('SEO_TWITTER', '@balancedbodyivwellness'),

    'locale' => 'en_US',

    'google_site_verification' => env('SEO_GOOGLE_VERIFICATION', 'sJcDcW92mysdY4J1n_FWh_9IAVQyjb36tk4Tnw9Twpg'),

    'ga_measurement_id' => env('SEO_GA_ID', 'G-Y2EZVYVB8L'),

    'gtm_container_id' => env('SEO_GTM_ID', 'GTM-5933CKDT'),

    'geo' => [
        'region' => 'US-NY',
        'placename' => 'Town of Yorktown',
        'position' => '41.32861;-73.807808',
        'icbm' => '41.32861, -73.807808',
    ],

    'business' => [
        'type' => 'LocalBusiness',
        'alternate_name' => 'Mobile IV Therapy NYC',
        'phone' => '914-745-6924',
        'email' => 'info@balancedbodyivwellness.com',
        'instagram' => 'https://www.instagram.com/balancedbodyivwellness/',
        'facebook' => 'https://www.facebook.com/balancedbodyivwellness',
        'area_served' => 'New York City, Westchester, Putnam, Dutchess, Rockland County',
        'street_address' => '650 Lee blvd',
        'address_locality' => 'Jefferson Valley',
        'address_region' => 'NY',
        'postal_code' => '10598',
        'address_country' => 'US',
        'latitude' => 41.3286166,
        'longitude' => -73.8077192,
    ],

    /*
    | Public routes included in sitemap.xml (name => [priority, changefreq])
    */
    'sitemap_routes' => [
        'index' => ['priority' => '1.0', 'changefreq' => 'weekly'],
        'services' => ['priority' => '0.9', 'changefreq' => 'weekly'],
        'about-us' => ['priority' => '0.8', 'changefreq' => 'monthly'],
        'faqs' => ['priority' => '0.8', 'changefreq' => 'monthly'],
        'policies' => ['priority' => '0.5', 'changefreq' => 'yearly'],
        'contact' => ['priority' => '0.9', 'changefreq' => 'monthly'],
        'locations' => ['priority' => '0.8', 'changefreq' => 'monthly'],
    ],

];
