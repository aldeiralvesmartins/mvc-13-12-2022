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
                <div class="form-group" >
                    <h3>Cadastro</h3>
                    <form action="/?controller=clientes&acao=cadastrar" method ="post">
                    <div class="form-group" >
                
                        <input type="text"placeholder="Nome" name="nome"></br></br>
                        </div>
                        <div class="form-group" >
                    
                        <input type="text" placeholder="CPF"name="cpf"></br></br>
                        </div>
                        <input class="btn btn-secondary" type="reset"  value="Limpar">
                        <input class="btn btn-success" type="submit" name="submit" value="Cadastrar">
                    </form>
                </div>';
  
    }
    public function editar($clientes)
    {
        
        echo " 
                <div>
                    <h3>Editar Cadastro</h3>
                    <form action='/?controller=clientes&acao=editar' method ='post'>
           
                        <input type='text'placeholder='Usuário' name='nome' value='{$clientes['nome']}'></br></br>
                   
                        <input type='text'placeholder='CPF' name='cpf' value='{$clientes['cpf']}' ></br></br>                        
                        <input type='hidden' name='id' value={$clientes['id']} ></br></br>  
                        <input class='btn btn-secondary' type='reset'  value='Limpar'>
                        <input class='btn btn-success' type='submit' name='submit' value='Cadastrar'>
                    </form>
                </div>";
    } 

}

