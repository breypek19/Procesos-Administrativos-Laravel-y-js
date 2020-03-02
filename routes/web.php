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

Auth::routes(['register' => false]);


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/secre', 'SecreController@index')->name('secre');
Route::get('/tesor', 'TesoController@index')->name('tesor');


Route::prefix('admin')->group(function () {
Route::resource('users', 'UsuariosControllers');
});


Route::prefix('tesor')->group(function () {
    Route::get("/comprobante/ingreso/{id}", "IngresosController@ejecutarPdf")->name("imprimir");
    Route::get("/movimientos/registros", "MovimientosController@mostrar")->name("mostrarMov");
    Route::get("/movimientos/registros/repor", "MovimientosController@report")->name("mostrarRepor");
    Route::get("/movimientos/registros/repor/{id}", "MovimientosController@filtrarRubro")->name("fil");
    Route::get("/movimientos/reportes/ingresos/{id}/{ano?}/{mes?}", "MovimientosController@descargarPdfRubro")->name("descargRubro");
    Route::get("/movimientos/reportes/ingresosDet/{id}/{id_detalle}/{ano?}", "MovimientosController@descargarPdfDetalle")->name("descargDetalle");
    Route::get("/movimientos/registros/repor/{rubro}/{detalle}", "MovimientosController@filtrarDetalle")->name("filDe");
    Route::get("/movimientos/registros/ingresos/diezmo", "MovimientosController@mostrarDiez")->name("diezmo");
    Route::get("/movimientos/reportes/ingresosGeneral/{mes}", "MovimientosController@descargarInfoGeneralPdf")->name("general");
    Route::get("/movimientos/reportes/ingresosGeneral/{inicio}/{fin}", "MovimientosController@descargarInfoGeneralMesesPdf")->name("generalmeses");
    Route::get("/movimientos/reportes/liquidardiezmo/{cadena}/{cadena1}", "MovimientosController@descargarLiquidacionPdf")->name("diezmoL");
    Route::get("/movimientos/registros/datos", "MovimientosController@registros")->name("registros");
   Route::resource('ingresos', 'IngresosController');
   Route::post('ingresos/general', 'IngresosController@general')->name('ingresos.general');
Route::post('/ingresos/detalle', 'IngresosController@detalle')->name('ingresos.detalle');
Route::get('/ingresos/detalleDiezmo/{cadena}', 'IngresosController@detalleDiezmo')->name('detalle.Diezmo');
Route::post('/ingresos/diezmoGeneral', 'IngresosController@Diezmogeneral')->name('general.Diezmo');

//egresos 
Route::resource('egresos', 'EgresosController');
route::post('egresos/Rubro', 'EgresosController@storeRubro')->name("Rubro.egreso");
route::post('/egresos/Detalle', 'EgresosController@storeDetalle')->name("Detalle.egreso");
route::get('/egresos/comprobante/{id}', 'EgresosController@comprobanteEgreso')->name("comprobante.Egreso");
Route::get("/movimientos/registros/datos", "MovimientosController@registros")->name("registros");
Route::get("/movimientos/registros/egresos.reporte/", "MovimientosEgresosController@mostrarVistaParaFiltrar")->name("reportes.egresos");

//reportes o listas de egresos
Route::get("/movimientos/egresos/registros/datos", "MovimientosEgresosController@listarEnDatatable")->name("registros");
Route::get("/movimientos/lista/egresos", "MovimientosEgresosController@mostrarVistaDatatable")->name("vista.Egresos");
Route::get("/movimientos/registros/egresos/rubro/{idrubro}", "MovimientosEgresosController@filtrarRubro" )->name("traer.Detalles"); 
Route::get("/movimientos/registros/egresos/rubro/detalle/{idrubro}/{idetalle}", "MovimientosEgresosController@filtrarRubroDetalle" )->name("traer.RubroDetalle"); 
Route::get("/movimientos/reportes/pdfRubro/{id}/{ano?}/{mes?}", "MovimientosEgresosController@reporPdfRubro")->name("rubroPdf");
Route::get("/movimientos/reportes/pdfDetalle/{idR}/{idD}/{ano?}", "MovimientosEgresosController@reporPdfDetalle")->name("detallePdf");
});


Route::prefix("secre")->group(function(){
Route::resource('MovSecretaria', 'SecreMovimientosController'); 
Route::post("MovSecretaria/GuardarProfesion", "SecreMovimientosController@guardarProfesion")->name("guard.profesion") ;
Route::get("Reportes", "SecreMovimientosController@mostrarVistaReportes")->name("vista.reportes");
Route::get("Reportes/VistaGeneral", "SecreMovimientosController@showVistaDatatable")->name("vista.ReporteGeneral");
Route::get("Reportes/reporteGeneral", "SecreMovimientosController@DatosEnDatatable")->name("reporte.General");
Route::get("Reportes/BautizadosGeneral", "SecreMovimientosController@SoloBautizadosPdf")->name("Bautizados.general");
Route::get("Reportes/JovenesBautizados", "SecreMovimientosController@JovenesBautizadosPdf")->name("jovenes.bautismo");
Route::get("Reportes/DorcasBautizadas", "SecreMovimientosController@DorcasBautizadasPdf")->name("dorcas.bautismo");
Route::get("Reportes/Visitas", "SecreMovimientosController@visitasPdf")->name("visitas");
Route::get("Reportes/SinEpiritu", "SecreMovimientosController@MiembrosSinEPdf")->name("miembros.SinEpiritu");
Route::get("Reportes/Caballeros", "SecreMovimientosController@caballerosPdf")->name("miembros.caballeros");
Route::get("Reportes/ReportCantidad", "SecreMovimientosController@cantidad")->name("cantidad");

//asistencais
Route::resource('Asistencias', 'SecreAsistenciasController');
Route::get('Asis/verificar/{ano}/{mes}/{dia}/{diasemana}', 'SecreAsistenciasController@verificar')->name("verificar"); 

});

//Route::resource('ingresos', 'IngresosController');





