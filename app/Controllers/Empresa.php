<?php

namespace App\Controllers;

use App\Models\Empresa as ModelEmpresa;

class Empresa
{
	/** data @var array */
	private $data = [];

	public function index()
	{
		try {
			$empresas = new ModelEmpresa();
			$list = $empresas->find()->fetch(true);

			if (empty($list)) {
				echo json_encode(['response' => 'Nenhuma Empresa cadastrada'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

				return;
			}

			foreach ($list as $key => $empresa) {
				array_push($this->data, $empresa->data());
			}

			echo json_encode(['response' => $this->data], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
		} catch (\Throwable $th) {
			echo json_encode(
				['file' => $th->getFile(), 'line' => $th->getLine(), 'error' => $th->getMessage()],
				JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
			);
		}
	}

	public function show($args)
	{
		$empresas = new ModelEmpresa();
		$empresa = $empresas->findById($args['id']);

		if (empty($empresa)) {
			echo json_encode(['response' => 'Empresa nao encontrada'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			return;
		}

		array_push($this->data, $empresa->data());

		echo json_encode(['response' => $this->data], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	}

	public function create($data)
	{
		$empresa = new ModelEmpresa();

		foreach ($data as $key => $value) {
			$empresa->$key = $value;
		}

		if (!empty($empresa->cnpj)) {
			$empresa->cnpj = preg_replace('/[^0-9]/', '', $empresa->cnpj);
		}

		$empresa->save();

		if ($empresa->fail()) {
			echo "<script>alert('{$empresa->fail()->getMessage()}');javascript:history.go(-1)</script>";

			return;
		}

		echo "<script>alert('empresa cadastrado com sucesso')</script>";
		echo '<script>javascript:history.go(-2)</script>';
	}

	public function update($data)
	{
		$empresa = (new ModelEmpresa())->findById($data['id']);

		if (empty($empresa)) {
			echo json_encode(['response' => 'Nenhuma Empresa encontrada'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			return;
		}

		foreach ($data as $key => $value) {
			$empresa->$key = $value;
		}

		if (!empty($empresa->cnpj)) {
			$empresa->cnpj = preg_replace('/[^0-9]/', '', $empresa->cnpj);
		}

		$empresa->save();

		if ($empresa->fail()) {
			echo "<script>alert('{$empresa->fail()->getMessage()}');javascript:history.go(-1)</script>";

			return;
		}

		echo "<script>alert('empresa alterada com sucesso')</script>";
		echo '<script>javascript:history.go(-2)</script>';
	}

	public function delete($args)
	{
		$empresa = (new ModelEmpresa())->findById($args['id']);

		if (!$empresa) {
			echo json_encode(['response' => 'Empresa nao encontrada'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			return;
		}

		$empresa->destroy();

		if ($empresa->fail()) {
			echo json_encode(['response' => 'Não foi possivel excluir a empresa'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			return;
		}

		echo json_encode(['response' => 'Exluido com sucesso'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	}
}
