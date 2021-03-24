<?php

namespace App\Controllers;

use App\Models\Fornecedor as ModelFornecedor;

class Fornecedor
{
	/** data @var array */
	private $data = [];

	public function index($data)
	{
		try {
			$columns = [];
			$params = [];

			if (!empty($data['nome'])) {
				array_push($columns, 'nome = :nome');
				array_push($params, "nome={$data['nome']}");
			}

			if (!empty($data['documento'])) {
				array_push($columns, 'documento = :documento');
				array_push($params, 'documento=' . preg_replace('/[^0-9]/', '', $data['documento']));
			}

			if (!empty($data['created_at'])) {
				array_push($columns, 'DATE(created_at) = :created_at');
				array_push($params, 'created_at=' . inverteData($data['created_at']));
			}

			$columns = implode(' and ', $columns);
			$params = implode('&', $params);

			$fornecedores = new ModelFornecedor();
			$list = $fornecedores->find($columns, $params)->fetch(true);

			if (empty($list)) {
				echo json_encode(['response' => 'Nenhum Fornecedor encontrado'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

				return;
			}

			foreach ($list as $key => $fornecedor) {
				array_push($this->data, $fornecedor->data());
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
		$fornecedores = new ModelFornecedor();
		$fornecedor = $fornecedores->findById($args['id']);

		if (empty($fornecedor)) {
			echo json_encode(['response' => 'Fornecedor nao encontrado'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			return;
		}

		array_push($this->data, $fornecedor->data());

		echo json_encode(['response' => $this->data], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	}

	public function create($data)
	{
		$fornecedor = new ModelFornecedor();

		foreach ($data as $key => $value) {
			$fornecedor->$key = $value;
		}

		if (!empty($fornecedor->documento)) {
			$fornecedor->documento = preg_replace('/[^0-9]/', '', $fornecedor->documento);
		}

		if (!empty($fornecedor->telefone)) {
			$fornecedor->telefone = preg_replace('/[^0-9]/', '', $fornecedor->telefone);
			$fornecedor->telefone = implode(';', $fornecedor->telefone);
		}

		if (!empty($fornecedor->data_nascimento)) {
			$fornecedor->data_nascimento = inverteData($fornecedor->data_nascimento);
		}

		$fornecedor->save();

		if ($fornecedor->fail()) {
			echo "<script>alert('{$fornecedor->fail()->getMessage()}');javascript:history.go(-1)</script>";

			return;
		}

		echo "<script>alert('fornecedor cadastrado com sucesso')</script>";
		header('Location: http://localhost/controle-fornecedores/public/view/home.php');
	}

	public function update($data)
	{
		$fornecedor = (new ModelFornecedor())->findById($data['id']);

		if (empty($fornecedor)) {
			echo json_encode(['response' => 'Nenhum Fornecedor encontrado'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			return;
		}

		foreach ($data as $key => $value) {
			$fornecedor->$key = $value;
		}

		if (!empty($fornecedor->documento)) {
			$fornecedor->documento = preg_replace('/[^0-9]/', '', $fornecedor->documento);
		}

		if (!empty($fornecedor->telefone)) {
			$fornecedor->telefone = preg_replace('/[^0-9]/', '', $fornecedor->telefone);
			$fornecedor->telefone = implode(';', $fornecedor->telefone);
		}

		if (!empty($fornecedor->data_nascimento)) {
			$fornecedor->data_nascimento = inverteData($fornecedor->data_nascimento);
		}

		$fornecedor->save();

		if ($fornecedor->fail()) {
			echo "<script>alert('{$fornecedor->fail()->getMessage()}');javascript:history.go(-1)</script>";

			return;
		}

		echo "<script>alert('fornecedor atualizado com sucesso')</script>";
		header('Location: http://localhost/controle-fornecedores/public/view/home.php');
	}

	public function delete($args)
	{
		$fornecedor = (new ModelFornecedor())->findById($args['id']);

		if (!$fornecedor) {
			echo json_encode(['response' => 'Fornecedor nao encontrado'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			return;
		}

		$fornecedor->destroy();

		if ($fornecedor->fail()) {
			echo json_encode(['response' => 'Não foi possivel excluir o fornecedor'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			return;
		}

		echo json_encode(['response' => 'Exluido com sucesso'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	}
}
