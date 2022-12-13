<?php

namespace App\Views;

class ProdutosView
{


    public function login($validacao = null)
    {

        if (!isset($validacao)) {
            /* Exibe o formulário de login, onde será realizada a requisição pelo usuário */
            echo ' 
					<div>
						<h3>Login</h3>
						<form action="/?controller=clientes&acao=incluir" method ="post">
							Usuário:
							<input type="text" name="usuario"></br></br>
							Senha:
							<input type="password" name="senha"></br></br>
							<input class="botao" type="reset"  value="Limpar">
							<input class="botao" type="submit" name="submit" value="Logar">
						</form>
					</div>';
        } else {

            /* Exibe o resultado da validação do login feita pela Models */
            echo '<h3>' . $validacao . '</h3>';
            var_dump($validacao);exit;
        }
    }

    public function index($dados)

    {
        echo '<table class="table">';

        echo " <tr>
            <th>Nome</th>
            <th>Valor</th>
        </tr>";

        foreach ($dados as $index => $dado) {
            echo "<tr>
                    <td>{$dado['nome']}</td>
                    <td>{$dado['valor']}</td>
                   <td><a class='btn btn-warning' href='#'>Editar</a><a class='btn btn-danger' href='#'>Excluir</a></td>";
            echo "  </tr>";
        }
        echo '</table>';
    }
}
