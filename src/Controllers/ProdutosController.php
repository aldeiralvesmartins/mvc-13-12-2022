<?php
namespace App\Controllers;

use App\Models\ProdutosModel;
use App\Views\ProdutosView;

class ProdutosController {


    private $model;

    public function __construct(ProdutosModel $model)
    { 
        $this->model = $model;
    }

    public function Produto() {
        $clientes = $this->model->getProduto();
        $view = new ProdutosView();
        $view->index($clientes);

    }

    public function incluir()
    {

        $validacao = $this->model->validaDados($_POST['usuario'],$_POST['senha']);

        /* Pega o resultado da validação realizada no Models e o encaminha para ser exibido pela Views */
        $view = new ProdutosView();
        $view->login($validacao);

    }



}
