<?php

namespace App\Models;

use App\dao\ProdutoDAO;

class Produto
{
    protected $id;
    protected $descricao;
    protected $valor;
    protected $qtdEstoque;
    protected $estoqueMinimo;
    protected $validade;



    //GETTERS

    /**
     * @param $descricao
     * @param $valor
     * @param $qtdEstoque
     * @param $estoqueMinimo
     * @param $validade
     */
    public function __construct($descricao = NULL, $valor = NULL, $qtdEstoque = NULL, $estoqueMinimo = NULL, $validade = NULL)
    {
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->qtdEstoque = $qtdEstoque;
        $this->estoqueMinimo = $estoqueMinimo;
        $this->validade = $validade;
    }

    public function read($id){

        $dao = new ProdutoDAO();
        $data = $dao->read($id);

        $this->id = $data["id"];
        $this->descricao = $data["descricao"];
        $this->valor = $data["valor"];
        $this->qtdEstoque = $data["qtdEstoque"];
        $this->estoqueMinimo = $data["estoqueMinimo"];
        $this->validade = $data["validade"];

        return $this;
    }

    public function save()
    {
        $dao =  new ProdutoDAO();

        if(empty($this->id)){
            $response = $dao->create($this);
            return $response;
        }else{
            $response = $dao->update($this);
            return $response;
        }
    }

    public function delete(){
        $dao = new ProdutoDAO();
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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @return mixed
     */
    public function getQtdEstoque()
    {
        return $this->qtdEstoque;
    }

    /**
     * @return mixed
     */
    public function getEstoqueMinimo()
    {
        return $this->estoqueMinimo;
    }

    /**
     * @return mixed
     */
    public function getValidade()
    {
        return $this->validade;
    }

    //SETTERS

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @param mixed $qtdEstoque
     */
    public function setQtdEstoque($qtdEstoque)
    {
        $this->qtdEstoque = $qtdEstoque;
    }

    /**
     * @param mixed $estoqueMinimo
     */
    public function setEstoqueMinimo($estoqueMinimo)
    {
        $this->estoqueMinimo = $estoqueMinimo;
    }

    /**
     * @param mixed $validade
     */
    public function setValidade($validade)
    {
        $this->validade = $validade;
    }

    public function deleteProduto(){

    }

}