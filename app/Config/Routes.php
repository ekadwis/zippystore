<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'HomeController::index');
$routes->get('about', 'AboutController::index');
$routes->get('testimonials', 'TestimoniController::index');
$routes->get('cara-pesan', 'CaraPesanController::index');
$routes->get('gallery', 'GalleryController::index');
$routes->get('sosmed', 'SosmedController::index');
$routes->post('sosmed/hitung', 'SosmedController::hitung');
$routes->addRedirect('portfolio', 'cara-pesan');

// Auth
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');

// ===== ADMIN (dilindungi filter auth) =====
$routes->group('admin', ['filter' => 'auth'], static function ($routes) {

    $routes->group('sosmed', static function ($routes) {
        $routes->get('/', 'Admin\SosmedController::index');

        // Platform
        $routes->get('platform',              'Admin\SosmedController::platform');
        $routes->get('platform/create',       'Admin\SosmedController::platformForm');
        $routes->get('platform/edit/(:num)',  'Admin\SosmedController::platformForm/$1');
        $routes->post('platform/save',        'Admin\SosmedController::platformSave');
        $routes->post('platform/save/(:num)', 'Admin\SosmedController::platformSave/$1');
        $routes->get('platform/delete/(:num)','Admin\SosmedController::platformDelete/$1');

        // Layanan
        $routes->get('layanan',              'Admin\SosmedController::layanan');
        $routes->get('layanan/create',       'Admin\SosmedController::layananForm');
        $routes->get('layanan/edit/(:num)',  'Admin\SosmedController::layananForm/$1');
        $routes->post('layanan/save',        'Admin\SosmedController::layananSave');
        $routes->post('layanan/save/(:num)', 'Admin\SosmedController::layananSave/$1');
        $routes->get('layanan/delete/(:num)','Admin\SosmedController::layananDelete/$1');

        // Paket
        $routes->get('paket',              'Admin\SosmedController::paket');
        $routes->get('paket/create',       'Admin\SosmedController::paketForm');
        $routes->get('paket/edit/(:num)',  'Admin\SosmedController::paketForm/$1');
        $routes->post('paket/save',        'Admin\SosmedController::paketSave');
        $routes->post('paket/save/(:num)', 'Admin\SosmedController::paketSave/$1');
        $routes->get('paket/delete/(:num)','Admin\SosmedController::paketDelete/$1');

        // Kalkulator
        $routes->get('kalkulator',       'Admin\SosmedController::kalkulator');
        $routes->post('kalkulator/hitung','Admin\SosmedController::kalkulatorHitung');
        
    });

    // Testimoni
    $routes->group('testimoni', static function ($routes) {
        $routes->get('/',                'Admin\TestimoniController::index');
        $routes->get('create',           'Admin\TestimoniController::form');
        $routes->get('edit/(:num)',      'Admin\TestimoniController::form/$1');
        $routes->post('save',            'Admin\TestimoniController::save');
        $routes->post('save/(:num)',     'Admin\TestimoniController::save/$1');
        $routes->get('toggle/(:num)',    'Admin\TestimoniController::toggle/$1');
        $routes->get('delete/(:num)',    'Admin\TestimoniController::delete/$1');
    });

    // Galeri
    $routes->group('galeri', static function ($routes) {
        $routes->get('/',             'Admin\GaleriController::index');
        $routes->get('create',        'Admin\GaleriController::form');
        $routes->get('edit/(:num)',   'Admin\GaleriController::form/$1');
        $routes->post('save',         'Admin\GaleriController::save');
        $routes->post('save/(:num)',  'Admin\GaleriController::save/$1');
        $routes->get('toggle/(:num)', 'Admin\GaleriController::toggle/$1');
        $routes->get('delete/(:num)', 'Admin\GaleriController::delete/$1');
    });
});
