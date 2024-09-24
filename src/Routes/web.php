<?php
use Illuminate\Support\Facades\Route; 
Route::group(['namespace' => 'Lara\Installer\Http\Controllers'], function(){
	Route::group(['prefix' => 'install', 'middleware' => ['installer']], function() {
		Route::get('/', function(){ return view('Installer::welcome'); });
		Route::get('requirements','RequirementsController@requirements');
		Route::get('database', 'DatabaseController@create');
		Route::get('/database-fill', function(){ return view('Installer::database_fill'); });
		Route::get('seedmigrate', 'DatabaseController@seedMigrate');
		Route::post('database', 'DatabaseController@store');
	});
});
 
?>