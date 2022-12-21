<?php

namespace App\Models;

use App\Conexao\Conexao;
use Exception;
use PDO;

class ClientesModel extends Conexao
{   
    public $dados=[];
    public $msgDanger;

    public function __construct()
    {
        parent::__construct();
        $this->dados['nome'] = null;
        $this->dados['cpf'] = null;
    
    }

    private function validaCPF($cpf) 
    {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    
    }

    public function cadastrar($dados)
    {
        $cmd = $this->conn->prepare("SELECT id  FROM clientes WHERE cpf = :c");
        $cmd->bindValue(":c", $dados['cpf']);
        $cmd->execute();

        if ($cmd->rowcount() > 0) {
            echo "<div class='alert alert-primary' role='alert'>Usuario já existe</div>";
            return false;
     
        } else
        {
            $cmd = $this->conn->prepare("INSERT INTO  clientes (nome, cpf) VALUES (:n, :c)");
            $cmd->bindValue(":n", $dados['nome']);
            $cmd->bindValue(":c", $dados['cpf']);
            $ret =$this->validaCPF($dados['cpf']);
            if($ret == true){
                 $cmd->execute();
            }else{
      
                echo "<div class='alert alert-primary' role='alert'>CPF invalido</div>";
            }
           
         
           
            
        }
    }

    public function getAll()
    {
 
        $cmd = $this->conn->prepare("SELECT * FROM clientes");
        $cmd->execute();
        $res = $cmd->fetchAll();
        return $res;
    }

    public function excluir($id)
    {
        try{
            $cmd = $this->conn->prepare("DELETE FROM clientes where id = '$id'");
            return $cmd->execute();
        }catch(\Exception $e)
        {
            
            throw new Exception('Cliente já foi vinculado a um pedido',$e->getCode());
        }
        
    }

    public function editar($dados)
    {
        $cmd = $this->conn->prepare("UPDATE clientes SET cpf = :c, nome = :n WHERE id = :id");
        $cmd->bindValue(":c", $dados['cpf']);
        $cmd->bindValue(":n", $dados['nome']);
        $cmd->bindValue(":id", $dados['id']);
        $ret =$this->validaCPF($dados['cpf']);
        if($ret == true){
             $cmd->execute();
        }else{
  
            echo "<div class='alert alert-primary' role='alert'>CPF invalido</div>";
        }
        return $cmd->fetchAll();
    }

    public function getById($id)
    {
        $res = array();
        $cmd = $this->conn->prepare("SELECT * FROM clientes where id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getList(){
        $res = array();
        $cmd = $this->conn->prepare("SELECT id, nome FROM clientes order by nome asc");
        $cmd->execute();        
        return $cmd->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}
