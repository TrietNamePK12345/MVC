<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/src/configs.php';

use App\src\core\Route as Route;

// Client
Route::get('/', 'home');

// Admin

Route::get('/dashboard', 'dashboard');

Route::get('/login', 'login');

Route::get('/register', 'register');


Route::run();