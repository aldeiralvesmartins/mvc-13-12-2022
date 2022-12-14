<?php

namespace App\Views;

class ProdutosView
{


    public function index($dados)
    {
        echo '<a class="btn btn-primary" href="/?controller=produtos&acao=cadastrar" role="button">Novo</a>';
        echo '<table class="table">';

        echo " <tr>
            <th>Nome</th>
            <th>Valor</th>
        </tr>";
    foreach ($dados as $dado) {
        
            echo "<tr>
                    <td>{$dado['nome']}</td>
                    <td>{$dado['valor']}</td>
                   <td><a class='btn btn-warning' href='/?controller=produtos&acao=editar&id={$dado['id']}'>Editar</a><a class='btn btn-danger' href='/?controller=produtos&acao=excluir&id={$dado['id']}'>Excluir</a></td>";
            echo "  </tr>";
        }
        echo '</table>';
    }
    public function cadastrar()
    {

        echo ' 
                <div class="form-group" >
                    <h3>Cadastro</h3>
                    <form action="/?controller=produtos&acao=cadastrar" method ="post">
                    <div class="form-group" >
                
                        <input type="text"placeholder="Nome" name="nome"></br></br>
                        </div>
                        <div class="form-group" >
                    
                        <input type="text" placeholder="Valor"name="valor"></br></br>
                        </div>
                        <input class="btn btn-secondary" type="reset"  value="Limpar">
                        <input class="btn btn-success" type="submit" name="submit" value="Cadastrar">
                    </form>
                </div>';
  
    }
    public function editar($produtos)
    {
        
        echo " 
                <div>
                    <h3>Editar Cadastro</h3>
                    <form action='/?controller=produtos&acao=editar' method ='post'>
           
                        <input type='text'placeholder='Usuário' name='nome' value='{$produtos['nome']}'></br></br>
                   
                        <input type='text'placeholder='Valor' name='valor' value='{$produtos['valor']}' ></br></br>                        
                        <input type='hidden' name='id' value={$produtos['id']} ></br></br>  
                        <input class='btn btn-secondary' type='reset'  value='Limpar'>
                        <input class='btn btn-success' type='submit' name='submit' value='Cadastrar'>
                    </form>
                </div>";
    } 

}

