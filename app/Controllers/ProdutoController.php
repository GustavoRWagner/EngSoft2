<?php

namespace App\Controllers;

use App\dao\ClienteDAO;
use App\dao\ProdutoDAO;
use App\dao\VendedorDAO;
use App\Models\Produto;
use Symfony\Component\Routing\RouteCollection;

class ProdutoController
{
    public function showListAction(RouteCollection $routes)
    {
        $dao= new ProdutoDAO();
        $produtos = $dao->readMultiple();

        $dao= new VendedorDAO();
        $vendedores = $dao->readMultiple();

        $dao= new ClienteDAO();
        $clientes = $dao->readMultiple();

        require_once APP_ROOT . '/Views/Produtos.php';
    }
    public function createAction(string $descricao, string $valor, int $qtdEstoque, int $estoqueMinimo, string $validade,  RouteCollection $routes)
    {
        $valor = floatval(str_replace(',', '.', str_replace('.', '', $valor)));
        $Produto = new Produto($descricao, $valor, $qtdEstoque, $estoqueMinimo, $validade);
        $response = $Produto->save();
        echo $response;
    }
    public function editAction(int $id,string $descricao, string $valor, int $qtdEstoque, int $estoqueMinimo, string $validade,  RouteCollection $routes)
    {
        $valor = floatval(str_replace(',', '.', str_replace('.', '', $valor)));
        $Produto = new Produto();
        $Produto->read($id);
        $Produto->setDescricao($descricao);
        $Produto->setValor($valor);
        $Produto->setQtdEstoque($qtdEstoque);
        $Produto->setEstoqueMinimo($estoqueMinimo);
        $Produto->setValidade($validade);
        $response = $Produto->save();
        echo $response;
    }

    public function deleteAction(int $id,  RouteCollection $routes)
    {
        $Produto = new Produto();
        $Produto->read($id);
        $response = $Produto->delete();

        echo $response;
    }

}