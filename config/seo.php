<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Public website SEO (Balanced Body IV Wellness)
    |--------------------------------------------------------------------------
    */

    'site_name' => env('SEO_SITE_NAME', 'Balanced Body IV Wellness'),

    'default_description' => env(
        'SEO_DEFAULT_DESCRIPTION',
        'Holistic IV wellness in Los Angeles — IV drips, peptides, and vitamin injections with medical oversight in a calming, spa-inspired studio.'
    ),

    'default_og_image' => env('SEO_OG_IMAGE', ''),

    'twitter_handle' => env('SEO_TWITTER', '@balancedbodyivwellness'),

    'locale' => 'en_US',

    'business' => [
        'type' => 'MedicalBusiness',
        'phone' => '+16264066538',
        'email' => 'info@balancedbodyivwellness.com',
        'instagram' => 'https://www.instagram.com/balancedbodyivwellness/',
        'area_served' => 'Los Angeles, CA',
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
