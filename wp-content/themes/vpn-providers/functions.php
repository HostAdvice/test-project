<?php

use Twig\TwigFilter;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once dirname(__FILE__) . '/../../../vendor/autoload.php';
require_once 'ProviderService.php';

function init_twig()
{
    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);

    $twig->addFilter(new TwigFilter('dist', function ($relative_path) {
        return "/wp-content/themes/vpn-providers/dist/" . $relative_path;
    }));

    return $twig;
}

function init_provider_service()
{
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

add_filter('query_vars', function ($vars) {
    $vars[] = 'provider_slug';
    return $vars;
});