<?php

namespace App\dao;

use App\Models\Compra;

class CompraDAO
{
    public function __construct()
    {
        $this->pdo = new \PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    public function read($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM compras WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function readMultiple($limit = 15, $page = 1)
    {
        $offset = $limit * ($page - 1);
        $stmt = $this->pdo->prepare("SELECT d.id as id, v.nome vendedor, c.nome as cliente, p.descricao as produto,
       d.qtd as qtd, d.valor as valor, d.valorDesconto as valorDesconto, d.valorTotal as valorTotal, d.parcelas as parcelas,
       d.valorParcela as valorParcela, d.formaPagamento as formaPagamento, d.dtVenda as dtVenda FROM compras d inner join
       vendedores v on v.id = d.vendedor inner join clientes c on d.cliente = c.id inner join produtos p on p.id = d.produto 
       ORDER BY id DESC LIMIT " . $limit . " OFFSET " . $offset);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function create(Compra $compra)
    {
        $stmt = $this->pdo->prepare("INSERT INTO compras (vendedor, cliente, produto, qtd, valor, valorDesconto, valorTotal, parcelas, valorParcela, formaPagamento) VALUES (?,?,?,?,?,?,?,?,?,?)");

        try {
            if ($stmt->execute([$compra->getVendedor(), $compra->getCliente(), $compra->getProduto(), $compra->getQtd(), $compra->getValor(), $compra->getValorDesconto(), $compra->getValorTotal(), $compra->getParcelas(), $compra->getParcelas(), $compra->getFormaPagamento()])) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    public function delete($id){
        $query = $this->pdo->prepare("DELETE FROM compras WHERE id = ?");
        try {
            if ($query->execute([$id])) {
                return True;
            }
            else{
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}