<?php

namespace App\Views;

class ClientesView
{


    private function getForm($clientes, $titulo)
    {
        $form = " 
        <div class='form-group' >
                     <h3>{$titulo}</h3>
                     <form action='/?controller=clientes&acao=cadastrar' method ='post'>                     
                        <div class='form-row'>
                            <div class='col'>
                                <input type='text' name='nome' class='form-control' placeholder='Nome do usuario' value='{$clientes['nome']}'>
                            </div>
                            <div class='col'>
                                <input type='text' name='cpf' class='form-control' placeholder='cpf' value='{$clientes['cpf']}'>
                            </div>";
                            if(!empty($clientes['id']))
                                $form .= "<input type='hidden' name='id' value={$clientes['id']} >"; 
            $form .= "</div><br>
                        <div>
                            <input class='btn btn-secondary' type='reset'  value='Limpar'>
                            <input class='btn btn-success' type='submit' name='submit' value='Cadastrar'>
                        </div>
                    </form>
                </div> ";

        echo $form;
    }

    public function index($dados)
    {
        echo '<a class="btn btn-primary" href="/?controller=clientes&acao=cadastrar" role="button">Novo</a>';
        echo '<table class="table">';

        echo " <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
        </tr>";
    foreach ($dados as $dado) {
        
            echo "<tr>
                    <td>{$dado['id']}</td>
                    <td>{$dado['nome']}</td>
                    <td>{$dado['cpf']}</td>
                   <td><a class='btn btn-warning' href='/?controller=clientes&acao=editar&id={$dado['id']}'>Editar</a><a class='btn btn-danger' href='/?controller=clientes&acao=excluir&id={$dado['id']}'>Excluir</a></td>";
            echo "  </tr>";
        }
        echo '</table>';
    }
    public function cadastrar($dados)
    {
        $this->getForm($dados, 'Cadastrando');

    }
    public function editar($produtos)
    {
        $this->getForm($produtos, 'Editando');        
    }
}

