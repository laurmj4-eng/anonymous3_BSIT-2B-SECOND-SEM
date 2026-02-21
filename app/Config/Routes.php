<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/auth', 'Auth::auth');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/logout', 'Auth::logout');

// User Accounts routes
$routes->get('/users', 'Users::index');
$routes->post('users/save', 'Users::save');
$routes->get('users/edit/(:segment)', 'Users::edit/$1');
$routes->post('users/update', 'Users::update');
$routes->delete('users/delete/(:num)', 'Users::delete/$1');
$routes->post('users/fetchRecords', 'Users::fetchRecords');


/// Teacher routes
$routes->get('/teacher', 'Teacher::index');
$routes->post('teacher/save', 'Teacher::save');
$routes->get('teacher/edit/(:segment)', 'Teacher::edit/$1');
$routes->post('teacher/update', 'Teacher::update');
$routes->delete('teacher/delete/(:num)', 'Teacher::delete/$1');
$routes->post('teacher/fetchRecords', 'Teacher::fetchRecords');

// teacher routes
$routes->get('/student', 'Student::index');
$routes->post('student/save', 'Student::save');
$routes->get('student/edit/(:segment)', 'Student::edit/$1');
$routes->post('student/update', 'Student::update');
$routes->delete('student/delete/(:num)', 'Student::delete/$1');
$routes->post('student/fetchRecords', 'Student::fetchRecords');


// staff
$routes->get('/staff', 'Staff::index');
$routes->post('staff/save', 'Staff::save');
$routes->get('staff/edit/(:segment)', 'Staff::edit/$1');
$routes->post('staff/update', 'Staff::update');
$routes->delete('staff/delete/(:num)', 'Staff::delete/$1');
$routes->post('staff/fetchRecords', 'Staff::fetchRecords');

// parents routes
$routes->get('/parents', 'Parents::index');
$routes->post('parents/save', 'Parents::save');
$routes->get('parents/edit/(:segment)', 'Parents::edit/$1');
$routes->post('parents/update', 'Parents::update');
$routes->delete('parents/delete/(:num)', 'Parents::delete/$1');
$routes->post('parents/fetchRecords', 'Parents::fetchRecords');


// Logs routes for admin
$routes->get('/log', 'Logs::log');