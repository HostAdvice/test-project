<?php

$twig = init_twig();
$provider_service = init_provider_service();

$slug = get_query_var('provider_slug');
$provider = $provider_service->getProviderBySlug($slug);

if (!$provider) {
    wp_redirect(home_url());
    exit;
}

echo $twig->render('provider.twig', ['provider' => $provider]);