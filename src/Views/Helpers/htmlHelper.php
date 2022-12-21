<?php

namespace App\Views\Helpers;

class  htmlHelper
{

    public static function getSelect($dados, $name, $label, $selected = null, $titulo = null)
    {
        $select = "  <div class='form-row'>
        <div class='col-md-6 mb-3'>
         <label>{$titulo}</label>";
        $select .= "<select  class='custom-select' id='inputGroupSelect01' name={$name} aria-label='Selecione o Cliente'required>";
        if (!$selected)
            $select .= "<option  value='{$selected}'>{$label}</option>";

        foreach ($dados as $chave => $value) {
            if ($selected == $chave) {
                $select .= "<option selected value='{$chave}'>{$value}</option>";
            } else
                $select .= "  <option value='{$chave}'>{$value}</option>";
        }
        $select .= '</select></div>';
        return $select;
    }
    //----------------->>>>>>>>>>>>>>>>tabela de clientes/produtos)<<<<<<<<<<<<<<<<<<<--------------------
    public static function getTable($dados, $cpf, $controller = null)
    {
        $tabela = "<a class='btn btn-primary' href='/?controller={$controller}&acao=cadastrar' role='button'>Novo</a> 
                            </br><br><br>
                            <table class='table'>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>";
        if ($cpf) {
            $tabela .= "<th>CPF</th>";
        } else {
            $tabela .=  "<th>Valor</th>";
        }
        $tabela .= " <th></th>
                           </tr>";
        foreach ($dados as $dado) {
            $tabela .=  "<tr>
                                <td>{$dado['id']}</td>
                                <td>{$dado['nome']}</td>";
            if ($cpf) {
                $tabela .=  "  <td>{$dado['cpf']}</td>";
            } else {
                $tabela .= "  <td>R$ " . number_format($dado['valor'], 2, ',', '.') . "</td>";
            }
            $tabela .=  "  <td><a class='btn btn-primary' type='button' href='/?controller={$controller}&acao=editar&id={$dado['id']}'>Editar</a>
                        <button class='btn btn-danger''data-id='1' type='button' onclick=getValue({$dado['id']}) data-toggle='modal' data-target='#confirma'>Excluir</button>

                        <div id='confirma' class='modal fade' tabindex='-1' role='dialog'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header bootstrap-dialog-draggable' style='background: #f0ad4e; border-radius: 6px 6px 0 0;'>
                                   
                                    <h4 class='modal-title'>Confirma a gravação dos dados ?</h4>
                                </div>
                                <div class='modal-body'>
                                    <p>Tem certeza que deseja excluir</p>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' id='btn-nao' class='btn btn-primary' data-dismiss='modal'>
                                        Voltar
                                    </button>
                                    <a class='btn btn-danger' id='excluir'>Excluir</a>
                                       
                               
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                     </div><!-- /.modal --> </td>
                    
                    <td></td>
                  </tr>
                <script> function getValue(id) {

                    let element = document.getElementById('excluir');
                    element.setAttribute('href', '?controller={$controller}&acao=excluir&id=' + id)

                }
                  </script>";
                  
        }                  
        $tabela .= "</table><hr>";
        echo $tabela;
    }
    //----------------->>>>>>>>>>>>>>>>>>fomulario de cadastro/Editar (clientes,produtos)<<<<<<<<<<<<<<<<<<<--------------------
    public static function getForm($dados, $titulo, $acao, $controller, $placeholder, $placeholder2, $value)
    {
        $form = " 
              <div class='form-group' >
                      <h3>{$titulo}</h3>";
        $form .= " <form action='/?controller={$controller}&acao={$acao}' method ='post'> ";
        if ($value == true) {
            $form .= "  <div class='form-row'>
                            <div class='col'>
                            <input type='text' name='nome' class='form-control' placeholder='{$placeholder}' value='{$dados['nome']}'required>
                            </div>
                            <div class='col'>
                 <input type='text' name='valor' class='form-control' placeholder='{$placeholder2}' value='{$dados['valor']}'required>
              </div>";
        } else {
            $form .= "  <div class='form-row'>
            <div class='col'>
            <input type='text' name='nome' class='form-control' placeholder='{$placeholder}' value='{$dados['nome']}'required>
            </div>
            <div class='col'>
            <input type='text' name='cpf' oninput='mascara(this)' class='form-control' placeholder='{$placeholder2}' value='{$dados['cpf']}'required>
            </div>";
        }
        if (!empty($dados['id']))
            $form .= "<input type='hidden' name='id' value={$dados['id']} >";
        $form .= "</div><br>
                        <div>";
        if ($acao == 'cadastrar')
            $form .= " <input class='btn btn-secondary' type='reset'  value='Limpar'>";
        $form .= "  <input class='btn btn-success my' type='submit' name='submit' value='{$acao}'>
                        </div>
                    </form>
                </div>        
                <script>
                function mascara(i){
                
                var v = i.value;
                
                if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
                   i.value = v.substring(0, v.length-1);
                   return;
                }
                
                i.setAttribute('maxlength', '14');
                if (v.length == 3 || v.length == 7) i.value += '.';
                if (v.length == 11) i.value += '-';
             
             } 
             </script> ";
        echo $form;
    }
}