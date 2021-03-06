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

Route::get('/', function () {
    return redirect()->route('organizations.index');
});

Route::resource('/organizations', 'OrganizationsController');

Route::resource('/jobsites', 'JobsitesController');

Route::post('/organizations/{organization}/contact', 'OrganizationContactsController@store');
Route::patch('/organizations/{organization}/contact', 'OrganizationContactsController@update');

Route::get('/jobsites/{jobsite}/map', 'JobsiteMapsController@show');
Route::get('/jobsites/{jobsite}/map/edit', 'JobsiteMapsController@edit');
Route::post('jobsites/{jobsite}/map', 'JobsiteMapsController@store');
Route::patch('jobsites/{jobsite}/map', 'JobsiteMapsController@update');