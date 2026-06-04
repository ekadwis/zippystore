<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'HomeController::index');
$routes->get('about', 'AboutController::index');
$routes->get('testimonials', 'TestimoniController::index');
$routes->get('cara-pesan', 'CaraPesanController::index');
$routes->get('gallery', 'GalleryController::index');
$routes->get('sosmed', 'SosmedController::index');
$routes->get('joki', 'JokiController::index');
$routes->get('premium', 'PremiumController::index');
$routes->get('otp', 'OtpController::index');
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

    // Premium
    $routes->group('premium', static function ($routes) {
        $routes->get('/', 'Admin\PremiumController::index');

        // Produk
        $routes->get('produk',              'Admin\PremiumController::produk');
        $routes->get('produk/create',       'Admin\PremiumController::produkForm');
        $routes->get('produk/edit/(:num)',  'Admin\PremiumController::produkForm/$1');
        $routes->post('produk/save',        'Admin\PremiumController::produkSave');
        $routes->post('produk/save/(:num)', 'Admin\PremiumController::produkSave/$1');
        $routes->get('produk/delete/(:num)','Admin\PremiumController::produkDelete/$1');

        // Durasi
        $routes->get('durasi',              'Admin\PremiumController::durasi');
        $routes->get('durasi/create',       'Admin\PremiumController::durasiForm');
        $routes->get('durasi/edit/(:num)',  'Admin\PremiumController::durasiForm/$1');
        $routes->post('durasi/save',        'Admin\PremiumController::durasiSave');
        $routes->post('durasi/save/(:num)', 'Admin\PremiumController::durasiSave/$1');
        $routes->get('durasi/delete/(:num)','Admin\PremiumController::durasiDelete/$1');
    });

    $routes->group('otp', static function ($routes) {
        $routes->get('/',             'Admin\OtpController::index');
        $routes->get('create',        'Admin\OtpController::form');
        $routes->get('edit/(:num)',   'Admin\OtpController::form/$1');
        $routes->post('save',         'Admin\OtpController::save');
        $routes->post('save/(:num)',  'Admin\OtpController::save/$1');
        $routes->get('toggle/(:num)', 'Admin\OtpController::toggle/$1');
        $routes->get('delete/(:num)', 'Admin\OtpController::delete/$1');
    });

    $routes->group('statistik', static function ($routes) {
        $routes->get('/',            'Admin\StatistikController::index');
        $routes->get('create',       'Admin\StatistikController::form');
        $routes->get('edit/(:num)',  'Admin\StatistikController::form/$1');
        $routes->post('save',        'Admin\StatistikController::save');
        $routes->post('save/(:num)', 'Admin\StatistikController::save/$1');
        $routes->get('delete/(:num)','Admin\StatistikController::delete/$1');
    });

    $routes->group('client', static function ($routes) {
        $routes->get('/',            'Admin\ClientController::index');
        $routes->get('create',       'Admin\ClientController::form');
        $routes->get('edit/(:num)',  'Admin\ClientController::form/$1');
        $routes->post('save',        'Admin\ClientController::save');
        $routes->post('save/(:num)', 'Admin\ClientController::save/$1');
        $routes->get('delete/(:num)','Admin\ClientController::delete/$1');
    });

    $routes->group('promo', static function ($routes) {
        $routes->get('/',            'Admin\PromoController::index');
        $routes->get('create',       'Admin\PromoController::form');
        $routes->get('edit/(:num)',  'Admin\PromoController::form/$1');
        $routes->post('save',        'Admin\PromoController::save');
        $routes->post('save/(:num)', 'Admin\PromoController::save/$1');
        $routes->get('delete/(:num)','Admin\PromoController::delete/$1');
    });

    $routes->get('pengaturan',       'Admin\PengaturanController::index');
    $routes->post('pengaturan/save', 'Admin\PengaturanController::save');
});
