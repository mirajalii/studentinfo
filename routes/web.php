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
    return view('welcome');
});

Route::get('/add-student/', function () {
    return view('welcome');
});


// Route::resource('/add-student/','SudentsInfoController');

Route::get('/add-student/create', 'SudentsInfoController@create');

Route::post('/add-records', 'SudentsInfoController@store')->name('addRecord');

Route::get('/records', 'SudentsInfoController@list')->name('lists');

Route::get('/single-student/{id}', 'SudentsInfoController@show')->name('single');;

Route::get('/edit-records/{id}', 'SudentsInfoController@edit')->name('edit');

Route::post('/update-records/{id}', 'SudentsInfoController@update')->name('update');

Route::get('/delete-records/{id}', 'SudentsInfoController@desktroy')->name('delete');

Route::delete('/edit-records/{id}', 'SudentsInfoController@edit')->name('edit');

Route::get('/search', 'SudentsInfoController@studentRecords')->name('eseaarch');

Route::get('/image-delete/{id}', 'SudentsInfoController@studentRecords')->name('imageDelete');


