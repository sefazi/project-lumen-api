<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Poli
$router->get('/poli', 'Poli@index');
$router->post('/poli/input', 'Poli@store');
$router->get('/poli/{id}', 'Poli@show');
$router->delete('/poli/{id}', 'Poli@destroy');

// Pegawai
$router->get('/pegawai', 'Pegawai@index');
$router->post('/pegawai/input', 'Pegawai@store');
$router->get('/pegawai/{id}', 'Pegawai@show');
$router->delete('/pegawai/{id}', 'Pegawai@destroy');

// Pasien
$router->get('/pasien', 'Pasien@index');
$router->post('/pasien/input', 'Pasien@store');
$router->get('/pasien/{id}', 'Pasien@show');
$router->delete('/pasien/{id}', 'Pasien@destroy');
