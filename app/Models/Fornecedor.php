<?php

namespace App\Models;

use CoffeeCode\DataLayer\DataLayer;

class Fornecedor extends DataLayer
{
	public function __construct()
	{
		parent::__construct('fornecedores', ['empresa', 'nome', 'documento', 'telefone']);
	}
}
