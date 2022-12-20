<?php

namespace App\Views;

use App\Views\Helpers\htmlHelper;

class ClientesView
{
    public function index($dados)
    {
        htmlHelper::getTable($dados, $cpf = true, 'clientes');
    }
    public function cadastrar($cliente)
    {
        htmlHelper::getForm($cliente, 'Cadastrando', 'cadastrar', 'clientes','Nome do Cliente','CPF',false);
    }
    public function editar($cliente)
    {
        htmlHelper::getForm($cliente, 'Editando', 'editar', 'clientes','','','');
    }
}
