<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
	protected $fillable = [
		'vencimento','url','status','FKidUsuario'
	];
}
