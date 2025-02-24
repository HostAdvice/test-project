<?php

require_once dirname(__FILE__) . '/../../../vendor/autoload.php';
require_once 'ProviderService.php';

function init_twig() {
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
    return new \Twig\Environment($loader);
}

function init_provider_service() {
    global $wpdb;
    return new ProviderService($wpdb);
}

add_action('init', function () {
    add_rewrite_rule(
        'provider/([^/]+)/?$',
        'index.php?provider_slug=$matches[1]',
        'top'
    );
});

add_filter('query_vars', function($vars) {
    $vars[] = 'provider_slug';
    return $vars;
});