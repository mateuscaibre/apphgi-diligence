<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Http\Middleware\CheckImovel;
use App\Mail\SendMailNotificarion;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

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



if (App::environment('production')) {
   URL::forceScheme('https');
}
Auth::routes(['register' => true]);

Route::middleware('auth')->group(function () {

   Route::get('arquivo/{imovel}/', function ($file) {

      return Storage::download('/documentos/4/' . $file)->disk('public');
   })->name('download')->middleware('auth');


   Route::get("/notificacao", function ()
   {
      //return "notificacao";
      return Mail::to('andrecabrall@gmail.com')->send(new SendMailNotificarion('Assunto aqui', "Mensagem aqui", "Documentos reprovado"));
    }
   );



   //Route::get('/usuarios', 'Auth\RegisterController@showRegistrationForm')->name('usuarios');
   Route::get('/', 'HomeController@index')->name('home');


   Route::group(['middleware' => ['role:admin']], function () {
      Route::view('/clientes', 'clientes.index')->name('clientes');
      Route::view('/documentos', 'documentos.index')->name('documentos');
      Route::view('/usuarios', 'auth.register-user')->name('usuarios');
   });

   Route::group(['middleware' => ['CheckImovel']], function () {


      Route::get('/documentos/imovel/{id}', 'Documentos\DocumentosController@lista')->name('documentos.imovel');

      Route::get('/documentos/imovel/{id}/{idSocio}/send/documentos', 'Documentos\DocumentosController@listaDocumentos')->name('documentos.imovel.socio.send');
      Route::get('/documentos/imovel/{id}/send/documentos', 'Documentos\DocumentosController@listaDocumentosImovel')->name('documentos.imovel.send');

      Route::get('/documentos/imovel/{id}/item/{idDocumento}/delete', 'Documentos\DocumentosController@uploadItemDelete')->name('documentos.imovel.upload.item.delete');

      Route::get('/documentos/imovel/{id}/item/{idDocumento}/{idSocio?}', 'Documentos\DocumentosController@uploadItemSocio')->name('documentos.imovel.upload.item.socio');
      Route::get('/documentos/imovel/{id}/item/{idDocumento}', 'Documentos\DocumentosController@uploadItemImovel')->name('documentos.imovel.upload.item.imovel');


      Route::get('/documentos/imovel/item/{idDocumento}/send', 'Documentos\DocumentosController@sendDocumento')->name('documentos.imovel.item.send');
      Route::post('/documentos/imovel/item/send', 'Documentos\DocumentosController@StatusDocumento')->name('documentos.imovel.item.send.status');


      Route::get('/documentos/imovel/file/{imovel}/{documento}', 'Documentos\DocumentosController@getFile')->name('documentos.imovel.upload.get.file');
   });
   Route::post('/documentos/imovel/upload', 'Documentos\DocumentosController@upload')->name('documentos.imovel.upload');
});
