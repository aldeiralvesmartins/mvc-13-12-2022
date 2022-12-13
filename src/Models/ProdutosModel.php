<?php

namespace App\Models;


use mysqli;

define('BD_SERVIDOR', 'localhost:3306');
define('BD_USUARIO', 'root');
define('BD_SENHA', 'r2147258369');
define('BD_BANCO', 'app_db2');

class ProdutosModel
{

    protected $mysqli;

    public function __construct(){
        $this->conexao();
    }

    private function conexao(){
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO , BD_SENHA, BD_BANCO);
    }

    public function setProduto($nome,$valor){
        $stmt = $this->mysqli->prepare("INSERT INTO Produtos (`nome`,`valor`) VALUES (?,?)");
        $stmt->bind_param("ss",$nome,$valor);
         if( $stmt->execute() == TRUE){
            return true ;
        }else{
            return false;
        }

    }

    public function getProduto(){
        $result = $this->mysqli->query("SELECT * FROM Produtos");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;

    }

    public function deleteproduto($id){
        if($this->mysqli->query("DELETE FROM `Produtos` WHERE `nome` = '".$id."';")== TRUE){
            return true;
        }else{
            return false;
        }

    }
    public function pesquisaProduto($id){
        $result = $this->mysqli->query("SELECT * FROM Produtos WHERE nome='$id'");
        return $result->fetch_array(MYSQLI_ASSOC);

    }
    public function updateProduto($nome,$valor,$id){
        $stmt = $this->mysqli->prepare("UPDATE `Produtos` SET `nome` = ?, `valor`=? WHERE `nome` = ?");
        $stmt->bind_param("sss",$nome,$valor,$id);
        if($stmt->execute()==TRUE){
            return true;
        }else{
            return false;
        }
    }
    public function validaDados($usuario, $senha)
    {

        /* Aplica a validação ao usuário e senha passados, utilizando as regras de négocio especificas para ele. */
        if (strlen($usuario) < 5) {

            return 'Digite o usuário corretamente';
        } else if (strlen($senha) < 8) {

            return 'A senha deve possuir mais de 8 caracteres';
        } else {

            return 'Login efetuado com sucesso';
        }
    }
}
