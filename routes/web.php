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
use sis_ventas\Empresa;
Route::get('/', function () {
    $empresa = Empresa::first();
    return view('auth.login',compact('empresa'));
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
    // HOME
    Route::get('/home', 'HomeController@index')->name('home');

    // USUARIOS
    Route::get('users','PersonaController@index')->name('users.index');

    Route::get('users/create','PersonaController@create')->name('users.create');

    Route::get('users/show/{persona}','PersonaController@show')->name('users.show');

    Route::get('users/edit/{persona}','PersonaController@edit')->name('users.edit');

    Route::post('users/store','PersonaController@store')->name('users.store');

    Route::put('users/update/{persona}','PersonaController@update')->name('users.update');

    Route::delete('users/destroy/{persona}','PersonaController@destroy')->name('users.destroy');
    
    // Configuración de cuenta
        // contraseña
    // Route::GET('users/configurar/cuenta/{user}','DatosUsuarioController@config_cuenta')->name('users.config');
    // Route::PUT('users/configurar/cuenta/update/{user}','DatosUsuarioController@cuenta_update')->name('users.config_update');
    //     // foto de perfil
    // Route::POST('users/configurar/cuenta/update/foto/{user}','DatosUsuarioController@cuenta_update_foto')->name('users.config_update_foto');

    // MEDIDAS
    Route::get('medidas','MedidaController@index')->name('medidas.index');

    Route::get('medidas/create','MedidaController@create')->name('medidas.create');

    Route::get('medidas/show/{medida}','MedidaController@show')->name('medidas.show');

    Route::get('medidas/edit/{medida}','MedidaController@edit')->name('medidas.edit');

    Route::post('medidas/store','MedidaController@store')->name('medidas.store');

    Route::put('medidas/update/{medida}','MedidaController@update')->name('medidas.update');

    Route::delete('medidas/destroy/{medida}','MedidaController@destroy')->name('medidas.destroy');
});
