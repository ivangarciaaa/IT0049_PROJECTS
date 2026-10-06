<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::index');
$routes->get('/services', 'Services::index');
$routes->match(['get', 'post'], '/contact', 'Contact::index');
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::create');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::authenticate');
$routes->post('/logout', 'Login::logout');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/account/new', 'Dashboard::newAccount');
$routes->post('/dashboard/account', 'Dashboard::createAccount');
$routes->get('/dashboard/account/(:num)', 'Dashboard::viewAccount/$1');
$routes->get('/dashboard/account/(:num)/edit', 'Dashboard::editAccount/$1');
$routes->post('/dashboard/account/(:num)/update', 'Dashboard::updateAccount/$1');
$routes->post('/dashboard/account/(:num)/delete', 'Dashboard::deleteAccount/$1');
