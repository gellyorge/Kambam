<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homePage');
});

Route::get('/create', function () {
    return view('formularioPage');
});

Route::get('/dashboard', function () {
    return view('dashboardPage');
});