<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('times.index');
});

Auth::routes([ 'register' => false ]);

Route::get('/times', 'TimesController@index')->name('times.index');
Route::get('/times/{time}/stop', 'TimesController@stop')->name('times.stop');

Route::get('/reports', 'ReportsController@index')->name('reports.index');
Route::get('/reports/{code}/shared', 'SharedReportsController@show')->name('reports.shared.show');
Route::get('/reports/{code}/shared/csv', 'SharedReportsController@export')->name('reports.shared.export');

Route::get('/projects/{status?}', 'ProjectsController@index')->name('projects.index')->where('status', 'archived');
Route::delete('/projects/{project}', 'ProjectsController@archive')->name('projects.archive');
Route::patch('/projects/{project}', 'ProjectsController@restore')->name('projects.restore');

Route::get('/activities', 'ActivitiesController@index')->name('activities.index');
Route::get('/users', 'UsersController@index')->name('users.index');
