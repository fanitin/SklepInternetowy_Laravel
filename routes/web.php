<?php

use App\Http\Middleware\AdminPanelMiddleware;
use App\Http\Middleware\WorkerPanelMiddleware;
use Illuminate\Support\Facades\Route;


Auth::routes();


Route::namespace("App\Http\Controllers\Home")->name('home.')->group(function () {
    Route::get('/', 'IndexController');
    Route::get('/home', 'IndexController')->name('index');
});


Route::middleware(AdminPanelMiddleware::class)->namespace("App\Http\Controllers\Admin")->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', 'IndexController')->name('index');
});


Route::middleware(WorkerPanelMiddleware::class)->namespace("App\Http\Controllers\Worker")->prefix('worker')->name('worker.')->group(function () {
    Route::get('/home', 'IndexController')->name('index');

    Route::namespace('Category')->prefix('category')->name('category.')->group(function () {
        Route::get('/','IndexController')->name('index');
        Route::post('/search', 'SearchController')->name('search');
        Route::post('/sort', 'SortController')->name('sort');
    });

    Route::namespace('Dish')->prefix('dish')->name('dish.')->group(function () {
        Route::get('/','IndexController')->name('index');
        Route::post('/search', 'SearchController')->name('search');
        Route::post('/sort', 'SortController')->name('sort');
    });
});