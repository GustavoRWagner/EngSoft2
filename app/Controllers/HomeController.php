<?php

namespace App\Controllers;

use App\Models\Product;
use Symfony\Component\Routing\RouteCollection;

class HomeController
{
// Homepage action
    public function indexAction(RouteCollection $routes)
    {
        $routeToCliente = str_replace('{id}', 1, $routes->get('cliente')->getPath());

        require_once APP_ROOT . '\Views\Home.php';
    }
}