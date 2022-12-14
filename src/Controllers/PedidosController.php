<?php

namespace App\Controllers;

use App\Models\PedidosModel;
use App\Views\PedidosView;

class PedidosController
{


    private $model;

    public $msg;

    public function __construct(PedidosModel $model)
    {
        $this->model = $model;
    }


    public function index()
    {


        $pedidos = $this->model->getAll();
        $view = new PedidosView();

        $view->index($pedidos);
    }

    public function cadastrar()
    {
    
        $view = new PedidosView();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $clientes = $this->model->cadastrar($_POST);
            $clientes = $this->model->getAll();
            $view->index($clientes);
        } else {

            $view->cadastrar($_POST);
        }
    }

    public function editar($id = null)
    {
        $view = new PedidosView();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pedidos = $this->model->editar($_POST);
            $pedidos = $this->model->getAll();
            $view->index($pedidos);
        } else {
            $pedidos = $this->model->getById($id);
            $view->editar(@$pedidos);
        }
    }

    public function excluir($id = null)
    {
        $view = new PedidosView();
        $this->model->excluir($id);
        $this->msg = 'Pedido Excluido';
        $view->index($this->model->getAll());
    }
}
