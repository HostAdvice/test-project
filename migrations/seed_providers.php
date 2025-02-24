<?php
function seed_providers()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'vpn_providers';

    $providers = [
        [
            'name' => 'NordVPN',
            'slug' => 'nordvpn',
            'price' => 11.99,
            'locations' => 59,
            'rating' => 4.8,
            'description' => 'NordVPN is one of the most popular VPN providers...'
        ],
        [
            'name' => 'ExpressVPN',
            'slug' => 'expressvpn',
            'price' => 12.95,
            'locations' => 94,
            'rating' => 4.7,
            'description' => 'ExpressVPN offers high-speed connections...'
        ]
    ];

    // if provider table is not empty, do not seed
    $results = $wpdb->get_results("SELECT * FROM $table_name");
    if (!empty($results)) {
        return;
    }

    foreach ($providers as $provider) {
        $wpdb->insert($table_name, $provider);
    }
}