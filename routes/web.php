<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return view('welcome');
});
Route::get('/porto', function () {
    return view('porto');
});
Route::get('/profile ', function () {
    return view('article');
});

