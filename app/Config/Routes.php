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
$routes->get('d_profil', 'D_ProfilController::index');
$routes->get('absen_dosen', 'StatusController::index');
$routes->get('janji', 'JanjiTemuController::index');
$routes->post('janji/create', 'JanjiTemuController::create');
$routes->get('home', 'HomeController::index');
$routes->get('d_home', 'D_HomeController::index');
$routes->get('dosen', 'DosenController::index');
$routes->post('absen/absen', 'AbsenController::absen');
$routes->get('/d_auth', 'D_AuthController::index');
$routes->post('d/register', 'D_AuthController::register');
$routes->post('d/login', 'D_AuthController::login');
$routes->get('d/logout', 'D_AuthController::logout');
