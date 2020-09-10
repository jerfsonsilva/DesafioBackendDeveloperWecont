<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/',function ()
{
	return 'Bem vindo ao meu mundo!!';
});

Route::get('/usuarionaologado','UsuarioController@usuarionaologado')->name('usuarionaologado');
Route::get('/logar/{email}/{senha}','UsuarioController@logar');

Route::get('/registrar/{email}/{senha}/{nome}','UsuarioController@registrar');

Route::get('/dadosUsuario','UsuarioController@usuarioLogado');//Mostrar as informações do usuário autenticado (somente nome e e-mail).

Route::get('/sair','UsuarioController@sair');

Route::group(['middleware' => ['auth']], function () {//Com excessão da rota de Autenticar um usuário, as demais deverão serem acessadas somente por usuários autenticados.

	Route::prefix('faturas')->group(function () {//CRUD de faturas do usuário autenticado (um usuário não deverá ter acesso à faturas de outro).

		Route::get('/', 'FaturasController@listar');//A rota de ler faturas deverá ter paginação, sendo, por padrão, 5 faturas por página.

		Route::get('cadastrar/', 'FaturasController@cadastrar');

		Route::get('buscar/{id}', 'FaturasController@buscar');

		Route::get('editar/{id}', 'FaturasController@editar');

		Route::get('excluir/{id}', 'FaturasController@excluir');
		
	});

});