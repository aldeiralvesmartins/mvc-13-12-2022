<?php

namespace App\Models;

use App\Conexao\Conexao;
use PDO;

class ProdutosModel extends Conexao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function cadastrar($dados)
    {
        $cmd = $this->conn->prepare("SELECT id FROM produtos WHERE nome = :n");
        $cmd->bindValue(":n", $dados['nome']);
        $cmd->execute();

        if ($cmd->rowcount() > 0) {
            return false;
        } else {
            $cmd = $this->conn->prepare("INSERT INTO  produtos (nome, valor) VALUES (:n, :v)");
            $cmd->bindValue(":n", $dados['nome']);
            $cmd->bindValue(":v", $dados['valor']);
            $cmd->execute();
        }
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
        $cmd = $this->conn->prepare("DELETE FROM produtos where id = :id");
        $cmd->bindValue(":id", $id);
        return $cmd->execute();
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
}
