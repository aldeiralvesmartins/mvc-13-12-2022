<?php

namespace App\Views;

use App\Views\Helpers\htmlHelper;

class PedidosView
{
    
    public function index($dados)
    {
        echo '<a class="btn btn-primary" href="/?controller=pedidos&acao=cadastrar" role="button">Novo</a>';
        echo '<table class="table">';
        echo " <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Data</th>
            <th>Status</th>
        </tr>";
        foreach ($dados as $dado) {
            echo "<tr>
                    <td>{$dado['id']}</td>
                    <td>{$dado['nome']}</td>
                    <td>{$dado['data']}</td>
                    <td>{$dado['status']}</td>
                   <td><a class='btn btn-warning' href='/?controller=pedidos&acao=editar&id={$dado['id']}'>Editar</a><a class='btn btn-danger' href='/?controller=pedidos&acao=excluir&id={$dado['id']}'>Excluir</a></td>";
            echo "  </tr>";
        }
        echo '</table>';
    }
    public function cadastrar($clientes = null, $produtos = null)
    {

        echo ' 
                <div class="form-group" >
                    <h3>Cadastro</h3>
                    <form action="/?controller=pedidos&acao=cadastrar" method ="post">';
        echo htmlHelper::getSelect($clientes, 'pedido[cliente_id]', 'Selecione um cliente','','Nome');
        echo '          <div class="col-md-6 mb-3">
                        <label>Data</label>
                        <input type="date" class="form-control" name="pedido[data]">
                        </div>
                       ';
        echo htmlHelper::getSelect($produtos, 'itens_pedido[produto_id]', 'Selecione um produto','','Produto');
        echo ' 
                      <div class="col-md-3 mb-3">
                        <label>Valor</label>
                        <input type="text" class="form-control" placeholder="Valor" name="itens_pedido[valor_unitario]" required>
                      </div>

                      <div class="col-md-3 mb-3">
                        <label>Quantidade</label>
                        <input type="text" class="form-control" placeholder="Quantidade" name="itens_pedido[quantidade]" required>
                      </div> 
                      <div class="col-md-3 mb-5" >
                      <label>Status</label>
                        <select class="custom-select"name="pedido[status]" id="status" aria-label="Selecione o Cliente">
                        <option >Selecione Status</option>
                        <option >Aberto</option>
                        <option >Pago</option>
                        <option >Cancelado</option>
                        </select></div>
                        <div class="col-md-10" >
                        <input class="btn btn-secondary" type="reset"  value="Limpar">
                        <input class="btn btn-success" type="submit" name="submit" value="Cadastrar">
                        </div><br><br>
                    </form>
                </div>';
    }
    public function editar($pedido = null)
    {

        echo "
        <div class='form-group' >
            <h3>Editar</h3>
            <form action='/?controller=pedidos&acao=editar' method ='post'>";
            echo htmlHelper::getSelect($pedido['clientes'], 'pedido[cliente_id]', 'Selecione um cliente', $pedido['pedido']['cliente_id'],'Nome');
echo "          <div class='col-md-6 mb-3'>
                <label>Data</label>
                <input type='date' class='form-control' name='pedido[data]' value='{$pedido['pedido']['data']}'>
                </div>";
               echo htmlHelper::getSelect($pedido['produtos'], 'itens_pedido[produto_id]', 'Selecione um produto', $pedido['itens']['produto_id'],'Produto');
   echo "    <div class='col-md-3 mb-3'>
                <label>Valor</label>
                <input type='text' class='form-control' placeholder='Valor' name='itens_pedido[valor_unitario]' value='{$pedido['itens']['valor_unitario']}' required>
              </div>

              <div class='col-md-3 mb-3'>
                <label>Quantidade</label>
                <input type='text' class='form-control' placeholder='Quantidade' name='itens_pedido[quantidade]' value='{$pedido['itens']['quantidade']}' required>
              </div>  ";
              echo htmlHelper::getSelect($pedido['status'], 'pedido[status]', 'Selecione um status', $pedido['pedido']['status'],'Status');
               echo "<div class='col-md-10'>
                <input class='btn btn-secondary' type='reset'  value='Limpar'>
                <input class='btn btn-success' type='submit' name='submit' value='Cadastrar'> 
                </div>
            </form>
        </div>";


    }
}
