<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();

$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'HomeController', 'method'=>'indexAction'), array()));

//Cliente Routes
$routes->add('clientes', new Route(constant('URL_SUBFOLDER') .  '/clientes/', array('controller' => 'ClienteController', 'method'=>'showListAction')));
$routes->add('cliente', new Route(constant('URL_SUBFOLDER') .  '/cliente/{id}', array('controller' => 'ClienteController', 'method'=>'showAction'), array('id' => '[0-9]+')));
$routes->add('clienteEdit', new Route(constant('URL_SUBFOLDER') .  '/cliente/edit/{id}/{nome}/{endereco}/{telefone}/{celular}/{cpf}', array('controller' => 'ClienteController', 'method'=>'editAction'), array('id' => '[0-9]+')));
$routes->add('clienteCreate', new Route(constant('URL_SUBFOLDER') .  '/cliente/create/{nome}/{endereco}/{telefone}/{celular}/{cpf}', array('controller' => 'ClienteController', 'method'=>'createAction'), array('id' => '[0-9]+')));
$routes->add('clienteDelete', new Route(constant('URL_SUBFOLDER') .  '/cliente/delete/{id}', array('controller' => 'ClienteController', 'method'=>'deleteAction'), array('id' => '[0-9]+')));

//Vendedor Routes
$routes->add('vendedores', new Route(constant('URL_SUBFOLDER') .  '/vendedores/', array('controller' => 'VendedorController', 'method'=>'showListAction')));
$routes->add('vendedorCreate', new Route(constant('URL_SUBFOLDER') .  '/vendedor/create/{nome}/{endereco}/{telefone}/{cpf}/{salarioBase}', array('controller' => 'VendedorController', 'method'=>'createAction')));
$routes->add('vendedorEdit', new Route(constant('URL_SUBFOLDER') .  '/vendedor/edit/{id}/{matricula}/{nome}/{endereco}/{telefone}/{cpf}/{salarioBase}', array('controller' => 'VendedorController', 'method'=>'editAction')));
$routes->add('vendedorDelete', new Route(constant('URL_SUBFOLDER') .  '/vendedor/delete/{id}', array('controller' => 'VendedorController', 'method'=>'deleteAction'), array('id' => '[0-9]+')));

//Produtos Routes
$routes->add('produtos', new Route(constant('URL_SUBFOLDER') .  '/produtos/', array('controller' => 'ProdutoController', 'method'=>'showListAction')));
$routes->add('produtoCreate', new Route(constant('URL_SUBFOLDER') .  '/produto/create/{descricao}/{valor}/{qtdEstoque}/{estoqueMinimo}/{validade}', array('controller' => 'produtoController', 'method'=>'createAction')));
$routes->add('produtoEdit', new Route(constant('URL_SUBFOLDER') .  '/produto/edit/{id}/{descricao}/{valor}/{qtdEstoque}/{estoqueMinimo}/{validade}', array('controller' => 'produtoController', 'method'=>'editAction')));
$routes->add('produtoDelete', new Route(constant('URL_SUBFOLDER') .  '/produto/delete/{id}', array('controller' => 'produtoController', 'method'=>'deleteAction')));

//Vendas Routes
$routes->add('vendas', new Route(constant('URL_SUBFOLDER') .  '/vendas/', array('controller' => 'CompraController', 'method'=>'showListAction')));
$routes->add('calcDesconto', new Route(constant('URL_SUBFOLDER') .  '/vendas/calcDesconto/{subtotal}', array('controller' => 'CompraController', 'method'=>'calcDesconto')));
$routes->add('vendasCreateC', new Route(constant('URL_SUBFOLDER') .  '/vendas/create/{vendedorID}/{clienteID}/{produtoID}/{qtd}/{vlProduto}/{vlDesconto}/{vlTotal}/{qtdParcela}/{valorParcela}/{formaPagamento}', array('controller' => 'CompraController', 'method'=>'createAction')));
$routes->add('vendasCreateD', new Route(constant('URL_SUBFOLDER') .  '/vendas/create/{vendedorID}/{clienteID}/{produtoID}/{qtd}/{vlProduto}/{vlDesconto}/{vlTotal}/{formaPagamento}', array('controller' => 'CompraController', 'method'=>'createAction')));
$routes->add('vendaDelete', new Route(constant('URL_SUBFOLDER') .  '/vendas/delete/{id}', array('controller' => 'CompraController', 'method'=>'deleteAction')));
