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

Route::get('solicitudes/create','SolicitudController@create')->name('solicitudes.create');
    
Route::POST('solicitudes/store','SolicitudController@store')->name('solicitudes.store');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    // HOME
    Route::get('/home', 'HomeController@index')->name('home');

    // USUARIOS
    Route::get('users','EmpleadoController@index')->name('users.index');

    Route::get('users/edit/{empleado}','EmpleadoController@edit')->name('users.edit');

    Route::post('users/store','EmpleadoController@store')->name('users.store');

    Route::put('users/update/{empleado}','EmpleadoController@update')->name('users.update');

    Route::PUT('configurar/cuenta/update/{user}','EmpleadoController@cuenta_update')->name('users.config_update');
        // foto de perfil
    Route::POST('configurar/cuenta/update/foto/{user}','EmpleadoController@cuenta_update_foto')->name('users.config_update_foto');

    // DESCUENTOS
    Route::get('descuentos','DescuentoController@index')->name('descuentos.index');

    Route::get('descuentos/create','DescuentoController@create')->name('descuentos.create');

    Route::get('descuentos/show/{descuento}','DescuentoController@show')->name('descuentos.show');

    Route::get('descuentos/edit/{descuento}','DescuentoController@edit')->name('descuentos.edit');

    Route::post('descuentos/store','DescuentoController@store')->name('descuentos.store');

    Route::put('descuentos/update/{descuento}','DescuentoController@update')->name('descuentos.update');

    Route::delete('descuentos/destroy/{descuento}','DescuentoController@destroy')->name('descuentos.destroy');

    Route::get('descuentos/info','DescuentoController@info')->name('descuentos.info');

    // PRODUCTOS
    Route::get('productos','ProductoController@index')->name('productos.index');

    Route::get('productos/create','ProductoController@create')->name('productos.create');

    Route::get('productos/show/{producto}','ProductoController@show')->name('productos.show');

    Route::get('productos/edit/{producto}','ProductoController@edit')->name('productos.edit');

    Route::post('productos/store','ProductoController@store')->name('productos.store');

    Route::post('productos/ingreso/{producto}','ProductoController@ingreso')->name('productos.ingreso');

    Route::put('productos/update/{producto}','ProductoController@update')->name('productos.update');

    Route::delete('productos/destroy/{producto}','ProductoController@destroy')->name('productos.destroy');

    Route::get('productos/infoProducto/{producto}','ProductoController@infoProducto')->name('productos.infoProducto');

    Route::get('masVendidos','ProductoController@masVendidos')->name('productos.masVendidos');

    Route::get('estadisticas','ProductoController@estadisticas')->name('productos.estadisticas');

    // PROMOCIONES
    Route::get('promociones','PromocionController@index')->name('promociones.index');

    Route::get('promociones/create','PromocionController@create')->name('promociones.create');

    Route::get('promociones/show/{promocion}','PromocionController@show')->name('promociones.show');

    Route::get('promociones/edit/{promocion}','PromocionController@edit')->name('promociones.edit');

    Route::post('promociones/store','PromocionController@store')->name('promociones.store');

    Route::put('promociones/update/{promocion}','PromocionController@update')->name('promociones.update');

    Route::delete('promociones/destroy/{promocion}','PromocionController@destroy')->name('promociones.destroy');

    // CLIENTES
    Route::get('clientes','ClienteController@index')->name('clientes.index');

    Route::get('clientes/create','ClienteController@create')->name('clientes.create');

    Route::get('clientes/show/{cliente}','ClienteController@show')->name('clientes.show');

    Route::get('clientes/edit/{cliente}','ClienteController@edit')->name('clientes.edit');

    Route::post('clientes/store','ClienteController@store')->name('clientes.store');

    Route::put('clientes/update/{cliente}','ClienteController@update')->name('clientes.update');

    Route::delete('clientes/destroy/{cliente}','ClienteController@destroy')->name('clientes.destroy');

    Route::get('clientes/habilitar/{cliente}','ClienteController@habilitar')->name('clientes.habilitar');


    // VENTAS
    Route::get('ventas','VentaController@index')->name('ventas.index');

    Route::get('ventas/create','VentaController@create')->name('ventas.create');

    Route::get('ventas/show/{venta}','VentaController@show')->name('ventas.show');

    Route::get('ventas/edit/{venta}','VentaController@edit')->name('ventas.edit');

    Route::post('ventas/store','VentaController@store')->name('ventas.store');


    // SOLICITUD DE CONTRASEÑAS
    Route::get('solicitudes','SolicitudController@index')->name('solicitudes.index');

    Route::POST('solicitudes/asignar/{solicitud}','SolicitudController@asignar')->name('solicitudes.asignar');
});
