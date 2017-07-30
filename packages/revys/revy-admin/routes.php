<?php

Route::group([
	'prefix' => config('revy.admin.path'), 
	'namespace' => '\Revys\RevyAdmin\App\Http\Controllers',
	'middleware' => ['web', 'admin'],
	'as' => 'admin::',
], function () {
	if (request()->segment(1) == config('revy.admin.path'))
		\Revys\RevyAdmin\App\Providers\RevyAdminServiceProvider::initProviders();
		
	// Variables
	$locale = request()->segment(2);

	// Core routes
	Route::get('', config('revy.admin.default_route'));

	// Routes
	Route::group(['prefix' => $locale, 'middleware' => 'admin_lang'], function () {

		// Default route
		Route::get('', config('revy.admin.default_route'))->name('home');

		// Routes
		// ========================================================

		// Login
		Route::group(['as' => 'login::'], function () {
			Route::get('login', 'AuthController@login')->name('login-form');
			Route::post('login', 'AuthController@signin')->name('signin');
			Route::get('logout', 'AuthController@logout')->name('logout');
		});

		// Admin Settings
		Route::get('settings', function(){
			abort(404);
		})->name('settings');



		// List Path
		Route::get('{controller}', function($controller){
			$class = app()->make('\Revys\RevyAdmin\App\Http\Controllers\\' . studly_case($controller) . 'Controller');
			return $class->callAction('index', $parameters = []);
		})->where([
			'controller' => '\w+'
		])->name('list');
		
		// Edit Path
		Route::get('{controller}/edit/{id}', function($controller, $id){
			$class = app()->make('\Revys\RevyAdmin\App\Http\Controllers\\' . studly_case($controller) . 'Controller');
			return $class->callAction('edit', $parameters = [$id]);
		})->where([
			'controller' => '\w+'
		])->name('edit');

		// Update Path
		Route::post('{controller}/update/{id}', function($controller, $id){
			$class = app()->make('\Revys\RevyAdmin\App\Http\Controllers\\' . studly_case($controller) . 'Controller');
			return $class->callAction('update', $parameters = [$id]);
		})->where([
			'controller' => '\w+'
		])->name('update');

		// Create Path
		Route::get('{controller}/create', function($controller){
			$class = app()->make('\Revys\RevyAdmin\App\Http\Controllers\\' . studly_case($controller) . 'Controller');
			return $class->callAction('create', $parameters = []);
		})->where([
			'controller' => '\w+',
		])->name('create');
		
		// Insert Path
		Route::post('{controller}/insert', function($controller){
			$class = app()->make('\Revys\RevyAdmin\App\Http\Controllers\\' . studly_case($controller) . 'Controller');
			return $class->callAction('update', $parameters = []);
		})->where([
			'controller' => '\w+'
		])->name('insert');

		// Base Path
		Route::get('{controller}/{action}', function($controller, $action = 'index'){
			$class = app()->make('\Revys\RevyAdmin\App\Http\Controllers\\' . studly_case($controller) . 'Controller');
			return $class->callAction($action, $parameters = []);
		})->where([
			'controller' => '\w+',
			'action' => '\w{0,}',
		])->name('path');
	});

});