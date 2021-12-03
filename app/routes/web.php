<?php

use App\Router;

// Router::get('/hello', function () {
//     echo 'Hello world!';
// });

Router::get('/', 'App\Controllers\HomeController@index');
Router::get('home', 'App\Controllers\HomeController@index');

Router::get('login', 'App\Controllers\Auth\LoginController@showLoginForm');
Router::post('login', 'App\Controllers\Auth\LoginController@login');

Router::get('/logout', 'App\Controllers\Auth\LoginController@logout');
Router::post('/logout', 'App\Controllers\Auth\LoginController@logout');

Router::get('/register', 'App\Controllers\Auth\RegisterController@showRegisterForm');
Router::post('/register', 'App\Controllers\Auth\RegisterController@register');

Router::get('/address/ward', 'App\Controllers\AddressController@ward');
Router::post('/address/ward/delete', 'App\Controllers\AddressController@deleteWard');

Router::get('/profile', 'App\Controllers\ProfileController@profile');



Router::error(function () {
    echo '404 :: Page not found';
});
