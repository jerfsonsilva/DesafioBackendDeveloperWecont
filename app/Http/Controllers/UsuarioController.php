<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UsuarioController extends Controller
{
	public function logar(String $email,String $senha)
	{
		$credentials = ['password'=>$senha,'email'=>$email];

		if(!Auth::attempt($credentials))
			return response()->json([
				'message' => 'Não autorizado',
				'resultado'=>false
			], 401);

		return response()->json([
			'resultado'=>true,
			'message' => 'Usuario Logado'
		]);

	}
	public function usuarionaologado()
	{
		return response()->json([
			'resultado'=>false,
			'message'=>'Usuario não logado'
		]);
	}
	public function usuarioLogado()
	{
		$user = \Auth::user();
		return response()->json([
			'email'=>$user->email,
			'nome'=>$user->nome
		]);

	}
	public function registrar(String $email, String $senha, String $nome)
	{
		$validator = \Validator::make(['email'=>$email,'password'=>$senha,'nome'=>$nome], [
			'nome' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8'],
		]);
		
	if ($validator->fails()) { //Se houver erro na validação retorne o erro
		return response()->json(['resultado'=>false,'erros'=>$validator->errors()]);
	}

	$usuario = \App\User::create([
		'nome' => $nome,
		'email' => $email,
		'password' => \Hash::make($senha),
	]);
	return response()->json(['resultado'=>true,'usuario'=>$usuario ]);


}
public function sair()
{
	\Auth::logout();
	\Session::flush();

	return response()->json(['resultado'=>true,'message'=>'Usuario deslogado']);
}
}
