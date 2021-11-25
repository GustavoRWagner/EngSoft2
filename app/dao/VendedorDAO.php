<?php

namespace App\dao;

use App\Models\Vendedor;

class VendedorDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(DB_TYPE.':host='.DB_HOST.';dbname='. DB_NAME, DB_USER, DB_PASS);
    }

    public function read($id){
        $stmt = $this->pdo->prepare ("SELECT * FROM vendedores WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function readMultiple($limit = 15, $page = 1){
        $offset = $limit * ($page - 1);
        $stmt = $this->pdo->prepare ("SELECT * FROM vendedores ORDER BY id DESC LIMIT ".$limit." OFFSET ". $offset);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function create(Vendedor $vendedor){
        if(strlen($vendedor->getNome()) > 255){
            return false;
        }
        if(strlen((string)$vendedor->getEndereco()) > 255){
            return false;
        }
        if(strlen((string)$vendedor->getTelefone()) > 11){
            return false;
        }
        if(strlen($vendedor->getCpf()) > 14){
            return false;
        }
        $stmt = $this->pdo->prepare("INSERT INTO vendedores (matricula, nome, endereco, telefone, cpf, salarioBase) VALUES (?,?,?,?,?,?)");

        try{
            if($stmt->execute([$vendedor->getMatricula(), $vendedor->getNome(), $vendedor->getEndereco(), $vendedor->getTelefone(), $vendedor->getCpf(), $vendedor->getSalarioBase()])){
                return true;
            }
        }catch (Exception $e){
            return false;
        }
    }

    public function update(Vendedor $vendedor){
        if(strlen($vendedor->getNome()) > 255){
            return false;
        }
        if(strlen((string)$vendedor->getEndereco()) > 255){
            return false;
        }
        if(strlen((string)$vendedor->getTelefone()) > 11){
            return false;
        }
        if(strlen($vendedor->getCpf()) > 14){
            return false;
        }
        $stmt = $this->pdo->prepare("UPDATE vendedores SET matricula=?, nome=?, endereco=?, telefone=?, cpf=?, salarioBase=? WHERE id=?");
        try{
            $stmt->execute([$vendedor->getMatricula(), $vendedor->getNome(), $vendedor->getEndereco(), $vendedor->getTelefone(), $vendedor->getCpf(), $vendedor->getSalarioBase(), $vendedor->getId()]);
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
        $query = $this->pdo->prepare("DELETE FROM vendedores WHERE id = ?");
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
    public function getNextIndex(){
        $stmt = $this->pdo->prepare("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'vendedores'");
        $stmt->execute();
        $result = $stmt->fetch();
        $result = $result['auto_increment'];
        if($result < 10){
            $result = "00".$result;
        }else if($result < 100){
            $result = "0".$result;
        }
        return $result;
    }
}