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
Route::get('/resource',function (){
    return response()->download(public_path('resource.pdf'), '教学资源');
});
Route::resource('/', 'IndexController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/student/info', 'StudentController@info');
Route::resource('/student', 'StudentController');
Route::get('/scholarship', 'StudentController@scholarship');
Route::post('/scholarship/form', 'StudentController@forms');
Route::get('/ceshi', function (){
    return view('student/show');
});
