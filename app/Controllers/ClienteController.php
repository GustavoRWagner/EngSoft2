<?php

namespace App\Controllers;

use App\dao\ClienteDAO;
use App\Models\Cliente;
use Symfony\Component\Routing\RouteCollection;

class ClienteController
{
    // Show the product attributes based on the id.
    public function showListAction(RouteCollection $routes)
    {
        $dao= new ClienteDAO();
        $clientes = $dao->readMultiple();

        require_once APP_ROOT . '/Views/Clientes.php';
    }

    public function showAction(int $id, RouteCollection $routes)
    {
        $Cliente = new Cliente();
        $Cliente->read($id);

        require_once APP_ROOT . '/Views/Cliente.php';
    }
    // Show the product attributes based on the id.
    public function editAction(int $id, string $nome, string $endereco, int $telefone, int $celular, string $cpf,  RouteCollection $routes)
    {
        $Cliente = new Cliente();
        $Cliente->read($id);
        $Cliente->setNome($nome);
        $Cliente->setEndereco($endereco);
        $Cliente->setTelefone($telefone);
        $Cliente->setCelular($celular);
        $Cliente->setCpf($cpf);
        $response = $Cliente->save();

        echo $response;
    }
    public function createAction(string $nome, string $endereco, int $telefone, int $celular, string $cpf,  RouteCollection $routes)
    {
        $Cliente = new Cliente();
        $Cliente->setNome($nome);
        $Cliente->setEndereco($endereco);
        $Cliente->setTelefone($telefone);
        $Cliente->setCelular($celular);
        $Cliente->setCpf($cpf);
        $response = $Cliente->save();

        echo $response;
    }
    public function deleteAction(int $id,  RouteCollection $routes)
    {
        $Cliente = new Cliente();
        $Cliente->read($id);
        $response = $Cliente->delete();

        echo $response;
    }
}