<?php

/**
 * Frontend Controllers.
 */

get('/old', 'FrontendController@home')->name('old');
get('macros', 'FrontendController@macros');
get('/', 'FrontendController@home')->name('home');
get('/root', 'FrontendController@home');

use App\Models\Project;
use App\Models\Task;

Route::model('projects', 'App\Models\Project');
Route::model('tasks', 'App\Models\Task');

Route::bind('tasks', function($value, $route) {
	return App\Models\Task::whereSlug($value)->first();
});
Route::bind('projects', function($value, $route) {
	if (is_int($value))
		return App\Models\Project::whereId($value)->first();
	else
		return App\Models\Project::whereSlug($value)->first();
});

Route::resource('projects', 'ProjectsController');
Route::resource('projects.tasks', 'TasksController');

/*
 * These frontend controllers require the user to be logged in
 */
$router->group(['middleware' => 'auth'], function () {
    get('dashboard', 'DashboardController@index')->name('frontend.dashboard');
    get('profile/edit', 'ProfileController@edit')->name('frontend.profile.edit');
    patch('profile/update', 'ProfileController@update')->name('frontend.profile.update');
    get('projects/create', 'ProjectsController@create')->name('projects.create');
});
