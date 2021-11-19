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
        $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, endereco, telefone, celular, cpf) VALUES (?,?,?,?,?)");
        try{
            if($stmt->execute([$cliente->getNome(), $cliente->getEndereco(), $cliente->getTelefone(), $cliente->getCelular(), $cliente->getCpf()])){
                return true;
            }
        }catch (Exception $e){
            echo("ERROR TRING TO INSERT ON DB: ".$e);
        }
    }

    public function read($id){
        $stmt = $this->pdo->prepare ("SELECT * FROM clientes WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function update($cliente){
        $stmt = $this->pdo->prepare("UPDATE clientes SET nome=?, endereco=?, telefone=?, celular=?, cpf=? WHERE id=?");
        try{
            if($stmt->execute([$cliente->getNome(), $cliente->getEndereco(), $cliente->getTelefone(), $cliente->getCelular(), $cliente->getCpf(), $cliente->getId()])){
                return true;
            }
        }catch (Exception $e){
            echo("ERROR TRING TO UPDATE ON DB: ".$e);
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
            $stmt = $this->pdo->prepare ("SELECT * FROM clientes LIMIT ".$limit." OFFSET ". $offset);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;

    }

    public function hasCompras($id){

    }

}