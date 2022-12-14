<?php

namespace App\Controllers;

use App\Models\ClientesModel;
use App\Views\ClientesView;

class ClientesController
{


    private $model;

    public $msg;

    public function __construct(ClientesModel $model)
    {
        $this->model = $model;
    }


    public function index()
    {


        $clientes = $this->model->getAll();
        $view = new ClientesView();

        $view->index($clientes);
    }

    public function incluir()
    {
        $view = new ClientesView();
        $view->login();
    }

    public function cadastrar()
    {
           $view = new ClientesView();
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
        $view = new ClientesView();
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
        $view = new ClientesView();
        $this->model->excluir($id);
        $this->msg = 'Cliente Excluido';
        $view->index($this->model->getAll());
    }
}
