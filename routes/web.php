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
    return view('layouts.app');
});

//invitados rutas a ver
Route::group(['middleware' => ['guest']], function(){
	Route::get('/', 'Auth\LoginController@showLoginForm');
	Route::post('/login', 'Auth\LoginController@login')->name('login');

});
//acceso a usuarios logueados
Route::group(['middleware' => 'auth'], function(){
	Route::resource('dashboard', 'DashboardController');
	Route::resource('almacen', 'WarehouseController');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::resource('clientes', 'ClientController');
	Route::post('clientes/status/{id}', 'ClientController@status');
	Route::resource('creditos', 'CreditController');
	Route::post('cuenta_por_cobrar/{credit_id}', 'CreditController@payment')->name('cuenta_por_cobrar');
	Route::resource('departamentos', 'DepartamentController');
	Route::resource('roles', 'RolController');
	Route::resource('usuarios', 'UserController');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::post('departamentos/{id}/asignacion', ['as' => 'assigment', 'uses' => 'DepartamentController@assigment']);
	Route::resource('productos', 'ProductsController');
	Route::post('productos/eliminar/{id}', 'ProductsController@eliminar')->name('eliminar_producto');




	Route::get('produccion/{id}', 'DepartamentController@production')->name('produccion');

	Route::get('produccion/perdida/{id}', 'DepartamentController@productionLost')->name('perdida_produccion');
	Route::post('guardar_perdida', 'DepartamentController@storePerdida')->name('perdida_guardar');




	Route::post('guardar_produccion', 'DepartamentController@storeProduction')->name('produccion_guardar');
	Route::post('estatus_cambiar/{id}', 'DepartamentController@changeStatus')->name('cambiar_estatus');
	Route::get('perdida/{id}', 'DepartamentController@lost')->name('perdida');
	Route::resource('ventas', 'SaleController');
	Route::get('ventas/nueva_venta', 'SaleController@newSale')->name('nueva_venta');
	Route::post('/clientes/autocomplete', 'SaleController@autocomplete')->name('clients.getClients');

	Route::get('factura/{id}', 'SaleController@fact')->name('fact_venta');
	Route::get('nota_entrega/{id}', 'SaleController@note')->name('nota_de_entrega');

	Route::resource('pedidos', 'OrderController');
	Route::get('despachos', 'OrderController@sends')->name('despachos');
	Route::resource('reportes', 'ReportController');
	Route::get('venta_del_dia', 'ReportController@sellToday')->name('venta_del_dia');
	Route::post('ventas_fechas/{start}/{end}', 'ReportController@saleForDates')->name('ventas_fechas');
	Route::get('pedidos_del_dia', 'ReportController@ordersDay')->name('pedidos_del_dia');
	Route::post('pedidos_fechas/{start}/{end}', 'ReportController@ordersForDates')->name('pedidos_fechas');


	Route::resource('empleados', 'EmployeController');
	Route::resource('bancos', 'BankController');



	
	Route::group(['middleware' => 'Vendedor'], function(){
		Route::resource('ventas', 'SaleController');
		Route::get('ventas/nueva_venta', 'SaleController@newSale')->name('nueva_venta');
		Route::post('/clientes/autocomplete', 'SaleController@autocomplete')->name('clients.getClients');
		Route::resource('productos', 'ProductsController');


		//Route::resource('almacen', 'WarehouseController');


	});

});
	//usuarios Administradores rol_id=1
//	Route::group(['middleware' => 'Administrador'], function(){
		
		

//	});
	//usuarios supervisores rol_id = 2
//
	Route::group(['middleware' => 'Supervisor'], function(){

		//Route::resource('almacen', 'WarehouseController');


	});
	//usuarios vendedor rol_id = 3
//	Route::group(['middleware' => 'Vendedor'], function(){

//	});
	//usuarios normales por departamento rol_id = 4
//	Route::group(['middleware' => 'Usuario'], function(){


//	});
	
//});
		//Auth::routes();  se comenta para probar otra configuracion
		//login
		//Route::get('/home', 'HomeController@index')->name('home');
		//
		//
		//
		//
		//
		//