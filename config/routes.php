<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use App\Controller\ClientController;
use App\Controller\GalleryController;
use App\Controller\ImageController;

return function (RoutingConfigurator $routes) {

    $routes->add('gallery_get_gallery', '/api/v1/gallery')
        ->controller([GalleryController::class, 'index']);

    $routes->add('gallery_get_album', '/api/v1/album/{title}')
        ->controller([GalleryController::class, 'show'])
        ->requirements(['title' => '^[a-zA-Z0-9--]*$']);

    $routes->add('image_response', '/img/{title}/{id}')
        ->controller([ImageController::class, 'imageResponse']);

    $routes->add('client_serve', '/{path}')
        ->controller(ClientController::class)
        ->defaults(['path' => 1]);
};
