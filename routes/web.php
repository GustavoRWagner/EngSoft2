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