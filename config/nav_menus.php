<?php

/**
 * Header dropdown menus (Services & Locations).
 * Service items are loaded from the database (admin → Service Pages).
 * Location items fall back to config until fully migrated to DB.
 */
return [
    'services' => [
        'items' => [],
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
