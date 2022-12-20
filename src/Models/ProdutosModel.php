<?php

namespace App\Models;

use App\Conexao\Conexao;
use Exception;
use PDO;

class ProdutosModel extends Conexao
{
    public $dados=[];

    public function __construct()
    {
        parent::__construct();
        $this->dados['nome']=null;
        $this->dados['valor']=null;
    }

    public function cadastrar($dados)
    {
        $cmd = $this->conn->prepare("SELECT id FROM produtos WHERE nome = :n ");
        $cmd->bindValue(":n", $dados['nome']);
        $cmd->execute();
        if ($cmd->rowcount() > 0)
         { echo "<div class='alert alert-primary' role='alert'>Produto já foi cadastrado</div>";
            return false;
        } else {
            $cmd = $this->conn->prepare("INSERT INTO  produtos (nome, valor) VALUES (:n, :v)");
            $cmd->bindValue(":n", $dados['nome']);
            if($dados['valor'] > 0){
            $cmd->bindValue(":v", $dados['valor']);
            $cmd->execute();
             } else{
                echo "<div class='alert alert-primary' role='alert'>Valor deve ser maior que 0</div>";
            }
        } 
        $this->dados['nome']=null;
        $this->dados['valor']=null;
    }

    public function getAll()
    {
        $res = array();
        $cmd = $this->conn->prepare("SELECT * FROM produtos");
        $cmd->execute();
        $res = $cmd->fetchAll();
        return $res;
    }


    public function excluir($id)
    { 
        try{
            $cmd = $this->conn->prepare("DELETE FROM produtos where id = '$id'");
            $cmd->execute();
        }catch(\Exception $e){
            throw new Exception('Produto já foi vinculado a um pedido', $e->getCode());
        }
        
    }

    public function editar($dados)
    {
        $cmd = $this->conn->prepare("UPDATE produtos SET nome = :n, valor = :v WHERE id = :id");
        $cmd->bindValue(":v", $dados['valor']);
        $cmd->bindValue(":n", $dados['nome']);
        $cmd->bindValue(":id", $dados['id']);
        $cmd->execute();
        return $cmd->fetchAll();
    }

    public function getById($id)
    {
        $res = array();
        $cmd = $this->conn->prepare("SELECT * FROM produtos where id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }

    public function getList()
    {
        $res = array();
        $cmd = $this->conn->prepare("SELECT id, nome FROM produtos order by nome asc");
        $cmd->execute();        
        return $cmd->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}
