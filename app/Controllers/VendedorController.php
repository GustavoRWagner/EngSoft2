<?php

namespace App\Controllers;

use App\dao\CompraDAO;
use App\dao\VendedorDAO;
use App\Models\Vendedor;
use Symfony\Component\Routing\RouteCollection;

class VendedorController
{

    public function showListAction(RouteCollection $routes)
    {
        $dao = new VendedorDAO();
        $vendedores = $dao->readMultiple();

        require_once APP_ROOT . '/Views/Vendedores.php';
    }

    public function createAction(string $nome, string $endereco, int $telefone, string $cpf, string $salarioBase, RouteCollection $routes)
    {
        $salarioBase = floatval(str_replace(',', '.', str_replace('.', '', $salarioBase)));
        $Vendedor = new Vendedor($nome, $endereco, $telefone, $cpf, $salarioBase);
        $response = $Vendedor->save();
        echo $response;
    }

    public function editAction(int $id, int $matricula, string $nome, string $endereco, int $telefone, string $cpf, string $salarioBase, RouteCollection $routes)
    {
        $Vendedor = new Vendedor();
        $Vendedor->read($id);
        $Vendedor->setMatricula($matricula);
        $Vendedor->setNome($nome);
        $Vendedor->setEndereco($endereco);
        $Vendedor->setTelefone($telefone);
        $Vendedor->setCpf($cpf);
        $Vendedor->setSalarioBase($salarioBase);
        $response = $Vendedor->save();
        echo $response;
    }

    public function deleteAction(int $id, RouteCollection $routes)
    {
        $Cliente = new Vendedor();
        $Cliente->read($id);
        $response = $Cliente->delete();

        echo $response;
    }

    public function calcComissao($id, RouteCollection $routes)
    {
        $valorVendasTotal = new CompraDAO();
        $valorVendasTotal = $valorVendasTotal->totalVendas($id);
        if ($valorVendasTotal < 10000) {
            $comissao = $valorVendasTotal * 0.05;
        } else {
            $comissao = $valorVendasTotal * 0.07;
        }
        echo $comissao;
    }

}