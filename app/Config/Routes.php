<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('register', 'AuthController::register');
$routes->post('login', 'AuthController::login');
$routes->get('auth/logout', 'AuthController::logout');
$routes->get('profil', 'ProfilController::index', ['as' => 'profil']);
$routes->get('d_profil', 'D_ProfilController::index');
$routes->get('absen_dosen', 'StatusController::index');
$routes->get('home', 'HomeController::index');
$routes->get('d_home', 'D_HomeController::index');
$routes->get('d_absen', 'DosenController::index');
$routes->post('absen/absen', 'AbsenController::absen');
$routes->get('/d_auth', 'D_AuthController::index');
$routes->post('d/register', 'D_AuthController::register');
$routes->post('d/login', 'D_AuthController::login');
$routes->get('d/logout', 'D_AuthController::logout');
$routes->get('profil/edit_profile', 'ProfilController::edit_profile', ['as' => 'edit_profile']);
$routes->post('profil/update_profile', 'ProfilController::update_profile', ['as' => 'update_profile']);
$routes->group('dosen', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('janji_temu', 'JanjiTemuController::dosenJanjiTemu');
    $routes->get('janji_temu/updateStatus/(:num)/(:alpha)', 'JanjiTemuController::updateStatus/$1/$2');
});

