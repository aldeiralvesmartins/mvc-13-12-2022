<?php

namespace App\Views;

class PedidosView
{



    public function index($dados)
    {
        echo '<a class="btn btn-primary" href="/?controller=pedidos&acao=cadastrar" role="button">Novo</a>';
        echo '<table class="table">';

        echo " <tr>
            <th>Id do Cliente</th>
            <th>Data</th>
            <th>Status</th>
        </tr>";
        foreach ($dados as $dado) {

            echo "<tr>
                    <td>{$dado['cliente_id']}</td>
                    <td>{$dado['data']}</td>
                    <td>{$dado['status']}</td>
                   <td><a class='btn btn-warning' href='/?controller=pedidos&acao=editar&id={$dado['id']}'>Editar</a><a class='btn btn-danger' href='/?controller=pedidos&acao=excluir&id={$dado['id']}'>Excluir</a></td>";
            echo "  </tr>";
        }
        echo '</table>';
    }
    public function cadastrar($dados)
    {

        echo ' 
                <div class="form-group" >
                    <h3>Cadastro</h3>
                    <form action="/?controller=Pedidos&acao=cadastrar" method ="post">
                        
                       
                         <select class="form-select"name="pedidos" id="pedidos" aria-label="Selecione o Cliente">
                            <option selected>Selecione o Cliente</option>';
                            foreach ($dados as $dado) {
                          echo"  <option value='1'>{$dado['cliente_id']}</option>";
                            }
                         echo ' </select>
                      
                        <div class="form-group" >
                        <input type="date"name="data"></br></br>
                        </div>
                   
                        <select class="form-group"name="pedidos" id="pedidos" aria-label="Selecione o Cliente">
                        <option selected>Selecione Status</option>';
                        foreach ($dados as $dado) {
                      echo"  <option value='{$dado['status']}'></option>";
                        }
                     echo ' </select>
           
                        <input class="btn btn-secondary" type="reset"  value="Limpar">
                        <input class="btn btn-success" type="submit" name="submit" value="Cadastrar">
                    </form>
                </div>';
    }
    public function editar($dados)
    {

        echo " 
                <div>
                    <h3>Editar Cadastro</h3>
                    <form action='/?controller=pedidos&acao=editar' method ='post'>";
           
                   echo " <select class='form-select'name='pedidos' id='pedidos' aria-label='Selecione o Cliente'>
                    <option selected>Open this select menu</option>";
                    foreach ($dados as $dado) {
                  echo"  <option value='1'>{$dado['cliente_id']}</option>";
                    }
               echo " </select>
                        <input type='text'placeholder='Usuário' name='nome' value='{$dado['nome']}'></br></br>
                   
                        <input type='text'placeholder='CPF' name='cpf' value='{$dado['cpf']}' ></br></br>                        
                        <input type='hidden' name='id' value={$dado['id']} ></br></br>  
                        <input class='btn btn-secondary' type='reset'  value='Limpar'>
                        <input class='btn btn-success' type='submit' name='submit' value='Cadastrar'>
                    </form>
                </div>";
    }
}
