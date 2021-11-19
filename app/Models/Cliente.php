<?php

namespace App\Models;

use App\dao\ClienteDAO;
use http\Env\Response;

class Cliente
{
    protected $id;
    protected $nome;
    protected $endereco;
    protected $telefone;
    protected $celular;
    protected $cpf;

    public function __construct(String $nome = NULL, String $endereco = NULL, Int $telefone= NULL, Int $celular = NULL, Int $cpf = NULL)
    {
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->celular = $celular;
        $this->cpf = $cpf;
    }

//GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

//SETTERS
    public function setNome(String $nome)
    {
        $this->nome = $nome;
    }

    public function setEndereco(String $endereco)
    {
        $this->endereco = $endereco;
    }

    public function setTelefone(String $telefone)
    {
        $this->telefone = $telefone;
    }

    public function setCelular(String $celular)
    {
        $this->celular = $celular;
    }

    public function setCpf(String $cpf)
    {
        $this->cpf = $cpf;
    }

//CRUD
    public function read(int $id)
    {
        $dao = new ClienteDAO();
        $data = $dao->read($id);

        $this->id = $data["id"];
        $this->nome = $data["nome"];
        $this->endereco = $data["endereco"];
        $this->telefone = $data["telefone"];
        $this->celular = $data["celular"];
        $this->cpf = $data["cpf"];

        return $this;

    }

    public function save()
    {
        $dao =  new ClienteDAO();

        if(empty($this->id)){
            $response = $dao->create($this);
            return $response;
        }else{
            $response = $dao->update($this);
            return $response;
        }
    }

    public function delete()
    {
        if($this->hasCompras()){
            return "Usuario já possui compras";
        }else{
            $dao = new ClienteDAO();
            $response = $dao->delete($this->id);
            return $response;
        }
    }

    public function hasCompras(){
        //TODO
        return false;
    }
}
