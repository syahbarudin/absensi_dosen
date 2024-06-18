<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('register', 'AuthController::register');
$routes->post('login', 'AuthController::login');
$routes->get('auth/logout', 'AuthController::logout');
$routes->get('profil', 'ProfilController::index');
$routes->get('home', 'HomeController::index');
$routes->get('dosen', 'DosenController::index');
$routes->post('dosen/absen', 'DosenController::absen');