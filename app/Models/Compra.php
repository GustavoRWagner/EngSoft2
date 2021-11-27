<?php

namespace App\Models;

use App\dao\CompraDAO;

class Compra
{
    protected $id;
    protected $vendedor;
    protected $cliente;
    protected $produto;
    protected $qtd;
    protected $valor;
    protected $valorDesconto;
    protected $valorTotal;
    protected $parcelas;
    protected $valorParcela;
    protected $formaPagamento;
    protected $dtVenda;

    /**
     * @param $vendedor
     * @param $cliente
     * @param $produto
     * @param $valor
     * @param $valorDesconto
     * @param $valorTotal
     * @param $parcelas
     * @param $valorParcela
     * @param $formaPagamento
     */
    public function __construct($vendedorID = NULL, $clienteID = NULL, $produtoID = NULL, $qtd = NULL, $valor = NULL, $valorDesconto = NULL, $valorTotal = NULL, $parcelas = NULL, $valorParcela = NULL, $formaPagamento = NULL)
    {
        $this->vendedor = $vendedorID;
        $this->cliente = $clienteID;
        $this->produto = $produtoID;
        $this->qtd = $qtd;
        $this->valor = $valor;
        $this->valorDesconto = $valorDesconto;
        $this->valorTotal = $valorTotal;
        $this->parcelas = $parcelas;
        $this->valorParcela = $valorParcela;
        $this->formaPagamento = $formaPagamento;
    }

    public function save()
    {
        $dao =  new CompraDAO();

        if(empty($this->id)){
            $response = $dao->create($this);
            return $response;
        }else{
            $response = $dao->update($this);
            return $response;
        }
    }

    public function read($id){

        $dao = new CompraDAO();
        $data = $dao->read($id);

        $this->id = $data["id"];
        $this->vendedor = $data["vendedor"];
        $this->cliente = $data["cliente"];
        $this->produto = $data["produto"];
        $this->qtd = $data["qtd"];
        $this->valor = $data["valor"];
        $this->valorDesconto = $data["valorDesconto"];
        $this->valorTotal = $data["valorTotal"];
        $this->parcelas = $data["parcelas"];
        $this->valorParcela = $data["valorParcela"];
        $this->formaPagamento = $data["formaPagamento"];
        $this->dtVenda = $data["dtVenda"];

        return $this;
    }

    public function delete(){
        $dao = new CompraDAO();
        $result = $dao->delete($this->id);
        return $result;
    }
    /**
     * @return mixed
     */
    public function getQtd()
    {
        return $this->qtd;
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
    public function getDtVenda()
    {
        return $this->dtVenda;
    }
    /**
     * @return Vendedor
     */
    public function getVendedor()
    {
        return $this->vendedor;
    }

    /**
     * @param mixed $vendedor
     */
    public function setVendedor($vendedor)
    {
        $this->vendedor = $vendedor;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * @param int $produto
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param float $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @return mixed
     */
    public function getValorDesconto()
    {
        return $this->valorDesconto;
    }

    /**
     * @param float $valorDesconto
     */
    public function setValorDesconto($valorDesconto)
    {
        $this->valorDesconto = $valorDesconto;
    }

    /**
     * @return mixed
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * @param float $valorTotal
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;
    }

    /**
     * @return mixed
     */
    public function getParcelas()
    {
        return $this->parcelas;
    }

    /**
     * @param int $parcelas
     */
    public function setParcelas($parcelas)
    {
        $this->parcelas = $parcelas;
    }

    /**
     * @return mixed
     */
    public function getValorParcela()
    {
        return $this->valorParcela;
    }

    /**
     * @param float $valorParcela
     */
    public function setValorParcela($valorParcela)
    {
        $this->valorParcela = $valorParcela;
    }

    /**
     * @return mixed
     */
    public function getFormaPagamento()
    {
        return $this->formaPagamento;
    }

    /**
     * @param string $formaPagamento
     */
    public function setFormaPagamento($formaPagamento)
    {
        $this->formaPagamento = $formaPagamento;
    }



}