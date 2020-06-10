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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Rotas criadas pelo 'auth' do laravel
Auth::routes();

// ROTA PARA ACESSAR ÁREA do USUÁRIO COMUM LOGADO
Route::get('/home', 'HomeController@index')->name('home');

// ROTA PARA ACESSAR ÁREA RESTRITA de ADMIN
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

// ROTAS de LOGIN de ADMIN
Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');


