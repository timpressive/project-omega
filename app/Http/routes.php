<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@index');

// Login admin
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

// access game
Route::post('auth/access', 'Auth\AuthController@access');

// Control panel page
Route::get('overzicht', 'PagesController@overview');

Route::group(['middleware' => 'game'], function () {

	Route::get('pin-code', 'GamesController@pincode');
	Route::get('decryptie/level-{level}', 'GamesController@mastermind');
	Route::get('game/decrypt-level', 'GamesController@decryptlevel');

	Route::get('console', 'GamesController@console');
	Route::get('netcat', "GamesController@console");

});

Route::group(['middleware' =>  'auth', 'prefix' => 'admin'], function() {

	Route::get('/', 'AdminController@index');
	Route::get('dashboard', 'AdminController@index');
	Route::get('game', 'AdminController@game');
	Route::get('settings', 'AdminController@settings');
	Route::get('instructions', 'AdminController@instructions');

	Route::post('game/setcodes', 'AdminController@setcodes');
	Route::post('game/setconsole', 'AdminController@setconsole');
	Route::post('game/setduration', 'AdminController@setduration');
	Route::post('game/resetconsole', 'AdminController@resetconsole');

});

Route::group(['prefix' => 'ajax'], function() {

	Route::group(['middleware' => 'game'], function () {

		Route::get('keypad', 'GamesController@keypad');
		Route::get('file/{name}', 'GamesController@file');
		Route::get('get-command', 'GamesController@getcommand');

		Route::get('poll', 'GamesController@poll');
		Route::get('win', 'GamesController@win');

	});

	Route::group(['middleware' => 'auth'], function () {

		Route::get('start-game', 'AdminController@startgame');
		Route::get('stop', 'AdminController@stopgame');

		Route::group(['middleware' => 'game'], function () {

			Route::get('pause-game', 'AdminController@pausegame');
			Route::get('penalty', 'AdminController@penalty');
			Route::get('get-active', 'AdminController@started');
			Route::get('get-paused', 'AdminController@paused');

		});

	});

});
