<?php

namespace App\Models;

use App\dao\CompraDAO;
use App\dao\VendedorDAO;

class Vendedor
{
    protected $id;
    protected $matricula;
    protected $nome;
    protected $endereco;
    protected $telefone;
    protected $cpf;
    protected $salarioBase;

    public function __construct(string $nome = NULL, string $endereco = NULL, int $telefone = NULL, string $cpf = NULL, float $salarioBase = NULL)
    {
        $this->matricula = $this->generateMatricula();
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->cpf = $cpf;
        $this->salarioBase = $salarioBase;
    }


    public function read($id){

        $dao = new VendedorDAO();
        $data = $dao->read($id);

        $this->id = $data["id"];
        $this->matricula = $data["matricula"];
        $this->nome = $data["nome"];
        $this->endereco = $data["endereco"];
        $this->telefone = $data["telefone"];
        $this->cpf = $data["cpf"];
        $this->salarioBase = $data["salarioBase"];

        return $this;
    }

    public function save()
    {
        $dao =  new VendedorDAO();

        if(empty($this->id)){
            $response = $dao->create($this);
            return $response;
        }else{
            $response = $dao->update($this);
            return $response;
        }
    }

    public function delete(){
        $dao = new VendedorDAO();
        $result = $dao->delete($this->id);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * @param mixed $matricula
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getSalarioBase()
    {
        return $this->salarioBase;
    }

    /**
     * @param mixed $salarioBase
     */
    public function setSalarioBase($salarioBase)
    {
        $this->salarioBase = $salarioBase;
    }
    private function generateMatricula(){
        $dao = new VendedorDAO();
        $nextIndex = $dao->getNextIndex();
        $matricula = date("Ymd").$nextIndex;
        return $matricula;
    }


}