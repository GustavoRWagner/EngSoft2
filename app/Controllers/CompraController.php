<?php

namespace App\Controllers;

use App\dao\ClienteDAO;
use App\dao\CompraDAO;
use App\dao\VendedorDAO;
use App\Models\Compra;
use Symfony\Component\Routing\RouteCollection;

class CompraController
{

    public function showListAction(RouteCollection $routes)
    {
        $dao = new CompraDAO();
        $compras = $dao->readMultiple();

        require_once APP_ROOT . '/Views/Compras.php';
    }

    public function createAction(int $vendedorID, int $clienteID, int $produtoID, int $qtd, string $vlProduto, string $vlDesconto, string $vlTotal, int $qtdParcela = NULL, string $valorParcela = NULL, string $formaPagamento = NULL, RouteCollection $routes)
    {
        $vlProduto = (float)str_replace(",", ".", $vlProduto);
        $vlDesconto = (float)str_replace(",", ".", $vlDesconto);
        $vlTotal = (float)str_replace(",", ".", $vlTotal);
        $valorParcela = (float)str_replace(",", ".", $valorParcela);

        $Compra = new Compra($vendedorID, $clienteID, $produtoID, $qtd, $vlProduto, $vlDesconto, $vlTotal, $qtdParcela, $valorParcela, $formaPagamento);
        $response = $Compra->save();
        echo $response;
    }

    public function deleteAction(int $id,  RouteCollection $routes)
    {
        $Produto = new Compra();
        $Produto->read($id);
        $response = $Produto->delete();

        echo $response;
    }

    public function calcDesconto(float $subtotal, RouteCollection $routes)
    {
        $desconto = 0;
        if ($subtotal < 1000) {
            $desconto = 0.03;
        } else {
            $desconto = 0.05;
        }
        $vlDesconto = $subtotal * $desconto;

        echo $vlDesconto;
    }
}