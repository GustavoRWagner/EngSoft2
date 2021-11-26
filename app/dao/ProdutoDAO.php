<?php

namespace App\dao;

use App\Models\Produto;

class ProdutoDAO
{
    public function __construct()
    {
        $this->pdo = new \PDO(DB_TYPE.':host='.DB_HOST.';dbname='. DB_NAME, DB_USER, DB_PASS);
    }

    public function read($id){
        $stmt = $this->pdo->prepare ("SELECT * FROM produtos WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function readMultiple($limit = 15, $page = 1){
        $offset = $limit * ($page - 1);
        $stmt = $this->pdo->prepare ("SELECT * FROM produtos ORDER BY id DESC LIMIT ".$limit." OFFSET ". $offset);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function create(Produto $produto){
        if(strlen($produto->getDescricao()) > 255){
            return false;
        }
        if(strlen((string)$produto->getQtdEstoque()) > 255){
            return false;
        }
        if(strlen((string)$produto->getQtdEstoque()) > 11){
            return false;
        }
        if(strlen($produto->getEstoqueMinimo()) > 11){
            return false;
        }
        $stmt = $this->pdo->prepare("INSERT INTO produtos (descricao, valor, qtdEstoque, estoqueMinimo, validade) VALUES (?,?,?,?,?)");

        try{
            if($stmt->execute([$produto->getDescricao(), $produto->getValor(), $produto->getQtdEstoque(), $produto->getEstoqueMinimo(), $produto->getValidade()])){
                return true;
            }
        }catch (Exception $e){
            return false;
        }
    }

    public function update(Produto $produto){
        if(strlen($produto->getDescricao()) > 255){
            return false;
        }
        if(strlen((string)$produto->getQtdEstoque()) > 255){
            return false;
        }
        if(strlen((string)$produto->getQtdEstoque()) > 11){
            return false;
        }
        if(strlen($produto->getEstoqueMinimo()) > 11){
            return false;
        }
        $stmt = $this->pdo->prepare("UPDATE produtos SET descricao=?, valor=?, qtdEstoque=?, estoqueMinimo=?, validade=? WHERE id=?");
        try{
            $stmt->execute([$produto->getDescricao(), $produto->getValor(), $produto->getQtdEstoque(), $produto->getEstoqueMinimo(), $produto->getValidade(), $produto->getId()]);
            if($stmt->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }catch (\Exception $e){
            return false;
        }
    }

    public function delete($id){
        $query = $this->pdo->prepare("DELETE FROM produtos WHERE id = ?");
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