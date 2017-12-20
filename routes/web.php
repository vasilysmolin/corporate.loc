<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/','IndexController',[
    'only'=>['index'],
    'names'=> [
        'index'=>'home'
    ]

]);
// почему для них он создавал ресурсы?
Route::resource('portfolios','PortfolioController',[
    'parameters' =>[
        'portfolios' => 'alias'
    ]
]);

Route::resource('articles','ArticlesController',[
        'parameters' =>[
            'articles' => 'alias'
        ]
    ]);

// для странциы категорий?
Route::get('articles/cat/{cat_alias}',['uses'=>'ArticlesController@index', 'as'=>'articlesCat']);

Route::resource('comment','CommentController',['only' =>['store']]);

//php artisan make:auth
Route::get('login','Auth\LoginController@showLoginForm');

Route::auth('login', 'Auth\LoginController@showLoginForm');

Route::get('logout','Auth\LoginController@login');

Route::get('logout','Auth\LoginController@logout');

Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){

    // admin
    Route::get('/',['uses'=>'Admin\IndexController@index', 'as' => 'adminIndex']);
    Route::resource('/articles','Admin\ArticleController');

});



