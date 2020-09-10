<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Helper\Helper;
class FaturasController extends Controller
{
	public function listar(Request $request)
	{
		$objetos = \App\Fatura::orderby('id','desc')->where('FKidUsuario',\Auth::user()->id)->paginate(5);//Gera paginação automatica

		return response()->json([$objetos]);
	}
	public function buscar($id)
	{
		$objeto = \App\Fatura::where('id',$id)->where('FKidUsuario',\Auth::user()->id)->first();//Pego objeto pelo ID e garanto que apenas o usuario permitido vai acessar

		if ($objeto==null) {
			return response()->json(['resultado'=>false,'message'=>'objeto não encontrado']);
		}
		return response()->json([$objeto]);
	}
	public function cadastrar(Request $request)
	{
		

//['Paga','Aberta','Atrasada']
		//Função que valida os campos do formulario
		$validator = \Validator::make($request->all(), [
			'vencimento' => ['required', 'date', 'max:255'],
			'url' => ['required', 'string', 'max:255'],
			'status' => ['required', 'string', 'in:Paga,Aberta,Atrasada'],//Verifica se o status é valido
		]);

			if ($validator->fails()) { //Se houver erro na validação retorne uma lista com os erros
				return response()->json(['resultado'=>false,'erros'=>$validator->errors()]);
			}

			$objeto = \App\Fatura::create([ //Passo os parametros para o model e guardo o objeto 
				'vencimento' => $request['vencimento'],
				'url' => $request['url'],
				'status' => $request['status'],
				'FKidUsuario'=>\Auth::user()->id
			]);

			if ($objeto!=null) { 
				return response()->json(['resultado'=>true,'objeto'=>$objeto]);
			}else{
				return response()->json(['resultado'=>false]);
			}


		}
		public function editar($id,Request $request)
		{
		$objeto = \App\Fatura::where('id',$id)->where('FKidUsuario',\Auth::user()->id)->first();//Pego objeto pelo ID e garanto que apenas o usuario permitido vai acessar
		if ($objeto==null) {
			return response()->json(['resultado'=>false,'message'=>'objeto não encontrado']);
		}

		//Função que valida os campos do formulario
		$validator = \Validator::make($request->all(), [
			'vencimento' => ['required', 'date', 'max:255'],
			'url' => ['required', 'string', 'max:255'],
			'status' => ['required', 'string', 'in:Paga,Aberta,Atrasada'],//Verifica se o status é valido
		]);

			if ($validator->fails()) { //Se houver erro na validação retorne uma lista com os erros
				return response()->json(['resultado'=>false,'erros'=>$validator->errors()]);
			}

			
			$objeto['vencimento'] = $request['vencimento'];
			$objeto['url'] = $request['url'];
			$objeto['status'] = $request['status'];


			if ($objeto->save()) { 
				return response()->json(['resultado'=>true,'objeto'=>$objeto]);
			}else{
				return response()->json(['resultado'=>false]);
			}


		}

		public function excluir($id,Request $request)
		{
    	$objeto = \App\Fatura::where('id',$id)->where('FKidUsuario',\Auth::user()->id)->first();//Pego objeto pelo ID e garanto que apenas o usuario permitido vai acessar
    	
    	if ($objeto==null) {
    		return response()->json(['resultado'=>false,'message'=>'objeto não encontrado']);
    	}

    	if ($objeto->delete()) { 
    		return response()->json(['resultado'=>true,'objeto'=>$objeto]);
    	}else{
    		return response()->json(['resultado'=>false]);
    	}

    }
}
