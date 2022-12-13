<?php

namespace App\Views;

class ClientesView
{


    public function login()
    {

    }

    public function index($dados)
    {
        echo '<a class="btn btn-primary" href="/?controller=clientes&acao=cadastrar" role="button">Novo</a>';
        echo '<table class="table">';

        echo " <tr>
            <th>Nome</th>
            <th>CPF</th>
        </tr>";
    foreach ($dados as $dado) {
        
            echo "<tr>
                    <td>{$dado['nome']}</td>
                    <td>{$dado['cpf']}</td>
                   <td><a class='btn btn-warning' href='/?controller=clientes&acao=editar&id={$dado['id']}'>Editar</a><a class='btn btn-danger' href='/?controller=clientes&acao=excluir&id={$dado['id']}'>Excluir</a></td>";
            echo "  </tr>";
        }
        echo '</table>';
    }
    public function cadastrar()
    {
      

        
        echo ' 
                <div>
                    <h3>Cadastro</h3>
                    <form action="/?controller=clientes&acao=cadastrar" method ="post">
                        Usuário:
                        <input type="text" name="nome"></br></br>
                        CPF:
                        <input type="text" name="cpf"></br></br>
                        <input class="botao" type="reset"  value="Limpar">
                        <input class="botao" type="submit" name="submit" value="Cadastrar">
                    </form>
                </div>';
  
    }
    public function editar($clientes)
    {
        
        echo " 
                <div>
                    <h3>Editar Cadastro</h3>
                    <form action='/?controller=clientes&acao=editar' method ='post'>
                        Usuário:
                        <input type='text' name='nome' value='{$clientes['nome']}'></br></br>
                        CPF:
                        <input type='text' name='cpf' value='{$clientes['cpf']}' ></br></br>                        
                        <input type='hidden' name='id' value={$clientes['id']} ></br></br>  
                        <input class='botao' type='reset'  value='Limpar'>
                        <input class='botao' type='submit' name='submit' value='Cadastrar'>
                    </form>
                </div>";
    } 
}

