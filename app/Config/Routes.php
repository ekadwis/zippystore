<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->POST('/linkbola/purchase', 'Home::purchase');
$routes->get('/linkbola/payment-success-lifetime', 'Home::payment_success_lifetime');
$routes->get('/linkbola/payment-success-daily', 'Home::payment_success_daily');
