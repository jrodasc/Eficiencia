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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'PagesController@home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('notes', 'NotesController@index');
Route::get('notes/{id}/destroy', 'NotesController@destroy')->name('notes.destroy');

Route::group(['middleware' => ['auth',]], function () {
	
	Route::get('/home', 'HomeController@index');
    Route::get('/admin','HomeController@index');
    Route::resource('/admin/users','UserController');
    Route::get('user',['as'=>'user.index','uses'=>'UserController@index','middleware' => ['role:administrador|role-create|role-edit|role-delete']]);
    Route::resource('/admin/roles','RoleController');
    Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
   
    Route::get('/admin/control/{id}', 'ControlController@index');
    Route::put('/admin/control/{id}', 'ControlController@update');
    Route::post('/admin/push', 'ControlController@httpush');
    Route::post('/admin/push/produccion', 'ControlController@httpushproduccion');
    Route::get('/admin/calculo', 'ControlController@calculo_oee');
    Route::get('/admin/control/maquina/{id}','ControlController@ajaxCausa');
    Route::get('/admin/control/causa/{id}','ControlController@ajaxCausaMaquina');
    Route::get('/admin/control/receta/{id}','ControlController@ajaxReceta');
    
    Route::resource('/admin/lineas','LineasController');
    Route::resource('/admin/producciones','ProduccionesController');
    Route::get('/admin/informe-dia/{id}', 'ProduccionesController@informe');
   /* Route::get('/admin/archivos', 'StorageController@index');
    Route::post('/admin/archivos/create', 'StorageController@save');
    Route::get('/admin/archivos/{archivo}', function ($archivo) {
        $public_path = public_path();
        $url = $public_path.'/storage/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
        if (Storage::exists($archivo))
            {
                return response()->download($url);
            }
     //si no se encuentra lanzamos un error 404.
        abort(404);
    /* Route::get('/admin/archivos', function(){
		return view('archivos.index');
	});*/
//});*
     Route::get('/admin/categorias', function(){
		return view('categorias.index');
	});

     /*Route::get('/admin/articulos', function(){
		return view('articulos.index');
	});*/
    Route::resource('/admin/articulos','ArticulosController');
    
    Route::get('/admin/articulos/notas/{id}','ArticulosController@notas')->name('articulos.notas');
    Route::post('/admin/articulos/notas/add','ArticulosController@notasadd');
    Route::post('/admin/articulos/notas/edit/{id}','ArticulosController@notasedit');
    Route::post('/admin/articulos/notas/eliminar/{id}','ArticulosController@notasdelete');
    
    Route::get('/admin/articulos/changeStatus/{id}', array('as' => 'changeStatus', 'uses' => 'ArticulosController@changeStatus'))->name('changeStatus');
    
    Route::resource('/admin/archivos', 'ArchivosController');
    Route::get('/admin/archivos-notas/{id}','ArchivosController@ajaxNota');
    Route::get('/admin/upload', 'UploadController@uploadForm');
    Route::post('/admin/archivos/upload', 'UploadController@uploadSubmit');
    Route::post('/admin/articulos/upload', 'UploadController@uploadarticulosSubmit');
    Route::post('/admin/archivos/nota', 'ArchivosController@postArchivo');
    Route::get('/admin/archivos-descargar/archivos/{$file}' , 'ArchivosController@DescargaArchivo');

});
