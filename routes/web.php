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
        Route::delete('/{dish_category}/delete', 'DeleteController')->name('destroy');
        Route::get('/add', 'StoreController@addSender')->name('add');
        Route::post('/store', 'StoreController@store')->name('store');
        Route::get('/{dish_category}/edit', 'EditController@sender')->name('send');
        Route::patch('/{dish_category}', 'EditController@edit')->name('edit');
    });

    Route::namespace('Dish')->prefix('dish')->name('dish.')->group(function () {
        Route::get('/','IndexController')->name('index');
        Route::post('/search', 'SearchController')->name('search');
        Route::post('/sort', 'SortController')->name('sort');
        Route::delete('/{dish}/delete', 'DeleteController')->name('destroy');
        Route::get('/{dish}/show', 'ShowController')->name('show');
        Route::get('/add', 'StoreController@addSender')->name('add');
        Route::post('/store', 'StoreController@store')->name('store');
        Route::get('/{dish}/edit', 'EditController@sender')->name('send');
        Route::patch('/{dish}/show', 'EditController@edit')->name('edit');
    });
});