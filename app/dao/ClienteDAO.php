<?php

namespace App\dao;

class ClienteDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(DB_TYPE.':host='.DB_HOST.';dbname='. DB_NAME, DB_USER, DB_PASS);
    }

    public function create($cliente){
        if(strlen($cliente->getNome()) > 255){
            return false;
        }
        if(strlen((string)$cliente->getEndereco()) > 255){
            return false;
        }
        if(strlen((string)$cliente->getTelefone()) > 11){
            return false;
        }
        if(strlen((string)$cliente->getCelular()) > 11){
            return false;
        }
        if(strlen($cliente->getCpf()) > 11){
            return false;
        }
        $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, endereco, telefone, celular, cpf) VALUES (?,?,?,?,?)");
        try{
            if($stmt->execute([$cliente->getNome(), $cliente->getEndereco(), $cliente->getTelefone(), $cliente->getCelular(), $cliente->getCpf()])){
                return true;
            }
        }catch (Exception $e){
            return false;
        }
    }

    public function read($id){
        $stmt = $this->pdo->prepare ("SELECT * FROM clientes WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function update($cliente){
        if(strlen($cliente->getNome()) > 255){
            return false;
        }
        if(strlen((string)$cliente->getEndereco()) > 255){
            return false;
        }
        if(strlen((string)$cliente->getTelefone()) > 11){
            return false;
        }
        if(strlen((string)$cliente->getCelular()) > 11){
            return false;
        }
        if(strlen($cliente->getCpf()) > 12){
            return false;
        }
        $stmt = $this->pdo->prepare("UPDATE clientes SET nome=?, endereco=?, telefone=?, celular=?, cpf=? WHERE id=?");
        try{
            $stmt->execute([$cliente->getNome(), $cliente->getEndereco(), $cliente->getTelefone(), $cliente->getCelular(), $cliente->getCpf(), $cliente->getId()]);
            if($stmt->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }catch (Exception $e){
            return false;
        }
    }

    public function delete($id){
        $query = $this->pdo->prepare("DELETE FROM clientes WHERE id = ?");
        try {
            if ($query->execute([$id])) {
                return True;
            }
        } catch (Exception $e) {
            header("Location: delete-error.php?err=" . $e);
        }
    }

    public function readMultiple($limit = 15, $page = 1){
        $offset = $limit * ($page - 1);
            $stmt = $this->pdo->prepare ("SELECT * FROM clientes ORDER BY id DESC LIMIT ".$limit." OFFSET ". $offset);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;

    }

    public function hasCompras($id){

    }

}