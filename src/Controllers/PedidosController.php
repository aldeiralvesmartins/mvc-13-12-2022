<?php

namespace App\Controllers;

use App\Models\ClientesModel;
use App\Models\PedidosModel;
use App\Models\ProdutosModel;
use App\Models\ItensPedidosModel;
use App\Views\PedidosView;


class PedidosController
{
    private $pedido;
    private $clientesModel;
    private $produtosModel;
    private $itensPedido;
    public $msg;
    public $msgDanger;
    public $status=['Aberto'=>'Aberto', 'Pago'=>'Pago', 'Cancelado'=>'Cancelado'];

    public function __construct(
        PedidosModel $model,
        ClientesModel $clientes,
        ProdutosModel $produtos,
        ItensPedidosModel $itensPedido
    ) {
        $this->pedido = $model;
        $this->clientesModel = $clientes;
        $this->produtosModel = $produtos;
        $this->itensPedido = $itensPedido;
    }

    public function index()
    {
        $pedidos = $this->pedido->getAll();
        $view = new PedidosView();
        $view->index($pedidos);
    }

    public function cadastrar()
    {
        $view = new PedidosView();
        $clientes = $this->clientesModel->getList();
        $produtos = $this->produtosModel->getList();
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $itens = $_POST['itens_pedido'];
            $itens['pedido_id'] = $this->pedido->cadastrar($_POST['pedido']);

            $this->itensPedido->cadastrar($itens);
            $pedidos = $this->pedido->getAll();
            $view->index($pedidos);
        } else 
        {
         $view->cadastrar($clientes, $produtos);
        }
    }

    public function editar($id = null)
    {
        $view = new PedidosView();   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pedidos = $this->pedido->editar($_POST);
            $pedidos = $this->pedido->getAll();
            $view->index($pedidos);
        } else 
        {
            $pedido['clientes'] = $this->clientesModel->getList();
            $pedido['produtos'] = $this->produtosModel->getList();
            $pedido['pedido'] = $this->pedido->getById($id);
            $pedido['itens'] = $this->itensPedido->getByPedidoId($id);
            $pedido['status'] = $this->status;
            $view->editar($pedido);
        }
    }

    public function excluir($id = null)
    {
        $view = new PedidosView();
        try {
        $this->pedido->excluir($id);
        $this->msg = 'Pedido Excluido';
    } catch (\Exception $e) {
        $this->msgDanger = $e->getMessage();
    }
        $view->index($this->pedido->getAll());
    }
}
