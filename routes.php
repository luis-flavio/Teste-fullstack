<?php

use CoffeeCode\Router\Router;

$route = new Router('localhost/controle-fornecedores', ':');

$route->namespace('App\Controllers');

$route->group('fornecedor');
$route->get('/', 'Fornecedor:index');
$route->get('/{id}', 'Fornecedor:show');
$route->post('/', 'Fornecedor:create');
$route->post('/pesquisar', 'Fornecedor:index');
$route->put('/', 'Fornecedor:update');
$route->delete('/{id}', 'Fornecedor:delete');

$route->group('empresa');
$route->get('/', 'Empresa:index');
$route->get('/{id}', 'Empresa:show');
$route->post('/', 'Empresa:create');
$route->put('/', 'Empresa:update');
$route->delete('/{id}', 'Empresa:delete');

$route->dispatch();

if ($route->error()) {
	header('Location: public/view/home.php');
}
