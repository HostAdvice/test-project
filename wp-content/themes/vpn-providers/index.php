<?php

$slug = get_query_var('provider_slug');
if ($slug) {
    require_once 'single-provider.php';
    return;
}

$twig = init_twig();
$provider_service = init_provider_service();

$providers = $provider_service->getAllProviders();
echo $twig->render('home.twig', ['providers' => $providers]);