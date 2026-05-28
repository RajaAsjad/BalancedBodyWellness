<?php

/**
 * Header dropdown menus (Services & Locations).
 * Slugs must match routes: services/{slug}, locations/{slug}
 */
return [
    'services' => [
        'items' => [
            ['slug' => 'methylene-blue-iv-therapy-nyc', 'label' => 'Methylene Blue'],
            ['slug' => 'nad-therapy-nyc', 'label' => 'NAD'],
            ['slug' => 'peptide-therapy-nyc', 'label' => 'Peptide Therapy'],
            ['slug' => 'iv-vitamin-therapy-nyc', 'label' => 'IV Vitamin Therapy'],
            ['slug' => 'medical-weight-loss-nyc', 'label' => 'Medical Weight Loss'],
            ['slug' => 'iron-infusion-therapy-nyc', 'label' => 'Iron Infusion'],
            ['slug' => 'high-dose-vitamin-c-drip-nyc', 'label' => 'High-Dose Vitamin C Drip'],
            ['slug' => 'ala-drips-nyc', 'label' => 'ALA Drips'],
        ],
        'all_label' => 'All Services',
    ],
    'locations' => [
        'items' => [
            ['slug' => 'iv-therapy-rockland-county', 'label' => 'Rockland County'],
            ['slug' => 'iv-therapy-jefferson-valley-ny', 'label' => 'Jefferson Valley'],
            ['slug' => 'iv-therapy-putnam-county', 'label' => 'Putnam County'],
            ['slug' => 'iv-therapy-dutchess-county', 'label' => 'Dutchess County'],
            ['slug' => 'iv-therapy-westchester-county', 'label' => 'Westchester'],
            ['slug' => 'iv-therapy-new-york-city', 'label' => 'New York City'],
        ], 
    ],
];
