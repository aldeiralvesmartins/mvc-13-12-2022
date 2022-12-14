<?php

namespace App\Controllers;

use App\Models\ProdutosModel;
use App\Views\ProdutosView;

class ProdutosController
{


    private $model;

    public $msg;

    public function __construct(ProdutosModel $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        $clientes = $this->model->getAll();
        $view = new ProdutosView();
        $view->index($clientes);
    }


    public function cadastrar()
    {
           $view = new ProdutosView();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $clientes = $this->model->cadastrar($_POST);
            $clientes = $this->model->getAll();
            $view->index($clientes);
        } else {

            $view->cadastrar();
        }
    }

    public function editar($id = null)
    {
        $view = new ProdutosView();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $clientes = $this->model->editar($_POST);
            $clientes = $this->model->getAll();
            $view->index($clientes);
        } else {
            $clientes = $this->model->getById($id);
            $view->editar(@$clientes);
        }
    }

    public function excluir($id = null)
    {
        $view = new ProdutosView();
        $this->model->excluir($id);
        $this->msg = 'Cliente Excluido';
        $view->index($this->model->getAll());
    }
}
