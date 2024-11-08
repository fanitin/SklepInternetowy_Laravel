<?php

use App\Http\Middleware\AdminPanelMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\WorkerPanelMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();


Route::get('/contact', 'App\Http\Controllers\Contact\IndexController')->name('contact.index');


Route::namespace("App\Http\Controllers\Home")->name('home.')->group(function () {
    Route::get('/', 'IndexController');
    Route::get('/home', 'IndexController')->name('index');
});


Route::namespace("App\Http\Controllers\Menu")->prefix('menu')->name('menu.')->group(function () {
    Route::get('/', 'IndexController')->name('index');
    Route::get('/{category}', 'CategoryController')->name('category');
});


Route::namespace('App\Http\Controllers\Cart')->prefix('cart')->name('cart.')->group(function () {
    Route::get('/','IndexController')->name('index');
    Route::post('/add', 'AddController')->name('add');
    Route::get('/deleteAll', 'DeleteAllController')->name('deleteAll');
    Route::post('/deleteDish', 'DeleteDishController')->name('deleteDish');
    Route::post('/deleteChosen', 'DeleteChosenController')->name('deleteChosen');


});


Route::middleware(UserMiddleware::class)->namespace('App\Http\Controllers\Order')->prefix('order')->name('order.')->group(function () {
    Route::get('/','IndexController')->name('index');
    Route::post('/pay', 'PayController')->name('pay');
    Route::get('/make', 'MakeController')->name('make');
    Route::post('/make', 'MakeController')->name('make');
});


Route::middleware(UserMiddleware::class)->namespace('App\Http\Controllers\Profile')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/','IndexController')->name('index');
    Route::get('/{order}/cancelOrder', 'CancelOrderController')->name('cancelOrder');
    Route::get('/{order}/show', 'ShowController')->name('order');
});


Route::middleware(AdminPanelMiddleware::class)->namespace("App\Http\Controllers\Admin")->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', 'IndexController')->name('index');
    Route::get('/profile', 'ProfileController')->name('profile');


    Route::namespace('User')->prefix('user')->name('user.')->group(function () {
        Route::get('/', 'IndexController')->name('index');
        Route::post('/search', 'SearchController')->name('search');
        Route::post('/sort', 'SortController')->name('sort');
        Route::get('/{user}/show', 'ShowController')->name('show');
        Route::post('/{user}/edit', 'EditController')->name('edit');
    });
});


Route::middleware(WorkerPanelMiddleware::class)->namespace("App\Http\Controllers\Worker")->prefix('worker')->name('worker.')->group(function () {
    Route::get('/home', 'IndexController')->name('index');
    Route::get('/profile', 'ProfileController')->name('profile');

    Route::namespace('Category')->prefix('category')->name('category.')->group(function () {
        Route::get('/','IndexController')->name('index');
        Route::post('/search', 'SearchController')->name('search');
        Route::post('/sort', 'SortController')->name('sort');
        Route::delete('/{dishCategory:id}/delete', 'DeleteController')->name('destroy');
        Route::get('/add', 'StoreController@addSender')->name('add');
        Route::post('/store', 'StoreController@store')->name('store');
        Route::get('/{dishCategory:id}/edit', 'SendController')->name('send');
        Route::patch('/', 'EditController')->name('edit');
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


    Route::namespace('Order')->prefix('order')->name('order.')->group(function () {
        Route::get('/','IndexController')->name('index');
        Route::post('/search', 'SearchController')->name('search');
        Route::post('/sort', 'SortController')->name('sort');
        Route::get('/{order}/show', 'ShowController@index')->name('show');
        Route::patch('/{order}', 'ShowController@changeStatus')->name('changeStatus');
        Route::get('/order/{user}/show', 'ShowUserController')->name('showUser');
    });


    Route::namespace('Payment')->prefix('payment')->name('payment.')->group(function () {
        Route::get('/','IndexController')->name('index');
        Route::post('/search', 'SearchController')->name('search');
        Route::post('/sort', 'SortController')->name('sort');
    });
});
