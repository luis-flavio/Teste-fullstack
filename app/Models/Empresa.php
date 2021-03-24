<?php

namespace App\Models;

use CoffeeCode\DataLayer\DataLayer;

class Empresa extends DataLayer
{
	public function __construct()
	{
		parent::__construct('empresa', ['uf', 'nome_fantasia', 'cnpj'], 'id', false);
	}
}
