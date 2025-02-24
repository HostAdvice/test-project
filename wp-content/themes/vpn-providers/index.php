<?php

$twig = init_twig();
$provider_service = init_provider_service();

$providers = $provider_service->getAllProviders();
echo $twig->render('home.twig', ['providers' => $providers]);