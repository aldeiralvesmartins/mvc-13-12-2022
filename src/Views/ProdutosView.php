<?php

namespace App\Views;

use App\Views\Helpers\htmlHelper;

class ProdutosView
{
    public function index($dados)
    {
        htmlHelper::getTable($dados,$cpf=false,'produtos');
    }
    public function cadastrar($produtos)
    {
        htmlHelper::getForm($produtos, 'Cadastrando', 'cadastrar','produtos','Nome do Produto','Valor',true);
    }
    public function editar($produtos)
    {
        htmlHelper::getForm($produtos, 'Editando', 'editar','produtos','','',true);
    }
}
