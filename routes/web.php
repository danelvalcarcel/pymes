<?php
use Illuminate\Support\Facades\Auth;
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
   return redirect('/login');
});

Auth::routes();
Route::get('/login', function(){
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html');
	if (Auth::check()) {
       return redirect('/home');
}else{
	return view("auth.login");
}
});




Route::resource('Clientes','ClienteController');
Route::get('Clientes/{cedula}/{empresa}','ClienteController@show_fact_cli')->name("Clientes.show_fact_cli");



Route::get('Factura_pdf/{id}','FacturacionController@Factura_pdf')->name("Factura_pdf");
Route::resource('Facturacion','FacturacionController');




Route::resource('User','UserController');

Route::get('Cliente2',"ClienteController@index2")->name("Cliente2.index2");

Route::resource('Productos','ProductosController');
Route::get('Productos/{nomb_prod}/ajax_prod', 'ProductosController@show_comple_prod')->name("ajax_prod");



Route::resource('Facturacion','FacturacionController');


Route::resource("Inventarios","InventarioController");

Route::get('/home', 'HomeController@index')->name('home');



Route::post('/login_auth', 'SistemaController@login_auth')->name('login_auth');
Route::post('/Cambiar_Fecha', 'SistemaController@Cambiar_Fecha')->name('Cambiar_Fecha');
Route::group(['middleware' => ['auth']], function () {
Route::get('/registeruser/{id}/{ruta}/', 'SistemaController@register')->name('registeruser');
Route::post('/User_create', 'SistemaController@User_create')->name('User_create');
Route::post('/User_update', 'SistemaController@User_update')->name('User_update');
Route::get('/All_users', 'SistemaController@All_users')->name('All_users');
Route::post('/delete_users/{id}', 'SistemaController@delete_users')->name('delete_users');
Route::resource('Administracion', 'AdministracionController');
Route::resource('Bancos', 'BancosController');
Route::resource('Cartera', 'CarteraController');
//Route::resource('Clientes', 'ClientesController');
Route::resource('Compras', 'ComprasController');
Route::resource('Contabilidad', 'ContabilidadController');
Route::resource('Maestro', 'MaestroController');






Route::resource('Nomina', 'NominaController');
Route::get('/formulario_tipos_nomina/{id}/{ruta}/', 'NominaController@formulario_tipos_nomina')->name('formulario_tipos_nomina');
Route::post('/tipos_nomina_create', 'NominaController@tipos_nomina_create')->name('tipos_nomina_create');
Route::post('/tipos_nomina_update', 'NominaController@tipos_nomina_update')->name('tipos_nomina_update');
Route::get('/All_tipos_nomina', 'NominaController@All_tipos_nomina')->name('All_tipos_nomina');
Route::post('/delete_tipos_nomina/{id}', 'NominaController@delete_tipos_nomina')->name('delete_tipos_nomina');

Route::get('/formulario_centros_trabajo/{id}/{ruta}/', 'NominaController@formulario_centros_trabajo')->name('formulario_centros_trabajo');
Route::post('/centros_trabajo_create', 'NominaController@centros_trabajo_create')->name('centros_trabajo_create');
Route::post('/centros_trabajo_update', 'NominaController@centros_trabajo_update')->name('centros_trabajo_update');
Route::get('/All_centros_trabajo', 'NominaController@All_centros_trabajo')->name('All_centros_trabajo');
Route::post('/delete_centros_trabajo/{id}', 'NominaController@delete_centros_trabajo')->name('delete_centros_trabajo');


Route::get('/formulario_cargo/{id}/{ruta}/', 'NominaController@formulario_cargo')->name('formulario_cargo');
Route::post('/cargo_create', 'NominaController@cargo_create')->name('cargo_create');
Route::post('/cargo_update', 'NominaController@cargo_update')->name('cargo_update');
Route::get('/All_cargo', 'NominaController@All_cargo')->name('All_cargo');
Route::post('/delete_cargo/{id}', 'NominaController@delete_cargo')->name('delete_cargo');


Route::get('/Sedes', 'SedesController@index')->name('Sedes.index');



Route::get('/formulario_Empleado/{id}/{ruta}/', 'EmpleadoController@formulario_Empleado')->name('formulario_Empleado');
Route::post('/Empleado_create', 'EmpleadoController@Empleado_create')->name('Empleado_create');
Route::post('/Empleado_update', 'EmpleadoController@Empleado_update')->name('Empleado_update');
Route::any('/All_Empleado', 'EmpleadoController@All_Empleado')->name('All_Empleado');
Route::post('/delete_Empleado/{id}', 'EmpleadoController@delete_Empleado')->name('delete_Empleado');
Route::post('/Report_Empleado/', 'EmpleadoController@Report_Empleado')->name('Report_Empleado');
Route::get('/Certificado_Empleado/{id}', 'EmpleadoController@Certificado_Empleado')->name('Certificado_Empleado');


Route::get('/formulario_Incapacidade/{id}/{ruta}/{sede?}', 'IncapacidadeController@formulario_Incapacidade')->name('formulario_Incapacidade');
Route::post('/Incapacidade_create', 'IncapacidadeController@Incapacidade_create')->name('Incapacidade_create');
Route::post('/Incapacidade_update', 'IncapacidadeController@Incapacidade_update')->name('Incapacidade_update');
Route::any('/All_Incapacidade/{sede?}', 'IncapacidadeController@All_Incapacidade')->name('All_Incapacidade');
Route::post('/delete_Incapacidade/{id}', 'IncapacidadeController@delete_Incapacidade')->name('delete_Incapacidade');
Route::post('/Report_Incapacidade/', 'IncapacidadeController@Report_Incapacidade')->name('Report_Incapacidade');


Route::get('/formulario_Arl/{id}/{ruta}/', 'ArlController@formulario_Arl')->name('formulario_Arl');
Route::post('/Arl_create', 'ArlController@Arl_create')->name('Arl_create');
Route::post('/Arl_update', 'ArlController@Arl_update')->name('Arl_update');
Route::get('/All_Arl', 'ArlController@All_Arl')->name('All_Arl');
Route::post('/delete_Arl/{id}', 'ArlController@delete_Arl')->name('delete_Arl');


Route::get('/formulario_Epp/{id}/{ruta}/', 'EppController@formulario_Epp')->name('formulario_Epp');
Route::post('/Epp_create', 'EppController@Epp_create')->name('Epp_create');
Route::post('/Epp_update', 'EppController@Epp_update')->name('Epp_update');
Route::get('/All_Epp', 'EppController@All_Epp')->name('All_Epp');
Route::post('/delete_Epp/{id}', 'EppController@delete_Epp')->name('delete_Epp');


Route::get('/formulario_Retiro/{id}/{ruta}/{sede?}', 'RetiroController@formulario_Retiro')->name('formulario_Retiro');
Route::post('/Retiro_create', 'RetiroController@Retiro_create')->name('Retiro_create');
Route::post('/Retiro_update', 'RetiroController@Retiro_update')->name('Retiro_update');
Route::any('/All_Retiro/{sede?}', 'RetiroController@All_Retiro')->name('All_Retiro');
Route::post('/delete_Retiro/{id}', 'RetiroController@delete_Retiro')->name('delete_Retiro');


Route::get('/formulario_Eps/{id}/{ruta}/', 'EpsController@formulario_Eps')->name('formulario_Eps');
Route::post('/Eps_create', 'EpsController@Eps_create')->name('Eps_create');
Route::post('/Eps_update', 'EpsController@Eps_update')->name('Eps_update');
Route::get('/All_Eps', 'EpsController@All_Eps')->name('All_Eps');
Route::post('/delete_Eps/{id}', 'EpsController@delete_Eps')->name('delete_Eps');






Route::get('/formulario_Puc/{id}/{ruta}/', 'Maestros\PucController@formulario_Puc')->name('formulario_Puc');
Route::post('/Puc_create', 'Maestros\PucController@Puc_create')->name('Puc_create');
Route::post('/Puc_update', 'Maestros\PucController@Puc_update')->name('Puc_update');
Route::get('/All_Puc', 'Maestros\PucController@All_Puc')->name('All_Puc');
Route::post('/delete_Puc/{id}', 'Maestros\PucController@delete_Puc')->name('delete_Puc');


Route::get('/formulario_Sede/{id}/{ruta}/', 'Maestros\SedeController@formulario_Sede')->name('formulario_Sede');
Route::post('/Sede_create', 'Maestros\SedeController@Sede_create')->name('Sede_create');
Route::post('/Sede_update', 'Maestros\SedeController@Sede_update')->name('Sede_update');
Route::get('/All_Sede', 'Maestros\SedeController@All_Sede')->name('All_Sede');
Route::post('/delete_Sede/{id}', 'Maestros\SedeController@delete_Sede')->name('delete_Sede');


Route::get('/formulario_NovedadeSede/{id}/{ruta}/', 'Sedes\NovedadeSedeController@formulario_NovedadeSede')->name('formulario_NovedadeSede');
Route::post('/NovedadeSede_create', 'Sedes\NovedadeSedeController@NovedadeSede_create')->name('NovedadeSede_create');
Route::post('/NovedadeSede_update', 'Sedes\NovedadeSedeController@NovedadeSede_update')->name('NovedadeSede_update');
Route::get('/All_NovedadeSede', 'Sedes\NovedadeSedeController@All_NovedadeSede')->name('All_NovedadeSede');
Route::post('/delete_NovedadeSede/{id}', 'Sedes\NovedadeSedeController@delete_NovedadeSede')->name('delete_NovedadeSede');




Route::get('/formulario_Categoria/{id}/{ruta}/', 'Maestros\CategoriaController@formulario_Categoria')->name('formulario_Categoria');
Route::post('/Categoria_create', 'Maestros\CategoriaController@Categoria_create')->name('Categoria_create');
Route::post('/Categoria_update', 'Maestros\CategoriaController@Categoria_update')->name('Categoria_update');
Route::get('/All_Categoria', 'Maestros\CategoriaController@All_Categoria')->name('All_Categoria');
Route::post('/delete_Categoria/{id}', 'Maestros\CategoriaController@delete_Categoria')->name('delete_Categoria');

Route::get('/formulario_Cliente/{id}/{ruta}/', 'ClienteController@formulario_Cliente')->name('formulario_Cliente');
Route::post('/Cliente_create', 'ClienteController@Cliente_create')->name('Cliente_create');
Route::post('/Cliente_update', 'ClienteController@Cliente_update')->name('Cliente_update');
Route::get('/All_Cliente', 'ClienteController@All_Cliente')->name('All_Cliente');
Route::post('/delete_Cliente/{id}', 'ClienteController@delete_Cliente')->name('delete_Cliente');

Route::get('/formulario_Medida/{id}/{ruta}/', 'Maestros\MedidaController@formulario_Medida')->name('formulario_Medida');
Route::post('/Medida_create', 'Maestros\MedidaController@Medida_create')->name('Medida_create');
Route::post('/Medida_update', 'Maestros\MedidaController@Medida_update')->name('Medida_update');
Route::get('/All_Medida', 'Maestros\MedidaController@All_Medida')->name('All_Medida');
Route::post('/delete_Medida/{id}', 'Maestros\MedidaController@delete_Medida')->name('delete_Medida');




Route::get('/formulario_Fondo/{id}/{ruta}/', 'Bancos\FondoController@formulario_Fondo')->name('formulario_Fondo');
Route::post('/Fondo_create', 'Bancos\FondoController@Fondo_create')->name('Fondo_create');
Route::post('/Fondo_update', 'Bancos\FondoController@Fondo_update')->name('Fondo_update');
Route::get('/All_Fondo', 'Bancos\FondoController@All_Fondo')->name('All_Fondo');
Route::post('/delete_Fondo/{id}', 'Bancos\FondoController@delete_Fondo')->name('delete_Fondo');



Route::get('/formulario_Moneda/{id}/{ruta}/', 'Maestros\MonedaController@formulario_Moneda')->name('formulario_Moneda');
Route::post('/Moneda_create', 'Maestros\MonedaController@Moneda_create')->name('Moneda_create');
Route::post('/Moneda_update', 'Maestros\MonedaController@Moneda_update')->name('Moneda_update');
Route::get('/All_Moneda', 'Maestros\MonedaController@All_Moneda')->name('All_Moneda');
Route::post('/delete_Moneda/{id}', 'Maestros\MonedaController@delete_Moneda')->name('delete_Moneda');


Route::get('/formulario_Articulo/{id}/{ruta}/', 'Maestros\ArticuloController@formulario_Articulo')->name('formulario_Articulo');
Route::post('/Articulo_create', 'Maestros\ArticuloController@Articulo_create')->name('Articulo_create');
Route::post('/Articulo_update', 'Maestros\ArticuloController@Articulo_update')->name('Articulo_update');
Route::get('/All_Articulo', 'Maestros\ArticuloController@All_Articulo')->name('All_Articulo');
Route::post('/delete_Articulo/{id}', 'Maestros\ArticuloController@delete_Articulo')->name('delete_Articulo');



Route::get('/formulario_MisArticulo/{id}/{ruta}/', 'Maestros\MisArticuloController@formulario_Articulo')->name('formulario_MisArticulo');
Route::post('/MisArticulo_create', 'Maestros\MisArticuloController@Articulo_create')->name('MisArticulo_create');
Route::post('/MisArticulo_update', 'Maestros\MisArticuloController@Articulo_update')->name('MisArticulo_update');
Route::get('/All_MisArticulo', 'Maestros\MisArticuloController@All_Articulo')->name('All_MisArticulo');
Route::get('/All_MisArticulo_Carga', 'Maestros\MisArticuloController@All_Articulo_Carga')->name('All_MisArticulo_Carga');
Route::post('/delete_MisArticulo/{id}', 'Maestros\MisArticuloController@delete_Articulo')->name('delete_MisArticulo');





Route::get('/formulario_Banco/{id}/{ruta}/', 'Maestros\BancoController@formulario_Banco')->name('formulario_Banco');
Route::post('/Banco_create', 'Maestros\BancoController@Banco_create')->name('Banco_create');
Route::post('/Banco_update', 'Maestros\BancoController@Banco_update')->name('Banco_update');
Route::get('/All_Banco', 'Maestros\BancoController@All_Banco')->name('All_Banco');
Route::post('/delete_Banco/{id}', 'Maestros\BancoController@delete_Banco')->name('delete_Banco');


//********************************
//********************************
//********************************
//********PROVISIONALES***********
Route::get('/All_Archivo_Sistema', 'ProvisionalController@All_Archivo_Sistema')->name('All_Archivo_Sistema');
Route::get('/All_Archivo_Beneficiario', 'ProvisionalController@All_Archivo_Beneficiario')->name('All_Archivo_Beneficiario');
Route::get('/All_Archivo_Registro', 'ProvisionalController@All_Archivo_Registro')->name('All_Archivo_Registro');
Route::get('/All_Archivo_Modificacione', 'ProvisionalController@All_Archivo_Modificacione')->name('All_Archivo_Modificacione');
Route::get('/All_Archivo_CuentasCobra', 'ProvisionalController@All_Archivo_CuentasCobra')->name('All_Archivo_CuentasCobra');
Route::get('/All_Archivo_CuentasPaga', 'ProvisionalController@All_Archivo_CuentasPaga')->name('All_Archivo_CuentasPaga');
Route::get('/All_Archivo_Conciliacione', 'ProvisionalController@All_Archivo_Conciliacione')->name('All_Archivo_Conciliacione');
Route::get('/All_Archivo_Cotizacione', 'ProvisionalController@All_Archivo_Cotizacione')->name('All_Archivo_Cotizacione');
Route::get('/All_Reporte_Banco', 'ProvisionalController@All_Reporte_Banco')->name('All_Reporte_Banco');
Route::get('/All_Varios_Mensuale', 'ProvisionalController@All_Varios_Mensuale')->name('All_Varios_Mensuale');
Route::get('/All_Varios_Indice', 'ProvisionalController@All_Varios_Indice')->name('All_Varios_Indice');

Route::get('/All_Reimprime_Fact', 'ProvisionalController@All_Reimprime_Fact')->name('All_Reimprime_Fact');
Route::get('/All_Reimprime_Dev', 'ProvisionalController@All_Reimprime_Dev')->name('All_Reimprime_Dev');



Route::get('/All_Remision_Rece', 'ProvisionalController@All_Remision_Rece')->name('All_Remision_Rece');
Route::get('/All_Remision_Reimpre', 'ProvisionalController@All_Remision_Reimpre')->name('All_Remision_Reimpre');
Route::get('/All_Remision_Elimina', 'ProvisionalController@All_Remision_Elimina')->name('All_Remision_Elimina');

//********************************
//********************************
//********************************
//********************************






Route::get('/formulario_TipoIngreso/{id}/{ruta}/', 'Maestros\TipoIngresoController@formulario_TipoIngreso')->name('formulario_TipoIngreso');
Route::post('/TipoIngreso_create', 'Maestros\TipoIngresoController@TipoIngreso_create')->name('TipoIngreso_create');
Route::post('/TipoIngreso_update', 'Maestros\TipoIngresoController@TipoIngreso_update')->name('TipoIngreso_update');
Route::get('/All_TipoIngreso', 'Maestros\TipoIngresoController@All_TipoIngreso')->name('All_TipoIngreso');
Route::post('/delete_TipoIngreso/{id}', 'Maestros\TipoIngresoController@delete_TipoIngreso')->name('delete_TipoIngreso');



Route::get('/formulario_TipoEgreso/{id}/{ruta}/', 'Maestros\TipoEgresoController@formulario_TipoEgreso')->name('formulario_TipoEgreso');
Route::post('/TipoEgreso_create', 'Maestros\TipoEgresoController@TipoEgreso_create')->name('TipoEgreso_create');
Route::post('/TipoEgreso_update', 'Maestros\TipoEgresoController@TipoEgreso_update')->name('TipoEgreso_update');
Route::get('/All_TipoEgreso', 'Maestros\TipoEgresoController@All_TipoEgreso')->name('All_TipoEgreso');
Route::post('/delete_TipoEgreso/{id}', 'Maestros\TipoEgresoController@delete_TipoEgreso')->name('delete_TipoEgreso');



Route::get('/formulario_CajaCompensacion/{id}/{ruta}/', 'CajaCompensacionController@formulario_CajaCompensacion')->name('formulario_CajaCompensacion');
Route::post('/CajaCompensacion_create', 'CajaCompensacionController@CajaCompensacion_create')->name('CajaCompensacion_create');
Route::post('/CajaCompensacion_update', 'CajaCompensacionController@CajaCompensacion_update')->name('CajaCompensacion_update');
Route::get('/All_CajaCompensacion', 'CajaCompensacionController@All_CajaCompensacion')->name('All_CajaCompensacion');
Route::post('/delete_CajaCompensacion/{id}', 'CajaCompensacionController@delete_CajaCompensacion')->name('delete_CajaCompensacion');





Route::get('/formulario_Enfermedade/{id}/{ruta}/', 'EnfermedadeController@formulario_Enfermedade')->name('formulario_Enfermedade');
Route::post('/Enfermedade_create', 'EnfermedadeController@Enfermedade_create')->name('Enfermedade_create');
Route::post('/Enfermedade_update', 'EnfermedadeController@Enfermedade_update')->name('Enfermedade_update');
Route::get('/All_Enfermedade', 'EnfermedadeController@All_Enfermedade')->name('All_Enfermedade');
Route::post('/delete_Enfermedade/{id}', 'EnfermedadeController@delete_Enfermedade')->name('delete_Enfermedade');




Route::get('/formulario_Licencia/{id}/{ruta}/{sede?}', 'LicenciaController@formulario_Licencia')->name('formulario_Licencia');
Route::post('/Licencia_create', 'LicenciaController@Licencia_create')->name('Licencia_create');
Route::post('/Licencia_update', 'LicenciaController@Licencia_update')->name('Licencia_update');
Route::any('/All_Licencia/{sede?}', 'LicenciaController@All_Licencia')->name('All_Licencia');
Route::post('/delete_Licencia/{id}', 'LicenciaController@delete_Licencia')->name('delete_Licencia');





Route::get('/formulario_Vacacione/{id}/{ruta}/{sede?}', 'VacacioneController@formulario_Vacacione')->name('formulario_Vacacione');
Route::post('/Vacacione_create', 'VacacioneController@Vacacione_create')->name('Vacacione_create');
Route::post('/Vacacione_update', 'VacacioneController@Vacacione_update')->name('Vacacione_update');
Route::any('/All_Vacacione/{sede?}', 'VacacioneController@All_Vacacione')->name('All_Vacacione');
Route::post('/delete_Vacacione/{id}', 'VacacioneController@delete_Vacacione')->name('delete_Vacacione');



Route::get('/formulario_ContratoFinaliza/{id}/{ruta}/', 'ContratoFinalizaController@formulario_ContratoFinaliza')->name('formulario_ContratoFinaliza');
Route::post('/ContratoFinaliza_create', 'ContratoFinalizaController@ContratoFinaliza_create')->name('ContratoFinaliza_create');
Route::post('/ContratoFinaliza_update', 'ContratoFinalizaController@ContratoFinaliza_update')->name('ContratoFinaliza_update');
Route::get('/All_ContratoFinaliza', 'ContratoFinalizaController@All_ContratoFinaliza')->name('All_ContratoFinaliza');
Route::post('/delete_ContratoFinaliza/{id}', 'ContratoFinalizaController@delete_ContratoFinaliza')->name('delete_ContratoFinaliza');


Route::get('/formulario_DocumentoFinaliza/{id}/{ruta}/', 'DocumentoFinalizaController@formulario_DocumentoFinaliza')->name('formulario_DocumentoFinaliza');
Route::post('/DocumentoFinaliza_create', 'DocumentoFinalizaController@DocumentoFinaliza_create')->name('DocumentoFinaliza_create');
Route::post('/DocumentoFinaliza_update', 'DocumentoFinalizaController@DocumentoFinaliza_update')->name('DocumentoFinaliza_update');
Route::get('/All_DocumentoFinaliza', 'DocumentoFinalizaController@All_DocumentoFinaliza')->name('All_DocumentoFinaliza');
Route::post('/delete_DocumentoFinaliza/{id}', 'DocumentoFinalizaController@delete_DocumentoFinaliza')->name('delete_DocumentoFinaliza');


Route::get('/formulario_EmpleadoVacacione/{id}/{ruta}/', 'EmpleadoVacacioneController@formulario_EmpleadoVacacione')->name('formulario_EmpleadoVacacione');
Route::post('/EmpleadoVacacione_create', 'EmpleadoVacacioneController@EmpleadoVacacione_create')->name('EmpleadoVacacione_create');
Route::post('/EmpleadoVacacione_update', 'EmpleadoVacacioneController@EmpleadoVacacione_update')->name('EmpleadoVacacione_update');
Route::get('/All_EmpleadoVacacione', 'EmpleadoVacacioneController@All_EmpleadoVacacione')->name('All_EmpleadoVacacione');
Route::post('/delete_EmpleadoVacacione/{id}', 'EmpleadoVacacioneController@delete_EmpleadoVacacione')->name('delete_EmpleadoVacacione');




Route::get('/formulario_EmpleadoCumple/{id}/{ruta}/', 'EmpleadoCumpleController@formulario_EmpleadoCumple')->name('formulario_EmpleadoCumple');
Route::post('/EmpleadoCumple_create', 'EmpleadoCumpleController@EmpleadoCumple_create')->name('EmpleadoCumple_create');
Route::post('/EmpleadoCumple_update', 'EmpleadoCumpleController@EmpleadoCumple_update')->name('EmpleadoCumple_update');
Route::get('/All_EmpleadoCumple', 'EmpleadoCumpleController@All_EmpleadoCumple')->name('All_EmpleadoCumple');
Route::post('/delete_EmpleadoCumple/{id}', 'EmpleadoCumpleController@delete_EmpleadoCumple')->name('delete_EmpleadoCumple');


Route::get('/formulario_Tipo_documento/{id}/{ruta}/', 'Tipo_documentoController@formulario_Tipo_documento')->name('formulario_Tipo_documento');
Route::post('/Tipo_documento_create', 'Tipo_documentoController@Tipo_documento_create')->name('Tipo_documento_create');
Route::post('/Tipo_documento_update', 'Tipo_documentoController@Tipo_documento_update')->name('Tipo_documento_update');
Route::get('/All_Tipo_documento', 'Tipo_documentoController@All_Tipo_documento')->name('All_Tipo_documento');
Route::post('/delete_Tipo_documento/{id}', 'Tipo_documentoController@delete_Tipo_documento')->name('delete_Tipo_documento');




Route::get('/formulario_Novedade/{id}/{ruta}/{sede?}', 'NovedadeController@formulario_Novedade')->name('formulario_Novedade');
Route::post('/Novedade_create', 'NovedadeController@Novedade_create')->name('Novedade_create');
Route::post('/Novedade_update', 'NovedadeController@Novedade_update')->name('Novedade_update');
Route::any('/All_Novedade/{sede?}', 'NovedadeController@All_Novedade')->name('All_Novedade');
Route::post('/delete_Novedade/{id}', 'NovedadeController@delete_Novedade')->name('delete_Novedade');
Route::post('/Report_Novedade/', 'NovedadeController@Report_Novedade')->name('Report_Novedade');



Route::get('/formulario_Evento/{id}/{ruta}/{sede?}', 'EventoController@formulario_Evento')->name('formulario_Evento');
Route::post('/Evento_create', 'EventoController@Evento_create')->name('Evento_create');
Route::post('/Evento_update', 'EventoController@Evento_update')->name('Evento_update');
Route::any('/All_Evento/{sede?}', 'EventoController@All_Evento')->name('All_Evento');
Route::post('/delete_Evento/{id}', 'EventoController@delete_Evento')->name('delete_Evento');





Route::get('/formulario_CambioEps/{id}/{ruta}/{sede?}', 'CambioEpsController@formulario_CambioEps')->name('formulario_CambioEps');
Route::post('/CambioEps_create', 'CambioEpsController@CambioEps_create')->name('CambioEps_create');
Route::post('/CambioEps_update', 'CambioEpsController@CambioEps_update')->name('CambioEps_update');
Route::any('/All_CambioEps/{sede?}', 'CambioEpsController@All_CambioEps')->name('All_CambioEps');
Route::post('/delete_CambioEps/{id}', 'CambioEpsController@delete_CambioEps')->name('delete_CambioEps');



Route::get('/formulario_CambioAfp/{id}/{ruta}/{sede?}', 'CambioAfpController@formulario_CambioAfp')->name('formulario_CambioAfp');
Route::post('/CambioAfp_create', 'CambioAfpController@CambioAfp_create')->name('CambioAfp_create');
Route::post('/CambioAfp_update', 'CambioAfpController@CambioAfp_update')->name('CambioAfp_update');
Route::any('/All_CambioAfp/{sede?}', 'CambioAfpController@All_CambioAfp')->name('All_CambioAfp');
Route::post('/delete_CambioAfp/{id}', 'CambioAfpController@delete_CambioAfp')->name('delete_CambioAfp');



Route::get('/formulario_Profesione/{id}/{ruta}/', 'ProfesioneController@formulario_Profesione')->name('formulario_Profesione');
Route::post('/Profesione_create', 'ProfesioneController@Profesione_create')->name('Profesione_create');
Route::post('/Profesione_update', 'ProfesioneController@Profesione_update')->name('Profesione_update');
Route::get('/All_Profesione', 'ProfesioneController@All_Profesione')->name('All_Profesione');
Route::post('/delete_Profesione/{id}', 'ProfesioneController@delete_Profesione')->name('delete_Profesione');


Route::resource('Thumano', 'ThumanoController');
Route::resource('VentasCor', 'VentasCorController');
Route::resource('VentasPos', 'VentasPosController');


Route::resource('Entidades', 'EntidadesController');
Route::get('/formulario_Entidades/{id}/{ruta}/', 'EntidadesController@formulario_Entidades')->name('formulario_Entidades');
Route::post('/Entidades_create', 'EntidadesController@Entidades_create')->name('Entidades_create');
Route::post('/Entidades_update', 'EntidadesController@Entidades_update')->name('Entidades_update');
Route::get('/All_Entidades', 'EntidadesController@All_Entidades')->name('All_Entidades');
Route::post('/delete_Entidades/{id}', 'EntidadesController@delete_Entidades')->name('delete_Entidades');
});
